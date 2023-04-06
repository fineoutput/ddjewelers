<div class="content-wrapper">
  <section class="content-header">
    <h1>
    Country
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url() ?>dcadmin/Home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="<?php echo base_url() ?>dcadmin/Country/view_country"><i class="fa fa-undo" aria-hidden="true"></i>Country </a></li>

    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12">

        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Country</h3>
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
              <form action="<?php echo base_url() ?>dcadmin/Country/add_country_data/<?php echo base64_encode(2); ?>/<?=$id?>" method="POST" id="slide_frm" enctype="multipart/form-data">
                <div class="table-responsive">
                  <table class="table table-hover">

                    <tr>
                    <td> <strong>Name</strong> <span style="color:red;">*</span></strong> </td>
                    <td>
                    <input type="text" name="name" class="form-control" placeholder="" required value="<?=$country->name?>" />
                    </td>
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
      $('#title').html('<strong>Item Id</strong> <span style="color:red;">*</span></strong>');
      $('#value_input').html('<input type="text" name="ids" class="form-control" required placeholder=""  value="<?=$promocode->ids?>" />');
    }else if(x==3){
      $('#title').html('<strong>Category Id</strong> <span style="color:red;">*</span></strong>');
      $('#value_input').html('<input type="text" name="ids" class="form-control" required placeholder=""  value="<?=$promocode->ids?>" />');
    }
});
function show(x){
if(x==1){
  $('#title').html('');
  $('#value_input').html('');
}else if(x==2){
  $('#title').html('<strong>Item Id</strong> <span style="color:red;">*</span></strong>');
  $('#value_input').html('<input type="text" name="ids" class="form-control" required placeholder=""  value="<?=$promocode->ids?>" />');
}else if(x==3){
  $('#title').html('<strong>Category Id</strong> <span style="color:red;">*</span></strong>');
  $('#value_input').html('<input type="text" name="ids" class="form-control" required placeholder=""  value="<?=$promocode->ids?>" />');
}
}

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
