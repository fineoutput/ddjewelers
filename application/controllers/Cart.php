<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cart extends CI_Controller{
function __construct()
		{
			parent::__construct();
			$this->load->model("admin/login_model");
			$this->load->model("admin/base_model");
		}




// check inventory before add to cart for frontend js functions

public function check_Inventory()
 {


	 $this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->helper('security');
		if($this->input->post())
		{


$product_id= $this->input->post('product_id');
$stuller_pro_id= $this->input->post('stuller_pro_id');
$type1= $this->input->post('type1');
$type2= $this->input->post('type2');
$type3= $this->input->post('type3');
$type4= $this->input->post('type4');

$b1= $this->input->post('b1');
$b2= $this->input->post('b2');
$b3= $this->input->post('b3');
$b4= $this->input->post('b4');

$quantity= $this->input->post('quantity');

$inventory= 0;
$status= "";

//get product sku start

if(empty($stuller_pro_id)){
	$this->db->select('*');
	$this->db->from('tbl_products');
	$this->db->where('id',$product_id);
	$this->db->where('is_active',1);
	$pro_da= $this->db->get()->row();
}else{
	$this->db->select('*');
	$this->db->from('tbl_quickshop_products');
	$this->db->where('product_id',$stuller_pro_id);
	$this->db->where('is_active',1);
	$pro_da= $this->db->get()->row();
}



if(!empty($pro_da)){
$sku= $pro_da->sku;
}else{
$sku= "";
$data['data'] = false;
$data['data_message'] = 'Invalid Product';

echo json_encode($data); exit;
}
//get product sku end


//Inventory Check api start

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.stuller.com/v2/products?SKU='.$sku,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Basic ZGV2amV3ZWw6Q29kaW5nMjA9',
    'Host: api.stuller.com',
    'Cookie: AWSALB=1Sg7jQ5WrUEnBoDmGaVnJorbqXXyK+dQqUw2GqaBRbmyB6wS6B3VR4K87ey+TZIJ5mvDqbTHnp6sD/1ka744OTa6umVGWUfMgFASSRnN0Qg1xRkh7tPLbCA3hfBh; AWSALBCORS=1Sg7jQ5WrUEnBoDmGaVnJorbqXXyK+dQqUw2GqaBRbmyB6wS6B3VR4K87ey+TZIJ5mvDqbTHnp6sD/1ka744OTa6umVGWUfMgFASSRnN0Qg1xRkh7tPLbCA3hfBh'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
// echo $response;
$response_dec= json_decode($response);
// print_r( $response_dec->Products);die();

if(!empty($response_dec->Products)){
  foreach ($response_dec->Products as $res) {
   $inventory= $res->OnHand;
   $status= $res->Status;
  }
}

// echo $status;
// echo $inventory;

// die();

//Inventory Check api end



// $this->db->select('*');
// $this->db->from('tbl_inventory');
// $this->db->where('product_id',$product_id);
// $this->db->where('product_type',$type_id);
// $pro_inv_da= $this->db->get()->row();

// $pro_inv_da= Inventory::wherenull('deleted_at')->where('product_id',$product_id)->where('color_id',$color_id)->first();

// print_r($pro_inv_da); die();

if(!empty($status) && $status !='Out Of Stock'){
  // $db_quantity=$pro_inv_da->inventory;
  $db_quantity= $inventory;

  if($status =='Made To Order'){

    $data['data'] = true;

  }else{

    if($db_quantity >= $quantity ){
          $data['data'] = true;
    }else{
      $data['data'] = false;
      $data['data_message'] = 'Product is out of stock';
    }

  }


}else{
  $data['data'] = false;
  $data['data_message'] = 'Product is out of stock';
}


}else{

 $data['data'] = false;
 $data['data_message'] = 'Please insert some data, No data available';

 }

echo json_encode($data);

}




//add to cart after login in the website using js

public function add_to_cart_online(){
  $this->load->helper(array('form', 'url'));
   $this->load->library('form_validation');
   $this->load->helper('security');
   if($this->input->post())
   {


       $product_id=$this->input->post('product_id');
       $stuller_pro_id=$this->input->post('stuller_pro_id');
       $user_id=$this->input->post('user_id');
       $quantity=$this->input->post('quantity');
       $ringsize=$this->input->post('ringsize');
       $ringprice=$this->input->post('ringprice');

       $type1= $this->input->post('type1');
       $type2= $this->input->post('type2');
       $type3= $this->input->post('type3');
       $type4= $this->input->post('type4');

       $b1= $this->input->post('b1');
       $b2= $this->input->post('b2');
       $b3= $this->input->post('b3');
       $b4= $this->input->post('b4');

date_default_timezone_set("Asia/Calcutta");
         $cur_date=date("Y-m-d H:i:s");


if(empty($stuller_pro_id)){
	$this->db->select('*');
	$this->db->from('tbl_products');
	$this->db->where('id',$product_id);
	$this->db->where('is_active',1);
	$pro_da= $this->db->get()->row();
}else{
	$this->db->select('*');
	$this->db->from('tbl_quickshop_products');
	$this->db->where('product_id',$stuller_pro_id);
	$this->db->where('is_active',1);
	$pro_da= $this->db->get()->row();
}

if(!empty($pro_da)){
  $sku= $pro_da->sku;
}else{
  $sku= "";
  $data['data'] = false;
  $data['data_message'] = 'Invalid Product';

   echo json_encode($data); exit;
}

     $inventory= 0;
     $status= "";

//Inventory Check api start

         $curl = curl_init();

         curl_setopt_array($curl, array(
           CURLOPT_URL => 'https://api.stuller.com/v2/products?SKU='.$sku,
           CURLOPT_RETURNTRANSFER => true,
           CURLOPT_ENCODING => '',
           CURLOPT_MAXREDIRS => 10,
           CURLOPT_TIMEOUT => 0,
           CURLOPT_FOLLOWLOCATION => true,
           CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
           CURLOPT_CUSTOMREQUEST => 'GET',
           CURLOPT_HTTPHEADER => array(
             'Authorization: Basic ZGV2amV3ZWw6Q29kaW5nMjA9',
             'Host: api.stuller.com',
             'Cookie: AWSALB=1Sg7jQ5WrUEnBoDmGaVnJorbqXXyK+dQqUw2GqaBRbmyB6wS6B3VR4K87ey+TZIJ5mvDqbTHnp6sD/1ka744OTa6umVGWUfMgFASSRnN0Qg1xRkh7tPLbCA3hfBh; AWSALBCORS=1Sg7jQ5WrUEnBoDmGaVnJorbqXXyK+dQqUw2GqaBRbmyB6wS6B3VR4K87ey+TZIJ5mvDqbTHnp6sD/1ka744OTa6umVGWUfMgFASSRnN0Qg1xRkh7tPLbCA3hfBh'
           ),
         ));

         $response = curl_exec($curl);

         curl_close($curl);
         // echo $response;
         $response_dec= json_decode($response);
         // print_r( $response_dec->Products);die();

         if(!empty($response_dec->Products)){
           foreach ($response_dec->Products as $res) {
            $inventory= $res->OnHand;
            $status= $res->Status;
           }
         }

         // echo $status;
         // echo $inventory;

         // die();

//Inventory Check api end


				 // $this->db->select('*');
				 // $this->db->from('tbl_inventory');
				 // $this->db->where('product_id',$product_id);
				 // $this->db->where('product_type',$type_id);
				 // $pro_inv_da= $this->db->get()->row();
         //
         //
				 if(!empty($status) && $status !='Out Of Stock'){
				   // $db_quantity=$pro_inv_da->inventory;
				   $db_quantity= $inventory;


           if($status =='Made To Order'){

if(empty($stuller_pro_id)){
		$this->db->select('*');
		$this->db->from('tbl_cart');
		$this->db->where('product_id',$product_id);
		$this->db->where('user_id',$user_id);
		$dsa= $this->db->get();
		$da=$dsa->row();
}else{
		$this->db->select('*');
		$this->db->from('tbl_cart');
		$this->db->where('product_id',$product_id);
		$this->db->where('stuller_pro_id',$stuller_pro_id);
		$this->db->where('user_id',$user_id);
		$dsa= $this->db->get();
		$da=$dsa->row();
}


              if(empty($da)){

                     $data_insert = array('product_id'=>$product_id,

                            'stuller_pro_id'=>$stuller_pro_id,
                            'user_id'=>$user_id,
                            'quantity' =>$quantity,
                             'desc_e_name2' =>$b1,
                             'desc_e_value2' =>$type1,
                             'desc_e_name3' =>$b2,
                             'desc_e_value3' =>$type2,
                             'desc_e_name4' =>$b3,
                             'desc_e_value4' =>$type3,
                             'desc_e_name5' =>$b4,
                             'desc_e_value5' =>$type4,
                             'ringsize' =>$ringsize,
                             'ringprice' =>$ringprice,
                             'date' =>$cur_date,


                            );





                  $last_id=$this->base_model->insert_table("tbl_cart",$data_insert,1) ;

                   $this->db->select('*');
                 $this->db->from('tbl_cart');
                 $this->db->where('user_id',$user_id);
                 $data['cartcount']= $this->db->count_all_results();

                  $data['data'] = true;
                  $data['product_id'] = $product_id;

                 }else{
                 $data['data'] = false;
                 $data['data_message'] = 'Item is already in your cart';
                 }



           }else{

                 if($db_quantity >= $quantity ){
                       // $data['data'] = true;



										 if(empty($stuller_pro_id)){
												$this->db->select('*');
												$this->db->from('tbl_cart');
												$this->db->where('product_id',$product_id);
												$this->db->where('user_id',$user_id);
												$dsa= $this->db->get();
												$da=$dsa->row();
										 }else{
										 		$this->db->select('*');
										 		$this->db->from('tbl_cart');
										 		$this->db->where('product_id',$product_id);
										 		$this->db->where('stuller_pro_id',$stuller_pro_id);
										 		$this->db->where('user_id',$user_id);
										 		$dsa= $this->db->get();
										 		$da=$dsa->row();
										 }


                    if(empty($da)){

                           $data_insert = array('product_id'=>$product_id,

													 				'stuller_pro_id'=>$stuller_pro_id,
                                  'user_id'=>$user_id,
                                  'quantity' =>$quantity,
                                  'desc_e_name2' =>$b1,
                                  'desc_e_value2' =>$type1,
                                  'desc_e_name3' =>$b2,
                                  'desc_e_value3' =>$type2,
                                  'desc_e_name4' =>$b3,
                                  'desc_e_value4' =>$type3,
                                  'desc_e_name5' =>$b4,
                                  'desc_e_value5' =>$type4,
                                  'date' =>$cur_date,


                                  );





                        $last_id=$this->base_model->insert_table("tbl_cart",$data_insert,1) ;

                         $this->db->select('*');
                       $this->db->from('tbl_cart');
                       $this->db->where('user_id',$user_id);
                       $data['cartcount']= $this->db->count_all_results();

                        $data['data'] = true;
                        $data['product_id'] = $product_id;

                       }else{
                       $data['data'] = false;
                       $data['data_message'] = 'Item is already in your cart';
                       }





                 }else{
                   $data['data'] = false;
                   $data['data_message'] = 'Product is out of stock';
                 }

           }




				 }else{
				   $data['data'] = false;
				   $data['data_message'] = 'Product is out of stock';
				 }





}else{

 $data['data'] = false;
 $data['data_message'] = 'Please insert some data, No data available';

 }
 echo json_encode($data);
}





//delete products from cart

public function delete_product($idd){

			 if(!empty($this->session->userdata('users_data'))){




				 // echo SITE_NAME;
				 // echo $this->session->userdata('image');
				 // echo $this->session->userdata('position');
				 // exit;
$id=base64_decode($idd);



		$this->db->select('id');
			$this->db->from('tbl_cart');
			$this->db->where('id',$id);
			$dsa= $this->db->get();
			$da=$dsa->row();

if(!empty($da)){

			$id=$da->id;

$zapak=$this->db->delete('tbl_cart', array('id' => $id));
if($zapak!=0){
//      $path = FCPATH . "assets/public/slider/".$id;
// unlink($path);
redirect("Cart/cart","refresh");
}
else
{
$this->session->set_flashdata('emessage','Sorry error occured');
		redirect($_SERVER['HTTP_REFERER']);
}


}else{
	$this->session->set_flashdata('emessage','Sorry error occured');
			redirect($_SERVER['HTTP_REFERER']);
}
						 }
						 else{

				 redirect("Home/login","refresh");

						 }

						 }




//update quantity in cart table after user login
						 public function update_qty_in_tbl_cart(){

			 $this->load->helper(array('form', 'url'));
				$this->load->library('form_validation');
				$this->load->helper('security');
				if($this->input->post())
				{

						 				 	$cart_id= $this->input->post('cart_id');
						 					$product_id= $this->input->post('product_id');
						 					$quantity= $this->input->post('quantity');
						 					// $user_id= $this->session->userdata('usersid');
						 					$user_id= 15;

						 					date_default_timezone_set("Asia/Calcutta");
						 					$cur_date=date("Y-m-d H:i:s");


      			$this->db->select('*');
$this->db->from('tbl_cart');
$this->db->where('id',$cart_id);
$cart_data= $this->db->get()->row();

// print_r($cart_data); die();
						 if(!empty($cart_data)){

						 	$data_update = array(
						 		'quantity'=> $quantity

						 	 );

							 $this->db->where('id', $cart_id);
 					      $last_id=$this->db->update('tbl_cart', $data_update);

								//total cart product count of user
								$this->db->select('*');
							$this->db->from('tbl_cart');
							$this->db->where('user_id',$user_id);
							$user_cart_count= $this->db->count_all_results();

							if($last_id !=0)	{

						 	  $data['data'] = true;
						 	  $data['cartcount'] = $user_cart_count;
							}else{
								$data['data'] = false;
								$data['cartcount'] = $user_cart_count;
							}

						 }else{

						 $data['data'] = false;

						 }

			 }else{

	 		 $data['data'] = false;
	 		 $data['data_message'] = 'Please insert some data, No data available';

	 		 }

						 echo json_encode($data);

						 	}



// check inventory before add to cart  for frontend js functions

			public function get_cart_pro_full_data()
			 {


	 $this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->helper('security');
		if($this->input->post())
		{

			$product_id= $this->input->post('product_id');
			$stuller_pro_id= $this->input->post('stuller_pro_id');
			$quantity= $this->input->post('quantity');

			$d1= $this->input->post('d1');
			$d2= $this->input->post('d2');
			$d3= $this->input->post('d3');
			$d4= $this->input->post('d4');

			$t1= $this->input->post('t1');
			$t2= $this->input->post('t2');
			$t3= $this->input->post('t3');
			$t4= $this->input->post('t4');

if(empty($stuller_pro_id)){
	$this->db->select('*');
$this->db->from('tbl_products');
$this->db->where('id',$product_id);
$this->db->where('is_active',1);
$product= $this->db->get()->row();
}else{
	$this->db->select('*');
$this->db->from('tbl_quickshop_products');
$this->db->where('product_id',$stuller_pro_id);
$this->db->where('is_active',1);
$product= $this->db->get()->row();
}




			if(!empty($product)){
			$product_id= $product->id;
			// $stuller_product_id= $product->product_id;
			$product_name= $product->description;
			$sku= $product->sku;
			$product_img1= $product->image1;
			$product_price= $product->price;
			$product_currency= $product->currency;

      $this->db->select('*');
      $this->db->from('tbl_price_rule');
      $pr_data= $this->db->get()->row();
      $multiplier= $pr_data->multiplier;
      $cost_price11= $pr_data->cost_price1;
      $cost_price22= $pr_data->cost_price2;
      $cost_price33= $pr_data->cost_price3;
      $cost_price44= $pr_data->cost_price4;
      $cost_price55= $pr_data->cost_price5;

        $cost_price = $product->price;
        $retail = $cost_price * $multiplier;
        $now_price = $cost_price;
        // echo $now_price;
        // exit;
if($cost_price<=500){
  $cost_price2=$cost_price*$cost_price;
  // $now_price= $cost_price*0.00000264018*($cost_price*2)+(-0.002220133*$cost_price)+1.950022201-1+0.95;
  $number= round($cost_price*($cost_price11*$cost_price2+$cost_price22*$cost_price+$cost_price33),2);
  $unit=5;
  $remainder = $number % $unit;
$mround = ($remainder < $unit / 2) ? $number - $remainder : $number + ($unit - $remainder);
$now_price = round($mround)-1+0.95;
// $now_price = round($mround);
  	$product_price= $now_price * $quantity;
  // exit;
}
if($cost_price>500){
  $number= round($cost_price*($cost_price44*$cost_price/$multiplier+$cost_price55));
  $unit=5;
  $remainder = $number % $unit;
$mround = ($remainder < $unit / 2) ? $number - $remainder : $number + ($unit - $remainder);
$now_price = round($mround)-1+0.95;
// $now_price = round($mround);
  $product_price= $now_price * $quantity;
}

			}else{
				$product_id= "";
				// $stuller_product_id= "";
				$product_name= "";
				$sku= "";
				$product_img1= "";
				$product_price= "";
				$product_currency= "";

			}



			// print_r($pro_inv_da); die();

			$data['data'] = true;
			$data['product_id'] = $product_id;
			$data['stuller_product_id'] = $stuller_pro_id;
			$data['product_name'] = $product_name;
			$data['sku'] = $sku;
			$data['product_img1'] = $product_img1;
			$data['product_price'] = number_format($product_price,2);
			$data['product_currency'] = $product_currency;
			$data['d1'] = $d1;
			$data['d2'] = $d2;
			$data['d3'] = $d3;
			$data['d4'] = $d4;
			$data['t1'] = $t1;
			$data['t2'] = $t2;
			$data['t3'] = $t3;
			$data['t4'] = $t4;
			$data['qnty'] = $quantity;


		}else{

 	 $data['data'] = false;
 	 $data['data_message'] = 'Please insert some data, No data available';

 	 }


			echo json_encode($data);

	}






	//check cart product data of localstorage (if deleted and zero inventories than remove autometicaly)

	public function check_localcart(){

		$data['data'] = '';
			$data['data_message'] = '';

$this->load->helper(array('form', 'url'));
$this->load->library('form_validation');
$this->load->helper('security');
if($this->input->post())
{



							 $cart_array[]=$this->input->post('cart_array');

							// print_r($cart_array);
							// exit;
							// $h = $cart_array[0][1];
							$h1 =  count($cart_array[0]);
					// print_r($h);
	// exit;
	// echo  $h1; exit;


	$ip = $this->input->ip_address();
date_default_timezone_set("Asia/Calcutta");
	$cur_date=date("Y-m-d H:i:s");


	$last_id = 0;
	$res=[];


	//local cart product
	for ($i=0; $i < $h1; $i++) {

		$v = $cart_array[0][$i];
		// print_r($v); exit;
		$product_id= $v['product_id'];
		$stuller_pro_id= $v['stuller_pro_id'];
		$quantity= $v['quantity'];


    $inventory= 0;
    $status= "";

    //get product sku start

if(empty($stuller_pro_id)){
	$this->db->select('*');
	$this->db->from('tbl_products');
	$this->db->where('id',$product_id);
	$this->db->where('is_active',1);
	$pro_da= $this->db->get()->row();
}else{
	$this->db->select('*');
	$this->db->from('tbl_quickshop_products');
	$this->db->where('product_id',$stuller_pro_id);
	$this->db->where('is_active',1);
	$pro_da= $this->db->get()->row();
}



    if(!empty($pro_da)){
    $sku= $pro_da->sku;
    }else{
    $sku= "";
    }
    //get product sku end


    //Inventory Check api start

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.stuller.com/v2/products?SKU='.$sku,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Basic ZGV2amV3ZWw6Q29kaW5nMjA9',
        'Host: api.stuller.com',
        'Cookie: AWSALB=1Sg7jQ5WrUEnBoDmGaVnJorbqXXyK+dQqUw2GqaBRbmyB6wS6B3VR4K87ey+TZIJ5mvDqbTHnp6sD/1ka744OTa6umVGWUfMgFASSRnN0Qg1xRkh7tPLbCA3hfBh; AWSALBCORS=1Sg7jQ5WrUEnBoDmGaVnJorbqXXyK+dQqUw2GqaBRbmyB6wS6B3VR4K87ey+TZIJ5mvDqbTHnp6sD/1ka744OTa6umVGWUfMgFASSRnN0Qg1xRkh7tPLbCA3hfBh'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    // echo $response;
    $response_dec= json_decode($response);
    // print_r( $response_dec->Products);die();

    if(!empty($response_dec->Products)){
      foreach ($response_dec->Products as $res) {
       $inventory= $res->OnHand;
       $status= $res->Status;
      }
    }

    // echo $status;
    // echo $inventory;

    // die();

    //Inventory Check api end

	// print_r($pro_inv_da); die();


      if(!empty($status) && $status !='Out Of Stock'){
        // $db_quantity=$pro_inv_da->inventory;
        $db_quantity= $inventory;

        if($status =='Made To Order'){



        }else{

          if($db_quantity >= $quantity ){


          }else{
            $user_id= $this->session->userdata('user_id');

if(empty($stuller_pro_id)){
                  $this->db->select('*');
      $this->db->from('tbl_cart');
      $this->db->where('product_id',$product_id);
      $this->db->where('user_id',$user_id);
      $cartdata= $this->db->get()->row();
}else{
			$this->db->select('*');
			$this->db->from('tbl_cart');
			$this->db->where('product_id',$product_id);
			$this->db->where('stuller_pro_id',$stuller_pro_id);
			$this->db->where('user_id',$user_id);
			$cartdata= $this->db->get()->row();
}

            if(!empty($cartdata)){

              $this->db->delete('tbl_cart', array('id' => $cartdata->id));

            }else{

            }


          $res[]= $product_id;

          }

        }



		}else{

			$user_id= $this->session->userdata('usersid');


		if(empty($stuller_pro_id)){
				$this->db->select('*');
				$this->db->from('tbl_cart');
				$this->db->where('product_id',$product_id);
				$this->db->where('user_id',$user_id);
				$cartdata= $this->db->get()->row();
		}else{
					$this->db->select('*');
					$this->db->from('tbl_cart');
					$this->db->where('product_id',$product_id);
					$this->db->where('stuller_pro_id',$stuller_pro_id);
					$this->db->where('user_id',$user_id);
					$cartdata= $this->db->get()->row();
		}


		 if(!empty($cartdata)){

			 $this->db->delete('tbl_cart', array('id' => $cartdata->id));

		 }else{

		 }

		$res[]= $product_id;

		}


//product check start

	if(empty($stuller_pro_id)){
				$this->db->select('*');
		$this->db->from('tbl_products');
		$this->db->where('id',$product_id);
		$this->db->where('is_active',1);
		$product_data_dsa= $this->db->get()->row();
	}else{
		$this->db->select('*');
		$this->db->from('tbl_quickshop_products');
		$this->db->where('product_id',$stuller_pro_id);
		$this->db->where('is_active',1);
		$product_data_dsa= $this->db->get()->row();
	}


	        if(!empty($product_data_dsa)){

	        }else{
						$user_id= $this->session->userdata('usersid');

						if(empty($stuller_pro_id)){
				 				$this->db->select('*');
				 				$this->db->from('tbl_cart');
				 				$this->db->where('product_id',$product_id);
				 				$this->db->where('user_id',$user_id);
				 				$cartdata= $this->db->get()->row();
				 		}else{
				 					$this->db->select('*');
				 					$this->db->from('tbl_cart');
				 					$this->db->where('product_id',$product_id);
				 					$this->db->where('stuller_pro_id',$stuller_pro_id);
				 					$this->db->where('user_id',$user_id);
				 					$cartdata= $this->db->get()->row();
				 		}



			 		 if(!empty($cartdata)){

			 			 $this->db->delete('tbl_cart', array('id' => $cartdata->id));

			 		 }else{

			 		 }


	        $res[]= $product_id;




	        }
//product check ends





	}





}else{

// $data['data'] = false;
// $data['data_message'] = 'Please insert some data, No data available';

$res=[];

}

	echo json_encode($res);
		exit;



	}






	//check cart product data of Tbl_cart  (if deleted and zero inventories than remove autometicaly)

	public function check_localcart_frm_tbl(){

		$data['data'] = '';
			$data['data_message'] = '';

$this->load->helper(array('form', 'url'));
$this->load->library('form_validation');
$this->load->helper('security');
if($this->input->post())
{



		  $user_ids =$this->input->post('user_id');

			$ip = $this->input->ip_address();
		date_default_timezone_set("Asia/Calcutta");
			$cur_date=date("Y-m-d H:i:s");



	//cart table data delete if product out of stock or deleted
	// $user_id= $req->session()->get('user_id');


      			$this->db->select('*');
$this->db->from('tbl_cart');
$this->db->where('user_id',$user_ids);
$carttdata= $this->db->get();


	// print_r($carttdata); exit;
	if(!empty($carttdata)){
	foreach ($carttdata->result() as $cartt) {

$product_id= $cartt->product_id;
$stuller_pro_id= $cartt->stuller_pro_id;
$quantity= $cartt->quantity;

        $inventory= 0;
        $status= "";

        //get product sku start


				if(empty($stuller_pro_id)){
					$this->db->select('*');
					$this->db->from('tbl_products');
					$this->db->where('id',$product_id);
					$this->db->where('is_active',1);
					$pro_da= $this->db->get()->row();
				}else{
					$this->db->select('*');
					$this->db->from('tbl_quickshop_products');
					$this->db->where('product_id',$stuller_pro_id);
					$this->db->where('is_active',1);
					$pro_da= $this->db->get()->row();
				}


        if(!empty($pro_da)){
        $sku= $pro_da->sku;
        }else{
        $sku= "";
        }
        //get product sku end


        //Inventory Check api start

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.stuller.com/v2/products?SKU='.$sku,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'Authorization: Basic ZGV2amV3ZWw6Q29kaW5nMjA9',
            'Host: api.stuller.com',
            'Cookie: AWSALB=1Sg7jQ5WrUEnBoDmGaVnJorbqXXyK+dQqUw2GqaBRbmyB6wS6B3VR4K87ey+TZIJ5mvDqbTHnp6sD/1ka744OTa6umVGWUfMgFASSRnN0Qg1xRkh7tPLbCA3hfBh; AWSALBCORS=1Sg7jQ5WrUEnBoDmGaVnJorbqXXyK+dQqUw2GqaBRbmyB6wS6B3VR4K87ey+TZIJ5mvDqbTHnp6sD/1ka744OTa6umVGWUfMgFASSRnN0Qg1xRkh7tPLbCA3hfBh'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // echo $response;
        $response_dec= json_decode($response);
        // print_r( $response_dec->Products);die();

        if(!empty($response_dec->Products)){
          foreach ($response_dec->Products as $res) {
           $inventory= $res->OnHand;
           $status= $res->Status;
          }
        }

        // echo $status;
        // echo $inventory;

        // die();

        //Inventory Check api end




        if(!empty($status) && $status !='Out Of Stock'){
          // $db_quantity=$pro_inv_da->inventory;
          $db_quantity= $inventory;

          if($status =='Made To Order'){



          }else{

            if($db_quantity >= $quantity ){


            }else{

              $this->db->delete('tbl_cart', array('id' => $cartt->id));

            }

          }



  		}else{

  		$this->db->delete('tbl_cart', array('id' => $cartt->id));

  		}



		// if(!empty($pro_inv_da)){
		//   $db_quantity=$pro_inv_da->inventory;
		//
		//     if($quantity <= $db_quantity){
		//
		//
		// 		}else{
		// 				$this->db->delete('tbl_cart', array('id' => $cartt->id));
		// 		}
		// 	}else{
		// 		$this->db->delete('tbl_cart', array('id' => $cartt->id));
		// 	}

//inventory check end




//product check start



if(empty($stuller_pro_id)){
	$this->db->select('*');
$this->db->from('tbl_products');
$this->db->where('id',$cartt->product_id);
$this->db->where('is_active',1);
$product_data_dsa= $this->db->get()->row();
}else{
	$this->db->select('*');
$this->db->from('tbl_quickshop_products');
$this->db->where('product_id',$cartt->stuller_pro_id);
$this->db->where('is_active',1);
$product_data_dsa= $this->db->get()->row();
}

if(!empty($product_data_dsa)){

}else{

	$this->db->delete('tbl_cart', array('id' => $cartt->id));

}

//product check end





	 }
	}


}else{
	$res= 0;
}

	$res= 9;

				echo json_encode($res);
					exit;






	}

	//--------wishlist---------
	public function wishlist()
	{
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->load->helper('security');
			if ($this->input->post()) {
					$this->form_validation->set_rules('product_id', 'product_id', 'required|xss_clean|trim');
					$this->form_validation->set_rules('user_id', 'user_id', 'required|xss_clean|trim');
					$this->form_validation->set_rules('status', 'status', 'required|xss_clean|trim');
					$this->form_validation->set_rules('ringsize', 'ringsize', 'xss_clean|trim');
					$this->form_validation->set_rules('ringprice', 'ringprice', 'xss_clean|trim');


					if ($this->form_validation->run()== true) {
							$product_id=$this->input->post('product_id');
							$user_id=$this->input->post('user_id');
							$status=$this->input->post('status');
							$ringsize=$this->input->post('ringsize');
							$ringprice=$this->input->post('ringprice');
							$ip = $this->input->ip_address();
							date_default_timezone_set("Asia/Calcutta");
							$cur_date=date("Y-m-d H:i:s");
							$this->db->select('*');
							$this->db->from('tbl_wishlist');
							$this->db->where('user_id', $user_id);
							$this->db->where('product_id', $product_id);
							$wishcheck= $this->db->get()->row();
							// print_r($wishcheck);die();
							// echo $product_id;die();

							//----------add to wishlist----
							if ($status=="add") {
									if (empty($wishcheck)) {
											$data_insert = array('user_id'=>$user_id,
													'product_id'=>$product_id,
													'ringsize'=>$ringsize,
													'ringprice'=>$ringprice,
													'ip' =>$ip,
													'date'=>$cur_date
													);

											$last_id=$this->base_model->insert_table("tbl_wishlist", $data_insert, 1) ;

											if (!empty($last_id)) {
													$respone['data'] = true;
													$respone['data_message'] ='Item successfully added in your wishlist';
													$respone['button_message'] ='REMOVE FROM WISHLIST';
													echo json_encode($respone);
											} else {
													$respone['data'] = false;
													$respone['data_message'] ='Some error occured';
													echo json_encode($respone);
											}
									} else {
											$respone['data'] = false;
											$respone['data_message'] ='Already in your wishlist';
											echo json_encode($respone);
									}
							}
							//---------remove wishlist---------
							elseif ($status=="remove") {
									$delete=$this->db->delete('tbl_wishlist', array('user_id' => $user_id,'product_id'=>$product_id));
									if (!empty($delete)) {
											$respone['data'] = true;
											$respone['data_message'] ='Item successfully deleted from your wishlist';
											echo json_encode($respone);
									} else {
											$respone['data'] = false;
											$respone['data_message'] ='Some error occured';
											echo json_encode($respone);
									}
							}
							//---------move to cart--------
							elseif ($status=="move") {
								$this->db->select('*');
								$this->db->from('tbl_cart');
								$this->db->where('user_id',$user_id);
								$this->db->where('product_id',$wishcheck->product_id);
								$wish_check= $this->db->get()->row();
								if(empty($wish_check)){
									$cart_insert = array('user_id'=>$user_id,
												'product_id'=>$wishcheck->product_id,
												'ringsize'=>$wishcheck->ringsize,
												'ringprice'=>$wishcheck->ringprice,
												'quantity'=>1,
												// 'ip' =>$ip,
												'date'=>$cur_date
												);

									$cart_id=$this->base_model->insert_table("tbl_cart", $cart_insert, 1) ;
									if (!empty($cart_id)) {
											$delete=$this->db->delete('tbl_wishlist', array('user_id' => $user_id,'product_id'=>$product_id));
											$respone['data'] = true;
											$respone['data_message'] ='Item successfully moved to your cart';
											echo json_encode($respone);
									} else {
											$respone['data'] = false;
											$respone['data_message'] ='Some error occured';
											echo json_encode($respone);
									}
							}else{
								$respone['data'] = false;
								$respone['data_message'] ='Product is already in your cart';
								echo json_encode($respone);
							}
						}
					} else {
							$respone['data'] = false;
							$respone['data_message'] =validation_errors();
							echo json_encode($respone);
					}
			} else {
					$respone['data'] = false;
					$respone['data_message'] ="Please insert some data, No data available";
					echo json_encode($respone);
			}
	}






}
