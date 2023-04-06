<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'core/CI_finecontrol.php');
class Faq_category extends CI_finecontrol{
function __construct()
{
parent::__construct();
$this->load->model("login_model");
$this->load->model("admin/base_model");
$this->load->library('user_agent');
$this->load->library('upload');
}

//****************************view faq_category Function**************************************

public function View_faq_category(){

if(!empty($this->session->userdata('admin_data'))){


$data['user_name']=$this->load->get_var('user_name');

$this->db->select('*');
$this->db->from('tbl_faq_category');

$data['faq_category_data']= $this->db->get();

$this->load->view('admin/common/header_view',$data);
$this->load->view('admin/faq_category/view_faq_category');
$this->load->view('admin/common/footer_view');

}
else{

redirect("login/admin_login","refresh");
}

}
//****************************Add faq_category Function**************************************
public function add_faq_category(){

if(!empty($this->session->userdata('admin_data'))){


$data['user_name']=$this->load->get_var('user_name');




$this->load->view('admin/common/header_view',$data);
$this->load->view('admin/faq_category/add_faq_category');
$this->load->view('admin/common/footer_view');

}
else{

redirect("login/admin_login","refresh");
}

}
//****************************Insert faq_category Function**************************************
public function add_faq_category_data($t,$iw="")

{

if(!empty($this->session->userdata('admin_data'))){


$this->load->helper(array('form', 'url'));
$this->load->library('form_validation');
$this->load->helper('security');
if($this->input->post())
{
// print_r($this->input->post());
// exit;


$this->form_validation->set_rules('name', 'name', 'required|xss_clean|trim');
$this->form_validation->set_rules('sequence', 'sequence', 'required|xss_clean|trim');




if($this->form_validation->run()== TRUE)
{
$name=$this->input->post('name');
$sequence=$this->input->post('sequence');




$ip = $this->input->ip_address();
date_default_timezone_set("Asia/Calcutta");
$cur_date=date("Y-m-d H:i:s");

$addedby=$this->session->userdata('admin_id');


$typ=base64_decode($t);
if($typ==1){

$data_insert = array(
'sequence'=>$sequence,
'name'=>$name,





'ip' =>$ip,
'added_by' =>$addedby,
'is_active' =>1,
'date'=>$cur_date

);

$last_id=$this->base_model->insert_table("tbl_faq_category",$data_insert,1) ;

}
if($typ==2){

$idw=base64_decode($iw);



$data_insert = array(	'sequence'=>$sequence,
'name'=>$name

);

$this->db->where('id', $idw);
$last_id=$this->db->update('tbl_faq_category', $data_insert);

}


if($last_id!=0){

$this->session->set_flashdata('smessage','Data inserted successfully');

redirect("dcadmin/Faq_category/view_faq_category","refresh");

}

else

{

$this->session->set_flashdata('smessage','Sorry error occured');
redirect($_SERVER['HTTP_REFERER']);


}


}
else{

$this->session->set_flashdata('smessage',validation_errors());
redirect($_SERVER['HTTP_REFERER']);

}

}
else{

$this->session->set_flashdata('smessage','Please insert some data, No data available');
redirect($_SERVER['HTTP_REFERER']);

}
}
else{

redirect("login/admin_login","refresh");


}
}

//****************************Update faq_category Function**************************************
public function update_faq_category($idd){

if(!empty($this->session->userdata('admin_data'))){


$data['user_name']=$this->load->get_var('user_name');


$id=base64_decode($idd);
$data['id']=$idd;


$this->db->select('*');
$this->db->from('tbl_faq_category');
$this->db->where('id',$id);
$dsa= $this->db->get();
$data['faq_category']=$dsa->row();




$this->load->view('admin/common/header_view',$data);
$this->load->view('admin/faq_category/update_faq_category');
$this->load->view('admin/common/footer_view');

}
else{

redirect("login/admin_login","refresh");
}

}

//****************************Delete faq_category Function**************************************


public function delete_faq_category($idd){

if(!empty($this->session->userdata('admin_data'))){


$data['user_name']=$this->load->get_var('user_name');


$id=base64_decode($idd);

if($this->load->get_var('position')=="Super Admin"){


$zapak=$this->db->delete('tbl_faq_category', array('id' => $id));
if($zapak!=0){

redirect("dcadmin/Faq_category/view_faq_category","refresh");
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
//****************************Update Farmers Status Function**************************************
public function updatefaq_categoryStatus($idd,$t){

if(!empty($this->session->userdata('admin_data'))){


$data['user_name']=$this->load->get_var('user_name');

$id=base64_decode($idd);

if($t=="active"){

$data_update = array(
'is_active'=>1

);

$this->db->where('id', $id);
$zapak=$this->db->update('tbl_faq_category', $data_update);

if($zapak!=0){
redirect("dcadmin/Faq_category/view_faq_category","refresh");
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
$zapak=$this->db->update('tbl_faq_category', $data_update);

if($zapak!=0){
redirect("dcadmin/Faq_category/view_faq_category","refresh");
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
