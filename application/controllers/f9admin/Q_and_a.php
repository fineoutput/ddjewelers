<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'core/CI_finecontrol.php');
class Q_and_a extends CI_finecontrol
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("login_model");
        $this->load->model("admin/base_model");
        $this->load->library('user_agent');
        $this->load->library('upload');
    }

    //****************************view q_and_a Function**************************************

    public function view_q_and_a($idd)
    {

        if (!empty($this->session->userdata('admin_data'))) {
            $id = base64_decode($idd);
            $data['id'] = $idd;

            $this->db->select('*');
            $this->db->from('tbl_faq_category');
            $this->db->where('id', $id);
            $data['cat_data'] = $this->db->get()->row();

            $data['user_name'] = $this->load->get_var('user_name');

            $this->db->select('*');
            $this->db->from('tbl_faq_qna');
            $this->db->where('cat_id', $id);
            $this->db->order_by('id', 'desc');
            $data['q_and_a_data'] = $this->db->get();

            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/q_and_a/view_q_and_a');
            $this->load->view('admin/common/footer_view');
        } else {

            redirect("login/admin_login", "refresh");
        }
    }
    //****************************Add q_and_a Function**************************************
    public function add_q_and_a($cat_id)
    {

        if (!empty($this->session->userdata('admin_data'))) {
            $id = base64_decode($cat_id);
            $data['id'] = $cat_id;


            $data['user_name'] = $this->load->get_var('user_name');




            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/q_and_a/add_q_and_a');
            $this->load->view('admin/common/footer_view');
        } else {

            redirect("login/admin_login", "refresh");
        }
    }
    //****************************Insert q_and_a Function**************************************
    public function add_q_and_a_data($t, $iw = "")

    {

        if (!empty($this->session->userdata('admin_data'))) {


            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->helper('security');
            if ($this->input->post()) {
                // print_r($this->input->post());
                // exit;


                $this->form_validation->set_rules('cat_id', 'cat_id', 'required|xss_clean|trim');
                $this->form_validation->set_rules('question', 'question', 'required|xss_clean|trim');
                $this->form_validation->set_rules('answer', 'answer', 'required|xss_clean|trim');
                $this->form_validation->set_rules('sequence', 'sequence', 'required|xss_clean|trim');





                if ($this->form_validation->run() == TRUE) {
                    $cat_id = base64_decode($this->input->post('cat_id'));
                    $question = $this->input->post('question');
                    $answer = $this->input->post('answer');
                    $sequence = $this->input->post('sequence');





                    $ip = $this->input->ip_address();
                    date_default_timezone_set("Asia/Calcutta");
                    $cur_date = date("Y-m-d H:i:s");

                    $addedby = $this->session->userdata('admin_id');


                    $typ = base64_decode($t);
                    if ($typ == 1) {

                        $data_insert = array(
                            'cat_id' => $cat_id,
                            'question' => $question,
                            'answer' => $answer,
                            'sequence' => $sequence,
                            'ip' => $ip,
                            'added_by' => $addedby,
                            'is_active' => 1,
                            'date' => $cur_date

                        );

                        $last_id = $this->base_model->insert_table("tbl_faq_qna", $data_insert, 1);
                    }
                    if ($typ == 2) {

                        $idw = base64_decode($iw);



                        $data_insert = array(
                            'question' => $question,
                            'answer' => $answer,
                            'sequence' => $sequence,
                            'cat_id' => $cat_id

                        );

                        $this->db->where('id', $idw);
                        $last_id = $this->db->update('tbl_faq_qna', $data_insert);
                    }


                    if ($last_id != 0) {

                        $this->session->set_flashdata('smessage', 'Data inserted successfully');

                        redirect("dcadmin/Q_and_a/view_q_and_a/" . base64_encode($cat_id), "refresh");
                    } else {

                        $this->session->set_flashdata('smessage', 'Sorry error occured');
                        redirect($_SERVER['HTTP_REFERER']);
                    }
                } else {

                    $this->session->set_flashdata('smessage', validation_errors());
                    redirect($_SERVER['HTTP_REFERER']);
                }
            } else {

                $this->session->set_flashdata('smessage', 'Please insert some data, No data available');
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {

            redirect("login/admin_login", "refresh");
        }
    }

    //****************************Update q_and_a Function**************************************
    public function update_q_and_a($idd)
    {

        if (!empty($this->session->userdata('admin_data'))) {


            $data['user_name'] = $this->load->get_var('user_name');


            $id = base64_decode($idd);
            $data['id'] = $idd;


            $this->db->select('*');
            $this->db->from('tbl_faq_qna');
            $this->db->where('id', $id);
            $dsa = $this->db->get();
            $data['q_and_a'] = $dsa->row();




            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/q_and_a/update_q_and_a');
            $this->load->view('admin/common/footer_view');
        } else {

            redirect("login/admin_login", "refresh");
        }
    }

    //****************************Delete q_and_a Function**************************************


    public function delete_q_and_a($idd)
    {

        if (!empty($this->session->userdata('admin_data'))) {


            $data['user_name'] = $this->load->get_var('user_name');


            $id = base64_decode($idd);
            $this->db->select('*');
            $this->db->from('tbl_faq_qna');
            $this->db->where('id', $id);
            $q_and_a_data = $this->db->get()->row();

            if ($this->load->get_var('position') == "Super Admin") {


                $zapak = $this->db->delete('tbl_faq_qna', array('id' => $id));
                if ($zapak != 0) {

                    redirect("dcadmin/Q_and_a/view_q_and_a/".base64_encode($q_and_a_data->cat_id), "refresh");

                } else {
                    echo "Error";
                    exit;
                }
            } else {
                $data['e'] = "Sorry You Don't Have Permission To Delete Anything.";
                // exit;
                $this->load->view('errors/error500admin', $data);
            }
        } else {

            $this->load->view('admin/login/index');
        }
    }
    //****************************Update q_and_a Function**************************************
    public function updateq_and_aStatus($idd, $t)
    {

        if (!empty($this->session->userdata('admin_data'))) {


            $data['user_name'] = $this->load->get_var('user_name');

            $id = base64_decode($idd);

            $this->db->select('*');
            $this->db->from('tbl_faq_qna');
            $this->db->where('id', $id);
            $q_and_a_data = $this->db->get()->row();

            if ($t == "active") {

                $data_update = array(
                    'is_active' => 1

                );

                $this->db->where('id', $id);
                $zapak = $this->db->update('tbl_faq_qna', $data_update);

                if ($zapak != 0) {
                    redirect("dcadmin/Q_and_a/view_q_and_a/".base64_encode($q_and_a_data->cat_id), "refresh");
                } else {
                    echo "Error";
                    exit;
                }
            }
            if ($t == "inactive") {
                $data_update = array(
                    'is_active' => 0

                );

                $this->db->where('id', $id);
                $zapak = $this->db->update('tbl_faq_qna', $data_update);

                if ($zapak != 0) {
                    redirect("dcadmin/Q_and_a/view_q_and_a/".base64_encode($q_and_a_data->cat_id), "refresh");
                } else {

                    $data['e'] = "Error Occured";
                    // exit;
                    $this->load->view('errors/error500admin', $data);
                }
            }
        } else {

            $this->load->view('admin/login/index');
        }
    }
}
