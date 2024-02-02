<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'core/CI_finecontrol.php');
class OrdersNew extends CI_finecontrol
{
  function __construct()
  {
    parent::__construct();
    $this->load->model("login_model");
    $this->load->model("admin/base_model");
    $this->load->library('user_agent');
    $this->load->library('upload');
  }


  public function new_orders()
  {

    if (!empty($this->session->userdata('admin_data'))) {

      $this->db->select('*');
      $this->db->from('tbl_order1');
      $this->db->where('order_status', 1);
      $this->db->or_where('order_status', 2);
      $this->db->order_by("id", "desc");

      $data['orders_data'] = $this->db->get();
      $data['page_title'] = ' New Orders';
      $this->load->view('admin/common/header_view', $data);
      $this->load->view('admin/orders/view_all_orders');
      $this->load->view('admin/common/footer_view');
    } else {

      $this->load->view('admin/login/index');
    }
  }

  public function dispatched_orders()
  {

    if (!empty($this->session->userdata('admin_data'))) {

      $this->db->select('*');
      $this->db->from('tbl_order1');
      $this->db->where('order_status', 3);
      $this->db->order_by("id", "desc");
      $data['orders_data'] = $this->db->get();
      $data['page_title'] = ' Dispatched Orders';
      $this->load->view('admin/common/header_view', $data);
      $this->load->view('admin/orders/view_all_orders');
      $this->load->view('admin/common/footer_view');
    } else {

      $this->load->view('admin/login/index');
    }
  }

  public function completed_orders()
  {

    if (!empty($this->session->userdata('admin_data'))) {

      $this->db->select('*');
      $this->db->from('tbl_order1');
      $this->db->where('order_status', 4);
      // $this->db->or_where('order_status',5);
      $this->db->order_by("id", "desc");
      $data['orders_data'] = $this->db->get();
      $data['page_title'] = ' Completed Orders';
      $this->load->view('admin/common/header_view', $data);
      $this->load->view('admin/orders/view_all_orders');
      $this->load->view('admin/common/footer_view');
    } else {

      $this->load->view('admin/login/index');
    }
  }


  public function rejected_orders()
  {

    if (!empty($this->session->userdata('admin_data'))) {

      $this->db->select('*');
      $this->db->from('tbl_order1');
      // $this->db->where('order_status',4);
      $this->db->where('order_status', 5);
      $this->db->order_by("id", "desc");
      $data['orders_data'] = $this->db->get();
      $data['page_title'] = ' Rejected Orders';
      $this->load->view('admin/common/header_view', $data);
      $this->load->view('admin/orders/view_all_orders');
      $this->load->view('admin/common/footer_view');
    } else {

      $this->load->view('admin/login/index');
    }
  }


  public function view_all_orders()
  {

    if (!empty($this->session->userdata('admin_data'))) {

      $data['page_title'] = ' All Orders';
      $this->db->select('*');
      $this->db->from('tbl_order1');
      $this->db->order_by("id", "desc");
      // $this->db->where('order_status',1);
      // $this->db->or_where('order_status',2);
      // $this->db->or_where('order_status',3);
      // $this->db->or_where('order_status',4);
      // $this->db->or_where('order_status',5);
      $data['orders_data'] = $this->db->get();

      $this->load->view('admin/common/header_view', $data);
      $this->load->view('admin/orders/view_all_orders');
      $this->load->view('admin/common/footer_view');
    } else {

      $this->load->view('admin/login/index');
    }
  }

