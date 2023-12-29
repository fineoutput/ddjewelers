

<!-- cart start -->

<section>
  <div class="container-fluid pl-5 pr-5 pt-3 pb-5">
    <div class="row">
      <div class="col-md-12">
        <h1 class="r-title">Your Cart</h1>
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
if(!empty($cart)){
  $total_cart_amount=0;
$i=1; foreach($cart->result() as $data) {
  $pid=$data->product_id;

if(empty($data->stuller_pro_id)){
  $this->db->select('*');
  $this->db->from('tbl_products');
  $this->db->where('id',$pid);
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
        <strong>QUANTITY</strong>
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

<?php if(empty($data->stuller_pro_id)){ ?>
        <form action="<?php echo base_url()?>Home/add_quantity_data/<? echo base64_encode(2); ?>/<?echo base64_encode($pid);?>" method="POST" id="slide_frm" enctype="multipart/form-data">
<?php }else{?>
        <form action="<?php echo base_url()?>Home/add_quantity_data/<? echo base64_encode(2); ?>/<?echo base64_encode($pid);?>?stuller=<?=base64_encode($data->stuller_pro_id);?>" method="POST" id="slide_frm" enctype="multipart/form-data">
<?php } ?>
        <div class="d-flex">
          <input type="number" onkeydown="if(event.key==='.'){event.preventDefault();}"  oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');"   name="quantity" class="w-73" value="<?=$data->quantity?>" min="1">
          <button class="each_btn">Update</button>
        </div>
      </div>
    </form>
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

          $cost_price = $da->price + $data->ringprice;
          $retail = $cost_price * $multiplier;
          $now_price = $cost_price;
          $price_with_quantity = $now_price;
        //   echo $data->ringprice;
        //   exit;
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
  $price_with_quantity = $now_price * $data->quantity;
  }
  if($cost_price>500){
    $number= round($cost_price*($cost_price44*$cost_price/$multiplier+$cost_price55));
    $unit=5;
    $remainder = $number % $unit;
  $mround = ($remainder < $unit / 2) ? $number - $remainder : $number + ($unit - $remainder);
  $now_price = round($mround)-1+0.95;
// $now_price = round($mround);
  $price_with_quantity = $now_price * $data->quantity;
  }

        ?>
        <p class="green_text"><a>$<?=number_format((float)$price_with_quantity, 2, '.', ''); ?></a></p>
      </div>
    </div>
    <div class="row back_col">
      <div class="col-md-12 text-right">
        <p class="mt-2 mb-2 red_text"><i class="fa fa-trash"></i><a href="<?=base_url();?>Home/delete_cart/<?=base64_encode($data->id);?>">remove item</a></p>

      </div>
    </div>

  </div>

</section>
<?php
$product_qty_amount= $data->quantity * $now_price;
$total_cart_amount= $total_cart_amount + $product_qty_amount;

$i++; } }?>

<section class="font-16">
  <div class="container-fluid pl-5 pr-5 pt-0 pb-5">

    <div class="row">
      <div class="col-md-3">
        <button class="red_btn"><a href="<?=base_url();?>Home/delete_all_cart">Remove All from My Cart</a></button>
      </div>

      <div class="col-3 ml-auto text-right">
        <p>Subtotal:</p>
        <!-- <p>Estimated Sales Tax:</p> -->
      </div>


      <div class="col-2 text-right">
        <p>$<?=number_format((float)$total_cart_amount, 2, '.', '');?></p>
        <!-- <p>$0</p> -->
      </div>

    </div>
    <div class="col-md-6 ml-auto p-0">
      <hr class="mt-0 mb-0">
    </div>
    <div class="row">


      <!-- <div class="col-3 ml-auto text-right">
       <p><b>Estimated Total:</b></p>
      </div> -->

      <!-- <div class="col-2 text-right">
       <p><b>$<?=number_format((float)$total_cart_amount, 2, '.', '');?></b></p>
      </div> -->



    </div>
    <div class="row mt-3">
       <div class="col-4 ml-auto">

    <?php if($total_cart_amount  != 0 ){?>
      <a href="<?=base_url(); ?>Home/add_address">
        <button class="cart_btn">Checkout</button>
      </a>
    <?php }else { ?>
      <!-- <a href="<?=base_url(); ?>Home/add_address"> -->
        <button class="cart_btn" disabled style="opacity:0.5;" >Checkout</button>
      <!-- </a> -->
  <?php  } ?>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <p>Pricing Notice</p>
        <p>All prices are approximate and are subject to change without notice. Quoted prices for items sold by weight are based on average weight. You will be invoiced for these items based on the actual total weight of the item(s) shipped and the market rates in effect at the time of shipping.</p>
      </div>
    </div>

  </div>
</section>
<?}?>



<!-- cart end -->
