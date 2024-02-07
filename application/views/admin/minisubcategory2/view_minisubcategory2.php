<div class="content-wrapper">
  <section class="content-header">
    <h1>
      View Sub-Category (Level 4)
    </h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12">
        <a class="btn custom_btn" href="<?php echo base_url() ?>dcadmin/minisubcategory2/add_minisubcategory2" role="button" style="margin-bottom:12px;"> Add Sub-Category </a>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i>View Sub-Category (Level 4)</h3>
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

                      <th>Seq #</th>
                      <th>CAT Level 1</th>
                      <th>SUBCAT Level 2</th>
                      <th>SUBCAT Level 3</th>
                      <th>SUBCAT Level 4</th>
                      <th>Type</th>
                      <th>Image</th>
                      <th>Banner</th>
                      <!-- <th>Api Id</th>
      <th>Excluded Series</th>
      <th>Excluded Sku</th>
      <th>Include Series</th>
      <th>Include Sku</th> -->
                      <!-- <th>Description</th> -->



                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1;
                    foreach ($minisubcategory2_data->result() as $data) { ?>
                      <tr>
                        <td><?php echo $i ?> </td>
                        <td><?php echo $data->seq ?></td>

                        <td><?php

                            $this->db->select('*');
                            $this->db->from('tbl_category');
                            $this->db->where('id', $data->category);
                            $this->db->where('is_active', 1);
                            $category = $this->db->get()->row();

                            if (!empty($category)) {
                              echo $category->name;
                            } else {
                              echo "-";
                            }


                            ?></td>
                        <td><?php

                            $this->db->select('*');
                            $this->db->from('tbl_sub_category');
                            $this->db->where('id', $data->subcategory);
                            $this->db->where('is_active', 1);
                            $subcategory = $this->db->get()->row();

                            if (!empty($subcategory)) {
                              echo $subcategory->name;
                            } else {
                              echo "-";
                            }

                            ?></td>

                        <td><?php

                            $this->db->select('*');
                            $this->db->from('tbl_minisubcategory');
                            $this->db->where('id', $data->minorsubcategory);
                            $this->db->where('is_active', 1);
                            $minorsubcategory = $this->db->get()->row();

                            if (!empty($minorsubcategory)) {
                              echo $minorsubcategory->name;
                            } else {
                              echo "-";
                            }

                            ?></td>

                        <td><?php echo $data->name ?></td>
                        <td style="max-width: 150px;overflow-wrap: break-word;"><?php
                                                                                if ($data->type == 1) {
                                                                                  echo "Category ID";
                                                                                } else if ($data->type == 2) {
                                                                                  echo "Series No.";
                                                                                } else if ($data->type == 3) {
                                                                                  echo "SKU";
                                                                                } else {
                                                                                  echo "None";
                                                                                }
                                                                                ?></td>
                        <td>
                          <?php if ($data->image != "") { ?>
                            <img id="slide_img_path" height=50 width=100 src="<?php echo base_url() . $data->image
                                                                              ?>">
                          <?php } else { ?>
                            Sorry No File Found
                          <?php } ?>
                        </td>
                        <td>
                          <?php if ($data->banner != "") { ?>
                            <img id="slide_img_path" height=50 width=100 src="<?php echo base_url() ?>/<? echo $data->banner; ?>">
                          <?php } else { ?>
                            Sorry No File Found
                          <?php } ?>
                        </td>

                        <!-- <td style="max-width: 150px;overflow-wrap: break-word;"><?php
                                                                                      echo $data->api_id; ?></td>
<td><?php echo $data->exlude_series ?></td>
<td><?php echo $data->exlude_sku ?></td>
<td><?php echo $data->include_series ?></td>
<td><?php echo $data->include_sku ?></td> -->
                        <!-- <td><?php echo $data->description ?></td> -->





                        <td><?php if ($data->is_active == 1) { ?>
                            <p class="label bg-green">Active</p>

                          <?php } else { ?>
                            <p class="label bg-yellow">Inactive</p>


                          <?php } ?>
                        </td>
                        <td>
                          <div class="btn-group" id="btns<?php echo $i ?>">
                            <div class="btn-group">
                              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                Action <span class="caret"></span></button>
                              <ul class="dropdown-menu" role="menu">

                                <?php if ($data->is_active == 1) { ?>
                                  <li><a href="<?php echo base_url() ?>dcadmin/minisubcategory2/updateminisubcategory2Status/<?php echo
                                                                                                                              base64_encode($data->id) ?>/inactive">Inactive</a></li>
                                <?php } else { ?>
                                  <li><a href="<?php echo base_url() ?>dcadmin/minisubcategory2/updateminisubcategory2Status/<?php echo
                                                                                                                              base64_encode($data->id) ?>/active">Active</a></li>
                                <?php } ?>
                                <li><a href="<?php echo base_url() ?>dcadmin/minisubcategory2/update_minisubcategory2/<?php echo
                                                                                                                      base64_encode($data->id) ?>">Edit</a></li>
                                <li><a href="javascript:;" class="dCnf" mydata="<?php echo $i ?>">Delete</a></li>
                              </ul>
                            </div>
                          </div>

                          <div style="display:none" id="cnfbox<?php echo $i ?>">
                            <p> Are you sure delete this </p>
                            <a href="<?php echo base_url() ?>dcadmin/minisubcategory2/delete_minisubcategory2/<?php echo
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