<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
       require_once(APPPATH . 'core/CI_finecontrol.php');
       class Sub_category extends CI_finecontrol{
       function __construct()
           {
             parent::__construct();
             $this->load->model("login_model");
             $this->load->model("admin/base_model");
             $this->load->library('user_agent');
             $this->load->library('upload');
           }

         public function view_sub_category(){

            if(!empty($this->session->userdata('admin_data'))){


              $data['user_name']=$this->load->get_var('user_name');

              // echo SITE_NAME;
              // echo $this->session->userdata('image');
              // echo $this->session->userdata('position');
              // exit;

                           $this->db->select('*');
               $this->db->from('tbl_sub_category');
               //$this->db->where('id',$usr);
               $data['sub_category_data']= $this->db->get();

              $this->load->view('admin/common/header_view',$data);
              $this->load->view('admin/sub_category/view_sub_category');
              $this->load->view('admin/common/footer_view');

          }
          else{

             redirect("login/admin_login","refresh");
          }

          }

              public function add_sub_category(){

                 if(!empty($this->session->userdata('admin_data'))){

                   $this->db->select('*');
                   $this->db->from('tbl_category');
                   $this->db->where('is_active',1);
                   $data['category']= $this->db->get();

                   $this->load->view('admin/common/header_view',$data);
                   $this->load->view('admin/sub_category/add_sub_category');
                   $this->load->view('admin/common/footer_view');

               }
               else{

                  redirect("login/admin_login","refresh");
               }

               }

               public function update_sub_category($idd){

                   if(!empty($this->session->userdata('admin_data'))){


                     $data['user_name']=$this->load->get_var('user_name');

                     // echo SITE_NAME;
                     // echo $this->session->userdata('image');
                     // echo $this->session->userdata('position');
                     // exit;

                      $id=base64_decode($idd);
                     $data['id']=$idd;

                            $this->db->select('*');
                            $this->db->from('tbl_sub_category');
                            $this->db->where('id',$id);
                            $data['sub_category_data']= $this->db->get()->row();


                     $this->load->view('admin/common/header_view',$data);
                     $this->load->view('admin/sub_category/update_sub_category');
                     $this->load->view('admin/common/footer_view');

                 }
                 else{

                    redirect("login/admin_login","refresh");
                 }

                 }

             public function add_sub_category_data($t,$iw="")

               {

                 if(!empty($this->session->userdata('admin_data'))){


             $this->load->helper(array('form', 'url'));
             $this->load->library('form_validation');
             $this->load->helper('security');
             if($this->input->post())
             {
               // print_r($this->input->post());
               // exit;
  $this->form_validation->set_rules('category', 'category', 'required|xss_clean|trim');
  $this->form_validation->set_rules('name', 'name', 'required|xss_clean|trim');
  $this->form_validation->set_rules('type', 'type', 'required|xss_clean|trim');

  $this->form_validation->set_rules('api_id', 'api_id', 'xss_clean|trim');
  $this->form_validation->set_rules('seq', 'sequence number', 'required|xss_clean|trim');
  $this->form_validation->set_rules('finshed', 'finshed', 'xss_clean|trim');
  $this->form_validation->set_rules('exlude_series', 'exlude_series', 'xss_clean|trim');
  $this->form_validation->set_rules('exlude_sku', 'exlude_sku', 'xss_clean|trim');
  $this->form_validation->set_rules('include_series', 'include_series', 'xss_clean|trim');
  $this->form_validation->set_rules('include_sku', 'include_sku', 'xss_clean|trim');







               if($this->form_validation->run()== TRUE)
               {
  $category=$this->input->post('category');
  $name=$this->input->post('name');
  $type=$this->input->post('type');

  $api_id1=$this->input->post('api_id');
  $seq=$this->input->post('seq');
  $finshed=$this->input->post('finshed');
  $exlude_series=$this->input->post('exlude_series');
  $exlude_sku=$this->input->post('exlude_sku');
  $include_series=$this->input->post('include_series');
  $include_sku=$this->input->post('include_sku');

  $api_id=explode(",",$api_id1);

  if($finshed == 1){
    $f_id= 1;
  }else{
    $f_id= 0;
  }


      $api_id=json_encode($api_id);


                   $ip = $this->input->ip_address();
                   date_default_timezone_set("Asia/Calcutta");
                   $cur_date=date("Y-m-d H:i:s");
                   $addedby=$this->session->userdata('admin_id');

           $typ=base64_decode($t);
           $last_id = 0;
           if($typ==1){



$img2='image';


           $file_check=($_FILES['image']['error']);
if($file_check!=4){

         $image_upload_folder = FCPATH . "assets/uploads/sub_category/";
                     if (!file_exists($image_upload_folder))
                     {
                         mkdir($image_upload_folder, DIR_WRITE_MODE, true);
                     }
                     $new_file_name="sub_category".date("Ymdhms");
                     $this->upload_config = array(
                             'upload_path'   => $image_upload_folder,
                             'file_name' => $new_file_name,
                             'allowed_types' =>'xlsx|csv|xls|pdf|doc|docx|txt|jpg|jpeg|png',
                             'max_size'      => 25000
                     );
                     $this->upload->initialize($this->upload_config);
                     if (!$this->upload->do_upload($img2))
                     {
                         $upload_error = $this->upload->display_errors();
                         // echo json_encode($upload_error);

           //$this->session->set_flashdata('emessage',$upload_error);
             //redirect($_SERVER['HTTP_REFERER']);
                     }
                     else
                     {

                         $file_info = $this->upload->data();

                         $videoNAmePath = "assets/uploads/sub_category/".$new_file_name.$file_info['file_ext'];
                         $file_info['new_name']=$videoNAmePath;
                         // $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
                         $nnnn=$file_info['file_name'];
                         $nnnn2=$videoNAmePath;

                         // echo json_encode($file_info);
                     }
        }
        //Banner
        $bann2='banner';


                   $file_check=($_FILES['banner']['error']);
        if($file_check!=4){

                 $image_upload_folder = FCPATH . "assets/uploads/sub_category/";
                             if (!file_exists($image_upload_folder))
                             {
                                 mkdir($image_upload_folder, DIR_WRITE_MODE, true);
                             }
                             $new_file_name="sub_category2".date("Ymdhms");
                             $this->upload_config = array(
                                     'upload_path'   => $image_upload_folder,
                                     'file_name' => $new_file_name,
                                     'allowed_types' =>'xlsx|csv|xls|pdf|doc|docx|txt|jpg|jpeg|png',
                                     'max_size'      => 25000
                             );
                             $this->upload->initialize($this->upload_config);
                             if (!$this->upload->do_upload($bann2))
                             {
                                 $upload_error = $this->upload->display_errors();
                                 // echo json_encode($upload_error);

                   //$this->session->set_flashdata('emessage',$upload_error);
                     //redirect($_SERVER['HTTP_REFERER']);
                             }
                             else
                             {

                                 $file_info = $this->upload->data();

                                 $videoNAmePath = "assets/uploads/sub_category/".$new_file_name.$file_info['file_ext'];
                                 $file_info['new_name']=$videoNAmePath;
                                 // $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
                                 $banner=$file_info['file_name'];
                                 $banner2=$videoNAmePath;

                                 // echo json_encode($file_info);
                             }
                }else{
                  $banner2='';
                }



           $data_insert = array(
                  'category'=>$category,
  'name'=>$name,
  'image'=>$nnnn2,
  'banner'=>$banner2,
  'type'=>$type,
  'api_id'=>$api_id,
  'seq'=>$seq,
  'finshed'=>$finshed,
  'exlude_series'=>$exlude_series,
  'exlude_sku'=>$exlude_sku,
  'include_series'=>$include_series,
  'include_sku'=>$include_sku,


                     'ip' =>$ip,
                     'added_by' =>$addedby,
                     'is_active' =>1,
                     'date'=>$cur_date
                     );


           $last_id=$this->base_model->insert_table("tbl_sub_category",$data_insert,1) ;

           }
           if($typ==2){

    $idw=base64_decode($iw);


 $this->db->select('*');
 $this->db->from('tbl_sub_category');
 $this->db->where('id',$idw);
 $dsa=$this->db->get();
 $da=$dsa->row();



$img2='image';


           $file_check=($_FILES['image']['error']);
if($file_check!=4){

         $image_upload_folder = FCPATH . "assets/uploads/sub_category/";
                     if (!file_exists($image_upload_folder))
                     {
                         mkdir($image_upload_folder, DIR_WRITE_MODE, true);
                     }
                     $new_file_name="sub_category".date("Ymdhms");
                     $this->upload_config = array(
                             'upload_path'   => $image_upload_folder,
                             'file_name' => $new_file_name,
                             'allowed_types' =>'xlsx|csv|xls|pdf|doc|docx|txt|jpg|jpeg|png',
                             'max_size'      => 25000
                     );
                     $this->upload->initialize($this->upload_config);
                     if (!$this->upload->do_upload($img2))
                     {
                         $upload_error = $this->upload->display_errors();
                         // echo json_encode($upload_error);

           //$this->session->set_flashdata('emessage',$upload_error);
             //redirect($_SERVER['HTTP_REFERER']);
                     }
                     else
                     {

                         $file_info = $this->upload->data();

                         $videoNAmePath = "assets/uploads/sub_category/".$new_file_name.$file_info['file_ext'];
                         $file_info['new_name']=$videoNAmePath;
                         // $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
                         $nnnn=$file_info['file_name'];
                         $nnnn2=$videoNAmePath;

                         // echo json_encode($file_info);
                     }
        }



 if(!empty($da)){ $img = $da ->image;
if(!empty($img)) { if(empty($nnnn2)){ $nnnn2 = $img; } }else{ if(empty($nnnn2)){ $nnnn2= ""; } } }

           $data_insert = array(
                  'category'=>$category,
  'name'=>$name,
    'type'=>$type,
  'image'=>$nnnn2,
  'api_id'=>$api_id,
  'seq'=>$seq,
  'finshed'=>$finshed,
  'exlude_series'=>$exlude_series,
  'exlude_sku'=>$exlude_sku,
  'include_series'=>$include_series,
  'include_sku'=>$include_sku,


                     );
             $this->db->where('id', $idw);
             $last_id=$this->db->update('tbl_sub_category', $data_insert);
           }
                       if($last_id!=0){
                               $this->session->set_flashdata('smessage','Data inserted successfully');
                               redirect("dcadmin/sub_category/view_sub_category","refresh");
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

               public function updatesub_categoryStatus($idd,$t){

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
                       $zapak=$this->db->update('tbl_sub_category', $data_update);

                            if($zapak!=0){
                            redirect("dcadmin/sub_category/view_sub_category","refresh");
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
                         $zapak=$this->db->update('tbl_sub_category', $data_update);

                             if($zapak!=0){
                             redirect("dcadmin/sub_category/view_sub_category","refresh");
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



               public function delete_sub_category($idd){

                      if(!empty($this->session->userdata('admin_data'))){

                        $data['user_name']=$this->load->get_var('user_name');

                        // echo SITE_NAME;
                        // echo $this->session->userdata('image');
                        // echo $this->session->userdata('position');
                        // exit;
                        $id=base64_decode($idd);

                       if($this->load->get_var('position')=="Super Admin"){

                     $this->db->select('image');
                     $this->db->from('tbl_sub_category');
                     $this->db->where('id',$id);
                     $dsa= $this->db->get();
                     $da=$dsa->row();
                     $img=$da->image;

 $zapak=$this->db->delete('tbl_sub_category', array('id' => $id));
 if($zapak!=0){
        $path = FCPATH .$img;
          unlink($path);
        redirect("dcadmin/sub_category/view_sub_category","refresh");
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




      //delete category imag
        public function delete_subcategory_image($idd){

               if(!empty($this->session->userdata('admin_data'))){

                 $data['user_name']=$this->load->get_var('user_name');

                 // echo SITE_NAME;
                 // echo $this->session->userdata('image');
                 // echo $this->session->userdata('position');
                 // exit;
                 $id=base64_decode($idd);

                if($this->load->get_var('position')=="Super Admin"){

                  $this->db->select('image');
                  $this->db->from('tbl_sub_category');
                  $this->db->where('id',$id);
                  $dsa= $this->db->get();
                  $da=$dsa->row();
                  $img=$da->image;

              $data_update = array(
              'image'=>"",

              );

              $this->db->where('id', $id);
              $zapak=$this->db->update('tbl_sub_category', $data_update);

      if($zapak!=0){
          if(!empty($img)){
              $path = FCPATH .$img;
              unlink($path);
          }
      redirect("dcadmin/sub_category/view_sub_category","refresh");
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


      }else{

      redirect("login/admin_login","refresh");

      }

      }




                      }

      ?>
