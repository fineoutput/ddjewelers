<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'core/CI_finecontrol.php');
class Taskapi extends CI_finecontrol{
function __construct()
		{
			parent::__construct();
			$this->load->model("login_model");
			$this->load->model("admin/base_model");
			$this->load->library('user_agent');
		}


            public function task()

              {

            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->helper('security');
            if($this->input->post())
            {
              // print_r($this->input->post());
              // exit;
              $this->form_validation->set_rules('email', 'email', 'required|valid_email|xss_clean|trim');
              $this->form_validation->set_rules('password', 'password', 'required|xss_clean|trim');
              // $this->form_validation->set_rules('changes', 'changes', 'required|xss_clean|trim');
              // $this->form_validation->set_rules('type', 'type', 'required|xss_clean|trim');


              if($this->form_validation->run()== TRUE)
              {
                $email=$this->input->post('email');
                $passw=$this->input->post('password');
                // $changes=$this->input->post('changes');
                // $type=$this->input->post('type');


                  $ip = $this->input->ip_address();
          date_default_timezone_set("Asia/Calcutta");
                  $cur_date=date("Y-m-d H:i:s");

                  $this->db->select('*');
                              $this->db->from('tbl_client');
                              $this->db->where('email',$email);
                              $dsa= $this->db->get();
                              $da=$dsa->row();
                              if(!empty($da)){
                                $p1=$da->password;

                                if($passw == $p1){
                                    $id=$da->id;

                                  $this->db->select('*');
                                  $this->db->from('tbl_projects');
                                  $this->db->where('client_id',$id);
                                  $da= $this->db->get();

                                 $i=1; foreach($da->result() as $db) {


                                  $pid=$db->id;
                                  $pname=$db->project_name;


                                  $this->db->select('*');
                                  $this->db->from('tbl_client_tasks');
                                  $this->db->where('project',$pid);
                                  $project22= $this->db->get();


											$i=1; foreach($project22->result() as $d22) {

											  $t1[] = array('task' =>$d22->changes,'type'=>$d22->type);


											}


                    $new1[] = array('id' =>$pid ,'name'=>$pname,'task'=>$t1);

										$t1=array();


                            $i++; }

                                $rep=array('status'=>200,
                                  'message'=>'success',
                                  'tasks'=>$new1
                              );



                                echo json_encode($rep);

                                exit;

                                }
                                else{
                                  $rep=array('status'=>201,
                                    'message'=>'password is incorrect'
                                );

                                echo json_encode($rep);
                                exit;

                                }



                              }
                            else{


                              $rep=array('status'=>201,
                                'message'=>'email id is wrong'
                            );

                            echo json_encode($rep);
                            exit;


                            }





              }
            else{

                                   $rep=array('status'=>201,
                                     'message'=>validation_errors()
                                 );

                                 echo json_encode($rep);
                                 exit;

            }

            }
          else{

            $rep=array('status'=>201,
              'message'=>'no post data'
          );

          echo json_encode($rep);
          exit;

          }

          }


}
