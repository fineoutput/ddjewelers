<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
<style>
    @media (min-width: 360px) and (max-width: 767px) {
        .p30 {
            padding: 10px 30px;
        }

        .add1 {
            padding: 0;
        }
    }

    @media (max-width: 768) {
        .add1 {
            padding: 30px;
        }
    }

    button.pay_btn.pay_btn-2 {
        padding: 0px;
        display: inline-table;
        border-radius: 0px !important;
        color: black;
        background-color: transparent;
        /* border: 1px solid; */
        box-shadow: 0px 1px 4px 1px rgb(104 97 97 / 75%);
    }


    i.bi.bi-arrow-right {
        margin-left: 7px;
        color: white;
        background: #6b6ddf;
        padding: 8px 9px;
        border-radius: 50%;
        font-size: 15px;
    }
</style>

<section>
    <div class="container-fluid pl-5 pr-5 pt-3 pb-5 responsive-padding-mobile">
        <div class="row">
            <div class="col-md-12 page_span">
                <p><a href="<?= base_url(); ?>"><span>Home</span> > <a href="<?= base_url(); ?>Home/cart"><span> SHOPPING CART </span> </a> > <span> Checkout </span></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="font-we">Checkout</h1>
            </div>
        </div>
        <!-- //------- html code start -------- -->
        <?php
        $this->db->select('*');
        $this->db->from('tbl_user_address');
        $this->db->where('id', $address_id);
        $addr_da = $this->db->get()->row();
        if (!empty($addr_da)) {
            $address = $addr_da->address;
            if (!empty($addr_da->country_id)) {
                $country_data1 = $this->db->get_where('tbl_country', array('id' => $addr_da->country_id))->result();
                $country = $country_data1[0]->name;
            } else {
                $country = '';
            }
            if (!empty($addr_da->state_id)) {
                $state_data = $this->db->get_where('tbl_state', array('id' => $addr_da->state_id))->result();
                if (!empty($state_data)) {

                    $state_name = $state_data[0]->name;
                } else {
                    $state_name = '';
                }
            } else {
                $state_name = '';
            }
            $name = $addr_da->first_name . ' ' . $addr_da->last_name;
            $phone = $addr_da->phone_number;
            $dial_code = $addr_da->dial_code;
            $state = $state_name;
            $city = $addr_da->city;
            $zip = $addr_da->zipcode;
            $notes = $addr_da->notes;
        } else {
            $name;
            $address = "";
            $state = "";
            $city = "";
            $zip = "";
            $country = "";
            $notes = '';
            $phone = '';
            $dial_code  = '';
        }
        ?>
        <section class="Address">
            <div class="  container-fluid " style="margin-bottom: 50px;">
                <div class="row ">
                    <div class="col-sm-6 col-md-8 add1">
                        <h5 class="font-we"><b>Address</b></h5>
                        <div class="border" style="padding: 10px;">


                            <p style="margin-bottom: 5px;overflow-wrap: break-word"><b>Name : </b><?= $name; ?></p>

                            <p style="margin-bottom: 5px;overflow-wrap: break-word"><b>Phone Number : </b><?=$dial_code; ?> <?=$phone; ?></p>

                            <p style="margin-bottom: 5px;overflow-wrap: break-word"> <b>Address : </b><?= $address; ?></p>

                            <p style="margin-bottom: 5px;overflow-wrap: break-word"> <b>City : </b><?= $city; ?></p>

                            <p style="margin-bottom: 5px;overflow-wrap: break-word"> <b>State : </b><?= $state_name; ?></p>

                            <p style="margin-bottom: 5px;overflow-wrap: break-word"> <b>Zip Code : </b><?= $zip; ?></p>

                            <p style="margin-bottom: 5px;overflow-wrap: break-word"> <b>Country : </b><?= $country; ?></p>

                            <p style="margin-bottom: 5px;overflow-wrap: break-word"> <b>Notes : </b><?= $notes; ?></p>
                        </div>
                        <h5 class="font-we Address mt-2"><b>Cart Details</b></h5>
                        <div class="  border">
                            <div class="col djhj">
                                <div class="row bold_text bg-light">
                                    <div class="col-5">
                                        <p>Product Name</p>
                                    </div>
                                    <div class="col-3 p-0">
                                        <p>Item Number</p>
                                    </div>
                                    <div class="col-2 p-0">
                                        <p>Quantity</p>
                                    </div>
                                    <div class="col-2 p-0 ">
                                        <p>Price</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $total_cart_amount = 0;
                        if (!empty($order2_data)) {
                            foreach ($order2_data as $cart) {
                                $gem_data = $cart->gem_data ? json_decode($cart->gem_data) : [];
                                $monogram_data = $cart->monogram ? json_decode($cart->monogram) : [];
                                $engrave_data = $cart->engrave_data ? json_decode($cart->engrave_data) : [];
                                $product_id = $cart->pro_id;
                                $pro_da = $this->db->get_where('tbl_products', array('pro_id' => $cart->pro_id))->row();
                                if (!empty($pro_da)) {
                                    $pro_qty_price = $cart->quantity * $cart->amount;
                                    $total_cart_amount = $total_cart_amount + $pro_qty_price;
                        ?>
                                    <div class=" pt-3 border_new table-font-size ">
                                        <div class="col-12">
                                            <div class="row ">
                                                <div class="col-5  " style="    padding-left: 11px;">
                                                    <p><?= $cart->description; ?></p>
                                                    <? if (!empty($cart->ring_size)) { ?>
                                                        <p><span><b>Ring Size : </b></span><?= $cart->ring_size ?></p>
                                                    <? } ?>
                                                    <? if (!empty($cart->mono_chain_length)) { ?>
                                                        <p><span><b>Chain Length : </b></span><?= $cart->mono_chain_length ?></p>
                                                    <? } ?>
                                                    <? if (!empty($gem_data)) { ?>
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
                                                    <? }
                                                    } ?>
                                                    <? if (!empty($monogram_data)) { ?>
                                                        <span><b>Monogram : </b></span>
                                                        <? foreach ($monogram_data as  $mono) { ?>
                                                            <span><b><?= $mono->Text ?> - </b> <?= $mono->Value ?> <b>|</b> </span>
                                                        <? } ?>
                                                    <? } ?>
                                                    <? if (!empty($engrave_data)) { ?>
                                                        <span><b>Engrave : </b></span>
                                                        <? foreach ($engrave_data as  $mono) { ?>
                                                            <span><b><?= $mono->Description ?> - </b> <?= $mono->Text ?> <b>|</b> </span>
                                                        <? } ?>
                                                    <? } ?>
                                                </div>
                                                <div class="col-3 p-0">
                                                    <p class="qut-price1"><?= "SLR-" . $cart->sku; ?></p>
                                                </div>
                                                <div class="col-2 p-0">
                                                    <p class="qut-price2"><?= $cart->quantity; ?></p>
                                                </div>
                                                <div class="col-2 p-0">
                                                    <p class="qut-price3"><b>$<a><?= number_format((float)$pro_qty_price, 2, '.', ''); ?></a></b></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        <?php }
                            }
                        } ?>
                    </div>
                    <div class="col-md-4 col-sm-6 p-0">
                        <h5 class="font-we"><b> Order Summary</b></h5>
                        <div class="px-3 border  pt-0 ">
                            <div class=" ">
                                <div class="row bold_text border-bottom bg-light">
                                    <div class="col-9 col-sm-9 ">
                                        <p> Total: </p>
                                    </div>
                                    <div class="col-3 col-sm-3">
                                        <p><b>$<a><?= number_format((float)$order1_data[0]->total_amount, 2, '.', '') ?></a></b></p>
                                    </div>
                                </div>
                                <div class="row bold_text border-bottom bg-light">
                                    <div class="col-9 col-sm-9">
                                        <p>Shipping Charge:</p>
                                    </div>
                                    <div class="col-3 col-sm-3">
                                        <p>+$<?= number_format((float)$order1_data[0]->shipping, 2, '.', '') ?></p>
                                    </div>
                                </div>
                                <div class="row bold_text border-bottom bg-light">
                                    <div class="col-9 col-sm-9">
                                        <p>Tax:</p>
                                    </div>
                                    <div class="col-3 col-sm-3">
                                        <p>+$<?= number_format((float)$order1_data[0]->delivery_charge, 2, '.', '') ?></p>
                                    </div>
                                </div>
                                <? if (!empty($order1_data[0]->p_discount)) { ?>
                                    <div class="row bold_text border-bottom bg-light">
                                        <div class="col-9 col-sm-9">
                                            <p style="color:green">Promocode:</p>
                                        </div>
                                        <div class="col-3 col-sm-3">
                                            <p style="color:green">-$<?= number_format((float) $order1_data[0]->p_discount, 2, '.', '') ?></p>
                                        </div>
                                    </div>
                                <? } ?>
                                <div class="row bold_text border-bottom bg-light">
                                    <div class="col-9 col-sm-9">
                                        <p> Sub Total: </p>
                                    </div>
                                    <div class="col-3 col-sm-3">
                                        <p><b>$<a><?= number_format((float)$order1_data[0]->final_amount, 2, '.', '') ?></a></b></p>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="amt" value="<?= $order1_data[0]->final_amount ?>">
                            <? if (!empty($promocode_data)) { ?>
                                <div class="d-flex justify-content-between align-items-center my-2">
                                    <label style="color:red"><?= $promocode_data[0]->name ?></label>
                                    <a href="<?= base_url() ?>Order/remove_promocode"><i class="fa fa-times" aria-hidden="true" style="color:red"></i></a>
                                </div>
                            <? } ?>
                            <form method="post" action="<?= base_url() ?>Order/apply_promocode">
                                <label>Promo Code</label><br>
                                <div class="row">
                                    <div class="col-9  col-sm-9  col-9" style="padding-right: 0px ;">
                                        <input type="hidden" name="id" value="<?= $order1_data[0]->id ?>">
                                        <input type="text" name="promocode" class="border" style="height: 38px; width: 100%;">
                                        <!-- style="height: 40px; width:250px;" -->
                                    </div>
                                    <div class="col-3  col-sm-3 col-3">
                                        <Button class="btn signup text-center" type="submit" style=" width: 100%;"> Apply</Button>
                                    </div>
                                </div>
                            </form>

                            <div class=" border-bottom bg-light py-3">
                                <h6><b>Shipping Method</b></h6>
                                <? $i = 0;
                                if (!empty($methods_data)) {
                                    foreach ($methods_data as $key => $method) {
                                ?>
                                        <input type="radio" id="<?= $method['name'] ?>" name="method" index="<?= $key ?>" shipping_id="<?= $method['shipping_id'] ?>" value="<?= $method['id'] ?>" <? if ($method['id'] == $order1_data[0]->method_id) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?>>
                                        <label for="<?= $method['name'] ?>"><?= $method['name'] ?></label><br>
                                    <? $i++;
                                    }
                                } else { ?>
                                    <a href="<?= base_url() ?>Home/contact_us">
                                        <? if (!empty($error_msg)) { ?>
                                            <p style="color:red"><?= $error_msg ?></p>
                                        <? } else { ?>
                                            <p style="color:red">Contact us for shipping cost</p>
                                        <? } ?>
                                    </a>
                                <? } ?>
                            </div>

                            <input type="hidden" name="shipping_arr" id="shipping_arr" value='<?= json_encode($shipping_costs) ?>'>
                            <? if (!empty($methods_data)) { ?>

                                <div class=" mb-3 text-center mb-2">
                                    <!-- <form action="<?= base_url(); ?>Home/affrim_place_order" method="post" enctype="multipart/form-data"> -->
                                    <input type="hidden" value="<?= $address_id; ?>" name="addresss_id">
                                    <input type="hidden" value="" name="applied_promocode" id="applied_promocode">
                                    <a href="javascript:void(0)">
                                        <button class="pay_btn pay_btn-2" style="align-items: baseline;" type="submit" onclick="affirm_open()">
                                            <div style="padding-top: 4px;"> <img src="<?= base_url() ?>assets/frontend/affirm.png" class="img-fluid mx-2" style="width:17%;margin-bottom: 10px" /><span style="text-transform: none; color: black; font-weight: 600;">Pay over time</span> <i class="bi bi-arrow-right"></i>
                                            </div>


                                        </button></a>
                                    <p class="affirm-as-low-as mt-1" data-page-type="cart" data-amount="<?= round($order1_data[0]->final_amount, 2) * 100 ?>"></p>
                                    <P class="" style="font-size:12px"> <a href='https://www.affirm.com/how-it-works' target='_blank' rel='noopener noreferrer'>Affirm How is Works</a></P>
                                    <!-- </form> -->
                                </div>

                                <div class=" mb-3 text-center ">
                                    <input type="hidden" value="<?= $address_id; ?>" name="addresss_id">
                                    <input type="hidden" value="" name="applied_promocode" id="applied_promocode">
                                    <!-- <button class="pay_btn" type="submit">Buy With <img src="<?= base_url() ?>assets/frontend/paypal.png" class="img-fluid ml-2" style="width:20%;" /></button> -->
                                    <div style="text-align:center;" id="paypal-button-container"></div>
                                    <div style="text-align:center;" id="paypal-button" class="btn-space"></div>
                                </div>

                                <div class="mb-3 text-center mb-2" style="align-items: center;display: flex;justify-content: center;">
                                 
                                    <form action="<?= CONVERGEPAY_CHECKOUT_URL ?>" method="post" enctype="application/x-www-form-urlencoded" style="width: 72%;">
                                        <input id="ssl_txn_auth_token" value="<?= $transaction_token ?>" type="hidden" name="ssl_txn_auth_token" size="25">
                                        <input id="ssl_callback_url" value="<?= base_url('Order/process_payment') ?>" type="hidden" name="ssl_callback_url" size="25">

                                        <button id="clicktopay-button" class="pay_btn pay_btn-2" style="align-items: baseline;display: flex;width: 100%;align-items: center;justify-content: space-between;padding: 10px;flex-direction: column;">
                                            <div style="padding-top: 4px;">
                                                <span style="text-transform: none; color: black; font-weight: 600;">
                                                    Pay with Credit Card
                                                </span>

                                            </div>
                                            <div class="pay_ic" style="align-items: center;" style="">
                                                
                                                <img class="payicon" style="width:20%;" src="<?= base_url() ?>assets/jewel/img/payment.png">
                                                <img class="payicon" style="width:20%;" src="<?= base_url() ?>assets/jewel/img/master-card (1).png">
                                                <img class="payicon" style="width:20%;" src="<?= base_url() ?>assets/jewel/img/discover2.png">
                                                <img class="payicon" style="width:20%;" src="<?= base_url() ?>assets/jewel/img/paymentamex.png">

                                            </div>
                                        </button>
                                    </form>
                                </div>


                                <div class="justify-content-center text-center">
                                    <!-- <div id="google-pay-button"></div> -->
                                    <!-- <button id="google-pay-button"></button> -->
                                </div>

                                <div class="justify-content-center text-center">
                                    <div id="dropin-container"></div>
                                </div>
                            <? } ?>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</section>
