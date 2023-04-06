<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Add New Shipping
        </h1>
        <ol class="breadcrumb">


        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Add New Shipping</h3>
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
                            <form action="<?php echo base_url() ?>dcadmin/Shippingrules/add_shippingrules_data/<?php echo base64_encode(1); ?>" method="POST" id="slide_frm" enctype="multipart/form-data">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <input type="hidden" name="shipping_id" value="<?= $id ?>">
                                        <tr>
                                            <td> <strong>Start Price</strong> <span style="color:red;">*</span></strong> </td>
                                            <td>
                                                <input type="text" name="start_price" class="form-control" placeholder="" required value="" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <strong>End Price</strong> <span style="color:red;">*</span></strong> </td>
                                            <td>
                                                <input type="text" name="End_price" class="form-control" placeholder="" required value="" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <strong>Shipping Cost</strong> <span style="color:red;">*</span></strong> </td>
                                            <td>
                                                <input type="text" name="shipment_cost" class="form-control" placeholder="" required value="" />
                                            </td>
                                        </tr>


                                        <tr>

                                        <tr>
                                            <td colspan="2">
                                                <input type="submit" class="btn btn-success" value="save">
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </form>
                        </div>
                        <style>
                        </style>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="<?php echo base_url() ?>assets/size/ajaxupload.3.5.js"></script>
<link href="<?php echo base_url() ?>assets/cowadmin/css/jqvmap.css" rel='stylesheet' type='text/css' />
<link href="<?php echo base_url() ?>assets/cowadmin/css/jqvmap.css" rel='stylesheet' type='text/css' />
<script type="text/javascript">
    $('select').selectpicker();
</script>