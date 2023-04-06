<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class QuickShops extends CI_Controller{
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
		$this->db->where('is_active',1);
		$data['quickshop_cate_data']= $this->db->get();


			$this->load->view('common/header',$data);
			$this->load->view('quickshop_category');
			$this->load->view('common/footer');

	}


//get quickshop subcategories after clicking categories on header category quickshop option

  public function quickshops_subcategory($idd)
  	{

  $id= base64_decode($idd);
  $data['quicksubcategory_id']= $idd;

//get category name
            $this->db->select('*');
$this->db->from('tbl_quickshop_subcategory');
$this->db->where('id',$id);
$this->db->where('is_active',1);
$subcate_da= $this->db->get()->row();

if(!empty($subcate_da)){
  $category_id= $subcate_da->category;
  $quick_subcategory_name= $subcate_da->name;

  if(!empty($subcate_da->image)){
    $quick_subcategory_iamge= base_url().$subcate_da->image;
  }else{
    $quick_subcategory_iamge="";
  }

  if(!empty($subcate_da->description)){
    $quick_subcategory_desc= $subcate_da->description;
  }else{
    $quick_subcategory_desc="";
  }

}else{
  $category_id="";
  $quick_subcategory_name="";
  $quick_subcategory_iamge="";
  $quick_subcategory_desc="";
}

$data['quick_subcategory_name']= $quick_subcategory_name;
$data['quick_subcategory_iamge']= $quick_subcategory_iamge;
$data['quick_subcategory_description']= $quick_subcategory_desc;



//get category name
            $this->db->select('*');
$this->db->from('tbl_quickshop_category');
$this->db->where('id',$category_id);
$this->db->where('is_active',1);
$cate_da= $this->db->get()->row();

if(!empty($cate_da)){

$quick_category_name= $cate_da->name;

}else{
	$quick_category_name="";
}

$data['quick_category_name']= $quick_category_name;


//get minorsubcategory data , subcategory  wise
  		$this->db->select('*');
  		$this->db->from('tbl_quickshop_minisubcategory');
  		$this->db->where('subcategory', $id);
  		$this->db->where('is_active',1);
  		$data['quickshop_minorsubcate_data']= $this->db->get();


  			$this->load->view('common/header',$data);
  			$this->load->view('quickshop_subcategory');
  			$this->load->view('common/footer');

  	}




//get quickshop product detail page on header category quickshop option

		public function quickshops_product_detail($idd)
			{
				$data['page_t']= 1; // 1 for quickshop product ,2 for new arrivals, 3 for normal products


				$data['page']= 1;
				$id= base64_decode($idd);
				// echo $id;
				// exit;
					$this->db->select('*');
					$this->db->from('tbl_quickshop_products');
					$this->db->where('product_id',$id);
					$this->db->where('is_active',1);
					$data['products']= $this->db->get()->row();


					$this->db->select('*');
					$this->db->from('tbl_quickshop_products');
					$this->db->where('product_id',$id);
					$d1= $this->db->get()->row();

					$sub_id=$d1->sub_category;
					$a1=$d1->desc_e_value1;


				$this->db->select('*');
				$this->db->from('tbl_quickshop_products');
				$this->db->where('desc_e_value1',$a1);
				$d2= $this->db->get();

		 $i=1; foreach($d2->result() as $d3) {

		$data['b1']=$d1->desc_e_name2;
		$data['b2']=$d1->desc_e_name3;
		$data['b3']=$d1->desc_e_name4;
		$data['b4']=$d1->desc_e_name5;
		$data['b5']=$d1->desc_e_name6;
		$data['b6']=$d1->desc_e_name7;
		$data['b7']=$d1->desc_e_name8;
		$data['b8']=$d1->desc_e_name9;
		$data['b9']=$d1->desc_e_name10;
		$data['b10']=$d1->desc_e_name11;

		$c1[]=$d3->desc_e_value2;
		$c2[]=$d3->desc_e_value3;
		$c3[]=$d3->desc_e_value4;
		$c4[]=$d3	->desc_e_value5;
		$c5[]=$d3	->desc_e_value6;
		$c6[]=$d3	->desc_e_value7;
		$c7[]=$d3	->desc_e_value8;
		$c8[]=$d3	->desc_e_value9;
		$c9[]=$d3	->desc_e_value10;
		$c10[]=$d3	->desc_e_value11;




		}

		$data['d1']=array_unique($c1);
		$data['d2']=array_unique($c2);
		$data['d3']=array_unique($c3);
		$data['d4']=array_unique($c4);
		$data['d5']=array_unique($c5);
		$data['d6']=array_unique($c6);
		$data['d7']=array_unique($c7);
		$data['d8']=array_unique($c8);
		$data['d9']=array_unique($c9);
		$data['d10']=array_unique($c10);


		// print_r($d1);
		// exit;

								//
		      			// $this->db->select('*');
								// $this->db->from('tbl_types');
								// $this->db->where('product',$id);
								// $data['types']= $this->db->get();



		//get related products(Shoppers Also Bought)

		// if(!empty($minorsub_id)){
		// 	$this->db->select('*');
		// 	$this->db->from('tbl_products');
		// 	$this->db->where('minisub_category',$minorsub_id);
		// 	$this->db->where('is_active',1);
		// 	$this->db->order_by('id','DESC');
		// 	$data['ralated_products']= $this->db->limit(100)->get();
		// }else {
			$this->db->select('*');
			$this->db->from('tbl_quickshop_products');
			$this->db->where('sub_category',$sub_id);
			$this->db->where('is_active',1);
			$this->db->order_by('id','DESC');
			$data['ralated_products']= $this->db->limit(30)->get();
		// }



		//get trendings products(Popular Products)

		// if(!empty($minorsub_id)){
		// 	$this->db->select('*');
		// 	$this->db->from('tbl_products');
		// 	$this->db->where('minisub_category',$minorsub_id);
		// 	$this->db->where('is_active',1);
		// 	$this->db->order_by('id', 'RANDOM');
		// 	$data['trending_products']= $this->db->limit(100)->get();
		// }else {
		// 	$this->db->select('*');
		// 	$this->db->from('tbl_products');
		// 	$this->db->where('sub_category',$sub_category);
		// 	$this->db->where('is_active',1);
		// 	$this->db->order_by('id', 'RANDOM');
		// 	$data['trending_products']= $this->db->limit(100)->get();
		// }



					$this->load->view('common/header',$data);
					$this->load->view('product_detail');
					$this->load->view('common/footer');

			}




}
