<div class="content-wrapper">
               <section class="content-header">
                  <h1>
                Update Shipping
                 </h1>

               </section>
           <section class="content">
           <div class="row">
              <div class="col-lg-12">

                               <div class="panel panel-default">
                                   <div class="panel-heading">
                                       <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Add New Shipping</h3>
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
                                          <form action=" <?php echo base_url()  ?>dcadmin/Shippingrules/add_shippingrules_data/<? echo base64_encode(2);?>/<?=$id?>" method="POST" id="slide_frm" enctype="multipart/form-data">
                                          <table class="table table-hover">
                  <input type="hidden" name="shipping_id" value="<?=base64_encode($rules_data->shipping_id)?>">
                    <tr>
                      <td> <strong>Start Price</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="start_price" class="form-control" placeholder="" required value="<?=$rules_data->start_price?>" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>End Price</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="End_price" class="form-control" placeholder="" required value="<?=$rules_data->end_price?>" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Shipping Cost</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="shipment_cost" class="form-control" placeholder="" required value="<?=$rules_data->shipment_cost?>" />
                      </td>
                    </tr>
                  

                    <tr>

                      <tr>
                      <td colspan="2">
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
