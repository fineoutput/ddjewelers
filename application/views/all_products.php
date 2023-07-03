<!-- all products start-->
<section>
  <div class="container-fluid pl-5 pr-5 pt-3 pb-5">
    <div class="row">
      <div class="col-md-12 page_span">
        <p><a href="<?=base_url()?>"><span>Home</span></a> >
          <?php if(!empty($subcategory_name)){ ?>
             <a href="<?=base_url();?>Home/sub_category/<?=$category_id?>"><span><?=$category_name;?></span></a>
             <?php if(!empty($minorsub_name)){?>
              > <span><?=$subcategory_name;?></span> > <span><?=$minorsub_name;?></span> </p>
            <?php }else{ ?>
              > <span><?=$subcategory_name;?></span> </p>
            <?php } ?>
          <?php }else{ ?>
             <span><?=$category_name;?></span>
          <?php }?>
      </div>
    </div>
    <div class="row ">
      <div class="col-md-3 all_pro_fil ">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<!-- <form action="<?=base_url();?>Home/all_products/<?=$sub_id?>" method="get" enctype="multipart/form-data"> -->
    <!-- <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="heading2">
             <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="true" aria-controls="collapse2">
         Primary store shape
        </a>
      </h4>
        </div>
        <div id="collapse2" class="panel-collapse in collapse fil_2" role="tabpanel" aria-labelledby="heading2">
            <div class="panel-body">
              <ul>
                <li><input type="checkbox" name=""> Diamond fashion</li>
                <li><input type="checkbox" name=""> Lab-Grown Diamond</li>
                <li> <input type="checkbox" name=""> Gemstone Fashion</li>
                <li> <input type="checkbox" name=""> Metal Fashion</li>
                <li> <input type="checkbox" name=""> Semi-Set</li>
                <li> <input type="checkbox" name=""> Personalized</li>
                <li> <input type="checkbox" name=""> Family Jewelry</li>
                <li> <input type="checkbox" name=""> Religious</li>
                <li> <input type="checkbox" name=""> Pearl Fashion</li>
                <li> <input type="checkbox" name=""> Moissanite</li>
                <li> <input type="checkbox" name=""> CZ Fashion</li>
                <li> <input type="checkbox" name=""> Sterling Silver</li>
                <li> <input type="checkbox" name=""> Youth</li>
                <li> <input type="checkbox" name=""> Promise Rings</li>
                <li> <input type="checkbox" name=""> Wedding & Engagement</li>
                <li> <input type="checkbox" name=""> Bestsellers</li>
                <li> <input type="checkbox" name=""> Show All Rings</li>
              </ul>
            </div>
        </div>
  </div> -->
      <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="heading4">
             <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse4" aria-expanded="true" aria-controls="collapse4">
         Primary store Size
        </a>
      </h4>
        </div>
        <div id="collapse4" class="panel-collapse in collapse fil_2" role="tabpanel" aria-labelledby="heading4">
            <div class="panel-body">
              <ul>
