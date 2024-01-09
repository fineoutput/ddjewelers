<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Quick Shops: View Products
    </h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12">
        <a class="btn custom_btn" href="<?php echo base_url() ?>dcadmin/QuickshopProducts/view_minisubcategory2/<?= $minsubcateg_id; ?>" role="button" style="margin-bottom:12px;"> Back</a>
        <a class="btn custom_btn" href="<?php echo base_url() ?>dcadmin/QuickshopProducts/add_products" role="button" style="margin-bottom:12px;"> Add products</a>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i>View products</h3>
          </div>
          <div class="panel panel-default">
            <? if (!empty($this->session->flashdata('smessage'))) { ?>
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                <? echo $this->session->flashdata('smessage'); ?>
              </div>
            <? }
            if (!empty($this->session->flashdata('emessage'))) { ?>
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                <? echo $this->session->flashdata('emessage'); ?>
              </div>
            <? } ?>
            <div class="panel-body">
              <div class="box-body table-responsive no-padding">
                <table class="table table-bordered table-hover table-striped" id="userTable">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Product name</th>
                      <th>Product Id</th>
                      <th>Price</th>
                      <th>Total Weight</th>
                      <th>Image1</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1;
                    foreach ($products_data->result() as $data) {
                      $images = json_decode($data->full_set_images);
                    ?>
                      <tr>
                        <td><?php echo $i ?> </td>
                        <td><?php echo $data->description ?></td>
                        <td><?php echo $data->pro_id ?></td>
                        <td>$<?php echo $data->price ?></td>
                        <td><?php echo $data->weight ?></td>
                        <td>
                          <?php if ($images[0]->FullUrl != "") { ?>
                            <img id="slide_img_path" height=50 width=100 src="<?php echo  $images[0]->FullUrl
                                                                              ?>">
                          <?php } else { ?>
                            Sorry No File Found
                          <?php } ?>
                        </td>

                        <td>
                          <div class="btn-group" id="btns<?php echo $i ?>">
                            <div class="btn-group">
                              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                Action <span class="caret"></span></button>
                              <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo base_url() ?>dcadmin/QuickshopProducts/product_details/<?php echo                                                          base64_encode($data->id) ?>">Product Details</a></li>
                              </ul>
                            </div>
                          </div>
                          <div style="display:none" id="cnfbox<?php echo $i ?>">
                            <p> Are you sure delete this </p>
                            <a href="<?php echo base_url() ?>dcadmin/QuickshopProducts/delete_products/<?php echo
                                                                                                        base64_encode($data->id); ?>" class="btn btn-danger">Yes</a>
                            <a href="javasript:;" class="cans btn btn-default" mydatas="<?php echo $i ?>">No</a>
                          </div>
                        </td>
                      </tr>
                    <?php $i++;
                    } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<style>
  label {
    margin: 5px;
  }
</style>
<script src="<?php echo base_url() ?>assets/admin/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url() ?>assets/admin/plugins/datatables/dataTables.bootstrap.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $(document.body).on('click', '.dCnf', function() {
      var i = $(this).attr("mydata");
      console.log(i);
      $("#btns" + i).hide();
      $("#cnfbox" + i).show();
    });
    $(document.body).on('click', '.cans', function() {
      var i = $(this).attr("mydatas");
      console.log(i);
      $("#btns" + i).show();
      $("#cnfbox" + i).hide();
    })
  });
</script>
<!-- <script type="text/javascript" src="<?php echo base_url()
                                          ?>assets/slider/ajaxupload.3.5.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/slider/rs.js"></script> -->