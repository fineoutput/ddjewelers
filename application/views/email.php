<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<style>
    * {
        font-family: sans-serif;
    }

    .dnd {
        text-align: center;
    }

    .dnd img {
        width: 120px;
    }

    .order_section {
        text-align: center;
        margin-top: 50px;
    }

    .Italian_sec {
        margin-top: 50px;
    }

    h1,
    h2 {
        color: #333366;
    }

    p,
    td {
        color: #909292;
    }

    .order_section button {
        width: 220px;
        background-color: #e1e3e4;
        color: #909292;
        border: 0px;
        border-radius: 2px;
    }

    .summary {
        border: 1px solid #e1e3e4;
        border-radius: 5px;
        margin-top: 100px;
        padding: 15px 20px;
        background-color: #eeeff0;
    }

    section {
        margin-top: 50px;
        margin-bottom: 50px;
    }

    @media only screen and (max-width: 768px) {
        .order_section button {
            width: 162px;
        }

        section {
            margin-top: 6px;
            margin-bottom: 15px;
            padding: 3px;
        }

        .summary {
            margin-top: 30px;
            margin-bottom: 25px;
        }

        .order_section {
            margin-top: 5px;
        }

        .dnd img {
            width: 80px;
        }
    }
</style>

<body>
    <div class="container">
        <div class="dnd  text-center">
            <img src="https://dd.jewelplus.com/assets/jewel/img/dd.jewelplus.com_Website_Latest_-removebg-preview.png" alt="D&D" class="img-fluid">
            <h3 class=" text-center lobi " style="margin-block-end: 0;">D&amp;D Jewelry</h3>
            <h5 style="    margin-block-start:0;
                        margin-block-end: 0;">Since 1985</h5>
        </div>
        <hr>
        <section>
            <div class="order_section ">
                <h1><b>Order Confirmation</b></h1>
                <p>A new order was made on <a href="#" target="_blank">www.dd.jewelplus.com</a>, you can view this order in your site admin.</p>
        </section>
        <section>
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
                    <div class="row">
                        <div class="col-lg-4 ">
                            <img src="<?= $ord->img ?>" alt="D&D" class="img-fluid">
                        </div>
                        <div class="col-lg-8 Italian_sec">
                            <h3><?= $ord->description ?>
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
        <section>
            <div class="order_section2">
                <H2>Order Info</H2>
                <div class="row">
                    <div class="col-lg-6">
                        <p class="text-uppercase mt-3">Order Information</p>
                        <div>
                            <p>Name: <?= $user->name ?></p>
                            <p> Email:<a href="#" target="_blank"> <?= $user->email ?></a></p>
                            <!-- <p>phone: 419572611</p> -->
                        </div>
                        <div class="mt-5">
                            <p><?= 'Order Id : #' . $order1_id ?></p>
                            <p> <?= 'Txn Id :' . $order1_data->txnid ?></p>
                            <p> <?= 'Total Product : ' . $count ?></p>
                            <p><?= 'Payment Type : ' . $order1_data->payment_type; ?></p>
                            <!-- <p> Payment: Paypal</p> -->
                        </div>
                    </div>
                    <div class="col-lg-6 ">
                        <div class="summary ">
                            <h4 class="table ">Order Summary</h4>
                            <table>
                                <tr style="width: 100%;">
                                    <td style="width: 95%;">Total Amount:</td>
                                    <td style="width: 5%;">$<?= $order1_data->total_amount ? $order1_data->total_amount : 0; ?></td>
                                </tr>
                                <tr style="width: 100%;">
                                    <td style="width: 95%;">Payment Discount:</td>
                                    <td style="width: 5%;">$<?= $order1_data->p_discount ? $order1_data->p_discount : 0; ?></td>
                                </tr>
                                <tr>
                                    <td>Shipping:</td>
                                    <td>$<?= $order1_data->shipping ? $order1_data->shipping : 0; ?></td>
                                </tr>
                                <tr>
                                    <th>Total:</th>
                                    <th><span style="color: rgb(145, 37, 37); "><?= '$' . $order1_data->final_amount; ?></span></th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <hr>
        <section>
            <div class="customer_section">
                <h2>Customer Info</h2>
                <div class="row">
                    <div class="col-lg-4">
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
                    <div class="col-lg-4">
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
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>