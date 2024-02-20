<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'core/CI_finecontrol.php');
class QuickshopProducts extends CI_finecontrol
{
  function __construct()
  {
    parent::__construct();
    $this->load->model("login_model");
    $this->load->model("admin/base_model");
    $this->load->library('user_agent');
    $this->load->library('upload');
  }
  // ============ START VIEW CATEGORY ========================
  public function view_category()
  {
    if (!empty($this->session->userdata('admin_data'))) {
      $data['user_name'] = $this->load->get_var('user_name');
      $this->db->select('*');
      $this->db->from('tbl_quickshop_category');
      $this->db->where('is_active', 1);
      $data['category_data'] = $this->db->get();
      $this->load->view('admin/common/header_view', $data);
      $this->load->view('admin/quickshop_products/view_category');
      $this->load->view('admin/common/footer_view');
    } else {
      redirect("login/admin_login", "refresh");
    }
  }
  // ============ END VIEW CATEGORY ========================
  // ============ START VIEW SUB CATEGORY ========================
  public function view_sub_category($idd)
  {
    if (!empty($this->session->userdata('admin_data'))) {
      $id = base64_decode($idd);
      $data['cate_id'] = $idd;
      $data['user_name'] = $this->load->get_var('user_name');
      $this->db->select('*');
      $this->db->from('tbl_quickshop_subcategory');
      $this->db->where('is_active', 1);
      $this->db->where('category', $id);
      $data['sub_category_data'] = $this->db->get();
      $this->load->view('admin/common/header_view', $data);
      $this->load->view('admin/quickshop_products/view_sub_category');
      $this->load->view('admin/common/footer_view');
    } else {
      redirect("login/admin_login", "refresh");
    }
  }
  // ============ END VIEW SUB CATEGORY  ========================
  // ============ START VIEW MINOR CATEGORY  ========================
  public function view_minisubcategory($idd)
  {
    if (!empty($this->session->userdata('admin_data'))) {
      $id = base64_decode($idd);
      $data['subcate_id'] = $idd;
      $data['user_name'] = $this->load->get_var('user_name');
      $this->db->select('*');
      $this->db->from('tbl_quickshop_minisubcategory');
      $this->db->where('is_active', 1);
      $this->db->where('subcategory', $id);
      $data['minisubcategory_data'] = $this->db->get();
      $temp = $data['minisubcategory_data']->row();
      $data['category_id'] = $temp ? base64_encode($temp->category) : '';
      $this->load->view('admin/common/header_view', $data);
      $this->load->view('admin/quickshop_products/view_minor_subcategory');
      $this->load->view('admin/common/footer_view');
    } else {
      redirect("login/admin_login", "refresh");
    }
  }
  // ============ END VIEW MINOR CATEGORY   ========================
  // ============ START VIEW MINOR CATEGORY 2   ========================
  public function view_minisubcategory2($idd)
  {
    if (!empty($this->session->userdata('admin_data'))) {
      $id = base64_decode($idd);
      $data['minsubcate_id'] = $idd;
      $data['user_name'] = $this->load->get_var('user_name');
      $this->db->select('*');
      $this->db->from('tbl_quickshop_minisubcategory2');
      $this->db->where('is_active', 1);
      $this->db->where('minorsubcategory', $id);
      $data['minisubcategory2_data'] = $this->db->get();
      $temp = $data['minisubcategory2_data']->row();
      $data['subcategory_id'] = $temp ? base64_encode($temp->subcategory) : '';
      $this->load->view('admin/common/header_view', $data);
      $this->load->view('admin/quickshop_products/view_minor_subcategory2');
      $this->load->view('admin/common/footer_view');
    } else {
      redirect("login/admin_login", "refresh");
    }
  }
  // ============ END VIEW MINOR CATEGORY 2   ========================
  // ============ START VIEW PRODUCTS   ========================

