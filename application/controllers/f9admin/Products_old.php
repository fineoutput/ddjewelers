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
    //view category start
    public function view_category()
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name'] = $this->load->get_var('user_name');
            // echo SITE_NAME;
            // echo $this->session->userdata('image');
            // echo $this->session->userdata('position');
            // exit;
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
    //view category end
    //view subcategory start
    public function view_sub_category($idd)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $id = base64_decode($idd);
            $data['cate_id'] = $idd;
            $data['user_name'] = $this->load->get_var('user_name');
            // echo SITE_NAME;
            // echo $this->session->userdata('image');
            // echo $this->session->userdata('position');
            // exit;
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
    //view subcategory end
    //view minorsubcategory start
    public function view_minisubcategory($idd)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $id = base64_decode($idd);
            $data['subcate_id'] = $idd;
            $data['user_name'] = $this->load->get_var('user_name');
            // echo SITE_NAME;
            // echo $this->session->userdata('image');
            // echo $this->session->userdata('position');
            // exit;
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
    //view minorsubcategory end
    //view minorsubcategory2 start
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
    //view minorsubcategory2 end
    public function view_products($idd, $page)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name'] = $this->load->get_var('user_name');
            // echo SITE_NAME;
            // echo $this->session->userdata('image');
            // echo $this->session->userdata('position');
            // exit;
            $id = base64_decode($idd);
            $page_dec = base64_decode($page);
            $data['page'] = $page;
            if ($page_dec == 3) {
                $data['cate_id'] = $idd;
                $this->db->select('*');
                $this->db->from('tbl_products');
                $this->db->where('category', $id);
                $data['products_data'] = $this->db->get();
            } elseif ($page_dec == 0) {
                $data['subcate_id'] = $idd;
                $this->db->select('*');
                $this->db->from('tbl_products');
                $this->db->where('sub_category', $id);
                $data['products_data'] = $this->db->get();
            } elseif ($page_dec == 1) {
                $data['minorsubcate_id'] = $idd;
                $this->db->select('*');
                $this->db->from('tbl_products');
                $this->db->where('minisub_category', $id);
                $data['products_data'] = $this->db->get();
            } else {
                $data['minorsubcate2_id'] = $idd;
                $this->db->select('*');
                $this->db->from('tbl_products');
                $this->db->where('minisub_category2', $id);
                $data['products_data'] = $this->db->get();
            }
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/products/view_products');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    public function add_products()
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $this->db->select('*');
            $this->db->from('tbl_category');
            //$this->db->where('',);
            $data['category'] = $this->db->get();
            // $this->db->select('*');
            // $this->db->from('tbl_vendor');
            // //$this->db->where('',);
            // $data['vendor']= $this->db->get();
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/products/add_products');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    public function update_productss($idd)
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
            $this->db->from('tbl_products');
            $this->db->where('id', $id);
            $data['products_data'] = $this->db->get()->row();
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/products/update_productss');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    public function product_details($idd)
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
    //In this method  add products  in the table using third party stuller api and update products
    public function add_products_data($t, $iw = "")
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->helper('security');
            if ($this->input->post()) {
                // print_r($this->input->post());
                // exit;
                // $this->form_validation->set_rules('product_name', 'product_name', 'required|xss_clean|trim');
                $this->form_validation->set_rules('category', 'category', 'required|xss_clean|trim');
                $this->form_validation->set_rules('sub_category', 'sub_category', 'xss_clean|trim');
                $this->form_validation->set_rules('minisubcategory', 'minisubcategory', 'xss_clean|trim');
                $this->form_validation->set_rules('minisubcategory2', 'minisubcategory2', 'xss_clean|trim');
                // $this->form_validation->set_rules('vendor', 'vendor', 'xss_clean|trim');
                if ($this->form_validation->run() == true) {
                    // $product_name=$this->input->post('product_name');
                    $category = $this->input->post('category');
                    $sub_category = $this->input->post('sub_category');
                    $minisubcategory = $this->input->post('minisubcategory');
                    $minisubcategory2 = $this->input->post('minisubcategory2');
                    // $vendor=$this->input->post('vendor');
                    $ip = $this->input->ip_address();
                    date_default_timezone_set("Asia/Calcutta");
                    $cur_date = date("Y-m-d H:i:s");
                    $addedby = $this->session->userdata('admin_id');
                    $typ = base64_decode($t);
                    $last_id = 0;
                    if ($typ == 1) {
                        $api_id = 0;
                        if ($category != 0) {
                            $this->db->select('*');
                            $this->db->from('tbl_category');
                            $this->db->where('id', $category);
                            $catedata = $this->db->get()->row();
                            if (!empty($catedata)) {
                                $api_id = $catedata->api_id;
                                $type = $catedata->type;
                                $finshed = $catedata->finshed;
                                $include_series = $catedata->include_series;
                                $include_sku = $catedata->include_sku;
                            }
                        }
                        if ($sub_category != 0) {
                            $this->db->select('*');
                            $this->db->from('tbl_sub_category');
                            $this->db->where('id', $sub_category);
                            $subdata = $this->db->get()->row();
                            if (!empty($subdata)) {
                                $api_id = $subdata->api_id;
                                $type = $subdata->type;
                                $finshed = $subdata->finshed;
                                $include_series = $catedata->include_series;
                                $include_sku = $catedata->include_sku;
                            }
                        }
                        if ($minisubcategory != 0) {
                            $this->db->select('*');
                            $this->db->from('tbl_minisubcategory');
                            $this->db->where('id', $minisubcategory);
                            $minisubdata = $this->db->get()->row();
                            if (!empty($minisubdata)) {
                                $api_id = $minisubdata->api_id;
                                $type = $minisubdata->type;
                                $finshed = $minisubdata->finshed;
                                $include_series = $catedata->include_series;
                                $include_sku = $catedata->include_sku;
                            }
                        }
                        if ($minisubcategory2 != 0) {
                            $this->db->select('*');
                            $this->db->from('tbl_minisubcategory2');
                            $this->db->where('id', $minisubcategory2);
                            $minisub2data = $this->db->get()->row();
                            if (!empty($minisub2data)) {
                                $api_id = $minisub2data->api_id;
                                $type = $minisub2data->type;
                                $finshed = $minisub2data->finshed;
                                $include_series = $catedata->include_series;
                                $include_sku = $catedata->include_sku;
                            }
                        }
                        // echo $catedata->api_id;
                        // echo "<br>";
                        // echo $subdata->api_id;
                        // echo "<br>";
                        //
                        // echo $minisubdata->api_id;
                        // echo "<br>";
                        //
                        // echo $minisub2data->api_id;
                        // exit;
                        $api_id = json_decode($api_id);
                        if ($api_id != 0) {
                            //stuller api fuction call
                            $last_id = $this->stuller_data($api_id, $category, $sub_category, $minisubcategory, $minisubcategory2, $type, $finshed);
                            if (!empty($include_series)) {
                                $includeSeries = explode(",", $include_series);
                                if (count($includeSeries) > 0) {
                                    $last_id = $this->stuller_data($includeSeries, $category, $sub_category, $minisubcategory, $minisubcategory2, 2, $finshed, 0);
                                }
                                //    $last_id2= $this->include_serieswise($apis2, $category, $sub_category, $minisubcategory, $minisubcategory2, $type, $finshed);
                            }
                            if (!empty($include_sku)) {
                                $includeSKU = explode(",", $include_sku);
                                if (count($includeSKU) > 0) {
                                    $last_id = $this->stuller_data($includeSKU, $category, $sub_category, $minisubcategory, $minisubcategory2, 3, $finshed, 0);
                                }
                                //    $last_id2= $this->include_serieswise($apis2, $category, $sub_category, $minisubcategory, $minisubcategory2, $type, $finshed);
                            }
                        } else {
                            $this->session->set_flashdata('emessage', 'Api Id not found.');
                            redirect($_SERVER['HTTP_REFERER']);
                        }
                    }
                    if ($typ == 2) {
                        $idw = base64_decode($iw);
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->where('id', $idw);
                        $dsa = $this->db->get();
                        $da = $dsa->row();
                        $img5 = 'image1';
                        $file_check = ($_FILES['image1']['error']);
                        if ($file_check != 4) {
                            $image_upload_folder = FCPATH . "assets/uploads/products/";
                            if (!file_exists($image_upload_folder)) {
                                mkdir($image_upload_folder, DIR_WRITE_MODE, true);
                            }
                            $new_file_name = "products" . date("Ymdhms");
                            $this->upload_config = array(
                                'upload_path'   => $image_upload_folder,
                                'file_name' => $new_file_name,
                                'allowed_types' => 'xlsx|csv|xls|pdf|doc|docx|txt|jpg|jpeg|png',
                                'max_size'      => 25000
                            );
                            $this->upload->initialize($this->upload_config);
                            if (!$this->upload->do_upload($img5)) {
                                $upload_error = $this->upload->display_errors();
                                // echo json_encode($upload_error);
                                //$this->session->set_flashdata('emessage',$upload_error);
                                //redirect($_SERVER['HTTP_REFERER']);
                            } else {
                                $file_info = $this->upload->data();
                                $videoNAmePath = "assets/uploads/products/" . $new_file_name . $file_info['file_ext'];
                                $file_info['new_name'] = $videoNAmePath;
                                // $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
                                $nnnn = $file_info['file_name'];
                                $nnnn5 = $videoNAmePath;
                                // echo json_encode($file_info);
                            }
                        }
                        $img6 = 'image2';
                        $file_check = ($_FILES['image2']['error']);
                        if ($file_check != 4) {
                            $image_upload_folder = FCPATH . "assets/uploads/products/";
                            if (!file_exists($image_upload_folder)) {
                                mkdir($image_upload_folder, DIR_WRITE_MODE, true);
                            }
                            $new_file_name = "products" . date("Ymdhms");
                            $this->upload_config = array(
                                'upload_path'   => $image_upload_folder,
                                'file_name' => $new_file_name,
                                'allowed_types' => 'xlsx|csv|xls|pdf|doc|docx|txt|jpg|jpeg|png',
                                'max_size'      => 25000
                            );
                            $this->upload->initialize($this->upload_config);
                            if (!$this->upload->do_upload($img6)) {
                                $upload_error = $this->upload->display_errors();
                                // echo json_encode($upload_error);
                                //$this->session->set_flashdata('emessage',$upload_error);
                                //redirect($_SERVER['HTTP_REFERER']);
                            } else {
                                $file_info = $this->upload->data();
                                $videoNAmePath = "assets/uploads/products/" . $new_file_name . $file_info['file_ext'];
                                $file_info['new_name'] = $videoNAmePath;
                                // $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
                                $nnnn = $file_info['file_name'];
                                $nnnn6 = $videoNAmePath;
                                // echo json_encode($file_info);
                            }
                        }
                        $img7 = 'image3';
                        $file_check = ($_FILES['image3']['error']);
                        if ($file_check != 4) {
                            $image_upload_folder = FCPATH . "assets/uploads/products/";
                            if (!file_exists($image_upload_folder)) {
                                mkdir($image_upload_folder, DIR_WRITE_MODE, true);
                            }
                            $new_file_name = "products" . date("Ymdhms");
                            $this->upload_config = array(
                                'upload_path'   => $image_upload_folder,
                                'file_name' => $new_file_name,
                                'allowed_types' => 'xlsx|csv|xls|pdf|doc|docx|txt|jpg|jpeg|png',
                                'max_size'      => 25000
                            );
                            $this->upload->initialize($this->upload_config);
                            if (!$this->upload->do_upload($img7)) {
                                $upload_error = $this->upload->display_errors();
                                // echo json_encode($upload_error);
                                //$this->session->set_flashdata('emessage',$upload_error);
                                //redirect($_SERVER['HTTP_REFERER']);
                            } else {
                                $file_info = $this->upload->data();
                                $videoNAmePath = "assets/uploads/products/" . $new_file_name . $file_info['file_ext'];
                                $file_info['new_name'] = $videoNAmePath;
                                // $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
                                $nnnn = $file_info['file_name'];
                                $nnnn7 = $videoNAmePath;
                                // echo json_encode($file_info);
                            }
                        }
                        // $img8='image4';
                        //
                        //
                        //            $file_check=($_FILES['image4']['error']);
                        // if($file_check!=4){
                        //
                        //          $image_upload_folder = FCPATH . "assets/uploads/products/";
                        //                      if (!file_exists($image_upload_folder))
                        //                      {
                        //                          mkdir($image_upload_folder, DIR_WRITE_MODE, true);
                        //                      }
                        //                      $new_file_name="products".date("Ymdhms");
                        //                      $this->upload_config = array(
                        //                              'upload_path'   => $image_upload_folder,
                        //                              'file_name' => $new_file_name,
                        //                              'allowed_types' =>'xlsx|csv|xls|pdf|doc|docx|txt|jpg|jpeg|png',
                        //                              'max_size'      => 25000
                        //                      );
                        //                      $this->upload->initialize($this->upload_config);
                        //                      if (!$this->upload->do_upload($img8))
                        //                      {
                        //                          $upload_error = $this->upload->display_errors();
                        //                          // echo json_encode($upload_error);
                        //
                        //            //$this->session->set_flashdata('emessage',$upload_error);
                        //              //redirect($_SERVER['HTTP_REFERER']);
                        //                      }
                        //                      else
                        //                      {
                        //
                        //                          $file_info = $this->upload->data();
                        //
                        //                          $videoNAmePath = "assets/uploads/products/".$new_file_name.$file_info['file_ext'];
                        //                          $file_info['new_name']=$videoNAmePath;
                        //                          // $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
                        //                          $nnnn=$file_info['file_name'];
                        //                          $nnnn8=$videoNAmePath;
                        //
                        //                          // echo json_encode($file_info);
                        //                      }
                        //         }
                        //
                        //
                        //
                        // $img9='image5';
                        //
                        //
                        //            $file_check=($_FILES['image5']['error']);
                        // if($file_check!=4){
                        //
                        //          $image_upload_folder = FCPATH . "assets/uploads/products/";
                        //                      if (!file_exists($image_upload_folder))
                        //                      {
                        //                          mkdir($image_upload_folder, DIR_WRITE_MODE, true);
                        //                      }
                        //                      $new_file_name="products".date("Ymdhms");
                        //                      $this->upload_config = array(
                        //                              'upload_path'   => $image_upload_folder,
                        //                              'file_name' => $new_file_name,
                        //                              'allowed_types' =>'xlsx|csv|xls|pdf|doc|docx|txt|jpg|jpeg|png',
                        //                              'max_size'      => 25000
                        //                      );
                        //                      $this->upload->initialize($this->upload_config);
                        //                      if (!$this->upload->do_upload($img9))
                        //                      {
                        //                          $upload_error = $this->upload->display_errors();
                        //                          // echo json_encode($upload_error);
                        //
                        //            //$this->session->set_flashdata('emessage',$upload_error);
                        //              //redirect($_SERVER['HTTP_REFERER']);
                        //                      }
                        //                      else
                        //                      {
                        //
                        //                          $file_info = $this->upload->data();
                        //
                        //                          $videoNAmePath = "assets/uploads/products/".$new_file_name.$file_info['file_ext'];
                        //                          $file_info['new_name']=$videoNAmePath;
                        //                          // $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
                        //                          $nnnn=$file_info['file_name'];
                        //                          $nnnn9=$videoNAmePath;
                        //
                        //                          // echo json_encode($file_info);
                        //                      }
                        //         }
                        if (!empty($da)) {
                            $img = $da->image1;
                            if (!empty($img)) {
                                if (empty($nnnn5)) {
                                    $nnnn5 = $img;
                                }
                            } else {
                                if (empty($nnnn5)) {
                                    $nnnn5 = "";
                                }
                            }
                        }
                        if (!empty($da)) {
                            $img = $da->image2;
                            if (!empty($img)) {
                                if (empty($nnnn6)) {
                                    $nnnn6 = $img;
                                }
                            } else {
                                if (empty($nnnn6)) {
                                    $nnnn6 = "";
                                }
                            }
                        }
                        if (!empty($da)) {
                            $img = $da->image3;
                            if (!empty($img)) {
                                if (empty($nnnn7)) {
                                    $nnnn7 = $img;
                                }
                            } else {
                                if (empty($nnnn7)) {
                                    $nnnn7 = "";
                                }
                            }
                        }
                        // if(!empty($da)){ $img = $da ->image4;
                        // if(!empty($img)) { if(empty($nnnn8)){ $nnnn8 = $img; } }else{ if(empty($nnnn8)){ $nnnn8= ""; } } }if(!empty($da)){ $img = $da ->image5;
                        // if(!empty($img)) { if(empty($nnnn9)){ $nnnn9 = $img; } }else{ if(empty($nnnn9)){ $nnnn9= ""; } } }
                        $data_insert = array(
                            'product_name' => $product_name,
                            'category' => $category,
                            'sub_category' => $sub_category,
                            'minisub_category' => $minisubcategory,
                            'minisub_category2' => $minisubcategory2,
                            'sdesc' => $sdesc,
                            'ldesc' => $ldesc,
                            'image1' => $nnnn5,
                            'image2' => $nnnn6,
                            'image3' => $nnnn7,
                            // 'image4'=>$nnnn8,
                            // 'image5'=>$nnnn9,
                        );
                        $this->db->where('id', $idw);
                        $last_id = $this->db->update('tbl_products', $data_insert);
                    }
                    if ($last_id != 0) {
                        if (!empty($minisubcategory)) {
                            if (empty($minisubcategory2)) {
                                $minisub = base64_encode($minisubcategory);
                                $page = base64_encode(1);
                                $this->session->set_flashdata('smessage', 'Data inserted successfully');
                                redirect("dcadmin/products/view_products/" . $minisub . "/" . $page, "refresh");
                            } else {
                                $minisub2 = base64_encode($minisubcategory2);
                                $page = base64_encode(2);
                                $this->session->set_flashdata('smessage', 'Data inserted successfully');
                                redirect("dcadmin/products/view_products/" . $minisub2 . "/" . $page, "refresh");
                            }
                        } else {
                            if (!empty($sub_category)) {
                                $sub = base64_encode($sub_category);
                                $page = base64_encode(0);
                                $this->session->set_flashdata('smessage', 'Data inserted successfully');
                                redirect("dcadmin/products/view_products/" . $sub . "/" . $page, "refresh");
                            } else {
                                $cate = base64_encode($category);
                                $page = base64_encode(3);
                                $this->session->set_flashdata('smessage', 'Data inserted successfully');
                                redirect("dcadmin/products/view_products/" . $cate . "/" . $page, "refresh");
                            }
                        }
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
    public function updateproductsStatus($idd, $t)
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
                $zapak = $this->db->update('tbl_products', $data_update);
                if ($zapak != 0) {
                    redirect("dcadmin/products/view_products", "refresh");
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
                $zapak = $this->db->update('tbl_products', $data_update);
                if ($zapak != 0) {
                    redirect("dcadmin/products/view_products", "refresh");
                } else {
                    $this->session->set_flashdata('emessage', 'Sorry error occured');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            }
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    public function delete_products($idd)
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
                $this->db->from('tbl_products');
                $this->db->where('id', $id);
                $dsa = $this->db->get();
                $da = $dsa->row();
                $img = $da->image;
                $zapak = $this->db->delete('tbl_products', array('id' => $id));
                if ($zapak != 0) {
                    $path = FCPATH . $img;
                    unlink($path);
                    redirect("dcadmin/products/view_products", "refresh");
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
    //test calling function route for  add data from stuller api
    public function call()
    {
        return $this->stuller_data(27268, 1, 2);
    }
    //main function for  add data from stuller api
    public function stuller_data($api_id, $category_id, $subcategory, $minorsub = null, $minorsub2 = null, $type = null, $finshed = 0, $delete = 1)
    {
        // echo $minorsub2;
        ini_set('memory_limit', '3000M');
        $ip = $this->input->ip_address();
        date_default_timezone_set("Asia/Calcutta");
        $cur_date = date("Y-m-d H:i:s");
        $addedby = $this->session->userdata('admin_id');
        $total_pages = 0;
        //get count of total number of products start
        $url = 'https://api.stuller.com/v2/products';
        $this->db->select('*');
        $this->db->from('tbl_minimum_cost');
        $minimum_cost_data = $this->db->get()->row();
        $MINIMUM_COST = $minimum_cost_data->cost;
        //check furnished
        // $this->db->select('*');
        //           $this->db->from('tbl_category');
        //           $this->db->where('id',$category_id);
        //           $data_check= $this->db->get()->row();
        // echo $minorsub;
        // $api_ids=explode(",",$api_id);
        $api_ids = $api_id;
        // print_r($api_ids);
        // exit;
        $else = 0;
        $del = 1;
        foreach ($api_ids as  $value) {
            if (empty($minorsub)) {
                if (empty($subcategory)) {
                    if ($del == 1) {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->where('category', $category_id);
                        $this->db->where('sub_category  IS NULL', null);
                        // $this->db->where('minisub_category IS NULL' ,NULL);
                        $product_data = $this->db->get();
                        if (!empty($product_data && $delete == 1)) {
                            foreach ($product_data->result() as $pro) {
                                $this->db->delete('tbl_products', array('id' => $pro->id));
                            }
                        }
                    }
                    // echo $type;die();
                    if ($type == 1 || $type == "") {
                        if ($finshed == 1) {
                            // die();
                            $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList","Finished"],"CategoryIds":["' . $value . '"]}';
                            // $data = '{"Filter":["Orderable","OnPriceList","Finished"],"Series":["'.$api_id.'"]}';
                            // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"]}';
                        } else {
                            $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList"],"CategoryIds":["' . $value . '"]}';
                        }
                        $postdata = $data;
                        $header = array();
                        $header[] = 'Host:api.stuller.com';
                        $header[] = 'Content-Type:application/json';
                        $header[] = 'Authorization:Basic ZGV2amV3ZWw6Q29kaW5nMjA9';
                        $ch = curl_init($url);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                        $result = curl_exec($ch);
                        curl_close($ch);
                        // print_r ($result);
                        $result_da = json_decode($result);
                        // echo $result[0];
                        if (!empty($result_da)) {
                            $TotalNumberOfProducts = $result_da->TotalNumberOfProducts;
                            $total_pages = round($TotalNumberOfProducts / 500) + 1;
                        }
                        // echo $TotalNumberOfProducts;
                        // exit;
                        // foreach ($result_da->Products as $prod) {
                        // $specifications = [];
                        //   print_r($prod->Specifications);die();
                        // }
                        //get count of total number of products end
                        //category products adding
                        // echo $total_pages; die();
                        //delete previous data from the table start
                        $c_api = count($api_ids);
                        //delete previous data from the table end
                        //product data insert from the api start
                        $NextPage = "";
                        $else = 0;
                        for ($i = 0; $i < $total_pages; $i++) {
                            // code...
                            // echo $i;
                            $url = 'https://api.stuller.com/v2/products';
                            if ($type == 1 || $type == "") {
                                if ($finshed == 1) {
                                    if ($i == 0) {
                                        $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList","Finished"],"CategoryIds":["' . $value . '"]}';
                                        // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"]}';
                                    } else {
                                        $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList","Finished"],"CategoryIds":["' . $value . '"],"NextPage":"' . $NextPage . '" }';
                                        // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"],"NextPage":"'.$NextPage.'" }';
                                    }
                                } else {
                                    if ($i == 0) {
                                        $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList"],"CategoryIds":["' . $value . '"]}';
                                        // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"]}';
                                    } else {
                                        $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList"],"CategoryIds":["' . $value . '"],"NextPage":"' . $NextPage . '" }';
                                        // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"],"NextPage":"'.$NextPage.'" }';
                                    }
                                }
                                $postdata = $data;
                                $header = array();
                                $header[] = 'Host:api.stuller.com';
                                $header[] = 'Content-Type:application/json';
                                $header[] = 'Authorization:Basic ZGV2amV3ZWw6Q29kaW5nMjA9';
                                $ch = curl_init($url);
                                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                                curl_setopt($ch, CURLOPT_POST, 1);
                                curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                                curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                                $result = curl_exec($ch);
                                curl_close($ch);
                                $result_da = json_decode($result);
                                // echo "<pre>";
                                //
                                // echo "</pre>";
                                //
                                // echo $result_da->TotalNumberOfProducts;
                                // exit;
                                if (!empty($result_da)) {
                                    $specifications = [];
                                    // print_r($result_da);die();
                                    if (!empty($result_da->Products)) {
                                        foreach ($result_da->Products as $prod) {
                                            $ringsize = 0;
                                            $ringsizetype = "";
                                            $RingSizable = "";
                                            if (!empty($prod->RingSizable)) {
                                                $RingSizable = $prod->RingSizable;
                                                if ($RingSizable == false) {
                                                    $ringsize = 0;
                                                    $ringsizetype = "";
                                                } else {
                                                    if (!empty($prod->ringsize)) {
                                                        $ringsize = $prod->ringsize;
                                                    }
                                                    if (!empty($prod->ringsizetype)) {
                                                        $ringsizetype = $prod->ringsizetype;
                                                    }
                                                }
                                            }
                                            //group eliments
                                            if (empty($prod->DescriptiveElementGroup)) {
                                                $DescriptiveElements = [];
                                            } else {
                                                $DescriptiveElements = $prod->DescriptiveElementGroup->DescriptiveElements;
                                            }
                                            $cate_array_count = 0;
                                            if (!empty($DescriptiveElements)) {
                                                $cate_array_count = count($DescriptiveElements);
                                            }
                                            $desc_e_name1 = "";
                                            $desc_e_value1 = "";
                                            $desc_e_name2 = "";
                                            $desc_e_value2 = "";
                                            $desc_e_name3 = "";
                                            $desc_e_value3 = "";
                                            $desc_e_name4 = "";
                                            $desc_e_value4 = "";
                                            $desc_e_name5 = "";
                                            $desc_e_value5 = "";
                                            $desc_e_name6 = "";
                                            $desc_e_value6 = "";
                                            $desc_e_name7 = "";
                                            $desc_e_value7 = "";
                                            $desc_e_name8 = "";
                                            $desc_e_value8 = "";
                                            $desc_e_name9 = "";
                                            $desc_e_value9 = "";
                                            $desc_e_name10 = "";
                                            $desc_e_value10 = "";
                                            $desc_e_name11 = "";
                                            $desc_e_value11 = "";
                                            $desc_e_name12 = "";
                                            $desc_e_value12 = "";
                                            $desc_e_name13 = "";
                                            $desc_e_value13 = "";
                                            $desc_e_name14 = "";
                                            $desc_e_value14 = "";
                                            $desc_e_name15 = "";
                                            $desc_e_value15 = "";
                                            if ($cate_array_count >= 1) {
                                                $desc_e_name1 = $DescriptiveElements[0]->Name;
                                                // not replacing only X1 because Center Stone Size contains values like 07.00'X1'2.00
                                                $desc_e_value1 = str_replace("K X1", "K Forever", $DescriptiveElements[0]->DisplayValue);
                                            }
                                            if ($cate_array_count >= 2) {
                                                $desc_e_name2 = $DescriptiveElements[1]->Name;
                                                $desc_e_value2 = str_replace("K X1", "K Forever", $DescriptiveElements[1]->DisplayValue);
                                            }
                                            if ($cate_array_count >= 3) {
                                                $desc_e_name3 = $DescriptiveElements[2]->Name;
                                                $desc_e_value3 = str_replace("K X1", "K Forever", $DescriptiveElements[2]->DisplayValue);
                                            }
                                            if ($cate_array_count >= 4) {
                                                $desc_e_name4 = $DescriptiveElements[3]->Name;
                                                $desc_e_value4 = str_replace("K X1", "K Forever", $DescriptiveElements[3]->DisplayValue);
                                            }
                                            if ($cate_array_count >= 5) {
                                                $desc_e_name5 = $DescriptiveElements[4]->Name;
                                                $desc_e_value5 = str_replace("K X1", "K Forever", $DescriptiveElements[4]->DisplayValue);
                                            }
                                            if ($cate_array_count >= 6) {
                                                $desc_e_name6 = $DescriptiveElements[5]->Name;
                                                $desc_e_value6 = str_replace("K X1", "K Forever", $DescriptiveElements[5]->DisplayValue);
                                            }
                                            if ($cate_array_count >= 7) {
                                                $desc_e_name7 = $DescriptiveElements[6]->Name;
                                                $desc_e_value7 = str_replace("K X1", "K Forever", $DescriptiveElements[6]->DisplayValue);
                                            }
                                            if ($cate_array_count >= 8) {
                                                $desc_e_name8 = $DescriptiveElements[7]->Name;
                                                $desc_e_value8 = str_replace("K X1", "K Forever", $DescriptiveElements[7]->DisplayValue);
                                            }
                                            if ($cate_array_count >= 9) {
                                                $desc_e_name9 = $DescriptiveElements[8]->Name;
                                                $desc_e_value9 = str_replace("K X1", "K Forever", $DescriptiveElements[8]->DisplayValue);
                                            }
                                            if ($cate_array_count >= 10) {
                                                $desc_e_name10 = $DescriptiveElements[9]->Name;
                                                $desc_e_value10 = str_replace("K X1", "K Forever", $DescriptiveElements[9]->DisplayValue);
                                            }
                                            if ($cate_array_count >= 11) {
                                                $desc_e_name11 = $DescriptiveElements[10]->Name;
                                                $desc_e_value11 = str_replace("K X1", "K Forever", $DescriptiveElements[10]->DisplayValue);
                                            }
                                            if ($cate_array_count >= 12) {
                                                $desc_e_name12 = $DescriptiveElements[11]->Name;
                                                $desc_e_value12 = str_replace("K X1", "K Forever", $DescriptiveElements[11]->DisplayValue);
                                            }
                                            if ($cate_array_count >= 13) {
                                                $desc_e_name13 = $DescriptiveElements[12]->Name;
                                                $desc_e_value13 = str_replace("K X1", "K Forever", $DescriptiveElements[12]->DisplayValue);
                                            }
                                            if ($cate_array_count >= 14) {
                                                $desc_e_name14 = $DescriptiveElements[13]->Name;
                                                $desc_e_value14 = str_replace("K X1", "K Forever", $DescriptiveElements[13]->DisplayValue);
                                            }
                                            if ($cate_array_count >= 15) {
                                                $desc_e_name15 = $DescriptiveElements[14]->Name;
                                                $desc_e_value15 = str_replace("K X1", "K Forever", $DescriptiveElements[14]->DisplayValue);
                                            }
                                            $image1 = "";
                                            $image2 = "";
                                            $image3 = "";
                                            $image4 = "";
                                            $image5 = "";
                                            $image6 = "";
                                            $gimage1 = "";
                                            $gimage2 = "";
                                            $gimage3 = "";
                                            $fullysetimage1 = "";
                                            $fullysetimage2 = "";
                                            $fullysetimage3 = "";
                                            $fullysetimage4 = "";
                                            $fullysetimage5 = "";
                                            $fullysetimage6 = "";
                                            //get images
                                            // if(!empty($prod->Images)){
                                            //   $image1= $prod->Images[0]->FullUrl;
                                            //   $image2= $prod->Images[0]->ThumbnailUrl;
                                            //   $image3= $prod->Images[0]->ZoomUrl;
                                            // }
                                            // if(!empty($prod->GroupImages)){
                                            //   $gimage1= $prod->GroupImages[0]->ZoomUrl;
                                            //   $gimage2= $prod->GroupImages[0]->ZoomUrl;
                                            //   $gimage3= $prod->GroupImages[0]->ZoomUrl;
                                            // }
                                            //get images
                                            if (!empty($prod->Images)) {
                                                $image_peram_count = count($prod->Images);
                                                if ($image_peram_count >= 1) {
                                                    $image1 = $prod->Images[0]->FullUrl;
                                                }
                                                if ($image_peram_count >= 2) {
                                                    $image2 = $prod->Images[1]->FullUrl;
                                                }
                                                if ($image_peram_count >= 3) {
                                                    $image3 = $prod->Images[2]->FullUrl;
                                                }
                                                if ($image_peram_count >= 4) {
                                                    $image4 = $prod->Images[3]->FullUrl;
                                                }
                                                if ($image_peram_count >= 5) {
                                                    $image5 = $prod->Images[4]->FullUrl;
                                                }
                                                if ($image_peram_count >= 6) {
                                                    $image5 = $prod->Images[5]->FullUrl;
                                                }
                                                // $image1= $prod->Images[0]->FullUrl;
                                                // $image2= $prod->Images[0]->ThumbnailUrl;
                                                // $image3= $prod->Images[0]->ZoomUrl;
                                            }
                                            //get group images
                                            if (!empty($prod->GroupImages)) {
                                                $Groupimage_peram_count = count($prod->GroupImages);
                                                if ($Groupimage_peram_count >= 1) {
                                                    $gimage1 = $prod->GroupImages[0]->FullUrl;
                                                }
                                                if ($Groupimage_peram_count >= 2) {
                                                    $gimage2 = $prod->GroupImages[1]->FullUrl;
                                                }
                                                if ($Groupimage_peram_count >= 3) {
                                                    $gimage3 = $prod->GroupImages[2]->FullUrl;
                                                }
                                                // $gimage1= $prod->GroupImages[0]->ZoomUrl;
                                                // $gimage2= $prod->GroupImages[0]->ZoomUrl;
                                                // $gimage3= $prod->GroupImages[0]->ZoomUrl;
                                            }
                                            //get Fully Set Images images
                                            if (!empty($prod->FullySetImages)) {
                                                $FullySetimage_peram_count = count($prod->FullySetImages);
                                                if ($FullySetimage_peram_count >= 1) {
                                                    $fullysetimage1 = $prod->FullySetImages[0]->FullUrl;
                                                }
                                                if ($FullySetimage_peram_count >= 2) {
                                                    $fullysetimage2 = $prod->FullySetImages[1]->FullUrl;
                                                }
                                                if ($FullySetimage_peram_count >= 3) {
                                                    $fullysetimage3 = $prod->FullySetImages[2]->FullUrl;
                                                }
                                                if ($FullySetimage_peram_count >= 4) {
                                                    $fullysetimage4 = $prod->FullySetImages[3]->FullUrl;
                                                }
                                                if ($FullySetimage_peram_count >= 5) {
                                                    $fullysetimage5 = $prod->FullySetImages[4]->FullUrl;
                                                }
                                                if ($FullySetimage_peram_count >= 6) {
                                                    $fullysetimage6 = $prod->FullySetImages[5]->FullUrl;
                                                }
                                                // $image1= $prod->Images[0]->FullUrl;
                                                // $image2= $prod->Images[0]->ThumbnailUrl;
                                                // $image3= $prod->Images[0]->ZoomUrl;
                                            }
                                            //get AGTA
                                            if (!empty($prod->AGTA)) {
                                                $agta = $prod->AGTA;
                                            } else {
                                                $agta = "";
                                            }
                                            //get MerchandisingCategory
                                            $mcat1 = "";
                                            $mcat2 = "";
                                            $mcat3 = "";
                                            $mcat4 = "";
                                            $mcat5 = "";
                                            if (!empty($prod->MerchandisingCategory1)) {
                                                $mcat1 = $prod->MerchandisingCategory1;
                                            }
                                            if (!empty($prod->MerchandisingCategory2)) {
                                                $mcat2 = $prod->MerchandisingCategory2;
                                            }
                                            if (!empty($prod->MerchandisingCategory3)) {
                                                $mcat3 = $prod->MerchandisingCategory3;
                                            }
                                            if (!empty($prod->MerchandisingCategory4)) {
                                                $mcat4 = $prod->MerchandisingCategory4;
                                            }
                                            if (!empty($prod->MerchandisingCategory5)) {
                                                $mcat5 = $prod->MerchandisingCategory5;
                                            }
                                            $Description = "";
                                            if (!empty($prod->Description)) {
                                                $Description = str_replace("K X1", "K Forever", $prod->Description);
                                            }
                                            $ShortDescription = "";
                                            if (!empty($prod->ShortDescription)) {
                                                $ShortDescription = str_replace("K X1", "K Forever", $prod->ShortDescription);
                                            }
                                            $GroupDescription = "";
                                            if (!empty($prod->GroupDescription)) {
                                                $GroupDescription = str_replace("K X1", "K Forever", $prod->GroupDescription);
                                            }
                                            $LeadTime = "";
                                            if (!empty($prod->LeadTime)) {
                                                $LeadTime = $prod->LeadTime;
                                            }
                                            //get vedio and Group vedios
                                            $vedio = "";
                                            $gvedio = "";
                                            if (!empty($prod->Videos)) {
                                                $vedio = $prod->Videos[0]->DownloadUrl;
                                            }
                                            if (!empty($prod->GroupVideos)) {
                                                $gvedio = $prod->GroupVideos[0]->Url;
                                            }
                                            //get vedio and Group vedios
                                            $vedio = "";
                                            $gvedio = "";
                                            if (!empty($prod->Videos)) {
                                                $vedio = $prod->Videos[0]->DownloadUrl;
                                            }
                                            if (!empty($prod->GroupVideos)) {
                                                $gvedio = $prod->GroupVideos[0]->Url;
                                            }
                                            $GramWeight = "";
                                            if (!empty($prod->GramWeight)) {
                                                $GramWeight = $prod->GramWeight;
                                            }
                                            //explode sku for get and save sku series and sku series type start
                                            $sku_no = $prod->SKU;
                                            $sku_ar = explode(":", $sku_no);
                                            //    if (is_numeric($sku_no[0])) {
                                            //     echo "hi";die();
                                            //        $sku_ar= explode(":", $sku_no);
                                            //    } else {
                                            //        $arr = (str_split($sku_no));
                                            //        $l = count($arr);
                                            //        for ($i=0;$i<=$l;$i++) {
                                            //            if (is_numeric($arr[$i])) {
                                            //                array_splice($arr, $i, 0, ":");
                                            //                break;
                                            //            }
                                            //        }
                                            //        $s = join($arr);
                                            //        $sku_ar= explode(":", $s);
                                            //    }
                                            $cate_param_count = count($sku_ar);
                                            // print_r($sku_ar);die();
                                            $sku_series = "";
                                            $sku_series_type1 = "";
                                            $sku_series_type2 = "";
                                            $sku_series_type3 = "";
                                            if ($cate_param_count >= 1) {
                                                $sku_series = $sku_ar[0];
                                            }
                                            if ($cate_param_count >= 2) {
                                                $sku_series_type1 = $sku_ar[1];
                                            }
                                            if ($cate_param_count >= 3) {
                                                $sku_series_type2 = $sku_ar[2];
                                            }
                                            if ($cate_param_count >= 4) {
                                                $sku_series_type3 = $sku_ar[3];
                                            }
                                            if (empty($prod->Weight)) {
                                                $Weight = "";
                                            } else {
                                                $Weight = $prod->Weight;
                                            }
                                            if (empty($prod->WeightUnitOfMeasure)) {
                                                $WeightUnitOfMeasure = "";
                                            } else {
                                                $WeightUnitOfMeasure = $prod->WeightUnitOfMeasure;
                                            }
                                            if (empty($prod->CountryOfOrigin)) {
                                                $CountryOfOrigin = "";
                                            } else {
                                                $CountryOfOrigin = $prod->CountryOfOrigin;
                                            }
                                            if (empty($prod->Price->Value)) {
                                                $Price = "";
                                            } else {
                                                $Price = $prod->Price->Value;
                                            }
                                            if (empty($prod->ProductType)) {
                                                $ProductType = "";
                                            } else {
                                                $ProductType = $prod->ProductType;
                                            }
                                            if (empty($prod->OnHand)) {
                                                $OnHand = "";
                                            } else {
                                                $OnHand = $prod->OnHand;
                                            }
                                            if (empty($prod->Status)) {
                                                $Status = "";
                                            } else {
                                                $Status = $prod->Status;
                                            }
                                            if (empty($prod->Price->CurrencyCode)) {
                                                $CurrencyCode = "";
                                            } else {
                                                $CurrencyCode = $prod->Price->CurrencyCode;
                                            }
                                            if (empty($prod->UnitOfSale)) {
                                                $UnitOfSale = "";
                                            } else {
                                                $UnitOfSale = $prod->UnitOfSale;
                                            }
                                            if (empty($prod->DescriptiveElementGroup->GroupName)) {
                                                $GroupName = "";
                                            } else {
                                                $GroupName = $prod->DescriptiveElementGroup->GroupName;
                                            }
                                            if (empty($prod->ReadyToWear)) {
                                                $ReadyToWear = "";
                                            } else {
                                                $ReadyToWear = $prod->ReadyToWear;
                                            }
                                            if (empty($prod->CreationDate)) {
                                                $CreationDate = "";
                                            } else {
                                                $CreationDate = $prod->CreationDate;
                                            }
                                            //specifications
                                            if (empty($prod->Specifications)) {
                                                $specifications = "";
                                            } else {
                                                $specifications = $prod->Specifications;
                                            }
                                            //comessetwith
                                            if (empty($prod->CanBeSetWith)) {
                                                $canbesetwith = "";
                                            } else {
                                                $canbesetwith = $prod->CanBeSetWith;
                                            }
                                            //SetWith
                                            if (empty($prod->SetWith)) {
                                                $setwith = "";
                                            } else {
                                                $setwith = $prod->SetWith;
                                            }
                                            //ringsize
                                            $ringSizeArray = [];
                                            // print_r($prod->ConfigurationModel->RingSizeOptions);die();
                                            if (!empty($prod->ConfigurationModel)) {
                                                if (empty($prod->ConfigurationModel->RingSizeOptions)) {
                                                    $ringSizeArray = "";
                                                } else {
                                                    foreach ($prod->ConfigurationModel->RingSizeOptions as $configModel) {
                                                        $ringSizeArray[] = array(
                                                            "Size" => number_format((float)$configModel->Size, 2, '.', ''),
                                                            "Price" => $configModel->Price->Value
                                                        );
                                                    }
                                                }
                                            } else {
                                                $ringSizeArray = "";
                                            }
                                            // print_r($specifications); die();
                                            //explode sku for get and save sku series and sku series type end
                                            if (!empty($prod->Price->Value)) {
                                                if ($prod->Price->Value > $MINIMUM_COST) {
                                                    $ex = 0;
                                                    $ex1 = 0;
                                                    //---- excluding series --------
                                                    $this->db->select('*');
                                                    $this->db->from('tbl_category');
                                                    $this->db->where('is_active', 1);
                                                    $this->db->where('id', $category_id);
                                                    $cat_data = $this->db->get()->row();
                                                    if (!empty($cat_data->exlude_series)) {
                                                        $exclude = explode(",", $cat_data->exlude_series);
                                                        if (count($exclude) > 0) {
                                                            foreach ($exclude as $key => $value345) {
                                                                if ($value345 == $sku_series) {
                                                                    $ex = 1;
                                                                    break;
                                                                }
                                                            }
                                                        } else {
                                                            if ($cat_data->exlude_series == $sku_series) {
                                                                $ex = 1;
                                                            }
                                                        }
                                                    }
                                                    //---- excluding sku --------
                                                    if (!empty($cat_data->exlude_sku)) {
                                                        $exclude1 = explode(",", $cat_data->exlude_sku);
                                                        if (count($exclude1) > 0) {
                                                            foreach ($exclude1 as $key => $value3452) {
                                                                if ($value3452 == $prod->SKU) {
                                                                    $ex1 = 1;
                                                                    break;
                                                                }
                                                            }
                                                        } else {
                                                            if ($cat_data->exlude_sku == $prod->SKU) {
                                                                $ex1 = 1;
                                                            }
                                                        }
                                                    }
                                                    if ($ex == 0 && $ex1 == 0) {
                                                        $data_insert = array(
                                                            'product_id' => $prod->Id,
                                                            'category' => $category_id,
                                                            // 'sub_category'=>$subcategory,
                                                            // 'minisub_category'=>$minisubcategory,
                                                            // 'vendor'=>1,
                                                            'sku' => $prod->SKU,
                                                            'sku_series' => $sku_series,
                                                            'sku_series_type1' => $sku_series_type1,
                                                            'sku_series_type2' => $sku_series_type2,
                                                            'sku_series_type3' => $sku_series_type3,
                                                            'description' => $Description,
                                                            'sdesc' => $ShortDescription,
                                                            'gdesc' => $GroupDescription,
                                                            'mcat1' => $mcat1,
                                                            'mcat2' => $mcat2,
                                                            'mcat3' => $mcat3,
                                                            'mcat4' => $mcat4,
                                                            'mcat5' => $mcat5,
                                                            'product_type' => $ProductType,
                                                            'collection' => "",
                                                            'onhand' => $OnHand,
                                                            'status' => $Status,
                                                            'price' => $Price,
                                                            'currency' => $CurrencyCode,
                                                            'unitofsale' => $UnitOfSale,
                                                            'weight' => $Weight,
                                                            'weightunit' => $WeightUnitOfMeasure,
                                                            'gramweight' => $GramWeight,
                                                            'ringsizable' => $RingSizable,
                                                            'ringsize' => $ringsize,
                                                            'ringsizetype' => $ringsizetype,
                                                            'leadtime' => $LeadTime,
                                                            'agta' => $agta,
                                                            'desc_e_grp' => $GroupName,
                                                            'desc_e_name1' => $desc_e_name1,
                                                            'desc_e_value1' => ltrim($desc_e_value1),
                                                            'desc_e_name2' => $desc_e_name2,
                                                            'desc_e_value2' => ltrim($desc_e_value2),
                                                            'desc_e_name3' => $desc_e_name3,
                                                            'desc_e_value3' => ltrim($desc_e_value3),
                                                            'desc_e_name4' => $desc_e_name4,
                                                            'desc_e_value4' => ltrim($desc_e_value4),
                                                            'desc_e_name5' => $desc_e_name5,
                                                            'desc_e_value5' => ltrim($desc_e_value5),
                                                            'desc_e_name6' => $desc_e_name6,
                                                            'desc_e_value6' => ltrim($desc_e_value6),
                                                            'desc_e_name7' => $desc_e_name7,
                                                            'desc_e_value7' => ltrim($desc_e_value7),
                                                            'desc_e_name8' => $desc_e_name8,
                                                            'desc_e_value8' => ltrim($desc_e_value8),
                                                            'desc_e_name9' => $desc_e_name9,
                                                            'desc_e_value9' => ltrim($desc_e_value9),
                                                            'desc_e_name10' => $desc_e_name10,
                                                            'desc_e_value10' => ltrim($desc_e_value10),
                                                            'desc_e_name11' => $desc_e_name11,
                                                            'desc_e_value11' => ltrim($desc_e_value11),
                                                            'desc_e_name12' => $desc_e_name12,
                                                            'desc_e_value12' => ltrim($desc_e_value12),
                                                            'desc_e_name13' => $desc_e_name13,
                                                            'desc_e_value13' => ltrim($desc_e_value13),
                                                            'desc_e_name14' => $desc_e_name14,
                                                            'desc_e_value14' => ltrim($desc_e_value14),
                                                            'desc_e_name15' => $desc_e_name15,
                                                            'desc_e_value15' => ltrim($desc_e_value15),
                                                            'readytowear' => $ReadyToWear,
                                                            'smi' => "",
                                                            'image1' => $image1,
                                                            'image2' => $image2,
                                                            'image3' => $image3,
                                                            'image4' => $image4,
                                                            'image5' => $image5,
                                                            'image6' => $image6,
                                                            'FullySetImage1' => $fullysetimage1,
                                                            'FullySetImage2' => $fullysetimage2,
                                                            'FullySetImage3' => $fullysetimage3,
                                                            'FullySetImage4' => $fullysetimage4,
                                                            'FullySetImage5' => $fullysetimage5,
                                                            'FullySetImage6' => $fullysetimage6,
                                                            'video' => $vedio,
                                                            'gimage1' => $gimage1,
                                                            'gimage2' => $gimage2,
                                                            'gimage3' => $gimage3,
                                                            'gvideo' => $gvedio,
                                                            'creationdate' => $CreationDate,
                                                            'currencycode' => "USD",
                                                            'country' => $CountryOfOrigin,
                                                            'dclarity' => "",
                                                            'dcolor' => "",
                                                            'totalweight' => "",
                                                            'ip' => $ip,
                                                            'added_by' => $addedby,
                                                            'is_active' => 1,
                                                            'group_id' => $prod->DescriptiveElementGroup->GroupId,
                                                            'series_id' => $prod->DescriptiveElementGroup->DescriptiveElements[0]->Value,

                                                            'date' => $cur_date
                                                        );
                                                        $last_id = $this->base_model->insert_table("tbl_products", $data_insert, 1);
                                                        $beta_insert = array(
                                                            'product_id' => $last_id,
                                                            'specifications' => json_encode($specifications),
                                                            'canbesetwith' => json_encode($canbesetwith),
                                                            'setwith' => json_encode($setwith),
                                                            'ringsize' => json_encode($ringSizeArray),
                                                        );
                                                        $spec_id = $this->base_model->insert_table("tbl_product_specifications", $beta_insert, 1);
                                                    }
                                                } else {
                                                    $else++;
                                                }
                                            }
                                        }
                                    }
                                    $NextPage = "";
                                    if (!empty($result_da->NextPage)) {
                                        $NextPage = $result_da->NextPage;
                                    }
                                    // echo $i." NP- ".$NextPage."<br>";
                                }
                            } //----category end----
                            //Series
                            if ($type == 2) {
                                if ($finshed == 1) {
                                    if ($i == 0) {
                                        $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList","Finished"],"Series":["' . $value . '"]}';
                                        // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"]}';
                                    } else {
                                        $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList","Finished"],"Series":["' . $value . '"],"NextPage":"' . $NextPage . '" }';
                                        // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"],"NextPage":"'.$NextPage.'" }';
                                    }
                                } else {
                                    if ($i == 0) {
                                        $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList"],"Series":["' . $value . '"]}';
                                        // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"]}';
                                    } else {
                                        $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList"],"Series":["' . $value . '"],"NextPage":"' . $NextPage . '" }';
                                        // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"],"NextPage":"'.$NextPage.'" }';
                                    }
                                }
                                $postdata = $data;
                                $header = array();
                                $header[] = 'Host:api.stuller.com';
                                $header[] = 'Content-Type:application/json';
                                $header[] = 'Authorization:Basic ZGV2amV3ZWw6Q29kaW5nMjA9';
                                $ch = curl_init($url);
                                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                                curl_setopt($ch, CURLOPT_POST, 1);
                                curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                                curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                                $result = curl_exec($ch);
                                curl_close($ch);
                                $result_da = json_decode($result);
                                // echo "<pre>";
                                //
                                // print_r($result_da);
                                // echo "</pre>";
                                //
                                // exit;
                                if (!empty($result_da)) {
                                    $specifications = [];
                                    foreach ($result_da->Products as $prod) {
                                        $ringsize = 0;
                                        $ringsizetype = "";
                                        $RingSizable = "";
                                        if (!empty($prod->RingSizable)) {
                                            $RingSizable = $prod->RingSizable;
                                            if ($RingSizable == false) {
                                                $ringsize = 0;
                                                $ringsizetype = "";
                                            } else {
                                                if (!empty($prod->ringsize)) {
                                                    $ringsize = $prod->ringsize;
                                                }
                                                if (!empty($prod->ringsizetype)) {
                                                    $ringsizetype = $prod->ringsizetype;
                                                }
                                            }
                                        }
                                        //group eliments
                                        if (empty($prod->DescriptiveElementGroup)) {
                                            $DescriptiveElements = [];
                                        } else {
                                            $DescriptiveElements = $prod->DescriptiveElementGroup->DescriptiveElements;
                                        }
                                        $cate_array_count = 0;
                                        if (!empty($DescriptiveElements)) {
                                            $cate_array_count = count($DescriptiveElements);
                                        }
                                        $desc_e_name1 = "";
                                        $desc_e_value1 = "";
                                        $desc_e_name2 = "";
                                        $desc_e_value2 = "";
                                        $desc_e_name3 = "";
                                        $desc_e_value3 = "";
                                        $desc_e_name4 = "";
                                        $desc_e_value4 = "";
                                        $desc_e_name5 = "";
                                        $desc_e_value5 = "";
                                        $desc_e_name6 = "";
                                        $desc_e_value6 = "";
                                        $desc_e_name7 = "";
                                        $desc_e_value7 = "";
                                        $desc_e_name8 = "";
                                        $desc_e_value8 = "";
                                        $desc_e_name9 = "";
                                        $desc_e_value9 = "";
                                        $desc_e_name10 = "";
                                        $desc_e_value10 = "";
                                        $desc_e_name11 = "";
                                        $desc_e_value11 = "";
                                        $desc_e_name12 = "";
                                        $desc_e_value12 = "";
                                        $desc_e_name13 = "";
                                        $desc_e_value13 = "";
                                        $desc_e_name14 = "";
                                        $desc_e_value14 = "";
                                        $desc_e_name15 = "";
                                        $desc_e_value15 = "";
                                        if ($cate_array_count >= 1) {
                                            $desc_e_name1 = $DescriptiveElements[0]->Name;
                                            $desc_e_value1 = str_replace("K X1", "K Forever", $DescriptiveElements[0]->DisplayValue);
                                        }
                                        if ($cate_array_count >= 2) {
                                            $desc_e_name2 = $DescriptiveElements[1]->Name;
                                            $desc_e_value2 = str_replace("K X1", "K Forever", $DescriptiveElements[1]->DisplayValue);
                                        }
                                        if ($cate_array_count >= 3) {
                                            $desc_e_name3 = $DescriptiveElements[2]->Name;
                                            $desc_e_value3 = str_replace("K X1", "K Forever", $DescriptiveElements[2]->DisplayValue);
                                        }
                                        if ($cate_array_count >= 4) {
                                            $desc_e_name4 = $DescriptiveElements[3]->Name;
                                            $desc_e_value4 = str_replace("K X1", "K Forever", $DescriptiveElements[3]->DisplayValue);
                                        }
                                        if ($cate_array_count >= 5) {
                                            $desc_e_name5 = $DescriptiveElements[4]->Name;
                                            $desc_e_value5 = str_replace("K X1", "K Forever", $DescriptiveElements[4]->DisplayValue);
                                        }
                                        if ($cate_array_count >= 6) {
                                            $desc_e_name6 = $DescriptiveElements[5]->Name;
                                            $desc_e_value6 = str_replace("K X1", "K Forever", $DescriptiveElements[5]->DisplayValue);
                                        }
                                        if ($cate_array_count >= 7) {
                                            $desc_e_name7 = $DescriptiveElements[6]->Name;
                                            $desc_e_value7 = str_replace("K X1", "K Forever", $DescriptiveElements[6]->DisplayValue);
                                        }
                                        if ($cate_array_count >= 8) {
                                            $desc_e_name8 = $DescriptiveElements[7]->Name;
                                            $desc_e_value8 = str_replace("K X1", "K Forever", $DescriptiveElements[7]->DisplayValue);
                                        }
                                        if ($cate_array_count >= 9) {
                                            $desc_e_name9 = $DescriptiveElements[8]->Name;
                                            $desc_e_value9 = str_replace("K X1", "K Forever", $DescriptiveElements[8]->DisplayValue);
                                        }
                                        if ($cate_array_count >= 10) {
                                            $desc_e_name10 = $DescriptiveElements[9]->Name;
                                            $desc_e_value10 = str_replace("K X1", "K Forever", $DescriptiveElements[9]->DisplayValue);
                                        }
                                        if ($cate_array_count >= 11) {
                                            $desc_e_name11 = $DescriptiveElements[10]->Name;
                                            $desc_e_value11 = str_replace("K X1", "K Forever", $DescriptiveElements[10]->DisplayValue);
                                        }
                                        if ($cate_array_count >= 12) {
                                            $desc_e_name12 = $DescriptiveElements[11]->Name;
                                            $desc_e_value12 = str_replace("K X1", "K Forever", $DescriptiveElements[11]->DisplayValue);
                                        }
                                        if ($cate_array_count >= 13) {
                                            $desc_e_name13 = $DescriptiveElements[12]->Name;
                                            $desc_e_value13 = str_replace("K X1", "K Forever", $DescriptiveElements[12]->DisplayValue);
                                        }
                                        if ($cate_array_count >= 14) {
                                            $desc_e_name14 = $DescriptiveElements[13]->Name;
                                            $desc_e_value14 = str_replace("K X1", "K Forever", $DescriptiveElements[13]->DisplayValue);
                                        }
                                        if ($cate_array_count >= 15) {
                                            $desc_e_name15 = $DescriptiveElements[14]->Name;
                                            $desc_e_value15 = str_replace("K X1", "K Forever", $DescriptiveElements[14]->DisplayValue);
                                        }
                                        $image1 = "";
                                        $image2 = "";
                                        $image3 = "";
                                        $image4 = "";
                                        $image5 = "";
                                        $image6 = "";
                                        $gimage1 = "";
                                        $gimage2 = "";
                                        $gimage3 = "";
                                        $fullysetimage1 = "";
                                        $fullysetimage2 = "";
                                        $fullysetimage3 = "";
                                        $fullysetimage4 = "";
                                        $fullysetimage5 = "";
                                        $fullysetimage6 = "";
                                        //get images
                                        // if(!empty($prod->Images)){
                                        //   $image1= $prod->Images[0]->FullUrl;
                                        //   $image2= $prod->Images[0]->ThumbnailUrl;
                                        //   $image3= $prod->Images[0]->ZoomUrl;
                                        // }
                                        // if(!empty($prod->GroupImages)){
                                        //   $gimage1= $prod->GroupImages[0]->ZoomUrl;
                                        //   $gimage2= $prod->GroupImages[0]->ZoomUrl;
                                        //   $gimage3= $prod->GroupImages[0]->ZoomUrl;
                                        // }
                                        //get images
                                        if (!empty($prod->Images)) {
                                            $image_peram_count = count($prod->Images);
                                            if ($image_peram_count >= 1) {
                                                $image1 = $prod->Images[0]->FullUrl;
                                            }
                                            if ($image_peram_count >= 2) {
                                                $image2 = $prod->Images[1]->FullUrl;
                                            }
                                            if ($image_peram_count >= 3) {
                                                $image3 = $prod->Images[2]->FullUrl;
                                            }
                                            if ($image_peram_count >= 4) {
                                                $image4 = $prod->Images[3]->FullUrl;
                                            }
                                            if ($image_peram_count >= 5) {
                                                $image5 = $prod->Images[4]->FullUrl;
                                            }
                                            if ($image_peram_count >= 6) {
                                                $image5 = $prod->Images[5]->FullUrl;
                                            }
                                            // $image1= $prod->Images[0]->FullUrl;
                                            // $image2= $prod->Images[0]->ThumbnailUrl;
                                            // $image3= $prod->Images[0]->ZoomUrl;
                                        }
                                        //get group images
                                        if (!empty($prod->GroupImages)) {
                                            $Groupimage_peram_count = count($prod->GroupImages);
                                            if ($Groupimage_peram_count >= 1) {
                                                $gimage1 = $prod->GroupImages[0]->FullUrl;
                                            }
                                            if ($Groupimage_peram_count >= 2) {
                                                $gimage2 = $prod->GroupImages[1]->FullUrl;
                                            }
                                            if ($Groupimage_peram_count >= 3) {
                                                $gimage3 = $prod->GroupImages[2]->FullUrl;
                                            }
                                            // $gimage1= $prod->GroupImages[0]->ZoomUrl;
                                            // $gimage2= $prod->GroupImages[0]->ZoomUrl;
                                            // $gimage3= $prod->GroupImages[0]->ZoomUrl;
                                        }
                                        //get Fully Set Images images
                                        if (!empty($prod->FullySetImages)) {
                                            $FullySetimage_peram_count = count($prod->FullySetImages);
                                            if ($FullySetimage_peram_count >= 1) {
                                                $fullysetimage1 = $prod->FullySetImages[0]->FullUrl;
                                            }
                                            if ($FullySetimage_peram_count >= 2) {
                                                $fullysetimage2 = $prod->FullySetImages[1]->FullUrl;
                                            }
                                            if ($FullySetimage_peram_count >= 3) {
                                                $fullysetimage3 = $prod->FullySetImages[2]->FullUrl;
                                            }
                                            if ($FullySetimage_peram_count >= 4) {
                                                $fullysetimage4 = $prod->FullySetImages[3]->FullUrl;
                                            }
                                            if ($FullySetimage_peram_count >= 5) {
                                                $fullysetimage5 = $prod->FullySetImages[4]->FullUrl;
                                            }
                                            if ($FullySetimage_peram_count >= 6) {
                                                $fullysetimage6 = $prod->FullySetImages[5]->FullUrl;
                                            }
                                            // $image1= $prod->Images[0]->FullUrl;
                                            // $image2= $prod->Images[0]->ThumbnailUrl;
                                            // $image3= $prod->Images[0]->ZoomUrl;
                                        }
                                        //get AGTA
                                        if (!empty($prod->AGTA)) {
                                            $agta = $prod->AGTA;
                                        } else {
                                            $agta = "";
                                        }
                                        //get MerchandisingCategory
                                        $mcat1 = "";
                                        $mcat2 = "";
                                        $mcat3 = "";
                                        $mcat4 = "";
                                        $mcat5 = "";
                                        if (!empty($prod->MerchandisingCategory1)) {
                                            $mcat1 = $prod->MerchandisingCategory1;
                                        }
                                        if (!empty($prod->MerchandisingCategory2)) {
                                            $mcat2 = $prod->MerchandisingCategory2;
                                        }
                                        if (!empty($prod->MerchandisingCategory3)) {
                                            $mcat3 = $prod->MerchandisingCategory3;
                                        }
                                        if (!empty($prod->MerchandisingCategory4)) {
                                            $mcat4 = $prod->MerchandisingCategory4;
                                        }
                                        if (!empty($prod->MerchandisingCategory5)) {
                                            $mcat5 = $prod->MerchandisingCategory5;
                                        }
                                        $Description = "";
                                        if (!empty($prod->Description)) {
                                            $Description = str_replace("K X1", "K Forever", $prod->Description);
                                        }
                                        $ShortDescription = "";
                                        if (!empty($prod->ShortDescription)) {
                                            $ShortDescription = str_replace("K X1", "K Forever", $prod->ShortDescription);
                                        }
                                        $GroupDescription = "";
                                        if (!empty($prod->GroupDescription)) {
                                            $GroupDescription = str_replace("K X1", "K Forever", $prod->GroupDescription);
                                        }
                                        $LeadTime = "";
                                        if (!empty($prod->LeadTime)) {
                                            $LeadTime = $prod->LeadTime;
                                        }
                                        //get vedio and Group vedios
                                        $vedio = "";
                                        $gvedio = "";
                                        if (!empty($prod->Videos)) {
                                            $vedio = $prod->Videos[0]->DownloadUrl;
                                        }
                                        if (!empty($prod->GroupVideos)) {
                                            $gvedio = $prod->GroupVideos[0]->Url;
                                        }
                                        //get vedio and Group vedios
                                        $vedio = "";
                                        $gvedio = "";
                                        if (!empty($prod->Videos)) {
                                            $vedio = $prod->Videos[0]->DownloadUrl;
                                        }
                                        if (!empty($prod->GroupVideos)) {
                                            $gvedio = $prod->GroupVideos[0]->Url;
                                        }
                                        //explode sku for get and save sku series and sku series type start
                                        $sku_no = $prod->SKU;
                                        //    if (is_numeric($sku_no[0])) {
                                        //        $sku_ar= explode(":", $sku_no);
                                        //    } else {
                                        //        $arr = (str_split($sku_no));
                                        //        $l = count($arr);
                                        //        for ($i=0;$i<=$l;$i++) {
                                        //            if (is_numeric($arr[$i])) {
                                        //                array_splice($arr, $i, 0, ":");
                                        //                break;
                                        //            }
                                        //        }
                                        //        $s = join($arr);
                                        //        $sku_ar= explode(":", $s);
                                        //    }
                                        $cate_param_count = count($sku_ar);
                                        $sku_series = "";
                                        $sku_series_type1 = "";
                                        $sku_series_type2 = "";
                                        $sku_series_type3 = "";
                                        if ($cate_param_count >= 1) {
                                            $sku_series = $sku_ar[0];
                                        }
                                        if ($cate_param_count >= 2) {
                                            $sku_series_type1 = $sku_ar[1];
                                        }
                                        if ($cate_param_count >= 3) {
                                            $sku_series_type2 = $sku_ar[2];
                                        }
                                        if ($cate_param_count >= 4) {
                                            $sku_series_type3 = $sku_ar[3];
                                        }
                                        $ProductType = "";
                                        if (!empty($prod->ProductType)) {
                                            $ProductType = $prod->ProductType;
                                        }
                                        $OnHand = "";
                                        if (!empty($prod->OnHand)) {
                                            $OnHand = $prod->OnHand;
                                        }
                                        $Status = "";
                                        if (!empty($prod->Status)) {
                                            $Status = $prod->Status;
                                        }
                                        $Value = "";
                                        if (!empty($prod->Price->Value)) {
                                            $Value = $prod->Price->Value;
                                        }
                                        $CurrencyCode = "";
                                        if (!empty($prod->Price->CurrencyCode)) {
                                            $CurrencyCode = $prod->Price->CurrencyCode;
                                        }
                                        $UnitOfSale = "";
                                        if (!empty($prod->UnitOfSale)) {
                                            $UnitOfSale = $prod->UnitOfSale;
                                        }
                                        $Weight = "";
                                        if (!empty($prod->Weight)) {
                                            $Weight = $prod->Weight;
                                        }
                                        $WeightUnitOfMeasure = "";
                                        if (!empty($prod->WeightUnitOfMeasure)) {
                                            $WeightUnitOfMeasure = $prod->WeightUnitOfMeasure;
                                        }
                                        $GramWeight = "";
                                        if (!empty($prod->GramWeight)) {
                                            $GramWeight = $prod->GramWeight;
                                        }
                                        $GroupName = "";
                                        if (!empty($prod->DescriptiveElementGroup->GroupName)) {
                                            $GroupName = $prod->DescriptiveElementGroup->GroupName;
                                        }
                                        $CreationDate = "";
                                        if (!empty($prod->CreationDate)) {
                                            $CreationDate = $prod->CreationDate;
                                        }
                                        $CountryOfOrigin = "";
                                        if (!empty($prod->CountryOfOrigin)) {
                                            $CountryOfOrigin = $prod->CountryOfOrigin;
                                        }
                                        $RingSizable = "";
                                        if (!empty($prod->RingSizable)) {
                                            $RingSizable = $prod->RingSizable;
                                        }
                                        $ReadyToWear = "";
                                        if (!empty($prod->ReadyToWear)) {
                                            $ReadyToWear = $prod->ReadyToWear;
                                        }
                                        //specifications
                                        if (empty($prod->Specifications)) {
                                            $specifications = "";
                                        } else {
                                            $specifications = $prod->Specifications;
                                        }
                                        //comessetwith
                                        if (empty($prod->CanBeSetWith)) {
                                            $canbesetwith = "";
                                        } else {
                                            $canbesetwith = $prod->CanBeSetWith;
                                        }
                                        //SetWith
                                        if (empty($prod->SetWith)) {
                                            $setwith = "";
                                        } else {
                                            $setwith = $prod->SetWith;
                                        }
                                        //ringsize
                                        //ringsize
                                        $ringSizeArray = [];
                                        // print_r($prod->ConfigurationModel->RingSizeOptions);die();
                                        if (!empty($prod->ConfigurationModel)) {
                                            if (empty($prod->ConfigurationModel->RingSizeOptions)) {
                                                $ringSizeArray = "";
                                            } else {
                                                foreach ($prod->ConfigurationModel->RingSizeOptions as $configModel) {
                                                    $ringSizeArray[] = array(
                                                        "Size" => number_format((float)$configModel->Size, 2, '.', ''),
                                                        "Price" => $configModel->Price->Value
                                                    );
                                                }
                                            }
                                        } else {
                                            $ringSizeArray = "";
                                        }
                                        //explode sku for get and save sku series and sku series type end
                                        if (!empty($prod->Price->Value)) {
                                            if ($prod->Price->Value > $MINIMUM_COST) {
                                                $ex = 0;
                                                $ex1 = 0;
                                                //---- excluding series --------
                                                $this->db->select('*');
                                                $this->db->from('tbl_category');
                                                $this->db->where('is_active', 1);
                                                $this->db->where('id', $category_id);
                                                $cat_data = $this->db->get()->row();
                                                if (!empty($cat_data->exlude_series)) {
                                                    $exclude = explode(",", $cat_data->exlude_series);
                                                    if (count($exclude) > 0) {
                                                        foreach ($exclude as $key => $value345) {
                                                            if ($value345 == $sku_series) {
                                                                $ex = 1;
                                                                break;
                                                            }
                                                        }
                                                    } else {
                                                        if ($cat_data->exlude_series == $sku_series) {
                                                            $ex = 1;
                                                        }
                                                    }
                                                }
                                                //---- excluding sku --------
                                                if (!empty($cat_data->exlude_sku)) {
                                                    $exclude1 = explode(",", $cat_data->exlude_sku);
                                                    if (count($exclude1) > 0) {
                                                        foreach ($exclude1 as $key => $value3452) {
                                                            if ($value3452 == $prod->SKU) {
                                                                $ex = 1;
                                                                break;
                                                            }
                                                        }
                                                    } else {
                                                        if ($cat_data->exlude_sku == $prod->SKU) {
                                                            $ex = 1;
                                                        }
                                                    }
                                                }
                                                if ($ex == 0 && $ex1 == 0) {
                                                    $data_insert = array(
                                                        'product_id' => ltrim($prod->Id),
                                                        'category' => $category_id,
                                                        // 'sub_category'=>$subcategory,
                                                        // 'minisub_category'=>$minisubcategory,
                                                        // 'vendor'=>1,
                                                        'sku' => $prod->SKU,
                                                        'sku_series' => $sku_series,
                                                        'sku_series_type1' => $sku_series_type1,
                                                        'sku_series_type2' => $sku_series_type2,
                                                        'sku_series_type3' => $sku_series_type3,
                                                        'description' => $Description,
                                                        'sdesc' => $ShortDescription,
                                                        'gdesc' => $GroupDescription,
                                                        'mcat1' => $mcat1,
                                                        'mcat2' => $mcat2,
                                                        'mcat3' => $mcat3,
                                                        'mcat4' => $mcat4,
                                                        'mcat5' => $mcat5,
                                                        'product_type' => $ProductType,
                                                        'collection' => "",
                                                        'onhand' => $OnHand,
                                                        'status' => $Status,
                                                        'price' => $Value,
                                                        'currency' => $CurrencyCode,
                                                        'unitofsale' => $UnitOfSale,
                                                        'weight' => $Weight,
                                                        'weightunit' => $WeightUnitOfMeasure,
                                                        'gramweight' => $GramWeight,
                                                        'ringsizable' => $RingSizable,
                                                        'ringsize' => $ringsize,
                                                        'ringsizetype' => $ringsizetype,
                                                        'leadtime' => $LeadTime,
                                                        'agta' => $agta,
                                                        'desc_e_grp' => $GroupName,
                                                        'desc_e_name1' => $desc_e_name1,
                                                        'desc_e_value1' => ltrim($desc_e_value1),
                                                        'desc_e_name2' => $desc_e_name2,
                                                        'desc_e_value2' => ltrim($desc_e_value2),
                                                        'desc_e_name3' => $desc_e_name3,
                                                        'desc_e_value3' => ltrim($desc_e_value3),
                                                        'desc_e_name4' => $desc_e_name4,
                                                        'desc_e_value4' => ltrim($desc_e_value4),
                                                        'desc_e_name5' => $desc_e_name5,
                                                        'desc_e_value5' => ltrim($desc_e_value5),
                                                        'desc_e_name6' => $desc_e_name6,
                                                        'desc_e_value6' => ltrim($desc_e_value6),
                                                        'desc_e_name7' => $desc_e_name7,
                                                        'desc_e_value7' => ltrim($desc_e_value7),
                                                        'desc_e_name8' => $desc_e_name8,
                                                        'desc_e_value8' => ltrim($desc_e_value8),
                                                        'desc_e_name9' => $desc_e_name9,
                                                        'desc_e_value9' => ltrim($desc_e_value9),
                                                        'desc_e_name10' => $desc_e_name10,
                                                        'desc_e_value10' => ltrim($desc_e_value10),
                                                        'desc_e_name11' => $desc_e_name11,
                                                        'desc_e_value11' => ltrim($desc_e_value11),
                                                        'desc_e_name12' => $desc_e_name12,
                                                        'desc_e_value12' => ltrim($desc_e_value12),
                                                        'desc_e_name13' => $desc_e_name13,
                                                        'desc_e_value13' => ltrim($desc_e_value13),
                                                        'desc_e_name14' => $desc_e_name14,
                                                        'desc_e_value14' => ltrim($desc_e_value14),
                                                        'desc_e_name15' => $desc_e_name15,
                                                        'desc_e_value15' => ltrim($desc_e_value15),
                                                        'readytowear' => $ReadyToWear,
                                                        'smi' => "",
                                                        'image1' => $image1,
                                                        'image2' => $image2,
                                                        'image3' => $image3,
                                                        'image4' => $image4,
                                                        'image5' => $image5,
                                                        'image6' => $image6,
                                                        'FullySetImage1' => $fullysetimage1,
                                                        'FullySetImage2' => $fullysetimage2,
                                                        'FullySetImage3' => $fullysetimage3,
                                                        'FullySetImage4' => $fullysetimage4,
                                                        'FullySetImage5' => $fullysetimage5,
                                                        'FullySetImage6' => $fullysetimage6,
                                                        'video' => $vedio,
                                                        'gimage1' => $gimage1,
                                                        'gimage2' => $gimage2,
                                                        'gimage3' => $gimage3,
                                                        'gvideo' => $gvedio,
                                                        'creationdate' => $CreationDate,
                                                        'currencycode' => "USD",
                                                        'country' => $CountryOfOrigin,
                                                        'dclarity' => "",
                                                        'dcolor' => "",
                                                        'totalweight' => "",
                                                        'ip' => $ip,
                                                        'added_by' => $addedby,
                                                        'is_active' => 1,
                                                        'group_id' => $prod->DescriptiveElementGroup->GroupId,
                                                        'series_id' => $prod->DescriptiveElementGroup->DescriptiveElements[0]->Value,

                                                        'date' => $cur_date
                                                    );
                                                    $last_id = $this->base_model->insert_table("tbl_products", $data_insert, 1);
                                                    $beta_insert = array(
                                                        'product_id' => $last_id,
                                                        'specifications' => json_encode($specifications),
                                                        'canbesetwith' => json_encode($canbesetwith),
                                                        'setwith' => json_encode($setwith),
                                                        'ringsize' => json_encode($ringSizeArray),
                                                    );
                                                    $spec_id = $this->base_model->insert_table("tbl_product_specifications", $beta_insert, 1);
                                                }
                                            }
                                        }
                                    }
                                    $NextPage = "";
                                    if (!empty($result_da->NextPage)) {
                                        $NextPage = $result_da->NextPage;
                                    }
                                    // echo $i." NP- ".$NextPage."<br>";
                                }
                            } //---series end-------
                            // $NextPage= "";
                            // $NextPage= $result_da->NextPage;
                            // echo $i." NP- ".$NextPage."<br>";
                        }
                        // echo $else;
                        // exit;
                    }
                    if ($type == 2) {
                        // $ne_id=json_decode($api_id)
                        $se = 0;
                        // foreach ($api_ids as $value) {
                        if ($finshed == 1) {
                            // $data = '{"Filter":["Orderable","OnPriceList","Finished"],"CategoryIds":["'.$api_id.'"]}';
                            $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList","Finished"],"Series":["' . $value . '"]}';
                            // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"]}';
                        } else {
                            $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList"],"Series":["' . $value . '"]}';
                        }
                        $postdata = $data;
                        // echo $postdata;
                        // exit;
                        $header = array();
                        $header[] = 'Host:api.stuller.com';
                        $header[] = 'Content-Type:application/json';
                        $header[] = 'Authorization:Basic ZGV2amV3ZWw6Q29kaW5nMjA9';
                        $ch = curl_init($url);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                        $result = curl_exec($ch);
                        curl_close($ch);
                        // print_r ($result);
                        $result_da = json_decode($result);
                        // echo $result[0];
                        if (!empty($result_da)) {
                            $TotalNumberOfProducts = $result_da->TotalNumberOfProducts;
                            $total_pages = round($TotalNumberOfProducts / 500) + 1;
                        }
                        // echo $TotalNumberOfProducts;
                        // exit;
                        //get count of total number of products end
                        //category products adding
                        // echo $total_pages; die();
                        //delete previous data from the table start
                        $c_api = count($api_ids);
                        //delete previous data from the table end
                        //product data insert from the api start
                        $NextPage = "";
                        for ($i = 0; $i < $total_pages; $i++) {
                            // code...
                            // echo $i;
                            $url = 'https://api.stuller.com/v2/products';
                            if ($type == 1 || $type == "") {
                                if ($finshed == 1) {
                                    if ($i == 0) {
                                        $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList","Finished"],"CategoryIds":["' . $value . '"]}';
                                        // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"]}';
                                    } else {
                                        $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList","Finished"],"CategoryIds":["' . $value . '"],"NextPage":"' . $NextPage . '" }';
                                        // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"],"NextPage":"'.$NextPage.'" }';
                                    }
                                } else {
                                    if ($i == 0) {
                                        $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList"],"CategoryIds":["' . $value . '"]}';
                                        // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"]}';
                                    } else {
                                        $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList"],"CategoryIds":["' . $value . '"],"NextPage":"' . $NextPage . '" }';
                                        // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"],"NextPage":"'.$NextPage.'" }';
                                    }
                                }
                                $postdata = $data;
                                $header = array();
                                $header[] = 'Host:api.stuller.com';
                                $header[] = 'Content-Type:application/json';
                                $header[] = 'Authorization:Basic ZGV2amV3ZWw6Q29kaW5nMjA9';
                                $ch = curl_init($url);
                                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                                curl_setopt($ch, CURLOPT_POST, 1);
                                curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                                curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                                $result = curl_exec($ch);
                                curl_close($ch);
                                $result_da = json_decode($result);
                                // echo "<pre>";
                                //
                                // print_r($result_da);
                                // echo "</pre>";
                                //
                                // exit;
                                if (!empty($result_da)) {
                                    foreach ($result_da->Products as $prod) {
                                        $specifications = [];
                                        $ringsize = 0;
                                        $ringsizetype = "";
                                        $RingSizable = "";
                                        if (!empty($prod->RingSizable)) {
                                            $RingSizable = $prod->RingSizable;
                                            if ($RingSizable == false) {
                                                $ringsize = 0;
                                                $ringsizetype = "";
                                            } else {
                                                if (!empty($prod->ringsize)) {
                                                    $ringsize = $prod->ringsize;
                                                }
                                                if (!empty($prod->ringsizetype)) {
                                                    $ringsizetype = $prod->ringsizetype;
                                                }
                                            }
                                        }
                                        //group eliments
                                        if (empty($prod->DescriptiveElementGroup)) {
                                            $DescriptiveElements = [];
                                        } else {
                                            $DescriptiveElements = $prod->DescriptiveElementGroup->DescriptiveElements;
                                        }
                                        $cate_array_count = 0;
                                        if (!empty($DescriptiveElements)) {
                                            $cate_array_count = count($DescriptiveElements);
                                        }
                                        $desc_e_name1 = "";
                                        $desc_e_value1 = "";
                                        $desc_e_name2 = "";
                                        $desc_e_value2 = "";
                                        $desc_e_name3 = "";
                                        $desc_e_value3 = "";
                                        $desc_e_name4 = "";
                                        $desc_e_value4 = "";
                                        $desc_e_name5 = "";
                                        $desc_e_value5 = "";
                                        $desc_e_name6 = "";
                                        $desc_e_value6 = "";
                                        $desc_e_name7 = "";
                                        $desc_e_value7 = "";
                                        $desc_e_name8 = "";
                                        $desc_e_value8 = "";
                                        $desc_e_name9 = "";
                                        $desc_e_value9 = "";
                                        $desc_e_name10 = "";
                                        $desc_e_value10 = "";
                                        $desc_e_name11 = "";
                                        $desc_e_value11 = "";
                                        $desc_e_name12 = "";
                                        $desc_e_value12 = "";
                                        $desc_e_name13 = "";
                                        $desc_e_value13 = "";
                                        $desc_e_name14 = "";
                                        $desc_e_value14 = "";
                                        $desc_e_name15 = "";
                                        $desc_e_value15 = "";
                                        if ($cate_array_count >= 1) {
                                            $desc_e_name1 = $DescriptiveElements[0]->Name;
                                            $desc_e_value1 = str_replace("K X1", "K Forever", $DescriptiveElements[0]->DisplayValue);
                                        }
                                        if ($cate_array_count >= 2) {
                                            $desc_e_name2 = $DescriptiveElements[1]->Name;
                                            $desc_e_value2 = str_replace("K X1", "K Forever", $DescriptiveElements[1]->DisplayValue);
                                        }
                                        if ($cate_array_count >= 3) {
                                            $desc_e_name3 = $DescriptiveElements[2]->Name;
                                            $desc_e_value3 = str_replace("K X1", "K Forever", $DescriptiveElements[2]->DisplayValue);
                                        }
                                        if ($cate_array_count >= 4) {
                                            $desc_e_name4 = $DescriptiveElements[3]->Name;
                                            $desc_e_value4 = str_replace("K X1", "K Forever", $DescriptiveElements[3]->DisplayValue);
                                        }
                                        if ($cate_array_count >= 5) {
                                            $desc_e_name5 = $DescriptiveElements[4]->Name;
                                            $desc_e_value5 = str_replace("K X1", "K Forever", $DescriptiveElements[4]->DisplayValue);
                                        }
                                        if ($cate_array_count >= 6) {
                                            $desc_e_name6 = $DescriptiveElements[5]->Name;
                                            $desc_e_value6 = str_replace("K X1", "K Forever", $DescriptiveElements[5]->DisplayValue);
                                        }
                                        if ($cate_array_count >= 7) {
                                            $desc_e_name7 = $DescriptiveElements[6]->Name;
                                            $desc_e_value7 = str_replace("K X1", "K Forever", $DescriptiveElements[6]->DisplayValue);
                                        }
                                        if ($cate_array_count >= 8) {
                                            $desc_e_name8 = $DescriptiveElements[7]->Name;
                                            $desc_e_value8 = str_replace("K X1", "K Forever", $DescriptiveElements[7]->DisplayValue);
                                        }
                                        if ($cate_array_count >= 9) {
                                            $desc_e_name9 = $DescriptiveElements[8]->Name;
                                            $desc_e_value9 = str_replace("K X1", "K Forever", $DescriptiveElements[8]->DisplayValue);
                                        }
                                        if ($cate_array_count >= 10) {
                                            $desc_e_name10 = $DescriptiveElements[9]->Name;
                                            $desc_e_value10 = str_replace("K X1", "K Forever", $DescriptiveElements[9]->DisplayValue);
                                        }
                                        if ($cate_array_count >= 11) {
                                            $desc_e_name11 = $DescriptiveElements[10]->Name;
                                            $desc_e_value11 = str_replace("K X1", "K Forever", $DescriptiveElements[10]->DisplayValue);
                                        }
                                        if ($cate_array_count >= 12) {
                                            $desc_e_name12 = $DescriptiveElements[11]->Name;
                                            $desc_e_value12 = str_replace("K X1", "K Forever", $DescriptiveElements[11]->DisplayValue);
                                        }
                                        if ($cate_array_count >= 13) {
                                            $desc_e_name13 = $DescriptiveElements[12]->Name;
                                            $desc_e_value13 = str_replace("K X1", "K Forever", $DescriptiveElements[12]->DisplayValue);
                                        }
                                        if ($cate_array_count >= 14) {
                                            $desc_e_name14 = $DescriptiveElements[13]->Name;
                                            $desc_e_value14 = str_replace("K X1", "K Forever", $DescriptiveElements[13]->DisplayValue);
                                        }
                                        if ($cate_array_count >= 15) {
                                            $desc_e_name15 = $DescriptiveElements[14]->Name;
                                            $desc_e_value15 = str_replace("K X1", "K Forever", $DescriptiveElements[14]->DisplayValue);
                                        }
                                        $image1 = "";
                                        $image2 = "";
                                        $image3 = "";
                                        $image4 = "";
                                        $image5 = "";
                                        $image6 = "";
                                        $gimage1 = "";
                                        $gimage2 = "";
                                        $gimage3 = "";
                                        $fullysetimage1 = "";
                                        $fullysetimage2 = "";
                                        $fullysetimage3 = "";
                                        $fullysetimage4 = "";
                                        $fullysetimage5 = "";
                                        $fullysetimage6 = "";
                                        //get images
                                        // if(!empty($prod->Images)){
                                        //   $image1= $prod->Images[0]->FullUrl;
                                        //   $image2= $prod->Images[0]->ThumbnailUrl;
                                        //   $image3= $prod->Images[0]->ZoomUrl;
                                        // }
                                        // if(!empty($prod->GroupImages)){
                                        //   $gimage1= $prod->GroupImages[0]->ZoomUrl;
                                        //   $gimage2= $prod->GroupImages[0]->ZoomUrl;
                                        //   $gimage3= $prod->GroupImages[0]->ZoomUrl;
                                        // }
                                        //get images
                                        if (!empty($prod->Images)) {
                                            $image_peram_count = count($prod->Images);
                                            if ($image_peram_count >= 1) {
                                                $image1 = $prod->Images[0]->FullUrl;
                                            }
                                            if ($image_peram_count >= 2) {
                                                $image2 = $prod->Images[1]->FullUrl;
                                            }
                                            if ($image_peram_count >= 3) {
                                                $image3 = $prod->Images[2]->FullUrl;
                                            }
                                            if ($image_peram_count >= 4) {
                                                $image4 = $prod->Images[3]->FullUrl;
                                            }
                                            if ($image_peram_count >= 5) {
                                                $image5 = $prod->Images[4]->FullUrl;
                                            }
                                            if ($image_peram_count >= 6) {
                                                $image5 = $prod->Images[5]->FullUrl;
                                            }
                                            // $image1= $prod->Images[0]->FullUrl;
                                            // $image2= $prod->Images[0]->ThumbnailUrl;
                                            // $image3= $prod->Images[0]->ZoomUrl;
                                        }
                                        //get group images
                                        if (!empty($prod->GroupImages)) {
                                            $Groupimage_peram_count = count($prod->GroupImages);
                                            if ($Groupimage_peram_count >= 1) {
                                                $gimage1 = $prod->GroupImages[0]->FullUrl;
                                            }
                                            if ($Groupimage_peram_count >= 2) {
                                                $gimage2 = $prod->GroupImages[1]->FullUrl;
                                            }
                                            if ($Groupimage_peram_count >= 3) {
                                                $gimage3 = $prod->GroupImages[2]->FullUrl;
                                            }
                                            // $gimage1= $prod->GroupImages[0]->ZoomUrl;
                                            // $gimage2= $prod->GroupImages[0]->ZoomUrl;
                                            // $gimage3= $prod->GroupImages[0]->ZoomUrl;
                                        }
                                        //get Fully Set Images images
                                        if (!empty($prod->FullySetImages)) {
                                            $FullySetimage_peram_count = count($prod->FullySetImages);
                                            if ($FullySetimage_peram_count >= 1) {
                                                $fullysetimage1 = $prod->FullySetImages[0]->FullUrl;
                                            }
                                            if ($FullySetimage_peram_count >= 2) {
                                                $fullysetimage2 = $prod->FullySetImages[1]->FullUrl;
                                            }
                                            if ($FullySetimage_peram_count >= 3) {
                                                $fullysetimage3 = $prod->FullySetImages[2]->FullUrl;
                                            }
                                            if ($FullySetimage_peram_count >= 4) {
                                                $fullysetimage4 = $prod->FullySetImages[3]->FullUrl;
                                            }
                                            if ($FullySetimage_peram_count >= 5) {
                                                $fullysetimage5 = $prod->FullySetImages[4]->FullUrl;
                                            }
                                            if ($FullySetimage_peram_count >= 6) {
                                                $fullysetimage6 = $prod->FullySetImages[5]->FullUrl;
                                            }
                                            // $image1= $prod->Images[0]->FullUrl;
                                            // $image2= $prod->Images[0]->ThumbnailUrl;
                                            // $image3= $prod->Images[0]->ZoomUrl;
                                        }
                                        //get AGTA
                                        if (!empty($prod->AGTA)) {
                                            $agta = $prod->AGTA;
                                        } else {
                                            $agta = "";
                                        }
                                        //get MerchandisingCategory
                                        $mcat1 = "";
                                        $mcat2 = "";
                                        $mcat3 = "";
                                        $mcat4 = "";
                                        $mcat5 = "";
                                        if (!empty($prod->MerchandisingCategory1)) {
                                            $mcat1 = $prod->MerchandisingCategory1;
                                        }
                                        if (!empty($prod->MerchandisingCategory2)) {
                                            $mcat2 = $prod->MerchandisingCategory2;
                                        }
                                        if (!empty($prod->MerchandisingCategory3)) {
                                            $mcat3 = $prod->MerchandisingCategory3;
                                        }
                                        if (!empty($prod->MerchandisingCategory4)) {
                                            $mcat4 = $prod->MerchandisingCategory4;
                                        }
                                        if (!empty($prod->MerchandisingCategory5)) {
                                            $mcat5 = $prod->MerchandisingCategory5;
                                        }
                                        $Description = "";
                                        if (!empty($prod->Description)) {
                                            $Description = str_replace("K X1", "K Forever", $prod->Description);
                                        }
                                        $ShortDescription = "";
                                        if (!empty($prod->ShortDescription)) {
                                            $ShortDescription = str_replace("K X1", "K Forever", $prod->ShortDescription);
                                        }
                                        $GroupDescription = "";
                                        if (!empty($prod->GroupDescription)) {
                                            $GroupDescription = str_replace("K X1", "K Forever", $prod->GroupDescription);
                                        }
                                        $LeadTime = "";
                                        if (!empty($prod->LeadTime)) {
                                            $LeadTime = $prod->LeadTime;
                                        }
                                        //get vedio and Group vedios
                                        $vedio = "";
                                        $gvedio = "";
                                        if (!empty($prod->Videos)) {
                                            $vedio = $prod->Videos[0]->DownloadUrl;
                                        }
                                        if (!empty($prod->GroupVideos)) {
                                            $gvedio = $prod->GroupVideos[0]->Url;
                                        }
                                        //get vedio and Group vedios
                                        $vedio = "";
                                        $gvedio = "";
                                        if (!empty($prod->Videos)) {
                                            $vedio = $prod->Videos[0]->DownloadUrl;
                                        }
                                        if (!empty($prod->GroupVideos)) {
                                            $gvedio = $prod->GroupVideos[0]->Url;
                                        }
                                        //explode sku for get and save sku series and sku series type start
                                        $sku_no = $prod->SKU;
                                        if (is_numeric($sku_no[0])) {
                                            $sku_ar = explode(":", $sku_no);
                                        } else {
                                            $arr = (str_split($sku_no));
                                            $l = count($arr);
                                            for ($i = 0; $i <= $l; $i++) {
                                                if (is_numeric($arr[$i])) {
                                                    array_splice($arr, $i, 0, ":");
                                                    break;
                                                }
                                            }
                                            $s = join($arr);
                                            $sku_ar = explode(":", $s);
                                        }
                                        $cate_param_count = count($sku_ar);
                                        $sku_series = "";
                                        $sku_series_type1 = "";
                                        $sku_series_type2 = "";
                                        $sku_series_type3 = "";
                                        if ($cate_param_count >= 1) {
                                            $sku_series = $sku_ar[0];
                                        }
                                        if ($cate_param_count >= 2) {
                                            $sku_series_type1 = $sku_ar[1];
                                        }
                                        if ($cate_param_count >= 3) {
                                            $sku_series_type2 = $sku_ar[2];
                                        }
                                        if ($cate_param_count >= 4) {
                                            $sku_series_type3 = $sku_ar[3];
                                        }
                                        $ProductType = "";
                                        if (!empty($prod->ProductType)) {
                                            $ProductType = $prod->ProductType;
                                        }
                                        $OnHand = "";
                                        if (!empty($prod->OnHand)) {
                                            $OnHand = $prod->OnHand;
                                        }
                                        $Status = "";
                                        if (!empty($prod->Status)) {
                                            $Status = $prod->Status;
                                        }
                                        $Value = "";
                                        if (!empty($prod->Price->Value)) {
                                            $Value = $prod->Price->Value;
                                        }
                                        $CurrencyCode = "";
                                        if (!empty($prod->Price->CurrencyCode)) {
                                            $CurrencyCode = $prod->Price->CurrencyCode;
                                        }
                                        $UnitOfSale = "";
                                        if (!empty($prod->UnitOfSale)) {
                                            $UnitOfSale = $prod->UnitOfSale;
                                        }
                                        $Weight = "";
                                        if (!empty($prod->Weight)) {
                                            $Weight = $prod->Weight;
                                        }
                                        $WeightUnitOfMeasure = "";
                                        if (!empty($prod->WeightUnitOfMeasure)) {
                                            $WeightUnitOfMeasure = $prod->WeightUnitOfMeasure;
                                        }
                                        $GramWeight = "";
                                        if (!empty($prod->GramWeight)) {
                                            $GramWeight = $prod->GramWeight;
                                        }
                                        $GroupName = "";
                                        if (!empty($prod->DescriptiveElementGroup->GroupName)) {
                                            $GroupName = $prod->DescriptiveElementGroup->GroupName;
                                        }
                                        $CreationDate = "";
                                        if (!empty($prod->CreationDate)) {
                                            $CreationDate = $prod->CreationDate;
                                        }
                                        $CountryOfOrigin = "";
                                        if (!empty($prod->CountryOfOrigin)) {
                                            $CountryOfOrigin = $prod->CountryOfOrigin;
                                        }
                                        $RingSizable = "";
                                        if (!empty($prod->RingSizable)) {
                                            $RingSizable = $prod->RingSizable;
                                        }
                                        $ReadyToWear = "";
                                        if (!empty($prod->ReadyToWear)) {
                                            $ReadyToWear = $prod->ReadyToWear;
                                        }
                                        //specifications
                                        if (empty($prod->Specifications)) {
                                            $specifications = "";
                                        } else {
                                            $specifications = $prod->Specifications;
                                        }
                                        //comessetwith
                                        if (empty($prod->CanBeSetWith)) {
                                            $canbesetwith = "";
                                        } else {
                                            $canbesetwith = $prod->CanBeSetWith;
                                        }
                                        //SetWith
                                        if (empty($prod->SetWith)) {
                                            $setwith = "";
                                        } else {
                                            $setwith = $prod->SetWith;
                                        }
                                        //ringsize
                                        $ringSizeArray = [];
                                        // print_r($prod->ConfigurationModel->RingSizeOptions);die();
                                        if (!empty($prod->ConfigurationModel)) {
                                            if (empty($prod->ConfigurationModel->RingSizeOptions)) {
                                                $ringSizeArray = "";
                                            } else {
                                                foreach ($prod->ConfigurationModel->RingSizeOptions as $configModel) {
                                                    $ringSizeArray[] = array(
                                                        "Size" => number_format((float)$configModel->Size, 2, '.', ''),
                                                        "Price" => $configModel->Price->Value
                                                    );
                                                }
                                            }
                                        } else {
                                            $ringSizeArray = "";
                                        }
                                        //explode sku for get and save sku series and sku series type end
                                        if (!empty($prod->Price->Value)) {
                                            if ($prod->Price->Value > $MINIMUM_COST) {
                                                $data_insert = array(
                                                    'product_id' => $prod->Id,
                                                    'category' => $category_id,
                                                    // 'sub_category'=>$subcategory,
                                                    // 'minisub_category'=>$minisubcategory,
                                                    // 'vendor'=>1,
                                                    'sku' => $prod->SKU,
                                                    'sku_series' => $sku_series,
                                                    'sku_series_type1' => $sku_series_type1,
                                                    'sku_series_type2' => $sku_series_type2,
                                                    'sku_series_type3' => $sku_series_type3,
                                                    'description' => $Description,
                                                    'sdesc' => $ShortDescription,
                                                    'gdesc' => $GroupDescription,
                                                    'mcat1' => $mcat1,
                                                    'mcat2' => $mcat2,
                                                    'mcat3' => $mcat3,
                                                    'mcat4' => $mcat4,
                                                    'mcat5' => $mcat5,
                                                    'product_type' => $ProductType,
                                                    'collection' => "",
                                                    'onhand' => $OnHand,
                                                    'status' => $Status,
                                                    'price' => $Value,
                                                    'currency' => $CurrencyCode,
                                                    'unitofsale' => $UnitOfSale,
                                                    'weight' => $Weight,
                                                    'weightunit' => $WeightUnitOfMeasure,
                                                    'gramweight' => $GramWeight,
                                                    'ringsizable' => $RingSizable,
                                                    'ringsize' => $ringsize,
                                                    'ringsizetype' => $ringsizetype,
                                                    'leadtime' => $LeadTime,
                                                    'agta' => $agta,
                                                    'desc_e_grp' => $GroupName,
                                                    'desc_e_name1' => $desc_e_name1,
                                                    'desc_e_value1' => ltrim($desc_e_value1),
                                                    'desc_e_name2' => $desc_e_name2,
                                                    'desc_e_value2' => ltrim($desc_e_value2),
                                                    'desc_e_name3' => $desc_e_name3,
                                                    'desc_e_value3' => ltrim($desc_e_value3),
                                                    'desc_e_name4' => $desc_e_name4,
                                                    'desc_e_value4' => ltrim($desc_e_value4),
                                                    'desc_e_name5' => $desc_e_name5,
                                                    'desc_e_value5' => ltrim($desc_e_value5),
                                                    'desc_e_name6' => $desc_e_name6,
                                                    'desc_e_value6' => ltrim($desc_e_value6),
                                                    'desc_e_name7' => $desc_e_name7,
                                                    'desc_e_value7' => ltrim($desc_e_value7),
                                                    'desc_e_name8' => $desc_e_name8,
                                                    'desc_e_value8' => ltrim($desc_e_value8),
                                                    'desc_e_name9' => $desc_e_name9,
                                                    'desc_e_value9' => ltrim($desc_e_value9),
                                                    'desc_e_name10' => $desc_e_name10,
                                                    'desc_e_value10' => ltrim($desc_e_value10),
                                                    'desc_e_name11' => $desc_e_name11,
                                                    'desc_e_value11' => ltrim($desc_e_value11),
                                                    'desc_e_name12' => $desc_e_name12,
                                                    'desc_e_value12' => ltrim($desc_e_value12),
                                                    'desc_e_name13' => $desc_e_name13,
                                                    'desc_e_value13' => ltrim($desc_e_value13),
                                                    'desc_e_name14' => $desc_e_name14,
                                                    'desc_e_value14' => ltrim($desc_e_value14),
                                                    'desc_e_name15' => $desc_e_name15,
                                                    'desc_e_value15' => ltrim($desc_e_value15),
                                                    'readytowear' => $ReadyToWear,
                                                    'smi' => "",
                                                    'image1' => $image1,
                                                    'image2' => $image2,
                                                    'image3' => $image3,
                                                    'image4' => $image4,
                                                    'image5' => $image5,
                                                    'image6' => $image6,
                                                    'FullySetImage1' => $fullysetimage1,
                                                    'FullySetImage2' => $fullysetimage2,
                                                    'FullySetImage3' => $fullysetimage3,
                                                    'FullySetImage4' => $fullysetimage4,
                                                    'FullySetImage5' => $fullysetimage5,
                                                    'FullySetImage6' => $fullysetimage6,
                                                    'video' => $vedio,
                                                    'gimage1' => $gimage1,
                                                    'gimage2' => $gimage2,
                                                    'gimage3' => $gimage3,
                                                    'gvideo' => $gvedio,
                                                    'creationdate' => $CreationDate,
                                                    'currencycode' => "USD",
                                                    'country' => $CountryOfOrigin,
                                                    'dclarity' => "",
                                                    'dcolor' => "",
                                                    'totalweight' => "",
                                                    'ip' => $ip,
                                                    'added_by' => $addedby,
                                                    'is_active' => 1,
                                                    'group_id' => $prod->DescriptiveElementGroup->GroupId,
                                                    'series_id' => $prod->DescriptiveElementGroup->DescriptiveElements[0]->Value,

                                                    'date' => $cur_date
                                                );
                                                $last_id = $this->base_model->insert_table("tbl_products", $data_insert, 1);
                                                $beta_insert = array(
                                                    'product_id' => $last_id,
                                                    'specifications' => json_encode($specifications),
                                                    'canbesetwith' => json_encode($canbesetwith),
                                                    'setwith' => json_encode($setwith),
                                                    'ringsize' => json_encode($ringSizeArray),
                                                );
                                                $spec_id = $this->base_model->insert_table("tbl_product_specifications", $beta_insert, 1);
                                            }
                                        }
                                    }
                                    $NextPage = "";
                                    if (!empty($result_da->NextPage)) {
                                        $NextPage = $result_da->NextPage;
                                    }
                                    // echo $i." NP- ".$NextPage."<br>";
                                }
                            }
                            //Series
                            if ($type == 2) {
                                if ($finshed == 1) {
                                    if ($i == 0) {
                                        $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList","Finished"],"Series":["' . $value . '"]}';
                                        // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"]}';
                                    } else {
                                        $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList","Finished"],"Series":["' . $value . '"],"NextPage":"' . $NextPage . '" }';
                                        // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"],"NextPage":"'.$NextPage.'" }';
                                    }
                                } else {
                                    if ($i == 0) {
                                        $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList"],"Series":["' . $value . '"]}';
                                        // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"]}';
                                    } else {
                                        $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList"],"Series":["' . $value . '"],"NextPage":"' . $NextPage . '" }';
                                        // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"],"NextPage":"'.$NextPage.'" }';
                                    }
                                }
                                $postdata = $data;
                                // echo $postdata;
                                // exit;
                                $header = array();
                                $header[] = 'Host:api.stuller.com';
                                $header[] = 'Content-Type:application/json';
                                $header[] = 'Authorization:Basic ZGV2amV3ZWw6Q29kaW5nMjA9';
                                // echo $url;
                                // exit;
                                $ch = curl_init($url);
                                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                                curl_setopt($ch, CURLOPT_POST, 1);
                                curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                                curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                                $result = curl_exec($ch);
                                curl_close($ch);
                                $result_da = json_decode($result);
                                // echo "<pre>";
                                //
                                // echo "</pre>";
                                if (!empty($result_da->Products)) {
                                    foreach ($result_da->Products as $prod) {
                                        $specifications = [];
                                        $ringsize = 0;
                                        $ringsizetype = "";
                                        $RingSizable = "";
                                        if (!empty($prod->RingSizable)) {
                                            $RingSizable = $prod->RingSizable;
                                            if ($RingSizable == false) {
                                                $ringsize = 0;
                                                $ringsizetype = "";
                                            } else {
                                                if (!empty($prod->ringsize)) {
                                                    $ringsize = $prod->ringsize;
                                                }
                                                if (!empty($prod->ringsizetype)) {
                                                    $ringsizetype = $prod->ringsizetype;
                                                }
                                            }
                                        }
                                        //group eliments
                                        if (empty($prod->DescriptiveElementGroup)) {
                                            $DescriptiveElements = [];
                                        } else {
                                            $DescriptiveElements = $prod->DescriptiveElementGroup->DescriptiveElements;
                                        }
                                        $cate_array_count = 0;
                                        if (!empty($DescriptiveElements)) {
                                            $cate_array_count = count($DescriptiveElements);
                                        }
                                        $desc_e_name1 = "";
                                        $desc_e_value1 = "";
                                        $desc_e_name2 = "";
                                        $desc_e_value2 = "";
                                        $desc_e_name3 = "";
                                        $desc_e_value3 = "";
                                        $desc_e_name4 = "";
                                        $desc_e_value4 = "";
                                        $desc_e_name5 = "";
                                        $desc_e_value5 = "";
                                        $desc_e_name6 = "";
                                        $desc_e_value6 = "";
                                        $desc_e_name7 = "";
                                        $desc_e_value7 = "";
                                        $desc_e_name8 = "";
                                        $desc_e_value8 = "";
                                        $desc_e_name9 = "";
                                        $desc_e_value9 = "";
                                        $desc_e_name10 = "";
                                        $desc_e_value10 = "";
                                        $desc_e_name11 = "";
                                        $desc_e_value11 = "";
                                        $desc_e_name12 = "";
                                        $desc_e_value12 = "";
                                        $desc_e_name13 = "";
                                        $desc_e_value13 = "";
                                        $desc_e_name14 = "";
                                        $desc_e_value14 = "";
                                        $desc_e_name15 = "";
                                        $desc_e_value15 = "";
                                        if ($cate_array_count >= 1) {
                                            $desc_e_name1 = $DescriptiveElements[0]->Name;
                                            $desc_e_value1 = str_replace("K X1", "K Forever", $DescriptiveElements[0]->DisplayValue);
                                        }
                                        if ($cate_array_count >= 2) {
                                            $desc_e_name2 = $DescriptiveElements[1]->Name;
                                            $desc_e_value2 = str_replace("K X1", "K Forever", $DescriptiveElements[1]->DisplayValue);
                                        }
                                        if ($cate_array_count >= 3) {
                                            $desc_e_name3 = $DescriptiveElements[2]->Name;
                                            $desc_e_value3 = str_replace("K X1", "K Forever", $DescriptiveElements[2]->DisplayValue);
                                        }
                                        if ($cate_array_count >= 4) {
                                            $desc_e_name4 = $DescriptiveElements[3]->Name;
                                            $desc_e_value4 = str_replace("K X1", "K Forever", $DescriptiveElements[3]->DisplayValue);
                                        }
                                        if ($cate_array_count >= 5) {
                                            $desc_e_name5 = $DescriptiveElements[4]->Name;
                                            $desc_e_value5 = str_replace("K X1", "K Forever", $DescriptiveElements[4]->DisplayValue);
                                        }
                                        if ($cate_array_count >= 6) {
                                            $desc_e_name6 = $DescriptiveElements[5]->Name;
                                            $desc_e_value6 = str_replace("K X1", "K Forever", $DescriptiveElements[5]->DisplayValue);
                                        }
                                        if ($cate_array_count >= 7) {
                                            $desc_e_name7 = $DescriptiveElements[6]->Name;
                                            $desc_e_value7 = str_replace("K X1", "K Forever", $DescriptiveElements[6]->DisplayValue);
                                        }
                                        if ($cate_array_count >= 8) {
                                            $desc_e_name8 = $DescriptiveElements[7]->Name;
                                            $desc_e_value8 = str_replace("K X1", "K Forever", $DescriptiveElements[7]->DisplayValue);
                                        }
                                        if ($cate_array_count >= 9) {
                                            $desc_e_name9 = $DescriptiveElements[8]->Name;
                                            $desc_e_value9 = str_replace("K X1", "K Forever", $DescriptiveElements[8]->DisplayValue);
                                        }
                                        if ($cate_array_count >= 10) {
                                            $desc_e_name10 = $DescriptiveElements[9]->Name;
                                            $desc_e_value10 = str_replace("K X1", "K Forever", $DescriptiveElements[9]->DisplayValue);
                                        }
                                        if ($cate_array_count >= 11) {
                                            $desc_e_name11 = $DescriptiveElements[10]->Name;
                                            $desc_e_value11 = str_replace("K X1", "K Forever", $DescriptiveElements[10]->DisplayValue);
                                        }
                                        if ($cate_array_count >= 12) {
                                            $desc_e_name12 = $DescriptiveElements[11]->Name;
                                            $desc_e_value12 = str_replace("K X1", "K Forever", $DescriptiveElements[11]->DisplayValue);
                                        }
                                        if ($cate_array_count >= 13) {
                                            $desc_e_name13 = $DescriptiveElements[12]->Name;
                                            $desc_e_value13 = str_replace("K X1", "K Forever", $DescriptiveElements[12]->DisplayValue);
                                        }
                                        if ($cate_array_count >= 14) {
                                            $desc_e_name14 = $DescriptiveElements[13]->Name;
                                            $desc_e_value14 = str_replace("K X1", "K Forever", $DescriptiveElements[13]->DisplayValue);
                                        }
                                        if ($cate_array_count >= 15) {
                                            $desc_e_name15 = $DescriptiveElements[14]->Name;
                                            $desc_e_value15 = str_replace("K X1", "K Forever", $DescriptiveElements[14]->DisplayValue);
                                        }
                                        $image1 = "";
                                        $image2 = "";
                                        $image3 = "";
                                        $image4 = "";
                                        $image5 = "";
                                        $image6 = "";
                                        $gimage1 = "";
                                        $gimage2 = "";
                                        $gimage3 = "";
                                        $fullysetimage1 = "";
                                        $fullysetimage2 = "";
                                        $fullysetimage3 = "";
                                        $fullysetimage4 = "";
                                        $fullysetimage5 = "";
                                        $fullysetimage6 = "";
                                        //get images
                                        // if(!empty($prod->Images)){
                                        //   $image1= $prod->Images[0]->FullUrl;
                                        //   $image2= $prod->Images[0]->ThumbnailUrl;
                                        //   $image3= $prod->Images[0]->ZoomUrl;
                                        // }
                                        // if(!empty($prod->GroupImages)){
                                        //   $gimage1= $prod->GroupImages[0]->ZoomUrl;
                                        //   $gimage2= $prod->GroupImages[0]->ZoomUrl;
                                        //   $gimage3= $prod->GroupImages[0]->ZoomUrl;
                                        // }
                                        //get images
                                        if (!empty($prod->Images)) {
                                            $image_peram_count = count($prod->Images);
                                            if ($image_peram_count >= 1) {
                                                $image1 = $prod->Images[0]->FullUrl;
                                            }
                                            if ($image_peram_count >= 2) {
                                                $image2 = $prod->Images[1]->FullUrl;
                                            }
                                            if ($image_peram_count >= 3) {
                                                $image3 = $prod->Images[2]->FullUrl;
                                            }
                                            if ($image_peram_count >= 4) {
                                                $image4 = $prod->Images[3]->FullUrl;
                                            }
                                            if ($image_peram_count >= 5) {
                                                $image5 = $prod->Images[4]->FullUrl;
                                            }
                                            if ($image_peram_count >= 6) {
                                                $image5 = $prod->Images[5]->FullUrl;
                                            }
                                            // $image1= $prod->Images[0]->FullUrl;
                                            // $image2= $prod->Images[0]->ThumbnailUrl;
                                            // $image3= $prod->Images[0]->ZoomUrl;
                                        }
                                        //get group images
                                        if (!empty($prod->GroupImages)) {
                                            $Groupimage_peram_count = count($prod->GroupImages);
                                            if ($Groupimage_peram_count >= 1) {
                                                $gimage1 = $prod->GroupImages[0]->FullUrl;
                                            }
                                            if ($Groupimage_peram_count >= 2) {
                                                $gimage2 = $prod->GroupImages[1]->FullUrl;
                                            }
                                            if ($Groupimage_peram_count >= 3) {
                                                $gimage3 = $prod->GroupImages[2]->FullUrl;
                                            }
                                            // $gimage1= $prod->GroupImages[0]->ZoomUrl;
                                            // $gimage2= $prod->GroupImages[0]->ZoomUrl;
                                            // $gimage3= $prod->GroupImages[0]->ZoomUrl;
                                        }
                                        //get Fully Set Images images
                                        if (!empty($prod->FullySetImages)) {
                                            $FullySetimage_peram_count = count($prod->FullySetImages);
                                            if ($FullySetimage_peram_count >= 1) {
                                                $fullysetimage1 = $prod->FullySetImages[0]->FullUrl;
                                            }
                                            if ($FullySetimage_peram_count >= 2) {
                                                $fullysetimage2 = $prod->FullySetImages[1]->FullUrl;
                                            }
                                            if ($FullySetimage_peram_count >= 3) {
                                                $fullysetimage3 = $prod->FullySetImages[2]->FullUrl;
                                            }
                                            if ($FullySetimage_peram_count >= 4) {
                                                $fullysetimage4 = $prod->FullySetImages[3]->FullUrl;
                                            }
                                            if ($FullySetimage_peram_count >= 5) {
                                                $fullysetimage5 = $prod->FullySetImages[4]->FullUrl;
                                            }
                                            if ($FullySetimage_peram_count >= 6) {
                                                $fullysetimage6 = $prod->FullySetImages[5]->FullUrl;
                                            }
                                            // $image1= $prod->Images[0]->FullUrl;
                                            // $image2= $prod->Images[0]->ThumbnailUrl;
                                            // $image3= $prod->Images[0]->ZoomUrl;
                                        }
                                        //get AGTA
                                        if (!empty($prod->AGTA)) {
                                            $agta = $prod->AGTA;
                                        } else {
                                            $agta = "";
                                        }
                                        //get MerchandisingCategory
                                        $mcat1 = "";
                                        $mcat2 = "";
                                        $mcat3 = "";
                                        $mcat4 = "";
                                        $mcat5 = "";
                                        if (!empty($prod->MerchandisingCategory1)) {
                                            $mcat1 = $prod->MerchandisingCategory1;
                                        }
                                        if (!empty($prod->MerchandisingCategory2)) {
                                            $mcat2 = $prod->MerchandisingCategory2;
                                        }
                                        if (!empty($prod->MerchandisingCategory3)) {
                                            $mcat3 = $prod->MerchandisingCategory3;
                                        }
                                        if (!empty($prod->MerchandisingCategory4)) {
                                            $mcat4 = $prod->MerchandisingCategory4;
                                        }
                                        if (!empty($prod->MerchandisingCategory5)) {
                                            $mcat5 = $prod->MerchandisingCategory5;
                                        }
                                        $Description = "";
                                        if (!empty($prod->Description)) {
                                            $Description = str_replace("K X1", "K Forever", $prod->Description);
                                        }
                                        $ShortDescription = "";
                                        if (!empty($prod->ShortDescription)) {
                                            $ShortDescription = str_replace("K X1", "K Forever", $prod->ShortDescription);
                                        }
                                        $GroupDescription = "";
                                        if (!empty($prod->GroupDescription)) {
                                            $GroupDescription = str_replace("K X1", "K Forever", $prod->GroupDescription);
                                        }
                                        $LeadTime = "";
                                        if (!empty($prod->LeadTime)) {
                                            $LeadTime = $prod->LeadTime;
                                        }
                                        //get vedio and Group vedios
                                        $vedio = "";
                                        $gvedio = "";
                                        if (!empty($prod->Videos)) {
                                            $vedio = $prod->Videos[0]->DownloadUrl;
                                        }
                                        if (!empty($prod->GroupVideos)) {
                                            $gvedio = $prod->GroupVideos[0]->Url;
                                        }
                                        //get vedio and Group vedios
                                        $vedio = "";
                                        $gvedio = "";
                                        if (!empty($prod->Videos)) {
                                            $vedio = $prod->Videos[0]->DownloadUrl;
                                        }
                                        if (!empty($prod->GroupVideos)) {
                                            $gvedio = $prod->GroupVideos[0]->Url;
                                        }
                                        //explode sku for get and save sku series and sku series type start
                                        $sku_no = $prod->SKU;
                                        if (is_numeric($sku_no[0])) {
                                            $sku_ar = explode(":", $sku_no);
                                        } else {
                                            $arr = (str_split($sku_no));
                                            $l = count($arr);
                                            for ($i = 0; $i <= $l; $i++) {
                                                if (is_numeric($arr[$i])) {
                                                    array_splice($arr, $i, 0, ":");
                                                    break;
                                                }
                                            }
                                            $s = join($arr);
                                            $sku_ar = explode(":", $s);
                                        }
                                        $cate_param_count = count($sku_ar);
                                        $sku_series = "";
                                        $sku_series_type1 = "";
                                        $sku_series_type2 = "";
                                        $sku_series_type3 = "";
                                        if ($cate_param_count >= 1) {
                                            $sku_series = $sku_ar[0];
                                        }
                                        if ($cate_param_count >= 2) {
                                            $sku_series_type1 = $sku_ar[1];
                                        }
                                        if ($cate_param_count >= 3) {
                                            $sku_series_type2 = $sku_ar[2];
                                        }
                                        if ($cate_param_count >= 4) {
                                            $sku_series_type3 = $sku_ar[3];
                                        }
                                        $ProductType = "";
                                        if (!empty($prod->ProductType)) {
                                            $ProductType = $prod->ProductType;
                                        }
                                        $OnHand = "";
                                        if (!empty($prod->OnHand)) {
                                            $OnHand = $prod->OnHand;
                                        }
                                        $Status = "";
                                        if (!empty($prod->Status)) {
                                            $Status = $prod->Status;
                                        }
                                        $Value = "";
                                        if (!empty($prod->Price->Value)) {
                                            $Value = $prod->Price->Value;
                                        }
                                        $CurrencyCode = "";
                                        if (!empty($prod->Price->CurrencyCode)) {
                                            $CurrencyCode = $prod->Price->CurrencyCode;
                                        }
                                        $UnitOfSale = "";
                                        if (!empty($prod->UnitOfSale)) {
                                            $UnitOfSale = $prod->UnitOfSale;
                                        }
                                        $Weight = "";
                                        if (!empty($prod->Weight)) {
                                            $Weight = $prod->Weight;
                                        }
                                        $WeightUnitOfMeasure = "";
                                        if (!empty($prod->WeightUnitOfMeasure)) {
                                            $WeightUnitOfMeasure = $prod->WeightUnitOfMeasure;
                                        }
                                        $GramWeight = "";
                                        if (!empty($prod->GramWeight)) {
                                            $GramWeight = $prod->GramWeight;
                                        }
                                        $GroupName = "";
                                        if (!empty($prod->DescriptiveElementGroup->GroupName)) {
                                            $GroupName = $prod->DescriptiveElementGroup->GroupName;
                                        }
                                        $CreationDate = "";
                                        if (!empty($prod->CreationDate)) {
                                            $CreationDate = $prod->CreationDate;
                                        }
                                        $CountryOfOrigin = "";
                                        if (!empty($prod->CountryOfOrigin)) {
                                            $CountryOfOrigin = $prod->CountryOfOrigin;
                                        }
                                        $RingSizable = "";
                                        if (!empty($prod->RingSizable)) {
                                            $RingSizable = $prod->RingSizable;
                                        }
                                        $ReadyToWear = "";
                                        if (!empty($prod->ReadyToWear)) {
                                            $ReadyToWear = $prod->ReadyToWear;
                                        }
                                        //specifications
                                        if (empty($prod->Specifications)) {
                                            $specifications = "";
                                        } else {
                                            $specifications = $prod->Specifications;
                                        }
                                        //comessetwith
                                        if (empty($prod->CanBeSetWith)) {
                                            $canbesetwith = "";
                                        } else {
                                            $canbesetwith = $prod->CanBeSetWith;
                                        }
                                        //SetWith
                                        if (empty($prod->SetWith)) {
                                            $setwith = "";
                                        } else {
                                            $setwith = $prod->SetWith;
                                        }
                                        //ringsize
                                        $ringSizeArray = [];
                                        // print_r($prod->ConfigurationModel->RingSizeOptions);die();
                                        if (!empty($prod->ConfigurationModel)) {
                                            if (empty($prod->ConfigurationModel->RingSizeOptions)) {
                                                $ringSizeArray = "";
                                            } else {
                                                foreach ($prod->ConfigurationModel->RingSizeOptions as $configModel) {
                                                    $ringSizeArray[] = array(
                                                        "Size" => number_format((float)$configModel->Size, 2, '.', ''),
                                                        "Price" => $configModel->Price->Value
                                                    );
                                                }
                                            }
                                        } else {
                                            $ringSizeArray = "";
                                        }
                                        //explode sku for get and save sku series and sku series type end
                                        if (!empty($prod->Price->Value)) {
                                            if ($prod->Price->Value > $MINIMUM_COST) {
                                                $data_insert = array(
                                                    'product_id' => $prod->Id,
                                                    'category' => $category_id,
                                                    // 'sub_category'=>$subcategory,
                                                    // 'minisub_category'=>$minisubcategory,
                                                    // 'vendor'=>1,
                                                    'sku' => $prod->SKU,
                                                    'sku_series' => $sku_series,
                                                    'sku_series_type1' => $sku_series_type1,
                                                    'sku_series_type2' => $sku_series_type2,
                                                    'sku_series_type3' => $sku_series_type3,
                                                    'description' => $Description,
                                                    'sdesc' => $ShortDescription,
                                                    'gdesc' => $GroupDescription,
                                                    'mcat1' => $mcat1,
                                                    'mcat2' => $mcat2,
                                                    'mcat3' => $mcat3,
                                                    'mcat4' => $mcat4,
                                                    'mcat5' => $mcat5,
                                                    'product_type' => $ProductType,
                                                    'collection' => "",
                                                    'onhand' => $OnHand,
                                                    'status' => $Status,
                                                    'price' => $Value,
                                                    'currency' => $CurrencyCode,
                                                    'unitofsale' => $UnitOfSale,
                                                    'weight' => $Weight,
                                                    'weightunit' => $WeightUnitOfMeasure,
                                                    'gramweight' => $GramWeight,
                                                    'ringsizable' => $RingSizable,
                                                    'ringsize' => $ringsize,
                                                    'ringsizetype' => $ringsizetype,
                                                    'leadtime' => $LeadTime,
                                                    'agta' => $agta,
                                                    'desc_e_grp' => $GroupName,
                                                    'desc_e_name1' => $desc_e_name1,
                                                    'desc_e_value1' => ltrim($desc_e_value1),
                                                    'desc_e_name2' => $desc_e_name2,
                                                    'desc_e_value2' => ltrim($desc_e_value2),
                                                    'desc_e_name3' => $desc_e_name3,
                                                    'desc_e_value3' => ltrim($desc_e_value3),
                                                    'desc_e_name4' => $desc_e_name4,
                                                    'desc_e_value4' => ltrim($desc_e_value4),
                                                    'desc_e_name5' => $desc_e_name5,
                                                    'desc_e_value5' => ltrim($desc_e_value5),
                                                    'desc_e_name6' => $desc_e_name6,
                                                    'desc_e_value6' => ltrim($desc_e_value6),
                                                    'desc_e_name7' => $desc_e_name7,
                                                    'desc_e_value7' => ltrim($desc_e_value7),
                                                    'desc_e_name8' => $desc_e_name8,
                                                    'desc_e_value8' => ltrim($desc_e_value8),
                                                    'desc_e_name9' => $desc_e_name9,
                                                    'desc_e_value9' => ltrim($desc_e_value9),
                                                    'desc_e_name10' => $desc_e_name10,
                                                    'desc_e_value10' => ltrim($desc_e_value10),
                                                    'desc_e_name11' => $desc_e_name11,
                                                    'desc_e_value11' => ltrim($desc_e_value11),
                                                    'desc_e_name12' => $desc_e_name12,
                                                    'desc_e_value12' => ltrim($desc_e_value12),
                                                    'desc_e_name13' => $desc_e_name13,
                                                    'desc_e_value13' => ltrim($desc_e_value13),
                                                    'desc_e_name14' => $desc_e_name14,
                                                    'desc_e_value14' => ltrim($desc_e_value14),
                                                    'desc_e_name15' => $desc_e_name15,
                                                    'desc_e_value15' => ltrim($desc_e_value15),
                                                    'readytowear' => $prod->ReadyToWear,
                                                    'smi' => "",
                                                    'image1' => $image1,
                                                    'image2' => $image2,
                                                    'image3' => $image3,
                                                    'image4' => $image4,
                                                    'image5' => $image5,
                                                    'image6' => $image6,
                                                    'FullySetImage1' => $fullysetimage1,
                                                    'FullySetImage2' => $fullysetimage2,
                                                    'FullySetImage3' => $fullysetimage3,
                                                    'FullySetImage4' => $fullysetimage4,
                                                    'FullySetImage5' => $fullysetimage5,
                                                    'FullySetImage6' => $fullysetimage6,
                                                    'video' => $vedio,
                                                    'gimage1' => $gimage1,
                                                    'gimage2' => $gimage2,
                                                    'gimage3' => $gimage3,
                                                    'gvideo' => $gvedio,
                                                    'creationdate' => $CreationDate,
                                                    'currencycode' => "USD",
                                                    'country' => $CountryOfOrigin,
                                                    'dclarity' => "",
                                                    'dcolor' => "",
                                                    'totalweight' => "",
                                                    'ip' => $ip,
                                                    'added_by' => $addedby,
                                                    'is_active' => 1,
                                                    'group_id' => $prod->DescriptiveElementGroup->GroupId,
                                                    'series_id' => $prod->DescriptiveElementGroup->DescriptiveElements[0]->Value,

                                                    'date' => $cur_date
                                                );
                                                $last_id = $this->base_model->insert_table("tbl_products", $data_insert, 1);
                                                $beta_insert = array(
                                                    'product_id' => $last_id,
                                                    'specifications' => json_encode($specifications),
                                                    'canbesetwith' => json_encode($canbesetwith),
                                                    'setwith' => json_encode($setwith),
                                                    'ringsize' => json_encode($ringSizeArray),
                                                );
                                                $spec_id = $this->base_model->insert_table("tbl_product_specifications", $beta_insert, 1);
                                            }
                                        }
                                    }
                                    $NextPage = "";
                                    if (!empty($result_da->NextPage)) {
                                        $NextPage = $result_da->NextPage;
                                    }
                                    // echo $i." NP- ".$NextPage."<br>";
                                }
                            }
                            // $NextPage= "";
                            // $NextPage= $result_da->NextPage;
                            // echo $i." NP- ".$NextPage."<br>";
                        }
                        //product data insert from the api end
                        // die();
                        // $se++;
                        // echo $TotalNumberOfProducts;
                        // echo "<br />";
                        // }
                        // echo "<br />";
                        // echo $se;exit;
                    }
                    //statr squ
                    if ($type == 3) {
                        // foreach ($api_ids as $value) {
                        $this->db->delete('tbl_products', array('sku' => $value));
                        $url = 'https://api.stuller.com/v2/products?SKU=' . $value;
                        $header = array();
                        $header[] = 'Host:api.stuller.com';
                        $header[] = 'Content-Type:application/json';
                        $header[] = 'Authorization:Basic ZGV2amV3ZWw6Q29kaW5nMjA9';
                        $ch = curl_init($url);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                        // curl_setopt($ch, CURLOPT_POST, 1);
                        // curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                        $result = curl_exec($ch);
                        curl_close($ch);
                        $result_da = json_decode($result);
                        // echo "<pre>";
                        //
                        // echo "</pre>";
                        // print_r($result_da->Products);
                        // print_r($result);
                        // exit;
                        //
                        if (!empty($result_da)) {
                            // if(!empty($result_da->Products)){
                            foreach ($result_da->Products as $prod) {
                                $specifications = [];
                                $ringsize = 0;
                                $ringsizetype = "";
                                $RingSizable = "";
                                if (!empty($prod->RingSizable)) {
                                    $RingSizable = $prod->RingSizable;
                                    if ($RingSizable == false) {
                                        $ringsize = 0;
                                        $ringsizetype = "";
                                    } else {
                                        if (!empty($prod->ringsize)) {
                                            $ringsize = $prod->ringsize;
                                        }
                                        if (!empty($prod->ringsizetype)) {
                                            $ringsizetype = $prod->ringsizetype;
                                        }
                                    }
                                }
                                //group eliments
                                if (empty($prod->DescriptiveElementGroup)) {
                                    $DescriptiveElements = [];
                                } else {
                                    $DescriptiveElements = $prod->DescriptiveElementGroup->DescriptiveElements;
                                }
                                $cate_array_count = 0;
                                if (!empty($DescriptiveElements)) {
                                    $cate_array_count = count($DescriptiveElements);
                                }
                                $desc_e_name1 = "";
                                $desc_e_value1 = "";
                                $desc_e_name2 = "";
                                $desc_e_value2 = "";
                                $desc_e_name3 = "";
                                $desc_e_value3 = "";
                                $desc_e_name4 = "";
                                $desc_e_value4 = "";
                                $desc_e_name5 = "";
                                $desc_e_value5 = "";
                                $desc_e_name6 = "";
                                $desc_e_value6 = "";
                                $desc_e_name7 = "";
                                $desc_e_value7 = "";
                                $desc_e_name8 = "";
                                $desc_e_value8 = "";
                                $desc_e_name9 = "";
                                $desc_e_value9 = "";
                                $desc_e_name10 = "";
                                $desc_e_value10 = "";
                                $desc_e_name11 = "";
                                $desc_e_value11 = "";
                                $desc_e_name12 = "";
                                $desc_e_value12 = "";
                                $desc_e_name13 = "";
                                $desc_e_value13 = "";
                                $desc_e_name14 = "";
                                $desc_e_value14 = "";
                                $desc_e_name15 = "";
                                $desc_e_value15 = "";
                                if ($cate_array_count >= 1) {
                                    $desc_e_name1 = $DescriptiveElements[0]->Name;
                                    $desc_e_value1 = str_replace("K X1", "K Forever", $DescriptiveElements[0]->DisplayValue);
                                }
                                if ($cate_array_count >= 2) {
                                    $desc_e_name2 = $DescriptiveElements[1]->Name;
                                    $desc_e_value2 = str_replace("K X1", "K Forever", $DescriptiveElements[1]->DisplayValue);
                                }
                                if ($cate_array_count >= 3) {
                                    $desc_e_name3 = $DescriptiveElements[2]->Name;
                                    $desc_e_value3 = str_replace("K X1", "K Forever", $DescriptiveElements[2]->DisplayValue);
                                }
                                if ($cate_array_count >= 4) {
                                    $desc_e_name4 = $DescriptiveElements[3]->Name;
                                    $desc_e_value4 = str_replace("K X1", "K Forever", $DescriptiveElements[3]->DisplayValue);
                                }
                                if ($cate_array_count >= 5) {
                                    $desc_e_name5 = $DescriptiveElements[4]->Name;
                                    $desc_e_value5 = str_replace("K X1", "K Forever", $DescriptiveElements[4]->DisplayValue);
                                }
                                if ($cate_array_count >= 6) {
                                    $desc_e_name6 = $DescriptiveElements[5]->Name;
                                    $desc_e_value6 = str_replace("K X1", "K Forever", $DescriptiveElements[5]->DisplayValue);
                                }
                                if ($cate_array_count >= 7) {
                                    $desc_e_name7 = $DescriptiveElements[6]->Name;
                                    $desc_e_value7 = str_replace("K X1", "K Forever", $DescriptiveElements[6]->DisplayValue);
                                }
                                if ($cate_array_count >= 8) {
                                    $desc_e_name8 = $DescriptiveElements[7]->Name;
                                    $desc_e_value8 = str_replace("K X1", "K Forever", $DescriptiveElements[7]->DisplayValue);
                                }
                                if ($cate_array_count >= 9) {
                                    $desc_e_name9 = $DescriptiveElements[8]->Name;
                                    $desc_e_value9 = str_replace("K X1", "K Forever", $DescriptiveElements[8]->DisplayValue);
                                }
                                if ($cate_array_count >= 10) {
                                    $desc_e_name10 = $DescriptiveElements[9]->Name;
                                    $desc_e_value10 = str_replace("K X1", "K Forever", $DescriptiveElements[9]->DisplayValue);
                                }
                                if ($cate_array_count >= 11) {
                                    $desc_e_name11 = $DescriptiveElements[10]->Name;
                                    $desc_e_value11 = str_replace("K X1", "K Forever", $DescriptiveElements[10]->DisplayValue);
                                }
                                if ($cate_array_count >= 12) {
                                    $desc_e_name12 = $DescriptiveElements[11]->Name;
                                    $desc_e_value12 = str_replace("K X1", "K Forever", $DescriptiveElements[11]->DisplayValue);
                                }
                                if ($cate_array_count >= 13) {
                                    $desc_e_name13 = $DescriptiveElements[12]->Name;
                                    $desc_e_value13 = str_replace("K X1", "K Forever", $DescriptiveElements[12]->DisplayValue);
                                }
                                if ($cate_array_count >= 14) {
                                    $desc_e_name14 = $DescriptiveElements[13]->Name;
                                    $desc_e_value14 = str_replace("K X1", "K Forever", $DescriptiveElements[13]->DisplayValue);
                                }
                                if ($cate_array_count >= 15) {
                                    $desc_e_name15 = $DescriptiveElements[14]->Name;
                                    $desc_e_value15 = str_replace("K X1", "K Forever", $DescriptiveElements[14]->DisplayValue);
                                }
                                $image1 = "";
                                $image2 = "";
                                $image3 = "";
                                $image4 = "";
                                $image5 = "";
                                $image6 = "";
                                $gimage1 = "";
                                $gimage2 = "";
                                $gimage3 = "";
                                $fullysetimage1 = "";
                                $fullysetimage2 = "";
                                $fullysetimage3 = "";
                                $fullysetimage4 = "";
                                $fullysetimage5 = "";
                                $fullysetimage6 = "";
                                //get images
                                // if(!empty($prod->Images)){
                                //   $image1= $prod->Images[0]->FullUrl;
                                //   $image2= $prod->Images[0]->ThumbnailUrl;
                                //   $image3= $prod->Images[0]->ZoomUrl;
                                // }
                                // if(!empty($prod->GroupImages)){
                                //   $gimage1= $prod->GroupImages[0]->ZoomUrl;
                                //   $gimage2= $prod->GroupImages[0]->ZoomUrl;
                                //   $gimage3= $prod->GroupImages[0]->ZoomUrl;
                                // }
                                //get images
                                if (!empty($prod->Images)) {
                                    $image_peram_count = count($prod->Images);
                                    if ($image_peram_count >= 1) {
                                        $image1 = $prod->Images[0]->FullUrl;
                                    }
                                    if ($image_peram_count >= 2) {
                                        $image2 = $prod->Images[1]->FullUrl;
                                    }
                                    if ($image_peram_count >= 3) {
                                        $image3 = $prod->Images[2]->FullUrl;
                                    }
                                    if ($image_peram_count >= 4) {
                                        $image4 = $prod->Images[3]->FullUrl;
                                    }
                                    if ($image_peram_count >= 5) {
                                        $image5 = $prod->Images[4]->FullUrl;
                                    }
                                    if ($image_peram_count >= 6) {
                                        $image5 = $prod->Images[5]->FullUrl;
                                    }
                                    // $image1= $prod->Images[0]->FullUrl;
                                    // $image2= $prod->Images[0]->ThumbnailUrl;
                                    // $image3= $prod->Images[0]->ZoomUrl;
                                }
                                //get group images
                                if (!empty($prod->GroupImages)) {
                                    $Groupimage_peram_count = count($prod->GroupImages);
                                    if ($Groupimage_peram_count >= 1) {
                                        $gimage1 = $prod->GroupImages[0]->FullUrl;
                                    }
                                    if ($Groupimage_peram_count >= 2) {
                                        $gimage2 = $prod->GroupImages[1]->FullUrl;
                                    }
                                    if ($Groupimage_peram_count >= 3) {
                                        $gimage3 = $prod->GroupImages[2]->FullUrl;
                                    }
                                    // $gimage1= $prod->GroupImages[0]->ZoomUrl;
                                    // $gimage2= $prod->GroupImages[0]->ZoomUrl;
                                    // $gimage3= $prod->GroupImages[0]->ZoomUrl;
                                }
                                //get Fully Set Images images
                                if (!empty($prod->FullySetImages)) {
                                    $FullySetimage_peram_count = count($prod->FullySetImages);
                                    if ($FullySetimage_peram_count >= 1) {
                                        $fullysetimage1 = $prod->FullySetImages[0]->FullUrl;
                                    }
                                    if ($FullySetimage_peram_count >= 2) {
                                        $fullysetimage2 = $prod->FullySetImages[1]->FullUrl;
                                    }
                                    if ($FullySetimage_peram_count >= 3) {
                                        $fullysetimage3 = $prod->FullySetImages[2]->FullUrl;
                                    }
                                    if ($FullySetimage_peram_count >= 4) {
                                        $fullysetimage4 = $prod->FullySetImages[3]->FullUrl;
                                    }
                                    if ($FullySetimage_peram_count >= 5) {
                                        $fullysetimage5 = $prod->FullySetImages[4]->FullUrl;
                                    }
                                    if ($FullySetimage_peram_count >= 6) {
                                        $fullysetimage6 = $prod->FullySetImages[5]->FullUrl;
                                    }
                                    // $image1= $prod->Images[0]->FullUrl;
                                    // $image2= $prod->Images[0]->ThumbnailUrl;
                                    // $image3= $prod->Images[0]->ZoomUrl;
                                }
                                //get AGTA
                                if (!empty($prod->AGTA)) {
                                    $agta = $prod->AGTA;
                                } else {
                                    $agta = "";
                                }
                                //get MerchandisingCategory
                                $mcat1 = "";
                                $mcat2 = "";
                                $mcat3 = "";
                                $mcat4 = "";
                                $mcat5 = "";
                                if (!empty($prod->MerchandisingCategory1)) {
                                    $mcat1 = $prod->MerchandisingCategory1;
                                }
                                if (!empty($prod->MerchandisingCategory2)) {
                                    $mcat2 = $prod->MerchandisingCategory2;
                                }
                                if (!empty($prod->MerchandisingCategory3)) {
                                    $mcat3 = $prod->MerchandisingCategory3;
                                }
                                if (!empty($prod->MerchandisingCategory4)) {
                                    $mcat4 = $prod->MerchandisingCategory4;
                                }
                                if (!empty($prod->MerchandisingCategory5)) {
                                    $mcat5 = $prod->MerchandisingCategory5;
                                }
                                $Description = "";
                                if (!empty($prod->Description)) {
                                    $Description = str_replace("K X1", "K Forever", $prod->Description);
                                }
                                $ShortDescription = "";
                                if (!empty($prod->ShortDescription)) {
                                    $ShortDescription = str_replace("K X1", "K Forever", $prod->ShortDescription);
                                }
                                $GroupDescription = "";
                                if (!empty($prod->GroupDescription)) {
                                    $GroupDescription = str_replace("K X1", "K Forever", $prod->GroupDescription);
                                }
                                $LeadTime = "";
                                if (!empty($prod->LeadTime)) {
                                    $LeadTime = $prod->LeadTime;
                                }
                                //get vedio and Group vedios
                                $vedio = "";
                                $gvedio = "";
                                if (!empty($prod->Videos)) {
                                    $vedio = $prod->Videos[0]->DownloadUrl;
                                }
                                if (!empty($prod->GroupVideos)) {
                                    $gvedio = $prod->GroupVideos[0]->Url;
                                }
                                //get vedio and Group vedios
                                $vedio = "";
                                $gvedio = "";
                                if (!empty($prod->Videos)) {
                                    $vedio = $prod->Videos[0]->DownloadUrl;
                                }
                                if (!empty($prod->GroupVideos)) {
                                    $gvedio = $prod->GroupVideos[0]->Url;
                                }
                                //explode sku for get and save sku series and sku series type start
                                $sku_no = $prod->SKU;
                                if (is_numeric($sku_no[0])) {
                                    $sku_ar = explode(":", $sku_no);
                                } else {
                                    $arr = (str_split($sku_no));
                                    $l = count($arr);
                                    for ($i = 0; $i <= $l; $i++) {
                                        if (is_numeric($arr[$i])) {
                                            array_splice($arr, $i, 0, ":");
                                            break;
                                        }
                                    }
                                    $s = join($arr);
                                    $sku_ar = explode(":", $s);
                                }
                                $cate_param_count = count($sku_ar);
                                $sku_series = "";
                                $sku_series_type1 = "";
                                $sku_series_type2 = "";
                                $sku_series_type3 = "";
                                if ($cate_param_count >= 1) {
                                    $sku_series = $sku_ar[0];
                                }
                                if ($cate_param_count >= 2) {
                                    $sku_series_type1 = $sku_ar[1];
                                }
                                if ($cate_param_count >= 3) {
                                    $sku_series_type2 = $sku_ar[2];
                                }
                                if ($cate_param_count >= 4) {
                                    $sku_series_type3 = $sku_ar[3];
                                }
                                $ProductType = "";
                                if (!empty($prod->ProductType)) {
                                    $ProductType = $prod->ProductType;
                                }
                                $OnHand = "";
                                if (!empty($prod->OnHand)) {
                                    $OnHand = $prod->OnHand;
                                }
                                $Status = "";
                                if (!empty($prod->Status)) {
                                    $Status = $prod->Status;
                                }
                                $Value = "";
                                if (!empty($prod->Price->Value)) {
                                    $Value = $prod->Price->Value;
                                }
                                $CurrencyCode = "";
                                if (!empty($prod->Price->CurrencyCode)) {
                                    $CurrencyCode = $prod->Price->CurrencyCode;
                                }
                                $UnitOfSale = "";
                                if (!empty($prod->UnitOfSale)) {
                                    $UnitOfSale = $prod->UnitOfSale;
                                }
                                $Weight = "";
                                if (!empty($prod->Weight)) {
                                    $Weight = $prod->Weight;
                                }
                                $WeightUnitOfMeasure = "";
                                if (!empty($prod->WeightUnitOfMeasure)) {
                                    $WeightUnitOfMeasure = $prod->WeightUnitOfMeasure;
                                }
                                $GramWeight = "";
                                if (!empty($prod->GramWeight)) {
                                    $GramWeight = $prod->GramWeight;
                                }
                                $GroupName = "";
                                if (!empty($prod->DescriptiveElementGroup->GroupName)) {
                                    $GroupName = $prod->DescriptiveElementGroup->GroupName;
                                }
                                $CreationDate = "";
                                if (!empty($prod->CreationDate)) {
                                    $CreationDate = $prod->CreationDate;
                                }
                                $CountryOfOrigin = "";
                                if (!empty($prod->CountryOfOrigin)) {
                                    $CountryOfOrigin = $prod->CountryOfOrigin;
                                }
                                $RingSizable = "";
                                if (!empty($prod->RingSizable)) {
                                    $RingSizable = $prod->RingSizable;
                                }
                                $ReadyToWear = "";
                                if (!empty($prod->ReadyToWear)) {
                                    $ReadyToWear = $prod->ReadyToWear;
                                }
                                //specifications
                                if (empty($prod->Specifications)) {
                                    $specifications = "";
                                } else {
                                    $specifications = $prod->Specifications;
                                }
                                //comessetwith
                                if (empty($prod->CanBeSetWith)) {
                                    $canbesetwith = "";
                                } else {
                                    $canbesetwith = $prod->CanBeSetWith;
                                }
                                //SetWith
                                if (empty($prod->SetWith)) {
                                    $setwith = "";
                                } else {
                                    $setwith = $prod->SetWith;
                                }
                                //ringsize
                                $ringSizeArray = [];
                                // print_r($prod->ConfigurationModel->RingSizeOptions);die();
                                if (!empty($prod->ConfigurationModel)) {
                                    if (empty($prod->ConfigurationModel->RingSizeOptions)) {
                                        $ringSizeArray = "";
                                    } else {
                                        foreach ($prod->ConfigurationModel->RingSizeOptions as $configModel) {
                                            $ringSizeArray[] = array(
                                                "Size" => number_format((float)$configModel->Size, 2, '.', ''),
                                                "Price" => $configModel->Price->Value
                                            );
                                        }
                                    }
                                } else {
                                    $ringSizeArray = "";
                                }
                                //explode sku for get and save sku series and sku series type end
                                if (!empty($prod->Price->Value)) {
                                    if ($prod->Price->Value > $MINIMUM_COST) {
                                        $data_insert = array(
                                            'product_id' => $prod->Id,
                                            'category' => $category_id,
                                            // 'sub_category'=>$subcategory,
                                            // 'minisub_category'=>$minisubcategory,
                                            // 'vendor'=>1,
                                            'sku' => $prod->SKU,
                                            'sku_series' => $sku_series,
                                            'sku_series_type1' => $sku_series_type1,
                                            'sku_series_type2' => $sku_series_type2,
                                            'sku_series_type3' => $sku_series_type3,
                                            'description' => $Description,
                                            'sdesc' => $ShortDescription,
                                            'gdesc' => $GroupDescription,
                                            'mcat1' => $mcat1,
                                            'mcat2' => $mcat2,
                                            'mcat3' => $mcat3,
                                            'mcat4' => $mcat4,
                                            'mcat5' => $mcat5,
                                            'product_type' => $ProductType,
                                            'collection' => "",
                                            'onhand' => $OnHand,
                                            'status' => $Status,
                                            'price' => $Value,
                                            'currency' => $CurrencyCode,
                                            'unitofsale' => $UnitOfSale,
                                            'weight' => $Weight,
                                            'weightunit' => $WeightUnitOfMeasure,
                                            'gramweight' => $GramWeight,
                                            'ringsizable' => $RingSizable,
                                            'ringsize' => $ringsize,
                                            'ringsizetype' => $ringsizetype,
                                            'leadtime' => $LeadTime,
                                            'agta' => $agta,
                                            'desc_e_grp' => $GroupName,
                                            'desc_e_name1' => $desc_e_name1,
                                            'desc_e_value1' => ltrim($desc_e_value1),
                                            'desc_e_name2' => $desc_e_name2,
                                            'desc_e_value2' => ltrim($desc_e_value2),
                                            'desc_e_name3' => $desc_e_name3,
                                            'desc_e_value3' => ltrim($desc_e_value3),
                                            'desc_e_name4' => $desc_e_name4,
                                            'desc_e_value4' => ltrim($desc_e_value4),
                                            'desc_e_name5' => $desc_e_name5,
                                            'desc_e_value5' => ltrim($desc_e_value5),
                                            'desc_e_name6' => $desc_e_name6,
                                            'desc_e_value6' => ltrim($desc_e_value6),
                                            'desc_e_name7' => $desc_e_name7,
                                            'desc_e_value7' => ltrim($desc_e_value7),
                                            'desc_e_name8' => $desc_e_name8,
                                            'desc_e_value8' => ltrim($desc_e_value8),
                                            'desc_e_name9' => $desc_e_name9,
                                            'desc_e_value9' => ltrim($desc_e_value9),
                                            'desc_e_name10' => $desc_e_name10,
                                            'desc_e_value10' => ltrim($desc_e_value10),
                                            'desc_e_name11' => $desc_e_name11,
                                            'desc_e_value11' => ltrim($desc_e_value11),
                                            'desc_e_name12' => $desc_e_name12,
                                            'desc_e_value12' => ltrim($desc_e_value12),
                                            'desc_e_name13' => $desc_e_name13,
                                            'desc_e_value13' => ltrim($desc_e_value13),
                                            'desc_e_name14' => $desc_e_name14,
                                            'desc_e_value14' => ltrim($desc_e_value14),
                                            'desc_e_name15' => $desc_e_name15,
                                            'desc_e_value15' => ltrim($desc_e_value15),
                                            'readytowear' => $ReadyToWear,
                                            'smi' => "",
                                            'image1' => $image1,
                                            'image2' => $image2,
                                            'image3' => $image3,
                                            'image4' => $image4,
                                            'image5' => $image5,
                                            'image6' => $image6,
                                            'FullySetImage1' => $fullysetimage1,
                                            'FullySetImage2' => $fullysetimage2,
                                            'FullySetImage3' => $fullysetimage3,
                                            'FullySetImage4' => $fullysetimage4,
                                            'FullySetImage5' => $fullysetimage5,
                                            'FullySetImage6' => $fullysetimage6,
                                            'video' => $vedio,
                                            'gimage1' => $gimage1,
                                            'gimage2' => $gimage2,
                                            'gimage3' => $gimage3,
                                            'gvideo' => $gvedio,
                                            'creationdate' => $CreationDate,
                                            'currencycode' => "USD",
                                            'country' => $CountryOfOrigin,
                                            'dclarity' => "",
                                            'dcolor' => "",
                                            'totalweight' => "",
                                            'ip' => $ip,
                                            'added_by' => $addedby,
                                            'is_active' => 1,
                                            'group_id' => $prod->DescriptiveElementGroup->GroupId,
                                            'series_id' => $prod->DescriptiveElementGroup->DescriptiveElements[0]->Value,

                                            'date' => $cur_date
                                        );
                                        $last_id = $this->base_model->insert_table("tbl_products", $data_insert, 1);
                                        $beta_insert = array(
                                            'product_id' => $last_id,
                                            'specifications' => json_encode($specifications),
                                            'canbesetwith' => json_encode($canbesetwith),
                                            'setwith' => json_encode($setwith),
                                            'ringsize' => json_encode($ringSizeArray),
                                        );
                                        $spec_id = $this->base_model->insert_table("tbl_product_specifications", $beta_insert, 1);
                                    }
                                }
                            }
                            $NextPage = "";
                            if (!empty($result_da->NextPage)) {
                                $NextPage = $result_da->NextPage;
                            }
                            // echo $i." NP- ".$NextPage."<br>";
                        }
                        // }
                        // }
                    }
                    //end squ
                } else {
                    //subcategory products adding
                    // echo $total_pages; die();
                    //delete previous data from the table start
                    $this->db->select('*');
                    $this->db->from('tbl_products');
                    $this->db->where('category', $category_id);
                    $this->db->where('sub_category', $subcategory);
                    $this->db->where('minisub_category IS NULL', null);
                    $product_data = $this->db->get();
                    $c_api = count($api_ids);
                    // echo $type;die();
                    if ($del == 1) {
                        if (!empty($product_data && $delete == 1)) {
                            foreach ($product_data->result() as $pro) {
                                $this->db->delete('tbl_products', array('id' => $pro->id));
                            }
                        }
                    }
                    //delete previous data from the table end
                    if ($type == 1) {
                        if ($finshed == 1) {
                            $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList","Finished"],"CategoryIds":["' . $value . '"]}';
                            // $data = '{"Filter":["Orderable","OnPriceList","Finished"],"Series":["'.$api_id.'"]}';
                            // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"]}';
                        } else {
                            $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList"],"CategoryIds":["' . $value . '"]}';
                        }
                    } else if ($type == 2) {
                        if ($finshed == 1) {
                            // $data = '{"Filter":["Orderable","OnPriceList","Finished"],"CategoryIds":["'.$api_id.'"]}';
                            $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList","Finished"],"Series":["' . $value . '"]}';
                            // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"]}';
                        } else {
                            $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList"],"Series":["' . $value . '"]}';
                        }
                    }
                    if ($type == 3) {
                        // foreach ($api_ids as $value) {
                        $this->db->delete('tbl_products', array('sku' => $value));
                        $url = 'https://api.stuller.com/v2/products?SKU=' . $value;
                        $header = array();
                        $header[] = 'Host:api.stuller.com';
                        $header[] = 'Content-Type:application/json';
                        $header[] = 'Authorization:Basic ZGV2amV3ZWw6Q29kaW5nMjA9';
                        $ch = curl_init($url);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                        // curl_setopt($ch, CURLOPT_POST, 1);
                        // curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                        $result = curl_exec($ch);
                        curl_close($ch);
                        $result_da = json_decode($result);
                    } else {
                        //product data insert from the api start
                        $postdata = $data;
                        // echo $postdata;
                        // exit;
                        $header = array();
                        $header[] = 'Host:api.stuller.com';
                        $header[] = 'Content-Type:application/json';
                        $header[] = 'Authorization:Basic ZGV2amV3ZWw6Q29kaW5nMjA9';
                        $ch = curl_init($url);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                        $result = curl_exec($ch);
                        curl_close($ch);
                        // print_r($result);
                        $result_da = json_decode($result);
                    }
                    // print_r($result_da);
                    // exit;
                    if (!empty($result_da->TotalNumberOfProducts)) {
                        $TotalNumberOfProducts = $result_da->TotalNumberOfProducts;
                        $total_pages = round($TotalNumberOfProducts / 500) + 1;
                    }
                    $NextPage = "";
                    // $total_pages=2;
                    // print_r($total_pages);
                    //    echo $type;die();
                    for ($i = 0; $i < $total_pages; $i++) {
                        // code...
                        $url = 'https://api.stuller.com/v2/products';
                        if ($type == 1 || $type == "") {
                            if ($finshed == 1) {
                                if ($i == 0) {
                                    $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList","Finished"],"CategoryIds":["' . $value . '"]}';
                                    // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"]}';
                                } else {
                                    $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList","Finished"],"CategoryIds":["' . $value . '"],"NextPage":"' . $NextPage . '" }';
                                    // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"],"NextPage":"'.$NextPage.'" }';
                                }
                            } else {
                                if ($i == 0) {
                                    $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList"],"CategoryIds":["' . $value . '"]}';
                                    // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"]}';
                                } else {
                                    $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList"],"CategoryIds":["' . $value . '"],"NextPage":"' . $NextPage . '" }';
                                    // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"],"NextPage":"'.$NextPage.'" }';
                                }
                            }
                            $postdata = $data;
                            // echo $postdata;exit;
                            $header = array();
                            $header[] = 'Host:api.stuller.com';
                            $header[] = 'Content-Type:application/json';
                            $header[] = 'Authorization:Basic ZGV2amV3ZWw6Q29kaW5nMjA9';
                            $ch = curl_init($url);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            curl_setopt($ch, CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                            $result = curl_exec($ch);
                            curl_close($ch);
                            $result_da = json_decode($result);
                            // print_r($result_da);
                            // exit;
                            if (!empty($result_da)) {
                                foreach ($result_da->Products as $prod) {
                                    $specifications = [];
                                    $ringsize = 0;
                                    $ringsizetype = "";
                                    $RingSizable = "";
                                    if (!empty($prod->RingSizable)) {
                                        $RingSizable = $prod->RingSizable;
                                        if ($RingSizable == false) {
                                            $ringsize = 0;
                                            $ringsizetype = "";
                                        } else {
                                            if (!empty($prod->ringsize)) {
                                                $ringsize = $prod->ringsize;
                                            }
                                            if (!empty($prod->ringsizetype)) {
                                                $ringsizetype = $prod->ringsizetype;
                                            }
                                        }
                                    }
                                    //group eliments
                                    if (empty($prod->DescriptiveElementGroup)) {
                                        $DescriptiveElements = [];
                                    } else {
                                        $DescriptiveElements = $prod->DescriptiveElementGroup->DescriptiveElements;
                                    }
                                    $cate_array_count = 0;
                                    if (!empty($DescriptiveElements)) {
                                        $cate_array_count = count($DescriptiveElements);
                                    }
                                    $desc_e_name1 = "";
                                    $desc_e_value1 = "";
                                    $desc_e_name2 = "";
                                    $desc_e_value2 = "";
                                    $desc_e_name3 = "";
                                    $desc_e_value3 = "";
                                    $desc_e_name4 = "";
                                    $desc_e_value4 = "";
                                    $desc_e_name5 = "";
                                    $desc_e_value5 = "";
                                    $desc_e_name6 = "";
                                    $desc_e_value6 = "";
                                    $desc_e_name7 = "";
                                    $desc_e_value7 = "";
                                    $desc_e_name8 = "";
                                    $desc_e_value8 = "";
                                    $desc_e_name9 = "";
                                    $desc_e_value9 = "";
                                    $desc_e_name10 = "";
                                    $desc_e_value10 = "";
                                    $desc_e_name11 = "";
                                    $desc_e_value11 = "";
                                    $desc_e_name12 = "";
                                    $desc_e_value12 = "";
                                    $desc_e_name13 = "";
                                    $desc_e_value13 = "";
                                    $desc_e_name14 = "";
                                    $desc_e_value14 = "";
                                    $desc_e_name15 = "";
                                    $desc_e_value15 = "";
                                    if ($cate_array_count >= 1) {
                                        $desc_e_name1 = $DescriptiveElements[0]->Name;
                                        $desc_e_value1 = str_replace("K X1", "K Forever", $DescriptiveElements[0]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 2) {
                                        $desc_e_name2 = $DescriptiveElements[1]->Name;
                                        $desc_e_value2 = str_replace("K X1", "K Forever", $DescriptiveElements[1]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 3) {
                                        $desc_e_name3 = $DescriptiveElements[2]->Name;
                                        $desc_e_value3 = str_replace("K X1", "K Forever", $DescriptiveElements[2]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 4) {
                                        $desc_e_name4 = $DescriptiveElements[3]->Name;
                                        $desc_e_value4 = str_replace("K X1", "K Forever", $DescriptiveElements[3]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 5) {
                                        $desc_e_name5 = $DescriptiveElements[4]->Name;
                                        $desc_e_value5 = str_replace("K X1", "K Forever", $DescriptiveElements[4]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 6) {
                                        $desc_e_name6 = $DescriptiveElements[5]->Name;
                                        $desc_e_value6 = str_replace("K X1", "K Forever", $DescriptiveElements[5]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 7) {
                                        $desc_e_name7 = $DescriptiveElements[6]->Name;
                                        $desc_e_value7 = str_replace("K X1", "K Forever", $DescriptiveElements[6]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 8) {
                                        $desc_e_name8 = $DescriptiveElements[7]->Name;
                                        $desc_e_value8 = str_replace("K X1", "K Forever", $DescriptiveElements[7]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 9) {
                                        $desc_e_name9 = $DescriptiveElements[8]->Name;
                                        $desc_e_value9 = str_replace("K X1", "K Forever", $DescriptiveElements[8]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 10) {
                                        $desc_e_name10 = $DescriptiveElements[9]->Name;
                                        $desc_e_value10 = str_replace("K X1", "K Forever", $DescriptiveElements[9]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 11) {
                                        $desc_e_name11 = $DescriptiveElements[10]->Name;
                                        $desc_e_value11 = str_replace("K X1", "K Forever", $DescriptiveElements[10]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 12) {
                                        $desc_e_name12 = $DescriptiveElements[11]->Name;
                                        $desc_e_value12 = str_replace("K X1", "K Forever", $DescriptiveElements[11]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 13) {
                                        $desc_e_name13 = $DescriptiveElements[12]->Name;
                                        $desc_e_value13 = str_replace("K X1", "K Forever", $DescriptiveElements[12]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 14) {
                                        $desc_e_name14 = $DescriptiveElements[13]->Name;
                                        $desc_e_value14 = str_replace("K X1", "K Forever", $DescriptiveElements[13]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 15) {
                                        $desc_e_name15 = $DescriptiveElements[14]->Name;
                                        $desc_e_value15 = str_replace("K X1", "K Forever", $DescriptiveElements[14]->DisplayValue);
                                    }
                                    $image1 = "";
                                    $image2 = "";
                                    $image3 = "";
                                    $image4 = "";
                                    $image5 = "";
                                    $image6 = "";
                                    $gimage1 = "";
                                    $gimage2 = "";
                                    $gimage3 = "";
                                    $fullysetimage1 = "";
                                    $fullysetimage2 = "";
                                    $fullysetimage3 = "";
                                    $fullysetimage4 = "";
                                    $fullysetimage5 = "";
                                    $fullysetimage6 = "";
                                    //get images
                                    // if(!empty($prod->Images)){
                                    //   $image1= $prod->Images[0]->FullUrl;
                                    //   $image2= $prod->Images[0]->ThumbnailUrl;
                                    //   $image3= $prod->Images[0]->ZoomUrl;
                                    // }
                                    // if(!empty($prod->GroupImages)){
                                    //   $gimage1= $prod->GroupImages[0]->ZoomUrl;
                                    //   $gimage2= $prod->GroupImages[0]->ZoomUrl;
                                    //   $gimage3= $prod->GroupImages[0]->ZoomUrl;
                                    // }
                                    //get images
                                    if (!empty($prod->Images)) {
                                        $image_peram_count = count($prod->Images);
                                        if ($image_peram_count >= 1) {
                                            $image1 = $prod->Images[0]->FullUrl;
                                        }
                                        if ($image_peram_count >= 2) {
                                            $image2 = $prod->Images[1]->FullUrl;
                                        }
                                        if ($image_peram_count >= 3) {
                                            $image3 = $prod->Images[2]->FullUrl;
                                        }
                                        if ($image_peram_count >= 4) {
                                            $image4 = $prod->Images[3]->FullUrl;
                                        }
                                        if ($image_peram_count >= 5) {
                                            $image5 = $prod->Images[4]->FullUrl;
                                        }
                                        if ($image_peram_count >= 6) {
                                            $image5 = $prod->Images[5]->FullUrl;
                                        }
                                        // $image1= $prod->Images[0]->FullUrl;
                                        // $image2= $prod->Images[0]->ThumbnailUrl;
                                        // $image3= $prod->Images[0]->ZoomUrl;
                                    }
                                    //get group images
                                    if (!empty($prod->GroupImages)) {
                                        $Groupimage_peram_count = count($prod->GroupImages);
                                        if ($Groupimage_peram_count >= 1) {
                                            $gimage1 = $prod->GroupImages[0]->FullUrl;
                                        }
                                        if ($Groupimage_peram_count >= 2) {
                                            $gimage2 = $prod->GroupImages[1]->FullUrl;
                                        }
                                        if ($Groupimage_peram_count >= 3) {
                                            $gimage3 = $prod->GroupImages[2]->FullUrl;
                                        }
                                        // $gimage1= $prod->GroupImages[0]->ZoomUrl;
                                        // $gimage2= $prod->GroupImages[0]->ZoomUrl;
                                        // $gimage3= $prod->GroupImages[0]->ZoomUrl;
                                    }
                                    //get Fully Set Images images
                                    if (!empty($prod->FullySetImages)) {
                                        $FullySetimage_peram_count = count($prod->FullySetImages);
                                        if ($FullySetimage_peram_count >= 1) {
                                            $fullysetimage1 = $prod->FullySetImages[0]->FullUrl;
                                        }
                                        if ($FullySetimage_peram_count >= 2) {
                                            $fullysetimage2 = $prod->FullySetImages[1]->FullUrl;
                                        }
                                        if ($FullySetimage_peram_count >= 3) {
                                            $fullysetimage3 = $prod->FullySetImages[2]->FullUrl;
                                        }
                                        if ($FullySetimage_peram_count >= 4) {
                                            $fullysetimage4 = $prod->FullySetImages[3]->FullUrl;
                                        }
                                        if ($FullySetimage_peram_count >= 5) {
                                            $fullysetimage5 = $prod->FullySetImages[4]->FullUrl;
                                        }
                                        if ($FullySetimage_peram_count >= 6) {
                                            $fullysetimage6 = $prod->FullySetImages[5]->FullUrl;
                                        }
                                        // $image1= $prod->Images[0]->FullUrl;
                                        // $image2= $prod->Images[0]->ThumbnailUrl;
                                        // $image3= $prod->Images[0]->ZoomUrl;
                                    }
                                    //get AGTA
                                    if (!empty($prod->AGTA)) {
                                        $agta = $prod->AGTA;
                                    } else {
                                        $agta = "";
                                    }
                                    //get MerchandisingCategory
                                    $mcat1 = "";
                                    $mcat2 = "";
                                    $mcat3 = "";
                                    $mcat4 = "";
                                    $mcat5 = "";
                                    if (!empty($prod->MerchandisingCategory1)) {
                                        $mcat1 = $prod->MerchandisingCategory1;
                                    }
                                    if (!empty($prod->MerchandisingCategory2)) {
                                        $mcat2 = $prod->MerchandisingCategory2;
                                    }
                                    if (!empty($prod->MerchandisingCategory3)) {
                                        $mcat3 = $prod->MerchandisingCategory3;
                                    }
                                    if (!empty($prod->MerchandisingCategory4)) {
                                        $mcat4 = $prod->MerchandisingCategory4;
                                    }
                                    if (!empty($prod->MerchandisingCategory5)) {
                                        $mcat5 = $prod->MerchandisingCategory5;
                                    }
                                    $Description = "";
                                    if (!empty($prod->Description)) {
                                        $Description = str_replace("K X1", "K Forever", $prod->Description);
                                    }
                                    $ShortDescription = "";
                                    if (!empty($prod->ShortDescription)) {
                                        $ShortDescription = str_replace("K X1", "K Forever", $prod->ShortDescription);
                                    }
                                    $GroupDescription = "";
                                    if (!empty($prod->GroupDescription)) {
                                        $GroupDescription = str_replace("K X1", "K Forever", $prod->GroupDescription);
                                    }
                                    $LeadTime = "";
                                    if (!empty($prod->LeadTime)) {
                                        $LeadTime = $prod->LeadTime;
                                    }
                                    //get vedio and Group vedios
                                    $vedio = "";
                                    $gvedio = "";
                                    if (!empty($prod->Videos)) {
                                        $vedio = $prod->Videos[0]->DownloadUrl;
                                    }
                                    if (!empty($prod->GroupVideos)) {
                                        $gvedio = $prod->GroupVideos[0]->Url;
                                    }
                                    //explode sku for get and save sku series and sku series type start
                                    $sku_no = $prod->SKU;
                                    if (is_numeric($sku_no[0])) {
                                        $sku_ar = explode(":", $sku_no);
                                    } else {
                                        $arr = (str_split($sku_no));
                                        $l = count($arr);
                                        for ($i = 0; $i <= $l; $i++) {
                                            if (is_numeric($arr[$i])) {
                                                array_splice($arr, $i, 0, ":");
                                                break;
                                            }
                                        }
                                        $s = join($arr);
                                        $sku_ar = explode(":", $s);
                                    }
                                    $cate_param_count = count($sku_ar);
                                    $sku_series = "";
                                    $sku_series_type1 = "";
                                    $sku_series_type2 = "";
                                    $sku_series_type3 = "";
                                    if ($cate_param_count >= 1) {
                                        $sku_series = $sku_ar[0];
                                    }
                                    if ($cate_param_count >= 2) {
                                        $sku_series_type1 = $sku_ar[1];
                                    }
                                    if ($cate_param_count >= 3) {
                                        $sku_series_type2 = $sku_ar[2];
                                    }
                                    if ($cate_param_count >= 4) {
                                        $sku_series_type3 = $sku_ar[3];
                                    }
                                    //explode sku for get and save sku series and sku series type end
                                    if (!empty($prod->Price)) {
                                        $price = $prod->Price->Value;
                                        $currency = $prod->Price->CurrencyCode;
                                    } else {
                                        $price = "";
                                        $currency = "";
                                    }
                                    if (!empty($prod->UnitOfSale)) {
                                        $unit = $prod->UnitOfSale;
                                    } else {
                                        $unit = "";
                                    }
                                    if (!empty($prod->Weight)) {
                                        $Weight = $prod->Weight;
                                    } else {
                                        $Weight = "";
                                    }
                                    if (!empty($prod->WeightUnitOfMeasure)) {
                                        $WeightUnitOfMeasure = $prod->WeightUnitOfMeasure;
                                    } else {
                                        $WeightUnitOfMeasure = "";
                                    }
                                    if (!empty($prod->GramWeight)) {
                                        $GramWeight = $prod->GramWeight;
                                    } else {
                                        $GramWeight = "";
                                    }
                                    if (!empty($prod->DescriptiveElementGroup)) {
                                        $GroupName = $prod->DescriptiveElementGroup->GroupName;
                                    } else {
                                        $GroupName = "";
                                    }
                                    if (!empty($prod->CountryOfOrigin)) {
                                        $CountryOfOrigin = $prod->CountryOfOrigin;
                                    } else {
                                        $CountryOfOrigin = "";
                                    }
                                    if (!empty($prod->ProductType)) {
                                        $ProductType = $prod->ProductType;
                                    } else {
                                        $ProductType = "";
                                    }
                                    if (!empty($prod->OnHand)) {
                                        $OnHand = $prod->OnHand;
                                    } else {
                                        $OnHand = "";
                                    }
                                    if (!empty($prod->Status)) {
                                        $Status = $prod->Status;
                                    } else {
                                        $Status = "";
                                    }
                                    if (!empty($prod->ReadyToWear)) {
                                        $ReadyToWear = $prod->ReadyToWear;
                                    } else {
                                        $ReadyToWear = "";
                                    }
                                    if (!empty($prod->CreationDate)) {
                                        $CreationDate = $prod->CreationDate;
                                    } else {
                                        $CreationDate = "";
                                    }
                                    //specifications
                                    if (empty($prod->Specifications)) {
                                        $specifications = "";
                                    } else {
                                        $specifications = $prod->Specifications;
                                    }
                                    //comessetwith
                                    if (empty($prod->CanBeSetWith)) {
                                        $canbesetwith = "";
                                    } else {
                                        $canbesetwith = $prod->CanBeSetWith;
                                    }
                                    //SetWith
                                    if (empty($prod->SetWith)) {
                                        $setwith = "";
                                    } else {
                                        $setwith = $prod->SetWith;
                                    }
                                    //ringsize
                                    $ringSizeArray = [];
                                    // print_r($prod->ConfigurationModel->RingSizeOptions);die();
                                    if (!empty($prod->ConfigurationModel)) {
                                        if (empty($prod->ConfigurationModel->RingSizeOptions)) {
                                            $ringSizeArray = "";
                                        } else {
                                            foreach ($prod->ConfigurationModel->RingSizeOptions as $configModel) {
                                                $ringSizeArray[] = array(
                                                    "Size" => number_format((float)$configModel->Size, 2, '.', ''),
                                                    "Price" => $configModel->Price->Value
                                                );
                                            }
                                        }
                                    } else {
                                        $ringSizeArray = "";
                                    }
                                    if ($price > $MINIMUM_COST) {
                                        $ex = 0;
                                        $ex1 = 0;
                                        //---- excluding series --------
                                        $this->db->select('*');
                                        $this->db->from('tbl_sub_category');
                                        $this->db->where('is_active', 1);
                                        $this->db->where('id', $subcategory);
                                        $cat_data = $this->db->get()->row();
                                        //    print_r($cat_data->id);die();
                                        if (!empty($cat_data->exlude_series)) {
                                            $exclude = explode(",", $cat_data->exlude_series);
                                            if (count($exclude) > 0) {
                                                foreach ($exclude as $key => $value345) {
                                                    if ($value345 == $sku_series) {
                                                        $ex = 1;
                                                        break;
                                                    }
                                                }
                                            } else {
                                                if ($cat_data->exlude_series == $sku_series) {
                                                    $ex = 1;
                                                }
                                            }
                                        }
                                        //---- excluding sku --------
                                        if (!empty($cat_data->exlude_sku)) {
                                            $exclude1 = explode(",", $cat_data->exlude_sku);
                                            if (count($exclude1) > 0) {
                                                foreach ($exclude1 as $key => $value3452) {
                                                    if ($value3452 == $prod->SKU) {
                                                        $ex1 = 1;
                                                        break;
                                                    }
                                                }
                                            } else {
                                                if ($cat_data->exlude_sku == $prod->SKU) {
                                                    $ex1 = 1;
                                                }
                                            }
                                        }
                                        //  die();
                                        if ($ex == 0 && $ex1 == 0) {
                                            $data_insert = array(
                                                'product_id' => $prod->Id,
                                                'category' => $category_id,
                                                'sub_category' => $subcategory,
                                                // 'minisub_category'=>$minisubcategory,
                                                // 'vendor'=>1,
                                                'sku' => $prod->SKU,
                                                'sku_series' => $sku_series,
                                                'sku_series_type1' => $sku_series_type1,
                                                'sku_series_type2' => $sku_series_type2,
                                                'sku_series_type3' => $sku_series_type3,
                                                'description' => $Description,
                                                'sdesc' => $ShortDescription,
                                                'gdesc' => $GroupDescription,
                                                'mcat1' => $mcat1,
                                                'mcat2' => $mcat2,
                                                'mcat3' => $mcat3,
                                                'mcat4' => $mcat4,
                                                'mcat5' => $mcat5,
                                                'product_type' => $ProductType,
                                                'collection' => "",
                                                'onhand' => $OnHand,
                                                'status' => $Status,
                                                'price' => $price,
                                                'currency' => $currency,
                                                'unitofsale' => $unit,
                                                'weight' => $Weight,
                                                'weightunit' => $WeightUnitOfMeasure,
                                                'gramweight' => $GramWeight,
                                                'ringsizable' => $RingSizable,
                                                'ringsize' => $ringsize,
                                                'ringsizetype' => $ringsizetype,
                                                'leadtime' => $LeadTime,
                                                'agta' => $agta,
                                                'desc_e_grp' => $GroupName,
                                                'desc_e_name1' => $desc_e_name1,
                                                'desc_e_value1' => ltrim($desc_e_value1),
                                                'desc_e_name2' => $desc_e_name2,
                                                'desc_e_value2' => ltrim($desc_e_value2),
                                                'desc_e_name3' => $desc_e_name3,
                                                'desc_e_value3' => ltrim($desc_e_value3),
                                                'desc_e_name4' => $desc_e_name4,
                                                'desc_e_value4' => ltrim($desc_e_value4),
                                                'desc_e_name5' => $desc_e_name5,
                                                'desc_e_value5' => ltrim($desc_e_value5),
                                                'desc_e_name6' => $desc_e_name6,
                                                'desc_e_value6' => ltrim($desc_e_value6),
                                                'desc_e_name7' => $desc_e_name7,
                                                'desc_e_value7' => ltrim($desc_e_value7),
                                                'desc_e_name8' => $desc_e_name8,
                                                'desc_e_value8' => ltrim($desc_e_value8),
                                                'desc_e_name9' => $desc_e_name9,
                                                'desc_e_value9' => ltrim($desc_e_value9),
                                                'desc_e_name10' => $desc_e_name10,
                                                'desc_e_value10' => ltrim($desc_e_value10),
                                                'desc_e_name11' => $desc_e_name11,
                                                'desc_e_value11' => ltrim($desc_e_value11),
                                                'desc_e_name12' => $desc_e_name12,
                                                'desc_e_value12' => ltrim($desc_e_value12),
                                                'desc_e_name13' => $desc_e_name13,
                                                'desc_e_value13' => ltrim($desc_e_value13),
                                                'desc_e_name14' => $desc_e_name14,
                                                'desc_e_value14' => ltrim($desc_e_value14),
                                                'desc_e_name15' => $desc_e_name15,
                                                'desc_e_value15' => ltrim($desc_e_value15),
                                                'readytowear' => $ReadyToWear,
                                                'smi' => "",
                                                'image1' => $image1,
                                                'image2' => $image2,
                                                'image3' => $image3,
                                                'image4' => $image4,
                                                'image5' => $image5,
                                                'image6' => $image6,
                                                'FullySetImage1' => $fullysetimage1,
                                                'FullySetImage2' => $fullysetimage2,
                                                'FullySetImage3' => $fullysetimage3,
                                                'FullySetImage4' => $fullysetimage4,
                                                'FullySetImage5' => $fullysetimage5,
                                                'FullySetImage6' => $fullysetimage6,
                                                'video' => $vedio,
                                                'gimage1' => $gimage1,
                                                'gimage2' => $gimage2,
                                                'gimage3' => $gimage3,
                                                'gvideo' => $gvedio,
                                                'creationdate' => $CreationDate,
                                                'currencycode' => "USD",
                                                'country' => $CountryOfOrigin,
                                                'dclarity' => "",
                                                'dcolor' => "",
                                                'totalweight' => "",
                                                'ip' => $ip,
                                                'added_by' => $addedby,
                                                'is_active' => 1,
                                                'group_id' => $prod->DescriptiveElementGroup->GroupId,
                                                'series_id' => $prod->DescriptiveElementGroup->DescriptiveElements[0]->Value,

                                                'date' => $cur_date
                                            );
                                            // print_r($data_insert);
                                            // exit;
                                            $last_id = $this->base_model->insert_table("tbl_products", $data_insert, 1);
                                            $beta_insert = array(
                                                'product_id' => $last_id,
                                                'specifications' => json_encode($specifications),
                                                'canbesetwith' => json_encode($canbesetwith),
                                                'setwith' => json_encode($setwith),
                                                'ringsize' => json_encode($ringSizeArray),
                                            );
                                            $spec_id = $this->base_model->insert_table("tbl_product_specifications", $beta_insert, 1);
                                        }
                                    }
                                }
                                $NextPage = "";
                                if (!empty($result_da->NextPage)) {
                                    $NextPage = $result_da->NextPage;
                                }
                                // echo $i." NP- ".$NextPage."<br>";
                            }
                        }
                        if ($type == 2) {
                            // $ne_id=json_decode($api_id);
                            // echo $ne_id;
                            // exit;
                            // foreach ($api_id as $value) {
                            if ($finshed == 1) {
                                if ($i == 0) {
                                    $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList","Finished"],"Series":["' . $value . '"]}';
                                    // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"]}';
                                } else {
                                    $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList","Finished"],"Series":["' . $value . '"],"NextPage":"' . $NextPage . '" }';
                                    // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"],"NextPage":"'.$NextPage.'" }';
                                }
                            } else {
                                if ($i == 0) {
                                    $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList"],"Series":["' . $value . '"]}';
                                    // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"]}';
                                } else {
                                    $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList"],"Series":["' . $value . '"],"NextPage":"' . $NextPage . '" }';
                                    // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"],"NextPage":"'.$NextPage.'" }';
                                }
                            }
                            $postdata = $data;
                            $header = array();
                            $header[] = 'Host:api.stuller.com';
                            $header[] = 'Content-Type:application/json';
                            $header[] = 'Authorization:Basic ZGV2amV3ZWw6Q29kaW5nMjA9';
                            $ch = curl_init($url);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            curl_setopt($ch, CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                            $result = curl_exec($ch);
                            curl_close($ch);
                            $result_da = json_decode($result);
                            if (!empty($result_da->Products)) {
                                foreach ($result_da->Products as $prod) {
                                    $specifications = [];
                                    $ringsize = 0;
                                    $ringsizetype = "";
                                    $RingSizable = "";
                                    if (!empty($prod->RingSizable)) {
                                        $RingSizable = $prod->RingSizable;
                                        if ($RingSizable == false) {
                                            $ringsize = 0;
                                            $ringsizetype = "";
                                        } else {
                                            if (!empty($prod->ringsize)) {
                                                $ringsize = $prod->ringsize;
                                            }
                                            if (!empty($prod->ringsizetype)) {
                                                $ringsizetype = $prod->ringsizetype;
                                            }
                                        }
                                    }
                                    //group eliments
                                    if (empty($prod->DescriptiveElementGroup)) {
                                        $DescriptiveElements = [];
                                    } else {
                                        $DescriptiveElements = $prod->DescriptiveElementGroup->DescriptiveElements;
                                    }
                                    $cate_array_count = 0;
                                    if (!empty($DescriptiveElements)) {
                                        $cate_array_count = count($DescriptiveElements);
                                    }
                                    $desc_e_name1 = "";
                                    $desc_e_value1 = "";
                                    $desc_e_name2 = "";
                                    $desc_e_value2 = "";
                                    $desc_e_name3 = "";
                                    $desc_e_value3 = "";
                                    $desc_e_name4 = "";
                                    $desc_e_value4 = "";
                                    $desc_e_name5 = "";
                                    $desc_e_value5 = "";
                                    $desc_e_name6 = "";
                                    $desc_e_value6 = "";
                                    $desc_e_name7 = "";
                                    $desc_e_value7 = "";
                                    $desc_e_name8 = "";
                                    $desc_e_value8 = "";
                                    $desc_e_name9 = "";
                                    $desc_e_value9 = "";
                                    $desc_e_name10 = "";
                                    $desc_e_value10 = "";
                                    $desc_e_name11 = "";
                                    $desc_e_value11 = "";
                                    $desc_e_name12 = "";
                                    $desc_e_value12 = "";
                                    $desc_e_name13 = "";
                                    $desc_e_value13 = "";
                                    $desc_e_name14 = "";
                                    $desc_e_value14 = "";
                                    $desc_e_name15 = "";
                                    $desc_e_value15 = "";
                                    if ($cate_array_count >= 1) {
                                        $desc_e_name1 = $DescriptiveElements[0]->Name;
                                        $desc_e_value1 = str_replace("K X1", "K Forever", $DescriptiveElements[0]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 2) {
                                        $desc_e_name2 = $DescriptiveElements[1]->Name;
                                        $desc_e_value2 = str_replace("K X1", "K Forever", $DescriptiveElements[1]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 3) {
                                        $desc_e_name3 = $DescriptiveElements[2]->Name;
                                        $desc_e_value3 = str_replace("K X1", "K Forever", $DescriptiveElements[2]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 4) {
                                        $desc_e_name4 = $DescriptiveElements[3]->Name;
                                        $desc_e_value4 = str_replace("K X1", "K Forever", $DescriptiveElements[3]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 5) {
                                        $desc_e_name5 = $DescriptiveElements[4]->Name;
                                        $desc_e_value5 = str_replace("K X1", "K Forever", $DescriptiveElements[4]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 6) {
                                        $desc_e_name6 = $DescriptiveElements[5]->Name;
                                        $desc_e_value6 = str_replace("K X1", "K Forever", $DescriptiveElements[5]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 7) {
                                        $desc_e_name7 = $DescriptiveElements[6]->Name;
                                        $desc_e_value7 = str_replace("K X1", "K Forever", $DescriptiveElements[6]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 8) {
                                        $desc_e_name8 = $DescriptiveElements[7]->Name;
                                        $desc_e_value8 = str_replace("K X1", "K Forever", $DescriptiveElements[7]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 9) {
                                        $desc_e_name9 = $DescriptiveElements[8]->Name;
                                        $desc_e_value9 = str_replace("K X1", "K Forever", $DescriptiveElements[8]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 10) {
                                        $desc_e_name10 = $DescriptiveElements[9]->Name;
                                        $desc_e_value10 = str_replace("K X1", "K Forever", $DescriptiveElements[9]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 11) {
                                        $desc_e_name11 = $DescriptiveElements[10]->Name;
                                        $desc_e_value11 = str_replace("K X1", "K Forever", $DescriptiveElements[10]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 12) {
                                        $desc_e_name12 = $DescriptiveElements[11]->Name;
                                        $desc_e_value12 = str_replace("K X1", "K Forever", $DescriptiveElements[11]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 13) {
                                        $desc_e_name13 = $DescriptiveElements[12]->Name;
                                        $desc_e_value13 = str_replace("K X1", "K Forever", $DescriptiveElements[12]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 14) {
                                        $desc_e_name14 = $DescriptiveElements[13]->Name;
                                        $desc_e_value14 = str_replace("K X1", "K Forever", $DescriptiveElements[13]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 15) {
                                        $desc_e_name15 = $DescriptiveElements[14]->Name;
                                        $desc_e_value15 = str_replace("K X1", "K Forever", $DescriptiveElements[14]->DisplayValue);
                                    }
                                    $image1 = "";
                                    $image2 = "";
                                    $image3 = "";
                                    $image4 = "";
                                    $image5 = "";
                                    $image6 = "";
                                    $gimage1 = "";
                                    $gimage2 = "";
                                    $gimage3 = "";
                                    $fullysetimage1 = "";
                                    $fullysetimage2 = "";
                                    $fullysetimage3 = "";
                                    $fullysetimage4 = "";
                                    $fullysetimage5 = "";
                                    $fullysetimage6 = "";
                                    //get images
                                    // if(!empty($prod->Images)){
                                    //   $image1= $prod->Images[0]->FullUrl;
                                    //   $image2= $prod->Images[0]->ThumbnailUrl;
                                    //   $image3= $prod->Images[0]->ZoomUrl;
                                    // }
                                    // if(!empty($prod->GroupImages)){
                                    //   $gimage1= $prod->GroupImages[0]->ZoomUrl;
                                    //   $gimage2= $prod->GroupImages[0]->ZoomUrl;
                                    //   $gimage3= $prod->GroupImages[0]->ZoomUrl;
                                    // }
                                    //get images
                                    if (!empty($prod->Images)) {
                                        $image_peram_count = count($prod->Images);
                                        if ($image_peram_count >= 1) {
                                            $image1 = $prod->Images[0]->FullUrl;
                                        }
                                        if ($image_peram_count >= 2) {
                                            $image2 = $prod->Images[1]->FullUrl;
                                        }
                                        if ($image_peram_count >= 3) {
                                            $image3 = $prod->Images[2]->FullUrl;
                                        }
                                        if ($image_peram_count >= 4) {
                                            $image4 = $prod->Images[3]->FullUrl;
                                        }
                                        if ($image_peram_count >= 5) {
                                            $image5 = $prod->Images[4]->FullUrl;
                                        }
                                        if ($image_peram_count >= 6) {
                                            $image5 = $prod->Images[5]->FullUrl;
                                        }
                                        // $image1= $prod->Images[0]->FullUrl;
                                        // $image2= $prod->Images[0]->ThumbnailUrl;
                                        // $image3= $prod->Images[0]->ZoomUrl;
                                    }
                                    //get group images
                                    if (!empty($prod->GroupImages)) {
                                        $Groupimage_peram_count = count($prod->GroupImages);
                                        if ($Groupimage_peram_count >= 1) {
                                            $gimage1 = $prod->GroupImages[0]->FullUrl;
                                        }
                                        if ($Groupimage_peram_count >= 2) {
                                            $gimage2 = $prod->GroupImages[1]->FullUrl;
                                        }
                                        if ($Groupimage_peram_count >= 3) {
                                            $gimage3 = $prod->GroupImages[2]->FullUrl;
                                        }
                                        // $gimage1= $prod->GroupImages[0]->ZoomUrl;
                                        // $gimage2= $prod->GroupImages[0]->ZoomUrl;
                                        // $gimage3= $prod->GroupImages[0]->ZoomUrl;
                                    }
                                    //get Fully Set Images images
                                    if (!empty($prod->FullySetImages)) {
                                        $FullySetimage_peram_count = count($prod->FullySetImages);
                                        if ($FullySetimage_peram_count >= 1) {
                                            $fullysetimage1 = $prod->FullySetImages[0]->FullUrl;
                                        }
                                        if ($FullySetimage_peram_count >= 2) {
                                            $fullysetimage2 = $prod->FullySetImages[1]->FullUrl;
                                        }
                                        if ($FullySetimage_peram_count >= 3) {
                                            $fullysetimage3 = $prod->FullySetImages[2]->FullUrl;
                                        }
                                        if ($FullySetimage_peram_count >= 4) {
                                            $fullysetimage4 = $prod->FullySetImages[3]->FullUrl;
                                        }
                                        if ($FullySetimage_peram_count >= 5) {
                                            $fullysetimage5 = $prod->FullySetImages[4]->FullUrl;
                                        }
                                        if ($FullySetimage_peram_count >= 6) {
                                            $fullysetimage6 = $prod->FullySetImages[5]->FullUrl;
                                        }
                                        // $image1= $prod->Images[0]->FullUrl;
                                        // $image2= $prod->Images[0]->ThumbnailUrl;
                                        // $image3= $prod->Images[0]->ZoomUrl;
                                    }
                                    //get AGTA
                                    if (!empty($prod->AGTA)) {
                                        $agta = $prod->AGTA;
                                    } else {
                                        $agta = "";
                                    }
                                    //get MerchandisingCategory
                                    $mcat1 = "";
                                    $mcat2 = "";
                                    $mcat3 = "";
                                    $mcat4 = "";
                                    $mcat5 = "";
                                    if (!empty($prod->MerchandisingCategory1)) {
                                        $mcat1 = $prod->MerchandisingCategory1;
                                    }
                                    if (!empty($prod->MerchandisingCategory2)) {
                                        $mcat2 = $prod->MerchandisingCategory2;
                                    }
                                    if (!empty($prod->MerchandisingCategory3)) {
                                        $mcat3 = $prod->MerchandisingCategory3;
                                    }
                                    if (!empty($prod->MerchandisingCategory4)) {
                                        $mcat4 = $prod->MerchandisingCategory4;
                                    }
                                    if (!empty($prod->MerchandisingCategory5)) {
                                        $mcat5 = $prod->MerchandisingCategory5;
                                    }
                                    $Description = "";
                                    if (!empty($prod->Description)) {
                                        $Description = str_replace("K X1", "K Forever", $prod->Description);
                                    }
                                    $ShortDescription = "";
                                    if (!empty($prod->ShortDescription)) {
                                        $ShortDescription = str_replace("K X1", "K Forever", $prod->ShortDescription);
                                    }
                                    $GroupDescription = "";
                                    if (!empty($prod->GroupDescription)) {
                                        $GroupDescription = str_replace("K X1", "K Forever", $prod->GroupDescription);
                                    }
                                    $LeadTime = "";
                                    if (!empty($prod->LeadTime)) {
                                        $LeadTime = $prod->LeadTime;
                                    }
                                    //get vedio and Group vedios
                                    $vedio = "";
                                    $gvedio = "";
                                    if (!empty($prod->Videos)) {
                                        $vedio = $prod->Videos[0]->DownloadUrl;
                                    }
                                    if (!empty($prod->GroupVideos)) {
                                        $gvedio = $prod->GroupVideos[0]->Url;
                                    }
                                    //explode sku for get and save sku series and sku series type start
                                    $sku_no = $prod->SKU;
                                    if (is_numeric($sku_no[0])) {
                                        $sku_ar = explode(":", $sku_no);
                                    } else {
                                        $arr = (str_split($sku_no));
                                        $l = count($arr);
                                        for ($i = 0; $i <= $l; $i++) {
                                            if (is_numeric($arr[$i])) {
                                                array_splice($arr, $i, 0, ":");
                                                break;
                                            }
                                        }
                                        $s = join($arr);
                                        $sku_ar = explode(":", $s);
                                    }
                                    $cate_param_count = count($sku_ar);
                                    $sku_series = "";
                                    $sku_series_type1 = "";
                                    $sku_series_type2 = "";
                                    $sku_series_type3 = "";
                                    if ($cate_param_count >= 1) {
                                        $sku_series = $sku_ar[0];
                                    }
                                    if ($cate_param_count >= 2) {
                                        $sku_series_type1 = $sku_ar[1];
                                    }
                                    if ($cate_param_count >= 3) {
                                        $sku_series_type2 = $sku_ar[2];
                                    }
                                    if ($cate_param_count >= 4) {
                                        $sku_series_type3 = $sku_ar[3];
                                    }
                                    //explode sku for get and save sku series and sku series type end
                                    if (!empty($prod->Price)) {
                                        $price = $prod->Price->Value;
                                        $currency = $prod->Price->CurrencyCode;
                                    } else {
                                        $price = "";
                                        $currency = "";
                                    }
                                    if (!empty($prod->UnitOfSale)) {
                                        $unit = $prod->UnitOfSale;
                                    } else {
                                        $unit = "";
                                    }
                                    if (!empty($prod->Weight)) {
                                        $Weight = $prod->Weight;
                                    } else {
                                        $Weight = "";
                                    }
                                    if (!empty($prod->WeightUnitOfMeasure)) {
                                        $WeightUnitOfMeasure = $prod->WeightUnitOfMeasure;
                                    } else {
                                        $WeightUnitOfMeasure = "";
                                    }
                                    if (!empty($prod->GramWeight)) {
                                        $GramWeight = $prod->GramWeight;
                                    } else {
                                        $GramWeight = "";
                                    }
                                    if (!empty($prod->DescriptiveElementGroup)) {
                                        $GroupName = $prod->DescriptiveElementGroup->GroupName;
                                    } else {
                                        $GroupName = "";
                                    }
                                    //specifications
                                    if (empty($prod->Specifications)) {
                                        $specifications = "";
                                    } else {
                                        $specifications = $prod->Specifications;
                                    }
                                    //comessetwith
                                    if (empty($prod->CanBeSetWith)) {
                                        $canbesetwith = "";
                                    } else {
                                        $canbesetwith = $prod->CanBeSetWith;
                                    }
                                    //SetWith
                                    if (empty($prod->SetWith)) {
                                        $setwith = "";
                                    } else {
                                        $setwith = $prod->SetWith;
                                    }
                                    //ringsize
                                    $ringSizeArray = [];
                                    // print_r($prod->ConfigurationModel->RingSizeOptions);die();
                                    if (!empty($prod->ConfigurationModel)) {
                                        if (empty($prod->ConfigurationModel->RingSizeOptions)) {
                                            $ringSizeArray = "";
                                        } else {
                                            foreach ($prod->ConfigurationModel->RingSizeOptions as $configModel) {
                                                $ringSizeArray[] = array(
                                                    "Size" => number_format((float)$configModel->Size, 2, '.', ''),
                                                    "Price" => $configModel->Price->Value
                                                );
                                            }
                                        }
                                    } else {
                                        $ringSizeArray = "";
                                    }
                                    if ($price > $MINIMUM_COST) {
                                        $ex = 0;
                                        $ex1 = 0;
                                        //---- excluding series --------
                                        $this->db->select('*');
                                        $this->db->from('tbl_sub_category');
                                        $this->db->where('is_active', 1);
                                        $this->db->where('id', $subcategory);
                                        $cat_data = $this->db->get()->row();
                                        if (!empty($cat_data->exlude_series)) {
                                            $exclude = explode(",", $cat_data->exlude_series);
                                            if (count($exclude) > 0) {
                                                foreach ($exclude as $key => $value345) {
                                                    if ($value345 == $sku_series) {
                                                        $ex = 1;
                                                        break;
                                                    }
                                                }
                                            } else {
                                                if ($cat_data->exlude_series == $sku_series) {
                                                    $ex = 1;
                                                }
                                            }
                                        }
                                        //---- excluding sku --------
                                        if (!empty($cat_data->exlude_sku)) {
                                            $exclude1 = explode(",", $cat_data->exlude_sku);
                                            if (count($exclude1) > 0) {
                                                foreach ($exclude1 as $key => $value3452) {
                                                    if ($value3452 == $prod->SKU) {
                                                        $ex1 = 1;
                                                        break;
                                                    }
                                                }
                                            } else {
                                                if ($cat_data->exlude_sku == $prod->SKU) {
                                                    $ex1 = 1;
                                                }
                                            }
                                        }
                                        if ($ex == 0 && $ex1 == 0) {
                                            $data_insert = array(
                                                'product_id' => $prod->Id,
                                                'category' => $category_id,
                                                'sub_category' => $subcategory,
                                                // 'minisub_category'=>$minisubcategory,
                                                // 'vendor'=>1,
                                                'sku' => $prod->SKU,
                                                'sku_series' => $sku_series,
                                                'sku_series_type1' => $sku_series_type1,
                                                'sku_series_type2' => $sku_series_type2,
                                                'sku_series_type3' => $sku_series_type3,
                                                'description' => $Description,
                                                'sdesc' => $ShortDescription,
                                                'gdesc' => $GroupDescription,
                                                'mcat1' => $mcat1,
                                                'mcat2' => $mcat2,
                                                'mcat3' => $mcat3,
                                                'mcat4' => $mcat4,
                                                'mcat5' => $mcat5,
                                                'product_type' => $prod->ProductType,
                                                'collection' => "",
                                                'onhand' => $prod->OnHand,
                                                'status' => $prod->Status,
                                                'price' => $price,
                                                'currency' => $currency,
                                                'unitofsale' => $unit,
                                                'weight' => $Weight,
                                                'weightunit' => $WeightUnitOfMeasure,
                                                'gramweight' => $GramWeight,
                                                'ringsizable' => $RingSizable,
                                                'ringsize' => $ringsize,
                                                'ringsizetype' => $ringsizetype,
                                                'leadtime' => $LeadTime,
                                                'agta' => $agta,
                                                'desc_e_grp' => $GroupName,
                                                'desc_e_name1' => $desc_e_name1,
                                                'desc_e_value1' => ltrim($desc_e_value1),
                                                'desc_e_name2' => $desc_e_name2,
                                                'desc_e_value2' => ltrim($desc_e_value2),
                                                'desc_e_name3' => $desc_e_name3,
                                                'desc_e_value3' => ltrim($desc_e_value3),
                                                'desc_e_name4' => $desc_e_name4,
                                                'desc_e_value4' => ltrim($desc_e_value4),
                                                'desc_e_name5' => $desc_e_name5,
                                                'desc_e_value5' => ltrim($desc_e_value5),
                                                'desc_e_name6' => $desc_e_name6,
                                                'desc_e_value6' => ltrim($desc_e_value6),
                                                'desc_e_name7' => $desc_e_name7,
                                                'desc_e_value7' => ltrim($desc_e_value7),
                                                'desc_e_name8' => $desc_e_name8,
                                                'desc_e_value8' => ltrim($desc_e_value8),
                                                'desc_e_name9' => $desc_e_name9,
                                                'desc_e_value9' => ltrim($desc_e_value9),
                                                'desc_e_name10' => $desc_e_name10,
                                                'desc_e_value10' => ltrim($desc_e_value10),
                                                'desc_e_name11' => $desc_e_name11,
                                                'desc_e_value11' => ltrim($desc_e_value11),
                                                'desc_e_name12' => $desc_e_name12,
                                                'desc_e_value12' => ltrim($desc_e_value12),
                                                'desc_e_name13' => $desc_e_name13,
                                                'desc_e_value13' => ltrim($desc_e_value13),
                                                'desc_e_name14' => $desc_e_name14,
                                                'desc_e_value14' => ltrim($desc_e_value14),
                                                'desc_e_name15' => $desc_e_name15,
                                                'desc_e_value15' => ltrim($desc_e_value15),
                                                'readytowear' => $prod->ReadyToWear,
                                                'smi' => "",
                                                'image1' => $image1,
                                                'image2' => $image2,
                                                'image3' => $image3,
                                                'image4' => $image4,
                                                'image5' => $image5,
                                                'image6' => $image6,
                                                'FullySetImage1' => $fullysetimage1,
                                                'FullySetImage2' => $fullysetimage2,
                                                'FullySetImage3' => $fullysetimage3,
                                                'FullySetImage4' => $fullysetimage4,
                                                'FullySetImage5' => $fullysetimage5,
                                                'FullySetImage6' => $fullysetimage6,
                                                'video' => $vedio,
                                                'gimage1' => $gimage1,
                                                'gimage2' => $gimage2,
                                                'gimage3' => $gimage3,
                                                'gvideo' => $gvedio,
                                                'creationdate' => $prod->CreationDate,
                                                'currencycode' => "USD",
                                                'country' => $prod->CountryOfOrigin,
                                                'dclarity' => "",
                                                'dcolor' => "",
                                                'totalweight' => "",
                                                'ip' => $ip,
                                                'added_by' => $addedby,
                                                'is_active' => 1,
                                                'group_id' => $prod->DescriptiveElementGroup->GroupId,
                                                'series_id' => $prod->DescriptiveElementGroup->DescriptiveElements[0]->Value,

                                                'date' => $cur_date
                                            );
                                            $last_id = $this->base_model->insert_table("tbl_products", $data_insert, 1);
                                            $beta_insert = array(
                                                'product_id' => $last_id,
                                                'specifications' => json_encode($specifications),
                                                'canbesetwith' => json_encode($canbesetwith),
                                                'setwith' => json_encode($setwith),
                                                'ringsize' => json_encode($ringSizeArray),
                                            );
                                            $spec_id = $this->base_model->insert_table("tbl_product_specifications", $beta_insert, 1);
                                        }
                                    }
                                }
                                $NextPage = "";
                                if (!empty($result_da->NextPage)) {
                                    $NextPage = $result_da->NextPage;
                                }
                                // echo $i." NP- ".$NextPage."<br>";
                            }
                            // $NextPage= "";
                            // $NextPage= $result_da->NextPage;
                            // echo $i." NP- ".$NextPage."<br>";
                            // }
                        }
                        //statr squ
                        if ($type == 3) {
                            // foreach ($api_id as $value) {
                            $url = 'https://api.stuller.com/v2/products?SKU=' . $value;
                            $header = array();
                            $header[] = 'Host:api.stuller.com';
                            $header[] = 'Content-Type:application/json';
                            $header[] = 'Authorization:Basic ZGV2amV3ZWw6Q29kaW5nMjA9';
                            $ch = curl_init($url);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            // curl_setopt($ch, CURLOPT_POST, 1);
                            // curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                            $result = curl_exec($ch);
                            curl_close($ch);
                            $result_da = json_decode($result);
                            // echo "<pre>";
                            //
                            // echo "</pre>";
                            // print_r($result_da);
                            // exit;
                            if (!empty($result_da)) {
                                foreach ($result_da->Products as $prod) {
                                    $specifications = [];
                                    // echo"hi";exit;
                                    $ringsize = 0;
                                    $ringsizetype = "";
                                    $RingSizable = "";
                                    if (!empty($prod->RingSizable)) {
                                        $RingSizable = $prod->RingSizable;
                                        if ($RingSizable == false) {
                                            $ringsize = 0;
                                            $ringsizetype = "";
                                        } else {
                                            if (!empty($prod->ringsize)) {
                                                $ringsize = $prod->ringsize;
                                            }
                                            if (!empty($prod->ringsizetype)) {
                                                $ringsizetype = $prod->ringsizetype;
                                            }
                                        }
                                    }
                                    //group eliments
                                    if (empty($prod->DescriptiveElementGroup)) {
                                        $DescriptiveElements = [];
                                    } else {
                                        $DescriptiveElements = $prod->DescriptiveElementGroup->DescriptiveElements;
                                    }
                                    $cate_array_count = 0;
                                    if (!empty($DescriptiveElements)) {
                                        $cate_array_count = count($DescriptiveElements);
                                    }
                                    $desc_e_name1 = "";
                                    $desc_e_value1 = "";
                                    $desc_e_name2 = "";
                                    $desc_e_value2 = "";
                                    $desc_e_name3 = "";
                                    $desc_e_value3 = "";
                                    $desc_e_name4 = "";
                                    $desc_e_value4 = "";
                                    $desc_e_name5 = "";
                                    $desc_e_value5 = "";
                                    $desc_e_name6 = "";
                                    $desc_e_value6 = "";
                                    $desc_e_name7 = "";
                                    $desc_e_value7 = "";
                                    $desc_e_name8 = "";
                                    $desc_e_value8 = "";
                                    $desc_e_name9 = "";
                                    $desc_e_value9 = "";
                                    $desc_e_name10 = "";
                                    $desc_e_value10 = "";
                                    $desc_e_name11 = "";
                                    $desc_e_value11 = "";
                                    $desc_e_name12 = "";
                                    $desc_e_value12 = "";
                                    $desc_e_name13 = "";
                                    $desc_e_value13 = "";
                                    $desc_e_name14 = "";
                                    $desc_e_value14 = "";
                                    $desc_e_name15 = "";
                                    $desc_e_value15 = "";
                                    if ($cate_array_count >= 1) {
                                        $desc_e_name1 = $DescriptiveElements[0]->Name;
                                        $desc_e_value1 = str_replace("K X1", "K Forever", $DescriptiveElements[0]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 2) {
                                        $desc_e_name2 = $DescriptiveElements[1]->Name;
                                        $desc_e_value2 = str_replace("K X1", "K Forever", $DescriptiveElements[1]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 3) {
                                        $desc_e_name3 = $DescriptiveElements[2]->Name;
                                        $desc_e_value3 = str_replace("K X1", "K Forever", $DescriptiveElements[2]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 4) {
                                        $desc_e_name4 = $DescriptiveElements[3]->Name;
                                        $desc_e_value4 = str_replace("K X1", "K Forever", $DescriptiveElements[3]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 5) {
                                        $desc_e_name5 = $DescriptiveElements[4]->Name;
                                        $desc_e_value5 = str_replace("K X1", "K Forever", $DescriptiveElements[4]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 6) {
                                        $desc_e_name6 = $DescriptiveElements[5]->Name;
                                        $desc_e_value6 = str_replace("K X1", "K Forever", $DescriptiveElements[5]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 7) {
                                        $desc_e_name7 = $DescriptiveElements[6]->Name;
                                        $desc_e_value7 = str_replace("K X1", "K Forever", $DescriptiveElements[6]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 8) {
                                        $desc_e_name8 = $DescriptiveElements[7]->Name;
                                        $desc_e_value8 = str_replace("K X1", "K Forever", $DescriptiveElements[7]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 9) {
                                        $desc_e_name9 = $DescriptiveElements[8]->Name;
                                        $desc_e_value9 = str_replace("K X1", "K Forever", $DescriptiveElements[8]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 10) {
                                        $desc_e_name10 = $DescriptiveElements[9]->Name;
                                        $desc_e_value10 = str_replace("K X1", "K Forever", $DescriptiveElements[9]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 11) {
                                        $desc_e_name11 = $DescriptiveElements[10]->Name;
                                        $desc_e_value11 = str_replace("K X1", "K Forever", $DescriptiveElements[10]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 12) {
                                        $desc_e_name12 = $DescriptiveElements[11]->Name;
                                        $desc_e_value12 = str_replace("K X1", "K Forever", $DescriptiveElements[11]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 13) {
                                        $desc_e_name13 = $DescriptiveElements[12]->Name;
                                        $desc_e_value13 = str_replace("K X1", "K Forever", $DescriptiveElements[12]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 14) {
                                        $desc_e_name14 = $DescriptiveElements[13]->Name;
                                        $desc_e_value14 = str_replace("K X1", "K Forever", $DescriptiveElements[13]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 15) {
                                        $desc_e_name15 = $DescriptiveElements[14]->Name;
                                        $desc_e_value15 = str_replace("K X1", "K Forever", $DescriptiveElements[14]->DisplayValue);
                                    }
                                    $image1 = "";
                                    $image2 = "";
                                    $image3 = "";
                                    $image4 = "";
                                    $image5 = "";
                                    $image6 = "";
                                    $gimage1 = "";
                                    $gimage2 = "";
                                    $gimage3 = "";
                                    $fullysetimage1 = "";
                                    $fullysetimage2 = "";
                                    $fullysetimage3 = "";
                                    $fullysetimage4 = "";
                                    $fullysetimage5 = "";
                                    $fullysetimage6 = "";
                                    //get images
                                    // if(!empty($prod->Images)){
                                    //   $image1= $prod->Images[0]->FullUrl;
                                    //   $image2= $prod->Images[0]->ThumbnailUrl;
                                    //   $image3= $prod->Images[0]->ZoomUrl;
                                    // }
                                    // if(!empty($prod->GroupImages)){
                                    //   $gimage1= $prod->GroupImages[0]->ZoomUrl;
                                    //   $gimage2= $prod->GroupImages[0]->ZoomUrl;
                                    //   $gimage3= $prod->GroupImages[0]->ZoomUrl;
                                    // }
                                    //get images
                                    if (!empty($prod->Images)) {
                                        $image_peram_count = count($prod->Images);
                                        if ($image_peram_count >= 1) {
                                            $image1 = $prod->Images[0]->FullUrl;
                                        }
                                        if ($image_peram_count >= 2) {
                                            $image2 = $prod->Images[1]->FullUrl;
                                        }
                                        if ($image_peram_count >= 3) {
                                            $image3 = $prod->Images[2]->FullUrl;
                                        }
                                        if ($image_peram_count >= 4) {
                                            $image4 = $prod->Images[3]->FullUrl;
                                        }
                                        if ($image_peram_count >= 5) {
                                            $image5 = $prod->Images[4]->FullUrl;
                                        }
                                        if ($image_peram_count >= 6) {
                                            $image5 = $prod->Images[5]->FullUrl;
                                        }
                                        // $image1= $prod->Images[0]->FullUrl;
                                        // $image2= $prod->Images[0]->ThumbnailUrl;
                                        // $image3= $prod->Images[0]->ZoomUrl;
                                    }
                                    //get group images
                                    if (!empty($prod->GroupImages)) {
                                        $Groupimage_peram_count = count($prod->GroupImages);
                                        if ($Groupimage_peram_count >= 1) {
                                            $gimage1 = $prod->GroupImages[0]->FullUrl;
                                        }
                                        if ($Groupimage_peram_count >= 2) {
                                            $gimage2 = $prod->GroupImages[1]->FullUrl;
                                        }
                                        if ($Groupimage_peram_count >= 3) {
                                            $gimage3 = $prod->GroupImages[2]->FullUrl;
                                        }
                                        // $gimage1= $prod->GroupImages[0]->ZoomUrl;
                                        // $gimage2= $prod->GroupImages[0]->ZoomUrl;
                                        // $gimage3= $prod->GroupImages[0]->ZoomUrl;
                                    }
                                    //get Fully Set Images images
                                    if (!empty($prod->FullySetImages)) {
                                        $FullySetimage_peram_count = count($prod->FullySetImages);
                                        if ($FullySetimage_peram_count >= 1) {
                                            $fullysetimage1 = $prod->FullySetImages[0]->FullUrl;
                                        }
                                        if ($FullySetimage_peram_count >= 2) {
                                            $fullysetimage2 = $prod->FullySetImages[1]->FullUrl;
                                        }
                                        if ($FullySetimage_peram_count >= 3) {
                                            $fullysetimage3 = $prod->FullySetImages[2]->FullUrl;
                                        }
                                        if ($FullySetimage_peram_count >= 4) {
                                            $fullysetimage4 = $prod->FullySetImages[3]->FullUrl;
                                        }
                                        if ($FullySetimage_peram_count >= 5) {
                                            $fullysetimage5 = $prod->FullySetImages[4]->FullUrl;
                                        }
                                        if ($FullySetimage_peram_count >= 6) {
                                            $fullysetimage6 = $prod->FullySetImages[5]->FullUrl;
                                        }
                                        // $image1= $prod->Images[0]->FullUrl;
                                        // $image2= $prod->Images[0]->ThumbnailUrl;
                                        // $image3= $prod->Images[0]->ZoomUrl;
                                    }
                                    //get AGTA
                                    if (!empty($prod->AGTA)) {
                                        $agta = $prod->AGTA;
                                    } else {
                                        $agta = "";
                                    }
                                    //get MerchandisingCategory
                                    $mcat1 = "";
                                    $mcat2 = "";
                                    $mcat3 = "";
                                    $mcat4 = "";
                                    $mcat5 = "";
                                    if (!empty($prod->MerchandisingCategory1)) {
                                        $mcat1 = $prod->MerchandisingCategory1;
                                    }
                                    if (!empty($prod->MerchandisingCategory2)) {
                                        $mcat2 = $prod->MerchandisingCategory2;
                                    }
                                    if (!empty($prod->MerchandisingCategory3)) {
                                        $mcat3 = $prod->MerchandisingCategory3;
                                    }
                                    if (!empty($prod->MerchandisingCategory4)) {
                                        $mcat4 = $prod->MerchandisingCategory4;
                                    }
                                    if (!empty($prod->MerchandisingCategory5)) {
                                        $mcat5 = $prod->MerchandisingCategory5;
                                    }
                                    $Description = "";
                                    if (!empty($prod->Description)) {
                                        $Description = str_replace("K X1", "K Forever", $prod->Description);
                                    }
                                    $ShortDescription = "";
                                    if (!empty($prod->ShortDescription)) {
                                        $ShortDescription = str_replace("K X1", "K Forever", $prod->ShortDescription);
                                    }
                                    $GroupDescription = "";
                                    if (!empty($prod->GroupDescription)) {
                                        $GroupDescription = str_replace("K X1", "K Forever", $prod->GroupDescription);
                                    }
                                    $LeadTime = "";
                                    if (!empty($prod->LeadTime)) {
                                        $LeadTime = $prod->LeadTime;
                                    }
                                    //get vedio and Group vedios
                                    $vedio = "";
                                    $gvedio = "";
                                    if (!empty($prod->Videos)) {
                                        $vedio = $prod->Videos[0]->DownloadUrl;
                                    }
                                    if (!empty($prod->GroupVideos)) {
                                        $gvedio = $prod->GroupVideos[0]->Url;
                                    }
                                    //get vedio and Group vedios
                                    $vedio = "";
                                    $gvedio = "";
                                    if (!empty($prod->Videos)) {
                                        $vedio = $prod->Videos[0]->DownloadUrl;
                                    }
                                    if (!empty($prod->GroupVideos)) {
                                        $gvedio = $prod->GroupVideos[0]->Url;
                                    }
                                    //explode sku for get and save sku series and sku series type start
                                    $sku_no = $prod->SKU;
                                    if (is_numeric($sku_no[0])) {
                                        $sku_ar = explode(":", $sku_no);
                                    } else {
                                        $arr = (str_split($sku_no));
                                        $l = count($arr);
                                        for ($i = 0; $i <= $l; $i++) {
                                            if (is_numeric($arr[$i])) {
                                                array_splice($arr, $i, 0, ":");
                                                break;
                                            }
                                        }
                                        $s = join($arr);
                                        $sku_ar = explode(":", $s);
                                    }
                                    $cate_param_count = count($sku_ar);
                                    $sku_series = "";
                                    $sku_series_type1 = "";
                                    $sku_series_type2 = "";
                                    $sku_series_type3 = "";
                                    if ($cate_param_count >= 1) {
                                        $sku_series = $sku_ar[0];
                                    }
                                    if ($cate_param_count >= 2) {
                                        $sku_series_type1 = $sku_ar[1];
                                    }
                                    if ($cate_param_count >= 3) {
                                        $sku_series_type2 = $sku_ar[2];
                                    }
                                    if ($cate_param_count >= 4) {
                                        $sku_series_type3 = $sku_ar[3];
                                    }
                                    $ProductType = "";
                                    if (!empty($prod->ProductType)) {
                                        $ProductType = $prod->ProductType;
                                    }
                                    $OnHand = "";
                                    if (!empty($prod->OnHand)) {
                                        $OnHand = $prod->OnHand;
                                    }
                                    $Status = "";
                                    if (!empty($prod->Status)) {
                                        $Status = $prod->Status;
                                    }
                                    $Value = "";
                                    if (!empty($prod->Price->Value)) {
                                        $Value = $prod->Price->Value;
                                    }
                                    $CurrencyCode = "";
                                    if (!empty($prod->Price->CurrencyCode)) {
                                        $CurrencyCode = $prod->Price->CurrencyCode;
                                    }
                                    $UnitOfSale = "";
                                    if (!empty($prod->UnitOfSale)) {
                                        $UnitOfSale = $prod->UnitOfSale;
                                    }
                                    $Weight = "";
                                    if (!empty($prod->Weight)) {
                                        $Weight = $prod->Weight;
                                    }
                                    $WeightUnitOfMeasure = "";
                                    if (!empty($prod->WeightUnitOfMeasure)) {
                                        $WeightUnitOfMeasure = $prod->WeightUnitOfMeasure;
                                    }
                                    $GramWeight = "";
                                    if (!empty($prod->GramWeight)) {
                                        $GramWeight = $prod->GramWeight;
                                    }
                                    $GroupName = "";
                                    if (!empty($prod->DescriptiveElementGroup->GroupName)) {
                                        $GroupName = $prod->DescriptiveElementGroup->GroupName;
                                    }
                                    $CreationDate = "";
                                    if (!empty($prod->CreationDate)) {
                                        $CreationDate = $prod->CreationDate;
                                    }
                                    $CountryOfOrigin = "";
                                    if (!empty($prod->CountryOfOrigin)) {
                                        $CountryOfOrigin = $prod->CountryOfOrigin;
                                    }
                                    //specifications
                                    if (empty($prod->Specifications)) {
                                        $specifications = "";
                                    } else {
                                        $specifications = $prod->Specifications;
                                    }
                                    //comessetwith
                                    if (empty($prod->CanBeSetWith)) {
                                        $canbesetwith = "";
                                    } else {
                                        $canbesetwith = $prod->CanBeSetWith;
                                    }
                                    //SetWith
                                    if (empty($prod->SetWith)) {
                                        $setwith = "";
                                    } else {
                                        $setwith = $prod->SetWith;
                                    }
                                    //ringsize
                                    $ringSizeArray = [];
                                    // print_r($prod->ConfigurationModel->RingSizeOptions);die();
                                    if (!empty($prod->ConfigurationModel)) {
                                        if (empty($prod->ConfigurationModel->RingSizeOptions)) {
                                            $ringSizeArray = "";
                                        } else {
                                            foreach ($prod->ConfigurationModel->RingSizeOptions as $configModel) {
                                                $ringSizeArray[] = array(
                                                    "Size" => number_format((float)$configModel->Size, 2, '.', ''),
                                                    "Price" => $configModel->Price->Value
                                                );
                                            }
                                        }
                                    } else {
                                        $ringSizeArray = "";
                                    }
                                    //explode sku for get and save sku series and sku series type end
                                    // if(!empty($prod->Price->Value)){
                                    if ($prod->Price->Value > $MINIMUM_COST) {
                                        $ex = 0;
                                        $ex1 = 0;
                                        //---- excluding series --------
                                        $this->db->select('*');
                                        $this->db->from('tbl_sub_category');
                                        $this->db->where('is_active', 1);
                                        $this->db->where('id', $subcategory);
                                        $cat_data = $this->db->get()->row();
                                        if (!empty($cat_data->exlude_series)) {
                                            $exclude = explode(",", $cat_data->exlude_series);
                                            if (count($exclude) > 0) {
                                                foreach ($exclude as $key => $value345) {
                                                    if ($value345 == $sku_series) {
                                                        $ex = 1;
                                                        break;
                                                    }
                                                }
                                            } else {
                                                if ($cat_data->exlude_series == $sku_series) {
                                                    $ex = 1;
                                                }
                                            }
                                        }
                                        //---- excluding sku --------
                                        if (!empty($cat_data->exlude_sku)) {
                                            $exclude1 = explode(",", $cat_data->exlude_sku);
                                            if (count($exclude1) > 0) {
                                                foreach ($exclude1 as $key => $value3452) {
                                                    if ($value3452 == $prod->SKU) {
                                                        $ex1 = 1;
                                                        break;
                                                    }
                                                }
                                            } else {
                                                if ($cat_data->exlude_sku == $prod->SKU) {
                                                    $ex1 = 1;
                                                }
                                            }
                                        }
                                        if ($ex == 0 && $ex1 == 0) {
                                            $data_insert = array(
                                                'product_id' => $prod->Id,
                                                'category' => $category_id,
                                                'sub_category' => $subcategory,
                                                // 'minisub_category'=>$minisubcategory,
                                                // 'vendor'=>1,
                                                'sku' => $prod->SKU,
                                                'sku_series' => $sku_series,
                                                'sku_series_type1' => $sku_series_type1,
                                                'sku_series_type2' => $sku_series_type2,
                                                'sku_series_type3' => $sku_series_type3,
                                                'description' => $Description,
                                                'sdesc' => $ShortDescription,
                                                'gdesc' => $GroupDescription,
                                                'mcat1' => $mcat1,
                                                'mcat2' => $mcat2,
                                                'mcat3' => $mcat3,
                                                'mcat4' => $mcat4,
                                                'mcat5' => $mcat5,
                                                'product_type' => $ProductType,
                                                'collection' => "",
                                                'onhand' => $OnHand,
                                                'status' => $Status,
                                                'price' => $Value,
                                                'currency' => $CurrencyCode,
                                                'unitofsale' => $UnitOfSale,
                                                'weight' => $Weight,
                                                'weightunit' => $WeightUnitOfMeasure,
                                                'gramweight' => $GramWeight,
                                                'ringsizable' => $RingSizable,
                                                'ringsize' => $ringsize,
                                                'ringsizetype' => $ringsizetype,
                                                'leadtime' => $LeadTime,
                                                'agta' => $agta,
                                                'desc_e_grp' => $GroupName,
                                                'desc_e_name1' => $desc_e_name1,
                                                'desc_e_value1' => ltrim($desc_e_value1),
                                                'desc_e_name2' => $desc_e_name2,
                                                'desc_e_value2' => ltrim($desc_e_value2),
                                                'desc_e_name3' => $desc_e_name3,
                                                'desc_e_value3' => ltrim($desc_e_value3),
                                                'desc_e_name4' => $desc_e_name4,
                                                'desc_e_value4' => ltrim($desc_e_value4),
                                                'desc_e_name5' => $desc_e_name5,
                                                'desc_e_value5' => ltrim($desc_e_value5),
                                                'desc_e_name6' => $desc_e_name6,
                                                'desc_e_value6' => ltrim($desc_e_value6),
                                                'desc_e_name7' => $desc_e_name7,
                                                'desc_e_value7' => ltrim($desc_e_value7),
                                                'desc_e_name8' => $desc_e_name8,
                                                'desc_e_value8' => ltrim($desc_e_value8),
                                                'desc_e_name9' => $desc_e_name9,
                                                'desc_e_value9' => ltrim($desc_e_value9),
                                                'desc_e_name10' => $desc_e_name10,
                                                'desc_e_value10' => ltrim($desc_e_value10),
                                                'desc_e_name11' => $desc_e_name11,
                                                'desc_e_value11' => ltrim($desc_e_value11),
                                                'desc_e_name12' => $desc_e_name12,
                                                'desc_e_value12' => ltrim($desc_e_value12),
                                                'desc_e_name13' => $desc_e_name13,
                                                'desc_e_value13' => ltrim($desc_e_value13),
                                                'desc_e_name14' => $desc_e_name14,
                                                'desc_e_value14' => ltrim($desc_e_value14),
                                                'desc_e_name15' => $desc_e_name15,
                                                'desc_e_value15' => ltrim($desc_e_value15),
                                                'readytowear' => $prod->ReadyToWear,
                                                'smi' => "",
                                                'image1' => $image1,
                                                'image2' => $image2,
                                                'image3' => $image3,
                                                'image4' => $image4,
                                                'image5' => $image5,
                                                'image6' => $image6,
                                                'FullySetImage1' => $fullysetimage1,
                                                'FullySetImage2' => $fullysetimage2,
                                                'FullySetImage3' => $fullysetimage3,
                                                'FullySetImage4' => $fullysetimage4,
                                                'FullySetImage5' => $fullysetimage5,
                                                'FullySetImage6' => $fullysetimage6,
                                                'video' => $vedio,
                                                'gimage1' => $gimage1,
                                                'gimage2' => $gimage2,
                                                'gimage3' => $gimage3,
                                                'gvideo' => $gvedio,
                                                'creationdate' => $CreationDate,
                                                'currencycode' => "USD",
                                                'country' => $CountryOfOrigin,
                                                'dclarity' => "",
                                                'dcolor' => "",
                                                'totalweight' => "",
                                                'ip' => $ip,
                                                'added_by' => $addedby,
                                                'is_active' => 1,
                                                'group_id' => $prod->DescriptiveElementGroup->GroupId,
                                                'series_id' => $prod->DescriptiveElementGroup->DescriptiveElements[0]->Value,

                                                'date' => $cur_date
                                            );
                                            $last_id = $this->base_model->insert_table("tbl_products", $data_insert, 1);
                                            $beta_insert = array(
                                                'product_id' => $last_id,
                                                'specifications' => json_encode($specifications),
                                                'canbesetwith' => json_encode($canbesetwith),
                                                'setwith' => json_encode($setwith),
                                                'ringsize' => json_encode($ringSizeArray),
                                            );
                                            $spec_id = $this->base_model->insert_table("tbl_product_specifications", $beta_insert, 1);
                                        }
                                    }
                                    // echo $last_id;exit;
                                    // }
                                }
                                $NextPage = "";
                                if (!empty($result_da->NextPage)) {
                                    $NextPage = $result_da->NextPage;
                                }
                                // echo $i." NP- ".$NextPage."<br>";
                            }
                            // }
                        }
                        //end squ
                    }
                    //product data insert from the api end
                    // die();
                }
            }
            //---minor sub category
            else {
                // echo $total_pages; die();
                if (empty($minorsub2)) {
                    // echo $type;
                    // exit;
                    //minor subcategory2 unexists
                    //minorsubcategory products adding
                    // echo "we".$total_pages; die();
                    //delete previous data from the table start
                    $this->db->select('*');
                    $this->db->from('tbl_products');
                    $this->db->where('category', $category_id);
                    $this->db->where('sub_category', $subcategory);
                    $this->db->where('minisub_category', $minorsub);
                    $product_data = $this->db->get();
                    $c_api = count($api_ids);
                    if ($del == 1) {
                        if (!empty($product_data)) {
                            foreach ($product_data->result() as $pro) {
                                $this->db->delete('tbl_products', array('id' => $pro->id));
                            }
                        }
                    }
                    //delete previous data from the table end
                    if ($type == 1) {
                        //delete previous data from the table end
                        if ($type == 1 || $type == "") {
                            if ($finshed == 1) {
                                $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList","Finished"],"CategoryIds":["' . $value . '"]}';
                                // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"],"NextPage":"'.$NextPage.'" }';
                            } else {
                                $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList"],"CategoryIds":["' . $value . '"]}';
                                // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"],"NextPage":"'.$NextPage.'" }';
                            }
                        }
                        if ($type == 2) {
                            // $ne_id=json_decode($api_id);
                            // echo $ne_id;
                            // exit;
                            // foreach ($api_id as $value) {
                            if ($finshed == 1) {
                                $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList","Finished"],"Series":["' . $value . '"]}';
                                // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"],"NextPage":"'.$NextPage.'" }';
                            } else {
                                $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList"],"Series":["' . $value . '"]}';
                                // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"]}';
                            }
                        }
                        $postdata = $data;
                        $header = array();
                        $header[] = 'Host:api.stuller.com';
                        $header[] = 'Content-Type:application/json';
                        $header[] = 'Authorization:Basic ZGV2amV3ZWw6Q29kaW5nMjA9';
                        $ch = curl_init($url);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                        $result = curl_exec($ch);
                        curl_close($ch);
                        // print_r ($result);
                        $result_da = json_decode($result);
                        // echo $result[0];
                        if (!empty($result_da)) {
                            $TotalNumberOfProducts = $result_da->TotalNumberOfProducts;
                            $total_pages = round($TotalNumberOfProducts / 500) + 1;
                        }
                    } else {
                        $total_pages = 1;
                    }
                    //product data insert from the api start
                    // echo $TotalNumberOfProducts;die();
                    $NextPage = "";
                    for ($i = 0; $i < $total_pages; $i++) {
                        set_time_limit(0);
                        // code...
                        // echo $i;
                        $url = 'https://api.stuller.com/v2/products';
                        if ($type == 1 || $type == "") {
                            if ($finshed == 1) {
                                if ($i == 0) {
                                    $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList","Finished"],"CategoryIds":["' . $value . '"]}';
                                    // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"]}';
                                } else {
                                    $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList","Finished"],"CategoryIds":["' . $value . '"],"NextPage":"' . $NextPage . '" }';
                                    // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"],"NextPage":"'.$NextPage.'" }';
                                }
                            } else {
                                if ($i == 0) {
                                    $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList"],"CategoryIds":["' . $value . '"]}';
                                    // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"]}';
                                } else {
                                    $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList"],"CategoryIds":["' . $value . '"],"NextPage":"' . $NextPage . '" }';
                                    // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"],"NextPage":"'.$NextPage.'" }';
                                }
                            }
                            $postdata = $data;
                            $header = array();
                            $header[] = 'Host:api.stuller.com';
                            $header[] = 'Content-Type:application/json';
                            $header[] = 'Authorization:Basic ZGV2amV3ZWw6Q29kaW5nMjA9';
                            $ch = curl_init($url);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            curl_setopt($ch, CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                            $result = curl_exec($ch);
                            curl_close($ch);
                            $result_da = json_decode($result);
                            if (!empty($result_da)) {
                                foreach ($result_da->Products as $prod) {
                                    $specifications = [];
                                    $ringsize = 0;
                                    $ringsizetype = "";
                                    $RingSizable = "";
                                    if (!empty($prod->RingSizable)) {
                                        $RingSizable = $prod->RingSizable;
                                        if ($RingSizable == false) {
                                            $ringsize = 0;
                                            $ringsizetype = "";
                                        } else {
                                            if (!empty($prod->ringsize)) {
                                                $ringsize = $prod->ringsize;
                                            }
                                            if (!empty($prod->ringsizetype)) {
                                                $ringsizetype = $prod->ringsizetype;
                                            }
                                        }
                                    }
                                    //group eliments
                                    if (empty($prod->DescriptiveElementGroup)) {
                                        $DescriptiveElements = [];
                                    } else {
                                        $DescriptiveElements = $prod->DescriptiveElementGroup->DescriptiveElements;
                                    }
                                    $cate_array_count = 0;
                                    if (!empty($DescriptiveElements)) {
                                        $cate_array_count = count($DescriptiveElements);
                                    }
                                    $desc_e_name1 = "";
                                    $desc_e_value1 = "";
                                    $desc_e_name2 = "";
                                    $desc_e_value2 = "";
                                    $desc_e_name3 = "";
                                    $desc_e_value3 = "";
                                    $desc_e_name4 = "";
                                    $desc_e_value4 = "";
                                    $desc_e_name5 = "";
                                    $desc_e_value5 = "";
                                    $desc_e_name6 = "";
                                    $desc_e_value6 = "";
                                    $desc_e_name7 = "";
                                    $desc_e_value7 = "";
                                    $desc_e_name8 = "";
                                    $desc_e_value8 = "";
                                    $desc_e_name9 = "";
                                    $desc_e_value9 = "";
                                    $desc_e_name10 = "";
                                    $desc_e_value10 = "";
                                    $desc_e_name11 = "";
                                    $desc_e_value11 = "";
                                    $desc_e_name12 = "";
                                    $desc_e_value12 = "";
                                    $desc_e_name13 = "";
                                    $desc_e_value13 = "";
                                    $desc_e_name14 = "";
                                    $desc_e_value14 = "";
                                    $desc_e_name15 = "";
                                    $desc_e_value15 = "";
                                    if ($cate_array_count >= 1) {
                                        $desc_e_name1 = str_replace("K X1", "K Forever", $DescriptiveElements[0]->DisplayValue);
                                        $desc_e_value1 = str_replace("K X1", "K Forever", $DescriptiveElements[0]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 2) {
                                        $desc_e_name2 = $DescriptiveElements[1]->Name;
                                        $desc_e_value2 = str_replace("K X1", "K Forever", $DescriptiveElements[1]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 3) {
                                        $desc_e_name3 = $DescriptiveElements[2]->Name;
                                        $desc_e_value3 = str_replace("K X1", "K Forever", $DescriptiveElements[2]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 4) {
                                        $desc_e_name4 = $DescriptiveElements[3]->Name;
                                        $desc_e_value4 = str_replace("K X1", "K Forever", $DescriptiveElements[3]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 5) {
                                        $desc_e_name5 = $DescriptiveElements[4]->Name;
                                        $desc_e_value5 = str_replace("K X1", "K Forever", $DescriptiveElements[4]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 6) {
                                        $desc_e_name6 = $DescriptiveElements[5]->Name;
                                        $desc_e_value6 = str_replace("K X1", "K Forever", $DescriptiveElements[5]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 7) {
                                        $desc_e_name7 = $DescriptiveElements[6]->Name;
                                        $desc_e_value7 = str_replace("K X1", "K Forever", $DescriptiveElements[6]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 8) {
                                        $desc_e_name8 = $DescriptiveElements[7]->Name;
                                        $desc_e_value8 = str_replace("K X1", "K Forever", $DescriptiveElements[7]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 9) {
                                        $desc_e_name9 = $DescriptiveElements[8]->Name;
                                        $desc_e_value9 = str_replace("K X1", "K Forever", $DescriptiveElements[8]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 10) {
                                        $desc_e_name10 = $DescriptiveElements[9]->Name;
                                        $desc_e_value10 = str_replace("K X1", "K Forever", $DescriptiveElements[9]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 11) {
                                        $desc_e_name11 = $DescriptiveElements[10]->Name;
                                        $desc_e_value11 = str_replace("K X1", "K Forever", $DescriptiveElements[10]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 12) {
                                        $desc_e_name12 = $DescriptiveElements[11]->Name;
                                        $desc_e_value12 = str_replace("K X1", "K Forever", $DescriptiveElements[11]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 13) {
                                        $desc_e_name13 = $DescriptiveElements[12]->Name;
                                        $desc_e_value13 = str_replace("K X1", "K Forever", $DescriptiveElements[12]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 14) {
                                        $desc_e_name14 = $DescriptiveElements[13]->Name;
                                        $desc_e_value14 = str_replace("K X1", "K Forever", $DescriptiveElements[13]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 15) {
                                        $desc_e_name15 = $DescriptiveElements[14]->Name;
                                        $desc_e_value15 = str_replace("K X1", "K Forever", $DescriptiveElements[14]->DisplayValue);
                                    }
                                    $image1 = "";
                                    $image2 = "";
                                    $image3 = "";
                                    $image4 = "";
                                    $image5 = "";
                                    $image6 = "";
                                    $gimage1 = "";
                                    $gimage2 = "";
                                    $gimage3 = "";
                                    $fullysetimage1 = "";
                                    $fullysetimage2 = "";
                                    $fullysetimage3 = "";
                                    $fullysetimage4 = "";
                                    $fullysetimage5 = "";
                                    $fullysetimage6 = "";
                                    //get images
                                    // if(!empty($prod->Images)){
                                    //   $image1= $prod->Images[0]->FullUrl;
                                    //   $image2= $prod->Images[0]->ThumbnailUrl;
                                    //   $image3= $prod->Images[0]->ZoomUrl;
                                    // }
                                    // if(!empty($prod->GroupImages)){
                                    //   $gimage1= $prod->GroupImages[0]->ZoomUrl;
                                    //   $gimage2= $prod->GroupImages[0]->ZoomUrl;
                                    //   $gimage3= $prod->GroupImages[0]->ZoomUrl;
                                    // }
                                    //get images
                                    if (!empty($prod->Images)) {
                                        $image_peram_count = count($prod->Images);
                                        if ($image_peram_count >= 1) {
                                            $image1 = $prod->Images[0]->FullUrl;
                                        }
                                        if ($image_peram_count >= 2) {
                                            $image2 = $prod->Images[1]->FullUrl;
                                        }
                                        if ($image_peram_count >= 3) {
                                            $image3 = $prod->Images[2]->FullUrl;
                                        }
                                        if ($image_peram_count >= 4) {
                                            $image4 = $prod->Images[3]->FullUrl;
                                        }
                                        if ($image_peram_count >= 5) {
                                            $image5 = $prod->Images[4]->FullUrl;
                                        }
                                        if ($image_peram_count >= 6) {
                                            $image5 = $prod->Images[5]->FullUrl;
                                        }
                                        // $image1= $prod->Images[0]->FullUrl;
                                        // $image2= $prod->Images[0]->ThumbnailUrl;
                                        // $image3= $prod->Images[0]->ZoomUrl;
                                    }
                                    //get group images
                                    if (!empty($prod->GroupImages)) {
                                        $Groupimage_peram_count = count($prod->GroupImages);
                                        if ($Groupimage_peram_count >= 1) {
                                            $gimage1 = $prod->GroupImages[0]->FullUrl;
                                        }
                                        if ($Groupimage_peram_count >= 2) {
                                            $gimage2 = $prod->GroupImages[1]->FullUrl;
                                        }
                                        if ($Groupimage_peram_count >= 3) {
                                            $gimage3 = $prod->GroupImages[2]->FullUrl;
                                        }
                                        // $gimage1= $prod->GroupImages[0]->ZoomUrl;
                                        // $gimage2= $prod->GroupImages[0]->ZoomUrl;
                                        // $gimage3= $prod->GroupImages[0]->ZoomUrl;
                                    }
                                    //get Fully Set Images images
                                    if (!empty($prod->FullySetImages)) {
                                        $FullySetimage_peram_count = count($prod->FullySetImages);
                                        if ($FullySetimage_peram_count >= 1) {
                                            $fullysetimage1 = $prod->FullySetImages[0]->FullUrl;
                                        }
                                        if ($FullySetimage_peram_count >= 2) {
                                            $fullysetimage2 = $prod->FullySetImages[1]->FullUrl;
                                        }
                                        if ($FullySetimage_peram_count >= 3) {
                                            $fullysetimage3 = $prod->FullySetImages[2]->FullUrl;
                                        }
                                        if ($FullySetimage_peram_count >= 4) {
                                            $fullysetimage4 = $prod->FullySetImages[3]->FullUrl;
                                        }
                                        if ($FullySetimage_peram_count >= 5) {
                                            $fullysetimage5 = $prod->FullySetImages[4]->FullUrl;
                                        }
                                        if ($FullySetimage_peram_count >= 6) {
                                            $fullysetimage6 = $prod->FullySetImages[5]->FullUrl;
                                        }
                                        // $image1= $prod->Images[0]->FullUrl;
                                        // $image2= $prod->Images[0]->ThumbnailUrl;
                                        // $image3= $prod->Images[0]->ZoomUrl;
                                    }
                                    //get AGTA
                                    if (!empty($prod->AGTA)) {
                                        $agta = $prod->AGTA;
                                    } else {
                                        $agta = "";
                                    }
                                    //get MerchandisingCategory
                                    $mcat1 = "";
                                    $mcat2 = "";
                                    $mcat3 = "";
                                    $mcat4 = "";
                                    $mcat5 = "";
                                    if (!empty($prod->MerchandisingCategory1)) {
                                        $mcat1 = $prod->MerchandisingCategory1;
                                    }
                                    if (!empty($prod->MerchandisingCategory2)) {
                                        $mcat2 = $prod->MerchandisingCategory2;
                                    }
                                    if (!empty($prod->MerchandisingCategory3)) {
                                        $mcat3 = $prod->MerchandisingCategory3;
                                    }
                                    if (!empty($prod->MerchandisingCategory4)) {
                                        $mcat4 = $prod->MerchandisingCategory4;
                                    }
                                    if (!empty($prod->MerchandisingCategory5)) {
                                        $mcat5 = $prod->MerchandisingCategory5;
                                    }
                                    $Description = "";
                                    if (!empty($prod->Description)) {
                                        $Description = str_replace("K X1", "K Forever", $prod->Description);
                                    }
                                    $ShortDescription = "";
                                    if (!empty($prod->ShortDescription)) {
                                        $ShortDescription = str_replace("K X1", "K Forever", $prod->ShortDescription);
                                    }
                                    $GroupDescription = "";
                                    if (!empty($prod->GroupDescription)) {
                                        $GroupDescription = str_replace("K X1", "K Forever", $prod->GroupDescription);
                                    }
                                    $LeadTime = "";
                                    if (!empty($prod->LeadTime)) {
                                        $LeadTime = $prod->LeadTime;
                                    }
                                    //get vedio and Group vedios
                                    $vedio = "";
                                    $gvedio = "";
                                    if (!empty($prod->Videos)) {
                                        $vedio = $prod->Videos[0]->DownloadUrl;
                                    }
                                    if (!empty($prod->GroupVideos)) {
                                        $gvedio = $prod->GroupVideos[0]->Url;
                                    }
                                    //explode sku for get and save sku series and sku series type start
                                    $sku_no = $prod->SKU;
                                    if (is_numeric($sku_no[0])) {
                                        $sku_ar = explode(":", $sku_no);
                                    } else {
                                        $arr = (str_split($sku_no));
                                        $l = count($arr);
                                        for ($i = 0; $i <= $l; $i++) {
                                            if (is_numeric($arr[$i])) {
                                                array_splice($arr, $i, 0, ":");
                                                break;
                                            }
                                        }
                                        $s = join($arr);
                                        $sku_ar = explode(":", $s);
                                    }
                                    $cate_param_count = count($sku_ar);
                                    $sku_series = "";
                                    $sku_series_type1 = "";
                                    $sku_series_type2 = "";
                                    $sku_series_type3 = "";
                                    if ($cate_param_count >= 1) {
                                        $sku_series = $sku_ar[0];
                                    }
                                    if ($cate_param_count >= 2) {
                                        $sku_series_type1 = $sku_ar[1];
                                    }
                                    if ($cate_param_count >= 3) {
                                        $sku_series_type2 = $sku_ar[2];
                                    }
                                    if ($cate_param_count >= 4) {
                                        $sku_series_type3 = $sku_ar[3];
                                    }
                                    $ProductType = "";
                                    if (!empty($prod->ProductType)) {
                                        $ProductType = $prod->ProductType;
                                    }
                                    $OnHand = "";
                                    if (!empty($prod->OnHand)) {
                                        $OnHand = $prod->OnHand;
                                    }
                                    $Status = "";
                                    if (!empty($prod->Status)) {
                                        $Status = $prod->Status;
                                    }
                                    $Value = "";
                                    if (!empty($prod->Price->Value)) {
                                        $Value = $prod->Price->Value;
                                    }
                                    $CurrencyCode = "";
                                    if (!empty($prod->Price->CurrencyCode)) {
                                        $CurrencyCode = $prod->Price->CurrencyCode;
                                    }
                                    $UnitOfSale = "";
                                    if (!empty($prod->UnitOfSale)) {
                                        $UnitOfSale = $prod->UnitOfSale;
                                    }
                                    $Weight = "";
                                    if (!empty($prod->Weight)) {
                                        $Weight = $prod->Weight;
                                    }
                                    $WeightUnitOfMeasure = "";
                                    if (!empty($prod->WeightUnitOfMeasure)) {
                                        $WeightUnitOfMeasure = $prod->WeightUnitOfMeasure;
                                    }
                                    $GramWeight = "";
                                    if (!empty($prod->GramWeight)) {
                                        $GramWeight = $prod->GramWeight;
                                    }
                                    $GroupName = "";
                                    if (!empty($prod->DescriptiveElementGroup->GroupName)) {
                                        $GroupName = $prod->DescriptiveElementGroup->GroupName;
                                    }
                                    $CreationDate = "";
                                    if (!empty($prod->CreationDate)) {
                                        $CreationDate = $prod->CreationDate;
                                    }
                                    $CountryOfOrigin = "";
                                    if (!empty($prod->CountryOfOrigin)) {
                                        $CountryOfOrigin = $prod->CountryOfOrigin;
                                    }
                                    $RingSizable = "";
                                    if (!empty($prod->RingSizable)) {
                                        $RingSizable = $prod->RingSizable;
                                    }
                                    $ReadyToWear = "";
                                    if (!empty($prod->ReadyToWear)) {
                                        $ReadyToWear = $prod->ReadyToWear;
                                    }
                                    //specifications
                                    if (empty($prod->Specifications)) {
                                        $specifications = "";
                                    } else {
                                        $specifications = $prod->Specifications;
                                    }
                                    //comessetwith
                                    if (empty($prod->CanBeSetWith)) {
                                        $canbesetwith = "";
                                    } else {
                                        $canbesetwith = $prod->CanBeSetWith;
                                    }
                                    //SetWith
                                    if (empty($prod->SetWith)) {
                                        $setwith = "";
                                    } else {
                                        $setwith = $prod->SetWith;
                                    }
                                    //ringsize
                                    $ringSizeArray = [];
                                    // print_r($prod->ConfigurationModel->RingSizeOptions);die();
                                    if (!empty($prod->ConfigurationModel)) {
                                        if (empty($prod->ConfigurationModel->RingSizeOptions)) {
                                            $ringSizeArray = "";
                                        } else {
                                            foreach ($prod->ConfigurationModel->RingSizeOptions as $configModel) {
                                                $ringSizeArray[] = array(
                                                    "Size" => number_format((float)$configModel->Size, 2, '.', ''),
                                                    "Price" => $configModel->Price->Value
                                                );
                                            }
                                        }
                                    } else {
                                        $ringSizeArray = "";
                                    }
                                    //explode sku for get and save sku series and sku series type end
                                    // echo $prod->Price->Value;die();
                                    if (!empty($prod->Price->Value)) {
                                        if ($prod->Price->Value > $MINIMUM_COST) {
                                            $ex = 0;
                                            $ex1 = 0;
                                            //---- excluding series --------
                                            $this->db->select('*');
                                            $this->db->from('tbl_minisubcategory');
                                            $this->db->where('is_active', 1);
                                            $this->db->where('id', $minorsub);
                                            $cat_data = $this->db->get()->row();
                                            if (!empty($cat_data->exlude_series)) {
                                                $exclude = explode(",", $cat_data->exlude_series);
                                                if (count($exclude) > 0) {
                                                    foreach ($exclude as $key => $value345) {
                                                        if ($value345 == $sku_series) {
                                                            $ex = 1;
                                                            break;
                                                        }
                                                    }
                                                } else {
                                                    if ($cat_data->exlude_series == $sku_series) {
                                                        $ex = 1;
                                                    }
                                                }
                                            }
                                            //---- excluding sku --------
                                            if (!empty($cat_data->exlude_sku)) {
                                                $exclude1 = explode(",", $cat_data->exlude_sku);
                                                if (count($exclude1) > 0) {
                                                    foreach ($exclude1 as $key => $value3452) {
                                                        if ($value3452 == $prod->SKU) {
                                                            $ex1 = 1;
                                                            break;
                                                        }
                                                    }
                                                } else {
                                                    if ($cat_data->exlude_sku == $prod->SKU) {
                                                        $ex1 = 1;
                                                    }
                                                }
                                            }
                                            if ($ex == 0 && $ex1 == 0) {
                                                $data_insert = array(
                                                    'product_id' => $prod->Id,
                                                    'category' => $category_id,
                                                    'sub_category' => $subcategory,
                                                    'minisub_category' => $minorsub,
                                                    // 'vendor'=>1,
                                                    'sku' => $prod->SKU,
                                                    'sku_series' => $sku_series,
                                                    'sku_series_type1' => $sku_series_type1,
                                                    'sku_series_type2' => $sku_series_type2,
                                                    'sku_series_type3' => $sku_series_type3,
                                                    'description' => $Description,
                                                    'sdesc' => $ShortDescription,
                                                    'gdesc' => $GroupDescription,
                                                    'mcat1' => $mcat1,
                                                    'mcat2' => $mcat2,
                                                    'mcat3' => $mcat3,
                                                    'mcat4' => $mcat4,
                                                    'mcat5' => $mcat5,
                                                    'product_type' => $ProductType,
                                                    'collection' => "",
                                                    'onhand' => $OnHand,
                                                    'status' => $Status,
                                                    'price' => $Value,
                                                    'currency' => $CurrencyCode,
                                                    'unitofsale' => $UnitOfSale,
                                                    'weight' => $Weight,
                                                    'weightunit' => $WeightUnitOfMeasure,
                                                    'gramweight' => $GramWeight,
                                                    'ringsizable' => $RingSizable,
                                                    'ringsize' => $ringsize,
                                                    'ringsizetype' => $ringsizetype,
                                                    'leadtime' => $LeadTime,
                                                    'agta' => $agta,
                                                    'desc_e_grp' => $prod->DescriptiveElementGroup->GroupName,
                                                    'desc_e_name1' => $desc_e_name1,
                                                    'desc_e_value1' => ltrim($desc_e_value1),
                                                    'desc_e_name2' => $desc_e_name2,
                                                    'desc_e_value2' => ltrim($desc_e_value2),
                                                    'desc_e_name3' => $desc_e_name3,
                                                    'desc_e_value3' => ltrim($desc_e_value3),
                                                    'desc_e_name4' => $desc_e_name4,
                                                    'desc_e_value4' => ltrim($desc_e_value4),
                                                    'desc_e_name5' => $desc_e_name5,
                                                    'desc_e_value5' => ltrim($desc_e_value5),
                                                    'desc_e_name6' => $desc_e_name6,
                                                    'desc_e_value6' => ltrim($desc_e_value6),
                                                    'desc_e_name7' => $desc_e_name7,
                                                    'desc_e_value7' => ltrim($desc_e_value7),
                                                    'desc_e_name8' => $desc_e_name8,
                                                    'desc_e_value8' => ltrim($desc_e_value8),
                                                    'desc_e_name9' => $desc_e_name9,
                                                    'desc_e_value9' => ltrim($desc_e_value9),
                                                    'desc_e_name10' => $desc_e_name10,
                                                    'desc_e_value10' => ltrim($desc_e_value10),
                                                    'desc_e_name11' => $desc_e_name11,
                                                    'desc_e_value11' => ltrim($desc_e_value11),
                                                    'desc_e_name12' => $desc_e_name12,
                                                    'desc_e_value12' => ltrim($desc_e_value12),
                                                    'desc_e_name13' => $desc_e_name13,
                                                    'desc_e_value13' => ltrim($desc_e_value13),
                                                    'desc_e_name14' => $desc_e_name14,
                                                    'desc_e_value14' => ltrim($desc_e_value14),
                                                    'desc_e_name15' => $desc_e_name15,
                                                    'desc_e_value15' => ltrim($desc_e_value15),
                                                    'readytowear' => $ReadyToWear,
                                                    'smi' => "",
                                                    'image1' => $image1,
                                                    'image2' => $image2,
                                                    'image3' => $image3,
                                                    'image4' => $image4,
                                                    'image5' => $image5,
                                                    'image6' => $image6,
                                                    'FullySetImage1' => $fullysetimage1,
                                                    'FullySetImage2' => $fullysetimage2,
                                                    'FullySetImage3' => $fullysetimage3,
                                                    'FullySetImage4' => $fullysetimage4,
                                                    'FullySetImage5' => $fullysetimage5,
                                                    'FullySetImage6' => $fullysetimage6,
                                                    'video' => $vedio,
                                                    'gimage1' => $gimage1,
                                                    'gimage2' => $gimage2,
                                                    'gimage3' => $gimage3,
                                                    'gvideo' => $gvedio,
                                                    'creationdate' => $CreationDate,
                                                    'currencycode' => "USD",
                                                    'country' => $CountryOfOrigin,
                                                    'dclarity' => "",
                                                    'dcolor' => "",
                                                    'totalweight' => "",
                                                    'ip' => $ip,
                                                    'added_by' => $addedby,
                                                    'is_active' => 1,
                                                    'group_id' => $prod->DescriptiveElementGroup->GroupId,
                                                    'series_id' => $prod->DescriptiveElementGroup->DescriptiveElements[0]->Value,

                                                    'date' => $cur_date
                                                );
                                                $last_id = $this->base_model->insert_table("tbl_products", $data_insert, 1);
                                                $beta_insert = array(
                                                    'product_id' => $last_id,
                                                    'specifications' => json_encode($specifications),
                                                    'canbesetwith' => json_encode($canbesetwith),
                                                    'setwith' => json_encode($setwith),
                                                    'ringsize' => json_encode($ringSizeArray),
                                                );
                                                $spec_id = $this->base_model->insert_table("tbl_product_specifications", $beta_insert, 1);
                                            }
                                        }
                                    }
                                }
                                $NextPage = "";
                                if (!empty($result_da->NextPage)) {
                                    $NextPage = $result_da->NextPage;
                                }
                                // echo $i." NP- ".$NextPage."<br>";
                            }
                        }
                        if ($type == 2) {
                            // $n_it=json_decode($api_id);
                            // foreach ($api_id as $value) {
                            if ($finshed == 1) {
                                if ($i == 0) {
                                    $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList","Finished"],"Series":["' . $value . '"]}';
                                    // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"]}';
                                } else {
                                    $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList","Finished"],"Series":["' . $value . '"],"NextPage":"' . $NextPage . '" }';
                                    // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"],"NextPage":"'.$NextPage.'" }';
                                }
                            } else {
                                if ($i == 0) {
                                    $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList"],"Series":["' . $value . '"]}';
                                    // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"]}';
                                } else {
                                    $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList"],"Series":["' . $value . '"],"NextPage":"' . $NextPage . '" }';
                                    // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"],"NextPage":"'.$NextPage.'" }';
                                }
                            }
                            $postdata = $data;
                            $header = array();
                            $header[] = 'Host:api.stuller.com';
                            $header[] = 'Content-Type:application/json';
                            $header[] = 'Authorization:Basic ZGV2amV3ZWw6Q29kaW5nMjA9';
                            $ch = curl_init($url);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            curl_setopt($ch, CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                            $result = curl_exec($ch);
                            curl_close($ch);
                            $result_da = json_decode($result);
                            // print_r($result_da);die();
                            if (!empty($result_da->Products)) {
                                foreach ($result_da->Products as $prod) {
                                    $specifications = [];
                                    $ringsize = 0;
                                    $ringsizetype = "";
                                    $RingSizable = "";
                                    if (!empty($prod->RingSizable)) {
                                        $RingSizable = $prod->RingSizable;
                                        if ($RingSizable == false) {
                                            $ringsize = 0;
                                            $ringsizetype = "";
                                        } else {
                                            if (!empty($prod->ringsize)) {
                                                $ringsize = $prod->ringsize;
                                            }
                                            if (!empty($prod->ringsizetype)) {
                                                $ringsizetype = $prod->ringsizetype;
                                            }
                                        }
                                    }
                                    //group eliments
                                    if (empty($prod->DescriptiveElementGroup)) {
                                        $DescriptiveElements = [];
                                    } else {
                                        $DescriptiveElements = $prod->DescriptiveElementGroup->DescriptiveElements;
                                    }
                                    $cate_array_count = 0;
                                    if (!empty($DescriptiveElements)) {
                                        $cate_array_count = count($DescriptiveElements);
                                    }
                                    $desc_e_name1 = "";
                                    $desc_e_value1 = "";
                                    $desc_e_name2 = "";
                                    $desc_e_value2 = "";
                                    $desc_e_name3 = "";
                                    $desc_e_value3 = "";
                                    $desc_e_name4 = "";
                                    $desc_e_value4 = "";
                                    $desc_e_name5 = "";
                                    $desc_e_value5 = "";
                                    $desc_e_name6 = "";
                                    $desc_e_value6 = "";
                                    $desc_e_name7 = "";
                                    $desc_e_value7 = "";
                                    $desc_e_name8 = "";
                                    $desc_e_value8 = "";
                                    $desc_e_name9 = "";
                                    $desc_e_value9 = "";
                                    $desc_e_name10 = "";
                                    $desc_e_value10 = "";
                                    $desc_e_name11 = "";
                                    $desc_e_value11 = "";
                                    $desc_e_name12 = "";
                                    $desc_e_value12 = "";
                                    $desc_e_name13 = "";
                                    $desc_e_value13 = "";
                                    $desc_e_name14 = "";
                                    $desc_e_value14 = "";
                                    $desc_e_name15 = "";
                                    $desc_e_value15 = "";
                                    if ($cate_array_count >= 1) {
                                        $desc_e_name1 = $DescriptiveElements[0]->Name;
                                        $desc_e_value1 = str_replace("K X1", "K Forever", $DescriptiveElements[0]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 2) {
                                        $desc_e_name2 = $DescriptiveElements[1]->Name;
                                        $desc_e_value2 = str_replace("K X1", "K Forever", $DescriptiveElements[1]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 3) {
                                        $desc_e_name3 = $DescriptiveElements[2]->Name;
                                        $desc_e_value3 = str_replace("K X1", "K Forever", $DescriptiveElements[2]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 4) {
                                        $desc_e_name4 = $DescriptiveElements[3]->Name;
                                        $desc_e_value4 = str_replace("K X1", "K Forever", $DescriptiveElements[3]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 5) {
                                        $desc_e_name5 = $DescriptiveElements[4]->Name;
                                        $desc_e_value5 = str_replace("K X1", "K Forever", $DescriptiveElements[4]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 6) {
                                        $desc_e_name6 = $DescriptiveElements[5]->Name;
                                        $desc_e_value6 = str_replace("K X1", "K Forever", $DescriptiveElements[5]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 7) {
                                        $desc_e_name7 = $DescriptiveElements[6]->Name;
                                        $desc_e_value7 = str_replace("K X1", "K Forever", $DescriptiveElements[6]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 8) {
                                        $desc_e_name8 = $DescriptiveElements[7]->Name;
                                        $desc_e_value8 = str_replace("K X1", "K Forever", $DescriptiveElements[7]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 9) {
                                        $desc_e_name9 = $DescriptiveElements[8]->Name;
                                        $desc_e_value9 = str_replace("K X1", "K Forever", $DescriptiveElements[8]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 10) {
                                        $desc_e_name10 = $DescriptiveElements[9]->Name;
                                        $desc_e_value10 = str_replace("K X1", "K Forever", $DescriptiveElements[9]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 11) {
                                        $desc_e_name11 = $DescriptiveElements[10]->Name;
                                        $desc_e_value11 = str_replace("K X1", "K Forever", $DescriptiveElements[10]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 12) {
                                        $desc_e_name12 = $DescriptiveElements[11]->Name;
                                        $desc_e_value12 = str_replace("K X1", "K Forever", $DescriptiveElements[11]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 13) {
                                        $desc_e_name13 = $DescriptiveElements[12]->Name;
                                        $desc_e_value13 = str_replace("K X1", "K Forever", $DescriptiveElements[12]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 14) {
                                        $desc_e_name14 = $DescriptiveElements[13]->Name;
                                        $desc_e_value14 = str_replace("K X1", "K Forever", $DescriptiveElements[13]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 15) {
                                        $desc_e_name15 = $DescriptiveElements[14]->Name;
                                        $desc_e_value15 = str_replace("K X1", "K Forever", $DescriptiveElements[14]->DisplayValue);
                                    }
                                    $image1 = "";
                                    $image2 = "";
                                    $image3 = "";
                                    $image4 = "";
                                    $image5 = "";
                                    $image6 = "";
                                    $gimage1 = "";
                                    $gimage2 = "";
                                    $gimage3 = "";
                                    $fullysetimage1 = "";
                                    $fullysetimage2 = "";
                                    $fullysetimage3 = "";
                                    $fullysetimage4 = "";
                                    $fullysetimage5 = "";
                                    $fullysetimage6 = "";
                                    //get images
                                    // if(!empty($prod->Images)){
                                    //   $image1= $prod->Images[0]->FullUrl;
                                    //   $image2= $prod->Images[0]->ThumbnailUrl;
                                    //   $image3= $prod->Images[0]->ZoomUrl;
                                    // }
                                    // if(!empty($prod->GroupImages)){
                                    //   $gimage1= $prod->GroupImages[0]->ZoomUrl;
                                    //   $gimage2= $prod->GroupImages[0]->ZoomUrl;
                                    //   $gimage3= $prod->GroupImages[0]->ZoomUrl;
                                    // }
                                    //get images
                                    if (!empty($prod->Images)) {
                                        $image_peram_count = count($prod->Images);
                                        if ($image_peram_count >= 1) {
                                            $image1 = $prod->Images[0]->FullUrl;
                                        }
                                        if ($image_peram_count >= 2) {
                                            $image2 = $prod->Images[1]->FullUrl;
                                        }
                                        if ($image_peram_count >= 3) {
                                            $image3 = $prod->Images[2]->FullUrl;
                                        }
                                        if ($image_peram_count >= 4) {
                                            $image4 = $prod->Images[3]->FullUrl;
                                        }
                                        if ($image_peram_count >= 5) {
                                            $image5 = $prod->Images[4]->FullUrl;
                                        }
                                        if ($image_peram_count >= 6) {
                                            $image5 = $prod->Images[5]->FullUrl;
                                        }
                                        // $image1= $prod->Images[0]->FullUrl;
                                        // $image2= $prod->Images[0]->ThumbnailUrl;
                                        // $image3= $prod->Images[0]->ZoomUrl;
                                    }
                                    //get group images
                                    if (!empty($prod->GroupImages)) {
                                        $Groupimage_peram_count = count($prod->GroupImages);
                                        if ($Groupimage_peram_count >= 1) {
                                            $gimage1 = $prod->GroupImages[0]->FullUrl;
                                        }
                                        if ($Groupimage_peram_count >= 2) {
                                            $gimage2 = $prod->GroupImages[1]->FullUrl;
                                        }
                                        if ($Groupimage_peram_count >= 3) {
                                            $gimage3 = $prod->GroupImages[2]->FullUrl;
                                        }
                                        // $gimage1= $prod->GroupImages[0]->ZoomUrl;
                                        // $gimage2= $prod->GroupImages[0]->ZoomUrl;
                                        // $gimage3= $prod->GroupImages[0]->ZoomUrl;
                                    }
                                    //get Fully Set Images images
                                    if (!empty($prod->FullySetImages)) {
                                        $FullySetimage_peram_count = count($prod->FullySetImages);
                                        if ($FullySetimage_peram_count >= 1) {
                                            $fullysetimage1 = $prod->FullySetImages[0]->FullUrl;
                                        }
                                        if ($FullySetimage_peram_count >= 2) {
                                            $fullysetimage2 = $prod->FullySetImages[1]->FullUrl;
                                        }
                                        if ($FullySetimage_peram_count >= 3) {
                                            $fullysetimage3 = $prod->FullySetImages[2]->FullUrl;
                                        }
                                        if ($FullySetimage_peram_count >= 4) {
                                            $fullysetimage4 = $prod->FullySetImages[3]->FullUrl;
                                        }
                                        if ($FullySetimage_peram_count >= 5) {
                                            $fullysetimage5 = $prod->FullySetImages[4]->FullUrl;
                                        }
                                        if ($FullySetimage_peram_count >= 6) {
                                            $fullysetimage6 = $prod->FullySetImages[5]->FullUrl;
                                        }
                                        // $image1= $prod->Images[0]->FullUrl;
                                        // $image2= $prod->Images[0]->ThumbnailUrl;
                                        // $image3= $prod->Images[0]->ZoomUrl;
                                    }
                                    //get AGTA
                                    if (!empty($prod->AGTA)) {
                                        $agta = $prod->AGTA;
                                    } else {
                                        $agta = "";
                                    }
                                    //get MerchandisingCategory
                                    $mcat1 = "";
                                    $mcat2 = "";
                                    $mcat3 = "";
                                    $mcat4 = "";
                                    $mcat5 = "";
                                    if (!empty($prod->MerchandisingCategory1)) {
                                        $mcat1 = $prod->MerchandisingCategory1;
                                    }
                                    if (!empty($prod->MerchandisingCategory2)) {
                                        $mcat2 = $prod->MerchandisingCategory2;
                                    }
                                    if (!empty($prod->MerchandisingCategory3)) {
                                        $mcat3 = $prod->MerchandisingCategory3;
                                    }
                                    if (!empty($prod->MerchandisingCategory4)) {
                                        $mcat4 = $prod->MerchandisingCategory4;
                                    }
                                    if (!empty($prod->MerchandisingCategory5)) {
                                        $mcat5 = $prod->MerchandisingCategory5;
                                    }
                                    $Description = "";
                                    if (!empty($prod->Description)) {
                                        $Description = str_replace("K X1", "K Forever", $prod->Description);
                                    }
                                    $ShortDescription = "";
                                    if (!empty($prod->ShortDescription)) {
                                        $ShortDescription = str_replace("K X1", "K Forever", $prod->ShortDescription);
                                    }
                                    $GroupDescription = "";
                                    if (!empty($prod->GroupDescription)) {
                                        $GroupDescription = str_replace("K X1", "K Forever", $prod->GroupDescription);
                                    }
                                    $LeadTime = "";
                                    if (!empty($prod->LeadTime)) {
                                        $LeadTime = $prod->LeadTime;
                                    }
                                    //get vedio and Group vedios
                                    $vedio = "";
                                    $gvedio = "";
                                    if (!empty($prod->Videos)) {
                                        $vedio = $prod->Videos[0]->DownloadUrl;
                                    }
                                    if (!empty($prod->GroupVideos)) {
                                        $gvedio = $prod->GroupVideos[0]->Url;
                                    }
                                    //explode sku for get and save sku series and sku series type start
                                    $sku_no = $prod->SKU;
                                    if (is_numeric($sku_no[0])) {
                                        $sku_ar = explode(":", $sku_no);
                                    } else {
                                        $arr = (str_split($sku_no));
                                        $l = count($arr);
                                        for ($i = 0; $i <= $l; $i++) {
                                            if (is_numeric($arr[$i])) {
                                                array_splice($arr, $i, 0, ":");
                                                break;
                                            }
                                        }
                                        $s = join($arr);
                                        $sku_ar = explode(":", $s);
                                    }
                                    $cate_param_count = count($sku_ar);
                                    $sku_series = "";
                                    $sku_series_type1 = "";
                                    $sku_series_type2 = "";
                                    $sku_series_type3 = "";
                                    if ($cate_param_count >= 1) {
                                        $sku_series = $sku_ar[0];
                                    }
                                    if ($cate_param_count >= 2) {
                                        $sku_series_type1 = $sku_ar[1];
                                    }
                                    if ($cate_param_count >= 3) {
                                        $sku_series_type2 = $sku_ar[2];
                                    }
                                    if ($cate_param_count >= 4) {
                                        $sku_series_type3 = $sku_ar[3];
                                    }
                                    $ProductType = "";
                                    if (!empty($prod->ProductType)) {
                                        $ProductType = $prod->ProductType;
                                    }
                                    $OnHand = "";
                                    if (!empty($prod->OnHand)) {
                                        $OnHand = $prod->OnHand;
                                    }
                                    $Status = "";
                                    if (!empty($prod->Status)) {
                                        $Status = $prod->Status;
                                    }
                                    $Value = "";
                                    if (!empty($prod->Price->Value)) {
                                        $Value = $prod->Price->Value;
                                    }
                                    $CurrencyCode = "";
                                    if (!empty($prod->Price->CurrencyCode)) {
                                        $CurrencyCode = $prod->Price->CurrencyCode;
                                    }
                                    $UnitOfSale = "";
                                    if (!empty($prod->UnitOfSale)) {
                                        $UnitOfSale = $prod->UnitOfSale;
                                    }
                                    $Weight = "";
                                    if (!empty($prod->Weight)) {
                                        $Weight = $prod->Weight;
                                    }
                                    $WeightUnitOfMeasure = "";
                                    if (!empty($prod->WeightUnitOfMeasure)) {
                                        $WeightUnitOfMeasure = $prod->WeightUnitOfMeasure;
                                    }
                                    $GramWeight = "";
                                    if (!empty($prod->GramWeight)) {
                                        $GramWeight = $prod->GramWeight;
                                    }
                                    $GroupName = "";
                                    if (!empty($prod->DescriptiveElementGroup->GroupName)) {
                                        $GroupName = $prod->DescriptiveElementGroup->GroupName;
                                    }
                                    $CreationDate = "";
                                    if (!empty($prod->CreationDate)) {
                                        $CreationDate = $prod->CreationDate;
                                    }
                                    $CountryOfOrigin = "";
                                    if (!empty($prod->CountryOfOrigin)) {
                                        $CountryOfOrigin = $prod->CountryOfOrigin;
                                    }
                                    $RingSizable = "";
                                    if (!empty($prod->RingSizable)) {
                                        $RingSizable = $prod->RingSizable;
                                    }
                                    //specifications
                                    if (empty($prod->Specifications)) {
                                        $specifications = "";
                                    } else {
                                        $specifications = $prod->Specifications;
                                    }
                                    //comessetwith
                                    if (empty($prod->CanBeSetWith)) {
                                        $canbesetwith = "";
                                    } else {
                                        $canbesetwith = $prod->CanBeSetWith;
                                    }
                                    //SetWith
                                    if (empty($prod->SetWith)) {
                                        $setwith = "";
                                    } else {
                                        $setwith = $prod->SetWith;
                                    }
                                    //ringsize
                                    $ringSizeArray = [];
                                    // print_r($prod->ConfigurationModel->RingSizeOptions);die();
                                    if (!empty($prod->ConfigurationModel)) {
                                        if (empty($prod->ConfigurationModel->RingSizeOptions)) {
                                            $ringSizeArray = "";
                                        } else {
                                            foreach ($prod->ConfigurationModel->RingSizeOptions as $configModel) {
                                                $ringSizeArray[] = array(
                                                    "Size" => number_format((float)$configModel->Size, 2, '.', ''),
                                                    "Price" => $configModel->Price->Value
                                                );
                                            }
                                        }
                                    } else {
                                        $ringSizeArray = "";
                                    }
                                    //explode sku for get and save sku series and sku series type end
                                    if (!empty($prod->Price->Value)) {
                                        if ($prod->Price->Value > $MINIMUM_COST) {
                                            $ex = 0;
                                            $ex1 = 0;
                                            //---- excluding series --------
                                            $this->db->select('*');
                                            $this->db->from('tbl_minisubcategory');
                                            $this->db->where('is_active', 1);
                                            $this->db->where('id', $minorsub);
                                            $cat_data = $this->db->get()->row();
                                            if (!empty($cat_data->exlude_series)) {
                                                $exclude = explode(",", $cat_data->exlude_series);
                                                if (count($exclude) > 0) {
                                                    foreach ($exclude as $key => $value345) {
                                                        if ($value345 == $sku_series) {
                                                            $ex = 1;
                                                            break;
                                                        }
                                                    }
                                                } else {
                                                    if ($cat_data->exlude_series == $sku_series) {
                                                        $ex = 1;
                                                    }
                                                }
                                            }
                                            //---- excluding sku --------
                                            if (!empty($cat_data->exlude_sku)) {
                                                $exclude1 = explode(",", $cat_data->exlude_sku);
                                                if (count($exclude1) > 0) {
                                                    foreach ($exclude1 as $key => $value3452) {
                                                        if ($value3452 == $prod->SKU) {
                                                            $ex1 = 1;
                                                            break;
                                                        }
                                                    }
                                                } else {
                                                    if ($cat_data->exlude_sku == $prod->SKU) {
                                                        $ex1 = 1;
                                                    }
                                                }
                                            }
                                            if ($ex == 0 && $ex1 == 0) {
                                                $data_insert = array(
                                                    'product_id' => $prod->Id,
                                                    'category' => $category_id,
                                                    'sub_category' => $subcategory,
                                                    'minisub_category' => $minorsub,
                                                    // 'vendor'=>1,
                                                    'sku' => $prod->SKU,
                                                    'sku_series' => $sku_series,
                                                    'sku_series_type1' => $sku_series_type1,
                                                    'sku_series_type2' => $sku_series_type2,
                                                    'sku_series_type3' => $sku_series_type3,
                                                    'description' => $Description,
                                                    'sdesc' => $ShortDescription,
                                                    'gdesc' => $GroupDescription,
                                                    'mcat1' => $mcat1,
                                                    'mcat2' => $mcat2,
                                                    'mcat3' => $mcat3,
                                                    'mcat4' => $mcat4,
                                                    'mcat5' => $mcat5,
                                                    'product_type' => $ProductType,
                                                    'collection' => "",
                                                    'onhand' => $OnHand,
                                                    'status' => $Status,
                                                    'price' => $Value,
                                                    'currency' => $CurrencyCode,
                                                    'unitofsale' => $UnitOfSale,
                                                    'weight' => $Weight,
                                                    'weightunit' => $WeightUnitOfMeasure,
                                                    'gramweight' => $GramWeight,
                                                    'ringsizable' => $RingSizable,
                                                    'ringsize' => $ringsize,
                                                    'ringsizetype' => $ringsizetype,
                                                    'leadtime' => $LeadTime,
                                                    'agta' => $agta,
                                                    'desc_e_grp' => $GroupName,
                                                    'desc_e_name1' => $desc_e_name1,
                                                    'desc_e_value1' => ltrim($desc_e_value1),
                                                    'desc_e_name2' => $desc_e_name2,
                                                    'desc_e_value2' => ltrim($desc_e_value2),
                                                    'desc_e_name3' => $desc_e_name3,
                                                    'desc_e_value3' => ltrim($desc_e_value3),
                                                    'desc_e_name4' => $desc_e_name4,
                                                    'desc_e_value4' => ltrim($desc_e_value4),
                                                    'desc_e_name5' => $desc_e_name5,
                                                    'desc_e_value5' => ltrim($desc_e_value5),
                                                    'desc_e_name6' => $desc_e_name6,
                                                    'desc_e_value6' => ltrim($desc_e_value6),
                                                    'desc_e_name7' => $desc_e_name7,
                                                    'desc_e_value7' => ltrim($desc_e_value7),
                                                    'desc_e_name8' => $desc_e_name8,
                                                    'desc_e_value8' => ltrim($desc_e_value8),
                                                    'desc_e_name9' => $desc_e_name9,
                                                    'desc_e_value9' => ltrim($desc_e_value9),
                                                    'desc_e_name10' => $desc_e_name10,
                                                    'desc_e_value10' => ltrim($desc_e_value10),
                                                    'desc_e_name11' => $desc_e_name11,
                                                    'desc_e_value11' => ltrim($desc_e_value11),
                                                    'desc_e_name12' => $desc_e_name12,
                                                    'desc_e_value12' => ltrim($desc_e_value12),
                                                    'desc_e_name13' => $desc_e_name13,
                                                    'desc_e_value13' => ltrim($desc_e_value13),
                                                    'desc_e_name14' => $desc_e_name14,
                                                    'desc_e_value14' => ltrim($desc_e_value14),
                                                    'desc_e_name15' => $desc_e_name15,
                                                    'desc_e_value15' => ltrim($desc_e_value15),
                                                    'readytowear' => $prod->ReadyToWear,
                                                    'smi' => "",
                                                    'image1' => $image1,
                                                    'image2' => $image2,
                                                    'image3' => $image3,
                                                    'image4' => $image4,
                                                    'image5' => $image5,
                                                    'image6' => $image6,
                                                    'FullySetImage1' => $fullysetimage1,
                                                    'FullySetImage2' => $fullysetimage2,
                                                    'FullySetImage3' => $fullysetimage3,
                                                    'FullySetImage4' => $fullysetimage4,
                                                    'FullySetImage5' => $fullysetimage5,
                                                    'FullySetImage6' => $fullysetimage6,
                                                    'video' => $vedio,
                                                    'gimage1' => $gimage1,
                                                    'gimage2' => $gimage2,
                                                    'gimage3' => $gimage3,
                                                    'gvideo' => $gvedio,
                                                    'creationdate' => $CreationDate,
                                                    'currencycode' => "USD",
                                                    'country' => $CountryOfOrigin,
                                                    'dclarity' => "",
                                                    'dcolor' => "",
                                                    'totalweight' => "",
                                                    'ip' => $ip,
                                                    'added_by' => $addedby,
                                                    'is_active' => 1,
                                                    'group_id' => $prod->DescriptiveElementGroup->GroupId,
                                                    'series_id' => $prod->DescriptiveElementGroup->DescriptiveElements[0]->Value,

                                                    'date' => $cur_date
                                                );
                                                $last_id = $this->base_model->insert_table("tbl_products", $data_insert, 1);
                                                $beta_insert = array(
                                                    'product_id' => $last_id,
                                                    'specifications' => json_encode($specifications),
                                                    'canbesetwith' => json_encode($canbesetwith),
                                                    'setwith' => json_encode($setwith),
                                                    'ringsize' => json_encode($ringSizeArray),
                                                );
                                                $spec_id = $this->base_model->insert_table("tbl_product_specifications", $beta_insert, 1);
                                            }
                                        }
                                    }
                                }
                                $NextPage = "";
                                if (!empty($result_da->NextPage)) {
                                    $NextPage = $result_da->NextPage;
                                }
                                // echo $i." NP- ".$NextPage."<br>";
                            }
                            // $NextPage= "";
                            // $NextPage= $result_da->NextPage;
                            // echo $i." NP- ".$NextPage."<br>";
                            // }
                        }
                        //statr squ
                        if ($type == 3) {
                            // foreach ($api_id as $value) {
                            $url = 'https://api.stuller.com/v2/products?SKU=' . $value;
                            $header = array();
                            $header[] = 'Host:api.stuller.com';
                            $header[] = 'Content-Type:application/json';
                            $header[] = 'Authorization:Basic ZGV2amV3ZWw6Q29kaW5nMjA9';
                            $ch = curl_init($url);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            // curl_setopt($ch, CURLOPT_POST, 1);
                            // curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                            $result = curl_exec($ch);
                            curl_close($ch);
                            $result_da = json_decode($result);
                            // echo "<pre>";
                            //
                            // print_r($result_da);
                            // echo "</pre>";
                            //
                            // exit;
                            if (!empty($result_da)) {
                                foreach ($result_da->Products as $prod) {
                                    $specifications = [];
                                    $ringsize = 0;
                                    $ringsizetype = "";
                                    $RingSizable = "";
                                    if (!empty($prod->RingSizable)) {
                                        $RingSizable = $prod->RingSizable;
                                        if ($RingSizable == false) {
                                            $ringsize = 0;
                                            $ringsizetype = "";
                                        } else {
                                            if (!empty($prod->ringsize)) {
                                                $ringsize = $prod->ringsize;
                                            }
                                            if (!empty($prod->ringsizetype)) {
                                                $ringsizetype = $prod->ringsizetype;
                                            }
                                        }
                                    }
                                    //group eliments
                                    if (empty($prod->DescriptiveElementGroup)) {
                                        $DescriptiveElements = [];
                                    } else {
                                        $DescriptiveElements = $prod->DescriptiveElementGroup->DescriptiveElements;
                                    }
                                    $cate_array_count = 0;
                                    if (!empty($DescriptiveElements)) {
                                        $cate_array_count = count($DescriptiveElements);
                                    }
                                    $desc_e_name1 = "";
                                    $desc_e_value1 = "";
                                    $desc_e_name2 = "";
                                    $desc_e_value2 = "";
                                    $desc_e_name3 = "";
                                    $desc_e_value3 = "";
                                    $desc_e_name4 = "";
                                    $desc_e_value4 = "";
                                    $desc_e_name5 = "";
                                    $desc_e_value5 = "";
                                    $desc_e_name6 = "";
                                    $desc_e_value6 = "";
                                    $desc_e_name7 = "";
                                    $desc_e_value7 = "";
                                    $desc_e_name8 = "";
                                    $desc_e_value8 = "";
                                    $desc_e_name9 = "";
                                    $desc_e_value9 = "";
                                    $desc_e_name10 = "";
                                    $desc_e_value10 = "";
                                    $desc_e_name11 = "";
                                    $desc_e_value11 = "";
                                    $desc_e_name12 = "";
                                    $desc_e_value12 = "";
                                    $desc_e_name13 = "";
                                    $desc_e_value13 = "";
                                    $desc_e_name14 = "";
                                    $desc_e_value14 = "";
                                    $desc_e_name15 = "";
                                    $desc_e_value15 = "";
                                    if ($cate_array_count >= 1) {
                                        $desc_e_name1 = $DescriptiveElements[0]->Name;
                                        $desc_e_value1 = str_replace("K X1", "K Forever", $DescriptiveElements[0]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 2) {
                                        $desc_e_name2 = $DescriptiveElements[1]->Name;
                                        $desc_e_value2 = str_replace("K X1", "K Forever", $DescriptiveElements[1]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 3) {
                                        $desc_e_name3 = $DescriptiveElements[2]->Name;
                                        $desc_e_value3 = str_replace("K X1", "K Forever", $DescriptiveElements[2]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 4) {
                                        $desc_e_name4 = $DescriptiveElements[3]->Name;
                                        $desc_e_value4 = str_replace("K X1", "K Forever", $DescriptiveElements[3]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 5) {
                                        $desc_e_name5 = $DescriptiveElements[4]->Name;
                                        $desc_e_value5 = str_replace("K X1", "K Forever", $DescriptiveElements[4]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 6) {
                                        $desc_e_name6 = $DescriptiveElements[5]->Name;
                                        $desc_e_value6 = str_replace("K X1", "K Forever", $DescriptiveElements[5]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 7) {
                                        $desc_e_name7 = $DescriptiveElements[6]->Name;
                                        $desc_e_value7 = $DescriptiveElements[6]->Value;
                                    }
                                    if ($cate_array_count >= 8) {
                                        $desc_e_name8 = $DescriptiveElements[7]->Name;
                                        $desc_e_value8 = str_replace("K X1", "K Forever", $DescriptiveElements[7]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 9) {
                                        $desc_e_name9 = $DescriptiveElements[8]->Name;
                                        $desc_e_value9 = str_replace("K X1", "K Forever", $DescriptiveElements[8]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 10) {
                                        $desc_e_name10 = $DescriptiveElements[9]->Name;
                                        $desc_e_value10 = str_replace("K X1", "K Forever", $DescriptiveElements[9]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 11) {
                                        $desc_e_name11 = $DescriptiveElements[10]->Name;
                                        $desc_e_value11 = str_replace("K X1", "K Forever", $DescriptiveElements[10]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 12) {
                                        $desc_e_name12 = $DescriptiveElements[11]->Name;
                                        $desc_e_value12 = str_replace("K X1", "K Forever", $DescriptiveElements[11]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 13) {
                                        $desc_e_name13 = $DescriptiveElements[12]->Name;
                                        $desc_e_value13 = str_replace("K X1", "K Forever", $DescriptiveElements[12]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 14) {
                                        $desc_e_name14 = $DescriptiveElements[13]->Name;
                                        $desc_e_value14 = str_replace("K X1", "K Forever", $DescriptiveElements[13]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 15) {
                                        $desc_e_name15 = $DescriptiveElements[14]->Name;
                                        $desc_e_value15 = str_replace("K X1", "K Forever", $DescriptiveElements[14]->DisplayValue);
                                    }
                                    $image1 = "";
                                    $image2 = "";
                                    $image3 = "";
                                    $image4 = "";
                                    $image5 = "";
                                    $image6 = "";
                                    $gimage1 = "";
                                    $gimage2 = "";
                                    $gimage3 = "";
                                    $fullysetimage1 = "";
                                    $fullysetimage2 = "";
                                    $fullysetimage3 = "";
                                    $fullysetimage4 = "";
                                    $fullysetimage5 = "";
                                    $fullysetimage6 = "";
                                    //get images
                                    // if(!empty($prod->Images)){
                                    //   $image1= $prod->Images[0]->FullUrl;
                                    //   $image2= $prod->Images[0]->ThumbnailUrl;
                                    //   $image3= $prod->Images[0]->ZoomUrl;
                                    // }
                                    // if(!empty($prod->GroupImages)){
                                    //   $gimage1= $prod->GroupImages[0]->ZoomUrl;
                                    //   $gimage2= $prod->GroupImages[0]->ZoomUrl;
                                    //   $gimage3= $prod->GroupImages[0]->ZoomUrl;
                                    // }
                                    //get images
                                    if (!empty($prod->Images)) {
                                        $image_peram_count = count($prod->Images);
                                        if ($image_peram_count >= 1) {
                                            $image1 = $prod->Images[0]->FullUrl;
                                        }
                                        if ($image_peram_count >= 2) {
                                            $image2 = $prod->Images[1]->FullUrl;
                                        }
                                        if ($image_peram_count >= 3) {
                                            $image3 = $prod->Images[2]->FullUrl;
                                        }
                                        if ($image_peram_count >= 4) {
                                            $image4 = $prod->Images[3]->FullUrl;
                                        }
                                        if ($image_peram_count >= 5) {
                                            $image5 = $prod->Images[4]->FullUrl;
                                        }
                                        if ($image_peram_count >= 6) {
                                            $image5 = $prod->Images[5]->FullUrl;
                                        }
                                        // $image1= $prod->Images[0]->FullUrl;
                                        // $image2= $prod->Images[0]->ThumbnailUrl;
                                        // $image3= $prod->Images[0]->ZoomUrl;
                                    }
                                    //get group images
                                    if (!empty($prod->GroupImages)) {
                                        $Groupimage_peram_count = count($prod->GroupImages);
                                        if ($Groupimage_peram_count >= 1) {
                                            $gimage1 = $prod->GroupImages[0]->FullUrl;
                                        }
                                        if ($Groupimage_peram_count >= 2) {
                                            $gimage2 = $prod->GroupImages[1]->FullUrl;
                                        }
                                        if ($Groupimage_peram_count >= 3) {
                                            $gimage3 = $prod->GroupImages[2]->FullUrl;
                                        }
                                        // $gimage1= $prod->GroupImages[0]->ZoomUrl;
                                        // $gimage2= $prod->GroupImages[0]->ZoomUrl;
                                        // $gimage3= $prod->GroupImages[0]->ZoomUrl;
                                    }
                                    //get Fully Set Images images
                                    if (!empty($prod->FullySetImages)) {
                                        $FullySetimage_peram_count = count($prod->FullySetImages);
                                        if ($FullySetimage_peram_count >= 1) {
                                            $fullysetimage1 = $prod->FullySetImages[0]->FullUrl;
                                        }
                                        if ($FullySetimage_peram_count >= 2) {
                                            $fullysetimage2 = $prod->FullySetImages[1]->FullUrl;
                                        }
                                        if ($FullySetimage_peram_count >= 3) {
                                            $fullysetimage3 = $prod->FullySetImages[2]->FullUrl;
                                        }
                                        if ($FullySetimage_peram_count >= 4) {
                                            $fullysetimage4 = $prod->FullySetImages[3]->FullUrl;
                                        }
                                        if ($FullySetimage_peram_count >= 5) {
                                            $fullysetimage5 = $prod->FullySetImages[4]->FullUrl;
                                        }
                                        if ($FullySetimage_peram_count >= 6) {
                                            $fullysetimage6 = $prod->FullySetImages[5]->FullUrl;
                                        }
                                        // $image1= $prod->Images[0]->FullUrl;
                                        // $image2= $prod->Images[0]->ThumbnailUrl;
                                        // $image3= $prod->Images[0]->ZoomUrl;
                                    }
                                    //get AGTA
                                    if (!empty($prod->AGTA)) {
                                        $agta = $prod->AGTA;
                                    } else {
                                        $agta = "";
                                    }
                                    //get MerchandisingCategory
                                    $mcat1 = "";
                                    $mcat2 = "";
                                    $mcat3 = "";
                                    $mcat4 = "";
                                    $mcat5 = "";
                                    if (!empty($prod->MerchandisingCategory1)) {
                                        $mcat1 = $prod->MerchandisingCategory1;
                                    }
                                    if (!empty($prod->MerchandisingCategory2)) {
                                        $mcat2 = $prod->MerchandisingCategory2;
                                    }
                                    if (!empty($prod->MerchandisingCategory3)) {
                                        $mcat3 = $prod->MerchandisingCategory3;
                                    }
                                    if (!empty($prod->MerchandisingCategory4)) {
                                        $mcat4 = $prod->MerchandisingCategory4;
                                    }
                                    if (!empty($prod->MerchandisingCategory5)) {
                                        $mcat5 = $prod->MerchandisingCategory5;
                                    }
                                    $Description = "";
                                    if (!empty($prod->Description)) {
                                        $Description = str_replace("K X1", "K Forever", $prod->Description);
                                    }
                                    $ShortDescription = "";
                                    if (!empty($prod->ShortDescription)) {
                                        $ShortDescription = str_replace("K X1", "K Forever", $prod->ShortDescription);
                                    }
                                    $GroupDescription = "";
                                    if (!empty($prod->GroupDescription)) {
                                        $GroupDescription = str_replace("K X1", "K Forever", $prod->GroupDescription);
                                    }
                                    $LeadTime = "";
                                    if (!empty($prod->LeadTime)) {
                                        $LeadTime = $prod->LeadTime;
                                    }
                                    //get vedio and Group vedios
                                    $vedio = "";
                                    $gvedio = "";
                                    if (!empty($prod->Videos)) {
                                        $vedio = $prod->Videos[0]->DownloadUrl;
                                    }
                                    if (!empty($prod->GroupVideos)) {
                                        $gvedio = $prod->GroupVideos[0]->Url;
                                    }
                                    //get vedio and Group vedios
                                    $vedio = "";
                                    $gvedio = "";
                                    if (!empty($prod->Videos)) {
                                        $vedio = $prod->Videos[0]->DownloadUrl;
                                    }
                                    if (!empty($prod->GroupVideos)) {
                                        $gvedio = $prod->GroupVideos[0]->Url;
                                    }
                                    //explode sku for get and save sku series and sku series type start
                                    $sku_no = $prod->SKU;
                                    if (is_numeric($sku_no[0])) {
                                        $sku_ar = explode(":", $sku_no);
                                    } else {
                                        $arr = (str_split($sku_no));
                                        $l = count($arr);
                                        for ($i = 0; $i <= $l; $i++) {
                                            if (is_numeric($arr[$i])) {
                                                array_splice($arr, $i, 0, ":");
                                                break;
                                            }
                                        }
                                        $s = join($arr);
                                        $sku_ar = explode(":", $s);
                                    }
                                    $cate_param_count = count($sku_ar);
                                    $sku_series = "";
                                    $sku_series_type1 = "";
                                    $sku_series_type2 = "";
                                    $sku_series_type3 = "";
                                    if ($cate_param_count >= 1) {
                                        $sku_series = $sku_ar[0];
                                    }
                                    if ($cate_param_count >= 2) {
                                        $sku_series_type1 = $sku_ar[1];
                                    }
                                    if ($cate_param_count >= 3) {
                                        $sku_series_type2 = $sku_ar[2];
                                    }
                                    if ($cate_param_count >= 4) {
                                        $sku_series_type3 = $sku_ar[3];
                                    }
                                    $ProductType = "";
                                    if (!empty($prod->ProductType)) {
                                        $ProductType = $prod->ProductType;
                                    }
                                    $OnHand = "";
                                    if (!empty($prod->OnHand)) {
                                        $OnHand = $prod->OnHand;
                                    }
                                    $Status = "";
                                    if (!empty($prod->Status)) {
                                        $Status = $prod->Status;
                                    }
                                    $Value = "";
                                    if (!empty($prod->Price->Value)) {
                                        $Value = $prod->Price->Value;
                                    }
                                    $CurrencyCode = "";
                                    if (!empty($prod->Price->CurrencyCode)) {
                                        $CurrencyCode = $prod->Price->CurrencyCode;
                                    }
                                    $UnitOfSale = "";
                                    if (!empty($prod->UnitOfSale)) {
                                        $UnitOfSale = $prod->UnitOfSale;
                                    }
                                    $Weight = "";
                                    if (!empty($prod->Weight)) {
                                        $Weight = $prod->Weight;
                                    }
                                    $WeightUnitOfMeasure = "";
                                    if (!empty($prod->WeightUnitOfMeasure)) {
                                        $WeightUnitOfMeasure = $prod->WeightUnitOfMeasure;
                                    }
                                    $GramWeight = "";
                                    if (!empty($prod->GramWeight)) {
                                        $GramWeight = $prod->GramWeight;
                                    }
                                    $GroupName = "";
                                    if (!empty($prod->DescriptiveElementGroup->GroupName)) {
                                        $GroupName = $prod->DescriptiveElementGroup->GroupName;
                                    }
                                    $CreationDate = "";
                                    if (!empty($prod->CreationDate)) {
                                        $CreationDate = $prod->CreationDate;
                                    }
                                    $CountryOfOrigin = "";
                                    if (!empty($prod->CountryOfOrigin)) {
                                        $CountryOfOrigin = $prod->CountryOfOrigin;
                                    }
                                    $RingSizable = "";
                                    if (!empty($prod->RingSizable)) {
                                        $RingSizable = $prod->RingSizable;
                                    }
                                    $ReadyToWear = "";
                                    if (!empty($prod->ReadyToWear)) {
                                        $ReadyToWear = $prod->ReadyToWear;
                                    }
                                    //specifications
                                    if (empty($prod->Specifications)) {
                                        $specifications = "";
                                    } else {
                                        $specifications = $prod->Specifications;
                                    }
                                    //comessetwith
                                    if (empty($prod->CanBeSetWith)) {
                                        $canbesetwith = "";
                                    } else {
                                        $canbesetwith = $prod->CanBeSetWith;
                                    }
                                    //SetWith
                                    if (empty($prod->SetWith)) {
                                        $setwith = "";
                                    } else {
                                        $setwith = $prod->SetWith;
                                    }
                                    //ringsize
                                    $ringSizeArray = [];
                                    // print_r($prod->ConfigurationModel->RingSizeOptions);die();
                                    if (!empty($prod->ConfigurationModel)) {
                                        if (empty($prod->ConfigurationModel->RingSizeOptions)) {
                                            $ringSizeArray = "";
                                        } else {
                                            foreach ($prod->ConfigurationModel->RingSizeOptions as $configModel) {
                                                $ringSizeArray[] = array(
                                                    "Size" => number_format((float)$configModel->Size, 2, '.', ''),
                                                    "Price" => $configModel->Price->Value
                                                );
                                            }
                                        }
                                    } else {
                                        $ringSizeArray = "";
                                    }
                                    //explode sku for get and save sku series and sku series type end
                                    if (!empty($prod->Price->Value)) {
                                        if ($prod->Price->Value > $MINIMUM_COST) {
                                            $ex = 0;
                                            $ex1 = 0;
                                            //---- excluding series --------
                                            $this->db->select('*');
                                            $this->db->from('tbl_minisubcategory');
                                            $this->db->where('is_active', 1);
                                            $this->db->where('id', $minorsub);
                                            $cat_data = $this->db->get()->row();
                                            if (!empty($cat_data->exlude_series)) {
                                                $exclude = explode(",", $cat_data->exlude_series);
                                                if (count($exclude) > 0) {
                                                    foreach ($exclude as $key => $value345) {
                                                        if ($value345 == $sku_series) {
                                                            $ex = 1;
                                                            break;
                                                        }
                                                    }
                                                } else {
                                                    if ($cat_data->exlude_series == $sku_series) {
                                                        $ex = 1;
                                                    }
                                                }
                                            }
                                            //---- excluding sku --------
                                            if (!empty($cat_data->exlude_sku)) {
                                                $exclude1 = explode(",", $cat_data->exlude_sku);
                                                if (count($exclude1) > 0) {
                                                    foreach ($exclude1 as $key => $value3452) {
                                                        if ($value3452 == $prod->SKU) {
                                                            $ex1 = 1;
                                                            break;
                                                        }
                                                    }
                                                } else {
                                                    if ($cat_data->exlude_sku == $prod->SKU) {
                                                        $ex1 = 1;
                                                    }
                                                }
                                            }
                                            if ($ex == 0 && $ex1 == 0) {
                                                $data_insert = array(
                                                    'product_id' => $prod->Id,
                                                    'category' => $category_id,
                                                    'sub_category' => $subcategory,
                                                    'minisub_category' => $minorsub,
                                                    // 'vendor'=>1,
                                                    'sku' => $prod->SKU,
                                                    'sku_series' => $sku_series,
                                                    'sku_series_type1' => $sku_series_type1,
                                                    'sku_series_type2' => $sku_series_type2,
                                                    'sku_series_type3' => $sku_series_type3,
                                                    'description' => $Description,
                                                    'sdesc' => $ShortDescription,
                                                    'gdesc' => $GroupDescription,
                                                    'mcat1' => $mcat1,
                                                    'mcat2' => $mcat2,
                                                    'mcat3' => $mcat3,
                                                    'mcat4' => $mcat4,
                                                    'mcat5' => $mcat5,
                                                    'product_type' => $ProductType,
                                                    'collection' => "",
                                                    'onhand' => $OnHand,
                                                    'status' => $Status,
                                                    'price' => $Value,
                                                    'currency' => $CurrencyCode,
                                                    'unitofsale' => $UnitOfSale,
                                                    'weight' => $Weight,
                                                    'weightunit' => $WeightUnitOfMeasure,
                                                    'gramweight' => $GramWeight,
                                                    'ringsizable' => $RingSizable,
                                                    'ringsize' => $ringsize,
                                                    'ringsizetype' => $ringsizetype,
                                                    'leadtime' => $LeadTime,
                                                    'agta' => $agta,
                                                    'desc_e_grp' => $GroupName,
                                                    'desc_e_name1' => $desc_e_name1,
                                                    'desc_e_value1' => ltrim($desc_e_value1),
                                                    'desc_e_name2' => $desc_e_name2,
                                                    'desc_e_value2' => ltrim($desc_e_value2),
                                                    'desc_e_name3' => $desc_e_name3,
                                                    'desc_e_value3' => ltrim($desc_e_value3),
                                                    'desc_e_name4' => $desc_e_name4,
                                                    'desc_e_value4' => ltrim($desc_e_value4),
                                                    'desc_e_name5' => $desc_e_name5,
                                                    'desc_e_value5' => ltrim($desc_e_value5),
                                                    'desc_e_name6' => $desc_e_name6,
                                                    'desc_e_value6' => ltrim($desc_e_value6),
                                                    'desc_e_name7' => $desc_e_name7,
                                                    'desc_e_value7' => ltrim($desc_e_value7),
                                                    'desc_e_name8' => $desc_e_name8,
                                                    'desc_e_value8' => ltrim($desc_e_value8),
                                                    'desc_e_name9' => $desc_e_name9,
                                                    'desc_e_value9' => ltrim($desc_e_value9),
                                                    'desc_e_name10' => $desc_e_name10,
                                                    'desc_e_value10' => ltrim($desc_e_value10),
                                                    'desc_e_name11' => $desc_e_name11,
                                                    'desc_e_value11' => ltrim($desc_e_value11),
                                                    'desc_e_name12' => $desc_e_name12,
                                                    'desc_e_value12' => ltrim($desc_e_value12),
                                                    'desc_e_name13' => $desc_e_name13,
                                                    'desc_e_value13' => ltrim($desc_e_value13),
                                                    'desc_e_name14' => $desc_e_name14,
                                                    'desc_e_value14' => ltrim($desc_e_value14),
                                                    'desc_e_name15' => $desc_e_name15,
                                                    'desc_e_value15' => ltrim($desc_e_value15),
                                                    'readytowear' => $ReadyToWear,
                                                    'smi' => "",
                                                    'image1' => $image1,
                                                    'image2' => $image2,
                                                    'image3' => $image3,
                                                    'image4' => $image4,
                                                    'image5' => $image5,
                                                    'image6' => $image6,
                                                    'FullySetImage1' => $fullysetimage1,
                                                    'FullySetImage2' => $fullysetimage2,
                                                    'FullySetImage3' => $fullysetimage3,
                                                    'FullySetImage4' => $fullysetimage4,
                                                    'FullySetImage5' => $fullysetimage5,
                                                    'FullySetImage6' => $fullysetimage6,
                                                    'video' => $vedio,
                                                    'gimage1' => $gimage1,
                                                    'gimage2' => $gimage2,
                                                    'gimage3' => $gimage3,
                                                    'gvideo' => $gvedio,
                                                    'creationdate' => $CreationDate,
                                                    'currencycode' => "USD",
                                                    'country' => $CountryOfOrigin,
                                                    'dclarity' => "",
                                                    'dcolor' => "",
                                                    'totalweight' => "",
                                                    'ip' => $ip,
                                                    'added_by' => $addedby,
                                                    'is_active' => 1,
                                                    'group_id' => $prod->DescriptiveElementGroup->GroupId,
                                                    'series_id' => $prod->DescriptiveElementGroup->DescriptiveElements[0]->Value,

                                                    'date' => $cur_date
                                                );
                                                $last_id = $this->base_model->insert_table("tbl_products", $data_insert, 1);
                                                $beta_insert = array(
                                                    'product_id' => $last_id,
                                                    'specifications' => json_encode($specifications),
                                                    'canbesetwith' => json_encode($canbesetwith),
                                                    'setwith' => json_encode($setwith),
                                                    'ringsize' => json_encode($ringSizeArray),
                                                );
                                                $spec_id = $this->base_model->insert_table("tbl_product_specifications", $beta_insert, 1);
                                            }
                                        }
                                    }
                                    $NextPage = "";
                                    if (!empty($result_da->NextPage)) {
                                        $NextPage = $result_da->NextPage;
                                    }
                                }
                                // echo $i." NP- ".$NextPage."<br>";
                            }
                            // }
                        }
                        //end squ
                        // echo $type;
                        // exit;
                    }
                    //product data insert from the api end
                } else {
                    // echo "hi2";
                    // exit;
                    //minor subcategory2 exists
                    //minorsubcategory2 products adding
                    // echo $total_pages; die();
                    //delete previous data from the table start
                    $this->db->select('*');
                    $this->db->from('tbl_products');
                    $this->db->where('category', $category_id);
                    $this->db->where('sub_category', $subcategory);
                    $this->db->where('minisub_category', $minorsub);
                    $this->db->where('minisub_category2', $minorsub2);
                    $product_data = $this->db->get();
                    $c_api = count($api_ids);
                    if ($del == 1) {
                        if (!empty($product_data && $delete == 1)) {
                            foreach ($product_data->result() as $pro) {
                                $this->db->delete('tbl_products', array('id' => $pro->id));
                            }
                        }
                    }
                    if ($type != 3) {
                        //delete previous data from the table end
                        if ($finshed == 1) {
                            $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList","Finished"],"CategoryIds":["' . $value . '"]}';
                            // $data = '{"Filter":["Orderable","OnPriceList","Finished"],"Series":["'.$api_id.'"]}';
                            // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"]}';
                        } else {
                            $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList"],"CategoryIds":["' . $value . '"]}';
                        }
                        $postdata = $data;
                        $header = array();
                        $header[] = 'Host:api.stuller.com';
                        $header[] = 'Content-Type:application/json';
                        $header[] = 'Authorization:Basic ZGV2amV3ZWw6Q29kaW5nMjA9';
                        $ch = curl_init($url);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                        $result = curl_exec($ch);
                        curl_close($ch);
                        // print_r ($result);
                        $result_da = json_decode($result);
                        // echo $result[0];
                        if (!empty($result_da)) {
                            $TotalNumberOfProducts = $result_da->TotalNumberOfProducts;
                            $total_pages = round($TotalNumberOfProducts / 500) + 1;
                        }
                        //product data insert from the api start
                    } else {
                        $total_pages = 1;
                    }
                    $url = 'https://api.stuller.com/v2/products';
                    $NextPage = "";
                    // $total_pages=1;
                    for ($i = 0; $i < $total_pages; $i++) {
                        // code...
                        // echo $i;
                        if ($type == 1 || $type == "") {
                            if ($finshed == 1) {
                                if ($i == 0) {
                                    $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList","Finished"],"CategoryIds":["' . $value . '"]}';
                                    // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"]}';
                                } else {
                                    $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList","Finished"],"CategoryIds":["' . $value . '"],"NextPage":"' . $NextPage . '" }';
                                    // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"],"NextPage":"'.$NextPage.'" }';
                                }
                            } else {
                                if ($i == 0) {
                                    $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList"],"CategoryIds":["' . $value . '"]}';
                                    // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"]}';
                                } else {
                                    $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList"],"CategoryIds":["' . $value . '"],"NextPage":"' . $NextPage . '" }';
                                    // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"],"NextPage":"'.$NextPage.'" }';
                                }
                            }
                            $postdata = $data;
                            $header = array();
                            $header[] = 'Host:api.stuller.com';
                            $header[] = 'Content-Type:application/json';
                            $header[] = 'Authorization:Basic ZGV2amV3ZWw6Q29kaW5nMjA9';
                            $ch = curl_init($url);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            curl_setopt($ch, CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                            $result = curl_exec($ch);
                            curl_close($ch);
                            // $result_da=[];
                            $result_da = json_decode($result);
                            if (!empty($result_da)) {
                                // print_r($result_da);
                                // exit;
                                // echo $result_da->Products;
                                // exit;
                                foreach ($result_da->Products as $prod) {
                                    $specifications = [];
                                    // foreach($result_da as $prod) {
                                    $ringsize = 0;
                                    $ringsizetype = "";
                                    $RingSizable = "";
                                    if (!empty($prod->RingSizable)) {
                                        $RingSizable = $prod->RingSizable;
                                        if ($RingSizable == false) {
                                            $ringsize = 0;
                                            $ringsizetype = "";
                                        } else {
                                            if (!empty($prod->ringsize)) {
                                                $ringsize = $prod->ringsize;
                                            }
                                            if (!empty($prod->ringsizetype)) {
                                                $ringsizetype = $prod->ringsizetype;
                                            }
                                        }
                                    }
                                    //group eliments
                                    if (empty($prod->DescriptiveElementGroup)) {
                                        $DescriptiveElements = [];
                                    } else {
                                        $DescriptiveElements = $prod->DescriptiveElementGroup->DescriptiveElements;
                                    }
                                    $cate_array_count = 0;
                                    if (!empty($DescriptiveElements)) {
                                        $cate_array_count = count($DescriptiveElements);
                                    }
                                    $desc_e_name1 = "";
                                    $desc_e_value1 = "";
                                    $desc_e_name2 = "";
                                    $desc_e_value2 = "";
                                    $desc_e_name3 = "";
                                    $desc_e_value3 = "";
                                    $desc_e_name4 = "";
                                    $desc_e_value4 = "";
                                    $desc_e_name5 = "";
                                    $desc_e_value5 = "";
                                    $desc_e_name6 = "";
                                    $desc_e_value6 = "";
                                    $desc_e_name7 = "";
                                    $desc_e_value7 = "";
                                    $desc_e_name8 = "";
                                    $desc_e_value8 = "";
                                    $desc_e_name9 = "";
                                    $desc_e_value9 = "";
                                    $desc_e_name10 = "";
                                    $desc_e_value10 = "";
                                    $desc_e_name11 = "";
                                    $desc_e_value11 = "";
                                    $desc_e_name12 = "";
                                    $desc_e_value12 = "";
                                    $desc_e_name13 = "";
                                    $desc_e_value13 = "";
                                    $desc_e_name14 = "";
                                    $desc_e_value14 = "";
                                    $desc_e_name15 = "";
                                    $desc_e_value15 = "";
                                    if ($cate_array_count >= 1) {
                                        $desc_e_name1 = $DescriptiveElements[0]->Name;
                                        $desc_e_value1 = str_replace("K X1", "K Forever", $DescriptiveElements[0]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 2) {
                                        $desc_e_name2 = $DescriptiveElements[1]->Name;
                                        $desc_e_value2 = str_replace("K X1", "K Forever", $DescriptiveElements[1]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 3) {
                                        $desc_e_name3 = $DescriptiveElements[2]->Name;
                                        $desc_e_value3 = str_replace("K X1", "K Forever", $DescriptiveElements[2]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 4) {
                                        $desc_e_name4 = $DescriptiveElements[3]->Name;
                                        $desc_e_value4 = str_replace("K X1", "K Forever", $DescriptiveElements[3]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 5) {
                                        $desc_e_name5 = $DescriptiveElements[4]->Name;
                                        $desc_e_value5 = str_replace("K X1", "K Forever", $DescriptiveElements[4]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 6) {
                                        $desc_e_name6 = $DescriptiveElements[5]->Name;
                                        $desc_e_value6 = str_replace("K X1", "K Forever", $DescriptiveElements[5]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 7) {
                                        $desc_e_name7 = $DescriptiveElements[6]->Name;
                                        $desc_e_value7 = str_replace("K X1", "K Forever", $DescriptiveElements[6]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 8) {
                                        $desc_e_name8 = $DescriptiveElements[7]->Name;
                                        $desc_e_value8 = str_replace("K X1", "K Forever", $DescriptiveElements[7]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 9) {
                                        $desc_e_name9 = $DescriptiveElements[8]->Name;
                                        $desc_e_value9 = str_replace("K X1", "K Forever", $DescriptiveElements[8]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 10) {
                                        $desc_e_name10 = $DescriptiveElements[9]->Name;
                                        $desc_e_value10 = str_replace("K X1", "K Forever", $DescriptiveElements[9]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 11) {
                                        $desc_e_name11 = $DescriptiveElements[10]->Name;
                                        $desc_e_value11 = str_replace("K X1", "K Forever", $DescriptiveElements[10]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 12) {
                                        $desc_e_name12 = $DescriptiveElements[11]->Name;
                                        $desc_e_value12 = str_replace("K X1", "K Forever", $DescriptiveElements[11]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 13) {
                                        $desc_e_name13 = $DescriptiveElements[12]->Name;
                                        $desc_e_value13 = str_replace("K X1", "K Forever", $DescriptiveElements[12]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 14) {
                                        $desc_e_name14 = $DescriptiveElements[13]->Name;
                                        $desc_e_value14 = str_replace("K X1", "K Forever", $DescriptiveElements[13]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 15) {
                                        $desc_e_name15 = $DescriptiveElements[14]->Name;
                                        $desc_e_value15 = str_replace("K X1", "K Forever", $DescriptiveElements[14]->DisplayValue);
                                    }
                                    $image1 = "";
                                    $image2 = "";
                                    $image3 = "";
                                    $image4 = "";
                                    $image5 = "";
                                    $image6 = "";
                                    $gimage1 = "";
                                    $gimage2 = "";
                                    $gimage3 = "";
                                    $fullysetimage1 = "";
                                    $fullysetimage2 = "";
                                    $fullysetimage3 = "";
                                    $fullysetimage4 = "";
                                    $fullysetimage5 = "";
                                    $fullysetimage6 = "";
                                    //get images
                                    // if(!empty($prod->Images)){
                                    //   $image1= $prod->Images[0]->FullUrl;
                                    //   $image2= $prod->Images[0]->ThumbnailUrl;
                                    //   $image3= $prod->Images[0]->ZoomUrl;
                                    // }
                                    // if(!empty($prod->GroupImages)){
                                    //   $gimage1= $prod->GroupImages[0]->ZoomUrl;
                                    //   $gimage2= $prod->GroupImages[0]->ZoomUrl;
                                    //   $gimage3= $prod->GroupImages[0]->ZoomUrl;
                                    // }
                                    //get images
                                    if (!empty($prod->Images)) {
                                        $image_peram_count = count($prod->Images);
                                        if ($image_peram_count >= 1) {
                                            $image1 = $prod->Images[0]->FullUrl;
                                        }
                                        if ($image_peram_count >= 2) {
                                            $image2 = $prod->Images[1]->FullUrl;
                                        }
                                        if ($image_peram_count >= 3) {
                                            $image3 = $prod->Images[2]->FullUrl;
                                        }
                                        if ($image_peram_count >= 4) {
                                            $image4 = $prod->Images[3]->FullUrl;
                                        }
                                        if ($image_peram_count >= 5) {
                                            $image5 = $prod->Images[4]->FullUrl;
                                        }
                                        if ($image_peram_count >= 6) {
                                            $image5 = $prod->Images[5]->FullUrl;
                                        }
                                        // $image1= $prod->Images[0]->FullUrl;
                                        // $image2= $prod->Images[0]->ThumbnailUrl;
                                        // $image3= $prod->Images[0]->ZoomUrl;
                                    }
                                    //get group images
                                    if (!empty($prod->GroupImages)) {
                                        $Groupimage_peram_count = count($prod->GroupImages);
                                        if ($Groupimage_peram_count >= 1) {
                                            $gimage1 = $prod->GroupImages[0]->FullUrl;
                                        }
                                        if ($Groupimage_peram_count >= 2) {
                                            $gimage2 = $prod->GroupImages[1]->FullUrl;
                                        }
                                        if ($Groupimage_peram_count >= 3) {
                                            $gimage3 = $prod->GroupImages[2]->FullUrl;
                                        }
                                        // $gimage1= $prod->GroupImages[0]->ZoomUrl;
                                        // $gimage2= $prod->GroupImages[0]->ZoomUrl;
                                        // $gimage3= $prod->GroupImages[0]->ZoomUrl;
                                    }
                                    //get Fully Set Images images
                                    if (!empty($prod->FullySetImages)) {
                                        $FullySetimage_peram_count = count($prod->FullySetImages);
                                        if ($FullySetimage_peram_count >= 1) {
                                            $fullysetimage1 = $prod->FullySetImages[0]->FullUrl;
                                        }
                                        if ($FullySetimage_peram_count >= 2) {
                                            $fullysetimage2 = $prod->FullySetImages[1]->FullUrl;
                                        }
                                        if ($FullySetimage_peram_count >= 3) {
                                            $fullysetimage3 = $prod->FullySetImages[2]->FullUrl;
                                        }
                                        if ($FullySetimage_peram_count >= 4) {
                                            $fullysetimage4 = $prod->FullySetImages[3]->FullUrl;
                                        }
                                        if ($FullySetimage_peram_count >= 5) {
                                            $fullysetimage5 = $prod->FullySetImages[4]->FullUrl;
                                        }
                                        if ($FullySetimage_peram_count >= 6) {
                                            $fullysetimage6 = $prod->FullySetImages[5]->FullUrl;
                                        }
                                        // $image1= $prod->Images[0]->FullUrl;
                                        // $image2= $prod->Images[0]->ThumbnailUrl;
                                        // $image3= $prod->Images[0]->ZoomUrl;
                                    }
                                    //get AGTA
                                    if (!empty($prod->AGTA)) {
                                        $agta = $prod->AGTA;
                                    } else {
                                        $agta = "";
                                    }
                                    //get MerchandisingCategory
                                    $mcat1 = "";
                                    $mcat2 = "";
                                    $mcat3 = "";
                                    $mcat4 = "";
                                    $mcat5 = "";
                                    if (!empty($prod->MerchandisingCategory1)) {
                                        $mcat1 = $prod->MerchandisingCategory1;
                                    }
                                    if (!empty($prod->MerchandisingCategory2)) {
                                        $mcat2 = $prod->MerchandisingCategory2;
                                    }
                                    if (!empty($prod->MerchandisingCategory3)) {
                                        $mcat3 = $prod->MerchandisingCategory3;
                                    }
                                    if (!empty($prod->MerchandisingCategory4)) {
                                        $mcat4 = $prod->MerchandisingCategory4;
                                    }
                                    if (!empty($prod->MerchandisingCategory5)) {
                                        $mcat5 = $prod->MerchandisingCategory5;
                                    }
                                    $Description = "";
                                    if (!empty($prod->Description)) {
                                        $Description = str_replace("K X1", "K Forever", $prod->Description);
                                    }
                                    $ShortDescription = "";
                                    if (!empty($prod->ShortDescription)) {
                                        $ShortDescription = str_replace("K X1", "K Forever", $prod->ShortDescription);
                                    }
                                    $GroupDescription = "";
                                    if (!empty($prod->GroupDescription)) {
                                        $GroupDescription = str_replace("K X1", "K Forever", $prod->GroupDescription);
                                    }
                                    $LeadTime = "";
                                    if (!empty($prod->LeadTime)) {
                                        $LeadTime = $prod->LeadTime;
                                    }
                                    //get vedio and Group vedios
                                    $vedio = "";
                                    $gvedio = "";
                                    if (!empty($prod->Videos)) {
                                        $vedio = $prod->Videos[0]->DownloadUrl;
                                    }
                                    if (!empty($prod->GroupVideos)) {
                                        $gvedio = $prod->GroupVideos[0]->Url;
                                    }
                                    //explode sku for get and save sku series and sku series type start
                                    $sku_no = $prod->SKU;
                                    if (is_numeric($sku_no[0])) {
                                        $sku_ar = explode(":", $sku_no);
                                    } else {
                                        $arr = (str_split($sku_no));
                                        $l = count($arr);
                                        for ($i = 0; $i <= $l; $i++) {
                                            if (is_numeric($arr[$i])) {
                                                array_splice($arr, $i, 0, ":");
                                                break;
                                            }
                                        }
                                        $s = join($arr);
                                        $sku_ar = explode(":", $s);
                                    }
                                    $cate_param_count = count($sku_ar);
                                    $sku_series = "";
                                    $sku_series_type1 = "";
                                    $sku_series_type2 = "";
                                    $sku_series_type3 = "";
                                    if ($cate_param_count >= 1) {
                                        $sku_series = $sku_ar[0];
                                    }
                                    if ($cate_param_count >= 2) {
                                        $sku_series_type1 = $sku_ar[1];
                                    }
                                    if ($cate_param_count >= 3) {
                                        $sku_series_type2 = $sku_ar[2];
                                    }
                                    if ($cate_param_count >= 4) {
                                        $sku_series_type3 = $sku_ar[3];
                                    }
                                    $ProductType = "";
                                    if (!empty($prod->ProductType)) {
                                        $ProductType = $prod->ProductType;
                                    }
                                    $OnHand = "";
                                    if (!empty($prod->OnHand)) {
                                        $OnHand = $prod->OnHand;
                                    }
                                    $Status = "";
                                    if (!empty($prod->Status)) {
                                        $Status = $prod->Status;
                                    }
                                    $Value = "";
                                    if (!empty($prod->Price->Value)) {
                                        $Value = $prod->Price->Value;
                                    }
                                    $CurrencyCode = "";
                                    if (!empty($prod->Price->CurrencyCode)) {
                                        $CurrencyCode = $prod->Price->CurrencyCode;
                                    }
                                    $UnitOfSale = "";
                                    if (!empty($prod->UnitOfSale)) {
                                        $UnitOfSale = $prod->UnitOfSale;
                                    }
                                    $Weight = "";
                                    if (!empty($prod->Weight)) {
                                        $Weight = $prod->Weight;
                                    }
                                    $WeightUnitOfMeasure = "";
                                    if (!empty($prod->WeightUnitOfMeasure)) {
                                        $WeightUnitOfMeasure = $prod->WeightUnitOfMeasure;
                                    }
                                    $GramWeight = "";
                                    if (!empty($prod->GramWeight)) {
                                        $GramWeight = $prod->GramWeight;
                                    }
                                    $GroupName = "";
                                    if (!empty($prod->DescriptiveElementGroup->GroupName)) {
                                        $GroupName = $prod->DescriptiveElementGroup->GroupName;
                                    }
                                    $CreationDate = "";
                                    if (!empty($prod->CreationDate)) {
                                        $CreationDate = $prod->CreationDate;
                                    }
                                    $CountryOfOrigin = "";
                                    if (!empty($prod->CountryOfOrigin)) {
                                        $CountryOfOrigin = $prod->CountryOfOrigin;
                                    }
                                    $RingSizable = "";
                                    if (!empty($prod->RingSizable)) {
                                        $RingSizable = $prod->RingSizable;
                                    }
                                    $ReadyToWear = "";
                                    if (!empty($prod->ReadyToWear)) {
                                        $ReadyToWear = $prod->ReadyToWear;
                                    }
                                    //specifications
                                    if (empty($prod->Specifications)) {
                                        $specifications = "";
                                    } else {
                                        $specifications = $prod->Specifications;
                                    }
                                    //comessetwith
                                    if (empty($prod->CanBeSetWith)) {
                                        $canbesetwith = "";
                                    } else {
                                        $canbesetwith = $prod->CanBeSetWith;
                                    }
                                    //SetWith
                                    if (empty($prod->SetWith)) {
                                        $setwith = "";
                                    } else {
                                        $setwith = $prod->SetWith;
                                    }
                                    //ringsize
                                    $ringSizeArray = [];
                                    // print_r($prod->ConfigurationModel->RingSizeOptions);die();
                                    if (!empty($prod->ConfigurationModel)) {
                                        if (empty($prod->ConfigurationModel->RingSizeOptions)) {
                                            $ringSizeArray = "";
                                        } else {
                                            foreach ($prod->ConfigurationModel->RingSizeOptions as $configModel) {
                                                $ringSizeArray[] = array(
                                                    "Size" => number_format((float)$configModel->Size, 2, '.', ''),
                                                    "Price" => $configModel->Price->Value
                                                );
                                            }
                                        }
                                    } else {
                                        $ringSizeArray = "";
                                    }
                                    //explode sku for get and save sku series and sku series type end
                                    if (!empty($prod->Price->Value)) {
                                        if ($prod->Price->Value > $MINIMUM_COST) {
                                            $ex = 0;
                                            $ex1 = 0;
                                            //---- excluding series --------
                                            $this->db->select('*');
                                            $this->db->from('tbl_minisubcategory2');
                                            $this->db->where('is_active', 1);
                                            $this->db->where('id', $minorsub2);
                                            $cat_data = $this->db->get()->row();
                                            if (!empty($cat_data->exlude_series)) {
                                                $exclude = explode(",", $cat_data->exlude_series);
                                                if (count($exclude) > 0) {
                                                    foreach ($exclude as $key => $value345) {
                                                        if ($value345 == $sku_series) {
                                                            $ex = 1;
                                                            break;
                                                        }
                                                    }
                                                } else {
                                                    if ($cat_data->exlude_series == $sku_series) {
                                                        $ex = 1;
                                                    }
                                                }
                                            }
                                            //---- excluding sku --------
                                            if (!empty($cat_data->exlude_sku)) {
                                                $exclude1 = explode(",", $cat_data->exlude_sku);
                                                if (count($exclude1) > 0) {
                                                    foreach ($exclude1 as $key => $value3452) {
                                                        if ($value3452 == $prod->SKU) {
                                                            $ex1 = 1;
                                                            break;
                                                        }
                                                    }
                                                } else {
                                                    if ($cat_data->exlude_sku == $prod->SKU) {
                                                        $ex1 = 1;
                                                    }
                                                }
                                            }
                                            if ($ex == 0 && $ex1 == 0) {
                                                $data_insert = array(
                                                    'product_id' => $prod->Id,
                                                    'category' => $category_id,
                                                    'sub_category' => $subcategory,
                                                    'minisub_category' => $minorsub,
                                                    'minisub_category2' => $minorsub2,
                                                    // 'vendor'=>1,
                                                    'sku' => $prod->SKU,
                                                    'sku_series' => $sku_series,
                                                    'sku_series_type1' => $sku_series_type1,
                                                    'sku_series_type2' => $sku_series_type2,
                                                    'sku_series_type3' => $sku_series_type3,
                                                    'description' => $Description,
                                                    'sdesc' => $ShortDescription,
                                                    'gdesc' => $GroupDescription,
                                                    'mcat1' => $mcat1,
                                                    'mcat2' => $mcat2,
                                                    'mcat3' => $mcat3,
                                                    'mcat4' => $mcat4,
                                                    'mcat5' => $mcat5,
                                                    'product_type' => $ProductType,
                                                    'collection' => "",
                                                    'onhand' => $OnHand,
                                                    'status' => $Status,
                                                    'price' => $Value,
                                                    'currency' => $CurrencyCode,
                                                    'unitofsale' => $UnitOfSale,
                                                    'weight' => $Weight,
                                                    'weightunit' => $WeightUnitOfMeasure,
                                                    'gramweight' => $GramWeight,
                                                    'ringsizable' => $RingSizable,
                                                    'ringsize' => $ringsize,
                                                    'ringsizetype' => $ringsizetype,
                                                    'leadtime' => $LeadTime,
                                                    'agta' => $agta,
                                                    'desc_e_grp' => $GroupName,
                                                    'desc_e_name1' => $desc_e_name1,
                                                    'desc_e_value1' => ltrim($desc_e_value1),
                                                    'desc_e_name2' => $desc_e_name2,
                                                    'desc_e_value2' => ltrim($desc_e_value2),
                                                    'desc_e_name3' => $desc_e_name3,
                                                    'desc_e_value3' => ltrim($desc_e_value3),
                                                    'desc_e_name4' => $desc_e_name4,
                                                    'desc_e_value4' => ltrim($desc_e_value4),
                                                    'desc_e_name5' => $desc_e_name5,
                                                    'desc_e_value5' => ltrim($desc_e_value5),
                                                    'desc_e_name6' => $desc_e_name6,
                                                    'desc_e_value6' => ltrim($desc_e_value6),
                                                    'desc_e_name7' => $desc_e_name7,
                                                    'desc_e_value7' => ltrim($desc_e_value7),
                                                    'desc_e_name8' => $desc_e_name8,
                                                    'desc_e_value8' => ltrim($desc_e_value8),
                                                    'desc_e_name9' => $desc_e_name9,
                                                    'desc_e_value9' => ltrim($desc_e_value9),
                                                    'desc_e_name10' => $desc_e_name10,
                                                    'desc_e_value10' => ltrim($desc_e_value10),
                                                    'desc_e_name11' => $desc_e_name11,
                                                    'desc_e_value11' => ltrim($desc_e_value11),
                                                    'desc_e_name12' => $desc_e_name12,
                                                    'desc_e_value12' => ltrim($desc_e_value12),
                                                    'desc_e_name13' => $desc_e_name13,
                                                    'desc_e_value13' => ltrim($desc_e_value13),
                                                    'desc_e_name14' => $desc_e_name14,
                                                    'desc_e_value14' => ltrim($desc_e_value14),
                                                    'desc_e_name15' => $desc_e_name15,
                                                    'desc_e_value15' => ltrim($desc_e_value15),
                                                    'readytowear' => $ReadyToWear,
                                                    'smi' => "",
                                                    'image1' => $image1,
                                                    'image2' => $image2,
                                                    'image3' => $image3,
                                                    'image4' => $image4,
                                                    'image5' => $image5,
                                                    'image6' => $image6,
                                                    'FullySetImage1' => $fullysetimage1,
                                                    'FullySetImage2' => $fullysetimage2,
                                                    'FullySetImage3' => $fullysetimage3,
                                                    'FullySetImage4' => $fullysetimage4,
                                                    'FullySetImage5' => $fullysetimage5,
                                                    'FullySetImage6' => $fullysetimage6,
                                                    'video' => $vedio,
                                                    'gimage1' => $gimage1,
                                                    'gimage2' => $gimage2,
                                                    'gimage3' => $gimage3,
                                                    'gvideo' => $gvedio,
                                                    'creationdate' => $CreationDate,
                                                    'currencycode' => "USD",
                                                    'country' => $CountryOfOrigin,
                                                    'dclarity' => "",
                                                    'dcolor' => "",
                                                    'totalweight' => "",
                                                    'ip' => $ip,
                                                    'added_by' => $addedby,
                                                    'is_active' => 1,
                                                    'group_id' => $prod->DescriptiveElementGroup->GroupId,
                                                    'series_id' => $prod->DescriptiveElementGroup->DescriptiveElements[0]->Value,

                                                    'date' => $cur_date
                                                );
                                                $last_id = $this->base_model->insert_table("tbl_products", $data_insert, 1);
                                                $beta_insert = array(
                                                    'product_id' => $last_id,
                                                    'specifications' => json_encode($specifications),
                                                    'canbesetwith' => json_encode($canbesetwith),
                                                    'setwith' => json_encode($setwith),
                                                    'ringsize' => json_encode($ringSizeArray),
                                                );
                                                $spec_id = $this->base_model->insert_table("tbl_product_specifications", $beta_insert, 1);
                                            }
                                        }
                                    }
                                }
                                $NextPage = "";
                                if (!empty($result_da->NextPage)) {
                                    $NextPage = $result_da->NextPage;
                                }
                                // echo $i." NP- ".$NextPage."<br>";
                            }
                        }
                        if ($type == 2) {
                            // $n_it=json_decode($api_id);
                            // foreach ($api_id as $value) {
                            if ($finshed == 1) {
                                if ($i == 0) {
                                    $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList","Finished"],"Series":["' . $value . '"]}';
                                    // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"]}';
                                } else {
                                    $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList","Finished"],"Series":["' . $value . '"],"NextPage":"' . $NextPage . '" }';
                                    // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"],"NextPage":"'.$NextPage.'" }';
                                }
                            } else {
                                if ($i == 0) {
                                    $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList"],"Series":["' . $value . '"]}';
                                    // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"]}';
                                } else {
                                    $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList"],"Series":["' . $value . '"],"NextPage":"' . $NextPage . '" }';
                                    // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"],"NextPage":"'.$NextPage.'" }';
                                }
                            }
                            $postdata = $data;
                            $header = array();
                            $header[] = 'Host:api.stuller.com';
                            $header[] = 'Content-Type:application/json';
                            $header[] = 'Authorization:Basic ZGV2amV3ZWw6Q29kaW5nMjA9';
                            $ch = curl_init($url);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            curl_setopt($ch, CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                            $result = curl_exec($ch);
                            curl_close($ch);
                            // $result_da=[];
                            $result_da = json_decode($result);
                            // print_r($result_da);
                            // exit;
                            // if(!empty($result_da->Products)){
                            if (!empty($result_da)) {
                                // echo $result_da->Products;
                                // exit;
                                foreach ($result_da->Products as $prod) {
                                    $specifications = [];
                                    // foreach($result_da as $prod) {
                                    $ringsize = 0;
                                    $ringsizetype = "";
                                    $RingSizable = "";
                                    if (!empty($prod->RingSizable)) {
                                        $RingSizable = $prod->RingSizable;
                                        if ($RingSizable == false) {
                                            $ringsize = 0;
                                            $ringsizetype = "";
                                        } else {
                                            if (!empty($prod->ringsize)) {
                                                $ringsize = $prod->ringsize;
                                            }
                                            if (!empty($prod->ringsizetype)) {
                                                $ringsizetype = $prod->ringsizetype;
                                            }
                                        }
                                    }
                                    //group eliments
                                    if (empty($prod->DescriptiveElementGroup)) {
                                        $DescriptiveElements = [];
                                    } else {
                                        $DescriptiveElements = $prod->DescriptiveElementGroup->DescriptiveElements;
                                    }
                                    $cate_array_count = 0;
                                    if (!empty($DescriptiveElements)) {
                                        $cate_array_count = count($DescriptiveElements);
                                    }
                                    $desc_e_name1 = "";
                                    $desc_e_value1 = "";
                                    $desc_e_name2 = "";
                                    $desc_e_value2 = "";
                                    $desc_e_name3 = "";
                                    $desc_e_value3 = "";
                                    $desc_e_name4 = "";
                                    $desc_e_value4 = "";
                                    $desc_e_name5 = "";
                                    $desc_e_value5 = "";
                                    $desc_e_name6 = "";
                                    $desc_e_value6 = "";
                                    $desc_e_name7 = "";
                                    $desc_e_value7 = "";
                                    $desc_e_name8 = "";
                                    $desc_e_value8 = "";
                                    $desc_e_name9 = "";
                                    $desc_e_value9 = "";
                                    $desc_e_name10 = "";
                                    $desc_e_value10 = "";
                                    $desc_e_name11 = "";
                                    $desc_e_value11 = "";
                                    $desc_e_name12 = "";
                                    $desc_e_value12 = "";
                                    $desc_e_name13 = "";
                                    $desc_e_value13 = "";
                                    $desc_e_name14 = "";
                                    $desc_e_value14 = "";
                                    $desc_e_name15 = "";
                                    $desc_e_value15 = "";
                                    if ($cate_array_count >= 1) {
                                        $desc_e_name1 = $DescriptiveElements[0]->Name;
                                        $desc_e_value1 = str_replace("K X1", "K Forever", $DescriptiveElements[0]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 2) {
                                        $desc_e_name2 = $DescriptiveElements[1]->Name;
                                        $desc_e_value2 = str_replace("K X1", "K Forever", $DescriptiveElements[1]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 3) {
                                        $desc_e_name3 = $DescriptiveElements[2]->Name;
                                        $desc_e_value3 = str_replace("K X1", "K Forever", $DescriptiveElements[2]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 4) {
                                        $desc_e_name4 = $DescriptiveElements[3]->Name;
                                        $desc_e_value4 = str_replace("K X1", "K Forever", $DescriptiveElements[3]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 5) {
                                        $desc_e_name5 = $DescriptiveElements[4]->Name;
                                        $desc_e_value5 = str_replace("K X1", "K Forever", $DescriptiveElements[4]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 6) {
                                        $desc_e_name6 = $DescriptiveElements[5]->Name;
                                        $desc_e_value6 = str_replace("K X1", "K Forever", $DescriptiveElements[5]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 7) {
                                        $desc_e_name7 = $DescriptiveElements[6]->Name;
                                        $desc_e_value7 = str_replace("K X1", "K Forever", $DescriptiveElements[6]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 8) {
                                        $desc_e_name8 = $DescriptiveElements[7]->Name;
                                        $desc_e_value8 = str_replace("K X1", "K Forever", $DescriptiveElements[7]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 9) {
                                        $desc_e_name9 = $DescriptiveElements[8]->Name;
                                        $desc_e_value9 = str_replace("K X1", "K Forever", $DescriptiveElements[8]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 10) {
                                        $desc_e_name10 = $DescriptiveElements[9]->Name;
                                        $desc_e_value10 = str_replace("K X1", "K Forever", $DescriptiveElements[9]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 11) {
                                        $desc_e_name11 = $DescriptiveElements[10]->Name;
                                        $desc_e_value11 = str_replace("K X1", "K Forever", $DescriptiveElements[10]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 12) {
                                        $desc_e_name12 = $DescriptiveElements[11]->Name;
                                        $desc_e_value12 = str_replace("K X1", "K Forever", $DescriptiveElements[11]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 13) {
                                        $desc_e_name13 = $DescriptiveElements[12]->Name;
                                        $desc_e_value13 = str_replace("K X1", "K Forever", $DescriptiveElements[12]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 14) {
                                        $desc_e_name14 = $DescriptiveElements[13]->Name;
                                        $desc_e_value14 = str_replace("K X1", "K Forever", $DescriptiveElements[13]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 15) {
                                        $desc_e_name15 = $DescriptiveElements[14]->Name;
                                        $desc_e_value15 = str_replace("K X1", "K Forever", $DescriptiveElements[14]->DisplayValue);
                                    }
                                    $image1 = "";
                                    $image2 = "";
                                    $image3 = "";
                                    $image4 = "";
                                    $image5 = "";
                                    $image6 = "";
                                    $gimage1 = "";
                                    $gimage2 = "";
                                    $gimage3 = "";
                                    $fullysetimage1 = "";
                                    $fullysetimage2 = "";
                                    $fullysetimage3 = "";
                                    $fullysetimage4 = "";
                                    $fullysetimage5 = "";
                                    $fullysetimage6 = "";
                                    //get images
                                    // if(!empty($prod->Images)){
                                    //   $image1= $prod->Images[0]->FullUrl;
                                    //   $image2= $prod->Images[0]->ThumbnailUrl;
                                    //   $image3= $prod->Images[0]->ZoomUrl;
                                    // }
                                    // if(!empty($prod->GroupImages)){
                                    //   $gimage1= $prod->GroupImages[0]->ZoomUrl;
                                    //   $gimage2= $prod->GroupImages[0]->ZoomUrl;
                                    //   $gimage3= $prod->GroupImages[0]->ZoomUrl;
                                    // }
                                    //get images
                                    if (!empty($prod->Images)) {
                                        $image_peram_count = count($prod->Images);
                                        if ($image_peram_count >= 1) {
                                            $image1 = $prod->Images[0]->FullUrl;
                                        }
                                        if ($image_peram_count >= 2) {
                                            $image2 = $prod->Images[1]->FullUrl;
                                        }
                                        if ($image_peram_count >= 3) {
                                            $image3 = $prod->Images[2]->FullUrl;
                                        }
                                        if ($image_peram_count >= 4) {
                                            $image4 = $prod->Images[3]->FullUrl;
                                        }
                                        if ($image_peram_count >= 5) {
                                            $image5 = $prod->Images[4]->FullUrl;
                                        }
                                        if ($image_peram_count >= 6) {
                                            $image5 = $prod->Images[5]->FullUrl;
                                        }
                                        // $image1= $prod->Images[0]->FullUrl;
                                        // $image2= $prod->Images[0]->ThumbnailUrl;
                                        // $image3= $prod->Images[0]->ZoomUrl;
                                    }
                                    //get group images
                                    if (!empty($prod->GroupImages)) {
                                        $Groupimage_peram_count = count($prod->GroupImages);
                                        if ($Groupimage_peram_count >= 1) {
                                            $gimage1 = $prod->GroupImages[0]->FullUrl;
                                        }
                                        if ($Groupimage_peram_count >= 2) {
                                            $gimage2 = $prod->GroupImages[1]->FullUrl;
                                        }
                                        if ($Groupimage_peram_count >= 3) {
                                            $gimage3 = $prod->GroupImages[2]->FullUrl;
                                        }
                                        // $gimage1= $prod->GroupImages[0]->ZoomUrl;
                                        // $gimage2= $prod->GroupImages[0]->ZoomUrl;
                                        // $gimage3= $prod->GroupImages[0]->ZoomUrl;
                                    }
                                    //get Fully Set Images images
                                    if (!empty($prod->FullySetImages)) {
                                        $FullySetimage_peram_count = count($prod->FullySetImages);
                                        if ($FullySetimage_peram_count >= 1) {
                                            $fullysetimage1 = $prod->FullySetImages[0]->FullUrl;
                                        }
                                        if ($FullySetimage_peram_count >= 2) {
                                            $fullysetimage2 = $prod->FullySetImages[1]->FullUrl;
                                        }
                                        if ($FullySetimage_peram_count >= 3) {
                                            $fullysetimage3 = $prod->FullySetImages[2]->FullUrl;
                                        }
                                        if ($FullySetimage_peram_count >= 4) {
                                            $fullysetimage4 = $prod->FullySetImages[3]->FullUrl;
                                        }
                                        if ($FullySetimage_peram_count >= 5) {
                                            $fullysetimage5 = $prod->FullySetImages[4]->FullUrl;
                                        }
                                        if ($FullySetimage_peram_count >= 6) {
                                            $fullysetimage6 = $prod->FullySetImages[5]->FullUrl;
                                        }
                                        // $image1= $prod->Images[0]->FullUrl;
                                        // $image2= $prod->Images[0]->ThumbnailUrl;
                                        // $image3= $prod->Images[0]->ZoomUrl;
                                    }
                                    //get AGTA
                                    if (!empty($prod->AGTA)) {
                                        $agta = $prod->AGTA;
                                    } else {
                                        $agta = "";
                                    }
                                    //get MerchandisingCategory
                                    $mcat1 = "";
                                    $mcat2 = "";
                                    $mcat3 = "";
                                    $mcat4 = "";
                                    $mcat5 = "";
                                    if (!empty($prod->MerchandisingCategory1)) {
                                        $mcat1 = $prod->MerchandisingCategory1;
                                    }
                                    if (!empty($prod->MerchandisingCategory2)) {
                                        $mcat2 = $prod->MerchandisingCategory2;
                                    }
                                    if (!empty($prod->MerchandisingCategory3)) {
                                        $mcat3 = $prod->MerchandisingCategory3;
                                    }
                                    if (!empty($prod->MerchandisingCategory4)) {
                                        $mcat4 = $prod->MerchandisingCategory4;
                                    }
                                    if (!empty($prod->MerchandisingCategory5)) {
                                        $mcat5 = $prod->MerchandisingCategory5;
                                    }
                                    $Description = "";
                                    if (!empty($prod->Description)) {
                                        $Description = str_replace("K X1", "K Forever", $prod->Description);
                                    }
                                    $ShortDescription = "";
                                    if (!empty($prod->ShortDescription)) {
                                        $ShortDescription = str_replace("K X1", "K Forever", $prod->ShortDescription);
                                    }
                                    $GroupDescription = "";
                                    if (!empty($prod->GroupDescription)) {
                                        $GroupDescription = str_replace("K X1", "K Forever", $prod->GroupDescription);
                                    }
                                    $LeadTime = "";
                                    if (!empty($prod->LeadTime)) {
                                        $LeadTime = $prod->LeadTime;
                                    }
                                    //get vedio and Group vedios
                                    $vedio = "";
                                    $gvedio = "";
                                    if (!empty($prod->Videos)) {
                                        $vedio = $prod->Videos[0]->DownloadUrl;
                                    }
                                    if (!empty($prod->GroupVideos)) {
                                        $gvedio = $prod->GroupVideos[0]->Url;
                                    }
                                    //explode sku for get and save sku series and sku series type start
                                    $sku_no = $prod->SKU;
                                    if (is_numeric($sku_no[0])) {
                                        $sku_ar = explode(":", $sku_no);
                                    } else {
                                        $arr = (str_split($sku_no));
                                        $l = count($arr);
                                        for ($i = 0; $i <= $l; $i++) {
                                            if (is_numeric($arr[$i])) {
                                                array_splice($arr, $i, 0, ":");
                                                break;
                                            }
                                        }
                                        $s = join($arr);
                                        $sku_ar = explode(":", $s);
                                    }
                                    $cate_param_count = count($sku_ar);
                                    $sku_series = "";
                                    $sku_series_type1 = "";
                                    $sku_series_type2 = "";
                                    $sku_series_type3 = "";
                                    if ($cate_param_count >= 1) {
                                        $sku_series = $sku_ar[0];
                                    }
                                    if ($cate_param_count >= 2) {
                                        $sku_series_type1 = $sku_ar[1];
                                    }
                                    if ($cate_param_count >= 3) {
                                        $sku_series_type2 = $sku_ar[2];
                                    }
                                    if ($cate_param_count >= 4) {
                                        $sku_series_type3 = $sku_ar[3];
                                    }
                                    $ProductType = "";
                                    if (!empty($prod->ProductType)) {
                                        $ProductType = $prod->ProductType;
                                    }
                                    $OnHand = "";
                                    if (!empty($prod->OnHand)) {
                                        $OnHand = $prod->OnHand;
                                    }
                                    $Status = "";
                                    if (!empty($prod->Status)) {
                                        $Status = $prod->Status;
                                    }
                                    $Value = "";
                                    if (!empty($prod->Price->Value)) {
                                        $Value = $prod->Price->Value;
                                    }
                                    $CurrencyCode = "";
                                    if (!empty($prod->Price->CurrencyCode)) {
                                        $CurrencyCode = $prod->Price->CurrencyCode;
                                    }
                                    $UnitOfSale = "";
                                    if (!empty($prod->UnitOfSale)) {
                                        $UnitOfSale = $prod->UnitOfSale;
                                    }
                                    $Weight = "";
                                    if (!empty($prod->Weight)) {
                                        $Weight = $prod->Weight;
                                    }
                                    $WeightUnitOfMeasure = "";
                                    if (!empty($prod->WeightUnitOfMeasure)) {
                                        $WeightUnitOfMeasure = $prod->WeightUnitOfMeasure;
                                    }
                                    $GramWeight = "";
                                    if (!empty($prod->GramWeight)) {
                                        $GramWeight = $prod->GramWeight;
                                    }
                                    $GroupName = "";
                                    if (!empty($prod->DescriptiveElementGroup->GroupName)) {
                                        $GroupName = $prod->DescriptiveElementGroup->GroupName;
                                    }
                                    $CreationDate = "";
                                    if (!empty($prod->CreationDate)) {
                                        $CreationDate = $prod->CreationDate;
                                    }
                                    $CountryOfOrigin = "";
                                    if (!empty($prod->CountryOfOrigin)) {
                                        $CountryOfOrigin = $prod->CountryOfOrigin;
                                    }
                                    $RingSizable = "";
                                    if (!empty($prod->RingSizable)) {
                                        $RingSizable = $prod->RingSizable;
                                    }
                                    $ReadyToWear = "";
                                    if (!empty($prod->ReadyToWear)) {
                                        $ReadyToWear = $prod->ReadyToWear;
                                    }
                                    //specifications
                                    if (empty($prod->Specifications)) {
                                        $specifications = "";
                                    } else {
                                        $specifications = $prod->Specifications;
                                    }
                                    //comessetwith
                                    if (empty($prod->CanBeSetWith)) {
                                        $canbesetwith = "";
                                    } else {
                                        $canbesetwith = $prod->CanBeSetWith;
                                    }
                                    //SetWith
                                    if (empty($prod->SetWith)) {
                                        $setwith = "";
                                    } else {
                                        $setwith = $prod->SetWith;
                                    }
                                    //ringsize
                                    $ringSizeArray = [];
                                    // print_r($prod->ConfigurationModel->RingSizeOptions);die();
                                    if (!empty($prod->ConfigurationModel)) {
                                        if (empty($prod->ConfigurationModel->RingSizeOptions)) {
                                            $ringSizeArray = "";
                                        } else {
                                            foreach ($prod->ConfigurationModel->RingSizeOptions as $configModel) {
                                                $ringSizeArray[] = array(
                                                    "Size" => number_format((float)$configModel->Size, 2, '.', ''),
                                                    "Price" => $configModel->Price->Value
                                                );
                                            }
                                        }
                                    } else {
                                        $ringSizeArray = "";
                                    }
                                    //explode sku for get and save sku series and sku series type end
                                    if (!empty($prod->Price->Value)) {
                                        if ($prod->Price->Value > $MINIMUM_COST) {
                                            $ex = 0;
                                            $ex1 = 0;
                                            //---- excluding series --------
                                            $this->db->select('*');
                                            $this->db->from('tbl_minisubcategory2');
                                            $this->db->where('is_active', 1);
                                            $this->db->where('id', $minorsub2);
                                            $cat_data = $this->db->get()->row();
                                            if (!empty($cat_data->exlude_series)) {
                                                $exclude = explode(",", $cat_data->exlude_series);
                                                if (count($exclude) > 0) {
                                                    foreach ($exclude as $key => $value345) {
                                                        if ($value345 == $sku_series) {
                                                            $ex = 1;
                                                            break;
                                                        }
                                                    }
                                                } else {
                                                    if ($cat_data->exlude_series == $sku_series) {
                                                        $ex = 1;
                                                    }
                                                }
                                            }
                                            //---- excluding sku --------
                                            if (!empty($cat_data->exlude_sku)) {
                                                $exclude1 = explode(",", $cat_data->exlude_sku);
                                                if (count($exclude1) > 0) {
                                                    foreach ($exclude1 as $key => $value3452) {
                                                        if ($value3452 == $prod->SKU) {
                                                            $ex1 = 1;
                                                            break;
                                                        }
                                                    }
                                                } else {
                                                    if ($cat_data->exlude_sku == $prod->SKU) {
                                                        $ex1 = 1;
                                                    }
                                                }
                                            }
                                            if ($ex == 0 && $ex1 == 0) {
                                                $data_insert = array(
                                                    'product_id' => $prod->Id,
                                                    'category' => $category_id,
                                                    'sub_category' => $subcategory,
                                                    'minisub_category' => $minorsub,
                                                    'minisub_category2' => $minorsub2,
                                                    // 'vendor'=>1,
                                                    'sku' => $prod->SKU,
                                                    'sku_series' => $sku_series,
                                                    'sku_series_type1' => $sku_series_type1,
                                                    'sku_series_type2' => $sku_series_type2,
                                                    'sku_series_type3' => $sku_series_type3,
                                                    'description' => $Description,
                                                    'sdesc' => $ShortDescription,
                                                    'gdesc' => $GroupDescription,
                                                    'mcat1' => $mcat1,
                                                    'mcat2' => $mcat2,
                                                    'mcat3' => $mcat3,
                                                    'mcat4' => $mcat4,
                                                    'mcat5' => $mcat5,
                                                    'product_type' => $ProductType,
                                                    'collection' => "",
                                                    'onhand' => $OnHand,
                                                    'status' => $Status,
                                                    'price' => $Value,
                                                    'currency' => $CurrencyCode,
                                                    'unitofsale' => $UnitOfSale,
                                                    'weight' => $Weight,
                                                    'weightunit' => $WeightUnitOfMeasure,
                                                    'gramweight' => $GramWeight,
                                                    'ringsizable' => $RingSizable,
                                                    'ringsize' => $ringsize,
                                                    'ringsizetype' => $ringsizetype,
                                                    'leadtime' => $LeadTime,
                                                    'agta' => $agta,
                                                    'desc_e_grp' => $GroupName,
                                                    'desc_e_name1' => $desc_e_name1,
                                                    'desc_e_value1' => ltrim($desc_e_value1),
                                                    'desc_e_name2' => $desc_e_name2,
                                                    'desc_e_value2' => ltrim($desc_e_value2),
                                                    'desc_e_name3' => $desc_e_name3,
                                                    'desc_e_value3' => ltrim($desc_e_value3),
                                                    'desc_e_name4' => $desc_e_name4,
                                                    'desc_e_value4' => ltrim($desc_e_value4),
                                                    'desc_e_name5' => $desc_e_name5,
                                                    'desc_e_value5' => ltrim($desc_e_value5),
                                                    'desc_e_name6' => $desc_e_name6,
                                                    'desc_e_value6' => ltrim($desc_e_value6),
                                                    'desc_e_name7' => $desc_e_name7,
                                                    'desc_e_value7' => ltrim($desc_e_value7),
                                                    'desc_e_name8' => $desc_e_name8,
                                                    'desc_e_value8' => ltrim($desc_e_value8),
                                                    'desc_e_name9' => $desc_e_name9,
                                                    'desc_e_value9' => ltrim($desc_e_value9),
                                                    'desc_e_name10' => $desc_e_name10,
                                                    'desc_e_value10' => ltrim($desc_e_value10),
                                                    'desc_e_name11' => $desc_e_name11,
                                                    'desc_e_value11' => ltrim($desc_e_value11),
                                                    'desc_e_name12' => $desc_e_name12,
                                                    'desc_e_value12' => ltrim($desc_e_value12),
                                                    'desc_e_name13' => $desc_e_name13,
                                                    'desc_e_value13' => ltrim($desc_e_value13),
                                                    'desc_e_name14' => $desc_e_name14,
                                                    'desc_e_value14' => ltrim($desc_e_value14),
                                                    'desc_e_name15' => $desc_e_name15,
                                                    'desc_e_value15' => ltrim($desc_e_value15),
                                                    'readytowear' => $ReadyToWear,
                                                    'smi' => "",
                                                    'image1' => $image1,
                                                    'image2' => $image2,
                                                    'image3' => $image3,
                                                    'image4' => $image4,
                                                    'image5' => $image5,
                                                    'image6' => $image6,
                                                    'FullySetImage1' => $fullysetimage1,
                                                    'FullySetImage2' => $fullysetimage2,
                                                    'FullySetImage3' => $fullysetimage3,
                                                    'FullySetImage4' => $fullysetimage4,
                                                    'FullySetImage5' => $fullysetimage5,
                                                    'FullySetImage6' => $fullysetimage6,
                                                    'video' => $vedio,
                                                    'gimage1' => $gimage1,
                                                    'gimage2' => $gimage2,
                                                    'gimage3' => $gimage3,
                                                    'gvideo' => $gvedio,
                                                    'creationdate' => $CreationDate,
                                                    'currencycode' => "USD",
                                                    'country' => $CountryOfOrigin,
                                                    'dclarity' => "",
                                                    'dcolor' => "",
                                                    'totalweight' => "",
                                                    'ip' => $ip,
                                                    'added_by' => $addedby,
                                                    'is_active' => 1,
                                                    'group_id' => $prod->DescriptiveElementGroup->GroupId,
                                                    'series_id' => $prod->DescriptiveElementGroup->DescriptiveElements[0]->Value,

                                                    'date' => $cur_date
                                                );
                                                $last_id = $this->base_model->insert_table("tbl_products", $data_insert, 1);
                                                $beta_insert = array(
                                                    'product_id' => $last_id,
                                                    'specifications' => json_encode($specifications),
                                                    'canbesetwith' => json_encode($canbesetwith),
                                                    'setwith' => json_encode($setwith),
                                                    'ringsize' => json_encode($ringSizeArray),
                                                );
                                                $spec_id = $this->base_model->insert_table("tbl_product_specifications", $beta_insert, 1);
                                            }
                                        }
                                    }
                                }
                                $NextPage = "";
                                if (!empty($result_da->NextPage)) {
                                    $NextPage = $result_da->NextPage;
                                }
                                // echo $i." NP- ".$NextPage."<br>";
                            }
                            // }else{
                            //   echo "product is zero";
                            // }
                            // $NextPage= "";
                            // $NextPage= $result_da->NextPage;
                            // echo $i." NP- ".$NextPage."<br>";
                            // }
                        }
                        //statr squ
                        if ($type == 3) {
                            // foreach ($api_id as $value) {
                            $url = 'https://api.stuller.com/v2/products?SKU=' . $value;
                            $header = array();
                            $header[] = 'Host:api.stuller.com';
                            $header[] = 'Content-Type:application/json';
                            $header[] = 'Authorization:Basic ZGV2amV3ZWw6Q29kaW5nMjA9';
                            $ch = curl_init($url);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            // curl_setopt($ch, CURLOPT_POST, 1);
                            // curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                            $result = curl_exec($ch);
                            curl_close($ch);
                            $result_da = json_decode($result);
                            // echo "<pre>";
                            //
                            // print_r($result_da);
                            // echo "</pre>";
                            //
                            // exit;
                            if (!empty($result_da)) {
                                foreach ($result_da->Products as $prod) {
                                    $specifications = [];
                                    $ringsize = 0;
                                    $ringsizetype = "";
                                    $RingSizable = "";
                                    if (!empty($prod->RingSizable)) {
                                        $RingSizable = $prod->RingSizable;
                                        if ($RingSizable == false) {
                                            $ringsize = 0;
                                            $ringsizetype = "";
                                        } else {
                                            if (!empty($prod->ringsize)) {
                                                $ringsize = $prod->ringsize;
                                            }
                                            if (!empty($prod->ringsizetype)) {
                                                $ringsizetype = $prod->ringsizetype;
                                            }
                                        }
                                    }
                                    //group eliments
                                    if (empty($prod->DescriptiveElementGroup)) {
                                        $DescriptiveElements = [];
                                    } else {
                                        $DescriptiveElements = $prod->DescriptiveElementGroup->DescriptiveElements;
                                    }
                                    $cate_array_count = 0;
                                    if (!empty($DescriptiveElements)) {
                                        $cate_array_count = count($DescriptiveElements);
                                    }
                                    $desc_e_name1 = "";
                                    $desc_e_value1 = "";
                                    $desc_e_name2 = "";
                                    $desc_e_value2 = "";
                                    $desc_e_name3 = "";
                                    $desc_e_value3 = "";
                                    $desc_e_name4 = "";
                                    $desc_e_value4 = "";
                                    $desc_e_name5 = "";
                                    $desc_e_value5 = "";
                                    $desc_e_name6 = "";
                                    $desc_e_value6 = "";
                                    $desc_e_name7 = "";
                                    $desc_e_value7 = "";
                                    $desc_e_name8 = "";
                                    $desc_e_value8 = "";
                                    $desc_e_name9 = "";
                                    $desc_e_value9 = "";
                                    $desc_e_name10 = "";
                                    $desc_e_value10 = "";
                                    $desc_e_name11 = "";
                                    $desc_e_value11 = "";
                                    $desc_e_name12 = "";
                                    $desc_e_value12 = "";
                                    $desc_e_name13 = "";
                                    $desc_e_value13 = "";
                                    $desc_e_name14 = "";
                                    $desc_e_value14 = "";
                                    $desc_e_name15 = "";
                                    $desc_e_value15 = "";
                                    if ($cate_array_count >= 1) {
                                        $desc_e_name1 = $DescriptiveElements[0]->Name;
                                        $desc_e_value1 = str_replace("K X1", "K Forever", $DescriptiveElements[0]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 2) {
                                        $desc_e_name2 = $DescriptiveElements[1]->Name;
                                        $desc_e_value2 = str_replace("K X1", "K Forever", $DescriptiveElements[1]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 3) {
                                        $desc_e_name3 = $DescriptiveElements[2]->Name;
                                        $desc_e_value3 = str_replace("K X1", "K Forever", $DescriptiveElements[2]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 4) {
                                        $desc_e_name4 = $DescriptiveElements[3]->Name;
                                        $desc_e_value4 = str_replace("K X1", "K Forever", $DescriptiveElements[3]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 5) {
                                        $desc_e_name5 = $DescriptiveElements[4]->Name;
                                        $desc_e_value5 = str_replace("K X1", "K Forever", $DescriptiveElements[4]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 6) {
                                        $desc_e_name6 = $DescriptiveElements[5]->Name;
                                        $desc_e_value6 = str_replace("K X1", "K Forever", $DescriptiveElements[5]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 7) {
                                        $desc_e_name7 = $DescriptiveElements[6]->Name;
                                        $desc_e_value7 = str_replace("K X1", "K Forever", $DescriptiveElements[6]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 8) {
                                        $desc_e_name8 = $DescriptiveElements[7]->Name;
                                        $desc_e_value8 = str_replace("K X1", "K Forever", $DescriptiveElements[7]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 9) {
                                        $desc_e_name9 = $DescriptiveElements[8]->Name;
                                        $desc_e_value9 = str_replace("K X1", "K Forever", $DescriptiveElements[8]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 10) {
                                        $desc_e_name10 = $DescriptiveElements[9]->Name;
                                        $desc_e_value10 = str_replace("K X1", "K Forever", $DescriptiveElements[9]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 11) {
                                        $desc_e_name11 = $DescriptiveElements[10]->Name;
                                        $desc_e_value11 = str_replace("K X1", "K Forever", $DescriptiveElements[10]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 12) {
                                        $desc_e_name12 = $DescriptiveElements[11]->Name;
                                        $desc_e_value12 = str_replace("K X1", "K Forever", $DescriptiveElements[11]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 13) {
                                        $desc_e_name13 = $DescriptiveElements[12]->Name;
                                        $desc_e_value13 = str_replace("K X1", "K Forever", $DescriptiveElements[12]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 14) {
                                        $desc_e_name14 = $DescriptiveElements[13]->Name;
                                        $desc_e_value14 = str_replace("K X1", "K Forever", $DescriptiveElements[13]->DisplayValue);
                                    }
                                    if ($cate_array_count >= 15) {
                                        $desc_e_name15 = $DescriptiveElements[14]->Name;
                                        $desc_e_value15 = str_replace("K X1", "K Forever", $DescriptiveElements[14]->DisplayValue);
                                    }
                                    $image1 = "";
                                    $image2 = "";
                                    $image3 = "";
                                    $image4 = "";
                                    $image5 = "";
                                    $image6 = "";
                                    $gimage1 = "";
                                    $gimage2 = "";
                                    $gimage3 = "";
                                    $fullysetimage1 = "";
                                    $fullysetimage2 = "";
                                    $fullysetimage3 = "";
                                    $fullysetimage4 = "";
                                    $fullysetimage5 = "";
                                    $fullysetimage6 = "";
                                    //get images
                                    // if(!empty($prod->Images)){
                                    //   $image1= $prod->Images[0]->FullUrl;
                                    //   $image2= $prod->Images[0]->ThumbnailUrl;
                                    //   $image3= $prod->Images[0]->ZoomUrl;
                                    // }
                                    // if(!empty($prod->GroupImages)){
                                    //   $gimage1= $prod->GroupImages[0]->ZoomUrl;
                                    //   $gimage2= $prod->GroupImages[0]->ZoomUrl;
                                    //   $gimage3= $prod->GroupImages[0]->ZoomUrl;
                                    // }
                                    //get images
                                    if (!empty($prod->Images)) {
                                        $image_peram_count = count($prod->Images);
                                        if ($image_peram_count >= 1) {
                                            $image1 = $prod->Images[0]->FullUrl;
                                        }
                                        if ($image_peram_count >= 2) {
                                            $image2 = $prod->Images[1]->FullUrl;
                                        }
                                        if ($image_peram_count >= 3) {
                                            $image3 = $prod->Images[2]->FullUrl;
                                        }
                                        if ($image_peram_count >= 4) {
                                            $image4 = $prod->Images[3]->FullUrl;
                                        }
                                        if ($image_peram_count >= 5) {
                                            $image5 = $prod->Images[4]->FullUrl;
                                        }
                                        if ($image_peram_count >= 6) {
                                            $image5 = $prod->Images[5]->FullUrl;
                                        }
                                        // $image1= $prod->Images[0]->FullUrl;
                                        // $image2= $prod->Images[0]->ThumbnailUrl;
                                        // $image3= $prod->Images[0]->ZoomUrl;
                                    }
                                    //get group images
                                    if (!empty($prod->GroupImages)) {
                                        $Groupimage_peram_count = count($prod->GroupImages);
                                        if ($Groupimage_peram_count >= 1) {
                                            $gimage1 = $prod->GroupImages[0]->FullUrl;
                                        }
                                        if ($Groupimage_peram_count >= 2) {
                                            $gimage2 = $prod->GroupImages[1]->FullUrl;
                                        }
                                        if ($Groupimage_peram_count >= 3) {
                                            $gimage3 = $prod->GroupImages[2]->FullUrl;
                                        }
                                        // $gimage1= $prod->GroupImages[0]->ZoomUrl;
                                        // $gimage2= $prod->GroupImages[0]->ZoomUrl;
                                        // $gimage3= $prod->GroupImages[0]->ZoomUrl;
                                    }
                                    //get Fully Set Images images
                                    if (!empty($prod->FullySetImages)) {
                                        $FullySetimage_peram_count = count($prod->FullySetImages);
                                        if ($FullySetimage_peram_count >= 1) {
                                            $fullysetimage1 = $prod->FullySetImages[0]->FullUrl;
                                        }
                                        if ($FullySetimage_peram_count >= 2) {
                                            $fullysetimage2 = $prod->FullySetImages[1]->FullUrl;
                                        }
                                        if ($FullySetimage_peram_count >= 3) {
                                            $fullysetimage3 = $prod->FullySetImages[2]->FullUrl;
                                        }
                                        if ($FullySetimage_peram_count >= 4) {
                                            $fullysetimage4 = $prod->FullySetImages[3]->FullUrl;
                                        }
                                        if ($FullySetimage_peram_count >= 5) {
                                            $fullysetimage5 = $prod->FullySetImages[4]->FullUrl;
                                        }
                                        if ($FullySetimage_peram_count >= 6) {
                                            $fullysetimage6 = $prod->FullySetImages[5]->FullUrl;
                                        }
                                        // $image1= $prod->Images[0]->FullUrl;
                                        // $image2= $prod->Images[0]->ThumbnailUrl;
                                        // $image3= $prod->Images[0]->ZoomUrl;
                                    }
                                    //get AGTA
                                    if (!empty($prod->AGTA)) {
                                        $agta = $prod->AGTA;
                                    } else {
                                        $agta = "";
                                    }
                                    //get MerchandisingCategory
                                    $mcat1 = "";
                                    $mcat2 = "";
                                    $mcat3 = "";
                                    $mcat4 = "";
                                    $mcat5 = "";
                                    if (!empty($prod->MerchandisingCategory1)) {
                                        $mcat1 = $prod->MerchandisingCategory1;
                                    }
                                    if (!empty($prod->MerchandisingCategory2)) {
                                        $mcat2 = $prod->MerchandisingCategory2;
                                    }
                                    if (!empty($prod->MerchandisingCategory3)) {
                                        $mcat3 = $prod->MerchandisingCategory3;
                                    }
                                    if (!empty($prod->MerchandisingCategory4)) {
                                        $mcat4 = $prod->MerchandisingCategory4;
                                    }
                                    if (!empty($prod->MerchandisingCategory5)) {
                                        $mcat5 = $prod->MerchandisingCategory5;
                                    }
                                    $Description = "";
                                    if (!empty($prod->Description)) {
                                        $Description = str_replace("K X1", "K Forever", $prod->Description);
                                    }
                                    $ShortDescription = "";
                                    if (!empty($prod->ShortDescription)) {
                                        $ShortDescription = str_replace("K X1", "K Forever", $prod->ShortDescription);
                                    }
                                    $GroupDescription = "";
                                    if (!empty($prod->GroupDescription)) {
                                        $GroupDescription = str_replace("K X1", "K Forever", $prod->GroupDescription);
                                    }
                                    $LeadTime = "";
                                    if (!empty($prod->LeadTime)) {
                                        $LeadTime = $prod->LeadTime;
                                    }
                                    //get vedio and Group vedios
                                    $vedio = "";
                                    $gvedio = "";
                                    if (!empty($prod->Videos)) {
                                        $vedio = $prod->Videos[0]->DownloadUrl;
                                    }
                                    if (!empty($prod->GroupVideos)) {
                                        $gvedio = $prod->GroupVideos[0]->Url;
                                    }
                                    //get vedio and Group vedios
                                    $vedio = "";
                                    $gvedio = "";
                                    if (!empty($prod->Videos)) {
                                        $vedio = $prod->Videos[0]->DownloadUrl;
                                    }
                                    if (!empty($prod->GroupVideos)) {
                                        $gvedio = $prod->GroupVideos[0]->Url;
                                    }
                                    //explode sku for get and save sku series and sku series type start
                                    $sku_no = $prod->SKU;
                                    if (is_numeric($sku_no[0])) {
                                        $sku_ar = explode(":", $sku_no);
                                    } else {
                                        $arr = (str_split($sku_no));
                                        $l = count($arr);
                                        for ($i = 0; $i <= $l; $i++) {
                                            if (is_numeric($arr[$i])) {
                                                array_splice($arr, $i, 0, ":");
                                                break;
                                            }
                                        }
                                        $s = join($arr);
                                        $sku_ar = explode(":", $s);
                                    }
                                    $cate_param_count = count($sku_ar);
                                    $sku_series = "";
                                    $sku_series_type1 = "";
                                    $sku_series_type2 = "";
                                    $sku_series_type3 = "";
                                    if ($cate_param_count >= 1) {
                                        $sku_series = $sku_ar[0];
                                    }
                                    if ($cate_param_count >= 2) {
                                        $sku_series_type1 = $sku_ar[1];
                                    }
                                    if ($cate_param_count >= 3) {
                                        $sku_series_type2 = $sku_ar[2];
                                    }
                                    if ($cate_param_count >= 4) {
                                        $sku_series_type3 = $sku_ar[3];
                                    }
                                    $ProductType = "";
                                    if (!empty($prod->ProductType)) {
                                        $ProductType = $prod->ProductType;
                                    }
                                    $OnHand = "";
                                    if (!empty($prod->OnHand)) {
                                        $OnHand = $prod->OnHand;
                                    }
                                    $Status = "";
                                    if (!empty($prod->Status)) {
                                        $Status = $prod->Status;
                                    }
                                    $Value = "";
                                    if (!empty($prod->Price->Value)) {
                                        $Value = $prod->Price->Value;
                                    }
                                    $CurrencyCode = "";
                                    if (!empty($prod->Price->CurrencyCode)) {
                                        $CurrencyCode = $prod->Price->CurrencyCode;
                                    }
                                    $UnitOfSale = "";
                                    if (!empty($prod->UnitOfSale)) {
                                        $UnitOfSale = $prod->UnitOfSale;
                                    }
                                    $Weight = "";
                                    if (!empty($prod->Weight)) {
                                        $Weight = $prod->Weight;
                                    }
                                    $WeightUnitOfMeasure = "";
                                    if (!empty($prod->WeightUnitOfMeasure)) {
                                        $WeightUnitOfMeasure = $prod->WeightUnitOfMeasure;
                                    }
                                    $GramWeight = "";
                                    if (!empty($prod->GramWeight)) {
                                        $GramWeight = $prod->GramWeight;
                                    }
                                    $GroupName = "";
                                    if (!empty($prod->DescriptiveElementGroup->GroupName)) {
                                        $GroupName = $prod->DescriptiveElementGroup->GroupName;
                                    }
                                    $CreationDate = "";
                                    if (!empty($prod->CreationDate)) {
                                        $CreationDate = $prod->CreationDate;
                                    }
                                    $CountryOfOrigin = "";
                                    if (!empty($prod->CountryOfOrigin)) {
                                        $CountryOfOrigin = $prod->CountryOfOrigin;
                                    }
                                    $RingSizable = "";
                                    if (!empty($prod->RingSizable)) {
                                        $RingSizable = $prod->RingSizable;
                                    }
                                    $ReadyToWear = "";
                                    if (!empty($prod->ReadyToWear)) {
                                        $ReadyToWear = $prod->ReadyToWear;
                                    }
                                    //specifications
                                    if (empty($prod->Specifications)) {
                                        $specifications = "";
                                    } else {
                                        $specifications = $prod->Specifications;
                                    }
                                    //comessetwith
                                    if (empty($prod->CanBeSetWith)) {
                                        $canbesetwith = "";
                                    } else {
                                        $canbesetwith = $prod->CanBeSetWith;
                                    }
                                    //SetWith
                                    if (empty($prod->SetWith)) {
                                        $setwith = "";
                                    } else {
                                        $setwith = $prod->SetWith;
                                    }
                                    //ringsize
                                    $ringSizeArray = [];
                                    // print_r($prod->ConfigurationModel->RingSizeOptions);die();
                                    if (!empty($prod->ConfigurationModel)) {
                                        if (empty($prod->ConfigurationModel->RingSizeOptions)) {
                                            $ringSizeArray = "";
                                        } else {
                                            foreach ($prod->ConfigurationModel->RingSizeOptions as $configModel) {
                                                $ringSizeArray[] = array(
                                                    "Size" => number_format((float)$configModel->Size, 2, '.', ''),
                                                    "Price" => $configModel->Price->Value
                                                );
                                            }
                                        }
                                    } else {
                                        $ringSizeArray = "";
                                    }
                                    //explode sku for get and save sku series and sku series type end
                                    if (!empty($prod->Price->Value)) {
                                        if ($prod->Price->Value > $MINIMUM_COST) {
                                            $ex = 0;
                                            $ex1 = 0;
                                            //---- excluding series --------
                                            $this->db->select('*');
                                            $this->db->from('tbl_minisubcategory2');
                                            $this->db->where('is_active', 1);
                                            $this->db->where('id', $minorsub2);
                                            $cat_data = $this->db->get()->row();
                                            if (!empty($cat_data->exlude_series)) {
                                                $exclude = explode(",", $cat_data->exlude_series);
                                                if (count($exclude) > 0) {
                                                    foreach ($exclude as $key => $value345) {
                                                        if ($value345 == $sku_series) {
                                                            $ex = 1;
                                                            break;
                                                        }
                                                    }
                                                } else {
                                                    if ($cat_data->exlude_series == $sku_series) {
                                                        $ex = 1;
                                                    }
                                                }
                                            }
                                            //---- excluding sku --------
                                            if (!empty($cat_data->exlude_sku)) {
                                                $exclude1 = explode(",", $cat_data->exlude_sku);
                                                if (count($exclude1) > 0) {
                                                    foreach ($exclude1 as $key => $value3452) {
                                                        if ($value3452 == $prod->SKU) {
                                                            $ex1 = 1;
                                                            break;
                                                        }
                                                    }
                                                } else {
                                                    if ($cat_data->exlude_sku == $prod->SKU) {
                                                        $ex1 = 1;
                                                    }
                                                }
                                            }
                                            if ($ex == 0 && $ex1 == 0) {
                                                $data_insert = array(
                                                    'product_id' => $prod->Id,
                                                    'category' => $category_id,
                                                    'sub_category' => $subcategory,
                                                    'minisub_category' => $minorsub,
                                                    'minisub_category2' => $minorsub2,
                                                    // 'vendor'=>1,
                                                    'sku' => $prod->SKU,
                                                    'sku_series' => $sku_series,
                                                    'sku_series_type1' => $sku_series_type1,
                                                    'sku_series_type2' => $sku_series_type2,
                                                    'sku_series_type3' => $sku_series_type3,
                                                    'description' => $Description,
                                                    'sdesc' => $ShortDescription,
                                                    'gdesc' => $GroupDescription,
                                                    'mcat1' => $mcat1,
                                                    'mcat2' => $mcat2,
                                                    'mcat3' => $mcat3,
                                                    'mcat4' => $mcat4,
                                                    'mcat5' => $mcat5,
                                                    'product_type' => $ProductType,
                                                    'collection' => "",
                                                    'onhand' => $OnHand,
                                                    'status' => $Status,
                                                    'price' => $Value,
                                                    'currency' => $CurrencyCode,
                                                    'unitofsale' => $UnitOfSale,
                                                    'weight' => $Weight,
                                                    'weightunit' => $WeightUnitOfMeasure,
                                                    'gramweight' => $GramWeight,
                                                    'ringsizable' => $RingSizable,
                                                    'ringsize' => $ringsize,
                                                    'ringsizetype' => $ringsizetype,
                                                    'leadtime' => $LeadTime,
                                                    'agta' => $agta,
                                                    'desc_e_grp' => $GroupName,
                                                    'desc_e_name1' => $desc_e_name1,
                                                    'desc_e_value1' => ltrim($desc_e_value1),
                                                    'desc_e_name2' => $desc_e_name2,
                                                    'desc_e_value2' => ltrim($desc_e_value2),
                                                    'desc_e_name3' => $desc_e_name3,
                                                    'desc_e_value3' => ltrim($desc_e_value3),
                                                    'desc_e_name4' => $desc_e_name4,
                                                    'desc_e_value4' => ltrim($desc_e_value4),
                                                    'desc_e_name5' => $desc_e_name5,
                                                    'desc_e_value5' => ltrim($desc_e_value5),
                                                    'desc_e_name6' => $desc_e_name6,
                                                    'desc_e_value6' => ltrim($desc_e_value6),
                                                    'desc_e_name7' => $desc_e_name7,
                                                    'desc_e_value7' => ltrim($desc_e_value7),
                                                    'desc_e_name8' => $desc_e_name8,
                                                    'desc_e_value8' => ltrim($desc_e_value8),
                                                    'desc_e_name9' => $desc_e_name9,
                                                    'desc_e_value9' => ltrim($desc_e_value9),
                                                    'desc_e_name10' => $desc_e_name10,
                                                    'desc_e_value10' => ltrim($desc_e_value10),
                                                    'desc_e_name11' => $desc_e_name11,
                                                    'desc_e_value11' => ltrim($desc_e_value11),
                                                    'desc_e_name12' => $desc_e_name12,
                                                    'desc_e_value12' => ltrim($desc_e_value12),
                                                    'desc_e_name13' => $desc_e_name13,
                                                    'desc_e_value13' => ltrim($desc_e_value13),
                                                    'desc_e_name14' => $desc_e_name14,
                                                    'desc_e_value14' => ltrim($desc_e_value14),
                                                    'desc_e_name15' => $desc_e_name15,
                                                    'desc_e_value15' => ltrim($desc_e_value15),
                                                    'readytowear' => $ReadyToWear,
                                                    'smi' => "",
                                                    'image1' => $image1,
                                                    'image2' => $image2,
                                                    'image3' => $image3,
                                                    'image4' => $image4,
                                                    'image5' => $image5,
                                                    'image6' => $image6,
                                                    'FullySetImage1' => $fullysetimage1,
                                                    'FullySetImage2' => $fullysetimage2,
                                                    'FullySetImage3' => $fullysetimage3,
                                                    'FullySetImage4' => $fullysetimage4,
                                                    'FullySetImage5' => $fullysetimage5,
                                                    'FullySetImage6' => $fullysetimage6,
                                                    'video' => $vedio,
                                                    'gimage1' => $gimage1,
                                                    'gimage2' => $gimage2,
                                                    'gimage3' => $gimage3,
                                                    'gvideo' => $gvedio,
                                                    'creationdate' => $CreationDate,
                                                    'currencycode' => "USD",
                                                    'country' => $CountryOfOrigin,
                                                    'dclarity' => "",
                                                    'dcolor' => "",
                                                    'totalweight' => "",
                                                    'ip' => $ip,
                                                    'added_by' => $addedby,
                                                    'is_active' => 1,
                                                    'group_id' => $prod->DescriptiveElementGroup->GroupId,
                                                    'series_id' => $prod->DescriptiveElementGroup->DescriptiveElements[0]->Value,

                                                    'date' => $cur_date
                                                );
                                                $last_id = $this->base_model->insert_table("tbl_products", $data_insert, 1);
                                                $beta_insert = array(
                                                    'product_id' => $last_id,
                                                    'specifications' => json_encode($specifications),
                                                    'canbesetwith' => json_encode($canbesetwith),
                                                    'setwith' => json_encode($setwith),
                                                    'ringsize' => json_encode($ringSizeArray),
                                                );
                                                $spec_id = $this->base_model->insert_table("tbl_product_specifications", $beta_insert, 1);
                                            }
                                        }
                                    }
                                }
                                $NextPage = "";
                                if (!empty($result_da->NextPage)) {
                                    $NextPage = $result_da->NextPage;
                                }
                                // echo $i." NP- ".$NextPage."<br>";
                            }
                            // }
                        }
                        //end squ
                    }
                }
                //product data insert from the api end
            }
            // $else++;
            $del++;
        }
        // echo $else;
        // exit;
        return 1;
    }
    public function api($idd)
    {
        $api_id = $idd;
        $total_pages = 0;
        //get count of total number of products start
        $url = 'https://api.stuller.com/v2/products ';
        if ($type == 1 || $type == "") {
            if ($finshed == 1) {
                $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList","Finished"],"CategoryIds":["' . $api_id . '"]}';
            } else {
                $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList"],"CategoryIds":["' . $api_id . '"]}';
            }
        }
        if ($type == 1 || $type == "") {
            if ($finshed == 1) {
            } else {
            }
        }
        $postdata = $data;
        $header = array();
        $header[] = 'Host:api.stuller.com';
        $header[] = 'Content-Type:application/json';
        $header[] = 'Authorization:Basic ZGV2amV3ZWw6Q29kaW5nMjA9';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        $result = curl_exec($ch);
        curl_close($ch);
        // print_r ($result);
        $result_da = json_decode($result);
        //   echo $result[0];
        //
        // exit;
        if (!empty($result_da)) {
            $TotalNumberOfProducts = $result_da->TotalNumberOfProducts;
            $total_pages = round($TotalNumberOfProducts / 500) + 1;
        }
        // echo $total_pages;
        // exit;
        $NextPage = "";
        $response = [];
        for ($i = 0; $i < $total_pages; $i++) {
            if ($data_check->type == 1 || $data_check->type == "") {
                if ($data_check->finshed == 1) {
                    if ($i == 0) {
                        $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList","Finished"],"CategoryIds":["' . $api_id . '"]}';
                    } else {
                        $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList","Finished"],"CategoryIds":["' . $api_id . '"],"NextPage":"' . $NextPage . '" }';
                    }
                } else {
                    if ($i == 0) {
                        $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList"],"CategoryIds":["' . $api_id . '"]}';
                        // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"]}';
                    } else {
                        $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList"],"CategoryIds":["' . $api_id . '"],"NextPage":"' . $NextPage . '" }';
                        // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"],"NextPage":"'.$NextPage.'" }';
                    }
                }
            }
            $n_it = json_decode($api_id);
            foreach ($n_it as $value) {
                if ($type == 2) {
                    if ($finshed == 1) {
                        if ($i == 0) {
                            $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList","Finished"],"Series":["' . $value . '"]}';
                        } else {
                            $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList","Finished"],"Series":["' . $value . '"],"NextPage":"' . $NextPage . '" }';
                        }
                    } else {
                        if ($i == 0) {
                            $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList"],"Series":["' . $value . '"]}';
                            // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"]}';
                        } else {
                            $data = '{"Include":["All", "Media", "DescriptiveElements"],"Filter":["Orderable","OnPriceList"],"Series":["' . $value . '"],"NextPage":"' . $NextPage . '" }';
                            // $data = '{"Filter":[],"CategoryIds":["'.$api_id.'"],"NextPage":"'.$NextPage.'" }';
                        }
                    }
                }
                $postdata = $data;
                $header = array();
                $header[] = 'Host:api.stuller.com';
                $header[] = 'Content-Type:application/json';
                $header[] = 'Authorization:Basic ZGV2amV3ZWw6Q29kaW5nMjA9';
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                $result = curl_exec($ch);
                curl_close($ch);
                // print_r ($result);
                $result_da = json_decode($result);
                $response[] = $result;
                // if ($i==15) {
                //     print_r($response);
                //     exit;
                // }
                $NextPage = "";
                if (!empty($result_da->NextPage)) {
                    $NextPage = $result_da->NextPage;
                }
            }
        }
        // echo json_encode($response);
        // exit;
    }

    //==============product_cron job start======//
    public function products_cron_jobs()
    {



        $category = 0;
        $sub_category = 0;
        $minisubcategory = 0;
        $minisubcategory2 = 0;
        $this->db->select('*');
        $this->db->from('tbl_cron_jobs');
        $this->db->where('status', 0);
        $this->db->order_by('id', 'ASC');
        $cron_jobs = $this->db->get()->row();



        if (!empty($cron_jobs)) {


            $data_insert = array(
                'status' => 1,

            );
            $this->db->where('id', $cron_jobs->id);
            $last_id = $this->db->update('tbl_cron_jobs', $data_insert);





            $category = $cron_jobs->cat_id;
            $sub_category = $cron_jobs->subcat_id;
            $minisubcategory = $cron_jobs->mincat_id1;
            $minisubcategory2 = $cron_jobs->mincat_id2;
        }


        $api_id = 0;
        $last_id = 0;
        if ($category != 0) {
            $this->db->select('*');
            $this->db->from('tbl_category');
            $this->db->where('id', $category);
            $catedata = $this->db->get()->row();
            if (!empty($catedata)) {
                $api_id = $catedata->api_id;
                $type = $catedata->type;
                $finshed = $catedata->finshed;
                $include_series = $catedata->include_series;
                $include_sku = $catedata->include_sku;
            }
        }
        if ($sub_category != 0) {
            $this->db->select('*');
            $this->db->from('tbl_sub_category');
            $this->db->where('id', $sub_category);
            $subdata = $this->db->get()->row();
            if (!empty($subdata)) {
                $api_id = $subdata->api_id;
                $type = $subdata->type;
                $finshed = $subdata->finshed;
                $include_series = $catedata->include_series;
                $include_sku = $catedata->include_sku;
            }
        }
        if ($minisubcategory != 0) {
            $this->db->select('*');
            $this->db->from('tbl_minisubcategory');
            $this->db->where('id', $minisubcategory);
            $minisubdata = $this->db->get()->row();
            if (!empty($minisubdata)) {
                $api_id = $minisubdata->api_id;
                $type = $minisubdata->type;
                $finshed = $minisubdata->finshed;
                $include_series = $catedata->include_series;
                $include_sku = $catedata->include_sku;
            }
        }
        if ($minisubcategory2 != 0) {
            $this->db->select('*');
            $this->db->from('tbl_minisubcategory2');
            $this->db->where('id', $minisubcategory2);
            $minisub2data = $this->db->get()->row();
            if (!empty($minisub2data)) {
                $api_id = $minisub2data->api_id;
                $type = $minisub2data->type;
                $finshed = $minisub2data->finshed;
                $include_series = $catedata->include_series;
                $include_sku = $catedata->include_sku;
            }
        }

        $api_id = json_decode($api_id);
        if ($api_id != 0) {
            //stuller api fuction call
            $last_id = $this->stuller_data($api_id, $category, $sub_category, $minisubcategory, $minisubcategory2, $type, $finshed);
            if (!empty($include_series)) {
                $includeSeries = explode(",", $include_series);
                if (count($includeSeries) > 0) {
                    $last_id = $this->stuller_data($includeSeries, $category, $sub_category, $minisubcategory, $minisubcategory2, 2, $finshed, 0);
                }
                //    $last_id2= $this->include_serieswise($apis2, $category, $sub_category, $minisubcategory, $minisubcategory2, $type, $finshed);
            }
            if (!empty($include_sku)) {
                $includeSKU = explode(",", $include_sku);
                if (count($includeSKU) > 0) {
                    $last_id = $this->stuller_data($includeSKU, $category, $sub_category, $minisubcategory, $minisubcategory2, 3, $finshed, 0);
                }
                //    $last_id2= $this->include_serieswise($apis2, $category, $sub_category, $minisubcategory, $minisubcategory2, $type, $finshed);
            }
        } else {
            $rep = array(
                'status' => 201,
                'message' => 'Api Id not found'
            );

            echo json_encode($rep);
            exit;
        }


        if ($last_id != 0) {
            $data_insert = array(
                'status' => 2,
            );
            $this->db->where('id', $cron_jobs->id);
            $last_id = $this->db->update('tbl_cron_jobs', $data_insert);
            if (!empty($minisubcategory)) {
                if (empty($minisubcategory2)) {
                    $minisub = base64_encode($minisubcategory);
                    $page = base64_encode(1);
                    // $this->session->set_flashdata('smessage', 'Data inserted successfully');
                    // redirect("dcadmin/products/view_products/" . $minisub . "/" . $page, "refresh");
                    $rep = array(
                        'status' => 200,
                        'message' => 'Data inserted successfully'
                    );

                    echo json_encode($rep);
                    exit;
                } else {
                    $minisub2 = base64_encode($minisubcategory2);
                    $page = base64_encode(2);
                    $rep = array(
                        'status' => 200,
                        'message' => 'Data inserted successfully'
                    );

                    echo json_encode($rep);
                    exit;
                    // $this->session->set_flashdata('smessage', 'Data inserted successfully');
                    // redirect("dcadmin/products/view_products/" . $minisub2 . "/" . $page, "refresh");
                }
            } else {
                if (!empty($sub_category)) {
                    $sub = base64_encode($sub_category);
                    $page = base64_encode(0);
                    // $this->session->set_flashdata('smessage', 'Data inserted successfully');
                    // redirect("dcadmin/products/view_products/" . $sub . "/" . $page, "refresh");
                    $rep = array(
                        'status' => 200,
                        'message' => 'Data inserted successfully'
                    );

                    echo json_encode($rep);
                    exit;
                } else {
                    $cate = base64_encode($category);
                    $page = base64_encode(3);
                    // $this->session->set_flashdata('smessage', 'Data inserted successfully');
                    // redirect("dcadmin/products/view_products/" . $cate . "/" . $page, "refresh");
                    $rep = array(
                        'status' => 200,
                        'message' => 'Data inserted successfully'
                    );

                    echo json_encode($rep);
                    exit;
                }
            }
        } else {
            // $this->session->set_flashdata('emessage', 'Sorry error occured');
            // redirect($_SERVER['HTTP_REFERER']);
            $rep = array(
                'status' => 201,
                'message' => 'Sorry error occured'
            );

            echo json_encode($rep);
            exit;
        }
    }
    //==============product_cron job End======//
    //view category start
    public function view_cron_job()
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name'] = $this->load->get_var('user_name');
            // echo SITE_NAME;
            // echo $this->session->userdata('image');
            // echo $this->session->userdata('position');
            // exit;
            $this->db->select('*');
            $this->db->from('tbl_cron_jobs');
            $this->db->order_by('id', 'desc');
            $data['cron_jobs'] = $this->db->get();
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/products/view_cron_jobs');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    //view category end
}
