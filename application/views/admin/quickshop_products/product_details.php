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
                    <? $c = $products_data->category_id; ?><? $sc = $products_data->subcategory_id;
                                                            $scc = $products_data->minor_category_id;
                                                            $scc2 = $products_data->minor2_category_id;
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

                                                            if (!empty($data2)) {
                                                              $sub = $data2->name;
                                                            } else {
                                                              $sub = "-";
                                                            }

                                                            $this->db->select('*');
                                                            $this->db->from('tbl_quickshop_minisubcategory');
                                                            $this->db->where('id', $scc);
                                                            $data4 = $this->db->get()->row();

                                                            if (!empty($data4)) {
                                                              $minisub = $data4->name;
                                                            } else {
                                                              $minisub = "-";
                                                            }

                                                            $this->db->select('*');
                                                            $this->db->from('tbl_quickshop_minisubcategory2');
                                                            $this->db->where('id', $scc2);
                                                            $data5 = $this->db->get()->row();

                                                            if (!empty($data5)) {
                                                              $minisub2 = $data5->name;
                                                            } else {
                                                              $minisub2 = "-";
                                                            }

                                                            ?>
                    <tr>
                      <td> <strong>Category</strong> <span style="color:red;">*</span></strong> </td>
                      <td><?= $data3->name; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>SubCategory(Level 2)</strong> <span style="color:red;">*</span></strong> </td>
                      <td><?= $sub; ?> </td>
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
                      <td><?= $products_data->short_description; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>Group Description</strong> <span style="color:red;">*</span></strong> </td>
                      <td><?= $products_data->description; ?> </td>
                    </tr>
                    <tr>
                      <td> <strong>On hand</strong> <span style="color:red;">*</span></strong> </td>
                      <td><?= $products_data->on_hand; ?> </td>
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
                      <td>$</td>
                    </tr>
                    <tr>
                      <td> <strong>Weight</strong> </strong> </td>
                      <td><?= $products_data->weight; ?> </td>
                    </tr>
                    
                    <tr>
                      <td> <strong>Ring Size</strong> </strong> </td>
                      <td><?= $products_data->ring_size; ?> </td>
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