<!-- //------- html code end -------- -->
<script>
    $('input[type=radio][name=method]').change(function() {
        var base_url = "<?= base_url() ?>";
        var method_id = $(this).val();
        var shipping_id = $(this).attr('shipping_id');
        var index = $(this).attr('index');
        var shipping_arr = $('#shipping_arr').val();
        // console.log(shipping_arr);return;
        var id = "<?= $order1_data[0]->id ?>";
        $.ajax({
            url: base_url + 'Order/change_shipping_method',
            method: 'post',
            data: {
                shipping_arr: shipping_arr,
                method_id: method_id,
                shipping_id: shipping_id,
                index: index,
                id: id,
            },
            dataType: 'json',
            success: function(response) {
                if (response.status == true) {
                    location.reload();
                } else if (response.status == false) {
                    location.reload();
                }
            }
        });
    });
</script>
<!-- payment model start-->
<?php
// $message = $af;
// print_r($message); die();
// if (!empty($message)) {
$amount = $this->session->flashdata('amn');
$amount = number_format((float)$order1_data[0]->final_amount, 2, '.', '');
$merchant_order_id = $this->session->flashdata('order_id');
// $ordr_id_enc = base64_encode($merchant_order_id);
$ordr_id_enc = base64_encode($order1_data[0]->id);
$return_url = site_url() . 'Home/callback/' . $ordr_id_enc;
// } else {
//     $amount = 0;
//     $merchant_order_id = 0;
//     $ordr_id_enc = 0;
//     $return_url = "";
// }
?>
<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Click on button for further payment...</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- <h3 style="text-align:center;"> Click on button for further payment...</h3> -->
                <div style="text-align:center;" id="paypal-button-container"></div>
                <div style="text-align:center;" id="paypal-button"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>

