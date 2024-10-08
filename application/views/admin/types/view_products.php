
        <div class="content-wrapper">
        <section class="content-header">
        <h1>
          View Products
        </h1>
        </section>
        <section class="content">
        <div class="row">
        <div class="col-lg-12">
        <div class="panel panel-default">
        <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-money fa-fw"></i>View products</h3>
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

 	 <th>Product name</th>
 	 <th>Category</th>
 	 <th>Sub-Category</th>


        <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php $i=1; foreach($products_data->result() as $data) { ?>
        <tr>
        <td><?php echo $i ?> </td>

 	 <td><?php echo $data->description ?></td>
   <?$category= $data->category;
   $sub_category= $data->sub_category;

   $this->db->select('*');
   $this->db->from('tbl_category');
   $this->db->where('id',$category);
   $data1= $this->db->get()->row();

   $this->db->select('*');
   $this->db->from('tbl_sub_category');
   $this->db->where('id',$sub_category);
   $data2= $this->db->get()->row();
   ?>

   <td><?php echo $data1->name ?></td>
 	 <td><?php echo $data2->name ?></td>


        <td>
        <div class="btn-group" id="btns<?php echo $i ?>">
        <div class="btn-group">
        <a href="<?php echo base_url() ?>dcadmin/Types/view_product_types/<?php echo
        base64_encode($data->product_id) ?>" type="button" class="btn btn-default">View Types</a>

        </div>
        </div>

        <div style="display:none" id="cnfbox<?php echo $i ?>">
        <p> Are you sure delete this </p>
        <a href="<?php echo base_url() ?>dcadmin/products/delete_products/<?php echo
        base64_encode($data->id); ?>" class="btn btn-danger" >Yes</a>
        <a href="javasript:;" class="cans btn btn-default" mydatas="<?php echo $i ?>" >No</a>
        </div>
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
