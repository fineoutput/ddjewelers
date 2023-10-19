<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Update Sub-Category (Level 4)
    </h1>

  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12">

        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Update Sub-Category (Level 4) </h3>
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
              <form action=" <?php echo base_url(); ?>dcadmin/minisubcategory2/add_minisubcategory2_data/<? echo base64_encode(2); ?>/<?= $id; ?>" method="POST" id="slide_frm" enctype="multipart/form-data">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <!-- <tr>
<td> <strong>Category</strong>  <span style="color:red;">*</span></strong> </td>
<td> <input type="text" name="category"  class="form-control" placeholder="" required value="<?= $minisubcategory2_data->category; ?>" />  </td>
</tr>
<tr>
<td> <strong>Subcategory</strong>  <span style="color:red;">*</span></strong> </td>
<td> <input type="text" name="subcategory"  class="form-control" placeholder="" required value="<?= $minisubcategory2_data->subcategory; ?>" />  </td>
</tr> -->



                    <tr>
                      <td> <strong>Category</strong> <span style="color:red;">*</span></strong> </td>
                      <td> <select class="form-control" name="category" id="category">
                          <option value="">Select Category</option>
                          <?php $i = 1;
                          foreach ($category->result() as $data) { ?>
                            <option value="<?= $data->id ?>" <?php if ($data->id == $minisubcategory2_data->category) {
                                                                echo 'selected';
                                                              } ?>><?= $data->name ?></option>
                          <?php $i++;
                          } ?>
                        </select>
                        <!-- <td> <input type="select" name="category"  class="form-control" placeholder=""  value="" />  </td> -->
                    </tr>


                    <tr>
                      <td> <strong>Subcategory</strong> <span style="color:red;">*</span></strong> </td>
                      <td> <select class="form-control" name="subcategory" id="subcategory">
                          <option value="">Select Subcategory</option>
                          <?php $i = 1;
                          foreach ($subcategory->result() as $data) { ?>
                            <option value="<?= $data->id ?>" <?php if ($data->id == $minisubcategory2_data->subcategory) {
                                                                echo 'selected';
                                                              } ?>><?= $data->name ?></option>
                          <?php $i++;
                          } ?>
                        </select>
                        <!-- <td> <input type="select" name="category"  class="form-control" placeholder=""  value="" />  </td> -->
                    </tr>


                    <tr>
                      <td> <strong>MinorSubcategory</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <select class="form-control" name="minorsubcategory" id="minorsubcategory">
                          <option value="">Select MinorSubcategory</option>
                          <?php $i = 1;
                          foreach ($minisubcategory->result() as $data) { ?>
                            <option value="<?= $data->id ?>" <?php if ($data->id == $minisubcategory2_data->minorsubcategory) {
                                                                echo 'selected';
                                                              } ?>><?= $data->name ?></option>
                          <?php $i++;
                          } ?>
                        </select>
                        <!-- <td> <input type="select" name="category"  class="form-control" placeholder=""  value="" />  </td> -->
                    </tr>

                    <tr>
                      <td> <strong>Name</strong> <span style="color:red;">*</span></strong> </td>
                      <td> <input type="text" name="name" class="form-control" placeholder="" required value="<?= $minisubcategory2_data->name; ?>" /> </td>
                    </tr>
                    <tr>
                      <td> <strong>Image</strong> <span style="color:red;">*</span></strong> </td>
                      <td> <input type="file" name="image" class="form-control" placeholder="" />
                        <?php if ($minisubcategory2_data->image != "") { ?> <img id="slide_img_path" height=200 width=300 src="<?php echo base_url() . $minisubcategory2_data->image; ?> "> <?php } else { ?> Sorry No File Found <?php } ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Banner</strong> <span style="color:red;">*</span></strong> </td>
                      <td> <input type="file" name="banner" class="form-control" placeholder="" />
                        <?php if ($minisubcategory2_data->banner != "") { ?> <img id="slide_img_path" height=200 width=300 src="<?php echo base_url() . $minisubcategory2_data->banner; ?> "> <?php } else { ?> Sorry No File Found <?php } ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Type</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <select class="form-control" name="type" required>
                          <option value="" selected>---------------------select type----------------------</option>
                          <option value="1" <? if ($minisubcategory2_data->type == 1) {
                                              echo "selected";
                                            } ?>>Category ID</option>
                          <option value="2" <? if ($minisubcategory2_data->type == 2) {
                                              echo "selected";
                                            } ?>>Series No.</option>
                          <option value="3" <? if ($minisubcategory2_data->type == 3) {
                                              echo "selected";
                                            } ?>>SKU</option>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Api Id</strong> <span style="color:red;">*</span></strong> </td>
                      <?
                      $d_api = json_decode($minisubcategory2_data->api_id);
                      if (is_array($d_api)) {
                        $api = implode(',', $d_api);
                      } else {
                        $api = "";
                      }
                      ?>
                      <td><textarea name="api_id" class="form-control" rows="5" cols="50"><?= $api; ?></textarea></td>
                    </tr>

                    <tr>
                      <td> <strong>Sequence</strong> <span style="color:red;">*</span></strong> </td>
                      <td> <input type="number" name="seq" class="form-control" placeholder="" value="<?= $minisubcategory2_data->seq; ?>" /> </td>
                    </tr>
                    <tr>
                      <td> <strong>Finshed</strong> <span style="color:red;">*</span></strong> </td>
                      <td> <input type="checkbox" name="finshed" class="" placeholder="" value="1" <? if ($minisubcategory2_data->finshed == 1) {
                                                                                                      echo "checked";
                                                                                                    } else {
                                                                                                      echo "";
                                                                                                    } ?> />&nbsp&nbsp<lable> Finshed </lable>
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Excluded Series Ex(1235,ch12)</strong> <span style="color:red;">*</span></strong> </td>
                      <td> <input type="text" name="exlude_series" class="form-control" placeholder="" value="<?= $minisubcategory2_data->exlude_series; ?>" /> </td>
                    </tr>

                    <tr>
                      <td> <strong>Excluded Sku Ex(1235,ch12)</strong> <span style="color:red;">*</span></strong> </td>
                      <td> <input type="text" name="exlude_sku" class="form-control" placeholder="" value="<?= $minisubcategory2_data->exlude_sku; ?>" /> </td>
                    </tr>
                    <tr>
                      <td> <strong>Include Series Ex(1235,ch12)</strong> <span style="color:red;">*</span></strong> </td>
                      <td> <input type="text" name="include_series" class="form-control" placeholder="" value="<?= $minisubcategory2_data->include_series; ?>" /> </td>
                    </tr>

                    <tr>
                      <td> <strong>Include Sku Ex(1235,ch12)</strong> <span style="color:red;">*</span></strong> </td>
                      <td> <input type="text" name="include_sku" class="form-control" placeholder="" value="<?= $minisubcategory2_data->include_sku; ?>" /> </td>
                    </tr>
                    <tr>
                      <td> <strong>Description</strong> <span style="color:red;">*</span></strong> </td>
                      <td> <textarea name="description" class="form-control" placeholder=""><?= $minisubcategory2_data->description; ?></textarea> </td>
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



