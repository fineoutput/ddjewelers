<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require_once(APPPATH . 'core/CI_finecontrol.php');
class Country extends CI_finecontrol
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("login_model");
        $this->load->model("admin/base_model");
        $this->load->library('user_agent');
    }
    //============================view_promocode=======================\\
    public function view_country()
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');
            $this->db->select('*');
            $this->db->from('tbl_country');
            $this->db->order_by('id','desc');
            $data['country_data']= $this->db->get();



            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/country/view_country');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    //================================add_promocode========================\\
    public function add_country()
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');




            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/country/add_country');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    //=============================add_promocode_data==================\\
    public function add_country_data($t, $iw="")
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->helper('security');
            if ($this->input->post()) {
                // print_r($this->input->post());
                // exit;
                $this->form_validation->set_rules('name', 'name', 'required|xss_clean|trim');
             
                               if ($this->form_validation->run()== true) {
                    $name=$this->input->post('name');
                                      $ip = $this->input->ip_address();
                    date_default_timezone_set("Asia/Calcutta");
                    $cur_date=date("Y-m-d H:i:s");

                    $addedby=$this->session->userdata('admin_id');

                    $typ=base64_decode($t);
                    if ($typ==1) {
                        $data_insert = array('name'=>$name,
                     
                              'ip' =>$ip,
                              'added_by' =>$addedby,
                              'is_active' =>1,
                              'date'=>$cur_date

                              );

// die();



                        $last_id=$this->base_model->insert_table("tbl_country", $data_insert, 1) ;
                        if ($last_id!=0) {
                            $this->session->set_flashdata('smessage', 'Data inserted successfully');

                            redirect("dcadmin/Country/view_country", "refresh");
                        } else {
                            $this->session->set_flashdata('emessage', 'Sorry error occurred');
                            redirect($_SERVER['HTTP_REFERER']);
                        }
                    }
                    if ($typ==2) {
                        $idw=base64_decode($iw);


                        $data_insert = array('name'=>$name
                      
                              );

                        $this->db->where('id', $idw);
                        $last_id=$this->db->update('tbl_country', $data_insert);
                        if ($last_id!=0) {
                            $this->session->set_flashdata('smessage', 'Data updated successfully');

                            redirect("dcadmin/Country/view_country", "refresh");
                        } else {
                            $this->session->set_flashdata('emessage', 'Sorry error occurred');
                            redirect($_SERVER['HTTP_REFERER']);
                        }
                    }

                } else {
                    $this->session->set_flashdata('emessage', validation_errors());
                    redirect($_SERVER['HTTP_REFERER']);
                }
            } else {
                $this->session->set_flashdata('emessage', 'Please insert some data, No data available');
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
		//============================update_promocode==========================\\
    public function update_country($idd)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');
            $id=base64_decode($idd);
            $data['id']=$idd;
            $this->db->select('*');
            $this->db->from('tbl_country');
            $this->db->where('id', $id);
            $dsa= $this->db->get();
            $data['country']=$dsa->row();


            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/country/update_country');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    //==============================delete_promocode=====================\\
    public function delete_country($idd)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');


            $id=base64_decode($idd);

            if ($this->load->get_var('position')=="Super Admin") {
                $zapak=$this->db->delete('tbl_country', array('id' => $id));
                if ($zapak!=0) {
                      $this->session->set_flashdata('smessage', 'Data deleted successfully');
                    redirect("dcadmin/Country/view_country", "refresh");
                } else {
                    echo "Error";
                    exit;
                }
            } else {
              $this->session->set_flashdata('emessage', "Sorry You Don't Have Permission To Delete Anything");
              redirect("dcadmin/Country/view_country", "refresh");
            }
        } else {
            $this->load->view('admin/login/index');
        }
    }

    //==================update_promocode status=====================\\
    public function updatecountryStatus($idd, $t)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');


            $id=base64_decode($idd);

            if ($t=="active") {
                $data_update = array(
                               'is_active'=>1

                               );

                $this->db->where('id', $id);
                $zapak=$this->db->update('tbl_country', $data_update);
                $this->session->set_flashdata('smessage', 'Data updated successfully');

                if ($zapak!=0) {
                    redirect("dcadmin/Country/view_country", "refresh");
                } else {
                    echo "Error";
                    exit;
                }
            }
            if ($t=="inactive") {
                $data_update = array(
                               'is_active'=>0

                               );

                $this->db->where('id', $id);
                $zapak=$this->db->update('tbl_country', $data_update);
                $this->session->set_flashdata('smessage', 'Data updated successfully');

                if ($zapak!=0) {
                    redirect("dcadmin/Country/view_country", "refresh");
                } else {
                    $data['e']="Error occurred";
                    // exit;
                    $this->load->view('errors/error500admin', $data);
                }
            }
        } else {
            $this->load->view('admin/login/index');
        }
    }
}
