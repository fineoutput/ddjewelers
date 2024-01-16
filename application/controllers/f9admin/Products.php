<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require_once(APPPATH . 'core/CI_finecontrol.php');
class Products extends CI_finecontrol
{
    public function __construct()
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
            $this->db->from('tbl_category');
            $this->db->where('is_active', 1);
            $data['category_data'] = $this->db->get();
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/products/view_category');
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
            $this->db->from('tbl_sub_category');
            $this->db->where('is_active', 1);
            $this->db->where('category', $id);
            $data['sub_category_data'] = $this->db->get();
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/products/view_sub_category');
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
            $this->db->from('tbl_minisubcategory');
            $this->db->where('is_active', 1);
            $this->db->where('subcategory', $id);
            $data['minisubcategory_data'] = $this->db->get();
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/products/view_minisubcategory');
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
            $data['minorsubcate_id'] = $idd;
            $data['user_name'] = $this->load->get_var('user_name');
            // echo SITE_NAME;
            // echo $this->session->userdata('image');
            // echo $this->session->userdata('position');
            // exit;
            $this->db->select('*');
            $this->db->from('tbl_minisubcategory2');
            $this->db->where('is_active', 1);
            $this->db->where('minorsubcategory', $id);
            $data['minisubcategory2_data'] = $this->db->get();
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/products/view_minorsubcategory2');
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
            $data['user_name'] = $this->load->get_var('user_name');
            $id = base64_decode($idd);
            $page_dec = base64_decode($page);
            $data['page'] = $page;
            if ($page_dec == 3) {
                $data['cate_id'] = $idd;
                $this->db->select('*');
                $this->db->from('tbl_products');
                $this->db->where('category_id', $id);
                $data['products_data'] = $this->db->get();
            } elseif ($page_dec == 0) {
                $data['subcate_id'] = $idd;
                $this->db->select('*');
                $this->db->from('tbl_products');
                $this->db->where('subcategory_id', $id);
                $data['products_data'] = $this->db->get();
            } elseif ($page_dec == 1) {
                $data['minorsubcate_id'] = $idd;
                $this->db->select('*');
                $this->db->from('tbl_products');
                $this->db->where('minor_category_id', $id);
                $data['products_data'] = $this->db->get();
            } else {
                $data['minorsubcate2_id'] = $idd;
                $this->db->select('*');
                $this->db->from('tbl_products');
                $this->db->where('minor2_category_id', $id);
                $data['products_data'] = $this->db->get();
            }
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/products/view_products');
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
            $this->db->from('tbl_category');
            $data['category'] = $this->db->get();
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/products/add_products');
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
            $this->load->view('admin/products/product_details');
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
                if ($this->form_validation->run() == true) {
                    $category_id = $this->input->post('category');
                    $subcategory_id     = $this->input->post('sub_category');
                    $minor_category_id = $this->input->post('minisubcategory');
                    $minor2_category_id = $this->input->post('minisubcategory2');
                    if ($minor2_category_id != 0) {
                        $return_id = base64_encode($minor2_category_id);
                        $return_type = base64_encode(2);
                    } else if ($minor_category_id != 0) {
                        $return_id = base64_encode($minor_category_id);
                        $return_type = base64_encode(1);
                    } else if ($subcategory_id != 0) {
                        $return_id = base64_encode($subcategory_id);
                        $return_type = base64_encode(0);
                    } else {
                        $return_id = base64_encode($category_id);
                        $return_type = base64_encode(3);
                    }
                    $send = [
                        'category_id' => $category_id,
                        'subcategory_id' => $subcategory_id,
                        'minor_category_id' => $minor_category_id,
                        'minor2_category_id' => $minor2_category_id,
                        'is_quick' => '',
                    ];
                    $this->fetch_product($send);
                    $this->session->set_flashdata('smessage', 'Data inserted successfully');
                    redirect("dcadmin/products/view_products/" . $return_id . "/" . $return_type, "refresh");
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
        $is_quick = $received['is_quick'];
        $api_id = '';
        $type = '';
        $finished = '';
        $include_series = '';
        $include_sku = '';

        $exclude_series = '';
        $exclude_sku = '';
        if (!empty($is_quick)) {
            //-------------- quick shop products -----------------
            $minor2_data = $this->db->select('id,api_id')->get_where('tbl_quickshop_minisubcategory2', array('id' => $minor2_category_id))->row();
            if (!empty($minor2_data)) {
                $api_id = $minor2_data->api_id;
                $type = 2;
                $finished = '';
                $include_series = '';
                $include_sku = '';
                $exclude_series = '';
                $exclude_sku = '';
            }
            //------ Deleting existing data -----------
            $delete = $this->db->delete('tbl_products', array('category_id' => $category_id, 'subcategory_id' => $subcategory_id, 'minor_category_id' => $minor_category_id, 'minor2_category_id' => $minor2_category_id));
        }
        //-------------- normal products -----------------
        else {
            if ($minor2_category_id != 0) {
                $minor2_data = $this->db->select('id,api_id,type,finshed,include_series,include_sku,exlude_series,exlude_sku')->get_where('tbl_minisubcategory2', array('id' => $minor2_category_id))->row();
                if (!empty($minor2_data)) {
                    $api_id = $minor2_data->api_id;
                    $type = $minor2_data->type;
                    $finished = $minor2_data->finshed;
                    $include_series = $minor2_data->include_series;
                    $include_sku = $minor2_data->include_sku;
                    $exclude_series = $minor2_data->exlude_series;
                    $exclude_sku = $minor2_data->exlude_sku;
                }
                //------ Deleting existing data -----------
                $delete = $this->db->delete('tbl_products', array('category_id' => $category_id, 'subcategory_id' => $subcategory_id, 'minor_category_id' => $minor_category_id, 'minor2_category_id' => $minor2_category_id));
            } else if ($minor_category_id != 0) {
                $minor_data = $this->db->select('id,api_id,type,finshed,include_series,include_sku,exlude_series,exlude_sku')->get_where('tbl_minisubcategory', array('id' => $minor_category_id))->row();
                if (!empty($minor_data)) {
                    $api_id = $minor_data->api_id;
                    $type = $minor_data->type;
                    $finished = $minor_data->finshed;
                    $include_series = $minor_data->include_series;
                    $include_sku = $minor_data->include_sku;
                    $exclude_series = $minor_data->exlude_series;
                    $exclude_sku = $minor_data->exlude_sku;
                }
                //------ Deleting existing data -----------
                $delete = $this->db->delete('tbl_products', array('category_id' => $category_id, 'subcategory_id' => $subcategory_id, 'minor_category_id' => $minor_category_id,));
            } else if ($subcategory_id != 0) {
                $sub_data = $this->db->select('id,api_id,type,finshed,include_series,include_sku,exlude_series,exlude_sku')->get_where('tbl_sub_category', array('id' => $subcategory_id))->row();
                if (!empty($sub_data)) {
                    $api_id = $sub_data->api_id;
                    $type = $sub_data->type;
                    $finished = $sub_data->finshed;
                    $include_series = $sub_data->include_series;
                    $include_sku = $sub_data->include_sku;
                    $exclude_series = $sub_data->exlude_series;
                    $exclude_sku = $sub_data->exlude_sku;
                }
                //------ Deleting existing data -----------
                $delete = $this->db->delete('tbl_products', array('category_id' => $category_id, 'subcategory_id' => $subcategory_id));
            } else {
                $cate_data = $this->db->select('id,api_id,type,finshed,include_series,include_sku,exlude_series,exlude_sku')->get_where('tbl_category', array('id' => $category_id))->row();
                if (!empty($cate_data)) {
                    $api_id = $cate_data->api_id;
                    $type = $cate_data->type;
                    $finished = $cate_data->finshed;
                    $include_series = $cate_data->include_series;
                    $include_sku = $cate_data->include_sku;
                    $exclude_series = $cate_data->exlude_series;
                    $exclude_sku = $cate_data->exlude_sku;
                }
                //------ Deleting existing data -----------
                $delete = $this->db->delete('tbl_products', array('category_id' => $category_id));
            }
        }
        $minimum_cost = $this->db->get_where('tbl_minimum_cost', array())->row();
        if ($finished) {
            $filter = json_encode(["Orderable", "OnPriceList", "Finished"]);
        } else {
            $filter = json_encode(["Orderable", "OnPriceList"]);
        }
        if ($type == 1) {
            $key = 'CategoryIds';
        } else if ($type == 2) {
            $key = 'Series';
        } else {
            $key = 'SKU';
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
            'exclude_series' => $exclude_series,
            'exclude_sku' => $exclude_sku,
            'minimum_cost' => $minimum_cost->cost,
            'key' => $key,
            'is_quick' => $is_quick,
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
                $exclude_series = json_decode($receive['exclude_series'], true);
                $exclude_sku = json_decode($receive['exclude_sku'], true);
                foreach ($result_da->Products as $prod) {
                    //----- exclude series ------ 
                    if (!empty($exclude_series) && in_array($prod->DescriptiveElementGroup->DescriptiveElements[0]->Value, $exclude_series)) {
                        continue;
                    }
                    //----- exclude sku ------ 
                    if (!empty($exclude_sku) && in_array($prod->SKU, $exclude_sku)) {
                        continue;
                    }
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
            'is_quick' => $receive['is_quick'] ? $receive['is_quick'] : null,
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
    //============================= START PRODUCT CRON JOB ==========================
    public function products_cron_jobs()
    {
        date_default_timezone_set("Asia/Calcutta");
        $start_date = date("Y-m-d H:i:s");
        $cron_jobs = $this->db->order_by('id', 'ASC')->get_where('tbl_cron_jobs', array('status' => 0))->row();
        if (!empty($cron_jobs)) {
            //------ update cron job status to started --------
            $data_insert = array('status' => 1, 'start_time' => $start_date);
            $this->db->where('id', $cron_jobs->id);
            $last_id = $this->db->update('tbl_cron_jobs', $data_insert);
            $send = [
                'category_id' => $cron_jobs->cat_id,
                'subcategory_id' => $cron_jobs->subcat_id,
                'minor_category_id' => $cron_jobs->mincat_id1,
                'minor2_category_id' => $cron_jobs->mincat_id2,
                'is_quick' => $cron_jobs->is_quick,
            ];
            $res = $this->fetch_product($send);
            date_default_timezone_set("Asia/Calcutta");
            $end_data = date("Y-m-d H:i:s");
            //------ update cron job status to completed --------
            $data_insert2 = array('status' => 2, 'end_time' => $end_data, 'total_products' => $res['total_products'], 'inserted_products' => $res['inserted_products']);
            $this->db->where('id', $cron_jobs->id);
            $last_id2 = $this->db->update('tbl_cron_jobs', $data_insert2);
            $rep = array(
                'status' => 200,
                'message' => 'Data inserted successfully'
            );
            echo json_encode($rep);
        }
    }
    //============================= END PRODUCT CRON JOB==========================
    //============================= START VIEW PRODUCT CRON JOB==========================
    public function view_cron_job($dev = 0)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name'] = $this->load->get_var('user_name');
            $this->db->select('*');
            $this->db->from('tbl_cron_jobs');
            $this->db->order_by('id', 'desc');
            $data['cron_jobs'] = $this->db->get();
            $data['dev'] = $dev;
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/products/view_cron_jobs');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    //============================= END VIEW PRODUCT CRON JOB==========================

    //============================= START GET AJAX SUBCATEGORY ==========================
    public function getSub_category()
    {
        if (!empty($this->session->userdata('admin_data'))) {
            // $data['user_name']=$this->load->get_var('user_name');
            $isl = $_GET['isl'];
            $this->db->select('*');
            $this->db->from('tbl_sub_category');
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
            $this->db->from('tbl_minisubcategory');
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
            // $data['user_name']=$this->load->get_var('user_name');
            $isl = $_GET['isl'];
            $this->db->select('*');
            $this->db->from('tbl_minisubcategory2');
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
    //============================= START GET AJAX STONE FAMILY ==========================
    public function GetStoneFamily()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('modelID', 'modelID', 'required|xss_clean|trim');
            $this->form_validation->set_rules('groupName', 'groupName', 'required|xss_clean|trim');
            $this->form_validation->set_rules('LocationNumber', 'LocationNumber', 'required|xss_clean|trim');
            $this->form_validation->set_rules('size', 'size', 'required|xss_clean|trim');
            $this->form_validation->set_rules('count', 'count', 'xss_clean|trim');
            if ($this->form_validation->run() == true) {
                $modelID = $this->input->post('modelID');
                $groupName = $this->input->post('groupName');
                $LocationNumber = $this->input->post('LocationNumber');
                $size = $this->input->post('size');
                $count = $this->input->post('count');
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.stuller.com/v2/products/stonefamilies',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => '{"ConfigurationModelId":' . $modelID . ',"StoneGroups":["' . $groupName . '"]}',
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: Basic ZGV2amV3ZWw6Q29kaW5nMjA9',
                        'Content-Type: application/json',
                        'Host: api.stuller.com',
                    ),
                ));

                $response = curl_exec($curl);
                curl_close($curl);
                $res = json_decode($response);
                $html = "<div class='w-100 text-right'><button onclick='stonesListBtn()' class='btn' style='border-color: #797979;'>Back</button></div>";
                if ($count > 1) {
                    $html .= '<h6 class="mt-3" style="border-bottom:1px solid grey">' . $groupName . ' ' . $size . '  <span style="font-size:13px">(' . $count . ' stones)</span></h6>';
                } else {
                    $html .= '<h6 class="mt-3" style="border-bottom:1px solid grey">' . $groupName . ' ' . $size . '</h6>';
                }
                $html .= '<div class="row mt-3">';
                foreach ($res->StoneFamilies as $item) {
                    $categoriesToRemove = ["Imitation", "Natural"];
                    $filteredCategories = array_diff($item->Categories, $categoriesToRemove);
                    if (count($filteredCategories) > 0) {
                        $img = base_url() . 'assets/jewel/img/gemstone/' . strtolower($item->Name) . '.jpg';
                        $html .= '<div class="col-md-3" onclick="showStoneType(this)" data-modelID="' . $modelID . '" data-groupName="' . $groupName . '" data-size="' . $size . '" data-name="' . $item->Name . '" data-image="' . $img . '" data-LocationNumber="' . $LocationNumber . '" data-category=\'' . json_encode($item->Categories) . '\'><div class="text-center" style="cursor: pointer;"><img src="' . $img . '" style="width:60px;height:60px"><p>' . $item->Name . '</p></div></div>';
                    }
                }
                $html .= '</div>';

                $html2 = "<div class='w-100 text-right'><button onclick='sideStonesListBtn()' class='btn' style='border-color: #797979;'>Back</button></div>";
                $html2 .= '<h6 class="mt-3" style="border-bottom:1px solid grey">For Side Stone</h6>';
                $html2 .= '<div class="row mt-3">';
                foreach ($res->StoneFamilies as $item) {
                    $categoriesToRemove = ["Imitation", "Natural"];
                    $filteredCategories = array_diff($item->Categories, $categoriesToRemove);
                    if (count($filteredCategories) > 0) {
                        $img = base_url() . 'assets/jewel/img/gemstone/' . strtolower($item->Name) . '.jpg';
                        $html2 .= '<div class="col-md-3" onclick="configureProduct(this)" data-modelID="' . $modelID . '" data-groupName="' . $groupName . '" data-size="' . $size . '" data-name="' . $item->Name . '" data-image="' . $img . '" data-LocationNumber="' . $LocationNumber . '" data-category=\'' . json_encode($item->Categories) . '\'><div class="text-center" style="cursor: pointer;"><img src="' . $img . '" style="width:60px;height:60px"><p>' . $item->Name . '</p></div></div>';
                    }
                }
                $html2 .= '</div>';
                echo json_encode(['status' => 200, 'data' => $html, 'html2' => $html2]);
            } else {
                $res = array(
                    'message' => validation_errors(),
                    'status' => 201
                );
                echo json_encode($res);
            }
        } else {
            $res = array(
                'message' => 'Please insert some data, No data available',
                'status' => 201
            );
            echo json_encode($res);
        }
    }
    //============================= START GET AJAX STONE FAMILY ==========================
    //============================= START GET AJAX SEARCH STONE ==========================
    public function SearchStone()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('modelID', 'modelID', 'required|xss_clean|trim');
            $this->form_validation->set_rules('LocationNumber', 'LocationNumber', 'required|xss_clean|trim');
            $this->form_validation->set_rules('StoneFamilyName', 'StoneFamilyName', 'required|xss_clean|trim');
            $this->form_validation->set_rules('stoneCategory', 'stoneCategory', 'required|xss_clean|trim');
            if ($this->form_validation->run() == true) {
                $modelID = $this->input->post('modelID');
                $LocationNumber = $this->input->post('LocationNumber');
                $StoneFamilyName = $this->input->post('StoneFamilyName');
                $stoneCategory = $this->input->post('stoneCategory');
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.stuller.com/v2/products/searchstones',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => '{"ConfigurationModelId":' . $modelID . ',"LocationNumbers":[' . $LocationNumber . '],"StoneFamilyName":"' . $StoneFamilyName . '","StoneCategories":["' . $stoneCategory . '"]}',
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: Basic ZGV2amV3ZWw6Q29kaW5nMjA9',
                        'Content-Type: application/json',
                        'Host: api.stuller.com',
                    ),
                ));

                $response = curl_exec($curl);
                curl_close($curl);
                $res = json_decode($response);
                $data = $res->ConfiguredStones;
                $count = count($data);
                $html = "<div class='w-100 text-right'><button onclick='setStonesTableBtn()' class='btn' style='border-color: #797979;'>Back</button></div>";
                $html .= '<h6 class="mt-3">Results - ' . $stoneCategory . ' (' . $count . ')</h6>';

                $html .= '<div class="row mt-3">';
                $html .= '<div class="table-responsive" style="height: 400px !important;
                overflow: scroll;">';
                $html .= '<table class="table table-hover table-sm" id="stoneDataTable">';
                if (!empty($data)) {
                    $html .= '<thead style="position:sticky;top: 0;background-color:white"><tr>';
                    $headings = $data[0]->Product->DescriptiveElementGroup->DescriptiveElements;
                    foreach ($headings as $head) {
                        $html .= '<th scope="col">' . $head->Name . '</th>';
                    }
                    $html .= '<th scope="col"></th>';
                    $html .= '</tr></thead>';
                    $html .= '<tbody>';
                    foreach ($data as $item) {
                        $html .= '<tr> ';
                        $values = $item->Product->DescriptiveElementGroup->DescriptiveElements;
                        foreach ($values as $v) {
                            $html .= '<td>' . $v->DisplayValue . '</td>';
                        }

                        $html .= '<td><button type="button" data-stoneId="' . $item->Product->Id . '" data-StoneFamilyName="' . $StoneFamilyName . '" data-stoneCategory="' . $stoneCategory . '" data-LocationNumber="' . $LocationNumber . '" class="btn btn-info" onClick="AskSideStone(this)">Set</button></td>';
                        $html .= '</tr>';
                    }
                    $html .= '</tbody>';
                }
                $html .= ' </table>';
                $html .= '</div>';
                $html .= '</div>';
                $html .= '<script>
                jQuery.noConflict();
                $(document).ready(function() {
                    $("#stoneDataTable").DataTable();
                });
                </script>';
                echo json_encode(['status' => 200, 'data' => $html]);
            } else {
                $res = array(
                    'message' => validation_errors(),
                    'status' => 201
                );
                echo json_encode($res);
            }
        } else {
            $res = array(
                'message' => 'Please insert some data, No data available',
                'status' => 201
            );
            echo json_encode($res);
        }
    }
    //============================= START GET AJAX AJAX SEARCH STONE ==========================
    //============================= START GET AJAX SET STONE ==========================
    public function configureProduct()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('ProductId', 'ProductId', 'required|xss_clean|trim');
            $this->form_validation->set_rules('StoneProductId', 'StoneProductId', 'required|xss_clean|trim');
            $this->form_validation->set_rules('RingSize', 'RingSize', 'required|xss_clean|trim');
            $this->form_validation->set_rules('StoneFamilyName', 'StoneFamilyName', 'required|xss_clean|trim');
            $this->form_validation->set_rules('stoneCategory', 'stoneCategory', 'required|xss_clean|trim');
            $this->form_validation->set_rules('LocationNumber', 'LocationNumber', 'required|xss_clean|trim');
            $this->form_validation->set_rules('sideName', 'sideName', 'required|xss_clean|trim');
            if ($this->form_validation->run() == true) {
                $ProductId = $this->input->post('ProductId');
                $StoneProductId = $this->input->post('StoneProductId');
                $RingSize = $this->input->post('RingSize');
                $StoneFamilyName = $this->input->post('StoneFamilyName');
                $stoneCategory = $this->input->post('stoneCategory');
                $LocationNumber = $this->input->post('LocationNumber');
                $sideName = $this->input->post('sideName');
                //----------------- Get all location of the product--------
                $pro_data = $this->db->get_where('tbl_products', array('pro_id' => $ProductId))->row();
                $final_arr = [];
                $setting_options = json_decode($pro_data->setting_options);
                foreach ($setting_options as $st) {
                    if ($st->LocationNumber != $LocationNumber) {
                        $SF = $sideName;
                    } else {
                        $SF = $StoneFamilyName;
                    }
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://api.stuller.com/v2/products/searchstones',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => '{"ConfigurationModelId":' . $pro_data->config_model_id . ',"LocationNumbers":[' . $st->LocationNumber . '],"StoneFamilyName":"' . $SF . '","StoneCategories":["' . $stoneCategory . '"]}',
                        CURLOPT_HTTPHEADER => array(
                            'Authorization: Basic ZGV2amV3ZWw6Q29kaW5nMjA9',
                            'Content-Type: application/json',
                            'Host: api.stuller.com',
                        ),
                    ));

                    $response = curl_exec($curl);
                    curl_close($curl);
                    $res = json_decode($response);
                    $SP = $res->ConfiguredStones[0]->Product->Id;
                    if ($st->LocationNumber != $LocationNumber) {
                        $final_arr[] = ['LocationNumber' => $st->LocationNumber, 'StoneProductId' => $SP];
                    } else {
                        $final_arr[] = ['LocationNumber' => $LocationNumber, 'StoneProductId' => $StoneProductId];
                    }
                }
                $final_arr = json_encode($final_arr);
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.stuller.com/v2/products/configureproduct',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => '{"ProductId":' . $ProductId . ',"Quantity":1,"Stones":' . $final_arr . ',"RingSize":7.0}}',
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: Basic ZGV2amV3ZWw6Q29kaW5nMjA9',
                        'Content-Type: application/json',
                        'Host: api.stuller.com',
                    ),
                ));

                $response = curl_exec($curl);
                curl_close($curl);
                $res = json_decode($response);
                $html = '<h6 class="mt-3">' . $res->Product->GroupDescription . '</h6>';
                $html .= '<div class="table-responsive-sm">';
                $html .= '<table class="table table-hover"><tbody>';
                $html .= '<tr>';
                $html .= '<td style="text-align: left;padding: 8px; vertical-align: -webkit-baseline-middle;">' . $res->Product->CenterStoneShape . '</td>';
                $html .= '<td style="text-align: left;padding: 8px; vertical-align: -webkit-baseline-middle;">' . $res->Product->CenterStoneSize . '</td>';
                $html .= '<td style="text-align: left;padding: 8px; vertical-align: -webkit-baseline-middle;"><button class="btn btn-danger" onClick="ResetStone()">Reset</button></td>';
                $html .= '</tr></tbody></table></div>';
                //---------- Calculate pricing ----------
                // $pro_price = $res->Product->ShowcasePrice->Value + $res->RingSizingShowcasePrice->Value + $res->PolishingShowcasePrice->Value;
                // $stone_price = 0;
                // foreach ($res->Stones as $st) {
                //     $stone_price += ($st->TotalShowcasePrice->Value + $st->ShowcaseLabor->Value);
                // }
                $pr_data = $this->db->get_where('tbl_price_rule', array())->row();
                $multiplier = $pr_data->multiplier;
                $cost_price = $res->TotalShowcasePrice->Value;
                $retail =  round($cost_price * $multiplier, 2);
                $final_price = $cost_price;
                if ($cost_price <= 500) {
                    $cost_price2 = $cost_price * $cost_price;
                    $number = round($cost_price * ($pr_data->cost_price1 * $cost_price2 + $pr_data->cost_price2 * $cost_price + $pr_data->cost_price3), 2);
                    $unit = 5;
                    $remainder = $number % $unit;
                    $mround = ($remainder < $unit / 2) ? $number - $remainder : $number + ($unit - $remainder);
                    $final_price = round($mround) - 1 + 0.95;
                } else if ($cost_price > 500) {
                    $number = round($cost_price * ($pr_data->cost_price4 * $cost_price / $multiplier + $pr_data->cost_price5));
                    $unit = 5;
                    $remainder = $number % $unit;
                    $mround = ($remainder < $unit / 2) ? $number - $remainder : $number + ($unit - $remainder);
                    $final_price = round($mround) - 1 + 0.95;
                }
                $saved = round($retail - $final_price, 2);
                // $dis_percent = round($saved / $retail * 100,2);

                $html .= '<div class="price-summary col-md-8 float-right">
                <div class="price-item">
                    <span class="item-label">Retail Price:</span>
                    <span class="item-value">$' . $retail . '</span>
                </div>
                <div class="price-item">
                    <span class="item-label">You Saved:</span>
                    <span class="item-value" style="color:green">$' . $saved . '</span>
                </div>
                <div class="price-item">
                    <span class="item-label">Now Price:</span>
                    <span class="item-value">$' . $final_price . '</span>
                </div>
            </div>';

                echo json_encode(['status' => 200, 'data' => $res->Images[0]->ZoomUrl, 'html' => $html]);
            } else {
                $res = array(
                    'message' => validation_errors(),
                    'status' => 201
                );
                echo json_encode($res);
            }
        } else {
            $res = array(
                'message' => 'Please insert some data, No data available',
                'status' => 201
            );
            echo json_encode($res);
        }
    }
    //============================= START SET STONE ==========================
}
