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
</style>
<section>
    <div class="container-fluid pl-5 pr-5 pt-3 pb-5">
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
            $state = $addr_da->state;
            $city = $addr_da->town_city;
            $zip = $addr_da->postal_code;
            $phone = $addr_da->customer_phone;
        } else {
            $address = "";
            $state = "";
            $city = "";
            $zip = "";
            $country = "";
            $phone = "";
        }
        ?>
        <section class="Address">
            <div class="  container-fluid " style="margin-bottom: 50px;">
                <div class="row ">
                    <div class="col-sm-6 col-md-8 add1">
                        <h5 class="font-we"><b>Address</b></h5>
                        <p class="border" style="padding: 10px;"> <?= $address . ", " . $city . ", " . $state . ", " . $country . "," . $zip; ?></p>
                        <h5 class="font-we Address "><b>Cart Details</b></h5>
                        <div class="  border">
                            <div class="col">
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
                                $product_id = $cart->product_id;
                                if (empty($cart->stuller_pro_id)) {
                                    $this->db->select('*');
                                    $this->db->from('tbl_products');
                                    $this->db->where('id', $product_id);
                                    $this->db->where('is_active', 1);
                                    $pro_da = $this->db->get()->row();
                                } else {
                                    $this->db->select('*');
                                    $this->db->from('tbl_quickshop_products');
                                    $this->db->where('product_id', $cart->stuller_pro_id);
                                    $this->db->where('is_active', 1);
                                    $pro_da = $this->db->get()->row();
                                }
                                if (!empty($pro_da)) {
                                    $this->db->select('*');
                                    $this->db->from('tbl_price_rule');
                                    $pr_data = $this->db->get()->row();
                                    $multiplier = $pr_data->multiplier;
                                    $cost_price11 = $pr_data->cost_price1;
                                    $cost_price22 = $pr_data->cost_price2;
                                    $cost_price33 = $pr_data->cost_price3;
                                    $cost_price44 = $pr_data->cost_price4;
                                    $cost_price55 = $pr_data->cost_price5;
                                    $cost_price = $pro_da->price + $cart->ringprice;
                                    $retail = $cost_price * $multiplier;
                                    $now_price = $cost_price;
                                    //   echo $cart->ringprice;
                                    //   exit;
                                    if ($cost_price <= 500) {
                                        $cost_price2 = $cost_price * $cost_price;
                                        // $now_price= $cost_price*0.00000264018*($cost_price*2)+(-0.002220133*$cost_price)+1.950022201-1+0.95;
                                        $number = round($cost_price * ($cost_price11 * $cost_price2 + $cost_price22 * $cost_price + $cost_price33), 2);
                                        $unit = 5;
                                        $remainder = $number % $unit;
                                        $mround = ($remainder < $unit / 2) ? $number - $remainder : $number + ($unit - $remainder);
                                        $now_price = round($mround) - 1 + 0.95;
                                        // $now_price = round($mround);
                                        // exit;
                                    }
                                    if ($cost_price > 500) {
                                        $number = round($cost_price * ($cost_price44 * $cost_price / $multiplier + $cost_price55));
                                        $unit = 5;
                                        $remainder = $number % $unit;
                                        $mround = ($remainder < $unit / 2) ? $number - $remainder : $number + ($unit - $remainder);
                                        $now_price = round($mround) - 1 + 0.95;
                                        // $now_price = round($mround);
                                    }
                                    $pro_qty_price = $cart->quantity * $now_price;
                                    $total_cart_amount = $total_cart_amount + $pro_qty_price;
                        ?>
                                    <div class=" pt-3 border_new ">
                                        <div class="col-12">
                                            <div class="row ">
                                                <div class="col-5  " style="    padding-left: 11px;">
                                                    <p><?= $pro_da->description; ?></p>
                                                </div>
                                                <div class="col-3 p-0">
                                                    <p><?= "SLR-" . $pro_da->sku; ?></p>
                                                </div>
                                                <div class="col-2 p-0">
                                                    <p><?= $cart->quantity; ?></p>
                                                </div>
                                                <div class="col-2 p-0">
                                                    <p><b>$<a><?= number_format((float)$pro_qty_price, 2, '.', ''); ?></a></b></p>
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
                                    <div class="col-8  col-sm-8 ">
                                        <input type="hidden" name="id" value="<?= $order1_data[0]->id ?>">
                                        <input type="text" name="promocode" class="border" style="height: 38px; width: 100%;">
                                        <!-- style="height: 40px; width:250px;" -->
                                    </div>
                                    <div class="col-4  col-sm-4">
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
                                        <p style="color:red">Contact us for shipping cost</p>
                                    </a>
                                <? } ?>
                            </div>
                            <input type="hidden" name="shipping_arr" id="shipping_arr" value='<?= json_encode($shipping_costs) ?>'>
                            <? if (!empty($methods_data)) { ?>
                                <div class=" mb-3 text-center">
                                    <!-- <form action="<?= base_url(); ?>Home/affrim_place_order" method="post" enctype="multipart/form-data"> -->
                                    <input type="hidden" value="<?= $address_id; ?>" name="addresss_id">
                                    <input type="hidden" value="" name="applied_promocode" id="applied_promocode">
                                    <a href="javascript:void(0)"><button class="pay_btn" style="align-items: baseline;" type="submit" onclick="affirm_open()">Buy With <img src="<?= base_url() ?>assets/frontend/affirm.png" class="img-fluid ml-2" style="width:17%;" /></button></a>
                                    <!-- </form> -->
                                </div>
                                <div class=" mb-3 text-center ">
                                    <input type="hidden" value="<?= $address_id; ?>" name="addresss_id">
                                    <input type="hidden" value="" name="applied_promocode" id="applied_promocode">
                                    <!-- <button class="pay_btn" type="submit">Buy With <img src="<?= base_url() ?>assets/frontend/paypal.png" class="img-fluid ml-2" style="width:20%;" /></button> -->
                                    <div style="text-align:center;" id="paypal-button-container"></div>
                                    <div style="text-align:center;" id="paypal-button"></div>
                                </div>
                                <div class="justify-content-center text-center">
                                    <div id="container"></div>
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
$ordr_id_enc = base64_encode($merchant_order_id);
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
                    window.location = "<?php echo PAYPAL_BASE_URL . $return_url; ?>?paymentID=" + data.paymentID + "&payerID=" + data.payerID + "&token=" + data.paymentToken + "&pid=<?php echo $merchant_order_id; ?>";
                });
        }
    }, '#paypal-button');
