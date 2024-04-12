  <!-- carousel start -->


<div id="demo" class="carousel slide carousel-fade" data-ride="carousel">

  <!-- Indicators -->
  <ul class="carousel-indicators">
    <?php $i=1; if(!empty($slider)){ foreach($slider->result() as $data) { ?>
    <li data-target="#demo" data-slide-to="<?=$i;?>" class="<? if($i==1) { echo "active"; }?>"></li>
    <?php $i++; } } ?>
  </ul>

  <!-- The slideshow -->

  <div class="carousel-inner">
<?php $i=1; if(!empty($slider)){ foreach($slider->result() as $data) { ?>
    <div class="carousel-item <? if($i==1) { echo "active"; }?>">
      <a href="<?=base_url(); ?>Home/sub_category/<?= $data->id?>">
      <img class="he_40 lazyload" src="<?= base_url() ?>assets/frontend/lazy/slider20210528050501.jpg" data-src="<?=base_url();?><?=$data->image?>" alt="jewel"></a>
</div>
<?php $i++; } } ?>

  </div>

  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>


 <!-- carousel end -->



<!-- categories slider start -->

<!-- Swiper -->


<style media="screen">
  @media (max-width:767px){
    .sm-mt-index{
      margin-top: 2rem;
    }
  }
</style>

<section>
  <div class="container-fluid p-5">
    <div class="row">

      <div class="col-md-4 sm-mt-index">
        <div class="swiper-container mySwiper">
          <div class="swiper-wrapper" >
    <?php $i=1; if(!empty($slider1)){ foreach($slider1->result() as $data) { ?>
            <div class="swiper-slide">
              <a href="<?=$data->link;?>">
                <img src="<?=base_url().$data ->image;?>" loading="lazy" >
              </a>
            </div>
    <?php $i++;} }?>
          </div>
          <div class="swiper-button-next"></div>
          <div class="swiper-button-prev"></div>
        </div>
      </div>

      <div class="col-md-4 sm-mt-index">
        <div class="swiper-container mySwiper">
          <div class="swiper-wrapper">

            <?php $i=1; if(!empty($slider2)){ foreach($slider2->result() as $data) { ?>
                    <div class="swiper-slide">
                      <a href="<?=$data->link;?>">
                        <img src="<?=base_url().$data->image;?>" loading="lazy">
                      </a>
                    </div>
            <?php $i++;} }?>
          </div>
          <div class="swiper-button-next"></div>
          <div class="swiper-button-prev"></div>
        </div>
      </div>

      <div class="col-md-4 sm-mt-index">
        <div class="swiper-container mySwiper">
          <div class="swiper-wrapper">

            <?php $i=1; if(!empty($slider3)){ foreach($slider3->result() as $data) { ?>
                    <div class="swiper-slide">
                      <a href="<?=$data->link;?>">
                        <img class="lazyload" src="<?= base_url() ?>assets/frontend/lazy/cat1.jpg" data-src="<?=base_url().$data->image;?>" loading="lazy">
                      </a>
                    </div>
            <?php $i++;} }?>
          </div>
          <div class="swiper-button-next"></div>
          <div class="swiper-button-prev"></div>
        </div>
      </div>
    </div>
  </div>

</section>




<!-- categories slider end -->














<!-- categories start -->
<div>

  <h3 class="logoplace text-center mb-0" style="font-size: 41px;">Top Categories</h3>

</div>


<section id="cat_all">
  <div class="container-fluid pl-5 pr-5 pb-5 pt-0">




    <div class="row">


      <?php $i=1; foreach($category->result() as $data) { ?>
      <div class="col-md-4">

        <?php
        $this->db->select('*');
    $this->db->from('tbl_sub_category');
    $this->db->where('is_active',1);
    $this->db->where('category',$data->id);
    $subcategory_da= $this->db->get()->row();

    if(!empty($subcategory_da)){ ?>

  <a href="<?=base_url(); ?>Home/sub_category/<?= $data->id?>">

<?php   }else{ ?>
    <a href="<?=base_url(); ?>Home/all_products/<?=$data->id?>/<?=base64_encode(3);?>">
<?php  } ?>


        <div>
          <img class="lazyload" src="<?= base_url() ?>assets/frontend/lazy/cat1.jpg" data-src="<?=base_url();?><?=$data->image?>">
          <button class="cat_but">

        <?php  if(!empty($subcategory_da)){ ?>
          <a href="<?=base_url(); ?>Home/sub_category/<?= $data->id?>"><?=$data->name?><span></a>
        <?php   }else{ ?>
            <a href="<?=base_url(); ?>Home/all_products/<?=$data->id?>/<?=base64_encode(3);?>"><?=$data->name?><span></a>
        <?php  } ?>


          </button>
        </div>
        </a>
      </div>
      <? if ($data->id==3) {
        break;
      }?>
      <?php $i++; } ?>



    </div>


  </div>
</section>

<!-- categories end -->





<!-- not sure start -->

<section>
  <div class="container-fluid pt-0 pb-0 pl-5 pr-5 mb-3">
    <div class="row not_sure">
      <div class="col-md-12">
        <h5 class="mb-0"><a href="<?=base_url(); ?>QuickShops/quickshops_category">Not sure what you need? browse our quick shops</a></h5>
      </div>
    </div>
  </div>
</section>

<script>
  window.addEventListener('load', function() {
    var lazyloadImages = document.querySelectorAll('.lazyload');

    lazyloadImages.forEach(function(img) {
      img.src = img.getAttribute('data-src');
      img.removeAttribute('data-src');
    });
  });
</script>
<!-- not sure end -->
