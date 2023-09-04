<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Update Category (Level 1)
    </h1>

  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12">

        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Update Category (Level 1) </h3>
          </div>

          <? if (!empty($this->session->flashdata('smessage'))) {  ?>
            <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4><i class="icon fa fa-check"></i> Alert!</h4>
              <? echo $this->session->flashdata('smessage');
              $this->session->unset_userdata('smessage'); ?>
            </div>
          <? }
          if (!empty($this->session->flashdata('emessage'))) {  ?>
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4><i class="icon fa fa-ban"></i> Alert!</h4>
              <? echo $this->session->flashdata('emessage');
              $this->session->unset_userdata('emessage');  ?>
            </div>
          <? }  ?>


          <div class="panel-body">
            <div class="col-lg-10">
              <form action=" <?php echo base_url(); ?>dcadmin/category/add_category_data/<? echo base64_encode(2); ?>/<?= $id; ?>" method="POST" id="slide_frm" enctype="multipart/form-data">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <tr>
                      <td> <strong>Name</strong> <span style="color:red;">*</span></strong> </td>
                      <td> <input type="text" name="name" class="form-control" placeholder="" value="<?= $category_data->name; ?>" /> </td>
                    </tr>
                    <tr>
                      <td> <strong>Image</strong> <span style="color:red;">*</span></strong> </td>
                      <td> <input type="file" name="image" class="form-control" placeholder="" />
                        <?php if ($category_data->image != "") { ?> <img id="slide_img_path" height=200 width=300 src="<?php echo base_url() . $category_data->image; ?> "> <?php } else { ?> Sorry No File Found <?php } ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Banner</strong> <span style="color:red;">*</span></strong> </td>
                      <td> <input type="file" name="banner" class="form-control" placeholder="" />
                        <?php if ($category_data->banner != "") { ?> <img id="slide_img_path" height=200 width=300 src="<?php echo base_url() . $category_data->banner; ?> "> <?php } else { ?> Sorry No File Found <?php } ?> </td>
                    </tr>

                    <tr>
                      <td> <strong>Description</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <!-- <input type="number" name="seq"  class="form-control" placeholder=""  value="" /> -->
                        <textarea type="text" name="description" required class="form-control" placeholder="" value="<?= $category_data->description; ?>" rows="5"><?= $category_data->description; ?></textarea>
                      </td>
                    </tr>

                    <tr>
                      <td> <strong>Type</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <select class="form-control" name="type" required>
                          <option value="" selected>---------------------select type----------------------</option>
                          <option value="0" <? if ($category_data->type == 0) {
                                              echo "selected";
                                            } ?>>None</option>
                          <option value="1" <? if ($category_data->type == 1) {
                                              echo "selected";
                                            } ?>>Category ID</option>
                          <option value="2" <? if ($category_data->type == 2) {
                                              echo "selected";
                                            } ?>>Series No.</option>
                          <option value="3" <? if ($category_data->type == 3) {
                                              echo "selected";
                                            } ?>>SKU</option>
                        </select>
                      </td>
                    </tr>


                    <tr>
                      <td> <strong>Api Id</strong> </strong> </td>
                      <td>
                        <?
                        $d_api = json_decode($category_data->api_id);
                        $api = implode(',', $d_api)
                        ?>
                        <textarea name="api_id" class="form-control" rows="5" cols="50"><?= $api; ?></textarea>
                      </td>
                    </tr>


                    <tr>
                      <td> <strong>Sequence No.</strong> <span style="color:red;">*</span></strong> </td>
                      <td> <input type="number" name="seq" class="form-control" placeholder="" value="<?= $category_data->seq; ?>" /> </td>
                    </tr>
                    <tr>
                      <td> <strong>Finshed</strong> <span style="color:red;">*</span></strong> </td>
                      <td> <input type="checkbox" name="finshed" class="" placeholder="" value="1" <? if ($category_data->finshed == 1) {
                                                                                                      echo "checked";
                                                                                                    } else {
                                                                                                      echo "";
                                                                                                    } ?> />&nbsp&nbsp<lable> Finshed </lable>
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Excluded Series Ex(1235,ch12)</strong> <span style="color:red;">*</span></strong> </td>
                      <td> <input type="text" name="exlude_series" class="form-control" placeholder="" value="<?= $category_data->exlude_series; ?>" /> </td>
                    </tr>

                    <tr>
                      <td> <strong>Excluded Sku Ex(1235,ch12)</strong> <span style="color:red;">*</span></strong> </td>
                      <td> <input type="text" name="exlude_sku" class="form-control" placeholder="" value="<?= $category_data->exlude_sku; ?>" /> </td>
                    </tr>

                    <tr>
                      <td> <strong>Include Series Ex(1235,ch12)</strong> <span style="color:red;">*</span></strong> </td>
                      <td> <input type="text" name="include_series" class="form-control" placeholder="" value="<?= $category_data->include_series; ?>" /> </td>
                    </tr>

                    <tr>
                      <td> <strong>Include Sku Ex(1235,ch12)</strong> <span style="color:red;">*</span></strong> </td>
                      <td> <input type="text" name="include_sku" class="form-control" placeholder="" value="<?= $category_data->include_sku; ?>" /> </td>
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