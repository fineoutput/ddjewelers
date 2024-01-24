<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('user_agent');
        // $this->load->library('paypal_lib');
        $this->load->model("admin/login_model");
        $this->load->model("admin/base_model");
        $this->load->library("pagination");
    }
    // 	function  __construct() {
    // 		parent::__construct();
    // 		$this->load->library('paypal_lib');
    // 		$this->load->model('product');
    // 		$this->load->database();
    // }
    //paypal integration methods starts
    // checkout page
    // public function charge($am,$idd) {
    //
    //   $id= base64_decode($idd);
    //   $amu= base64_decode($am);
    // 	 $data['title'] = 'Checkout payment | TechArise';
    // 	 // $this->site->setProductID($id);
    // 	 $data['order_id'] =  $id;
    // 	 $data['amn'] =  $amu;
    // 	 $data['return_url'] = site_url().'Home/callback/'.$idd;
    // 	 $data['surl'] = site_url().'Home/order_success';;
    // 	 $data['furl'] = site_url().'Home/order_failed';;
    // 	 $data['currency_code'] = 'USD';
    // 	 // $this->load->view('paypal/checkout', $data);
    //
    // 	 $this->load->view('common/header',$data);
    // 	 $this->load->view('confirmation');
    // 	 $this->load->view('common/footer');
    // }
    // success method for order place paypal
    public function callback($idd)
    {
        $order_id = base64_decode($idd);
        $user_id = $this->session->userdata('user_id');
        $para = $this->input->get();
        $datas['title'] = 'Paypal Success | TechArise';
        $paymentID = $para['paymentID'];
        $payerID = $para['payerID'];
        $token = $para['token'];
        $pid = $para['pid'];
        // echo $pid;die();
        if (!empty($paymentID) && !empty($payerID) && !empty($token)) {
            // $data['paymentID'] = $paymentID;
            // $data['payerID'] = $payerID;
            // $data['token'] = $token;
            // $data['pid'] = $pid;
            // $this->load->view('paypal/success', $data);
            $data['txn_id']    = $token;
            $data['payment_id'] = $paymentID;
            $data['payer_id'] = $payerID;
            // $data['payment_gross'] = $paypalInfo["mc_gross"];
            $data['currency_code'] = 'USD';
            // $data['payer_email'] = $paypalInfo["payer_email"];
            $data['online_payment_status']    = 'success';
            $data['payment_status']    = 1;
            $data['order_status']    = 1;
            $data['payment_type']    = 'Paypal';
            // $order1_da = Order1::wherenull('deleted_at')->where('id', $order_id)->first();
            // $order1_da->update($data);
            $this->db->where('id', $order_id);
            $zapak = $this->db->update('tbl_order1', $data);
            //delete Tbl Cart data of user
            // if($page != 0){
            // 			$this->db->select('*');
            // 			$this->db->from('tbl_cart');
            // 			$this->db->where('user_id',$user_id);
            // 			$this->db->where('product_id',$page);
            // 			$cart_dat= $this->db->get();
            // }else {
            $this->db->select('*');
            $this->db->from('tbl_cart');
            $this->db->where('user_id', $user_id);
            $cart_dat = $this->db->get();
            // }
            if (!empty($cart_dat)) {
                foreach ($cart_dat->result() as $cart) {
                    $del_cart = $this->db->delete('tbl_cart', array('id' => $cart->id));
                }
            }
            //------------User Sent Email Start--------------//
            $config = array(
                'protocol' => 'smtp',
                'smtp_host' => SMTP_HOST,
                'smtp_port' => SMTP_PORT,
                'smtp_user' => USER_NAME, // change it to yours
                'smtp_pass' => PASSWORD, // change it to yours
                'mailtype' => 'html',
                'charset' => 'iso-8859-1',
                'wordwrap' => true
            );
            $this->db->select('*');
            $this->db->from('tbl_order1');
            $this->db->where('id', $order_id);
            $order1 = $this->db->get()->row();
            $this->db->select('*');
            $this->db->from('tbl_users');
            $this->db->where('id', $order1->user_id);
            $user = $this->db->get()->row();
            if (!empty($user->email)) {
                $to = $user->email;
                $name = $user->name;
                $data['name'] = $name;
                $data['order1_id'] = $order_id;
                $data['order1_data'] = $order1;
                $message = $this->load->view('email', $data, TRUE);
                //  print_r($message);
                // exit;
                $this->load->library('email', $config);
                $this->email->set_newline("");
                $this->email->from(EMAIL, EMAIL_NAME); // change it to yours
                $this->email->to($to); // change it to yours
                $this->email->subject('Order Placed');
                $this->email->message($message);
                if ($this->email->send()) {
                } else {
                    // show_error($this->email->print_debugger());
                }
            }
            //------------User Sent Email End--------------//
            //------------sent email to admin--------------//
            $this->load->library('email', $config);
            $this->email->set_newline("");
            $this->email->from(EMAIL, EMAIL_NAME); // change it to yours
            // $this->email->to('jewelplus@gmail.com');  // change it to yours
            $this->email->to('office.fineoutput@gmail.com');  // change it to yours
            $this->email->subject('New order received');
            $this->email->message($message);
            if ($this->email->send()) {
            } else {
                // show_error($this->email->print_debugger());
            }
            //------------sent email to admin End--------------//
            redirect("Home/order_success", "refresh");
        } else {
            redirect('Home/order_failed', "refresh");
        }
    }
    // function charge($am,$idd){
    //
    // 	$amu= base64_decode($am);
    // 	$order_id= base64_decode($idd);
    // 		//Set variables for paypal form
    // 		$returnURL = base_url().'Home/payment_success/'.$idd; //payment success url
    // 		$failURL = base_url().'Home/order_failed'; //payment fail url
    // 		$notifyURL = base_url().'paypal/ipn'; //ipn url
    // 		//get particular product data
    // 		$product_name= 'ddJewellery';
    // 		$product_number= 1;
    // 		$userID = $this->session->userdata('user_id'); //current user id
    // 		$logo = base_url().'assets/frontend/logo.png';
    //
    // 		$this->paypal_lib->add_field('return', $returnURL);
    // 		$this->paypal_lib->add_field('fail_return', $failURL);
    // 		$this->paypal_lib->add_field('notify_url', $notifyURL);
    // 		$this->paypal_lib->add_field('item_name', $product_name);
    // 		$this->paypal_lib->add_field('custom', $userID);
    // 		$this->paypal_lib->add_field('item_number',  $product_number);
    // 		$this->paypal_lib->add_field('amount',  $amu);
    // 		$this->paypal_lib->image($logo);
    //
    // 		$this->paypal_lib->paypal_auto_form();
    // }
    // public function payment_success($idd){
    //
    // 	$order_id= base64_decode($idd);
    // $user_id = $this->session->userdata('user_id');
    // 	//get the transaction data
    // // $paypalInfoTrans = $this->input->get();
    // //
    // // print_r($paypalInfoTrans);
    // //
    // // $data['item_number'] = $paypalInfoTrans['item_number'];
    // // $data['txn_id'] = $paypalInfoTrans["tx"];
    // // $data['payment_amt'] = $paypalInfoTrans["amt"];
    // // $data['currency_code'] = $paypalInfoTrans["cc"];
    // // $data['status'] = $paypalInfoTrans["st"];
    //
    //
    // //paypal return transaction details array
    //  $paypalInfo    = $this->input->post();
    //
    //
    //  $data['txn_id']    = $paypalInfo["txn_id"];
    //  $data['payment_gross'] = $paypalInfo["mc_gross"];
    //  $data['currency_code'] = $paypalInfo["mc_currency"];
    //  $data['payer_email'] = $paypalInfo["payer_email"];
    //  $data['online_payment_status']    = $paypalInfo["payment_status"];
    //  $data['payment_status']    = 1;
    //  $data['order_status']    = 1;
    //
    //
    //  $paypalURL = $this->paypal_lib->paypal_url;
    //  $result    = $this->paypal_lib->curlPost($paypalURL,$paypalInfo);
    //
    //  //check whether the payment is verified
    //  if(preg_match("/VERIFIED/i",$result)){
    // 		 //insert the transaction data into the database
    //
    // 		 $order1_da = Order1::wherenull('deleted_at')->where('id', $order_id)->first();
    // 		 $order1_da->update($data);
    //
    //
    //
    //
    // 		 //delete Tbl Cart data of user
    //
    // 		 // if($page != 0){
    // 		 // 			$this->db->select('*');
    // 		 // 			$this->db->from('tbl_cart');
    // 		 // 			$this->db->where('user_id',$user_id);
    // 		 // 			$this->db->where('product_id',$page);
    // 		 // 			$cart_dat= $this->db->get();
    // 		 // }else {
    // 		 $this->db->select('*');
    // 		 			$this->db->from('tbl_cart');
    // 		 			$this->db->where('user_id',$user_id);
    // 		 			$cart_dat= $this->db->get();
    // 		 // }
    //
    //
    // 		 if(!empty($cart_dat)){
    // 		 foreach ($cart_dat->result() as $cart) {
    //
    // 		 $del_cart=$this->db->delete('tbl_cart', array('id' => $cart->id));
    //
    // 		 }
    // 		 }
    //
    //
    //
    // 		 //send email to user's email start
    // 		 //
    // 		 // $config = Array(
    // 		 // 							'protocol' => 'smtp',
    // 		 // 							// 'smtp_host' => 'mail.fineoutput.co.in',
    // 		 // 							'smtp_host' => SMTP_HOST,
    // 		 // 							'smtp_port' => 26,
    // 		 // 							// 'smtp_user' => 'info@fineoutput.co.in', // change it to yours
    // 		 // 							// 'smtp_pass' => 'info@fineoutput2019', // change it to yours
    // 		 // 							'smtp_user' => USER_NAME, // change it to yours
    // 		 // 							'smtp_pass' => PASSWORD, // change it to yours
    // 		 // 							'mailtype' => 'html',
    // 		 // 							'charset' => 'iso-8859-1',
    // 		 // 							'wordwrap' => TRUE
    // 		 // 							);
    // 		 //
    // 		 // 							$this->db->select('*');
    // 		 // 										$this->db->from('tbl_users');
    // 		 // 										$this->db->where('id',$user_id);
    // 		 // 										$user_data= $this->db->get()->row();
    // 		 // 					$email = '';
    // 		 // 										if(!empty($user_data)){
    // 		 // 											$email =  $user_data->email;
    // 		 // 										}
    // 		 //
    // 		 // 							$to=$email;
    // 		 //
    // 		 // 							$email_data = array("order1_id"=>$last_order_id, "type"=>"1"
    // 		 // 							);
    // 		 //
    // 		 // 							$message = 	$this->load->view('emails/order-success',$email_data,TRUE);
    // 		 // 							// $message = 	"HELLO";
    // 		 // 							$this->load->library('email', $config);
    // 		 // 							$this->email->set_newline("");
    // 		 // 							// $this->email->from('info@fineoutput.co.in'); // change it to yours
    // 		 // 							$this->email->from(EMAIL); // change it to yours
    // 		 // 							$this->email->to($to);// change it to yours
    // 		 // 							$this->email->subject('Order Placed Successfully');
    // 		 // 							$this->email->message($message);
    // 		 // 							if($this->email->send()){
    // 		 // 							//  echo 'Email sent.';
    // 		 // 							}else{
    // 		 // 							// show_error($this->email->print_debugger());
    // 		 // 							}
    //
    // 		 //send email to user's email end
    //
    //  redirect("Home/order_success","refresh");
    //
    //  }
    //
    //
    // 						}
    //paypal integration methods end
    public function index()
    {
        $this->db->select('*');
        $this->db->from('tbl_category');
        $this->db->where('is_active', 1);
        $this->db->order_by('id', 'ASC');
        $data['category'] = $this->db->get();
        $this->db->select('*');
        $this->db->from('tbl_slider');
        $this->db->where('is_active', 1);
        $this->db->order_by('seq', 'ASC');
        $data['slider'] = $this->db->get();
        $this->db->select('*');
        $this->db->from('tbl_slider1');
        $this->db->where('is_active', 1);
        $this->db->order_by('seq', 'ASC');
        $data['slider1'] = $this->db->get();
        $this->db->select('*');
        $this->db->from('tbl_slider2');
        $this->db->where('is_active', 1);
        $this->db->order_by('seq', 'ASC');
        $data['slider2'] = $this->db->get();
        $this->db->select('*');
        $this->db->from('tbl_slider3');
        $this->db->where('is_active', 1);
        $this->db->order_by('seq', 'ASC');
        $data['slider3'] = $this->db->get();
        $this->load->view('common/header', $data);
        $this->load->view('index');
        $this->load->view('common/footer');
    }
    //Search Products  by subcategory Page after search
    public function search_sub_products($idd)
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        $id = base64_decode($idd);
        // $id = base64_decode($idd);
        //  $this->db->select('*');
        // $this->db->from('tbl_categories');
        // $this->db->where('id',$id);
        // $data['categories_data']= $this->db->get();
        $this->db->select('*');
        $this->db->from('tbl_category');
        $this->db->where('is_active', 1);
        $data['categories'] = $this->db->get();
        $this->db->select('*');
        $this->db->from('tbl_sub_category');
        $this->db->where('id', $id);
        $this->db->where('is_active', 1);
        $subcategories = $this->db->limit(5000)->get()->row();
        if (!empty($subcategories)) {
            $subcategory_name = $subcategories->name;
        } else {
            $subcategory_name = "";
        }
        $user_id = $this->session->userdata('user_id');
        // $data['products']= $this->db->select('*')->from('tbl_vendors_product')->where('is_active', 1)->where("name LIKE '%$string%'")->or_where('product_tag', 'like', '%' . $string . '%')->get();
        // 				$this->db->select('*');
        // $this->db->from('tbl_vendors_product');
        // $this->db->where("name LIKE '%$string%'");
        // $this->db->or_where("product_tag LIKE '%$string%'");
        // $this->db->where('is_active', 1);
        // $data['products']= $this->db->get();
        //new search code start
        $ss = [];
        // $string1 = explode(" ", $string);
        // $st_count= count($string1);
        // // print_r($string1);
        //
        // $det1="";
        // $det2="";
        // $det3="";
        // $det4="";
        // $det5="";
        // $det6="";
        // if($st_count >= 1 ){
        // 	$a= $string1[0];
        // // $det1="->where('name','LIKE', '%{$a}%' )";
        // $det1 = " description LIKE '%". $a . "%' ";
        // }
        // if($st_count >= 2 ){
        // 	$b= $string1[1];
        // // $det2="->where('name','LIKE', '%{$a}%' )";
        // $det2 = "AND description LIKE '%". $b . "%' ";
        // }
        // if($st_count >= 3 ){
        // 	$c= $string1[2];
        // // $det3="->where('name','LIKE', '%{$a}%' )";
        // $det3 = "AND description LIKE '%". $c . "%' ";
        // }
        // if($st_count >= 4 ){
        // 	$d= $string1[3];
        // // $det4="->where('name','LIKE', '%{$a}%' )";
        // $det4 = "AND description LIKE '%". $d . "%' ";
        // }
        //
        // if($st_count >= 5 ){
        // 	$e= $string1[4];
        // // $det4="->where('name','LIKE', '%{$a}%' )";
        // $det5 = "AND description LIKE '%". $e . "%' ";
        // }
        //
        // if($st_count >= 6 ){
        // 	$f= $string1[5];
        // // $det4="->where('name','LIKE', '%{$a}%' )";
        // $det6 = "AND description LIKE '%". $f . "%' ";
        // }
        $isactiveProductCondition = "AND is_active = 1";
        $subcategory_condition = " sub_category = " . $id;
        // $isSubCatDeleteProductCondition = "AND is_subcat_delete = 0";
        // $deleteAtProductCondition = "AND deleted_at IS NULL";
        // $details= "SELECT * FROM `tbl_products` WHERE name LIKE '%silver%' AND name LIKE '%gemstone%' AND name LIKE '%chain%'";
        $native_query = "SELECT * FROM tbl_products WHERE  " . $subcategory_condition . "  " . $isactiveProductCondition;
        // echo $native_query; die();
        // $details = DB::select($native_query);
        $details = $this->db->query($native_query);
        // echo "<pre>";	print_r($details->result()); die();
        // SELECT * FROM tbl_products WHERE name LIKE '%lapis%' AND name LIKE '%tyre%' AND name LIKE '%beads%' AND is_active = 1 AND is_cat_delete = 0 AND is_subcat_delete = 0
        // print_r($details); echo count($details); die();
        if (!empty($details)) {
            $ss = [];
            foreach ($details->result() as $dt) {
                // code...
                $a = 0;
                if (!empty($ss)) {
                    foreach ($ss as $value) {
                        if ($dt->sku_series == $value['sku_series']) {
                            $a = 1;
                        }
                    }
                }
                if ($a == 1) {
                    continue;
                } else {
                    $ss[] = array(
                        'id' => $dt->id, 'product_id' => $dt->product_id, 'category' => $dt->category, 'sub_category' => $dt->sub_category, 'minisub_category' => $dt->minisub_category, 'minisub_category2' => $dt->minisub_category2, 'vendor' => $dt->vendor, 'sku' => $dt->sku, 'sku_series' => $dt->sku_series, 'description' => $dt->description, 'sdesc' => $dt->sdesc, 'gdesc' => $dt->gdesc, 'mcat1' => $dt->mcat1, 'mcat2' => $dt->mcat2,
                        'mcat3' => $dt->mcat3, 'mcat4' => $dt->mcat4, 'mcat5' => $dt->mcat5, 'product_type' => $dt->product_type, 'collection' => $dt->collection, 'onhand' => $dt->onhand, 'status' => $dt->status, 'price' => $dt->price, 'currency' => $dt->currency, 'unitofsale' => $dt->unitofsale, 'weight' => $dt->weight, 'weightunit' => $dt->weightunit, 'gramweight' => $dt->gramweight, 'ringsizable' => $dt->ringsizable, 'ringsize' => $dt->ringsize, 'ringsizetype' => $dt->ringsizetype, 'leadtime' => $dt->leadtime, 'agta' => $dt->agta, 'desc_e_grp' => $dt->desc_e_grp, 'desc_e_name1' => $dt->desc_e_name1, 'desc_e_value1' => $dt->desc_e_value1, 'desc_e_name2' => $dt->desc_e_name2, 'desc_e_value2' => $dt->desc_e_value2, 'desc_e_name3' => $dt->desc_e_name3, 'desc_e_value3' => $dt->desc_e_value3, 'desc_e_name4' => $dt->desc_e_name4, 'desc_e_value4' => $dt->desc_e_value4, 'desc_e_name5' => $dt->desc_e_name5, 'desc_e_value5' => $dt->desc_e_value5, 'desc_e_name6' => $dt->desc_e_name6,
                        'desc_e_value6' => $dt->desc_e_value6, 'desc_e_name7' => $dt->desc_e_name7, 'desc_e_value7' => $dt->desc_e_value7, 'desc_e_name8' => $dt->desc_e_name8, 'desc_e_value8' => $dt->desc_e_value8, 'desc_e_name9' => $dt->desc_e_name9, 'desc_e_value9' => $dt->desc_e_value9, 'desc_e_name10' => $dt->desc_e_name10, 'desc_e_value10' => $dt->desc_e_value10,
                        'desc_e_name11' => $dt->desc_e_name11, 'desc_e_value11' => $dt->desc_e_value11, 'desc_e_name12' => $dt->desc_e_name12, 'desc_e_value12' => $dt->desc_e_value12, 'desc_e_name13' => $dt->desc_e_name13, 'desc_e_value13' => $dt->desc_e_value13, 'desc_e_name14' => $dt->desc_e_name14, 'desc_e_value14' => $dt->desc_e_value14, 'desc_e_name15' => $dt->desc_e_value15, 'FullySetImage1' => $dt->FullySetImage1, 'FullySetImage2' => $dt->FullySetImage2, 'FullySetImage3' => $dt->FullySetImage3, 'FullySetImage4' => $dt->FullySetImage4, 'FullySetImage5' => $dt->FullySetImage5, 'FullySetImage6' => $dt->FullySetImage6,
                        'readytowear' => $dt->readytowear, 'smi' => $dt->smi, 'image1' => $dt->image1, 'image2' => $dt->image2, 'image3' => $dt->image3, 'video' => $dt->video, 'gimage1' => $dt->gimage1, 'gimage2' => $dt->gimage2, 'gimage3' => $dt->gimage3,
                        'gvideo' => $dt->gvideo, 'creationdate' => $dt->creationdate, 'currencycode' => $dt->currencycode, 'country' => $dt->country, 'dclarity' => $dt->dclarity, 'dcolor' => $dt->dcolor,  'totalweight' => $dt->totalweight,  'ip' => $dt->ip,  'date' => $dt->date,  'added_by' => $dt->added_by,  'is_active' => $dt->is_active
                    );
                }
            }
        } else {
            $ss = [];
        }
        $detail_name = $ss;
        // $detail_sku = Product::wherenull('deleted_at')->where('is_active', 1)->where('is_cat_delete', 0)->where('is_subcat_delete', 0)
        // ->where('sku_id','LIKE', "%{$string}%" )->get()->toArray();
        // $detail_tag = Product::wherenull('deleted_at')->where('is_active', 1)->where('is_cat_delete', 0)->where('is_subcat_delete', 0)
        // ->where('tag','LIKE', "%{$string}%" )->get()->toArray();
        // 						$this->db->select('*');
        // $this->db->from('tbl_products');
        // $this->db->where("sku LIKE '%$string%'");
        // $this->db->where('is_active', 1);
        // $detail_sku= $this->db->get()->result_array();
        $detail_sku = [];
        // $detail_tag=[];
        // print_r($detail_tag);
        // echo "df";
        $detail = array_merge($detail_name, $detail_sku);
        // print_r($detail); die();
        //duplicate objects will be removed
        $detail = array_map("unserialize", array_unique(array_map("serialize", $detail)));
        //array is sorted on the bases of id
        sort($detail);
        //new search code end
        // echo "<pre>"; print_r($detail); die();
        $data['product'] = $detail;
        $data['search_string'] = $subcategory_name;
        $this->load->view('common/header', $data);
        $this->load->view('search_products');
        $this->load->view('common/footer');
    }
    //Search Products Page after search
    public function search_products_old()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('search_input', 'search_input', 'required|xss_clean|trim');
            if ($this->form_validation->run() == TRUE) {
                $string_main = $this->input->post('search_input');
                $string = str_replace('SLR-', '', $string_main);
                // echo $string; exit;
                // $id = base64_decode($idd);
                //  $this->db->select('*');
                // $this->db->from('tbl_categories');
                // $this->db->where('id',$id);
                // $data['categories_data']= $this->db->get();
                $this->db->select('*');
                $this->db->from('tbl_category');
                $this->db->where('is_active', 1);
                $data['categories'] = $this->db->get();
                $user_id = $this->session->userdata('user_id');
                // $data['products']= $this->db->select('*')->from('tbl_vendors_product')->where('is_active', 1)->where("name LIKE '%$string%'")->or_where('product_tag', 'like', '%' . $string . '%')->get();
                // 				$this->db->select('*');
                // $this->db->from('tbl_vendors_product');
                // $this->db->where("name LIKE '%$string%'");
                // $this->db->or_where("product_tag LIKE '%$string%'");
                // $this->db->where('is_active', 1);
                // $data['products']= $this->db->get();
                // ----------------query to fetch distinct product types--------------------
                // $this->db->select('product_type');
                // $this->db->from('tbl_products');
                // $this->db->distinct();
                // $query = $this->db->get();
                // foreach($query->result() as $type){
                // 	echo $type->product_type."<br />";
                // }
                // die();
                // ---------------------------------------------------------------
                //new search code start
                $ss = [];
                $string1 = explode(" ", $string);
                $st_count = count($string1);
                // print_r($st_count);die();
                $det1 = "";
                $det2 = "";
                $det3 = "";
                $det4 = "";
                $det5 = "";
                $det6 = "";
                $findProduct = "";
                if ($st_count >= 1) {
                    $a = " " . $string1[0] . " ";            //----------ADDED SPACES TO DIFFERENTIATE BETWEEN WORDS LIKE RING AND EAR-RING
                    if (strtoupper($string1[0]) == "RING" || strtoupper($string1[0]) == "RINGS") {
                        $findProduct = "Rings";
                    }
                    if (strtoupper($string1[0]) == "EARRING" || strtoupper($string1[0]) == "EARRINGS") {
                        $findProduct = "Earrings";
                    }
                    if (strtoupper($string1[0]) == "SHANK" || strtoupper($string1[0]) == "SHANKS") {
                        $findProduct = "Shanks";
                    }
                    if (strtoupper($string1[0]) == "NECKLACE" || strtoupper($string1[0]) == "NECKLACES") {
                        $findProduct = "Necklaces";
                    }
                    if (strtoupper($string1[0]) == "BRACELET" || strtoupper($string1[0]) == "BRACELETS") {
                        $findProduct = "Bracelets";
                    }
                    if (strtoupper($string1[0]) == "PENDANT" || strtoupper($string1[0]) == "PENDANTS") {
                        $findProduct = "Pendants";
                    }
                    if (strtoupper($string1[0]) == "CHARM" || strtoupper($string1[0]) == "CHARMS") {
                        $findProduct = "Charms";
                    }
                    // echo $a;die();
                    // $det1="->where('name','LIKE', '%{$a}%' )";
                    $det1 = " sdesc LIKE '%" . $a . "%' ";
                    // echo $det1;
                }
                if ($st_count >= 2) {
                    $b = $string1[1];
                    $findProduct = "";
                    // $det2="->where('name','LIKE', '%{$a}%' )";
                    $det2 = "AND sdesc LIKE '%" . $b . "%' ";
                }
                if ($st_count >= 3) {
                    $c = $string1[2];
                    // $det3="->where('name','LIKE', '%{$a}%' )";
                    $det3 = "AND sdesc LIKE '%" . $c . "%' ";
                }
                if ($st_count >= 4) {
                    $d = $string1[3];
                    // $det4="->where('name','LIKE', '%{$a}%' )";
                    $det4 = "AND sdesc LIKE '%" . $d . "%' ";
                }
                if ($st_count >= 5) {
                    $e = $string1[4];
                    // $det4="->where('name','LIKE', '%{$a}%' )";
                    $det5 = "AND sdesc LIKE '%" . $e . "%' ";
                }
                if ($st_count >= 6) {
                    $f = $string1[5];
                    // $det4="->where('name','LIKE', '%{$a}%' )";
                    $det6 = "AND sdesc LIKE '%" . $f . "%' ";
                }
                $isactiveProductCondition = "AND is_active = 1";
                $groupByCondition = " group by sku_series, sku_series_type1";
                // $isCatDeleteProductCondition = "AND is_cat_delete = 0";
                // $isSubCatDeleteProductCondition = "AND is_subcat_delete = 0";
                // $deleteAtProductCondition = "AND deleted_at IS NULL";
                // $details= "SELECT * FROM `tbl_products` WHERE name LIKE '%silver%' AND name LIKE '%gemstone%' AND name LIKE '%chain%'";
                if (!empty($findProduct)) {
                    $native_query = "SELECT * FROM tbl_products WHERE product_type='" . $findProduct . "'  " . $isactiveProductCondition . " " . $groupByCondition . " LIMIT 5000";
                } else {
                    $native_query = "SELECT * FROM tbl_products WHERE " . $det1 . "  " . $det2 . "  " . $det3 . "  " . $det4 . "  " . $det5 . "  " . $det6 . "  " . $isactiveProductCondition . " " . $groupByCondition . " LIMIT 5000";
                }
                // echo $native_query; die();
                // $details = DB::select($native_query);
                $details = $this->db->query($native_query);
                // echo "<pre>";	print_r($details->result()); die();
                // SELECT * FROM tbl_products WHERE name LIKE '%lapis%' AND name LIKE '%tyre%' AND name LIKE '%beads%' AND is_active = 1 AND is_cat_delete = 0 AND is_subcat_delete = 0
                // print_r($details); die();
                if (!empty($details)) {
                    $ss = [];
                    foreach ($details->result() as $dt) {
                        // code...
                        // print_r($dt);die();
                        $a = 0;
                        if (!empty($ss)) {
                            foreach ($ss as $value) {
                                if ($dt->sku_series == $value['sku_series']) {
                                    $a = 1;
                                }
                            }
                        }
                        if ($a == 1) {
                            continue;
                        } else {
                            $ss[] = array(
                                'id' => $dt->id, 'product_id' => $dt->product_id, 'category' => $dt->category, 'sub_category' => $dt->sub_category, 'minisub_category' => $dt->minisub_category, 'minisub_category2' => $dt->minisub_category2, 'vendor' => $dt->vendor, 'sku' => $dt->sku, 'sku_series' => $dt->sku_series, 'description' => $dt->description, 'sdesc' => $dt->sdesc, 'gdesc' => $dt->gdesc, 'mcat1' => $dt->mcat1, 'mcat2' => $dt->mcat2,
                                'mcat3' => $dt->mcat3, 'mcat4' => $dt->mcat4, 'mcat5' => $dt->mcat5, 'product_type' => $dt->product_type, 'collection' => $dt->collection, 'onhand' => $dt->onhand, 'status' => $dt->status, 'price' => $dt->price, 'currency' => $dt->currency, 'unitofsale' => $dt->unitofsale, 'weight' => $dt->weight, 'weightunit' => $dt->weightunit, 'gramweight' => $dt->gramweight, 'ringsizable' => $dt->ringsizable, 'ringsize' => $dt->ringsize, 'ringsizetype' => $dt->ringsizetype, 'leadtime' => $dt->leadtime, 'agta' => $dt->agta, 'desc_e_grp' => $dt->desc_e_grp, 'desc_e_name1' => $dt->desc_e_name1, 'desc_e_value1' => $dt->desc_e_value1, 'desc_e_name2' => $dt->desc_e_name2, 'desc_e_value2' => $dt->desc_e_value2, 'desc_e_name3' => $dt->desc_e_name3, 'desc_e_value3' => $dt->desc_e_value3, 'desc_e_name4' => $dt->desc_e_name4, 'desc_e_value4' => $dt->desc_e_value4, 'desc_e_name5' => $dt->desc_e_name5, 'desc_e_value5' => $dt->desc_e_value5, 'desc_e_name6' => $dt->desc_e_name6,
                                'desc_e_value6' => $dt->desc_e_value6, 'desc_e_name7' => $dt->desc_e_name7, 'desc_e_value7' => $dt->desc_e_value7, 'desc_e_name8' => $dt->desc_e_name8, 'desc_e_value8' => $dt->desc_e_value8, 'desc_e_name9' => $dt->desc_e_name9, 'desc_e_value9' => $dt->desc_e_value9, 'desc_e_name10' => $dt->desc_e_name10, 'desc_e_value10' => $dt->desc_e_value10,
                                'desc_e_name11' => $dt->desc_e_name11, 'desc_e_value11' => $dt->desc_e_value11, 'desc_e_name12' => $dt->desc_e_name12, 'desc_e_value12' => $dt->desc_e_value12, 'desc_e_name13' => $dt->desc_e_name13, 'desc_e_value13' => $dt->desc_e_value13, 'desc_e_name14' => $dt->desc_e_name14, 'desc_e_value14' => $dt->desc_e_value14, 'desc_e_name15' => $dt->desc_e_value15,
                                'readytowear' => $dt->readytowear, 'smi' => $dt->smi, 'FullySetImage1' => $dt->FullySetImage1, 'FullySetImage2' => $dt->FullySetImage2, 'image3' => $dt->image3, 'video' => $dt->video, 'gimage1' => $dt->gimage1, 'gimage2' => $dt->gimage2, 'gimage3' => $dt->gimage3,
                                'gvideo' => $dt->gvideo, 'creationdate' => $dt->creationdate, 'currencycode' => $dt->currencycode, 'country' => $dt->country, 'dclarity' => $dt->dclarity, 'dcolor' => $dt->dcolor,  'totalweight' => $dt->totalweight,  'ip' => $dt->ip,  'date' => $dt->date,  'added_by' => $dt->added_by,  'is_active' => $dt->is_active
                            );
                        }
                    }
                } else {
                    $ss = [];
                }
                $detail_name = $ss;
                // print_r($detail_name);die();
                // $detail_sku = Product::wherenull('deleted_at')->where('is_active', 1)->where('is_cat_delete', 0)->where('is_subcat_delete', 0)
                // ->where('sku_id','LIKE', "%{$string}%" )->get()->toArray();
                // $detail_tag = Product::wherenull('deleted_at')->where('is_active', 1)->where('is_cat_delete', 0)->where('is_subcat_delete', 0)
                // ->where('tag','LIKE', "%{$string}%" )->get()->toArray();
                $this->db->select('*');
                $this->db->from('tbl_products');
                $this->db->group_by(array("sku_series", "sku_series_type1"));
                $this->db->where("sku LIKE ", '%' . $string . '%');
                $this->db->where('is_active', 1);
                $detail_sku = $this->db->get();
                $detail = [];
                $yy = [];
                foreach ($detail_sku->result() as $dt) {
                    // print_r($yy);
                    $b = 0;
                    if (empty($detail_name)) {
                        $j = 1;
                        foreach ($yy as $value) {
                            // echo $dt->sku_series." ".$value['sku_series'];
                            if ($dt->sku_series == $value['sku_series']) {
                                $b = 1;
                            }
                        }
                    }
                    if ($b == 1) {
                        continue;
                    } else {
                        $yy[] = array(
                            'id' => $dt->id, 'product_id' => $dt->product_id, 'category' => $dt->category, 'sub_category' => $dt->sub_category, 'minisub_category' => $dt->minisub_category, 'minisub_category2' => $dt->minisub_category2, 'vendor' => $dt->vendor, 'sku' => $dt->sku, 'sku_series' => $dt->sku_series, 'description' => $dt->description, 'sdesc' => $dt->sdesc, 'gdesc' => $dt->gdesc, 'mcat1' => $dt->mcat1, 'mcat2' => $dt->mcat2,
                            'mcat3' => $dt->mcat3, 'mcat4' => $dt->mcat4, 'mcat5' => $dt->mcat5, 'product_type' => $dt->product_type, 'collection' => $dt->collection, 'onhand' => $dt->onhand, 'status' => $dt->status, 'price' => $dt->price, 'currency' => $dt->currency, 'unitofsale' => $dt->unitofsale, 'weight' => $dt->weight, 'weightunit' => $dt->weightunit, 'gramweight' => $dt->gramweight, 'ringsizable' => $dt->ringsizable, 'ringsize' => $dt->ringsize, 'ringsizetype' => $dt->ringsizetype, 'leadtime' => $dt->leadtime, 'agta' => $dt->agta, 'desc_e_grp' => $dt->desc_e_grp, 'desc_e_name1' => $dt->desc_e_name1, 'desc_e_value1' => $dt->desc_e_value1, 'desc_e_name2' => $dt->desc_e_name2, 'desc_e_value2' => $dt->desc_e_value2, 'desc_e_name3' => $dt->desc_e_name3, 'desc_e_value3' => $dt->desc_e_value3, 'desc_e_name4' => $dt->desc_e_name4, 'desc_e_value4' => $dt->desc_e_value4, 'desc_e_name5' => $dt->desc_e_name5, 'desc_e_value5' => $dt->desc_e_value5, 'desc_e_name6' => $dt->desc_e_name6,
                            'desc_e_value6' => $dt->desc_e_value6, 'desc_e_name7' => $dt->desc_e_name7, 'desc_e_value7' => $dt->desc_e_value7, 'desc_e_name8' => $dt->desc_e_name8, 'desc_e_value8' => $dt->desc_e_value8, 'desc_e_name9' => $dt->desc_e_name9, 'desc_e_value9' => $dt->desc_e_value9, 'desc_e_name10' => $dt->desc_e_name10, 'desc_e_value10' => $dt->desc_e_value10,
                            'desc_e_name11' => $dt->desc_e_name11, 'desc_e_value11' => $dt->desc_e_value11, 'desc_e_name12' => $dt->desc_e_name12, 'desc_e_value12' => $dt->desc_e_value12, 'desc_e_name13' => $dt->desc_e_name13, 'desc_e_value13' => $dt->desc_e_value13, 'desc_e_name14' => $dt->desc_e_name14, 'desc_e_value14' => $dt->desc_e_value14, 'desc_e_name15' => $dt->desc_e_value15,
                            'readytowear' => $dt->readytowear, 'smi' => $dt->smi, 'FullySetImage1' => $dt->FullySetImage1, 'FullySetImage2' => $dt->FullySetImage2, 'image3' => $dt->image3, 'video' => $dt->video, 'gimage1' => $dt->gimage1, 'gimage2' => $dt->gimage2, 'gimage3' => $dt->gimage3,
                            'gvideo' => $dt->gvideo, 'creationdate' => $dt->creationdate, 'currencycode' => $dt->currencycode, 'country' => $dt->country, 'dclarity' => $dt->dclarity, 'dcolor' => $dt->dcolor,  'totalweight' => $dt->totalweight,  'ip' => $dt->ip,  'date' => $dt->date,  'added_by' => $dt->added_by,  'is_active' => $dt->is_active
                        );
                    }
                }
                // exit;
                $detail = array_merge($detail_name, $yy);
                // print_r($yy);die();
                if (empty($detail)) {
                    $detail = $detail_name;
                }
                // $detail = array_merge( $detail_name, $detail_sku );
                // print_r($detail); die();
                //duplicate objects will be removed
                $detail = array_map("unserialize", array_unique(array_map("serialize", $detail)));
                // print_r($detail); die();
                //array is sorted on the bases of id
                sort($detail);
                //new search code end
                // echo "<pre>";
                // print_r($detail); die();
                $data['product'] = $detail;
                $data['search_string'] = $string_main;
                // echo count($detail);die();
                if (count($detail) == 1) {
                    // echo "hi";die();
                    redirect('Home/product_detail/' . $detail[0]['sku']);
                } else {
                    $this->load->view('common/header', $data);
                    $this->load->view('search_products');
                    $this->load->view('common/footer');
                }
            } else {
                $this->session->set_flashdata('emessage', validation_errors());
                // redirect("auth/login","refresh");
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->session->set_flashdata('emessage', 'sorry error occur.');
            // redirect("auth/login","refresh");
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function search_products()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');

        if ($this->input->post()) {
            $this->form_validation->set_rules('search_input', 'search_input', 'required|xss_clean|trim');

            if ($this->form_validation->run() == TRUE) {
                $string_main = $this->input->post('search_input');
                $string = str_replace('SLR-', '', $string_main);
                $user_id = $this->session->userdata('user_id');
                $ss = [];

                $string1 = explode(" ", $string);
                $st_count = count($string1);

                $det = array();

                for ($i = 0; $i < min($st_count, 6); $i++) {
                    $det[] = "sdesc LIKE '%" . $string1[$i] . "%'";
                }

                $isactiveProductCondition = "AND is_active = 1";
                $groupByCondition = " GROUP BY sku_series, sku_series_type1";
                $findProduct = "";

                if ($st_count >= 1) {
                    $a = " " . $string1[0] . " ";
                    $det[] = "sdesc LIKE '%" . $a . "%'";
                    $findProduct = $this->getProductType($string1[0]);
                }

                if ($st_count >= 2) {
                    $b = $string1[1];
                    $det[] = "AND sdesc LIKE '%" . $b . "%'";
                }

                if (!empty($findProduct)) {
                    $native_query = "SELECT 'id, product_id, category, sub_category, minisub_category, minisub_category2, vendor, sku, sku_series, description, sdesc, gdesc, mcat1, mcat2, mcat3, mcat4, mcat5, product_type, collection, onhand, status, price, currency, unitofsale, weight, weightunit, gramweight, ringsizable, ringsize, ringsizetype, leadtime, agta, desc_e_grp, desc_e_name1, desc_e_value1, desc_e_name2, desc_e_value2, desc_e_name3, desc_e_value3, desc_e_name4, desc_e_value4, desc_e_name5, desc_e_value5, desc_e_name6, desc_e_value6, desc_e_name7, desc_e_value7, desc_e_name8, desc_e_value8, desc_e_name9, desc_e_value9, desc_e_name10, desc_e_value10, desc_e_name11, desc_e_value11, desc_e_name12, desc_e_value12, desc_e_name13, desc_e_value13, desc_e_name14, desc_e_value14, desc_e_name15, desc_e_value15, readytowear, smi, FullySetImage1, FullySetImage2, image3, video, gimage1, gimage2, gimage3, gvideo, creationdate, currencycode, country, dclarity, dcolor, totalweight, ip, date, added_by, is_active' FROM tbl_products WHERE product_type='" . $findProduct . "' " . $isactiveProductCondition . $groupByCondition;
                } else {
                    $placeholders = implode(' ', $det);
                    $native_query = "SELECT 'id, product_id, category, sub_category, minisub_category, minisub_category2, vendor, sku, sku_series, description, sdesc, gdesc, mcat1, mcat2, mcat3, mcat4, mcat5, product_type, collection, onhand, status, price, currency, unitofsale, weight, weightunit, gramweight, ringsizable, ringsize, ringsizetype, leadtime, agta, desc_e_grp, desc_e_name1, desc_e_value1, desc_e_name2, desc_e_value2, desc_e_name3, desc_e_value3, desc_e_name4, desc_e_value4, desc_e_name5, desc_e_value5, desc_e_name6, desc_e_value6, desc_e_name7, desc_e_value7, desc_e_name8, desc_e_value8, desc_e_name9, desc_e_value9, desc_e_name10, desc_e_value10, desc_e_name11, desc_e_value11, desc_e_name12, desc_e_value12, desc_e_name13, desc_e_value13, desc_e_name14, desc_e_value14, desc_e_name15, desc_e_value15, readytowear, smi, FullySetImage1, FullySetImage2, image3, video, gimage1, gimage2, gimage3, gvideo, creationdate, currencycode, country, dclarity, dcolor, totalweight, ip, date, added_by, is_active' FROM tbl_products WHERE " . implode(' AND ', $det) . $isactiveProductCondition . $groupByCondition;
                }

                $details = $this->db->query($native_query);

                if ($details->num_rows() > 0) {
                    $ss = [];
                    foreach ($details->result() as $dt) {
                        $a = 0;
                        if (!empty($ss)) {
                            foreach ($ss as $value) {
                                if ($dt->sku_series == $value['sku_series']) {
                                    $a = 1;
                                }
                            }
                        }

                        if ($a == 1) {
                            continue;
                        } else {
                            $ss[] = $this->prepareProductData($dt);
                        }
                    }
                } else {
                    $ss = [];
                }

                $this->db->select('id, product_id, category, sub_category, minisub_category, minisub_category2, vendor, sku, sku_series, description, sdesc, gdesc, mcat1, mcat2, mcat3, mcat4, mcat5, product_type, collection, onhand, status, price, currency, unitofsale, weight, weightunit, gramweight, ringsizable, ringsize, ringsizetype, leadtime, agta, desc_e_grp, desc_e_name1, desc_e_value1, desc_e_name2, desc_e_value2, desc_e_name3, desc_e_value3, desc_e_name4, desc_e_value4, desc_e_name5, desc_e_value5, desc_e_name6, desc_e_value6, desc_e_name7, desc_e_value7, desc_e_name8, desc_e_value8, desc_e_name9, desc_e_value9, desc_e_name10, desc_e_value10, desc_e_name11, desc_e_value11, desc_e_name12, desc_e_value12, desc_e_name13, desc_e_value13, desc_e_name14, desc_e_value14, desc_e_name15, desc_e_value15, readytowear, smi, FullySetImage1, FullySetImage2, image3, video, gimage1, gimage2, gimage3, gvideo, creationdate, currencycode, country, dclarity, dcolor, totalweight, ip, date, added_by, is_active');
                $this->db->from('tbl_products');
                $this->db->group_by(array("sku_series", "sku_series_type1"));
                $this->db->like("sku", $string);
                $this->db->where('is_active', 1);
                $detail_sku = $this->db->get();
                $yy = [];

                foreach ($detail_sku->result() as $dt) {
                    $b = 0;

                    if (empty($ss)) {
                        foreach ($yy as $value) {
                            if ($dt->sku_series == $value['sku_series']) {
                                $b = 1;
                            }
                        }
                    }

                    if ($b == 1) {
                        continue;
                    } else {
                        $yy[] = $this->prepareProductData($dt);
                    }
                }

                $detail = array_merge($ss, $yy);

                if (empty($detail)) {
                    $detail = $ss;
                }

                $detail = array_map("unserialize", array_unique(array_map("serialize", $detail)));
                sort($detail);

                $data['product'] = $detail;
                $data['search_string'] = $string_main;

                if (count($detail) == 1) {
                    redirect('Home/product_detail/' . $detail[0]['sku']);
                } else {
                    $this->load->view('common/header', $data);
                    $this->load->view('search_products');
                    $this->load->view('common/footer');
                }
            } else {
                $this->session->set_flashdata('emessage', validation_errors());
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->session->set_flashdata('emessage', 'Sorry, an error occurred.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function search_product()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');

        if ($this->input->post()) {
            $this->form_validation->set_rules('search_input', 'search_input', 'required|xss_clean|trim');

            if ($this->form_validation->run() == TRUE) {
                $string_main = $this->input->post('search_input');
                $product_data = $this->db->select('id,pro_id,series_id,group_id,search_values')
                    ->from('tbl_products')
                    ->where("JSON_SEARCH(search_values, 'one', '$string_main') IS NOT NULL", null, false)
                    ->get()->row();
                $data['search_string'] = $string_main;
                if (!empty($product_data)) {
                    redirect('Home/product_details/' . $product_data->series_id . '/' . $product_data->pro_id . '?groupId=' . $product_data->group_id . '');
                } else {
                    $this->session->set_flashdata('emessage', 'No Product found!');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            } else {
                $this->session->set_flashdata('emessage', validation_errors());
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->session->set_flashdata('emessage', 'Sorry, an error occurred.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    function getProductType($input)
    {
        $productTypes = [
            "RING" => "Rings",
            "RINGS" => "Rings",
            "EARRING" => "Earrings",
            "EARRINGS" => "Earrings",
            "SHANK" => "Shanks",
            "SHANKS" => "Shanks",
            "NECKLACE" => "Necklaces",
            "NECKLACES" => "Necklaces",
            "BRACELET" => "Bracelets",
            "BRACELETS" => "Bracelets",
            "PENDANT" => "Pendants",
            "PENDANTS" => "Pendants",
            "CHARM" => "Charms",
            "CHARMS" => "Charms"
        ];

        $upperInput = strtoupper($input);

        return isset($productTypes[$upperInput]) ? $productTypes[$upperInput] : "";
    }
    function prepareProductData($dt)
    {
        return array(
            'id' => $dt->id,
            'product_id' => $dt->product_id,
            'category' => $dt->category,
            'sub_category' => $dt->sub_category,
            'minisub_category' => $dt->minisub_category,
            'minisub_category2' => $dt->minisub_category2,
            'vendor' => $dt->vendor,
            'sku' => $dt->sku,
            'sku_series' => $dt->sku_series,
            'description' => $dt->description,
            'sdesc' => $dt->sdesc,
            'gdesc' => $dt->gdesc,
            'mcat1' => $dt->mcat1,
            'mcat2' => $dt->mcat2,
            'mcat3' => $dt->mcat3,
            'mcat4' => $dt->mcat4,
            'mcat5' => $dt->mcat5,
            'product_type' => $dt->product_type,
            'collection' => $dt->collection,
            'onhand' => $dt->onhand,
            'status' => $dt->status,
            'price' => $dt->price,
            'currency' => $dt->currency,
            'unitofsale' => $dt->unitofsale,
            'weight' => $dt->weight,
            'weightunit' => $dt->weightunit,
            'gramweight' => $dt->gramweight,
            'ringsizable' => $dt->ringsizable,
            'ringsize' => $dt->ringsize,
            'ringsizetype' => $dt->ringsizetype,
            'leadtime' => $dt->leadtime,
            'agta' => $dt->agta,
            'desc_e_grp' => $dt->desc_e_grp,
            'desc_e_name1' => $dt->desc_e_name1,
            'desc_e_value1' => $dt->desc_e_value1,
            'desc_e_name2' => $dt->desc_e_name2,
            'desc_e_value2' => $dt->desc_e_value2,
            'desc_e_name3' => $dt->desc_e_name3,
            'desc_e_value3' => $dt->desc_e_value3,
            'desc_e_name4' => $dt->desc_e_name4,
            'desc_e_value4' => $dt->desc_e_value4,
            'desc_e_name5' => $dt->desc_e_name5,
            'desc_e_value5' => $dt->desc_e_value5,
            'desc_e_name6' => $dt->desc_e_name6,
            'desc_e_value6' => $dt->desc_e_value6,
            'desc_e_name7' => $dt->desc_e_name7,
            'desc_e_value7' => $dt->desc_e_value7,
            'desc_e_name8' => $dt->desc_e_name8,
            'desc_e_value8' => $dt->desc_e_value8,
            'desc_e_name9' => $dt->desc_e_name9,
            'desc_e_value9' => $dt->desc_e_value9,
            'desc_e_name10' => $dt->desc_e_name10,
            'desc_e_value10' => $dt->desc_e_value10,
            'desc_e_name11' => $dt->desc_e_name11,
            'desc_e_value11' => $dt->desc_e_value11,
            'desc_e_name12' => $dt->desc_e_name12,
            'desc_e_value12' => $dt->desc_e_value12,
            'desc_e_name13' => $dt->desc_e_name13,
            'desc_e_value13' => $dt->desc_e_value13,
            'desc_e_name14' => $dt->desc_e_name14,
            'desc_e_value14' => $dt->desc_e_value14,
            'desc_e_name15' => $dt->desc_e_value15,
            'readytowear' => $dt->readytowear,
            'smi' => $dt->smi,
            'FullySetImage1' => $dt->FullySetImage1,
            'FullySetImage2' => $dt->FullySetImage2,
            'image3' => $dt->image3,
            'video' => $dt->video,
            'gimage1' => $dt->gimage1,
            'gimage2' => $dt->gimage2,
            'gimage3' => $dt->gimage3,
            'gvideo' => $dt->gvideo,
            'creationdate' => $dt->creationdate,
            'currencycode' => $dt->currencycode,
            'country' => $dt->country,
            'dclarity' => $dt->dclarity,
            'dcolor' => $dt->dcolor,
            'totalweight' => $dt->totalweight,
            'ip' => $dt->ip,
            'date' => $dt->date,
            'added_by' => $dt->added_by,
            'is_active' => $dt->is_active
        );
    }
    //search result data
    public function search_results()
    {
        $data['data'] = '';
        // if(!empty($this->session->userdata('user_data'))){
        $string = $this->input->post('string');
        $user_id = $this->session->userdata('usersid');
        //new search code start
        $ss = [];
        $string1 = explode(" ", $string);
        $st_count = count($string1);
        // print_r($string1);
        $det1 = "";
        $det2 = "";
        $det3 = "";
        $det4 = "";
        $det5 = "";
        $det6 = "";
        if ($st_count >= 1) {
            $a = $string1[0];
            // $det1="->where('name','LIKE', '%{$a}%' )";
            $det1 = " name LIKE '%" . $a . "%' ";
        }
        if ($st_count >= 2) {
            $b = $string1[1];
            // $det2="->where('name','LIKE', '%{$a}%' )";
            $det2 = "AND name LIKE '%{" . $b . "}%' ";
        }
        if ($st_count >= 3) {
            $c = $string1[2];
            // $det3="->where('name','LIKE', '%{$a}%' )";
            $det3 = "AND name LIKE '%" . $c . "%' ";
        }
        if ($st_count >= 4) {
            $d = $string1[3];
            // $det4="->where('name','LIKE', '%{$a}%' )";
            $det4 = "AND name LIKE '%" . $d . "%' ";
        }
        if ($st_count >= 5) {
            $e = $string1[4];
            // $det4="->where('name','LIKE', '%{$a}%' )";
            $det5 = "AND name LIKE '%" . $e . "%' ";
        }
        if ($st_count >= 6) {
            $f = $string1[5];
            // $det4="->where('name','LIKE', '%{$a}%' )";
            $det6 = "AND name LIKE '%" . $f . "%' ";
        }
        $isactiveProductCondition = "AND is_active = 1";
        // $isCatDeleteProductCondition = "AND is_cat_delete = 0";
        // $isSubCatDeleteProductCondition = "AND is_subcat_delete = 0";
        // $deleteAtProductCondition = "AND deleted_at IS NULL";
        // $details= "SELECT * FROM `tbl_products` WHERE name LIKE '%silver%' AND name LIKE '%gemstone%' AND name LIKE '%chain%'";
        $native_query = "SELECT * FROM tbl_sub_category WHERE " . $det1 . "  " . $det2 . "  " . $det3 . "  " . $det4 . "  " . $det5 . "  " . $det6 . "  " . $isactiveProductCondition;
        // echo $native_query; die();
        // $details = DB::select($native_query);
        $details = $this->db->query($native_query);
        // echo "<pre>";	print_r($details->result()); die();
        // SELECT * FROM tbl_products WHERE name LIKE '%lapis%' AND name LIKE '%tyre%' AND name LIKE '%beads%' AND is_active = 1 AND is_cat_delete = 0 AND is_subcat_delete = 0
        // print_r($details); echo count($details); die();
        if (!empty($details)) {
            foreach ($details->result() as $dt) {
                // code...
                $ss[] = array('id' => $dt->id, 'category' => $dt->category, 'api_id' => $dt->api_id, 'name' => $dt->name, 'image' => $dt->image, 'seq' => $dt->seq,  'ip' => $dt->ip,  'date' => $dt->date,  'added_by' => $dt->added_by,  'is_active' => $dt->is_active);
            }
        } else {
            $ss = [];
        }
        $detail_name = $ss;
        // $detail_sku = Product::wherenull('deleted_at')->where('is_active', 1)->where('is_cat_delete', 0)->where('is_subcat_delete', 0)
        // ->where('sku_id','LIKE', "%{$string}%" )->get()->toArray();
        // $detail_tag = Product::wherenull('deleted_at')->where('is_active', 1)->where('is_cat_delete', 0)->where('is_subcat_delete', 0)
        // ->where('tag','LIKE', "%{$string}%" )->get()->toArray();
        // 						$this->db->select('*');
        // $this->db->from('tbl_products');
        // $this->db->where("sku LIKE '%$string%'");
        // $this->db->where('is_active', 1);
        // $detail_sku= $this->db->get()->result_array();
        $detail_sku = [];
        // $detail_tag=[];
        // print_r($detail_tag);
        // echo "df";
        $detail = array_merge($detail_name, $detail_sku);
        // print_r($detail); die();
        //duplicate objects will be removed
        $detail = array_map("unserialize", array_unique(array_map("serialize", $detail)));
        //array is sorted on the bases of id
        sort($detail);
        //new search code end
        $data['data'] = true;
        $data['result_da'] = $detail;
        // $this->db->select('*');
        // $this->db->from('tbl_ecom_products');
        // $this->db->where('category_id',$catid);
        // $this->db->where("is_active", 1);
        // $this->db->where("is_cat_delete", 0);
        // $data['ecom_product_data']= $this->db->get();
        // $this->load->view('layout/withoutheader');
        // $this->load->view('view_wishlist',$data);
        // $this->load->view('layout/footer');
        // }else{
        // // redirect("home","refresh");
        // $data['data']=false;
        //
        // }
        echo json_encode($data);
    }
    public function new_arrivals()
    {
        $this->db->select('*');
        $this->db->from('tbl_new_arrival_products');
        $this->db->group_by(array("sku_series", "sku_series_type1"));
        $this->db->where('is_active', 1);
        $this->db->order_by('id', 'ASC');
        $data['product'] = $this->db->get();
        //get product count
        $this->db->select('*');
        $this->db->from('tbl_new_arrival_products');
        $this->db->group_by(array("sku_series", "sku_series_type1"));
        $this->db->where('is_active', 1);
        $data['product_count'] = $this->db->count_all_results();
        $this->load->view('common/header', $data);
        $this->load->view('new_arrival_products');
        $this->load->view('common/footer');
    }
    public function new_arrive_product_detail($idd)
    {
        $data['page_t'] = 2; // 1 for quickshop product ,2 for new arrivals, 3 for normal products
        $data['page'] = 0;
        $id = $idd;
        // echo $id;
        // exit;
        $this->db->select('*');
        $this->db->from('tbl_new_arrival_products');
        $this->db->where('id', $id);
        $this->db->where('is_active', 1);
        $data['products'] = $this->db->get()->row();
        $this->db->select('*');
        $this->db->from('tbl_new_arrival_products');
        $this->db->where('id', $id);
        $this->db->where('is_active', 1);
        $d1 = $this->db->get()->row();
        $sub_id = $d1->sub_category;
        $minorsub_id = $d1->minisub_category;
        $a1 = $d1->desc_e_value1;
        $this->db->select('*');
        $this->db->from('tbl_new_arrival_products');
        $this->db->where('desc_e_value1', $a1);
        $this->db->where('is_active', 1);
        $d2 = $this->db->get();
        $i = 1;
        foreach ($d2->result() as $d3) {
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
            $c1[] = $d3->desc_e_value2;
            $c2[] = $d3->desc_e_value3;
            $c3[] = $d3->desc_e_value4;
            $c4[] = $d3->desc_e_value5;
            $c5[] = $d3->desc_e_value6;
            $c6[] = $d3->desc_e_value7;
            $c7[] = $d3->desc_e_value8;
            $c8[] = $d3->desc_e_value9;
            $c9[] = $d3->desc_e_value10;
            $c10[] = $d3->desc_e_value11;
        }
        $data['d1'] = array_unique($c1);
        $data['d2'] = array_unique($c2);
        $data['d3'] = array_unique($c3);
        $data['d4'] = array_unique($c4);
        $data['d5'] = array_unique($c5);
        $data['d6'] = array_unique($c6);
        $data['d7'] = array_unique($c7);
        $data['d8'] = array_unique($c8);
        $data['d9'] = array_unique($c9);
        $data['d10'] = array_unique($c10);
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
        // 	$this->db->from('tbl_new_arrival_products');
        // 	$this->db->group_by(array("sku_series", "sku_series_type1"));
        // 	$this->db->where('minisub_category',$minorsub_id);
        // 	$this->db->where('is_active',1);
        // 	$this->db->order_by('id','DESC');
        // 	$data['ralated_products']= $this->db->limit(100)->get();
        // }else {
        $this->db->select('*');
        $this->db->from('tbl_new_arrival_products');
        $this->db->group_by(array("sku_series", "sku_series_type1"));
        // $this->db->where('sub_category',$sub_id);
        $this->db->where('is_active', 1);
        $this->db->order_by('id', 'DESC');
        $data['ralated_products'] = $this->db->limit(100)->get();
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
        $this->load->view('common/header', $data);
        $this->load->view('product_detail');
        $this->load->view('common/footer');
    }
    public function all_products($idd, $t, $page_index = "1")
    {
        $type = base64_decode($t);
        $config['base_url'] = base_url() . 'Home/all_products/' . $idd . '/' . $t;
        $per_page = 28;
        $config['per_page'] = $per_page;
        $config['num_links'] = 3;
        $config['full_tag_open'] = '<ul class="pagination " style="margin: auto;">';
        $config['full_tag_close'] = '</ul>';
        $config['use_page_numbers'] = true;
        $config['next_link'] = 'First';
        $config['first_tag_open'] = '<li class="first page page-link">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="last page page-link">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = ' <span aria-hidden="true">&raquo;</span>';
        $config['next_tag_open'] = '<li class="page-item page-link nextpage">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = ' <span aria-hidden="true">&laquo;</span>';
        $config['prev_tag_open'] = '<li class="page-item  page-link prevpage">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active page-link"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item page-link page-link">';
        $config['num_tag_close'] = '</li>';
        if ($type == 1) {
            $data['productCount'] = $this->db->select('id')->group_by(array("series_id"))->get_where('tbl_products', array('minor_category_id' => $idd, 'is_quick' => null))->num_rows();
            //--------- pagination config ----------------------
            $config['total_rows'] = $data['productCount'];
            $this->pagination->initialize($config);
            if (!empty($page_index)) {
                if (is_numeric($page_index)) {
                    $start = ($page_index - 1) * $config['per_page'];
                } else {
                    $page_index = 0;
                    $start = 0;
                }
            } else {
                $page_index = 0;
                $start = 0;
            }
            $data['products_data'] = $this->db->select('full_set_images,images,group_images,series_id,pro_id,group_id,description,price,catalog_values')->limit($config["per_page"], $start)->group_by(array("series_id"))->get_where('tbl_products', array('minor_category_id' => $idd, 'is_quick' => null))->result();
            $mini_data = $this->db->get_where('tbl_minisubcategory', array('is_active' => 1, 'id' => $idd))->row();
            $subcat_data = $this->db->get_where('tbl_sub_category', array('is_active' => 1, 'id' => $mini_data->subcategory))->row();
            $cat_data = $this->db->get_where('tbl_category', array('is_active' => 1, 'id' => $mini_data->category))->row();
            $data['category_name'] = $cat_data->name;
            $data['subcategory_name'] = $subcat_data->name;
            $data['category_id'] = $cat_data->id;
            $data['minorsub_name'] = $mini_data->name;
            $data['description'] = $mini_data->description;
            $data['banner'] = $mini_data->banner;
            $data['heading'] = $mini_data->name;
        } else if ($type == 3) {
            $data['productCount'] = $this->db->select('id')->group_by(array("series_id"))->get_where('tbl_products', array('category_id' => $idd, 'is_quick' => null))->num_rows();
            //--------- pagination config ----------------------
            $config['total_rows'] = $data['productCount'];
            $this->pagination->initialize($config);
            if (!empty($page_index)) {
                if (is_numeric($page_index)) {
                    $start = ($page_index - 1) * $config['per_page'];
                } else {
                    $page_index = 0;
                    $start = 0;
                }
            } else {
                $page_index = 0;
                $start = 0;
            }
            $data['products_data'] = $this->db->select('full_set_images,images,group_images,series_id,pro_id,group_id,description,price,catalog_values')->limit($config["per_page"], $start)->group_by(array("series_id"))->get_where('tbl_products', array('category_id' => $idd, 'is_quick' => null))->result();
            $cat_data = $this->db->get_where('tbl_category', array('is_active' => 1, 'id' => $idd))->row();
            $data['category_name'] = $cat_data->name;
            $data['category_id'] = $cat_data->id;
            $data['subcategory_name'] = '';
            $data['minorsub_name'] = '';
            $data['description'] = $cat_data->description;
            $data['banner'] = $cat_data->banner;
            $data['heading'] = $cat_data->name;
        } else {
            $data['productCount'] = $this->db->select('id')->group_by(array("series_id"))->get_where('tbl_products', array('subcategory_id' => $idd, 'is_quick' => null))->num_rows();
            //--------- pagination config ----------------------
            $config['total_rows'] = $data['productCount'];
            $this->pagination->initialize($config);
            if (!empty($page_index)) {
                if (is_numeric($page_index)) {
                    $start = ($page_index - 1) * $config['per_page'];
                } else {
                    $page_index = 0;
                    $start = 0;
                }
            } else {
                $page_index = 0;
                $start = 0;
            }
            $data['products_data'] = $this->db->select('full_set_images,images,group_images,series_id,pro_id,group_id,description,price,catalog_values')->limit($config["per_page"], $start)->group_by(array("series_id"))->get_where('tbl_products', array('subcategory_id' => $idd, 'is_quick' => null))->result();
            $subcat_data = $this->db->get_where('tbl_sub_category', array('is_active' => 1, 'id' => $idd))->row();
            $cat_data = $this->db->get_where('tbl_category', array('is_active' => 1, 'id' => $subcat_data->category))->row();
            $data['category_name'] = $cat_data->name;
            $data['subcategory_name'] = $subcat_data->name;
            $data['category_id'] = $cat_data->id;
            $data['description'] = $subcat_data->description;
            $data['banner'] = $subcat_data->banner;
            $data['heading'] = $subcat_data->name;
        }
        $links = $this->pagination->create_links();
        $data['sort_type'] = '';
        $data['level_id'] = $idd;
        $data['links'] = $links;

        $this->load->view('common/header', $data);
        $this->load->view('all_products');
        $this->load->view('common/footer');
    }
    public function product_details($series_id, $pro_id)
    {
        $group_id = $_GET['groupId'];
        $data['products'] = $this->db->get_where('tbl_products', array('pro_id' => $pro_id))->row();
        $data['stone_data']  = $this->db->select("id,pro_id,stone")->order_by('stone', 'desc')->group_by('stone')->get_where('tbl_products', array('series_id' => $series_id, 'group_id' => $group_id, 'is_quick' => $data['products']->is_quick))->result();
        $product_data  = $this->db->select('elements')->group_by('pro_id')->get_where('tbl_products', array('series_id' => $series_id, 'group_id' => $group_id, 'stone' => $data['products']->stone, 'is_quick' => $data['products']->is_quick))->result();
        $data['more_products'] = $this->db->select('series_id, full_set_images,images,group_images, group_id,description,pro_id')->where('series_id !=', $data['products']->series_id)->group_by('series_id')->limit(15)->get_where('tbl_products', array('category_id' => $data['products']->category_id, 'is_quick' => $data['products']->is_quick))->result();
        $data['suggested_products'] = $this->db->select('series_id, full_set_images,images,group_images, group_id,description,pro_id')->where('series_id !=', $data['products']->series_id)->group_by('series_id')->limit(15)->get_where('tbl_products', array('is_quick' => $data['products']->is_quick))->result();


        // $data['suggested_products'] = [];
        // $data['more_products']= [];
        $options = [];
        // $pro_elements = json_decode($data['products']->elements);
        $DescriptiveElements = json_decode($data['products']->elements);
        $searchedValues = [];
        foreach ($product_data as $product) {
            $jsonData = json_decode($product->elements, true);
            foreach ($jsonData as $index => $element) {
                $key = $element['Name'];
                $value = $element['DisplayValue'];
                // Collect unique options for each key
                if (!isset($options[$key])) {
                    $options[$key] = [];
                }
                // // Check if the value is not already in the options for the key
                $existingValues = array_column($options[$key], 'DisplayValue');
                if (!in_array($value, $existingValues)) {
                    // if ($value == $data['products']) {
                    if ($DescriptiveElements[$index]->Name == $key && $DescriptiveElements[$index]->DisplayValue == $value) {
                        $selected = "selected";
                        $searchedValues[]  = $value;
                    } else {
                        $selected = "";
                    }
                    $options[$key][] = [
                        'DisplayValue' => $value,
                        'selected' => $selected,
                        'value' => $element['Value'],
                    ];
                }
            }
        }
        // Sort options in ascending order
        foreach ($options as &$option) {
            usort($option, function ($a, $b) {
                return strcmp($a['DisplayValue'], $b['DisplayValue']);
            });
        }
        //---- CALCULATE PRICE -------
        $r_data = json_decode($data['products']->ring_size_data, true);
        $sizePrice = 0;
        if (!empty($r_data)) {
            $sizePriceDa = array_values(array_filter($r_data, fn ($item) => $item['Size'] == $data['products']->ring_size))[0] ?? null;
            $sizePrice = $sizePriceDa['Price']['Value'];
        }
        $pr_data = $this->db->get_where('tbl_price_rule', array())->row();
        $data['sizePrice'] = $sizePrice;
        $multiplier = $pr_data->multiplier;
        $cost_price = $data['products']->price + $sizePrice;
        $retail = $cost_price * $multiplier;
        $now_price = $cost_price;
        if ($cost_price <= 500) {
            $cost_price2 = $cost_price * $cost_price;
            $number = round($cost_price * ($pr_data->cost_price1 * $cost_price2 + $pr_data->cost_price2 * $cost_price + $pr_data->cost_price3), 2);
            $unit = 5;
            $remainder = $number % $unit;
            $mround = ($remainder < $unit / 2) ? $number - $remainder : $number + ($unit - $remainder);
            $now_price = round($mround) - 1 + 0.95;
        } else if ($cost_price > 500) {
            $number = round($cost_price * ($pr_data->cost_price4 * $cost_price / $multiplier + $pr_data->cost_price5));
            $unit = 5;
            $remainder = $number % $unit;
            $mround = ($remainder < $unit / 2) ? $number - $remainder : $number + ($unit - $remainder);
            $now_price = round($mround) - 1 + 0.95;
        }
        $saved = round($retail - $now_price);
        $dis_percent = $saved / $retail * 100;

        $data['now_price'] = $now_price;
        $data['saved'] = $saved;
        $data['dis_percent'] = $dis_percent;
        $data['retail'] = $retail;
        $data['options'] = $options;
        $data['product_data'] = $product_data;
        $data['searchedValues'] = $searchedValues;
        $setting_options = json_decode($data['products']->setting_options);
        $this->load->view('common/header', $data);
        if (!empty($setting_options)) {
            $this->load->view('build_product');
        } else {
            $this->load->view('product_detail_new');
        }
        $this->load->view('common/footer');
    }
    public  function GetProductId()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('pro_id', 'pro_id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('group_id', 'group_id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('series_id', 'series_id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('catalog_key', 'catalog_key', 'required|xss_clean|trim');
            $this->form_validation->set_rules('catalog_value', 'catalog_value', 'required|xss_clean|trim');
            if ($this->form_validation->run() == true) {
                $pro_id = $this->input->post('pro_id');
                $group_id = $this->input->post('group_id');
                $series_id = $this->input->post('series_id');
                $catalog_key = $this->input->post('catalog_key');
                $catalog_value = $this->input->post('catalog_value');
                $existing_pro_data = $this->db->get_where('tbl_products', array('pro_id' => $pro_id, 'group_id' => $group_id, 'series_id' => $series_id))->row();
                $catalogValues = json_decode($existing_pro_data->catalog_values);
                // print_r($catalogValues);
                $catalogValues[$catalog_key] = $catalog_value;
                // print_r($catalogValues);
                // die();
                $new_pro_data = $this->db->like('catalog_values', json_encode($catalogValues))->get_where('tbl_products', array('group_id' => $group_id, 'series_id' => $series_id))->row();
                if (!empty($new_pro_data)) {
                    $res = array(
                        'message' => $new_pro_data->pro_id,
                        'status' => 200
                    );
                    echo json_encode($res);
                } else {
                    $res = array(
                        'message' => 'No combination found!',
                        'status' => 201
                    );
                    echo json_encode($res);
                }
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

    //--- Update Product Price ---------
    public  function UpdatePrice()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('pro_id', 'pro_id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('price', 'price', 'required|xss_clean|trim');
            if ($this->form_validation->run() == true) {
                $pro_id = $this->input->post('pro_id');
                $price = $this->input->post('price');
                $pro_data = $this->db->get_where('tbl_products', array('pro_id' => $pro_id))->row();
                if (!empty($pro_data)) {
                    $pr_data = $this->db->get_where('tbl_price_rule', array())->row();
                    $multiplier = $pr_data->multiplier;
                    $cost_price = $pro_data->price + $price;
                    $retail = $cost_price * $multiplier;
                    $now_price = $cost_price;
                    if ($cost_price <= 500) {
                        $cost_price2 = $cost_price * $cost_price;
                        $number = round($cost_price * ($pr_data->cost_price1 * $cost_price2 + $pr_data->cost_price2 * $cost_price + $pr_data->cost_price3), 2);
                        $unit = 5;
                        $remainder = $number % $unit;
                        $mround = ($remainder < $unit / 2) ? $number - $remainder : $number + ($unit - $remainder);
                        $now_price = round($mround) - 1 + 0.95;
                    } else if ($cost_price > 500) {
                        $number = round($cost_price * ($pr_data->cost_price4 * $cost_price / $multiplier + $pr_data->cost_price5));
                        $unit = 5;
                        $remainder = $number % $unit;
                        $mround = ($remainder < $unit / 2) ? $number - $remainder : $number + ($unit - $remainder);
                        $now_price = round($mround) - 1 + 0.95;
                    }
                    $saved = round($retail - $now_price);
                    $dis_percent = $saved / $retail * 100;

                    $data['now_price'] = number_format($now_price, 2);
                    $data['saved'] = number_format($saved, 2);
                    $data['dis_percent'] = number_format($dis_percent, 2);
                    $data['retail'] = number_format($retail, 2);

                    $res = array(
                        'message' => 'success',
                        'status' => 200,
                        'data' => $data
                    );
                    echo json_encode($res);
                } else {
                    $res = array(
                        'message' => 'No combination found!',
                        'status' => 201
                    );
                    echo json_encode($res);
                }
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
    public function all_products_old($idd, $t)
    {
        // echo 4;die();
        $id = $idd;
        $page = base64_decode($t);
        $sort_type = $this->input->get('sort_type');
        $data['page'] = $t;
        $data['level_id'] = $idd;
        $data['sort_type'] = $sort_type;
        if ($sort_type == 0) {
            $sort_type = "";
        }
        if ($page == 3) {

            //pagination code
            $config = array();
            $config["base_url"] = base_url() . "Home/all_products/" . $id . "/" . $t;
            $this->db->select('*');
            $this->db->from('tbl_products');
            $this->db->group_by(array("sku_series", "sku_series_type1"));
            $this->db->where('category', $id);
            $this->db->where('is_active', 1);
            $config["total_rows"] = $this->db->count_all_results();
            // echo  $config["total_rows"];die();
            $config["per_page"] = 100;
            $config["uri_segment"] = 6;
            $this->pagination->initialize($config);
            // $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
            $page = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
            $data["links"] = $this->pagination->create_links();
            // Category
            // $data['cate_id']= $idd;
            $data['sub_id'] = "";
            $data['minorsub_id'] = "";
            $data['minorsub_name'] = "";
            $data['subcategory_id'] = "";
            $this->db->distinct();
            $this->db->select('sku_series');
            $this->db->where('sub_category', $id);
            $this->db->where('is_active', 1);
            $query = $this->db->get('tbl_products');
            $data['product_count'] = $query->num_rows();
            // 	$this->db->select('*');
            // $this->db->from('tbl_products');
            // $this->db->group_by(array("sku_series", "sku_series_type1"));
            // $this->db->where('category',$id);
            // $this->db->where('is_active', 1);
            // $data['product_count']= $this->db->count_all_results();
            $this->db->select('*');
            $this->db->from('tbl_category');
            $this->db->where('id', $id);
            $this->db->where('is_active', 1);
            $cate_da = $this->db->get()->row();
            if (!empty($cate_da)) {
                $cate_name = $cate_da->name;
            } else {
                $cate_name = "";
                $category_id = "";
                $subcate_name = "";
                $cate_name = "";
            }
            $data['category_id'] = $idd;
            $data['subcategory_name'] = "";
            $data['category_name'] = $cate_name;
            $ringsize = $this->input->get('ringsize');
            $product_type = $this->input->get('product_type');
            $totalweight = $this->input->get('totalweight');
            $dclarity = $this->input->get('dclarity');
            $dcolor = $this->input->get('dcolor');
            if (!empty($ringsize)) {
                //sorting logic start
                if (!empty($sort_type)) {
                    if ($sort_type == 1) {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('category', $id);
                        $this->db->where('ringsize', $ringsize);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('id', "DESC");
                        $data['product'] = $this->db->get();
                    } elseif ($sort_type == 2) {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('category', $id);
                        $this->db->where('ringsize', $ringsize);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('price', "DESC");
                        $data['product'] = $this->db->get();
                    } else {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('category', $id);
                        $this->db->where('ringsize', $ringsize);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('price', "ASC");
                        $data['product'] = $this->db->get();
                    }
                } else {
                    $this->db->select('*');
                    $this->db->from('tbl_products');
                    $this->db->group_by(array("sku_series", "sku_series_type1"));
                    $this->db->where('category', $id);
                    $this->db->where('ringsize', $ringsize);
                    $this->db->where('is_active', 1);
                    $data['product'] = $this->db->get();
                }
                //sorting logic end
                $data['flter_name'] = $ringsize;
            } elseif (!empty($dcolor)) {
                //sorting logic start
                if (!empty($sort_type)) {
                    if ($sort_type == 1) {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('category', $id);
                        $this->db->where('dcolor', $dcolor);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('id', "DESC");
                        $data['product'] = $this->db->get();
                    } elseif ($sort_type == 2) {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('category', $id);
                        $this->db->where('dcolor', $dcolor);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('price', "DESC");
                        $data['product'] = $this->db->get();
                    } else {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('category', $id);
                        $this->db->where('dcolor', $dcolor);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('price', "ASC");
                        $data['product'] = $this->db->get();
                    }
                } else {
                    $this->db->select('*');
                    $this->db->from('tbl_products');
                    $this->db->group_by(array("sku_series", "sku_series_type1"));
                    $this->db->where('category', $id);
                    $this->db->where('dcolor', $dcolor);
                    $this->db->where('is_active', 1);
                    $data['product'] = $this->db->get();
                }
                //sorting logic end
                $data['flter_name'] = $dcolor;
            } elseif (!empty($product_type)) {
                //sorting logic start
                if (!empty($sort_type)) {
                    if ($sort_type == 1) {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('category', $id);
                        $this->db->where('product_type', $product_type);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('id', "DESC");
                        $data['product'] = $this->db->get();
                    } elseif ($sort_type == 2) {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('category', $id);
                        $this->db->where('product_type', $product_type);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('price', "DESC");
                        $data['product'] = $this->db->get();
                    } else {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('category', $id);
                        $this->db->where('product_type', $product_type);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('price', "ASC");
                        $data['product'] = $this->db->get();
                    }
                } else {
                    $this->db->select('*');
                    $this->db->from('tbl_products');
                    $this->db->group_by(array("sku_series", "sku_series_type1"));
                    $this->db->where('category', $id);
                    $this->db->where('product_type', $product_type);
                    $this->db->where('is_active', 1);
                    $data['product'] = $this->db->get();
                }
                //sorting logic end
                $data['flter_name'] = $product_type;
            } elseif (!empty($totalweight)) {
                //sorting logic start
                if (!empty($sort_type)) {
                    if ($sort_type == 1) {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('category', $id);
                        $this->db->where('totalweight', $totalweight);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('id', "DESC");
                        $data['product'] = $this->db->get();
                    } elseif ($sort_type == 2) {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('category', $id);
                        $this->db->where('totalweight', $totalweight);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('price', "DESC");
                        $data['product'] = $this->db->get();
                    } else {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('category', $id);
                        $this->db->where('totalweight', $totalweight);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('price', "ASC");
                        $data['product'] = $this->db->get();
                    }
                } else {
                    $this->db->select('*');
                    $this->db->from('tbl_products');
                    $this->db->group_by(array("sku_series", "sku_series_type1"));
                    $this->db->where('category', $id);
                    $this->db->where('totalweight', $totalweight);
                    $this->db->where('is_active', 1);
                    $data['product'] = $this->db->get();
                }
                //sorting logic end
                $data['flter_name'] = $totalweight;
            } elseif (!empty($dclarity)) {
                //sorting logic start
                if (!empty($sort_type)) {
                    if ($sort_type == 1) {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('category', $id);
                        $this->db->where('dclarity', $dclarity);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('id', "DESC");
                        $data['product'] = $this->db->get();
                    } elseif ($sort_type == 2) {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('category', $id);
                        $this->db->where('dclarity', $dclarity);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('price', "DESC");
                        $data['product'] = $this->db->get();
                    } else {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('category', $id);
                        $this->db->where('dclarity', $dclarity);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('price', "ASC");
                        $data['product'] = $this->db->get();
                    }
                } else {
                    $this->db->select('*');
                    $this->db->from('tbl_products');
                    $this->db->group_by(array("sku_series", "sku_series_type1"));
                    $this->db->where('category', $id);
                    $this->db->where('dclarity', $dclarity);
                    $this->db->where('is_active', 1);
                    $data['product'] = $this->db->get();
                }
                //sorting logic end
                $data['flter_name'] = $dclarity;
            } else {
                //sorting logic start
                if (!empty($sort_type)) {
                    if ($sort_type == 1) {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('category', $id);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('id', "DESC");
                        $data['product'] = $this->db->get();
                    } elseif ($sort_type == 2) {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('category', $id);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('price', "DESC");
                        $data['product'] = $this->db->get();
                    } else {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('category', $id);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('price', "ASC");
                        $data['product'] = $this->db->get();
                    }
                } else {
                    $this->db->select('*');
                    $this->db->from('tbl_products');
                    // $this->db->group_by(array("sku_series", "sku_series_type1"));
                    $this->db->where('category', $id);
                    $this->db->where('is_active', 1);
                    // $this->db->limit($config["per_page"], $page);
                    $data['product'] = $this->db->get();
                    // echo $data['product'];
                    // exit;
                }
                //sorting logic end
            }
        } elseif ($page == 0) {

            //pagination code
            $config = array();
            $config["base_url"] = base_url() . "Home/all_products/" . $id . "/" . $t;
            $this->db->distinct();
            $this->db->select('sku_series');
            $this->db->where('sub_category', $id);
            $query = $this->db->get('tbl_products');
            $config["total_rows"] = $query->num_rows();;
            // print_r($config["total_rows"]);
            // exit;
            $config["per_page"] = 100;
            $config["uri_segment"] = 4;
            $this->pagination->initialize($config);
            // $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
            $data["links"] = $this->pagination->create_links();
            // echo $page; print_r($data["links"]); die();
            // echo "f"; die();
            // subcategory
            $data['sub_id'] = $idd;
            $data['minorsub_id'] = "";
            $data['minorsub_name'] = "";
            $data['subcategory_id'] = $idd;
            $this->db->distinct();
            $this->db->select('sku_series');
            $this->db->where('sub_category', $id);
            $this->db->where('is_active', 1);
            $query = $this->db->get('tbl_products');
            $data['product_count'] = $query->num_rows();
            // 	$this->db->select('*');
            // $this->db->from('tbl_products');
            // $this->db->group_by(array("sku_series", "sku_series_type1"));
            // $this->db->where('sub_category',$id);
            // $this->db->where('is_active', 1);
            // $data['product_count']= $this->db->count_all_results();
            $this->db->select('*');
            $this->db->from('tbl_sub_category');
            $this->db->where('id', $id);
            $this->db->where('is_active', 1);
            $subcate_da = $this->db->get()->row();
            if (!empty($subcate_da)) {
                $subcate_name = $subcate_da->name;
                $category_id = $subcate_da->category;
                $this->db->select('*');
                $this->db->from('tbl_category');
                $this->db->where('id', $category_id);
                $this->db->where('is_active', 1);
                $cate_da = $this->db->get()->row();
                if (!empty($cate_da)) {
                    $cate_name = $cate_da->name;
                } else {
                    $cate_name = "";
                }
            } else {
                $category_id = "";
                $subcate_name = "";
                $cate_name = "";
            }
            $data['category_id'] = $category_id;
            $data['subcategory_name'] = $subcate_name;
            $data['category_name'] = $cate_name;
            $ringsize = $this->input->get('ringsize');
            $product_type = $this->input->get('product_type');
            $totalweight = $this->input->get('totalweight');
            $dclarity = $this->input->get('dclarity');
            $dcolor = $this->input->get('dcolor');
            if (!empty($ringsize)) {
                //sorting logic start
                if (!empty($sort_type)) {
                    if ($sort_type == 1) {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('sub_category', $id);
                        $this->db->where('ringsize', $ringsize);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('id', "DESC");
                        $data['product'] = $this->db->get();
                    } elseif ($sort_type == 2) {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('sub_category', $id);
                        $this->db->where('ringsize', $ringsize);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('price', "DESC");
                        $data['product'] = $this->db->get();
                    } else {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('sub_category', $id);
                        $this->db->where('ringsize', $ringsize);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('price', "ASC");
                        $data['product'] = $this->db->get();
                    }
                } else {
                    $this->db->select('*');
                    $this->db->from('tbl_products');
                    $this->db->group_by(array("sku_series", "sku_series_type1"));
                    $this->db->where('sub_category', $id);
                    $this->db->where('ringsize', $ringsize);
                    $this->db->where('is_active', 1);
                    $data['product'] = $this->db->get();
                }
                //sorting logic end
                $data['flter_name'] = $ringsize;
            } elseif (!empty($dcolor)) {
                //sorting logic start
                if (!empty($sort_type)) {
                    if ($sort_type == 1) {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('sub_category', $id);
                        $this->db->where('dcolor', $dcolor);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('id', "DESC");
                        $data['product'] = $this->db->get();
                    } elseif ($sort_type == 2) {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('sub_category', $id);
                        $this->db->where('dcolor', $dcolor);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('price', "DESC");
                        $data['product'] = $this->db->get();
                    } else {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('sub_category', $id);
                        $this->db->where('dcolor', $dcolor);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('price', "ASC");
                        $data['product'] = $this->db->get();
                    }
                } else {
                    $this->db->select('*');
                    $this->db->from('tbl_products');
                    $this->db->group_by(array("sku_series", "sku_series_type1"));
                    $this->db->where('sub_category', $id);
                    $this->db->where('dcolor', $dcolor);
                    $this->db->where('is_active', 1);
                    $data['product'] = $this->db->get();
                }
                //sorting logic end
                $data['flter_name'] = $dcolor;
            } elseif (!empty($product_type)) {
                //sorting logic start
                if (!empty($sort_type)) {
                    if ($sort_type == 1) {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('sub_category', $id);
                        $this->db->where('product_type', $product_type);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('id', "DESC");
                        $data['product'] = $this->db->get();
                    } elseif ($sort_type == 2) {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('sub_category', $id);
                        $this->db->where('product_type', $product_type);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('price', "DESC");
                        $data['product'] = $this->db->get();
                    } else {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('sub_category', $id);
                        $this->db->where('product_type', $product_type);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('price', "ASC");
                        $data['product'] = $this->db->get();
                    }
                } else {
                    $this->db->select('*');
                    $this->db->from('tbl_products');
                    $this->db->group_by(array("sku_series", "sku_series_type1"));
                    $this->db->where('sub_category', $id);
                    $this->db->where('product_type', $product_type);
                    $this->db->where('is_active', 1);
                    $data['product'] = $this->db->get();
                }
                //sorting logic end
                $data['flter_name'] = $product_type;
            } elseif (!empty($totalweight)) {
                //sorting logic start
                if (!empty($sort_type)) {
                    if ($sort_type == 1) {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('sub_category', $id);
                        $this->db->where('totalweight', $totalweight);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('id', "DESC");
                        $data['product'] = $this->db->get();
                    } elseif ($sort_type == 2) {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('sub_category', $id);
                        $this->db->where('totalweight', $totalweight);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('price', "DESC");
                        $data['product'] = $this->db->get();
                    } else {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('sub_category', $id);
                        $this->db->where('totalweight', $totalweight);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('price', "ASC");
                        $data['product'] = $this->db->get();
                    }
                } else {
                    $this->db->select('*');
                    $this->db->from('tbl_products');
                    $this->db->group_by(array("sku_series", "sku_series_type1"));
                    $this->db->where('sub_category', $id);
                    $this->db->where('totalweight', $totalweight);
                    $this->db->where('is_active', 1);
                    $data['product'] = $this->db->get();
                }
                //sorting logic end
                $data['flter_name'] = $totalweight;
            } elseif (!empty($dclarity)) {
                //sorting logic start
                if (!empty($sort_type)) {
                    if ($sort_type == 1) {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('sub_category', $id);
                        $this->db->where('dclarity', $dclarity);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('id', "DESC");
                        $data['product'] = $this->db->get();
                    } elseif ($sort_type == 2) {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('sub_category', $id);
                        $this->db->where('dclarity', $dclarity);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('price', "DESC");
                        $data['product'] = $this->db->get();
                    } else {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('sub_category', $id);
                        $this->db->where('dclarity', $dclarity);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('price', "ASC");
                        $data['product'] = $this->db->get();
                    }
                } else {
                    $this->db->select('*');
                    $this->db->from('tbl_products');
                    $this->db->group_by(array("sku_series", "sku_series_type1"));
                    $this->db->where('sub_category', $id);
                    $this->db->where('dclarity', $dclarity);
                    $this->db->where('is_active', 1);
                    $data['product'] = $this->db->get();
                }
                //sorting logic end
                $data['flter_name'] = $dclarity;
            } else {
                // echo "hi";
                // exit;
                //sorting logic start
                if (!empty($sort_type)) {
                    if ($sort_type == 1) {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('sub_category', $id);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('id', "DESC");
                        $data['product'] = $this->db->get();
                    } elseif ($sort_type == 2) {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('sub_category', $id);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('price', "DESC");
                        $data['product'] = $this->db->get();
                    } else {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('sub_category', $id);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('price', "ASC");
                        $data['product'] = $this->db->get();
                    }
                } else {
                    $this->db->distinct();
                    $this->db->select('*');
                    $this->db->where('sub_category', $id);
                    $this->db->where('is_active', 1);
                    $data['product'] = $this->db->get('tbl_products');
                    // $this->db->select('*');
                    // $this->db->from('tbl_products');
                    // $this->db->where('is_active', 1);
                    // $this->db->group_by(array("series_id"));
                    // $data['product'] = $this->db->get();
                    // echo $data['product'];
                    // die();
                    // $this->db->select('*');
                    //
                    // $this->db->from('tbl_products');
                    // $this->db->group_by(array("sku_series", "sku_series_type1"));
                    // $this->db->where('sub_category',$id);
                    // $this->db->where('is_active', 1);
                    // $this->db->limit($config["per_page"], $page);
                    // $data['product']= $this->db->get();
                    // print_r($data['product']);
                    // exit;
                }
                //sorting logic end
            }
        } else {

            // echo $id;
            // exit;
            //minor subcategory
            //pagination code
            $config = array();
            $config["base_url"] = base_url() . "Home/all_products/" . $id . "/" . $t;
            $this->db->select('*');
            $this->db->from('tbl_products');
            $this->db->group_by(array("sku_series", "sku_series_type1"));
            $this->db->where('minisub_category', $id);
            $this->db->where('is_active', 1);
            $config["total_rows"] = $this->db->count_all_results();
            //  echo $config["total_rows"];
            // exit;
            $config["per_page"] = 100;
            $config["uri_segment"] = 6;
            $this->pagination->initialize($config);
            // $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
            $page = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
            $data["links"] = $this->pagination->create_links();
            $data['minorsub_id'] = $idd;
            $data['sub_id'] = "";
            // 	$this->db->select('*');
            // $this->db->from('tbl_products');
            // $this->db->group_by(array("sku_series", "sku_series_type1"));
            // $this->db->where('minisub_category',$id);
            // $this->db->where('is_active', 1);
            // $data['product_count']= $this->db->count_all_results();
            $this->db->distinct();
            $this->db->select('sku_series');
            $this->db->from('tbl_products');
            $this->db->group_by(array("sku_series", "sku_series_type1"));
            $this->db->where('minisub_category', $id);
            $this->db->where('is_active', 1);
            $data['product_count'] = $this->db->count_all_results();
            $this->db->select('*');
            $this->db->from('tbl_minisubcategory');
            $this->db->where('id', $id);
            $this->db->where('is_active', 1);
            $minorsubcate_da = $this->db->get()->row();
            if (!empty($minorsubcate_da)) {
                $minorsubcate_name = $minorsubcate_da->name;
                $description = $minorsubcate_da->description;
                $category_id = $minorsubcate_da->category;
                $subcategory_id = $minorsubcate_da->subcategory;
                $this->db->select('*');
                $this->db->from('tbl_category');
                $this->db->where('id', $category_id);
                $this->db->where('is_active', 1);
                $cate_da = $this->db->get()->row();
                if (!empty($cate_da)) {
                    $cate_name = $cate_da->name;
                } else {
                    $cate_name = "";
                }
                $this->db->select('*');
                $this->db->from('tbl_sub_category');
                $this->db->where('id', $subcategory_id);
                $this->db->where('is_active', 1);
                $subcate_da = $this->db->get()->row();
                if (!empty($subcate_da)) {
                    $subcate_name = $subcate_da->name;
                } else {
                    $subcate_name = "";
                }
            } else {
                $category_id = "";
                $subcategory_id = "";
                $subcate_name = "N/A";
                $cate_name = "N/A";
                $minorsubcate_name = "N/A";
                $description = "N/A";
            }
            $data['category_id'] = $category_id;
            $data['subcategory_id'] = $subcategory_id;
            $data['subcategory_name'] = $subcate_name;
            $data['category_name'] = $cate_name;
            $data['minorsub_name'] = $minorsubcate_name;
            $data['description'] = $description;
            $ringsize = $this->input->get('ringsize');
            $product_type = $this->input->get('product_type');
            $totalweight = $this->input->get('totalweight');
            $dclarity = $this->input->get('dclarity');
            $dcolor = $this->input->get('dcolor');
            if (!empty($ringsize)) {
                //sorting logic start
                if (!empty($sort_type)) {
                    if ($sort_type == 1) {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('minisub_category', $id);
                        $this->db->where('ringsize', $ringsize);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('id', "DESC");
                        $data['product'] = $this->db->get();
                    } elseif ($sort_type == 2) {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('minisub_category', $id);
                        $this->db->where('ringsize', $ringsize);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('price', "DESC");
                        $data['product'] = $this->db->get();
                    } else {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('minisub_category', $id);
                        $this->db->where('ringsize', $ringsize);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('price', "ASC");
                        $data['product'] = $this->db->get();
                    }
                } else {
                    $this->db->select('*');
                    $this->db->from('tbl_products');
                    $this->db->group_by(array("sku_series", "sku_series_type1"));
                    $this->db->where('minisub_category', $id);
                    $this->db->where('ringsize', $ringsize);
                    $this->db->where('is_active', 1);
                    $data['product'] = $this->db->get();
                }
                //sorting logic end
                $data['flter_name'] = $ringsize;
            } elseif (!empty($dcolor)) {
                //sorting logic start
                if (!empty($sort_type)) {
                    if ($sort_type == 1) {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('minisub_category', $id);
                        $this->db->where('dcolor', $dcolor);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('id', "DESC");
                        $data['product'] = $this->db->get();
                    } elseif ($sort_type == 2) {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('minisub_category', $id);
                        $this->db->where('dcolor', $dcolor);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('price', "DESC");
                        $data['product'] = $this->db->get();
                    } else {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('minisub_category', $id);
                        $this->db->where('dcolor', $dcolor);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('price', "ASC");
                        $data['product'] = $this->db->get();
                    }
                } else {
                    $this->db->select('*');
                    $this->db->from('tbl_products');
                    $this->db->group_by(array("sku_series", "sku_series_type1"));
                    $this->db->where('minisub_category', $id);
                    $this->db->where('dcolor', $dcolor);
                    $this->db->where('is_active', 1);
                    $data['product'] = $this->db->get();
                }
                //sorting logic end
                $data['flter_name'] = $dcolor;
            } elseif (!empty($product_type)) {
                //sorting logic start
                if (!empty($sort_type)) {
                    if ($sort_type == 1) {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('minisub_category', $id);
                        $this->db->where('product_type', $product_type);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('id', "DESC");
                        $data['product'] = $this->db->get();
                    } elseif ($sort_type == 2) {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('minisub_category', $id);
                        $this->db->where('product_type', $product_type);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('price', "DESC");
                        $data['product'] = $this->db->get();
                    } else {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('minisub_category', $id);
                        $this->db->where('product_type', $product_type);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('price', "ASC");
                        $data['product'] = $this->db->get();
                    }
                } else {
                    $this->db->select('*');
                    $this->db->from('tbl_products');
                    $this->db->group_by(array("sku_series", "sku_series_type1"));
                    $this->db->where('minisub_category', $id);
                    $this->db->where('product_type', $product_type);
                    $this->db->where('is_active', 1);
                    $data['product'] = $this->db->get();
                }
                //sorting logic end
                $data['flter_name'] = $product_type;
            } elseif (!empty($totalweight)) {
                //sorting logic start
                if (!empty($sort_type)) {
                    if ($sort_type == 1) {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('minisub_category', $id);
                        $this->db->where('totalweight', $totalweight);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('id', "DESC");
                        $data['product'] = $this->db->get();
                    } elseif ($sort_type == 2) {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('minisub_category', $id);
                        $this->db->where('totalweight', $totalweight);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('price', "DESC");
                        $data['product'] = $this->db->get();
                    } else {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('minisub_category', $id);
                        $this->db->where('totalweight', $totalweight);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('price', "ASC");
                        $data['product'] = $this->db->get();
                    }
                } else {
                    $this->db->select('*');
                    $this->db->from('tbl_products');
                    $this->db->group_by(array("sku_series", "sku_series_type1"));
                    $this->db->where('minisub_category', $id);
                    $this->db->where('totalweight', $totalweight);
                    $this->db->where('is_active', 1);
                    $data['product'] = $this->db->get();
                }
                //sorting logic end
                $data['flter_name'] = $totalweight;
            } elseif (!empty($dclarity)) {
                //sorting logic start
                if (!empty($sort_type)) {
                    if ($sort_type == 1) {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('minisub_category', $id);
                        $this->db->where('dclarity', $dclarity);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('id', "DESC");
                        $data['product'] = $this->db->get();
                    } elseif ($sort_type == 2) {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('minisub_category', $id);
                        $this->db->where('dclarity', $dclarity);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('price', "DESC");
                        $data['product'] = $this->db->get();
                    } else {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('minisub_category', $id);
                        $this->db->where('dclarity', $dclarity);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('price', "ASC");
                        $data['product'] = $this->db->get();
                    }
                } else {
                    $this->db->select('*');
                    $this->db->from('tbl_products');
                    $this->db->group_by(array("sku_series", "sku_series_type1"));
                    $this->db->where('minisub_category', $id);
                    $this->db->where('dclarity', $dclarity);
                    $this->db->where('is_active', 1);
                    $data['product'] = $this->db->get();
                }
                //sorting logic end
                $data['flter_name'] = $dclarity;
            } else {
                //sorting logic start
                if (!empty($sort_type)) {
                    if ($sort_type == 1) {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('minisub_category', $id);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('id', "DESC");
                        $data['product'] = $this->db->get();
                    } elseif ($sort_type == 2) {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('minisub_category', $id);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('price', "DESC");
                        $data['product'] = $this->db->get();
                    } else {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->group_by(array("sku_series", "sku_series_type1"));
                        $this->db->where('minisub_category', $id);
                        $this->db->where('is_active', 1);
                        $this->db->order_by('price', "ASC");
                        $data['product'] = $this->db->get();
                    }
                } else {
                    $this->db->select('*');
                    $this->db->from('tbl_products');
                    $this->db->group_by(array("sku_series", "sku_series_type1"));
                    $this->db->where('minisub_category', $id);
                    $this->db->where('is_active', 1);
                    // $this->db->limit($config["per_page"], $page);
                    $data['product'] = $this->db->get();
                }
                //sorting logic end
            }
        }
        // print_r($data['product']);die();
        $product1 = [];
        foreach ($data['product']->result() as $count_data) {
            // $sku1=explode(":",$data->sku);
            // $sku = $sku1[0];
            $a = 0;
            if (!empty($product1)) {
                foreach ($product1 as $value) {
                    if ($count_data->sku_series == $value['sku_series']) {
                        $a = 1;
                    }
                }
            }
            if ($a == 1) {
                continue;
            } else {
                // $this->db->select('*');
                // $this->db->from('tbl_products');
                // $this->db->where('sku_series',$data->sku_series);
                // $this->db->like('id',$data->sku_series);
                // $data['']= $this->db->get()->row();
                $image1 = '';
                $image2 = '';
                if ($count_data->gimage1) {
                    $image1 = $count_data->gimage1;
                    $image2 = $count_data->gimage2;
                } else  if ($count_data->FullySetImage1) {
                    $image1 = $count_data->FullySetImage1;
                    $image2 = $count_data->FullySetImage2;
                } else {
                    $image1 = $count_data->image1;
                    $image2 = $count_data->image2;
                }
                $product1[] = array(
                    'id' => $count_data->id,
                    'sku' => $count_data->sku,
                    'sku_series' => $count_data->sku_series,
                    'image1' => $image1,
                    'image2' => $image2,
                    'description' => $count_data->description,
                    'price' => $count_data->price,
                    'currency' => $count_data->currency,
                );
            }
        }
        $counting = 0;
        foreach ($product1 as $prod1) {
            $counting++;
        }
        $data['product1'] = $product1;
        $data['productCount'] = $counting;
        // $products=[];
        // $ss=[];
        //
        // 		if(!empty($ringsize)){
        // 		  $cc1= count($ringsize);
        //
        //
        // 		for ($i=0; $i < $cc1 ; $i++) {
        // 			 $ringsize= $ringsize[$i];
        //
        //
        //
        // 		       $this->db->select('*');
        // 		       $this->db->from('tbl_products');
        // 		       $this->db->where('ringsize',$ringsize);
        // 		 			$this->db->where('sub_category',$id);
        // 		       $this->db->where('is_active', 1);
        // 		       $sub_all_products_da[]= $this->db->get();
        // 		 // echo "   next   ";
        // 		 // print_r($sub_all_products_da);
        // 		       if(!empty($sub_all_products_da)){
        //
        //
        // 		 $ss[] = array('id' => $sub_all_products_da->id, 'categories_id' => $sub_all_products_da->categories_id, 'subcategories_id' =>$sub_all_products_da->subcategories_id , 'vendor_id' => $sub_all_products_da->vendor_id, 'name' => $sub_all_products_da->name, 'details' =>$sub_all_products_da->details ,'ldesc' => $sub_all_products_da->ldesc, 'product_tag' => $sub_all_products_da->product_tag, 'brand' =>$sub_all_products_da->brand , 'date' => $sub_all_products_da->date, 'ip' => $sub_all_products_da->ip, 'added_by' =>$sub_all_products_da->added_by , 'is_active' =>$sub_all_products_da->is_active );
        //
        // 		       }
        //
        //
        // 		 // print_r($ss);
        //
        // 		 // $data['products']= $ss;
        //
        //
        //
        // 		}
        // 		$data['product']= $ss;
        // 		}
        // print_r($ss); die();
        // echo "<pre>"; print_r($data); die();
        $this->load->view('common/header', $data);
        $this->load->view('all_products');
        $this->load->view('common/footer');
    }
    public function product_detail($idd)
    {
        $data['page_t'] = 3; // 1 for quickshop product ,2 for new arrivals, 3 for normal products
        $data['page'] = 0;
        $id = $idd;
        // echo $id;
        // exit;
        $this->db->select('*');
        $this->db->from('tbl_products');
        $this->db->where('sku', $id);
        // $this->db->where('is_active',1);
        $data['products'] = $this->db->get()->row();
        if (empty($data['products'])) {
            $this->session->set_flashdata('emessage', 'Product not found!');
            redirect("/", "refresh");
            die();
        }
        // echo($data['products']->category);	die();
        $cat_data = $this->db->get_where('tbl_category', array('is_active' => 1, 'id' =>    $data['products']->category))->result();
        $data['cat_name'] = $cat_data[0]->name;
        $data['cat_id'] = $cat_data[0]->id;
        $subcat_data = $this->db->get_where('tbl_sub_category', array('is_active' => 1, 'id' =>    $data['products']->sub_category))->result();
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
        $this->db->from('tbl_products');
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
        $this->db->from('tbl_products');
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
        $this->db->from('tbl_products');
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
        $this->db->from('tbl_products');
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
        $this->db->from('tbl_products');
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
        $this->db->from('tbl_products');
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
        // print_r($data);die();
        //get related products(Shoppers Also Bought)
        // if(!empty($minorsub_id)){
        // 	$this->db->select('*');
        // 	$this->db->from('tbl_products');
        // 	$this->db->group_by(array("sku_series", "sku_series_type1"));
        // 	$this->db->where('minisub_category',$minorsub_id);
        // 	$this->db->where('is_active',1);
        // 	$this->db->order_by('id','DESC');
        // 	$data['ralated_products']= $this->db->limit(5000)->get();
        // }else {
        // 	$this->db->select('*');
        // 	$this->db->from('tbl_products');
        // 	$this->db->group_by(array("sku_series", "sku_series_type1"));
        // 	$this->db->where('sub_category',$sub_id);
        // 	$this->db->where('is_active',1);
        // 	$this->db->order_by('id','DESC');
        // 	$data['ralated_products']= $this->db->limit(5000)->get();
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
        $this->load->view('common/header', $data);
        $this->load->view('product_detail');
        $this->load->view('common/footer');
    }
    public function pro_change()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('col', 'col', 'required|xss_clean|trim');
            $this->form_validation->set_rules('value', 'value', 'required|xss_clean|trim');
            $this->form_validation->set_rules('sku_series', 'sku_series', 'required|xss_clean|trim');
            $this->form_validation->set_rules('gdesc', 'gdesc', 'xss_clean|trim');
            $this->form_validation->set_rules('desc_e_value2', 'desc_e_value2', 'required|xss_clean|trim');
            $this->form_validation->set_rules('desc_e_value3', 'desc_e_value3', 'required|xss_clean|trim');
            $this->form_validation->set_rules('desc_e_value4', 'desc_e_value4', 'required|xss_clean|trim');
            $this->form_validation->set_rules('desc_e_value5', 'desc_e_value5', 'xss_clean|trim');
            $this->form_validation->set_rules('desc_e_value6', 'desc_e_value6', 'xss_clean|trim');
            $this->form_validation->set_rules('desc_e_value7', 'desc_e_value7', 'xss_clean|trim');
            $this->form_validation->set_rules('desc_e_value8', 'desc_e_value8', 'xss_clean|trim');
            $this->form_validation->set_rules('desc_e_value9', 'desc_e_value9', 'xss_clean|trim');
            $this->form_validation->set_rules('desc_e_value10', 'desc_e_value10', 'xss_clean|trim');
            $this->form_validation->set_rules('desc_e_value11', 'desc_e_value11', 'xss_clean|trim');
            $this->form_validation->set_rules('dropdownName', 'dropdownName', 'xss_clean|trim'); //--------Quality Name
            $this->form_validation->set_rules('qty', 'qty', 'xss_clean|trim');
            $this->form_validation->set_rules('pid', 'pid', 'xss_clean|trim');
            $this->form_validation->set_rules('para', 'para', 'xss_clean|trim'); //------- 1 for image, 0 for dropdown, 2 for jewelry State
            $this->form_validation->set_rules('active', 'active', 'xss_clean|trim'); //-------------Shape of stone
            if ($this->form_validation->run() == TRUE) {
                $pid = $this->input->post('pid');
                $qty = $this->input->post('qty');
                $col = $this->input->post('col');
                $para = $this->input->post('para');
                $value = $this->input->post('value');
                $gdesc = $this->input->post('gdesc');
                $active = $this->input->post('active');
                $sku_series = $this->input->post('sku_series');
                $desc_e_value2 = $this->input->post('desc_e_value2');
                $desc_e_value3 = $this->input->post('desc_e_value3');
                $desc_e_value4 = $this->input->post('desc_e_value4');
                $desc_e_value5 = $this->input->post('desc_e_value5');
                $desc_e_value6 = $this->input->post('desc_e_value6');
                $desc_e_value7 = $this->input->post('desc_e_value7');
                $desc_e_value8 = $this->input->post('desc_e_value8');
                $desc_e_value9 = $this->input->post('desc_e_value9');
                $desc_e_value10 = $this->input->post('desc_e_value10');
                $desc_e_value11 = $this->input->post('desc_e_value11');
                $dropdownName = $this->input->post('dropdownName');
                //----------1 for image, 0 for dropdown, 2 for jewelry state--------------
                if ($para == 0) {
                    $this->db->select('*');
                    $this->db->from('tbl_products');
                    $this->db->where('sku_series', $sku_series);
                    $this->db->where('desc_e_value2', $desc_e_value2);
                    $this->db->where('desc_e_value3', $desc_e_value3);
                    $this->db->where('desc_e_value4', $desc_e_value4);
                    $this->db->where('desc_e_value5', $desc_e_value5);
                    $this->db->where('desc_e_value6', $desc_e_value6);
                    $this->db->where('desc_e_value7', $desc_e_value7);
                    $this->db->where('desc_e_value8', $desc_e_value8);
                    $this->db->where('desc_e_value9', $desc_e_value9);
                    $this->db->where('desc_e_value10', $desc_e_value10);
                    $this->db->where('desc_e_value11', $desc_e_value11);
                    $pro_data = $this->db->get()->row();
                    if (empty($pro_data)) {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->where('sku_series', $sku_series);
                        $this->db->where('desc_e_value2', $desc_e_value2);
                        $this->db->where('desc_e_value3', $desc_e_value3);
                        $this->db->where('desc_e_value4', $desc_e_value4);
                        $this->db->where('desc_e_value5', $desc_e_value5);
                        if ($col !== 'desc_e_value2' && $col !== 'desc_e_value3' && $col !== 'desc_e_value4' && $col !== 'desc_e_value5') {
                            $this->db->where($col, $value);
                        }
                        $pro_data = $this->db->get()->row();
                    }
                    $this->db->select('*');
                    $this->db->from('tbl_products');
                    $this->db->where('sku_series', $sku_series);
                    $this->db->where('gdesc', $gdesc);
                    $this->db->where($col, $value);
                    $quality_data = $this->db->get()->row();
                    // print_r($pro_data);die();
                    $column_shape = "";
                    $column_quality = "";
                    $column_jstate = "";
                    $column_product = "";
                    //-----shape of stone------
                    if ($desc_e_value2 == $active && !empty($desc_e_value2) && $col !== 'desc_e_value2') {
                        $column_shape = 'desc_e_value2';
                    }
                    if ($desc_e_value3 == $active && !empty($desc_e_value3) && $col !== 'desc_e_value3') {
                        $column_shape = 'desc_e_value3';
                    }
                    if ($desc_e_value4 == $active && !empty($desc_e_value4) && $col !== 'desc_e_value4') {
                        $column_shape = 'desc_e_value4';
                    }
                    if ($desc_e_value5 == $active && !empty($desc_e_value5) && $col !== 'desc_e_value5') {
                        $column_shape = 'desc_e_value5';
                    }
                    if ($desc_e_value6 == $active && !empty($desc_e_value6) && $col !== 'desc_e_value6') {
                        $column_shape = 'desc_e_value6';
                    }
                    if ($desc_e_value7 == $active && !empty($desc_e_value7) && $col !== 'desc_e_value7') {
                        $column_shape = 'desc_e_value7';
                    }
                    if ($desc_e_value8 == $active && !empty($desc_e_value8) && $col !== 'desc_e_value8') {
                        $column_shape = 'desc_e_value8';
                    }
                    if ($desc_e_value9 == $active && !empty($desc_e_value9) && $col !== 'desc_e_value9') {
                        $column_shape = 'desc_e_value9';
                    }
                    if ($desc_e_value10 == $active && !empty($desc_e_value10)  && $col !== 'desc_e_value10') {
                        $column_shape = 'desc_e_value10';
                    }
                    //-----quality----------
                    if ($quality_data->desc_e_name2 == 'Quality' && $col !== 'desc_e_value2') {
                        $column_quality = 'desc_e_value2';
                    }
                    if ($quality_data->desc_e_name3 == 'Quality' && $col !== 'desc_e_value3') {
                        $column_quality = 'desc_e_value3';
                    }
                    if ($quality_data->desc_e_name4 == 'Quality' && $col !== 'desc_e_value4') {
                        $column_quality = 'desc_e_value4';
                    }
                    if ($quality_data->desc_e_name5 == 'Quality' && $col !== 'desc_e_value5') {
                        $column_quality = 'desc_e_value5';
                    }
                    if ($quality_data->desc_e_name6 == 'Quality' && $col !== 'desc_e_value6') {
                        $column_quality = 'desc_e_value6';
                    }
                    if ($quality_data->desc_e_name7 == 'Quality' && $col !== 'desc_e_value7') {
                        $column_quality = 'desc_e_value7';
                    }
                    if ($quality_data->desc_e_name8 == 'Quality' && $col !== 'desc_e_value8') {
                        $column_quality = 'desc_e_value8';
                    }
                    if ($quality_data->desc_e_name9 == 'Quality' && $col !== 'desc_e_value9') {
                        $column_quality = 'desc_e_value9';
                    }
                    //------ jewelry state---------
                    if ($quality_data->desc_e_name2 == 'Jewelry State' && $col !== 'desc_e_value2') {
                        $column_jstate = 'desc_e_value2';
                        $value_jstate = $desc_e_value2;
                    }
                    if ($quality_data->desc_e_name3 == 'Jewelry State' && $col !== 'desc_e_value3') {
                        $column_jstate = 'desc_e_value3';
                        $value_jstate = $desc_e_value3;
                    }
                    if ($quality_data->desc_e_name4 == 'Jewelry State' && $col !== 'desc_e_value4') {
                        $column_jstate = 'desc_e_value4';
                        $value_jstate = $desc_e_value4;
                    }
                    if ($quality_data->desc_e_name5 == 'Jewelry State' && $col !== 'desc_e_value5') {
                        $column_jstate = 'desc_e_value5';
                        $value_jstate = $desc_e_value5;
                    }
                    if ($quality_data->desc_e_name6 == 'Jewelry State' && $col !== 'desc_e_value6') {
                        $column_jstate = 'desc_e_value6';
                        $value_jstate = $desc_e_value6;
                    }
                    if ($quality_data->desc_e_name7 == 'Jewelry State' && $col !== 'desc_e_value7') {
                        $column_jstate = 'desc_e_value7';
                        $value_jstate = $desc_e_value7;
                    }
                    if ($quality_data->desc_e_name8 == 'Jewelry State' && $col !== 'desc_e_value8') {
                        $column_jstate = 'desc_e_value8';
                        $value_jstate = $desc_e_value8;
                    }
                    if ($quality_data->desc_e_name9 == 'Jewelry State' && $col !== 'desc_e_value9') {
                        $column_jstate = 'desc_e_value9';
                        $value_jstate = $desc_e_value9;
                    }
                    //------ Product - Engagement ring/Band/Shank---------
                    if ($quality_data->desc_e_name2 == 'Product' && $col !== 'desc_e_value2') {
                        $column_product = 'desc_e_value2';
                        $value_product = $desc_e_value2;
                    }
                    if ($quality_data->desc_e_name3 == 'Product' && $col !== 'desc_e_value3') {
                        $column_product = 'desc_e_value3';
                        $value_product = $desc_e_value3;
                    }
                    if ($quality_data->desc_e_name4 == 'Product' && $col !== 'desc_e_value4') {
                        $column_product = 'desc_e_value4';
                        $value_product = $desc_e_value4;
                    }
                    if ($quality_data->desc_e_name5 == 'Product' && $col !== 'desc_e_value5') {
                        $column_product = 'desc_e_value5';
                        $value_product = $desc_e_value5;
                    }
                    if ($quality_data->desc_e_name6 == 'Product' && $col !== 'desc_e_value6') {
                        $column_product = 'desc_e_value6';
                        $value_product = $desc_e_value6;
                    }
                    if ($quality_data->desc_e_name7 == 'Product' && $col !== 'desc_e_value7') {
                        $column_product = 'desc_e_value7';
                        $value_product = $desc_e_value7;
                    }
                    if ($quality_data->desc_e_name8 == 'Product' && $col !== 'desc_e_value8') {
                        $column_product = 'desc_e_value8';
                        $value_product = $desc_e_value8;
                    }
                    if ($quality_data->desc_e_name9 == 'Product' && $col !== 'desc_e_value9') {
                        $column_product = 'desc_e_value9';
                        $value_product = $desc_e_value9;
                    }
                    if (empty($pro_data)) {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->where('sku_series', $sku_series);
                        $this->db->where($col, $value);
                        $this->db->where('gdesc', $gdesc);
                        if (!empty($column_shape) && !empty($active)) {
                            $this->db->where($column_shape, $active);
                        }
                        if (!empty($column_quality)) {
                            $this->db->where($column_quality, $dropdownName);
                        }
                        if (!empty($column_jstate)) {
                            $this->db->where($column_jstate, $value_jstate);
                        }
                        if (!empty($column_product)) {
                            $this->db->where($column_product, $value_product);
                        }
                        $pro_data = $this->db->get()->row();
                        if (empty($pro_data)) {
                            $this->db->select('*');
                            $this->db->from('tbl_products');
                            $this->db->where('sku_series', $sku_series);
                            $this->db->where('gdesc', $gdesc);
                            $this->db->where($col, $value);
                            if (!empty($column_jstate)) {
                                $this->db->where($column_jstate, $value_jstate);
                            }
                            if (!empty($column_product)) {
                                $this->db->where($column_product, $value_product);
                            }
                            $pro_data = $this->db->get()->row();
                        }
                    }
                    $this->db->select('*');
                    $this->db->from('tbl_products');
                    $this->db->where('sku_series', $pro_data->sku_series);
                    $this->db->where('gdesc', $pro_data->gdesc);
                    if (!empty($column_shape) && !empty($active)) {
                        $this->db->where($column_shape, $active);
                    }
                    if (!empty($column_quality)) {
                        $this->db->where($column_quality, $dropdownName);
                    }
                    if (!empty($column_jstate)) {
                        $this->db->where($column_jstate, $value_jstate);
                    }
                    if (!empty($column_product)) {
                        $this->db->where($column_product, $value_product);
                    }
                    $d2 = $this->db->get();
                    // echo $column_jstate;die();
                    $b = 0;
                    $Quality = [];
                    foreach ($d2->result() as $quality) {
                        if (!empty($s)) {
                            $Quality = array_merge(array('quality' . $b => $quality->$s), $Quality);
                            // print_r($B1);
                        }
                        $b++;
                    }
                    $Quality =  json_encode(array_unique($Quality));
                    // echo $Quality;die();
                    $b = 0;
                    $B1 = [];
                    if ($column_jstate != 'desc_e_value2' && $column_product != 'desc_e_value2') {
                        foreach ($d2->result() as $b111) {
                            if (!empty($desc_e_value2)) {
                                if ($pro_data->desc_e_value1 == $b111->desc_e_value1) {
                                    $B1 = array_merge(array('desc_e_value2' . $b => $b111->desc_e_value2), $B1);
                                }
                                // print_r($B1);
                            }
                            $b++;
                        }
                        $B1 =  json_encode(array_unique($B1));
                    } else {
                        $B1 = "";
                    }
                    $b = 0;
                    $B2 = [];
                    if ($column_jstate != 'desc_e_value3' && $column_product != 'desc_e_value3') {
                        foreach ($d2->result() as $b222) {
                            if (!empty($desc_e_value3)) {
                                if ($pro_data->desc_e_value1 == $b222->desc_e_value1 && $pro_data->desc_e_value2 == $b222->desc_e_value2) {
                                    $B2 = array_merge(array('desc_e_value3' . $b => $b222->desc_e_value3), $B2);
                                }
                            }
                            $b++;
                        }
                        $B2 =  json_encode(array_unique($B2));
                    } else {
                        $B2 = "";
                    }
                    $b = 0;
                    $B3 = [];
                    if ($column_jstate != 'desc_e_value4' && $column_product != 'desc_e_value4') {
                        foreach ($d2->result() as $b333) {
                            if (!empty($desc_e_value4)) {
                                if ($pro_data->desc_e_value1 == $b333->desc_e_value1 && $pro_data->desc_e_value2 == $b333->desc_e_value2 && $pro_data->desc_e_value3 == $b333->desc_e_value3) {
                                    $B3 = array_merge(array('desc_e_value4' . $b => $b333->desc_e_value4), $B3);
                                }
                            }
                            $b++;
                        }
                        $B3 =  json_encode(array_unique($B3));
                    } else {
                        $B3 = "";
                    }
                    $b = 0;
                    $B4 = [];
                    if ($column_jstate != 'desc_e_value5' && $column_product != 'desc_e_value5') {
                        foreach ($d2->result() as $b444) {
                            if (!empty($desc_e_value5)) {
                                if ($pro_data->desc_e_value1 == $b444->desc_e_value1 && $pro_data->desc_e_value2 == $b444->desc_e_value2 && $pro_data->desc_e_value3 == $b444->desc_e_value3 && $pro_data->desc_e_value4 == $b444->desc_e_value4) {
                                    $B4 = array_merge(array('desc_e_value5' . $b => $b444->desc_e_value5), $B4);
                                }
                            }
                            $b++;
                        }
                        $B4 =  json_encode(array_unique($B4));
                    } else {
                        $B4 = "";
                    }
                    $b = 0;
                    $B5 = [];
                    if ($column_jstate != 'desc_e_value6' && $column_product != 'desc_e_value6') {
                        foreach ($d2->result() as $b555) {
                            if (!empty($desc_e_value6)) {
                                if ($pro_data->desc_e_value1 == $b555->desc_e_value1 && $pro_data->desc_e_value2 == $b555->desc_e_value2 && $pro_data->desc_e_value3 == $b555->desc_e_value3 && $pro_data->desc_e_value4 == $b555->desc_e_value4 && $pro_data->desc_e_value5 == $b555->desc_e_value5) {
                                    $B5 = array_merge(array('desc_e_value6' . $b => $b555->desc_e_value6), $B5);
                                }
                            }
                            $b++;
                        }
                        $B5 =  json_encode(array_unique($B5));
                    } else {
                        $B5 = "";
                    }
                    $b = 0;
                    $B6 = [];
                    if ($column_jstate != 'desc_e_value7' && $column_product != 'desc_e_value7') {
                        foreach ($d2->result() as $b666) {
                            if (!empty($desc_e_value7)) {
                                if ($pro_data->desc_e_value1 == $b666->desc_e_value1 && $pro_data->desc_e_value2 == $b666->desc_e_value2 && $pro_data->desc_e_value3 == $b666->desc_e_value3 && $pro_data->desc_e_value4 == $b666->desc_e_value4 && $pro_data->desc_e_value5 == $b666->desc_e_value5 && $pro_data->desc_e_value6 == $b666->desc_e_value6) {
                                    $B6 = array_merge(array('desc_e_value7' . $b => $b666->desc_e_value7), $B6);
                                }
                            }
                            $b++;
                        }
                        $B6 =  json_encode(array_unique($B6));
                    } else {
                        $B6 = "";
                    }
                    $b = 0;
                    $B7 = [];
                    foreach ($d2->result() as $b777) {
                        if (!empty($desc_e_value8)) {
                            if ($pro_data->desc_e_value1 == $b777->desc_e_value1 && $pro_data->desc_e_value2 == $b777->desc_e_value2 && $pro_data->desc_e_value3 == $b777->desc_e_value3 && $pro_data->desc_e_value4 == $b777->desc_e_value4 && $pro_data->desc_e_value5 == $b777->desc_e_value5 && $pro_data->desc_e_value6 == $b777->desc_e_value6 && $pro_data->desc_e_value7 == $b777->desc_e_value7) {
                                $B7 = array_merge(array('desc_e_value8' . $b => $b777->desc_e_value8), $B7);
                            }
                        }
                        $b++;
                    }
                    $B7 =  json_encode(array_unique($B7));
                    $b = 0;
                    $B8 = [];
                    foreach ($d2->result() as $b888) {
                        if (!empty($desc_e_value9)) {
                            if ($pro_data->desc_e_value1 == $b888->desc_e_value1 && $pro_data->desc_e_value2 == $b888->desc_e_value2 && $pro_data->desc_e_value3 == $b888->desc_e_value3 && $pro_data->desc_e_value4 == $b888->desc_e_value4 && $pro_data->desc_e_value5 == $b888->desc_e_value5 && $pro_data->desc_e_value6 == $b888->desc_e_value6 && $pro_data->desc_e_value7 == $b888->desc_e_value7 && $pro_data->desc_e_value8 == $b888->desc_e_value8) {
                                $B8 = array_merge(array('desc_e_value9' . $b => $b888->desc_e_value9), $B8);
                            }
                        }
                        $b++;
                    }
                    $B8 =  json_encode(array_unique($B8));
                    $b = 0;
                    $B9 = [];
                    foreach ($d2->result() as $b999) {
                        if (!empty($desc_e_value10)) {
                            if ($pro_data->desc_e_value1 == $b999->desc_e_value1 && $pro_data->desc_e_value2 == $b999->desc_e_value2 && $pro_data->desc_e_value3 == $b999->desc_e_value3 && $pro_data->desc_e_value4 == $b999->desc_e_value4 && $pro_data->desc_e_value5 == $b999->desc_e_value5 && $pro_data->desc_e_value6 == $b999->desc_e_value6 && $pro_data->desc_e_value7 == $b999->desc_e_value7 && $pro_data->desc_e_value8 == $b999->desc_e_value8 && $pro_data->desc_e_value9 == $b999->desc_e_value9) {
                                $B9 = array_merge(array('desc_e_value10' . $b => $b999->desc_e_value10), $B9);
                            }
                        }
                        $b++;
                    }
                    $B9 = json_encode(array_unique($B9));
                    $b = 0;
                    $B10 = [];
                    foreach ($d2->result() as $b1010) {
                        if (!empty($desc_e_value11)) {
                            if ($pro_data->desc_e_value1 == $b1010->desc_e_value1 && $pro_data->desc_e_value2 == $b1010->desc_e_value2 && $pro_data->desc_e_value3 == $b1010->desc_e_value3 && $pro_data->desc_e_value4 == $b1010->desc_e_value4 && $pro_data->desc_e_value5 == $b1010->desc_e_value5 && $pro_data->desc_e_value6 == $b1010->desc_e_value6 && $pro_data->desc_e_value7 == $b1010->desc_e_value7 && $pro_data->desc_e_value8 == $b1010->desc_e_value8 && $pro_data->desc_e_value9 == $b1010->desc_e_value9 && $pro_data->desc_e_value10 == $b1010->desc_e_value10) {
                                $B10 = array_merge(array('desc_e_value11' . $b => $b1010->desc_e_value11), $B10);
                            }
                        }
                        $b++;
                    }
                    $B10 = json_encode(array_unique($B10));
                    $specs = [];
                    $canbe = [];
                    $RingSize = [];
                    $ringsizePriceadd = 0;
                    $this->db->select('*');
                    $this->db->from('tbl_product_specifications');
                    $this->db->where('product_id', $pro_data->id);
                    $spec_dataa = $this->db->get()->row();
                    if (!empty($spec_dataa)) {
                        $specs = $spec_dataa->specifications;
                        $canbe = $spec_dataa->canbesetwith;
                        $RingSize = $spec_dataa->ringsize;
                        $RingSizeDecode = json_decode($spec_dataa->ringsize);
                        if (!empty($RingSizeDecode)) {
                            foreach ($RingSizeDecode as $priceout) {
                                if ($priceout->Size == 7) {
                                    $ringsizePriceadd = $priceout->Price;
                                }
                            }
                        }
                    } else {
                        $specs = [];
                        $canbe = [];
                        $RingSize = [];
                        $ringsizePriceadd = 0;
                    }
                    $this->db->select('*');
                    $this->db->from('tbl_price_rule');
                    $pr_data = $this->db->get()->row();
                    $multiplier = $pr_data->multiplier;
                    $cost_price11 = $pr_data->cost_price1;
                    $cost_price22 = $pr_data->cost_price2;
                    $cost_price33 = $pr_data->cost_price3;
                    $cost_price44 = $pr_data->cost_price4;
                    $cost_price55 = $pr_data->cost_price5;
                    // echo $pro_data->price;
                    // die();
                    if (!empty($pro_data->price)) {
                        $cost_price = $pro_data->price + $ringsizePriceadd;
                        // $cost_price = $cost_price;
                        $retail = $cost_price * $multiplier;
                        $now_price = $cost_price;
                        if ($cost_price <= 500) {
                            $cost_price2 = $cost_price * $cost_price;
                            // $now_price= $cost_price*0.00000264018*($cost_price*2)+(-0.002220133*$cost_price)+1.950022201-1+0.95;
                            $number = round($cost_price * ($cost_price11 * $cost_price2 + $cost_price22 * $cost_price + $cost_price33), 2);
                            $unit = 5;
                            $remainder = $number % $unit;
                            $mround = ($remainder < $unit / 2) ? $number - $remainder : $number + ($unit - $remainder);
                            $now_price = round($mround) - 1 + 0.95;
                            // $now_price = round($mround);
                            // echo $cost_price;
                            // exit;
                        }
                        if ($cost_price > 500) {
                            $number = round($cost_price * ($cost_price44 * $cost_price / $multiplier + $cost_price55));
                            $unit = 5;
                            $remainder = $number % $unit;
                            $mround = ($remainder < $unit / 2) ? $number - $remainder : $number + ($unit - $remainder);
                            $now_price = round($mround) - 1 + 0.95;
                            // $now_price = round($mround);
                            // echo $cost_price;
                        }
                        $retail = $retail * $qty;
                        $now_price = $now_price * $qty;
                        $saved = round($retail - $now_price);
                        $dis_percent = round($saved / $retail * 100);
                        // $respone['retail'] = round($retail, 2);
                        $respone['retail'] = round($retail);
                        $respone['saved'] = $saved;
                        $respone['dis'] = $dis_percent;
                        $respone['price'] = number_format($now_price, 2);
                    }
                    $val_e = array(
                        'desc_e_name1' => $pro_data->desc_e_name1,
                        'desc_e_name2' => $pro_data->desc_e_name2,
                        'desc_e_name3' => $pro_data->desc_e_name3,
                        'desc_e_name4' => $pro_data->desc_e_name4,
                        'desc_e_name5' => $pro_data->desc_e_name5,
                        'desc_e_name6' => $pro_data->desc_e_name6,
                        'desc_e_name7' => $pro_data->desc_e_name7,
                        'desc_e_name8' => $pro_data->desc_e_name8,
                        'desc_e_name9' => $pro_data->desc_e_name9,
                        'desc_e_name10' => $pro_data->desc_e_name10,
                        'desc_e_name11' => $pro_data->desc_e_name11,
                    );
                    $deal = array_search('Quality', $val_e);
                    if (!empty($deal)) {
                        $col = $deal;
                    } else {
                        $col = '';
                    }
                    // echo $col;die();
                    if (empty($col)) {
                        $s = "";
                    } else {
                        $number = explode("desc_e_name", $col);
                        $s = "desc_e_value" . $number[1];
                    }
                    $respone['data'] = true;
                    $respone['update_pro'] = $pro_data;
                    $respone['quality'] = $pro_data->$s;
                    $respone['b1'] = $B1;
                    $respone['b2'] = $B2;
                    $respone['b3'] = $B3;
                    $respone['b4'] = $B4;
                    $respone['b5'] = $B5;
                    $respone['b6'] = $B6;
                    $respone['b7'] = $B7;
                    $respone['b8'] = $B8;
                    $respone['b9'] = $B9;
                    $respone['b10'] = $B10;
                    $respone['specs'] = $specs;
                    $respone['canbe'] = $canbe;
                    $respone['RingSize'] = $RingSize;
                    if ($B1 == '[]' && $B2 == '[]' && $B3 == '[]' && $B4 == '[]' && $B5 == '[]' && $B6 == '[]' && $B7 == '[]' && $B8 == '[]' && $B9 == '[]' && $B10 == '[]') {
                        $respone['changeThem'] = 0;
                    } else {
                        $respone['changeThem'] = 1;
                    }
                    echo json_encode($respone);
                } elseif ($para == 1) { //
                    // die();
                    // echo $col." ".$value;exit;
                    $this->db->select('*');
                    $this->db->from('tbl_products');
                    $this->db->where('sku_series', $sku_series);
                    $this->db->where('desc_e_value2', $desc_e_value2);
                    $this->db->where('desc_e_value3', $desc_e_value3);
                    $this->db->where('desc_e_value4', $desc_e_value4);
                    $this->db->where('desc_e_value5', $desc_e_value5);
                    $this->db->where('desc_e_value6', $desc_e_value6);
                    $this->db->where('desc_e_value7', $desc_e_value7);
                    $this->db->where('desc_e_value8', $desc_e_value8);
                    $this->db->where('desc_e_value9', $desc_e_value9);
                    $pro_dropdown = $this->db->get();
                    $pro_data = $pro_dropdown->row();
                    if (empty($pro_data)) {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->where('sku_series', $sku_series);
                        $this->db->where('gdesc', $gdesc);
                        $this->db->where($col, $value);
                        $pro_dropdown = $this->db->get();
                        $pro_data = $pro_dropdown->row();
                    }
                    // print_r($pro_data);exit;
                    //-----------------------Replace all dropdowns-------------------------------------------------
                    $val_e = array(
                        'desc_e_name2' => $pro_data->desc_e_name2,
                        'desc_e_name3' => $pro_data->desc_e_name3,
                        'desc_e_name4' => $pro_data->desc_e_name4,
                        'desc_e_name5' => $pro_data->desc_e_name5,
                        'desc_e_name6' => $pro_data->desc_e_name6,
                        'desc_e_name7' => $pro_data->desc_e_name7,
                        'desc_e_name8' => $pro_data->desc_e_name8,
                        'desc_e_name9' => $pro_data->desc_e_name9,
                        'desc_e_name10' => $pro_data->desc_e_name10,
                        'desc_e_name11' => $pro_data->desc_e_name11,
                    );
                    $deal = array_search('Quality', $val_e);
                    if (!empty($deal)) {
                        $colo = $deal;
                    } else {
                        $colo = $eng_center;
                    }
                    // echo $col;die();
                    if (empty($col)) {
                        $s = "";
                    } else {
                        $number = explode("desc_e_name", $colo);
                        $s = "desc_e_value" . $number[1];
                    }
                    // // echo $dropdownName;die();
                    $this->db->select('*');
                    $this->db->from('tbl_products');
                    $this->db->where('sku_series', $sku_series);
                    $this->db->where('gdesc', $gdesc);
                    $this->db->where($col, $value);
                    $this->db->where($s, $dropdownName);
                    $pro_dropdown = $this->db->get();
                    $pro_data = $pro_dropdown->row();
                    // print_r($pro_data); echo "hi";
                    // echo $col." ".$value;exit;
                    //
                    if (empty($pro_data)) {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->where('sku_series', $sku_series);
                        $this->db->where('gdesc', $gdesc);
                        $this->db->where($col, $value);
                        $pro_dropdown = $this->db->get();
                        $pro_data = $pro_dropdown->row();
                    }
                    $b = 0;
                    $Quality = [];
                    foreach ($pro_dropdown->result() as $quality) {
                        if (!empty($s)) {
                            $Quality = array_merge(array('quality' . $b => $quality->$s), $Quality);
                            // print_r($B1);
                        }
                        $b++;
                    }
                    $Quality =  json_encode(array_unique($Quality));
                    // echo $Quality;die();
                    $b = 0;
                    $B1 = [];
                    foreach ($pro_dropdown->result() as $b111) {
                        if (!empty($desc_e_value2)) {
                            if ($pro_data->desc_e_value1 == $b111->desc_e_value1) {
                                $B1 = array_merge(array('desc_e_value2' . $b => $b111->desc_e_value2), $B1);
                            }
                            // print_r($B1);
                        }
                        $b++;
                    }
                    $B1 =  json_encode(array_unique($B1));
                    $b = 0;
                    $B2 = [];
                    foreach ($pro_dropdown->result() as $b222) {
                        if (!empty($desc_e_value3)) {
                            if ($pro_data->desc_e_value1 == $b222->desc_e_value1 && $pro_data->desc_e_value2 == $b222->desc_e_value2) {
                                $B2 = array_merge(array('desc_e_value3' . $b => $b222->desc_e_value3), $B2);
                            }
                        }
                        $b++;
                    }
                    $B2 =  json_encode(array_unique($B2));
                    $b = 0;
                    $B3 = [];
                    foreach ($pro_dropdown->result() as $b333) {
                        if (!empty($desc_e_value4)) {
                            if ($pro_data->desc_e_value1 == $b333->desc_e_value1 && $pro_data->desc_e_value2 == $b333->desc_e_value2 && $pro_data->desc_e_value3 == $b333->desc_e_value3) {
                                $B3 = array_merge(array('desc_e_value4' . $b => $b333->desc_e_value4), $B3);
                            }
                        }
                        $b++;
                    }
                    $B3 =  json_encode(array_unique($B3));
                    $b = 0;
                    $B4 = [];
                    foreach ($pro_dropdown->result() as $b444) {
                        if (!empty($desc_e_value5)) {
                            if ($pro_data->desc_e_value1 == $b444->desc_e_value1 && $pro_data->desc_e_value2 == $b444->desc_e_value2 && $pro_data->desc_e_value3 == $b444->desc_e_value3 && $pro_data->desc_e_value4 == $b444->desc_e_value4) {
                                $B4 = array_merge(array('desc_e_value5' . $b => $b444->desc_e_value5), $B4);
                            }
                        }
                        $b++;
                    }
                    $B4 =  json_encode(array_unique($B4));
                    $b = 0;
                    $B5 = [];
                    foreach ($pro_dropdown->result() as $b555) {
                        if (!empty($desc_e_value6)) {
                            if ($pro_data->desc_e_value1 == $b555->desc_e_value1 && $pro_data->desc_e_value2 == $b555->desc_e_value2 && $pro_data->desc_e_value3 == $b555->desc_e_value3 && $pro_data->desc_e_value4 == $b555->desc_e_value4 && $pro_data->desc_e_value5 == $b555->desc_e_value5) {
                                $B5 = array_merge(array('desc_e_value6' . $b => $b555->desc_e_value6), $B5);
                            }
                        }
                        $b++;
                    }
                    $B5 =  json_encode(array_unique($B5));
                    $b = 0;
                    $B6 = [];
                    foreach ($pro_dropdown->result() as $b666) {
                        if (!empty($desc_e_value7)) {
                            if ($pro_data->desc_e_value1 == $b666->desc_e_value1 && $pro_data->desc_e_value2 == $b666->desc_e_value2 && $pro_data->desc_e_value3 == $b666->desc_e_value3 && $pro_data->desc_e_value4 == $b666->desc_e_value4 && $pro_data->desc_e_value5 == $b666->desc_e_value5 && $pro_data->desc_e_value6 == $b666->desc_e_value6) {
                                $B6 = array_merge(array('desc_e_value7' . $b => $b666->desc_e_value7), $B6);
                            }
                        }
                        $b++;
                    }
                    $B6 =  json_encode(array_unique($B6));
                    $b = 0;
                    $B7 = [];
                    foreach ($pro_dropdown->result() as $b777) {
                        if (!empty($desc_e_value8)) {
                            if ($pro_data->desc_e_value1 == $b777->desc_e_value1 && $pro_data->desc_e_value2 == $b777->desc_e_value2 && $pro_data->desc_e_value3 == $b777->desc_e_value3 && $pro_data->desc_e_value4 == $b777->desc_e_value4 && $pro_data->desc_e_value5 == $b777->desc_e_value5 && $pro_data->desc_e_value6 == $b777->desc_e_value6 && $pro_data->desc_e_value7 == $b777->desc_e_value7) {
                                $B7 = array_merge(array('desc_e_value8' . $b => $b777->desc_e_value8), $B7);
                            }
                        }
                        $b++;
                    }
                    $B7 =  json_encode(array_unique($B7));
                    $b = 0;
                    $B8 = [];
                    foreach ($pro_dropdown->result() as $b888) {
                        if (!empty($desc_e_value9)) {
                            if ($pro_data->desc_e_value1 == $b888->desc_e_value1 && $pro_data->desc_e_value2 == $b888->desc_e_value2 && $pro_data->desc_e_value3 == $b888->desc_e_value3 && $pro_data->desc_e_value4 == $b888->desc_e_value4 && $pro_data->desc_e_value5 == $b888->desc_e_value5 && $pro_data->desc_e_value6 == $b888->desc_e_value6 && $pro_data->desc_e_value7 == $b888->desc_e_value7 && $pro_data->desc_e_value8 == $b888->desc_e_value8) {
                                $B8 = array_merge(array('desc_e_value9' . $b => $b888->desc_e_value9), $B8);
                            }
                        }
                        $b++;
                    }
                    $B8 =  json_encode(array_unique($B8));
                    $b = 0;
                    $B9 = [];
                    foreach ($pro_dropdown->result() as $b999) {
                        if (!empty($desc_e_value10)) {
                            if ($pro_data->desc_e_value1 == $b999->desc_e_value1 && $pro_data->desc_e_value2 == $b999->desc_e_value2 && $pro_data->desc_e_value3 == $b999->desc_e_value3 && $pro_data->desc_e_value4 == $b999->desc_e_value4 && $pro_data->desc_e_value5 == $b999->desc_e_value5 && $pro_data->desc_e_value6 == $b999->desc_e_value6 && $pro_data->desc_e_value7 == $b999->desc_e_value7 && $pro_data->desc_e_value8 == $b999->desc_e_value8 && $pro_data->desc_e_value9 == $b999->desc_e_value9) {
                                $B9 = array_merge(array('desc_e_value10' . $b => $b999->desc_e_value10), $B9);
                            }
                        }
                        $b++;
                    }
                    $B9 = json_encode(array_unique($B9));
                    $b = 0;
                    $B10 = [];
                    foreach ($pro_dropdown->result() as $b1010) {
                        if (!empty($desc_e_value11)) {
                            if ($pro_data->desc_e_value1 == $b1010->desc_e_value1 && $pro_data->desc_e_value2 == $b1010->desc_e_value2 && $pro_data->desc_e_value3 == $b1010->desc_e_value3 && $pro_data->desc_e_value4 == $b1010->desc_e_value4 && $pro_data->desc_e_value5 == $b1010->desc_e_value5 && $pro_data->desc_e_value6 == $b1010->desc_e_value6 && $pro_data->desc_e_value7 == $b1010->desc_e_value7 && $pro_data->desc_e_value8 == $b1010->desc_e_value8 && $pro_data->desc_e_value9 == $b1010->desc_e_value9 && $pro_data->desc_e_value10 == $b1010->desc_e_value10) {
                                $B10 = array_merge(array('desc_e_value11' . $b => $b1010->desc_e_value11), $B10);
                            }
                        }
                        $b++;
                    }
                    $B10 = json_encode(array_unique($B10));
                    // print_r($B9);die();
                    if (!empty($pro_data)) {
                        $specs = [];
                        $canbe = [];
                        $RingSize = [];
                        $ringsizePriceadd = 0;
                        $this->db->select('*');
                        $this->db->from('tbl_product_specifications');
                        $this->db->where('product_id', $pro_data->id);
                        $spec_dataa = $this->db->get()->row();
                        if (!empty($spec_dataa)) {
                            $specs = $spec_dataa->specifications;
                            $canbe = $spec_dataa->canbesetwith;
                            $RingSize = $spec_dataa->ringsize;
                            $RingSizeDecode = json_decode($spec_dataa->ringsize);
                            if (!empty($RingSizeDecode)) {
                                foreach ($RingSizeDecode as $priceout) {
                                    if ($priceout->Size == 7) {
                                        $ringsizePriceadd = $priceout->Price;
                                    }
                                }
                            }
                        } else {
                            $specs = [];
                            $canbe = [];
                            $RingSize = [];
                            $ringsizePriceadd = 0;
                        }
                        $this->db->select('*');
                        $this->db->from('tbl_price_rule');
                        $pr_data = $this->db->get()->row();
                        $multiplier = $pr_data->multiplier;
                        $cost_price11 = $pr_data->cost_price1;
                        $cost_price22 = $pr_data->cost_price2;
                        $cost_price33 = $pr_data->cost_price3;
                        $cost_price44 = $pr_data->cost_price4;
                        $cost_price55 = $pr_data->cost_price5;
                        // echo $pro_data->price;die();
                        if (!empty($pro_data->price)) {
                            $cost_price = $pro_data->price + $ringsizePriceadd;
                            // $cost_price = $cost_price;
                            $retail = $cost_price * $multiplier;
                            $now_price = $cost_price;
                            // echo $now_price;
                            // exit;
                            if ($cost_price <= 500) {
                                $cost_price2 = $cost_price * $cost_price;
                                // $now_price= $cost_price*0.00000264018*($cost_price*2)+(-0.002220133*$cost_price)+1.950022201-1+0.95;
                                $number = round($cost_price * ($cost_price11 * $cost_price2 + $cost_price22 * $cost_price + $cost_price33), 2);
                                $unit = 5;
                                $remainder = $number % $unit;
                                $mround = ($remainder < $unit / 2) ? $number - $remainder : $number + ($unit - $remainder);
                                $now_price = round($mround) - 1 + 0.95;
                                // $now_price = round($mround);
                                // echo $cost_price;
                                // exit;
                            }
                            if ($cost_price > 500) {
                                $number = round($cost_price * ($cost_price44 * $cost_price / $multiplier + $cost_price55));
                                $unit = 5;
                                $remainder = $number % $unit;
                                $mround = ($remainder < $unit / 2) ? $number - $remainder : $number + ($unit - $remainder);
                                $now_price = round($mround) - 1 + 0.95;
                                // $now_price = round($mround);
                                // echo $cost_price;
                            }
                            $retail = $retail * $qty;
                            $now_price = $now_price * $qty;
                            $saved = round($retail - $now_price);
                            $dis_percent = round($saved / $retail * 100);
                            // $respone['retail'] = round($retail, 2);
                            // echo $now_price;die();
                            // $respone['retail'] = round($retail, 2);
                            $respone['retail'] = round($retail);
                            $respone['saved'] = $saved;
                            $respone['dis'] = $dis_percent;
                            $respone['price'] = number_format($now_price, 2);
                        }
                        $respone['data'] = true;
                        $respone['update_pro'] = $pro_data;
                        $respone['quality'] = $Quality;
                        $respone['b1'] = $B1;
                        $respone['b2'] = $B2;
                        $respone['b3'] = $B3;
                        $respone['b4'] = $B4;
                        $respone['b5'] = $B5;
                        $respone['b6'] = $B6;
                        $respone['b7'] = $B7;
                        $respone['b8'] = $B8;
                        $respone['b9'] = $B9;
                        $respone['b10'] = $B10;
                        $respone['specs'] = $specs;
                        $respone['canbe'] = $canbe;
                        $respone['RingSize'] = $RingSize;
                        $respone['changeThem'] = 1;
                        echo json_encode($respone);
                    } else {
                        $respone['data'] = false;
                        echo json_encode($respone);
                    }
                } elseif ($para == 2) {
                    // die();
                    // // echo $col." ".$value;exit;
                    $this->db->select('*');
                    $this->db->from('tbl_products');
                    $this->db->where('sku_series', $sku_series);
                    $this->db->where('gdesc', $gdesc);
                    $this->db->where('desc_e_value2', $desc_e_value2);
                    $this->db->where('desc_e_value3', $desc_e_value3);
                    $this->db->where('desc_e_value4', $desc_e_value4);
                    $this->db->where('desc_e_value5', $desc_e_value5);
                    // $this->db->where('desc_e_value6',$desc_e_value6);
                    $pro_dropdown = $this->db->get();
                    $pro_data = $pro_dropdown->row();
                    // print_r($pro_data);die();
                    // $pro_data = '';
                    if (empty($pro_data)) {
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->where('sku_series', $sku_series);
                        $this->db->where('gdesc', $gdesc);
                        $this->db->where($col, $value);
                        $pro_dropdown = $this->db->get();
                        $pro_data = $pro_dropdown->row();
                    }
                    // echo $value;
                    // print_r($pro_data);die();
                    // die();
                    //-----------------------Replace all but Jewelry State dropdowns------------------------------------------
                    $val_e = array(
                        'desc_e_name2' => $pro_data->desc_e_name2,
                        'desc_e_name3' => $pro_data->desc_e_name3,
                        'desc_e_name4' => $pro_data->desc_e_name4,
                        'desc_e_name5' => $pro_data->desc_e_name5,
                        'desc_e_name6' => $pro_data->desc_e_name6,
                        'desc_e_name7' => $pro_data->desc_e_name7,
                        'desc_e_name8' => $pro_data->desc_e_name8,
                        'desc_e_name9' => $pro_data->desc_e_name9,
                        'desc_e_name10' => $pro_data->desc_e_name10,
                        'desc_e_name11' => $pro_data->desc_e_name11,
                    );
                    $deal = array_search('Quality', $val_e);
                    if (!empty($deal)) {
                        $colo = $deal;
                    } else {
                        $colo = $eng_center;
                    }
                    $state = array_search('Jewelry State', $val_e);
                    if (empty($state)) {
                        $state_row = "";
                        $state_value = "";
                    } else {
                        $state_no = explode("desc_e_name", $state);
                        $state_row = "desc_e_value" . $state_no[1];
                        $state_value = $pro_data->$state_row;
                    }
                    $eng_band_shank = array_search('Product', $val_e);
                    if (empty($eng_band_shank)) {
                        $eng_band_shank_row = "";
                        $eng_band_shank_value = "";
                    } else {
                        $eng_band_shank_no = explode("desc_e_name", $eng_band_shank);
                        $eng_band_shank_row = "desc_e_value" . $eng_band_shank_no[1];
                        $eng_band_shank_value = $pro_data->$eng_band_shank_row;
                    }
                    // echo $state_row;die();
                    if (empty($col)) {
                        $s = "";
                    } else {
                        $number = explode("desc_e_name", $colo);
                        $s = "desc_e_value" . $number[1];
                    }
                    // echo $dropdownName;die();
                    $this->db->select('*');
                    $this->db->from('tbl_products');
                    $this->db->where('sku_series', $sku_series);
                    $this->db->where('gdesc', $gdesc);
                    $this->db->where($col, $value);                        //-----Jewelry state
                    $this->db->where($s, $dropdownName);            //-----Quality
                    $pro_dropdown = $this->db->get();
                    $pro_data = $pro_dropdown->row();
                    // print_r($pro_data); echo "hi";
                    // echo $col." ".$dropdownName;exit;
                    //
                    $this->db->select('*');
                    $this->db->from('tbl_products');
                    $this->db->where('sku_series', $sku_series);
                    $this->db->where('gdesc', $gdesc);
                    $this->db->where($col, $value);
                    $pro_dropdown = $this->db->get();
                    if (empty($pro_data)) {
                        $pro_data = $pro_dropdown->row();
                    }
                    $b = 0;
                    $Quality = [];
                    foreach ($pro_dropdown->result() as $quality) {
                        if (!empty($s)) {
                            $Quality = array_merge(array('quality' . $b => $quality->$s), $Quality);
                            // print_r($B1);
                        }
                        $b++;
                    }
                    $Quality =  json_encode(array_unique($Quality));
                    // echo $Quality;die();
                    $b = 0;
                    $B1 = [];
                    foreach ($pro_dropdown->result() as $b111) {
                        if (!empty($desc_e_value2) && $state_row != 'desc_e_value2'  && $eng_band_shank_row != 'desc_e_value2') {
                            $B1 = array_merge(array('desc_e_value2' . $b => $b111->desc_e_value2), $B1);
                            // print_r($B1);
                        } else {
                            $B1 = "";
                        }
                        $b++;
                    }
                    if (!empty($B1)) {
                        sort($B1);
                        $B1 =  json_encode(array_unique($B1));
                    } else {
                        $B1 = "";
                    }
                    $b = 0;
                    $B2 = [];
                    foreach ($pro_dropdown->result() as $b222) {
                        if (!empty($desc_e_value3) && $state_row != 'desc_e_value3'  && $eng_band_shank_row != 'desc_e_value3') {
                            $B2 = array_merge(array('desc_e_value3' . $b => $b222->desc_e_value3), $B2);
                        } else {
                            $B2 = "";
                        }
                        $b++;
                    }
                    if (!empty($B2)) {
                        sort($B2);
                        $B2 =  json_encode(array_unique($B2));
                    } else {
                        $B2 = "";
                    }
                    $b = 0;
                    $B3 = [];
                    // echo "hi";die();
                    foreach ($pro_dropdown->result() as $b333) {
                        if (!empty($desc_e_value4) && $state_row != 'desc_e_value4'  && $eng_band_shank_row != 'desc_e_value4') {
                            if ($pro_data->desc_e_value1 == $b333->desc_e_value1 && $pro_data->desc_e_value2 == $b333->desc_e_value2 && $pro_data->desc_e_value3 == $b333->desc_e_value3) {
                                $B3 = array_merge(array('desc_e_value4' . $b => $b333->desc_e_value4), $B3);
                            }
                        } else {
                            $B3 = "";
                        }
                        $b++;
                    }
                    if (!empty($B3)) {
                        sort($B3);
                        $B3 =  json_encode(array_unique($B3));
                    } else {
                        $B3 = "";
                    }
                    $b = 0;
                    $B4 = [];
                    foreach ($pro_dropdown->result() as $b444) {
                        if (!empty($desc_e_value5) && $state_row != 'desc_e_value5'  && $eng_band_shank_row != 'desc_e_value5') {
                            $B4 = array_merge(array('desc_e_value5' . $b => $b444->desc_e_value5), $B4);
                        } else {
                            $B4 = "";
                        }
                        $b++;
                    }
                    if (!empty($B4)) {
                        sort($B4);
                        $B4 =  json_encode(array_unique($B4));
                    } else {
                        $B4 = "";
                    }
                    $b = 0;
                    $B5 = [];
                    foreach ($pro_dropdown->result() as $b555) {
                        if (!empty($desc_e_value6) && $state_row != 'desc_e_value6'  && $eng_band_shank_row != 'desc_e_value6') {
                            $B5 = array_merge(array('desc_e_value6' . $b => $b555->desc_e_value6), $B5);
                        } else {
                            $B5 = "";
                        }
                        $b++;
                    }
                    if (!empty($B5)) {
                        sort($B5);
                        $B5 =  json_encode(array_unique($B5));
                    } else {
                        $B5 = "";
                    }
                    $b = 0;
                    $B6 = [];
                    foreach ($pro_dropdown->result() as $b666) {
                        if (!empty($desc_e_value7) && $state_row != 'desc_e_value7'  && $eng_band_shank_row != 'desc_e_value7') {
                            $B6 = array_merge(array('desc_e_value7' . $b => $b666->desc_e_value7), $B6);
                        } else {
                            $B6 = "";
                        }
                        $b++;
                    }
                    if (!empty($B6)) {
                        sort($B6);
                        $B6 =  json_encode(array_unique($B6));
                    } else {
                        $B6 = "";
                    }
                    $b = 0;
                    $B7 = [];
                    foreach ($pro_dropdown->result() as $b777) {
                        if (!empty($desc_e_value8) && $state_row != 'desc_e_value8'  && $eng_band_shank_row != 'desc_e_value8') {
                            $B7 = array_merge(array('desc_e_value8' . $b => $b777->desc_e_value8), $B7);
                        } else {
                            $B7 = "";
                        }
                        $b++;
                    }
                    if (!empty($B7)) {
                        sort($B7);
                        $B7 =  json_encode(array_unique($B7));
                    } else {
                        $B7 = "";
                    }
                    $b = 0;
                    $B8 = [];
                    foreach ($pro_dropdown->result() as $b888) {
                        if (!empty($desc_e_value9) && $state_row != 'desc_e_value9'  && $eng_band_shank_row != 'desc_e_value9') {
                            $B8 = array_merge(array('desc_e_value9' . $b => $b888->desc_e_value9), $B8);
                        } else {
                            $B8 = "";
                        }
                        $b++;
                    }
                    if (!empty($B8)) {
                        $B8 =  json_encode(array_unique($B8));
                    } else {
                        $B8 = "";
                    }
                    $b = 0;
                    $B9 = [];
                    foreach ($pro_dropdown->result() as $b999) {
                        if (!empty($desc_e_value10) && $state_row != 'desc_e_value10'  && $eng_band_shank_row != 'desc_e_value10') {
                            $B9 = array_merge(array('desc_e_value10' . $b => $b999->desc_e_value10), $B9);
                        } else {
                            $B9 = "";
                        }
                        $b++;
                    }
                    if (!empty($B9)) {
                        $B9 =  json_encode(array_unique($B9));
                    } else {
                        $B9 = "";
                    }
                    // print_r($B9);die();
                    //-----------------------------------------------------------------------------------------------
                    if (!empty($pro_data)) {
                        $specs = [];
                        $canbe = [];
                        $RingSize = [];
                        $ringsizePriceadd = 0;
                        $this->db->select('*');
                        $this->db->from('tbl_product_specifications');
                        $this->db->where('product_id', $pro_data->id);
                        $spec_dataa = $this->db->get()->row();
                        if (!empty($spec_dataa)) {
                            $specs = $spec_dataa->specifications;
                            $canbe = $spec_dataa->canbesetwith;
                            $RingSize = $spec_dataa->ringsize;
                            $RingSizeDecode = json_decode($spec_dataa->ringsize);
                            if (!empty($RingSizeDecode)) {
                                foreach ($RingSizeDecode as $priceout) {
                                    if ($priceout->Size == 7) {
                                        $ringsizePriceadd = $priceout->Price;
                                    }
                                }
                            }
                        } else {
                            $specs = [];
                            $canbe = [];
                            $RingSize = [];
                            $ringsizePriceadd = 0;
                        }
                        $this->db->select('*');
                        $this->db->from('tbl_price_rule');
                        $pr_data = $this->db->get()->row();
                        $multiplier = $pr_data->multiplier;
                        $cost_price11 = $pr_data->cost_price1;
                        $cost_price22 = $pr_data->cost_price2;
                        $cost_price33 = $pr_data->cost_price3;
                        $cost_price44 = $pr_data->cost_price4;
                        $cost_price55 = $pr_data->cost_price5;
                        // echo $pro_data->price;die();
                        if (!empty($pro_data->price)) {
                            $cost_price = $pro_data->price + $ringsizePriceadd;
                            // $cost_price = $cost_price;
                            $retail = $cost_price * $multiplier;
                            $now_price = $cost_price;
                            // echo $now_price;
                            // exit;
                            if ($cost_price <= 500) {
                                $cost_price2 = $cost_price * $cost_price;
                                // $now_price= $cost_price*0.00000264018*($cost_price*2)+(-0.002220133*$cost_price)+1.950022201-1+0.95;
                                $number = round($cost_price * ($cost_price11 * $cost_price2 + $cost_price22 * $cost_price + $cost_price33), 2);
                                $unit = 5;
                                $remainder = $number % $unit;
                                $mround = ($remainder < $unit / 2) ? $number - $remainder : $number + ($unit - $remainder);
                                $now_price = round($mround) - 1 + 0.95;
                                // $now_price = round($mround);
                                // echo $cost_price;
                                // exit;
                            }
                            if ($cost_price > 500) {
                                $number = round($cost_price * ($cost_price44 * $cost_price / $multiplier + $cost_price55));
                                $unit = 5;
                                $remainder = $number % $unit;
                                $mround = ($remainder < $unit / 2) ? $number - $remainder : $number + ($unit - $remainder);
                                $now_price = round($mround) - 1 + 0.95;
                                // $now_price = round($mround);
                                // echo $cost_price;
                            }
                            $retail = $retail * $qty;
                            $now_price = $now_price * $qty;
                            $saved = round($retail - $now_price);
                            $dis_percent = round($saved / $retail * 100);
                            // $respone['retail'] = round($retail, 2);
                            // echo $now_price;die();
                            // $respone['retail'] = round($retail, 2);
                            $respone['retail'] = round($retail);
                            $respone['saved'] = $saved;
                            $respone['dis'] = $dis_percent;
                            $respone['price'] = number_format($now_price, 2);
                        }
                        $respone['data'] = true;
                        $respone['update_pro'] = $pro_data;
                        $respone['quality'] = $Quality;
                        $respone['b1'] = $B1;
                        $respone['b2'] = $B2;
                        $respone['b3'] = $B3;
                        $respone['b4'] = $B4;
                        $respone['b5'] = $B5;
                        $respone['b6'] = $B6;
                        $respone['b7'] = $B7;
                        $respone['b8'] = $B8;
                        $respone['b9'] = $B9;
                        $respone['specs'] = $specs;
                        $respone['canbe'] = $canbe;
                        $respone['RingSize'] = $RingSize;
                        $respone['changeThem'] = 1;
                        echo json_encode($respone);
                    } else {
                        $respone['data'] = false;
                        echo json_encode($respone);
                    }
                }
            } else {
                $respone['data'] = false;
                $respone['data_message'] = validation_errors();
                echo json_encode($respone);
            }
        } else {
            $respone['data'] = false;
            $respone['data_message'] = "Please insert some data, No data available";
            echo json_encode($respone);
        }
    }
    public function quick_pro_change()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('col', 'col', 'required|xss_clean|trim');
            $this->form_validation->set_rules('value', 'value', 'required|xss_clean|trim');
            $this->form_validation->set_rules('sku_series', 'sku_series', 'required|xss_clean|trim');
            $this->form_validation->set_rules('gdesc', 'gdesc', 'xss_clean|trim');
            $this->form_validation->set_rules('desc_e_value2', 'desc_e_value2', 'required|xss_clean|trim');
            $this->form_validation->set_rules('desc_e_value3', 'desc_e_value3', 'required|xss_clean|trim');
            $this->form_validation->set_rules('desc_e_value4', 'desc_e_value4', 'required|xss_clean|trim');
            $this->form_validation->set_rules('desc_e_value5', 'desc_e_value5', 'xss_clean|trim');
            $this->form_validation->set_rules('desc_e_value6', 'desc_e_value6', 'xss_clean|trim');
            $this->form_validation->set_rules('desc_e_value7', 'desc_e_value7', 'xss_clean|trim');
            $this->form_validation->set_rules('desc_e_value8', 'desc_e_value8', 'xss_clean|trim');
            $this->form_validation->set_rules('desc_e_value9', 'desc_e_value9', 'xss_clean|trim');
            $this->form_validation->set_rules('desc_e_value10', 'desc_e_value10', 'xss_clean|trim');
            $this->form_validation->set_rules('desc_e_value11', 'desc_e_value11', 'xss_clean|trim');
            $this->form_validation->set_rules('dropdownName', 'dropdownName', 'xss_clean|trim'); //--------Quality Name
            $this->form_validation->set_rules('qty', 'qty', 'xss_clean|trim');
            $this->form_validation->set_rules('pid', 'pid', 'xss_clean|trim');
            $this->form_validation->set_rules('para', 'para', 'xss_clean|trim'); //------- 1 for image, 0 for dropdown, 2 for jewelry State
            $this->form_validation->set_rules('active', 'active', 'xss_clean|trim'); //-------------Shape of stone
            if ($this->form_validation->run() == TRUE) {
                $pid = $this->input->post('pid');
                $qty = $this->input->post('qty');
                $col = $this->input->post('col');
                $para = $this->input->post('para');
                $value = $this->input->post('value');
                $gdesc = $this->input->post('gdesc');
                $active = $this->input->post('active');
                $sku_series = $this->input->post('sku_series');
                $desc_e_value2 = $this->input->post('desc_e_value2');
                $desc_e_value3 = $this->input->post('desc_e_value3');
                $desc_e_value4 = $this->input->post('desc_e_value4');
                $desc_e_value5 = $this->input->post('desc_e_value5');
                $desc_e_value6 = $this->input->post('desc_e_value6');
                $desc_e_value7 = $this->input->post('desc_e_value7');
                $desc_e_value8 = $this->input->post('desc_e_value8');
                $desc_e_value9 = $this->input->post('desc_e_value9');
                $desc_e_value10 = $this->input->post('desc_e_value10');
                $desc_e_value11 = $this->input->post('desc_e_value11');
                $dropdownName = $this->input->post('dropdownName');
                //----------1 for image, 0 for dropdown, 2 for jewelry state--------------
                if ($para == 0) {
                    $this->db->select('*');
                    $this->db->from('tbl_quickshop_products');
                    $this->db->where('sku_series', $sku_series);
                    $this->db->where('desc_e_value2', $desc_e_value2);
                    $this->db->where('desc_e_value3', $desc_e_value3);
                    $this->db->where('desc_e_value4', $desc_e_value4);
                    $this->db->where('desc_e_value5', $desc_e_value5);
                    $this->db->where('desc_e_value6', $desc_e_value6);
                    $this->db->where('desc_e_value7', $desc_e_value7);
                    $this->db->where('desc_e_value8', $desc_e_value8);
                    $this->db->where('desc_e_value9', $desc_e_value9);
                    $this->db->where('desc_e_value10', $desc_e_value10);
                    $this->db->where('desc_e_value11', $desc_e_value11);
                    $pro_data = $this->db->get()->row();
                    if (empty($pro_data)) {
                        $this->db->select('*');
                        $this->db->from('tbl_quickshop_products');
                        $this->db->where('sku_series', $sku_series);
                        $this->db->where('desc_e_value2', $desc_e_value2);
                        $this->db->where('desc_e_value3', $desc_e_value3);
                        $this->db->where('desc_e_value4', $desc_e_value4);
                        $this->db->where('desc_e_value5', $desc_e_value5);
                        if ($col !== 'desc_e_value2' && $col !== 'desc_e_value3' && $col !== 'desc_e_value4' && $col !== 'desc_e_value5') {
                            $this->db->where($col, $value);
                        }
                        $pro_data = $this->db->get()->row();
                    }
                    $this->db->select('*');
                    $this->db->from('tbl_quickshop_products');
                    $this->db->where('sku_series', $sku_series);
                    $this->db->where('gdesc', $gdesc);
                    $this->db->where($col, $value);
                    $quality_data = $this->db->get()->row();
                    // print_r($pro_data);die();
                    $column_shape = "";
                    $column_quality = "";
                    $column_jstate = "";
                    $column_product = "";
                    //-----shape of stone------
                    if ($desc_e_value2 == $active && !empty($desc_e_value2) && $col !== 'desc_e_value2') {
                        $column_shape = 'desc_e_value2';
                    }
                    if ($desc_e_value3 == $active && !empty($desc_e_value3) && $col !== 'desc_e_value3') {
                        $column_shape = 'desc_e_value3';
                    }
                    if ($desc_e_value4 == $active && !empty($desc_e_value4) && $col !== 'desc_e_value4') {
                        $column_shape = 'desc_e_value4';
                    }
                    if ($desc_e_value5 == $active && !empty($desc_e_value5) && $col !== 'desc_e_value5') {
                        $column_shape = 'desc_e_value5';
                    }
                    if ($desc_e_value6 == $active && !empty($desc_e_value6) && $col !== 'desc_e_value6') {
                        $column_shape = 'desc_e_value6';
                    }
                    if ($desc_e_value7 == $active && !empty($desc_e_value7) && $col !== 'desc_e_value7') {
                        $column_shape = 'desc_e_value7';
                    }
                    if ($desc_e_value8 == $active && !empty($desc_e_value8) && $col !== 'desc_e_value8') {
                        $column_shape = 'desc_e_value8';
                    }
                    if ($desc_e_value9 == $active && !empty($desc_e_value9) && $col !== 'desc_e_value9') {
                        $column_shape = 'desc_e_value9';
                    }
                    if ($desc_e_value10 == $active && !empty($desc_e_value10)  && $col !== 'desc_e_value10') {
                        $column_shape = 'desc_e_value10';
                    }
                    //-----quality----------
                    if ($quality_data->desc_e_name2 == 'Quality' && $col !== 'desc_e_value2') {
                        $column_quality = 'desc_e_value2';
                    }
                    if ($quality_data->desc_e_name3 == 'Quality' && $col !== 'desc_e_value3') {
                        $column_quality = 'desc_e_value3';
                    }
                    if ($quality_data->desc_e_name4 == 'Quality' && $col !== 'desc_e_value4') {
                        $column_quality = 'desc_e_value4';
                    }
                    if ($quality_data->desc_e_name5 == 'Quality' && $col !== 'desc_e_value5') {
                        $column_quality = 'desc_e_value5';
                    }
                    if ($quality_data->desc_e_name6 == 'Quality' && $col !== 'desc_e_value6') {
                        $column_quality = 'desc_e_value6';
                    }
                    if ($quality_data->desc_e_name7 == 'Quality' && $col !== 'desc_e_value7') {
                        $column_quality = 'desc_e_value7';
                    }
                    if ($quality_data->desc_e_name8 == 'Quality' && $col !== 'desc_e_value8') {
                        $column_quality = 'desc_e_value8';
                    }
                    if ($quality_data->desc_e_name9 == 'Quality' && $col !== 'desc_e_value9') {
                        $column_quality = 'desc_e_value9';
                    }
                    //------ jewelry state---------
                    if ($quality_data->desc_e_name2 == 'Jewelry State' && $col !== 'desc_e_value2') {
                        $column_jstate = 'desc_e_value2';
                        $value_jstate = $desc_e_value2;
                    }
                    if ($quality_data->desc_e_name3 == 'Jewelry State' && $col !== 'desc_e_value3') {
                        $column_jstate = 'desc_e_value3';
                        $value_jstate = $desc_e_value3;
                    }
                    if ($quality_data->desc_e_name4 == 'Jewelry State' && $col !== 'desc_e_value4') {
                        $column_jstate = 'desc_e_value4';
                        $value_jstate = $desc_e_value4;
                    }
                    if ($quality_data->desc_e_name5 == 'Jewelry State' && $col !== 'desc_e_value5') {
                        $column_jstate = 'desc_e_value5';
                        $value_jstate = $desc_e_value5;
                    }
                    if ($quality_data->desc_e_name6 == 'Jewelry State' && $col !== 'desc_e_value6') {
                        $column_jstate = 'desc_e_value6';
                        $value_jstate = $desc_e_value6;
                    }
                    if ($quality_data->desc_e_name7 == 'Jewelry State' && $col !== 'desc_e_value7') {
                        $column_jstate = 'desc_e_value7';
                        $value_jstate = $desc_e_value7;
                    }
                    if ($quality_data->desc_e_name8 == 'Jewelry State' && $col !== 'desc_e_value8') {
                        $column_jstate = 'desc_e_value8';
                        $value_jstate = $desc_e_value8;
                    }
                    if ($quality_data->desc_e_name9 == 'Jewelry State' && $col !== 'desc_e_value9') {
                        $column_jstate = 'desc_e_value9';
                        $value_jstate = $desc_e_value9;
                    }
                    //------ Product - Engagement ring/Band/Shank---------
                    if ($quality_data->desc_e_name2 == 'Product' && $col !== 'desc_e_value2') {
                        $column_product = 'desc_e_value2';
                        $value_product = $desc_e_value2;
                    }
                    if ($quality_data->desc_e_name3 == 'Product' && $col !== 'desc_e_value3') {
                        $column_product = 'desc_e_value3';
                        $value_product = $desc_e_value3;
                    }
                    if ($quality_data->desc_e_name4 == 'Product' && $col !== 'desc_e_value4') {
                        $column_product = 'desc_e_value4';
                        $value_product = $desc_e_value4;
                    }
                    if ($quality_data->desc_e_name5 == 'Product' && $col !== 'desc_e_value5') {
                        $column_product = 'desc_e_value5';
                        $value_product = $desc_e_value5;
                    }
                    if ($quality_data->desc_e_name6 == 'Product' && $col !== 'desc_e_value6') {
                        $column_product = 'desc_e_value6';
                        $value_product = $desc_e_value6;
                    }
                    if ($quality_data->desc_e_name7 == 'Product' && $col !== 'desc_e_value7') {
                        $column_product = 'desc_e_value7';
                        $value_product = $desc_e_value7;
                    }
                    if ($quality_data->desc_e_name8 == 'Product' && $col !== 'desc_e_value8') {
                        $column_product = 'desc_e_value8';
                        $value_product = $desc_e_value8;
                    }
                    if ($quality_data->desc_e_name9 == 'Product' && $col !== 'desc_e_value9') {
                        $column_product = 'desc_e_value9';
                        $value_product = $desc_e_value9;
                    }
                    if (empty($pro_data)) {
                        $this->db->select('*');
                        $this->db->from('tbl_quickshop_products');
                        $this->db->where('sku_series', $sku_series);
                        $this->db->where($col, $value);
                        $this->db->where('gdesc', $gdesc);
                        if (!empty($column_shape) && !empty($active)) {
                            $this->db->where($column_shape, $active);
                        }
                        if (!empty($column_quality)) {
                            $this->db->where($column_quality, $dropdownName);
                        }
                        if (!empty($column_jstate)) {
                            $this->db->where($column_jstate, $value_jstate);
                        }
                        if (!empty($column_product)) {
                            $this->db->where($column_product, $value_product);
                        }
                        $pro_data = $this->db->get()->row();
                        if (empty($pro_data)) {
                            $this->db->select('*');
                            $this->db->from('tbl_quickshop_products');
                            $this->db->where('sku_series', $sku_series);
                            $this->db->where('gdesc', $gdesc);
                            $this->db->where($col, $value);
                            if (!empty($column_jstate)) {
                                $this->db->where($column_jstate, $value_jstate);
                            }
                            if (!empty($column_product)) {
                                $this->db->where($column_product, $value_product);
                            }
                            $pro_data = $this->db->get()->row();
                        }
                    }
                    $this->db->select('*');
                    $this->db->from('tbl_quickshop_products');
                    $this->db->where('sku_series', $pro_data->sku_series);
                    $this->db->where('gdesc', $pro_data->gdesc);
                    if (!empty($column_shape) && !empty($active)) {
                        $this->db->where($column_shape, $active);
                    }
                    if (!empty($column_quality)) {
                        $this->db->where($column_quality, $dropdownName);
                    }
                    if (!empty($column_jstate)) {
                        $this->db->where($column_jstate, $value_jstate);
                    }
                    if (!empty($column_product)) {
                        $this->db->where($column_product, $value_product);
                    }
                    $d2 = $this->db->get();
                    // echo $column_jstate;die();
                    $b = 0;
                    $Quality = [];
                    foreach ($d2->result() as $quality) {
                        if (!empty($s)) {
                            $Quality = array_merge(array('quality' . $b => $quality->$s), $Quality);
                            // print_r($B1);
                        }
                        $b++;
                    }
                    $Quality =  json_encode(array_unique($Quality));
                    // echo $Quality;die();
                    $b = 0;
                    $B1 = [];
                    if ($column_jstate != 'desc_e_value2' && $column_product != 'desc_e_value2') {
                        foreach ($d2->result() as $b111) {
                            if (!empty($desc_e_value2)) {
                                if ($pro_data->desc_e_value1 == $b111->desc_e_value1) {
                                    $B1 = array_merge(array('desc_e_value2' . $b => $b111->desc_e_value2), $B1);
                                }
                                // print_r($B1);
                            }
                            $b++;
                        }
                        $B1 =  json_encode(array_unique($B1));
                    } else {
                        $B1 = "";
                    }
                    $b = 0;
                    $B2 = [];
                    if ($column_jstate != 'desc_e_value3' && $column_product != 'desc_e_value3') {
                        foreach ($d2->result() as $b222) {
                            if (!empty($desc_e_value3)) {
                                if ($pro_data->desc_e_value1 == $b222->desc_e_value1 && $pro_data->desc_e_value2 == $b222->desc_e_value2) {
                                    $B2 = array_merge(array('desc_e_value3' . $b => $b222->desc_e_value3), $B2);
                                }
                            }
                            $b++;
                        }
                        $B2 =  json_encode(array_unique($B2));
                    } else {
                        $B2 = "";
                    }
                    $b = 0;
                    $B3 = [];
                    if ($column_jstate != 'desc_e_value4' && $column_product != 'desc_e_value4') {
                        foreach ($d2->result() as $b333) {
                            if (!empty($desc_e_value4)) {
                                if ($pro_data->desc_e_value1 == $b333->desc_e_value1 && $pro_data->desc_e_value2 == $b333->desc_e_value2 && $pro_data->desc_e_value3 == $b333->desc_e_value3) {
                                    $B3 = array_merge(array('desc_e_value4' . $b => $b333->desc_e_value4), $B3);
                                }
                            }
                            $b++;
                        }
                        $B3 =  json_encode(array_unique($B3));
                    } else {
                        $B3 = "";
                    }
                    $b = 0;
                    $B4 = [];
                    if ($column_jstate != 'desc_e_value5' && $column_product != 'desc_e_value5') {
                        foreach ($d2->result() as $b444) {
                            if (!empty($desc_e_value5)) {
                                if ($pro_data->desc_e_value1 == $b444->desc_e_value1 && $pro_data->desc_e_value2 == $b444->desc_e_value2 && $pro_data->desc_e_value3 == $b444->desc_e_value3 && $pro_data->desc_e_value4 == $b444->desc_e_value4) {
                                    $B4 = array_merge(array('desc_e_value5' . $b => $b444->desc_e_value5), $B4);
                                }
                            }
                            $b++;
                        }
                        $B4 =  json_encode(array_unique($B4));
                    } else {
                        $B4 = "";
                    }
                    $b = 0;
                    $B5 = [];
                    if ($column_jstate != 'desc_e_value6' && $column_product != 'desc_e_value6') {
                        foreach ($d2->result() as $b555) {
                            if (!empty($desc_e_value6)) {
                                if ($pro_data->desc_e_value1 == $b555->desc_e_value1 && $pro_data->desc_e_value2 == $b555->desc_e_value2 && $pro_data->desc_e_value3 == $b555->desc_e_value3 && $pro_data->desc_e_value4 == $b555->desc_e_value4 && $pro_data->desc_e_value5 == $b555->desc_e_value5) {
                                    $B5 = array_merge(array('desc_e_value6' . $b => $b555->desc_e_value6), $B5);
                                }
                            }
                            $b++;
                        }
                        $B5 =  json_encode(array_unique($B5));
                    } else {
                        $B5 = "";
                    }
                    $b = 0;
                    $B6 = [];
                    if ($column_jstate != 'desc_e_value7' && $column_product != 'desc_e_value7') {
                        foreach ($d2->result() as $b666) {
                            if (!empty($desc_e_value7)) {
                                if ($pro_data->desc_e_value1 == $b666->desc_e_value1 && $pro_data->desc_e_value2 == $b666->desc_e_value2 && $pro_data->desc_e_value3 == $b666->desc_e_value3 && $pro_data->desc_e_value4 == $b666->desc_e_value4 && $pro_data->desc_e_value5 == $b666->desc_e_value5 && $pro_data->desc_e_value6 == $b666->desc_e_value6) {
                                    $B6 = array_merge(array('desc_e_value7' . $b => $b666->desc_e_value7), $B6);
                                }
                            }
                            $b++;
                        }
                        $B6 =  json_encode(array_unique($B6));
                    } else {
                        $B6 = "";
                    }
                    $b = 0;
                    $B7 = [];
                    foreach ($d2->result() as $b777) {
                        if (!empty($desc_e_value8)) {
                            if ($pro_data->desc_e_value1 == $b777->desc_e_value1 && $pro_data->desc_e_value2 == $b777->desc_e_value2 && $pro_data->desc_e_value3 == $b777->desc_e_value3 && $pro_data->desc_e_value4 == $b777->desc_e_value4 && $pro_data->desc_e_value5 == $b777->desc_e_value5 && $pro_data->desc_e_value6 == $b777->desc_e_value6 && $pro_data->desc_e_value7 == $b777->desc_e_value7) {
                                $B7 = array_merge(array('desc_e_value8' . $b => $b777->desc_e_value8), $B7);
                            }
                        }
                        $b++;
                    }
                    $B7 =  json_encode(array_unique($B7));
                    $b = 0;
                    $B8 = [];
                    foreach ($d2->result() as $b888) {
                        if (!empty($desc_e_value9)) {
                            if ($pro_data->desc_e_value1 == $b888->desc_e_value1 && $pro_data->desc_e_value2 == $b888->desc_e_value2 && $pro_data->desc_e_value3 == $b888->desc_e_value3 && $pro_data->desc_e_value4 == $b888->desc_e_value4 && $pro_data->desc_e_value5 == $b888->desc_e_value5 && $pro_data->desc_e_value6 == $b888->desc_e_value6 && $pro_data->desc_e_value7 == $b888->desc_e_value7 && $pro_data->desc_e_value8 == $b888->desc_e_value8) {
                                $B8 = array_merge(array('desc_e_value9' . $b => $b888->desc_e_value9), $B8);
                            }
                        }
                        $b++;
                    }
                    $B8 =  json_encode(array_unique($B8));
                    $b = 0;
                    $B9 = [];
                    foreach ($d2->result() as $b999) {
                        if (!empty($desc_e_value10)) {
                            if ($pro_data->desc_e_value1 == $b999->desc_e_value1 && $pro_data->desc_e_value2 == $b999->desc_e_value2 && $pro_data->desc_e_value3 == $b999->desc_e_value3 && $pro_data->desc_e_value4 == $b999->desc_e_value4 && $pro_data->desc_e_value5 == $b999->desc_e_value5 && $pro_data->desc_e_value6 == $b999->desc_e_value6 && $pro_data->desc_e_value7 == $b999->desc_e_value7 && $pro_data->desc_e_value8 == $b999->desc_e_value8 && $pro_data->desc_e_value9 == $b999->desc_e_value9) {
                                $B9 = array_merge(array('desc_e_value10' . $b => $b999->desc_e_value10), $B9);
                            }
                        }
                        $b++;
                    }
                    $B9 = json_encode(array_unique($B9));
                    $b = 0;
                    $B10 = [];
                    foreach ($d2->result() as $b1010) {
                        if (!empty($desc_e_value11)) {
                            if ($pro_data->desc_e_value1 == $b1010->desc_e_value1 && $pro_data->desc_e_value2 == $b1010->desc_e_value2 && $pro_data->desc_e_value3 == $b1010->desc_e_value3 && $pro_data->desc_e_value4 == $b1010->desc_e_value4 && $pro_data->desc_e_value5 == $b1010->desc_e_value5 && $pro_data->desc_e_value6 == $b1010->desc_e_value6 && $pro_data->desc_e_value7 == $b1010->desc_e_value7 && $pro_data->desc_e_value8 == $b1010->desc_e_value8 && $pro_data->desc_e_value9 == $b1010->desc_e_value9 && $pro_data->desc_e_value10 == $b1010->desc_e_value10) {
                                $B10 = array_merge(array('desc_e_value11' . $b => $b1010->desc_e_value11), $B10);
                            }
                        }
                        $b++;
                    }
                    $B10 = json_encode(array_unique($B10));
                    $specs = [];
                    $canbe = [];
                    $RingSize = [];
                    $ringsizePriceadd = 0;
                    $this->db->select('*');
                    $this->db->from('tbl_product_specifications');
                    $this->db->where('product_id', $pro_data->id);
                    $spec_dataa = $this->db->get()->row();
                    if (!empty($spec_dataa)) {
                        $specs = $spec_dataa->specifications;
                        $canbe = $spec_dataa->canbesetwith;
                        $RingSize = $spec_dataa->ringsize;
                        $RingSizeDecode = json_decode($spec_dataa->ringsize);
                        if (!empty($RingSizeDecode)) {
                            foreach ($RingSizeDecode as $priceout) {
                                if ($priceout->Size == 7) {
                                    $ringsizePriceadd = $priceout->Price;
                                }
                            }
                        }
                    } else {
                        $specs = [];
                        $canbe = [];
                        $RingSize = [];
                        $ringsizePriceadd = 0;
                    }
                    $this->db->select('*');
                    $this->db->from('tbl_price_rule');
                    $pr_data = $this->db->get()->row();
                    $multiplier = $pr_data->multiplier;
                    $cost_price11 = $pr_data->cost_price1;
                    $cost_price22 = $pr_data->cost_price2;
                    $cost_price33 = $pr_data->cost_price3;
                    $cost_price44 = $pr_data->cost_price4;
                    $cost_price55 = $pr_data->cost_price5;
                    // echo $pro_data->price;
                    // die();
                    if (!empty($pro_data->price)) {
                        $cost_price = $pro_data->price + $ringsizePriceadd;
                        // $cost_price = $cost_price;
                        $retail = $cost_price * $multiplier;
                        $now_price = $cost_price;
                        if ($cost_price <= 500) {
                            $cost_price2 = $cost_price * $cost_price;
                            // $now_price= $cost_price*0.00000264018*($cost_price*2)+(-0.002220133*$cost_price)+1.950022201-1+0.95;
                            $number = round($cost_price * ($cost_price11 * $cost_price2 + $cost_price22 * $cost_price + $cost_price33), 2);
                            $unit = 5;
                            $remainder = $number % $unit;
                            $mround = ($remainder < $unit / 2) ? $number - $remainder : $number + ($unit - $remainder);
                            $now_price = round($mround) - 1 + 0.95;
                            // $now_price = round($mround);
                            // echo $cost_price;
                            // exit;
                        }
                        if ($cost_price > 500) {
                            $number = round($cost_price * ($cost_price44 * $cost_price / $multiplier + $cost_price55));
                            $unit = 5;
                            $remainder = $number % $unit;
                            $mround = ($remainder < $unit / 2) ? $number - $remainder : $number + ($unit - $remainder);
                            $now_price = round($mround) - 1 + 0.95;
                            // $now_price = round($mround);
                            // echo $cost_price;
                        }
                        $retail = $retail * $qty;
                        $now_price = $now_price * $qty;
                        $saved = round($retail - $now_price);
                        $dis_percent = round($saved / $retail * 100);
                        // $respone['retail'] = round($retail, 2);
                        $respone['retail'] = round($retail);
                        $respone['saved'] = $saved;
                        $respone['dis'] = $dis_percent;
                        $respone['price'] = number_format($now_price, 2);
                    }
                    $val_e = array(
                        'desc_e_name1' => $pro_data->desc_e_name1,
                        'desc_e_name2' => $pro_data->desc_e_name2,
                        'desc_e_name3' => $pro_data->desc_e_name3,
                        'desc_e_name4' => $pro_data->desc_e_name4,
                        'desc_e_name5' => $pro_data->desc_e_name5,
                        'desc_e_name6' => $pro_data->desc_e_name6,
                        'desc_e_name7' => $pro_data->desc_e_name7,
                        'desc_e_name8' => $pro_data->desc_e_name8,
                        'desc_e_name9' => $pro_data->desc_e_name9,
                        'desc_e_name10' => $pro_data->desc_e_name10,
                        'desc_e_name11' => $pro_data->desc_e_name11,
                    );
                    $deal = array_search('Quality', $val_e);
                    if (!empty($deal)) {
                        $col = $deal;
                    } else {
                        $col = '';
                    }
                    // echo $col;die();
                    if (empty($col)) {
                        $s = "";
                    } else {
                        $number = explode("desc_e_name", $col);
                        $s = "desc_e_value" . $number[1];
                    }
                    $respone['data'] = true;
                    $respone['update_pro'] = $pro_data;
                    $respone['quality'] = $pro_data->$s;
                    $respone['b1'] = $B1;
                    $respone['b2'] = $B2;
                    $respone['b3'] = $B3;
                    $respone['b4'] = $B4;
                    $respone['b5'] = $B5;
                    $respone['b6'] = $B6;
                    $respone['b7'] = $B7;
                    $respone['b8'] = $B8;
                    $respone['b9'] = $B9;
                    $respone['b10'] = $B10;
                    $respone['specs'] = $specs;
                    $respone['canbe'] = $canbe;
                    $respone['RingSize'] = $RingSize;
                    if ($B1 == '[]' && $B2 == '[]' && $B3 == '[]' && $B4 == '[]' && $B5 == '[]' && $B6 == '[]' && $B7 == '[]' && $B8 == '[]' && $B9 == '[]' && $B10 == '[]') {
                        $respone['changeThem'] = 0;
                    } else {
                        $respone['changeThem'] = 1;
                    }
                    echo json_encode($respone);
                } elseif ($para == 1) { //
                    // die();
                    // echo $col." ".$value;exit;
                    $this->db->select('*');
                    $this->db->from('tbl_quickshop_products');
                    $this->db->where('sku_series', $sku_series);
                    $this->db->where('desc_e_value2', $desc_e_value2);
                    $this->db->where('desc_e_value3', $desc_e_value3);
                    $this->db->where('desc_e_value4', $desc_e_value4);
                    $this->db->where('desc_e_value5', $desc_e_value5);
                    $this->db->where('desc_e_value6', $desc_e_value6);
                    $this->db->where('desc_e_value7', $desc_e_value7);
                    $this->db->where('desc_e_value8', $desc_e_value8);
                    $this->db->where('desc_e_value9', $desc_e_value9);
                    $pro_dropdown = $this->db->get();
                    $pro_data = $pro_dropdown->row();
                    if (empty($pro_data)) {
                        $this->db->select('*');
                        $this->db->from('tbl_quickshop_products');
                        $this->db->where('sku_series', $sku_series);
                        $this->db->where('gdesc', $gdesc);
                        $this->db->where($col, $value);
                        $pro_dropdown = $this->db->get();
                        $pro_data = $pro_dropdown->row();
                    }
                    // print_r($pro_data);exit;
                    //-----------------------Replace all dropdowns-------------------------------------------------
                    $val_e = array(
                        'desc_e_name2' => $pro_data->desc_e_name2,
                        'desc_e_name3' => $pro_data->desc_e_name3,
                        'desc_e_name4' => $pro_data->desc_e_name4,
                        'desc_e_name5' => $pro_data->desc_e_name5,
                        'desc_e_name6' => $pro_data->desc_e_name6,
                        'desc_e_name7' => $pro_data->desc_e_name7,
                        'desc_e_name8' => $pro_data->desc_e_name8,
                        'desc_e_name9' => $pro_data->desc_e_name9,
                        'desc_e_name10' => $pro_data->desc_e_name10,
                        'desc_e_name11' => $pro_data->desc_e_name11,
                    );
                    $deal = array_search('Quality', $val_e);
                    if (!empty($deal)) {
                        $colo = $deal;
                    } else {
                        $colo = $eng_center;
                    }
                    // echo $col;die();
                    if (empty($col)) {
                        $s = "";
                    } else {
                        $number = explode("desc_e_name", $colo);
                        $s = "desc_e_value" . $number[1];
                    }
                    // // echo $dropdownName;die();
                    $this->db->select('*');
                    $this->db->from('tbl_quickshop_products');
                    $this->db->where('sku_series', $sku_series);
                    $this->db->where('gdesc', $gdesc);
                    $this->db->where($col, $value);
                    $this->db->where($s, $dropdownName);
                    $pro_dropdown = $this->db->get();
                    $pro_data = $pro_dropdown->row();
                    // print_r($pro_data); echo "hi";
                    // echo $col." ".$value;exit;
                    //
                    if (empty($pro_data)) {
                        $this->db->select('*');
                        $this->db->from('tbl_quickshop_products');
                        $this->db->where('sku_series', $sku_series);
                        $this->db->where('gdesc', $gdesc);
                        $this->db->where($col, $value);
                        $pro_dropdown = $this->db->get();
                        $pro_data = $pro_dropdown->row();
                    }
                    $b = 0;
                    $Quality = [];
                    foreach ($pro_dropdown->result() as $quality) {
                        if (!empty($s)) {
                            $Quality = array_merge(array('quality' . $b => $quality->$s), $Quality);
                            // print_r($B1);
                        }
                        $b++;
                    }
                    $Quality =  json_encode(array_unique($Quality));
                    // echo $Quality;die();
                    $b = 0;
                    $B1 = [];
                    foreach ($pro_dropdown->result() as $b111) {
                        if (!empty($desc_e_value2)) {
                            if ($pro_data->desc_e_value1 == $b111->desc_e_value1) {
                                $B1 = array_merge(array('desc_e_value2' . $b => $b111->desc_e_value2), $B1);
                            }
                            // print_r($B1);
                        }
                        $b++;
                    }
                    $B1 =  json_encode(array_unique($B1));
                    $b = 0;
                    $B2 = [];
                    foreach ($pro_dropdown->result() as $b222) {
                        if (!empty($desc_e_value3)) {
                            if ($pro_data->desc_e_value1 == $b222->desc_e_value1 && $pro_data->desc_e_value2 == $b222->desc_e_value2) {
                                $B2 = array_merge(array('desc_e_value3' . $b => $b222->desc_e_value3), $B2);
                            }
                        }
                        $b++;
                    }
                    $B2 =  json_encode(array_unique($B2));
                    $b = 0;
                    $B3 = [];
                    foreach ($pro_dropdown->result() as $b333) {
                        if (!empty($desc_e_value4)) {
                            if ($pro_data->desc_e_value1 == $b333->desc_e_value1 && $pro_data->desc_e_value2 == $b333->desc_e_value2 && $pro_data->desc_e_value3 == $b333->desc_e_value3) {
                                $B3 = array_merge(array('desc_e_value4' . $b => $b333->desc_e_value4), $B3);
                            }
                        }
                        $b++;
                    }
                    $B3 =  json_encode(array_unique($B3));
                    $b = 0;
                    $B4 = [];
                    foreach ($pro_dropdown->result() as $b444) {
                        if (!empty($desc_e_value5)) {
                            if ($pro_data->desc_e_value1 == $b444->desc_e_value1 && $pro_data->desc_e_value2 == $b444->desc_e_value2 && $pro_data->desc_e_value3 == $b444->desc_e_value3 && $pro_data->desc_e_value4 == $b444->desc_e_value4) {
                                $B4 = array_merge(array('desc_e_value5' . $b => $b444->desc_e_value5), $B4);
                            }
                        }
                        $b++;
                    }
                    $B4 =  json_encode(array_unique($B4));
                    $b = 0;
                    $B5 = [];
                    foreach ($pro_dropdown->result() as $b555) {
                        if (!empty($desc_e_value6)) {
                            if ($pro_data->desc_e_value1 == $b555->desc_e_value1 && $pro_data->desc_e_value2 == $b555->desc_e_value2 && $pro_data->desc_e_value3 == $b555->desc_e_value3 && $pro_data->desc_e_value4 == $b555->desc_e_value4 && $pro_data->desc_e_value5 == $b555->desc_e_value5) {
                                $B5 = array_merge(array('desc_e_value6' . $b => $b555->desc_e_value6), $B5);
                            }
                        }
                        $b++;
                    }
                    $B5 =  json_encode(array_unique($B5));
                    $b = 0;
                    $B6 = [];
                    foreach ($pro_dropdown->result() as $b666) {
                        if (!empty($desc_e_value7)) {
                            if ($pro_data->desc_e_value1 == $b666->desc_e_value1 && $pro_data->desc_e_value2 == $b666->desc_e_value2 && $pro_data->desc_e_value3 == $b666->desc_e_value3 && $pro_data->desc_e_value4 == $b666->desc_e_value4 && $pro_data->desc_e_value5 == $b666->desc_e_value5 && $pro_data->desc_e_value6 == $b666->desc_e_value6) {
                                $B6 = array_merge(array('desc_e_value7' . $b => $b666->desc_e_value7), $B6);
                            }
                        }
                        $b++;
                    }
                    $B6 =  json_encode(array_unique($B6));
                    $b = 0;
                    $B7 = [];
                    foreach ($pro_dropdown->result() as $b777) {
                        if (!empty($desc_e_value8)) {
                            if ($pro_data->desc_e_value1 == $b777->desc_e_value1 && $pro_data->desc_e_value2 == $b777->desc_e_value2 && $pro_data->desc_e_value3 == $b777->desc_e_value3 && $pro_data->desc_e_value4 == $b777->desc_e_value4 && $pro_data->desc_e_value5 == $b777->desc_e_value5 && $pro_data->desc_e_value6 == $b777->desc_e_value6 && $pro_data->desc_e_value7 == $b777->desc_e_value7) {
                                $B7 = array_merge(array('desc_e_value8' . $b => $b777->desc_e_value8), $B7);
                            }
                        }
                        $b++;
                    }
                    $B7 =  json_encode(array_unique($B7));
                    $b = 0;
                    $B8 = [];
                    foreach ($pro_dropdown->result() as $b888) {
                        if (!empty($desc_e_value9)) {
                            if ($pro_data->desc_e_value1 == $b888->desc_e_value1 && $pro_data->desc_e_value2 == $b888->desc_e_value2 && $pro_data->desc_e_value3 == $b888->desc_e_value3 && $pro_data->desc_e_value4 == $b888->desc_e_value4 && $pro_data->desc_e_value5 == $b888->desc_e_value5 && $pro_data->desc_e_value6 == $b888->desc_e_value6 && $pro_data->desc_e_value7 == $b888->desc_e_value7 && $pro_data->desc_e_value8 == $b888->desc_e_value8) {
                                $B8 = array_merge(array('desc_e_value9' . $b => $b888->desc_e_value9), $B8);
                            }
                        }
                        $b++;
                    }
                    $B8 =  json_encode(array_unique($B8));
                    $b = 0;
                    $B9 = [];
                    foreach ($pro_dropdown->result() as $b999) {
                        if (!empty($desc_e_value10)) {
                            if ($pro_data->desc_e_value1 == $b999->desc_e_value1 && $pro_data->desc_e_value2 == $b999->desc_e_value2 && $pro_data->desc_e_value3 == $b999->desc_e_value3 && $pro_data->desc_e_value4 == $b999->desc_e_value4 && $pro_data->desc_e_value5 == $b999->desc_e_value5 && $pro_data->desc_e_value6 == $b999->desc_e_value6 && $pro_data->desc_e_value7 == $b999->desc_e_value7 && $pro_data->desc_e_value8 == $b999->desc_e_value8 && $pro_data->desc_e_value9 == $b999->desc_e_value9) {
                                $B9 = array_merge(array('desc_e_value10' . $b => $b999->desc_e_value10), $B9);
                            }
                        }
                        $b++;
                    }
                    $B9 = json_encode(array_unique($B9));
                    $b = 0;
                    $B10 = [];
                    foreach ($pro_dropdown->result() as $b1010) {
                        if (!empty($desc_e_value11)) {
                            if ($pro_data->desc_e_value1 == $b1010->desc_e_value1 && $pro_data->desc_e_value2 == $b1010->desc_e_value2 && $pro_data->desc_e_value3 == $b1010->desc_e_value3 && $pro_data->desc_e_value4 == $b1010->desc_e_value4 && $pro_data->desc_e_value5 == $b1010->desc_e_value5 && $pro_data->desc_e_value6 == $b1010->desc_e_value6 && $pro_data->desc_e_value7 == $b1010->desc_e_value7 && $pro_data->desc_e_value8 == $b1010->desc_e_value8 && $pro_data->desc_e_value9 == $b1010->desc_e_value9 && $pro_data->desc_e_value10 == $b1010->desc_e_value10) {
                                $B10 = array_merge(array('desc_e_value11' . $b => $b1010->desc_e_value11), $B10);
                            }
                        }
                        $b++;
                    }
                    $B10 = json_encode(array_unique($B10));
                    // print_r($B9);die();
                    if (!empty($pro_data)) {
                        $specs = [];
                        $canbe = [];
                        $RingSize = [];
                        $ringsizePriceadd = 0;
                        $this->db->select('*');
                        $this->db->from('tbl_product_specifications');
                        $this->db->where('product_id', $pro_data->id);
                        $spec_dataa = $this->db->get()->row();
                        if (!empty($spec_dataa)) {
                            $specs = $spec_dataa->specifications;
                            $canbe = $spec_dataa->canbesetwith;
                            $RingSize = $spec_dataa->ringsize;
                            $RingSizeDecode = json_decode($spec_dataa->ringsize);
                            if (!empty($RingSizeDecode)) {
                                foreach ($RingSizeDecode as $priceout) {
                                    if ($priceout->Size == 7) {
                                        $ringsizePriceadd = $priceout->Price;
                                    }
                                }
                            }
                        } else {
                            $specs = [];
                            $canbe = [];
                            $RingSize = [];
                            $ringsizePriceadd = 0;
                        }
                        $this->db->select('*');
                        $this->db->from('tbl_price_rule');
                        $pr_data = $this->db->get()->row();
                        $multiplier = $pr_data->multiplier;
                        $cost_price11 = $pr_data->cost_price1;
                        $cost_price22 = $pr_data->cost_price2;
                        $cost_price33 = $pr_data->cost_price3;
                        $cost_price44 = $pr_data->cost_price4;
                        $cost_price55 = $pr_data->cost_price5;
                        // echo $pro_data->price;die();
                        if (!empty($pro_data->price)) {
                            $cost_price = $pro_data->price + $ringsizePriceadd;
                            // $cost_price = $cost_price;
                            $retail = $cost_price * $multiplier;
                            $now_price = $cost_price;
                            // echo $now_price;
                            // exit;
                            if ($cost_price <= 500) {
                                $cost_price2 = $cost_price * $cost_price;
                                // $now_price= $cost_price*0.00000264018*($cost_price*2)+(-0.002220133*$cost_price)+1.950022201-1+0.95;
                                $number = round($cost_price * ($cost_price11 * $cost_price2 + $cost_price22 * $cost_price + $cost_price33), 2);
                                $unit = 5;
                                $remainder = $number % $unit;
                                $mround = ($remainder < $unit / 2) ? $number - $remainder : $number + ($unit - $remainder);
                                $now_price = round($mround) - 1 + 0.95;
                                // $now_price = round($mround);
                                // echo $cost_price;
                                // exit;
                            }
                            if ($cost_price > 500) {
                                $number = round($cost_price * ($cost_price44 * $cost_price / $multiplier + $cost_price55));
                                $unit = 5;
                                $remainder = $number % $unit;
                                $mround = ($remainder < $unit / 2) ? $number - $remainder : $number + ($unit - $remainder);
                                $now_price = round($mround) - 1 + 0.95;
                                // $now_price = round($mround);
                                // echo $cost_price;
                            }
                            $retail = $retail * $qty;
                            $now_price = $now_price * $qty;
                            $saved = round($retail - $now_price);
                            $dis_percent = round($saved / $retail * 100);
                            // $respone['retail'] = round($retail, 2);
                            // echo $now_price;die();
                            // $respone['retail'] = round($retail, 2);
                            $respone['retail'] = round($retail);
                            $respone['saved'] = $saved;
                            $respone['dis'] = $dis_percent;
                            $respone['price'] = number_format($now_price, 2);
                        }
                        $respone['data'] = true;
                        $respone['update_pro'] = $pro_data;
                        $respone['quality'] = $Quality;
                        $respone['b1'] = $B1;
                        $respone['b2'] = $B2;
                        $respone['b3'] = $B3;
                        $respone['b4'] = $B4;
                        $respone['b5'] = $B5;
                        $respone['b6'] = $B6;
                        $respone['b7'] = $B7;
                        $respone['b8'] = $B8;
                        $respone['b9'] = $B9;
                        $respone['b10'] = $B10;
                        $respone['specs'] = $specs;
                        $respone['canbe'] = $canbe;
                        $respone['RingSize'] = $RingSize;
                        $respone['changeThem'] = 1;
                        echo json_encode($respone);
                    } else {
                        $respone['data'] = false;
                        echo json_encode($respone);
                    }
                } elseif ($para == 2) {
                    // die();
                    // // echo $col." ".$value;exit;
                    $this->db->select('*');
                    $this->db->from('tbl_quickshop_products');
                    $this->db->where('sku_series', $sku_series);
                    $this->db->where('gdesc', $gdesc);
                    $this->db->where('desc_e_value2', $desc_e_value2);
                    $this->db->where('desc_e_value3', $desc_e_value3);
                    $this->db->where('desc_e_value4', $desc_e_value4);
                    $this->db->where('desc_e_value5', $desc_e_value5);
                    // $this->db->where('desc_e_value6',$desc_e_value6);
                    $pro_dropdown = $this->db->get();
                    $pro_data = $pro_dropdown->row();
                    // print_r($pro_data);die();
                    // $pro_data = '';
                    if (empty($pro_data)) {
                        $this->db->select('*');
                        $this->db->from('tbl_quickshop_products');
                        $this->db->where('sku_series', $sku_series);
                        $this->db->where('gdesc', $gdesc);
                        $this->db->where($col, $value);
                        $pro_dropdown = $this->db->get();
                        $pro_data = $pro_dropdown->row();
                    }
                    // echo $value;
                    // print_r($pro_data);die();
                    // die();
                    //-----------------------Replace all but Jewelry State dropdowns------------------------------------------
                    $val_e = array(
                        'desc_e_name2' => $pro_data->desc_e_name2,
                        'desc_e_name3' => $pro_data->desc_e_name3,
                        'desc_e_name4' => $pro_data->desc_e_name4,
                        'desc_e_name5' => $pro_data->desc_e_name5,
                        'desc_e_name6' => $pro_data->desc_e_name6,
                        'desc_e_name7' => $pro_data->desc_e_name7,
                        'desc_e_name8' => $pro_data->desc_e_name8,
                        'desc_e_name9' => $pro_data->desc_e_name9,
                        'desc_e_name10' => $pro_data->desc_e_name10,
                        'desc_e_name11' => $pro_data->desc_e_name11,
                    );
                    $deal = array_search('Quality', $val_e);
                    if (!empty($deal)) {
                        $colo = $deal;
                    } else {
                        $colo = $eng_center;
                    }
                    $state = array_search('Jewelry State', $val_e);
                    if (empty($state)) {
                        $state_row = "";
                        $state_value = "";
                    } else {
                        $state_no = explode("desc_e_name", $state);
                        $state_row = "desc_e_value" . $state_no[1];
                        $state_value = $pro_data->$state_row;
                    }
                    $eng_band_shank = array_search('Product', $val_e);
                    if (empty($eng_band_shank)) {
                        $eng_band_shank_row = "";
                        $eng_band_shank_value = "";
                    } else {
                        $eng_band_shank_no = explode("desc_e_name", $eng_band_shank);
                        $eng_band_shank_row = "desc_e_value" . $eng_band_shank_no[1];
                        $eng_band_shank_value = $pro_data->$eng_band_shank_row;
                    }
                    // echo $state_row;die();
                    if (empty($col)) {
                        $s = "";
                    } else {
                        $number = explode("desc_e_name", $colo);
                        $s = "desc_e_value" . $number[1];
                    }
                    // echo $dropdownName;die();
                    $this->db->select('*');
                    $this->db->from('tbl_quickshop_products');
                    $this->db->where('sku_series', $sku_series);
                    $this->db->where('gdesc', $gdesc);
                    $this->db->where($col, $value);                        //-----Jewelry state
                    $this->db->where($s, $dropdownName);            //-----Quality
                    $pro_dropdown = $this->db->get();
                    $pro_data = $pro_dropdown->row();
                    // print_r($pro_data); echo "hi";
                    // echo $col." ".$dropdownName;exit;
                    //
                    $this->db->select('*');
                    $this->db->from('tbl_quickshop_products');
                    $this->db->where('sku_series', $sku_series);
                    $this->db->where('gdesc', $gdesc);
                    $this->db->where($col, $value);
                    $pro_dropdown = $this->db->get();
                    if (empty($pro_data)) {
                        $pro_data = $pro_dropdown->row();
                    }
                    $b = 0;
                    $Quality = [];
                    foreach ($pro_dropdown->result() as $quality) {
                        if (!empty($s)) {
                            $Quality = array_merge(array('quality' . $b => $quality->$s), $Quality);
                            // print_r($B1);
                        }
                        $b++;
                    }
                    $Quality =  json_encode(array_unique($Quality));
                    // echo $Quality;die();
                    $b = 0;
                    $B1 = [];
                    foreach ($pro_dropdown->result() as $b111) {
                        if (!empty($desc_e_value2) && $state_row != 'desc_e_value2'  && $eng_band_shank_row != 'desc_e_value2') {
                            $B1 = array_merge(array('desc_e_value2' . $b => $b111->desc_e_value2), $B1);
                            // print_r($B1);
                        } else {
                            $B1 = "";
                        }
                        $b++;
                    }
                    if (!empty($B1)) {
                        sort($B1);
                        $B1 =  json_encode(array_unique($B1));
                    } else {
                        $B1 = "";
                    }
                    $b = 0;
                    $B2 = [];
                    foreach ($pro_dropdown->result() as $b222) {
                        if (!empty($desc_e_value3) && $state_row != 'desc_e_value3'  && $eng_band_shank_row != 'desc_e_value3') {
                            $B2 = array_merge(array('desc_e_value3' . $b => $b222->desc_e_value3), $B2);
                        } else {
                            $B2 = "";
                        }
                        $b++;
                    }
                    if (!empty($B2)) {
                        sort($B2);
                        $B2 =  json_encode(array_unique($B2));
                    } else {
                        $B2 = "";
                    }
                    $b = 0;
                    $B3 = [];
                    // echo "hi";die();
                    foreach ($pro_dropdown->result() as $b333) {
                        if (!empty($desc_e_value4) && $state_row != 'desc_e_value4'  && $eng_band_shank_row != 'desc_e_value4') {
                            if ($pro_data->desc_e_value1 == $b333->desc_e_value1 && $pro_data->desc_e_value2 == $b333->desc_e_value2 && $pro_data->desc_e_value3 == $b333->desc_e_value3) {
                                $B3 = array_merge(array('desc_e_value4' . $b => $b333->desc_e_value4), $B3);
                            }
                        } else {
                            $B3 = "";
                        }
                        $b++;
                    }
                    if (!empty($B3)) {
                        sort($B3);
                        $B3 =  json_encode(array_unique($B3));
                    } else {
                        $B3 = "";
                    }
                    $b = 0;
                    $B4 = [];
                    foreach ($pro_dropdown->result() as $b444) {
                        if (!empty($desc_e_value5) && $state_row != 'desc_e_value5'  && $eng_band_shank_row != 'desc_e_value5') {
                            $B4 = array_merge(array('desc_e_value5' . $b => $b444->desc_e_value5), $B4);
                        } else {
                            $B4 = "";
                        }
                        $b++;
                    }
                    if (!empty($B4)) {
                        sort($B4);
                        $B4 =  json_encode(array_unique($B4));
                    } else {
                        $B4 = "";
                    }
                    $b = 0;
                    $B5 = [];
                    foreach ($pro_dropdown->result() as $b555) {
                        if (!empty($desc_e_value6) && $state_row != 'desc_e_value6'  && $eng_band_shank_row != 'desc_e_value6') {
                            $B5 = array_merge(array('desc_e_value6' . $b => $b555->desc_e_value6), $B5);
                        } else {
                            $B5 = "";
                        }
                        $b++;
                    }
                    if (!empty($B5)) {
                        sort($B5);
                        $B5 =  json_encode(array_unique($B5));
                    } else {
                        $B5 = "";
                    }
                    $b = 0;
                    $B6 = [];
                    foreach ($pro_dropdown->result() as $b666) {
                        if (!empty($desc_e_value7) && $state_row != 'desc_e_value7'  && $eng_band_shank_row != 'desc_e_value7') {
                            $B6 = array_merge(array('desc_e_value7' . $b => $b666->desc_e_value7), $B6);
                        } else {
                            $B6 = "";
                        }
                        $b++;
                    }
                    if (!empty($B6)) {
                        sort($B6);
                        $B6 =  json_encode(array_unique($B6));
                    } else {
                        $B6 = "";
                    }
                    $b = 0;
                    $B7 = [];
                    foreach ($pro_dropdown->result() as $b777) {
                        if (!empty($desc_e_value8) && $state_row != 'desc_e_value8'  && $eng_band_shank_row != 'desc_e_value8') {
                            $B7 = array_merge(array('desc_e_value8' . $b => $b777->desc_e_value8), $B7);
                        } else {
                            $B7 = "";
                        }
                        $b++;
                    }
                    if (!empty($B7)) {
                        sort($B7);
                        $B7 =  json_encode(array_unique($B7));
                    } else {
                        $B7 = "";
                    }
                    $b = 0;
                    $B8 = [];
                    foreach ($pro_dropdown->result() as $b888) {
                        if (!empty($desc_e_value9) && $state_row != 'desc_e_value9'  && $eng_band_shank_row != 'desc_e_value9') {
                            $B8 = array_merge(array('desc_e_value9' . $b => $b888->desc_e_value9), $B8);
                        } else {
                            $B8 = "";
                        }
                        $b++;
                    }
                    if (!empty($B8)) {
                        $B8 =  json_encode(array_unique($B8));
                    } else {
                        $B8 = "";
                    }
                    $b = 0;
                    $B9 = [];
                    foreach ($pro_dropdown->result() as $b999) {
                        if (!empty($desc_e_value10) && $state_row != 'desc_e_value10'  && $eng_band_shank_row != 'desc_e_value10') {
                            $B9 = array_merge(array('desc_e_value10' . $b => $b999->desc_e_value10), $B9);
                        } else {
                            $B9 = "";
                        }
                        $b++;
                    }
                    if (!empty($B9)) {
                        $B9 =  json_encode(array_unique($B9));
                    } else {
                        $B9 = "";
                    }
                    // print_r($B9);die();
                    //-----------------------------------------------------------------------------------------------
                    if (!empty($pro_data)) {
                        $specs = [];
                        $canbe = [];
                        $RingSize = [];
                        $ringsizePriceadd = 0;
                        $this->db->select('*');
                        $this->db->from('tbl_product_specifications');
                        $this->db->where('product_id', $pro_data->id);
                        $spec_dataa = $this->db->get()->row();
                        if (!empty($spec_dataa)) {
                            $specs = $spec_dataa->specifications;
                            $canbe = $spec_dataa->canbesetwith;
                            $RingSize = $spec_dataa->ringsize;
                            $RingSizeDecode = json_decode($spec_dataa->ringsize);
                            if (!empty($RingSizeDecode)) {
                                foreach ($RingSizeDecode as $priceout) {
                                    if ($priceout->Size == 7) {
                                        $ringsizePriceadd = $priceout->Price;
                                    }
                                }
                            }
                        } else {
                            $specs = [];
                            $canbe = [];
                            $RingSize = [];
                            $ringsizePriceadd = 0;
                        }
                        $this->db->select('*');
                        $this->db->from('tbl_price_rule');
                        $pr_data = $this->db->get()->row();
                        $multiplier = $pr_data->multiplier;
                        $cost_price11 = $pr_data->cost_price1;
                        $cost_price22 = $pr_data->cost_price2;
                        $cost_price33 = $pr_data->cost_price3;
                        $cost_price44 = $pr_data->cost_price4;
                        $cost_price55 = $pr_data->cost_price5;
                        // echo $pro_data->price;die();
                        if (!empty($pro_data->price)) {
                            $cost_price = $pro_data->price + $ringsizePriceadd;
                            // $cost_price = $cost_price;
                            $retail = $cost_price * $multiplier;
                            $now_price = $cost_price;
                            // echo $now_price;
                            // exit;
                            if ($cost_price <= 500) {
                                $cost_price2 = $cost_price * $cost_price;
                                // $now_price= $cost_price*0.00000264018*($cost_price*2)+(-0.002220133*$cost_price)+1.950022201-1+0.95;
                                $number = round($cost_price * ($cost_price11 * $cost_price2 + $cost_price22 * $cost_price + $cost_price33), 2);
                                $unit = 5;
                                $remainder = $number % $unit;
                                $mround = ($remainder < $unit / 2) ? $number - $remainder : $number + ($unit - $remainder);
                                $now_price = round($mround) - 1 + 0.95;
                                // $now_price = round($mround);
                                // echo $cost_price;
                                // exit;
                            }
                            if ($cost_price > 500) {
                                $number = round($cost_price * ($cost_price44 * $cost_price / $multiplier + $cost_price55));
                                $unit = 5;
                                $remainder = $number % $unit;
                                $mround = ($remainder < $unit / 2) ? $number - $remainder : $number + ($unit - $remainder);
                                $now_price = round($mround) - 1 + 0.95;
                                // $now_price = round($mround);
                                // echo $cost_price;
                            }
                            $retail = $retail * $qty;
                            $now_price = $now_price * $qty;
                            $saved = round($retail - $now_price);
                            $dis_percent = round($saved / $retail * 100);
                            // $respone['retail'] = round($retail, 2);
                            // echo $now_price;die();
                            // $respone['retail'] = round($retail, 2);
                            $respone['retail'] = round($retail);
                            $respone['saved'] = $saved;
                            $respone['dis'] = $dis_percent;
                            $respone['price'] = number_format($now_price, 2);
                        }
                        $respone['data'] = true;
                        $respone['update_pro'] = $pro_data;
                        $respone['quality'] = $Quality;
                        $respone['b1'] = $B1;
                        $respone['b2'] = $B2;
                        $respone['b3'] = $B3;
                        $respone['b4'] = $B4;
                        $respone['b5'] = $B5;
                        $respone['b6'] = $B6;
                        $respone['b7'] = $B7;
                        $respone['b8'] = $B8;
                        $respone['b9'] = $B9;
                        $respone['specs'] = $specs;
                        $respone['canbe'] = $canbe;
                        $respone['RingSize'] = $RingSize;
                        $respone['changeThem'] = 1;
                        echo json_encode($respone);
                    } else {
                        $respone['data'] = false;
                        echo json_encode($respone);
                    }
                }
            } else {
                $respone['data'] = false;
                $respone['data_message'] = validation_errors();
                echo json_encode($respone);
            }
        } else {
            $respone['data'] = false;
            $respone['data_message'] = "Please insert some data, No data available";
            echo json_encode($respone);
        }
    }
    public function sub_category($idd)
    {
        $id = $idd;
        $this->db->select('*');
        $this->db->from('tbl_sub_category');
        $this->db->where('category', $id);
        $this->db->where('is_active', 1);
        $this->db->order_by('seq', 'ASC');
        $data['sub_category'] = $this->db->get();
        //get name Category
        $this->db->select('*');
        $this->db->from('tbl_category');
        $this->db->where('id', $id);
        $cate_da = $this->db->get()->row();
        $cat_banner = '';
        if (!empty($cate_da)) {
            $cate_name = $cate_da->name;
            $cate_description = $cate_da->description;
            if (!empty($cate_da->banner)) {
                $cat_banner = base_url() . $cate_da->banner;
            }
        } else {
            $cate_name = "";
            $cate_description = "";
        }
        $data['category_id'] = $id;
        $data['category_name'] = $cate_name;
        $data['cate_description'] = $cate_description;
        $data['cat_banner'] = $cat_banner;
        $this->load->view('common/header', $data);
        $this->load->view('sub_category');
        $this->load->view('common/footer');
    }
    public function minor_sub_products($idd)
    {
        $id = base64_decode($idd);
        $nurseng = 1;
        $data['subcategory_id'] = $idd;
        $this->db->select('*');
        $this->db->from('tbl_minisubcategory');
        $this->db->where('subcategory', $id);
        $this->db->where('is_active', 1);
        $this->db->order_by('seq', 'ASC');
        $data['minorsub_category'] = $this->db->get();
        //get subcategory ans category name
        $this->db->select('*');
        $this->db->from('tbl_sub_category');
        $this->db->where('id', $id);
        // $this->db->where('is_active',1);
        $subcate_da = $this->db->get()->row();
        if (!empty($subcate_da)) {
            $subcategory_name = $subcate_da->name;
            $category_id = $subcate_da->category;
            $banner = $subcate_da->banner;
            $description = $subcate_da->description;
            //get name Category
            $this->db->select('*');
            $this->db->from('tbl_category');
            $this->db->where('id', $category_id);
            $cate_da = $this->db->get()->row();
            if (!empty($cate_da)) {
                $cate_name = $cate_da->name;
            } else {
                $cate_name = "";
            }
        } else {
            $category_id = "";
            $cate_name = "N/A";
            $subcategory_name = "N/A";
            $banner = "";
            $description = "N/A";
        }
        $data['category_id'] = $category_id;
        $data['category_name'] = $cate_name;
        $data['subcategory_name'] = $subcategory_name;
        $data['banner'] = $banner;
        $data['description'] = $description;
        $this->load->view('common/header', $data);
        $this->load->view('minorsub_category');
        $this->load->view('common/footer');
    }
    // public function checkout()
    // 	{
    // 			$this->load->view('common/header');
    // 			$this->load->view('checkout');
    // 			$this->load->view('common/footer');
    //
    // 	}
    public function checkout_af()
    {
        $selected_address = $this->input->get('addr');
        $user_id = $this->session->userdata('user_id');
        $this->db->select('*');
        $this->db->from('tbl_cart');
        $this->db->where('user_id', $user_id);
        $data['cart_data'] = $this->db->get();
        $data['address_id'] = base64_decode($selected_address);
        $data['af'] = 1;
        // echo $selected_address;
        // 															echo 	$this->session->flashdata('data');
        // 															 echo $this->session->flashdata('order_id');
        // 															echo  $this->session->flashdata('amn');
        // 															 echo $this->session->flashdata('return_url');
        // 															 echo $this->session->flashdata('surl');
        // 															 echo $this->session->flashdata('furl');
        // 															 echo $this->session->flashdata('currency_code');
        //
        // die();
        $this->load->view('common/header', $data);
        $this->load->view('checkout');
        $this->load->view('common/footer');
    }
    public function register()
    {
        if (!empty($this->session->userdata('user_id'))) {
            redirect("/", "refresh");
        } else {
            $this->load->view('common/header');
            $this->load->view('register');
            $this->load->view('common/footer');
        }
    }
    // public function cart()
    // 	{
    //
    // 			$this->db->select('*');
    // 			$this->db->from('tbl_cart');
    // 			//$this->db->where('',);
    // 			$data['cart']= $this->db->get();
    //
    // 			$this->load->view('common/header',$data);
    // 			$this->load->view('cart');
    // 			$this->load->view('common/footer');
    //
    // 	}
    public function cart()
    {
        if (!empty($this->session->userdata('user_data'))) {
            $cart_fetch = $this->cart->ViewCartOnline();
        } else {
            $cart_fetch = $this->cart->ViewCartOffline();
        }
        if (!empty($this->session->userdata('user_id'))) {
            $user_id =  $this->session->userdata('usersid');
            $this->db->select('*');
            $this->db->from('tbl_cart');
            //$this->db->where('',);
            $data['cart'] = $this->db->get();
            $this->load->view('common/header', $data);
            $this->load->view('cart');
            $this->load->view('common/footer');
        } else {
            // $data['cart_page']= $cart_page;
            $data['data'] = true;
            $this->load->view('common/header', $data);
            $this->load->view('local_cart');
            $this->load->view('common/footer');
        }
    }
    public function wishlist()
    {
        if (!empty($this->session->userdata('user_id'))) {
            $this->db->select('*');
            $this->db->from('tbl_wishlist');
            $this->db->where('user_id', $this->session->userdata('user_id'));
            $data['wishlist_data'] = $this->db->get();
            $data['wishlistCheck'] = $data['wishlist_data']->row();
            $this->load->view('common/header', $data);
            $this->load->view('wishlist');
            $this->load->view('common/footer');
        } else {
            redirect("/");
        }
    }
    public function add_quantity_data($t, $iw = "")
    {
        if (!empty($this->session->userdata('user_name'))) {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->helper('security');
            if ($this->input->post()) {
                // print_r($this->input->post());
                // exit;
                $this->form_validation->set_rules('quantity', 'quantity', 'required|xss_clean|trim');
                if ($this->form_validation->run() == TRUE)
                // {			echo 'hi';exit;
                {
                    $qty = $this->input->post('quantity');
                    $cid = $this->session->userdata('user_id');
                    $idw = base64_decode($iw);
                    $stuller_pro_id = $this->input->get('stuller');
                    if (!empty($stuller_pro_id)) {
                        $stuller_pro_idw = base64_decode($stuller_pro_id);
                    } else {
                        $stuller_pro_idw = "";
                    }
                    $typ = base64_decode($t);
                    if ($qty <= 0) {
                        $this->session->set_flashdata('emessage', 'Product quantity should be greater than 0.');
                        redirect($_SERVER['HTTP_REFERER']);
                    }
                    if ($typ == 1) {
                        $data_insert = array(
                            'quantity' => $qty,
                            'user_id' => $cid,
                            'product_id' => $idw,
                        );
                        $last_id = $this->base_model->insert_table("tbl_cart", $data_insert, 1);
                    }
                    if ($typ == 2) {
                        $idw = base64_decode($iw);
                        $data_insert = array(
                            'quantity' => $qty,
                        );
                        if (empty($stuller_pro_idw)) {
                            $this->db->where('product_id', $idw);
                            $last_id = $this->db->update('tbl_cart', $data_insert);
                        } else {
                            $this->db->where('stuller_pro_id', $stuller_pro_idw);
                            $last_id = $this->db->update('tbl_cart', $data_insert);
                        }
                    }
                    if ($last_id != 0) {
                        $this->session->set_flashdata('smessage', 'Quantity updated successfully');
                        redirect("Home/cart", "refresh");
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
    // 	public function add_quantity_data($t,$iw="")
    //
    // 					{
    //
    // 						if(!empty($this->session->userdata('user_name'))){
    //
    //
    // 				$this->load->helper(array('form', 'url'));
    // 				$this->load->library('form_validation');
    // 				$this->load->helper('security');
    // 				if($this->input->post())
    // 				{
    // 					// print_r($this->input->post());
    // 					// exit;
    // 			$this->form_validation->set_rules('quantity', 'quantity', 'required|xss_clean|trim');
    // 					if($this->form_validation->run()== TRUE)
    // 					{
    // 						$quan=$this->input->post('quantity');
    // 						$cid = $this->session->userdata('user_id');
    // 					$idw=base64_decode($iw);
    //
    // 				$typ=base64_decode($t);
    //
    // 				// echo $typ;exit;
    //
    // 			if($typ==1){
    //
    // 				$data_insert = array(
    // 									'quantity'=>$quan,
    // 									'user_id'=>$cid,
    // 									'product_id'=>$idw
    //
    // 									);
    //
    // 				$last_id=$this->base_model->insert_table("tbl_cart",$data_insert,1) ;
    //
    //
    //
    // 													if($last_id!=0){
    //
    // 													$this->session->set_flashdata('smessage','Data inserted successfully');
    // 													//echo "saved";
    // 													redirect("Home/cart","refresh");
    //
    // 																	}
    //
    // 																	else
    //
    // 																	{
    // 																		//echo('items left');
    //
    // 															 $this->session->set_flashdata('emessage','Only '.$invent.' items left');
    // 																 redirect($_SERVER['HTTP_REFERER']);
    //
    //
    // 																	}
    // }
    //
    //
    // 					}
    // 				else{
    //
    // 			$this->session->set_flashdata('emessage',validation_errors());
    // 			redirect($_SERVER['HTTP_REFERER']);
    //
    // 				}
    //
    // 				}
    // 			else{
    //
    // 			$this->session->set_flashdata('emessage','Please insert some data, No data available');
    // 			redirect($_SERVER['HTTP_REFERER']);
    //
    // 			}
    // 			}
    // 			else{
    //
    // 			redirect("login/admin_login","refresh");
    //
    //
    // 			}
    //
    // 			}
    public function add_address()
    {
        if (!empty($this->session->userdata('user_id'))) {
            $user_id = $this->session->userdata('user_id');
            $this->db->select('*');
            $this->db->from('tbl_user_address');
            $this->db->where('is_active', 1);
            $this->db->where('user_id', $user_id);
            $data['user_addr_data'] = $this->db->get();
            $this->db->select('*');
            $this->db->from('tbl_country');
            // $this->db->where('is_active', 1);
            $data['country_data'] = $this->db->get();
            // die();
            $this->db->distinct();
            $this->db->select('name');
            $this->db->from('tbl_state');
            $this->db->where('is_active', 1);
            $this->db->limit(20);
            $data['states'] = $this->db->get();
            $this->load->view('common/header', $data);
            $this->load->view('add_address');
            $this->load->view('common/footer');
        } else {
            redirect("Home/register", "refresh");
        }
    }
    public function contact_us()
    {
        $data['contact_data'] = $this->db->get_where('tbl_contact_us_page', array('is_active' => 1))->result();
        $data['title'] =  $data['contact_data'][0]->page_title;
        $data['keyword'] =  $data['contact_data'][0]->keyword;
        $data['dsc'] =  $data['contact_data'][0]->dsc;
        $this->load->view('common/header', $data);
        $this->load->view('contact_us');
        $this->load->view('common/footer');
    }
    public function faq()
    {
        // $data['contact_data'] = $this->db->get_where('tbl_contact_us_page', array('is_active'=> 1))->result();
        $this->db->select('*');
        $this->db->from('tbl_faq_category');
        $this->db->where('is_active', 1);
        $this->db->order_by('sequence', 'asc');
        $data['faq_category_data'] = $this->db->get();
        $this->db->select('*');
        $this->db->from('tbl_faq_category');
        $this->db->where('is_active', 1);
        $this->db->order_by('sequence', 'asc');
        $data['faq_category_data2'] = $this->db->get();
        $this->load->view('common/header', $data);
        $this->load->view('faq');
        $this->load->view('common/footer');
    }
    //add contact process
    public function add_contact_process()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('fname', 'fname', 'required|xss_clean|trim');
            $this->form_validation->set_rules('lname', 'lname', 'required|xss_clean|trim');
            $this->form_validation->set_rules('email', 'email', 'required|xss_clean|valid_email|trim');
            $this->form_validation->set_rules('phone', 'phone', 'xss_clean|trim');
            $this->form_validation->set_rules('offer', 'offer', 'xss_clean|trim');
            $this->form_validation->set_rules('message', 'message', 'xss_clean|trim');
            if ($this->form_validation->run() == TRUE) {
                $fname = $this->input->post('fname');
                $lname = $this->input->post('lname');
                $email = $this->input->post('email');
                $phone = $this->input->post('phone');
                $offer = $this->input->post('offer');
                $message = $this->input->post('message');
                // $user_id=$this->input->post('user_id');
                $ip = $this->input->ip_address();
                date_default_timezone_set("Asia/Calcutta");
                $cur_date = date("Y-m-d H:i:s");
                $recaptchaResponse = trim($this->input->post('g-recaptcha-response'));
                $userIp =  $ip;
                $secret = "6LeGH_QmAAAAAGpZCC1XAVFzo8rNDqgkZs3mKP6x"; //----live
                // $secret = "6LfptFUnAAAAADfFrpsNFyP9W9ms3Wq_jQSUdaHW"; //----localhost
                $url = "https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $recaptchaResponse . "&remoteip=" . $userIp;
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $output = curl_exec($ch);
                curl_close($ch);
                $status = json_decode($output, true);
                if ($status['success']) {
                    // $user_id = $this->session->userdata('usersid');
                    $data_insert = array(
                        'fname' => $fname,
                        'lname' => $lname,
                        'email' => $email,
                        'phone' => $phone,
                        'message' => $message,
                        'ip' => $ip,
                        'date' => $cur_date
                    );
                    $last_id = $this->base_model->insert_table("tbl_contact", $data_insert, 1);
                    if ($last_id != 0) {
                        //---- sent email to user ------
                        $config = array(
                            'protocol' => 'smtp',
                            'smtp_host' => SMTP_HOST,
                            'smtp_port' => SMTP_PORT,
                            'smtp_user' => USER_NAME, // change it to yours
                            'smtp_pass' => PASSWORD, // change it to yours
                            'mailtype' => 'html',
                            'charset' => 'iso-8859-1',
                            'wordwrap' => true
                        );
                        if (!empty($offer)) {
                            $subject = " Thanks for Signing Up!";
                            $message2 = "
                            Dear, " . $fname . ",<br/><br/>
                            Thanks for signing up! We're thrilled to have you on board. Expect exciting offers coming your way soon!<br/><br/>
                            Best regards,<br/>
                            DD Jewellry
                               ";
                        } else {
                            $subject = "Thank You! We'll be in touch soon.";
                            $message2 = "
                            Dear, " . $fname . ",<br/><br/>
                            Thank you for contacting us! We've received your message and will get back to you shortly.<br/><br/>
                            Best regards,<br/>
                            DD Jewellry
                               ";
                        }
                        $this->load->library('email', $config);
                        $this->email->set_newline("");
                        $this->email->from(EMAIL, EMAIL_NAME); // change it to yours
                        $this->email->to($email); // change it to yours
                        $this->email->subject($subject);
                        $this->email->message($message2);
                        if ($this->email->send()) {
                        } else {
                            // show_error($this->email->print_debugger());
                        }
                        //---- sent email to admin ------
                        if (!empty($offer)) {
                            $subject = "New special offers signup received";
                            $message2 = '
                            Hello Admin<br/><br/>
                            You have received new special offers signup and below are the details<br/><br/>
                            <b>First Name</b> - ' . $fname . '<br/>
                            <b>Last Name</b> - ' . $lname . '<br/>
                            <b>Email</b> - ' . $email . '<br/>
                              ';
                        } else {
                            $subject = "New contact query received.";
                            $message2 = '
                            Hello Admin<br/><br/>
                            You have received new contact query and below are the details<br/><br/>
                            <b>First Name</b> - ' . $fname . '<br/>
                            <b>Last Name</b> - ' . $lname . '<br/>
                            <b>Email</b> - ' . $email . '<br/>
                            <b>Phone</b> - ' . $phone . '<br/>
                            <b>Message</b> - ' . $message . '<br/>
                              ';
                        }
                        $this->load->library('email', $config);
                        $this->email->set_newline("");
                        $this->email->from(EMAIL, EMAIL_NAME); // change it to yours
                        $this->email->to('jewelplus@gmail.com'); // change it to yours
                        $this->email->subject($subject);
                        $this->email->message($message2);
                        if ($this->email->send()) {
                        } else {
                            // show_error($this->email->print_debugger());
                        }
                        if (!empty($offer)) {
                            $this->session->set_flashdata('smessage', 'Thankyou for signing up');
                            redirect("Home/signup_special_offers", "refresh");
                        } else {
                            $this->session->set_flashdata('smessage', 'Thankyou for contacting us. We will get back to you.');
                            redirect("Home/contact_us", "refresh");
                        }
                    } else {
                        $this->session->set_flashdata('emessage', 'Sorry error occured');
                        redirect($_SERVER['HTTP_REFERER']);
                    }
                } else {
                    $this->session->set_flashdata('emessage', 'Failed to validate reCAPTCHA.');
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
    }
    public function add_new_address()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('country_id', 'country id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('first_name', 'first name', 'required|xss_clean|trim');
            $this->form_validation->set_rules('last_name', 'last name', 'required|xss_clean|trim');
            $this->form_validation->set_rules('address', 'address', 'required|xss_clean|trim');
            $this->form_validation->set_rules('address2', 'address2', 'xss_clean|trim');
            $this->form_validation->set_rules('city', 'city', 'required|xss_clean|trim');
            $this->form_validation->set_rules('state_id', 'state', 'required|xss_clean|trim');
            $this->form_validation->set_rules('zipcode', 'zipcode', 'required|xss_clean|trim');
            $this->form_validation->set_rules('is_gift', 'is gift', 'xss_clean|trim');
            $this->form_validation->set_rules('notes', 'notes', 'xss_clean|trim');
            if ($this->form_validation->run() == TRUE) {
                $country_id = $this->input->post('country_id');
                $first_name = $this->input->post('first_name');
                $last_name = $this->input->post('last_name');
                $address = $this->input->post('address');
                $address2 = $this->input->post('address2');
                $city = $this->input->post('city');
                $state_id = $this->input->post('state_id');
                $zipcode = $this->input->post('zipcode');
                $is_gift = $this->input->post('is_gift');
                $notes = $this->input->post('notes');
                $user_id = $this->session->userdata('user_id');
                $data_insert = array(
                    'user_id' => $user_id,
                    'country_id' => $country_id,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'address' => $address,
                    'address2' => $address2,
                    'city' => $city,
                    'state_id' => $state_id,
                    'zipcode' => $zipcode,
                    'is_gift' => $is_gift,
                    'notes' => $notes,
                    'is_active' => 1,
                );
                // echo "<pre>";
                // print_r($data_insert);
                // echo "</pre>";
                // exit;
                $last_id = $this->base_model->insert_table("tbl_user_address", $data_insert, 1);
                if ($last_id != 0) {
                    $this->session->set_flashdata('smessage', 'Address added Successfully.');
                    // redirect($_SERVER['HTTP_REFERER']);
                    redirect('Home/add_address');
                } else {
                    $this->session->set_flashdata('emessage', 'Sorry error occured');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            } else {
                print_r(validation_errors());
                die();
                $this->session->set_flashdata('emessage', validation_errors());
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->session->set_flashdata('emessage', 'Please insert some data, No data available');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function ask_question()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            // print_r($this->input->post());
            // exit;
            $this->form_validation->set_rules('name', 'name', 'required|xss_clean|trim');
            $this->form_validation->set_rules('email', 'email', 'required|xss_clean|trim');
            $this->form_validation->set_rules('phone', 'phone', 'xss_clean|trim');
            $this->form_validation->set_rules('query', 'query', 'required|xss_clean|trim');
            if ($this->form_validation->run() == TRUE) {
                $name = $this->input->post('name');
                $email = $this->input->post('email');
                $phone = $this->input->post('phone');
                $query = $this->input->post('query');
                $product_id = $this->input->post('product_id');
                $user_id = $this->session->userdata('user_id');
                $ip = $this->input->ip_address();
                date_default_timezone_set("Asia/Calcutta");
                $cur_date = date("Y-m-d H:i:s");
                $recaptchaResponse = trim($this->input->post('g-recaptcha-response'));
                $userIp = $ip;
                $secret = "6LeGH_QmAAAAAGpZCC1XAVFzo8rNDqgkZs3mKP6x";
                $url = "https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $recaptchaResponse . "&remoteip=" . $userIp;
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $output = curl_exec($ch);
                curl_close($ch);
                $status = json_decode($output, true);
                if ($status['success']) {
                    $data_insert = array(
                        'name' => $name,
                        'email' => $email,
                        'phone' => $phone,
                        'query' => $query,
                        'product_id' => $product_id,
                        'ip' => $ip,
                        'date' => $cur_date,
                    );
                    $last_id = $this->base_model->insert_table("tbl_ask_questions", $data_insert, 1);
                    // }
                    if ($last_id != 0) {
                        $this->session->set_flashdata('smessage', 'Question Submitted Successfully.');
                        redirect($_SERVER['HTTP_REFERER']);
                        // redirect('Home/add_address');
                    } else {
                        $this->session->set_flashdata('emessage', 'Sorry error occured');
                        redirect($_SERVER['HTTP_REFERER']);
                    }
                } else {
                    $this->session->set_flashdata('emessage', 'Failed to validate reCAPTCHA.');
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
    }
    //order place start
    public function  affrim_place_order()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('addresss_id', 'addresss_id', 'xss_clean|trim');
            // $this->form_validation->set_rules('payment_type', 'payment_type', 'xss_clean|trim');
            $this->form_validation->set_rules('applied_promocode', 'applied_promocode', 'xss_clean|trim');
            if ($this->form_validation->run() == TRUE) {
                $payment_type = 2;
                // echo 	$address_id=$this->input->post('addresss_id'); die();
                $address_id = $this->input->post('addresss_id');
                $applied_promocode = $this->input->post('applied_promocode');
                // $page=$this->input->post('page');
                $user_id = $this->session->userdata('user_id');
                $ip = $this->input->ip_address();
                date_default_timezone_set("Asia/Calcutta");
                $cur_date = date("Y-m-d H:i:s");
                $totalAmount = 0;
                $txnid =  substr(hash('sha256', mt_rand() . microtime()), 0, 20);
                $promocode_id = "";
                if (!empty($applied_promocode)) {
                    $this->db->select('*');
                    $this->db->from('tbl_promocode');
                    $this->db->where('promo_code', $applied_promocode);
                    $this->db->where('is_active', 1);
                    $promocode_da = $this->db->get()->row();
                    if (!empty($promocode_da)) {
                        $promocode_id = $promocode_da->id;
                    } else {
                        $promocode_id = "";
                    }
                } else {
                    $promocode_id = "";
                }
                if ($payment_type == 2) {
                    // if($page != 0){
                    // 			$this->db->select('*');
                    // 			$this->db->from('tbl_cart');
                    // 			$this->db->where('user_id',$user_id);
                    // 			$this->db->where('product_id',$page);
                    // 			$cart_da= $this->db->get();
                    // }else {
                    $this->db->select('*');
                    $this->db->from('tbl_cart');
                    $this->db->where('user_id', $user_id);
                    $cart_da = $this->db->get();
                    // }
                    if (!empty($cart_da)) {
                        // echo "f"; echo '<pre>'; print_r($cart_da->result()); die();
                        $i = 1;
                        foreach ($cart_da->result() as $data) {
                            $product_id = $data->product_id;
                            $quantity = $data->quantity;
                            $inventory = 0;
                            $status = "";
                            //get product sku start
                            if (empty($data->stuller_pro_id)) {
                                $this->db->select('*');
                                $this->db->from('tbl_products');
                                $this->db->where('id', $product_id);
                                $this->db->where('is_active', 1);
                                $pro_da = $this->db->get()->row();
                            } else {
                                $this->db->select('*');
                                $this->db->from('tbl_quickshop_products');
                                $this->db->where('product_id', $data->stuller_pro_id);
                                $this->db->where('is_active', 1);
                                $pro_da = $this->db->get()->row();
                            }
                            if (!empty($pro_da)) {
                                $sku = $pro_da->sku;
                            } else {
                                $sku = "";
                                $this->session->set_flashdata('emessage', 'Some error occured.');
                                redirect($_SERVER['HTTP_REFERER']);
                            }
                            //get product sku end
                            //Inventory Check api start
                            $curl = curl_init();
                            curl_setopt_array($curl, array(
                                CURLOPT_URL => 'https://api.stuller.com/v2/products?SKU=' . $sku,
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
                            $response_dec = json_decode($response);
                            // print_r( $response_dec->Products);die();
                            if (!empty($response_dec->Products)) {
                                foreach ($response_dec->Products as $res) {
                                    $inventory = $res->OnHand;
                                    $status = $res->Status;
                                }
                            }
                            // echo $status;
                            // echo $inventory;
                            // die();
                            //Inventory Check api end
                            if (!empty($status) && $status != 'Out Of Stock') {
                                // $db_quantity=$pro_inv_da->inventory;
                                $db_quantity = $inventory;
                                if ($status == 'Made To Order') {
                                    if ($i == 1) {
                                        //tbl order1 entry
                                        $data_insert_order1 = array(
                                            'user_id' => $user_id,
                                            'total_amount' => 0,
                                            'address_id' => $address_id,
                                            'payment_type' => $payment_type,
                                            'payment_status' => 0,
                                            'order_status' => 0,
                                            'delivery_charge' => 0,
                                            'txnid' => $txnid,
                                            'ip' => $ip,
                                            'date' => $cur_date
                                        );
                                        $last_order_id = $this->base_model->insert_table("tbl_order1", $data_insert_order1, 1);
                                    }
                                    if (empty($data->stuller_pro_id)) {
                                        $this->db->select('*');
                                        $this->db->from('tbl_products');
                                        $this->db->where('id', $data->product_id);
                                        $this->db->where('is_active', 1);
                                        $prod_data = $this->db->get()->row();
                                    } else {
                                        $this->db->select('*');
                                        $this->db->from('tbl_quickshop_products');
                                        $this->db->where('product_id', $data->stuller_pro_id);
                                        $this->db->where('is_active', 1);
                                        $prod_data = $this->db->get()->row();
                                    }
                                    if (!empty($prod_data)) {
                                        $selling_price = $prod_data->price;
                                        $product_qty_price = $selling_price * $data->quantity;
                                    } else {
                                        $selling_price = 0;
                                        $product_qty_price = 0;
                                    }
                                    //tbl order2 entry
                                    $data_insert = array(
                                        'product_id' => $data->product_id,
                                        'desc_e_name2' => $data->desc_e_name2,
                                        'desc_e_value2' => $data->desc_e_value2,
                                        'desc_e_name3' => $data->desc_e_name3,
                                        'desc_e_value3' => $data->desc_e_value3,
                                        'desc_e_name4' => $data->desc_e_name4,
                                        'desc_e_value4' => $data->desc_e_value4,
                                        'desc_e_name5' => $data->desc_e_name5,
                                        'desc_e_value5' => $data->desc_e_value5,
                                        'quantity' => $data->quantity,
                                        'amount' => $product_qty_price,
                                        'main_id' => $last_order_id,
                                        'date' => $cur_date
                                    );
                                    $last_id = $this->base_model->insert_table("tbl_order2", $data_insert, 1);
                                    //calculate total cart amount
                                    $totalAmount = $totalAmount + $product_qty_price;
                                    $i++;
                                } else {
                                    if ($db_quantity >= $quantity) {
                                        if ($i == 1) {
                                            //tbl order1 entry
                                            $data_insert_order1 = array(
                                                'user_id' => $user_id,
                                                'total_amount' => 0,
                                                'address_id' => $address_id,
                                                'payment_type' => $payment_type,
                                                'payment_status' => 0,
                                                'order_status' => 0,
                                                'delivery_charge' => 0,
                                                'txnid' => $txnid,
                                                'ip' => $ip,
                                                'date' => $cur_date
                                            );
                                            $last_order_id = $this->base_model->insert_table("tbl_order1", $data_insert_order1, 1);
                                        }
                                        if (empty($data->stuller_pro_id)) {
                                            $this->db->select('*');
                                            $this->db->from('tbl_products');
                                            $this->db->where('id', $data->product_id);
                                            $this->db->where('is_active', 1);
                                            $prod_data = $this->db->get()->row();
                                        } else {
                                            $this->db->select('*');
                                            $this->db->from('tbl_quickshop_products');
                                            $this->db->where('product_id', $data->stuller_pro_id);
                                            $this->db->where('is_active', 1);
                                            $prod_data = $this->db->get()->row();
                                        }
                                        if (!empty($prod_data)) {
                                            $selling_price = $prod_data->price;
                                            $product_qty_price = $selling_price * $data->quantity;
                                        } else {
                                            $selling_price = 0;
                                            $product_qty_price = 0;
                                        }
                                        //tbl order2 entry
                                        $data_insert = array(
                                            'product_id' => $data->product_id,
                                            'desc_e_name2' => $data->desc_e_name2,
                                            'desc_e_value2' => $data->desc_e_value2,
                                            'desc_e_name3' => $data->desc_e_name3,
                                            'desc_e_value3' => $data->desc_e_value3,
                                            'desc_e_name4' => $data->desc_e_name4,
                                            'desc_e_value4' => $data->desc_e_value4,
                                            'desc_e_name5' => $data->desc_e_name5,
                                            'desc_e_value5' => $data->desc_e_value5,
                                            'ringsize' => $data->ringsize,
                                            'ringprice' => $data->ringprice,
                                            'quantity' => $data->quantity,
                                            'amount' => $product_qty_price,
                                            'main_id' => $last_order_id,
                                            'date' => $cur_date
                                        );
                                        $last_id = $this->base_model->insert_table("tbl_order2", $data_insert, 1);
                                        //calculate total cart amount
                                        $totalAmount = $totalAmount + $product_qty_price;
                                        $i++;
                                    } else {
                                        if (empty($data->stuller_pro_id)) {
                                            $this->db->select('*');
                                            $this->db->from('tbl_products');
                                            $this->db->where('id', $data->product_id);
                                            $this->db->where('is_active', 1);
                                            $prodata = $this->db->get()->row();
                                        } else {
                                            $this->db->select('*');
                                            $this->db->from('tbl_quickshop_products');
                                            $this->db->where('product_id', $data->stuller_pro_id);
                                            $this->db->where('is_active', 1);
                                            $prodata = $this->db->get()->row();
                                        }
                                        if (!empty($prodata)) {
                                            $product_name = $prodata->description;
                                        } else {
                                            $product_name = "";
                                        }
                                        $this->session->set_flashdata('emessage', 'This product ' . $product_name . ' is out of stock.Please remove this product before order place.');
                                        redirect($_SERVER['HTTP_REFERER']);
                                    }
                                }
                            } else {
                                if (empty($data->stuller_pro_id)) {
                                    $this->db->select('*');
                                    $this->db->from('tbl_products');
                                    $this->db->where('id', $data->product_id);
                                    $this->db->where('is_active', 1);
                                    $prodata = $this->db->get()->row();
                                } else {
                                    $this->db->select('*');
                                    $this->db->from('tbl_quickshop_products');
                                    $this->db->where('product_id', $data->stuller_pro_id);
                                    $this->db->where('is_active', 1);
                                    $prodata = $this->db->get()->row();
                                }
                                if (!empty($prodata)) {
                                    $product_name = $prodata->description;
                                } else {
                                    $product_name = "";
                                }
                                $this->session->set_flashdata('emessage', 'This product ' . $product_name . ' is out of stock.Please remove this product before order place.');
                                redirect($_SERVER['HTTP_REFERER']);
                            }
                        }
                    }
                    if ($last_order_id != 0) {
                        if (!empty($applied_promocode)) {
                            $totalAmount = $this->isValidPromocode($last_order_id, $totalAmount, $applied_promocode);
                        }
                        //update order details full information of order
                        $data_update_ordr = array(
                            'total_amount' => $totalAmount,
                            'payment_status' => 0,
                            'order_status' => 0,
                            'promocode' => $promocode_id,
                        );
                        $this->db->where('id', $last_order_id);
                        $order = $this->db->update('tbl_order1', $data_update_ordr);
                        $address_data = $this->db->get_where('tbl_user_address', array('id' => $address_id))->result();
                        $user_data = $this->db->get_where('tbl_users', array('id' => $user_id))->result();
                        $amu = base64_encode($totalAmount);
                        $idd = base64_encode($last_order_id);
                        $addr_id = base64_encode($address_id);
                        $id = base64_decode($idd);
                        $amu = base64_decode($amu);
                        $this->session->unset_userdata("data");
                        $this->session->unset_userdata("order_id");
                        $this->session->unset_userdata("amn");
                        // $this->session->unset_userdata("return_url");
                        // $this->session->unset_userdata("surl");
                        // $this->session->unset_userdata("furl");
                        $this->session->unset_userdata("currency_code");
                        $this->session->unset_userdata("address_data");
                        $this->session->unset_userdata("user_data");
                        $this->session->set_flashdata('data', 1);
                        $this->session->set_flashdata('order_id', $id);
                        $this->session->set_flashdata('amn', $amu);
                        // $this->session->set_flashdata('return_url', site_url() . 'Home/callback/' . $idd);
                        // $this->session->set_flashdata('surl', site_url() . 'Home/order_success');
                        // $this->session->set_flashdata('furl', site_url() . 'Home/order_failed');
                        $this->session->set_flashdata('currency_code', 'USD');
                        $this->session->set_flashdata('address_data', $address_data);
                        $this->session->set_flashdata('user_data', $user_data);
                        // redirect("Home/checkout_af?addr=" . $addr_id, "refresh");
                        $this->load->view('affirm_confirm');
                    } else {
                        $this->session->set_flashdata('emessage', 'Sorry error occured');
                        redirect($_SERVER['HTTP_REFERER']);
                    }
                }
            } else {
                $this->session->set_flashdata('emessage', validation_errors());
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->session->set_flashdata('emessage', 'Please insert some data, No data available');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function  gpay_place_order()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('addresss_id', 'addresss_id', 'xss_clean|trim');
            // $this->form_validation->set_rules('payment_type', 'payment_type', 'xss_clean|trim');
            $this->form_validation->set_rules('applied_promocode', 'applied_promocode', 'xss_clean|trim');
            if ($this->form_validation->run() == TRUE) {
                $payment_type = 2;
                // echo 	$address_id=$this->input->post('addresss_id'); die();
                $address_id = $this->input->post('addresss_id');
                $applied_promocode = $this->input->post('applied_promocode');
                // $page=$this->input->post('page');
                $user_id = $this->session->userdata('user_id');
                $ip = $this->input->ip_address();
                date_default_timezone_set("Asia/Calcutta");
                $cur_date = date("Y-m-d H:i:s");
                $totalAmount = 0;
                $txnid =  substr(hash('sha256', mt_rand() . microtime()), 0, 20);
                $promocode_id = "";
                if (!empty($applied_promocode)) {
                    $this->db->select('*');
                    $this->db->from('tbl_promocode');
                    $this->db->where('promo_code', $applied_promocode);
                    $this->db->where('is_active', 1);
                    $promocode_da = $this->db->get()->row();
                    if (!empty($promocode_da)) {
                        $promocode_id = $promocode_da->id;
                    } else {
                        $promocode_id = "";
                    }
                } else {
                    $promocode_id = "";
                }
                if ($payment_type == 2) {
                    // if($page != 0){
                    // 			$this->db->select('*');
                    // 			$this->db->from('tbl_cart');
                    // 			$this->db->where('user_id',$user_id);
                    // 			$this->db->where('product_id',$page);
                    // 			$cart_da= $this->db->get();
                    // }else {
                    $this->db->select('*');
                    $this->db->from('tbl_cart');
                    $this->db->where('user_id', $user_id);
                    $cart_da = $this->db->get();
                    // }
                    if (!empty($cart_da)) {
                        // echo "f"; echo '<pre>'; print_r($cart_da->result()); die();
                        $i = 1;
                        foreach ($cart_da->result() as $data) {
                            $product_id = $data->product_id;
                            $quantity = $data->quantity;
                            $inventory = 0;
                            $status = "";
                            //get product sku start
                            if (empty($data->stuller_pro_id)) {
                                $this->db->select('*');
                                $this->db->from('tbl_products');
                                $this->db->where('id', $product_id);
                                $this->db->where('is_active', 1);
                                $pro_da = $this->db->get()->row();
                            } else {
                                $this->db->select('*');
                                $this->db->from('tbl_quickshop_products');
                                $this->db->where('product_id', $data->stuller_pro_id);
                                $this->db->where('is_active', 1);
                                $pro_da = $this->db->get()->row();
                            }
                            if (!empty($pro_da)) {
                                $sku = $pro_da->sku;
                            } else {
                                $sku = "";
                                $this->session->set_flashdata('emessage', 'Some error occured.');
                                redirect($_SERVER['HTTP_REFERER']);
                            }
                            //get product sku end
                            //Inventory Check api start
                            $curl = curl_init();
                            curl_setopt_array($curl, array(
                                CURLOPT_URL => 'https://api.stuller.com/v2/products?SKU=' . $sku,
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
                            $response_dec = json_decode($response);
                            // print_r( $response_dec->Products);die();
                            if (!empty($response_dec->Products)) {
                                foreach ($response_dec->Products as $res) {
                                    $inventory = $res->OnHand;
                                    $status = $res->Status;
                                }
                            }
                            // echo $status;
                            // echo $inventory;
                            // die();
                            //Inventory Check api end
                            if (!empty($status) && $status != 'Out Of Stock') {
                                // $db_quantity=$pro_inv_da->inventory;
                                $db_quantity = $inventory;
                                if ($status == 'Made To Order') {
                                    if ($i == 1) {
                                        //tbl order1 entry
                                        $data_insert_order1 = array(
                                            'user_id' => $user_id,
                                            'total_amount' => 0,
                                            'address_id' => $address_id,
                                            'payment_type' => $payment_type,
                                            'payment_status' => 0,
                                            'order_status' => 0,
                                            'delivery_charge' => 0,
                                            'txnid' => $txnid,
                                            'ip' => $ip,
                                            'date' => $cur_date
                                        );
                                        $last_order_id = $this->base_model->insert_table("tbl_order1", $data_insert_order1, 1);
                                    }
                                    if (empty($data->stuller_pro_id)) {
                                        $this->db->select('*');
                                        $this->db->from('tbl_products');
                                        $this->db->where('id', $data->product_id);
                                        $this->db->where('is_active', 1);
                                        $prod_data = $this->db->get()->row();
                                    } else {
                                        $this->db->select('*');
                                        $this->db->from('tbl_quickshop_products');
                                        $this->db->where('product_id', $data->stuller_pro_id);
                                        $this->db->where('is_active', 1);
                                        $prod_data = $this->db->get()->row();
                                    }
                                    if (!empty($prod_data)) {
                                        $selling_price = $prod_data->price;
                                        $product_qty_price = $selling_price * $data->quantity;
                                    } else {
                                        $selling_price = 0;
                                        $product_qty_price = 0;
                                    }
                                    //tbl order2 entry
                                    $data_insert = array(
                                        'product_id' => $data->product_id,
                                        'desc_e_name2' => $data->desc_e_name2,
                                        'desc_e_value2' => $data->desc_e_value2,
                                        'desc_e_name3' => $data->desc_e_name3,
                                        'desc_e_value3' => $data->desc_e_value3,
                                        'desc_e_name4' => $data->desc_e_name4,
                                        'desc_e_value4' => $data->desc_e_value4,
                                        'desc_e_name5' => $data->desc_e_name5,
                                        'desc_e_value5' => $data->desc_e_value5,
                                        'quantity' => $data->quantity,
                                        'amount' => $product_qty_price,
                                        'main_id' => $last_order_id,
                                        'date' => $cur_date
                                    );
                                    $last_id = $this->base_model->insert_table("tbl_order2", $data_insert, 1);
                                    //calculate total cart amount
                                    $totalAmount = $totalAmount + $product_qty_price;
                                    $i++;
                                } else {
                                    if ($db_quantity >= $quantity) {
                                        if ($i == 1) {
                                            //tbl order1 entry
                                            $data_insert_order1 = array(
                                                'user_id' => $user_id,
                                                'total_amount' => 0,
                                                'address_id' => $address_id,
                                                'payment_type' => $payment_type,
                                                'payment_status' => 0,
                                                'order_status' => 0,
                                                'delivery_charge' => 0,
                                                'txnid' => $txnid,
                                                'ip' => $ip,
                                                'date' => $cur_date
                                            );
                                            $last_order_id = $this->base_model->insert_table("tbl_order1", $data_insert_order1, 1);
                                        }
                                        if (empty($data->stuller_pro_id)) {
                                            $this->db->select('*');
                                            $this->db->from('tbl_products');
                                            $this->db->where('id', $data->product_id);
                                            $this->db->where('is_active', 1);
                                            $prod_data = $this->db->get()->row();
                                        } else {
                                            $this->db->select('*');
                                            $this->db->from('tbl_quickshop_products');
                                            $this->db->where('product_id', $data->stuller_pro_id);
                                            $this->db->where('is_active', 1);
                                            $prod_data = $this->db->get()->row();
                                        }
                                        if (!empty($prod_data)) {
                                            $selling_price = $prod_data->price;
                                            $product_qty_price = $selling_price * $data->quantity;
                                        } else {
                                            $selling_price = 0;
                                            $product_qty_price = 0;
                                        }
                                        //tbl order2 entry
                                        $data_insert = array(
                                            'product_id' => $data->product_id,
                                            'desc_e_name2' => $data->desc_e_name2,
                                            'desc_e_value2' => $data->desc_e_value2,
                                            'desc_e_name3' => $data->desc_e_name3,
                                            'desc_e_value3' => $data->desc_e_value3,
                                            'desc_e_name4' => $data->desc_e_name4,
                                            'desc_e_value4' => $data->desc_e_value4,
                                            'desc_e_name5' => $data->desc_e_name5,
                                            'desc_e_value5' => $data->desc_e_value5,
                                            'ringsize' => $data->ringsize,
                                            'ringprice' => $data->ringprice,
                                            'quantity' => $data->quantity,
                                            'amount' => $product_qty_price,
                                            'main_id' => $last_order_id,
                                            'date' => $cur_date
                                        );
                                        $last_id = $this->base_model->insert_table("tbl_order2", $data_insert, 1);
                                        //calculate total cart amount
                                        $totalAmount = $totalAmount + $product_qty_price;
                                        $i++;
                                    } else {
                                        if (empty($data->stuller_pro_id)) {
                                            $this->db->select('*');
                                            $this->db->from('tbl_products');
                                            $this->db->where('id', $data->product_id);
                                            $this->db->where('is_active', 1);
                                            $prodata = $this->db->get()->row();
                                        } else {
                                            $this->db->select('*');
                                            $this->db->from('tbl_quickshop_products');
                                            $this->db->where('product_id', $data->stuller_pro_id);
                                            $this->db->where('is_active', 1);
                                            $prodata = $this->db->get()->row();
                                        }
                                        if (!empty($prodata)) {
                                            $product_name = $prodata->description;
                                        } else {
                                            $product_name = "";
                                        }
                                        $this->session->set_flashdata('emessage', 'This product ' . $product_name . ' is out of stock.Please remove this product before order place.');
                                        redirect($_SERVER['HTTP_REFERER']);
                                    }
                                }
                            } else {
                                if (empty($data->stuller_pro_id)) {
                                    $this->db->select('*');
                                    $this->db->from('tbl_products');
                                    $this->db->where('id', $data->product_id);
                                    $this->db->where('is_active', 1);
                                    $prodata = $this->db->get()->row();
                                } else {
                                    $this->db->select('*');
                                    $this->db->from('tbl_quickshop_products');
                                    $this->db->where('product_id', $data->stuller_pro_id);
                                    $this->db->where('is_active', 1);
                                    $prodata = $this->db->get()->row();
                                }
                                if (!empty($prodata)) {
                                    $product_name = $prodata->description;
                                } else {
                                    $product_name = "";
                                }
                                $this->session->set_flashdata('emessage', 'This product ' . $product_name . ' is out of stock.Please remove this product before order place.');
                                redirect($_SERVER['HTTP_REFERER']);
                            }
                        }
                    }
                    if ($last_order_id != 0) {
                        if (!empty($applied_promocode)) {
                            $totalAmount = $this->isValidPromocode($last_order_id, $totalAmount, $applied_promocode);
                        }
                        //update order details full information of order
                        $data_update_ordr = array(
                            'total_amount' => $totalAmount,
                            'payment_status' => 0,
                            'order_status' => 0,
                            'promocode' => $promocode_id,
                        );
                        $this->db->where('id', $last_order_id);
                        $order = $this->db->update('tbl_order1', $data_update_ordr);
                        $address_data = $this->db->get_where('tbl_user_address', array('id' => $address_id))->result();
                        $user_data = $this->db->get_where('tbl_users', array('id' => $user_id))->result();
                        $amu = base64_encode($totalAmount);
                        $idd = base64_encode($last_order_id);
                        $addr_id = base64_encode($address_id);
                        $id = base64_decode($idd);
                        $amu = base64_decode($amu);
                        $this->session->unset_userdata("data");
                        $this->session->unset_userdata("order_id");
                        $this->session->unset_userdata("amn");
                        // $this->session->unset_userdata("return_url");
                        // $this->session->unset_userdata("surl");
                        // $this->session->unset_userdata("furl");
                        $this->session->unset_userdata("currency_code");
                        $this->session->unset_userdata("address_data");
                        $this->session->unset_userdata("user_data");
                        $this->session->set_flashdata('data', 1);
                        $this->session->set_flashdata('order_id', $id);
                        $this->session->set_flashdata('amn', $amu);
                        // $this->session->set_flashdata('return_url', site_url() . 'Home/callback/' . $idd);
                        // $this->session->set_flashdata('surl', site_url() . 'Home/order_success');
                        // $this->session->set_flashdata('furl', site_url() . 'Home/order_failed');
                        $this->session->set_flashdata('currency_code', 'USD');
                        $this->session->set_flashdata('address_data', $address_data);
                        $this->session->set_flashdata('user_data', $user_data);
                        // redirect("Home/checkout_af?addr=" . $addr_id, "refresh");
                        $this->load->view('gpay_confirm');
                    } else {
                        $this->session->set_flashdata('emessage', 'Sorry error occured');
                        redirect($_SERVER['HTTP_REFERER']);
                    }
                }
            } else {
                $this->session->set_flashdata('emessage', validation_errors());
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->session->set_flashdata('emessage', 'Please insert some data, No data available');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function place_order()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('addresss_id', 'addresss_id', 'xss_clean|trim');
            // $this->form_validation->set_rules('payment_type', 'payment_type', 'xss_clean|trim');
            $this->form_validation->set_rules('applied_promocode', 'applied_promocode', 'xss_clean|trim');
            if ($this->form_validation->run() == TRUE) {
                $payment_type = 2;
                // echo 	$address_id=$this->input->post('addresss_id'); die();
                $address_id = $this->input->post('addresss_id');
                $applied_promocode = $this->input->post('applied_promocode');
                // $page=$this->input->post('page');
                $user_id = $this->session->userdata('user_id');
                $ip = $this->input->ip_address();
                date_default_timezone_set("Asia/Calcutta");
                $cur_date = date("Y-m-d H:i:s");
                $totalAmount = 0;
                $txnid =  substr(hash('sha256', mt_rand() . microtime()), 0, 20);
                $promocode_id = "";
                if (!empty($applied_promocode)) {
                    $this->db->select('*');
                    $this->db->from('tbl_promocode');
                    $this->db->where('promo_code', $applied_promocode);
                    $this->db->where('is_active', 1);
                    $promocode_da = $this->db->get()->row();
                    if (!empty($promocode_da)) {
                        $promocode_id = $promocode_da->id;
                    } else {
                        $promocode_id = "";
                    }
                } else {
                    $promocode_id = "";
                }
                if ($payment_type == 2) {
                    // if($page != 0){
                    // 			$this->db->select('*');
                    // 			$this->db->from('tbl_cart');
                    // 			$this->db->where('user_id',$user_id);
                    // 			$this->db->where('product_id',$page);
                    // 			$cart_da= $this->db->get();
                    // }else {
                    $this->db->select('*');
                    $this->db->from('tbl_cart');
                    $this->db->where('user_id', $user_id);
                    $cart_da = $this->db->get();
                    // }
                    if (!empty($cart_da)) {
                        // echo "f"; echo '<pre>'; print_r($cart_da->result()); die();
                        $i = 1;
                        foreach ($cart_da->result() as $data) {
                            $product_id = $data->product_id;
                            $quantity = $data->quantity;
                            $inventory = 0;
                            $status = "";
                            //get product sku start
                            if (empty($data->stuller_pro_id)) {
                                $this->db->select('*');
                                $this->db->from('tbl_products');
                                $this->db->where('id', $product_id);
                                $this->db->where('is_active', 1);
                                $pro_da = $this->db->get()->row();
                            } else {
                                $this->db->select('*');
                                $this->db->from('tbl_quickshop_products');
                                $this->db->where('product_id', $data->stuller_pro_id);
                                $this->db->where('is_active', 1);
                                $pro_da = $this->db->get()->row();
                            }
                            if (!empty($pro_da)) {
                                $sku = $pro_da->sku;
                            } else {
                                $sku = "";
                                $this->session->set_flashdata('emessage', 'Some error occured.');
                                redirect($_SERVER['HTTP_REFERER']);
                            }
                            //get product sku end
                            //Inventory Check api start
                            $curl = curl_init();
                            curl_setopt_array($curl, array(
                                CURLOPT_URL => 'https://api.stuller.com/v2/products?SKU=' . $sku,
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
                            $response_dec = json_decode($response);
                            // print_r( $response_dec->Products);die();
                            if (!empty($response_dec->Products)) {
                                foreach ($response_dec->Products as $res) {
                                    $inventory = $res->OnHand;
                                    $status = $res->Status;
                                }
                            }
                            // echo $status;
                            // echo $inventory;
                            // die();
                            //Inventory Check api end
                            if (!empty($status) && $status != 'Out Of Stock') {
                                // $db_quantity=$pro_inv_da->inventory;
                                $db_quantity = $inventory;
                                if ($status == 'Made To Order') {
                                    if ($i == 1) {
                                        //tbl order1 entry
                                        $data_insert_order1 = array(
                                            'user_id' => $user_id,
                                            'total_amount' => 0,
                                            'address_id' => $address_id,
                                            'payment_type' => $payment_type,
                                            'payment_status' => 0,
                                            'order_status' => 0,
                                            'delivery_charge' => 0,
                                            'txnid' => $txnid,
                                            'ip' => $ip,
                                            'date' => $cur_date
                                        );
                                        $last_order_id = $this->base_model->insert_table("tbl_order1", $data_insert_order1, 1);
                                    }
                                    if (empty($data->stuller_pro_id)) {
                                        $this->db->select('*');
                                        $this->db->from('tbl_products');
                                        $this->db->where('id', $data->product_id);
                                        $this->db->where('is_active', 1);
                                        $prod_data = $this->db->get()->row();
                                    } else {
                                        $this->db->select('*');
                                        $this->db->from('tbl_quickshop_products');
                                        $this->db->where('product_id', $data->stuller_pro_id);
                                        $this->db->where('is_active', 1);
                                        $prod_data = $this->db->get()->row();
                                    }
                                    if (!empty($prod_data)) {
                                        $selling_price = $prod_data->price;
                                        $product_qty_price = $selling_price * $data->quantity;
                                    } else {
                                        $selling_price = 0;
                                        $product_qty_price = 0;
                                    }
                                    //tbl order2 entry
                                    $data_insert = array(
                                        'product_id' => $data->product_id,
                                        'desc_e_name2' => $data->desc_e_name2,
                                        'desc_e_value2' => $data->desc_e_value2,
                                        'desc_e_name3' => $data->desc_e_name3,
                                        'desc_e_value3' => $data->desc_e_value3,
                                        'desc_e_name4' => $data->desc_e_name4,
                                        'desc_e_value4' => $data->desc_e_value4,
                                        'desc_e_name5' => $data->desc_e_name5,
                                        'desc_e_value5' => $data->desc_e_value5,
                                        'quantity' => $data->quantity,
                                        'amount' => $product_qty_price,
                                        'main_id' => $last_order_id,
                                        'date' => $cur_date
                                    );
                                    $last_id = $this->base_model->insert_table("tbl_order2", $data_insert, 1);
                                    //calculate total cart amount
                                    $totalAmount = $totalAmount + $product_qty_price;
                                    $i++;
                                } else {
                                    if ($db_quantity >= $quantity) {
                                        if ($i == 1) {
                                            //tbl order1 entry
                                            $data_insert_order1 = array(
                                                'user_id' => $user_id,
                                                'total_amount' => 0,
                                                'address_id' => $address_id,
                                                'payment_type' => $payment_type,
                                                'payment_status' => 0,
                                                'order_status' => 0,
                                                'delivery_charge' => 0,
                                                'txnid' => $txnid,
                                                'ip' => $ip,
                                                'date' => $cur_date
                                            );
                                            $last_order_id = $this->base_model->insert_table("tbl_order1", $data_insert_order1, 1);
                                        }
                                        if (empty($data->stuller_pro_id)) {
                                            $this->db->select('*');
                                            $this->db->from('tbl_products');
                                            $this->db->where('id', $data->product_id);
                                            $this->db->where('is_active', 1);
                                            $prod_data = $this->db->get()->row();
                                        } else {
                                            $this->db->select('*');
                                            $this->db->from('tbl_quickshop_products');
                                            $this->db->where('product_id', $data->stuller_pro_id);
                                            $this->db->where('is_active', 1);
                                            $prod_data = $this->db->get()->row();
                                        }
                                        if (!empty($prod_data)) {
                                            $selling_price = $prod_data->price;
                                            $product_qty_price = $selling_price * $data->quantity;
                                        } else {
                                            $selling_price = 0;
                                            $product_qty_price = 0;
                                        }
                                        //tbl order2 entry
                                        $data_insert = array(
                                            'product_id' => $data->product_id,
                                            'desc_e_name2' => $data->desc_e_name2,
                                            'desc_e_value2' => $data->desc_e_value2,
                                            'desc_e_name3' => $data->desc_e_name3,
                                            'desc_e_value3' => $data->desc_e_value3,
                                            'desc_e_name4' => $data->desc_e_name4,
                                            'desc_e_value4' => $data->desc_e_value4,
                                            'desc_e_name5' => $data->desc_e_name5,
                                            'desc_e_value5' => $data->desc_e_value5,
                                            'ringsize' => $data->ringsize,
                                            'ringprice' => $data->ringprice,
                                            'quantity' => $data->quantity,
                                            'amount' => $product_qty_price,
                                            'main_id' => $last_order_id,
                                            'date' => $cur_date
                                        );
                                        $last_id = $this->base_model->insert_table("tbl_order2", $data_insert, 1);
                                        //calculate total cart amount
                                        $totalAmount = $totalAmount + $product_qty_price;
                                        $i++;
                                    } else {
                                        if (empty($data->stuller_pro_id)) {
                                            $this->db->select('*');
                                            $this->db->from('tbl_products');
                                            $this->db->where('id', $data->product_id);
                                            $this->db->where('is_active', 1);
                                            $prodata = $this->db->get()->row();
                                        } else {
                                            $this->db->select('*');
                                            $this->db->from('tbl_quickshop_products');
                                            $this->db->where('product_id', $data->stuller_pro_id);
                                            $this->db->where('is_active', 1);
                                            $prodata = $this->db->get()->row();
                                        }
                                        if (!empty($prodata)) {
                                            $product_name = $prodata->description;
                                        } else {
                                            $product_name = "";
                                        }
                                        $this->session->set_flashdata('emessage', 'This product ' . $product_name . ' is out of stock.Please remove this product before order place.');
                                        redirect($_SERVER['HTTP_REFERER']);
                                    }
                                }
                            } else {
                                if (empty($data->stuller_pro_id)) {
                                    $this->db->select('*');
                                    $this->db->from('tbl_products');
                                    $this->db->where('id', $data->product_id);
                                    $this->db->where('is_active', 1);
                                    $prodata = $this->db->get()->row();
                                } else {
                                    $this->db->select('*');
                                    $this->db->from('tbl_quickshop_products');
                                    $this->db->where('product_id', $data->stuller_pro_id);
                                    $this->db->where('is_active', 1);
                                    $prodata = $this->db->get()->row();
                                }
                                if (!empty($prodata)) {
                                    $product_name = $prodata->description;
                                } else {
                                    $product_name = "";
                                }
                                $this->session->set_flashdata('emessage', 'This product ' . $product_name . ' is out of stock.Please remove this product before order place.');
                                redirect($_SERVER['HTTP_REFERER']);
                            }
                        }
                    }
                    if ($last_order_id != 0) {
                        if (!empty($applied_promocode)) {
                            $totalAmount = $this->isValidPromocode($last_order_id, $totalAmount, $applied_promocode);
                        }
                        //update order details full information of order
                        $data_update_ordr = array(
                            'total_amount' => $totalAmount,
                            'payment_status' => 0,
                            'order_status' => 0,
                            'promocode' => $promocode_id,
                        );
                        $this->db->where('id', $last_order_id);
                        $order = $this->db->update('tbl_order1', $data_update_ordr);
                        //delete Tbl Cart data of user
                        // if($page != 0){
                        // 			$this->db->select('*');
                        // 			$this->db->from('tbl_cart');
                        // 			$this->db->where('user_id',$user_id);
                        // 			$this->db->where('product_id',$page);
                        // 			$cart_dat= $this->db->get();
                        // }else {
                        // $this->db->select('*');
                        // 			$this->db->from('tbl_cart');
                        // 			$this->db->where('user_id',$user_id);
                        // 			$cart_dat= $this->db->get();
                        // // }
                        //
                        //
                        // if(!empty($cart_dat)){
                        // foreach ($cart_dat->result() as $cart) {
                        //
                        // $del_cart=$this->db->delete('tbl_cart', array('id' => $cart->id));
                        //
                        // }
                        // }
                        //send email to user's email start
                        //
                        // $config = Array(
                        // 							'protocol' => 'smtp',
                        // 							// 'smtp_host' => 'mail.fineoutput.co.in',
                        // 							'smtp_host' => SMTP_HOST,
                        // 							'smtp_port' => 26,
                        // 							// 'smtp_user' => 'info@fineoutput.co.in', // change it to yours
                        // 							// 'smtp_pass' => 'info@fineoutput2019', // change it to yours
                        // 							'smtp_user' => USER_NAME, // change it to yours
                        // 							'smtp_pass' => PASSWORD, // change it to yours
                        // 							'mailtype' => 'html',
                        // 							'charset' => 'iso-8859-1',
                        // 							'wordwrap' => TRUE
                        // 							);
                        //
                        // 							$this->db->select('*');
                        // 										$this->db->from('tbl_users');
                        // 										$this->db->where('id',$user_id);
                        // 										$user_data= $this->db->get()->row();
                        // 					$email = '';
                        // 										if(!empty($user_data)){
                        // 											$email =  $user_data->email;
                        // 										}
                        //
                        // 							$to=$email;
                        //
                        // 							$email_data = array("order1_id"=>$last_order_id, "type"=>"1"
                        // 							);
                        //
                        // 							$message = 	$this->load->view('emails/order-success',$email_data,TRUE);
                        // 							// $message = 	"HELLO";
                        // 							$this->load->library('email', $config);
                        // 							$this->email->set_newline("");
                        // 							// $this->email->from('info@fineoutput.co.in'); // change it to yours
                        // 							$this->email->from(EMAIL); // change it to yours
                        // 							$this->email->to($to);// change it to yours
                        // 							$this->email->subject('Order Placed Successfully');
                        // 							$this->email->message($message);
                        // 							if($this->email->send()){
                        // 							//  echo 'Email sent.';
                        // 							}else{
                        // 							// show_error($this->email->print_debugger());
                        // 							}
                        //send email to user's email end
                        // $this->session->set_flashdata('smessage','Register successfully');
                        // redirect("Home/order_success","refresh");
                        $amu = base64_encode($totalAmount);
                        $idd = base64_encode($last_order_id);
                        $addr_id = base64_encode($address_id);
                        // redirect("Home/charge/".$amu."/".$idd,"refresh");
                        $id = base64_decode($idd);
                        $amu = base64_decode($amu);
                        // $data['title'] = 'Checkout payment | TechArise';
                        // // $this->site->setProductID($id);
                        // $data['order_id'] =  $id;
                        // $data['amn'] =  $amu;
                        // $data['return_url'] = site_url().'Home/callback/'.$idd;
                        // $data['surl'] = site_url().'Home/order_success';
                        // $data['furl'] = site_url().'Home/order_failed';
                        // $data['currency_code'] = 'USD';
                        // $this->load->view('paypal/checkout', $data);
                        // 	 $this->load->view('common/header',$data);
                        // 	 $this->load->view('confirmation');
                        // 	 $this->load->view('common/footer');
                        $this->session->unset_userdata("data");
                        $this->session->unset_userdata("order_id");
                        $this->session->unset_userdata("amn");
                        $this->session->unset_userdata("return_url");
                        $this->session->unset_userdata("surl");
                        $this->session->unset_userdata("furl");
                        $this->session->unset_userdata("currency_code");
                        $this->session->set_flashdata('data', 1);
                        $this->session->set_flashdata('order_id', $id);
                        $this->session->set_flashdata('amn', $amu);
                        $this->session->set_flashdata('return_url', site_url() . 'Home/callback/' . $idd);
                        $this->session->set_flashdata('surl', site_url() . 'Home/order_success');
                        $this->session->set_flashdata('furl', site_url() . 'Home/order_failed');
                        $this->session->set_flashdata('currency_code', 'USD');
                        // $this->session->flashdata('data');
                        // $this->session->flashdata('order_id');
                        // $this->session->flashdata('amn');
                        // $this->session->flashdata('return_url');
                        // $this->session->flashdata('surl');
                        // $this->session->flashdata('furl');
                        // $this->session->flashdata('currency_code');
                        redirect("Home/checkout_af?addr=" . $addr_id, "refresh");
                    } else {
                        $this->session->set_flashdata('emessage', 'Sorry error occured');
                        redirect($_SERVER['HTTP_REFERER']);
                    }
                }
            } else {
                $this->session->set_flashdata('emessage', validation_errors());
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->session->set_flashdata('emessage', 'Please insert some data, No data available');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    //order place end
    public function order_success()
    {
        $data['data'] = "";
        $this->load->view('common/header', $data);
        $this->load->view('order_success');
        $this->load->view('common/footer');
    }
    public function order_failed()
    {
        $data['data'] = "";
        $this->load->view('common/header', $data);
        $this->load->view('order_failed');
        $this->load->view('common/footer');
    }
    public function myorder()
    {
        if (!empty($this->session->userdata('user_id'))) {
            $user_id = $this->session->userdata('user_id');
            $this->db->select('*');
            $this->db->from('tbl_order1');
            $this->db->where('user_id', $user_id);
            // $this->db->where('order_status', '!=',  0);
            $this->db->order_by('id', "desc");
            $data['orders_data'] = $this->db->get();
            $this->load->view('common/header', $data);
            $this->load->view('myorder');
            $this->load->view('common/footer');
        } else {
            redirect("Home/register", "refresh");
        }
    }
    //cancel order by user
    public function cancel_order($idd)
    {
        if (!empty($this->session->userdata('user_id'))) {
            $id = base64_decode($idd);
            $typ = 5;
            date_default_timezone_set("Asia/Calcutta");
            $cur_date = date("Y-m-d H:i:s");
            $user_id = $this->session->userdata('user_id');
            $data_update = array(
                'rejected_by' => 1,
                'rejected_by_id' => $user_id,
                'order_status' => $typ,
                'last_update_date' => $cur_date,
            );
            $this->db->where('id', $id);
            $zapak = $this->db->update('tbl_order1', $data_update);
            if ($zapak != 0) {
                $this->session->set_flashdata('smessage', 'Order #' . $id . ' cancelled successfully.');
                redirect("Home/myorder", "refresh");
            } else {
                $this->session->set_flashdata('emessage', 'Sorry error occured');
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            redirect("Home/register", "refresh");
        }
    }
    public function profile()
    {
        if (!empty($this->session->userdata('user_id'))) {
            $this->db->select('*');
            $this->db->from('tbl_users');
            $this->db->where('id', $this->session->userdata('user_id'));
            $data['users'] = $this->db->get()->row();
            $this->load->view('common/header', $data);
            $this->load->view('profile');
            $this->load->view('common/footer');
        } else {
            redirect("Home/register", "refresh");
        }
    }
    public function edit_profile()
    {
        $this->load->view('common/header');
        $this->load->view('edit_profile');
        $this->load->view('common/footer');
    }
    public function add_register_data()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            // print_r($this->input->post());
            // exit;
            $this->form_validation->set_rules('psw', 'psw', 'required|xss_clean|trim');
            $this->form_validation->set_rules('name', 'name', 'required|xss_clean|trim');
            $this->form_validation->set_rules('email', 'email', 'required|xss_clean|valid_email|trim');
            if ($this->form_validation->run() == TRUE) {
                $email = $this->input->post('email');
                $passw = $this->input->post('psw');
                $name = $this->input->post('name');
                // --- check for already exist user ------
                $checkUser = $this->db->get_where('tbl_users', array('email' => $email))->result();
                if (empty($checkUser)) {
                    $pass = md5($passw);
                    $data_insert = array(
                        'email' => $email,
                        'psw' => $pass,
                        'name' => $name
                    );
                    $last_id = $this->base_model->insert_table("tbl_users", $data_insert, 1);
                    $this->session->set_userdata('user_name', $name);
                    $this->session->set_userdata('user_id', $last_id);
                    //$this->session->set_userdata('name',$name);
                    if ($last_id != 0) {
                        $this->session->set_flashdata('smessage', 'Sign Up Success');
                        redirect("Home/index", "refresh");
                    } else {
                        $this->session->set_flashdata('emessage', 'Sorry error occured');
                        redirect($_SERVER['HTTP_REFERER']);
                    }
                } else {
                    $this->session->set_flashdata('emessage', 'Email already exist!');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            } else {
                $this->session->set_flashdata('emessage', validation_errors());
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->session->set_flashdata('emessage', 'No post data');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function login()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('email', 'email', 'required|valid_email|xss_clean|trim');
            $this->form_validation->set_rules('psw', 'psw', 'required|xss_clean|trim');
            if ($this->form_validation->run() == TRUE) {
                $email = $this->input->post('email');
                $passw = $this->input->post('psw');
                $pass = md5($passw);
                $this->db->select('*');
                $this->db->from('tbl_users');
                $this->db->where('email', $email);
                $this->db->where('psw', $pass);
                $da_teacher = $this->db->get();
                $da = $da_teacher->row();
                if (!empty($da)) {
                    $nnn1 = $da->email;
                    $nnn2 = $da->psw;
                    $nnn3 = $da->name;
                    $nnn4 = $da->id;
                    $this->session->set_userdata('user_name', $nnn3);
                    $this->session->set_userdata('user_id', $nnn4);
                    $this->session->set_userdata('user_data', $nnn4);
                    //$this->session->set_userdata('name',$name);
                    redirect("Home/index", "refresh");
                } else {
                    $this->session->set_flashdata('emessage', 'wrong password');
                    // redirect("auth/login","refresh");
                    redirect($_SERVER['HTTP_REFERER']);
                }
            } else {
                //echo $pass;
                $this->session->set_flashdata('emessage', 'Wrong Details Entered');
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->session->set_flashdata('emessage', validation_errors());
            // redirect("auth/login","refresh");
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function logout()
    {
        if (!empty($this->session->userdata('user_name'))) {
            $this->session->sess_destroy();
            redirect("Home/index", "refresh");
        } else {
            echo "Error Loging out";
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
    public function delete_cart($idd)
    {
        if (!empty($this->session->userdata('user_name'))) {
            $id = base64_decode($idd);
            $zapak = $this->db->delete('tbl_cart', array('id' => $id));
            if ($zapak != 0) {
                $this->session->set_flashdata('smessage', 'Item removed successfully');
                redirect("Home/cart", "refresh");
            } else {
                $this->session->set_flashdata('emessage', 'Sorry error occured');
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    public function delete_all_cart()
    {
        if (!empty($this->session->userdata('user_id'))) {
            $cid = $this->session->userdata('user_id');
            // echo $cid;exit;
            $zapak = $this->db->delete('tbl_cart', array('user_id' => $cid));
            if ($zapak != 0) {
                redirect("Home/cart", "refresh");
            } else {
                $this->session->set_flashdata('emessage', 'Sorry error occured');
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    // public function update_quantity($idd){
    //
    // 													if(!empty($this->session->userdata('user_name'))){
    //
    //
    // 														$idw=$idd;
    //
    //
    // 																	 $data_insert = array('quantity'=>$name,
    // 																						 'phone'=>$phone,
    // 																						 'address'=>$address,
    // 																						 'email'=>$email,
    // 																						 'password'=>$pass,
    // 																						 'power'=>$position,
    // 																						 'services'=>$ser
    //
    // 																						 );
    //
    //
    //
    //
    // 																		 $this->db->where('id', $idw);
    // 																		 $last_id=$this->db->update('tbl_', $data_insert);
    //
    // 																	 }
    //
    //
    // 																											 if($last_id!=0){
    //
    // 																											 $this->session->set_flashdata('smessage','Data inserted successfully');
    //
    // 																											 redirect("dcadmin//view_","refresh");
    //
    // 																															 }
    //
    // 																															 else
    //
    // 																															 {
    //
    // 																														$this->session->set_flashdata('emessage','Sorry error occured');
    // 																															redirect($_SERVER['HTTP_REFERER']);
    //
    //
    // 																															 }
    //
    // 												}
    // 												else{
    //
    // 													 redirect("login/admin_login","refresh");
    // 												}
    //
    // 												}
    //
    //footer pages start
    public function about_us()
    {
        $this->db->select('*');
        $this->db->from('tbl_about_us');
        $this->db->where('is_active', 1);
        $data['about_us'] = $this->db->get()->row();
        $data['title'] =  $data['about_us']->page_title;
        $data['keyword'] =  $data['about_us']->keyword;
        $data['dsc'] =  $data['about_us']->dsc;
        $this->load->view('common/header', $data);
        $this->load->view('about_us');
        $this->load->view('common/footer');
    }
    public function email_view()
    {
        $this->load->view('email');
    }
    public function terms_and_conditions()
    {
        $this->db->select('*');
        $this->db->from('tbl_terms_and_conditions');
        $this->db->where('is_active', 1);
        $data['terms_and_conditions'] = $this->db->get()->row();
        $data['title'] =  $data['terms_and_conditions']->page_title;
        $data['keyword'] =  $data['terms_and_conditions']->keyword;
        $data['dsc'] =  $data['terms_and_conditions']->dsc;
        $this->load->view('common/header', $data);
        $this->load->view('terms_and_conditions');
        $this->load->view('common/footer');
    }
    public function return_policy()
    {
        $this->db->select('*');
        $this->db->from('tbl_return_policy');
        $this->db->where('is_active', 1);
        $data['return_policy'] = $this->db->get()->row();
        $data['title'] =  $data['return_policy']->page_title;
        $data['keyword'] =  $data['return_policy']->keyword;
        $data['dsc'] =  $data['return_policy']->dsc;
        $this->load->view('common/header', $data);
        $this->load->view('return_policy');
        $this->load->view('common/footer');
    }
    public function privacy_policy()
    {
        $this->db->select('*');
        $this->db->from('tbl_privacy_policy');
        $this->db->where('is_active', 1);
        $data['privacy_policy'] = $this->db->get()->row();
        $data['title'] =  $data['privacy_policy']->page_title;
        $data['keyword'] =  $data['privacy_policy']->keyword;
        $data['dsc'] =  $data['privacy_policy']->dsc;
        $this->load->view('common/header', $data);
        $this->load->view('privacy_policy');
        $this->load->view('common/footer');
    }
    public function why_us()
    {
        $this->db->select('*');
        $this->db->from('tbl_why_us');
        $this->db->where('is_active', 1);
        $data['why_us_data'] = $this->db->get()->row();
        $data['title'] =  $data['why_us_data']->page_title;
        $data['keyword'] =  $data['why_us_data']->keyword;
        $data['dsc'] =  $data['why_us_data']->dsc;
        $this->load->view('common/header', $data);
        $this->load->view('why_us');
        $this->load->view('common/footer');
    }
    public function flexiblefinancing()
    {
        $this->db->select('*');
        $this->db->from('tbl_flexiblefinancing');
        $this->db->where('is_active', 1);
        $data['flexiblefinancing_data'] = $this->db->get()->row();
        $data['title'] =  $data['flexiblefinancing_data']->page_title;
        $data['keyword'] =  $data['flexiblefinancing_data']->keyword;
        $data['dsc'] =  $data['flexiblefinancing_data']->dsc;
        $this->load->view('common/header', $data);
        $this->load->view('flexiblefinancing');
        $this->load->view('common/footer');
    }
    public function free_shipping()
    {
        $this->db->select('*');
        $this->db->from('tbl_free_shipping');
        $this->db->where('is_active', 1);
        $data['free_shipping_data'] = $this->db->get()->row();
        $data['title'] =  $data['free_shipping_data']->page_title;
        $data['keyword'] =  $data['free_shipping_data']->keyword;
        $data['dsc'] =  $data['free_shipping_data']->dsc;
        $this->load->view('common/header', $data);
        $this->load->view('free_shipping');
        $this->load->view('common/footer');
    }
    public function lifetime_upgrades()
    {
        $this->db->select('*');
        $this->db->from('tbl_lifetime_upgrades');
        $this->db->where('is_active', 1);
        $data['lifetime_upgrades_data'] = $this->db->get()->row();
        $data['title'] =  $data['lifetime_upgrades_data']->page_title;
        $data['keyword'] =  $data['lifetime_upgrades_data']->keyword;
        $data['dsc'] =  $data['lifetime_upgrades_data']->dsc;
        $this->load->view('common/header', $data);
        $this->load->view('lifetime_upgrades');
        $this->load->view('common/footer');
    }
    public function lifetime_warranty()
    {
        $this->db->select('*');
        $this->db->from('tbl_lifetime_warranty');
        $this->db->where('is_active', 1);
        $data['lifetime_warranty_data'] = $this->db->get()->row();
        $data['title'] =  $data['lifetime_warranty_data']->page_title;
        $data['keyword'] =  $data['lifetime_warranty_data']->keyword;
        $data['dsc'] =  $data['lifetime_warranty_data']->dsc;
        $this->load->view('common/header', $data);
        $this->load->view('lifetime_warranty');
        $this->load->view('common/footer');
    }
    public function visit_our_showroom()
    {
        $this->db->select('*');
        $this->db->from('tbl_visit_our_showroom');
        $this->db->where('is_active', 1);
        $data['visit_us'] = $this->db->get()->row();
        $data['title'] =  $data['visit_us']->page_title;
        $data['keyword'] =  $data['visit_us']->keyword;
        $data['dsc'] =  $data['visit_us']->dsc;
        $this->load->view('common/header', $data);
        $this->load->view('visit_our_showroom');
        $this->load->view('common/footer');
    }
    public function visit_showroom()
    {
        $this->load->view('visit_showroom');
    }
    public function services()
    {
        $this->db->select('*');
        $this->db->from('tbl_services');
        $this->db->where('is_active', 1);
        $data['services_data'] = $this->db->get()->row();
        $data['title'] =  $data['services_data']->page_title;
        $data['keyword'] =  $data['services_data']->keyword;
        $data['dsc'] =  $data['services_data']->dsc;
        $this->load->view('common/header', $data);
        $this->load->view('services');
        $this->load->view('common/footer');
    }
    //open iframes start
    public function subcategories($t)
    {
        $t_decode = base64_decode($t);
        $data['t_dec'] = $t_decode;
        $this->load->view('common/header', $data);
        $this->load->view('iframe_subcategory');
        $this->load->view('common/footer');
    }
    public function minor_category($t)
    {
        $t_decode = base64_decode($t);
        $data['t_dec'] = $t_decode;
        $this->load->view('common/header', $data);
        $this->load->view('iframe_minor_category');
        $this->load->view('common/footer');
    }
    //open iframes end
    //open show header signup page start
    public function signup_special_offers()
    {
        $this->load->view('common/header');
        $this->load->view('signup_offer');
        $this->load->view('common/footer');
    }
    //open show header signup page end
    //footer pages end
    //
    //
    //
    // public function cancel_order_data($idd)
    // {
    //
    // if(!empty($this->session->userdata(user_id))){
    //
    // $id= base64_decode($idd);
    // $user_id = $this->session->userdata('user_id');
    //
    // $ip = $this->input->ip_address();
    // date_default_timezone_set("Asia/Calcutta");
    // $cur_date=date("Y-m-d H:i:s");
    //
    // $this->db->select('*');
    // $this->db->from('tbl_order1');
    // $this->db->where('id',$id);
    // $order1_data= $this->db->get()->row();
    //
    // if(!empty($order1_data)){
    //
    // 	$data_update= array(
    // 		'order_status'=> 5,
    // 		'rejected_by'=> "USER",
    // 		'rejected_by_id'=> $user_id,
    // 		'last_update_date'=> $cur_date,
    // 	);
    //
    //
    // $this->db->where('id',$order1_data->id);
    // $this->db->where('id',$order1_data->id);
    // $updated_row= $this->db->update('tbl_order1',$data_update);
    //
    // if($updated_row != 0){
    //
    // }else
    //
    //
    // }
    //
    //
    // }else{
    // 	  redirect("login/admin_login","refresh");
    // }
    //
    //
    // }
    public function price_change()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('pid', 'pid', 'xss_clean|trim');
            $this->form_validation->set_rules('qty', 'qty', 'xss_clean|trim');
            $this->form_validation->set_rules('ringsizeprice', 'ringsizeprice', 'xss_clean|trim');
            if ($this->form_validation->run() == TRUE) {
                $qty = $this->input->post('qty');
                $pid = $this->input->post('pid');
                $ringsizeprice = $this->input->post('ringsizeprice');
                $this->db->select('*');
                $this->db->from('tbl_products');
                $this->db->where('id', $pid);
                $pro_data = $this->db->get()->row();
                if (!empty($pro_data)) {
                    $this->db->select('*');
                    $this->db->from('tbl_price_rule');
                    $pr_data = $this->db->get()->row();
                    $multiplier = $pr_data->multiplier;
                    $cost_price11 = $pr_data->cost_price1;
                    $cost_price22 = $pr_data->cost_price2;
                    $cost_price33 = $pr_data->cost_price3;
                    $cost_price44 = $pr_data->cost_price4;
                    $cost_price55 = $pr_data->cost_price5;
                    if (!empty($pro_data->price)) {
                        $cost_price = $pro_data->price + $ringsizeprice;
                        $cost_price = $cost_price;
                        $retail = $cost_price * $multiplier;
                        $now_price = $cost_price;
                        // echo $now_price;
                        // exit;
                        if ($cost_price <= 500) {
                            $cost_price2 = $cost_price * $cost_price;
                            // $now_price= $cost_price*0.00000264018*($cost_price*2)+(-0.002220133*$cost_price)+1.950022201-1+0.95;
                            $number = round($cost_price * ($cost_price11 * $cost_price2 + $cost_price22 * $cost_price + $cost_price33), 2);
                            $unit = 5;
                            $remainder = $number % $unit;
                            $mround = ($remainder < $unit / 2) ? $number - $remainder : $number + ($unit - $remainder);
                            $now_price = round($mround) - 1 + 0.95;
                            // $now_price = round($mround);
                            // echo $cost_price;
                            // exit;
                        }
                        if ($cost_price > 500) {
                            $number = round($cost_price * ($cost_price44 * $cost_price / $multiplier + $cost_price55));
                            $unit = 5;
                            $remainder = $number % $unit;
                            $mround = ($remainder < $unit / 2) ? $number - $remainder : $number + ($unit - $remainder);
                            $now_price = round($mround) - 1 + 0.95;
                            // $now_price = round($mround);
                            // echo $cost_price;
                        }
                        $retail = $retail * $qty;
                        $now_price = $now_price * $qty;
                        $saved = round($retail - $now_price);
                        $dis_percent = round($saved / $retail * 100);
                        // $respone['retail'] = round($retail, 2);
                        $respone['retail'] = round($retail);
                        $respone['saved'] = $saved;
                        $respone['dis'] = $dis_percent;
                        $respone['price'] = number_format($now_price, 2);
                    }
                    $respone['data'] = true;
                    echo json_encode($respone);
                }
            } else {
                $respone['data'] = false;
                $respone['data_message'] = validation_errors();
                echo json_encode($respone);
            }
        } else {
            $respone['data'] = false;
            $respone['data_message'] = "Please insert some data, No data available";
            echo json_encode($respone);
        }
    }
    public function load_modify_contact($id)
    {
        // echo $id; die();
        $data['id'] = $id;
        $this->db->select('*');
        $this->db->from('tbl_modify_info_content');
        //$this->db->where('id',$usr);
        $data['content_data'] = $this->db->get()->row();
        $this->db->select('*');
        $this->db->from('tbl_products');
        $this->db->where('id', $id);
        $data['product_data'] = $this->db->get()->row();
        // echo $product_data->description;die();
        $this->load->view('common/header', $data);
        $this->load->view('modify_contact');
        $this->load->view('common/footer');
    }
    public function modify_contact($id)
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'name', 'xss_clean|trim');
            $this->form_validation->set_rules('email', 'email', 'required|xss_clean|trim');
            $this->form_validation->set_rules('b_phone', 'b_phone', 'xss_clean|trim');
            $this->form_validation->set_rules('m_phone', 'm_phone', 'xss_clean|trim');
            $this->form_validation->set_rules('acc_no', 'acc_no', 'xss_clean|trim');
            if ($this->form_validation->run() == TRUE) {
                $name = $this->input->post('name');
                $email = $this->input->post('email');
                $b_phone = $this->input->post('b_phone');
                $m_phone = $this->input->post('m_phone');
                $acc_no = $this->input->post('acc_no');
                $ip = $this->input->ip_address();
                date_default_timezone_set("Asia/Calcutta");
                $cur_date = date("Y-m-d H:i:s");
                $addedby = $this->session->userdata('admin_id');
                $data_insert = array(
                    'product_id' => $id,
                    'name' => $name,
                    'email' => $email,
                    'b_phone' => $b_phone,
                    'm_phone' => $m_phone,
                    'acc_no' => $acc_no,
                    'ip' => $ip,
                    'added_by' => $addedby,
                    'is_active' => 1,
                    'date' => $cur_date
                );
                $last_id = $this->base_model->insert_table("tbl_modify_contact", $data_insert, 1);
                if ($last_id == 0) {
                    $this->session->set_flashdata('emessage', 'Some error occured');
                    redirect($_SERVER['HTTP_REFERER']);
                } else {
                    $this->session->set_flashdata('smessage', 'Your request was submitted successfully');
                    redirect('Home/product_detail/' . $id);
                }
            } else {
                $this->session->set_flashdata('emessage', validation_errors());
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $respone['data'] = false;
            $respone['data_message'] = "Please insert some data, No data available";
            echo json_encode($respone);
        }
    }
    public function share_with()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('link', 'link', 'required|xss_clean|trim');
            $this->form_validation->set_rules('from_email', 'from_email', 'required|xss_clean|trim');
            $this->form_validation->set_rules('to_email', 'to_email', 'required|xss_clean|trim');
            $this->form_validation->set_rules('name', 'name', 'required|xss_clean|trim');
            $this->form_validation->set_rules('shared_product', 'shared_product', 'required|xss_clean|trim');
            $this->form_validation->set_rules('message', 'message', 'required|xss_clean|trim');
            if ($this->form_validation->run() == TRUE) {
                $link = $this->input->post('link');
                $from_email = $this->input->post('from_email');
                $to_email = $this->input->post('to_email');
                $name = $this->input->post('name');
                $shared_product = $this->input->post('shared_product');
                $message = $this->input->post('message');
                $ip = $this->input->ip_address();
                date_default_timezone_set("Asia/Calcutta");
                $cur_date = date("Y-m-d H:i:s");
                $data_insert = array(
                    'name' => $name,
                    'from_email' => $from_email,
                    'to_email' => $to_email,
                    'message' => $message,
                    'shared_product' => $shared_product
                );
                $last_id = $this->base_model->insert_table("tbl_shared_products", $data_insert, 1);
                if ($last_id != 0) {
                    // $config = array(
                    // 											'protocol' => 'smtp',
                    // 											'smtp_host' => SMTP_HOST,
                    // 											'smtp_port' => SMTP_PORT,
                    // 											'smtp_user' => USER_NAME, // change it to yours
                    // 											'smtp_pass' => PASSWORD, // change it to yours
                    // 											'mailtype' => 'html',
                    // 											'charset' => 'iso-8859-1',
                    // 											'wordwrap' => true
                    // 											);
                    // 								$to=$to_email;
                    // 								$data['name']= $name;
                    // 								$data['date']= $cur_date;
                    //
                    //
                    //
                    // 								$message = $message."<br>".$link."<br>From- ".$name;
                    // 								// echo $to;
                    // 								// print_r($message);
                    // 								// exit;
                    //
                    // 								$this->load->library('email', $config);
                    // 								$this->email->set_newline("");
                    // 								$this->email->from(EMAIL); // change it to yours
                    // 								$this->email->to($to);// change it to yours
                    // 								$this->email->subject('Order Placed');
                    // 								$this->email->message($message);
                    // 								if ($this->email->send()) {
                    // 										// echo 'Email sent.';
                    // 								} else {
                    // 										show_error($this->email->print_debugger());
                    // 								}
                    $this->session->set_flashdata('smessage', 'Your message has been sent successfully.');
                    redirect($_SERVER['HTTP_REFERER']);
                } else {
                    $this->session->set_flashdata('emessage', 'Some error occured');
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
    }


    public function generateRandomString($length = 20)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    //========================forgot password email submit===================================
    public function form_submit_forgot_password()
    {
        if (empty($this->session->userdata('user_data'))) {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->helper('security');
            if ($this->input->post()) {
                $this->form_validation->set_rules('reset_email', 'reset_email', 'required|valid_email|xss_clean|trim');

                if ($this->form_validation->run() == true) {
                    $email = $this->input->post('reset_email');


                    $this->db->select('*');
                    $this->db->from('tbl_users');
                    $this->db->where('email', $email);
                    $user_data = $this->db->get()->row();
                    // print_r($user_data);
                    // exit;
                    if (!empty($user_data)) {

                        if ($user_data->is_active == 1) {
                            $user_id = $user_data->id;
                            $user_email = $user_data->email;
                            $user_name = $user_data->name;
                            $ip = $this->input->ip_address();
                            date_default_timezone_set("Asia/Calcutta");
                            $cur_date = date("Y-m-d H:i:s");

                            //generate unique string number for txn_id

                            $txn_id =  $this->generateRandomString(6);

                            $data_insert = array(
                                'user_id' => $user_id,
                                'txn_id' => $txn_id,
                                'status' => 0,
                                'ip' => $ip,
                                'date' => $cur_date
                            );

                            $last_id = $this->base_model->insert_table("tbl_forgot_pass", $data_insert, 1);
                            $link = base_url() . "Home/forget_password_reset/" . $txn_id;
                            $forgot_password_data = array(
                                'user_name' => $user_name,
                                'link' => $link

                            );

                            $config = array(
                                'protocol' => 'smtp',
                                'smtp_host' => SMTP_HOST,
                                'smtp_port' => SMTP_PORT,
                                'smtp_user' => USER_NAME, // change it to yours
                                'smtp_pass' => PASSWORD, // change it to yours
                                'mailtype' => 'html',
                                'charset' => 'iso-8859-1',
                                'wordwrap' => true
                            );
                            $to = $user_email;

                            $message =     $this->load->view('email/forgetpassword', $forgot_password_data, true);

                            $this->load->library('email', $config);
                            $this->email->set_newline("");
                            $this->email->from(EMAIL); // change it to yours
                            $this->email->to($to); // change it to yours
                            $this->email->subject('Reset Your Password');
                            $this->email->message($message);
                            if ($this->email->send()) {
                                // echo 'Email sent.';
                            } else {
                                show_error($this->email->print_debugger());
                            }

                            $this->session->set_flashdata('smessage', 'Password reset link has been sent successfully');
                            redirect('/');
                        } else {
                            $this->session->set_flashdata('emessage', 'Your account is inactive. Please contact admin.');
                            redirect($_SERVER['HTTP_REFERER']);
                        }
                    } else {
                        $this->session->set_flashdata('emessage', 'User does not exists');
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
            redirect("/", "refresh");
        }
    }

    //---forget-password-reset-----
    public function forget_password_reset($t)
    {
        if (empty($this->session->userdata('user_data'))) {
            $id = $t;
            $this->db->select('*');
            $this->db->from('tbl_forgot_pass');
            $this->db->where('txn_id', $id);
            $u1 = $this->db->get()->row();
            $st = $u1->status;

            if ($st == 0) {
                $data_update = array('status' => 1);
                $this->db->where('status', $u1->status);
                $zapak = $this->db->update('tbl_forgot_pass', $data_update);
                $data['auth'] = $id;

                $this->load->view('common/header', $data);
                $this->load->view('forgot_pass');
                $this->load->view('common/footer');
            } else {
                $this->session->set_flashdata('emessage', 'Link already used');
                redirect("/");
            }
        } else {
            redirect("/", "refresh");
        }
    }
    ////-------update password------
    public function update_password($t)
    {
        if (empty($this->session->userdata('user_data'))) {
            $txn_id = $t;

            $this->db->select('*');
            $this->db->from('tbl_forgot_pass');
            $this->db->where('txn_id', $txn_id);
            $u2 = $this->db->get()->row();
            $ui = $u2->user_id;
            $data['auth'] = $txn_id;
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->helper('security');
            if ($this->input->post()) {
                $this->form_validation->set_rules('reset_password', 'reset_password', 'required|xss_clean|trim');

                if ($this->form_validation->run() == true) {
                    $reset_password = $this->input->post('reset_password');

                    $this->db->select('*');
                    $this->db->from('tbl_users');
                    $this->db->where('id', $ui);
                    $this->db->where('is_active', 1);
                    $user = $this->db->get()->row();

                    if (!empty($user)) {
                        $rs = md5($reset_password);
                        $data_update = array('psw' => $rs);
                        $this->db->where('id', $user->id);
                        $zapak = $this->db->update('tbl_users', $data_update);

                        if ($zapak != 0) {
                            $this->session->set_flashdata('smessage', 'Password reset successfully');
                            redirect("/", "refresh");
                        }
                    } else {
                        $this->session->set_flashdata('emessage', 'User not found');
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
            redirect("/", "refresh");
        }
    }
}
