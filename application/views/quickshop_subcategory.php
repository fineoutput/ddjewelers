<style type="text/css">
  .text_light h1 {
    font-size: 2.7rem !important;
    color: rgb(85, 85, 85);
    text-transform: none;
    -webkit-font-smoothing: antialiased;
    letter-spacing: -0.02em;
    word-spacing: 0.06em;
    padding-bottom: 10px;
    font-weight: 100 !important;
  }

  .text_light p {
    color: rgb(38, 38, 38);
    line-height: 1.42857;
    font-size: 14px;
  }

  .img_chng {
    width: 400px;
    margin: auto;
    display: flex;
  }

  .quick_btn {
    position: relative;
    padding: 0px 8px;
    transition: all 0.2s ease 0s;
    cursor: pointer;
    margin-bottom: 5px;
    border: none;
    color: rgb(255, 255, 255);
    font-size: 17px;
    line-height: 34px;
    background-color: rgb(117, 176, 218);
    box-shadow: rgb(0 0 0 / 35%) 0px 2px 3px 0px;
    text-transform: uppercase;
  }

  .this_new h2 {
    line-height: 1;
    color: rgb(85, 85, 85);
    text-transform: none;
    -webkit-font-smoothing: antialiased;
    letter-spacing: -0.02em;
    word-spacing: 0.06em;
    padding-bottom: 10px;
    font-weight: 100 !important;
  }

  .this_new i {
    color: #000;
  }

  .prod_btn {
    position: relative;
    padding: 0px 8px;
    transition: all 0.2s ease 0s;
    cursor: pointer;
    margin-bottom: 5px;
    border: 1px solid rgb(65, 64, 66);
    color: rgb(65, 64, 66);
    font-size: 16px;
    background: 0px 0px;
    line-height: 32px;
    box-shadow: rgb(0 0 0 / 25%) 0px 2px 3px 0px;
  }

  .pad_img_new img {
    padding-left: 35px;
    width: 200px;
  }

  .black_tex {
    position: relative;
    padding: 12px 40px !important;
    background-color: rgb(51, 46, 46);
    color: rgb(255, 255, 255);
    margin: 10px 0px 5px;
    font-size: 1rem;
    font-weight: 500;
  }

  .col-md-dd {
    width: 144px;
    text-align: center;
    padding-left: 15px;
    padding-right: 15px;
  }

  .col-md-dd img {
    width: 100%;
  }

  .col-md-dd p {
    font-size: 12px;
  }
</style>
<!-- new page design start -->
<section class="this_new">
  <div class="container-fluid p-5 ">
    <div class="row">
      <div class="col-md-6 text_light">
        <h1><?= $quick_subcategory_name; ?></h1>
        <p><?= $quick_subcategory_description; ?></p>
        <a href="<?= base_url() ?>QuickShops/quickshops_category">
          <button class="quick_btn">View all quick shop</button>
        </a>
      </div>
      <div class="col-md-6">
        <div class="img_chng">
          <img src="<?= $quick_subcategory_iamge; ?>">
        </div>
      </div>
    </div>
    <?php
    if (!empty($quickshop_minorsubcate_data)) {
      foreach ($quickshop_minorsubcate_data->result() as $quick_mini_subcate) {
        if (!empty($quick_mini_subcate->image)) {
          $minisub_image = base_url() . $quick_mini_subcate->image;
        } else {
          $minisub_image = "";
        }
    ?>
        <div class="row">
          <div class="col-md-12">
            <hr>
            <div>
              <span>
                <a data-toggle="collapse" href="#collapseExample_<?= $quick_mini_subcate->id; ?>" role="button" aria-expanded="false" aria-controls="collapseExample">
                  <h2>
                    <i class="fa fa-plus-circle"></i>
                    <?= $quick_mini_subcate->name; ?>
                  </h2>
                </a>
              </span>
              <div class="row">
                <div class="col-md-3 pad_img_new">
                  <img src="<?= $minisub_image; ?>">
                </div>
                <div class="col-md-9 d-flex align-items-center">
                  <div>
                    <p><?= $quick_mini_subcate->description; ?></p>
                  </div>
                </div>
                <div class="col-md-12 ">
                  <button class="prod_btn d-flex m-auto" type="button" data-toggle="collapse" data-target="#collapseExample_<?= $quick_mini_subcate->id; ?>" aria-expanded="false" aria-controls="collapseExample"><span><i class="buttonIcon fa fa-plus-circle"></i>Show Products</span></button>
                </div>
                <div class="col-md-12 collapse" id="collapseExample_<?= $quick_mini_subcate->id; ?>">
                  <?php
                  $this->db->select('id,name');
                  $this->db->from('tbl_quickshop_minisubcategory2');
                  $this->db->where('minorsubcategory', $quick_mini_subcate->id);
                  $this->db->where('is_active', 1);
                  $quick_mini_subcate2_da = $this->db->get();
                  if (!empty($quick_mini_subcate2_da)) {
                    foreach ($quick_mini_subcate2_da->result() as $quick_mini_subcate2) {
                  ?>
                      <div class="back_bac">
                        <h4 class="black_tex">
                          <!-- <img src="https://meteor.stullercloud.com/das/14948259?size=35&fmt=smart-alpha" style="position: absolute; top: 2px; left: 3px;width:35px;"> -->
                          &nbsp; &nbsp;<?= $quick_mini_subcate2->name; ?>
                        </h4>
                      </div>
                      <div class="row m-4">
                        <?php
                        $this->db->select('id,full_set_images,images,group_images,series_id,group_id,description');
                        $this->db->from('tbl_products');
                        $this->db->where('minor2_category_id', $quick_mini_subcate2->id);
                        $this->db->where('is_quick', 1);
                        $this->db->group_by("series_id");
                        $product_da = $this->db->get();
                        // $product_da = [];
                        if (!empty($product_da)) {
                          foreach ($product_da->result() as $data) {
                            $full_images = json_decode($data->full_set_images);
                            $images = json_decode($data->images);
                            $group_images = json_decode($data->group_images);
                            $image1 = '';
                            if (!empty($full_images)) {
                              $image1 = $full_images[0]->FullUrl;
                            } else if (!empty($images)) {
                              $image1 = $images[0]->FullUrl;
                            } else if (!empty($group_images)) {
                              $image1 = $group_images[0]->FullUrl;
                            }
                        ?>
                            <a href="<?= base_url() ?>Home/product_details/<?= $data->series_id ?>/<?= $data->pro_id ?>?groupId=<?= $data->group_id ?>">
                              <div class="col-md-dd">
                                <img src="<?= $image1; ?>">
                                <P><?= $data->description; ?></P>
                              </div>
                            </a>
                        <?php
                          }
                        } else {
                          echo "No products found!";
                        }
                        ?>
                      </div>
                  <?php
                    }
                  }
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
    <?php
      }
    }
    ?>
  </div>
</section>
<!-- new page design end -->