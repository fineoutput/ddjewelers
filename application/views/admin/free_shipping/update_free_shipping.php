<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Update Free_shipping
    </h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Update Free_shipping </h3>
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
              <form action=" <?php echo base_url(); ?>dcadmin/free_shipping/add_free_shipping_data/<? echo base64_encode(2); ?>/<?= $id; ?>" method="POST" id="slide_frm" enctype="multipart/form-data">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <tr>
                      <td> <strong>Title</strong> <span style="color:red;">*</span></strong> </td>
                      <td> <input type="text" name="title" class="form-control" placeholder="" required value="<?= $free_shipping_data->title; ?>" /></td>
                    </tr>
                    <tr>
                      <td> <strong>FREE SHIPPING</strong> <span style="color:red;">*</span></strong> </td>
                      <td> <textarea type="text" name="free_shipping" id="editor1" class="form-control" placeholder="" required value="" /><?= $free_shipping_data->free_shipping; ?></textarea> </td>
                    </tr>
                    <tr>
                      <td> <strong>Page Title</strong> <span style="color:red;">*</span></strong> </td>
                      <td> <input type="text" name="page_title" class="form-control" placeholder="" required value="<?= $free_shipping_data->page_title; ?>" /> </td>
                    </tr>
                    <tr>
                      <td> <strong>Keyword</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <textarea name="keyword" class="form-control" placeholder="" required id="editor1"><?= $free_shipping_data->keyword; ?></textarea>
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Meta Description</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <textarea name="dsc" class="form-control" placeholder="" required id="editor1"><?= $free_shipping_data->dsc; ?></textarea>
                      </td>
                    </tr>
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
<script src="<?php echo base_url() ?>assets/admin/plugins/ckeditor/ckeditor.js"></script>
<script>
  // Replace the <textarea id="editor1"> with a CKEditor
  // instance, using default configuration.
  CKEDITOR.replace('editor1');
</script>