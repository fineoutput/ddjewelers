<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'core/CI_finecontrol.php');
class Lifetime_upgrades extends CI_finecontrol
{
  function __construct()
  {
    parent::__construct();
    $this->load->model("login_model");
    $this->load->model("admin/base_model");
    $this->load->library('user_agent');
    $this->load->library('upload');
  }
  public function view_lifetime_upgrades()
  {
    if (!empty($this->session->userdata('admin_data'))) {
      $data['user_name'] = $this->load->get_var('user_name');
      // echo SITE_NAME;
      // echo $this->session->userdata('image');
      // echo $this->session->userdata('position');
      // exit;
      $this->db->select('*');
      $this->db->from('tbl_lifetime_upgrades');
      //$this->db->where('id',$usr);
      $data['lifetime_upgrades_data'] = $this->db->get();
      $this->load->view('admin/common/header_view', $data);
      $this->load->view('admin/lifetime_upgrades/view_lifetime_upgrades');
      $this->load->view('admin/common/footer_view');
    } else {
      redirect("login/admin_login", "refresh");
    }
  }
  public function add_lifetime_upgrades()
  {
    if (!empty($this->session->userdata('admin_data'))) {
      $this->load->view('admin/common/header_view');
      $this->load->view('admin/lifetime_upgrades/add_lifetime_upgrades');
      $this->load->view('admin/common/footer_view');
    } else {
      redirect("login/admin_login", "refresh");
    }
  }
  public function update_lifetime_upgrades($idd)
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
      $this->db->from('tbl_lifetime_upgrades');
      $this->db->where('id', $id);
      $data['lifetime_upgrades_data'] = $this->db->get()->row();
      $this->load->view('admin/common/header_view', $data);
      $this->load->view('admin/lifetime_upgrades/update_lifetime_upgrades');
      $this->load->view('admin/common/footer_view');
    } else {
      redirect("login/admin_login", "refresh");
    }
  }
  public function add_lifetime_upgrades_data($t, $iw = "")
  {
    if (!empty($this->session->userdata('admin_data'))) {
      $this->load->helper(array('form', 'url'));
      $this->load->library('form_validation');
      $this->load->helper('security');
      if ($this->input->post()) {
        // print_r($this->input->post());
        // exit;
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('lifetime_upgrades', 'lifetime_upgrades', 'required');
        $this->form_validation->set_rules('page_title', 'page_title', 'required');
        $this->form_validation->set_rules('keyword', 'keyword', 'required');
        $this->form_validation->set_rules('dsc', 'dsc', 'required');
        if ($this->form_validation->run() == TRUE) {
          $title = $this->input->post('title');
          $lifetime_upgrades = $this->input->post('lifetime_upgrades');
          $page_title = $this->input->post('page_title');
          $keyword = $this->input->post('keyword');
          $dsc = $this->input->post('dsc');
          $ip = $this->input->ip_address();
          date_default_timezone_set("Asia/Calcutta");
          $cur_date = date("Y-m-d H:i:s");
          $addedby = $this->session->userdata('admin_id');
          $typ = base64_decode($t);
          $last_id = 0;
          if ($typ == 1) {
            $data_insert = array(
              'title' => $title,
              'lifetime_upgrades' => $lifetime_upgrades,
              'page_title'=>$page_title,
              'keyword'=>$keyword,
              'dsc'=>$dsc,
              'ip' => $ip,
              'added_by' => $addedby,
              'is_active' => 1,
              'date' => $cur_date
            );
            $last_id = $this->base_model->insert_table("tbl_lifetime_upgrades", $data_insert, 1);
          }
          if ($typ == 2) {
            $idw = base64_decode($iw);
            $this->db->select('*');
            $this->db->from('tbl_lifetime_upgrades');
            $this->db->where('id', $idw);
            $dsa = $this->db->get();
            $da = $dsa->row();
            $data_insert = array(
              'title' => $title,
              'lifetime_upgrades' => $lifetime_upgrades,
              'page_title'=>$page_title,
              'keyword'=>$keyword,
              'dsc'=>$dsc,
            );
            $this->db->where('id', $idw);
            $last_id = $this->db->update('tbl_lifetime_upgrades', $data_insert);
          }
          if ($last_id != 0) {
            $this->session->set_flashdata('smessage', 'Data inserted successfully');
            redirect("dcadmin/lifetime_upgrades/view_lifetime_upgrades", "refresh");
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
  public function updatelifetime_upgradesStatus($idd, $t)
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
        $zapak = $this->db->update('tbl_lifetime_upgrades', $data_update);
        if ($zapak != 0) {
          redirect("dcadmin/lifetime_upgrades/view_lifetime_upgrades", "refresh");
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
        $zapak = $this->db->update('tbl_lifetime_upgrades', $data_update);
        if ($zapak != 0) {
          redirect("dcadmin/lifetime_upgrades/view_lifetime_upgrades", "refresh");
        } else {
          $this->session->set_flashdata('emessage', 'Sorry error occured');
          redirect($_SERVER['HTTP_REFERER']);
        }
      }
    } else {
      redirect("login/admin_login", "refresh");
    }
  }
  public function delete_lifetime_upgrades($idd)
  {
    if (!empty($this->session->userdata('admin_data'))) {
      $data['user_name'] = $this->load->get_var('user_name');
      // echo SITE_NAME;
      // echo $this->session->userdata('image');
      // echo $this->session->userdata('position');
      // exit;
      $id = base64_decode($idd);
      if ($this->load->get_var('position') == "Super Admin") {
        $this->db->select('image');
        $this->db->from('tbl_lifetime_upgrades');
        $this->db->where('id', $id);
        $dsa = $this->db->get();
        $da = $dsa->row();
        $img = $da->image;
        $zapak = $this->db->delete('tbl_lifetime_upgrades', array('id' => $id));
        if ($zapak != 0) {
          $path = FCPATH . $img;
          unlink($path);
          redirect("dcadmin/lifetime_upgrades/view_lifetime_upgrades", "refresh");
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
