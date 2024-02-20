<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'core/CI_finecontrol.php');
class Minimum_product_amount extends CI_finecontrol
{
	function __construct()
	{
		parent::__construct();
		$this->load->model("login_model");
		$this->load->model("admin/base_model");
		$this->load->library('user_agent');
	}

	public function view_minimum_amount()
	{

		if (!empty($this->session->userdata('admin_data'))) {


			$data['user_name'] = $this->load->get_var('user_name');

			// echo SITE_NAME;
			// echo $this->session->userdata('image');
			// echo $this->session->userdata('position');
			// exit;
			$this->db->select('*');
			$this->db->from('tbl_minimum_cost');
			$data['cost_data'] = $this->db->get();


			$this->load->view('admin/common/header_view', $data);
			$this->load->view('admin/minimum_product_amount/view_minimum_amount');
			$this->load->view('admin/common/footer_view');
		} else {

			redirect("login/admin_login", "refresh");
		}
	}

	public function update_minimum_amount($idd)
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
			$this->db->from('tbl_minimum_cost');
			$this->db->where('id', $id);
			$data['cost_data'] = $this->db->get()->row();


			$this->load->view('admin/common/header_view', $data);
			$this->load->view('admin/minimum_product_amount/update_minimum_amount');
			$this->load->view('admin/common/footer_view');
		} else {

			redirect("login/admin_login", "refresh");
		}
	}

	public function update_amount($t, $iw = "")

	{

		if (!empty($this->session->userdata('admin_data'))) {


			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->load->helper('security');
			if ($this->input->post()) {
				// print_r($this->input->post());
				// exit;
				$this->form_validation->set_rules('cost', 'cost', 'required|xss_clean');
				if ($this->form_validation->run() == TRUE) {
					$cost = $this->input->post('cost');
					$ip = $this->input->ip_address();
					date_default_timezone_set("Asia/Calcutta");
					$cur_date = date("Y-m-d H:i:s");

					$typ = base64_decode($t);
					if ($typ == 1) {

						$data_insert = array(
							'cost' => $cost,
							'updated_on' => $cur_date
						);
						$last_id = $this->base_model->insert_table("tbl_minimum_cost", $data_insert, 1);

						if ($last_id != 0) {

							$this->session->set_flashdata('smessage', 'Data inserted successfully');

							redirect("dcadmin/Minimum_product_amount/view_minimum_amount", "refresh");
						} else {

							$this->session->set_flashdata('emessage', 'Sorry error occured');
							redirect($_SERVER['HTTP_REFERER']);
						}
					}
					if ($typ == 2) {

						$idw = base64_decode($iw);
						$data_insert = array(
							'cost' => $cost,
							'updated_on' => $cur_date
						);
						$this->db->where('id', $idw);
						$last_id = $this->db->update('tbl_minimum_cost', $data_insert);
						if ($last_id != 0) {
							$this->session->set_flashdata('smessage', 'Data updated successfully');
							redirect("dcadmin/Minimum_product_amount/view_minimum_amount", "refresh");
						} else {

							$this->session->set_flashdata('emessage', 'Sorry error occured');
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
}
