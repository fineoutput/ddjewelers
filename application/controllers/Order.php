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
            // print_r($this->input->post());
            // exit;
            $this->form_validation->set_rules('selected_address', 'selected_address', 'required|xss_clean|trim');
            if ($this->form_validation->run() == TRUE) {
                $address_id = $this->input->post('selected_address');
                $user_id = $this->session->userdata('user_id');
                $ip = $this->input->ip_address();
                date_default_timezone_set("Asia/Calcutta");
                $cur_date = date("Y-m-d H:i:s");
                $totalAmount = 0;
                $txnid =  substr(hash('sha256', mt_rand() . microtime()), 0, 20);
                $this->db->select('*');
                $this->db->from('tbl_cart');
                $this->db->where('user_id', $user_id);
                $cart_da = $this->db->get();
                $total_cart_amount = 0;
                $total_cart_amount1 = 0;
                if (!empty($cart_da)) {
                    // echo "f"; echo '<pre>'; print_r($cart_da->result()); die();
                    $i = 1;
                    $last_order_id = 0;
                    foreach ($cart_da->result() as $data) {
                        $product_id = $data->product_id;
                        $quantity = $data->quantity;
                        $inventory = 0;
                        $status = "";
                        //get product sku start
                        if (empty($data->stuller_pro_id)) {
                            $this->db->select('*');
                            $this->db->from('tbl_products');
                            $this->db->where('id', $product_id);
                            $this->db->where('is_active', 1);
                            $pro_da = $this->db->get()->row();
                        } else {
                            $this->db->select('*');
                            $this->db->from('tbl_quickshop_products');
                            $this->db->where('product_id', $data->stuller_pro_id);
                            $this->db->where('is_active', 1);
                            $pro_da = $this->db->get()->row();
                        }
                        if (!empty($pro_da)) {
                            $sku = $pro_da->sku;
                            $this->db->select('*');
                            $this->db->from('tbl_price_rule');
                            $pr_data = $this->db->get()->row();
                            $multiplier = $pr_data->multiplier;
                            $cost_price11 = $pr_data->cost_price1;
                            $cost_price22 = $pr_data->cost_price2;
                            $cost_price33 = $pr_data->cost_price3;
                            $cost_price44 = $pr_data->cost_price4;
                            $cost_price55 = $pr_data->cost_price5;
                            $cost_price = $pro_da->price + $data->ringprice;
                            $retail = $cost_price * $multiplier;
                            $now_price = $cost_price;
                            // echo $now_price;
                            // exit;
                            if ($cost_price <= 500) {
                                $cost_price2 = $cost_price * $cost_price;
                                // $now_price= $cost_price*0.00000264018*($cost_price*2)+(-0.002220133*$cost_price)+1.950022201-1+0.95;
                                $number = round($cost_price * ($cost_price11 * $cost_price2 + $cost_price22 * $cost_price + $cost_price33), 2);
                                $unit = 5;
                                $remainder = $number % $unit;
                                $mround = ($remainder < $unit / 2) ? $number - $remainder : $number + ($unit - $remainder);
                                $now_price = round($mround) - 1 + 0.95;
                                // $now_price = round($mround);
                                // exit;
                            }
                            if ($cost_price > 500) {
                                $number = round($cost_price * ($cost_price44 * $cost_price / $multiplier + $cost_price55));
                                $unit = 5;
                                $remainder = $number % $unit;
                                $mround = ($remainder < $unit / 2) ? $number - $remainder : $number + ($unit - $remainder);
                                $now_price = round($mround) - 1 + 0.95;
                                // $now_price = round($mround);
                            }
                            $pro_qty_price = $quantity * $now_price;
                            $total_cart_amount1 = $total_cart_amount + $pro_qty_price;
                        } else {
                            $sku = "";
                            $this->session->set_flashdata('emessage', 'Some error occured.');
                            redirect($_SERVER['HTTP_REFERER']);
                        }
                        //get product sku end
                        // echo $total_cart_amount;die();
                        //Inventory Check api start
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => 'https://api.stuller.com/v2/products?SKU=' . $sku,
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
                        // echo $response;
                        $response_dec = json_decode($response);
                        // print_r( $response_dec->Products);die();
                        if (!empty($response_dec->Products)) {
                            foreach ($response_dec->Products as $res) {
                                $inventory = $res->OnHand;
                                $status = $res->Status;
                            }
                        }
                        // echo $status;
                        // echo $inventory;
                        // die();
                        //Inventory Check api end
                        if (!empty($status) && $status != 'Out Of Stock') {
                            // $db_quantity=$pro_inv_da->inventory;
                            $db_quantity = $inventory;
                            if ($status == 'Made To Order') {
                                if ($i == 1) {
                                    //tbl order1 entry
                                    $data_insert_order1 = array(
                                        'user_id' => $user_id,
                                        'total_amount' => $total_cart_amount1,
                                        'address_id' => $address_id,
                                        'payment_type' => 0,
                                        'payment_status' => 0,
                                        'order_status' => 0,
                                        'delivery_charge' => 0,
                                        'txnid' => $txnid,
                                        'ip' => $ip,
                                        'date' => $cur_date
                                    );
                                    $last_order_id = $this->base_model->insert_table("tbl_order1", $data_insert_order1, 1);
                                }
                                if (empty($data->stuller_pro_id)) {
                                    $this->db->select('*');
                                    $this->db->from('tbl_products');
                                    $this->db->where('id', $data->product_id);
                                    $this->db->where('is_active', 1);
                                    $pro_da = $this->db->get()->row();
                                } else {
                                    $this->db->select('*');
                                    $this->db->from('tbl_quickshop_products');
                                    $this->db->where('product_id', $data->stuller_pro_id);
                                    $this->db->where('is_active', 1);
                                    $pro_da = $this->db->get()->row();
                                }
                                if (!empty($pro_da)) {
                                    $sku = $pro_da->sku;
                                    $this->db->select('*');
                                    $this->db->from('tbl_price_rule');
                                    $pr_data = $this->db->get()->row();
                                    $multiplier = $pr_data->multiplier;
                                    $cost_price11 = $pr_data->cost_price1;
                                    $cost_price22 = $pr_data->cost_price2;
                                    $cost_price33 = $pr_data->cost_price3;
                                    $cost_price44 = $pr_data->cost_price4;
                                    $cost_price55 = $pr_data->cost_price5;
                                    $cost_price = $pro_da->price + $data->ringprice;
                                    $retail = $cost_price * $multiplier;
                                    $now_price = $cost_price;
                                    // echo $now_price;
                                    // exit;
                                    if ($cost_price <= 500) {
                                        $cost_price2 = $cost_price * $cost_price;
                                        // $now_price= $cost_price*0.00000264018*($cost_price*2)+(-0.002220133*$cost_price)+1.950022201-1+0.95;
                                        $number = round($cost_price * ($cost_price11 * $cost_price2 + $cost_price22 * $cost_price + $cost_price33), 2);
                                        $unit = 5;
                                        $remainder = $number % $unit;
                                        $mround = ($remainder < $unit / 2) ? $number - $remainder : $number + ($unit - $remainder);
                                        $now_price = round($mround) - 1 + 0.95;
                                        // $now_price = round($mround);
                                        // exit;
                                    }
                                    if ($cost_price > 500) {
                                        $number = round($cost_price * ($cost_price44 * $cost_price / $multiplier + $cost_price55));
                                        $unit = 5;
                                        $remainder = $number % $unit;
                                        $mround = ($remainder < $unit / 2) ? $number - $remainder : $number + ($unit - $remainder);
                                        $now_price = round($mround) - 1 + 0.95;
                                        // $now_price = round($mround);
                                    }
                                    $pro_qty_price = $quantity * $now_price;
                                    $total_cart_amount = $total_cart_amount + $pro_qty_price;
                                    $selling_price = $now_price;
                                    $product_qty_price = $pro_qty_price;
                                } else {
                                    $selling_price = 0;
                                    $product_qty_price = 0;
                                }
                                // print_r($data);die();
                                //tbl order2 entry
                                $pr_d = $this->db->get_where('tbl_products', array('id' => $data->product_id))->result();
                                $data_insert = array(
                                    'product_id' => $data->product_id,
                                    'desc_e_name2' => $data->desc_e_name2,
                                    'desc_e_value2' => $data->desc_e_value2,
                                    'desc_e_name3' => $data->desc_e_name3,
                                    'desc_e_value3' => $data->desc_e_value3,
                                    'desc_e_name4' => $data->desc_e_name4,
                                    'desc_e_value4' => $data->desc_e_value4,
                                    'desc_e_name5' => $data->desc_e_name5,
                                    'desc_e_value5' => $data->desc_e_value5,
                                    'ringsize' => $data->ringsize,
                                    'ringprice' => $data->ringprice,
                                    'quantity' => $data->quantity,
                                    'amount' => $product_qty_price,
                                    'main_id' => $last_order_id,
                                    'unit_price' => $selling_price,
                                    'series' => $pr_d[0]->sku_series,
                                    'cat_id' => $pr_d[0]->category,
                                    'date' => $cur_date
                                );
                                $last_id = $this->base_model->insert_table("tbl_order2", $data_insert, 1);
                                //calculate total cart amount
                                $totalAmount = $totalAmount + $product_qty_price;
                                $i++;
                            } else {
                                if ($db_quantity >= $quantity) {
                                    if ($i == 1) {
                                        //tbl order1 entry
                                        $data_insert_order1 = array(
                                            'user_id' => $user_id,
                                            'total_amount' => $total_cart_amount1,
                                            'address_id' => $address_id,
                                            'payment_type' => 0,
                                            'payment_status' => 0,
                                            'order_status' => 0,
                                            'delivery_charge' => 0,
                                            'txnid' => $txnid,
                                            'ip' => $ip,
                                            'date' => $cur_date
                                        );
                                        $last_order_id = $this->base_model->insert_table("tbl_order1", $data_insert_order1, 1);
                                    }
                                    if (empty($data->stuller_pro_id)) {
                                        $this->db->select('*');
                                        $this->db->from('tbl_products');
                                        $this->db->where('id', $data->product_id);
                                        $this->db->where('is_active', 1);
                                        $pro_da = $this->db->get()->row();
                                    } else {
                                        $this->db->select('*');
                                        $this->db->from('tbl_quickshop_products');
                                        $this->db->where('product_id', $data->stuller_pro_id);
                                        $this->db->where('is_active', 1);
                                        $pro_da = $this->db->get()->row();
                                    }
                                    if (!empty($pro_da)) {
                                        $sku = $pro_da->sku;
                                        $this->db->select('*');
                                        $this->db->from('tbl_price_rule');
                                        $pr_data = $this->db->get()->row();
                                        $multiplier = $pr_data->multiplier;
                                        $cost_price11 = $pr_data->cost_price1;
                                        $cost_price22 = $pr_data->cost_price2;
                                        $cost_price33 = $pr_data->cost_price3;
                                        $cost_price44 = $pr_data->cost_price4;
                                        $cost_price55 = $pr_data->cost_price5;
                                        $cost_price = $pro_da->price + $data->ringprice;
                                        $retail = $cost_price * $multiplier;
                                        $now_price = $cost_price;
                                        // echo $now_price;
                                        // exit;
                                        if ($cost_price <= 500) {
                                            $cost_price2 = $cost_price * $cost_price;
                                            // $now_price= $cost_price*0.00000264018*($cost_price*2)+(-0.002220133*$cost_price)+1.950022201-1+0.95;
                                            $number = round($cost_price * ($cost_price11 * $cost_price2 + $cost_price22 * $cost_price + $cost_price33), 2);
                                            $unit = 5;
                                            $remainder = $number % $unit;
                                            $mround = ($remainder < $unit / 2) ? $number - $remainder : $number + ($unit - $remainder);
                                            $now_price = round($mround) - 1 + 0.95;
                                            // $now_price = round($mround);
                                            // exit;
                                        }
                                        if ($cost_price > 500) {
                                            $number = round($cost_price * ($cost_price44 * $cost_price / $multiplier + $cost_price55));
                                            $unit = 5;
                                            $remainder = $number % $unit;
                                            $mround = ($remainder < $unit / 2) ? $number - $remainder : $number + ($unit - $remainder);
                                            $now_price = round($mround) - 1 + 0.95;
                                            // $now_price = round($mround);
                                        }
                                        $pro_qty_price = $quantity * $now_price;
                                        $total_cart_amount = $total_cart_amount + $pro_qty_price;
                                        $selling_price = $now_price;
                                        $product_qty_price = $pro_qty_price;
                                    } else {
                                        $selling_price = 0;
                                        $product_qty_price = 0;
                                    }
                                    //tbl order2 entry
                                    $pr_d = $this->db->get_where('tbl_products', array('id' => $data->product_id))->result();
                                    $data_insert = array(
                                        'product_id' => $data->product_id,
                                        'desc_e_name2' => $data->desc_e_name2,
                                        'desc_e_value2' => $data->desc_e_value2,
                                        'desc_e_name3' => $data->desc_e_name3,
                                        'desc_e_value3' => $data->desc_e_value3,
                                        'desc_e_name4' => $data->desc_e_name4,
                                        'desc_e_value4' => $data->desc_e_value4,
                                        'desc_e_name5' => $data->desc_e_name5,
                                        'desc_e_value5' => $data->desc_e_value5,
                                        'ringsize' => $data->ringsize,
                                        'ringprice' => $data->ringprice,
                                        'quantity' => $data->quantity,
                                        'amount' => $product_qty_price,
                                        'main_id' => $last_order_id,
                                        'unit_price' => $selling_price,
                                        'series' => $pr_d[0]->sku_series,
                                        'cat_id' => $pr_d[0]->category,
                                        'date' => $cur_date
                                    );
                                    $last_id = $this->base_model->insert_table("tbl_order2", $data_insert, 1);
                                    //calculate total cart amount
                                    $totalAmount = $totalAmount + $product_qty_price;
                                    $i++;
                                } else {
                                    if (empty($data->stuller_pro_id)) {
                                        $this->db->select('*');
                                        $this->db->from('tbl_products');
                                        $this->db->where('id', $data->product_id);
                                        $this->db->where('is_active', 1);
                                        $prodata = $this->db->get()->row();
                                    } else {
                                        $this->db->select('*');
                                        $this->db->from('tbl_quickshop_products');
                                        $this->db->where('product_id', $data->stuller_pro_id);
                                        $this->db->where('is_active', 1);
                                        $prodata = $this->db->get()->row();
                                    }
                                    if (!empty($prodata)) {
                                        $product_name = $prodata->description;
                                    } else {
                                        $product_name = "";
                                    }
                                    $this->session->set_flashdata('emessage', 'This product ' . $product_name . ' is out of stock.Please remove this product before order place.');
                                    redirect($_SERVER['HTTP_REFERER']);
                                }
                            }
                        } else {
                            if (empty($data->stuller_pro_id)) {
                                $this->db->select('*');
                                $this->db->from('tbl_products');
                                $this->db->where('id', $data->product_id);
                                $this->db->where('is_active', 1);
                                $prodata = $this->db->get()->row();
                            } else {
                                $this->db->select('*');
                                $this->db->from('tbl_quickshop_products');
                                $this->db->where('product_id', $data->stuller_pro_id);
                                $this->db->where('is_active', 1);
                                $prodata = $this->db->get()->row();
                            }
                            if (!empty($prodata)) {
                                $product_name = $prodata->description;
                            } else {
                                $product_name = "";
                            }
                            $this->session->set_flashdata('emessage', 'This product ' . $product_name . ' is out of stock.Please remove this product before order place.');
                            redirect($_SERVER['HTTP_REFERER']);
                        }
                    }
                }
                $data_insert_order11 = array(
                    'total_amount' => $total_cart_amount1,
                );
                $this->db->where('id', $last_order_id);
                $zapak2 = $this->db->update('tbl_order1', $data_insert_order11);
                // $this->db->select('*');
                // $this->db->from('tbl_cart');
                // $this->db->where('user_id', $user_id);
                // $data['cart_data'] = $this->db->get();
                // $data2['address_id'] = $address_id;
                // $data2['cart_data'] = $cart_da;
                // $data2['af'] = "";
                $this->session->set_userdata('order_id', $last_order_id);
                redirect("Order/view_checkout/" . base64_encode($last_order_id), "refresh");
                // $this->load->view('common/header', $data2);
                // $this->load->view('checkout');
                // $this->load->view('common/footer');
            } else {
                $this->session->set_flashdata('emessage', validation_errors());
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->session->set_flashdata('emessage', 'Some error occured.Post data not found.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function view_checkout($idd)
    {
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
                    // print_r($methods[0]);die();
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
            // print_r($method_data);die();
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
            // print_r($temp_array);
            // die();
            //---- fectch cost of selected country ------------
            $shipping_costs = [];
            if (!empty($temp_array)) {
                foreach ($temp_array as $temp) {
                    $costs_data = $this->db->get_where('tbl_shippingrules', array('is_active' => 1, 'shipping_id' => $temp['shipping_id']))->result();
                    if ($costs_data[0]->start_price <= $order_data[0]->total_amount && $costs_data[0]->end_price >= $order_data[0]->total_amount) {
                        $shipping_costs[] = array('shipping_id' => $costs_data[0]->shipping_id, 'id' => $costs_data[0]->id, 'shipment_cost' => $costs_data[0]->shipment_cost);
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
            //-------- updating shipping data ---------
            if (!empty($shipping_costs)) {
                if (empty($order_data[0]->shipping_id)) {
                    $data_update2 = array(
                        'shipping_id' => $shipping_costs[0]['shipping_id'],
                        'method_id' => $temp_array[0]['id'],
                        'shipping' => $shipping_costs[0]['shipment_cost'],
                        'shipping_rule_id' => $shipping_costs[0]['id'],
                        'final_amount' => $order_data[0]->total_amount + $shipping_costs[0]['shipment_cost'],
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
            $data2['methods_data'] = array_values($temp_array);
            $data2['shipping_costs'] = array_values($shipping_costs);
            $gateway = new Braintree\Gateway([
                'environment' => 'sandbox',
                'merchantId' => 't88vsbn73n3ktmvc',
                'publicKey' => 'jwvgk8z38gwjywgr',
                'privateKey' => '880e71aeb8ff9eed853f45dc76627f86'
            ]);
            // pass $clientToken to your front-end
            // $clientToken = $gateway->clientToken()->generate([
            //     "customerId" => $aCustomerId
            // ]);
            $data2['braintree_auth'] = ($clientToken = $gateway->clientToken()->generate());
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
                $gateway = new Braintree\Gateway([
                    'environment' => 'sandbox',
                    'merchantId' => 't88vsbn73n3ktmvc',
                    'publicKey' => 'jwvgk8z38gwjywgr',
                    'privateKey' => '880e71aeb8ff9eed853f45dc76627f86'
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
                    $this->load->library('email', $config);
                    $this->email->set_newline("");
                    $this->email->from(EMAIL, EMAIL_NAME); // change it to yours
                    // $this->email->to('jewelplus@gmail.com');  // change it to yours
                    $this->email->to('office.fineoutput@gmail.com');  // change it to yours
                    $this->email->subject('New order received');
                    $this->email->message($message);
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
                    'final_amount' => $order_data[0]->total_amount + $shipping_arr[$index]->shipment_cost - $order_data[0]->p_discount,
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
                                    'final_amount' => $order_data[0]->total_amount + $order_data[0]->shipping -  $discount
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
                $this->load->library('email', $config);
                $this->email->set_newline("");
                $this->email->from(EMAIL, EMAIL_NAME); // change it to yours
                // $this->email->to('jewelplus@gmail.com');  // change it to yours
                $this->email->to('office.fineoutput@gmail.com');  // change it to yours
                $this->email->subject('New order received');
                $this->email->message($message);
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
}
