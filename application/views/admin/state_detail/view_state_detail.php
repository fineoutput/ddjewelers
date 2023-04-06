<div class="content-wrapper">
    <section class="content-header">
        <h1>
            View State Detail
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div style="margin-bottom:1rem;display:flex;justify-content: space-between;">
                    <a class="btn custom_btn" href="<?php echo base_url() ?>dcadmin/state_detail/add_state_detail" role="button" style="margin-bottom:12px;"> Add State</a>
                    <? date_default_timezone_set("Asia/Calcutta");
                    $cur_date = date("d-m-Y"); ?>
                    <div style="display:flex;align-items: center;">
                        <a href="<?= base_url() ?>assets/admin/state_taxes.xlsx" download="State Taxes Dummy (<?= $cur_date ?>)"><button type="button" class="btn custom_btn" style="margin-right:10px">Download State Taxes Excel</button></a>
                        <form method="post" action="<?= base_url() ?>dcadmin/State_detail/import_state_taxes_data" enctype="multipart/form-data" style="display:flex;border:1px solid grey;padding:1px;margin-bottom:0">
                            <input type="file" name="uploadFile" class="form-control" required />
                            <button type="submit" class="btn custom_btn">Upload State Taxes</button>
                        </form>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-money fa-fw"></i>View State Detail</h3>
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
                                <table class="table table-bordered table-hover table-striped" id="userTable23">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>State</th>
                                            <th>Percentage</th>
                                            <th>Zipcode</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                
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
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.js"></script>
<script>
$(document).ready(function () {
    $('#userTable23').DataTable({
        processing: true,
        serverSide: true,
        ajax: '<?=base_url()?>dcadmin/State_detail/view_state_detail2',
    });
});
</script>
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