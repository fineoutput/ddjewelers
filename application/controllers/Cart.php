<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Cart extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model("admin/login_model");
		$this->load->model("admin/base_model");
	}
	public function view_cart()
	{
		if (!empty($this->session->userdata('user_data'))) {
			$data['cart_data'] = $this->db->get_where('tbl_cart', array('user_id' => $this->session->userdata('user_data')))->result();
			$this->load->view('common/header', $data);
			$this->load->view('cart');
			$this->load->view('common/footer');
		} else {
			$data['cart_data'] = $this->session->userdata('cart_data');
			$this->load->view('common/header', $data);
			$this->load->view('local_cart');
			$this->load->view('common/footer');
		}
	}
	//======================================= ADD TO CART ========================================================

	public function addToCart()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->helper('security');
		if ($this->input->post()) {
			$this->form_validation->set_rules('pro_id', 'pro_id', 'required|xss_clean|trim');
			$this->form_validation->set_rules('quantity', 'quantity', 'required|xss_clean|trim');
			$this->form_validation->set_rules('ring_size', 'ring_size', 'xss_clean|trim');
			$this->form_validation->set_rules('ring_price', 'ring_price', 'xss_clean|trim');
			$this->form_validation->set_rules('gem_data', 'gem_data', 'xss_clean|trim');
			$this->form_validation->set_rules('price', 'price', 'xss_clean|trim');
			$this->form_validation->set_rules('img', 'img', 'xss_clean|trim');

			if ($this->form_validation->run() == true) {
				$pro_id = $this->input->post('pro_id');
				$quantity = $this->input->post('quantity');
				$ring_size = $this->input->post('ring_size');
				$ring_price = $this->input->post('ring_price');
				$gem_data = $this->input->post('gem_data');
				$price = $this->input->post('price');
				$img = $this->input->post('img');
				$send = [
					'pro_id' => $pro_id,
					'quantity' => $quantity,
					'ring_size' => $ring_size,
					'ring_price' => $ring_price,
					'gem_data' => $gem_data,
					'price' => $price,
					'img' => $img,
				];
				//----- check inventory ----------------
				$invRes = $this->check_Inventory($pro_id, $quantity);
				if ($invRes['data'] == false) {
					$response['status'] = false;
					$response['message'] = $invRes['data_message'];
					echo json_encode($response);
					return;
				}
				if (empty($this->session->userdata('user_data'))) {
					$cartCall = $this->AddToCartOffline($send);
				} else {
					$cartCall = $this->AddToCartOnline($send);
				}
				echo $cartCall;
			} else {
				$response['status'] = false;
				$response['message'] = validation_errors();
				echo json_encode($response);
			}
		} else {
			$response['status'] = false;
			$response['message'] = "Please insert some data, No data available";
			echo json_encode($response);
		}
	}

	// ======================= START CHECK INVENTORY =====================
	public function check_Inventory($id, $qty)
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://api.stuller.com/v2/products?ProductId=' . $id,
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
		$response_dec = json_decode($response);
		if (!empty($response_dec->Products)) {
			foreach ($response_dec->Products as $res) {
				$inventory = $res->OnHand;
				$status = $res->Status;
			}
		}
		if (!empty($status) && $status != 'Out Of Stock') {
			$db_quantity = $inventory;
			if ($status == 'Made To Order') {

				$data['data'] = true;
			} else {

				if ($db_quantity >= $qty) {
					$data['data'] = true;
				} else {
					$data['data'] = false;
					$data['data_message'] = 'Product is out of stock';
				}
			}
		} else {
			$data['data'] = false;
			$data['data_message'] = 'Product is out of stock';
		}
		return $data;
	}

	// ======================= END CHECK INVENTORY =====================
	//================================================= START BEFORE LOGIN CART ========================================================

	//================- ADD TO CART SESSION =====================================
	public function AddToCartOffline($receive)
	{
		$ip = $this->input->ip_address();
		date_default_timezone_set("Asia/Calcutta");
		$cur_date = date("Y-m-d H:i:s");
		$pro = $this->db->get_where('tbl_products', array('pro_id' => $receive['pro_id']))->row();
		$ring_price =  $receive['ring_price'] ? $receive['ring_price'] : 0;
		$price = $this->getPrice($pro->sku, $ring_price);
		$cart_item = array(
			'pro_id' => $receive['pro_id'],
			'quantity' => $receive['quantity'],
			'ring_size' => $receive['ring_size'],
			'ring_price' => $receive['ring_price'],
			'gem_data' => $receive['gem_data'],
			'price' => $receive['price'] ? round($receive['price'], 2) : round($price, 2),
			'img' => $receive['img'],
			'ip' => $ip,
			'date' => $cur_date
		);
		//----check product in already in cart------
		$cart_data = $this->session->userdata('cart_data');
		if (!empty($cart_data)) {
			$i = 0;
			foreach ($cart_data as $items) {
				if ($items['pro_id'] == $receive['pro_id'] && $items['ring_size'] == $receive['ring_size']) {
					$i = 1;
				}
			}
			if ($i == 1) {
				$response['status'] = false;
				$response['message'] = "Item is already in your cart";
				return json_encode($response);
			} else {
				array_push($cart_data, $cart_item);
				$this->session->set_userdata('cart_data', $cart_data);
				$response['status'] = true;
				$response['message'] = "Item successfully added in your cart";
				$response['data'] = count($cart_data);
				return json_encode($response);
			}
		}
		//------create session cart------
		else {
			$cart = array($cart_item);
			$this->session->set_userdata('cart_data', $cart);
			$response['status'] = true;
			$response['message'] = "Item successfully added in your cart";
			$response['data'] = 1;
			return json_encode($response);
		}
	}

	//================- REMOVE TO CART SESSION =====================================
	public function RemoveCartOffline($pro_id, $size = '')
	{
		$index = "-1";
		$cart = $this->session->userdata('cart_data');
		//----- Find index of the cart array ---
		if (!empty($cart)) {
			for ($i = 0; $i < count($cart); $i++) {
				if ($cart[$i]['pro_id'] == $pro_id && $cart[$i]['ring_size'] == $size) {
					$index = $i;
				}
			}
		}
		if ($index > -1) {
			$cart = $this->session->userdata('cart_data');
			unset($cart[$index]);
			$cart = array_values($cart);
			$this->session->set_userdata('cart_data', $cart);
			$this->session->set_flashdata('smessage', 'Item successfully removed from your cart');
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			$this->session->set_flashdata('emessage', 'Some error occurred');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	//========================= UPDATE SESSION CART ================================
	public function UpdateCartOffline($pro_id)
	{
		$quantity = $_GET['quantity'];
		$size = $_GET['ring_size'];
		$index = "-1";
		//----- check inventory ----------------
		$invRes = $this->check_Inventory($pro_id, $quantity);
		if ($invRes['data'] == false) {
			$this->session->set_flashdata('emessage', $invRes['data_message']);
			redirect($_SERVER['HTTP_REFERER']);
			return;
		}
		//----check product in already in cart------
		$cart = $this->session->userdata('cart_data');
		if (!empty($cart)) {
			for ($i = 0; $i < count($cart); $i++) {
				if ($cart[$i]['pro_id'] == $pro_id && $cart[$i]['ring_size'] == $size) {
					$index = $i;
				}
			}
		}
		if ($index > -1) {
			$cart = $this->session->userdata('cart_data');
			$cart[$index]['quantity'] = $quantity;
			$this->session->set_userdata('cart_data', $cart);
			$this->session->set_flashdata('smessage', 'Item successfully updated in your cart');
			redirect($_SERVER['HTTP_REFERER']);
			return;
		} else {
			$this->session->set_flashdata('smessage', 'Some error occurred');
			redirect($_SERVER['HTTP_REFERER']);
			return;
		}
	}

	//================================================= END BEFORE LOGIN CART ========================================================
	//================================================ START AFTER LOGIN CART ========================================================

	//================== LOGIN ADD TO CART ==================================

	public function AddToCartOnline($receive)
	{
		if (!empty($this->session->userdata('user_data'))) {
			$user_id = $this->session->userdata('user_id');
			$ip = $this->input->ip_address();
			date_default_timezone_set("Asia/Calcutta");
			$cur_date = date("Y-m-d H:i:s");
			// ------ CHECK ALREADY EXIST ------
			$cartInfo = $this->db->get_where('tbl_cart', array('user_id' => $user_id, 'pro_id' => $receive['pro_id'], 'ring_size' => $receive['ring_size']))->row();
			if (empty($cartInfo)) {
				$pro = $this->db->get_where('tbl_products', array('pro_id' => $receive['pro_id']))->row();
				$ring_price =  $receive['ring_price'] ? $receive['ring_price'] : 0;
				$price = $this->getPrice($pro->sku, $ring_price);
				$cart_insert = array(
					'user_id' => $user_id,
					'pro_id' => $receive['pro_id'],
					'quantity' => $receive['quantity'],
					'ring_size' => $receive['ring_size'],
					'ring_price' => $receive['ring_price'],
					'gem_data' => $receive['gem_data'],
					'price' => $receive['price'] ? round($receive['price'], 2) : round($price, 2),
					'img' => $receive['img'],
					'date' => $cur_date
				);
				$last_id = $this->base_model->insert_table("tbl_cart", $cart_insert, 1);
				if (!empty($last_id)) {
					$response['status'] = true;
					$response['message'] = "Item successfully added to your cart";
					return json_encode($response);
				} else {
					$response['status'] = false;
					$response['message'] = "Some error occurred";
					return json_encode($response);
				}
			} else {
				$response['status'] = false;
				$response['message'] = "Item is already in your cart";
				return json_encode($response);
			}
		} else {
			$response['status'] = false;
			$response['message'] = "Cart data not found";
			return json_encode($response);
		}
	}

	//============ REMOVE PRODUCT FROM CART LOGIN ============
	public function RemoveCartOnline($pro_id, $size = '')
	{
		if (!empty($this->session->userdata('user_data'))) {
			$user_id = $this->session->userdata('user_id');    //-- user and reseller manage
			$zapak = $this->db->delete('tbl_cart', array('user_id' => $user_id, 'pro_id' => $pro_id, 'ring_size' => $size,));
			$this->session->set_flashdata('smessage', 'Item successfully removed from your cart');
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			$this->session->set_flashdata('emessage', 'Some error occurred');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	//======================== UPDATE CART LOGIN ====================
	public function UpdateCartOnline($pro_id)
	{
		$quantity = $_GET['quantity'];
		$ring_size = $_GET['ring_size'];
		if (!empty($this->session->userdata('user_data'))) {
			$user_id = $this->session->userdata('user_id');
			//----- check inventory ----------------
			$invRes = $this->check_Inventory($pro_id, $quantity);
			if ($invRes['data'] == false) {
				$this->session->set_flashdata('emessage', $invRes['data_message']);
				redirect($_SERVER['HTTP_REFERER']);
				return;
			}
			//----------cart quantity update--------
			$data_update = array('quantity' => $quantity);
			$this->db->where('user_id', $user_id);
			$this->db->where('pro_id', $pro_id);
			$this->db->where('ring_size', $ring_size);
			$zapak = $this->db->update('tbl_cart', $data_update);
			if (!empty($zapak)) {
				$this->session->set_flashdata('smessage', 'Item successfully updated in your cart');
				redirect($_SERVER['HTTP_REFERER']);
			} else {
				$this->session->set_flashdata('smessage', 'Some error occurred');
				redirect($_SERVER['HTTP_REFERER']);
				return;
			}
		} else {
			redirect($_SERVER['HTTP_REFERER']);
			return;
		}
	}
	//--------wishlist---------
	public function wishlist()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->helper('security');
		if ($this->input->post()) {
			$this->form_validation->set_rules('pro_id', 'pro_id', 'required|xss_clean|trim');
			$this->form_validation->set_rules('status', 'status', 'required|xss_clean|trim');
			if ($this->form_validation->run() == true) {
				$pro_id = $this->input->post('pro_id');
				$status = $this->input->post('status');
				$ip = $this->input->ip_address();
				date_default_timezone_set("Asia/Calcutta");
				$cur_date = date("Y-m-d H:i:s");
				$user_id = $this->session->userdata('user_id');
				if (empty($user_id)) {
					$data['data'] = false;
					$data['data_message'] = 'Please login first!';
				}

				$this->db->select('*');
				$this->db->from('tbl_wishlist');
				$this->db->where('user_id', $user_id);
				$this->db->where('pro_id', $pro_id);
				$wishCheck = $this->db->get()->row();
				//----------add to wishlist----
				if ($status == "add") {
					if (empty($wishCheck)) {
						$data_insert = array(
							'user_id' => $user_id,
							'pro_id' => $pro_id,
							'ip' => $ip,
							'date' => $cur_date
						);

						$last_id = $this->base_model->insert_table("tbl_wishlist", $data_insert, 1);
						if (!empty($last_id)) {
							$response['data'] = true;
							$response['data_message'] = 'Item successfully added in your wishlist';
							$response['button_message'] = 'REMOVE FROM WISHLIST';
							echo json_encode($response);
						} else {
							$response['data'] = false;
							$response['data_message'] = 'Some error occurred';
							echo json_encode($response);
						}
					} else {
						$response['data'] = false;
						$response['data_message'] = 'Already in your wishlist';
						echo json_encode($response);
					}
				}
				//---------remove wishlist---------
				elseif ($status == "remove") {
					$delete = $this->db->delete('tbl_wishlist', array('user_id' => $user_id, 'pro_id' => $pro_id));
					if (!empty($delete)) {
						$response['data'] = true;
						$response['data_message'] = 'Item successfully deleted from your wishlist';
						echo json_encode($response);
					} else {
						$response['data'] = false;
						$response['data_message'] = 'Some error occurred';
						echo json_encode($response);
					}
				}
				//---------move to cart--------
				elseif ($status == "move") {
					$this->db->select('*');
					$this->db->from('tbl_cart');
					$this->db->where('user_id', $user_id);
					$this->db->where('pro_id', $wishCheck->pro_id);
					$wish_check = $this->db->get()->row();
					if (empty($wish_check)) {
						$cart_insert = array(
							'user_id' => $user_id,
							'pro_id' => $wishCheck->pro_id,
							'ring_size' => $wishCheck->ring_size,
							'ring_price' => $wishCheck->ring_price,
							'quantity' => 1,
							'date' => $cur_date
						);

						$cart_id = $this->base_model->insert_table("tbl_cart", $cart_insert, 1);
						if (!empty($cart_id)) {
							$delete = $this->db->delete('tbl_wishlist', array('user_id' => $user_id, 'product_id' => $pro_id));
							$response['data'] = true;
							$response['data_message'] = 'Item successfully moved to your cart';
							echo json_encode($response);
						} else {
							$response['data'] = false;
							$response['data_message'] = 'Some error occurred';
							echo json_encode($response);
						}
					} else {
						$response['data'] = false;
						$response['data_message'] = 'Product is already in your cart';
						echo json_encode($response);
					}
				}
			} else {
				$response['data'] = false;
				$response['data_message'] = validation_errors();
				echo json_encode($response);
			}
		} else {
			$response['data'] = false;
			$response['data_message'] = "Please insert some data, No data available";
			echo json_encode($response);
		}
	}
	//----- START GET PRODUCT LATEST PRICE ------
	public function getPrice($sku, $sizePrice)
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://api.stuller.com/v2/products',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => '{"Include":["All"],"Filter":["OnPriceList","Orderable"], "SKU":["' . $sku . '"]}',
			CURLOPT_HTTPHEADER => array(
				'Authorization: Basic ZGV2amV3ZWw6Q29kaW5nMjA9',
				'Content-Type: application/json',
				'Host: api.stuller.com',
			),
		));

		$response = curl_exec($curl);
		curl_close($curl);
		$prod = json_decode($response);
		if (!empty($prod->Products)) {
			$pro_price = $prod->Products[0]->Price->Value;
		} else if (!empty($prod->Diamond)) {
			$pro_price = $prod->Diamond[0]->Price->Value;
		} else if (!empty($prod->GemStone)) {
			$pro_price = $prod->GemStone[0]->Price->Value;
		} else if (!empty($prod->LabGrownDiamond)) {
			$pro_price = $prod->LabGrownDiamond[0]->Price->Value;
		}
		$pr_data = $this->db->get_where('tbl_price_rule', array())->row();
		$data['sizePrice'] = $sizePrice;
		$multiplier = $pr_data->multiplier;
		$cost_price = $pro_price + $sizePrice;
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
		return $now_price;
	}
	//----- END GET PRODUCT LATEST PRICE ------
}
