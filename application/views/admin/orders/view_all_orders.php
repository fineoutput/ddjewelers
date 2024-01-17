<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <?= $page_title ?>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url() ?>dcadmin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>

      <li class="active"> <?= $page_title ?></li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-lg-12">

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

          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> <?= $page_title ?></h3>
          </div>
          <div class="panel panel-default">
            <div class="panel-body">
              <div class="box-body table-responsive no-padding">
                <table class="table table-bordered table-hover table-striped" id="printTable">
                  <thead>
                    <tr>
                      <th>#</th>

                      <th>User</th>
                      <th>Total Amount</th>
                      <!-- <th>Promocode</th> -->

                      <th>User Address</th>
                      <th>Address Name</th>

                      <th>User Email</th>
                      <th>Payment From</th>

                      <th>Order Status</th>
                      <!-- <th>Order Track Id</th> -->
                      <th>Rejected By</th>

                      <th>Last Update Date</th>
                      <th>Order Date</th>
                      <!-- <th>Order Products</th> -->


                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php $i = 1;
                    foreach ($orders_data->result() as $data) {
                      $this->db->select('*');
                      $this->db->from('tbl_user_address');
                      $this->db->where('id', $data->address_id);
                      $addr_da = $this->db->get()->row();

                      if (!empty($addr_da)) {
                        $address = $addr_da->address;
                        if (!empty($addr_da->country_id)) {
                          $country_data1 = $this->db->get_where('tbl_country', array('id' => $addr_da->country_id))->result();
                          $country = $country_data1[0]->name;
                        } else {
                          $country = '';
                        }
                        if (!empty($addr_da->state_id)) {
                          $state_data = $this->db->get_where('tbl_state', array('id' => $addr_da->state_id))->result();
                          if (!empty($state_data)) {

                            $state_name = $state_data[0]->name;
                          } else {
                            $state_name = '';
                          }
                        } else {
                          $state_name = '';
                        }
                        $uname = $addr_da->first_name . ' ' . $addr_da->last_name;
                        $state = $state_name;
                        $city = $addr_da->city;
                        $zip = $addr_da->zipcode;
                      } else {
                        $uname = '';
                        $address = "";
                        $state = "";
                        $city = "";
                        $zip = "";
                        $country = "";
                        $notes = '';
                      }

                    ?>
                      <tr>
                        <td><?php echo $i ?> </td>

                        <td>
                          <?php $this->db->select('*');
                          $this->db->from('tbl_users');
                          $this->db->where('id', $data->user_id);
                          $user_dsa = $this->db->get()->row();
                          if (!empty($user_dsa)) { ?>

                            <?php
                            echo $user_dsa->name;
                            ?>
                          <?php  } else {
                            echo "N/A";
                            $email = "N/A";
                          }
                          ?></td>
                        <td>$<?php
                            echo $data->final_amount;
                            // echo $data->sub_total;

                            ?></td>
                        <!-- <td><?php

                                  $this->db->select('*');
                                  $this->db->from('tbl_promocode');
                                  $this->db->where('id', $data->promocode);
                                  $da = $this->db->get()->row();
                                  if (!empty($da)) {
                                    $name = $da->promocode;
                                  } else {
                                    $name = "";
                                  }

                                  if (!empty($data->promocode)) {
                                    echo $name;
                                  } else {
                                    echo "No Promocode";
                                  }


                                  ?></td> -->

                        <!-- <td>

        <?php
                      //  $promocode_name= "";
                      //
                      //  $this->db->select('*');
                      //  $this->db->from('tbl_promocode_applied');
                      //  $this->db->where('order_id',$data->id);
                      //  $this->db->where('user_id',$data->user_id);
                      //  $order_promocode= $this->db->get()->row();
                      //
                      //  if(!empty($order_promocode)){
                      //  $this->db->select('*');
                      //  $this->db->from('tbl_promocode');
                      //  $this->db->where('id',$order_promocode->promocode_id);
                      //  $order_promocode= $this->db->get()->row();
                      //   if(!empty($order_promocode)){
                      //  $promocode_name= $order_promocode->promocode;
                      //   }
                      //   else{
                      //     $promocode_name= "";
                      //   }
                      //
                      // }
                      // else{
                      //      $promocode_name= "";
                      // }
                      //
                      //
                      // 
        ?>
        //
        // <?php //if(!empty($promocode_name)){
                      //    echo $promocode_name;
                      //   }else{
                      //       echo "No Promocode";
                      //   } 
            ?>
    </td> -->

                        <td><?php
                            echo $address . ',' . $state . ',' . $city . ',' . $zip . ',' . $country;
                            ?></td>


                        <td><? echo $uname; ?></td>
                        <td>
                          <?php $this->db->select('*');
                          $this->db->from('tbl_users');
                          $this->db->where('id', $data->user_id);
                          $user_dsas = $this->db->get()->row();
                          if (!empty($user_dsas)) { ?>

                            <?php
                            $email = $user_dsas->email;
                            echo $email;
                            ?>
                          <?php  } else {
                            echo "N/A";
                          }
                          ?></td>








                        <td><?=$data->payment_type?></td>
                        <!-- <td><?php if ($data->payment_status == 0) {
                                  ?><span class="label label-warning" style="font-size:13px;">Pending</span><?php
                                                                                                          }
                                                                                                          if ($data->payment_status == 1) {
                                                                                                            ?><span class="label label-success" style="font-size:13px;">Succeed</span><?php
                                                                                                                                                        }
                                                                                                                                                          ?></td> -->

                        <!-- <td>
       <?
                      // $d_newdate = new DateTime($data->delivery_date);
                      // echo $d_newdate->format('j F, Y');   #d-m-Y  // March 10, 2001, 5:16 pm
        ?>
        </td> -->

                        <td><?php
                            if ($data->order_status == 1) {
                            ?><span class="label label-primary" style="font-size:13px;">New Order</span><?php
                                                                                                      }
                                                                                                      if ($data->order_status == 2) {
                                                                                                        ?><span class="label label-success" style="font-size:13px;">Accepted</span><?php
                                                                                                                                                        }
                                                                                                                                                        if ($data->order_status == 3) {
                                                                                                                                                          ?>
                            <span class="label label-info" style="font-size:13px;">Dispatched</span>
                          <?php
                                                                                                                                                        }
                                                                                                                                                        if ($data->order_status == 4) {
                          ?><span class="label label-success" style="font-size:13px;">Delivered</span><?php
                                                                                                                                                        }
                                                                                                                                                        if ($data->order_status == 5) {
                                                                                                      ?><span class="label label-danger" style="font-size:13px;">Rejected</span><?php
                                                                                                                                                        }
                                                                                                                                                        ?>
                        </td>


                        <!-- <td>

-
</td> -->


                        <td>
                          <?php
                          $rejected_by = $data->rejected_by;
                          $rejected_by_id = $data->rejected_by_id;

                          if (!empty($rejected_by)) {
                            if ($rejected_by == 1) {
                              $this->db->select('*');
                              $this->db->from('tbl_users');
                              $this->db->where('id', $data->rejected_by_id);
                              $this->db->where('is_active', 1);
                              $usrdata = $this->db->get()->row();

                              if (!empty($usrdata)) {
                                echo "User(" . $usrdata->name . ")";
                              } else {
                                echo "-";
                              }
                            }
                            if ($rejected_by == 2) {

                              $this->db->select('*');
                              $this->db->from('tbl_team');
                              $this->db->where('id', $data->rejected_by_id);
                              $this->db->where('is_active', 1);
                              $teamdata = $this->db->get()->row();

                              if (!empty($teamdata)) {
                                if ($teamdata->power == 1) {
                                  echo "SuperAdmin(" . $teamdata->name . ")";
                                } elseif ($teamdata->power == 2) {
                                  echo "Admin(" . $teamdata->name . ")";
                                } else {
                                  echo "Manager(" . $teamdata->name . ")";
                                };
                              } else {
                                echo "-";
                              }
                            }
                          } else {
                            echo "-";
                          }
                          ?>
                        </td>

                        <td>
                          <?
                          $newdate = new DateTime($data->last_update_date);
                          echo $newdate->format('j F, Y, g:i a');   #d-m-Y  // March 10, 2001, 5:16 pm
                          ?>
                        </td>

                        <td>
                          <?
                          $newdate = new DateTime($data->date);
                          echo $newdate->format('j F, Y, g:i a');   #d-m-Y  // March 10, 2001, 5:16 pm
                          ?>
                        </td>






                        <td>
                          <div class="btn-group" id="btns<?php echo $i ?>">
                            <div class="btn-group">
                              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                Action <span class="caret"></span></button>
                              <ul class="dropdown-menu" role="menu">

                                <?php if ($data->order_status == 1) { ?>
                                  <li><a href="<?php echo base_url() ?>dcadmin/OrdersNew/updateordersStatus/<?php echo
                                                                                                            base64_encode($data->id) ?>/<?= base64_encode(2) ?>">Accept Order Confirm</a></li>
                                  <li><a href="<?php echo base_url() ?>dcadmin/OrdersNew/updateordersStatus/<?php echo
                                                                                                            base64_encode($data->id) ?>/<?= base64_encode(5) ?>">Reject</a></li>
                                <?php } ?>
                                <?php if ($data->order_status == 2) { ?>

                                  <li><a href="<?php echo base_url() ?>dcadmin/OrdersNew/updateordersStatus/<?php echo
                                                                                                            base64_encode($data->id) ?>/<?= base64_encode(3) ?>">Dispatch Order</a></li>
                                <?php } ?>
                                <?php if ($data->order_status == 3) { ?>
                                  <li><a href="<?php echo base_url() ?>dcadmin/OrdersNew/updateordersStatus/<?php echo
                                                                                                            base64_encode($data->id) ?>/<?= base64_encode(4) ?>">Deliver Order</a></li>
                                <?php } ?>

                                <li><a href="<?php echo base_url() ?>dcadmin/OrdersNew/view_ordered_product_details/<?php echo
                                                                                                                    base64_encode($data->id) ?>">View Products</a></li>
                                <li><a href="<?php echo base_url() ?>dcadmin/OrdersNew/view_order_bill/<?php echo
                                                                                                        base64_encode($data->id) ?>">view bill</a></li>

                                <!-- <li><a href="<?php echo base_url() ?>dcadmin/OrdersNew/view_order_bill/<?php echo
                                                                                                            base64_encode($data->id) ?>">View Bill</a></li> -->

                                <!-- <li><a href="<?php echo base_url() ?>dcadmin/OrdersNew/view_delivery_challan/<?php echo
                                                                                                                  base64_encode($data->id) ?>">View Delivery Challan</a></li> -->

                                <!-- <?php if (empty($data->track_id)) { ?>
		<li><a href="<?php echo base_url() ?>dcadmin/OrdersNew/add_track_order_view/<?php echo
                                                                                base64_encode($data->id) ?>">Track Order</a></li>
<?php } else { ?>
	<li><a href="<?php echo base_url() ?>dcadmin/OrdersNew/update_track_order_view/<?php echo
                                                                                  base64_encode($data->id) ?>">Update Track Order</a></li>
<?php } ?> -->

                              </ul>
                            </div>
                          </div>

                          <div style="display:none" id="cnfbox<?php echo $i ?>">
                            <p> Are you sure delete this </p>
                            <a href="<?php echo base_url() ?>dcadmin/OrdersNew/delete_orders/<?php echo
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


<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>

<script type="text/javascript">
  // buttons: [
  //     'copy', 'csv', 'excel', 'pdf', 'print'
  // ]
  $(document).ready(function() {
    $('#printTable').DataTable({
      responsive: true,
      "bStateSave": true,
      "fnStateSave": function(oSettings, oData) {
        localStorage.setItem('offersDataTables', JSON.stringify(oData));
      },
      "fnStateLoad": function(oSettings) {
        return JSON.parse(localStorage.getItem('offersDataTables'));
      },
      dom: 'Bfrtip',
      buttons: [{
          extend: 'copyHtml5',
          exportOptions: {
            columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10] //number of columns, excluding # column
          }
        },
        {
          extend: 'csvHtml5',
          exportOptions: {
            columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
          }
        },
        {
          extend: 'excelHtml5',
          exportOptions: {
            columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
          }
        },
        {
          extend: 'pdfHtml5',
          exportOptions: {
            columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
          }
        },
        {
          extend: 'print',
          exportOptions: {
            columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
          }
        },

      ]


    });
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