<script>
    // $(document).ready(function() {
    //     if (data != "" && data != null) {
    //         jQuery.noConflict();
    //         // $( '#exampleModal' ).show();
    //         // $("#exampleModal").modal('show');
    //         jQuery('#exampleModal').modal('show');
    //     }
    // });
</script>

<!-- //--- paypal--------- -->
<script>
    paypal.Button.render({
        env: '<?= PAYPAL_ENV; ?>',
        client: {
            <?php if (PRO_PAYPAL) { ?>
                production: '<?php echo PAYPAL_CLIENTID; ?>'
            <?php } else { ?>
                sandbox: '<?php echo PAYPAL_CLIENTID; ?>'
            <?php } ?>
        },
        payment: function(data, actions) {
            return actions.payment.create({
                transactions: [{
                    amount: {
                        total: '<?php echo $amount; ?>',
                        currency: '<?php echo CURRENCY; ?>'
                    }
                }]
            });
        },
        onAuthorize: function(data, actions) {
            return actions.payment.execute()
                .then(function() {
                    $('.center').show();
                    window.location = "<?php echo $return_url; ?>?paymentID=" + data.paymentID + "&payerID=" + data.payerID + "&token=" + data.paymentToken + "&pid=<?php echo $merchant_order_id; ?>";
                });
        }
    }, '#paypal-button');
