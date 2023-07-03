<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class QuickShops extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('user_agent');
		// $this->load->library('paypal_lib');
		$this->load->model("admin/login_model");
		$this->load->model("admin/base_model");
	}
	//get quickshop categories on header category quickshop option
	public function quickshops_category()
	{
		$this->db->select('*');
		$this->db->from('tbl_quickshop_category');
		$this->db->where('is_active', 1);
		$data['quickshop_cate_data'] = $this->db->get();
		$this->load->view('common/header', $data);
		$this->load->view('quickshop_category');
		$this->load->view('common/footer');
	}
	//get quickshop subcategories after clicking categories on header category quickshop option
	public function quickshops_subcategory($idd)
	{
		$id = base64_decode($idd);
		$data['quicksubcategory_id'] = $idd;
		//get category name
		$this->db->select('*');
		$this->db->from('tbl_quickshop_subcategory');
		$this->db->where('id', $id);
		$this->db->where('is_active', 1);
		$subcate_da = $this->db->get()->row();
		if (!empty($subcate_da)) {
			$category_id = $subcate_da->category;
			$quick_subcategory_name = $subcate_da->name;
			if (!empty($subcate_da->image)) {
				$quick_subcategory_iamge = base_url() . $subcate_da->image;
			} else {
				$quick_subcategory_iamge = "";
			}
			if (!empty($subcate_da->description)) {
				$quick_subcategory_desc = $subcate_da->description;
			} else {
				$quick_subcategory_desc = "";
			}
		} else {
			$category_id = "";
			$quick_subcategory_name = "";
			$quick_subcategory_iamge = "";
			$quick_subcategory_desc = "";
		}
		$data['quick_subcategory_name'] = $quick_subcategory_name;
		$data['quick_subcategory_iamge'] = $quick_subcategory_iamge;
		$data['quick_subcategory_description'] = $quick_subcategory_desc;
		//get category name
		$this->db->select('*');
		$this->db->from('tbl_quickshop_category');
		$this->db->where('id', $category_id);
		$this->db->where('is_active', 1);
		$cate_da = $this->db->get()->row();
		if (!empty($cate_da)) {
			$quick_category_name = $cate_da->name;
		} else {
			$quick_category_name = "";
		}
		$data['quick_category_name'] = $quick_category_name;
		//get minorsubcategory data , subcategory  wise
		$this->db->select('*');
		$this->db->from('tbl_quickshop_minisubcategory');
		$this->db->where('subcategory', $id);
		$this->db->where('is_active', 1);
		$data['quickshop_minorsubcate_data'] = $this->db->get();
		$this->load->view('common/header', $data);
		$this->load->view('quickshop_subcategory');
		$this->load->view('common/footer');
	}
	//get quickshop product detail page on header category quickshop option
	public function quickshops_product_detail($idd)
	{
		$data['page_t'] = 3; // 1 for quickshop product ,2 for new arrivals, 3 for normal products
		$data['page'] = 0;
		$id = $idd;
		// echo $id;
		// exit;
		$this->db->select('*');
		$this->db->from('tbl_quickshop_products');
		$this->db->where('sku', $id);
		// $this->db->where('is_active',1);
		$data['products'] = $this->db->get()->row();
		if (empty($data['products'])) {
			$this->session->set_flashdata('emessage', 'Product not found!');
			redirect("/", "refresh");
			die();
		}
		// echo($data['products']->category);	die();
		$cat_data = $this->db->get_where('tbl_quickshop_category', array('is_active' => 1, 'id' =>    $data['products']->category))->result();
		$data['cat_name'] = $cat_data[0]->name;
		$data['cat_id'] = $cat_data[0]->id;
		$subcat_data = $this->db->get_where('tbl_quickshop_subcategory', array('is_active' => 1, 'id' =>    $data['products']->sub_category))->result();
		if (!empty($subcat_data)) {
			$data['subcat_name'] = $subcat_data[0]->name;
			$data['subcat_id'] = $subcat_data[0]->id;
		} else {
			$data['subcat_name'] = '';
			$data['subcat_id'] = '';
		}
		// print_r($data);
		// exit;
		$this->db->select('*');
		$this->db->from('tbl_quickshop_products');
		$this->db->where('sku', $id);
		// $this->db->where('is_active',1);
		$d1 = $this->db->get()->row();
		// print_r($d1);
		$val_e = array(
			'desc_e_name1' => $d1->desc_e_name1,
			'desc_e_name2' => $d1->desc_e_name2,
			'desc_e_name3' => $d1->desc_e_name3,
			'desc_e_name4' => $d1->desc_e_name4,
			'desc_e_name5' => $d1->desc_e_name5,
			'desc_e_name6' => $d1->desc_e_name6,
			'desc_e_name7' => $d1->desc_e_name7,
			'desc_e_name8' => $d1->desc_e_name8,
			'desc_e_name9' => $d1->desc_e_name9,
			'desc_e_name10' => $d1->desc_e_name10,
			'desc_e_name11' => $d1->desc_e_name11,
			'desc_e_name12' => $d1->desc_e_name12,
			'desc_e_name13' => $d1->desc_e_name13,
			'desc_e_name14' => $d1->desc_e_name14,
			'desc_e_name15' => $d1->desc_e_name15,
		);
		$first = array_search('Stone Shape', $val_e);
		$deal = array_search('Center Stone Shape', $val_e);
		$breaker = array_search('Primary Stone Shape', $val_e);
		$eng = array_search('Eng. Ctr. Stone Shape', $val_e);
		$eng_center = array_search('Eng. Center Stone Shape', $val_e);
		if (!empty($first)) {
			$col = $first;
		} elseif (!empty($deal)) {
			$col = $deal;
		} elseif (!empty($breaker)) {
			$col = $breaker;
		} elseif (!empty($eng)) {
			$col = $eng;
		} else {
			$col = $eng_center;
		}
		// echo $col;die();
		if (empty($col)) {
			$s = "";
			$value = "";
		} else {
			$number = explode("desc_e_name", $col);
			$s = "desc_e_value" . $number[1];
			$value = $d1->$s;
		}
		// echo $s.$value;die();
		// echo $value;
		// die();
		$state = array_search('Jewelry State', $val_e);
		if (empty($state)) {
			$state_row = "";
			$state_value = "";
		} else {
			$state_no = explode("desc_e_name", $state);
			$state_row = "desc_e_value" . $state_no[1];
			$state_value = $d1->$state_row;
		}
		$eng_band_shank = array_search('Product', $val_e);
		if (empty($eng_band_shank)) {
			$eng_band_shank_row = "";
			$eng_band_shank_value = "";
		} else {
			$eng_band_shank_no = explode("desc_e_name", $eng_band_shank);
			$eng_band_shank_row = "desc_e_value" . $eng_band_shank_no[1];
			$eng_band_shank_value = $d1->$eng_band_shank_row;
		}
		// echo $state_row." ".$state_value;die();
		if (empty($value)) {
			$value = "";
		}
		$sub_id = $d1->sub_category;
		//   if(!empty($d1->sub_category)){
		// 	$sub_id=$d1->sub_category;
		// }else{
		//   $sub_id="";
		// }
		if (!empty($d1->minisub_category)) {
			$minorsub_id = $d1->minisub_category;
		} else {
			$minorsub_id = "";
		}
		if (!empty($d1->desc_e_value1)) {
			$row2 = 'desc_e_value1';
			$a1 = $d1->desc_e_value1;
		} else {
			$row2 = '';
			$a1 = "";
		}
		// print_r($a1);
		// die();
		// echo $row2;
		// echo $a1;die();
		// echo $s." ".$value;
		// echo $row2." ".$a1;
		// echo "sku_series"." ".$d1->sku_series;
		// echo $state_row." ".$state_value;
		// echo $state_value;
		// die();
		$this->db->select('*');
		$this->db->from('tbl_quickshop_products');
		$this->db->where('sku_series', $d1->sku_series);
		$this->db->where('gdesc', $d1->gdesc);
		// $this->db->where('category',$d1->category);
		if ($s !== "" || $value !== "") {
			$this->db->where($s, $value);
		}
		// $this->db->where($row2,$a1);
		if (!empty($state_value)) {
			$this->db->where($state_row, $state_value);
		}
		if (!empty($eng_band_shank_value)) {
			$this->db->where($eng_band_shank_row, $eng_band_shank_value);
		}
		$d2 = $this->db->get();
		// print_r($d2->row());die();
		$this->db->select('*');
		$this->db->from('tbl_quickshop_products');
		if ($s !== "" || $value !== "") {
			$this->db->where($s, $value);
		}
		$this->db->where($row2, $a1);
		// $this->db->where('is_active',1);
		$state_dropdown = $this->db->get();
		if (!empty($state_row)) {
			foreach ($state_dropdown->result() as $drop_state) {
				$state_array[] = $drop_state->$state_row;
			}
			if (!empty($state_array)) {
				$state_array = array_unique($state_array);
				sort($state_array);
			}
			$data['state_array'] = $state_array;
		}
		if (!empty($eng_band_shank_row)) {
			foreach ($state_dropdown->result() as $drop_state) {
				$eng_band_shank_array[] = $drop_state->$eng_band_shank_row;
			}
			if (!empty($eng_band_shank_array)) {
				$eng_band_shank_array = array_unique($eng_band_shank_array);
				sort($eng_band_shank_array);
			}
			$data['eng_band_shank_array'] = $eng_band_shank_array;
		}
		$data['b1'] = $d1->desc_e_name2;
		$data['b2'] = $d1->desc_e_name3;
		$data['b3'] = $d1->desc_e_name4;
		$data['b4'] = $d1->desc_e_name5;
		$data['b5'] = $d1->desc_e_name6;
		$data['b6'] = $d1->desc_e_name7;
		$data['b7'] = $d1->desc_e_name8;
		$data['b8'] = $d1->desc_e_name9;
		$data['b9'] = $d1->desc_e_name10;
		$data['b10'] = $d1->desc_e_name11;
		$i = 1;
		foreach ($d2->result() as $d3) {
			// print_r($d3->desc_e_value1);die();
			if ($d1->desc_e_value1 == $d3->desc_e_value1) {
				$c1[] = $d3->desc_e_value2;
			}
		}
		$i = 1;
		foreach ($d2->result() as $d3) {
			if ($d1->desc_e_value1 == $d3->desc_e_value1 && $d1->desc_e_value2 == $d3->desc_e_value2) {
				$c2[] = $d3->desc_e_value3;
			}
		}
		foreach ($d2->result() as $d3) {
			if ($d1->desc_e_value1 == $d3->desc_e_value1 && $d1->desc_e_value2 == $d3->desc_e_value2 && $d1->desc_e_value3 == $d3->desc_e_value3) {
				$c3[] = $d3->desc_e_value4;
			}
		}
		foreach ($d2->result() as $d3) {
			if ($d1->desc_e_value1 == $d3->desc_e_value1 && $d1->desc_e_value2 == $d3->desc_e_value2 && $d1->desc_e_value3 == $d3->desc_e_value3 && $d1->desc_e_value4 == $d3->desc_e_value4) {
				$c4[] = $d3->desc_e_value5;
			}
		}
		foreach ($d2->result() as $d3) {
			if ($d1->desc_e_value1 == $d3->desc_e_value1 && $d1->desc_e_value2 == $d3->desc_e_value2 && $d1->desc_e_value3 == $d3->desc_e_value3 && $d1->desc_e_value4 == $d3->desc_e_value4 && $d1->desc_e_value5 == $d3->desc_e_value5) {
				$c5[] = $d3->desc_e_value6;
			}
		}
		foreach ($d2->result() as $d3) {
			if ($d1->desc_e_value1 == $d3->desc_e_value1 && $d1->desc_e_value2 == $d3->desc_e_value2 && $d1->desc_e_value3 == $d3->desc_e_value3 && $d1->desc_e_value4 == $d3->desc_e_value4 && $d1->desc_e_value5 == $d3->desc_e_value5 && $d1->desc_e_value6 == $d3->desc_e_value6) {
				$c6[] = $d3->desc_e_value7;
			}
		}
		foreach ($d2->result() as $d3) {
			if ($d1->desc_e_value1 == $d3->desc_e_value1 && $d1->desc_e_value2 == $d3->desc_e_value2 && $d1->desc_e_value3 == $d3->desc_e_value3 && $d1->desc_e_value4 == $d3->desc_e_value4 && $d1->desc_e_value5 == $d3->desc_e_value5 && $d1->desc_e_value6 == $d3->desc_e_value6 && $d1->desc_e_value7 == $d3->desc_e_value7) {
				$c7[] = $d3->desc_e_value8;
			}
		}
		foreach ($d2->result() as $d3) {
			if ($d1->desc_e_value1 == $d3->desc_e_value1 && $d1->desc_e_value2 == $d3->desc_e_value2 && $d1->desc_e_value3 == $d3->desc_e_value3 && $d1->desc_e_value4 == $d3->desc_e_value4 && $d1->desc_e_value5 == $d3->desc_e_value5 && $d1->desc_e_value6 == $d3->desc_e_value6 && $d1->desc_e_value7 == $d3->desc_e_value7 && $d1->desc_e_value8 == $d3->desc_e_value8) {
				$c8[] = $d3->desc_e_value9;
			}
		}
		foreach ($d2->result() as $d3) {
			if ($d1->desc_e_value1 == $d3->desc_e_value1 && $d1->desc_e_value2 == $d3->desc_e_value2 && $d1->desc_e_value3 == $d3->desc_e_value3 && $d1->desc_e_value4 == $d3->desc_e_value4 && $d1->desc_e_value5 == $d3->desc_e_value5 && $d1->desc_e_value6 == $d3->desc_e_value6 && $d1->desc_e_value7 == $d3->desc_e_value7 && $d1->desc_e_value8 == $d3->desc_e_value8 && $d1->desc_e_value9 == $d3->desc_e_value9) {
				$c9[] = $d3->desc_e_value10;
			}
		}
		foreach ($d2->result() as $d3) {
			if ($d1->desc_e_value1 == $d3->desc_e_value1 && $d1->desc_e_value2 == $d3->desc_e_value2 && $d1->desc_e_value3 == $d3->desc_e_value3 && $d1->desc_e_value4 == $d3->desc_e_value4 && $d1->desc_e_value5 == $d3->desc_e_value5 && $d1->desc_e_value6 == $d3->desc_e_value6 && $d1->desc_e_value7 == $d3->desc_e_value7 && $d1->desc_e_value8 == $d3->desc_e_value8 && $d1->desc_e_value9 == $d3->desc_e_value9 && $d1->desc_e_value10 == $d3->desc_e_value11) {
				$c10[] = $d3->desc_e_value11;
			}
		}
		// print_r($c6);die();
		//---------------------------------------------------------------------------------
		$this->db->select('*');
		$this->db->from('tbl_quickshop_products');
		// $this->db->where($s,$value);
		// if($s ==""){
		// 	$this->db->where('sku_series_type1',$d1->sku_series_type1);
		// }
		$this->db->where($row2, $a1);
		$this->db->where('is_active', 1);
		$e41 = $this->db->get();
		// echo $row2.$a1;die();
		foreach ($e41->result() as $d31) {
			$data['b11'] = $d1->desc_e_name2;
			$data['b21'] = $d1->desc_e_name3;
			$data['b31'] = $d1->desc_e_name4;
			$data['b41'] = $d1->desc_e_name5;
			$data['b51'] = $d1->desc_e_name6;
			$data['b61'] = $d1->desc_e_name7;
			$data['b71'] = $d1->desc_e_name8;
			$data['b81'] = $d1->desc_e_name9;
			$data['b91'] = $d1->desc_e_name10;
			$data['b101'] = $d1->desc_e_name11;
			$c11[] = $d31->desc_e_value2;
			$c21[] = $d31->desc_e_value3;
			$c31[] = $d31->desc_e_value4;
			$c41[] = $d31->desc_e_value5;
			$c51[] = $d31->desc_e_value6;
			$c61[] = $d31->desc_e_value7;
			$c71[] = $d31->desc_e_value8;
			$c81[] = $d31->desc_e_value9;
			$c91[] = $d31->desc_e_value10;
			$c101[] = $d31->desc_e_value11;
		}
		if (!empty($c11)) {
			$j11 = array_unique($c11);
			sort($j11);
		} else {
			$j11 = "";
		}
		if (!empty($c21)) {
			$j21 = array_unique($c21);
			sort($j21);
		} else {
			$j21 = "";
		}
		if (!empty($c31)) {
			$j31 = array_unique($c31);
			sort($j31);
		} else {
			$j31 = "";
		}
		if (!empty($c41)) {
			$j41 = array_unique($c41);
			sort($j41);
		} else {
			$j41 = "";
		}
		if (!empty($c51)) {
			$j51 = array_unique($c51);
			sort($j51);
		} else {
			$j51 = "";
		}
		if (!empty($c61)) {
			$j61 = array_unique($c61);
			sort($j61);
		} else {
			$j61 = "";
		}
		if (!empty($c71)) {
			$j71 = array_unique($c71);
			sort($j71);
		} else {
			$j71 = "";
		}
		if (!empty($c81)) {
			$j81 = array_unique($c81);
			sort($j81);
		} else {
			$j81 = "";
		}
		if (!empty($c91)) {
			$j91 = array_unique($c91);
			sort($j91);
		} else {
			$j91 = "";
		}
		if (!empty($c101)) {
			$j101 = array_unique($c101);
			sort($j101);
		} else {
			$j101 = "";
		}
		$data['d11'] = $j11;
		$data['d21'] = $j21;
		$data['d31'] = $j31;
		$data['d41'] = $j41;
		$data['d51'] = $j51;
		$data['d61'] = $j61;
		$data['d71'] = $j71;
		$data['d81'] = $j81;
		$data['d91'] = $j91;
		$data['d101'] = $j101;
		//-------------------------------------------------------------------------------
		if (!empty($c1)) {
			$j1 = array_unique($c1);
			sort($j1);
		} else {
			$j1 = "";
		}
		if (!empty($c2)) {
			$j2 = array_unique($c2);
			sort($j2);
		} else {
			$j2 = "";
		}
		if (!empty($c3)) {
			$j3 = array_unique($c3);
			sort($j3);
		} else {
			$j3 = "";
		}
		if (!empty($c4)) {
			$j4 = array_unique($c4);
			sort($j4);
		} else {
			$j4 = "";
		}
		if (!empty($c5)) {
			$j5 = array_unique($c5);
			sort($j5);
		} else {
			$j5 = "";
		}
		if (!empty($c6)) {
			$j6 = array_unique($c6);
			sort($j6);
		} else {
			$j6 = "";
		}
		if (!empty($c7)) {
			$j7 = array_unique($c7);
			sort($j7);
		} else {
			$j7 = "";
		}
		if (!empty($c8)) {
			$j8 = array_unique($c8);
			sort($j8);
		} else {
			$j8 = "";
		}
		if (!empty($c9)) {
			$j9 = array_unique($c9);
			sort($j9);
		} else {
			$j9 = "";
		}
		if (!empty($c10)) {
			$j10 = array_unique($c10);
			sort($j10);
		} else {
			$j10 = "";
		}
		$data['d1'] = $j1;
		$data['d2'] = $j2;
		$data['d3'] = $j3;
		$data['d4'] = $j4;
		$data['d5'] = $j5;
		$data['d6'] = $j6;
		$data['d7'] = $j7;
		$data['d8'] = $j8;
		$data['d9'] = $j9;
		$data['d10'] = $j10;
		// print_r($j10);die();
		// more items to Consider
		$cat_id = $d1->category;
		$this->db->select('*');
		$this->db->from('tbl_quickshop_products');
		$this->db->where('category', $cat_id);
		$this->db->order_by('rand()');
		$more_to_cons = $this->db->limit(5000)->get();
		$product1 = [];
		if (!empty($more_to_cons)) {
			$i = 1;
			foreach ($more_to_cons->result() as $data1) {
				// print_r($data1);die();
				$a = 0;
				if (!empty($product1)) {
					foreach ($product1 as $value) {
						if ($data1->sku_series == $value['sku_series']) {
							$a = 1;
						}
					}
				}
				if ($a == 1) {
					continue;
				} else {
					$product1[] = array(
						'id' => $data1->id,
						'sku' => $data1->sku,
						'sku_series' => $data1->sku_series,
						'FullySetImage1' => $data1->FullySetImage1,
						'gimage1' => $data1->gimage1,
						'image2' => $data1->FullySetImage2,
						'description' => $data1->description,
						'price' => $data1->price,
						'currency' => $data1->currency
					);
				}
			}
		}
		$data['more'] = $product1;
		$this->db->select('*');
		$this->db->from('tbl_quickshop_products');
		// $this->db->where('category',$category);
		$this->db->order_by('rand()');
		$random = $this->db->limit(5000)->get();
		$p_random = [];
		if (!empty($random)) {
			$i = 1;
			foreach ($random->result() as $r_data) {
				// print_r($data1);die();
				$a = 0;
				if (!empty($p_random)) {
					foreach ($p_random as $value) {
						if ($r_data->sku_series == $value['sku_series']) {
							$a = 1;
						}
					}
				}
				if ($a == 1) {
					continue;
				} else {
					$p_random[] = array(
						'id' => $r_data->id,
						'sku' => $r_data->sku,
						'sku_series' => $r_data->sku_series,
						'FullySetImage1' => $r_data->FullySetImage1,
						'gimage1' => $r_data->gimage1,
						'image2' => $r_data->FullySetImage2,
						'description' => $r_data->description,
						'price' => $r_data->price,
						'currency' => $r_data->currency
					);
				}
			}
		}
		$data['random'] = $p_random;
		$this->load->view('common/header', $data);
		$this->load->view('product_detail');
		$this->load->view('common/footer');
	}
}
