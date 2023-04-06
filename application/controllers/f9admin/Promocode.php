<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require_once(APPPATH . 'core/CI_finecontrol.php');
class Promocode extends CI_finecontrol
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("login_model");
        $this->load->model("admin/base_model");
        $this->load->library('user_agent');
    }
    //============================view_promocode=======================\\
    public function view_promocode()
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');
            $this->db->select('*');
            $this->db->from('tbl_promocode');
            $this->db->order_by('id','desc');
            $data['promocode_data']= $this->db->get();



            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/promocode/view_promocode');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    //================================add_promocode========================\\
    public function add_promocode()
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');

$this->db->select('*');
$this->db->from('tbl_category');
$this->db->where('is_active',1);
$data['cat_data']= $this->db->get();


            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/promocode/add_promocode');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    //=============================add_promocode_data==================\\
    public function add_promocode_data($t, $iw="")
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->helper('security');
            if ($this->input->post()) {
                // print_r($this->input->post());
                // exit;
                $this->form_validation->set_rules('name', 'namename', 'required|xss_clean|trim');
                $this->form_validation->set_rules('description', 'description', 'required|xss_clean|trim');


                $this->form_validation->set_rules('allowed_uses', 'allowed_uses', 'required|xss_clean|trim');
                $this->form_validation->set_rules('ids[]', 'ids', 'xss_clean|trim');

                $this->form_validation->set_rules('ptype', 'ptype', 'required|xss_clean|trim');
                $this->form_validation->set_rules('vaild_form', 'vaild_form', 'required|xss_clean|trim');
                $this->form_validation->set_rules('vaild_until', 'vaild_until', 'required|xss_clean|trim');
                $this->form_validation->set_rules('minpurchase', 'minpurchase', 'required|xss_clean|trim');
                $this->form_validation->set_rules('is_active', 'is_active', 'xss_clean|trim');
                $this->form_validation->set_rules('type', 'type', 'required|xss_clean|trim');
                            $type=$this->input->post('type');
                            if ($type==2) {
                                $this->form_validation->set_rules('percentage_amount', 'percentage_amount', 'xss_clean|trim');

                            }


                if ($this->form_validation->run()== true) {
                    $name=$this->input->post('name');
                    $description=$this->input->post('description');

                    // $name=$this->input->post('name');
                    $allowed_uses=$this->input->post('allowed_uses');
                    $ptype=$this->input->post('ptype');
                    $ids=json_encode($this->input->post('ids[]'));
                    // echo $ptype;die();
                    $vaild_form=$this->input->post('vaild_form');
                    $vaild_until=$this->input->post('vaild_until');
                    // $giftpercent=$this->input->post('giftpercent');
                    $minpurchase=$this->input->post('minpurchase');
                    $is_active=$this->input->post('is_active');
                    // print_r($is_active);die();
                    if(empty($is_active)){
                      $is_active=0;
                    }
  $percentage_amount=$this->input->post('percentage_amount');
                    $ip = $this->input->ip_address();
                    date_default_timezone_set("Asia/Calcutta");
                    $cur_date=date("Y-m-d H:i:s");

                    $addedby=$this->session->userdata('admin_id');

                    $typ=base64_decode($t);
                    if ($typ==1) {
                        $data_insert = array('name'=>$name,
                        'description'=>$description,
                        'allowed_uses'=>$allowed_uses,
                        'ptype'=>$ptype,
                        'ids'=>$ids,
                        'type'=>$type,
                        'percentage_amount'=>$percentage_amount,
                              // 'giftpercent'=>$giftpercent,
                              'vaild_form'=>$vaild_form,
                              'vaild_until'=>$vaild_until,
                              'minpurchase'=>$minpurchase,
                              // 'max'=>$max,
                              'ip' =>$ip,
                              'added_by' =>$addedby,
                              'is_active' =>$is_active,
                              'date'=>$cur_date

                              );

// die();



                        $last_id=$this->base_model->insert_table("tbl_promocode", $data_insert, 1) ;
                        if ($last_id!=0) {
                            $this->session->set_flashdata('smessage', 'Data inserted successfully');

                            redirect("dcadmin/Promocode/view_promocode", "refresh");
                        } else {
                            $this->session->set_flashdata('emessage', 'Sorry error occurred');
                            redirect($_SERVER['HTTP_REFERER']);
                        }
                    }
                    if ($typ==2) {
                        $idw=base64_decode($iw);


                        $data_insert = array('name'=>$name,
                        'description'=>$description,
                        'allowed_uses'=>$allowed_uses,
                        'ptype'=>$ptype,
                        'ids'=>$ids,
                        'type'=>$type,
                        'percentage_amount'=>$percentage_amount,
                              // 'giftpercent'=>$giftpercent,
                              'vaild_form'=>$vaild_form,
                              'vaild_until'=>$vaild_until,
                              'minpurchase'=>$minpurchase,
                              // 'max'=>$max,
                              );

                        $this->db->where('id', $idw);
                        $last_id=$this->db->update('tbl_promocode', $data_insert);
                        if ($last_id!=0) {
                            $this->session->set_flashdata('smessage', 'Data updated successfully');

                            redirect("dcadmin/Promocode/view_promocode", "refresh");
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
    public function update_promocode($idd)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');
            $id=base64_decode($idd);
            $data['id']=$idd;
            $this->db->select('*');
            $this->db->from('tbl_promocode');
            $this->db->where('id', $id);
            $dsa= $this->db->get();
            $data['promocode']=$dsa->row();

            $this->db->select('*');
            $this->db->from('tbl_category');
            $this->db->where('is_active',1);
            $data['cat_data']= $this->db->get();

            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/promocode/update_promocode');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    //==============================delete_promocode=====================\\
    public function delete_promocode($idd)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');


            $id=base64_decode($idd);

            if ($this->load->get_var('position')=="Super Admin") {
                $zapak=$this->db->delete('tbl_promocode', array('id' => $id));
                if ($zapak!=0) {
                      $this->session->set_flashdata('smessage', 'Data deleted successfully');
                    redirect("dcadmin/Promocode/view_promocode", "refresh");
                } else {
                    echo "Error";
                    exit;
                }
            } else {
              $this->session->set_flashdata('emessage', "Sorry You Don't Have Permission To Delete Anything");
              redirect("dcadmin/Promocode/view_promocode", "refresh");
            }
        } else {
            $this->load->view('admin/login/index');
        }
    }

    //==================update_promocode status=====================\\
    public function updatepromocodeStatus($idd, $t)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');


            $id=base64_decode($idd);

            if ($t=="active") {
                $data_update = array(
                               'is_active'=>1

                               );

                $this->db->where('id', $id);
                $zapak=$this->db->update('tbl_promocode', $data_update);
                $this->session->set_flashdata('smessage', 'Data updated successfully');

                if ($zapak!=0) {
                    redirect("dcadmin/Promocode/view_promocode", "refresh");
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
                $zapak=$this->db->update('tbl_promocode', $data_update);
                $this->session->set_flashdata('smessage', 'Data updated successfully');

                if ($zapak!=0) {
                    redirect("dcadmin/Promocode/view_promocode", "refresh");
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
