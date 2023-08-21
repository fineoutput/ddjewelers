<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'core/CI_finecontrol.php');
class Minisubcategory2 extends CI_finecontrol
{
  function __construct()
  {
    parent::__construct();
    $this->load->model("login_model");
    $this->load->model("admin/base_model");
    $this->load->library('user_agent');
    $this->load->library('upload');
  }

  public function view_minisubcategory2()
  {

    if (!empty($this->session->userdata('admin_data'))) {


      $data['user_name'] = $this->load->get_var('user_name');

      // echo SITE_NAME;
      // echo $this->session->userdata('image');
      // echo $this->session->userdata('position');
      // exit;

      $this->db->select('*');
      $this->db->from('tbl_minisubcategory2');
      //$this->db->where('id',$usr);
      $data['minisubcategory2_data'] = $this->db->get();

      $this->load->view('admin/common/header_view', $data);
      $this->load->view('admin/minisubcategory2/view_minisubcategory2');
      $this->load->view('admin/common/footer_view');
    } else {

      redirect("login/admin_login", "refresh");
    }
  }

  public function add_minisubcategory2()
  {

    if (!empty($this->session->userdata('admin_data'))) {


      $this->db->select('*');
      $this->db->from('tbl_category');
      $this->db->where('is_active', 1);
      $data['category'] = $this->db->get();

      $this->db->select('*');
      $this->db->from('tbl_sub_category');
      $this->db->where('is_active', 1);
      $data['subcategory'] = $this->db->get();

      $this->db->select('*');
      $this->db->from('tbl_minisubcategory');
      $this->db->where('is_active', 1);
      $data['minisubcategory'] = $this->db->get();

      $this->load->view('admin/common/header_view', $data);
      $this->load->view('admin/minisubcategory2/add_minisubcategory2');
      $this->load->view('admin/common/footer_view');
    } else {

      redirect("login/admin_login", "refresh");
    }
  }

  public function update_minisubcategory2($idd)
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
      $this->db->where('is_active', 1);
      $data['category'] = $this->db->get();

      $this->db->select('*');
      $this->db->from('tbl_sub_category');
      $this->db->where('is_active', 1);
      $data['subcategory'] = $this->db->get();

      $this->db->select('*');
      $this->db->from('tbl_minisubcategory');
      $this->db->where('is_active', 1);
      $data['minisubcategory'] = $this->db->get();


      $this->db->select('*');
      $this->db->from('tbl_minisubcategory2');
      $this->db->where('id', $id);
      $data['minisubcategory2_data'] = $this->db->get()->row();