<?php
// echo $sub_id; die();
if(empty($minorsub_id)){
if(!empty($sub_id)){
            $this->db->select('*');
$this->db->from('tbl_products');
$this->db->group_by('ringsize');
$this->db->where('sub_category', $sub_id);
$sd= $this->db->get();
if(!empty($sd)){
foreach ($sd->result() as $a){
// if(!empty($a->ringsize)){
?>
<a href="<?=base_url();?>Home/all_products/<?=$sub_id?>/<?=base64_encode(0);?>?ringsize=<?=$a->ringsize;?>">
                <li>
                  <!-- <input type="checkbox" name="ringsize[]"  value="<?=$a->ringsize;?>" > -->
                  <?=$a->ringsize;?>
                </li>
</a>
<?php
// }
} } ?>
<?php }else{
            $this->db->select('*');
$this->db->from('tbl_products');
$this->db->group_by('ringsize');
$this->db->where('category', $category_id);
$sd= $this->db->get();
if(!empty($sd)){
foreach ($sd->result() as $a){
// if(!empty($a->ringsize)){
?>
<a href="<?=base_url();?>Home/all_products/<?=$category_id?>/<?=base64_encode(3);?>?ringsize=<?=$a->ringsize;?>">
                <li>
                  <!-- <input type="checkbox" name="ringsize[]"  value="<?=$a->ringsize;?>" > -->
                  <?=$a->ringsize;?>
                </li>
</a>
<?php
// }
} } ?>
<?php } ?>
<?php }else{
  $this->db->select('*');
$this->db->from('tbl_products');
$this->db->group_by('ringsize');
$this->db->where('minisub_category', $minorsub_id);
$sd= $this->db->get();
if(!empty($sd)){
foreach ($sd->result() as $a){
// if(!empty($a->ringsize)){
?>
<a href="<?=base_url();?>Home/all_products/<?=$minorsub_id?>/<?=base64_encode(1);?>?ringsize=<?=$a->ringsize;?>">
      <li>
        <!-- <input type="checkbox" name="ringsize[]"  value="<?=$a->ringsize;?>" > -->
        <?=$a->ringsize;?>
      </li>
</a>
<?php
// }
} }
}?>
              </ul>
            </div>
        </div>
  </div>
          <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="heading4">
             <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse4" aria-expanded="true" aria-controls="collapse4">
         Primary store type
        </a>
      </h4>
        </div>
        <div id="collapse4" class="panel-collapse in collapse fil_2" role="tabpanel" aria-labelledby="heading4">
            <div class="panel-body">
              <ul>
  <?php
  // echo $sub_id; die();