  public function updateordersStatus($idd, $t)
  {

    if (!empty($this->session->userdata('admin_data'))) {

      $id = base64_decode($idd);
      $typ = base64_decode($t);

      $addedby = $this->session->userdata('user_id');

      date_default_timezone_set("Asia/Calcutta");
      $cur_date = date("Y-m-d H:i:s");

      if ($typ == 5) {

        $data_update = array(
          'rejected_by' => 2,
          'rejected_by_id' => $addedby,
          'order_status' => $typ,
          'last_update_date' => $cur_date
        );
      } else {

        $data_update = array(
          'order_status' => $typ,
          'last_update_date' => $cur_date
        );
      }


      $this->db->where('id', $id);
      $zapak = $this->db->update('tbl_order1', $data_update);

      if ($zapak != 0) {


        //Dispatched push notification to user
        //             if($typ == 3){
        //             // echo "4" die();
        //               $this->db->select('*');
        //             $this->db->from('tbl_order1');
        //             $this->db->where('id',$id);
        //             $order1data= $this->db->get()->row();
        //
        //             if(!empty($order1data)){
        //             $this->db->select('*');
        //             $this->db->from('tbl_users_device_token');
        //             $this->db->where('user_id',$order1data->user_id);
        //             $user_device_tokens= $this->db->get()->row();
        //
        //             if(!empty($user_device_tokens)){
        //
        //             //success notification code
        //
        //             $url = 'https://fcm.googleapis.com/fcm/send';
        //
        //             $title="Order Dispatched";
        //             $message="Your order has been dispatched. ";
        //
        //
        //             $msg2 = array(
        //             'body'=>$title,
        //             'title'=>$message,
        //             "sound" => "default"
        //
        //             );
        //
        //
        // // echo $user_device_tokens->device_token; die();
        //
        //             $fields = array(
        //             // 'to'=>"/topics/all",
        //             'to'=>$user_device_tokens->device_token,
        //             'notification'=>$msg2,
        //             'priority'=>'high'
        //             );
        //
        //             $fields = json_encode ( $fields );
        //
        //             $headers = array (
        //             'Authorization: key=' . "AAAACTZ6KLI:APA91bFFlxPfKqSFMojgL3EQAk1jmY_Kj3mqRqxtUjxjJVOV337aiOeGbPND-axUH8GBzEFtrgkQXblqMUjT5K4v8nM6gs1hjhcM_ocri6Bx0H62yR_DjjZLh6I3lbgwaa-D9WrF8vGC",
        //             'Content-Type: application/json'
        //             );
        //
        //             $ch = curl_init ();
        //             curl_setopt ( $ch, CURLOPT_URL, $url );
        //             curl_setopt ( $ch, CURLOPT_POST, true );
        //             curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
        //             curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
        //             curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
        //
        //             $result = curl_exec ( $ch );
        //             // echo $fields;
        //             // echo $result;
        //             curl_close ( $ch );
        //
        //             //End success notification code
        //             }
        //             }
        //
        //
        //             }
        //End Dispatched push notification to user


        //Delivered push notification to user

        // if($typ == 4){
        // // echo "4" die();
        //   $this->db->select('*');
        // $this->db->from('tbl_order1');
        // $this->db->where('id',$id);
        // $order1data= $this->db->get()->row();
        //
        // if(!empty($order1data)){
        // $this->db->select('*');
        // $this->db->from('tbl_users_device_token');
        // $this->db->where('user_id',$order1data->user_id);
        // $user_device_tokens= $this->db->get()->row();
        //
        // if(!empty($user_device_tokens)){
        //
        // //success notification code
        //
        // $url = 'https://fcm.googleapis.com/fcm/send';
        //
        // $title="Order Delivered";
        // $message="Your order has been delivered successfully. ";
        //
        //
        // $msg2 = array(
        // 'body'=>$title,
        // 'title'=>$message,
        //   "sound" => "default"
        // );
        //
        //
        // $fields = array(
        // // 'to'=>"/topics/all",
        // 'to'=>$user_device_tokens->device_token,
        // 'notification'=>$msg2,
        // 'priority'=>'high'
        // );
        //
        // $fields = json_encode ( $fields );
        //
        // $headers = array (
        // 'Authorization: key=' . "AAAACTZ6KLI:APA91bFFlxPfKqSFMojgL3EQAk1jmY_Kj3mqRqxtUjxjJVOV337aiOeGbPND-axUH8GBzEFtrgkQXblqMUjT5K4v8nM6gs1hjhcM_ocri6Bx0H62yR_DjjZLh6I3lbgwaa-D9WrF8vGC",
        // 'Content-Type: application/json'
        // );
        //
        // $ch = curl_init ();
        // curl_setopt ( $ch, CURLOPT_URL, $url );
        // curl_setopt ( $ch, CURLOPT_POST, true );
        // curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
        // curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
        // curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
        //
        // $result = curl_exec ( $ch );
        // // echo $fields;
        // // echo $result;
        // curl_close ( $ch );
        //
        // //End success notification code
        // }
        // }
        //
        //
        // }
        //End Delivered push notification to user


        //Cancelled push notification to user

        // if($typ == 5){
        // // echo "4" die();
        //   $this->db->select('*');
        // $this->db->from('tbl_order1');
        // $this->db->where('id',$id);
        // $order1data= $this->db->get()->row();
        //
        // if(!empty($order1data)){
        // $this->db->select('*');
        // $this->db->from('tbl_users_device_token');
        // $this->db->where('user_id',$order1data->user_id);
        // $user_device_tokens= $this->db->get()->row();
        //
        // if(!empty($user_device_tokens)){
        //
        // //success notification code
        //
        // $url = 'https://fcm.googleapis.com/fcm/send';
        //
        // $title="Order Cancelled";
        // $message="Your order has been cancelled. ";
        //
        //
        // $msg2 = array(
        // 'body'=>$title,
        // 'title'=>$message
        // );
        //
        //
        // $fields = array(
        // // 'to'=>"/topics/all",
        // 'to'=>$user_device_tokens->device_token,
        // 'notification'=>$msg2
        // );
        //
        // $fields = json_encode ( $fields );
        //
        // $headers = array (
        // 'Authorization: key=' . "AAAACTZ6KLI:APA91bFFlxPfKqSFMojgL3EQAk1jmY_Kj3mqRqxtUjxjJVOV337aiOeGbPND-axUH8GBzEFtrgkQXblqMUjT5K4v8nM6gs1hjhcM_ocri6Bx0H62yR_DjjZLh6I3lbgwaa-D9WrF8vGC",
        // 'Content-Type: application/json'
        // );
        //
        // $ch = curl_init ();
        // curl_setopt ( $ch, CURLOPT_URL, $url );
        // curl_setopt ( $ch, CURLOPT_POST, true );
        // curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
        // curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
        // curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
        //
        // $result = curl_exec ( $ch );
        // // echo $fields;
        // // echo $result;
        // curl_close ( $ch );
        //
        // //End success notification code
        // }
        // }
        //
        //
        // }
        //End Cancelled push notification to user


        redirect("dcadmin/OrdersNew/new_orders", "refresh");
      } else {
        $this->session->set_flashdata('emessage', 'Sorry error occured');
        redirect($_SERVER['HTTP_REFERER']);
      }
    } else {
      $this->load->view('admin/login/index');
    }
  }

