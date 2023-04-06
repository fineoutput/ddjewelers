<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
       require_once(APPPATH . 'core/CI_finecontrol.php');
       class Shippingrules extends CI_finecontrol{
       function __construct()
           {
             parent::__construct();
             $this->load->model("login_model");
             $this->load->model("admin/base_model");
             $this->load->library('user_agent');
             $this->load->library('upload');
           }

         public function view_shipping($idd){

            if(!empty($this->session->userdata('admin_data'))){


              $data['user_name']=$this->load->get_var('user_name');

              // echo SITE_NAME;
              // echo $this->session->userdata('image');
              // echo $this->session->userdata('position');
              // exit;
              $id=base64_decode($idd);
              $data['id']=$idd;
              $this->db->select('*');
              $this->db->from('tbl_shippingrules');
              $this->db->where('shipping_id',$id);
              $data['shipping_data']= $this->db->get();

            //   $this->db->select('*');
            //   $this->db->from('tbl_shipment');
            //   $this->db->where('id', $id);
            //   $shipment = $this->db->get()->row();
            //   $country = $this->db->get_where('tbl_country', array('id'=> $shipment->country_id))->result();
            //   $method = $this->db->get_where('tbl_method', array('id'=> $shipment->method_id))->result();
            //   $data['country'] = $country[0]->name;
            //   $data['heading'] = $method[0]->name;

              $this->load->view('admin/common/header_view',$data);
              $this->load->view('admin/shipping/view_shipping');
              $this->load->view('admin/common/footer_view');

          }
          else{

             redirect("login/admin_login","refresh");
          }

          }

              public function add_shipping($shipping_id){

                 if(!empty($this->session->userdata('admin_data'))){
                     $id=base64_decode($shipping_id);
            $data['id']=$shipping_id;
            $this->db->select('*');
            $this->db->from('tbl_shipment');
            $this->db->where('id', $id);
            $shipping_data = $this->db->get()->row();
                   $this->load->view('admin/common/header_view', $data);
                   $this->load->view('admin/shipping/add_shipping');
                   $this->load->view('admin/common/footer_view');

               }
               else{

                  redirect("login/admin_login","refresh");
               }

               }

               public function update_shipping($idd){

                   if(!empty($this->session->userdata('admin_data'))){


                     $data['user_name']=$this->load->get_var('user_name');

                     // echo SITE_NAME;
                     // echo $this->session->userdata('image');
                     // echo $this->session->userdata('position');
                     // exit;

                      $id=base64_decode($idd);
                     $data['id']=$idd;

                            $this->db->select('*');
                            $this->db->from('tbl_shippingrules');
                            $this->db->where('id',$id);
                            $data['rules_data']= $this->db->get()->row();


                     $this->load->view('admin/common/header_view',$data);
                     $this->load->view('admin/shipping/update_shipping');
                     $this->load->view('admin/common/footer_view');

                 }
                 else{

                    redirect("login/admin_login","refresh");
                 }

                 }

             public function add_shippingrules_data($t,$iw="")

               {

                 if(!empty($this->session->userdata('admin_data'))){


             $this->load->helper(array('form', 'url'));
             $this->load->library('form_validation');
             $this->load->helper('security');
             if($this->input->post())
             {
               // print_r($this->input->post());
               // exit;
               $this->form_validation->set_rules('shipping_id', 'shipping_id', 'required');
  $this->form_validation->set_rules('start_price', 'start_price', 'required');
  $this->form_validation->set_rules('End_price', 'End_price', 'required');
  $this->form_validation->set_rules('shipment_cost', 'shipment_cost', 'required');


               if($this->form_validation->run()== TRUE)
               {
                $shipping_id=$this->input->post('shipping_id');

  $start_price=$this->input->post('start_price');
  $End_price=$this->input->post('End_price');
  $shipment_cost=$this->input->post('shipment_cost');

                   $ip = $this->input->ip_address();
                   date_default_timezone_set("Asia/Calcutta");
                   $cur_date=date("Y-m-d H:i:s");
                   $addedby=$this->session->userdata('admin_id');

           $typ=base64_decode($t);
           $last_id = 0;
           if ($typ==1) {
            $data_insert = array('shipping_id'=>base64_decode($shipping_id),
            'start_price'=>$start_price,
  'End_price'=>$End_price,
  'shipment_cost'=>$shipment_cost,

                     'ip' =>$ip,
                     'added_by' =>$addedby,
                     'is_active' =>1,
                     'date'=>$cur_date
                    );
            $last_id=$this->base_model->insert_table("tbl_shippingrules", $data_insert, 1) ;
            if ($last_id!=0) {
                $this->session->set_flashdata('smessage', 'Data inserted successfully');
                redirect("dcadmin/Shippingrules/view_shipping/".$shipping_id, "refresh");
            } else {
                $this->session->set_flashdata('emessage', 'Sorry error occurred');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
           if($typ==2){

    $idw=base64_decode($iw);


 $this->db->select('*');
 $this->db->from('tbl_shippingrules');
 $this->db->where('id',$idw);
 $dsa=$this->db->get();
 $da=$dsa->row();


           $data_insert = array(
           
  'start_price'=>$start_price,
  'End_price'=>$End_price,
  'shipment_cost'=>$shipment_cost,

                     );
             $this->db->where('id', $idw);
             $last_id=$this->db->update('tbl_shippingrules', $data_insert);
           }
                       if($last_id!=0){
                               $this->session->set_flashdata('smessage','Data inserted successfully');
                               redirect("dcadmin/Shippingrules/view_shipping/".$shipping_id,"refresh");
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

               public function updateshippingrulesStatus($idd,$t){

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
                       $zapak=$this->db->update('tbl_shippingrules', $data_update);

                            if($zapak!=0){
                                redirect($_SERVER['HTTP_REFERER']);
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
                         $zapak=$this->db->update('tbl_shippingrules', $data_update);

                             if($zapak!=0){
                                redirect($_SERVER['HTTP_REFERER']);
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
       public function delete_shippingrules($idd){

                      if(!empty($this->session->userdata('admin_data'))){

                        $data['user_name']=$this->load->get_var('user_name');

                        // echo SITE_NAME;
                        // echo $this->session->userdata('image');
                        // echo $this->session->userdata('position');
                        // exit;
                        $id=base64_decode($idd);

                       if($this->load->get_var('position')=="Super Admin"){

                     $this->db->select('*');
                     $this->db->from('tbl_shippingrules');
                     $this->db->where('id',$id);
                     $dsa= $this->db->get();
                     $da=$dsa->row();
                    //  $img=$da->image;

 $zapak=$this->db->delete('tbl_shippingrules', array('id' => $id));
 if($zapak!=0){
        // $path = FCPATH .$img;
        //   unlink($path);
        redirect($_SERVER['HTTP_REFERER']);
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
                      }

      ?>
