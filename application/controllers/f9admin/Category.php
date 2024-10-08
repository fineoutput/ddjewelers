<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'core/CI_finecontrol.php');
class Category extends CI_finecontrol
{
  function __construct()
  {
    parent::__construct();
    $this->load->model("login_model");
    $this->load->model("admin/base_model");
    $this->load->library('user_agent');
    $this->load->library('upload');
  }

  public function view_category()
  {

    if (!empty($this->session->userdata('admin_data'))) {

      $data['active'] = "Category Levels";

      $data['user_name'] = $this->load->get_var('user_name');

      // echo SITE_NAME;
      // echo $this->session->userdata('image');
      // echo $this->session->userdata('position');
      // exit;

      $this->db->select('*');
      $this->db->from('tbl_category');
      $this->db->order_by('seq', 'ASC');
      $data['category_data'] = $this->db->get();

      $this->load->view('admin/common/header_view', $data);
      $this->load->view('admin/category/view_category');
      $this->load->view('admin/common/footer_view');
    } else {

      redirect("login/admin_login", "refresh");
    }
  }

  public function add_category()
  {

    if (!empty($this->session->userdata('admin_data'))) {

      $this->load->view('admin/common/header_view');
      $this->load->view('admin/category/add_category');
      $this->load->view('admin/common/footer_view');
    } else {

      redirect("login/admin_login", "refresh");
    }
  }

  public function update_category($idd)
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
      $this->db->from('tbl_category');
      $this->db->where('id', $id);
      $data['category_data'] = $this->db->get()->row();


