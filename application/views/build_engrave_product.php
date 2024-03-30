<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<style>
  .swiper-slide.slider-main-box {
    width: auto !important;
    margin: 4px !important;
  }

  .arrow-1 {
    top: 33%;
  }

  .top-slider-image {
    width: 30px !important;
  }

  .scroller {
    overflow-y: scroll;
    scrollbar-color: #1f1f2200 #bada5500;
    scroll-behavior: smooth;
  }

  .col-md-12.mb-4.box-slider-111 .swiper-container.swiper-containericon.swiper.swiper-initialized.swiper-horizontal.swiper-pointer-events.swiper-backface-hidden .text-center {
    transform: translate3d(0px, 10px, 10px) !important;
  }

  @media screen and (min-width: 1024px) and (max-width: 1440px) {
    .top-slider-image {
      width: 30px !important;
    }

  }

  .vodiapicker {
    display: none;
  }



  .sorting {
    font-size: 12px !important;
  }

  table.dataTable tbody th,
  table.dataTable tbody td {
    padding: 5px 5px !important;
    font-size: 12px !important;
  }

  .btn-info {
    font-size: 14px !important;
    padding: 5px 15px !important;
  }

  .paginate_button {
    font-size: 12px !important;
  }

  .dataTables_wrapper .dataTables_filter input {
    padding: 0px !important;
  }

  .dataTables_wrapper .dataTables_length select {
    padding: 0px !important;

  }

  #a {
    padding-left: 0px;
  }



  #a img,
  .btn-select img {
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

  .top-slider-image {
    /* width: 70% !important; */
  }

  @media(max-width:2560px) {
    .swiper-backface-hidden .swiper-slide {
      margin-right: -66px;
    }

    .top-slider-image {
      /* width: 53% ; */
    }
  }

  .swiper-slide.slider-main-box p.h6 {
    font-size: 0.8rem;
  }

  @media screen and (min-width: 1024px) and (max-width: 1440px) {
    .swiper-backface-hidden .swiper-slide {
      margin-right: -17px;
    }

    /* .top-slider-image {
    width: 100% !important ;
} */
    .swiper-backface-hidden .swiper-slide {
      margin-right: -15px;
      width: 82px;
    }

    .swiper-backface-hidden .swiper-slide a p.h6 {
      font-size: 11px;
    }

    .swiper-backface-hidden .swiper-slide {
      margin-right: -15px;
    }
  }

  .font-image {
    width: 50%;
  }
</style>

<?
if ($products->is_quick == 1) {
  $catData = $this->db->get_where('tbl_quickshop_category', array('id' => $products->category_id))->row();
  $subCatData = $this->db->get_where('tbl_quickshop_subcategory', array('id' => $products->subcategory_id))->row();
  $minor1Data = $this->db->get_where('tbl_quickshop_minisubcategory', array('id' => $products->minor_category_id))->row();
  $minor2Data = $this->db->get_where('tbl_quickshop_minisubcategory2', array('id' => $products->minor2_category_id))->row();
} else {
  $catData = $this->db->get_where('tbl_category', array('id' => $products->category_id))->row();
  $subCatData = $this->db->get_where('tbl_sub_category', array('id' => $products->subcategory_id))->row();
  $minor1Data = $this->db->get_where('tbl_minisubcategory', array('id' => $products->minor_category_id))->row();
  $minor2Data = $this->db->get_where('tbl_minisubcategory2', array('id' => $products->minor2_category_id))->row();
}

?>
<div class="container mt-3 ">

  <div class="row">
    <div class="col-md-12 page_span">
      <p>
        <?= $catData ? $catData->name  : '' ?>
        <?= $subCatData ? ' > ' . $subCatData->name : '' ?>
        <?= $minor1Data ? ' > ' . $minor1Data->name  : '' ?>
        <?= $minor2Data ? ' > ' . $minor2Data->name : '' ?>
      </p>
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
  $full_images = json_decode($products->full_set_images);
  $images = json_decode($products->images);
  $group_images = json_decode($products->group_images);
  $setting_options = json_decode($products->setting_options);
  $engraving_options = json_decode($products->engraving_options);
  $location_images = $images;
  $all_images = [];
  if (!empty($full_images)) {
    $all_images = $full_images;
  } else if (!empty($images)) {
    $all_images = $images;
  } else if (!empty($group_images)) {
    $all_images = $group_images;
  }
  $elements = json_decode($products->elements);
  $ring_size = json_decode($products->ring_size_data);
  $can_be_set = json_decode($products->can_be_set);
  $videos = json_decode($products->videos);
  ?>
  <div class="col-md-12 row mt-5 p-0">
    <!-- ----------- START MAIN SLIDER ------------- -->
    <div class="col-md-4 col-xl-4 col-xxl-4">
      <section id="detail">
        <div class="col-md-12 mx-auto">
          <? if (!empty($all_images)) { ?>
            <div class="product-images demo-gallery">
              <div class="main-img-slider">
                <? if (!empty($videos[0]->DownloadUrl) && strpos($videos[0]->DownloadUrl, ".mp4") !== false) { ?>
                  <!-- =============== video =============== -->
                  <a data-fancybox="gallery" href="<?= $videos[0]->DownloadUrl ?>">
                    <video width="100%" height="100%" loop autoplay muted>
                      <source type="video/mp4" src="<?= $videos[0]->DownloadUrl ?>" class="img-fluid gc-zoom">
                    </video> </a>
                  <!-- =============== video end =============== -->
                <? } ?>
                <?php foreach ($all_images as $img) :
                ?>
                  <a data-fancybox="gallery" href="<?= $img->ZoomUrl ?>"><img src="<?= $img->ZoomUrl ?>" class="img-fluid2"></a>
                <?php endforeach; ?>
              </div>
              <!-- Begin product thumb nav -->
              <ul class="thumb-nav">
                <? if (!empty($videos[0]->DownloadUrl) && strpos($videos[0]->DownloadUrl, ".mp4") !== false) { ?>
                  <!-- =============== video =============== -->
                  <li><img src="<?= base_url() ?>assets/frontend/play.png"></li>
                <? } ?>
                <!-- =============== video end =============== -->
                <?php foreach ($all_images as $img) :
                ?>
                  <li><img src="<?= $img->ThumbnailUrl ?>"></li>
                <?php endforeach; ?>
              </ul>
              <!-- End product thumb nav -->
            </div>
          <? } else { ?>
            <img src="<?= base_url() ?>assets/uploads/no-image-found.jpg" alt="" class="img-fluid first_img">
          <? } ?>
        </div>
      </section>
      <div class="row mt-5">
        <div class="col-md-12 m-auto">
          <a href="javascript:void(0)">
            <button type="button" id="view" class="btn w-100" style="background: #547f9e;color: white;">View Full Detail</button>
          </a>
        </div>
        <div class="col-md-12 m-auto">
          <a href="<?= base_url() ?>Home/load_modify_contact/<?= $products->id ?>">
            <button type="button" class="btn w-100 mt-3" style="background-color:#2a2828;color:white"><i class="fa fa-cog" style="color:#edbe68" aria-hidden="true"></i><span> Modify This Style</span></button>
          </a>
        </div>
      </div>
    </div>
    <!-- ----------- END MAIN SLIDER ------------- -->
    <!-- ----------- START MIDDLE SECTION ------------- -->
    <div class="col-md-5 col-xl-5 col-xxl-5  border-le">
      <? if (count($stone_data) > 1 && !empty($stone_data[0]->stone) && $stone_data[0]->stone != "N/A" && $products->stone != "N/A") { ?>
        <div class="row">
          <div class="col-md-12">
            <h5>Primary Stone Shape</h5>
            <hr>
          </div>
          <div class="col-md-12 mb-4 box-slider-111">
            <div class=" swiper-container ">
              <div class="swiper-wrapper text-center scroller">
                <?php foreach ($stone_data as $st) :
                  if (!empty($st->stone) && $st->stone != "N/A") {
                    if (strtolower($st->stone) == strtolower('ROUND')) {
                      $img = strtolower($products->stone) == strtolower('ROUND') ? 'round_2.png' : 'round_1.png';
                    } else if (strtolower($st->stone) == strtolower('CUSHION')) {
                      $img = strtolower($products->stone) == strtolower('CUSHION') ? 'cushion_2.png' : 'cushion_1.png';
                    } else if (strtolower($st->stone) == strtolower('OVAL')) {
                      $img = strtolower($products->stone) == strtolower('OVAL') ? 'oval_2.png' : 'oval_1.png';
                    } else if (strtolower($st->stone) == strtolower('EMERALD')) {
                      $img = strtolower($products->stone) == strtolower('EMERALD') ? 'emerald_2.png' : 'emerald_1.png';
                    } else if (strtolower($st->stone) == strtolower('SQUARE')) {
                      $img = strtolower($products->stone) == strtolower('SQUARE') ? 'square_2.png' : 'square_1.png';
                    } else if (strtolower($st->stone) == strtolower('PEAR SHAPE')) {
                      $img = strtolower($products->stone) == strtolower('PEAR SHAPE') ? 'pear_2.png' : 'pear_1.png';
                    } else if (strtolower($st->stone) == strtolower('ASSCHER')) {
                      $img = strtolower($products->stone) == strtolower('ASSCHER') ? 'asscher_2.png' : 'asscher_1.png';
                    } else if (strtolower($st->stone) == strtolower('MARQUISE')) {
                      $img = strtolower($products->stone) == strtolower('MARQUISE') ? 'marquise_2.png' : 'marquise_1.png';
                    } else if (strtolower($st->stone) == strtolower('HEART SHAPE')) {
                      $img = strtolower($products->stone) == strtolower('HEART SHAPE') ? 'heart_2.png' : 'heart_1.png';
                    } else if (strtolower($st->stone) == strtolower('STRAIGHT BAGUETTE')) {
                      $img = strtolower($products->stone) == strtolower('STRAIGHT BAGUETTE') ? 'straight_baguette_2.png' : 'straight_baguette_1.png';
                    } else {
                      $img = "";
                    }
                ?>
                    <div class="swiper-slide slider-main-box">
                      <a href="<?= base_url() ?>Home/product_details/<?= $products->series_id ?>/<?= $st->pro_id ?>?groupId=<?= $products->group_id ?>"><img src="<?= base_url() ?>assets\jewel\img\stone_shape\<?= $img ?>" class="img-fluid Stone_Shape_img top-slider-image">
                      </a>
                      <p class="h6"><?= $st->stone ?></p>
                    </div>

                <?php }
                endforeach; ?>
              </div>
              <!-- <div class="swiper-button-next "></div>
              <div class="swiper-button-prev "></div> -->
            </div>
          </div>
        </div>
      <? } else if (!empty($stone_data[0]->stone && $stone_data[0]->stone != "N/A")) { ?>
        <div class="d-flex jus_cont">
          <p><b>Primary Stone</b></p>
          <p><?= $stone_data[0]->stone ?></p>
        </div>
      <? } ?>
      <? if (!empty($setting_options)) { ?>

        <div class="d-flex jus_cont">
          <p><b>Gem Stone</b></p>
          <button type="button" id="gem_btn" class="btn add-btn" data-toggle="modal" data-target="#myModal">
            Set Stone
          </button>
          <div id="gem_div" class="w-100" style="display:none">
          </div>
        </div>
      <? } ?>
      <!-- //------------------- START ENGRAVING SECTION ---------- -->
      <?
      $eng_data = [];
      if (!empty($engraving_options)) {
        foreach ($engraving_options as $loop => $engrave) {
          if ($engrave->Description == "Logo" || $engrave->Description == "LOGO") {
            continue;
          }
          $eng_data[] = [
            "id" => $loop,
            "Description" => $engrave->Description,
            "Text" => null,
            "Font" => null,
            "Color" => null
          ];
      ?>
          <div class="d-flex jus_cont">
            <p><b><?= $engrave->Description ?></b></p>
            <button type="button" id="en_div_btn_<?= $loop ?>" class="btn add-btn" onclick='openEngrave(<?= json_encode($engrave) ?>,<?= $loop ?>)'>
              Engrave
            </button>
            <div id="en_div_<?= $loop ?>" class="w-100" style="display:none">
            </div>
          </div>
      <? }
      } ?>
      <!-- //------------------- END ENGRAVING SECTION ---------- -->
      <?php
      $index = 0;
      foreach ($options as  $key => $uniqueOptions) :
        $excludedKeys = ['Series', 'Description', 'Primary Stone Shape', 'Clarity, Color :: CTW', 'SERIES', 'Primary Stone Size', 'Finished State'];
        if (in_array($key, $excludedKeys)) {
          $index++;
          continue;
        }
        if (!empty($uniqueOptions) && count($uniqueOptions) <= 1) {
          if ($uniqueOptions[0]['DisplayValue'] != 'N/A' && !empty($uniqueOptions[0]['DisplayValue'])) {
      ?>
            <div class="d-flex jus_cont">
              <p><b><?php echo $key; ?></b></p>
              <p><?= $uniqueOptions[0]['DisplayValue'] ?></p>
            </div>
          <? }
        } else if ($key == 'Quality') { ?>
          <div class="d-flex jus_cont">
            <p><b>Metal</b></p>
            <select class="w-100 " id="<?php echo $key; ?>" name="<?php echo $key; ?>">
              <?php
              $quality = '';
              $stone = '';
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
            <!-- <div class="lang-select w-100" style="position: relative;">
              <button class="btn-select" id="btn_quality" value=""></button>
              <i class="fa fa-angle-down" style="position: absolute;float: right; right: 3%;top: 11px;
"></i>
              <div class="b">
                <ul id="a"></ul>
              </div>
            </div> -->
          </div>
          <?
          if (stripos($quality, 'X1') !== false) {
            $extra = ' (This is a special "Extreme White" grade gold from a new family of karat white gold casting grain that is formulated to achieve a superior white color whithout the need for rhodium plating)';
          } else if (stripos($quality, 'Palladium') !== false) {
            $extra = '(Palladium has a white color that lasts. 950 Palladium is a Platinum Group Metal and is enhanced 95% palladium alloy. Palladium is hypoallergenic and lead-free. It achieves the look and benefits of platinum at half the weight and at a more affordable price. This strong alloy will not tarnish and requires no rhodium plating to retain its bright white color. It will never lose metal weight when poished and is formulated to have the hardness of 14K Gold)';
          } else if (stripos($quality, 'Platinum') !== false) {
            $extra = 'Considered the noblest element. Platinum is 30 times more rare than gold, making it the most precious metal. Platinum is also hypoallergenic.)';
          } else if (stripos($quality, 'Continuum') !== false) {
            $extra = "(Continuum Sterling Silver is a bright white metal(no rhodium plating required) with more than 95% precious metal content. This patented sterling silver's superior oxidation and tarnish resistance  grade allows for a longer lasting finish.)";
          } else {
            $extra = '';
          }
          if (!empty($extra)) {
          ?>
            <div class="d-flex jus_cont" style="margin-top:-25px">
              <p>
              </p>
              <p style="color: #547f9e; font-size: 0.8rem;"><?= $extra ?></p>
            </div>
          <? } ?>
        <? } else if (!empty($uniqueOptions)) { ?>
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
      <? if ($products->ring_sizable && !empty($ring_size)) { ?>
        <div class="d-flex jus_cont">
          <p><b>Ring Size</b></p>
          <select class="w-100" id="Ring Size" name="Ring_Size">
            <?php
            foreach ($ring_size as $ring) :
            ?>
              <option value="<?= $ring->Size; ?>" data-price="<?= $ring->Price->Value ?>" <? if ($ring->Size == $products->ring_size) {
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
    <div class="col-md-3 col-xl-3 col-xxl-3">
      <?php
      if (!empty($now_price)) {
      ?>
        <div id="price_div">
          <h6 class="text-right">Retail Price: $<span id="r_price"><?= number_format($retail, 2); ?></span></h6>
          <? if ($saved > 0) { ?>
            <p class="text-right mb-2" style="color:red;">You Saved: $<span id="s_price"><?= number_format($saved); ?></span>(<span id="d_price"><?= round($dis_percent) ?></span>%)</p>
          <? } ?>
          <h2 class="text-right mb-3" style="color:red; font-weight: 100;font-size:1.7rem;">Now: $<span id="p_price"><?= number_format($now_price, 2); ?></span></h2>
        </div>
      <?php } else { ?>
        <a id="no_price" href="<?= base_url(); ?>Home/contact_us">
          <p>CONTACT US FOR PRICE AVAILABILITY </p>
        </a>
      <?php } ?>


      <!-- <sup class="float-right">QTY</sup>
      <div class="align-right d-flex  justify-content-end">
        <button class="qtyminus" aria-hidden="true">&minus;</button>
        <input type="number" readonly name="qty" id="qty" min="1" max="20" step="1" value="1" style="text-align:center;margin-top:1rem;width:auto;font-size:0.9rem;">
        <button class="qtyplus" aria-hidden="true">&plus;</button>
      </div> -->
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

      <?php
      if ($cart_status == 0) {
        if (empty($this->session->userdata('user_id'))) {
      ?>
          <input type="submit" class="mt-3 add-btn" value=" Add to cart" onclick="addToCart(this);" quantity="" id="addToCartBtn" data-pro-id="<?= $products->pro_id; ?>" data-ring_size="<?= $products->ring_size ?>" data-ring_price="<?= $sizePrice ?>" data-gem-data="" data-price="" data-img="" data-is_engrave="1" data-engrave='<?= json_encode($eng_data) ?>'>
        <?php } else { ?>
          <input type="submit" class="mt-3 add-btn" value=" Add to cart" onclick="addToCart(this);" quantity="" id="addToCartBtn" data-pro-id="<?= $products->pro_id; ?>" data-ring_size="<?= $products->ring_size ?>" data-ring_price="<?= $sizePrice ?>" data-gem-data="" data-price="" data-img="" data-is_engrave="1" data-engrave='<?= json_encode($eng_data) ?>'>
        <?php }
      } else { ?>
        <a href="<?= base_url() ?>Cart/view_cart"><button class="mt-3 add-btn" style="background-color:#547f9e" type="button">Go to cart</button></a>
      <? } ?>
      <button class="mt-3 add-btn" id="loader" disabled style="display:none">
        <i class="fa fa-spinner fa-spin"></i> Loading...
      </button>
      <!-- <?php if (!empty($this->session->userdata('user_id'))) { ?>
        <input type="submit" class="mt-3 add-btn" id="wishBtn" value="Add to wishlist" onclick="wishlist(this)" data-pro-id="<?= $products->pro_id; ?>" status="add">
      <?php } ?> -->
      <div class="d-flex justify-content-between p-2 pb-4">

        <a href="<?= base_url(); ?>Home/contact_us"><button class="btn d-flex" style="background:#2a2828;color:white;     align-items: center; margin: 2px;"><i class="fa fa-fw fa-envelope" aria-hidden="true"></i>Contact</button></a>
        <a href="<?= base_url(); ?>Home/contact_us"><button class="btn d-flex" style="background:#2a2828;color:white; align-items: center;    margin: 2px;"><i class="fa fa-fw fa-calendar" aria-hidden="true"></i>Appointment</button></a>

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
    <div class=" container-fluid p-0 row " style="margin-top: 2.5rem!important;">
      <div class="col-md-12 p-0 txt">
        <h2>More Items to Consider</h2>
        <hr>
      </div>
      <div class="col-md-12 p-0">
        <div class=" swiper-container swiper-containernew">
          <div class="swiper-wrapper text-center">
            <?php
            foreach ($more_products as $data) {
              $full_images = json_decode($data->full_set_images);
              $images = json_decode($data->images);
              $group_images = json_decode($data->group_images);
              if (!empty($full_images)) {
                $all_images = $full_images;
              } else if (!empty($images)) {
                $all_images = $images;
              } else if (!empty($group_images)) {
                $all_images = $group_images;
              }
            ?>
              <div class="swiper-slide" style="margin-top:3rem;">
                <p><b><?= $data->series_id ?></b></p>
                <a href="<?= base_url() ?>Home/product_details/<?= $data->series_id ?>/<?= $data->pro_id ?>?groupId=<?= $data->group_id ?>">
                  <img src="<?= $all_images[0]->FullUrl ?>" class="img-responsive small_mob" style="margin-bottom: 1rem;">
                  <p><?= $data->group_description ?></p>
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
    <div class="row container-fluid" style="margin-top: 2.5rem!important;">
      <div class="col-md-12 txt">
        <h2>Suggested for you</h2>
        <hr>
      </div>
      <div class="col-md-12">
        <div class=" swiper-container swiper-containernew">
          <div class="swiper-wrapper text-center">
            <?php
            foreach ($suggested_products as $data) {
              $full_images = json_decode($data->full_set_images);
              $images = json_decode($data->images);
              $group_images = json_decode($data->group_images);
              if (!empty($full_images)) {
                $all_images = $full_images;
              } else if (!empty($images)) {
                $all_images = $images;
              } else if (!empty($group_images)) {
                $all_images = $group_images;
              }
            ?>
              <div class="swiper-slide" style="margin-top:3rem;">
                <p><b><?= $data->series_id ?></b></p>
                <a href="<?= base_url() ?>Home/product_details/<?= $data->series_id ?>/<?= $data->pro_id ?>?groupId=<?= $data->group_id ?>">
                  <img src="<?= $all_images[0]->FullUrl ?>" class="img-responsive small_mob" style="margin-bottom: 1rem;">
                  <p><?= $data->group_description ?></p>
                </a>
              </div>
            <?php }   ?>
          </div>
          <div class="swiper-button-next arrow-1"></div>
          <div class="swiper-button-prev arrow-1"></div>
        </div>
      </div>
    </div>
  <? } ?>
  <!-- ===================== END SUGGESTED FOR YOU =========================== -->
  <!-- ====================== START SPECIFICATIONS ================= -->
  <div class="container-fluid row mt-4">
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
  <div class=" container-fluid row mt-4">
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
    <div class="container-fluid row mt-4 comesetwith">
      <div class="col-md-12 txt">
        <h2>Can Be Set With</h2>
      </div>
      <div class="col-md-12 txt">
        <table class="table table-bordered">
          <thead>
            <tr style="background-color: #f5f5f5;">
              <th>Quantity</th>
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
<!-- Container end -->
<!-- ====================== START STONE LOCATION MODEL ============================== -->
<div class="modal fade" id="myModal">
  <div class="dizzy-gillespie" style="position: absolute;left: 0;right: 0;top: 0; bottom: 0;margin:  auto;display:none;z-index: 99999;     background: #125965;" id='modelLoader'></div>
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Stone Locations</h4>
        <button type="button" class="close" id="myModalBtn" data-dismiss="modal">&times;</button>
      </div>


      <!-- Modal body -->
      <div class="modal-body" id="StoneLocation">

        <div class="row">
          <div class="col-md-4">
            <img src="<?= $products->stone_map_image ? $products->stone_map_image : null ?>" class="img-fluid2" id="preview_src">
          </div>
          <div class="col-md-8">
            <div class="table-responsive-sm">
              <? if (!empty($setting_options)) { ?>
                <table class="table table-hover" id="StonesTable">
                  <tbody>
                    <?php
                    $groupCounts = [];
                    // Iterate over the data to count each group
                    foreach ($setting_options as $st) {
                      if (!empty($st->GroupName)) {
                        $groupName = $st->GroupName;
                        
                      } else {
                        $groupName = $st->Shape;
                      }
                      if (!empty($groupCounts)) {
                        $groupCounts[$groupName] = ($groupCounts[$groupName] ?? 0) + 1;
                      } else {
                        $groupCounts[$groupName] = 0;
                        if (stripos($groupName, "stone") !== false) {
                          break;
                        }
                      }
                    }
                    foreach ($groupCounts as $groupName => $count) :
                      $groupItems = array_filter($setting_options, function ($item) use ($groupName) {
                        if (!empty($item->GroupName)) {
                          return $item->GroupName == $groupName;
                        } else {
                          return $item->Shape == $groupName;
                        }
                      });
                      $groupItems = array_values($groupItems);
                      $uniqueSizes = array_unique(array_column($groupItems, 'SizeMM'));
                      // echo $count;
                      if (count($groupCounts) == 1 || $groupName == 'Center') {
                    ?>
                        <tr>
                          <td style="text-align: left;padding: 8px; vertical-align: -webkit-baseline-middle;"><?= $groupName ?>
                            <? if ($count > 1) { ?>
                              <br><span style="color: #998b7d;font-size: 11px;"><b><?= $count . ' stones'; ?></b></span>
                            <? } ?>
                          </td>
                          <td style="vertical-align: -webkit-baseline-middle;"><? if ($count == 1) {
                                                                                  if ($groupItems[0]->Dimension2 != 0) {
                                                                                    echo $size = $groupItems[0]->Dimension1 . 'mm x ' . $groupItems[0]->Dimension2 . 'mm';
                                                                                  } else {
                                                                                    echo $size = $groupItems[0]->Dimension1 . 'mm';
                                                                                  }
                                                                                } else {
                                                                                  // If there are multiple unique SizeMM values, print "Varying Sizes"
                                                                                  if ($groupItems[0]->Dimension2 != 0) {
                                                                                    echo $size = count($uniqueSizes) > 1 ? "Varying Sizes" : $groupItems[0]->Dimension1 . 'mm x ' . $groupItems[0]->Dimension2 . 'mm';
                                                                                  } else {
                                                                                    echo $size = $groupItems[0]->Dimension1 . 'mm';
                                                                                  }
                                                                                } ?></td>
                          <td><button class="add-btn" onclick="fetchStoneFamily(this)" data-modelID="<?= $products->config_model_id ?>" data-size="<?= $size ?>" data-count="<?= $count ?>" data-groupName="<?= $groupName ?>" data-LocationNumber="<?= $groupItems[0]->LocationNumber ?>" data-group-count="<?= count($groupCounts) ?>">Select</button></td>
                        </tr>
                    <?php
                      }
                    endforeach; ?>
                  </tbody>
                </table>
              <? } ?>
            </div>
            <!-- --------------- START SELECT STONE -------- -->
            <div id="stonesList">
            </div>
            <!-- --------------- END SELECT STONE -------- -->
            <!-- --------------- START SELECT STONE -------- -->
            <div id="sideStonesList">
            </div>
            <!-- --------------- END SELECT STONE -------- -->
            <!-- --------------- START SELECT STONE TYPES -------- -->
            <div id="stonesTypes">
            </div>
            <!-- --------------- END SELECT STONE TYPES-------- -->
            <!-- --------------- START SET STONE TABLE -------- -->
            <div id="setStonesTable">
            </div>
            <!-- --------------- END SET STONE TABLE-------- -->
            <!-- --------------- START SET FINAL  -------- -->
            <div id="setFinal">
            </div>
            <!-- --------------- END SET FINAL-------- -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- ====================== END STONE LOCATION MODEL ============================== -->





<!-- <style>
  .fade:not(.show) {
    opacity: 1;
}
</style> -->




<!-- ====================== START ENGRAVE MODAL  ============================== -->
<div class="modal fade" id="engraveModal">
  <div class="dizzy-gillespie" style="position: absolute;left: 0;right: 0;top: 0; bottom: 0;margin:       auto;   display:none;z-index: 99999;     background: #125965;" id='modelLoader'></div>
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">ENGRAVING & PATTERNS</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">

        <div class="row">
          <div class="col-md-12">
            <p class="mb-0" style="font-size:12px">PRECISION LASER ENGRAVING</p>
            <h2 id="en_head"></h2>
            <div class="engravingOption">
              <p class="mb-1">Engraving Type</p>
              <p class="mb-2" style="font-size:16px" id="en_type"></p>
            </div>
          </div>
        </div>

        <div class="row align-items-center">
          <div class="col-md-12 ">
            <p class="mb-0">Message</p>
            <p style="color:red;font-size:12px">Max length : <span id="en_max"></span></p>
          </div>
          <div class="col-md-6">
            <div class="message-box">
              <div class="d-flex align-items-center model-top-box">
                <input type="text" class="w-100 py-2 " name="" id="en_message" maxlength="">
                <!-- <span class="input-group-addon u-border-radius-0 t-ui-label">0/8</span> -->
              </div>
            </div>
          </div>
          <!-- <div class="col-md-6">
            <img id="en_img" src="https://meteor.stullercloud.com/?src=(das/75898418?recipe=white&size=405,55&fmt=png)&src=(?text=&text.size=50px&text.color=%23000000&text.insetshadow=2&text.font=das/4784143&size=405,55&fmt=png)&hei=42&fmt=smart-alpha" style="height: 46px;">
          </div> -->
        </div>
        <div class="row align-items-center mt-3">
          <div class="col-md-12 ">
            <p class="mb-0">Font</p>
          </div>
          <div class="col-md-12">
            <div class="message-box" id="font-box">
              <select name="en_font" id="en_font" class="py-2 w-100">
              </select>

            </div>
          </div>

        </div>
        <div class="row align-items-center mt-3">
          <div class="col-md-12 ">
            <p class="mb-1">Color</p>
          </div>
          <div class="col-md-12">
            <div class="row m-auto" id="en_color">

            </div>
          </div>

        </div>
        <div class="row align-items-center mt-3">
          <div class="col-md-12" style="text-align: end;">
            <div class="floatRight rightMarginLarge bottomPadding">

              <!-- <a href="#" class="engravingModalButtons c-red rightMargin">Reset This Location</a>

              <div class="u-inline-block u-margin-left-10">
                <button class="sbtn sbtn-secondary">Cancel</button>
              </div> -->
              <div class="u-inline-block u-margin-left-10">
                <button type="button" class="sbtn sbtn-primary" id="save_btn">Save</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ====================== END ENGRAVE MODEL ============================== -->








<input name="temp_data" id="temp_data" type="hidden" value="">
<input name="ring_size" id="r_size" type="hidden" value="<?= $products->ring_size ?>">
<input name="r_price" id="r_price" type="hidden" value="<?= $sizePrice ?>">
<input name="proId" id="proId" type="hidden" value="<?= $products->pro_id ?>">
<input name="engrave_index" id="engrave_index" type="hidden" value="">
<input name="engrave_color" id="engrave_color" type="hidden" value="">
<input name="is_gems" id="is_gems" type="hidden" value="<? if (!empty($setting_options)) {
                                                          echo "1";
                                                        } ?>">

<script>
  jQuery(document).ready(function() {
    //----------- DROPDOWN CHANGE ---------------
    $('select').on('change', function() {
      if (this.name == "en_font") {
        return
      }

      if (this.name == "Ring_Size") {
        var selectedOption = this.options[this.selectedIndex];
        var dataKeyValue = selectedOption.getAttribute('data-price');
        $('#r_size').val(this.value);
        $('#r_price').val(dataKeyValue);
        //------ calculate updated price -----
        $.ajax({
          url: "<?= base_url() ?>Home/UpdatePrice",
          method: "POST",
          data: {
            pro_id: '<?= $products->pro_id ?>',
            price: dataKeyValue,
          },
          dataType: 'json',
          success: function(response) {
            if (response.status == 200) {
              $("#r_price").html(response.data.retail);
              $("#s_price").html(response.data.saved);
              $("#d_price").html(response.data.dis_percent);
              $("#p_price").html(response.data.now_price);
            } else {
              // alert(response.message)
              // location.reload(true);
            }
          }
        })
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
    // var mySwiper = new Swiper('.swiper-containericon', {
    //   slidesPerView: 6,
    //   spaceBetween: 10,
    //   breakpoints: {
    //     '300': {
    //       slidesPerView: 3,
    //       spaceBetween: 30,
    //     },
    //     '400': {
    //       slidesPerView: 3,
    //       spaceBetween: 30,
    //     },
    //     '500': {
    //       slidesPerView: 4,
    //       spaceBetween: 40,
    //     },
    //     '600': {
    //       slidesPerView: 4,
    //       spaceBetween: 40,
    //     },
    //     '767': {
    //       slidesPerView: 6,
    //       spaceBetween: 30,
    //     },

    //     '1220': {
    //       slidesPerView: 8,
    //       spaceBetween: 30,
    //     },
    //     '1440': {
    //       slidesPerView: 8,
    //       spaceBetween: 30,
    //     },
    //     '2660': {
    //       slidesPerView: 8,
    //       spaceBetween: 30,
    //     },
    //   },
    //   // Optional parameters
    //   freeMode: true,
    //   loop: false,
    //   scrollbar: {
    //     el: '.swiper-scrollbar',
    //     hide: true,
    //   },
    //   navigation: {
    //     nextEl: '.swiper-button-next',
    //     prevEl: '.swiper-button-prev',
    //   },

    // })


    //     const swiper = new Swiper('.swiper', {
    //   // Optional parameters
    //   freeMode: true,
    //   loop: false, 
    //       scrollbar: {
    //         el: '.swiper-scrollbar',
    //         hide: true,
    //       },
    //   centeredSlides: true,
    //   // Navigation arrows
    //   navigation: {
    //     nextEl: '.swiper-button-next',
    //     prevEl: '.swiper-button-prev',
    //   },
    //   breakpoints: {
    //     // when window width is >= 320px
    //     768: {
    //       loop: true, 
    //       slidesPerView: 5,
    //       spaceBetween: 30

    //     },
    //     // when window width is >= 480px
    //     1024: {
    //       slidesPerView: 6,
    //       spaceBetween: 40
    //     },
    //     // when window width is >= 640px
    //     1280: {
    //       slidesPerView: 7,
    //       spaceBetween: 50
    //     }
    //   }
    // });
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

  //----------- ENGRAVE MODAL -------------
  function openEngrave(obj, id) {
    $("#en_head").html(obj.Description + " Engraving");
    var en_type = obj.Types[0];
    $("#en_type").html(en_type.Name);
    $('#en_font').html('');
    $('#en_color').html('');
    var fonts;
    var colors = [];
    // en_type.Fonts.map(function(font, i) {
    //   if (i == 0) {
    //     $("#en_max").html(font.MaxCharacters);
    //     $("#en_message").attr("maxlength", font.MaxCharacters);
    //   }
    //   fonts += '<option value="' + font.Name + '">' + font.Name + '</option>';
    // });
    // $('#en_font').append(fonts);
    var fonts = en_type.Fonts.map(function(font) {
      return {
        id: font.Name,
        text: font.Name,
        imageUrl: font.SampleImage, // Store image URL in a data attribute
      };
    });
    // Check if Select2 instance exists
    var isSelect2Initialized = $('#en_font').data('select2');

    // If Select2 instance exists, destroy it
    if (isSelect2Initialized) {
      $('#en_font').select2('destroy');
    }

    // Update Select2
    $('#en_font').select2({
      data: fonts,
      templateResult: formatOption, // Use custom formatting function
      templateSelection: formatOptionSelection, // Use custom formatting function for selected option
    });

    // Custom formatting function to apply font family and image to options
    function formatOption(option) {
      if (!option.id) {
        return option.text;
      }
      var imageUrl = option.imageUrl;
      return $(
        '<span><img src="' + imageUrl + '" class="font-image" /><span style="font-size:12px">'+option.text+'</span></span>'
      );
    }

    // Custom formatting function for the selected option
    function formatOptionSelection(option) {
      return $(
        '<span><img src="' + option.imageUrl + '" class="font-image" /><span style="font-size:12px">'+option.text+'</span></span>'
      );
    }

    // Set initial MaxCharacters value
    if (en_type.Fonts.length > 0) {
      $("#en_max").html(en_type.Fonts[0].MaxCharacters);
      $("#en_message").attr("maxlength", en_type.Fonts[0].MaxCharacters);
    }

    // Update MaxCharacters and maxlength when selecting a new font
    $('#en_font').on('change', function() {
      var selectedFont = $(this).find(":selected");
      $("#en_max").html(selectedFont.data("maxcharacters"));
      $("#en_message").attr("maxlength", selectedFont.data("maxcharacters"));
    });
    var index = en_type.FillOptions.findIndex(function(option) {
      return option.Name == 'Enamel Color' || option.Name == 'Enamel Color Family';
    });
    if (index == -1) {
      index = 0;
    }
    en_type.FillOptions[index].Colors.map(function(color) {
      colors += '<div class="col-md-2 engravingFillColorContainer" id="color_btn_' + color.Name + '" onclick="en_change(\'font\',\'' + color.Name + '\')"><div class="engravingFillColor" style="background-color:' + color.Name + '"></div><span>' + color.Name + '</span></div>';
    });
    $('#en_color').append(colors);
    $("#engrave_index").val(id);
    var $j = jQuery.noConflict();
    $j('#engraveModal').modal('show');
  };


  function en_change(type, value = "") {
    // var img_path = $('#en_img').attr("src");
    // var id = $("#engrave_index").val();
    // var myElement = document.getElementById("addToCartBtn");
    // var eng_data = JSON.parse(myElement.getAttribute("data-engrave"));
    // var index = eng_data.findIndex(function(element) {
    //   return element.id == id;
    // });
    if (type == 'font') {
      var className = "selectedEngravingFillColor";
      // Remove class from all elements with a specific class
      var elements = document.querySelectorAll("." + className);
      elements.forEach(function(element) {
        element.classList.remove(className);
      });
      var myElement = document.getElementById("color_btn_" + value);
      // Add a new class to the element
      myElement.classList.add(className);
      $("#engrave_color").val(value);

      // if (index !== -1) {
      //   eng_data[index].Font = 'hello';
      // }
      // myElement.setAttribute("data-engrave", JSON.stringify(eng_data));
    } else if (type == "color") {
      // if (index !== -1) {
      //   eng_data[index].Color = 'hello2';
      // }
      // myElement.setAttribute("data-engrave", JSON.stringify(eng_data));
    } else if (type == "message") {
      // var newTextValue = $("#en_message").val();
      // if (index !== -1) {
      //   eng_data[index].Text = newTextValue;
      // }
      // myElement.setAttribute("data-engrave", JSON.stringify(eng_data));
      // var new_path = img_path.replace(/text=&/, 'text=' + encodeURIComponent(newTextValue) + '&')
    }
    // $('#en_img').attr("src", new_path);
  }

  document.getElementById("save_btn").addEventListener("click", function() {
    var id = $("#engrave_index").val();
    var color = $("#engrave_color").val();
    var newTextValue = $("#en_message").val();
    var selectElement = document.getElementsByName("en_font")[0];
    var selectedValue = selectElement.options[selectElement.selectedIndex].value;
    if (newTextValue == "") {
      loadErrorNotify('Message filed is required!');
      return;
    } else if (selectedValue == '') {
      loadErrorNotify('Font filed is required!');
      return;

    } else if (color == '') {
      loadErrorNotify('Color filed is required!');
      return;

    }
    //---- get add to cart buttom engrave json ----
    var myElement = document.getElementById("addToCartBtn");
    var eng_data = JSON.parse(myElement.getAttribute("data-engrave"));
    var index = eng_data.findIndex(function(element) {
      return element.id == id;
    });
    //---- update add to cart buttom engrave json ----
    if (index !== -1) {
      eng_data[index].Text = newTextValue;
      eng_data[index].Font = selectedValue;
      eng_data[index].Color = color;
      myElement.setAttribute("data-engrave", JSON.stringify(eng_data));
    }
    // var buttonElement = document.getElementById('en_div_btn_' + id);
    var buttonElement = $('#en_div_' + id).html();
    html = "<div class='row m-0 justify-content-between'><span><b>" + newTextValue + "</b></span><a href='javascript:void(0)' id='remove_" + id + "' onclick='reset_engrave(" + id + ")' style='color:red'>Reset</a></div>"
    $("#en_div_" + id).html(html);
    $("#en_div_btn_" + id).hide();
    $("#en_div_" + id).show();
    var $j = jQuery.noConflict();
    $j('#engraveModal').modal('hide');
  });

  function reset_engrave(id) {
    //---- get add to cart buttom engrave json ----
    var myElement = document.getElementById("addToCartBtn");
    var eng_data = JSON.parse(myElement.getAttribute("data-engrave"));
    var index = eng_data.findIndex(function(element) {
      return element.id == id;
    });
    //---- update add to cart buttom engrave json ----
    if (index !== -1) {
      eng_data[index].Text = null;
      eng_data[index].Font = null;
      eng_data[index].Color = null;
      myElement.setAttribute("data-engrave", JSON.stringify(eng_data));
    }
    $("#en_div_" + id).html('');
    $("#font-box").html('');
    $("#font-box").html('<select name="en_font" id="en_font" class="py-2 w-100"></select>');
    $("#en_div_" + id).hide('');
    
    setTimeout(() => {
      $("#en_div_btn_" + id).show();
    }, 500);
  }
  //------------- START SaveStone -------------------------
  function SaveStone(obj) {
    var myElement = document.getElementById("addToCartBtn");
    var ProductId = obj.getAttribute('data-pro-id');
    var ring_size = obj.getAttribute('data-ring_size');
    var ring_price = obj.getAttribute('data-ring_price');
    var gem_data = obj.getAttribute('data-gem-data');

    var pricetext = obj.getAttribute('data-price');
    var price = parseFloat(pricetext);
    var basePriceText = $("#p_price").text();
    var basePrice = parseFloat(basePriceText);
    var finalprice = price+basePrice;

    var retailPriceText = $("#r_price").text().replace(/,/g, '').replace(/\$/g, '');
    var retailPrice = parseFloat(retailPriceText);
    var retailPrice = parseFloat(retailPriceText);
    var RetailText = obj.getAttribute('data-retail').replace(/\$/g, '');
    var Retail = parseFloat(RetailText);
    var totalretail = Retail+retailPrice;

    var basesavedText = $("#s_price").text();
    var basesaved = parseFloat(basesavedText);
    var sevedtext = obj.getAttribute('data-saved');
    var saved = parseFloat(sevedtext);
    var totalsaved = basesaved+saved;

    var dis_percent = ((totalsaved / totalretail) * 100).toFixed(0);

    document.getElementById("p_price").textContent = finalprice;
    document.getElementById("r_price").textContent = totalretail;
    document.getElementById("s_price").textContent = totalsaved;
    document.getElementById("d_price").textContent = dis_percent;

    var img = obj.getAttribute('data-img');
    myElement.setAttribute("data-pro-id", ProductId);
    myElement.setAttribute("data-ring_size", ring_size);
    myElement.setAttribute("data-ring_price", ring_price);
    myElement.setAttribute("data-gem-data", gem_data);
    myElement.setAttribute("data-price", price);
    myElement.setAttribute("data-img", img);
    var gem_arr = JSON.parse(gem_data);
    var gem_arr = gem_arr[0]
    if (gem_arr.Product) {
      var item = gem_arr.Product;
    } else if (gem_arr.Diamond) {
      var item = gem_arr.Diamond;
    } else if (gem_arr.GemStone) {
      var item = gem_arr.GemStone;
    } else if (gem_arr.LabGrownDiamond) {
      var item = gem_arr.LabGrownDiamond;
    }
    if (item.Id ) {
      console.log(gem_arr);
    html = "<div class='row m-0 justify-content-between'><span><b>" + item.SKU + "</b></span><a href='javascript:void(0)' id='gem_remove' onclick='ResetGems()' style='color:red'>Reset</a></div>"}
    else{
      html = "<div class='row m-0 justify-content-between'><span><b>" + item.StoneType + "</b></span><a href='javascript:void(0)' id='gem_remove' onclick='ResetGems()' style='color:red'>Reset</a></div>"

    }
    $("#gem_div").html(html);
    $("#gem_btn").hide();
    setTimeout(() => {
      $("#gem_div").show();
      $("#myModalBtn").trigger("click");
    }, 500);
    ResetStone()
  }
  //------------- END SaveStone -------------------------
  function ResetGems() {
    //---- get add to cart buttom engrave json ----
    var myElement = document.getElementById("addToCartBtn");
    myElement.setAttribute("data-gem-data", '');
    myElement.setAttribute("data-price", '');
    myElement.setAttribute("data-img", '');
    $("#gem_div").html('');
    $("#gem_div").hide('');
    $("#gem_btn").show();
  }
  //----------- ENGRAVE MODAL -------------

  function stonesListBtn() {
    $("#stonesList").hide();
    $('#StonesTable').show();
  };

  function sideStonesListBtn() {
    $("#sideStonesList").hide();
    $('#setStonesTable').show();
  };

  function setStonesTableBtn() {
    $("#setStonesTable").hide();
    $('#stonesTypes').show();
  };

  function ResetStone() {
    $("#StoneLocation").load(window.location.href + " #StoneLocation > *");
    $("#setFinal").hide();
    $('#StonesTable').show();
  };

  //------------- START SET STONE -------------------------
  function fetchStoneFamily(obj) {
    $('#modelLoader').show();
    $('#StoneLocation').css('opacity', '30%');
    var modelID = obj.getAttribute('data-modelId');
    var groupName = obj.getAttribute('data-groupName');
    var size = obj.getAttribute('data-size');
    var count = obj.getAttribute('data-count');
    var group_count = obj.getAttribute('data-group-count');
    var LocationNumber = obj.getAttribute('data-LocationNumber');
    $.ajax({
      url: "<?= base_url() ?>dcadmin/Products/GetStoneFamily",
      method: "POST",
      data: {
        modelID: modelID,
        groupName: groupName,
        size: size,
        count: count,
        LocationNumber: LocationNumber,
        group_count: group_count,
      },
      dataType: 'json',
      success: function(response) {
        if (response.status == 200) {
          $('#StonesTable').hide();
          $('#stonesList').html(response.data)
          $('#sideStonesList').html(response.html2)
          $('#sideStonesList').hide();
          $("#stonesList").show();
          $('#modelLoader').hide();
          $('#StoneLocation').css('opacity', '100%');
          $("#stonesTypes").html();
        } else {
          alert(response.message)
          location.reload(true);
        }
      }
    })
  }
  //------------- END SET STONE -------------------------
  //------------- START SHOW STONE TYPES -------------------------
  function showStoneType(obj) {
    var categories = JSON.parse(obj.getAttribute('data-category'));
    var groupName = obj.getAttribute('data-groupName');
    var size = obj.getAttribute('data-size');
    var name = obj.getAttribute('data-name');
    var image = obj.getAttribute('data-image');
    var modelId = obj.getAttribute('data-modelId');
    var LocationNumber = obj.getAttribute('data-LocationNumber');
    var group_count = obj.getAttribute('data-group-count');
    //----- main
    var MainDiv = document.createElement('div');
    MainDiv.className = 'col-md-12';
    //----- back
    var BackDiv = document.createElement('div');
    BackDiv.className = 'w-100 text-right';
    //----- back button
    var buttonElement1 = document.createElement('button');
    buttonElement1.className = 'btn';
    buttonElement1.textContent = 'Back';
    buttonElement1.style.borderColor = '#797979';
    buttonElement1.addEventListener('click', function() {
      $("#stonesTypes").hide();
      $("#stonesList").show();
    })
    BackDiv.appendChild(buttonElement1);
    MainDiv.appendChild(BackDiv);
    //----- h6
    var h6Element = document.createElement('h6');
    // h6Element.className = 'mt-2';
    h6Element.style.borderBottom = '1px solid grey';
    h6Element.style.paddingBottom = '10px';
    h6Element.textContent = groupName + ' ' + size;
    //----- row
    var rowDiv = document.createElement('div');
    rowDiv.className = 'row mt-3';
    rowDiv.style.alignItems = 'baseline';
    //----- stone 
    // var stoneDiv = document.createElement('div');
    // stoneDiv.className = 'col-md-2';
    //----- img div 
    var imgDiv = document.createElement('div');
    imgDiv.className = 'row col-md-3 justify-content-center text-center';
    //----- img  
    var imgTag = document.createElement('img');
    imgTag.style.width = '60px';
    imgTag.style.height = '60px';
    imgTag.src = image;
    imgDiv.appendChild(imgTag);
    var pTag = document.createElement('p');
    pTag.style.marginBottom = '0px';
    pTag.textContent = name;
    imgDiv.appendChild(pTag);
    MainDiv.appendChild(imgDiv);
    MainDiv.appendChild(h6Element);
    // rowDiv.appendChild(stoneDiv);
    //---- types
    categories.map(function(category) {
      // if (category.CategoryName != 'Imitation' && category.CategoryName != 'Natural') {
      if (category.CategoryName == "Notable Gems") {
        var SName = "Natural Gems";
      } else if (category.CategoryName == "Diamonds with Grading Report") {
        var SName = "Diamonds with Certificate";
      } else if (category.CategoryName == "Diamonds without Grading Report") {
        var SName = "Diamonds without Certificate";
      } else if (category.CategoryName == "Lab-Grown") {
        var SName = "Lab-Grown Diamonds";
      } else {
        var SName = category.CategoryName;
      }
      var colDiv = document.createElement('div');
      colDiv.className = 'col-md-3';
      var buttonElement = document.createElement('button');
      buttonElement.className = 'btn btn-light';
      buttonElement.textContent = SName;
      buttonElement.style.width = '100%';
      buttonElement.style.borderColor = '#797979';
      buttonElement.setAttribute('data-modelId', modelId);
      buttonElement.setAttribute('data-Location', LocationNumber);
      buttonElement.setAttribute('data-StoneFamily', name);
      buttonElement.setAttribute('data-ShowName', SName);
      buttonElement.setAttribute('data-stoneCategory', category.CategoryName);
      buttonElement.setAttribute('data-IsSerialized', category.IsSerialized);
      buttonElement.setAttribute('data-group-count', group_count);
      buttonElement.addEventListener('click', function() {
        fetchFamilyStoneList(this)
      })
      colDiv.appendChild(buttonElement);
      rowDiv.appendChild(colDiv);
      // }
    });
    MainDiv.appendChild(rowDiv);
    $("#stonesList").hide();
    $('#stonesTypes').html(MainDiv);
    $("#stonesTypes").show();
  }
  //------------- END SHOW STONE TYPES -------------------------
  //------------- START SEARCH FAMILY STONES -------------------------
  function fetchFamilyStoneList(obj) {
    // console.log(obj);return;
    $('#modelLoader').show();
    $('#StoneLocation').css('opacity', '30%');
    var modelID = obj.getAttribute('data-modelId');
    var LocationNumber = obj.getAttribute('data-location');
    var StoneFamilyName = obj.getAttribute('data-stoneFamily');
    var stoneCategory = obj.getAttribute('data-stoneCategory');
    var group_count = obj.getAttribute('data-group-count');
    var is_serialized = obj.getAttribute('data-IsSerialized');
    var ShowName = obj.getAttribute('data-ShowName');
    $.ajax({
      url: "<?= base_url() ?>dcadmin/Products/SearchStone",
      method: "POST",
      data: {
        modelID: modelID,
        LocationNumber: LocationNumber,
        StoneFamilyName: StoneFamilyName,
        stoneCategory: stoneCategory,
        group_count: group_count,
        is_serialized: is_serialized,
        ShowName: ShowName,
      },
      dataType: 'json',
      success: function(response) {
        if (response.status == 200) {
          $('#modelLoader').hide();
          $('#StoneLocation').css('opacity', '100%');
          $('#stonesTypes').hide();
          $('#setStonesTable').html(response.data)
          $("#setStonesTable").show();
        } else {
          alert(response.message)
          location.reload(true);
        }
      }
    })
  }
  //------------- END SEARCH FAMILY STONES -------------------------
  //------------- START ASK SIDE STONE -------------------------
  function AskSideStone(obj) {
    var StoneProductId = obj.getAttribute('data-StoneProductId');
    var SerialNumber = obj.getAttribute('data-SerialNumber');
    var StoneFamilyName = obj.getAttribute('data-StoneFamilyName');
    var stoneCategory = obj.getAttribute('data-stoneCategory');
    var LocationNumber = obj.getAttribute('data-LocationNumber');
    var is_serialized = obj.getAttribute('data-is_serialized');
    var data = {
      StoneProductId: StoneProductId,
      SerialNumber: SerialNumber,
      StoneFamilyName: StoneFamilyName,
      stoneCategory: stoneCategory,
      LocationNumber: LocationNumber,
      is_serialized: is_serialized,
    };
    $('#temp_data').val(JSON.stringify(data));
    $('#setStonesTable').hide();
    $('#sideStonesList').show();


  }
  //------------- END ASK SIDE STONE -------------------------
  //------------- START SET STONES -------------------------
  function configureProduct(obj) {
    // console.log(obj);return;
    $('#modelLoader').show();
    $('#StoneLocation').css('opacity', '30%');
    var ProductId = $('#proId').val();
    var temp_data = $('#temp_data').val();
    var sideName = obj.getAttribute('data-name');
    if (temp_data) {
      temp_data = JSON.parse(temp_data);
      var StoneProductId = temp_data.StoneProductId;
      var SerialNumber = temp_data.SerialNumber;
      var StoneFamilyName = temp_data.StoneFamilyName;
      var stoneCategory = temp_data.stoneCategory;
      var LocationNumber = temp_data.LocationNumber;
      var is_serialized = temp_data.is_serialized;
    } else {
      var StoneProductId = obj.getAttribute('data-StoneProductId');
      var SerialNumber = obj.getAttribute('data-SerialNumber');
      var StoneFamilyName = obj.getAttribute('data-StoneFamilyName');
      var stoneCategory = obj.getAttribute('data-stoneCategory');
      var LocationNumber = obj.getAttribute('data-LocationNumber');
      var is_serialized = obj.getAttribute('data-is_serialized');
    }
    var RingSize = $('#r_size').val();
    $.ajax({
      url: "<?= base_url() ?>dcadmin/Products/configureProduct",
      method: "POST",
      data: {
        ProductId: ProductId,
        StoneProductId: StoneProductId,
        SerialNumber: SerialNumber,
        StoneFamilyName: StoneFamilyName,
        stoneCategory: stoneCategory,
        LocationNumber: LocationNumber,
        is_serialized: is_serialized,
        RingSize: RingSize,
        sideName: sideName,
        engrave: 1,
      },
      dataType: 'json',
      success: function(response) {
        if (response.status == 200) {
          $('#preview_src').attr("src", response.data);
          $('#sideStonesList').hide();
          $('#setFinal').html(response.html)
          $("#setFinal").show();
          $('#setStonesTable').hide();
          $('#modelLoader').hide();
          $('#StoneLocation').css('opacity', '100%');

          // $('#stonesTypes').hide();
          // $('#setStonesTable').html(response.data)
          // $("#setStonesTable").show();
        } else {
          alert(response.message)
          location.reload(true);
        }
      }
    })
  }
  //------------- END SET STONES  -------------------------
</script>
<script>
  var langArray = [];
  $('.vodiapicker option').each(function() {
    var img = $(this).attr("data-thumbnail");
    var text = this.innerText;
    var value = $(this).val();
    var item = '<li><img src="' + img + '" alt="" value="' + value + '"/><span>' + text + '</span></li>';
    langArray.push(item);
  })
  $('#a').html(langArray);
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