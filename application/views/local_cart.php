<!-- cart start -->

<section>
  <div class="container-fluid pl-5 pr-5 pt-3 pb-5">
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
    $gem_data = json_decode($data['gem_data']);
    $pro_data = $this->db->get_where('tbl_products', array('pro_id' => $data['pro_id']))->row();
    if (!empty($pro_data)) {
      if (empty($data['img'])) {
      $images = json_decode($pro_data->full_set_images);
      $img = $images[0]->FullUrl;
      }else{
        $img = $data['img'];
      }
      $elements = json_decode($pro_data->elements);
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
                <? if (!empty($gem_data)) { ?>
                  <div class="col-md-12">
                    <span><b>Stones : </b></span>
                    <? foreach ($gem_data as  $gem) { ?>
                      <span><?= $gem->Product->Description ?> <b>|</b> </span>
                    <? } ?>
                  </div>
                <? } ?>
              </div>
            </div>
            <div class="col-md-2">
              <form action="<?php echo base_url() ?>Cart/UpdateCartOffline/<?= $data['pro_id'] ?>" method="Get" enctype="multipart/form-data">
                <input type="hidden" name="ring_size" value="<?= $data['ring_size'] ?>">
                <div class="d-flex">
                  <input type="number" onkeydown="if(event.key==='.'){event.preventDefault();}" oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');" name="quantity" class="w-73" value="<?= $data['quantity'] ?>" min="1">
                  <button class="each_btn">Update</button>
                </div>
              </form>
            </div>
            <div class="col-md-3 text-right">
              <?php
              if (empty($gem_data)) {
                $pr_data = $this->db->get_where('tbl_price_rule', array())->row();
                $multiplier = $pr_data->multiplier;
                $cost_price = $pro_data->price;
                $retail = $cost_price * $multiplier;
                $now_price = $cost_price;
                if ($cost_price <= 500) {
                  $cost_price2 = $cost_price * $cost_price;
                  $number = round($cost_price * ($pr_data->cost_price1 * $cost_price2 + $pr_data->cost_price2 * $cost_price + $pr_data->cost_price3), 2);
                  $unit = 5;
                  $remainder = $number % $unit;
                  $m_round = ($remainder < $unit / 2) ? $number - $remainder : $number + ($unit - $remainder);
                  $now_price = round($m_round) - 1 + 0.95;
                  $price_with_quantity = $now_price * $data['quantity'];
                } else  if ($cost_price > 500) {
                  $number = round($cost_price * ($pr_data->cost_price4 * $cost_price / $multiplier + $pr_data->cost_price5));
                  $unit = 5;
                  $remainder = $number % $unit;
                  $m_round = ($remainder < $unit / 2) ? $number - $remainder : $number + ($unit - $remainder);
                  $now_price = round($m_round) - 1 + 0.95;
                  $price_with_quantity = $now_price * $data['quantity'];
                }
              } else {
                $now_price = $data['price'];
                $price_with_quantity = $data['price'] * $data['quantity'];
              }
              ?>
              <p class="green_text"><a>$<?= number_format((float)$price_with_quantity, 2, '.', ''); ?></a></p>
            </div>
          </div>
          <div class="row back_col">
            <div class="col-md-12 text-right">
              <p class="mt-2 mb-2 red_text"><i class="fa fa-trash"></i><a href="<?= base_url(); ?>Cart/RemoveCartOffline/<?= $data['pro_id']; ?>/<?= $data['ring_size']; ?>">remove item</a></p>

            </div>
          </div>
        </div>
      </section>
  <?php
      $product_qty_amount = $data['quantity'] * $now_price;
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
        <div class="col-2 text-right">
          <p>$<?= number_format((float)$total_cart_amount, 2, '.', ''); ?></p>
        </div>
      </div>
      <div class="col-md-6 ml-auto p-0">
        <hr class="mt-0 mb-0">
      </div>
      <div class="row mt-3">
        <div class="col-4 ml-auto">
          <a href="<?= base_url(); ?>Home/register">
            <button class="cart_btn">Checkout</button>
          </a>
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