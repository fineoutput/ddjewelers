

<!-- cart start -->
<div id="WishlistData">
<section>
  <div class="container-fluid pl-5 pr-5 pt-3 pb-5">
    <div class="row">
      <div class="col-md-12">
        <h1 class="r-title">Your Wishlist</h1>
<!--
        <? if(!empty($this->session->flashdata('smessage'))){ ?>
              <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-check"></i> Alert!</h4>
        <? echo $this->session->flashdata('smessage'); ?>
        </div>
          <? }
           if(!empty($this->session->flashdata('emessage'))){ ?>
           <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
       <? echo $this->session->flashdata('emessage'); ?>
       </div>
        <? } ?> -->

      </div>


    </div>



  </div>

</section>

<?php
// print_r($wishlist_data);die();
if(!empty($wishlistCheck)){
$i=1; foreach($wishlist_data->result() as $data) {
  $pid=$data->product_id;

if(empty($data->stuller_pro_id)){
  $this->db->select('*');
  $this->db->from('tbl_products');
  $this->db->where('id',$pid);
  $this->db->where('is_active', 1);
  $da= $this->db->get()->row();
}else {
  $this->db->select('*');
  $this->db->from('tbl_quickshop_products');
  $this->db->where('product_id',$data->stuller_pro_id);
  $this->db->where('is_active', 1);
  $da= $this->db->get()->row();
}
if(!empty($da)){
  ?>
<section>
  <div class="container-fluid pl-5 pr-5 pt-3 pb-5">

    <div class="row">
      <div class="col-md-7 pl-0 pr-0">
        <strong>ITEM DESCRIPTION</strong>
      </div>
      <div class="col-md-2 text-right pl-0">
        <!-- <strong>QUANTITY</strong> -->
      </div>
      <div class="col-md-3 text-right pr-0">
        <strong>EST. PRICE</strong>
      </div>
    </div>

    <div class="row border_cart">
      <div class="col-md-2 p-0">
        <div>
          <img src="<?=$da->FullySetImage1?>">
        </div>
      </div>
      <div class="col-md-5">
        <p><a href=""><b><?=$da->description?></b></a></p>
        <div class="row">
          <div class="col-md-4">
            <p><strong>Item #: SLR-<?=$da->sku?></strong></p>

          </div>
          <div class="col-md-8">
            <p><?=$da->description?></p>
            <!-- <p>2/15/2021</p>-->
          </div>
        </div>

        <?php if(!empty($data->desc_e_name2)){ ?>

                <div class="row">
                  <div class="col-md-4">
                    <p><strong><?=$data->desc_e_name2;?>:</strong></p>
                    <!-- <p><strong>Added on:</strong></p> -->
                  </div>
                  <div class="col-md-8">
                    <p><?=$data->desc_e_value2?></p>
                    <!-- <p>2/15/2021</p> -->
                  </div>
                </div>

        <?php } ?>

<?php if(!empty($data->desc_e_name3)){ ?>

        <div class="row">
          <div class="col-md-4">
            <p><strong><?=$data->desc_e_name3;?>:</strong></p>
            <!-- <p><strong>Added on:</strong></p> -->
          </div>
          <div class="col-md-8">
            <p><?=$data->desc_e_value3?></p>
            <!-- <p>2/15/2021</p> -->
          </div>
        </div>

<?php } ?>

<?php if(!empty($data->desc_e_name4)){ ?>

        <div class="row">
          <div class="col-md-4">
            <p><strong><?=$data->desc_e_name4;?>:</strong></p>
            <!-- <p><strong>Added on:</strong></p> -->
          </div>
          <div class="col-md-8">
            <p><?=$data->desc_e_value4?></p>
            <!-- <p>2/15/2021</p> -->
          </div>
        </div>

<?php } ?>

<?php if(!empty($data->desc_e_name5)){ ?>

        <div class="row">
          <div class="col-md-4">
            <p><strong><?=$data->desc_e_name5;?>:</strong></p>
            <!-- <p><strong>Added on:</strong></p> -->
          </div>
          <div class="col-md-8">
            <p><?=$data->desc_e_value5?></p>
            <!-- <p>2/15/2021</p> -->
          </div>
        </div>

<?php } ?>

      </div>
      <div class="col-md-2">
      </div>
      <div class="col-md-3 text-right">
        <?php
        $this->db->select('*');
        $this->db->from('tbl_price_rule');
        $pr_data= $this->db->get()->row();
        $multiplier= $pr_data->multiplier;
        $cost_price11= $pr_data->cost_price1;
        $cost_price22= $pr_data->cost_price2;
        $cost_price33= $pr_data->cost_price3;
        $cost_price44= $pr_data->cost_price4;
        $cost_price55= $pr_data->cost_price5;

          $cost_price = $da->price;
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

        ?>
        <p class="green_text"><a>$<?=number_format((float)$now_price, 2, '.', ''); ?></a></p>
      </div>
    </div>
    <div class="row back_col">
      <div class="col-md-6 text-left">
        <p class="mt-2 mb-2 green_text"><i class="fa fa-shopping-cart"></i><a href="javascript:;" onclick="wishlist(this)" data-product-id="<?=$data->product_id;?>" status="move" data-ringsize="<?=$data->ringsize;?>" data-ringprice="<?=$data->ringprice;?>" data-stuller-product-id="" user_id="<?=$this->session->userdata('user_id')?>"> MOVE TO CART</a></p>

      </div>
      <div class="col-md-6 text-right">
        <p class="mt-2 mb-2 red_text"><i class="fa fa-trash"></i><a href="javascript:;"  onclick="wishlist(this)" data-product-id="<?=$data->product_id;?>" status="remove" data-stuller-product-id="" user_id="<?=$this->session->userdata('user_id')?>">REMOVE FROM WISHLIST</a></p>

      </div>
    </div>

  </div>

</section>
<?php
$i++; } }?>
<?}?>


</div>
<!-- cart end -->