  public function view_ordered_product_details($main_id)
  {

    if (!empty($this->session->userdata('admin_data'))) {

      $this->db->select('*');
      $this->db->from('tbl_order2');
      $this->db->where('main_id', base64_decode($main_id));
      $data['ordered_product_details_data'] = $this->db->get();

      $this->load->view('admin/common/header_view', $data);
      $this->load->view('admin/orders/view_ordered_product_details');
      $this->load->view('admin/common/footer_view');
    } else {

      $this->load->view('admin/login/index');
    }
  }

  //Order bill

  public function view_order_bill($main_id)
  {

    if (!empty($this->session->userdata('admin_data'))) {

      $this->db->select('*');
      $this->db->from('tbl_order1');
      $this->db->where('id', base64_decode($main_id));
      $data['order1_data'] = $this->db->get()->row();

      $this->db->select('*');
      $this->db->from('tbl_order2');
      $this->db->where('main_id', base64_decode($main_id));
      $data['order2_data'] = $this->db->get();


      // $this->load->view('admin/common/header_view',$data);
      $this->load->view('admin/orders/order_bill', $data);
      // $this->load->view('admin/common/footer_view');

    } else {

      $this->load->view('admin/login/index');
    }
  }


  public function view_delivery_challan($main_id)
  {

    if (!empty($this->session->userdata('admin_data'))) {

      $this->db->select('*');
      $this->db->from('tbl_order1');
      $this->db->where('id', base64_decode($main_id));
      $data['order1_data'] = $this->db->get()->row();

      // $this->db->select('*');
      //  $this->db->from('tbl_order2');
      //  $this->db->where('main_id',base64_decode($main_id));
      //  $data['order2_data']= $this->db->get();


      // $this->load->view('admin/common/header_view',$data);
      $this->load->view('admin/orders/view_delivery_challan', $data);
      // $this->load->view('admin/common/footer_view');

    } else {

      $this->load->view('admin/login/index');
    }
  }


