<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<style>
  .vodiapicker {
    display: none;
  }

  #a {
    padding-left: 0px;
  }



  #a img, .btn-select img {
    width: 26px;
}

  #a li {
    list-style: none;
    padding-top: 5px;
    padding-bottom: 5px;
  }

  #a li:hover {
    background-color: #F4F3F3;
  }

  #a li img {
    margin: 5px;
  }

  #a li span,
  .btn-select li span {
    margin-left: 2px;
  }

  /* item list */

  .b {
    display: none;
    width: 100%;
    max-width: 350px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
    border: 1px solid rgba(0, 0, 0, .15);
    border-radius: 5px;

  }

  .open {
    display: show !important;
  }

  .btn-select {

    width: 100%;
    max-width: 350px;

    background-color: #fff;
    border: 1px solid #7e7e7e;
    padding: 5px;
  }

  .btn-select li {
    list-style: none;
    float: left;
    padding-bottom: 0px;
  }

  /* .btn-select:hover li {
    margin-left: 0px;
  }

  .btn-select:hover {
    background-color: #F4F3F3;
    border: 1px solid transparent;
    box-shadow: inset 0 0px 0px 1px #ccc;


  } */

  .btn-select:focus {
    outline: none;
  }




















  .slick-slider .slick-prev,
  .slick-slider .slick-next {

    z-index: 100;

    font-size: 2.5em;

    height: 40px;

    width: 40px;

    margin-top: -20px;

    color: #B7B7B7;

    position: absolute;

    top: 50%;

    text-align: center;

    color: #000;

    opacity: .3;

    transition: opacity .25s;

    cursor: pointer;

  }

  .slick-slider .slick-prev:hover,
  .slick-slider .slick-next:hover {

    opacity: .65;

  }

  .slick-slider .slick-prev {

    left: 0;

  }

  .slick-slider .slick-next {
    right: 0;
  }

  #detail .product-images {
    width: 100%;
    margin: 0 auto;
  }

  #detail .product-images li,
  #detail .product-images figure,
  #detail .product-images a,
  #detail .product-images img {

    display: block;

    outline: none;

    border: none;

  }

  #detail .product-images .main-img-slider figure {

    margin: 0 auto;

    padding: 0 2em;

  }

  #detail .product-images .main-img-slider figure a {

    cursor: pointer;

    cursor: -webkit-zoom-in;

    cursor: -moz-zoom-in;

    cursor: zoom-in;

  }

  #detail .product-images .main-img-slider figure a img {

    width: 100%;

    max-width: 400px;

    margin: 0 auto;

  }

  #detail .product-images .thumb-nav {

    margin: 0 auto;

    padding: 20px 10px;

    max-width: 600px;

  }

  #detail .product-images .thumb-nav.slick-slider .slick-prev,
  #detail .product-images .thumb-nav.slick-slider .slick-next {

    font-size: 1.2em;

    height: 20px;

    width: 26px;

    margin-top: -10px;

  }

  #detail .product-images .thumb-nav.slick-slider .slick-prev {

    margin-left: -30px;

  }

  #detail .product-images .thumb-nav.slick-slider .slick-next {

    margin-right: -30px;

  }

  #detail .product-images .thumb-nav li {

    display: block;

    margin: 0 auto;

    cursor: pointer;

  }

  #detail .product-images .thumb-nav li img {

    display: block;

    width: 100%;

    max-width: 75px;

    margin: 0 auto;

    border: 1px solid transparent;

    -webkit-transition: border-color .25s;

    -ms-transition: border-color .25s;

    -moz-transition: border-color .25s;

    transition: border-color .25s;

  }

  #detail .product-images .thumb-nav li:hover,
  #detail .product-images .thumb-nav li:focus {

    border-color: #999;

  }

  #detail .product-images .thumb-nav li.slick-current img {

    border-color: #5f8fb3;

  }

  .img-fluid2 {
    width: 100%;
    height: auto;
  }

  .txt h2 {
    font-size: 18px;
    font-weight: bold;
  }

  .txt td {
    font-size: 14px;
  }

  .txt th td {
    font-size: 14px;
  }

  .qtyminus {
    text-align: center;
    width: auto;
    margin-top: 1rem;
    font-size: 0.9rem;
    /* border: solid grey 1px; */
    /* margin-right: 0.3rem; */
    background: #547f9e;
    border: 0px;
    color: white;
  }

  .qtyplus {
    text-align: center;
    width: auto;
    margin-top: 1rem;
    font-size: 0.9rem;
    /* border: solid grey 1px; */
    /* margin-left: 0.3rem; */
    background: #547f9e;
    border: 0px;
    color: white;
  }

  .orderul {
    text-align: center;
    margin-top: 1rem;
    font-size: 0.9rem;
    border: solid grey 1px;
  }

  .main-img-slider.slick-initialized.slick-slider .slick-next.slick-arrow {
    display: none !important;
  }


  .main-img-slider.slick-initialized.slick-slider .slick-prev.slick-arrow {
    display: none !important;
  }
