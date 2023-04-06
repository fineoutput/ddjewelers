<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
   require_once(APPPATH . 'core/CI_finecontrol.php');
   class Modify_contact extends CI_finecontrol{
   function __construct()
       {
         parent::__construct();
         $this->load->model("login_model");
         $this->load->model("admin/base_model");
         $this->load->library('user_agent');
         $this->load->library('upload');
       }
       public function view_modify_contact(){

                        if(!empty($this->session->userdata('admin_data'))){


                          $data['user_name']=$this->load->get_var('user_name');

                          // echo SITE_NAME;
                          // echo $this->session->userdata('image');
                          // echo $this->session->userdata('position');
                          // exit;
                          $this->db->select('*');
                          $this->db->from('tbl_modify_contact');
                          // $this->db->where('id',$usr);
                          $this->db->order_by('date','desc');
                          $data['modify_data']= $this->db->get();


                          $this->load->view('admin/common/header_view',$data);
                          $this->load->view('admin/modify_contact/view_modify_contact');
                          $this->load->view('admin/common/footer_view');

                      }
                      else{

                         redirect("login/admin_login","refresh");
                      }

                      }
     }
