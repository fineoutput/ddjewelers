
        <div class="content-wrapper">
        <section class="content-header">
        <h1>
          View Ask Questions
        </h1>
        </section>
        <section class="content">
        <div class="row">
        <div class="col-lg-12">
        <div class="panel panel-default">
        <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-money fa-fw"></i>View Ask Questions</h3>
        </div>
        <div class="panel panel-default">

        <? if(!empty($this->session->flashdata('smessage'))){ ?>
        <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Alert!</h4>
        <? echo $this->session->flashdata('smessage');
        $this->session->unset_userdata('smessage');?>
        </div>
        <? }
        if(!empty($this->session->flashdata('emessage'))){ ?>
        <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
        <? echo $this->session->flashdata('emessage');
        $this->session->unset_userdata('emessage'); ?>
        </div>
        <? } ?>


        <div class="panel-body">
        <div class="box-body table-responsive no-padding">
        <table class="table table-bordered table-hover table-striped" id="userTable">
        <thead>
        <tr>
        <th>#</th>

 	 <th>Name</th>
 	 <th>Email</th>
 	 <th>Phone</th>
 	 <th>Question</th>
 	 <th>Product</th>
 	 <th>Date</th>


        <!-- <th>Status</th>
        <th>Action</th> -->
        </tr>
        </thead>
        <tbody>
        <?php $i=1; foreach($ask_ques_data->result() as $data) { ?>
        <tr>
        <td><?php echo $i ?> </td>

 	 <td><?php echo $data->name ?></td>
 	 <td><?php echo $data->email ?></td>
 	 <td><?php echo $data->phone ?></td>
 	 <td><?php echo $data->query ?></td>
 	 <td>
     <?php
            $this->db->select('*');
$this->db->from('tbl_products');
$this->db->where('id',$data->product_id);
$pro_data= $this->db->get()->row();

if(!empty($pro_data)){
  echo $pro_data->description;
}else{
  echo "";
}

      ?>
   </td>
 	 <td>
     <?php
     $newdate = new DateTime($data->date);
     echo $newdate->format('j F, Y, g:i a');   #d-m-Y  // March 10, 2001, 5:16 pm
      ?>
   </td>





        <!-- <td><?php if($data->is_active==1){ ?>
        <p class="label bg-green" >Active</p>

        <?php } else { ?>
        <p class="label bg-yellow" >Inactive</p>


        <?php } ?>
        </td> -->
        <!-- <td> -->
        <!-- <div class="btn-group" id="btns<?php echo $i ?>">
        <div class="btn-group">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        Action <span class="caret"></span></button> -->
        <!-- <ul class="dropdown-menu" role="menu">

        <?php if($data->is_active==1){ ?>
        <li><a href="<?php echo base_url() ?>dcadmin/contact_us/updatecontact_usStatus/<?php echo
        base64_encode($data->id) ?>/inactive">Inactive</a></li>
        <?php } else { ?>
        <li><a href="<?php echo base_url() ?>dcadmin/contact_us/updatecontact_usStatus/<?php echo
        base64_encode($data->id) ?>/active">Active</a></li>
        <?php } ?>
        <li><a href="<?php echo base_url() ?>dcadmin/contact_us/update_contact_us/<?php echo
        base64_encode($data->id) ?>">Edit</a></li>
        <li><a href="javascript:;" class="dCnf" mydata="<?php echo $i ?>">Delete</a></li>
        </ul> -->
        <!-- </div>
        </div> -->

        <!-- <div style="display:none" id="cnfbox<?php echo $i ?>">
        <p> Are you sure delete this </p>
        <a href="<?php echo base_url() ?>dcadmin/contact_us/delete_contact_us/<?php echo
        base64_encode($data->id); ?>" class="btn btn-danger" >Yes</a>
        <a href="javasript:;" class="cans btn btn-default" mydatas="<?php echo $i ?>" >No</a>
        </div> -->
        <!-- </td> -->
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
