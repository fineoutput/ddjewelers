<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
       require_once(APPPATH . 'core/CI_finecontrol.php');
       class State_detail extends CI_finecontrol{
       function __construct()
           {
             parent::__construct();
             $this->load->model("login_model");
             $this->load->model("admin/base_model");
             $this->load->library('user_agent');
             $this->load->library('upload');
           }

         public function view_state_detail(){

            if(!empty($this->session->userdata('admin_data'))){


              $data['user_name']=$this->load->get_var('user_name');

              // echo SITE_NAME;
              // echo $this->session->userdata('image');
              // echo $this->session->userdata('position');
              // exit;

            //                $this->db->select('*');
            //    $this->db->from('tbl_state_detail');
            //    $this->db->limit('10000','0');
            //    $data['state_detail_data']= $this->db->get();

              $this->load->view('admin/common/header_view',$data);
              $this->load->view('admin/state_detail/view_state_detail');
              $this->load->view('admin/common/footer_view');

          }
          else{

             redirect("login/admin_login","refresh");
          }

          }

          public function view_state_detail2(){

           
                           $this->db->select('*');
               $this->db->from('tbl_state_detail');
            //    $this->db->limit('10000','0');
               $da1= $this->db->get();



             $i=1; foreach($da1->result() as $da2) { 
            
                $arr2[] = array($i,$da2->country,$da2->Percentage,$da2->zip_code,$da2->is_active,$da2->is_active);
                $i++;
            }

             $arr = array('draw'=>1,
             'recordsTotal'=>$i,     
             'recordsFiltered'=>$i,     
             'data'=>$arr2     

);

// print_r($arr);
        echo json_encode($arr);
        exit; 

          }

              public function add_state_detail(){

                 if(!empty($this->session->userdata('admin_data'))){

                   $this->load->view('admin/common/header_view');
                   $this->load->view('admin/state_detail/add_state_detail');
                   $this->load->view('admin/common/footer_view');

               }
               else{

                  redirect("login/admin_login","refresh");
               }

               }

               public function update_state_detail($idd){

                   if(!empty($this->session->userdata('admin_data'))){


                     $data['user_name']=$this->load->get_var('user_name');

                     // echo SITE_NAME;
                     // echo $this->session->userdata('image');
                     // echo $this->session->userdata('position');
                     // exit;

                      $id=base64_decode($idd);
                     $data['id']=$idd;

                            $this->db->select('*');
                            $this->db->from('tbl_state_detail');
                            $this->db->where('id',$id);
                            $data['state_detail_data']= $this->db->get()->row();


                     $this->load->view('admin/common/header_view',$data);
                     $this->load->view('admin/state_detail/update_state_detail');
                     $this->load->view('admin/common/footer_view');

                 }
                 else{

                    redirect("login/admin_login","refresh");
                 }

                 }

             public function add_state_detail_data($t,$iw="")

               {

                 if(!empty($this->session->userdata('admin_data'))){


             $this->load->helper(array('form', 'url'));
             $this->load->library('form_validation');
             $this->load->helper('security');
             if($this->input->post())
             {
               // print_r($this->input->post());
               // exit;
  $this->form_validation->set_rules('country', 'country', 'required');
  $this->form_validation->set_rules('Percentage', 'Percentage', 'required');





               if($this->form_validation->run()== TRUE)
               {
  $country=$this->input->post('country');
  $Percentage=$this->input->post('Percentage');

                   $ip = $this->input->ip_address();
                   date_default_timezone_set("Asia/Calcutta");
                   $cur_date=date("Y-m-d H:i:s");
                   $addedby=$this->session->userdata('admin_id');

           $typ=base64_decode($t);
           $last_id = 0;
           if($typ==1){



           $data_insert = array(
                  'country'=>$country,
  'Percentage'=>$Percentage,

                     'ip' =>$ip,
                     'added_by' =>$addedby,
                     'is_active' =>1,
                     'date'=>$cur_date
                     );


           $last_id=$this->base_model->insert_table("tbl_state_detail",$data_insert,1) ;

           }
           if($typ==2){

    $idw=base64_decode($iw);


 $this->db->select('*');
 $this->db->from('tbl_state_detail');
 $this->db->where('id',$idw);
 $dsa=$this->db->get();
 $da=$dsa->row();





           $data_insert = array(
                  'country'=>$country,
  'Percentage'=>$Percentage,

                     );
             $this->db->where('id', $idw);
             $last_id=$this->db->update('tbl_state_detail', $data_insert);
           }
                       if($last_id!=0){
                               $this->session->set_flashdata('smessage','Data inserted successfully');
                               redirect("dcadmin/state_detail/view_state_detail","refresh");
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

               public function updatestate_detailStatus($idd,$t){

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
                       $zapak=$this->db->update('tbl_state_detail', $data_update);

                            if($zapak!=0){
                            redirect("dcadmin/state_detail/view_state_detail","refresh");
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
                         $zapak=$this->db->update('tbl_state_detail', $data_update);

                             if($zapak!=0){
                             redirect("dcadmin/state_detail/view_state_detail","refresh");
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



               public function delete_state_detail($idd){

                      if(!empty($this->session->userdata('admin_data'))){

                        $data['user_name']=$this->load->get_var('user_name');

                        // echo SITE_NAME;
                        // echo $this->session->userdata('image');
                        // echo $this->session->userdata('position');
                        // exit;
                        $id=base64_decode($idd);

                       if($this->load->get_var('position')=="Super Admin"){


 $zapak=$this->db->delete('tbl_state_detail', array('id' => $id));
 if($zapak!=0){
     
        redirect("dcadmin/state_detail/view_state_detail","refresh");
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
 //=================================  IMPORT STATE TAXES DATA FROM EXCEL =========================
 public function import_state_taxes_data()
 {
     require_once APPPATH . "/third_party/PHPExcel.php"; //------ INCLUDE EXCEL

     //-----------UPLOAD FILE INTO SERVER --------
     $ip = $this->input->ip_address();
     date_default_timezone_set("Asia/Calcutta");
     $cur_date=date("Y-m-d H:i:s");
     $addedby=$this->session->userdata('admin_id');
     $this->load->library('upload');
     $img1='uploadFile';
     $file_check=($_FILES['uploadFile']['error']);
     if ($file_check!=4) {
         $image_upload_folder = FCPATH . "assets/uploads/state_taxes/excel";
         if (!file_exists($image_upload_folder)) {
             mkdir($image_upload_folder, DIR_WRITE_MODE, true);
         }
         $new_file_name="state_taxes_excel".date("Ymdhms");
         $this->upload_config = array(
           'upload_path'   => $image_upload_folder,
           'file_name' => $new_file_name,
           'allowed_types' =>'xlsx|xls|csv',
           'max_size'      => 25000
           );
         $this->upload->initialize($this->upload_config);
         if (!$this->upload->do_upload($img1)) {
             $upload_error = $this->upload->display_errors();
             $this->session->set_flashdata('emessage', $upload_error);
             redirect($_SERVER['HTTP_REFERER']);
         } else {
             $file_info = $this->upload->data();

             $videoNAmePath = "assets/uploads/state_taxes/excel/".$new_file_name.$file_info['file_ext'];
             $inputFileName=$videoNAmePath;
         }
     }
     $this->db->truncate('tbl_state_detail');
     //-------- start excel read and insert into db
     try {
         $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
         $objReader = PHPExcel_IOFactory::createReader($inputFileType);
         $objPHPExcel = $objReader->load($inputFileName);
         $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
         $flag = true;
         $i=0;
         foreach ($allDataInSheet as $value) {
             if ($flag) {
                 $flag =false;
                 continue;
             }
             $data_insert = array('country'=>$value['A'],
                           'Percentage'=>$value['B'],
                           'zip_code'=>$value['C'],
                           'is_active'=>$value['D'],
                           'ip'=>$ip,
                           'added_by'=>$addedby,
                           'date'=>$cur_date );
             $last_id=$this->base_model->insert_table("tbl_state_detail", $data_insert, 1) ;
             $i++;
         }
         if ($last_id) {
             $this->session->set_flashdata('smessage', 'Data Uploaded Successfully!');
             redirect($_SERVER['HTTP_REFERER']);
         } else {
             $this->session->set_flashdata('emessage', 'Some error occurred!');
             redirect($_SERVER['HTTP_REFERER']);
         }
     } catch (Exception $e) {
         die('Error loading file "'.pathinfo($inputFileName, PATHINFO_BASENAME)
. '": ' .$e->getMessage());
     }
 }





                      }
