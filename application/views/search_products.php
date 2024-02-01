<!-- all products start-->
<style>
    .img-fluid {
        width: 100% !important;
    }

    .searchColumn {
        margin-bottom: 3.5rem;
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
                                    Search Products - <?= $search_string; ?>
                                </h1>
                            </div>
                        </div>
                    </div>
                    <div class="row w-100">
                        <?php $i = 1;
                        if (!empty($product_data)) {
                            foreach ($product_data->result() as $data) {
                                $catalogValues = json_decode($data->catalog_values);
                                if (in_array("Unset", $catalogValues)) {
                                    $set_data = $this->db->select('pro_id, full_set_images, images, group_images, series_id, group_id, description, price, catalog_values')
                                        ->where(['group_id' => $data->group_id, 'series_id' => $data->series_id])
                                        ->where("JSON_SEARCH(catalog_values, 'one', 'Set') IS NOT NULL", null, false)
                                        ->get('tbl_products')
                                        ->row();
                                    if (!empty($set_data)) {
                                        $data = $set_data;
                                    } else {
                                        $semi_set_data = $this->db->select('pro_id, full_set_images, images, group_images, series_id, group_id, description, price, catalog_values')
                                            ->where(['group_id' => $data->group_id, 'series_id' => $data->series_id])
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

                            <!-- <div class="row justify-content-center w-100">
                                <?= $links ?>
                                <div class="pagination-dropdown row align-items-center">
                                    <label for="page-select">Go to page: </label>
                                    <?= form_dropdown('page-select', $page_options, $current_page, 'class="form-control ml-2 " style="width: auto;" onchange="window.location.href=\'' . base_url("Home/search_product?search_input={$search_string}&page_index=") . '\' + this.value"') ?>
                                </div>
                            </div> -->
                        <?  } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
</section>