      $this->load->view('admin/common/header_view', $data);
      $this->load->view('admin/category/update_category');
      $this->load->view('admin/common/footer_view');
    } else {

      redirect("login/admin_login", "refresh");
    }
  }



  public function add_category_data($t, $iw = "")

  {

    if (!empty($this->session->userdata('admin_data'))) {


      $this->load->helper(array('form', 'url'));
      $this->load->library('form_validation');
      $this->load->helper('security');
      if ($this->input->post()) {
        // print_r($this->input->post());
        // exit;
        $this->form_validation->set_rules('name', 'name', 'required|xss_clean|trim');
        $this->form_validation->set_rules('description', 'description', 'required|xss_clean|trim');
        $this->form_validation->set_rules('type', 'type', 'required|xss_clean|trim');
        $this->form_validation->set_rules('api_id', 'api_id', 'xss_clean|trim');
        $this->form_validation->set_rules('seq', 'sequence', 'xss_clean|trim');
        $this->form_validation->set_rules('finshed', 'finshed', 'xss_clean|trim');
        $this->form_validation->set_rules('exlude_series', 'exlude_series', 'xss_clean|trim');
        $this->form_validation->set_rules('exlude_sku', 'exlude_sku', 'xss_clean|trim');
        $this->form_validation->set_rules('include_series', 'include_series', 'xss_clean|trim');
        $this->form_validation->set_rules('include_sku', 'include_sku', 'xss_clean|trim');






        if ($this->form_validation->run() == TRUE) {
          $name = $this->input->post('name');
          $description = $this->input->post('description');
          $type = $this->input->post('type');
          $api_id1 = $this->input->post('api_id');
          $cleanedString = str_replace(' ', '', $api_id1);
          $seq = $this->input->post('seq');
          $finshed = $this->input->post('finshed');
          $exlude_series = $this->input->post('exlude_series');
          $exlude_sku = $this->input->post('exlude_sku');
          $include_series = $this->input->post('include_series');
          $include_sku = $this->input->post('include_sku');

          $api_id = explode(",", $cleanedString);

          if ($finshed == 1) {
            $f_id = 1;
          } else {
            $f_id = 0;
          }

          if ($type == 1 || $type == "") {

            $api_id = json_encode($api_id);
          } else {
            $api_id = json_encode($api_id);
          }

          // echo $type;
          // exit;

          $ip = $this->input->ip_address();
          date_default_timezone_set("Asia/Calcutta");
          $cur_date = date("Y-m-d H:i:s");
          $addedby = $this->session->userdata('admin_id');

          $typ = base64_decode($t);
          $last_id = 0;
          if ($typ == 1) {



            $img1 = 'image';


            $file_check = ($_FILES['image']['error']);
            if ($file_check != 4) {

              $image_upload_folder = FCPATH . "assets/uploads/category/";
              if (!file_exists($image_upload_folder)) {
                mkdir($image_upload_folder, DIR_WRITE_MODE, true);
              }
              $new_file_name = "category" . date("Ymdhms");
              $this->upload_config = array(
                'upload_path'   => $image_upload_folder,
                'file_name' => $new_file_name,
                'allowed_types' => 'xlsx|csv|xls|pdf|doc|docx|txt|jpg|jpeg|png',
                'max_size'      => 25000
              );
              $this->upload->initialize($this->upload_config);
              if (!$this->upload->do_upload($img1)) {
                $upload_error = $this->upload->display_errors();
                // echo json_encode($upload_error);

                //$this->session->set_flashdata('emessage',$upload_error);
                //redirect($_SERVER['HTTP_REFERER']);
              } else {

                $file_info = $this->upload->data();

                $videoNAmePath = "assets/uploads/category/" . $new_file_name . $file_info['file_ext'];
                $file_info['new_name'] = $videoNAmePath;
                // $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
                $nnnn = $file_info['file_name'];
                $nnnn1 = $videoNAmePath;

                // echo json_encode($file_info);
              }
            }
            //Banner
            $ban2 = 'banner';


            $file_check = ($_FILES['banner']['error']);
            if ($file_check != 4) {

              $image_upload_folder = FCPATH . "assets/uploads/category/";
              if (!file_exists($image_upload_folder)) {
                mkdir($image_upload_folder, DIR_WRITE_MODE, true);
              }
              $new_file_name = "categoryBanner" . date("Ymdhms");
              $this->upload_config = array(
                'upload_path'   => $image_upload_folder,
                'file_name' => $new_file_name,
                'allowed_types' => 'xlsx|csv|xls|pdf|doc|docx|txt|jpg|jpeg|png',
                'max_size'      => 25000
              );
              $this->upload->initialize($this->upload_config);
              if (!$this->upload->do_upload($ban2)) {
                $upload_error = $this->upload->display_errors();
                // echo json_encode($upload_error);

                //$this->session->set_flashdata('emessage',$upload_error);
                //redirect($_SERVER['HTTP_REFERER']);
              } else {

                $file_info = $this->upload->data();

                $videoNAmePath = "assets/uploads/category/" . $new_file_name . $file_info['file_ext'];
                $file_info['new_name'] = $videoNAmePath;
                // $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
                $banner = $file_info['file_name'];
                $banner2 = $videoNAmePath;

                // echo json_encode($file_info);
              }
            } else {
              $banner2 = '';
            }
            if (!empty($nnnn1)) {
              $nnnn1 = $nnnn1;
            } else {
              $nnnn1 = "";
            }

            $data_insert = array(
              'name' => $name,
              'image' => $nnnn1,
              'banner' => $banner2,
              'description' => $description,
              'type' => $type,
              'api_id' => $api_id,
              'seq' => $seq,
              'finshed' => $f_id,
              'exlude_series' => $exlude_series,
              'exlude_sku' => $exlude_sku,
              'include_series' => $include_series,
              'include_sku' => $include_sku,


              'ip' => $ip,
              'added_by' => $addedby,
              'is_active' => 1,
              'date' => $cur_date
            );


            $last_id = $this->base_model->insert_table("tbl_category", $data_insert, 1);

            //===============add data in tbl_cron_job start===================//

            $this->db->select('*');
            $this->db->from('tbl_sub_category');
            $this->db->where('category', $last_id);
            $sub_data = $this->db->get()->row();
            $sub_id = '';
            $min_id = '';
            $min2_id = '';
            if (!empty($sub_data)) {
              $sub_id = $sub_data ? $sub_data->id : '';
              $this->db->select('*');
              $this->db->from('tbl_minisubcategory');
              $this->db->where('category', $last_id);
              $this->db->where('subcategory', $sub_data->id);
              $min_data = $this->db->get()->row();
              $min_id = $min_data ? $min_data->id : '';
              if (!empty($min_data)) {
                $this->db->select('*');
                $this->db->from('tbl_minisubcategory2');
                $this->db->where('category', $last_id);
                $this->db->where('subcategory', $sub_data->id);
                $this->db->where('minorsubcategory', $min_data->id);
                $min2_data = $this->db->get()->row();
                $min2_id = $min2_data ? $min2_data->id : '';
              }
            }


            $data_insert_cr = array(
              "cat_id" => $last_id,
              "subcat_id" => $sub_id,
              "mincat_id1" => $min_id,
              "mincat_id2" => $min2_id,
              'ip' => $ip,
              'date' => $cur_date,
              'is_quick' => 0,

            );
            $last_idd = $this->base_model->insert_table("tbl_cron_jobs", $data_insert_cr, 1);


            //===============add data in tbl_cron_job End===================//
          }
          if ($typ == 2) {

            $idw = base64_decode($iw);


            $this->db->select('*');
            $this->db->from('tbl_category');
            $this->db->where('id', $idw);
            $dsa = $this->db->get();
            $da = $dsa->row();



            $img1 = 'image';


            $file_check = ($_FILES['image']['error']);
            if ($file_check != 4) {

              $image_upload_folder = FCPATH . "assets/uploads/category/";
              if (!file_exists($image_upload_folder)) {
                mkdir($image_upload_folder, DIR_WRITE_MODE, true);
              }
              $new_file_name = "category" . date("Ymdhms");
              $this->upload_config = array(
                'upload_path'   => $image_upload_folder,
                'file_name' => $new_file_name,
                'allowed_types' => 'xlsx|csv|xls|pdf|doc|docx|txt|jpg|jpeg|png',
                'max_size'      => 25000
              );
              $this->upload->initialize($this->upload_config);
              if (!$this->upload->do_upload($img1)) {
                $upload_error = $this->upload->display_errors();
                // echo json_encode($upload_error);

                //$this->session->set_flashdata('emessage',$upload_error);
                //redirect($_SERVER['HTTP_REFERER']);
              } else {

                $file_info = $this->upload->data();

                $videoNAmePath = "assets/uploads/category/" . $new_file_name . $file_info['file_ext'];
                $file_info['new_name'] = $videoNAmePath;
                // $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
                $nnnn = $file_info['file_name'];
                $nnnn1 = $videoNAmePath;

                // echo json_encode($file_info);
              }
            }
            //Banner
            $ban2 = 'banner';


            $file_check = ($_FILES['banner']['error']);
            if ($file_check != 4) {

              $image_upload_folder = FCPATH . "assets/uploads/category/";
              if (!file_exists($image_upload_folder)) {
                mkdir($image_upload_folder, DIR_WRITE_MODE, true);
              }
              $new_file_name = "categoryBanner" . date("Ymdhms");
              $this->upload_config = array(
                'upload_path'   => $image_upload_folder,
                'file_name' => $new_file_name,
                'allowed_types' => 'xlsx|csv|xls|pdf|doc|docx|txt|jpg|jpeg|png',
                'max_size'      => 25000
              );
              $this->upload->initialize($this->upload_config);
              if (!$this->upload->do_upload($ban2)) {
                $upload_error = $this->upload->display_errors();
                // echo json_encode($upload_error);

                //$this->session->set_flashdata('emessage',$upload_error);
                //redirect($_SERVER['HTTP_REFERER']);
              } else {

                $file_info = $this->upload->data();

                $videoNAmePath = "assets/uploads/category/" . $new_file_name . $file_info['file_ext'];
                $file_info['new_name'] = $videoNAmePath;
                // $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
                $banner = $file_info['file_name'];
                $banner2 = $videoNAmePath;

                // echo json_encode($file_info);
              }
            } else {
              $banner2 = '';
            }



            if (!empty($da)) {
              $img = $da->image;
              if (!empty($img)) {
                if (empty($nnnn1)) {
                  $nnnn1 = $img;
                }
              } else {
                if (empty($nnnn1)) {
                  $nnnn1 = "";
                }
              }
            }
            if (empty($banner2)) {
              $banner2 = $da->banner;
            }

            $data_insert = array(
              'name' => $name,
              'image' => $nnnn1,
              'banner' => $banner2,
              'description' => $description,
              'type' => $type,
              'api_id' => $api_id,
              'seq' => $seq,
              'finshed' => $f_id,
              'exlude_series' => $exlude_series,
              'exlude_sku' => $exlude_sku,
              'include_series' => $include_series,
              'include_sku' => $include_sku

            );
            $this->db->where('id', $idw);
            $last_id = $this->db->update('tbl_category', $data_insert);
            //===============add data in tbl_cron_job start===================//

            $this->db->select('*');
            $this->db->from('tbl_sub_category');
            $this->db->where('category', $idw);
            $sub_data = $this->db->get()->row();
            $sub_id = '';
            $min_id = '';
            $min2_id = '';
            if (!empty($sub_data)) {
              $sub_id = $sub_data ? $sub_data->id : '';
              $this->db->select('*');
              $this->db->from('tbl_minisubcategory');
              $this->db->where('category', $idw);
              $this->db->where('subcategory', $sub_data->id);
              $min_data = $this->db->get()->row();
              $min_id = $min_data ? $min_data->id : '';
              if (!empty($min_data)) {
                $this->db->select('*');
                $this->db->from('tbl_minisubcategory2');
                $this->db->where('category', $idw);
                $this->db->where('subcategory', $sub_data->id);
                $this->db->where('minorsubcategory', $min_data->id);
                $min2_data = $this->db->get()->row();
                $min2_id = $min2_data ? $min2_data->id : '';
              }
            }


            $data_insert_cr = array(
              "cat_id" => $idw,
              "subcat_id" => $sub_id,
              "mincat_id1" => $min_id,
              "mincat_id2" => $min2_id,
              'ip' => $ip,
              'date' => $cur_date,
              'is_quick' => 0,

            );
            $last_idd = $this->base_model->insert_table("tbl_cron_jobs", $data_insert_cr, 1);


            //===============add data in tbl_cron_job End===================//
          }
          if ($last_id != 0) {
            $this->session->set_flashdata('smessage', 'Data inserted successfully');
            redirect("dcadmin/category/view_category", "refresh");
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

  public function updatecategoryStatus($idd, $t)
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
        $zapak = $this->db->update('tbl_category', $data_update);

        if ($zapak != 0) {
          redirect("dcadmin/category/view_category", "refresh");
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
        $zapak = $this->db->update('tbl_category', $data_update);

        if ($zapak != 0) {
          redirect("dcadmin/category/view_category", "refresh");
        } else {

          $this->session->set_flashdata('emessage', 'Sorry error occured');
          redirect($_SERVER['HTTP_REFERER']);
        }
      }
    } else {

      redirect("login/admin_login", "refresh");
    }
  }







  public function delete_category($idd)
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
        $this->db->from('tbl_category');
        $this->db->where('id', $id);
        $dsa = $this->db->get();
        $da = $dsa->row();
        $img = $da->image;

        $zapak = $this->db->delete('tbl_category', array('id' => $id));
        if ($zapak != 0) {
          if (!empty($img)) {
            // $path = FCPATH . $img;
            // unlink($path);
          }
          redirect("dcadmin/category/view_category", "refresh");
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
  public function delete_category_image($idd)
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
        $this->db->from('tbl_category');
        $this->db->where('id', $id);
        $dsa = $this->db->get();
        $da = $dsa->row();
        $img = $da->image;

        $data_update = array(
          'image' => "",

        );

        $this->db->where('id', $id);
        $zapak = $this->db->update('tbl_category', $data_update);
        if ($zapak != 0) {
          if (!empty($img)) {
            // $path = FCPATH . $img;
            // unlink($path);
          }

          redirect("dcadmin/category/view_category", "refresh");
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
