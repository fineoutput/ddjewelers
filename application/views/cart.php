<!-- cart start -->

<style>
  .moblie {
    display: block;
  }

  @media(max-width:785px) {
    .d-none-1 {
      display: block !important;
      text-align: start;
    }

    .moblie-respons-p {
      padding: 10px !important;
    }

    .col-md-2.d-flex.justify-content-between.mt-2 form {
      width: 50%;
    }

    .moblie {
      display: none;
    }
  }

  @media(max-width:397px) {
    .cart_btn {
      font-size: 13px;
    }
  }

  @media(max-width:352px) {
    .cart_btn {
      font-size: 11px;
    }
  }
</style>

<section>
  <div class="container-fluid pl-5 pr-5 pt-3 pb-5 moblie-respons-p">
    <div class="row">
      <div class="col-md-12">
        <h1 class="r-title">Your Cart</h1>
      </div>
    </div>
  </div>
</section>

<?php
if (!empty($cart_data)) {
  $total_cart_amount = 0;
  $i = 1;
  foreach ($cart_data as $data) {
    $gem_data = $data->gem_data?json_decode($data->gem_data):[];
    $monogram_data = $data->monogram?json_decode($data->monogram):[];
    $engrave_data = $data->engrave_data?json_decode($data->engrave_data):[];
    $pid = $data->pro_id;
    $pro_data = $this->db->get_where('tbl_products', array('pro_id' => $data->pro_id))->row();
    if (!empty($pro_data)) {
      if (empty($data->img)) {
        $images = json_decode($pro_data->full_set_images);
        $img = $images[0]->FullUrl;
      } else {
        $img = $data->img;
      }
      $elements = json_decode($pro_data->elements);
?>
      <section>
        <div class="container-fluid pl-5 pr-5 pt-3 pb-5">
          <div class="row">
            <div class="col-md-7 pl-0 pr-0">
              <strong>ITEM DESCRIPTION</strong>
            </div>
            <div class="col-md-2 text-right pl-0 moblie">
              <strong>QUANTITY</strong>
            </div>
            <div class="col-md-3 text-right pr-0 moblie">
              <strong>EST. PRICE</strong>
            </div>
          </div>
          <div class="row border_cart">
            <div class="col-md-2 p-0">
              <div>
                <img src="<?= $img ?>">
              </div>
            </div>
            <div class="col-md-5">
              <p><a href=""><b><?= $pro_data->description ?></b></a></p>
              <div class="row">
                <div class="col-md-12">
                  <p>Item #: SLR-<?= $pro_data->sku ?></p>
                </div>
                <div class="col-md-12">
                  <p><?= $pro_data->short_description ?></p>
                </div>
                <? if (!empty($data->ring_size)) { ?>
                <div class="col-md-12">
                  <p><span><b>Ring Size : </b></span><?= $data->ring_size ?></p>
                </div>
                <?}?>
                <? if (!empty($data->mono_chain_length)) { ?>
                <div class="col-md-12">
                  <p><span><b>Chain Length : </b></span><?= $data->mono_chain_length ?></p>
                </div>
                <?}?>
                <? if (!empty($gem_data)) { ?>
                  <div class="col-md-12">
                    <span><b>Stones : </b></span>
                    <? foreach ($gem_data as  $gem) {
                      if (!empty($gem->Product)) {
                        $item = $gem->Product;
                      } else if (!empty($gem->Diamond)) {
                        $item = $gem->Diamond;
                      } else if (!empty($gem->GemStone)) {
                        $item = $gem->GemStone;
                      } else if (!empty($gem->LabGrownDiamond)) {
                        $item = $gem->LabGrownDiamond;
                      } ?>
                      <? if (!empty($item->Description)) { ?>
                        <span> <?= $item->Description ?> <b>|</b> </span>
                      <? } else if (!empty($item->SerialNumber)) { ?>
                        <span> <?= $item->SerialNumber ?> <b>|</b> </span>
                      <? } else { ?>
                        <span> <?= $item->Id ?> <b>|</b> </span>
                      <? } ?>
                    <? } ?>
                  </div>
                <? } ?>
                <? if (!empty($monogram_data)) { ?>
                  <div class="col-md-12">
                    <span><b>Monogram : </b></span>
                    <? foreach ($monogram_data as  $mono) { ?>
                        <span><b><?= $mono->Text ?> - </b> <?= $mono->Value ?> <b>|</b> </span>
                    <? } ?>
                  </div>
                <? } ?>
                <? if (!empty($engrave_data)) { ?>
                  <div class="col-md-12">
                    <span><b>Engrave : </b></span>
                    <? foreach ($engrave_data as  $engr) { ?>
                        <span><b><?= $engr->Description ?> - </b> <?= $engr->Text ?> <b>|</b> </span>
                    <? } ?>
                  </div>
                <? } ?>
              </div>
            </div>
            <div class="col-md-2 d-flex justify-content-between mt-2 ">
              <div class="d-none d-none-1">
                <p class="mb-0"> <strong>QUANTITY :</strong></p>
              </div>
              <form action="<?php echo base_url() ?>Cart/UpdateCartOnline/<?= $data->pro_id ?>" method="Get" enctype="multipart/form-data">
                <input type="hidden" name="ring_size" value="<?= $data->ring_size ?>">
                <div class="d-flex">
                  <input type="number" onkeydown="if(event.key==='.'){event.preventDefault();}" oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');" name="quantity" class="w-73" value="<?= $data->quantity ?>" min="1">
                  <button class="each_btn">Update</button>
                </div>
              </form>
            </div>
            <div class="col-md-3 text-right d-flex justify-content-between ">
              <p class="d-none d-none-1 mb-0 mt-3 "> <strong>EST. PRICE : </strong></p>
              <?php
              $now_price = $data->price;
              $price_with_quantity = $data->price * $data->quantity;
              ?>

              <p class="green_text mb-0 mt-3" style="text-align: end;"><a>$<?= number_format((float)$price_with_quantity, 2, '.', ''); ?></a></p>
            </div>
          </div>
          <div class="row back_col">
            <div class="col-md-12 text-right">
              <p class="mt-2 mb-2 red_text"><i class="fa fa-trash"></i><a href="<?= base_url(); ?>Cart/RemoveCartOnline/<?= $data->pro_id; ?>/<?= $data->ring_size; ?>">remove item</a></p>

            </div>
          </div>

        </div>

      </section>
  <?php
      $product_qty_amount = $data->quantity * $now_price;
      $total_cart_amount = $total_cart_amount + $product_qty_amount;
      $i++;
    }
  } ?>

  <section class="font-16">
    <div class="container-fluid pl-5 pr-5 pt-0 pb-5">
      <div class="row">
        <!-- <div class="col-md-3">
          <button class="red_btn"><a href="<?= base_url(); ?>Home/delete_all_cart">Remove All from My Cart</a></button>
        </div> -->
        <div class="col-3 ml-auto text-right">
          <p>Subtotal:</p>
        </div>
        <div class="col-3 text-right">
          <p>$<?= number_format((float)$total_cart_amount, 2, '.', ''); ?></p>
        </div>
      </div>
      <div class="col-md-6 ml-auto p-0">
        <hr class="mt-0 mb-0">
      </div>
      <div class="row">
      </div>
      <div class="row mt-3">
        <div class="col-4 ml-auto">
          <?php if ($total_cart_amount  != 0) { ?>
            <a href="<?= base_url(); ?>Home/add_address">
              <button class="cart_btn ">Checkout</button>
            </a>
          <?php } else { ?>
            <button class="cart_btn" disabled style="opacity:0.5;">Checkout</button>
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
<? } else { ?>
  <div class="text-center mb-5">
    <img src="<?= base_url() ?>/assets/frontend/empty.jpg" style="max-width: 20%;
    height: auto;">
    <h5 class="mt-2">Opps! Your cart is empty...</h5>
  </div>
<? } ?>



<!-- cart end -->