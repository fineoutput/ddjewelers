<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'core/CI_finecontrol.php');
class Shipment extends CI_finecontrol
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("login_model");
        $this->load->model("admin/base_model");
        $this->load->library('user_agent');
        $this->load->library('upload');
    }

    public function view_shipment()
    {

        if (!empty($this->session->userdata('admin_data'))) {


            $data['user_name'] = $this->load->get_var('user_name');

            // echo SITE_NAME;
            // echo $this->session->userdata('image');
            // echo $this->session->userdata('position');
            // exit;

            $this->db->select('*');
            $this->db->from('tbl_shipment');
            //$this->db->where('id',$usr);
            $data['shipment_data'] = $this->db->get();

            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/shipment/view_shipment');
            $this->load->view('admin/common/footer_view');
        } else {

            redirect("login/admin_login", "refresh");
        }
    }

    public function add_shipment()
    {

        if (!empty($this->session->userdata('admin_data'))) {
            $this->db->select('*');
            $this->db->from('tbl_country');
            $this->db->where('is_active', 1);
            $data['country_data'] = $this->db->get();
            $this->db->select('*');
            $this->db->from('tbl_method');
            $this->db->where('is_active', 1);
            $data['method_data'] = $this->db->get();
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/shipment/add_shipment');
            $this->load->view('admin/common/footer_view');
        } else {

            redirect("login/admin_login", "refresh");
        }
    }

    public function update_shipment($idd)
    {

        if (!empty($this->session->userdata('admin_data'))) {


            $data['user_name'] = $this->load->get_var('user_name');

            // echo SITE_NAME;
            // echo $this->session->userdata('image');
            // echo $this->session->userdata('position');
            // exit;

            $id = base64_decode($idd);
            $data['id'] = $idd;
            $this->db->select('*');
            $this->db->from('tbl_country');
            $this->db->where('is_active', 1);
            $data['country_data'] = $this->db->get();
            $this->db->select('*');
            $this->db->from('tbl_method');
            $this->db->where('is_active', 1);
            $data['method_data'] = $this->db->get();

            $this->db->select('*');
            $this->db->from('tbl_shipment');
            $this->db->where('id', $id);
            $data['shipment_data'] = $this->db->get()->row();


            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/shipment/update_shipment');
            $this->load->view('admin/common/footer_view');
        } else {

            redirect("login/admin_login", "refresh");
        }
    }

    public function add_shipment_data($t, $iw = "")

    {

        if (!empty($this->session->userdata('admin_data'))) {


            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->helper('security');
            if ($this->input->post()) {
                // print_r($this->input->post());
                // exit;
                $this->form_validation->set_rules('country_id[]', 'country_id', 'required');
                $this->form_validation->set_rules('method_id[]', 'method_id', 'required');






                if ($this->form_validation->run() == TRUE) {
                    $country_id = json_encode($this->input->post('country_id'));
                    $method_id = json_encode($this->input->post('method_id'));

                    $ip = $this->input->ip_address();
                    date_default_timezone_set("Asia/Calcutta");
                    $cur_date = date("Y-m-d H:i:s");
                    $addedby = $this->session->userdata('admin_id');

                    $typ = base64_decode($t);
                    $last_id = 0;
                    if ($typ == 1) {



                        $data_insert = array(
                            'country_id' => $country_id,
                            'method_id' => $method_id,
                            'ip' => $ip,
                            'added_by' => $addedby,
                            'is_active' => 1,
                            'date' => $cur_date
                        );


                        $last_id = $this->base_model->insert_table("tbl_shipment", $data_insert, 1);
                    }
                    if ($typ == 2) {

                        $idw = base64_decode($iw);


                        $this->db->select('*');
                        $this->db->from('tbl_shipment');
                        $this->db->where('id', $idw);
                        $dsa = $this->db->get();
                        $da = $dsa->row();


                        $data_insert = array(
                            'country_id' => $country_id,
                            'method_id' => $method_id,


                        );
                        $this->db->where('id', $idw);
                        $last_id = $this->db->update('tbl_shipment', $data_insert);
                    }
                    if ($last_id != 0) {
                        $this->session->set_flashdata('smessage', 'Data inserted successfully');
                        redirect("dcadmin/shipment/view_shipment", "refresh");
                    } else {

                        $this->session->set_flashdata('emessage', 'Sorry error occured');
                        redirect($_SERVER['HTTP_REFERER']);
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

    public function updateshipmentStatus($idd, $t)
    {

        if (!empty($this->session->userdata('admin_data'))) {


            $data['user_name'] = $this->load->get_var('user_name');

            // echo SITE_NAME;
            // echo $this->session->userdata('image');
            // echo $this->session->userdata('position');
            // exit;
            $id = base64_decode($idd);

            if ($t == "active") {

                $data_update = array(
                    'is_active' => 1

                );

                $this->db->where('id', $id);
                $zapak = $this->db->update('tbl_shipment', $data_update);

                if ($zapak != 0) {
                    redirect("dcadmin/shipment/view_shipment", "refresh");
                } else {
                    $this->session->set_flashdata('emessage', 'Sorry error occured');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            }
            if ($t == "inactive") {
                $data_update = array(
                    'is_active' => 0

                );

                $this->db->where('id', $id);
                $zapak = $this->db->update('tbl_shipment', $data_update);

                if ($zapak != 0) {
                    redirect("dcadmin/shipment/view_shipment", "refresh");
                } else {

                    $this->session->set_flashdata('emessage', 'Sorry error occured');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            }
        } else {

            redirect("login/admin_login", "refresh");
        }
    }
    public function delete_shipment($idd)
    {

        if (!empty($this->session->userdata('admin_data'))) {

            $data['user_name'] = $this->load->get_var('user_name');

            // echo SITE_NAME;
            // echo $this->session->userdata('image');
            // echo $this->session->userdata('position');
            // exit;
            $id = base64_decode($idd);

            if ($this->load->get_var('position') == "Super Admin") {

                $this->db->select('*');
                $this->db->from('tbl_shipment');
                $this->db->where('id', $id);
                $dsa = $this->db->get();
                $da = $dsa->row();
                //  $img=$da->image;

                $zapak = $this->db->delete('tbl_shipment', array('id' => $id));
                if ($zapak != 0) {
                    // $path = FCPATH .$img;
                    //   unlink($path);
                    redirect("dcadmin/shipment/view_shipment", "refresh");
                } else {
                    $this->session->set_flashdata('emessage', 'Sorry error occured');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            } else {
                $this->session->set_flashdata('emessage', 'Sorry you not a super admin you dont have permission to delete anything');
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {

            redirect("login/admin_login", "refresh");
        }
    }
}
