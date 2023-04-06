<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<style>
    .bootstrap-select > .dropdown-toggle {
        height:100%;
    }
</style>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Discount Codes
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url() ?>dcadmin/Home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="<?php echo base_url() ?>dcadmin/Promocode/view_promocode"><i class="fa fa-undo" aria-hidden="true"></i>Discount Codes </a></li>

    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12">

        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Discount Codes</h3>
          </div>

          <?php if (!empty($this->session->flashdata('smessage'))) { ?>
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Alert!</h4>
            <?php echo $this->session->flashdata('smessage'); ?>
          </div>
          <?php }
             if (!empty($this->session->flashdata('emessage'))) { ?>
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
            <?php echo $this->session->flashdata('emessage'); ?>
          </div>
          <?php } ?>


          <div class="panel-body">
            <div class="col-lg-10">
              <form action="<?php echo base_url() ?>dcadmin/Promocode/add_promocode_data/<?php echo base64_encode(2); ?>/<?=$id?>" method="POST" id="slide_frm" enctype="multipart/form-data">
                <div class="table-responsive">
                  <table class="table table-hover">

                    <tr>
                    <td> <strong>Name</strong> <span style="color:red;">*</span></strong> </td>
                    <td>
                    <input type="text" name="description" class="form-control" placeholder="" required value="<?=$promocode->description?>" />
                    </td>
                    </tr>
                    <tr>
                      <tr>
                        <td> <strong>Type</strong> <span style="color:red;">*</span></strong> </td>
                        <td>
                            <input type="radio" id="percentage" name="type" value="1" <?php if ($promocode->type==1) {
                   echo "checked";
               }?> onclick="change(1)">
                          <label for="percentage">Percentage Off</label>
                            <input type="radio" id="amount" name="type" value="2" <?php if ($promocode->type==2) {
                   echo "checked";
               }?> onclick="change(2)">
                          <label for="amount">Fixed Amount(excludes tax and shipping)</label>
                        </td>
                      </tr>
                                    <tr id="change">
                                      <td> <strong>Percentage</strong> <span style="color:red;">*</span></strong> </td>
                                      <td>
                                        <input type="text" name="percentage_amount" class="form-control" placeholder="" required value="<?=$promocode->percentage_amount?>" onkeypress="return isNumberKey(event)" />
                                      </td>
                                    </tr>
                    <tr>
                    <td> <strong>Code</strong> <span style="color:red;">*</span></strong> </td>
                    <td>
                    <input type="text" name="name" class="form-control" placeholder="" required value="<?=$promocode->name?>" />

                    </td>
                    </tr>


                    <tr>
                    <td> <strong>Number Of Allowed Uses</strong> <span style="color:red;">*</span></strong> </td>
                    <td>
                    <input type="text" name="allowed_uses" class="form-control" placeholder="" required value="<?=$promocode->allowed_uses?>" onkeypress="return isNumberKey(event)"  />
                    </td>
                    </tr>
                    <tr>
                    <td> <strong>Number Of Times Already Used</strong> <span style="color:red;">*</span></strong> </td>
                    <td>
                    <input type="text" name="" class="form-control" readonly
                     placeholder=""  value="" />
                    </td>
                    </tr>




                    <tr>
                    <!-- <tr>
                      <td> <strong>Promocode Type</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <select class="form-control" required name="ptype">
                          <!-- <option value="" selected>select type</option> -->
                          <!-- <option value="1" <?php if ($promocode->ptype==1) {
                 echo "selected";
             }?>>One Time</option>
                          <option value="2" <?php if ($promocode->ptype==2) {
                 echo "selected";
             }?>>Every Time</option>
                        </select>
                      </td> -->
                      <!-- </tr>
  <td> <strong>Gift(%)</strong> <span style="color:red;">*</span></strong> </td>
  <td>
  <input type="number" name="giftpercent" class="form-control" placeholder="" required value="" />
  </td>
  </tr> -->
                    <tr>
                      <td> <strong>Vaild From</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="date" id="vaild_form" name="vaild_form" class="form-control" placeholder="" required value="<?=$promocode->vaild_form?>" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Vaild Until</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="date" id="enddate" name="vaild_until" class="form-control" placeholder="" required value="<?=$promocode->vaild_until?>" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Minimum Purchase</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="minpurchase" class="form-control" placeholder="" required value="<?=$promocode->minpurchase?>" onkeypress="return isNumberKey(event)" />
                      </td>
                    </tr>
                    <tr>
                    <td> <strong>Apply Discount To</strong> <span style="color:red;">*</span></strong> </td>
                    <td>
                      <input type="radio" id="entire" name="ptype" value="1"  <?php if ($promocode->ptype==1) {
                   echo "checked";
               }?>onclick="show(1)" checked> <label for="entire">Entire</label>
                      <input type="radio" id="item" name="ptype" onclick="show(2)" value="2" <?php if ($promocode->ptype==2) {
               echo "checked";
           }?>><label for="item">Speicifc Item</label>
                      <input type="radio" id="spcategory" onclick="show(3)" name="ptype" value="3" <?php if ($promocode->ptype==3) {
                   echo "checked";
               }?>><label for="spcategory">Speicifc Category</label></td>
                    </tr>
                    <tr>
                    <td> <strong id="title"></strong> </td>
                    <td id="value_input">

                    </td>
                    </tr>
                    <!-- <tr id="change2">
                      <?if ($promocode->type==1) {?>
                      <td> <strong>Maximum discount</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="max" class="form-control" placeholder="" required value="<?=$promocode->max?>" onkeypress="return isNumberKey(event)" />
                      </td>
                      <?}?>
                    </tr> -->
                    <tr>
                      <td colspan="2">
                        <input type="submit" class="btn btn-success" value="save">
                      </td>
                    </tr>
                  </table>
                </div>

              </form>
              <div id="cat_op" style="display:none">
