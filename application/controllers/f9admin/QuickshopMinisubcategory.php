<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'core/CI_finecontrol.php');
class QuickshopMinisubcategory extends CI_finecontrol
{
  function __construct()
  {
    parent::__construct();
    $this->load->model("login_model");
    $this->load->model("admin/base_model");
    $this->load->library('user_agent');
    $this->load->library('upload');
  }

  public function view_minor_subcategory()
  {

    if (!empty($this->session->userdata('admin_data'))) {


      $data['user_name'] = $this->load->get_var('user_name');

      // echo SITE_NAME;
      // echo $this->session->userdata('image');
      // echo $this->session->userdata('position');
      // exit;

      $this->db->select('*');
      $this->db->from('tbl_quickshop_minisubcategory');
      //$this->db->where('id',$usr);
      $data['minorsubcategory_data'] = $this->db->get();

      $this->load->view('admin/common/header_view', $data);
      $this->load->view('admin/quickshop_minisubcategory/view_minor_subcategory');
      $this->load->view('admin/common/footer_view');
    } else {

      redirect("login/admin_login", "refresh");
    }
  }

  public function add_minor_subcategory()
  {

    if (!empty($this->session->userdata('admin_data'))) {

      $this->db->select('*');
      $this->db->from('tbl_quickshop_category');
      $this->db->where('is_active', 1);
      $data['category'] = $this->db->get();


      $this->db->select('*');
      $this->db->from('tbl_quickshop_subcategory');
      $this->db->where('is_active', 1);
      $data['subcategory'] = $this->db->get();


      $this->load->view('admin/common/header_view', $data);
      $this->load->view('admin/quickshop_minisubcategory/add_minor_subcategory');
      $this->load->view('admin/common/footer_view');
    } else {

      redirect("login/admin_login", "refresh");
    }
  }

  public function update_minor_subcategory($idd)
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
      $this->db->from('tbl_quickshop_minisubcategory');
      $this->db->where('id', $id);
      $data['minorsubcategory_data'] = $this->db->get()->row();

      $this->db->select('*');
      $this->db->from('tbl_quickshop_category');
      $this->db->where('is_active', 1);
      $data['category'] = $this->db->get();

      $this->db->select('*');
      $this->db->from('tbl_quickshop_subcategory');
      $this->db->where('is_active', 1);
      $data['subcategory'] = $this->db->get();




