
<!-- sub categories start-->

<section>
  <div class="container-fluid pl-5 pr-5 pt-3 pb-5">
    <div class="row">
      <div class="col-md-12 page_span">
        <p><a href="<?=base_url()?>"><span>Home</span></a> > <a href="<?=base_url()?>Home/sub_category/<?=$category_id;?>"><span><?=$category_name;?></span></a> > <span><?=$subcategory_name;?></span>
      </div>
    </div>
    <div class="row">

      <div class="col-md-12">
        <h1 class="r-title mb-4"><?=$subcategory_name;?></h1>
        <!-- <img src="<?=base_url();?>assets/jewel/img/sub.jpg"> -->
        <div class="row">
          <?php $i=1; foreach($minorsub_category->result() as $data) { ?>
          <div class="col-md-4">
            <a href="<?=base_url(); ?>Home/all_products/<?=$data->id?>/<?=base64_encode(1);?>">
            <div class="text-center sub_img">
              <img src="<?=base_url();?><?=$data->image?>">
              <p><a href="<?=base_url(); ?>Home/all_products/<?=$data->id?>/<?=base64_encode(1);?>"><?=$data->name?></a></p>
            </div>
            </a>
          </div>
          <?php $i++; } ?>
          <!-- <div class="col-md-4">
            <a href="<?=base_url(); ?>Home/all_products">
            <div class="text-center sub_img">
              <img src="<?=base_url();?>assets/jewel/img/ring2.jpg">
              <p><a href="<?=base_url(); ?>Home/all_products">lab-glow diamond</a></p>
            </div>
            </a>
          </div>
          <div class="col-md-4">
            <a href="<?=base_url(); ?>Home/all_products">
            <div class="text-center sub_img">
              <img src="<?=base_url();?>assets/jewel/img/ring3.jpg">
              <p><a href="<?=base_url(); ?>Home/all_products">Gemstone fashion</a></p>
            </div>
            </a>
          </div>
          <div class="col-md-4">
            <a href="<?=base_url(); ?>Home/all_products">
            <div class="text-center sub_img">
              <img src="<?=base_url();?>assets/jewel/img/ring1.jpg">
              <p><a href="<?=base_url(); ?>Home/all_products"> diamond fashion</a></p>
            </div>
            </a>
          </div>
          <div class="col-md-4">
            <a href="<?=base_url(); ?>Home/all_products">
            <div class="text-center sub_img">
              <img src="<?=base_url();?>assets/jewel/img/ring2.jpg">
              <p><a href="<?=base_url(); ?>Home/all_products">lab-glow diamond</a></p>
            </div>
            </a>
          </div>
          <div class="col-md-4">
            <a href="<?=base_url(); ?>Home/all_products">
            <div class="text-center sub_img">
              <img src="<?=base_url();?>assets/jewel/img/ring3.jpg">
              <p><a href="<?=base_url(); ?>Home/all_products">Gemstone fashion</a></p>
            </div>
            </a>
          </div>
          <div class="col-md-4">
            <a href="<?=base_url(); ?>Home/all_products">
            <div class="text-center sub_img">
              <img src="<?=base_url();?>assets/jewel/img/ring1.jpg">
              <p><a href="<?=base_url(); ?>Home/all_products"> diamond fashion</a></p>
            </div>
            </a>
          </div>
          <div class="col-md-4">
            <a href="<?=base_url(); ?>Home/all_products">
            <div class="text-center sub_img">
              <img src="<?=base_url();?>assets/jewel/img/ring2.jpg">
              <p><a href="<?=base_url(); ?>Home/all_products">lab-glow diamond</a></p>
            </div>
            </a>
          </div>
          <div class="col-md-4">
            <a href="<?=base_url(); ?>Home/all_products">
            <div class="text-center sub_img">
              <img src="<?=base_url();?>assets/jewel/img/ring3.jpg">
              <p><a href="<?=base_url(); ?>Home/all_products">Gemstone fashion</a></p>
            </div>
            </a>
          </div>
          <div class="col-md-4">
            <a href="<?=base_url(); ?>Home/all_products">
            <div class="text-center sub_img">
              <img src="<?=base_url();?>assets/jewel/img/ring1.jpg">
              <p><a href="<?=base_url(); ?>Home/all_products"> diamond fashion</a></p>
            </div>
            </a>
          </div>
          <div class="col-md-4">
            <a href="<?=base_url(); ?>Home/all_products">
            <div class="text-center sub_img">
              <img src="<?=base_url();?>assets/jewel/img/ring2.jpg">
              <p><a href="<?=base_url(); ?>Home/all_products">lab-glow diamond</a></p>
            </div>
            </a>
          </div>
          <div class="col-md-4">
            <a href="<?=base_url(); ?>Home/all_products">
            <div class="text-center sub_img">
              <img src="<?=base_url();?>assets/jewel/img/ring3.jpg">
              <p><a href="<?=base_url(); ?>Home/all_products">Gemstone fashion</a></p>
            </div>
            </a>
          </div>
          <div class="col-md-4">
            <a href="<?=base_url(); ?>Home/all_products">
            <div class="text-center sub_img">
              <img src="<?=base_url();?>assets/jewel/img/ring1.jpg">
              <p><a href="<?=base_url(); ?>Home/all_products"> diamond fashion</a></p>
            </div>
            </a>
          </div>
          <div class="col-md-4">
            <a href="<?=base_url(); ?>Home/all_products">
            <div class="text-center sub_img">
              <img src="<?=base_url();?>assets/jewel/img/ring2.jpg">
              <p><a href="<?=base_url(); ?>Home/all_products">lab-glow diamond</a></p>
            </div>
            </a>
          </div>
          <div class="col-md-4">
            <a href="<?=base_url(); ?>Home/all_products">
            <div class="text-center sub_img">
              <img src="<?=base_url();?>assets/jewel/img/ring3.jpg">
              <p><a href="<?=base_url(); ?>Home/all_products">Gemstone fashion</a></p>
            </div>
            </a>
          </div>-->
        </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- sub categories end-->