if(empty($minorsub_id)){
if(!empty($sub_id)){
              $this->db->select('*');
  $this->db->from('tbl_products');
  $this->db->group_by('product_type');
  $this->db->where('sub_category', $sub_id);
  $sd= $this->db->get();
  if(!empty($sd)){
  foreach ($sd->result() as $a){
if(!empty($a->product_type)){
  ?>
<a href="<?=base_url();?>Home/all_products/<?=$sub_id?>/<?=base64_encode(0);?>?product_type=<?=$a->product_type;?>">
                <li>
                  <!-- <input type="checkbox" name="product_type[]"  value="<?=$a->product_type;?>">  -->
                  <?=$a->product_type;?>
                </li>
</a>
<?php } } } ?>
<?php }else{
  $this->db->select('*');
$this->db->from('tbl_products');
$this->db->group_by('product_type');
$this->db->where('category', $category_id);
$sd= $this->db->get();
if(!empty($sd)){
foreach ($sd->result() as $a){
if(!empty($a->product_type)){
?>
<a href="<?=base_url();?>Home/all_products/<?=$category_id?>/<?=base64_encode(3);?>?product_type=<?=$a->product_type;?>">
    <li>
      <!-- <input type="checkbox" name="product_type[]"  value="<?=$a->product_type;?>">  -->
      <?=$a->product_type;?>
    </li>
</a>
<?php } } } ?>
<?php } ?>
<?php }else{
                $this->db->select('*');
    $this->db->from('tbl_products');
    $this->db->group_by('product_type');
    $this->db->where('minisub_category', $minorsub_id);
    $sd= $this->db->get();
    if(!empty($sd)){
    foreach ($sd->result() as $a){
  if(!empty($a->product_type)){
    ?>
  <a href="<?=base_url();?>Home/all_products/<?=$minorsub_id?>/<?=base64_encode(1);?>?product_type=<?=$a->product_type;?>">
                  <li>
                    <!-- <input type="checkbox" name="product_type[]"  value="<?=$a->product_type;?>">  -->
                    <?=$a->product_type;?>
                  </li>
  </a>
  <?php } } }
} ?>
              </ul>
            </div>
        </div>
  </div>
                    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="heading5">
             <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse5" aria-expanded="true" aria-controls="collapse5">
         total diamond type weight
        </a>
      </h4>
        </div>
        <div id="collapse5" class="panel-collapse in collapse fil_2" role="tabpanel" aria-labelledby="heading5">
            <div class="panel-body">
              <ul>
  <?php
  // echo $sub_id; die();
  if(empty($minorsub_id)){
if(!empty($sub_id)){
              $this->db->select('*');
  $this->db->from('tbl_products');
  $this->db->group_by('totalweight');
  $this->db->where('sub_category', $sub_id);
  $sd= $this->db->get();
  if(!empty($sd)){
  foreach ($sd->result() as $a){
if(!empty($a->totalweight)){
  ?>
<a href="<?=base_url();?>Home/all_products/<?=$sub_id?>/<?=base64_encode(0);?>?dclarity=<?=$a->dclarity;?>">
                <li>
                  <!-- <input type="checkbox" name="totalweight[]"  value="<?=$a->totalweight;?>"> -->
                   <?=$a->totalweight;?>
                 </li>
</a>
<?php } } } ?>
<?php }else{
  $this->db->select('*');
$this->db->from('tbl_products');
$this->db->group_by('totalweight');
$this->db->where('category', $category_id);
$sd= $this->db->get();
if(!empty($sd)){
foreach ($sd->result() as $a){
if(!empty($a->totalweight)){
?>
<a href="<?=base_url();?>Home/all_products/<?=$category_id?>/<?=base64_encode(3);?>?dclarity=<?=$a->dclarity;?>">
    <li>
      <!-- <input type="checkbox" name="totalweight[]"  value="<?=$a->totalweight;?>"> -->
       <?=$a->totalweight;?>
     </li>
</a>
<?php } } } ?>
<?php } ?>
<?php }else{
  $this->db->select('*');
$this->db->from('tbl_products');
$this->db->group_by('totalweight');
$this->db->where('minisub_category', $minorsub_id);
$sd= $this->db->get();
if(!empty($sd)){
foreach ($sd->result() as $a){
if(!empty($a->totalweight)){
?>
<a href="<?=base_url();?>Home/all_products/<?=$minorsub_id?>/<?=base64_encode(1);?>?dclarity=<?=$a->dclarity;?>">
    <li>
      <!-- <input type="checkbox" name="totalweight[]"  value="<?=$a->totalweight;?>"> -->
       <?=$a->totalweight;?>
     </li>
</a>
<?php } } }
} ?>
              </ul>
            </div>
        </div>
  </div>
                    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="heading6">
             <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse6" aria-expanded="true" aria-controls="collapse6">
         diamond clarity
        </a>
      </h4>
        </div>
        <div id="collapse6" class="panel-collapse in collapse fil_2" role="tabpanel" aria-labelledby="heading6">
            <div class="panel-body">
              <ul>
    <?php
    // echo $sub_id; die();
  if(empty($minorsub_id)){
if(!empty($sub_id)){
                $this->db->select('*');
    $this->db->from('tbl_products');
    $this->db->group_by('dclarity');
    $this->db->where('sub_category', $sub_id);
    $sd= $this->db->get();
    if(!empty($sd)){
    foreach ($sd->result() as $a){
if(!empty($a->dclarity)){
    ?>
<a href="<?=base_url();?>Home/all_products/<?=$sub_id?>/<?=base64_encode(0);?>?dclarity=<?=$a->dclarity;?>">
                <li>
                  <!-- <input type="checkbox" name="dclarity[]" value="<?=$a->dclarity;?>"> -->
                   <?=$a->dclarity;?>
                 </li>
</a>
<?php } } } ?>
<?php }else{
        $this->db->select('*');
    $this->db->from('tbl_products');
    $this->db->group_by('dclarity');
    $this->db->where('category', $category_id);
    $sd= $this->db->get();
    if(!empty($sd)){
    foreach ($sd->result() as $a){
if(!empty($a->dclarity)){
    ?>
<a href="<?=base_url();?>Home/all_products/<?=$category_id?>/<?=base64_encode(3);?>?dclarity=<?=$a->dclarity;?>">
                <li>
                  <!-- <input type="checkbox" name="dclarity[]" value="<?=$a->dclarity;?>"> -->
                   <?=$a->dclarity;?>
                 </li>
</a>
<?php } } } ?>
<?php } ?>
<?php }else{
  $this->db->select('*');
$this->db->from('tbl_products');
$this->db->group_by('dclarity');
$this->db->where('minisub_category', $minorsub_id);
$sd= $this->db->get();
if(!empty($sd)){
foreach ($sd->result() as $a){
if(!empty($a->dclarity)){
?>
<a href="<?=base_url();?>Home/all_products/<?=$minorsub_id?>/<?=base64_encode(1);?>?dclarity=<?=$a->dclarity;?>">
  <li>
    <!-- <input type="checkbox" name="dclarity[]" value="<?=$a->dclarity;?>"> -->
     <?=$a->dclarity;?>
   </li>
</a>
<?php } } }
} ?>
              </ul>
            </div>
        </div>
  </div>
                      <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="heading6">
             <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse6" aria-expanded="true" aria-controls="collapse6">
         diamond color
        </a>
      </h4>
        </div>
        <div id="collapse6" class="panel-collapse in collapse fil_2" role="tabpanel" aria-labelledby="heading6">
            <div class="panel-body">
              <ul>
    <?php
    // echo $sub_id; die();
  if(empty($minorsub_id)){
  if(!empty($sub_id)){
                $this->db->select('*');
    $this->db->from('tbl_products');
    $this->db->group_by('dcolor');
    $this->db->where('sub_category', $sub_id);
    $sd= $this->db->get();
    if(!empty($sd)){
    foreach ($sd->result() as $a){
if(!empty($a->dcolor)){
    ?>
<a href="<?=base_url();?>Home/all_products/<?=$sub_id?>/<?=base64_encode(0);?>?dcolor=<?=$a->dcolor;?>">
                <li>
                  <!-- <input type="checkbox" name="dcolor[]" value="<?=$a->dcolor;?>"> -->
                   <?=$a->dcolor;?>
                 </li>
</a>
<?php } } } ?>
<?php }else{
  $this->db->select('*');
$this->db->from('tbl_products');
$this->db->group_by('dcolor');
$this->db->where('category', $category_id);
$sd= $this->db->get();
if(!empty($sd)){
foreach ($sd->result() as $a){
if(!empty($a->dcolor)){
?>
<a href="<?=base_url();?>Home/all_products/<?=$category_id?>/<?=base64_encode(3);?>?dcolor=<?=$a->dcolor;?>">
  <li>
    <!-- <input type="checkbox" name="dcolor[]" value="<?=$a->dcolor;?>"> -->
     <?=$a->dcolor;?>
   </li>
</a>
<?php } } } ?>
<?php } ?>
<?php }else{
  $this->db->select('*');
$this->db->from('tbl_products');
$this->db->group_by('dcolor');
$this->db->where('minisub_category', $minorsub_id);
$sd= $this->db->get();
if(!empty($sd)){
foreach ($sd->result() as $a){
if(!empty($a->dcolor)){
?>
<a href="<?=base_url();?>Home/all_products/<?=$minorsub_id?>/<?=base64_encode(1);?>?dcolor=<?=$a->dcolor;?>">
  <li>
    <!-- <input type="checkbox" name="dcolor[]" value="<?=$a->dcolor;?>"> -->
     <?=$a->dcolor;?>
   </li>
</a>
<?php } } }
}  ?>
              </ul>
            </div>
        </div>
  </div>
  <!-- <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="heading7">
             <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse7" aria-expanded="true" aria-controls="collapse7">
         metal karat
        </a>
      </h4>
        </div>
        <div id="collapse7" class="panel-collapse in collapse fil_2" role="tabpanel" aria-labelledby="heading7">
            <div class="panel-body">
              <ul>
                <li><input type="checkbox" name=""> Diamond fashion</li>
                <li><input type="checkbox" name=""> Lab-Grown Diamond</li>
                <li> <input type="checkbox" name=""> Gemstone Fashion</li>
                <li> <input type="checkbox" name=""> Metal Fashion</li>
                <li> <input type="checkbox" name=""> Semi-Set</li>
                <li> <input type="checkbox" name=""> Personalized</li>
                <li> <input type="checkbox" name=""> Family Jewelry</li>
                <li> <input type="checkbox" name=""> Religious</li>
                <li> <input type="checkbox" name=""> Pearl Fashion</li>
                <li> <input type="checkbox" name=""> Moissanite</li>
                <li> <input type="checkbox" name=""> CZ Fashion</li>
                <li> <input type="checkbox" name=""> Sterling Silver</li>
                <li> <input type="checkbox" name=""> Youth</li>
                <li> <input type="checkbox" name=""> Promise Rings</li>
                <li> <input type="checkbox" name=""> Wedding & Engagement</li>
                <li> <input type="checkbox" name=""> Bestsellers</li>
                <li> <input type="checkbox" name=""> Show All Rings</li>
              </ul>
            </div>
        </div>
  </div>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="heading8">
             <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse8" aria-expanded="true" aria-controls="collapse8">
         metal color
        </a>
      </h4>
        </div>
        <div id="collapse8" class="panel-collapse in collapse fil_2" role="tabpanel" aria-labelledby="heading8">
            <div class="panel-body">
              <ul>
                <li><input type="checkbox" name=""> Diamond fashion</li>
                <li><input type="checkbox" name=""> Lab-Grown Diamond</li>
                <li> <input type="checkbox" name=""> Gemstone Fashion</li>
                <li> <input type="checkbox" name=""> Metal Fashion</li>
                <li> <input type="checkbox" name=""> Semi-Set</li>
                <li> <input type="checkbox" name=""> Personalized</li>
                <li> <input type="checkbox" name=""> Family Jewelry</li>
                <li> <input type="checkbox" name=""> Religious</li>
                <li> <input type="checkbox" name=""> Pearl Fashion</li>
                <li> <input type="checkbox" name=""> Moissanite</li>
                <li> <input type="checkbox" name=""> CZ Fashion</li>
                <li> <input type="checkbox" name=""> Sterling Silver</li>
                <li> <input type="checkbox" name=""> Youth</li>
                <li> <input type="checkbox" name=""> Promise Rings</li>
                <li> <input type="checkbox" name=""> Wedding & Engagement</li>
                <li> <input type="checkbox" name=""> Bestsellers</li>
                <li> <input type="checkbox" name=""> Show All Rings</li>
              </ul>
            </div>
        </div>
  </div>
      <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="heading9">
             <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse9" aria-expanded="true" aria-controls="collapse9">
         metal type
        </a>
      </h4>
        </div>
        <div id="collapse9" class="panel-collapse in collapse fil_2" role="tabpanel" aria-labelledby="heading9">
            <div class="panel-body">
              <ul>
                <li><input type="checkbox" name=""> Diamond fashion</li>
                <li><input type="checkbox" name=""> Lab-Grown Diamond</li>
                <li> <input type="checkbox" name=""> Gemstone Fashion</li>
                <li> <input type="checkbox" name=""> Metal Fashion</li>
                <li> <input type="checkbox" name=""> Semi-Set</li>
                <li> <input type="checkbox" name=""> Personalized</li>
                <li> <input type="checkbox" name=""> Family Jewelry</li>
                <li> <input type="checkbox" name=""> Religious</li>
                <li> <input type="checkbox" name=""> Pearl Fashion</li>
                <li> <input type="checkbox" name=""> Moissanite</li>
                <li> <input type="checkbox" name=""> CZ Fashion</li>
                <li> <input type="checkbox" name=""> Sterling Silver</li>
                <li> <input type="checkbox" name=""> Youth</li>
                <li> <input type="checkbox" name=""> Promise Rings</li>
                <li> <input type="checkbox" name=""> Wedding & Engagement</li>
                <li> <input type="checkbox" name=""> Bestsellers</li>
                <li> <input type="checkbox" name=""> Show All Rings</li>
              </ul>
            </div>
        </div>
  </div>
      <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="heading10">
             <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse10" aria-expanded="true" aria-controls="collapse10">
         ENGRAVABLE
        </a>
      </h4>
        </div>
        <div id="collapse10" class="panel-collapse in collapse fil_2" role="tabpanel" aria-labelledby="heading10">
            <div class="panel-body">
              <ul>
                <li><input type="checkbox" name=""> Diamond fashion</li>
                <li><input type="checkbox" name=""> Lab-Grown Diamond</li>
                <li> <input type="checkbox" name=""> Gemstone Fashion</li>
                <li> <input type="checkbox" name=""> Metal Fashion</li>
                <li> <input type="checkbox" name=""> Semi-Set</li>
                <li> <input type="checkbox" name=""> Personalized</li>
                <li> <input type="checkbox" name=""> Family Jewelry</li>
                <li> <input type="checkbox" name=""> Religious</li>
                <li> <input type="checkbox" name=""> Pearl Fashion</li>
                <li> <input type="checkbox" name=""> Moissanite</li>
                <li> <input type="checkbox" name=""> CZ Fashion</li>
                <li> <input type="checkbox" name=""> Sterling Silver</li>
                <li> <input type="checkbox" name=""> Youth</li>
                <li> <input type="checkbox" name=""> Promise Rings</li>
                <li> <input type="checkbox" name=""> Wedding & Engagement</li>
                <li> <input type="checkbox" name=""> Bestsellers</li>
                <li> <input type="checkbox" name=""> Show All Rings</li>
              </ul>
            </div>
        </div>
  </div>
       <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="heading11">
             <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse11" aria-expanded="true" aria-controls="collapse11">
        FLEXIBLE DESIGNS
        </a>
      </h4>
        </div>
        <div id="collapse11" class="panel-collapse in collapse fil_2" role="tabpanel" aria-labelledby="heading11">
            <div class="panel-body">
              <ul>
                <li><input type="checkbox" name=""> Diamond fashion</li>
                <li><input type="checkbox" name=""> Lab-Grown Diamond</li>
                <li> <input type="checkbox" name=""> Gemstone Fashion</li>
                <li> <input type="checkbox" name=""> Metal Fashion</li>
                <li> <input type="checkbox" name=""> Semi-Set</li>
                <li> <input type="checkbox" name=""> Personalized</li>
                <li> <input type="checkbox" name=""> Family Jewelry</li>
                <li> <input type="checkbox" name=""> Religious</li>
                <li> <input type="checkbox" name=""> Pearl Fashion</li>
                <li> <input type="checkbox" name=""> Moissanite</li>
                <li> <input type="checkbox" name=""> CZ Fashion</li>
                <li> <input type="checkbox" name=""> Sterling Silver</li>
                <li> <input type="checkbox" name=""> Youth</li>
                <li> <input type="checkbox" name=""> Promise Rings</li>
                <li> <input type="checkbox" name=""> Wedding & Engagement</li>
                <li> <input type="checkbox" name=""> Bestsellers</li>
                <li> <input type="checkbox" name=""> Show All Rings</li>
              </ul>
            </div>
        </div>
  </div>
         <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="heading12">
             <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse12" aria-expanded="true" aria-controls="collapse12">
        GENDER
        </a>
      </h4>
        </div>
        <div id="collapse12" class="panel-collapse in collapse fil_2" role="tabpanel" aria-labelledby="heading12">
            <div class="panel-body">
              <ul>
                <li><input type="checkbox" name=""> Baby/Youth</li>
                <li><input type="checkbox" name=""> Ladies</li>
                <li> <input type="checkbox" name=""> Mens</li>
              </ul>
            </div>
        </div>
  </div> -->
  <!-- <input type="submit" class="mt-3 add-btn" value=" Apply "  > -->
