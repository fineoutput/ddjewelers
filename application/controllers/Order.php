<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Order extends CI_Controller
{
    function __construct()
    {
        require_once('./vendor/autoload.php');
        parent::__construct();
        $this->load->library('user_agent');
        // $this->load->library('paypal_lib');
        $this->load->model("admin/login_model");
        $this->load->model("admin/base_model");
        $this->load->library("pagination");
    }
    public function checkout()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('selected_address', 'selected_address', 'required|xss_clean|trim');
            if ($this->form_validation->run() == TRUE) {
                $address_id = $this->input->post('selected_address');
                $user_id = $this->session->userdata('user_id');
                $ip = $this->input->ip_address();
                date_default_timezone_set("Asia/Calcutta");
                $cur_date = date("Y-m-d H:i:s");
                $totalAmount = 0;
                $txn_id =  substr(hash('sha256', mt_rand() . microtime()), 0, 20);
                $this->db->select('*');
                $this->db->from('tbl_cart');
                $this->db->where('user_id', $user_id);
                $cart_da = $this->db->get();
                $total_cart_amount = 0;
                $total_cart_amount1 = 0;
                $order_details = [];
                if (!empty($cart_da)) {
                    $i = 1;
                    $last_order_id = 0;
                    foreach ($cart_da->result() as $data) {
                        $quantity = $data->quantity;
                        $inventory = 0;
                        $status = "";
                        $pro_da = $this->db->get_where('tbl_products', array('pro_id' => $data->pro_id))->row();
                        if (!empty($pro_da)) {
                            $full_images = json_decode($pro_da->full_set_images);
                            $images = json_decode($pro_da->images);
                            $group_images = json_decode($pro_da->group_images);
                            $all_images = [];
                            if (!empty($full_images)) {
                                $all_images = $full_images;
                            } else if (!empty($images)) {
                                $all_images = $images;
                            } else if (!empty($group_images)) {
                                $all_images = $group_images;
                            }
                            $sku = $pro_da->sku;
                            if (!empty($data->price)) {
                                $pro_qty_price = $quantity * $data->price;
                                $total_cart_amount += $pro_qty_price;
                            } else {
                                $this->session->set_flashdata('emessage', 'Some error occurred.');
                                redirect($_SERVER['HTTP_REFERER']);
                            }
                            $delivery_charge = 0;
                            //----- check inventory ----------------
                            $invRes = $this->check_Inventory($data->pro_id, $quantity);
                            if ($invRes['data'] == false) {
                                $response['status'] = false;
                                $response['message'] = $invRes['data_message'];
                                echo json_encode($response);
                                return;
                            }
                            if ($i == 1) {
                                //---------------- Order1 entry ------
                                $data_insert_order1 = array(
                                    'user_id' => $user_id,
                                    'total_amount' => $total_cart_amount,
                                    'address_id' => $address_id,
                                    'payment_type' => 0,
                                    'payment_status' => 0,
                                    'order_status' => 0,
                                    'delivery_charge' => $delivery_charge,
                                    'txnid' => $txn_id,
                                    'ip' => $ip,
                                    'date' => $cur_date
                                );
                                $last_order_id = $this->base_model->insert_table("tbl_order1", $data_insert_order1, 1);
                            }
                            if ($data->img) {
                                $order_img = $data->img;
                            } else if ($all_images) {
                                $order_img = $all_images[0]->ZoomUrl;
                            } else {
                                $order_img = '';
                            }
                            //---------------- Order2 entry ------
                            $data_insert = array(
                                'pro_id' => $data->pro_id,
                                'details' => json_encode($pro_da->elements),
                                'description' => $pro_da->short_description,
                                'ring_size' => $data->ring_size,
                                'ring_price' => $data->ring_price,
                                'quantity' => $data->quantity,
                                'amount' => $pro_qty_price,
                                'main_id' => $last_order_id,
                                'unit_price' => $data->price,
                                'series_id' => $pro_da->series_id,
                                'category_id' => $pro_da->category_id,
                                'gem_data' => $data->gem_data,
                                'monogram' => $data->monogram,
                                'mono_chain_length' => $data->mono_chain_length,
                                'engrave_data' => $data->engrave_data,
                                'img' => $order_img,
                                'sku' => $pro_da->sku,
                                'date' => $cur_date
                            );
                            $last_id = $this->base_model->insert_table("tbl_order2", $data_insert, 1);
                            //calculate total cart amount
                            $totalAmount = $totalAmount + $pro_qty_price;
                            $i++;
                        }
                    }
                    $address_data = $this->db->get_where('tbl_user_address', array('is_active' => 1, 'id' => $address_id))->row();
                    $state_data = $this->db->get_where('tbl_state_detail', array('is_active' => 1, 'zip_code' => $address_data->zipcode))->row();
                    if (!empty($state_data) && $state_data->Percentage != 0) {
                        $delivery_charge = round($total_cart_amount * $state_data->Percentage / 100, 2);
                    } else {
                        $delivery_charge = 0;
                    }
                    $data_insert_order11 = array(
                        'total_amount' => $total_cart_amount,
                        'delivery_charge' => $delivery_charge,
                    );
                    $this->db->where('id', $last_order_id);
                    $zapak2 = $this->db->update('tbl_order1', $data_insert_order11);
                    $this->session->set_userdata('order_id', $last_order_id);
                    redirect("Order/view_checkout/" . base64_encode($last_order_id), "refresh");
                } else {
                    $this->session->set_flashdata('emessage', 'Some error occurred!');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            } else {
                $this->session->set_flashdata('emessage', validation_errors());
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->session->set_flashdata('emessage', 'Some error occurred.Post data not found.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    // ======================= START CHECK INVENTORY =====================
    public function check_Inventory($id, $qty)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.stuller.com/v2/products?ProductId=' . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic ZGV2amV3ZWw6Q29kaW5nMjA9',
                'Host: api.stuller.com',
                'Cookie: AWSALB=1Sg7jQ5WrUEnBoDmGaVnJorbqXXyK+dQqUw2GqaBRbmyB6wS6B3VR4K87ey+TZIJ5mvDqbTHnp6sD/1ka744OTa6umVGWUfMgFASSRnN0Qg1xRkh7tPLbCA3hfBh; AWSALBCORS=1Sg7jQ5WrUEnBoDmGaVnJorbqXXyK+dQqUw2GqaBRbmyB6wS6B3VR4K87ey+TZIJ5mvDqbTHnp6sD/1ka744OTa6umVGWUfMgFASSRnN0Qg1xRkh7tPLbCA3hfBh'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $response_dec = json_decode($response);
        if (!empty($response_dec->Products)) {
            foreach ($response_dec->Products as $res) {
                $inventory = $res->OnHand;
                $status = $res->Status;
            }
        }
        if (!empty($status) && $status != 'Out Of Stock') {
            $db_quantity = $inventory;
            if ($status == 'Made To Order') {

                $data['data'] = true;
            } else {

                if ($db_quantity >= $qty) {
                    $data['data'] = true;
                } else {
                    $data['data'] = false;
                    $data['data_message'] = 'Product is out of stock';
                }
            }
        } else {
            $data['data'] = false;
            $data['data_message'] = 'Product is out of stock';
        }
        return $data;
    }
    public function view_checkout($idd)
    {
        // echo $idd;exit;
        $user_id = $this->session->userdata('user_id');
        $order_id = $this->session->userdata('order_id');

        if (!empty($user_id && $order_id)) {
       
            $id = base64_decode($idd);
            $data['id'] = $idd;
            $order_data = $this->db->get_where('tbl_order1', array('id' => $id))->result();
            $this->db->select('*');
            $this->db->from('tbl_cart');
            $this->db->where('user_id', $user_id);
            $cart_da = $this->db->get();
            $address_data = $this->db->get_where('tbl_user_address', array('id' => $order_data[0]->address_id))->result();
            $country_id = $address_data[0]->country_id;
            // echo  $country_id;
            $ship_data = $this->db->select('*')->where("JSON_CONTAINS(country_id, '[\"$country_id\"]')>0")->where('is_active', 1)->get('tbl_shipment')->result();
            // print_r($order_data[0]->total_amount);die();
            //---- fetch methods of selected country ------------
            $method_data = [];
            $error_msg = '';
            if (!empty($ship_data)) {
                foreach ($ship_data as $ship) {
                    $methods = json_decode($ship->method_id);
                    if (count($methods) > 1) {
                        foreach ($methods as $method) {
                            $meth_data = $this->db->get_where('tbl_method', array('is_active' => 1, 'id' => $method))->result();
                            if (!empty($meth_data[0]->max)) {
                                if ($meth_data[0]->max >= $order_data[0]->total_amount) {
                                    $method_data[] = array('shipping_id' => $ship->id, 'id' => $meth_data[0]->id, 'name' => $meth_data[0]->name, 'max' => $meth_data[0]->max);
                                }
                            } else {
                                $method_data[] = array('shipping_id' => $ship->id, 'id' => $meth_data[0]->id, 'name' => $meth_data[0]->name, 'max' => $meth_data[0]->max);
                            }
                        }
                    } else {
                        // print_r($methods);die();
                        $meth_data = $this->db->get_where('tbl_method', array('is_active' => 1, 'id' => $methods[0]))->result();
                        if (!empty($meth_data[0]->max)) {
                            if ($meth_data[0]->max >= $order_data[0]->total_amount) {
                                $method_data[] = array('shipping_id' => $ship->id, 'id' => $meth_data[0]->id, 'name' => $meth_data[0]->name, 'max' => $meth_data[0]->max);
                            }
                        } else {
                            $method_data[] = array('shipping_id' => $ship->id, 'id' => $meth_data[0]->id, 'name' => $meth_data[0]->name, 'max' => $meth_data[0]->max);
                        }
                    }
                }
            } else {
                $error_msg = "we are currently not servable in the selected county";
            }
            $temp_array = array();
            $i = 0;
            $key_array = array();
            $key = "name";
            //---- unique methods of selected country ------------
            foreach ($method_data as $val) {
                if (!in_array($val[$key], $key_array)) {
                    $key_array[$i] = $val[$key];
                    $temp_array[$i] = $val;
                }
                $i++;
            }

            //---- fectch cost of selected country ------------
            $shipping_costs = [];
            if (!empty($temp_array)) {
                foreach ($temp_array as $temp) {
                    $costs_data = $this->db->get_where('tbl_shippingrules', array('is_active' => 1, 'shipping_id' => $temp['shipping_id']))->result();
                    foreach ($costs_data as $cost) {
                        if ($cost->start_price <= $order_data[0]->total_amount && $cost->end_price >= $order_data[0]->total_amount) {
                            $shipping_costs[] = array('shipping_id' => $cost->shipping_id, 'id' => $cost->id, 'shipment_cost' => $cost->shipment_cost);
                        }
                    }
                    // print_r($shipping_costs);die();
                }
            }

            //---- remove method where  cost not found ------------
            if (!empty($temp_array)) {
                foreach ($temp_array as $key => $temp2) {
                    $a = 0;
                    foreach ($shipping_costs as $ship2) {
                        if ($ship2['shipping_id'] == $temp2['shipping_id']) {
                            $a = 1;
                            break;
                        }
                    }
                    if ($a == 0) {
                        unset($temp_array[$key]);
                    }
                }
            }
            $temp_array = array_values($temp_array);
            //-------- updating shipping data ---------
            if (!empty($shipping_costs)) {
                if (empty($order_data[0]->shipping_id)) {
                    $data_update2 = array(
                        'shipping_id' => $shipping_costs[0]['shipping_id'],
                        'method_id' => $temp_array ? $temp_array[0]['id'] : '',
                        'shipping' => $shipping_costs[0]['shipment_cost'],
                        'shipping_rule_id' => $shipping_costs[0]['id'],
                        'final_amount' => $order_data[0]->total_amount + $shipping_costs[0]['shipment_cost'] + $order_data[0]->delivery_charge,
                    );
                    $this->db->where('id', $id);
                    $zapak2 = $this->db->update('tbl_order1', $data_update2);
                }
            }
            // if(!empty($zapak2)){
            $order1_data = $this->db->get_where('tbl_order1', array('id' => $order_data[0]->id))->result();
            $order2_data = $this->db->get_where('tbl_order2', array('main_id' => $order_data[0]->id))->result();
            $promocode_data = $this->db->get_where('tbl_promocode', array('id' => $order_data[0]->promocode))->result();
            // print_r($temp_array);
            // echo "<br>";
            // print_r($order_data);die();
            $data2['order1_data'] = $order1_data;
            $data2['order2_data'] = $order2_data;
            $data2['promocode_data'] = $promocode_data;
            $data2['address_id'] = $order_data[0]->address_id;
            $data2['cart_data'] = $cart_da;
            $data2['error_msg'] = $error_msg;
            $data2['methods_data'] = array_values($temp_array);
            $data2['shipping_costs'] = array_values($shipping_costs);
            // $gateway = new Braintree\Gateway([
            //     'environment' => 'sandbox',
            //     'merchantId' => 't88vsbn73n3ktmvc',
            //     'publicKey' => 'jwvgk8z38gwjywgr',
            //     'privateKey' => '880e71aeb8ff9eed853f45dc76627f86'
            // ]);
            // $gateway = new Braintree\Gateway([
            //     'environment' => GOOGLE_PAY_ENVIRONMENTSEC,
            //     'merchantId' => GOOGLE_PAY_MERCHANTIDSEC,
            //     'publicKey' => GOOGLE_PAY_PUBLICKKEY,
            //     'privateKey' => GOOGLE_PAY_PRIVATEKEY
            // ]);
            // pass $clientToken to your front-end
            // $clientToken = $gateway->clientToken()->generate([
            //     "customerId" => $aCustomerId
            // ]);
            // $data2['braintree_auth'] = ($clientToken = $gateway->clientToken()->generate());
            $data2['transaction_token'] = $this->convergepay($order1_data[0]->final_amount);
            $this->load->view('common/header', $data2);
            $this->load->view('checkout');
            $this->load->view('common/footer');
            // }else{
            //     echo "hi";
            // }
        } else {
            redirect("/", "refresh");
        }
    }
    public function viewemail()
    {
        $this->db->select('*');
        $this->db->from('tbl_order1');
        $this->db->where('id', 232);
        $order1 = $this->db->get()->row();
        $this->db->select('*');
        $this->db->from('tbl_users');
        $this->db->where('id', $order1->user_id);
        $user = $this->db->get()->row();
        if (!empty($user->email)) {
            $to = $user->email;
            $name = $user->name;
            $data['name'] = $name;
            $data['order1_id'] = $order1->id;
            $data['order1_data'] = $order1;
            $message = $this->load->view('email', $data, TRUE);
            print_r($message);
            exit;
        }
        $this->load->view('email');
    }
    //==================== Google Pay order placing ==============
    public function  googlePay_verify()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('id', 'id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('nonce', 'nonce', 'required|xss_clean|trim');
            $this->form_validation->set_rules('amount', 'amount', 'required|xss_clean|trim');
            if ($this->form_validation->run() == TRUE) {
                $id = $this->input->post('id');
                $nonce = $this->input->post('nonce');
                $amount = $this->input->post('amount');
                $ip = $this->input->ip_address();
                date_default_timezone_set("Asia/Calcutta");
                $cur_date = date("Y-m-d H:i:s");
                // $gateway = new Braintree\Gateway([
                //     'environment' => 'sandbox',
                //     'merchantId' => 't88vsbn73n3ktmvc',
                //     'publicKey' => 'jwvgk8z38gwjywgr',
                //     'privateKey' => '880e71aeb8ff9eed853f45dc76627f86'
                // ]);
                $gateway = new Braintree\Gateway([
                    'environment' => GOOGLE_PAY_ENVIRONMENTSEC,
                    'merchantId' => GOOGLE_PAY_MERCHANTIDSEC,
                    'publicKey' => GOOGLE_PAY_PUBLICKKEY,
                    'privateKey' => GOOGLE_PAY_PRIVATEKEY
                ]);
                $result = $gateway->transaction()->sale([
                    'amount' => $amount,
                    'paymentMethodNonce' => $nonce,
                    'deviceData' => '',
                    'orderId' => $id,
                    // 'options' => [
                    //     'submitForSettlement' => True,
                    //     'paypal' => [
                    //         'customField' => $_POST["PayPal custom field"],
                    //         'description' => $_POST["Description for PayPal email receipt"],
                    //   ],
                    // ],
                ]);
                if ($result->success) {
                    // print_r("Success ID: " . $result->transaction->id);
                    $order1_data = $this->db->get_where('tbl_order1', array('id' => $id))->result();
                    $data_update = array(
                        'gpay_token' => $result->transaction->id,
                        'payment_type' => 'Google Pay',
                        'payment_status' => 1,
                        'order_status' => 1,
                    );
                    $this->db->where('id', $id);
                    $zapak = $this->db->update('tbl_order1', $data_update);
                    $user_id = $this->session->userdata('user_id');
                    //------------User Sent Email Start--------------//
                    $config = array(
                        'protocol' => 'smtp',
                        'smtp_host' => SMTP_HOST,
                        'smtp_port' => SMTP_PORT,
                        'smtp_user' => USER_NAME, // change it to yours
                        'smtp_pass' => PASSWORD, // change it to yours
                        'mailtype' => 'html',
                        'charset' => 'iso-8859-1',
                        'wordwrap' => true
                    );
                    $this->db->select('*');
                    $this->db->from('tbl_order1');
                    $this->db->where('id', $id);
                    $order1 = $this->db->get()->row();
                    $this->db->select('*');
                    $this->db->from('tbl_users');
                    $this->db->where('id', $order1->user_id);
                    $user = $this->db->get()->row();
                    if (!empty($user->email)) {
                        $to = $user->email;
                        $name = $user->name;
                        $data['name'] = $name;
                        $data['order1_id'] = $id;
                        $data['order1_data'] = $order1;
                        $message = $this->load->view('email', $data, TRUE);
                        //  print_r($message);
                        // exit;
                        $this->load->library('email', $config);
                        $this->email->set_newline("");
                        $this->email->from(EMAIL, EMAIL_NAME); // change it to yours
                        $this->email->to($to); // change it to yours
                        $this->email->subject('Order Placed');
                        $this->email->message($message);
                        if ($this->email->send()) {
                        } else {
                            // show_error($this->email->print_debugger());
                        }
                    }
                    //------------User Sent Email End--------------//
                    //------------sent email to admin--------------//
                    $data2['name'] = 'Admin';
                    $data2['order1_id'] = $id;
                    $data2['order1_data'] = $order1;
                    $message2 = $this->load->view('admin_email', $data2, TRUE);
                    $this->load->library('email', $config);
                    $this->email->set_newline("");
                    $this->email->from(EMAIL, EMAIL_NAME); // change it to yours
                    // $this->email->to('jewelplus@gmail.com');  // change it to yours
                    $this->email->to(TO);  // change it to yours
                    $this->email->subject('New order received');
                    $this->email->message($message2);
                    if ($this->email->send()) {
                    } else {
                        // show_error($this->email->print_debugger());
                    }
                    //------------sent email to admin End--------------//
                    if ($zapak != 0) {
                        $this->session->set_flashdata('order_id', $id);
                        $this->session->set_flashdata('amount', $order1_data[0]->final_amount);
                        // redirect("Home/order_success", "refresh");
                        $delete = $this->db->delete('tbl_cart', array('user_id' => $user_id));
                        $respone['status'] = true;
                        $respone['message'] = "Success";
                        echo json_encode($respone);
                    }
                } else {
                    // print_r("Error Message: " . $result->message);
                    $respone['status'] = false;
                    $respone['message'] = $result->message;
                    echo json_encode($respone);
                }
            } else {
                $respone['status'] = false;
                $respone['message'] = validation_errors();
                echo json_encode($respone);
            }
        } else {
            $respone['status'] = false;
            $respone['message'] = 'Please insert some data, No data available';
            echo json_encode($respone);
        }
    }
    //------ change shipping method  ----------
    public function change_shipping_method()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('method_id', 'method_id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('shipping_arr', 'shipping_arr', 'required|xss_clean|trim');
            $this->form_validation->set_rules('shipping_id', 'shipping_id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('index', 'index', 'required|xss_clean|trim');
            $this->form_validation->set_rules('id', 'id', 'required|xss_clean|trim');
            if ($this->form_validation->run() == TRUE) {
                $method_id = $this->input->post('method_id');
                $shipping_arr = json_decode($this->input->post('shipping_arr'));
                $shipping_id = $this->input->post('shipping_id');
                $index = $this->input->post('index');
                $id = $this->input->post('id');
                $order_data = $this->db->get_where('tbl_order1', array('id' => $id))->result();
                // print_r($shipping_arr[$index]->shipment_cost);die();
                //-------- updating shipping data ---------
                $data_update2 = array(
                    'shipping_id' => $shipping_id,
                    'method_id' => $method_id,
                    'shipping' => $shipping_arr[$index]->shipment_cost,
                    'shipping_rule_id' =>  $shipping_arr[$index]->id,
                    'final_amount' => $order_data[0]->total_amount + $shipping_arr[$index]->shipment_cost - $order_data[0]->p_discount + $order_data[0]->delivery_charge,
                );
                $this->db->where('id', $id);
                $zapak2 = $this->db->update('tbl_order1', $data_update2);
                $respone['status'] = true;
                $respone['message'] = "Success";
                echo json_encode($respone);
            } else {
                $this->session->set_flashdata('emessage', validation_errors());
                //header('Access-Control-Allow-Origin: *');
                $respone['status'] = false;
                $respone['message'] = validation_errors();
                echo json_encode($respone);
            }
        } else {
            $this->session->set_flashdata('emessage', 'Please insert some data, No data available');
            $respone['status'] = false;
            $respone['message'] = 'Please insert some data, No data available';
            echo json_encode($respone);
        }
    }
    //------------ Apply promocode  ----------
    public function apply_promocode()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('promocode', 'promocode', 'required|xss_clean|trim');
            $this->form_validation->set_rules('id', 'id', 'required|xss_clean|trim');
            if ($this->form_validation->run() == TRUE) {
                $promocode = $this->input->post('promocode');
                $id = json_decode($this->input->post('id'));
                $order_data = $this->db->get_where('tbl_order1', array('id' => $id))->result();
                $order2_data = $this->db->get_where('tbl_order2', array('main_id' => $id))->result();
                $promo_data = $this->db->like('name', $promocode)->get_where('tbl_promocode', array('is_active' => 1))->result();
                date_default_timezone_set("Asia/Calcutta");
                $user_id = $this->session->userdata('user_id');
                $cur_date = strtotime(date("Y-m-d"));
                if (!empty($promo_data)) {
                    $promocodeUsed = $this->db->get_where('tbl_order1', array('promocode' => $promo_data[0]->id, 'payment_status' => 1))->num_rows();;
                    //==================== check promocode expiry date ========================
                    if (strtotime($promo_data[0]->vaild_until) >= $cur_date && strtotime($promo_data[0]->vaild_form) <= $cur_date) {
                        //==================== check allowed users limit ========================
                        if ($promo_data[0]->allowed_uses >= $promocodeUsed) {
                            //==================== check minimum amount  ========================
                            if ($order_data[0]->total_amount > $promo_data[0]->minpurchase) {
                                //==================== for entire website ========================
                                if ($promo_data[0]->ptype == 1) {
                                    //---- for percentage off ------
                                    if ($promo_data[0]->type == 1) {
                                        $discount = round($order_data[0]->total_amount * $promo_data[0]->percentage_amount / 100);
                                        //---- for fixed amount off ------
                                    } else {
                                        $discount = round($promo_data[0]->percentage_amount);
                                    }
                                    //==================== for specific item ====================
                                } else if ($promo_data[0]->ptype == 2) {
                                    $series_ids = json_decode($promo_data[0]->ids);
                                    $series_arr = explode(',', $series_ids);
                                    // print_r($series_arr);die();
                                    $discount = 0;
                                    foreach ($order2_data as $order2) {
                                        foreach ($series_arr as $sr) {
                                            if ($order2->series == $sr) {
                                                $discount += round($order2->amount * $promo_data[0]->percentage_amount / 100);
                                                break;
                                            }
                                        }
                                    }
                                    if ($promo_data[0]->type != 1) {
                                        $discount = round($promo_data[0]->percentage_amount);
                                    }
                                    //==================== for specific category ====================
                                } else {
                                    $cat_ids = json_decode($promo_data[0]->ids);
                                    $discount = 0;
                                    foreach ($order2_data as $order2) {
                                        foreach ($cat_ids as $cr) {
                                            if ($order2->cat_id == $cr) {
                                                $discount += round($order2->amount * $promo_data[0]->percentage_amount / 100);
                                                break;
                                            }
                                        }
                                    }
                                    if ($promo_data[0]->type != 1) {
                                        $discount = round($promo_data[0]->percentage_amount);
                                    }
                                }
                                // echo $discount;die();
                                $data_update = array(
                                    'p_discount' => $discount,
                                    'promocode' => $promo_data[0]->id,
                                    'final_amount' => $order_data[0]->total_amount + $order_data[0]->shipping + $order_data[0]->delivery_charge -  $discount
                                );
                                $this->db->where('id', $id);
                                $zapak = $this->db->update('tbl_order1', $data_update);
                                $this->session->set_flashdata('smessage', 'Promocode Applied Successfully!');
                                redirect($_SERVER['HTTP_REFERER']);
                            } else {
                                //------- promocode minimum amount --------
                                $this->session->set_flashdata('emessage', 'The applicable promocode amount is greater than $' . $promo_data[0]->minpurchase);
                                redirect($_SERVER['HTTP_REFERER']);
                            }
                        } else {
                            //------- promocode used limit exceed --------
                            $this->session->set_flashdata('emessage', 'Invalid Promocode!');
                            redirect($_SERVER['HTTP_REFERER']);
                        }
                    } else {
                        //------- promocode expired --------
                        $this->session->set_flashdata('emessage', 'Invalid Promocode!');
                        redirect($_SERVER['HTTP_REFERER']);
                    }
                } else {
                    //------- Invalid promocode name --------
                    $this->session->set_flashdata('emessage', 'Invalid Promocode!');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            } else {
                $this->session->set_flashdata('emessage', validation_errors());
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->session->set_flashdata('emessage', 'Some error occurred.Post data not found.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    // ================ Remove promocode ===============
    public function remove_promocode()
    {
        $user_id = $this->session->userdata('user_id');
        $order_id = $this->session->userdata('order_id');
        if (!empty($user_id && $order_id)) {
            $order1_data = $this->db->get_where('tbl_order1', array('id' => $order_id))->result();
            if (!empty($order1_data)) {
                $data_update2 = array(
                    'promocode' => '',
                    'p_discount' => '',
                    'final_amount' => $order1_data[0]->final_amount + $order1_data[0]->p_discount,
                );
                $this->db->where('id', $order_id);
                $zapak2 = $this->db->update('tbl_order1', $data_update2);
                $this->session->set_flashdata('smessage', 'Promocode Removed Successfully!');
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect("/", "refresh");
            }
        } else {
            redirect("/", "refresh");
        }
    }
    //==================== affirm order placing ==============
    public function  affirm_success()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('id', 'id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('checkout_token', 'checkout_token', 'required|xss_clean|trim');
            if ($this->form_validation->run() == TRUE) {
                $id = $this->input->post('id');
                $checkout_token = $this->input->post('checkout_token');
                $ip = $this->input->ip_address();
                date_default_timezone_set("Asia/Calcutta");
                $cur_date = date("Y-m-d H:i:s");
                $order1_data = $this->db->get_where('tbl_order1', array('id' => $id))->result();
                $data_update = array(
                    'affirm_token' => $checkout_token,
                    'payment_type' => 'Affirm',
                    'payment_status' => 1,
                    'order_status' => 1,
                );
                $this->db->where('id', $id);
                $zapak = $this->db->update('tbl_order1', $data_update);
                $user_id = $this->session->userdata('user_id');
                //------------User Sent Email Start--------------//
                $config = array(
                    'protocol' => 'smtp',
                    'smtp_host' => SMTP_HOST,
                    'smtp_port' => SMTP_PORT,
                    'smtp_user' => USER_NAME, // change it to yours
                    'smtp_pass' => PASSWORD, // change it to yours
                    'mailtype' => 'html',
                    'charset' => 'iso-8859-1',
                    'wordwrap' => true
                );
                $this->db->select('*');
                $this->db->from('tbl_order1');
                $this->db->where('id', $id);
                $order1 = $this->db->get()->row();
                $this->db->select('*');
                $this->db->from('tbl_users');
                $this->db->where('id', $order1->user_id);
                $user = $this->db->get()->row();
                // echo $user->email;  
                if (!empty($user->email)) {
                    $to = $user->email;
                    $name = $user->name;
                    $data['name'] = $name;
                    $data['order1_id'] = $id;
                    $data['order1_data'] = $order1;
                    $message = $this->load->view('email', $data, TRUE);
                    //  print_r($message);
                    // exit;
                    $this->load->library('email', $config);
                    $this->email->set_newline("");
                    $this->email->from(EMAIL, EMAIL_NAME); // change it to yours
                    $this->email->to($to); // change it to yours
                    $this->email->subject('Order Placed');
                    $this->email->message($message);
                    if ($this->email->send()) {
                    } else {
                        // show_error($this->email->print_debugger());
                    }
                }
                //------------User Sent Email End--------------//
                //------------sent email to admin--------------//
                $data2['name'] = 'Admin';
                $data2['order1_id'] = $id;
                $data2['order1_data'] = $order1;
                $message2 = $this->load->view('admin_email', $data2, TRUE);
                $this->load->library('email', $config);
                $this->email->set_newline("");
                $this->email->from(EMAIL, EMAIL_NAME); // change it to yours
                // $this->email->to('jewelplus@gmail.com');  // change it to yours
                $this->email->to(TO);  // change it to yours
                $this->email->subject('New order received');
                $this->email->message($message2);
                if ($this->email->send()) {
                } else {
                    // show_error($this->email->print_debugger());
                }
                //------------sent email to admin End--------------//
                if ($zapak != 0) {
                    $this->session->set_flashdata('order_id', $id);
                    $this->session->set_flashdata('amount', $order1_data[0]->final_amount);
                    // redirect("Home/order_success", "refresh");
                    $delete = $this->db->delete('tbl_cart', array('user_id' => $user_id));
                    $respone['status'] = true;
                    $respone['message'] = "Success";
                    echo json_encode($respone);
                }
            } else {
                $respone['status'] = false;
                $respone['message'] = validation_errors();
                echo json_encode($respone);
            }
        } else {
            $respone['status'] = false;
            $respone['message'] = 'Please insert some data, No data available';
            echo json_encode($respone);
        }
    }
    public function  google_success()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('order_id', 'order_id', 'required|xss_clean|trim');
            // $this->form_validation->set_rules('gpay_token', 'gpay_token', 'required|xss_clean|trim');
            if ($this->form_validation->run() == TRUE) {
                $order_id = $this->input->post('order_id');
                // $gpay_token = $this->input->post('gpay_token');
                $ip = $this->input->ip_address();
                date_default_timezone_set("Asia/Calcutta");
                $cur_date = date("Y-m-d H:i:s");
                $order1_data = $this->db->get_where('tbl_order1', array('id' => $order_id))->result();
                $data_update = array(
                    // 'gpay_token' => $gpay_token,
                    'payment_type' => 'Google Pay',
                    'payment_status' => 1,
                    'order_status' => 1,
                );
                $this->db->where('id', $order_id);
                $zapak = $this->db->update('tbl_order1', $data_update);
                $user_id = $this->session->userdata('user_id');
                if ($zapak != 0) {
                    $this->session->set_flashdata('order_id', $order_id);
                    $this->session->set_flashdata('amount', $order1_data[0]->final_amount);
                    $delete = $this->db->delete('tbl_cart', array('user_id' => $user_id));
                    // redirect("Home/order_success", "refresh");
                    $respone['status'] = true;
                    $respone['message'] = "Success";
                    echo json_encode($respone);
                }
            } else {
                $respone['status'] = false;
                $respone['message'] = validation_errors();
                echo json_encode($respone);
            }
        } else {
            $respone['status'] = false;
            $respone['message'] = 'Please insert some data, No data available';
            echo json_encode($respone);
        }
    }

    public function delete_address($idd)
    {

        if (!empty($this->session->userdata('user_id'))) {

            $id = base64_decode($idd);
            $user_id = $this->session->userdata('user_id');

            $this->db->select('id');
            $this->db->from('tbl_user_address');
            $this->db->where('id', $id);
            $this->db->where('user_id', $user_id);
            $da = $this->db->get()->row();

            if (!empty($da)) {
                $data_update = array(
                    'is_active' => 0,
                );
                $this->db->where('id', $id);
                $zapak = $this->db->update('tbl_user_address', $data_update);
                if ($zapak != 0) {
                    $this->session->set_flashdata('smessage', 'Address successfully deleted!');
                    redirect($_SERVER['HTTP_REFERER']);
                } else {
                    $this->session->set_flashdata('emessage', 'Sorry error occured');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            } else {
                $this->session->set_flashdata('emessage', 'Sorry error occured');
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            redirect("Home/login", "refresh");
        }
    }

    //Converge payment Callback function

    public function convergepay($amount) {
       
        $url = 'https://api.demo.convergepay.com/hosted-payments/transaction_token';
        $accountId = '0022788';  // Replace with your actual account ID
        $userId = 'apiuser';     // Replace with your actual user ID
        $pin = '2VGA0V4YSBJR5WFAXBAB0XYXNSM6I8UVV6ZRYC3G6S4HCFOESN0KC73PN2GI3ZUN';  // Replace with your actual PIN

        $postFields = http_build_query([
            'ssl_transaction_type' => 'ccsale',
            'ssl_account_id'        => $accountId,
            'ssl_user_id'           => $userId,
            'ssl_pin'               => $pin,
            'ssl_amount'            => $amount,
        ]);

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30, // Set a reasonable timeout value
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $postFields,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/x-www-form-urlencoded'
            ],
        ]);

        $response = curl_exec($ch);

        curl_close($ch);

        return $response;
             
    }

    public function process_payment() {
        
        print_r($_POST);
        print_r($_GET);
    }
    
}
