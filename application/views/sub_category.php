
<!-- sub categories start-->

<section>
  <div class="container-fluid pl-5 pr-5 pt-3 pb-5">
    <div class="row">
      <div class="col-md-12 page_span">
        <p><a href="<?=base_url()?>"><span>Home</span></a> > <span>Category</span> > <span><?=$category_name;?></span>
      </div>
    </div>
    <div class="row">

      <div class="col-md-12">
        <h1 class="r-title"><?=$category_name;?></h1>
        <!-- <img src="<?=base_url();?>assets/jewel/img/sub.jpg"> -->
        <h6 class="mt-3 mb-4"><i><?=$cate_description;?></i></h6>
        <div class="row">
          <?php $i=1; foreach($sub_category->result() as $data) {
            ?>
          <div class="col-md-4">

<?php
$this->db->select('*');
$this->db->from('tbl_minisubcategory');
$this->db->where('subcategory',$data->id);
$this->db->where('is_active',1);
$minorsub_category= $this->db->get()->row();

if(empty($minorsub_category)){ ?>
    <a href="<?=base_url(); ?>Home/all_products/<?=$data->id?>/<?=base64_encode(0);?>">
<?php }else{?>
    <a href="<?=base_url(); ?>Home/minor_sub_products/<?=base64_encode($data->id);?>">
<?php } ?>

            <div class="text-center sub_img">
              <img src="<?=base_url();?><?=$data->image?>">
<?php if(empty($minorsub_category)){ ?>
  <p><a href="<?=base_url(); ?>Home/all_products/<?=$data->id?>/<?=base64_encode(0);?>"><?=$data->name?></a></p>
<?php }else{?>
  <p><a href="<?=base_url(); ?>Home/minor_sub_products/<?=base64_encode($data->id);?>"><?=$data->name?></a></p>

<?php } ?>
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
