<div class="content-wrapper">
        <section class="content-header">
           <h1>
          Update State
          </h1>
          <ol class="breadcrumb">
          <li><a href="<?php echo base_url() ?>dcadmin"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="<?php echo base_url() ?>dcadmin/State/view_state"><i class="fa fa-dashboard"></i> state </a></li>
            <li class="active">Update state</li>
            </ol>
          <br/>
          <a class="btn btn-info cticket" href="<?php echo base_url() ?>dcadmin/State/view_state"
  role="button" style="margin-bottom:12px;">Back</a>   
        </section>
        
    <section class="content">
    <div class="row">
       <div class="col-lg-12">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Update State </h3>
                            </div>

                                     <? if(!empty($this->session->flashdata('smessage'))){  ?>
                                          <div class="alert alert-success alert-dismissible">
                                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                      <h4><i class="icon fa fa-check"></i> Alert!</h4>
                                     <? echo $this->session->flashdata('smessage');  ?>
                                    </div>
                                       <? }
                                       if(!empty($this->session->flashdata('emessage'))){  ?>
                                       <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                                   <? echo $this->session->flashdata('emessage');  ?>
                                  </div>
                                     <? }  ?>


                            <div class="panel-body">
                                <div class="col-lg-10">
                                   <form action=" <?php echo base_url(); ?>dcadmin/State/add_state_data/<? echo base64_encode(2); ?>/<?=$id;?>" method="POST" id="slide_frm" enctype="multipart/form-data">
                                <div class="table-responsive">
                                    <table class="table table-hover">
	 <tr> 
 <td> <strong>State Name</strong>  <span style="color:red;">*</span></strong> </td> 
 <td> <input type="text" name="name"  class="form-control" placeholder="" required value="<?=$state_data->name;?>" />  </td> 
 </tr> 


                          <tr>
                            <td colspan="2" >
                              <input type="submit" class="btn btn-success" value="save">
                            </td>
                          </tr>
                                        </table>
                                    </div>

                                 </form>

                                    </div>



                                </div>

                            </div>

                        </div>
                        </div>
            </section>
          </div>


<script type="text/javascript" src=" <?php echo base_url()  ?>assets/slider/ajaxupload.3.5.js"></script>
<link href=" <? echo base_url()  ?>assets/cowadmin/css/jqvmap.css" rel='stylesheet' type='text/css' />


        