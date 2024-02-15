<div class="content-wrapper">
  <section class="content-header">
    <h1>
      View Price Rule
    </h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12">
        <!-- <a class="btn btn-info cticket" href="<?php echo base_url() ?>dcadmin/price_rule/add_price_rule"
        role="button" style="margin-bottom:12px;"> Add Price Rule</a> -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i>View Price Rule</h3>
          </div>
          <div class="panel panel-default">

            <?php if (!empty($this->session->flashdata('smessage'))) { ?>
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                <?php echo $this->session->flashdata('smessage'); ?>
              </div>
            <?php }
            if (!empty($this->session->flashdata('emessage'))) { ?>
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                <?php echo $this->session->flashdata('emessage'); ?>
              </div>
            <?php } ?>


            <div class="panel-body">
              <div class="box-body table-responsive no-padding">
                <table class="table table-bordered table-hover table-striped" id="userTable">
                  <thead>
                    <tr>
                      <th>#</th>

                      <th>Retail Multiplier</th>
                      <th>Tier1- Variable(a)</th>
                      <th>Tier1- Variable(b)</th>
                      <th>Tier1- Variable(c)</th>
                      <th>Tier2- Variable(m)</th>
                      <th>Tier2- Variable(b)</th>



                      <!-- <th>Status</th> -->
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1;
                    foreach ($price_rule_data->result() as $data) { ?>
                      <tr>
                        <td><?php echo $i ?> </td>

                        <td><?php echo $data->multiplier ?></td>
                        <td><?php echo $data->cost_price1 ?></td>
                        <td><?php echo $data->cost_price2 ?></td>
                        <td><?php echo $data->cost_price3 ?></td>
                        <td><?php echo $data->cost_price4 ?></td>
                        <td><?php echo $data->cost_price5 ?></td>





                        <!-- <td><?php if ($data->is_active == 1) { ?>
        <p class="label bg-green" >Active</p>

        <?php } else { ?>
        <p class="label bg-yellow" >Inactive</p>


        <?php } ?>
        </td> -->
                        <td>
                          <div class="btn-group" id="btns<?php echo $i ?>">
                            <div class="btn-group">
                              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                Action <span class="caret"></span></button>
                              <ul class="dropdown-menu" role="menu">

                                <!-- <?php if ($data->is_active == 1) { ?>
        <li><a href="<?php echo base_url() ?>dcadmin/price_rule/updateprice_ruleStatus/<?php echo
                                                                                        base64_encode($data->id) ?>/inactive">Inactive</a></li>
        <?php } else { ?>
        <li><a href="<?php echo base_url() ?>dcadmin/price_rule/updateprice_ruleStatus/<?php echo
                                                                                        base64_encode($data->id) ?>/active">Active</a></li>
        <?php } ?> -->
                                <li><a href="<?php echo base_url() ?>dcadmin/price_rule/update_price_rule/<?php echo
                                                                                                          base64_encode($data->id) ?>">Edit</a></li>
                                <!-- <li><a href="javascript:;" class="dCnf" mydata="<?php echo $i ?>">Delete</a></li> -->
                              </ul>
                            </div>
                          </div>

                          <div style="display:none" id="cnfbox<?php echo $i ?>">
                            <p> Are you sure delete this </p>
                            <a href="<?php echo base_url() ?>dcadmin/price_rule/delete_price_rule/<?php echo
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