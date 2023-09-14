<div class="content-wrapper">
    <section class="content-header">
        <h1>
            View Cron Jobs
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> View Cron Jobs</h3>
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
                                            <th>CAT Level 1</th>
                                            <th>SUBCAT Level 2</th>
                                            <th>SUBCAT Level 3</th>
                                            <th>SUBCAT Level 4</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($cron_jobs->result() as $data) { ?>
                                            <tr>
                                                <td><?php echo $i ?> </td>
                                                <td><?php
                                                    $this->db->select('*');
                                                    $this->db->from('tbl_category');
                                                    $this->db->where('id', $data->cat_id);
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
                                                    $this->db->where('id', $data->subcat_id);
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
                                                    $this->db->where('id', $data->mincat_id1);
                                                    $this->db->where('is_active', 1);
                                                    $minorsubcategory = $this->db->get()->row();

                                                    if (!empty($minorsubcategory)) {
                                                        echo $minorsubcategory->name;
                                                    } else {
                                                        echo "-";
                                                    }

                                                    ?></td>
                                                <td><?php

                                                    $this->db->select('*');
                                                    $this->db->from('tbl_minisubcategory2');
                                                    $this->db->where('id', $data->mincat_id2);
                                                    $this->db->where('is_active', 1);
                                                    $minorsubcategory2 = $this->db->get()->row();

                                                    if (!empty($minorsubcategory2)) {
                                                        echo $minorsubcategory2->name;
                                                    } else {
                                                        echo "-";
                                                    }

                                                    ?></td>



                                                <td><?php if ($data->status == 0) { ?>
                                                        <p class="label bg-red">Pending</p>

                                                    <?php } else if ($data->status == 1) { ?>
                                                        <p class="label bg-yellow">Running</p>
                                                    <?php } else { ?>
                                                        <p class="label bg-green">Completed</p>
                                                    <? } ?>
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