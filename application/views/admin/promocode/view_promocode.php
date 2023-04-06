<div class="content-wrapper">
<section class="content-header">
<h1>
Discount Codes
</h1>
<ol class="breadcrumb">
<li><a href="<?php echo base_url() ?>dcadmin/Home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
<li><a href="<?php echo base_url() ?>dcadmin/Promocode/view_promocode"><i class="fa fa-undo" aria-hidden="true"></i>  Discount Codes </a></li>
<!-- <li class="active"></li> -->
</ol>
</section>
<section class="content">
<div class="row">
<div class="col-lg-12">
  <?if($this->session->userdata('position')!='Manager'){?>
<a class="btn custom_btn" href="<?php echo base_url() ?>dcadmin/Promocode/add_promocode" role="button" style="margin-bottom:12px;">Discount Codes</a>
<?}?>
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title"><i class="fa fa-money fa-fw"></i>Discount Codes</h3>
</div>
<div class="panel panel-default">

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
  <div class="box-body table-responsive no-padding">
    <table class="table table-bordered table-hover table-striped" id="userTable">
      <thead>
        <tr>
          <th>#</th>
          <th>Code</th>
          <th>Name</th>
          <th>Value</th>
          <th>Number Of Allowed Uses</th>
          <th>Number Of Times Already Used</th>
          <th>Type</th>
          <th>Apply Discount To</th>
          <th>Series IDs/Categories</th>
          <th>Minimum Purchase</th>
        <th>Vaild From</th>
          <th>Vaild Until</th>
          <th>Status</th>
          <?if($this->session->userdata('position')!='Manager'){?>
            <th>Action</th>
            <?}?>
        </tr>
      </thead>
      <tbody>
        <?php $i=1; foreach ($promocode_data->result() as $data) { ?>
        <tr>
          <td><?php echo $i ?> </td>
          <td><?php echo $data->name ?></td>
            <td><?php echo $data->description ?></td>
            <td><?php if($data->type==1){echo $data->percentage_amount.'%';}else{echo '$'.$data->percentage_amount;} ?></td>
            <td><?php echo $data->allowed_uses ?></td>
            <td></td>
          <td><?php if($data->type==1){
                  echo "Percentage off";
                }else{
                  echo "Fixed Amount(excludes tax and shipping)";
                } ?></td>

                <td><?php if($data->ptype==1){
                        echo "Entire";
                      }elseif($data->ptype==2){
                        echo "Speicifc Item";
                      }else {
                            echo "Speicifc Category";
                      } ?></td>
                      <td><?php if($data->ptype==1){ echo 'NA';}
                      else if($data->ptype==2) {
                        echo json_decode($data->ids);
                      }else{
                        $ids_arr = json_decode($data->ids);
                        $category='';
                        if(is_array($ids_arr)){
                            foreach ($ids_arr as $cat) {
                            $category_data = $this->db->get_where('tbl_category', array('id'=> $cat))->result(); 
                            if(empty($category)){
                               $category = $category_data[0]->name;
                            }else{
                            $category = $category.', '.$category_data[0]->name;
                            }
                            }
                           }else{
                            $category_data = $this->db->get_where('tbl_country', array('id'=> $ids_arr))->result(); 
                            $category = $category_data[0]->name;
                           }
                           echo $category;
                      } ?></td>

          <td>$<?php echo $data->minpurchase ?></td>
  <td>
<?
  $newdate = new DateTime($data->vaild_form);
  echo $newdate->format('d-m-Y');   #d-m-Y  // March 10, 2001, 5:16 pm
  ?>
</td>
  <td>
<?
  $newdate = new DateTime($data->vaild_until);
  echo $newdate->format('d-m-Y');   #d-m-Y  // March 10, 2001, 5:16 pm
  ?>
</td>

          <td><?php if ($data->is_active==1) { ?>
            <p class="label bg-green">Active</p>

            <?php } else { ?>
            <p class="label bg-yellow">Inactive</p>


            <?php		}   ?>
          </td>
          <?if($this->session->userdata('position')!='Manager'){?>
          <td>
            <div class="btn-group" id="btns<?php echo $i ?>">
              <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> Action <span class="caret"></span></button>
                <ul class="dropdown-menu" role="menu">

                  <?php if ($data->is_active==1) { ?>
                  <li><a href="<?php echo base_url() ?>dcadmin/Promocode/updatepromocodeStatus/<?php echo base64_encode($data->id) ?>/inactive">Inactive</a></li>
                  <?php } else { ?>
                  <li><a href="<?php echo base_url() ?>dcadmin/Promocode/updatepromocodeStatus/<?php echo base64_encode($data->id) ?>/active">Active</a></li>
                  <?php		}   ?>
                  <li><a href="<?php echo base_url() ?>dcadmin/Promocode/update_promocode/<?php echo base64_encode($data->id) ?>">Edit</a></li>
                    <?if($this->session->userdata('position')=='Super Admin'){?>
                  <li><a href="javascript:;" class="dCnf" mydata="<?php echo $i ?>">Delete</a></li>
                  <?}?>
                </ul>
              </div>
            </div>

            <div style="display:none" id="cnfbox<?php echo $i ?>">
              <p> Are you sure delete this </p>
              <a href="<?php echo base_url() ?>dcadmin/Promocode/delete_promocode/<?php echo base64_encode($data->id); ?>" class="btn btn-danger">Yes</a>
              <a href="javasript:;" class="cans btn btn-default" mydatas="<?php echo $i ?>">No</a>
            </div>
          </td>
          <?}?>
        </tr>
        <?php $i++; } ?>
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
<!-- <script type="text/javascript" src="<?php echo base_url() ?>assets/slider/ajaxupload.3.5.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/slider/rs.js"></script>	  -->