</script>

<!-- //----------------------------- affirm -------------------- -->
<script>
    // var affirm_config = {
    //     public_api_key: "9PDZ6ZT2BFOPNZXJ",
    //     /* replace with public api key */
    //     //   script:         "https://affirm.com/js/v2/affirm.js"//--- live ---
    //     script: "https://cdn1-sandbox.affirm.com/js/v2/affirm.js" //--- test ---
    // };

    var affirm_config = {
        public_api_key: "<?= AFFIRM_API_KEY ?>",
        script: "<?= AFFIRM_BASE_URL ?>"
    };

    (function(m, g, n, d, a, e, h, c) {
        var b = m[n] || {},
            k = document.createElement(e),
            p = document.getElementsByTagName(e)[0],
            l = function(a, b, c) {
                return function() {
                    a[b]._.push([c, arguments])
                }
            };
        b[d] = l(b, d, "set");
        var f = b[d];
        b[a] = {};
        b[a]._ = [];
        f._ = [];
        b._ = [];
        b[a][h] = l(b, a, h);
        b[c] = function() {
            b._.push([h, arguments])
        };
        a = 0;
        for (c = "set add save post open empty reset on off trigger ready setProduct".split(" "); a < c.length; a++) f[c[a]] = l(b, d, c[a]);
        a = 0;
        for (c = ["get", "token", "url", "items"]; a < c.length; a++) f[c[a]] = function() {};
        k.async = !0;
        k.src = g[e];
        p.parentNode.insertBefore(k, p);
        delete g[e];
        f(g);
        m[n] = b
    })
    (window, affirm_config, "affirm", "checkout", "ui", "script", "ready", "jsReady");

    function affirm_open() {
        $('.center').show();
        affirm.checkout({
            // "merchant": {
            //     "user_confirmation_url": "https://merchantsite.com/confirm",
            //     "user_cancel_url": "https://merchantsite.com/cancel",
            //     "user_confirmation_url_action": "POST",
            //     "name": "DD Jewellers"
            // },
            "merchant": {
                "user_confirmation_url": "<?= AFFIRM_CONFIRMATION_URL ?>",
                "user_cancel_url": "<?= AFFIRM_CANCEL_URL ?>",
                "user_confirmation_url_action": "<?= AFFIRM_CONFIRMATION_URL_ACTION ?>",
                "name": "DD Jewellers"
            },
            "shipping": {
                "name": {
                    "first": "Joe",
                    "last": "Doe"
                },
                "address": {
                    "line1": "<?= $address ?>",
                    "line2": "",
                    "city": "<?= $city ?>",
                    "state": "<?= $state ?>",
                    //"state": "Alabama",
                    "zipcode": "<?= $zip ?>",
                    "country": "USA"
                },
                "phone_number": "",
                "email": "joedoe@123fakestreet.com"
            },
            "billing": {
                "name": {
                    "first": "Joe",
                    "last": "Doe"
                },
                "address": {
                    "line1": "<?= $address ?>",
                    "line2": "",
                    "city": "<?= $city ?>",
                    "state": "<?= $state ?>",
                    //"state": "Alabama",
                    "zipcode": "<?= $zip ?>",
                    "country": "USA"
                },
                "phone_number": "",
                "email": "joedoe@123fakestreet.com"
            },
            "items": [{
                "display_name": "Awesome Pants",
                "sku": "ABC-123",
                "unit_price": 10000,
                "qty": 3,
                "item_image_url": "http://merchantsite.com/images/awesome-pants.jpg",
                "item_url": "http://merchantsite.com/products/awesome-pants.html",
                "categories": [
                    ["Home", "Bedroom"],
                    ["Home", "Furniture", "Bed"]
                ]
            }],
            "discounts": {
                //      "RETURN5":{
                //         "discount_amount":500,
                //         "discount_display_name":"Returning customer 5% discount"
                //     },
                //     "PRESDAY10":{
                //         "discount_amount":1000,
                //         "discount_display_name":"President's Day 10% off"
                //   }
            },
            "metadata": {
                "shipping_type": "UPS Ground",
                "mode": "modal"
            },
            "order_id": "<?= $order1_data[0]->id ?>",
            "currency": "USD",
            "financing_program": "",
            "shipping_amount": <?= (int)round($order1_data[0]->shipping * 100) ?>,
            "tax_amount": <?= (int)round($order1_data[0]->delivery_charge * 100) ?>,
            "total": <?= (int)round($order1_data[0]->final_amount * 100) ?>

        })
        var base_url = "<?= base_url() ?>";
        affirm.checkout.open({
            onFail: (error) => {
                $('.center').hide();

                // window.open(base_url + 'Home/order_failed', "_self");
            },
            onSuccess: (data) => {
                $('.center').show();

                $.ajax({
                    url: base_url + 'Order/affirm_success',
                    method: 'post',
                    data: {
                        id: <?= $order1_data[0]->id ?>,
                        checkout_token: data['checkout_token'],
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        if (response.status == true) {
                            window.open(base_url + 'Home/order_success', "_self");
                        } else if (response.status == false) {
                            window.open(base_url + 'Home/order_failed', "_self");
                        }
                    },
                    error: function(xhr, status, error) {
                        // This function will be called if the request fails
                        console.error(xhr.responseText);
                        // Log the error message
                    }
                });
            }
        })

    }
