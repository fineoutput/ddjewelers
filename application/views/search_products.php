<!-- all products start-->

<style>
  .tgl {
    font-size: 14px !important;
    font-weight: 400;
  }

  .tab-scroll-bar {
    height: 139px;
    overflow: hidden;
    overflow-y: auto;
  }
  img.img-fluid.first_img{
    width: 75%;
  }
  img.img-fluid.second_img{
    width: 75%;
  }

  .searchColumn {
    margin-bottom: 1.5rem !important;
  }

  .col-md-3.col-12.searchColumn .box-sho {
    padding: 10px;
    height: 320px;
    border: 1px solid #dee2e6 !important;
    border-radius: 5px;
  }

  .col-md-3.col-12.searchColumn .box-sho:hover {
    padding: 10px;
    border: 1px solid #999999 !important;
    height: 320px;
  }

  .col-md-3.col-12.searchColumn .under-box:hover {
    padding: 10px;
    border: 1px solid #918f8f;
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

  p.bold-text {
    margin: 12px 0px;
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

  p.text-center.box-red-2 {
    display: none;
  }



  @media(max-width:572px) {
    p.text-center.box-red {
      display: none;
    }

    p.text-center.box-red-2 {
      display: block;
    }

    p.text-center.box-red-2 {
      margin: 10px 0px;
      display: flex;
    }

    .col-md-12.col-7.rext {
      text-align: start;
    }

    .col-md-3.col-12.searchColumn .box-sho {
      padding: 10px;
      height: 100% !important;
      border: 0px solid #dee2e6 !important;
      border-radius: 5px;
      border-bottom: 1px solid #dee2e6 !important;
    }

    .searchColumn {
      margin-bottom: 0.5rem !important;
    }
  }

  @media(max-width:493px) {
    h1.r-title.fsd {
      font-size: 23px !important;
    }
  }
</style>
<section>
    <div class="container pl-5 pr-5 pt-3 pb-5">
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
                                <h1 class="r-title fsd">
                                    Search Products - <?= $search_string; ?> (<?= $productCount ?>)
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
                                    <div class="box-sho">
                                        <div class="row">
                                            <div class="col-md-12 col-5" style="align-self: center;">
                                                <p class="text-center box-red"><i> <b><?= $data->series_id ?> </b></i></p>
                                                <a href="<?= base_url() ?>Home/product_details/<?= $data->series_id ?>/<?= $data->pro_id ?>?groupId=<?= $data->group_id ?>">
                                                    <? if (!empty($image1)) { ?>
                                                        <img src="<?= $image1 ?>" alt="" class=" img-fluid first_img">
                                                        <img src="<?= $image2 ? $image2 : $image1 ?>" alt="" class="img-fluid second_img" style="">
                                                    <? } else { ?>
                                                        <img src="<?= base_url() ?>assets/uploads/no-image-found.jpg" alt="" class="img-fluid first_img">
                                                        <img src="<?= base_url() ?>assets/uploads/no-image-found.jpg" alt="" class="img-fluid second_img">
                                                    <? } ?></a>
                                            </div>
                                            <div class="col-md-12 col-7 rext">
                                                <p class="text-center box-red-2"><i> <b><?= $data->series_id ?> </b></i></p>

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
                                            </div>
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
                        <?  }
                        } ?>
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