  public function view_products($idd, $page)
  {
    if (!empty($this->session->userdata('admin_data'))) {
      $id = base64_decode($idd);
      $page_dec = base64_decode($page);
      $data['page'] = $page;
      // if($page_dec == 0){
      $data['minsubcate2_id'] = $idd;
      $this->db->select('*');
      $this->db->from('tbl_products');
      $this->db->where('minor2_category_id', $id);
      $this->db->where('is_quick', 1);
      $data['products_data'] = $this->db->get();
      $temp = $data['products_data']->row();
      $data['minsubcateg_id'] = $temp ? base64_encode($temp->minor2_category_id) : '';
      $this->load->view('admin/common/header_view', $data);
      $this->load->view('admin/quickshop_products/view_products');
      $this->load->view('admin/common/footer_view');
    } else {
      redirect("login/admin_login", "refresh");
    }
  }
  // ============ END VIEW PRODUCTS   ========================
  // ============ START VIEW ADD PRODUCTS   ========================
  public function add_products()
  {
    if (!empty($this->session->userdata('admin_data'))) {
      $this->db->select('*');
      $this->db->from('tbl_quickshop_category');
      $data['category'] = $this->db->get();
      $this->db->select('*');
      $this->db->from('tbl_vendor');
      $data['vendor'] = $this->db->get();
      $this->load->view('admin/common/header_view', $data);
      $this->load->view('admin/quickshop_products/add_products');
      $this->load->view('admin/common/footer_view');
    } else {
      redirect("login/admin_login", "refresh");
    }
  }
  // ============ END VIEW ADD PRODUCTS  ========================
  // ============ START VIEW PRODUCT DETAILS  ========================
  public function product_details($idd)
  {
    if (!empty($this->session->userdata('admin_data'))) {
      $data['user_name'] = $this->load->get_var('user_name');
      $id = base64_decode($idd);
      $data['id'] = $idd;
      $this->db->select('*');
      $this->db->from('tbl_products');
      $this->db->where('id', $id);
      $data['products_data'] = $this->db->get()->row();
      $this->load->view('admin/common/header_view', $data);
      $this->load->view('admin/quickshop_products/product_details');
      $this->load->view('admin/common/footer_view');
    } else {
      redirect("login/admin_login", "refresh");
    }
  }
  // ============ END VIEW PRODUCT DETAILS   ========================
  // ============ START ADD PRODUCT DATA   ========================
  public function add_products_data()
  {
    if (!empty($this->session->userdata('admin_data'))) {
      $this->load->helper(array('form', 'url'));
      $this->load->library('form_validation');
      $this->load->helper('security');
      if ($this->input->post()) {
        $this->form_validation->set_rules('category', 'category', 'required|xss_clean|trim');
        $this->form_validation->set_rules('sub_category', 'sub_category', 'xss_clean|trim');
        $this->form_validation->set_rules('minisubcategory', 'minisubcategory', 'xss_clean|trim');
        $this->form_validation->set_rules('minisubcategory2', 'minisubcategory2', 'xss_clean|trim');
        $this->form_validation->set_rules('series_no', 'series_no', 'required|xss_clean|trim');
        $this->form_validation->set_rules('finished', 'finished', 'xss_clean|trim');
        if ($this->form_validation->run() == true) {
          $category_id = $this->input->post('category');
          $subcategory_id     = $this->input->post('sub_category');
          $minor_category_id = $this->input->post('minisubcategory');
          $minor2_category_id = $this->input->post('minisubcategory2');
          $series_no = $this->input->post('series_no');
          $finished = $this->input->post('finished');
          $cleanedString = str_replace(' ', '', $series_no);
          $api_id = explode(",", $cleanedString);
          $api_id = json_encode($api_id);
          $send = [
            'category_id' => $category_id,
            'subcategory_id' => $subcategory_id,
            'minor_category_id' => $minor_category_id,
            'minor2_category_id' => $minor2_category_id,
            'series_no' => $api_id,
            'finished' => $finished,
          ];
          $this->fetch_product($send);
          $minisub2 = base64_encode($minor2_category_id);
          $page = base64_encode(0);
          $this->session->set_flashdata('smessage', 'Data inserted successfully');
          redirect("dcadmin/QuickshopProducts/view_products/" . $minisub2 . "/" . $page, "refresh");
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
  // ============ END ADD PRODUCT DATA   ========================
  // ============ START FETCH DATA ========================
  public function fetch_product($received)
  {
    ini_set('memory_limit', '3000M');
    $category_id = $received['category_id'];
    $subcategory_id = $received['subcategory_id'];
    $minor_category_id = $received['minor_category_id'];
    $minor2_category_id = $received['minor2_category_id'];
    $api_id = $received['series_no'];
    $finished = $received['finished'];
    //------ Deleting existing data -----------
    $delete = $this->db->delete('tbl_products', array('category_id' => $category_id, 'subcategory_id' => $subcategory_id, 'minor_category_id' => $minor_category_id, 'minor2_category_id' => $minor2_category_id, 'is_quick' => 1));
    $minimum_cost = $this->db->get_where('tbl_minimum_cost', array('name'=>'Product'))->row();
    if ($finished) {
      $filter = json_encode(["Orderable", "OnPriceList", "Finished"]);
    } else {
      $filter = json_encode(["Orderable", "OnPriceList"]);
    }
    $key = 'Series';
    $send = [
      'category_id' => $category_id,
      'subcategory_id' => $subcategory_id,
      'minor_category_id' => $minor_category_id,
      'minor2_category_id' => $minor2_category_id,
      'api_id' => $api_id,
      'filter' => $filter,
      'minimum_cost' => $minimum_cost->cost,
      'key' => $key,
    ];
    $res = $this->fetchApiData($send);
    return $res;
  }
  //============================= END FETCH DATA  ==========================
  //============================= START FETCH API DATA  ==========================
  public function fetchApiData($receive)
  {
    $total_products = 0;
    $inserted_products = 0;
    $url = 'https://api.stuller.com/v2/products';
    $productCountData = '{"Include":["ExcludeAll"],"Filter":' . $receive['filter'] . ',"' . $receive['key'] . '":' . $receive['api_id'] . '}';
    //================= GET TOTAL NUMBER OF PAGES ========================
    $header = array();
    $header[] = 'Host:api.stuller.com';
    $header[] = 'Content-Type:application/json';
    $header[] = 'Authorization:Basic ZGV2amV3ZWw6Q29kaW5nMjA9';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $productCountData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    $result = curl_exec($ch);
    curl_close($ch);
    $result_da = json_decode($result);
    if (!empty($result_da)) {
      $total_products = $result_da->TotalNumberOfProducts;
      $total_pages = round($result_da->TotalNumberOfProducts / 500) + 1;
    }
    $NextPage = "";
    for ($i = 0; $i < $total_pages; $i++) {
      if (empty($NextPage)) {
        $productData = '{"Include":["All"],"Filter":' . $receive['filter'] . ',"' . $receive['key'] . '":' . $receive['api_id'] . '}';
      } else {
        $productData = '{"Include":["All"],"Filter":' . $receive['filter'] . ',"' . $receive['key'] . '":' . $receive['api_id'] . ',"NextPage":"' . $NextPage . '"}';
      }
      $header = array();
      $header[] = 'Host:api.stuller.com';
      $header[] = 'Content-Type:application/json';
      $header[] = 'Authorization:Basic ZGV2amV3ZWw6Q29kaW5nMjA9';
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $productData);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
      $result = curl_exec($ch);
      curl_close($ch);
      $result_da = json_decode($result);
      $products = [];
      if (!empty($result_da->Products)) {
        if (!empty($result_da->NextPage)) {
          $NextPage = $result_da->NextPage;
        }
        foreach ($result_da->Products as $prod) {
          if ($prod->Price->Value > $receive['minimum_cost']) {
            $products[] = $this->CreateObject($receive, $prod);
          }
        }
        $this->db->insert_batch('tbl_products', $products);
        $inserted_products += count($products);
      }
    }
    $send = ['total_products' => $total_products, 'inserted_products' => $inserted_products];
    return $send;
  }
  //============================= END END FETCH API DATA ==========================
  //============================= START CREATE OBJECT ==========================
  public function CreateObject($receive, $prod)
  {
    date_default_timezone_set("Asia/Calcutta");
    $cur_date = date("Y-m-d H:i:s");
    $inputArray = [$prod->Id, $prod->SKU, $prod->ShortDescription, $prod->Description, $prod->DescriptiveElementGroup->DescriptiveElements[0]->Value, $prod->DescriptiveElementGroup->GroupId];
    $cleanedArray = array_map(function ($item) {
      return str_replace(['\/', '/',], '', $item);
    }, $inputArray);
    $search_value = json_encode($cleanedArray);
    $response = array(
      'category_id' => $receive['category_id'],
      'subcategory_id' => $receive['subcategory_id'],
      'minor_category_id' => $receive['minor_category_id'],
      'minor2_category_id' => $receive['minor2_category_id'],
      'is_quick' => 1,
      'pro_id' => $prod->Id,
      'sku' => $prod->SKU,
      'short_description' => $prod->ShortDescription,
      'Description' => $prod->Description,
      'config_model_id' => $prod->ConfigurationModelId,
      'full_set_images' => !empty($prod->FullySetImages) ? json_encode($prod->FullySetImages) : '',
      'images' => !empty($prod->Images) ? json_encode($prod->Images) : '',
      'group_images' => !empty($prod->GroupImages) ? json_encode($prod->GroupImages) : '',
      'group_id' => $prod->DescriptiveElementGroup->GroupId,
      'series_id' => $prod->DescriptiveElementGroup->DescriptiveElements[0]->Value,
      'price' => $prod->Price->Value,
      'elements' => json_encode($prod->DescriptiveElementGroup->DescriptiveElements),
      'catalog_values' => json_encode(array_column($prod->DescriptiveElementGroup->DescriptiveElements, 'Value')),
      'ring_sizable' => $prod->RingSizable,
      'ring_size_data' => !empty($prod->ConfigurationModel->RingSizeOptions) ? json_encode($prod->ConfigurationModel->RingSizeOptions) : '',
      'ring_size' => !empty($prod->RingSize) ? json_encode($prod->RingSize) : '',
      'stone' => !empty($prod->CenterStoneShape) ? $prod->CenterStoneShape : '',
      'quality' => !empty($prod->QualityCatalogValue) ? $prod->QualityCatalogValue : '',
      'can_be_set' => !empty($prod->CanBeSetWith) ? json_encode($prod->CanBeSetWith) : "",
      'specification' => !empty($prod->Specifications) ? json_encode($prod->Specifications) : '',
      'setting_options' => !empty($prod->ConfigurationModel->SettingOptions) ? json_encode($prod->ConfigurationModel->SettingOptions) : '',
      'on_hand' => $prod->OnHand,
      'lead_time' => $prod->LeadTime,
      'status' => $prod->Status,
      'weight' => !empty($prod->GramWeight) ? $prod->GramWeight : '',
      'search_values' => $search_value,
      'videos' => !empty($prod->Videos) ? json_encode($prod->Videos) : '',
      'date' => $cur_date,
    );
    return $response;
  }
  //============================= END CREATE OBJECT ==========================
  //============================= START GET AJAX SUBCATEGORY ==========================

  public function getSub_category()
  {
    if (!empty($this->session->userdata('admin_data'))) {;
      $isl = $_GET['isl'];
      $this->db->select('*');
      $this->db->from('tbl_quickshop_subcategory');
      $this->db->where('category', $isl);
      $data = $this->db->get();
      $i = 1;
      foreach ($data->result() as $row) {
        $sub_category[] = array('id' => $row->id, 'name' => $row->name);
        $i++;
      }
      if (!empty($sub_category)) {
        // code...
        echo json_encode($sub_category);
      } else {
        echo 'NA';
      }
    } else {
      redirect("login/admin_login", "refresh");
    }
  }
  //============================= END GET AJAX SUBCATEGORY ==========================
  //============================= START GET AJAX MINOR CATEGORY ==========================
  public function getminiSub_category()
  {
    if (!empty($this->session->userdata('admin_data'))) {
      // $data['user_name']=$this->load->get_var('user_name');
      $isl = $_GET['isl'];
      $this->db->select('*');
      $this->db->from('tbl_quickshop_minisubcategory');
      $this->db->where('subcategory', $isl);
      $this->db->where('is_active', 1);
      $data = $this->db->get();
      $i = 1;
      foreach ($data->result() as $row) {
        $sub_category[] = array('id' => $row->id, 'name' => $row->name);
        $i++;
      }
      if (!empty($sub_category)) {
        // code...
        echo json_encode($sub_category);
      } else {
        echo 'NA';
      }
    } else {
      redirect("login/admin_login", "refresh");
    }
  }
  //============================= END GET AJAX MINOR CATEGORY ==========================
  //============================= START GET AJAX MINOR 2 CATEGORY ==========================
  public function getminiSub_category2()
  {
    if (!empty($this->session->userdata('admin_data'))) {
      $isl = $_GET['isl'];
      $this->db->select('*');
      $this->db->from('tbl_quickshop_minisubcategory2');
      $this->db->where('minorsubcategory', $isl);
      $this->db->where('is_active', 1);
      $data = $this->db->get();
      $i = 1;
      foreach ($data->result() as $row) {
        $sub_category[] = array('id' => $row->id, 'name' => $row->name);
        $i++;
      }
      if (!empty($sub_category)) {
        // code...
        echo json_encode($sub_category);
      } else {
        echo 'NA';
      }
    } else {
      redirect("login/admin_login", "refresh");
    }
  }
  //============================= END GET AJAX MINOR 2 CATEGORY ==========================

}
