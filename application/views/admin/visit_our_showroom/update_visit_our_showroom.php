<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Update Visit Our Showroom
    </h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Update Visit Our Showroom </h3>
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
              <form action=" <?php echo base_url(); ?>dcadmin/visit_our_showroom/add_visit_our_showroom_data/<? echo base64_encode(2); ?>/<?= $id; ?>" method="POST" id="slide_frm" enctype="multipart/form-data">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <tr>
                      <td> <strong>Image</strong> <span style="color:red;"></span></strong> </td>
                      <td> <input type="file" name="image" class="form-control" /><br /><img src="<?= base_url() . $visit_our_showroom_data->image ?>" height="150px" width="200px"> </td>
                    </tr>
                    <tr>
                      <td> <strong>Address</strong> <span style="color:red;"></span></strong> </td>
                      <td> <textarea type="text" name="address" id="addressEditor" class="form-control" placeholder="" required value="" /><?= $visit_our_showroom_data->address; ?></textarea> </td>
                    </tr>
                    <tr>
                      <td> <strong>Fax Number</strong> <span style="color:red;"></span></strong> </td>
                      <td> <input type="text" name="fax" id="fax" class="form-control" placeholder="" required value="<?= $visit_our_showroom_data->fax; ?>" /> </td>
                    </tr>
                    <tr>
                      <td> <strong>Store Hours</strong> <span style="color:red;"></span></strong> </td>
                      <td> <textarea type="text" name="store_hours" id="storeEditor" class="form-control" placeholder="" required value="" /><?= $visit_our_showroom_data->store_hours; ?></textarea> </td>
                    </tr>
                    <tr>
                      <td> <strong>Map Location</strong> <span style="color:red;"><br />(input iframe code)</span></strong> </td>
                      <td> <textarea type="text" name="map" id="map" class="form-control" placeholder="" required value="" /><?= $visit_our_showroom_data->map; ?></textarea> </td>
                    </tr>
                    <tr>
                      <td> <strong>Page Title</strong> <span style="color:red;">*</span></strong> </td>
                      <td> <input type="text" name="page_title" class="form-control" placeholder="" required value="<?= $visit_our_showroom_data->page_title; ?>" /> </td>
                    </tr>
                    <tr>
                      <td> <strong>Keyword</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <textarea name="keyword" class="form-control" placeholder="" required id="editor1"><?= $visit_our_showroom_data->keyword; ?></textarea>
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Meta Description</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <textarea name="dsc" class="form-control" placeholder="" required id="editor1"><?= $visit_our_showroom_data->dsc; ?></textarea>
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
  CKEDITOR.replace('addressEditor');
  CKEDITOR.replace('storeEditor');
</script>