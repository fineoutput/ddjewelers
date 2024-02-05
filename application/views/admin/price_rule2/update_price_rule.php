<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Update <?= $price_rule_data->name ?> Price Rule
    </h1>

  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12">

        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Update <?= $price_rule_data->name ?> Price Rule </h3>
          </div>

          <?php if (!empty($this->session->flashdata('smessage'))) {  ?>
            <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4><i class="icon fa fa-check"></i> Alert!</h4>
              <?php echo $this->session->flashdata('smessage');  ?>
            </div>
          <?php }
          if (!empty($this->session->flashdata('emessage'))) {  ?>
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4><i class="icon fa fa-ban"></i> Alert!</h4>
              <?php echo $this->session->flashdata('emessage');  ?>
            </div>
          <?php }  ?>


          <div class="panel-body">
            <div class="col-lg-10">
              <form action=" <?php echo base_url(); ?>dcadmin/price_rule2/add_price_rule_data/<?php echo base64_encode(2); ?>/<?= $id; ?>" method="POST" id="slide_frm" enctype="multipart/form-data">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <tr>
                      <td> <strong>Type</strong> <span style="color:red;">*</span></strong> </td>
                      <td style="display:flex"> <input type="radio" id="Simple" name="type" value="1" <? if ($price_rule_data->type == 1) {
                                                                                                        echo "checked";
                                                                                                      } ?>>
                        <label for="Simple">Simple</label><br>
                        <input type="radio" id="type1" name="type" value="2" <? if ($price_rule_data->type == 2) {
                                                                                echo "checked";
                                                                              } ?>>
                        <label for="type1">Tier by Cost</label><br>
                        <input type="radio" id="type2" name="type" value="3" <? if ($price_rule_data->type == 3) {
                                                                                echo "checked";
                                                                              } ?>>
                        <label for="type2">Tier by Weight</label>
                      </td>
                    </tr>
                    <tr id="simple_des">
                      <td> <strong>Markup</strong> <span style="color:red;">*</span></strong> </td>
                      <td> <input type="text" name="s_multiplier" class="form-control" placeholder="" value="<?= $price_rule_data->multiplier1; ?>" /> </td>
                    </tr>
                  </table>
                  <table class="table table-hover" id="cost_des">
                    <tr>
                      <td style="padding-top: 30px">
                        <strong>$</strong>
                      </td>
                      <td>
                        <strong>Cost</strong>
                        <input type="text" name="c_condition1" class="form-control" placeholder="" value="<?= $price_rule_data->condition1; ?>" />
                      </td>
                      <td>
                        <strong>use cost multiplied by</strong>
                        <input type="text" name="c_multiplier1" class="form-control" placeholder="" value="<?= $price_rule_data->multiplier1; ?>" />
                      </td>
                    </tr>
                    <tr>
                      <td style="padding-top: 30px">
                        <strong>$</strong>
                      </td>
                      <td>
                        <strong>Cost</strong>
                        <input type="text" name="c_condition2" class="form-control" placeholder="" value="<?= $price_rule_data->condition2; ?>" />
                      </td>
                      <td>
                        <strong>use cost multiplied by</strong>
                        <input type="text" name="c_multiplier2" class="form-control" placeholder="" value="<?= $price_rule_data->multiplier2; ?>" />
                      </td>
                    </tr>
                    <tr>
                      <td style="padding-top: 30px">
                        <strong>$</strong>
                      </td>
                      <td>
                        <strong>Cost</strong>
                        <input type="text" name="c_condition3" class="form-control" placeholder="" value="<?= $price_rule_data->condition3; ?>" />
                      </td>
                      <td>
                        <strong>use cost multiplied by</strong>
                        <input type="text" name="c_multiplier3" class="form-control" placeholder="" value="<?= $price_rule_data->multiplier3; ?>" />
                      </td>
                    </tr>
                    <tr>
                      <td style="padding-top: 30px">
                        <strong>$</strong>
                      </td>
                      <td>
                        <strong>Cost</strong>
                        <input type="text" name="c_condition4" class="form-control" placeholder="" value="<?= $price_rule_data->condition4; ?>" />
                      </td>
                      <td>
                        <strong>use cost multiplied by</strong>
                        <input type="text" name="c_multiplier4" class="form-control" placeholder="" value="<?= $price_rule_data->multiplier4; ?>" />
                      </td>
                    </tr>
                </div>
                </table>
                <table class="table table-hover" id="weight_des">
                  <tr>
                    <td style="padding-top: 30px">
                      <strong>Ct</strong>
                    </td>
                    <td>
                      <strong>Weight</strong>
                      <input type="text" name="w_condition1" class="form-control" placeholder="" value="<?= $price_rule_data->condition1; ?>" />
                    </td>
                    <td>
                      <strong>use cost multiplied by</strong>
                      <input type="text" name="w_multiplier1" class="form-control" placeholder="" value="<?= $price_rule_data->multiplier1; ?>" />
                    </td>
                  </tr>
                  <tr>
                    <td style="padding-top: 30px">
                      <strong>Ct</strong>
                    </td>
                    <td>
                      <strong>Weight</strong>
                      <input type="text" name="w_condition2" class="form-control" placeholder="" value="<?= $price_rule_data->condition2; ?>" />
                    </td>
                    <td>
                      <strong>use cost multiplied by</strong>
                      <input type="text" name="w_multiplier2" class="form-control" placeholder="" value="<?= $price_rule_data->multiplier2; ?>" />
                    </td>
                  </tr>
                  <tr>
                    <td style="padding-top: 30px">
                      <strong>Ct</strong>
                    </td>
                    <td>
                      <strong>Weight</strong>
                      <input type="text" name="w_condition3" class="form-control" placeholder="" value="<?= $price_rule_data->condition3; ?>" />
                    </td>
                    <td>
                      <strong>use cost multiplied by</strong>
                      <input type="text" name="w_multiplier3" class="form-control" placeholder="" value="<?= $price_rule_data->multiplier3; ?>" />
                    </td>
                  </tr>
                  <tr>
                    <td style="padding-top: 30px">
                      <strong>Ct</strong>
                    </td>
                    <td>
                      <strong>Weight</strong>
                      <input type="text" name="w_condition4" class="form-control" placeholder="" value="<?= $price_rule_data->condition4; ?>" />
                    </td>
                    <td>
                      <strong>use cost multiplied by</strong>
                      <input type="text" name="w_multiplier4" class="form-control" placeholder="" value="<?= $price_rule_data->multiplier4; ?>" />
                    </td>
                  </tr>
            </div>
            </table>
            <table class="table table-hover">
              <tr>
                <td> <strong>Minimum Price</strong> <span style="color:red;">*</span></strong> </td>
                <td> <input type="text" name="mini_price" class="form-control" placeholder="" required value="<?= $price_rule_data->mini_price; ?>" /> </td>
              </tr>
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
<link href=" <?php echo base_url()  ?>assets/cowadmin/css/jqvmap.css" rel='stylesheet' type='text/css' />
<script>
  $(document).ready(function() {
    if (<?= $price_rule_data->type ?> == 1) {
      $('#simple_des').show();
      $('#cost_des').hide();
      $('#weight_des').hide();

    } else if (<?= $price_rule_data->type ?> == 2) {
      $('#simple_des').hide();
      $('#cost_des').show();
      $('#weight_des').hide();
    } else if (<?= $price_rule_data->type ?> == 3) {
      $('#simple_des').hide();
      $('#cost_des').hide();
      $('#weight_des').show();
    }
  });
  $('input[type=radio][name=type]').change(function() {
    if (this.value == 1) {
      $('#simple_des').show();
      $('#cost_des').hide();
      $('#weight_des').hide();
    } else if (this.value == 2) {
      $('#simple_des').hide();
      $('#cost_des').show();
      $('#weight_des').hide();
    } else if (this.value == 3) {
      $('#simple_des').hide();
      $('#cost_des').hide();
      $('#weight_des').show();
    }
  });
</script>