      $this->load->view('admin/common/header_view', $data);
      $this->load->view('admin/quickshop_minisubcategory/update_minor_subcategory');
      $this->load->view('admin/common/footer_view');
    } else {

      redirect("login/admin_login", "refresh");
    }
  }

  public function add_minor_subcategory_data($t, $iw = "")

  {

    if (!empty($this->session->userdata('admin_data'))) {


      $this->load->helper(array('form', 'url'));
      $this->load->library('form_validation');
      $this->load->helper('security');
      if ($this->input->post()) {
        // print_r($this->input->post());
        // exit;
        $this->form_validation->set_rules('category', 'category', 'required|xss_clean|trim');
        $this->form_validation->set_rules('subcategory', 'subcategory', 'required|xss_clean|trim');
        $this->form_validation->set_rules('name', 'name', 'required|xss_clean|trim');
        $this->form_validation->set_rules('description', 'description', 'xss_clean|trim');
        $this->form_validation->set_rules('seq', 'sequence number', 'xss_clean|trim');
        $this->form_validation->set_rules('search_key', 'search_key', 'xss_clean|trim');





        if ($this->form_validation->run() == TRUE) {
          $category = $this->input->post('category');
          $subcategory = $this->input->post('subcategory');
          $name = $this->input->post('name');
          $description = $this->input->post('description');
          $seq = $this->input->post('seq');
          $search_key = $this->input->post('search_key');

          $ip = $this->input->ip_address();
          date_default_timezone_set("Asia/Calcutta");
          $cur_date = date("Y-m-d H:i:s");
          $addedby = $this->session->userdata('admin_id');

          $typ = base64_decode($t);
          $last_id = 0;
          if ($typ == 1) {



            $img2 = 'image';


            $file_check = ($_FILES['image']['error']);
            if ($file_check != 4) {

              $image_upload_folder = FCPATH . "assets/uploads/quick_minor_subcategory/";
              if (!file_exists($image_upload_folder)) {
                mkdir($image_upload_folder, DIR_WRITE_MODE, true);
              }
              $new_file_name = "quick_minor_subcategory" . date("Ymdhms");
              $this->upload_config = array(
                'upload_path'   => $image_upload_folder,
                'file_name' => $new_file_name,
                'allowed_types' => 'xlsx|csv|xls|pdf|doc|docx|txt|jpg|jpeg|png',
                'max_size'      => 25000
              );
              $this->upload->initialize($this->upload_config);
              if (!$this->upload->do_upload($img2)) {
                $upload_error = $this->upload->display_errors();
                // echo json_encode($upload_error);

                //$this->session->set_flashdata('emessage',$upload_error);
                //redirect($_SERVER['HTTP_REFERER']);
              } else {

                $file_info = $this->upload->data();

                $videoNAmePath = "assets/uploads/quick_minor_subcategory/" . $new_file_name . $file_info['file_ext'];
                $file_info['new_name'] = $videoNAmePath;
                // $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
                $nnnn = $file_info['file_name'];
                $nnnn2 = $videoNAmePath;

                // echo json_encode($file_info);
              }
            } else {
              $nnnn2 = "";
            }



            $data_insert = array(
              'category' => $category,
              'subcategory' => $subcategory,
              'name' => $name,
              'image' => $nnnn2,
              'description' => $description,
              'seq' => $seq,
              'search_key' => $search_key,

              'ip' => $ip,
              'added_by' => $addedby,
              'is_active' => 1,
              'date' => $cur_date
            );


            $last_id = $this->base_model->insert_table("tbl_quickshop_minisubcategory", $data_insert, 1);
          }
          if ($typ == 2) {

            $idw = base64_decode($iw);


            $this->db->select('*');
            $this->db->from('tbl_quickshop_minisubcategory');
            $this->db->where('id', $idw);
            $dsa = $this->db->get();
            $da = $dsa->row();



            $img2 = 'image';


            $file_check = ($_FILES['image']['error']);
            if ($file_check != 4) {

              $image_upload_folder = FCPATH . "assets/uploads/quick_minor_subcategory/";
              if (!file_exists($image_upload_folder)) {
                mkdir($image_upload_folder, DIR_WRITE_MODE, true);
              }
              $new_file_name = "quick_minor_subcategory" . date("Ymdhms");
              $this->upload_config = array(
                'upload_path'   => $image_upload_folder,
                'file_name' => $new_file_name,
                'allowed_types' => 'xlsx|csv|xls|pdf|doc|docx|txt|jpg|jpeg|png',
                'max_size'      => 25000
              );
              $this->upload->initialize($this->upload_config);
              if (!$this->upload->do_upload($img2)) {
                $upload_error = $this->upload->display_errors();
                // echo json_encode($upload_error);

                //$this->session->set_flashdata('emessage',$upload_error);
                //redirect($_SERVER['HTTP_REFERER']);
              } else {

                $file_info = $this->upload->data();

                $videoNAmePath = "assets/uploads/quick_minor_subcategory/" . $new_file_name . $file_info['file_ext'];
                $file_info['new_name'] = $videoNAmePath;
                // $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
                $nnnn = $file_info['file_name'];
                $nnnn2 = $videoNAmePath;

                // echo json_encode($file_info);
              }
            }



            if (!empty($da)) {
              $img = $da->image;
              if (!empty($img)) {
                if (empty($nnnn2)) {
                  $nnnn2 = $img;
                }
              } else {
                if (empty($nnnn2)) {
                  $nnnn2 = "";
                }
              }
            }

            $data_insert = array(
              'category' => $category,
              'subcategory' => $subcategory,
              'name' => $name,
              'image' => $nnnn2,
              'description' => $description,
              'seq' => $seq,
              'search_key' => $search_key,

            );
            $this->db->where('id', $idw);
            $last_id = $this->db->update('tbl_quickshop_minisubcategory', $data_insert);
          }
          if ($last_id != 0) {
            $this->session->set_flashdata('smessage', 'Data inserted successfully');
            redirect("dcadmin/QuickshopMinisubcategory/view_minor_subcategory", "refresh");
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

  public function update_minor_subcategory_Status($idd, $t)
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
        $zapak = $this->db->update('tbl_quickshop_minisubcategory', $data_update);

        if ($zapak != 0) {
          redirect("dcadmin/QuickshopMinisubcategory/view_minor_subcategory", "refresh");
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
        $zapak = $this->db->update('tbl_quickshop_minisubcategory', $data_update);

        if ($zapak != 0) {
          redirect("dcadmin/QuickshopMinisubcategory/view_minor_subcategory", "refresh");
        } else {

          $this->session->set_flashdata('emessage', 'Sorry error occured');
          redirect($_SERVER['HTTP_REFERER']);
        }
      }
    } else {

      redirect("login/admin_login", "refresh");
    }
  }



  public function delete_minor_subcategory($idd)
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
        $this->db->from('tbl_quickshop_minisubcategory');
        $this->db->where('id', $id);
        $dsa = $this->db->get();
        $da = $dsa->row();
        $img = $da->image;

        $zapak = $this->db->delete('tbl_quickshop_minisubcategory', array('id' => $id));
        if ($zapak != 0) {
          // $path = FCPATH .$img;
          //   unlink($path);
          redirect("dcadmin/QuickshopMinisubcategory/view_minor_subcategory", "refresh");
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




  //delete category imag
  public function delete_subcategory_image($idd)
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
        $this->db->from('tbl_quickshop_minisubcategory');
        $this->db->where('id', $id);
        $dsa = $this->db->get();
        $da = $dsa->row();
        $img = $da->image;

        $data_update = array(
          'image' => "",

        );

        $this->db->where('id', $id);
        $zapak = $this->db->update('tbl_quickshop_minisubcategory', $data_update);

        if ($zapak != 0) {
          if (!empty($img)) {
            // $path = FCPATH .$img;
            // unlink($path);
          }
          redirect("dcadmin/QuickshopMinisubcategory/view_minor_subcategory", "refresh");
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



  public function getSubcat()
  {

    if (!empty($this->session->userdata('admin_data'))) {

      $isl = $_GET['isl'];
      $data['user_name'] = $this->load->get_var('user_name');

      // echo SITE_NAME;
      // echo $this->session->userdata('image');
      // echo $this->session->userdata('position');

      $this->db->select('*');
      $this->db->from('tbl_quickshop_subcategory');
      $this->db->where('category', $isl);
      $this->db->where('is_active', 1);
      $d1 = $this->db->get();
      $i = 1;
      foreach ($d1->result() as $dd1) {
        $sub[] = array('sub_id' => $dd1->id, 'sub_name' => $dd1->name);
        // echo $dd1->name;
        // echo "<br/>";

      }

      echo json_encode($sub);
      exit;
    } else {

      redirect("login/admin_login", "refresh");
    }
  }
}
