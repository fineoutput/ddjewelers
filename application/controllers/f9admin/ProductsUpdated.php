<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require_once(APPPATH . 'core/CI_finecontrol.php');
class ProductsUpdated extends CI_finecontrol
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("login_model");
        $this->load->model("admin/base_model");
        $this->load->library('user_agent');
        $this->load->library('upload');
    }
    public function fetch_product()
    {
        // if (!empty($this->session->userdata('admin_data'))) {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('category', 'category', 'required|xss_clean|trim');
            $this->form_validation->set_rules('sub_category', 'sub_category', 'xss_clean|trim');
            $this->form_validation->set_rules('minisubcategory', 'minisubcategory', 'xss_clean|trim');
            $this->form_validation->set_rules('minisubcategory2', 'minisubcategory2', 'xss_clean|trim');
            if ($this->form_validation->run() == true) {
                $category_id = $this->input->post('category');
                $subcategory_id     = $this->input->post('sub_category');
                $minor_category_id = $this->input->post('minisubcategory');
                $minor2_category_id = $this->input->post('minisubcategory2');
                $api_id = '';
                $type = '';
                $finished = '';
                $include_series = '';
                $include_sku = '';
                if ($minor2_category_id != 0) {
                    $this->db->select('*');
                    $this->db->from('tbl_minisubcategory2');
                    $this->db->where('id', $minor2_category_id);
                    $minor2_data = $this->db->get()->row();
                    if (!empty($minor2_data)) {
                        $api_id = $minor2_data->api_id;
                        $type = $minor2_data->type;
                        $finished = $minor2_data->finshed;
                        $include_series = $minor2_data->include_series;
                        $include_sku = $minor2_data->include_sku;
                    }
                    //------ Deleting existing data -----------
                    $delete = $this->db->delete('tbl_products', array('category_id' => $category_id, 'subcategory_id' => $subcategory_id, 'minor_category_id' => $minor_category_id, 'minor2_category_id' => $minor2_category_id));
                } else if ($minor_category_id != 0) {
                    $this->db->select('*');
                    $this->db->from('tbl_minisubcategory');
                    $this->db->where('id', $minor_category_id);
                    $minor_data = $this->db->get()->row();
                    // print_r($minor_data);die();
                    if (!empty($minor_data)) {
                        $api_id = $minor_data->api_id;
                        $type = $minor_data->type;
                        $finished = $minor_data->finshed;
                        $include_series = $minor_data->include_series;
                        $include_sku = $minor_data->include_sku;
                    }
                    //------ Deleting existing data -----------
                    $delete = $this->db->delete('tbl_products', array('category_id' => $category_id, 'subcategory_id' => $subcategory_id, 'minor_category_id' => $minor_category_id,));
                } else if ($subcategory_id != 0) {
                    $this->db->select('*');
                    $this->db->from('tbl_sub_category');
                    $this->db->where('id', $subcategory_id);
                    $sub_data = $this->db->get()->row();
                    if (!empty($sub_data)) {
                        $api_id = $sub_data->api_id;
                        $type = $sub_data->type;
                        $finished = $sub_data->finshed;
                        $include_series = $sub_data->include_series;
                        $include_sku = $sub_data->include_sku;
                    }
                    //------ Deleting existing data -----------
                    $delete = $this->db->delete('tbl_products', array('category_id' => $category_id, 'subcategory_id' => $subcategory_id));
                } else {
                    $this->db->select('*');
                    $this->db->from('tbl_category');
                    $this->db->where('id', $category_id);
                    $cate_data = $this->db->get()->row();
                    if (!empty($cate_data)) {
                        $api_id = $cate_data->api_id;
                        $type = $cate_data->type;
                        $finished = $cate_data->finshed;
                        $include_series = $cate_data->include_series;
                        $include_sku = $cate_data->include_sku;
                    }
                    //------ Deleting existing data -----------
                    $delete = $this->db->delete('tbl_products', array('category_id' => $category_id));
                }
                $minimum_cost = $this->db->get_where('tbl_minimum_cost', array())->row();
                if ($finished) {
                    $filter = json_encode(["Orderable", "OnPriceList", "Finished"]);
                } else {
                    $filter = json_encode(["Orderable", "OnPriceList"]);
                }
                $send = [
                    'category_id' => $category_id,
                    'subcategory_id' => $subcategory_id,
                    'minor_category_id' => $minor_category_id,
                    'minor2_category_id' => $minor2_category_id,
                    'api_id' => $api_id,
                    'filter' => $filter,
                    'include_series' => $include_series,
                    'include_sku' => $include_sku,
                    'minimum_cost' => $minimum_cost->cost,
                ];
                if ($type == 1) {
                    $this->fetchDataByCategoryId($send);
                    // $this->session->set_flashdata('smessage', 'Success');
                    // redirect($_SERVER['HTTP_REFERER']);
                } else if ($type == 2) {
                    $this->fetchDataBySeriesId($send);
                    echo "success";
                    // $this->session->set_flashdata('smessage', 'Success');
                    // redirect($_SERVER['HTTP_REFERER']);
                } else {
                    $this->fetchDataBySku($send);
                    // $this->session->set_flashdata('smessage', 'Success');
                    // redirect($_SERVER['HTTP_REFERER']);
                }
            } else {
                $this->session->set_flashdata('emessage', validation_errors());
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->session->set_flashdata('emessage', 'Please insert some data, No data available');
            redirect($_SERVER['HTTP_REFERER']);
        }
        // } else {
        //     redirect("login/admin_login", "refresh");
        // }
    }
    //============================= START FETCH DATA BY CATEGORY IDS ==========================
    public function fetchDataByCategoryId($receive)
    {
        $url = 'https://api.stuller.com/v2/products';
        $api_id = ["72058", "122105", "122969", "122790", "121987", "122047", "122060", "123229", "123243", "122804", "121986", "122996", "122870", "122705", "122011"];
        $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList"],"CategoryIds":' . $api_id . '}';
    }
    //============================= END FETCH DATA BY CATEGORY IDS ==========================
    //============================= START FETCH DATA BY SERIES IDS ==========================
    public function fetchDataBySeriesId($receive)
    {
        $url = 'https://api.stuller.com/v2/products';
        $productCountData = '{"Include":["ExcludeAll"],"Filter":' . $receive['filter'] . ',"Series":' . $receive['api_id'] . '}';
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
            $total_pages = round($result_da->TotalNumberOfProducts / 500) + 1;
        }
        $NextPage = "";
        for ($i = 0; $i < $total_pages; $i++) {
            if (empty($NextPage)) {
                $productData = '{"Include":["All"],"Filter":' . $receive['filter'] . ',"Series":' . $receive['api_id'] . '}';
            } else {
                $productData = '{"Include":["All"],"Filter":' . $receive['filter'] . ',"Series":' . $receive['api_id'] . ',"NextPage":"' . $NextPage . '"}';
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
            }
        }
        return;
    }
    //============================= END FETCH DATA BY SERIES IDS ==========================
    //============================= START FETCH DATA BY SKU'S ==========================
    public function fetchDataBySku($receive)
    {
        $url = 'https://api.stuller.com/v2/products';
        $api_id = ["72058", "122105", "122969", "122790", "121987", "122047", "122060", "123229", "123243", "122804", "121986", "122996", "122870", "122705", "122011"];
        $postData = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList"],"CategoryIds":' . $api_id . '}';
        //================= GET TOTAL NUMBER OF PAGES ========================
        $header = array();
        $header[] = 'Host:api.stuller.com';
        $header[] = 'Content-Type:application/json';
        $header[] = 'Authorization:Basic ZGV2amV3ZWw6Q29kaW5nMjA9';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        $result = curl_exec($ch);
        curl_close($ch);
        $result_da = json_decode($result);
        if (!empty($result_da)) {
            $total_pages = round($result_da->TotalNumberOfProducts / 500) + 1;
        }
    }
    //============================= END FETCH DATA BY SKU'S ==========================
    public function CreateObject($receive, $prod)
    {
        date_default_timezone_set("Asia/Calcutta");
        $cur_date = date("Y-m-d H:i:s");
        $Specifications = '';
        $RingSizeOptions = '';
        if (!empty($prod->Specifications)) {
            $Specifications = json_encode($prod->Specifications);
        }
        if (!empty($prod->ConfigurationModel->RingSizeOptions)) {
            $RingSizeOptions = json_encode($prod->ConfigurationModel->RingSizeOptions);
        }
        $response = array(
            'category_id' => $receive['category_id'],
            'subcategory_id' => $receive['subcategory_id'],
            'minor_category_id' => $receive['minor_category_id'],
            'minor2_category_id' => $receive['minor2_category_id'],
            'pro_id' => $prod->Id,
            'sku' => $prod->SKU,
            'short_description' => $prod->ShortDescription,
            'Description' => $prod->Description,
            'config_model_id' => $prod->ConfigurationModelId,
            'full_set_images' => json_encode($prod->FullySetImages),
            'group_id' => $prod->DescriptiveElementGroup->GroupId,
            'series_id' => $prod->DescriptiveElementGroup->DescriptiveElements[0]->Value,
            'price' => $prod->Price->Value,
            'elements' => json_encode($prod->DescriptiveElementGroup->DescriptiveElements),
            'catalog_values' => json_encode(array_column($prod->DescriptiveElementGroup->DescriptiveElements, 'Value')),
            'ring_sizable' => $prod->RingSizable,
            'ring_size_data' => $RingSizeOptions,
            'ring_size' => $prod->RingSize ? json_encode($prod->RingSize) : '',
            'stone' => $prod->CenterStoneShape,
            'quality' => $prod->QualityCatalogValue,
            'can_be_set' => json_encode($prod->CanBeSetWith),
            'specification' => $Specifications,
            'on_hand' => $prod->OnHand,
            'lead_time' => $prod->LeadTime,
            'status' => $prod->Status,
            'weight' => $prod->Weight,
            'date' => $cur_date,
        );
        return $response;
    }
}
