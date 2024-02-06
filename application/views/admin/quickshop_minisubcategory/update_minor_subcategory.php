<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Quick Shops: Update Sub-Category (Level 3)
    </h1>

  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12">

        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Update Sub-Category (Level 3) </h3>
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
              <form action=" <?php echo base_url(); ?>dcadmin/QuickshopMinisubcategory/add_minor_subcategory_data/<? echo base64_encode(2); ?>/<?= $id; ?>" method="POST" id="slide_frm" enctype="multipart/form-data">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <!-- <tr>
<td> <strong>Category</strong>  <span style="color:red;">*</span></strong> </td>
<td> <input type="text" name="category"  class="form-control" placeholder="" required value="<?= $minisubcategory_data->category; ?>" />  </td>
</tr>
<tr>
<td> <strong>Subcategory</strong>  <span style="color:red;">*</span></strong> </td>
<td> <input type="text" name="subcategory"  class="form-control" placeholder="" required value="<?= $minorsubcategory_data->subcategory; ?>" />  </td>
</tr> -->



                    <tr>
                      <td> <strong>Category</strong> <span style="color:red;">*</span></strong> </td>
                      <td> <select class="form-control" name="category" id="category">
                          <option value="">Select Category</option>
                          <?php $i = 1;
                          foreach ($category->result() as $data) { ?>
                            <option value="<?= $data->id ?>" <?php if ($data->id == $minorsubcategory_data->category) {
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
                            <option value="<?= $data->id ?>" <?php if ($data->id == $minorsubcategory_data->subcategory) {
                                                              echo 'selected';
                                                            } ?>><?= $data->name ?></option>
                          <?php $i++;
                          } ?>
                        </select>
                        <!-- <td> <input type="select" name="category"  class="form-control" placeholder=""  value="" />  </td> -->
                    </tr>



                    <tr>
                      <td> <strong>Name</strong> <span style="color:red;">*</span></strong> </td>
                      <td> <input type="text" name="name" class="form-control" placeholder="" required value="<?= $minorsubcategory_data->name; ?>" /> </td>
                    </tr>



                    <tr>
                      <td> <strong>Image</strong> <span style="color:red;">*</span></strong> </td>
                      <td> <input type="file" name="image" class="form-control" placeholder="" />
                        <?php if ($minorsubcategory_data->image != "") { ?> <img id="slide_img_path" height=200 width=300 src="<?php echo base_url() . $minorsubcategory_data->image; ?> "> <?php } else { ?> Sorry No File Found <?php } ?> </td>
                    </tr>

                    <tr>
                      <td> <strong>Sequence</strong> <span style="color:red;">*</span></strong> </td>
                      <td> <input type="number" name="seq" class="form-control" placeholder="" value="<?= $minorsubcategory_data->seq; ?>" /> </td>
                    </tr>
                    <tr>
                      <td> <strong>Search Key</strong> <span style="color:red;"></span></strong> </td>
                      <td> <input type="text" name="search_key" class="form-control" placeholder="" value="<?= $minorsubcategory_data->search_key; ?>" /> </td>
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
          url: base_url + "dcadmin/QuickshopMinisubcategory/getSubcat?isl=" + vf,
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