<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'core/CI_finecontrol.php');
class Contact_us_page extends CI_finecontrol{
function __construct()
{
parent::__construct();
$this->load->model("login_model");
$this->load->model("admin/base_model");
$this->load->library('user_agent');
$this->load->library('upload');
}

//****************************view Contact_us_page Function**************************************

public function View_contact_us_page(){

if(!empty($this->session->userdata('admin_data'))){


$data['user_name']=$this->load->get_var('user_name');

$this->db->select('*');
$this->db->from('tbl_contact_us_page');

$data['contact_us_page_data']= $this->db->get();

$this->load->view('admin/common/header_view',$data);
$this->load->view('admin/contact_us_page/view_contact_us_page');
$this->load->view('admin/common/footer_view');

}
else{

redirect("login/admin_login","refresh");
}

}
//****************************Add contact_us_page Function**************************************
public function add_contact_us_page(){

if(!empty($this->session->userdata('admin_data'))){


$data['user_name']=$this->load->get_var('user_name');




$this->load->view('admin/common/header_view',$data);
$this->load->view('admin/contact_us_page/add_contact_us_page');
$this->load->view('admin/common/footer_view');

}
else{

redirect("login/admin_login","refresh");
}

}
//****************************Insert contact_us_page Function**************************************
public function add_contact_us_page_data($t,$iw="")

{

if(!empty($this->session->userdata('admin_data'))){


$this->load->helper(array('form', 'url'));
$this->load->library('form_validation');
$this->load->helper('security');
if($this->input->post())
{
// print_r($this->input->post());
// exit;


// $this->form_validation->set_rules('heading', 'heading', 'required|xss_clean|trim');
$this->form_validation->set_rules('address_heading', 'address_heading', 'required|xss_clean|trim');
$this->form_validation->set_rules('number', 'number', 'required|xss_clean|trim');

$this->form_validation->set_rules('address', 'address', 'xss_clean|trim');
$this->form_validation->set_rules('map_address', 'map_address', 'xss_clean|trim');
// $this->form_validation->set_rules('hours', 'hours', 'required|xss_clean|trim');
$this->form_validation->set_rules('hours_list', 'hours_list', 'required|xss_clean|trim');



if($this->form_validation->run()== TRUE)
{
// $heading=$this->input->post('heading');
$address_heading=$this->input->post('address_heading');
$number=$this->input->post('number');

$address=$this->input->post('address');
$map_address=$this->input->post('map_address');
// $hours=$this->input->post('hours');

$hours_list=$this->input->post('hours_list');



$ip = $this->input->ip_address();
date_default_timezone_set("Asia/Calcutta");
$cur_date=date("Y-m-d H:i:s");

$addedby=$this->session->userdata('admin_id');


$typ=base64_decode($t);
if($typ==1){

$data_insert = array(
// 'heading'=>$heading,
'address_heading'=>$address_heading,
'number'=>$number,
'address'=>$address,

'map_address'=>$map_address,
// 'hours'=>$hours,
'hours_list'=>$hours_list,




'ip' =>$ip,
'added_by' =>$addedby,
'is_active' =>1,
'date'=>$cur_date

);

$last_id=$this->base_model->insert_table("tbl_contact_us_page",$data_insert,1) ;

}
if($typ==2){

$idw=base64_decode($iw);



$data_insert = array(	
    // 'heading'=>$heading,
'address_heading'=>$address_heading,
'number'=>$number,
'address'=>$address,

'map_address'=>$map_address,
// 'hours'=>$hours,
'hours_list'=>$hours_list
);

$this->db->where('id', $idw);
$last_id=$this->db->update('tbl_contact_us_page', $data_insert);

}


if($last_id!=0){

$this->session->set_flashdata('smessage','Data inserted successfully');

redirect("dcadmin/Contact_us_page/view_contact_us_page","refresh");

}

else

{

$this->session->set_flashdata('emessage','Sorry error occured');
redirect($_SERVER['HTTP_REFERER']);


}


}
else{

$this->session->set_flashdata('emessage',validation_errors());
redirect($_SERVER['HTTP_REFERER']);

}

}
else{

$this->session->set_flashdata('emessage','Please insert some data, No data available');
redirect($_SERVER['HTTP_REFERER']);

}
}
else{

redirect("login/admin_login","refresh");


}
}

//****************************Update contact_us_page Function**************************************
public function update_contact_us_page($idd){

if(!empty($this->session->userdata('admin_data'))){


$data['user_name']=$this->load->get_var('user_name');


$id=base64_decode($idd);
$data['id']=$idd;


$this->db->select('*');
$this->db->from('tbl_contact_us_page');
$this->db->where('id',$id);
$dsa= $this->db->get();
$data['contact_us_page']=$dsa->row();




$this->load->view('admin/common/header_view',$data);
$this->load->view('admin/contact_us_page/update_contact_us_page');
$this->load->view('admin/common/footer_view');

}
else{

redirect("login/admin_login","refresh");
}

}

//****************************Delete contact_us_page Function**************************************


public function delete_contact_us_page($idd){

if(!empty($this->session->userdata('admin_data'))){


$data['user_name']=$this->load->get_var('user_name');


$id=base64_decode($idd);

if($this->load->get_var('position')=="Super Admin"){


$zapak=$this->db->delete('tbl_contact_us_page', array('id' => $id));
if($zapak!=0){

redirect("dcadmin/Contact_us_page/view_contact_us_page","refresh");
}
else
{
echo "Error";
exit;
}
}
else{
$data['e']="Sorry You Don't Have Permission To Delete Anything.";
// exit;
$this->load->view('errors/error500admin',$data);
}


}
else{

$this->load->view('admin/login/index');
}

}
//****************************Update contact_us_page Function**************************************
public function updatecontact_us_pageStatus($idd,$t){

if(!empty($this->session->userdata('admin_data'))){


$data['user_name']=$this->load->get_var('user_name');

$id=base64_decode($idd);

if($t=="active"){

$data_update = array(
'is_active'=>1

);

$this->db->where('id', $id);
$zapak=$this->db->update('tbl_contact_us_page', $data_update);

if($zapak!=0){
redirect("dcadmin/Contact_us_page/view_contact_us_page","refresh");
}
else
{
echo "Error";
exit;
}
}
if($t=="inactive"){
$data_update = array(
'is_active'=>0

);

$this->db->where('id', $id);
$zapak=$this->db->update('tbl_contact_us_page', $data_update);

if($zapak!=0){
redirect("dcadmin/Contact_us_page/view_contact_us_page","refresh");
}
else
{

$data['e']="Error Occured";
// exit;
$this->load->view('errors/error500admin',$data);
}
}



}
else{

$this->load->view('admin/login/index');
}

}







}