</style>


<div class="container-fluid ">
  <div class="row">
    <div class="col-md-12 page_span">
      <?= $products->description ?></span></p>
    </div>
    <div class="col-md-12">
      <h1 id="p_title" class="r-title" style="font-weight:600;"><?= $products->description ?></h1>
    </div>
  </div>
  <div class="row mt-1" style="padding-left: 12px;">
    <span style="font-size:1.2rem;margin-top:0px">Item # &nbsp</span>
    <span style="font-size:1.2rem;margin-top:0px" id="p_sku"> <?= "SLR-" . $products->sku ?></span>
    <div class="col-md-9 justify-content-around">
      <? $currentURL = current_url(); ?>
      <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $currentURL ?>" target="blank">
        <i style="color: #3b5998;font-size: 1.2rem;" class="fab fa-facebook-square"></i>
      </a>&nbsp
      <a href="http://twitter.com/share?text=ddjewelers&url=<?= $currentURL ?>">
        <i style="    color: #3b5998;font-size: 1.2rem;" class="fab fa-twitter"></i>
      </a>&nbsp
      <a href="http://pinterest.com/pin/create/button/?url=<?= $currentURL ?>" target="blank">
        <i style="    color: #cb2027;font-size: 1.2rem;" class="fab fa-pinterest"></i>
      </a>&nbsp
      <a href="mailto:?subject=ddjewelers&body=ddjewelers<?= $currentURL ?>" target="blank">
        <i style="    color: #547F9E;font-size: 1.2rem;" class="fa fa-envelope"></i>
      </a>
      <a href="javascript:void(0);" style="margin-left:7px;" data-bs-target="#myModal" data-bs-toggle="modal" data-bs-dismiss="modal" id="myBtn">
        <i style="color: #547F9E;font-size: 1.2rem;" class="fa fa-paper-plane"></i>
      </a>
    </div>
  </div>
  <?
  $images = json_decode($products->full_set_images);
  $elements = json_decode($products->elements);
  $ring_size = json_decode($products->ring_size_data);
  $can_be_set = json_decode($products->can_be_set);
  ?>
  <div class="col-md-12 row mt-5">
    <!-- ----------- START MAIN SLIDER ------------- -->
    <div class="col-md-4">
      <section id="detail">
        <div class="col-md-12 mx-auto">
          <div class="product-images demo-gallery">
            <div class="main-img-slider">
              <?php foreach ($images as $img) :
              ?>
                <a data-fancybox="gallery" href="<?= $img->ZoomUrl ?>"><img src="<?= $img->FullUrl ?>" class="img-fluid2"></a>
              
              <?php endforeach; ?>
            </div>
            <!-- Begin product thumb nav -->
            <ul class="thumb-nav">
              <?php foreach ($images as $img) :
              ?>
                <li><img src="<?= $img->ThumbnailUrl ?>"></li>
              <?php endforeach; ?>
            </ul>
            <!-- End product thumb nav -->
          </div>
        </div>
      </section>
      <div class="row mt-5">
        <div class="col-md-8 m-auto">
          <a href="javascript:void(0)">
            <button type="button" id="view" class="btn w-100" style="background: #547f9e;color: white;">View Full Detail</button>
          </a>
        </div>
        <div class="col-md-8 m-auto">
          <a href="<?= base_url() ?>Home/load_modify_contact/<?= $products->id ?>">
            <button type="button" class="btn w-100 mt-3" style="background-color:#2a2828;color:white"><i class="fa fa-cog" style="color:#edbe68" aria-hidden="true"></i><span> Modify This Style</span></button>
          </a>
        </div>
      </div>
    </div>
    <!-- ----------- END MAIN SLIDER ------------- -->
    <!-- ----------- START MIDDLE SECTION ------------- -->
    <div class="col-md-5 border-le">
      <? if (count($stone_data) > 1) { ?>
        <div class="row">
          <div class="col-md-12">
            <h5>Primary Stone Shape</h5>
            <hr>
          </div>
          <div class="col-md-12 mb-4">
            <div class=" swiper-container swiper-containericon">
              <div class="swiper-wrapper text-center">
                <?php foreach ($stone_data as $st) :
                  if ($st->stone == 'ROUND') {
                    $img = $products->stone == 'ROUND' ? 'round_3.png' : 'round_1.png';
                  } else if ($st->stone == 'CUSHION') {
                    $img = $products->stone == 'CUSHION' ? 'cushion_3.png' : 'cushion_1.png';
                  } else if ($st->stone == 'OVAL') {
                    $img = $products->stone == 'OVAL' ? 'oval_3.png' : 'oval_1.png';
                  } else if ($st->stone == 'EMERALD') {
                    $img = $products->stone == 'EMERALD' ? 'emerald_3.png' : 'emerald_1.png';
                  } else if ($st->stone == 'SQUARE') {
                    $img = $products->stone == 'SQUARE' ? 'square_3.png' : 'square_1.png';
                  } else if ($st->stone == 'PEAR') {
                    $img = $products->stone == 'PEAR' ? 'pear_3.png' : 'pear_1.png';
                  } else if ($st->stone == 'ASSCHER') {
                    $img = $products->stone == 'ASSCHER' ? 'asscher_3.png' : 'asscher_1.png';
                  } else if ($st->stone == 'MARQUISE') {
                    $img = $products->stone == 'MARQUISE' ? 'marquise_3.png' : 'marquise_1.png';
                  } else if ($st->stone == 'HEART') {
                    $img = $products->stone == 'HEART' ? 'heart_3.png' : 'heart_1.png';
                  } else {
                    $img = "";
                  }
                ?>
                  <div class="swiper-slide">
                    <a href="<?= base_url() ?>Home/product_details/<?= $products->series_id ?>/<?= $st->pro_id ?>?groupId=<?= $products->group_id ?>"><img src="<?= base_url() ?>assets\jewel\img\stone_shape\<?= $img ?>" style="width:70%;" class="img-fluid Stone_Shape_img">
                      <p class="h6"><?= $st->stone ?></p>
                    </a>
                  </div>
                <?php endforeach; ?>
              </div>
              <div class="swiper-button-next"></div>
              <div class="swiper-button-prev"></div>
            </div>
          </div>
        </div>
      <? } else { ?>
        <div class="d-flex jus_cont">
          <p><b>Primary Stone</b></p>
          <p><?= $stone_data[0]->stone ?></p>
        </div>
      <? } ?>
      <?php
      $index = 0;
      foreach ($options as  $key => $uniqueOptions) :
        $excludedKeys = ['Series', 'Description', 'Primary Stone Shape'];
        if (in_array($key, $excludedKeys)) {
          $index++;
          continue;
        }
        if (count($uniqueOptions) <= 1) {
          if ($uniqueOptions[0]['DisplayValue'] != 'N/A') {
      ?>
            <div class="d-flex jus_cont">
              <p><b><?php echo $key; ?></b></p>
              <p><?= $uniqueOptions[0]['DisplayValue'] ?></p>
            </div>
          <? }
        } else if ($key == 'Quality') { ?>
          <div class="d-flex jus_cont">
            <p><b><?php echo $key; ?></b></p>
            <select class="w-100 vodiapicker" id="<?php echo $key; ?>" name="<?php echo $key; ?>">
              <?php
              $quality = '';
              foreach ($uniqueOptions as $option) :
                if ($key == 'Quality' && $option['selected'] == 'selected') {
                  $quality  = $option['DisplayValue'];
                }
                $DisplayValue = str_replace("K X1", "K Forever", $option['DisplayValue']);
                if (strpos($DisplayValue, 'Rose')) {
                  $stone = 'rose.png';
                } else if (strpos($DisplayValue, 'White') || strpos($DisplayValue, 'Silver') || strpos($DisplayValue, 'Platinum')) {
                  $stone = 'white.png';
                } else if (strpos($DisplayValue, 'Yellow')) {
                  $stone = 'yellow.png';
                } else if (strpos($DisplayValue, 'black')) {
                  $stone = 'black.png';
                } else if (strpos($DisplayValue, 'white_rose')) {
                  $stone = 'white_rose.png';
                } else if (strpos($DisplayValue, 'rose_white')) {
                  $stone = 'rose_white.png';
                }
              ?>
                <option value="<?php echo $option['value']; ?>" data-key="<?= $index ?>" <?php echo $option['selected']; ?> data-thumbnail="<?= base_url() ?>assets/jewel/img/stone_quality/<?= $stone ?>"> <?php echo $DisplayValue; ?></option>
              <?php endforeach; ?>
            </select>
            <div class="lang-select w-100" style="    position: relative;">
              <button class="btn-select" id="btn_quality" value=""></button>
              <i class="fa fa-angle-down" style="position: absolute;float: right; right: 3%;top: 11px;
"></i>
              <div class="b">
                <ul id="a"></ul>
              </div>
            </div>
          </div>
          <?
          if (strpos($quality, 'Forever') == true) {
            $extra = ' (This is a special "Extreme White" grade gold from a new family of karat white gold casting grain that is formulated to achieve a superior white color whithout the need for rhodium plating)';
          } else if (strpos($quality, 'Palladium') == true) {
            $extra = '(Palladium has a white color that lasts. 950 Palladium is a Platinum Group Metal and is enhanced 95% palladium alloy. Palladium is hypoallergenic and lead-free. It achieves the look and benefits of platinum at half the weight and at a more affordable price. This strong alloy will not tarnish and requires no rhodium plating to retain its bright white color. It will never lose metal weight when poished and is formulated to have the hardness of 14K Gold)';
          } else if (strpos($quality, 'Platinum') == true) {
            $extra = 'Considered the noblest element. Platinum is 30 times more rare than gold, making it the most precious metal. Platinum is also hypoallergenic.)';
          } else if (strpos($quality, 'Continuum') == true) {
            $extra = "(Continuum Sterling Silver is a bright white metal(no rhodium plating required) with more than 95% precious metal content. This patented sterling silver's superior oxidation and tarnish resistance  grade allows for a longer lasting finish.)";
          } else {
            $extra = '';
          }
          if (!empty($extra)) {
          ?>
            <div class="d-flex jus_cont">
              <p>
              </p>
              <p style="color: #547f9e; font-size: 0.8rem;"><?= $extra ?></p>
            </div>
          <? } ?>
        <? } else { ?>
          <div class="d-flex jus_cont">
            <p><b><?php echo $key; ?></b></p>
            <select class="w-100" id="<?php echo $key; ?>" name="<?php echo $key; ?>">
              <?php
              $quality = '';
              foreach ($uniqueOptions as $option) :
                if ($key == 'Quality' && $option['selected'] == 'selected') {
                  $quality  = $option['DisplayValue'];
                }
                $DisplayValue = str_replace("K X1", "K Forever", $option['DisplayValue']);
              ?>
                <option value="<?php echo $option['value']; ?>" data-key="<?= $index ?>" <?php echo $option['selected']; ?>><?php echo $DisplayValue; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        <? } ?>
      <?php $index++;
      endforeach; ?>
      <!-- ----------------- START RING SIZE DROPDOWN ------------ -->
      <? if ($products->ring_sizable) { ?>
        <div class="d-flex jus_cont">
          <p><b>Ring Size</b></p>
          <select class="w-100" id="Ring Size" name="Ring_Size">
            <?php
            foreach ($ring_size as $ring) :
            ?>
              <option value="<?= $ring->Size; ?>" <? if ($ring->Size == $products->ring_size) {
                                                    echo 'selected';
                                                  } ?>><?= $ring->Size; ?></option>e
            <?php endforeach; ?>
          </select>
        </div>
      <? } ?>
      <!-- ----------------- END RING SIZE DROPDOWN ------------ -->
      <div class="d-flex jus_cont">
        <p><b>Description</b></p>
        <p><?= $products->short_description ?></p>
      </div>
    </div>
    <!-- ----------- END MIDDLE SECTION ------------- -->
    <!-- ----------- START RIGHT SECTION ------------- -->
    <div class="col-md-3">
      <?php
      if (!empty($now_price)) {
      ?>
        <div id="price_div">
          <h6 id="p_retail" class="text-right">Retail Price: $<?= number_format($retail, 2); ?></h6>
          <? if ($saved > 0) { ?>
            <p id="p_saved" class="text-right mb-2" style="color:red;">You Saved: $<?= number_format($saved); ?>(<?= round($dis_percent) ?>%)</p>
          <? } ?>
          <h2 class="text-right mb-3" id="p_price" style="color:red; font-weight: 100;font-size:1.7rem;">Now: $<?= number_format($now_price, 2); ?></h2>
        </div>
      <?php } else { ?>
        <a id="no_price" href="<?= base_url(); ?>Home/contact_us">
          <p>CONTACT US FOR PRICE AVAILABILITY </p>
        </a>
      <?php } ?>


      <sup class="float-right">QTY</sup>
      <div class="align-right d-flex  justify-content-end">
        <button class="qtyminus" aria-hidden="true">&minus;</button>
        <input type="number" readonly name="qty" id="qty" min="1" max="20" step="1" value="1" style="text-align:center;margin-top:1rem;width:auto;font-size:0.9rem;">
        <button class="qtyplus" aria-hidden="true">&plus;</button>
      </div>
      <? if (!empty($products->lead_time)) {
        $dd = round($products->lead_time) - 1;
        $NewDate = Date('l, F d', strtotime('+' . $dd . ' days'));
        // echo $dd;die();
        if ($NewDate === Date('l, F d')) {
          $NewDate = "Today";
        }
      ?>
        <div>
          <ul class="orderul">
            <li style="background:#547f9e;color:white; text-transform: uppercase;">
              <? if ($products->status == "Limited Availability") {
                echo $products->status . "<br />(NON-RETURNABLE)";
              } elseif ($products->status == "While Supplies Last") {
                echo $products->status . "<br />(NON-RETURNABLE)";
              } else {
                echo $products->status;
              }

              ?>
            </li>
            <li>
              Ready To Ship: <b><?= $NewDate ?></b>
            </li>
          </ul>
        </div>
      <? } ?>
      <p>
        <b>Quantity in stock: </b><? if (!empty($products->on_hand)) {
                                    echo round($products->on_hand);
                                  } else {
                                    echo "0";
                                  } ?>
      </p>

      <?php if (empty($this->session->userdata('user_id'))) { ?>

        <input type="submit" class="mt-3 add-btn" value=" Add to cart" onclick="addToCartOfflineHandler(this);" quantity="" id="addToCartBtn" data-product-id="<?= $products->id; ?>" data-stuller-product-id="<?= $products->pro_id; ?>" data-category-id="<?= $products->category_id; ?>" data-subcategory-id="<?= $products->subcategory_id; ?>" data-ringsize="" data-ringprice="">
      <?php } else { ?>

        <input type="submit" class="mt-3 add-btn" value=" Add to cart" onclick="addToCartOnlineHandler(this);" quantity="" id="addToCartBtn" data-type-id="" data-product-id="<?= $products->id; ?>" data-stuller-product-id="<?= $products->pro_id; ?>" data-category-id="<?= $products->category_id; ?>" data-subcategory-id="<?= $products->subcategory_id; ?>" data-ringsize="" data-ringprice="" user-id="<?= $this->session->userdata('user_id'); ?>">

      <?php } ?>

      <?php if (empty($this->session->userdata('user_id'))) { ?>
        <input type="submit" class="mt-3 add-btn" value="Add to wishlist" onclick="addToCartOfflineHandler(this);" quantity="" data-product-id="<?= $products->id; ?>" data-stuller-product-id="<?= $products->pro_id; ?>" data-category-id="<?= $products->category_id; ?>" data-subcategory-id="<?= $products->subcategory_id; ?>">
      <?php } else { ?>
        <input type="submit" class="mt-3 add-btn" value="Add to wishlist" onclick="addToCartOnlineHandler(this)" quantity="" data-type-id="" data-product-id="<?= $products->id; ?>" data-stuller-product-id="<?= $products->pro_id; ?>" data-category-id="<?= $products->category_id; ?>" data-subcategory-id="<?= $products->subcategory_id; ?>" user-id="<?= $this->session->userdata('user_id'); ?>">
      <?php } ?>
      <div class="d-flex justify-content-between p-2 pb-4">
        <div>
          <a href="<?= base_url(); ?>Home/contact_us"><button class="btn" style="background:#2a2828;color:white;"><i class="fa fa-fw fa-envelope" aria-hidden="true"></i>Contact</button></a>
          <a href="<?= base_url(); ?>Home/contact_us"><button class="btn" style="background:#2a2828;color:white;"><i class="fa fa-fw fa-calendar" aria-hidden="true"></i>Appointment</button></a>
        </div>
      </div>

      <div class="col-md-12">
        <h2>Ask a Question</h2>
        <form action="<?= base_url() ?>Home/ask_question" method="post" enctype="multipart/form-data">
          <input type="hidden" name="product_id" value="<?= $products->id; ?>">
          <input class="form-control mb-3" name="name" type="text" placeholder="Name" required />
          <input class="form-control mb-3" name="email" type="email" placeholder="Email Address" required />
          <input class="form-control mb-3 mobilenumbers" name="phone" type="number" placeholder="Phone Number" />
          <textarea class="form-control mb-3" name="query" placeholder="What can we help you with?" required></textarea>
          <script src="https://www.google.com/recaptcha/api.js" async defer></script>
          <div class="g-recaptcha" name="g-recaptcha-response" data-sitekey="6LeGH_QmAAAAAESodt2Bw0XfNXuFfy0SkwMXOaQl"></div>
          <button class="enq_btn" type="submit">
            <i class="fa fa-envelope"></i>
            Inquire
          </button>
        </form>
      </div>
    </div>
    <!-- ----------- END RIGHT SECTION ------------- -->
  </div>
  <!-- ===================== START MORE FOR YOU =========================== -->
  <? if (!empty($more_products)) { ?>
    <div class="row " style="margin-top: 5.5rem!important;">
      <div class="col-md-12 txt">
        <h2>More Items to Consider</h2>
        <hr>
      </div>
      <div class="col-md-12">
        <div class=" swiper-container swiper-containernew">
          <div class="swiper-wrapper text-center">
            <?php
            foreach ($more_products as $data) {
              $images = json_decode($data->full_set_images);
            ?>
              <div class="swiper-slide" style="margin-top:3rem;">
                <p><b><?= $data->series_id ?></b></p>
                <a href="<?= base_url() ?>Home/product_details/<?= $data->series_id ?>/<?= $data->pro_id ?>?groupId=<?= $data->group_id ?>">
                  <img src="<?= $images[0]->FullUrl ?>" class="img-responsive small_mob" style="margin-bottom: 1rem;">
                  <p><?= $data->description ?></p>
                </a>
              </div>
            <?php }   ?>
          </div>
          <div class="swiper-button-next"></div>
          <div class="swiper-button-prev"></div>
        </div>
      </div>
    </div>
  <? } ?>
  <!-- ===================== END MORE FOR YOU =========================== -->
  <!-- ===================== START SUGGESTED FOR YOU =========================== -->
  <? if (!empty($suggested_products)) { ?>
    <div class="row " style="margin-top: 5.5rem!important;">
      <div class="col-md-12 txt">
        <h2>Suggested for you</h2>
        <hr>
      </div>
      <div class="col-md-12">
        <div class=" swiper-container swiper-containernew">
          <div class="swiper-wrapper text-center">
            <?php
            foreach ($suggested_products as $data) {
              $images = json_decode($data->full_set_images);
            ?>
              <div class="swiper-slide" style="margin-top:3rem;">
                <p><b><?= $data->series_id ?></b></p>
                <a href="<?= base_url() ?>Home/product_details/<?= $data->series_id ?>/<?= $data->pro_id ?>?groupId=<?= $data->group_id ?>">
                  <img src="<?= $images[0]->FullUrl ?>" class="img-responsive small_mob" style="margin-bottom: 1rem;">
                  <p><?= $data->description ?></p>
                </a>
              </div>
            <?php }   ?>
          </div>
          <div class="swiper-button-next"></div>
          <div class="swiper-button-prev"></div>
        </div>
      </div>
    </div>
  <? } ?>
  <!-- ===================== END SUGGESTED FOR YOU =========================== -->
  <!-- ====================== START SPECIFICATIONS ================= -->
  <div class="row mt-4">
    <div class="col-md-12 txt" id="specification">
      <h2>Specifications</h2>
      <table class="detailsTable">
        <tbody id="specf">
          <tr>
            <td>Weight</td>
            <td><?= $products->weight ?> grams</td>
          </tr>
          <?
          $specs = json_decode($products->specification);
          if (!empty($specs)) {
            foreach ($specs as $spd) {
          ?>
              <tr>
                <td><? echo $spd->Name ?> </td>
                <td><? echo $spd->Value ?> </td>
              </tr> <? }
                } ?>
        </tbody>
      </table>
    </div>
  </div>
  <!-- ====================== END SPECIFICATIONS ================= -->

  <!-- ====================== START ADDITIONAL DETAILS ================= -->
  <div class="row mt-4">
    <div class="col-md-12 txt">
      <h2>Additional Details</h2>
    </div>
    <div class="col-md-12">
      <ul class="detailsTable newjf">
        <li>We do not normally stock this item.</li>
        <li>Out of Stock and Special Order items will ship when available.</li>
      </ul>
    </div>
  </div>
  <!-- ====================== END ADDITIONAL DETAILS ================= -->
  <!-- ====================== START CAN BE SET WITH ================= -->
  <? if (!empty($can_be_set)) { ?>
    <div class="row mt-4 comesetwith">
      <div class="col-md-12 txt">
        <h2>Can Be Set With</h2>
      </div>
      <div class="col-md-12 txt">
        <table class="table table-bordered">
          <thead>
            <tr style="background-color: #f5f5f5;">
              <th>Quantitity</th>
              <th>Stone</th>
              <th>Size</th>
              <th>Setting Type</th>
            </tr>
          </thead>
          <tbody id="canbe">
            <? foreach ($can_be_set as $SetWith) { ?>
              <tr>
                <td><? if (!empty($SetWith->Quantity)) {
                      echo $SetWith->Quantity;
                    } ?> </td>
                <td> <? if (!empty($SetWith->Shape)) {
                        echo $SetWith->Shape;
                      } ?></td>
                <td> <? if (!empty($SetWith->Size)) {
                        echo $SetWith->Size;
                      } ?></td>
                <td> <? if (!empty($SetWith->SettingType)) {
                        echo $SetWith->SettingType;
                      } ?></td>
              </tr>
            <? } ?>
          </tbody>
        </table>

      </div>
    </div>
  <? } ?>
  <!-- ====================== END CAN BE SET WITH ================= -->