<?php  if(empty($minorsub_id)){ ?>
<?php if(!empty($sub_id)){?>
<a href="<?=base_url();?>Home/all_products/<?=$sub_id?>/<?=base64_encode(0);?>">
  <input type="submit" class="mt-3 add-btn" value="Remove Filter"  >
</a>
<?php }else{ ?>
  <a href="<?=base_url();?>Home/all_products/<?=$category_id?>/<?=base64_encode(3);?>">
    <input type="submit" class="mt-3 add-btn" value="Remove Filter"  >
  </a>
<?php } ?>
<?php }else { ?>
  <a href="<?=base_url();?>Home/all_products/<?=$minorsub_id?>/<?=base64_encode(1);?>">
    <input type="submit" class="mt-3 add-btn" value="Remove Filter"  >
  </a>
<?php }?>
<!-- </form> -->
      </div>
    </div>
      <div class="col-md-9">
        <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="row ">
                            <div class="col-md-8 mb-4 hrds">
                                <h1 class="r-title">
<?php
if(!empty($subcategory_name)){
if(!empty($minorsub_name)){
  echo $minorsub_name." ( ".$productCount." )";
  
}else{
  echo $subcategory_name." ( ".$productCount." )";
}
}else{
  echo $category_name." ( ".$productCount." )";
}
$this->db->select('*');
            $this->db->from('tbl_sub_category');
            $this->db->where('id',$level_id);
          //  $this->db->where('id',44);
            $dsa= $this->db->get();
            $dai=$dsa->row();
            // print_r($dai);die();
