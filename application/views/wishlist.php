
<style>
  .moblie{
  display: block;
}
  @media(max-width:785px){
.d-none-1{
  display:  block  !important;  
  text-align: start;
}
.col-md-2.d-flex.justify-content-between.mt-2 form {
    width: 50%;
}
.moblie{
  display: none;
}
.moblie-respons-p{
      padding: 10px !important;
    }
  }
 
</style>


<!-- cart start -->
<div id="WishlistData">
  <section>
    <div class="container-fluid pl-5 pr-5 pt-3 pb-5 moblie-respons-p">
      <div class="row">
        <div class="col-md-12">
          <h1 class="r-title">Your Wishlist</h1>
        </div>
      </div>
    </div>
  </section>
  <?php
  if (!empty($wishlistCheck)) {
    $i = 1;
    foreach ($wishlist_data->result() as $data) {
      $pro_data = $this->db->get_where('tbl_products', array('pro_id' => $data->pro_id))->row();
      if (!empty($pro_data)) {
        $images = json_decode($pro_data->full_set_images);
        $elements = json_decode($pro_data->elements);
  ?>
        <section>
          <div class="container-fluid pl-5 pr-5 pt-3 pb-5">

            <div class="row">
              <div class="col-md-7 pl-0 pr-0">
                <strong>ITEM DESCRIPTION</strong>
              </div>
              <div class="col-md-2 text-right pl-0">
              </div>
              <div class="col-md-3 text-right pr-0 moblie">
                <strong>EST. PRICE</strong>
              </div>
            </div>

            <div class="row border_cart">
              <div class="col-md-2 p-0">
                <div>
                  <img src="<?= $images[0]->FullUrl ?>">
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
                </div>
              </div>
              <div class="col-md-2">
              </div>
              <div class="col-md-3 text-right d-flex justify-content-between  " >
              <p class="d-none d-none-1 mb-0  ">  <strong>EST. PRICE : </strong></p>
                <?php
                $pr_data = $this->db->get_where('tbl_price_rule', array('name'=>'Product'))->row();
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
                } else  if ($cost_price > 500) {
                  $number = round($cost_price * ($pr_data->cost_price4 * $cost_price / $multiplier + $pr_data->cost_price5));
                  $unit = 5;
                  $remainder = $number % $unit;
                  $m_round = ($remainder < $unit / 2) ? $number - $remainder : $number + ($unit - $remainder);
                  $now_price = round($m_round) - 1 + 0.95;
                }

                ?>
                <p class="green_text"><a>$<?= number_format((float)$now_price, 2, '.', ''); ?></a></p>
              </div>
            </div>
            <div class="row back_col">
              <!-- <div class="col-md-6 text-left">
                <p class="mt-2 mb-2 green_text"><i class="fa fa-shopping-cart"></i><a href="javascript:;" onclick="wishlist(this)" data-pro-id="<?= $data->pro_id; ?>" status="move"> MOVE TO CART</a></p>

              </div> -->
              <div class="col-md-12 text-right">
                <p class="mt-2 mb-2 red_text"><i class="fa fa-trash"></i><a href="javascript:;" onclick="wishlist(this)" data-pro-id="<?= $data->pro_id; ?>" status="remove">REMOVE FROM WISHLIST</a></p>
              </div>
            </div>
          </div>
        </section>
    <?php
        $i++;
      }
    } ?>
  <? } else { ?>
    <div class="text-center mb-5">
      <img src="<?= base_url() ?>/assets/frontend/empty.jpg" style="max-width: 20%;
    height: auto;">
      <h5 class="mt-2">Opps! Your wishlist is empty...</h5>
    </div>
  <? } ?>
</div>
<!-- cart end -->