</div> <!-- Container end -->



<input name="ring_size" id="r_size" type="hidden" value="<?= $products->ring_size ?>">
<script>
  jQuery(document).ready(function() {
    //----------- DROPDOWN CHANGE ---------------
    $('select').on('change', function() {
      if (this.name == "Ring_Size") {
        $('#r_size').val(this.value);
        return
      }
      var selectedOption = this.options[this.selectedIndex];
      var dataKeyValue = selectedOption.getAttribute('data-key');
      $.ajax({
        url: "<?= base_url() ?>Home/GetProductId",
        method: "POST",
        data: {
          pro_id: '<?= $products->pro_id ?>',
          group_id: '<?= $products->group_id ?>',
          series_id: '<?= $products->series_id ?>',
          catalog_key: dataKeyValue,
          catalog_value: this.value,
        },
        dataType: 'json',
        success: function(response) {
          if (response.status == 200) {
            location.href = '<?= base_url() ?>Home/product_details/<?= $products->series_id ?>/' + response.message + '?groupId=<?= $products->group_id ?>';
          } else {
            alert(response.message)
            location.reload(true);
          }
        }
      })
    });
    //initialize swiper when document ready
    var mySwiper = new Swiper('.swiper-containericon', {
      slidesPerView: 6,
      spaceBetween: 10,
      breakpoints: {
        '300': {
          slidesPerView: 3,
          spaceBetween: 30,
        },
        '400': {
          slidesPerView: 3,
          spaceBetween: 30,
        },
        '500': {
          slidesPerView: 4,
          spaceBetween: 40,
        },
        '600': {
          slidesPerView: 4,
          spaceBetween: 40,
        },
        '767': {
          slidesPerView: 6,
          spaceBetween: 30,
        },
      },
      // Optional parameters
      freeMode: true,
      loop: false,
      scrollbar: {
        el: '.swiper-scrollbar',
        hide: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },

    })

    $(".carousel-control-prev").click(function() {
      $("#myCarousel").carousel("prev");
    });
    $(".carousel-control-next").click(function() {
      $("#myCarousel").carousel("next");
    });
    //----------------------
    $("#view").click(function() {
      $('html,body').animate({
          scrollTop: $("#specification").offset().top
        },
        'slow');
    });

  });
  //------ qty-----------

  var input = document.querySelector('#qty');
  var btnminus = document.querySelector('.qtyminus');
  var btnplus = document.querySelector('.qtyplus');

  if (input !== undefined && btnminus !== undefined && btnplus !== undefined && input !== null && btnminus !== null && btnplus !== null) {

    var min = Number(input.getAttribute('min'));
    var max = Number(input.getAttribute('max'));
    var step = Number(input.getAttribute('step'));

    function qtyminus(e) {
      var current = Number(input.value);
      var newVal = (current - step);
      input.value = Number(newVal);
      $("#qty").val(newVal)
    }

    function qtyplus(e) {
      var current = Number(input.value);
      var newVal = (current + step);
      if (newVal > max) newVal = max;
      input.value = Number(newVal);
      $("#qty").val(newVal)
    }
  }
