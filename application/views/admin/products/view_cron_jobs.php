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
                                            <th>Type</th>
                                            <th>CAT Level 1</th>
                                            <th>SUBCAT Level 2</th>
                                            <th>SUBCAT Level 3</th>
                                            <th>SUBCAT Level 4</th>
                                            <th>Assign Date</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <? if ($dev == 1) { ?>
                                                <th>Total Products</th>
                                                <th>Inserted Products</th>
                                            <? } ?>
                                            <th>Status</th>
                                            <? if ($dev == 1) { ?>
                                                <th>Action</th>
                                            <? } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($cron_jobs->result() as $data) {
                                            if ($data->is_quick == 1) {
                                                $cat_data = $this->db->get_where('tbl_quickshop_category', array('id' => $data->cat_id))->row();
                                                $sub_cat_data = $this->db->get_where('tbl_quickshop_subcategory', array('id' => $data->subcat_id))->row();
                                                $minor_cat_data = $this->db->get_where('tbl_quickshop_minisubcategory', array('id' => $data->mincat_id1))->row();
                                                $minor_cat_data2 = $this->db->get_where('tbl_quickshop_minisubcategory2', array('id' => $data->mincat_id2))->row();
                                            } else {
                                                $cat_data = $this->db->get_where('tbl_category', array('id' => $data->cat_id))->row();
                                                $sub_cat_data = $this->db->get_where('tbl_sub_category', array('id' => $data->subcat_id))->row();
                                                $minor_cat_data = $this->db->get_where('tbl_minisubcategory', array('id' => $data->mincat_id1))->row();
                                                $minor_cat_data2 = $this->db->get_where('tbl_minisubcategory2', array('id' => $data->mincat_id2))->row();
                                            }
                                        ?>
                                            <tr>
                                                <td><?php echo $i ?> </td>
                                                <td><b><? if ($data->is_quick == 1) {
                                                            echo "QuickShops";
                                                        } else {
                                                            echo "Normal";
                                                        } ?></b></td>
                                                <td><?= $cat_data ? $cat_data->name : '-' ?></td>
                                                <td><?= $sub_cat_data ? $sub_cat_data->name : '-' ?></td>
                                                <td><?= $minor_cat_data ? $minor_cat_data->name : '-' ?></td>
                                                <td><?= $minor_cat_data2 ? $minor_cat_data2->name : '-' ?></td>

                                                <td>
                                                    <?
                                                    $newdate = new DateTime($data->date);
                                                    echo $newdate->format('M j, Y, g:i a');   #d-m-Y  // March 10, 2001, 5:16 pm
                                                    ?>
                                                </td>
                                                <td>
                                                    <?
                                                    if (!empty($data->start_time))
                                                        $newdate = new DateTime($data->start_time);
                                                    echo $newdate->format('M j, Y, g:i a');   #d-m-Y  // March 10, 2001, 5:16 pm
                                                    ?>
                                                </td>
                                                <td>
                                                    <?
                                                    if (!empty($data->end_time))
                                                        $newdate = new DateTime($data->end_time);
                                                    echo $newdate->format('M j, Y, g:i a');   #d-m-Y  // March 10, 2001, 5:16 pm
                                                    ?>
                                                </td>
                                                <? if ($dev == 1) { ?>
                                                    <td><?= $data->total_products ?></td>
                                                    <td><?= $data->inserted_products ?></td>
                                                <? } ?>
                                                <td><?php if ($data->status == 0) { ?>
                                                        <p class="label bg-red">Pending</p>

                                                    <?php } else if ($data->status == 1) { ?>
                                                        <p class="label bg-yellow">Running</p>
                                                    <?php } else { ?>
                                                        <p class="label bg-green">Completed</p>
                                                    <? } ?>
                                                </td>
                                                <? if ($dev == 1) { ?>
                                                    <td>
                                                        <?php if ($data->status == 0) { ?>
                                                            <a href="javascript:;" class="dCnf" mydata="<?php echo $i ?>"> <button type="button" class="btn btn-default">Delete</button></a>
                                                        <?php } else { ?>
                                                            <a href="<?php echo base_url() ?>dcadmin/Products/reset_cron_jon/<?php echo base64_encode($data->id); ?>"> <button type="button" class="btn btn-default">Reset</button></a>
                                                        <? } ?>
                                                        <div style="display:none" id="cnfbox<?php echo $i ?>">
                                                            <p> Are you sure delete this </p>
                                                            <a href="<?php echo base_url() ?>dcadmin/Products/delete_cron_jon/<?php echo base64_encode($data->id); ?>" class="btn btn-danger">Yes</a>
                                                            <a href="javasript:;" class="cans btn btn-default" mydatas="<?php echo $i ?>">No</a>
                                                        </div>
                                                    </td>
                                                <? } ?>
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