<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DD Jewel Plus</title>

</head>


<body>
    <div class="container" style="  width: 1100px;
        margin: auto;">
        <div style="text-align: center">
            <img src="<?= base_url() ?>assets/jewel/img/dd_logo.png" alt="D&D" style="width: 120px">
            <h3 class="lobi" style="margin-block-end: 0; font-weight: 100;
        color: #2f3338;
        font-size: 24px;
        margin-top: 5px;
        text-align: 'center';">D&amp;D Jewelry</h3>
            <h5 style="margin-block-start:0;margin-block-end: 0;      font-size: 22px;
        padding-top: 5px;
        color: #2f3338;" class="logo-bott-text" >Since 1985</h5>
        </div>
        <hr>
        <section style="  margin-top: 34px;
        margin-bottom: 34px;">
            <div class="order_section " style="        text-align: center;">
                <h1><b style="font-size: 40px;">Order Confirmation</b></h1>
                <p>A new order was made on <span style="color:#0d6efd">www.dd.jewelplus.com</span>, you can view this
                    order in your site admin.</p>
        </section>
        <section style="  margin-top: 34px;
        margin-bottom: 34px;">
            <?
            $this->db->select('*');
            $this->db->from('tbl_order2');
            $this->db->where('main_id', $order1_id);
            $order2 = $this->db->get();
            $this->db->select('*');
            $this->db->from('tbl_users');
            $this->db->where('id', $order1_data->user_id);
            $user = $this->db->get()->row();
            $this->db->select('*');
            $this->db->from('tbl_user_address');
            $this->db->where('id', $order1_data->address_id);
            $user_address = $this->db->get()->row();
            if (!empty($user_address)) {
                $name = $user_address->first_name . ' ' . $user_address->last_name;
                $address1 = $user_address->address;
                $address2 = $user_address->address2;
                $city = $user_address->city;
                $state_id = $user_address->state_id;
                $zipcode = $user_address->zipcode;
                $this->db->select('*');
                $this->db->from('tbl_state');
                $this->db->where('id', $state_id);
                $statedata = $this->db->get()->row();
                $state = $statedata->name;
                $country_id = $user_address->country_id;
                $this->db->select('*');
                $this->db->from('tbl_country');
                $this->db->where('id', $country_id);
                $contrydata = $this->db->get()->row();
                $country = $contrydata->name;
            } else {
                $name = '';
                $state = '';
                $country = '';
                $city = '';
                $address2 = '';
                $address1 = '';
                $zipcode = '';
            }
            ?>
            <? $count = 0;
            foreach ($order2->result() as $ord) {
                $gem_data = json_decode($ord->gem_data);
            ?>
                <div class="Italian_section ">
                    <hr>
                    <div class="row cart-box" style="  display: flex;
        align-items: center;">
                        <div class="col-lg-4 img-box " style="text-align: center;">
                            <img src="<?= $ord->img ?>" alt="D&D" class="img-fluid product-image" style=" width: 50%">
                        </div>
                        <div class="col-lg-8 Italian_sec" style="  width: 80%;">
                            <h3 style="  color: #2f3338;
        font-size: 22px;
        font-weight: 500;"><?= $ord->description ?>
                                <? if (!empty($gem_data)) { ?>
                                    </br><span><b>Stones : </b></span>
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
                                        <? } else { ?>
                                            <span> <?= $item->SerialNumber ?> <b>|</b> </span>

                                        <? } ?>
                                    <? } ?>
                                <? } ?>
                            </h3>
                            <p><?= 'QTY : ' . $ord->quantity ?></p>
                            <p><?= 'Sku Id : ' . $ord->sku ?></p>
                            <h3><?= '$' . $ord->amount ?></h3>
                        </div>
                    </div>
                </div>
            <?
                $count++;
            }
            ?>
        </section>
        <hr>
        <section style="    margin-bottom: 0px; margin-top: 34px;">
            <div class="order_section2">
                <H2 class="order-heading" style=" margin-bottom: 0px !important;  font-size: 33px;">Order Information</H2>
                <div class="row" style="  display: flex;
        align-items: center;">

                    <div>
                        <p>Name: <?= $user->name ?></p>
                        <p> Email: <span style="color:#0d6efd"><?= $user->email ?></span></p>
                    </div>



                </div>
            </div>
        </section>



        <section style="margin-bottom: 0px; margin-top: 34px;">
            <div class="order_section2">
                <div class="row" style="  display: flex;
        align-items: center;">
                    <div class="col-lg-6"  style="width:50%">

                        <div class="mt-5">
                            <p><?= 'Order Id : #' . $order1_id ?></p>
                            <p> <?= 'Txn Id :' . $order1_data->txnid ?></p>
                            <p> <?= 'Total Product : ' . $count ?></p>
                            <p><?= 'Payment Type : ' . $order1_data->payment_type; ?></p>
                        </div>
                    </div>
                    <div class="col-lg-6 " style="width:50%">
                        <div class="summary " style="  border: 1px solid #e1e3e4;
        border-radius: 5px;

        padding: 15px 20px;
        background-color: #eeeff0;">
                            <h4 class="table" style=" color: #333366;
        font-size: 16px;
        margin-top: 9px;
        margin-bottom: 13px;">Order Summary</h4>
                            <table>
                                <tr style="width: 100%;">
                                    <td style="width: 95%;">Total Amount:</td>
                                    <td style="width: 5%;">
                                        $<?= $order1_data->total_amount ? $order1_data->total_amount : 0; ?></td>
                                </tr>
                                <tr style="width: 100%;">
                                    <td style="width: 95%;">Payment Discount:</td>
                                    <td style="width: 5%;">
                                        $<?= $order1_data->p_discount ? $order1_data->p_discount : 0; ?></td>
                                </tr>
                                <tr>
                                    <td>Shipping:</td>
                                    <td>$<?= $order1_data->shipping ? $order1_data->shipping : 0; ?></td>
                                </tr>
                                <tr>
                                    <th style="text-align: start;">Total:</th>
                                    <th><span style="color: rgb(145, 37, 37); "><?= '$' . $order1_data->final_amount; ?></span>
                                    </th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <hr>
        <section style="  margin-top: 34px;
        margin-bottom: 34px;">
            <div class="customer_section">
                <h2 style="  font-size: 33px;
        margin: 5px 0px;">Customer Info</h2>
                <div class="row" style="  display: flex;
        align-items: center;">
                    <div class="col-lg-4 width"  style="width:45%">
                        <p class="text-uppercase mt-3 ">Shipping Information</p>
                        <p style="color:#343a40;"><b>Shipping Address</b></p>
                        <div>
                            <p>Name :<?= $name ?></p>
                            <p>Address : <?= $address1 ?></p>
                            <p>Address 2 : <?= $address2 ?></p>
                            <p> City : <?= $city ?></p>
                            <p> Zipcode : <?= $zipcode ?></p>
                            <p> State : <?= $state ?></p>
                            <p> Country : <?= $country ?></p>
                        </div>
                    </div>
                    <div class="col-lg-4 width" style="width:45%">
                        <p class="text-uppercase mt-3 ">Billing Information</p>
                        <p style="color:#343a40;"><b>Billing Address</b></p>
                        <p>Name :<?= $name ?></p>
                        <p>Address : <?= $address1 ?></p>
                        <p>Address 2 : <?= $address2 ?></p>
                        <p> City : <?= $city ?></p>
                        <p> Zipcode : <?= $zipcode ?></p>
                        <p> State : <?= $state ?></p>
                        <p> Country : <?= $country ?></p>
                    </div>
                </div>
            </div>
        </section>
        <hr>
    </div>

</body>

</html>