</script>
<script>
  //test for getting url value from attr
  // var img1 = $('.test').attr("data-thumbnail");
  // console.log(img1);

  //test for iterating over child elements
  var langArray = [];
  $('.vodiapicker option').each(function() {
    var img = $(this).attr("data-thumbnail");
    var text = this.innerText;
    var value = $(this).val();
    var item = '<li><img src="' + img + '" alt="" value="' + value + '"/><span>' + text + '</span></li>';
    langArray.push(item);
  })

  $('#a').html(langArray);

  //Set the button value to the first el of the array
  $('.btn-select').html(langArray[0]);
  $('.btn-select').attr('value', 'en');

  //change button stuff on click
  $('#a li').click(function() {
    var img = $(this).find('img').attr("src");
    var value = $(this).find('img').attr('value');
    var text = this.innerText;
    var item = '<li><img src="' + img + '" alt="" /><span>' + text + '</span></li>';
    $('.btn-select').html(item);
    $('.btn-select').attr('value', value);
    $(".b").toggle();
    //console.log(value);
  });

  $(".btn-select").click(function() {
    $(".b").toggle();
  });

  //check local storage for the lang
  var sessionLang = localStorage.getItem('lang');
  if (sessionLang) {
    //find an item with value of sessionLang
    var langIndex = langArray.indexOf(sessionLang);
    $('.btn-select').html(langArray[langIndex]);
    $('.btn-select').attr('value', sessionLang);
  } else {
    var langIndex = langArray.indexOf('ch');
    console.log(langIndex);
    $('.btn-select').html(langArray[langIndex]);
    //$('.btn-select').attr('value', 'en');
  }
</script>



<!-- product details end -->