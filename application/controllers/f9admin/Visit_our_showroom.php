<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
       require_once(APPPATH . 'core/CI_finecontrol.php');
       class Visit_our_showroom extends CI_finecontrol{
       function __construct()
           {
             parent::__construct();
             $this->load->model("login_model");
             $this->load->model("admin/base_model");
             $this->load->library('user_agent');
             $this->load->library('upload');
           }

         public function view_visit_our_showroom(){

            if(!empty($this->session->userdata('admin_data'))){


              $data['user_name']=$this->load->get_var('user_name');

              // echo SITE_NAME;
              // echo $this->session->userdata('image');
              // echo $this->session->userdata('position');
              // exit;

                           $this->db->select('*');
               $this->db->from('tbl_visit_our_showroom');
               //$this->db->where('id',$usr);
               $data['visit_our_showroom_data']= $this->db->get();

              $this->load->view('admin/common/header_view',$data);
              $this->load->view('admin/visit_our_showroom/view_visit_our_showroom');
              $this->load->view('admin/common/footer_view');

          }
          else{

             redirect("login/admin_login","refresh");
          }

          }

              public function add_visit_our_showroom(){

                 if(!empty($this->session->userdata('admin_data'))){

                   $this->load->view('admin/common/header_view');
                   $this->load->view('admin/visit_our_showroom/add_visit_our_showroom');
                   $this->load->view('admin/common/footer_view');

               }
               else{

                  redirect("login/admin_login","refresh");
               }

               }

               public function update_visit_our_showroom($idd){

                   if(!empty($this->session->userdata('admin_data'))){


                     $data['user_name']=$this->load->get_var('user_name');

                     // echo SITE_NAME;
                     // echo $this->session->userdata('image');
                     // echo $this->session->userdata('position');
                     // exit;

                      $id=base64_decode($idd);
                     $data['id']=$idd;

                            $this->db->select('*');
                            $this->db->from('tbl_visit_our_showroom');
                            $this->db->where('id',$id);
                            $data['visit_our_showroom_data']= $this->db->get()->row();


                     $this->load->view('admin/common/header_view',$data);
                     $this->load->view('admin/visit_our_showroom/update_visit_our_showroom');
                     $this->load->view('admin/common/footer_view');

                 }
                 else{

                    redirect("login/admin_login","refresh");
                 }

                 }

             public function add_visit_our_showroom_data($t,$iw="")

               {

                 if(!empty($this->session->userdata('admin_data'))){


             $this->load->helper(array('form', 'url'));
             $this->load->library('form_validation');
             $this->load->helper('security');
             if($this->input->post())
             {
               // print_r($this->input->post());
               // exit;
  $this->form_validation->set_rules('address', 'address', 'required');
  $this->form_validation->set_rules('fax', 'fax', 'required');
  $this->form_validation->set_rules('store_hours', 'store_hours', 'required');
  $this->form_validation->set_rules('map', 'map', 'required');
           if($this->form_validation->run()== TRUE)
               {
  $address=$this->input->post('address');
  $fax=$this->input->post('fax');
  $store_hours=$this->input->post('store_hours');
  $map=$this->input->post('map');

                   $ip = $this->input->ip_address();
                   date_default_timezone_set("Asia/Calcutta");
                   $cur_date=date("Y-m-d H:i:s");
                   $addedby=$this->session->userdata('admin_id');
                   $img1='image';
                   $nnnn = '';

                               $file_check=($_FILES['image']['error']);
                               if($file_check!=4){
                             	$image_upload_folder = FCPATH . "assets/uploads/visit_our_showroom/";
                     						if (!file_exists($image_upload_folder))
                     						{
                     							mkdir($image_upload_folder, DIR_WRITE_MODE, true);
                     						}
                     						$new_file_name="visit_our_showroom".date("Ymdhms");
                     						$this->upload_config = array(
                     								'upload_path'   => $image_upload_folder,
                     								'file_name' => $new_file_name,
                     								'allowed_types' =>'jpg|jpeg|png',
                     								'max_size'      => 25000
                     						);
                     						$this->upload->initialize($this->upload_config);
                     						if (!$this->upload->do_upload($img1))
                     						{
                     							$upload_error = $this->upload->display_errors();
                                   $this->session->set_flashdata('emessage',$upload_error);
                                      redirect($_SERVER['HTTP_REFERER']);
                     							// echo json_encode($upload_error);
                     							// echo $upload_error;
                     						}
                     						else
                     						{

                     							$file_info = $this->upload->data();

                     							$videoNAmePath = "assets/uploads/visit_our_showroom/".$new_file_name.$file_info['file_ext'];
                     							$nnnn=$videoNAmePath;
                     							// echo json_encode($file_info);
                     						}
                               }

           $typ=base64_decode($t);
           $last_id = 0;
           if($typ==1){
             $imageUpload = $nnnn;
           $data_insert = array(
                  'address'=>$address,
                  'fax'=>$fax,
                  'store_hours'=>$store_hours,
                  'map'=>$map,
                  'image'=>$imageUpload,

                     'ip' =>$ip,
                     'added_by' =>$addedby,
                     'is_active' =>1,
                     'date'=>$cur_date
                     );


           $last_id=$this->base_model->insert_table("tbl_visit_our_showroom",$data_insert,1) ;

           }
           if($typ==2){

    $idw=base64_decode($iw);


 $this->db->select('*');
 $this->db->from('tbl_visit_our_showroom');
 $this->db->where('id',$idw);
 $dsa=$this->db->get();
 $da=$dsa->row();
 if($nnnn == ''){
   $imageUpload = $da->image;
 }else{
   $imageUpload = $nnnn;
 }
     $data_insert = array(
       'address'=>$address,
       'fax'=>$fax,
       'store_hours'=>$store_hours,
       'map'=>$map,
       'image'=>$imageUpload,
                     );
             $this->db->where('id', $idw);
             $last_id=$this->db->update('tbl_visit_our_showroom', $data_insert);
           }
                       if($last_id!=0){
                               $this->session->set_flashdata('smessage','Data inserted successfully');
                               redirect("dcadmin/visit_our_showroom/view_visit_our_showroom","refresh");
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

               public function updatevisit_our_showroomStatus($idd,$t){

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
                       $zapak=$this->db->update('tbl_visit_our_showroom', $data_update);

                            if($zapak!=0){
                            redirect("dcadmin/visit_our_showroom/view_visit_our_showroom","refresh");
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
                         $zapak=$this->db->update('tbl_visit_our_showroom', $data_update);

                             if($zapak!=0){
                             redirect("dcadmin/visit_our_showroom/view_visit_our_showroom","refresh");
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

               public function delete_visit_our_showroom($idd){

                      if(!empty($this->session->userdata('admin_data'))){

                        $data['user_name']=$this->load->get_var('user_name');

                        // echo SITE_NAME;
                        // echo $this->session->userdata('image');
                        // echo $this->session->userdata('position');
                        // exit;
                        $id=base64_decode($idd);

                       if($this->load->get_var('position')=="Super Admin"){

                     $this->db->select('image');
                     $this->db->from('tbl_visit_our_showroom');
                     $this->db->where('id',$id);
                     $dsa= $this->db->get();
                     $da=$dsa->row();
                     $img=$da->image;

 $zapak=$this->db->delete('tbl_visit_our_showroom', array('id' => $id));
 if($zapak!=0){
        $path = FCPATH .$img;
          unlink($path);
        redirect("dcadmin/visit_our_showroom/view_visit_our_showroom","refresh");
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
