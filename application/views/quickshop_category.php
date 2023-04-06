<style>

.page_span_subtitle {
    /* text-transform: uppercase; */
    color: #6d6e71;
    font-weight: 400;
    font-size: 17px;
}

</style>

<section>
  <div class="container-fluid pl-5 pr-5 pt-3 pb-5">
    <div class="row">
      <div class="col-md-12 page_span">
        <p><a href="<?=base_url()?>"><span>Home</span></a> > <span>Quick Shops</span> </p>
      </div>
    </div>
    <div class="row">

      <div class="col-md-12">
      <div class=" mb-5">
        <h1 class="r-title">Quick Shops</h1>
      <h4 class="page_span_subtitle mt-4"><i>Each shop presents a full range of choices in one location — a simple way to see how different qualities and sizes affect price.</i></h4>
        <!-- <img src="<?=base_url();?>assets/jewel/img/sub.jpg"> -->
      </div>



      <?php
      if(!empty($quickshop_cate_data)){
       $i=1; foreach($quickshop_cate_data->result() as $data) { ?>
<hr>
                <span class=""><?=$data->name;?></span>

        <div class="row mb-3">

          <?php


             //get sub_category category wise
               		$this->db->select('*');
               		$this->db->from('tbl_quickshop_subcategory');
               		$this->db->where('category', $data->id);
               		$this->db->where('is_active',1);
               		$quickshop_subcate_data= $this->db->get();

                  if(!empty($quickshop_subcate_data)){
                   $i=1; foreach($quickshop_subcate_data->result() as $sub_data) {

              ?>
          <div class="col-md-3">
            <a href="<?=base_url(); ?>QuickShops/quickshops_subcategory/<?=base64_encode($sub_data->id);?>">
            <div class="text-center sub_img">
              <img src="<?=base_url();?><?=$sub_data->image?>">
              <p><a href="<?=base_url(); ?>QuickShops/quickshops_subcategory/<?=base64_encode($sub_data->id);?>"><?=$sub_data->name?></a></p>
            </div>
            </a>
          </div>
          <?php $i++; } }  ?>

        </div>
      <?php } } ?>
        </div>
      </div>
    </div>
  </div>
</section>
