<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Add Contact Us Page
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url() ?>admin/college"><i class="fa fa-dashboard"></i> All Contact Us Page </a></li>

        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Add New Contact Us Page</h3>
                    </div>


                    <? if (!empty($this->session->flashdata('smessage'))) { ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-check"></i> Alert!</h4>
                            <? echo $this->session->flashdata('smessage'); ?>
                        </div>
                    <? }
                    if (!empty($this->session->flashdata('emessage'))) { ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                            <? echo $this->session->flashdata('emessage'); ?>
                        </div>
                    <? } ?>


                    <div class="panel-body">
                        <div class="col-lg-10">
                            <form action="<?php echo base_url() ?>dcadmin/Contact_us_page/add_contact_us_page_data/<? echo base64_encode(1); ?>" method="POST" id="slide_frm" enctype="multipart/form-data">
                                <div class="table-responsive">
                                    <table class="table table-hover">

                                        <!-- <tr>
                                            <td> <strong>Heading</strong> <span style="color:red;">*</span></strong> </td>
                                            <td> <textarea type="text" name="heading" id="editor1" class="form-control" placeholder="" required value="" /></textarea> </td>
                                        </tr> -->

                                        <tr>
                                            <td> <strong>Address heading</strong> <span style="color:red;">*</span></strong> </td>
                                            <td>
                                                <textarea type="text" name="address_heading" id="editor1" class="form-control" placeholder="" required value="" ></textarea> 
                                            </td>
                                        </tr>

                                        <tr>
                                            <td> <strong>Number</strong> <span style="color:red;">*</span></strong> </td>
                                            <td> <textarea type="text" name="number" id="editor2" class="form-control" placeholder="" required value="" /></textarea> </td>
                                        </tr>


                                        <tr>
                                            <td> <strong>Address</strong> <span style="color:red;">*</span></strong> </td>
                                            <td> <textarea type="text" name="address" id="editor3" class="form-control" placeholder="" required value="" /></textarea> </td>
                                        </tr>



                                        <tr>
                                            <td> <strong>Map address</strong> <span style="color:red;">*</span></strong> </td>
                                            <td>
                                                <input type="text" name="map_address" class="form-control" placeholder="" required value="" />
                                            </td>
                                        </tr>

                                        <!-- 
<tr>
<td> <strong>Hours</strong>  <span style="color:red;">*</span></strong> </td>
<td>
<input type="text" name="hours"   class="form-control" placeholder="" required value="" />
</td>
</tr> -->


                                        <tr>
                                            <td> <strong>Hours list</strong> <span style="color:red;">*</span></strong> </td>
                                            <td> <textarea type="text" name="hours_list" id="editor4" class="form-control" placeholder="" required value="" /></textarea> </td>
                                        </tr>






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
<script src="<?php echo base_url() ?>assets/admin/plugins/ckeditor/ckeditor.js"></script>
<script>
    // Replace the <textarea id="editor1"> with a CKEditor

    // instance, using default configuration.

    CKEDITOR.replace('editor1');
    // CKEDITOR.instances['editor1'].setData('<p>nitesh</p><br><br><p>shah</p>');

    CKEDITOR.replace('editor2');
    // CKEDITOR.instances['editor1'].setData('<p>nitesh</p><br><br><p>shah</p>');

    CKEDITOR.replace('editor3');
    // CKEDITOR.instances['editor1'].setData('<p>nitesh</p><br><br><p>shah</p>');

    CKEDITOR.replace('editor4');
    // CKEDITOR.instances['editor1'].setData('<p>nitesh</p><br><br><p>shah</p>');
</script>