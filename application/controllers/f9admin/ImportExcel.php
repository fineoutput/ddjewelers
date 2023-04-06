<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
       require_once(APPPATH . 'core/CI_finecontrol.php');
       class ImportExcel extends CI_finecontrol{

       function __construct()
           {
             parent::__construct();
             $this->load->model("login_model");
             $this->load->model("admin/base_model");
             $this->load->library('user_agent');
             $this->load->library('upload');
           }



              public function upload_excel(){

                 if(!empty($this->session->userdata('admin_data'))){

                   $this->load->view('admin/common/header_view');
                   $this->load->view('admin/importExcel/upload_excel_view');
                   $this->load->view('admin/common/footer_view');

               }
               else{

                  redirect("login/admin_login","refresh");
               }

               }




               public function uploadData(){



                 if ($this->input->post('submit')) {

                   $ip = $this->input->ip_address();
                   date_default_timezone_set("Asia/Calcutta");
                   $cur_date=date("Y-m-d H:i:s");
                   $addedby=$this->session->userdata('admin_id');

$excel_file='file';
                           $path = 'uploads/';
                           require_once APPPATH . "/third_party/PHPExcel.php";
                           $config['upload_path'] = $path;
                           $config['allowed_types'] = 'xlsx|xls';
                           $config['remove_spaces'] = TRUE;
                           $this->load->library('upload', $config);
                           $this->upload->initialize($config);
                           if (!$this->upload->do_upload($excel_file)) {
                               $error = array('error' => $this->upload->display_errors());
                           } else {
                               $data = array('upload_data' => $this->upload->data());
                           }
                           if(empty($error)){
                             if (!empty($data['upload_data']['file_name'])) {
                               $import_xls_file = $data['upload_data']['file_name'];
                           } else {
                               $import_xls_file = 0;
                           }
                           $inputFileName = $path . $import_xls_file;

                           try {
                               $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                               $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                               $objPHPExcel = $objReader->load($inputFileName);
                               $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                               $flag = true;
                               $i=0;
                               foreach ($allDataInSheet as $value) {
                                 if($flag){
                                   $flag =false;
                                   continue;
                                 }
                                 $inserdata[$i]['sub_id'] = $value['A'];
                                 $inserdata[$i]['question'] = $value['B'];
                                 $inserdata[$i]['ques_img'] = $value['C'];
                                 $inserdata[$i]['op1'] = $value['D'];
                                 $inserdata[$i]['img1'] = $value['E'];
                                 $inserdata[$i]['op2'] = $value['F'];
                                 $inserdata[$i]['img2'] = $value['G'];
                                 $inserdata[$i]['op3'] = $value['H'];
                                 $inserdata[$i]['img3'] = $value['I'];
                                 $inserdata[$i]['op4'] = $value['J'];
                                 $inserdata[$i]['img4'] = $value['K'];
                                 $inserdata[$i]['ans'] = $value['L'];
                                 $inserdata[$i]['video'] = $value['M'];
                                 $inserdata[$i]['solution'] = $value['N'];
                                 $inserdata[$i]['question_h'] = $value['O'];
                                 $inserdata[$i]['op1_h'] = $value['P'];
                                 $inserdata[$i]['op2_h'] = $value['Q'];
                                 $inserdata[$i]['op3_h'] = $value['R'];
                                 $inserdata[$i]['op4_h'] = $value['S'];
                                 $inserdata[$i]['solution_h'] = $value['T'];
                                 $inserdata[$i]['ip'] = $ip;
                                 $inserdata[$i]['date'] = $cur_date;
                                 $inserdata[$i]['added_by'] = $addedby;
                                 $inserdata[$i]['is_active'] = 1;
                                 $i++;
                               }
                               // $result = $this->import->importdata($inserdata);


 $last_id=$this->base_model->insert_table("	tbl_qna",$inserdata,1) ;

                               if($last_id){
                                 // echo "";
                                 $this->session->set_flashdata('smessage','Data Imported Successfully');
                                 redirect("dcadmin/category/view_category","refresh");
                               }else{
                                 // echo "ERROR !";
                                 $this->session->set_flashdata('emessage','Sorry error occured');
                                 redirect($_SERVER['HTTP_REFERER']);
                               }

                         } catch (Exception $e) {
                              die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                                       . '": ' .$e->getMessage());
                           }
                         }else{
                             echo $error['error'];
                           }


                   }else {
                     $this->session->set_flashdata('emessage','Post method error!');
                     redirect($_SERVER['HTTP_REFERER']);
                   }
                   // $this->load->view('upload');

                 }

                 public function upload_excel_imp($idd){

                                  if(!empty($this->session->userdata('admin_data'))){


                                    $id=base64_decode($idd);
                                    // echo $id;
                                    // exit;
                                   $data['id']=$idd;

                                    $data['user_name']=$this->load->get_var('user_name');


                                    $this->load->view('admin/common/header_view',$data);
                                    $this->load->view('admin/importExcel/upload_excel');
                                    $this->load->view('admin/common/footer_view');

                                }
                                else{

                                   redirect("login/admin_login","refresh");
                                }

                                }


