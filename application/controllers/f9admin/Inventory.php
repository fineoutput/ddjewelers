<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
       require_once(APPPATH . 'core/CI_finecontrol.php');
       class Inventory extends CI_finecontrol{
       function __construct()
           {
             parent::__construct();
             $this->load->model("login_model");
             $this->load->model("admin/base_model");
             $this->load->library('user_agent');
             $this->load->library('upload');
           }

         public function view_inventory(){

            if(!empty($this->session->userdata('admin_data'))){


              $data['user_name']=$this->load->get_var('user_name');

              // echo SITE_NAME;
              // echo $this->session->userdata('image');
              // echo $this->session->userdata('position');
              // exit;

                           $this->db->select('*');
               $this->db->from('tbl_inventory');
               //$this->db->where('id',$usr);
               $data['inventory_data']= $this->db->get();

              $this->load->view('admin/common/header_view',$data);
              $this->load->view('admin/inventory/view_inventory');
              $this->load->view('admin/common/footer_view');

          }
          else{

             redirect("login/admin_login","refresh");
          }

          }

          public function view_products(){

             if(!empty($this->session->userdata('admin_data'))){


               $data['user_name']=$this->load->get_var('user_name');

               // echo SITE_NAME;
               // echo $this->session->userdata('image');
               // echo $this->session->userdata('position');
               // exit;

                $this->db->select('*');
                $this->db->from('tbl_products');
                //$this->db->where('id',$usr);
                $data['products_data']= $this->db->get();

               $this->load->view('admin/common/header_view',$data);
               $this->load->view('admin/inventory/view_products');
               $this->load->view('admin/common/footer_view');

           }
           else{

              redirect("login/admin_login","refresh");
           }

           }

           public function view_product_types($idd){

               if(!empty($this->session->userdata('admin_data'))){


                 $data['user_name']=$this->load->get_var('user_name');

                 // echo SITE_NAME;
                 // echo $this->session->userdata('image');
                 // echo $this->session->userdata('position');
                 // exit;

                  $id=base64_decode($idd);
                 $data['id']=$idd;
                 // echo $id;exit;

                        $this->db->select('*');
                        $this->db->from('tbl_types');
                        $this->db->where('product',$id);
                        $data['types_data']= $this->db->get();


                 $this->load->view('admin/common/header_view',$data);
                 $this->load->view('admin/inventory/view_product_types');
                 $this->load->view('admin/common/footer_view');

             }
             else{

                redirect("login/admin_login","refresh");
             }

             }


              public function add_inventory(){

                 if(!empty($this->session->userdata('admin_data'))){

                   $this->db->select('*');
                   $this->db->from('tbl_products');
                   //$this->db->where('',);
                   $data['products']= $this->db->get();

                   $this->load->view('admin/common/header_view',$data);
                   $this->load->view('admin/inventory/add_inventory');
                   $this->load->view('admin/common/footer_view');

               }
               else{

                  redirect("login/admin_login","refresh");
               }

               }

               public function update_inventory($idd){

                   if(!empty($this->session->userdata('admin_data'))){


                     $data['user_name']=$this->load->get_var('user_name');

                     // echo SITE_NAME;
                     // echo $this->session->userdata('image');
                     // echo $this->session->userdata('position');
                     // exit;

                      $id=base64_decode($idd);
                     $data['id']=$idd;

                            $this->db->select('*');
                            $this->db->from('tbl_inventory');
                            $this->db->where('id',$id);
                            $data['inventory_data']= $this->db->get()->row();


                     $this->load->view('admin/common/header_view',$data);
                     $this->load->view('admin/inventory/update_inventory');
                     $this->load->view('admin/common/footer_view');

                 }
                 else{

                    redirect("login/admin_login","refresh");
                 }

                 }

                 public function view_product_inventory($idd){

                     if(!empty($this->session->userdata('admin_data'))){


                       $data['user_name']=$this->load->get_var('user_name');

                       // echo SITE_NAME;
                       // echo $this->session->userdata('image');
                       // echo $this->session->userdata('position');
                       // exit;

                        $id=base64_decode($idd);
                       $data['id']=$idd;

                              $this->db->select('*');
                              $this->db->from('tbl_inventory');
                              $this->db->where('pid',$id);
                              $data['inventory_data']= $this->db->get();


                       $this->load->view('admin/common/header_view',$data);
                       $this->load->view('admin/inventory/view_product_inventory');
                       $this->load->view('admin/common/footer_view');

                   }
                   else{

                      redirect("login/admin_login","refresh");
                   }

                   }



             public function add_inventory_data($t,$iw="")

               {

                 if(!empty($this->session->userdata('admin_data'))){


             $this->load->helper(array('form', 'url'));
             $this->load->library('form_validation');
             $this->load->helper('security');
             if($this->input->post())
             {
               // print_r($this->input->post());
               // exit;
  $this->form_validation->set_rules('pid', 'pid', 'required|xss_clean|trim');
  $this->form_validation->set_rules('tid', 'tid', 'required|xss_clean|trim');
  $this->form_validation->set_rules('quantity', 'quantity', 'required|xss_clean|trim');





               if($this->form_validation->run()== TRUE)
               {
  $pid=$this->input->post('pid');
  $tid=$this->input->post('tid');
  $quantity=$this->input->post('quantity');

                   $ip = $this->input->ip_address();
                   date_default_timezone_set("Asia/Calcutta");
                   $cur_date=date("Y-m-d H:i:s");
                   $addedby=$this->session->userdata('admin_id');

           $typ=base64_decode($t);
           $last_id = 0;
           if($typ==1){



           $data_insert = array(
                  'pid'=>$pid,
  'tid'=>$tid,
  'quantity'=>$quantity,

                     'ip' =>$ip,
                     'added_by' =>$addedby,
                     'is_active' =>1,
                     'date'=>$cur_date
                     );


           $last_id=$this->base_model->insert_table("tbl_inventory",$data_insert,1) ;

           }
           if($typ==2){

    $idw=base64_decode($iw);


 $this->db->select('*');
 $this->db->from('tbl_inventory');
 $this->db->where('id',$idw);
 $dsa=$this->db->get();
 $da=$dsa->row();





           $data_insert = array(
                  'pid'=>$pid,
  'tid'=>$tid,
  'quantity'=>$quantity,

                     );
             $this->db->where('id', $idw);
             $last_id=$this->db->update('tbl_inventory', $data_insert);
           }
                       if($last_id!=0){
                               $this->session->set_flashdata('smessage','Data inserted successfully');
                               redirect("dcadmin/inventory/view_inventory","refresh");
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

               public function updateinventoryStatus($idd,$t){

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
                       $zapak=$this->db->update('tbl_inventory', $data_update);

                            if($zapak!=0){
                            redirect("dcadmin/inventory/view_inventory","refresh");
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
                         $zapak=$this->db->update('tbl_inventory', $data_update);

                             if($zapak!=0){
                             redirect("dcadmin/inventory/view_inventory","refresh");
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



               public function delete_inventory($idd){

                      if(!empty($this->session->userdata('admin_data'))){

                        $data['user_name']=$this->load->get_var('user_name');

                        // echo SITE_NAME;
                        // echo $this->session->userdata('image');
                        // echo $this->session->userdata('position');
                        // exit;
                        $id=base64_decode($idd);

                       if($this->load->get_var('position')=="Super Admin"){

                     $this->db->select('image');
                     $this->db->from('tbl_inventory');
                     $this->db->where('id',$id);
                     $dsa= $this->db->get();
                     $da=$dsa->row();
                     $img=$da->image;

 $zapak=$this->db->delete('tbl_inventory', array('id' => $id));
 if($zapak!=0){
        $path = FCPATH .$img;
          unlink($path);
        redirect("dcadmin/inventory/view_inventory","refresh");
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

                  public function getType(){

                                                  if(!empty($this->session->userdata('admin_data'))){

                                                                   // $data['user_name']=$this->load->get_var('user_name');

                                                $isl=$_GET['isl'];

                                                $this->db->select('*');
                                                $this->db->from('tbl_types');
                                                $this->db->where('product',$isl);
                                                $data= $this->db->get();

                                                 $i=1; foreach($data->result() as $row) {

                                                $types[] = array('id' =>$row->id ,'name'=>$row->name );


                                                 $i++; }
                                                if (!empty($types)) {
                                                  // code...

                                                 echo json_encode($types);
                                                }
                                                else {
                                                  echo 'NA';
                                                }

                                                               }
                                                               else{

                                                                  redirect("login/admin_login","refresh");
                                                               }

                                                               }






                      }


      ?>
