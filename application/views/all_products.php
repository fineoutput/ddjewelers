<!-- all products start-->
<style>
  .tgl {
    font-size: 14px !important;
    font-weight: 400;
  }
.tab-scroll-bar{
  height: 139px;
    overflow: hidden;
    overflow-y: auto;
}
.searchColumn {
    margin-bottom: 1.5rem !important;
}
.col-md-3.col-12.searchColumn .under-box {
    padding: 10px;
    height: 320px;
    border: 1px solid #dee2e6!important;
    border-radius: 5px;
  }
  .col-md-3.col-12.searchColumn .under-box:hover {
    padding: 10px;
    border: 1px solid #999999 !important;
    height: 320px;
}


/* width */
.tab-scroll-bar::-webkit-scrollbar {
  width: 5px;
}


/* Handle */
.tab-scroll-bar::-webkit-scrollbar-thumb {
  background: #5f8fb3; 
  border-radius: 10px;
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


  /* new css add 28/2/2024 */
@media(max-width:570px){
  .col-md-3.col-12.searchColumn div {
  display: flex;
  flex-direction:row-reverse;
  align-items: center;
}
.col-md-3.col-12.searchColumn div p.price {
    margin-bottom: 0px;
}
img.img-fluid.first_img{
  width: 60%;
}
img.img-fluid.second_img{
  width: 60%;
}
.col-md-3.col-12.searchColumn .under-box {
    padding: 10px;
    border: 0px !important; 
    /* border-top:  1px solid #c4c4c4;; */
    border-bottom:  1px solid #c4c4c4 !important;
    height: 151px;
}
p.bold-text {
    position: absolute;
    left: revert;
    right: 12px;
    width: 61%;
    bottom: 31%;
}
.col-md-3.col-12.searchColumn div p.price {
    margin-bottom: 0px;
    position: absolute;
    width: 62%;
    right: 66px;
    bottom: 15px;
}
p.text-center.box-red {
    position: relative;
    top: -32%;
    text-align: start !important;
}
.under-box div img.img-fluid.first_img {
  display: flex;
}

}
@media (max-width: 395px){
  p.bold-text {
    position: absolute;
    left: revert;
    right: 0px;
    width: 61%;
    bottom: 22%;
}
.col-md-3.col-12.searchColumn div p.price {
    margin-bottom: 0px;
    position: absolute;
    width: 62%;
    right: 56px;
}
p.text-center.box-red {
    position: relative;
    top: -32%;
    right: 16px;
}
}

</style>
<section>
  <div class="container-fluid pl-5 pr-5 pt-3 pb-5">
    <div class="row">
      <div class="col-md-12 page_span">
        <p><a href="<?= base_url() ?>"><span>Home</span></a> >
          <?php if (!empty($subcategory_name)) { ?>
            <a href="<?= base_url(); ?>Home/sub_category/<?= $category_id ?>"><span><?= $category_name; ?></span></a>
            <?php if (!empty($minorsub2_name)) { ?>
              > <span><?= $subcategory_name; ?></span> > <span><?= $minorsub_name; ?> > <span><?= $minorsub2_name; ?></span>
        </p>
      <?php } else  if (!empty($minorsub_name)) { ?>
        > <span><?= $subcategory_name; ?></span> > <span><?= $minorsub_name; ?></span>
        </p>
      <?php } else if (!empty($subcategory_name)) { ?>
        > <span><?= $subcategory_name; ?></span> </p>
      <?php } ?>
    <?php } else { ?>
      <span><?= $category_name; ?></span>
    <?php } ?>
      </div>
    </div>
    <?
    $priceRanges = array(
      array('min' => 0, 'max' => 500),
      array('min' => 501, 'max' => 1000),
      array('min' => 1001, 'max' => 1500),
      array('min' => 1501, 'max' => 2000),
      array('min' => 2001, 'max' => 2500),
      array('min' => 2501, 'max' => 3000),
      // Add more ranges as needed
    );
    ?>
    <div class="row ">
      <div class="col-md-3 all_pro_fil ">
        <form action="<?= base_url() ?>Home/all_products/<?= $idd ?>/<?= $t ?>" method="get">
          <div class="d-flex align-items-center justify-content-between" style="    margin-bottom: 6px;">
            <button type="submit" class="add-btn" style="width:50% ;     margin-right: 2px;">Apply</button>

            <button class="add-btn" style="width: 50%;margin-left:2px;     background: #75b0da;">
            <a href="<?= base_url() ?>Home/all_products/<?= $idd ?>/<?= $t ?>">
              Reset
            </a></button>
          </div>
          <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
              <div class="panel-heading " role="tab" id="heading1">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="false" aria-controls="collapse1">
                    Price Range
                  </a>
                </h4>
              </div>
              <div id="collapse1" class="panel-collapse in collapse fil_2 tab-scroll-bar" role="tabpanel" aria-labelledby="heading1">
                <div class="panel-body p-2">
                  <?php foreach ($priceRanges as $range) {
                    $min = $range['min'];
                    $max = $range['max'];
                    $value = $min . '-' . $max;
                  ?>
                    <input type="checkbox" name="price_range[]" value="<?= $value ?>" <?= (in_array($value, $filters['price_range'])) ? 'checked' : '' ?>> $<?= $min ?> - $<?= $max ?> <br>
                  <?php } ?>
                </div>
              </div>
            </div>
            <? if (!empty($jewelry_state)) { ?>
              <div class="panel panel-default">
                <div class="panel-heading " role="tab" id="heading2">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="true" aria-controls="collapse2">
                      Jewellery State
                    </a>
                  </h4>
                </div>
                <div id="collapse2" class="panel-collapse in collapse fil_2 tab-scroll-bar" role="tabpanel" aria-labelledby="heading2">
                  <div class="panel-body p-2">
                    <? foreach ($jewelry_state as $item) {
                    ?>
                      <input type="checkbox" name="jewelry_state[]" value="<?= $item ?>" <?php if (in_array($item, $filters['jewelry_state'])) echo 'checked'; ?>> <?= $item ?> <br>
                    <? } ?>
                  </div>
                </div>
              </div>
            <? } ?>
            <? if (!empty($stone_shape)) { ?>
              <div class="panel panel-default">
                <div class="panel-heading " role="tab" id="heading3">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="true" aria-controls="collapse3">
                      Primary Stone Shape
                    </a>
                  </h4>
                </div>
                <div id="collapse3" class="panel-collapse in collapse fil_2 tab-scroll-bar" role="tabpanel" aria-labelledby="heading3">
                  <div class="panel-body p-2">
                    <? foreach ($stone_shape as $item) {
                    ?>
                      <input type="checkbox" name="stone_shape[]" value="<?= $item ?>" <?php if (in_array($item, $filters['stone_shape'])) echo 'checked'; ?>> <?= $item ?> <br>
                    <? } ?>
                  </div>
                </div>
              </div>
            <? } ?>
            <? if (!empty($stone_size)) { ?>
              <div class="panel panel-default">
                <div class="panel-heading " role="tab" id="heading4">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse4" aria-expanded="true" aria-controls="collapse4">
                      Primary Stone Size
                    </a>
                  </h4>
                </div>
                <div id="collapse4" class="panel-collapse in collapse fil_2 tab-scroll-bar" role="tabpanel" aria-labelledby="heading4">
                  <div class="panel-body p-2">
                    <? foreach ($stone_size as $item) {
                    ?>
                      <input type="checkbox" name="stone_size[]" value="<?= $item ?>" <?php if (in_array($item, $filters['stone_size'])) echo 'checked'; ?>> <?= $item ?> <br>
                    <? } ?>
                  </div>
                </div>
              </div>
            <? } ?>
            <? if (!empty($stone_type)) { ?>
              <div class="panel panel-default">
                <div class="panel-heading " role="tab" id="heading5">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse5" aria-expanded="true" aria-controls="collapse5">
                      Primary Stone Type
                    </a>
                  </h4>
                </div>
                <div id="collapse5" class="panel-collapse in collapse fil_2 tab-scroll-bar" role="tabpanel" aria-labelledby="heading5">
                  <div class="panel-body p-2">
                    <? foreach ($stone_type as $item) {
                    ?>
                      <input type="checkbox" name="stone_type[]" value="<?= $item ?>" <?php if (in_array($item, $filters['stone_type'])) echo 'checked'; ?>> <?= $item ?> <br>
                    <? } ?>
                  </div>
                </div>
              </div>
            <? } ?>
            <? if (!empty($setting_method)) { ?>
              <div class="panel panel-default">
                <div class="panel-heading " role="tab" id="heading6">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse6" aria-expanded="true" aria-controls="collapse5">
                      Setting Method
                    </a>
                  </h4>
                </div>
                <div id="collapse6" class="panel-collapse in collapse fil_2 tab-scroll-bar" role="tabpanel" aria-labelledby="heading6">
                  <div class="panel-body">
                  </div>
                </div>
              </div>
            <? } ?>

          </div>
        </form>
      </div>
      <div class="col-md-9">
        <div class="row justify-content-center">
          <div class="col-md-12 mt-2">
            <div class="row ">
              <div class="col-md-12 mb-4 hrds">
                <h1 class="r-title">
                  <?= $heading . " ( " . $productCount . " )"; ?>
                </h1>
                <?
                if (!empty($banner)) {
                ?>
                  <img src="<?php echo base_url() . $banner ?>" alt="img">
                <?
                }
                ?>
                <?
                if (!empty($description)) {
                ?>
                  <h6 class="mt-3 mb-4"><i><?= $description; ?></i></h6>
                <?
                }
                ?>
              </div>


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
            if ($type == 2) { //---- minor2 category
              $column = "minor2_category_id";
            } else if ($type == 1) { //---- minor category
              $column = "minor_category_id";
            } else if ($type == 3) { //---- category
              $column = "category_id";
            } else { //---- subactegory
              $column = "subcategory_id";
            }
            if (!empty($products_data)) {
              foreach ($products_data as $data) {

                $catalogValues = json_decode($data->catalog_values);
                if (in_array("Unset", $catalogValues)) {
                  $set_data = $this->db->select('pro_id, full_set_images, images, group_images, series_id, group_id, group_description, price, catalog_values')
                    ->where(['group_id' => $data->group_id, 'series_id' => $data->series_id, $column => $idd])
                    ->where("JSON_SEARCH(catalog_values, 'one', 'Set') IS NOT NULL", null, false)
                    ->get('tbl_products')
                    ->row();
                  if (!empty($set_data)) {
                    $data = $set_data;
                  } else {
                    $semi_set_data = $this->db->select('pro_id, full_set_images, images, group_images, series_id, group_id, group_description, price, catalog_values')
                      ->where(['group_id' => $data->group_id, 'series_id' => $data->series_id, $column => $idd])
                      ->where("JSON_SEARCH(catalog_values, 'one', 'Semi-Set') IS NOT NULL", null, false)
                      ->get('tbl_products')
                      ->row();
                    if (!empty($semi_set_data)) {
                      $data = $semi_set_data;
                    }
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
                <div class="col-md-3  col-sm-6 col-12 searchColumn">
                  <div class="under-box">
                   
                  <p class="text-center box-red"><i> <b><?= $data->series_id ?> </b></i></p>
                  <div>
                  <a href="<?= base_url() ?>Home/product_details/<?= $data->series_id ?>/<?= $data->pro_id ?>?groupId=<?= $data->group_id ?>">
                    <? if (!empty($image1)) { ?>
                      <img src="<?= $image1 ?>" alt="" class=" img-fluid first_img">
                      <img src="<?= $image2 ? $image2 : $image1 ?>" alt="" class="img-fluid second_img" style="margin-left: 28px;">
                    <? } else { ?>
                      <img src="<?= base_url() ?>assets/uploads/no-image-found.jpg" alt="" class="img-fluid first_img">
                      <img src="<?= base_url() ?>assets/uploads/no-image-found.jpg" alt="" class="img-fluid second_img" style="margin-left: 28px;">
                    <? } ?>
          
                    <p class="bold-text"><b><?= $data->group_description ?></b></p>
                    <? if (!empty($data->price)) {
                      $this->db->select('*');
                      $this->db->from('tbl_price_rule');
                      $this->db->where('name', 'Product');
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
                      <p class="price box-trft">$<?= number_format($now_price, 2); ?></p>
                    <? } else { ?>
                      <p class="price box-trft"><a href="<?= base_url(); ?>Home/contact_us">contact</a></p>
                    <? } ?>
                  </a>
                  </div>
                  </div>
                </div>
              <?php $i++;
              } ?>
              <div class="row justify-content-center w-100">
                <?
                if ($current_page != "all") {
                  echo $links;
                  if (count($page_options) > 1) { ?>
                    <div class="pagination-dropdown row align-items-center">
                      <label for="page-select">Go to page: </label>
                      <?= form_dropdown('page-select', $page_options, $current_page, 'class="form-control ml-2 " style="width: auto;" onchange="handleChange(this)"') ?>
                    </div>
              </div>
          <? }
                }
              } else { ?>
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
<script>
  function handleChange(selectElement) {
    var selectedOption = selectElement.options[selectElement.selectedIndex].text;
    var selectedValue = selectElement.options[selectElement.selectedIndex].value;
    if (selectedOption === 'Show All') {
      window.location.href = '<?= base_url("Home/all_products/{$idd}/{$t}/all") ?>';
    } else {
      window.location.href = '<?= base_url("Home/all_products/{$idd}/{$t}/") ?>' + selectedValue;
    }
  }
</script>