public function excel_imp(){

                 if(!empty($this->session->userdata('admin_data'))){

                   $this->load->helper(array('form', 'url'));
                   $this->load->library('form_validation');
                   $this->load->helper('security');
                   if($this->input->post())
                   {
                     // print_r($this->input->post());
                     // exit;
                  $this->form_validation->set_rules('category', 'category', 'required|xss_clean|trim');
                  $this->form_validation->set_rules('sub_category', 'sub_category', 'required|xss_clean|trim');
                  // $this->form_validation->set_rules('minisubcategory', 'minisubcategory', 'xss_clean|trim');
                  $this->form_validation->set_rules('vendor', 'vendor', 'required|xss_clean|trim');

                     if($this->form_validation->run()== TRUE)
                     {
                  $category=$this->input->post('category');
                  $sub_category=$this->input->post('sub_category');
                  // $minisubcategory=$this->input->post('minisubcategory');
                  $vendor=$this->input->post('vendor');

                    $ip = $this->input->ip_address();
                    date_default_timezone_set("Asia/Calcutta");
                    $cur_date=date("Y-m-d H:i:s");
                    $addedby=$this->session->userdata('admin_id');


                   // $this->load->view('import_data');
                   		// if(isset($_POST["submit"]))
                   		// {
                   			$file = $_FILES['file']['tmp_name'];
                        // print_r($file);
                   			$handle = fopen($file, "r");
                   			$c = 0;//
                   			while(($filesop = fgetcsv($handle, 10000, ",")) !== false)
                   			{

                   				// $op1 = $filesop[D];
                   				// $op2 = $filesop[E];
                   				// $op3 = $filesop[F];
                   				// $op4 = $filesop[G];
                   				// $ans = $filesop[H];
                   				// $solution = $filesop[I];

                   				if($c<>0){					/* SKIP THE FIRST ROW */
                     				$product_id = $filesop[0];
                     				$sku = $filesop[1];
                     				$desc = $filesop[2];
                     				$sdesc = $filesop[3];
                     				$gdesc = $filesop[4];
                     				$mcat1 = $filesop[5];
                     				$mcat2 = $filesop[6];
                     				$mcat3 = $filesop[7];
                     				$mcat4 = $filesop[8];
                     				$mcat5 = $filesop[9];
                     				$product_type = $filesop[10];
                     				$collection = $filesop[11];
                     				$onhand = $filesop[12];
                     				$status = $filesop[13];
                     				$price = $filesop[14];
                     				$currency = $filesop[15];
                     				$unitofsale = $filesop[16];
                     				$weight = $filesop[17];
                     				$weightunit = $filesop[18];
                     				$gramweight = $filesop[19];
                     				$ringsizable = $filesop[20];
                     				$ringsize = $filesop[21];
                     				$ringsizetype = $filesop[22];
                     				$leadtime = $filesop[23];
                     				$agta = $filesop[24];
                     				$desc_e_grp = $filesop[25];
                     				$desc_e_name1 = $filesop[26];
                     				$desc_e_value1 = $filesop[27];
                     				$desc_e_name2 = $filesop[28];
                     				$desc_e_value2 = $filesop[29];
                     				$desc_e_name3 = $filesop[30];
                     				$desc_e_value3 = $filesop[31];
                     				$desc_e_name4 = $filesop[32];
                     				$desc_e_value4 = $filesop[33];
                     				$desc_e_name5 = $filesop[34];
                     				$desc_e_value5 = $filesop[35];
                     				$desc_e_name6 = $filesop[36];
                     				$desc_e_value6 = $filesop[37];
                     				$desc_e_name7 = $filesop[38];
                     				$desc_e_value7 = $filesop[39];
                     				$desc_e_name8 = $filesop[40];
                     				$desc_e_value8 = $filesop[41];
                     				$desc_e_name9 = $filesop[42];
                     				$desc_e_value9 = $filesop[43];
                     				$desc_e_name10 = $filesop[44];
                     				$desc_e_value10 = $filesop[45];
                     				$desc_e_name11 = $filesop[46];
                     				$desc_e_value11 = $filesop[47];
                     				$desc_e_name12 = $filesop[48];
                     				$desc_e_value12 = $filesop[49];
                     				$desc_e_name13 = $filesop[50];
                     				$desc_e_value13 = $filesop[51];
                     				$desc_e_name14 = $filesop[52];
                     				$desc_e_value14 = $filesop[53];
                     				$desc_e_name15 = $filesop[54];
                     				$desc_e_value15 = $filesop[55];
                     				$readytowear = $filesop[56];
                     				$smi = $filesop[57];
                     				$image1 = $filesop[58];
                     				$image2 = $filesop[59];
                     				$image3 = $filesop[60];
                     				$video = $filesop[61];
                     				$gimage1 = $filesop[62];
                     				$gimage2 = $filesop[63];
                     				$gimage3 = $filesop[64];
                     				$gvideo = $filesop[65];
                     				$creationdate = $filesop[66];
                     				$currencycode = $filesop[67];
                     				$country = $filesop[68];
                     				$dclarity = $filesop[69];
                     				$dcolor = $filesop[70];
                     				$totalweight = $filesop[71];

                   					// $this->Crud_model->saverecords($fname,$lname);
                            // echo $fname;
                            // echo '</br/>';
                            // echo $lname;
                            $data_insert = array(
                                   'product_id'=>$product_id,
                                   'category'=>$category,
                                   'sub_category'=>$sub_category,
                                   // 'minisub_category'=>$minisubcategory,
                                   'vendor'=>$vendor,
                                   'sku'=>$sku,
                                   'description'=>$desc,
                                   'sdesc'=>$sdesc,
                                   'gdesc'=>$gdesc,
                                   'mcat1'=>$mcat1,
                                   'mcat2'=>$mcat2,
                                   'mcat3'=>$mcat3,
                                   'mcat4'=>$mcat4,
                                   'mcat5'=>$mcat5,
                                   'product_type'=>$product_type,
                                   'collection'=>$collection,
                                   'onhand'=>$onhand,
                                   'status'=>$status,
                                   'price'=>$price,
                                   'currency'=>$currency,
                                   'unitofsale'=>$unitofsale,
                                   'weight'=>$weight,
                                   'weightunit'=>$weightunit,
                                   'gramweight'=>$gramweight,
                                   'ringsizable'=>$ringsizable,
                                   'ringsize'=>$ringsize,
                                   'ringsizetype'=>$ringsizetype,
                                   'leadtime'=>$leadtime,
                                   'agta'=>$agta,
                                   'desc_e_grp'=>$desc_e_grp,
                                   'desc_e_name1'=>$desc_e_name1,
                                   'desc_e_value1'=>$desc_e_value1,
                                   'desc_e_name2'=>$desc_e_name2,
                                   'desc_e_value2'=>$desc_e_value2,
                                   'desc_e_name3'=>$desc_e_name3,
                                   'desc_e_value3'=>$desc_e_value3,
                                   'desc_e_name4'=>$desc_e_name4,
                                   'desc_e_value4'=>$desc_e_value4,
                                   'desc_e_name5'=>$desc_e_name5,
                                   'desc_e_value5'=>$desc_e_value5,
                                   'desc_e_name6'=>$desc_e_name6,
                                   'desc_e_value6'=>$desc_e_value6,
                                   'desc_e_name7'=>$desc_e_name7,
                                   'desc_e_value7'=>$desc_e_value7,
                                   'desc_e_name8'=>$desc_e_name8,
                                   'desc_e_value8'=>$desc_e_value8,
                                   'desc_e_name9'=>$desc_e_name9,
                                   'desc_e_value9'=>$desc_e_value9,
                                   'desc_e_name10'=>$desc_e_name10,
                                   'desc_e_value10'=>$desc_e_value10,
                                   'desc_e_name11'=>$desc_e_name11,
                                   'desc_e_value11'=>$desc_e_value11,
                                   'desc_e_name12'=>$desc_e_name12,
                                   'desc_e_value12'=>$desc_e_value12,
                                   'desc_e_name13'=>$desc_e_name13,
                                   'desc_e_value13'=>$desc_e_value13,
                                   'desc_e_name14'=>$desc_e_name14,
                                   'desc_e_value14'=>$desc_e_value14,
                                   'desc_e_name15'=>$desc_e_name15,
                                   'desc_e_value15'=>$desc_e_value15,
                                   'readytowear'=>$readytowear,
                                   'smi'=>$smi,
                                   'image1'=>$image1,
                                   'image2'=>$image2,
                                   'image3'=>$image3,
                                   'video'=>$video,
                                   'gimage1'=>$gimage1,
                                   'gimage2'=>$gimage2,
                                   'gimage3'=>$gimage3,
                                   'gvideo'=>$gvideo,
                                   'creationdate'=>$creationdate,
                                   'currencycode'=>$currencycode,
                                   'country'=>$country,
                                   'dclarity'=>$dclarity,
                                   'dcolor'=>$dcolor,
                                   'totalweight'=>$totalweight,

                                      'ip' =>$ip,
                                      'added_by' =>$addedby,
                                      'is_active' =>1,
                                      'date'=>$cur_date
                                      );


                            $last_id=$this->base_model->insert_table("tbl_products",$data_insert,1) ;


                   				}
                   				$c = $c + 1;
                   			}

                   			// echo "sucessfully import data !";
                        redirect("dcadmin/products/view_products","refresh");

                   		// }
                      // else{
                      //   echo "noo";
                      // }

               }
               else{

               $this->session->set_flashdata('emessage',validation_errors());
               redirect($_SERVER['HTTP_REFERER']);
             }

             }
             else{

               echo "No post data";
   }

}
 else{

    redirect("login/admin_login","refresh");
 }


}
    }

      ?>
