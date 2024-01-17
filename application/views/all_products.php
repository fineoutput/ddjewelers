<!-- all products start-->
<style>
  .tgl {
    font-size: 14px !important;
    font-weight: 400;
  }

  .sb-text {
    font-weight: bold;
  }

  .sb-text label section {
    font-size: 14px !important;
  }

  .img-fluid {
    max-width: 75% !important;
  }

  .searchColumn {
    margin-bottom: 3.5rem;
  }

  li.page-item.active.page-link {
    color: #ffffff;
    background: #547f9e;
  }

  .page-link {
    position: relative;
    display: block;
    padding: 0.5rem 0.75rem;
    margin-left: -1px;
    line-height: 1.25;
    color: black;
    background-color: #fff;
    border: 1px solid #dee2e6;
  }
</style>
<section>
  <div class="container pl-5 pr-5 pt-3 pb-5">
    <div class="row">
      <div class="col-md-12 page_span">
        <p><a href="<?= base_url() ?>"><span>Home</span></a> >
          <?php if (!empty($subcategory_name)) { ?>
            <a href="<?= base_url(); ?>Home/sub_category/<?= $category_id ?>"><span><?= $category_name; ?></span></a>
            <?php if (!empty($minorsub_name)) { ?>
              > <span><?= $subcategory_name; ?></span> > <span><?= $minorsub_name; ?></span>
        </p>
      <?php } else { ?>
        > <span><?= $subcategory_name; ?></span> </p>
      <?php } ?>
    <?php } else { ?>
      <span><?= $category_name; ?></span>
    <?php } ?>
      </div>
    </div>
    <div class="row ">
      <!-- <div class="col-md-3 all_pro_fil ">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
          <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading1">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="false" aria-controls="collapse1">
                  Primary Stone Size
                </a>
              </h4>
            </div>
            <div id="collapse1" class="panel-collapse in collapse fil_2" role="tabpanel" aria-labelledby="heading1">
              <div class="panel-body">
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading2">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="true" aria-controls="collapse2">
                  Primary Stone type
                </a>
              </h4>
            </div>
            <div id="collapse2" class="panel-collapse in collapse fil_2" role="tabpanel" aria-labelledby="heading2">
              <div class="panel-body">
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading3">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="true" aria-controls="collapse3">
                  total diamond weight
                </a>
              </h4>
            </div>
            <div id="collapse3" class="panel-collapse in collapse fil_2" role="tabpanel" aria-labelledby="heading3">
              <div class="panel-body">
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading4">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse4" aria-expanded="true" aria-controls="collapse4">
                  diamond clarity
                </a>
              </h4>
            </div>
            <div id="collapse4" class="panel-collapse in collapse fil_2" role="tabpanel" aria-labelledby="heading4">
              <div class="panel-body">
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading5">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse5" aria-expanded="true" aria-controls="collapse5">
                  diamond color
                </a>
              </h4>
            </div>
            <div id="collapse5" class="panel-collapse in collapse fil_2" role="tabpanel" aria-labelledby="heading5">
              <div class="panel-body">
              </div>
            </div>
          </div>
        </div>
        <a href="#">
          <input type="submit" class="mt-3 add-btn" value="Remove Filter">
      </div> -->
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-12 mb-4">
            <div class="row ">
              <div class="col-md-8 mb-4 hrds">
                <h1 class="r-title">
                  <?= $heading . " ( " . $productCount . " )"; ?>
                </h1>
                <?
                if (!empty($description)) {
                ?>
                  <h6 class="mt-3 mb-4"><i><?= $description; ?></i></h6>
                <?
                }
                ?>
              </div>
              <?
              if (!empty($banner)) {
              ?>
                <img src="<?php echo base_url() . $banner ?>" alt="img">
              <?
              }
              ?>

              <!-- <div class="col-md-12 mt-5 hrdx">
                <div class="sb-text ">
                  <div class="s-option">
                    <label for="sort" class="tgl">Sort-by:</label>
                    <select name="sort" id="sort" class="tgl" onchange="sort();">
                      <option value="0" <?php if ($sort_type == 0) {
                                          echo "selected";
                                        } ?>>Best Sellers</option>
                      <option value="1" <?php if ($sort_type == 1) {
                                          echo "selected";
                                        } ?>>Newest</option>
                      <option value="2" <?php if ($sort_type == 2) {
                                          echo "selected";
                                        } ?>>Price:High to Low</option>
                      <option value="3" <?php if ($sort_type == 3) {
                                          echo "selected";
                                        } ?>>Price:Low to High</option>
                    </select>
                  </div>
                </div>
                <hr class="dt mt-0">
              </div>
              <div class="col-md-12 mt-5 fltr-btn">
                <button class="btn btn-secondary text-dark" id="fl-btn">Filter</button>
                <div class="sbsj-text mt-3 mb-5">
                  <div class="s-option">
                    <label for="sort">Sort-by:</label>
                    <select name="sort" id="sort">
                      <option value="volvo">Best Sellers</option>
                      <option value="saab">Newest</option>
                      <option value="mercedes">Price:High to Low</option>
                      <option value="mercedes">Price:Low to High</option>
                      <option value="audi">Name</option>
                      <option value="audi">Bestseller</option>
                    </select>
                  </div>
                  <div class="opt">
                    <label for="sort">Items:</label>
                    <select name="sort" id="sort">
                      <option value="volvo">36</option>
                      <option value="saab">72</option>
                      <option value="mercedes">144</option>
                    </select>
                  </div>
                </div>
                <hr>
              </div> -->
            </div>
          </div>

          <div class="row w-100">
            <?php $i = 1;
            if (!empty($products_data)) {
              foreach ($products_data as $data) {

                $catalogValues = json_decode($data->catalog_values);
                if (in_array("Unset", $catalogValues)) {
                  // $index = array_search("Unset", $catalogValues);
                  // $array[$index] = "Set";
                  $data2 = $this->db->select('pro_id, full_set_images, images, group_images, series_id, group_id, description, price, catalog_values')
                  ->from('tbl_products')
                  ->where('group_id', $data->group_id)
                  ->where('series_id', $data->series_id)
                  ->where("JSON_SEARCH(catalog_values, 'one', 'Set') IS NOT NULL", null, false)
                  ->get()->row();
                  if (!empty($data2)) {
                    $data = $data2;
                  }
                }
                $full_images = json_decode($data->full_set_images);
                $images = json_decode($data->images);
                $group_images = json_decode($data->group_images);
                $image1 = '';
                $image2 = '';
                if (!empty($full_images)) {
                  if (!empty($full_images[1]) && $full_images[1]->FullUrl) {
                    $image1 = $full_images[0]->FullUrl;
                    $image2 = $full_images[1]->FullUrl;
                  } else {
                    $image1 = $full_images[0]->FullUrl;
                    $image2 = $full_images[0]->FullUrl;
                  }
                } else if (!empty($images)) {
                  if (!empty($images[1]) && $images[1]->FullUrl) {
                    $image1 = $images[0]->FullUrl;
                    $image2 = $images[1]->FullUrl;
                  } else {
                    $image1 = $images[0]->FullUrl;
                    $image2 = $images[0]->FullUrl;
                  }
                } else if (!empty($group_images)) {
                  if (!empty($group_images[1]) && $group_images[1]->FullUrl) {
                    $image1 = $group_images[0]->FullUrl;
                    $image2 = $group_images[1]->FullUrl;
                  } else {
                    $image1 = $group_images[0]->FullUrl;
                    $image2 = $group_images[0]->FullUrl;
                  }
                }
            ?>
                <div class="col-md-3 col-4 searchColumn">
                  <p class="text-center"><i><?= $data->series_id ?></i></p>
                  <a href="<?= base_url() ?>Home/product_details/<?= $data->series_id ?>/<?= $data->pro_id ?>?groupId=<?= $data->group_id ?>">
                    <? if (!empty($image1)) { ?>
                      <img src="<?= $image1 ?>" alt="" class=" img-fluid first_img">
                      <img src="<?= $image2 ? $image2 : $image1 ?>" alt="" class="img-fluid second_img" style="margin-left: 28px;">
                    <? } else { ?>
                      <img src="<?= base_url() ?>assets/uploads/no-image-found.jpg" alt="" class="img-fluid first_img">
                      <img src="<?= base_url() ?>assets/uploads/no-image-found.jpg" alt="" class="img-fluid second_img" style="margin-left: 28px;">
                    <? } ?>
                    <p><b><?= $data->description ?></b></p>
                    <? if (!empty($data->price)) {
                      $this->db->select('*');
                      $this->db->from('tbl_price_rule');
                      $pr_data = $this->db->get()->row();
                      $multiplier = $pr_data->multiplier;
                      $cost_price11 = $pr_data->cost_price1;
                      $cost_price22 = $pr_data->cost_price2;
                      $cost_price33 = $pr_data->cost_price3;
                      $cost_price44 = $pr_data->cost_price4;
                      $cost_price55 = $pr_data->cost_price5;
                      $cost_price = $data->price;
                      $retail = $cost_price * $multiplier;
                      $now_price = $cost_price;
                      if ($cost_price <= 500) {
                        $cost_price2 = $cost_price * $cost_price;
                        $number = round($cost_price * ($cost_price11 * $cost_price2 + $cost_price22 * $cost_price + $cost_price33), 2);
                        $unit = 5;
                        $remainder = $number % $unit;
                        $mround = ($remainder < $unit / 2) ? $number - $remainder : $number + ($unit - $remainder);
                        $now_price = round($mround) - 1 + 0.95;
                      }
                      if ($cost_price > 500) {
                        $number = round($cost_price * ($cost_price44 * $cost_price / $multiplier + $cost_price55));
                        $unit = 5;
                        $remainder = $number % $unit;
                        $mround = ($remainder < $unit / 2) ? $number - $remainder : $number + ($unit - $remainder);
                        $now_price = round($mround) - 1 + 0.95;
                      }
                      $saved = round($retail - $now_price);
                    ?>
                      <p class="price">$<?= number_format($now_price, 2); ?></p>
                    <? } else { ?>
                      <p class="price"><a href="<?= base_url(); ?>Home/contact_us">contact</a></p>
                    <? } ?>
                  </a>
                  </a>
                </div>
              <?php $i++;
              } ?>
          </div>
          <?= $links ?>
        <? } else { ?>
          <div class="text-center">
            <img src="<?= base_url() ?>/assets/frontend/no_data.jpg" style="    max-width: 45%;
height: auto;">
            <h5 class="mt-2">Opps! No Data Found...</h5>
          </div>
        <? } ?>
        </div>
      </div>
    </div>
  </div>
  </div>
  <input type="hidden" value="<?= $level_id; ?>" id="level_id">
</section>