  public function transfer_to_deliver($order_id_encoded)
  {

    if (!empty($this->session->userdata('admin_data'))) {

      $data['order_id_encoded'] = $order_id_encoded;
      $this->db->select('*');
      $this->db->from('tbl_delivery_users');
      $data['delivery_users_data'] = $this->db->get();

      $this->load->view('admin/common/header_view', $data);
      $this->load->view('admin/orders/transfer_to_deliver');
      $this->load->view('admin/common/footer_view');
    } else {

      redirect("login/admin_login", "refresh");
    }
  }

  public function transfer_order_process($delivery_user_id_encoded, $order_id_encoded)
  {

    if (!empty($this->session->userdata('admin_data'))) {

      $delivery_user_id = base64_decode($delivery_user_id_encoded);
      $order_id = base64_decode($order_id_encoded);
      $ip = $this->input->ip_address();
      date_default_timezone_set("Asia/Calcutta");
      $cur_date = date("Y-m-d H:i:s");
      $addedby = $this->session->userdata('admin_id');


      $last_id = 0;
      $data_insert = array(
        'order_id' => $order_id,
        'delivery_user_id' => $delivery_user_id,
        'status' => 0,
        'ip' => $ip,
        'added_by' => $addedby,
        'date' => $cur_date
      );


      $last_id = $this->base_model->insert_table("tbl_transfer_orders", $data_insert, 1);

      $data_update = array(
        'delivery_status' => 1
      );
      $this->db->where('id', $order_id);
      $this->db->update('tbl_order1', $data_update);



      if ($last_id != 0) {


        $this->db->select('*');
        $this->db->from('tbl_order1');
        $this->db->where('id', $order_id);
        $order_user_data = $this->db->get()->row();
        if (!empty($order_user_data)) {
          $user_idd = $order_user_data->user_id;
        }

        $this->db->select('*');
        $this->db->from('tbl_delivery_users');
        $this->db->where('id', $delivery_user_id);
        $delivery_user_data = $this->db->get()->row();

        if (!empty($delivery_user_data)) {
          $delivery_user_email = $delivery_user_data->email;

          $this->db->select('*');
          $this->db->from('tbl_delivery_users_device_token');
          $this->db->where('email', $delivery_user_email);
          $delivery_user_device_tokens = $this->db->get();

          foreach ($delivery_user_device_tokens->result() as $user_device_token) {
            // code...

            //success notification code

            $url = 'https://fcm.googleapis.com/fcm/send';

            $title = "New Order Arrived";
            $message = "New delivery order transfered to you from admin, Please check.";


            $msg2 = array(
              'body' => $title,
              'title' => $message
            );


            $fields = array(
              //'to'=>"/topics/all",
              'to' => $user_device_token->device_token,
              'notification' => $msg2
            );

            $fields = json_encode($fields);

            $headers = array(
              'Authorization: key=' . "AAAAWlT0RSA:APA91bHgSPLXkn_RDZ7C3KcGChZKEVM-J9DLMya1exCG1Dbd1cQtG3nKVG4jxFhhrad_7aWOvbRblCbC9KLcMuzkxkquBlKUwcfnVaNZZkA_l7k1md9j9gazWGQfWJ_S1-j_--5870RS",
              'Content-Type: application/json'
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

            $result = curl_exec($ch);
            // echo $fields;
            // echo $result;
            curl_close($ch);

            //End success notification code
          }


          $data_insert_notify = array(
            'notification_type' => 2,
            'notification_title' => "Order Transfered",
            'user_id' => $user_idd,
            'description' => "this order id no: " . $order_id . " Order Transfered Successfully.",
            'is_read' => 0,
            'ip' => $ip,
            'date' => $cur_date
          );


          $this->base_model->insert_table("tbl_notification", $data_insert_notify, 1);
        }



        $this->session->set_flashdata('smessage', 'Order Transfered successfully');
        redirect("dcadmin/orders/new_orders", "refresh");
      } else {

        $this->session->set_flashdata('emessage', 'Sorry error occured');
        redirect($_SERVER['HTTP_REFERER']);
      }
    } else {

      $this->load->view('admin/login/index');
    }
  }




  public function add_track_order_view($order_id_encoded)
  {

    if (!empty($this->session->userdata('admin_data'))) {

      $data['order_id_encoded'] = $order_id_encoded;


      $this->load->view('admin/common/header_view', $data);
      $this->load->view('admin/orders/track_order');
      $this->load->view('admin/common/footer_view');
    } else {

      redirect("login/admin_login", "refresh");
    }
  }


  public function update_track_order_view($order_id_encoded)
  {

    if (!empty($this->session->userdata('admin_data'))) {

      $data['order_id_encoded'] = $order_id_encoded;


      $this->load->view('admin/common/header_view', $data);
      $this->load->view('admin/orders/update_track_order');
      $this->load->view('admin/common/footer_view');
    } else {

      redirect("login/admin_login", "refresh");
    }
  }





  public function add_track_order($typ = "")
  {

    if (!empty($this->session->userdata('admin_data'))) {

      $this->load->helper(array('form', 'url'));
      $this->load->library('form_validation');
      $this->load->library('upload');
      $this->load->helper('security');

      if ($this->input->post()) {

        // print_r($this->input->post());
        // exit;
        $this->form_validation->set_rules('track_id', 'track_id', 'required|numeric|xss_clean');

        if ($this->form_validation->run() == TRUE) {

          if (!empty($typ)) {
            $t = base64_decode($typ);
          } else {
            $t = "";
          }

          $order_id_encoded = $this->input->post('order_id');
          $order_id = base64_decode($order_id_encoded);
          $track_id = $this->input->post('track_id');

          $ip = $this->input->ip_address();
          date_default_timezone_set("Asia/Calcutta");
          $cur_date = date("Y-m-d H:i:s");
          $addedby = $this->session->userdata('admin_id');


          $last_id = 0;

          $this->db->select('*');
          $this->db->from('tbl_order1');
          $this->db->where('track_id', $track_id);
          $order_track_data = $this->db->get()->row();

          if (empty($order_track_data)) {

            $data_update = array(
              'track_id' => $track_id
            );
            $this->db->where('id', $order_id);
            $last_id = $this->db->update('tbl_order1', $data_update);
          } else {

            if (!empty($typ)) {

              if ($track_id == $order_track_data->track_id) {
                // echo "yes";die();


                $this->session->set_flashdata('emessage', 'This track id is already exist for other order. Please add another.');
                redirect($_SERVER['HTTP_REFERER']);
              } else {

                $data_update = array(
                  'track_id' => $track_id
                );
                $this->db->where('id', $order_id);
                $last_id = $this->db->update('tbl_order1', $data_update);
              }
            } else {
              $this->session->set_flashdata('emessage', 'This track id is already exist for other order. Please add another.');
              redirect($_SERVER['HTTP_REFERER']);
            }
          }


          if ($last_id != 0) {


            $this->session->set_flashdata('smessage', 'Order track id added successfully.');
            redirect("admin/OrdersNew/new_orders", "refresh");
          } else {

            $this->session->set_flashdata('emessage', 'Sorry error occured');
            redirect($_SERVER['HTTP_REFERER']);
          }
        } else {

          $this->session->set_flashdata('emessage', validation_errors());
          redirect($_SERVER['HTTP_REFERER']);
          exit;
        }
      } else {
        $this->session->set_flashdata('emessage', 'Please insert some data, No data available');
        redirect($_SERVER['HTTP_REFERER']);
      }
    } else {

      $this->load->view('admin/login/index');
    }
  }
}
