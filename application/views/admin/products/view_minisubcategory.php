
        <div class="content-wrapper">
        <section class="content-header">
        <h1>
          View SubCategory (Level 3)
        </h1>
        </section>
        <section class="content">
        <div class="row">
        <div class="col-lg-12">
<?php

$this->db->select('*');
$this->db->from('tbl_sub_category');
$this->db->where('is_active',1);
$this->db->where('id',base64_decode($subcate_id));
$sub_cate_da= $this->db->get()->row();
if(!empty($sub_cate_da)){
  $cate_id=$sub_cate_da->category;
}else{
  $cate_id= "";
}
?>

        <a class="btn custom_btn" href="<?php echo base_url() ?>dcadmin/products/view_sub_category/<?=base64_encode($cate_id);?>"
        role="button" style="margin-bottom:12px;"> Back</a>
        <div class="panel panel-default">
        <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-money fa-fw"></i>View SubCategory (Level 3)</h3>
        </div>
        <div class="panel panel-default">

        <? if(!empty($this->session->flashdata('smessage'))){ ?>
        <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Alert!</h4>
        <? echo $this->session->flashdata('smessage'); ?>
        </div>
        <? }
        if(!empty($this->session->flashdata('emessage'))){ ?>
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

 	 <th>Category (Level 1)</th>
 	 <th>SubCategory (Level 2)</th>
 	 <th>Name</th>
 	 <th>Image</th>
 	 <th>Api Id</th>


        <th>Status</th>
        <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php $i=1; foreach($minisubcategory_data->result() as $data) { ?>
        <tr>
        <td><?php echo $i ?> </td>

 	 <td><?php

   $this->db->select('*');
   $this->db->from('tbl_category');
   $this->db->where('id',$data->category);
   $this->db->where('is_active',1);
   $category= $this->db->get()->row();

if(!empty($category)){
  echo $category->name;
}else{
  echo "-";
}


    ?></td>
 	 <td><?php

   $this->db->select('*');
   $this->db->from('tbl_sub_category');
   $this->db->where('id',$data->subcategory);
   $this->db->where('is_active',1);
   $subcategory= $this->db->get()->row();

if(!empty($subcategory)){
  echo $subcategory->name;
}else{
  echo "-";
}

    ?></td>
 	 <td><?php echo $data->name ?></td>

        <td>
        <?php if($data->image!=""){ ?>
        <img id="slide_img_path" height=50 width=100 src="<?php echo base_url().$data->image
        ?>" >
        <?php }else { ?>
        Sorry No File Found
        <?php } ?>
        </td>

<td><?php echo $data->api_id ?></td>




        <td><?php if($data->is_active==1){ ?>
        <p class="label bg-green" >Active</p>

        <?php } else { ?>
        <p class="label bg-yellow" >Inactive</p>


        <?php } ?>
        </td>
        <td>
        <div class="btn-group" id="btns<?php echo $i ?>">
        <div class="btn-group">


          <?php
          $this->db->select('*');
      $this->db->from('tbl_minisubcategory2');
      $this->db->where('is_active',1);
      $this->db->where('minorsubcategory',$data->id);
      $minisubcategory2_da= $this->db->get()->row();

      if(!empty($minisubcategory2_da)){ ?>

        <a href="<?php echo base_url() ?>dcadmin/products/view_minisubcategory2/<?php echo
        base64_encode($data->id) ?>">
          <button type="button" class="btn btn-default " >View SubCategory (Level 4) </button>
        </a>

      <?php }else { ?>

        <a href="<?php echo base_url() ?>dcadmin/products/view_products/<?php echo
        base64_encode($data->id) ?>/<?=base64_encode(1);?>">
          <button type="button" class="btn btn-default " >View Products </button>
        </a>

      <?php } ?>





        </div>
        </div>

        <!-- <div style="display:none" id="cnfbox<?php echo $i ?>">
        <p> Are you sure delete this </p>
        <a href="<?php echo base_url() ?>dcadmin/minisubcategory/delete_minisubcategory/<?php echo
        base64_encode($data->id); ?>" class="btn btn-danger" >Yes</a>
        <a href="javasript:;" class="cans btn btn-default" mydatas="<?php echo $i ?>" >No</a>
        </div> -->
        </td>
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
        label{
        margin:5px;
        }
        </style>
        <script src="<?php echo base_url() ?>assets/admin/plugins/datatables/jquery.dataTables.js"></script>
        <script src="<?php echo base_url() ?>assets/admin/plugins/datatables/dataTables.bootstrap.js"></script>
        <script type="text/javascript">

        $(document).ready(function(){

        $(document.body).on('click', '.dCnf', function() {
        var i=$(this).attr("mydata");
        console.log(i);

        $("#btns"+i).hide();
        $("#cnfbox"+i).show();

        });

        $(document.body).on('click', '.cans', function() {
        var i=$(this).attr("mydatas");
        console.log(i);

        $("#btns"+i).show();
        $("#cnfbox"+i).hide();
        })

        });

        </script>
        <!-- <script type="text/javascript" src="<?php echo base_url()
        ?>assets/slider/ajaxupload.3.5.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/slider/rs.js"></script> -->
