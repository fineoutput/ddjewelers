<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
       require_once(APPPATH . 'core/CI_finecontrol.php');
       class NewArrivals extends CI_finecontrol{
       function __construct()
           {
             parent::__construct();
             $this->load->model("login_model");
             $this->load->model("admin/base_model");
             $this->load->library('user_agent');
             $this->load->library('upload');
           }



//view category start

//
//          public function view_category(){
//
//             if(!empty($this->session->userdata('admin_data'))){
//
//
//               $data['user_name']=$this->load->get_var('user_name');
//
//               // echo SITE_NAME;
//               // echo $this->session->userdata('image');
//               // echo $this->session->userdata('position');
//               // exit;
//
//                            $this->db->select('*');
//                $this->db->from('tbl_category');
//                $this->db->where('is_active',1);
//                $data['category_data']= $this->db->get();
//
//               $this->load->view('admin/common/header_view',$data);
//               $this->load->view('admin/products/view_category');
//               $this->load->view('admin/common/footer_view');
//
//           }
//           else{
//
//              redirect("login/admin_login","refresh");
//           }
//
//           }
//
//
// //view category end
//
//
// //view subcategory start
//
// public function view_sub_category($idd){
//
//    if(!empty($this->session->userdata('admin_data'))){
//
//      $id= base64_decode($idd);
//      $data['cate_id']= $idd;
//
//      $data['user_name']=$this->load->get_var('user_name');
//
//      // echo SITE_NAME;
//      // echo $this->session->userdata('image');
//      // echo $this->session->userdata('position');
//      // exit;
//
//                   $this->db->select('*');
//       $this->db->from('tbl_sub_category');
//       $this->db->where('is_active',1);
//       $this->db->where('category',$id);
//       $data['sub_category_data']= $this->db->get();
//
//      $this->load->view('admin/common/header_view',$data);
//      $this->load->view('admin/products/view_sub_category');
//      $this->load->view('admin/common/footer_view');
//
//  }
//  else{
//
//     redirect("login/admin_login","refresh");
//  }
//
//  }
//
// //view subcategory end
//
//
//
// //view minorsubcategory start
//
//          public function view_minisubcategory($idd){
//
//             if(!empty($this->session->userdata('admin_data'))){
//
// $id= base64_decode($idd);
// $data['subcate_id']= $idd;
//               $data['user_name']=$this->load->get_var('user_name');
//
//               // echo SITE_NAME;
//               // echo $this->session->userdata('image');
//               // echo $this->session->userdata('position');
//               // exit;
//
//                            $this->db->select('*');
//                $this->db->from('tbl_minisubcategory');
//                $this->db->where('is_active',1);
//                $this->db->where('subcategory',$id);
//                $data['minisubcategory_data']= $this->db->get();
//
//               $this->load->view('admin/common/header_view',$data);
//               $this->load->view('admin/products/view_minisubcategory');
//               $this->load->view('admin/common/footer_view');
//
//           }
//           else{
//
//              redirect("login/admin_login","refresh");
//           }
//
//
//       }
//
// //view minorsubcategory end
//
//
//
//
//          public function view_products($idd,$page){
//
//             if(!empty($this->session->userdata('admin_data'))){
//
//
//               $data['user_name']=$this->load->get_var('user_name');
//
//               // echo SITE_NAME;
//               // echo $this->session->userdata('image');
//               // echo $this->session->userdata('position');
//               // exit;
//
//               $id= base64_decode($idd);
//               $page_dec= base64_decode($page);
//               $data['page']= $page;
//
// if($page_dec == 0){
//
//   $data['subcate_id']= $idd;
//
//   $this->db->select('*');
//   $this->db->from('tbl_new_arrival_products');
//   $this->db->where('sub_category',$id);
//   $data['products_data']= $this->db->get();
// }else {
//   $data['minorsubcate_id']= $idd;
//
//   $this->db->select('*');
//   $this->db->from('tbl_new_arrival_products');
//   $this->db->where('minisub_category',$id);
//   $data['products_data']= $this->db->get();
// }
//
//
//
//               $this->load->view('admin/common/header_view',$data);
//               $this->load->view('admin/products/view_products');
//               $this->load->view('admin/common/footer_view');
//
//           }
//           else{
//
//              redirect("login/admin_login","refresh");
//           }
//
//           }


//working view_products method


public function view_products(){

   if(!empty($this->session->userdata('admin_data'))){


     $data['user_name']=$this->load->get_var('user_name');

     // echo SITE_NAME;
     // echo $this->session->userdata('image');
     // echo $this->session->userdata('position');
     // exit;



$this->db->select('*');
$this->db->from('tbl_new_arrival_products');
// $this->db->where('minisub_category',$id);
$data['products_data']= $this->db->get();




     $this->load->view('admin/common/header_view',$data);
     $this->load->view('admin/newarrivals/view_products');
     $this->load->view('admin/common/footer_view');

 }
 else{

    redirect("login/admin_login","refresh");
 }

 }



              public function add_products(){

                 if(!empty($this->session->userdata('admin_data'))){

$data['check']= 1;
                   // $this->db->select('*');
                   // $this->db->from('tbl_category');
                   // //$this->db->where('',);
                   // $data['category']= $this->db->get();
                   //
                   // $this->db->select('*');
                   // $this->db->from('tbl_vendor');
                   // //$this->db->where('',);
                   // $data['vendor']= $this->db->get();

                   $this->load->view('admin/common/header_view',$data);
                   $this->load->view('admin/newarrivals/add_products');
                   $this->load->view('admin/common/footer_view');

               }
               else{

                  redirect("login/admin_login","refresh");
               }

               }

               public function update_productss($idd){

                   if(!empty($this->session->userdata('admin_data'))){


                     $data['user_name']=$this->load->get_var('user_name');

                     // echo SITE_NAME;
                     // echo $this->session->userdata('image');
                     // echo $this->session->userdata('position');
                     // exit;

                      $id=base64_decode($idd);
                     $data['id']=$idd;

                            $this->db->select('*');
                            $this->db->from('tbl_new_arrival_products');
                            $this->db->where('id',$id);
                            $data['products_data']= $this->db->get()->row();


                     $this->load->view('admin/common/header_view',$data);
                     $this->load->view('admin/newarrivals/update_productss');
                     $this->load->view('admin/common/footer_view');

                 }
                 else{

                    redirect("login/admin_login","refresh");
                 }

                 }

               public function product_details($idd){

                   if(!empty($this->session->userdata('admin_data'))){


                     $data['user_name']=$this->load->get_var('user_name');

                     // echo SITE_NAME;
                     // echo $this->session->userdata('image');
                     // echo $this->session->userdata('position');
                     // exit;

                      $id=base64_decode($idd);
                     $data['id']=$idd;

                            $this->db->select('*');
                            $this->db->from('tbl_new_arrival_products');
                            $this->db->where('id',$id);
                            $data['products_data']= $this->db->get()->row();


                     $this->load->view('admin/common/header_view',$data);
                     $this->load->view('admin/newarrivals/product_details');
                     $this->load->view('admin/common/footer_view');

                 }
                 else{

                    redirect("login/admin_login","refresh");
                 }

                 }

             public function add_products_data($t,$iw="")

               {

                 if(!empty($this->session->userdata('admin_data'))){


             $this->load->helper(array('form', 'url'));
             $this->load->library('form_validation');
             $this->load->helper('security');
             if($this->input->post())
             {
               // print_r($this->input->post());
               // exit;
  // $this->form_validation->set_rules('product_name', 'product_name', 'required|xss_clean|trim');
  // $this->form_validation->set_rules('category', 'category', 'required|xss_clean|trim');
  // $this->form_validation->set_rules('sub_category', 'sub_category', 'required|xss_clean|trim');
  // $this->form_validation->set_rules('minisubcategory', 'minisubcategory', 'xss_clean|trim');
  // $this->form_validation->set_rules('vendor', 'vendor', 'required|xss_clean|trim');
  $this->form_validation->set_rules('post_en', 'post_en', 'required|xss_clean|trim');
  $this->form_validation->set_rules('api_ids', 'api_ids', 'required|xss_clean|trim');






               if($this->form_validation->run()== TRUE)
               {
  // $product_name=$this->input->post('product_name');
   // $category=$this->input->post('category');
   // $sub_category=$this->input->post('sub_category');
   // $minisubcategory=$this->input->post('minisubcategory');
   // $vendor=$this->input->post('vendor');
   $post_en= $this->input->post('post_en');
   $api_ids= $this->input->post('api_ids');


                   $ip = $this->input->ip_address();
                   date_default_timezone_set("Asia/Calcutta");
                   $cur_date=date("Y-m-d H:i:s");
                   $addedby=$this->session->userdata('admin_id');

           $typ=base64_decode($t);
           $last_id = 0;

           if($typ==1){

//stuller api fuction call
             $last_id= $this->new_arrive_stuller_data($api_ids);


           }
           if($typ==2){

    $idw=base64_decode($iw);


 $this->db->select('*');
 $this->db->from('tbl_new_arrival_products');
 $this->db->where('id',$idw);
 $dsa=$this->db->get();
 $da=$dsa->row();



$img5='image1';


           $file_check=($_FILES['image1']['error']);
if($file_check!=4){

         $image_upload_folder = FCPATH . "assets/uploads/products/";
                     if (!file_exists($image_upload_folder))
                     {
                         mkdir($image_upload_folder, DIR_WRITE_MODE, true);
                     }
                     $new_file_name="products".date("Ymdhms");
                     $this->upload_config = array(
                             'upload_path'   => $image_upload_folder,
                             'file_name' => $new_file_name,
                             'allowed_types' =>'xlsx|csv|xls|pdf|doc|docx|txt|jpg|jpeg|png',
                             'max_size'      => 25000
                     );
                     $this->upload->initialize($this->upload_config);
                     if (!$this->upload->do_upload($img5))
                     {
                         $upload_error = $this->upload->display_errors();
                         // echo json_encode($upload_error);

           //$this->session->set_flashdata('emessage',$upload_error);
             //redirect($_SERVER['HTTP_REFERER']);
                     }
                     else
                     {

                         $file_info = $this->upload->data();

                         $videoNAmePath = "assets/uploads/products/".$new_file_name.$file_info['file_ext'];
                         $file_info['new_name']=$videoNAmePath;
                         // $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
                         $nnnn=$file_info['file_name'];
                         $nnnn5=$videoNAmePath;

                         // echo json_encode($file_info);
                     }
        }



$img6='image2';


           $file_check=($_FILES['image2']['error']);
if($file_check!=4){

         $image_upload_folder = FCPATH . "assets/uploads/products/";
                     if (!file_exists($image_upload_folder))
                     {
                         mkdir($image_upload_folder, DIR_WRITE_MODE, true);
                     }
                     $new_file_name="products".date("Ymdhms");
                     $this->upload_config = array(
                             'upload_path'   => $image_upload_folder,
                             'file_name' => $new_file_name,
                             'allowed_types' =>'xlsx|csv|xls|pdf|doc|docx|txt|jpg|jpeg|png',
                             'max_size'      => 25000
                     );
                     $this->upload->initialize($this->upload_config);
                     if (!$this->upload->do_upload($img6))
                     {
                         $upload_error = $this->upload->display_errors();
                         // echo json_encode($upload_error);

           //$this->session->set_flashdata('emessage',$upload_error);
             //redirect($_SERVER['HTTP_REFERER']);
                     }
                     else
                     {

                         $file_info = $this->upload->data();

                         $videoNAmePath = "assets/uploads/products/".$new_file_name.$file_info['file_ext'];
                         $file_info['new_name']=$videoNAmePath;
                         // $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
                         $nnnn=$file_info['file_name'];
                         $nnnn6=$videoNAmePath;

                         // echo json_encode($file_info);
                     }
        }



$img7='image3';


           $file_check=($_FILES['image3']['error']);
if($file_check!=4){

         $image_upload_folder = FCPATH . "assets/uploads/products/";
                     if (!file_exists($image_upload_folder))
                     {
                         mkdir($image_upload_folder, DIR_WRITE_MODE, true);
                     }
                     $new_file_name="products".date("Ymdhms");
                     $this->upload_config = array(
                             'upload_path'   => $image_upload_folder,
                             'file_name' => $new_file_name,
                             'allowed_types' =>'xlsx|csv|xls|pdf|doc|docx|txt|jpg|jpeg|png',
                             'max_size'      => 25000
                     );
                     $this->upload->initialize($this->upload_config);
                     if (!$this->upload->do_upload($img7))
                     {
                         $upload_error = $this->upload->display_errors();
                         // echo json_encode($upload_error);

           //$this->session->set_flashdata('emessage',$upload_error);
             //redirect($_SERVER['HTTP_REFERER']);
                     }
                     else
                     {

                         $file_info = $this->upload->data();

                         $videoNAmePath = "assets/uploads/products/".$new_file_name.$file_info['file_ext'];
                         $file_info['new_name']=$videoNAmePath;
                         // $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
                         $nnnn=$file_info['file_name'];
                         $nnnn7=$videoNAmePath;

                         // echo json_encode($file_info);
                     }
        }



// $img8='image4';
//
//
//            $file_check=($_FILES['image4']['error']);
// if($file_check!=4){
//
//          $image_upload_folder = FCPATH . "assets/uploads/products/";
//                      if (!file_exists($image_upload_folder))
//                      {
//                          mkdir($image_upload_folder, DIR_WRITE_MODE, true);
//                      }
//                      $new_file_name="products".date("Ymdhms");
//                      $this->upload_config = array(
//                              'upload_path'   => $image_upload_folder,
//                              'file_name' => $new_file_name,
//                              'allowed_types' =>'xlsx|csv|xls|pdf|doc|docx|txt|jpg|jpeg|png',
//                              'max_size'      => 25000
//                      );
//                      $this->upload->initialize($this->upload_config);
//                      if (!$this->upload->do_upload($img8))
//                      {
//                          $upload_error = $this->upload->display_errors();
//                          // echo json_encode($upload_error);
//
//            //$this->session->set_flashdata('emessage',$upload_error);
//              //redirect($_SERVER['HTTP_REFERER']);
//                      }
//                      else
//                      {
//
//                          $file_info = $this->upload->data();
//
//                          $videoNAmePath = "assets/uploads/products/".$new_file_name.$file_info['file_ext'];
//                          $file_info['new_name']=$videoNAmePath;
//                          // $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
//                          $nnnn=$file_info['file_name'];
//                          $nnnn8=$videoNAmePath;
//
//                          // echo json_encode($file_info);
//                      }
//         }
//
//
//
// $img9='image5';
//
//
//            $file_check=($_FILES['image5']['error']);
// if($file_check!=4){
//
//          $image_upload_folder = FCPATH . "assets/uploads/products/";
//                      if (!file_exists($image_upload_folder))
//                      {
//                          mkdir($image_upload_folder, DIR_WRITE_MODE, true);
//                      }
//                      $new_file_name="products".date("Ymdhms");
//                      $this->upload_config = array(
//                              'upload_path'   => $image_upload_folder,
//                              'file_name' => $new_file_name,
//                              'allowed_types' =>'xlsx|csv|xls|pdf|doc|docx|txt|jpg|jpeg|png',
//                              'max_size'      => 25000
//                      );
//                      $this->upload->initialize($this->upload_config);
//                      if (!$this->upload->do_upload($img9))
//                      {
//                          $upload_error = $this->upload->display_errors();
//                          // echo json_encode($upload_error);
//
//            //$this->session->set_flashdata('emessage',$upload_error);
//              //redirect($_SERVER['HTTP_REFERER']);
//                      }
//                      else
//                      {
//
//                          $file_info = $this->upload->data();
//
//                          $videoNAmePath = "assets/uploads/products/".$new_file_name.$file_info['file_ext'];
//                          $file_info['new_name']=$videoNAmePath;
//                          // $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
//                          $nnnn=$file_info['file_name'];
//                          $nnnn9=$videoNAmePath;
//
//                          // echo json_encode($file_info);
//                      }
//         }



 if(!empty($da)){ $img = $da ->image1;
if(!empty($img)) { if(empty($nnnn5)){ $nnnn5 = $img; } }else{ if(empty($nnnn5)){ $nnnn5= ""; } } }if(!empty($da)){ $img = $da ->image2;
if(!empty($img)) { if(empty($nnnn6)){ $nnnn6 = $img; } }else{ if(empty($nnnn6)){ $nnnn6= ""; } } }if(!empty($da)){ $img = $da ->image3;
if(!empty($img)) { if(empty($nnnn7)){ $nnnn7 = $img; } }else{ if(empty($nnnn7)){ $nnnn7= ""; } } }

// if(!empty($da)){ $img = $da ->image4;
// if(!empty($img)) { if(empty($nnnn8)){ $nnnn8 = $img; } }else{ if(empty($nnnn8)){ $nnnn8= ""; } } }if(!empty($da)){ $img = $da ->image5;
// if(!empty($img)) { if(empty($nnnn9)){ $nnnn9 = $img; } }else{ if(empty($nnnn9)){ $nnnn9= ""; } } }

           $data_insert = array(
                  'product_name'=>$product_name,
  // 'category'=>$category,
  // 'sub_category'=>$sub_category,
  // 'minisub_category'=>$minisubcategory,
  'sdesc'=>$sdesc,
  'ldesc'=>$ldesc,
  'image1'=>$nnnn5,
  'image2'=>$nnnn6,
  'image3'=>$nnnn7,
  // 'image4'=>$nnnn8,
  // 'image5'=>$nnnn9,

                     );
             $this->db->where('id', $idw);
             $last_id=$this->db->update('tbl_new_arrival_products', $data_insert);
           }
                       if($last_id!=0){


                       $this->session->set_flashdata('smessage','Data inserted successfully');
                       redirect("dcadmin/NewArrivals/view_products","refresh");




                              }
                               else
                                   {

                                    $this->session->set_flashdata('emessage','Sorry error occured');
                                    redirect($_SERVER['HTTP_REFERER']);
                                  }
               }
             else{

        $this->session->set_flashdata('emessage',validation_errors());
      redirect($_SERVER['HTTP_REFERER']);

             }

             }
           else{

 $this->session->set_flashdata('emessage','Please insert some data, No data available');
      redirect($_SERVER['HTTP_REFERER']);

           }
           }
           else{

       redirect("login/admin_login","refresh");


           }

           }

               public function updateproductsStatus($idd,$t){

                        if(!empty($this->session->userdata('admin_data'))){


                          $data['user_name']=$this->load->get_var('user_name');

                          // echo SITE_NAME;
                          // echo $this->session->userdata('image');
                          // echo $this->session->userdata('position');
                          // exit;
                          $id=base64_decode($idd);

                          if($t=="active"){

                            $data_update = array(
                        'is_active'=>1

                        );

                        $this->db->where('id', $id);
                       $zapak=$this->db->update('tbl_new_arrival_products', $data_update);

                            if($zapak!=0){
                            redirect("dcadmin/NewArrivals/view_products","refresh");
                                    }
                                    else
                                    {
        $this->session->set_flashdata('emessage','Sorry error occured');
          redirect($_SERVER['HTTP_REFERER']);
                                    }
                          }
                          if($t=="inactive"){
                            $data_update = array(
                         'is_active'=>0

                         );

                         $this->db->where('id', $id);
                         $zapak=$this->db->update('tbl_new_arrival_products', $data_update);

                             if($zapak!=0){
                             redirect("dcadmin/NewArrivals/view_products","refresh");
                                     }
                                     else
                                     {

                $this->session->set_flashdata('emessage','Sorry error occured');
                  redirect($_SERVER['HTTP_REFERER']);
                                     }
                          }



                      }
                      else{

                         redirect("login/admin_login","refresh");

                      }

                      }



               public function delete_products($idd){

                      if(!empty($this->session->userdata('admin_data'))){

                        $data['user_name']=$this->load->get_var('user_name');

                        // echo SITE_NAME;
                        // echo $this->session->userdata('image');
                        // echo $this->session->userdata('position');
                        // exit;
                        $id=base64_decode($idd);

                       if($this->load->get_var('position')=="Super Admin"){

                     $this->db->select('image');
                     $this->db->from('tbl_new_arrival_products');
                     $this->db->where('id',$id);
                     $dsa= $this->db->get();
                     $da=$dsa->row();
                     $img=$da->image;

 $zapak=$this->db->delete('tbl_new_arrival_products', array('id' => $id));
 if($zapak!=0){
        $path = FCPATH .$img;
          unlink($path);
        redirect("dcadmin/NewArrivals/view_products","refresh");
                }
                else
                {
                   $this->session->set_flashdata('emessage','Sorry error occured');
                   redirect($_SERVER['HTTP_REFERER']);
                }
            }
            else{
             $this->session->set_flashdata('emessage','Sorry you not a super admin you dont have permission to delete anything');
               redirect($_SERVER['HTTP_REFERER']);
            }


                            }
                            else{

                        redirect("login/admin_login","refresh");

                            }

                            }


    public function getSub_category(){

    if(!empty($this->session->userdata('admin_data'))){

                     // $data['user_name']=$this->load->get_var('user_name');

    $isl=$_GET['isl'];

    $this->db->select('*');
    $this->db->from('tbl_sub_category');
    $this->db->where('category',$isl);
    $data= $this->db->get();

    $i=1; foreach($data->result() as $row) {

    $sub_category[] = array('id' =>$row->id ,'name'=>$row->name );


    $i++; }
    if (!empty($sub_category)) {
    // code...

    echo json_encode($sub_category);
    }
    else {
    echo 'NA';
    }

 }
 else{

    redirect("login/admin_login","refresh");
 }

 }





    public function getminiSub_category(){

    if(!empty($this->session->userdata('admin_data'))){

                    // $data['user_name']=$this->load->get_var('user_name');

    $isl=$_GET['isl'];

    $this->db->select('*');
    $this->db->from('tbl_minisubcategory');
    $this->db->where('subcategory',$isl);
    $this->db->where('is_active',1);
    $data= $this->db->get();

    $i=1; foreach($data->result() as $row) {

    $sub_category[] = array('id' =>$row->id ,'name'=>$row->name );


    $i++; }
    if (!empty($sub_category)) {
    // code...

    echo json_encode($sub_category);
    }
    else {
    echo 'NA';
    }

  }
  else{

     redirect("login/admin_login","refresh");
  }

  }



//stuller api fuction call for testing
      public function call(){

$a= "27268,27269,27270";

  return $this->new_arrive_stuller_data($a);

    }









//main stuller api function call for add data
//add product from api

public function new_arrive_stuller_data($str){


  $ip = $this->input->ip_address();
  date_default_timezone_set("Asia/Calcutta");
  $cur_date=date("Y-m-d H:i:s");
  $addedby=$this->session->userdata('admin_id');






$categoryIDs_array= explode(",",$str);

// print_r($categoryIDs_array); die();





//delete previous data from the table start

  $this->db->select('*');
  $this->db->from('tbl_new_arrival_products');
  $product_data= $this->db->get();


if(!empty($product_data)){
  foreach ($product_data->result() as $pro) {

     $this->db->delete('tbl_new_arrival_products', array('id' => $pro->id));

  }
}

//delete previous data from the table end





$n=0;
if(!empty($categoryIDs_array)){
  foreach ($categoryIDs_array as $api_id) {






$total_pages=0;
//get count of total number of products start

$url = 'https://api.stuller.com/v2/products';
  $data = '{"Filter":["Orderable","OnPriceList","Finished"],"AdvancedProductFilters": [{ "Type": "CreationDate", "Values": [{ "DisplayValue": "2021-01-01", "Value": "2021-01-01" }] }],"CategoryIds":["'.$api_id.'"]  }';


$postdata = $data;

$header = array();
$header[] = 'Host:api.stuller.com';
$header[] = 'Content-Type:application/json';
$header[] = 'Authorization:Basic ZGV2amV3ZWw6Q29kaW5nMjA9';

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
$result = curl_exec($ch);
curl_close($ch);
// print_r ($result);

$result_da= json_decode($result);
// echo $result[0];



if(!empty($result_da)){


    $TotalNumberOfProducts= $result_da->TotalNumberOfProducts;
    $total_pages= round($TotalNumberOfProducts/500) + 1;

}


//get count of total number of products end








//product data insert from the api start


$NextPage= "";

for ($i=0; $i < $total_pages; $i++) {
  // code...
// echo $i;


$url = 'https://api.stuller.com/v2/products';
if($i == 0){
  $data = '{"Filter":["Orderable","OnPriceList","Finished"],"AdvancedProductFilters": [{ "Type": "CreationDate", "Values": [{ "DisplayValue": "2021-01-01", "Value": "2021-01-01" }] }],"CategoryIds":["'.$api_id.'"] }';
}else {
  $data = '{"Filter":["Orderable","OnPriceList","Finished"],"AdvancedProductFilters": [{ "Type": "CreationDate", "Values": [{ "DisplayValue": "2021-01-01", "Value": "2021-01-01" }] }],"CategoryIds":["'.$api_id.'"],"NextPage":"'.$NextPage.'" }';
}





$postdata = $data;

$header = array();
$header[] = 'Host:api.stuller.com';
$header[] = 'Content-Type:application/json';
$header[] = 'Authorization:Basic ZGV2amV3ZWw6Q29kaW5nMjA9';

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
$result = curl_exec($ch);
curl_close($ch);

$result_da= json_decode($result);

if(!empty($result_da)){

foreach ($result_da->Products as $prod) {

  $ringsize= 0;
  $ringsizetype= "";
  $RingSizable= "";

if(!empty($prod->RingSizable)){

  $RingSizable=$prod->RingSizable;
  if($RingSizable == false){
        $ringsize= 0;
        $ringsizetype= "";
  }else {

    if(!empty($prod->ringsize)){
        $ringsize= $prod->ringsize;
    }
    if(!empty($prod->ringsizetype)){
        $ringsizetype= $prod->ringsizetype;
    }

  }

}

//group eliments

$DescriptiveElements= $prod->DescriptiveElementGroup->DescriptiveElements;
$cate_array_count=0; if(!empty($DescriptiveElements)) {  $cate_array_count= count($DescriptiveElements);  }


$desc_e_name1="";
$desc_e_value1="";
$desc_e_name2="";
$desc_e_value2="";
$desc_e_name3="";
$desc_e_value3="";
$desc_e_name4="";
$desc_e_value4="";
$desc_e_name5="";
$desc_e_value5="";
$desc_e_name6="";
$desc_e_value6="";
$desc_e_name7="";
$desc_e_value7="";
$desc_e_name8="";
$desc_e_value8="";
$desc_e_name9="";
$desc_e_value9="";
$desc_e_name10="";
$desc_e_value10="";
$desc_e_name11="";
$desc_e_value11="";
$desc_e_name12="";
$desc_e_value12="";
$desc_e_name13="";
$desc_e_value13="";
$desc_e_name14="";
$desc_e_value14="";
$desc_e_name15="";
$desc_e_value15="";

if($cate_array_count >= 1){
 $desc_e_name1= $DescriptiveElements[0]->Name;
 $desc_e_value1= $DescriptiveElements[0]->Value;
}
if($cate_array_count >= 2){
 $desc_e_name2= $DescriptiveElements[1]->Name;
 $desc_e_value2= $DescriptiveElements[1]->Value;
}
if($cate_array_count >= 3){
 $desc_e_name3= $DescriptiveElements[2]->Name;
 $desc_e_value3= $DescriptiveElements[2]->Value;
}
if($cate_array_count >= 4){
 $desc_e_name4= $DescriptiveElements[3]->Name;
 $desc_e_value4= $DescriptiveElements[3]->Value;
}
if($cate_array_count >= 5){
 $desc_e_name5= $DescriptiveElements[4]->Name;
 $desc_e_value5= $DescriptiveElements[4]->Value;
}
if($cate_array_count >= 6){
 $desc_e_name6= $DescriptiveElements[5]->Name;
 $desc_e_value6= $DescriptiveElements[5]->Value;
}
if($cate_array_count >= 7){
 $desc_e_name7= $DescriptiveElements[6]->Name;
 $desc_e_value7= $DescriptiveElements[6]->Value;
}
if($cate_array_count >= 8){
 $desc_e_name8= $DescriptiveElements[7]->Name;
 $desc_e_value8= $DescriptiveElements[7]->Value;
}
if($cate_array_count >= 9){
 $desc_e_name9= $DescriptiveElements[8]->Name;
 $desc_e_value9= $DescriptiveElements[8]->Value;
}
if($cate_array_count >= 10){
 $desc_e_name10= $DescriptiveElements[9]->Name;
 $desc_e_value10= $DescriptiveElements[9]->Value;
}
if($cate_array_count >= 11){
 $desc_e_name11= $DescriptiveElements[10]->Name;
 $desc_e_value11= $DescriptiveElements[10]->Value;
}
if($cate_array_count >= 12){
 $desc_e_name12= $DescriptiveElements[11]->Name;
 $desc_e_value12= $DescriptiveElements[11]->Value;
}
if($cate_array_count >= 13){
 $desc_e_name13= $DescriptiveElements[12]->Name;
 $desc_e_value13= $DescriptiveElements[12]->Value;
}
if($cate_array_count >= 14){
 $desc_e_name14= $DescriptiveElements[13]->Name;
 $desc_e_value14= $DescriptiveElements[13]->Value;
}
if($cate_array_count >= 15){
 $desc_e_name15= $DescriptiveElements[14]->Name;
 $desc_e_value15= $DescriptiveElements[14]->Value;
}


$image1= "";
$image2= "";
$image3= "";
$image4= "";
$image5= "";
$image6= "";
$gimage1= "";
$gimage2= "";
$gimage3= "";

$fullysetimage1= "";
$fullysetimage2= "";
$fullysetimage3= "";
$fullysetimage4= "";
$fullysetimage5= "";
$fullysetimage6= "";

//get images
// if(!empty($prod->Images)){
//   $image1= $prod->Images[0]->FullUrl;
//   $image2= $prod->Images[0]->ThumbnailUrl;
//   $image3= $prod->Images[0]->ZoomUrl;
// }
// if(!empty($prod->GroupImages)){
//   $gimage1= $prod->GroupImages[0]->ZoomUrl;
//   $gimage2= $prod->GroupImages[0]->ZoomUrl;
//   $gimage3= $prod->GroupImages[0]->ZoomUrl;
// }




//get images
if(!empty($prod->Images)){

 $image_peram_count= count($prod->Images);

 if($image_peram_count >= 1){
   $image1= $prod->Images[0]->FullUrl;
 }

 if($image_peram_count >= 2){
   $image2= $prod->Images[1]->FullUrl;
 }

 if($image_peram_count >= 3){
   $image3= $prod->Images[2]->FullUrl;
 }

 if($image_peram_count >= 4){
   $image4= $prod->Images[3]->FullUrl;
 }

 if($image_peram_count >= 5){
   $image5= $prod->Images[4]->FullUrl;
 }

 if($image_peram_count >= 6){
   $image5= $prod->Images[5]->FullUrl;
 }

  // $image1= $prod->Images[0]->FullUrl;
  // $image2= $prod->Images[0]->ThumbnailUrl;
  // $image3= $prod->Images[0]->ZoomUrl;
}

//get group images
if(!empty($prod->GroupImages)){

  $Groupimage_peram_count= count($prod->GroupImages);

  if($Groupimage_peram_count >= 1){
    $gimage1= $prod->GroupImages[0]->FullUrl;
  }

  if($Groupimage_peram_count >= 2){
    $gimage2= $prod->GroupImages[1]->FullUrl;
  }

  if($Groupimage_peram_count >= 3){
    $gimage3= $prod->GroupImages[2]->FullUrl;
  }

  // $gimage1= $prod->GroupImages[0]->ZoomUrl;
  // $gimage2= $prod->GroupImages[0]->ZoomUrl;
  // $gimage3= $prod->GroupImages[0]->ZoomUrl;
}


//get Fully Set Images images

if(!empty($prod->FullySetImages)){

  $FullySetimage_peram_count= count($prod->FullySetImages);

  if($FullySetimage_peram_count >= 1){
    $fullysetimage1= $prod->FullySetImages[0]->FullUrl;
  }

  if($FullySetimage_peram_count >= 2){
    $fullysetimage2 = $prod->FullySetImages[1]->FullUrl;
  }

  if($FullySetimage_peram_count >= 3){
    $fullysetimage3 = $prod->FullySetImages[2]->FullUrl;
  }

  if($FullySetimage_peram_count >= 4){
    $fullysetimage4 = $prod->FullySetImages[3]->FullUrl;
  }

  if($FullySetimage_peram_count >= 5){
    $fullysetimage5 = $prod->FullySetImages[4]->FullUrl;
  }

  if($FullySetimage_peram_count >= 6){
    $fullysetimage6 = $prod->FullySetImages[5]->FullUrl;
  }

  // $image1= $prod->Images[0]->FullUrl;
  // $image2= $prod->Images[0]->ThumbnailUrl;
  // $image3= $prod->Images[0]->ZoomUrl;
}










//get AGTA

if(!empty($prod->AGTA)){
  $agta= $prod->AGTA;
}else {
  $agta="";
}

//get MerchandisingCategory
$mcat1= "";
$mcat2= "";
$mcat3= "";
$mcat4= "";
$mcat5= "";

if(!empty($prod->MerchandisingCategory1)){
  $mcat1= $prod->MerchandisingCategory1;
}
if(!empty($prod->MerchandisingCategory2)){
  $mcat2= $prod->MerchandisingCategory2;
}
if(!empty($prod->MerchandisingCategory3)){
  $mcat3= $prod->MerchandisingCategory3;
}
if(!empty($prod->MerchandisingCategory4)){
  $mcat4= $prod->MerchandisingCategory4;
}
if(!empty($prod->MerchandisingCategory5)){
  $mcat5= $prod->MerchandisingCategory5;
}


$Description= "";
if(!empty($prod->Description)){
  $Description= $prod->Description;
}

$ShortDescription= "";
if(!empty($prod->ShortDescription)){
  $ShortDescription= $prod->ShortDescription;
}

$GroupDescription= "";
if(!empty($prod->GroupDescription)){
  $GroupDescription= $prod->GroupDescription;
}

$LeadTime= "";
if(!empty($prod->LeadTime)){
  $LeadTime= $prod->LeadTime;
}


//get vedio and Group vedios
$vedio="";
$gvedio="";
if(!empty($prod->Videos)){
  $vedio= $prod->Videos[0]->Url;
}

if(!empty($prod->GroupVideos)){
  $gvedio= $prod->GroupVideos[0]->Url;

}






//explode sku for get and save sku series and sku series type start


$sku_no= $prod->SKU;
$sku_ar= explode(":",$sku_no);
// print_r($sku_ar);
 $cate_param_count= count($sku_ar);

$sku_series = "";
$sku_series_type1 = "";
$sku_series_type2 = "";
$sku_series_type3 = "";

if($cate_param_count >= 1){
  $sku_series = $sku_ar[0];
}

if($cate_param_count >= 2){
  $sku_series_type1 = $sku_ar[1];
}

if($cate_param_count >= 3){
  $sku_series_type2 = $sku_ar[2];
}

if($cate_param_count >= 4){
  $sku_series_type3 = $sku_ar[3];
}



//explode sku for get and save sku series and sku series type end






  $data_insert = array(
         'product_id'=>$prod->Id,
         // 'category'=>$category_id,
         // 'sub_category'=>$subcategory,
         // 'minisub_category'=>$minisubcategory,
         // 'vendor'=>1,
         'sku'=>$prod->SKU,
         'sku_series'=>$sku_series,
         'sku_series_type1'=>$sku_series_type1,
         'sku_series_type2'=>$sku_series_type2,
         'sku_series_type3'=>$sku_series_type3,
         'description'=>$Description,
         'sdesc'=>$ShortDescription,
         'gdesc'=>$GroupDescription,
         'mcat1'=>$mcat1,
         'mcat2'=>$mcat2,
         'mcat3'=>$mcat3,
         'mcat4'=>$mcat4,
         'mcat5'=>$mcat5,
         'product_type'=>$prod->ProductType,
         'collection'=>"",
         'onhand'=>$prod->OnHand,
         'status'=>$prod->Status,
         'price'=>$prod->Price->Value,
         'currency'=>$prod->Price->CurrencyCode,
         'unitofsale'=>$prod->UnitOfSale,
         'weight'=>$prod->Weight,
         'weightunit'=>$prod->WeightUnitOfMeasure,
         'gramweight'=>$prod->GramWeight,
         'ringsizable'=>$RingSizable,
         'ringsize'=>$ringsize,
         'ringsizetype'=>$ringsizetype,
         'leadtime'=>$LeadTime,
         'agta'=>$agta,
         'desc_e_grp'=>$prod->DescriptiveElementGroup->GroupName,
         'desc_e_name1'=>$desc_e_name1,
         'desc_e_value1'=>$desc_e_value1,
         'desc_e_name2'=>$desc_e_name2,
         'desc_e_value2'=>$desc_e_value2,
         'desc_e_name3'=>$desc_e_name3,
         'desc_e_value3'=>$desc_e_value3,
         'desc_e_name4'=>$desc_e_name4,
         'desc_e_value4'=>$desc_e_value4,
         'desc_e_name5'=>$desc_e_name5,
         'desc_e_value5'=>$desc_e_value5,
         'desc_e_name6'=>$desc_e_name6,
         'desc_e_value6'=>$desc_e_value6,
         'desc_e_name7'=>$desc_e_name7,
         'desc_e_value7'=>$desc_e_value7,
         'desc_e_name8'=>$desc_e_name8,
         'desc_e_value8'=>$desc_e_value8,
         'desc_e_name9'=>$desc_e_name9,
         'desc_e_value9'=>$desc_e_value9,
         'desc_e_name10'=>$desc_e_name10,
         'desc_e_value10'=>$desc_e_value10,
         'desc_e_name11'=>$desc_e_name11,
         'desc_e_value11'=>$desc_e_value11,
         'desc_e_name12'=>$desc_e_name12,
         'desc_e_value12'=>$desc_e_value12,
         'desc_e_name13'=>$desc_e_name13,
         'desc_e_value13'=>$desc_e_value13,
         'desc_e_name14'=>$desc_e_name14,
         'desc_e_value14'=>$desc_e_value14,
         'desc_e_name15'=>$desc_e_name15,
         'desc_e_value15'=>$desc_e_value15,
         'readytowear'=>$prod->ReadyToWear,
         'smi'=>"",
         'image1'=>$image1,
         'image2'=>$image2,
         'image3'=>$image3,

        'image4'=>$image4,
        'image5'=>$image5,
        'image6'=>$image6,
        'FullySetImage1'=>$fullysetimage1,
        'FullySetImage2'=>$fullysetimage2,
        'FullySetImage3'=>$fullysetimage3,
        'FullySetImage4'=>$fullysetimage4,
        'FullySetImage5'=>$fullysetimage5,
        'FullySetImage6'=>$fullysetimage6,


         'video'=>$vedio,
         'gimage1'=>$gimage1,
         'gimage2'=>$gimage2,
         'gimage3'=>$gimage3,
         'gvideo'=>$gvedio,
         'creationdate'=>$prod->CreationDate,
         'currencycode'=>"USD",
         'country'=>$prod->CountryOfOrigin,
         'dclarity'=>"",
         'dcolor'=>"",
         'totalweight'=>"",

            'ip' =>$ip,
            'added_by' =>$addedby,
            'is_active' =>1,
            'date'=>$cur_date
            );


  $last_id=$this->base_model->insert_table("tbl_new_arrival_products",$data_insert,1);



}


$NextPage= "";

if(!empty($result_da->NextPage)){
$NextPage= $result_da->NextPage;
}
// echo $i." NP- ".$NextPage."<br>";


}

// $NextPage= "";
// $NextPage= $result_da->NextPage;
// echo $i." NP- ".$NextPage."<br>";


}

//product data insert from the api end

// die();

$n++;
}
}






return 1;


}




                      }

      ?>
