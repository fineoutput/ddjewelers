<!-- my order start -->
<section class="my_order">
    <? if (!empty($this->session->flashdata('smessage'))) { ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Alert!</h4>
            <? echo $this->session->flashdata('smessage'); ?>
        </div>
    <? }
    if (!empty($this->session->flashdata('emessage'))) { ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
            <? echo $this->session->flashdata('emessage'); ?>
        </div>
    <? } ?>
    <?php
    $user_id = $this->session->userdata('user_id');
    //    echo "<pre>";
    // print_r($orders_data->result()); die();
    $i = 0;
    if (!empty($orders_data)) {
        foreach ($orders_data->result() as $data_order1) {
            if ($data_order1->order_status != 0) {
                // $this->db->select('*');
                // $this->db->from('tbl_promocode');
                // $this->db->where('id',$data_order1->promocode);
                // $promo_da= $this->db->get()->row();
                //
                // if(!empty($promo_da)){
                // $percent= $promo_da->percent;
                // // $f_amount= $order1_data->total_amount + $order1_data->order_shipping_amount;
                // $f_amount= $data_order1->total_amount ;
                //
                // $promocodes_discount= $f_amount * $percent/100;
                // $promo_discount= round($promocodes_discount);
                // $promo_name= $promo_da->promocode;
                // }else{
                // $promo_discount= 0;
                // $promo_name= "N/A";
                // }
    ?>
                <div class="container-fluid bg-white order_cont mb-5 pt-5 pb-0 pl-5 pr-5">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6 d-flex align-items-center mb-4 two_btn">
                                    <button class="float-left order_small mr-4">order
                                        #<?= $data_order1->id; ?>
                                    </button>
                                    <span class="sp_od_web">Order Placed <a href="#">
                                            <?php
                                            $newdate = new DateTime($data_order1->date);
                                            echo $newdate->format('j F, Y, g:i a');   #d-m-Y  // March 10, 2001, 5:16 pm
                                            ?>
                                        </a></span>
                                </div>
                                <div class="col-6">
                                    <button class="float-right ordertrack_small">Track order</button>
                                </div>
                                <div class="col-12 sp_od_mob mb-3 d-none">
                                    <center>
                                        <span class="">Order Placed
                                            <?php
                                            $newdate = new DateTime($data_order1->date);
                                            echo $newdate->format('j F, Y, g:i a');   #d-m-Y  // March 10, 2001, 5:16 pm
                                            ?>
                                        </span>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <?php
                        $this->db->select('*');
                        $this->db->from('tbl_order2');
                        $this->db->where('main_id', $data_order1->id);
                        $d1 = $this->db->get();
                        if (!empty($d1)) {
                            foreach ($d1->result() as $dd1) {
                                $gem_data = json_decode($dd1->gem_data);
                                $o_product_name = $dd1->description;
                                $o_product_sku = $dd1->sku;
                                $o_product_image = $dd1->img;
                        ?>
                                <div class="col-12 mt-3 pt-3" style="border-top: 1px solid lightgrey;">
                                    <div class="row">
                                        <div class="col-2">
                                            <img src="<?= $o_product_image; ?>">
                                        </div>
                                        <div class="col-10">
                                            <h4><?= $o_product_name; ?></h4>
                                            <? if (!empty($gem_data)) { ?>
                                                <p><b>Stones:</b> <? foreach ($gem_data as  $gem) {
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
                                                </p>
                                            <? } ?>
                                            <p><b>SKU:</b> SLR-<?= $o_product_sku; ?></p>
                                            <p><b>Quantity: </b> <?= $dd1->quantity; ?></p>
                                            <p><b>Price:</b> $<?= $dd1->amount; ?></p>
                                        </div>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                        <div class="col-12 mt-3 pt-3 pb-3 " style="border-top: 1px solid lightgrey;">
                            <div class="row">
                                <div class="col-12 col-sm-2 col-md-2 col-lg-2 mt-5 mt-lg-0">
                                    <?php if ($data_order1->order_status == 3) { ?>
                                        <button class="can_btn" style="color:orange !important;"><i class="fa fa-truck pr-2"></i>Dispatched</button>
                                    <?php } elseif ($data_order1->order_status == 4) { ?>
                                        <button class="can_btn" style="color:green !important;"><i class="fa fa-check pr-2"></i>Delivered</button>
                                    <?php } elseif ($data_order1->order_status == 5) { ?>
                                        <button class="can_btn"><i class="fa fa-times pr-2"></i>Cancelled</button>
                                    <?php } else { ?>
                                        <!-- <a href="<?= base_url() ?>Home/cancel_order/<?= base64_encode($data_order1->id); ?>"> -->
                                        <button class="can_btn" data-toggle="modal" data-target="#orderCancleModel_<?= $data_order1->id ?>"><i class="fa fa-times pr-2" style="width:13%"></i>CANCEL ORDER</button>
                                        <!-- </a> -->
                                    <?php } ?>
                                    <!-- <button class="can_btn"><i class="fa fa-times pr-2"></i>CANCEL ORDER
              </button> -->
                                </div>
                                <div class="col-12 col-sm-10 col-md-10 col-lg-10 d-flex align-items-center ab_p_h" style="justify-content: space-between;">
                                    <p class="mb-0"><b>Payment Method :</b> <?= $data_order1->payment_type ?></p>
                                    <p class="mb-0 ml-2"><b>Subtotal:</b> $<?= $data_order1->total_amount; ?></p>
                                    <? if (!empty($data_order1->shipping)) { ?><p class="mb-0"><b>Shipping:</b>$<?= $data_order1->shipping; ?></p><? } ?>
                                    <? if (!empty($data_order1->p_discount)) { ?><p class="mb-0"><b>Coupon Discount:</b> $<?= $data_order1->p_discount; ?></p><? } ?>
                                    <p class="mb-0"><b>Total Amount:</b> $<?= $data_order1->final_amount; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- order cancle model popup code start -->
                <div class="modal" tabindex="-1" id="orderCancleModel_<?= $data_order1->id ?>" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Cancel Order - #<?= $data_order1->id; ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p> Are you sure cancel this order?</p>
                            </div>
                            <div class="modal-footer">
                                <a href="<?= base_url() ?>Home/cancel_order/<?= base64_encode($data_order1->id); ?>">
                                    <button type="button" class="btn" style="background-color:#ff6000 !important;color:white !important;">Yes</button>
                                </a>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- order cancle model popup code end -->
    <?php
            }
        }
    } ?>
</section>
<!-- my order end -->