</script>

<!-- //------- gpay ------- -->
<script src="https://pay.google.com/gp/p/js/pay.js"></script>
<script src="https://js.braintreegateway.com/web/3.91.0/js/client.min.js"></script>
<script src="https://js.braintreegateway.com/web/3.91.0/js/google-payment.min.js"></script>
<script>
    // Make sure to have https://pay.google.com/gp/p/js/pay.js loaded on your page
    // You will need a button element on your page styled according to Google's brand guidelines
    // https://developers.google.com/pay/api/web/guides/brand-guidelines
    // var button = document.querySelector('#google-pay-button');
    var paymentsClient = new google.payments.api.PaymentsClient({
        environment: 'TEST' // Or 'PRODUCTION'
    });
    const button =
        paymentsClient.createButton({});
    document.getElementById('google-pay-button').appendChild(button);
    const nodes = document.getElementsByTagName("button");
    //   setTimeout(() => {
    //   $("button").click();
    // $('button').trigger('click');
    //   }, 1000);
    var amount = $("#amt").val();
    braintree.client.create({
        authorization: "<?= $braintree_auth ?>"
    }, function(clientErr, clientInstance) {
        braintree.googlePayment.create({
            client: clientInstance,
            googlePayVersion: 2,
            // googleMerchantId: 'BCR2DN6TU7ZYT2CP' // Optional in sandbox; if set in sandbox, this value must be a valid production Google Merchant ID
            googleMerchantId: '<?= GOOGLE_PAY_MERCHANTID ?>' // Optional in sandbox; if set in sandbox, this value must be a valid production Google Merchant ID
        }, function(googlePaymentErr, googlePaymentInstance) {
            paymentsClient.isReadyToPay({
                // see https://developers.google.com/pay/api/web/reference/object#IsReadyToPayRequest
                apiVersion: 2,
                apiVersionMinor: 0,
                allowedPaymentMethods: googlePaymentInstance.createPaymentDataRequest().allowedPaymentMethods,
                existingPaymentMethodRequired: true // Optional
            }).then(function(response) {
                if (response.result) {
                    button.addEventListener('click', function(event) {
                        event.preventDefault();
                        var paymentDataRequest = googlePaymentInstance.createPaymentDataRequest({
                            transactionInfo: {
                                displayItems: [{
                                    label: "Subtotal",
                                    type: "SUBTOTAL",
                                    price: "" + amount + "",
                                }, ],
                                countryCode: 'US',
                                currencyCode: "USD",
                                totalPriceStatus: "FINAL",
                                totalPrice: "" + amount + "",
                                totalPriceLabel: "Total"
                            },
                            merchantInfo: {
                                // merchantId: 'BCR2DN6TU7ZYT2CP',
                                merchantId: '<?= GOOGLE_PAY_MERCHANTID ?>',
                                // merchantName: 'D&D Jewelry'
                                merchantName: '<?= GOOGLE_PAY_MERCHANTNAME ?>'
                            },
                        });
                        // We recommend collecting billing address information, at minimum
                        // billing postal code, and passing that billing postal code with all
                        // Google Pay card transactions as a best practice.
                        // See all available options at https://developers.google.com/pay/api/web/reference/object
                        var cardPaymentMethod = paymentDataRequest.allowedPaymentMethods[0];
                        cardPaymentMethod.parameters.billingAddressRequired = true;
                        cardPaymentMethod.parameters.billingAddressParameters = {
                            format: 'FULL',
                            phoneNumberRequired: true
                        };
                        paymentsClient.loadPaymentData(paymentDataRequest).then(function(paymentData) {
                            googlePaymentInstance.parseResponse(paymentData, function(err, result) {
                                if (err) {
                                    // Handle parsing error
                                    // alert("hello")
                                }
                                var nonce = paymentData.paymentMethodData.tokenizationData.token;
                                // console.log(JSON.stringify(paymentDataRequest))
                                // console.log(JSON.stringify(result))
                                // alert("hi")
                                // return;
                                var base_url = "<?= base_url() ?>";
                                $('.center').show();
                                $.ajax({
                                    url: base_url + 'Order/googlePay_verify',
                                    method: 'post',
                                    data: {
                                        id: <?= $order1_data[0]->id ?>,
                                        amount: amount,
                                        nonce: result.nonce,
                                    },
                                    dataType: 'json',
                                    success: function(response) {
                                        if (response.status == true) {
                                            window.open(base_url + 'Home/order_success', "_self");
                                        } else if (response.status == false) {
                                            window.open(base_url + 'Home/order_failed', "_self");
                                        }
                                    }
                                });
                                // Send result.nonce to your server
                                // result.type may be either "AndroidPayCard" or "PayPalAccount", and
                                // paymentData will contain the billingAddress for card payments
                            });
                        }).catch(function(err) {
                            // Handle errors
                            // alert("bye")
                        });
                    });
                }
            }).catch(function(err) {
                // Handle errors
                // alert("tata")
            });
        });
        // Set up other Braintree components
    });
</script>
<!-- payment model end-->