?>
                                </h1>
                                <?
                                if(!empty($description)){
                                  ?>
                                    <h6 class="mt-3 mb-4"><i><?=$description;?></i></h6>
                                  <?
                                }
                                ?>
                            </div>
                            <!-- <img src="https://meteor.stullercloud.com/das/68074515?scl=1&$sharpen$" alt="img"> -->
                            <?
                            if(!empty($dai->banner)){
                              $imgd=$dai->banner;
                            ?>
                              <img src="<?php echo base_url().$imgd ?>" alt="img">
                              <?
                            }else{
                              // echo "No Image Found";
                            }
                              ?>
                            <!-- <div class="col-md-12">
                                <div class="pd-toggle">
                                    <div class="toggle-text">
                                        <div class="tgl-lt">
                                            <label class="switch mr-2">
                                                <input type="checkbox" checked>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                        <div class="prgrf">
                                            <p class="lettr"><b>Ready to Ship</b> - Only show products that have at
                                                least one in-stock option <span class="new-feature-badge">NEW</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="pd-toggle-2">
                                    <div class="toggle-text">
                                        <div class="tgl-lt">
                                            <label class="switch mr-2">
                                                <input type="checkbox" checked>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                        <div class="prgrf">
                                            <p class="lettr"><b>Ready to Ship</b> - Only show products that have at
                                                least one in-stock option</p> <span class="new-feature-badge">NEW</span>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <style>
                              .sb-text{
                                font-weight: bold;
                              }
                              .sb-text label section{
                                font-size: 14px !important;
                              }
                            </style>
                            <div class="col-md-12 mt-5 hrdx">
                                <div class="sb-text ">
                                    <div class="s-option">
                                        <label for="sort" class="tgl">Sort-by:</label>
                                        <select name="sort" id="sort" class="tgl" onchange="sort();">
                                            <option value="0" <?php if($sort_type == 0){ echo "selected"; } ?>>Best Sellers</option>
                                            <option value="1" <?php if($sort_type == 1){ echo "selected"; } ?>>Newest</option>
                                            <option value="2" <?php if($sort_type == 2){ echo "selected"; } ?> >Price:High to Low</option>
                                            <option value="3" <?php if($sort_type == 3){ echo "selected"; } ?>>Price:Low to High</option>
                                            <!-- <option value="audi">Name</option>
                                            <option value="audi">Bestseller</option> -->
                                        </select>
                                    </div>
                                    <style>
                                    .tgline{
                                      width: inherit;
                                      margin-right: 0.5rem
                                    }
                                         .tgl{
                                           /* width: inherit; */
                                           font-size: 14px !important;
                                           font-weight: 400;
                                         }
                                    </style>
                                    <!-- <div class="opt">
                                        <pre class="tgline tgl">Showing 1 - 36 of 641   | </pre>
                                        <label for="sort" class="tgl">Items per page:</label>
                                        <select name="sort" id="sort" class="tgl">
                                            <option value="volvo">36</option>
                                            <option value="saab">72</option>
                                            <option value="mercedes">144</option>
                                        </select>
                                    </div> -->
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
                            </div>
                        </div>
                    </div>
                    <style>
                      .img-fluid {
                              max-width: 75% !important;
                            }
                            .searchColumn{
                              margin-bottom: 3.5rem;
                            }
                    </style>
                    <div class="row w-100">
                    <?php $i=1;
                    $product1 =[];
                    foreach($product->result() as $data) {
                      // $sku1=explode(":",$data->sku);
                      // $sku = $sku1[0];
                      $a=0;
                      if(!empty($product1)){
                        foreach ($product1 as $value) {
                      if($data->sku_series==$value['sku_series']){
                        $a=1;
                      }
                    }}
                      if($a==1){
                        continue;
                      }else{
                        // $this->db->select('*');
                        // $this->db->from('tbl_products');
                        // $this->db->where('sku_series',$data->sku_series);
                        // $this->db->like('id',$data->sku_series);
                        // $data['']= $this->db->get()->row();
                        $product1[]=array('id'=>$data->id,
                        'sku'=>$data->sku,
                        'sku_series'=>$data->sku_series,
                        'image1'=>$data->FullySetImage1,
                        'image2'=>$data->FullySetImage2,
                        'description'=>$data->description,
                        'price'=>$data->price,
                        'currency'=>$data->currency,
                      );
                      }
                      $i++;
                    }
                    // echo $i;die();
                    // print_r($product1);
                    // exit;
                    foreach($product1 as $data){
                      ?>
                        <div class="col-md-3 col-4 searchColumn">
                            <p class="text-center"><i><?=$data['sku_series']?></i></p>
                        <a href="<?=base_url(); ?>Home/product_detail/<?=$data['sku']?>">
                            <?if(!empty($data['image1'])){?>
                            <img src="<?=$data['image1']?>?$list$" alt=""
                                class="img-fluid first_img">
                          <img src="<?=$data['image2']?$data['image2']:$data['image1']?>?$list$" alt=""
                                class="img-fluid second_img" style="margin-left: 28px;">
                                <?}else{?>
                                  <img src="<?=base_url()?>assets/uploads/no-image-found.jpg" alt=""
                                      class="img-fluid first_img">
                                      <img src="<?=base_url()?>assets/uploads/no-image-found.jpg" alt=""
                                            class="img-fluid second_img" style="margin-left: 28px;">
                                  <?}?>
                                <p><b><?=$data['description']?></b></p>
                            <?if(!empty($data['price'])){
                              $this->db->select('*');
                  $this->db->from('tbl_price_rule');
                  $pr_data= $this->db->get()->row();
                  $multiplier= $pr_data->multiplier;
                  $cost_price11= $pr_data->cost_price1;
                  $cost_price22= $pr_data->cost_price2;
                  $cost_price33= $pr_data->cost_price3;
                  $cost_price44= $pr_data->cost_price4;
                  $cost_price55= $pr_data->cost_price5;
                              $cost_price = $data['price'];
                              $retail = $cost_price * $multiplier;
                              $now_price = $cost_price;
                              // echo $now_price;
                              // exit;
                      if($cost_price<=500){
                        $cost_price2=$cost_price*$cost_price;
                        // $now_price= $cost_price*0.00000264018*($cost_price*2)+(-0.002220133*$cost_price)+1.950022201-1+0.95;
                        $number= round($cost_price*($cost_price11*$cost_price2+$cost_price22*$cost_price+$cost_price33),2);
                        $unit=5;
                        $remainder = $number % $unit;
                      $mround = ($remainder < $unit / 2) ? $number - $remainder : $number + ($unit - $remainder);
                      $now_price = round($mround)-1+0.95;
// $now_price = round($mround);
                        // echo $cost_price;
                        // exit;
                      }
                      if($cost_price>500){
                        $number= round($cost_price*($cost_price44*$cost_price/$multiplier+$cost_price55));
                        $unit=5;
                        $remainder = $number % $unit;
                      $mround = ($remainder < $unit / 2) ? $number - $remainder : $number + ($unit - $remainder);
                      $now_price = round($mround)-1+0.95;
// $now_price = round($mround);
                      }
                      $saved = round($retail - $now_price);
                              ?>
                            <p class="price">$<?=number_format($now_price,2);?></p>
                            <?}else{?>
                              <p class="price"><a  href="<?=base_url(); ?>Home/contact_us">contact</a></p>
                              <? } ?>
                          </a>
                          </a>
                        </div>
                        <?php $i++; } ?>
                      </div>
                </div>
<!-- <div class="text-center"><?php echo $links; ?></div> -->
            </div>
      </div>
    </div>
  </div>
  <input type="hidden" value="<?=$page;?>" id="page">
  <input type="hidden" value="<?=$level_id;?>" id="level_id">
</section>
<script>
function sort(){
  var sort_type =  $('#sort').val();
  var page =  $('#page').val();
  var level_id =  $('#level_id').val();
  var year =  $("#selectyear").val();
  if(sort_type!= '' ){
    window.location.href="<?= base_url()?>Home/all_products/"+level_id+"/"+page+"?sort_type="+sort_type;
  }else{
    alert("Please Select Sort Type.");
  }
}
</script>
<!-- all products end-->
