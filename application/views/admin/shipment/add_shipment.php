<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<style>
    .bootstrap-select > .dropdown-toggle {
        height:100%;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Add New Shipping
        </h1>

    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Add New Shipping</h3>
                    </div>

                    <? if (!empty($this->session->flashdata('smessage'))) {  ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Alert!</h4>
                            <? echo $this->session->flashdata('smessage');  ?>
                        </div>
                    <? }
                    if (!empty($this->session->flashdata('emessage'))) {  ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                            <? echo $this->session->flashdata('emessage');  ?>
                        </div>
                    <? }  ?>


                    <div class="panel-body">
                        <div class="col-lg-10">
                            <form action=" <?php echo base_url()  ?>dcadmin/shipment/add_shipment_data/<? echo base64_encode(1);  ?>" method="POST" id="slide_frm" enctype="multipart/form-data">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <tr>
                                            <td  style="width: 20%;"> <strong>Country</strong> <span style="color:red;">*</span></strong> </td>
                                            <td>
                                                <select name="country_id[]" class="form-control" required multiple class="chosen-select">
                                                    <?php $i = 1;
                                                    foreach ($country_data->result() as $cat) { ?>
                                                        <option value="<?= $cat->id ?>"><?= $cat->name ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td  style="width: 20%;"> <strong>Method</strong> <span style="color:red;">*</span></strong> </td>
                                            <td>
                                                <select name="method_id[]" class="form-control" required multiple class="chosen-select">
                                                    <?php $i = 1;
                                                    foreach ($method_data->result() as $cat) { ?>
                                                        <option value="<?= $cat->id ?>"><?= $cat->name ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>


                                        <tr>
                                            <td colspan="2">
                                                <input type="submit" class="btn btn-success" value="save">
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                            </form>

                        </div>



                    </div>

                </div>

            </div>
        </div>
    </section>
</div>


<script type="text/javascript" src=" <?php echo base_url()  ?>assets/slider/ajaxupload.3.5.js"></script>
<link href=" <? echo base_url()  ?>assets/cowadmin/css/jqvmap.css" rel='stylesheet' type='text/css' />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script type="text/javascript">
  $('select').selectpicker();
</script>