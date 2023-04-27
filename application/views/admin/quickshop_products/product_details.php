<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Quick Shops: View Product Details
    </h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12">
        <!-- <a class="btn btn-info cticket" href="<?php echo base_url() ?>dcadmin/QuickshopProducts/view_products/<?= base64_encode($products_data->id); ?>/<?= base64_encode(0); ?>" role="button" style="margin-bottom:12px;"> Back</a> -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> View Product Details </h3>
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
              <form action=" <?php echo base_url(); ?>dcadmin/QuickshopProducts/add_products_data/<? echo base64_encode(2); ?>/<?= $id; ?>" method="POST" id="slide_frm" enctype="multipart/form-data">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <tr>
                      <td> <strong>Product name</strong> <span style="color:red;">*</span></strong> </td>
                      <td><?= $products_data->description; ?> </td>
                    </tr>
                    <? $c = $products_data->category; ?><? $sc = $products_data->sub_category;
                                                      $scc = $products_data->minisub_category;
                                                      $scc2 = $products_data->minisub_category2;
                                                      // echo $sc;
                                                      // exit;
                                                      $this->db->select('*');
                                                      $this->db->from('tbl_quickshop_category');
                                                      $this->db->where('id', $c);
                                                      $data3 = $this->db->get()->row();
                                                      $this->db->select('*');
                                                      $this->db->from('tbl_quickshop_subcategory');
                                                      $this->db->where('id', $sc);
                                                      $data2 = $this->db->get()->row();
                                                      $this->db->select('*');
                                                      $this->db->from('tbl_quickshop_minisubcategory');
                                                      $this->db->where('id', $scc);
                                                      $data4 = $this->db->get()->row();
                                                      if (!empty($data4)) {
                                                        $minisub = $data4->name;
                                                      } else {
                                                        $minisub = "";
                                                      }
                                                      $this->db->select('*');
                                                      $this->db->from('tbl_quickshop_minisubcategory2');
                                                      $this->db->where('id', $scc2);
                                                      $data5 = $this->db->get()->row();
                                                      if (!empty($data5)) {
                                                        $minisub2 = $data5->name;
                                                      } else {
                                                        $minisub2 = "";
                                                      }
                                                      ?>
                    <tr>
                      <td> <strong>Category</strong> <span style="color:red;">*</span></strong> </td>
                      <td><?= $data3->name; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>SubCategory(Level 2)</strong> <span style="color:red;">*</span></strong> </td>
                      <td><?= $data2->name; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>SubCategory(Level 3)</strong> <span style="color:red;">*</span></strong> </td>
                      <td><?= $minisub; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>SubCategory(Level 4)</strong> <span style="color:red;">*</span></strong> </td>
                      <td><?= $minisub2; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Sku</strong> <span style="color:red;">*</span></strong> </td>
                      <td><?= $products_data->sku; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Short Description</strong> <span style="color:red;">*</span></strong> </td>
                      <td><?= $products_data->sdesc; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Group Description</strong> <span style="color:red;">*</span></strong> </td>
                      <td><?= $products_data->gdesc; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Merchandising Category1</strong> <span style="color:red;">*</span></strong> </td>
                      <td><?= $products_data->mcat1; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Merchandising Category2</strong> <span style="color:red;">*</span></strong> </td>
                      <td><?= $products_data->mcat2 ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Merchandising Category3</strong> <span style="color:red;">*</span></strong> </td>
                      <td><?= $products_data->mcat3 ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Merchandising Category4</strong> <span style="color:red;">*</span></strong> </td>
                      <td><?= $products_data->mcat4 ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Merchandising Category5</strong> <span style="color:red;">*</span></strong> </td>
                      <td><?= $products_data->mcat5 ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Product Type</strong> <span style="color:red;">*</span></strong> </td>
                      <td><?= $products_data->product_type; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Collection</strong> <span style="color:red;">*</span></strong> </td>
                      <td><?= $products_data->collection; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>On hand</strong> <span style="color:red;">*</span></strong> </td>
                      <td><?= $products_data->onhand; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Status</strong> <span style="color:red;">*</span></strong> </td>
                      <td><?= $products_data->status; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Price</strong> <span style="color:red;">*</span></strong> </td>
                      <td><?= $products_data->price; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Currency</strong> <span style="color:red;">*</span></strong> </td>
                      <td><?= $products_data->currency; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Unit of Sale</strong> </strong> </td>
                      <td><?= $products_data->unitofsale; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Weight</strong> </strong> </td>
                      <td><?= $products_data->weight; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Weight Unit</strong> </strong> </td>
                      <td><?= $products_data->weightunit; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Gram weight</strong> </strong> </td>
                      <td><?= $products_data->gramweight; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Ring Sizable</strong> </strong> </td>
                      <td><?= $products_data->ringsizable; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Ring Size</strong> </strong> </td>
                      <td><?= $products_data->ringsize; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Ring Size Type</strong> </strong> </td>
                      <td><?= $products_data->ringsizetype; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Lead Time</strong> </strong> </td>
                      <td><?= $products_data->leadtime; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Agta</strong> </strong> </td>
                      <td><?= $products_data->agta; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Description Element Group</strong> </strong> </td>
                      <td><?= $products_data->desc_e_grp; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Description Element Name1</strong> </strong> </td>
                      <td><?= $products_data->desc_e_name1; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Description Element Value1</strong> </strong> </td>
                      <td><?= $products_data->desc_e_value1; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Description Element Name2</strong> </strong> </td>
                      <td><?= $products_data->desc_e_name2; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Description Element Value2</strong> </strong> </td>
                      <td><?= $products_data->desc_e_value2; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Description Element Name3</strong> </strong> </td>
                      <td><?= $products_data->desc_e_name3; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Description Element Value3</strong> </strong> </td>
                      <td><?= $products_data->desc_e_value3; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Description Element Name4</strong> </strong> </td>
                      <td><?= $products_data->desc_e_name4; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Description Element Value4</strong> </strong> </td>
                      <td><?= $products_data->desc_e_value4; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Description Element Name5</strong> </strong> </td>
                      <td><?= $products_data->desc_e_name5; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Description Element Value5</strong> </strong> </td>
                      <td><?= $products_data->desc_e_value5; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Description Element Name6</strong> </strong> </td>
                      <td><?= $products_data->desc_e_name6; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Description Element Value6</strong> </strong> </td>
                      <td><?= $products_data->desc_e_value6; ?> </td>
                    </tr>
                    <td> <strong>Description Element Value7</strong> </strong> </td>
                    <td><?= $products_data->desc_e_value7; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Description Element Name8</strong> </strong> </td>
                      <td><?= $products_data->desc_e_name8; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Description Element Value9</strong> </strong> </td>
                      <td><?= $products_data->desc_e_value9; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Description Element Name10</strong> </strong> </td>
                      <td><?= $products_data->desc_e_name10; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Description Element Value11</strong> </strong> </td>
                      <td><?= $products_data->desc_e_value11; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Description Element Name12</strong> </strong> </td>
                      <td><?= $products_data->desc_e_name12; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Description Element Value13</strong> </strong> </td>
                      <td><?= $products_data->desc_e_value13; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Description Element Name14</strong> </strong> </td>
                      <td><?= $products_data->desc_e_name14; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Description Element Value15</strong> </strong> </td>
                      <td><?= $products_data->desc_e_value15; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Ready to Wear</strong> </strong> </td>
                      <td><?= $products_data->readytowear; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Stone Map Image</strong> </strong> </td>
                      <td><?= $products_data->smi; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Image1</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <?php if ($products_data->image1 != "") { ?> <img id="slide_img_path" height=200 width=300 src="<?php echo $products_data->image1; ?> "> <?php } else { ?> Sorry No File Found <?php } ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Image2</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <?php if ($products_data->image2 != "") { ?> <img id="slide_img_path" height=200 width=300 src="<?php echo $products_data->image2; ?> "> <?php } else { ?> Sorry No File Found <?php } ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Image3</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <?php if ($products_data->image3 != "") { ?> <img id="slide_img_path" height=200 width=300 src="<?php echo $products_data->image3; ?> "> <?php } else { ?> Sorry No File Found <?php } ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Video</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <?php if ($products_data->video != "") { ?> <img id="slide_img_path" height=200 width=300 src="<?php echo $products_data->video; ?> "> <?php } else { ?> Sorry No File Found <?php } ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Group Image1</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <?php if ($products_data->gimage1 != "") { ?> <img id="slide_img_path" height=200 width=300 src="<?php echo $products_data->gimage1; ?> "> <?php } else { ?> Sorry No File Found <?php } ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Group Image2</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <?php if ($products_data->gimage2 != "") { ?> <img id="slide_img_path" height=200 width=300 src="<?php echo $products_data->gimage2; ?> "> <?php } else { ?> Sorry No File Found <?php } ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Group Image3</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <?php if ($products_data->gimage3 != "") { ?> <img id="slide_img_path" height=200 width=300 src="<?php echo $products_data->gimage3; ?> "> <?php } else { ?> Sorry No File Found <?php } ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Group Video</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <?php if ($products_data->gvideo != "") { ?> <img id="slide_img_path" height=200 width=300 src="<?php echo $products_data->gvideo; ?> "> <?php } else { ?> Sorry No File Found <?php } ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Creation Date</strong> </strong> </td>
                      <td><?= $products_data->creationdate; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Currency Code</strong> </strong> </td>
                      <td><?= $products_data->currencycode; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Country</strong> </strong> </td>
                      <td><?= $products_data->country; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Diamond Clarity</strong> </strong> </td>
                      <td><?= $products_data->dclarity; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Diamond Color</strong> </strong> </td>
                      <td><?= $products_data->dcolor; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Total Weight</strong> </strong> </td>
                      <td><?= $products_data->totalweight; ?> </td>
                    </tr>
                    <tr>
                      <td colspan="2">
                        <!-- <input type="submit" class="btn btn-success" value="save"> -->
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