<?php $i=1;
$ids_arr = json_decode($promocode->ids);
foreach($cat_data->result() as $data){
    $s = 0;
    if(is_array($ids_arr)){
        foreach ($ids_arr as $value) {
            if ($data->id == $value) {
                $s = 1;
            }
        }
    }
    ?><option value="<?=$data->id?>"  <? if ($s == 1) {
        echo 'selected';
    } ?>><?=$data->name?></option><?php $i++;}?>
</div>
<?if($promocode->ptype==2){?>
              <input type="hidden" id="s_ids" value="<?=json_decode($promocode->ids)?>">
<?}else{?>
    <input type="hidden" id="s_ids" value="">
<?}?>
            </div>



          </div>

        </div>

      </div>
    </div>
  </section>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script type="text/javascript">
  $('select').selectpicker();
</script>
<script>
  function change(x) {
    if (x == 1) {
      $('#change').html('<td><strong>Percentage</strong><span style="color:red;">*</span></strong></td><td><input type="text" name="percentage_amount" class="form-control" placeholder="" required value="<?=$promocode->percentage_amount?>" /></td>');
      $('#change2').html(
        '<td><strong>Maximum discount</strong> <span style="color:red;">*</span></strong> </td><td><input type="text" name="max" class="form-control" placeholder="" required value="<?=$promocode->max?>" onkeypress="return isNumberKey(event)"/></td>'
        );
    } else {
      $('#change').html('<td><strong>Amount</strong><span style="color:red;">*</span></strong></td><td><input type="text" name="percentage_amount" class="form-control" placeholder=""   value="<?=$promocode->percentage_amount?>" /></td>');
      $('#change2').html('');
    }
  }
</script>
<script>
$( document ).ready(function() {
    var x=  $('input[name="ptype"]:checked').val();
    if(x==1){
      $('#title').html('');
      $('#value_input').html('');
    }else if(x==2){
        var vl =$('#s_ids').val();
      $('#title').html('<strong>Item Id</strong> <span style="color:red;">*</span></strong>');
      $('#value_input').html('<input type="text" name="ids" class="form-control" required placeholder=""  value="'+vl+'" />');
    }else if(x==3){
        $('select').selectpicker();
    var op = $('#cat_op').html();
      $('#title').html('<strong>Category Id</strong> <span style="color:red;">*</span></strong>');
      $('#value_input').html('<select class="form-control" required multiple class="chosen-select" name="ids[]" id="category"><option value="">Select Category</option>'+op+'</select>');
  $('select').selectpicker();
    }
});
function show(x){
if(x==1){
  $('#title').html('');
  $('#value_input').html('');
}else if(x==2){
  $('#title').html('<strong>Item Id</strong> <span style="color:red;">*</span></strong>');
  $('#value_input').html('<input type="text" name="ids" class="form-control" required placeholder=""  value="" />');
}else if(x==3){
    $('select').selectpicker();
    var op = $('#cat_op').html();
  $('#title').html('<strong>Category Id</strong> <span style="color:red;">*</span></strong>');
  $('#value_input').html('<select class="form-control" required multiple class="chosen-select" name="ids[]" id="category"><option value="">Select Category</option>'+op+'</select>');
  $('select').selectpicker();
  
}
}
</script>

</script>
<script>
  $(function() {
    var dtToday = new Date();

    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if (month < 10)
      month = '0' + month.toString();
    if (day < 10)
      day = '0' + day.toString();

    var maxDate = year + '-' + month + '-' + day;
    // alert(maxDate);

    $('#vaild_form').attr('min', maxDate);
    $('#vaild_until').attr('min', maxDate);
  });
</script>
</script>
<script>
  function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
      return false;
    return true;
  }
</script>


<script type="text/javascript" src="<?php echo base_url() ?>assets/slider/ajaxupload.3.5.js"></script>
<link href="<?php echo base_url() ?>assets/cowadmin/css/jqvmap.css" rel='stylesheet' type='text/css' />