      $this->load->view('admin/common/header_view', $data);
      $this->load->view('admin/minisubcategory2/update_minisubcategory2');
      $this->load->view('admin/common/footer_view');
    } else {

      redirect("login/admin_login", "refresh");
    }
  }

  public function add_minisubcategory2_data($t, $iw = "")

  {

    if (!empty($this->session->userdata('admin_data'))) {


      $this->load->helper(array('form', 'url'));
      $this->load->library('form_validation');
      $this->load->helper('security');
      if ($this->input->post()) {
        // print_r($this->input->post());
        // exit;
        $this->form_validation->set_rules('category', 'category', 'required');
        $this->form_validation->set_rules('subcategory', 'subcategory', 'required');
        $this->form_validation->set_rules('minorsubcategory', 'minorsubcategory', '');
        $this->form_validation->set_rules('type', 'type', 'required|xss_clean|trim');

        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('api_id', 'api_id', 'xss_clean|trim');
        $this->form_validation->set_rules('seq', 'sequence', 'xss_clean|trim');
        $this->form_validation->set_rules('finshed', 'finshed', 'xss_clean|trim');
        $this->form_validation->set_rules('exlude_series', 'exlude_series', 'xss_clean|trim');
        $this->form_validation->set_rules('exlude_sku', 'exlude_sku', 'xss_clean|trim');
        $this->form_validation->set_rules('include_series', 'include_series', 'xss_clean|trim');
        $this->form_validation->set_rules('include_sku', 'include_sku', 'xss_clean|trim');
        $this->form_validation->set_rules('description', 'description', 'xss_clean|trim');







        if ($this->form_validation->run() == TRUE) {
          $category = $this->input->post('category');
          $subcategory = $this->input->post('subcategory');
          $minorsubcategory = $this->input->post('minorsubcategory');
          $name = $this->input->post('name');
          $type = $this->input->post('type');

          $api_id1 = $this->input->post('api_id');
          $cleanedString = str_replace(' ', '', $api_id1);
          $seq = $this->input->post('seq');
          $finshed = $this->input->post('finshed');
          $exlude_series = $this->input->post('exlude_series');
          $exlude_sku = $this->input->post('exlude_sku');
          $include_series = $this->input->post('include_series');
          $include_sku = $this->input->post('include_sku');
          $description = $this->input->post('description');

          $api_id = explode(",", $cleanedString);

          if ($finshed == 1) {
            $f_id = 1;
          } else {
            $f_id = 0;
          }


          $api_id = json_encode($api_id);

          $ip = $this->input->ip_address();
          date_default_timezone_set("Asia/Calcutta");
          $cur_date = date("Y-m-d H:i:s");
          $addedby = $this->session->userdata('admin_id');


          $typ = base64_decode($t);
          $last_id = 0;
          if ($typ == 1) {



            $img3 = 'image';


            $file_check = ($_FILES['image']['error']);
            if ($file_check != 4) {

              $image_upload_folder = FCPATH . "assets/uploads/minisubcategory2/";
              if (!file_exists($image_upload_folder)) {
                mkdir($image_upload_folder, DIR_WRITE_MODE, true);
              }
              $new_file_name = "minisubcategory2" . date("Ymdhms");
              $this->upload_config = array(
                'upload_path'   => $image_upload_folder,
                'file_name' => $new_file_name,
                'allowed_types' => 'xlsx|csv|xls|pdf|doc|docx|txt|jpg|jpeg|png',
                'max_size'      => 25000
              );
              $this->upload->initialize($this->upload_config);
              if (!$this->upload->do_upload($img3)) {
                $upload_error = $this->upload->display_errors();
                // echo json_encode($upload_error);

                //$this->session->set_flashdata('emessage',$upload_error);
                //redirect($_SERVER['HTTP_REFERER']);
              } else {

                $file_info = $this->upload->data();

                $videoNAmePath = "assets/uploads/minisubcategory2/" . $new_file_name . $file_info['file_ext'];
                $file_info['new_name'] = $videoNAmePath;
                // $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
                $nnnn = $file_info['file_name'];
                $nnnn3 = $videoNAmePath;

                // echo json_encode($file_info);
              }
            }



            $data_insert = array(
              'category' => $category,
              'subcategory' => $subcategory,
              'minorsubcategory' => $minorsubcategory,
              'name' => $name,
              'type' => $type,
              'image' => $nnnn3,
              'api_id' => $api_id,
              'seq' => $seq,
              'finshed' => $finshed,
              'exlude_series' => $exlude_series,
              'exlude_sku' => $exlude_sku,
              'include_series' => $include_series,
              'include_sku' => $include_sku,
              'description' => $description,


              'ip' => $ip,
              'added_by' => $addedby,
              'is_active' => 1,
              'date' => $cur_date
            );


            $last_id = $this->base_model->insert_table("tbl_minisubcategory2", $data_insert, 1);
          }
          if ($typ == 2) {
$idw=base64_decode($iw);
         

            $this->db->select('*');
            $this->db->from('tbl_minisubcategory2');
            $this->db->where('id', $idw);
            $dsa = $this->db->get();
            $da = $dsa->row();




            $img3 = 'image';


            $file_check = ($_FILES['image']['error']);
            if ($file_check != 4) {

              $image_upload_folder = FCPATH . "assets/uploads/minisubcategory2/";
              if (!file_exists($image_upload_folder)) {
                mkdir($image_upload_folder, DIR_WRITE_MODE, true);
              }
              $new_file_name = "minisubcategory2" . date("Ymdhms");
              $this->upload_config = array(
                'upload_path'   => $image_upload_folder,
                'file_name' => $new_file_name,
                'allowed_types' => 'xlsx|csv|xls|pdf|doc|docx|txt|jpg|jpeg|png',
                'max_size'      => 25000
              );
              $this->upload->initialize($this->upload_config);
              if (!$this->upload->do_upload($img3)) {
                $upload_error = $this->upload->display_errors();
                // echo json_encode($upload_error);

                //$this->session->set_flashdata('emessage',$upload_error);
                //redirect($_SERVER['HTTP_REFERER']);
              } else {

                $file_info = $this->upload->data();

                $videoNAmePath = "assets/uploads/minisubcategory2/" . $new_file_name . $file_info['file_ext'];
                $file_info['new_name'] = $videoNAmePath;
                // $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
                $nnnn = $file_info['file_name'];
                $nnnn3 = $videoNAmePath;

                // echo json_encode($file_info);
              }
            }



            if (!empty($da)) {
              $img = $da->image;
              if (!empty($img)) {
                if (empty($nnnn3)) {
                  $nnnn3 = $img;
                }
              } else {
                if (empty($nnnn3)) {
                  $nnnn3 = "";
                }
              }
            }

            $data_insert = array(
              'category' => $category,
              'subcategory' => $subcategory,
              'minorsubcategory' => $minorsubcategory,
              'name' => $name,
              'type' => $type,
              'image' => $nnnn3,
              'api_id' => $api_id,
              'seq' => $seq,
              'finshed' => $finshed,
              'exlude_series' => $exlude_series,
              'exlude_sku' => $exlude_sku,
              'include_series' => $include_series,
              'include_sku' => $include_sku,
              'description' => $description


            );
            $this->db->where('id', $idw);
            $last_id = $this->db->update('tbl_minisubcategory2', $data_insert);

            
              //===============add data in tbl_cron_job start===================//
          
              $this->db->select('*');
              $this->db->from('tbl_minisubcategory2');
              $this->db->where('id', $idw);
              $cat_data = $this->db->get()->row();
  
              if (!empty($cat_data->api_id)) {
  
                $data_insert_cr = array(
                  "cat_id" =>$category,
                  "subcat_id" => $subcategory,
                  "mincat_id1" => $minorsubcategory,
                  "mincat_id2" => $idw,
                 
                );
                $last_idd = $this->base_model->insert_table("tbl_cron_jobs", $data_insert_cr, 1);
              }
  
  
              //===============add data in tbl_cron_job End===================//

          }
          if ($last_id != 0) {
            $this->session->set_flashdata('smessage', 'Data inserted successfully');
            redirect("dcadmin/minisubcategory2/view_minisubcategory2", "refresh");
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
               



  public function updateminisubcategory2Status($idd, $t)
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
        $zapak = $this->db->update('tbl_minisubcategory2', $data_update);

        if ($zapak != 0) {
          redirect("dcadmin/minisubcategory2/view_minisubcategory2", "refresh");
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
        $zapak = $this->db->update('tbl_minisubcategory2', $data_update);

        if ($zapak != 0) {
          redirect("dcadmin/minisubcategory2/view_minisubcategory2", "refresh");
        } else {

          $this->session->set_flashdata('emessage', 'Sorry error occured');
          redirect($_SERVER['HTTP_REFERER']);
        }
      }
    } else {

      redirect("login/admin_login", "refresh");
    }
  }



  public function delete_minisubcategory2($idd)
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
        $this->db->from('tbl_minisubcategory2');
        $this->db->where('id', $id);
        $dsa = $this->db->get();
        $da = $dsa->row();
        // $img = $da->image;
        // unlink($path);
        $zapak = $this->db->delete('tbl_minisubcategory2', array('id' => $id));
        if ($zapak != 0) {

        redirect("dcadmin/minisubcategory2/view_minisubcategory2", "refresh");


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
    $this->db->from('tbl_sub_category');
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




public function getMinorSubcat()
{

  if (!empty($this->session->userdata('admin_data'))) {

    $isl = $_GET['isl'];
    $data['user_name'] = $this->load->get_var('user_name');

    // echo SITE_NAME;
    // echo $this->session->userdata('image');
    // echo $this->session->userdata('position');

    $this->db->select('*');
    $this->db->from('tbl_minisubcategory');
    $this->db->where('subcategory', $isl);
    $this->db->where('is_active', 1);
    $d1 = $this->db->get();
    $i = 1;
    foreach ($d1->result() as $dd1) {
      $minorsub[] = array('minorsub_id' => $dd1->id, 'minorsub_name' => $dd1->name);
      // echo $dd1->name;
      // echo "<br/>";

    }

    echo json_encode($minorsub);
    exit;
  } else {

    redirect("login/admin_login", "refresh");
  }
}
}