</script>
<!-- //----------------------------- affirm -------------------- -->
<script>
    var affirm_config = {
        public_api_key: "9PDZ6ZT2BFOPNZXJ",
        /* replace with public api key */
        //   script:         "https://affirm.com/js/v2/affirm.js"//--- live ---
        script: "https://cdn1-sandbox.affirm.com/js/v2/affirm.js" //--- test ---
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
        affirm.checkout({
            "merchant": {
                "user_confirmation_url": "https://merchantsite.com/confirm",
                "user_cancel_url": "https://merchantsite.com/cancel",
                "user_confirmation_url_action": "POST",
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
                    "zipcode": "<?= $zip ?>",
                    "country": "USA"
                },
                "phone_number": "<?= $phone ?>",
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
                    "zipcode": "<?= $zip ?>",
                    "country": "USA"
                },
                "phone_number": "<?= $phone ?>",
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
            "shipping_amount": "<?= $order1_data[0]->shipping ?>",
            "tax_amount": 0,
            "total": "<?= round($order1_data[0]->final_amount * 100) ?>"
        })
        affirm.checkout.open({
            onFail: (error) => {
                window.open(base_url + 'Home/order_failed', "_self");
            },
            onSuccess: (data) => {
                var base_url = "<?= base_url() ?>";
                $.ajax({
                    url: base_url + 'Order/affirm_success',
                    method: 'post',
                    data: {
                        id: <?= $order1_data[0]->id ?>,
                        checkout_token: data['checkout_token'],
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
            }
        })
    }
</script>
<!-- //------- gpay ------- -->
<script async   src="https://pay.google.com/gp/p/js/pay.js"   onload="onGooglePayLoaded()"></script>
<script>
    /**
     * Define the version of the Google Pay API referenced when creating your
     * configuration
     *
     * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#PaymentDataRequest|apiVersion in PaymentDataRequest}
     */
    const baseRequest = {
        apiVersion: 2,
        apiVersionMinor: 0
    };
    /**
     * Card networks supported by your site and your gateway
     *
     * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#CardParameters|CardParameters}
     * @todo confirm card networks supported by your site and gateway
     */
    const allowedCardNetworks = ["AMEX", "DISCOVER", "INTERAC", "JCB", "MASTERCARD", "VISA"];
    /**
     * Card authentication methods supported by your site and your gateway
     *
     * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#CardParameters|CardParameters}
     * @todo confirm your processor supports Android device tokens for your
     * supported card networks
     */
    const allowedCardAuthMethods = ["PAN_ONLY", "CRYPTOGRAM_3DS"];
    /**
     * Identify your gateway and your site's gateway merchant identifier
     *
     * The Google Pay API response will return an encrypted payment method capable
     * of being charged by a supported gateway after payer authorization
     *
     * @todo check with your gateway on the parameters to pass
     * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#gateway|PaymentMethodTokenizationSpecification}
     */
    const tokenizationSpecification = {
        type: 'PAYMENT_GATEWAY',
        parameters: {
            'gateway': 'example',
            'gatewayMerchantId': 'BCR2DN6T7P04XAJG'
        }
    };
    /**
     * Describe your site's support for the CARD payment method and its required
     * fields
     *
     * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#CardParameters|CardParameters}
     */
    const baseCardPaymentMethod = {
        type: 'CARD',
        parameters: {
            allowedAuthMethods: allowedCardAuthMethods,
            allowedCardNetworks: allowedCardNetworks
        }
    };
    /**
     * Describe your site's support for the CARD payment method including optional
     * fields
     *
     * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#CardParameters|CardParameters}
     */
    const cardPaymentMethod = Object.assign({},
        baseCardPaymentMethod, {
            tokenizationSpecification: tokenizationSpecification
        }
    );
    /**
     * An initialized google.payments.api.PaymentsClient object or null if not yet set
     *
     * @see {@link getGooglePaymentsClient}
     */
    let paymentsClient = null;
    /**
     * Configure your site's support for payment methods supported by the Google Pay
     * API.
     *
     * Each member of allowedPaymentMethods should contain only the required fields,
     * allowing reuse of this base request when determining a viewer's ability
     * to pay and later requesting a supported payment method
     *
     * @returns {object} Google Pay API version, payment methods supported by the site
     */
    function getGoogleIsReadyToPayRequest() {
        return Object.assign({},
            baseRequest, {
                allowedPaymentMethods: [baseCardPaymentMethod]
            }
        );
    }
    /**
     * Configure support for the Google Pay API
     *
     * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#PaymentDataRequest|PaymentDataRequest}
     * @returns {object} PaymentDataRequest fields
     */
    function getGooglePaymentDataRequest() {
        const paymentDataRequest = Object.assign({}, baseRequest);
        paymentDataRequest.allowedPaymentMethods = [cardPaymentMethod];
        paymentDataRequest.transactionInfo = getGoogleTransactionInfo();
        paymentDataRequest.merchantInfo = {
            // @todo a merchant ID is available for a production environment after approval by Google
            // See {@link https://developers.google.com/pay/api/web/guides/test-and-deploy/integration-checklist|Integration checklist}
            merchantId: 'BCR2DN6TU7ZYT2CP',
            merchantName: 'D&D Jewelry'
        };
        paymentDataRequest.callbackIntents = ["PAYMENT_AUTHORIZATION"];
        return paymentDataRequest;
    }
    /**
     * Return an active PaymentsClient or initialize
     *
     * @see {@link https://developers.google.com/pay/api/web/reference/client#PaymentsClient|PaymentsClient constructor}
     * @returns {google.payments.api.PaymentsClient} Google Pay API client
     */
    function getGooglePaymentsClient() {
        if (paymentsClient === null) {
            paymentsClient = new google.payments.api.PaymentsClient({
                environment: 'PRODUCTION',
                paymentDataCallbacks: {
                    onPaymentAuthorized: onPaymentAuthorized
                }
            });
        }
        return paymentsClient;
    }
    /**
     * Handles authorize payments callback intents.
     *
     * @param {object} paymentData response from Google Pay API after a payer approves payment through user gesture.
     * @see {@link https://developers.google.com/pay/api/web/reference/response-objects#PaymentData object reference}
     *
     * @see {@link https://developers.google.com/pay/api/web/reference/response-objects#PaymentAuthorizationResult}
     * @returns Promise<{object}> Promise of PaymentAuthorizationResult object to acknowledge the payment authorization status.
     */
    function onPaymentAuthorized(paymentData) {
        return new Promise(function(resolve, reject) {
            // handle the response
            processPayment(paymentData)
                .then(function() {
                    resolve({
                        transactionState: 'SUCCESS'
                    });
                    $.ajax({
                        url: '<?= base_url() ?>Order/google_success',
                        method: 'post',
                        data: {
                            order_id: <?= $order1_data[0]->id ?>,
                            // gpay_token: paymentToken,
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status == true) {
                                window.open('<?= base_url() ?>Home/order_success',);
                            } else if (response.status == false) {
                                alert('fail')
                            }
                        }
                    });
                })
                .catch(function() {
                    // alert('failed');
                    resolve({
                        transactionState: 'ERROR',
                        error: {
                            intent: 'PAYMENT_AUTHORIZATION',
                            message: 'Insufficient funds, try again. Next attempt should work.',
                            reason: 'PAYMENT_DATA_INVALID'
                        }
                    });
                });
        });
    }
    /**
     * Initialize Google PaymentsClient after Google-hosted JavaScript has loaded
     *
     * Display a Google Pay payment button after confirmation of the viewer's
     * ability to pay.
     */
    function onGooglePayLoaded() {
        const paymentsClient = getGooglePaymentsClient();
        paymentsClient.isReadyToPay(getGoogleIsReadyToPayRequest())
            .then(function(response) {
                if (response.result) {
                    // onGooglePaymentButtonClicked();
                    addGooglePayButton();
                }
            })
            .catch(function(err) {
                // show error in developer console for debugging
                console.error(err);
            });
    }
    /**
     * Add a Google Pay purchase button alongside an existing checkout button
     *
     * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#ButtonOptions|Button options}
     * @see {@link https://developers.google.com/pay/api/web/guides/brand-guidelines|Google Pay brand guidelines}
     */
    function addGooglePayButton() {
        const paymentsClient = getGooglePaymentsClient();
        const button =
            paymentsClient.createButton({
                onClick: onGooglePaymentButtonClicked
            });
        document.getElementById('container').appendChild(button);
        const nodes = document.getElementsByTagName("button");
        //   setTimeout(() => {
        //   $("button").click();
        // $('button').trigger('click');
        //   }, 1000);
    }
    /**
     * Provide Google Pay API with a payment amount, currency, and amount status
     *
     * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#TransactionInfo|TransactionInfo}
     * @returns {object} transaction info, suitable for use as transactionInfo property of PaymentDataRequest
     */
    <?
    // $amount = $this->session->flashdata('amn');
    // $order_id = $this->session->flashdata('order_id');
    // $currency_code = $this->session->flashdata('currency_code');
    // $address_data = $this->session->flashdata('address_data');
    // $user_data = $this->session->flashdata('user_data');
    ?>
    // var amount = $("#amt").val();
    var amount = 1;
    function getGoogleTransactionInfo() {
        return {
            displayItems: [{
                    label: "Subtotal",
                    type: "SUBTOTAL",
                    price: "" + amount + "",
                },
                {
                    label: "Tax",
                    type: "TAX",
                    price: "0.00",
                }
            ],
            countryCode: 'US',
            currencyCode: "USD",
            totalPriceStatus: "FINAL",
            totalPrice: "" + amount + "",
            totalPriceLabel: "Total"
        };
    }
    /**
     * Show Google Pay payment sheet when Google Pay payment button is clicked
     */
    function onGooglePaymentButtonClicked() {
        const paymentDataRequest = getGooglePaymentDataRequest();
        paymentDataRequest.transactionInfo = getGoogleTransactionInfo();
        const paymentsClient = getGooglePaymentsClient();
        paymentsClient.loadPaymentData(paymentDataRequest);
    }
    let attempts = 0;
    /**
     * Process payment data returned by the Google Pay API
     *
     * @param {object} paymentData response from Google Pay API after user approves payment
     * @see {@link https://developers.google.com/pay/api/web/reference/response-objects#PaymentData|PaymentData object reference}
     */
    function processPayment(paymentData) {
        return new Promise(function(resolve, reject) {
            setTimeout(function() {
                // @todo pass payment token to your gateway to process payment
                paymentToken = paymentData.paymentMethodData.tokenizationData.token;
                // success()
                console.log(paymentToken)
                if (attempts++ % 2 == 0) {
                    reject(new Error('Every other attempt fails, next one should succeed'));
                } else {
                    resolve({});
                }
            }, 500);
        });
    }
    function pay_success() {
        console.log("hi")
        $.ajax({
            url: '<?= base_url() ?>Order/google_success',
            method: 'post',
            data: {
                order_id: <?= $order1_data[0]->id ?>,
                // gpay_token: paymentToken,
            },
            dataType: 'json',
            success: function(response) {
                if (response.status == true) {
                    alert('success')
                } else if (response.status == false) {
                    alert('fail')
                }
            }
        });
    }
</script>
<!-- payment model end-->