<script type="text/javascript">
  $(document).ready(function() {
    $("#category").change(function() {
      var vf = $(this).val();
      // var yr = $("#year_id option:selected").val();
      if (vf == "") {
        return false;

      } else {
        $('#subcategory option').remove();
        var opton = "<option value=''>Please Select </option>";
        $.ajax({
          url: base_url + "dcadmin/Minisubcategory2/getSubcat?isl=" + vf,
          data: '',
          type: "get",
          success: function(html) {
            if (html != "NA") {
              var s = jQuery.parseJSON(html);
              $.each(s, function(i) {
                opton += '<option value="' + s[i]['sub_id'] + '">' + s[i]['sub_name'] + '</option>';
              });
              $('#subcategory').append(opton);
              //$('#city').append("<option value=''>Please Select State</option>");

              //var json = $.parseJSON(html);
              //var ayy = json[0].name;
              //var ayys = json[0].pincode;
            } else {
              alert('No Branch Found');
              return false;
            }

          }

        })
      }


    })
  });
</script>



<script type="text/javascript">
  $(document).ready(function() {
    $("#subcategory").change(function() {
      var vf = $(this).val();
      // var yr = $("#year_id option:selected").val();
      if (vf == "") {
        return false;

      } else {
        $('#minorsubcategory option').remove();
        var opton = "<option value=''>Please Select </option>";
        $.ajax({
          url: base_url + "dcadmin/Minisubcategory2/getMinorSubcat?isl=" + vf,
          data: '',
          type: "get",
          success: function(html) {
            if (html != "NA") {
              var s = jQuery.parseJSON(html);
              $.each(s, function(i) {
                opton += '<option value="' + s[i]['minorsub_id'] + '">' + s[i]['minorsub_name'] + '</option>';
              });
              $('#minorsubcategory').append(opton);
              //$('#city').append("<option value=''>Please Select State</option>");

              //var json = $.parseJSON(html);
              //var ayy = json[0].name;
              //var ayys = json[0].pincode;
            } else {
              alert('No Branch Found');
              return false;
            }

          }

        })
      }


    })
  });
</script>