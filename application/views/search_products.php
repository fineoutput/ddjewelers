<!-- all products start-->
<style>
    .img-fluid {
        width: 100% !important;
        margin: auto;
    }

    .searchColumn {
        margin-bottom: 3.5rem;
    }



    /* new css add 28/2/2024 */
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
    right: 62px;
 
    bottom: 15px;
}
p.text-center.box-red {
    position: relative;
    top: -32%;
    text-align: start !important;
    right: -47px;
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
    right: -32px;

}
}

</style>
<section>
    <div class="container-fluid pl-5 pr-5 pt-3 pb-5">
        <div class="row">
            <div class="col-md-12 page_span">
                <p><a href="<?= base_url() ?>"><span>Home</span></a> > Search Products
            </div>
        </div>
        <div class="row ">

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="row ">
                            <div class="col-md-12 mb-4 hrds">
                                <h1 class="r-title">
                                    Search Products - <?= $search_string; ?> (<?=$productCount?>)
                                </h1>
                            </div>
                        </div>
                    </div>
                    <div class="row w-100">
                        <?php $i = 1;
                        if (!empty($product_data)) {
                            foreach ($product_data as $data) {
                                $catalogValues = json_decode($data->catalog_values);
                                if (in_array("Unset", $catalogValues)) {
                                    $set_data = $this->db->select('pro_id, full_set_images, images, group_images, series_id, group_id, group_description, price, catalog_values')
                                        ->where(['group_id' => $data->group_id, 'series_id' => $data->series_id])
                                        ->where("JSON_SEARCH(catalog_values, 'one', 'Set') IS NOT NULL", null, false)
                                        ->like("search_values", $string)
                                        ->get('tbl_products')
                                        ->row();
                                    if (!empty($set_data)) {
                                        $data = $set_data;
                                    } else {
                                        $semi_set_data = $this->db->select('pro_id, full_set_images, images, group_images, series_id, group_id, group_description, price, catalog_values')
                                            ->where(['group_id' => $data->group_id, 'series_id' => $data->series_id])
                                            ->where("JSON_SEARCH(catalog_values, 'one', 'Semi-Set') IS NOT NULL", null, false)
                                            ->like("search_values", $string)
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
                            } 
                            if ($page_index != "all") {
                            ?>
                            <div class="row justify-content-center w-100">
                                <div class="pagination-dropdown row align-items-center">
                                    <label for="page-select">Go to page: </label>
                                    <?= form_dropdown('page-select', $page_options, $page_index, 'class="form-control ml-2 " style="width: auto;" onchange="handleChange(this)"') ?>
                                </div>
                            </div>
                        <?  }} ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
</section>
<script>
    function handleChange(selectElement) {
        var selectedOption = selectElement.options[selectElement.selectedIndex].text;
        var selectedValue = selectElement.options[selectElement.selectedIndex].value;
        if (selectedOption === 'Show All') {
            var x = '<?= base_url("Home/search_result/{$search}/all") ?>';

        } else {
            var x = '<?= base_url("Home/search_result/{$search}/") ?>' + selectedValue;
        }
        // console.log(x)
        location.replace(x)
    }
</script>