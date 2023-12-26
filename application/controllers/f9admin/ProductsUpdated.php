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
        if (!empty($this->session->userdata('admin_data'))) {
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
                    $sub_category_id = $this->input->post('sub_category');
                    $minor_subcategory_id = $this->input->post('minisubcategory');
                    $minor_subcategory_id2 = $this->input->post('minisubcategory2');
                    $ip = $this->input->ip_address();
                    date_default_timezone_set("Asia/Calcutta");
                    $cur_date = date("Y-m-d H:i:s");
                    $addedby = $this->session->userdata('admin_id');
                    $api_id = '';
                    $type = '';
                    $finished = '';
                    $include_series = '';
                    $include_sku = '';
                    if ($minor_subcategory_id2 != 0) {
                        $this->db->select('*');
                        $this->db->from('tbl_minisubcategory2');
                        $this->db->where('id', $minor_subcategory_id2);
                        $minor2_data = $this->db->get()->row();
                        if (!empty($minor2_data)) {
                            $api_id = $minor2_data->api_id;
                            $type = $minor2_data->type;
                            $finished = $minor2_data->finshed;
                            $include_series = $minor2_data->include_series;
                            $include_sku = $minor2_data->include_sku;
                        }
                    }
                    if ($minor_subcategory_id != 0) {
                        $this->db->select('*');
                        $this->db->from('tbl_minisubcategory');
                        $this->db->where('id', $minor_subcategory_id);
                        $minor_data = $this->db->get()->row();
                        if (!empty($minor_data)) {
                            $api_id = $minor_data->api_id;
                            $type = $minor_data->type;
                            $finished = $minor_data->finshed;
                            $include_series = $minor_data->include_series;
                            $include_sku = $minor_data->include_sku;
                        }
                    }
                    if ($sub_category_id != 0) {
                        $this->db->select('*');
                        $this->db->from('tbl_sub_category');
                        $this->db->where('id', $sub_category_id);
                        $sub_data = $this->db->get()->row();
                        if (!empty($sub_data)) {
                            $api_id = $sub_data->api_id;
                            $type = $sub_data->type;
                            $finished = $sub_data->finshed;
                            $include_series = $sub_data->include_series;
                            $include_sku = $sub_data->include_sku;
                        }
                    }
                    if ($category_id != 0) {
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
                    }
                    $this->fetchDataByCategoryId($api_id, $finished);
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
    public function fetchDataByCategoryId($api_id, $finished)
    {
        $url = 'https://api.stuller.com/v2/products';
        $api_id = ["72058", "122105", "122969", "122790", "121987", "122047", "122060", "123229", "123243", "122804", "121986", "122996", "122870", "122705", "122011"];
        $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList"],"CategoryIds":' . $api_id . '}';
    }
    public function fetchDataBySeriesId()
    {
        date_default_timezone_set("Asia/Calcutta");
        $cur_date = date("Y-m-d H:i:s");
        $url = 'https://api.stuller.com/v2/products';
        $api_id = ["72058", "122105", "122969", "122790", "121987", "122047", "122060", "123229", "123243", "122804", "121986", "122996", "122870", "122705", "122011"];
        $value = '72058';
        $productCountData = '{"Include":["ExcludeAll"],"Filter":["Orderable","OnPriceList",],"Series":["72058","122105", "122969"]}';
        $productData = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList",],"Series":["72058","122105", "122969"]}';
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
                foreach ($result_da->Products as $prod) {
                    $products[] = array(
                        'pro_id' => $prod->Id,
                        'sku' => $prod->SKU,
                        'short_description' => $prod->ShortDescription,
                        'Description' => $prod->Description,
                        'config_model_id' => $prod->ConfigurationModelId,
                        'full_set_images' => json_encode($prod->FullySetImages),
                        'group_id' => $prod->DescriptiveElementGroup->GroupId,
                        'series_id' => $prod->DescriptiveElementGroup->DescriptiveElements[0]->Value,
                        'price' => $prod->Price->Value,
                        'elements' => json_encode($prod->DescriptiveElementGroup),
                        'config_modal' => json_encode($prod->ConfigurationModelId),
                        'date' => json_encode($prod->ConfigurationModelId),
                    );
                }
                $this->db->insert_batch('tbl_temp_products', $products);
            }
        }
        // $batchSize = 500;
        // $chunks = array_chunk($apiData, $batchSize);

        // foreach ($chunks as $chunk) {
        //     $this->db->insert_batch($tableName, $chunk);
        // }
        header('Content-Type: application/json');
        echo (json_encode($products));
    }
    public function fetchDataBySku()
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
    public function test_pro()
    {
        $data['product'] = $this->db->group_by('series_id')->get_where('tbl_temp_products', array())->result();
        // echo count($pro_data);
        // header('Content-Type: application/json');
        // echo (json_encode($pro_data));
        $this->load->view('common/header', $data);
        $this->load->view('test_pro');
        $this->load->view('common/footer');
    }
}
