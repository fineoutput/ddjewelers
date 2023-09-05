<!DOCTYPE html>
<html>
<html lang="en">
<input type="hidden" value="<?php if (!empty($order1_data)) {
                                echo $order1_data->total_amount;
                            } ?>" id="tot_amnt">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <!-- Css file include -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>DD Jewelers Bill</title>
</head>

<body style="padding-top:75px;">
    <div class="container main_container">
        <div class="row">
            <div class="col-sm-6 oswal_logo">
                <img src="https://www.fineoutput.co.in/ddjewelers/assets/jewel/img/logo.png" class="img-fluid logo" style="width:20% !important">
            </div>
            <div class="col-sm-6 content_part">Tax Invoice/Bill of Supply/Cash Memo
                <p>(Original for Recipient)</p>
            </div>
        </div><br>

        <div class="container">
            <div class="row">
                <div class="col-sm-6"><span class="font-weight-bold ">Sold By</span><br>
                    <span class="seller_details">ddjewelers <br>

                        PO Box 283577<br>Dubai, UAE
                        <br><br>
                        www.ddjewelers.com<br></span>
                </div>

                <div class="col-sm-6 billing_content"><span class="font-weight-bold ">Billing Address:</span><br>
                    <!-- code here -->
                    <?php

                    $this->db->select('*');
                    $this->db->from('tbl_users');
                    $this->db->where('id', $order1_data->user_id);
                    $usr_dat = $this->db->get()->row();

                    if (!empty($usr_dat)) {
                        $user_name = $usr_dat->name;
                        $user_email = $usr_dat->email;
                        $user_contact = $usr_dat->phone;
                    } else {
                        $user_name = "";
                        $user_email = "";
                        $user_contact = "";
                    }
                    ?>


                    User: <?= $user_name; ?>
                    <br>Email: <?= $user_email; ?>
                    <br>Contact: <?= $user_contact; ?><br>


                    <?php
                    if (!empty($order1_data)) {
                        $this->db->select('*');
                        $this->db->from('tbl_user_address');
                        $this->db->where('id', $order1_data->address_id);
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
                                if(!empty($state_data)){
                
                                    $state_name = $state_data[0]->name;
                                }else{
                                    $state_name='';
                                }
                            } else {
                                $state_name = '';
                            }
                            $name = $addr_da->first_name . ' ' . $addr_da->last_name;
                            $state = $state_name;
                            $city = $addr_da->city;
                            $zip = $addr_da->zipcode;
                            $notes = $addr_da->notes;
                        } else {
                            $name = '';
                            $address = "";
                            $state = "";
                            $city = "";
                            $zip = "";
                            $country = "";
                            $notes = '';
                        }
                    }

                    // $name=$order1_data->first_name." ".$order1_data->last_name;
                    // $address=$order1_data->address;
                    // $state=$order1_data->state;
                    // $town_city=$order1_data->town_city;
                    // $postal_code=$order1_data->postal_code;


                    ?>

                </div>
            </div>

            <br>
            <div class="row">
                <div class="col-sm-6"></div>
                <div class="col-sm-6 shipping_content"><span class="font-weight-bold ">Shipping Address:</span> <br>
                    Name:
                    <?= $name; ?>
                    <br>
                    Email:
                    <?= $user_email; ?>
                    <br>
                    Phone:
                    <?= $user_contact ?>
                    <br>
                    Address: <?php
                                // if(empty($location_addres)){
                                //   echo $addres;
                                // }else{
                                //   echo $doorflat.", ".$landmark.", ".$location_addres;
                                // }

                                if (!empty($address)) {
                                    echo $address;
                                } else {
                                    echo "no address";
                                }
                                ?> <br>

                    State:
                    <?php echo $state; ?><br>
                    City :
                    <?php echo $city; ?><br>
                    Zipcode:
                    <?php echo $zip; ?><br>
                    Country:
                    <?php echo $country; ?><br>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">Order No: &nbsp; #<?php if (!empty($order1_data)) {
                                                            echo $order1_data->id;
                                                        } ?><br>
                    <p> Order Date: &nbsp;
                        <?php if (!empty($order1_data)) {
                            $source = $order1_data->date;
                            $date = new DateTime($source);
                            echo $date->format('F j, Y, g:i a');
                        } ?>
                </div><br> <br>




            </div>
        </div>





        <div class="container">

            <table class="table table-black">
                <thead class="product_table">

                    <tr>
                        <th>SNo.</th>
                        <th>Product</th>
                        <!-- <th>HSN Code</th> -->
                        <th>Type</th>
                        <!-- <th>Sample</th> -->
                        <th>Selling price</th>
                        <th>QTY</th>

                        <th>Total Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total_weight = 0;
                    $total_gst_percentt = 0;
                    $total_gst_pricee = 0;
                    if (!empty($order2_data)) {
                        $i = 1;
                        foreach ($order2_data->result() as $data) { ?>
                            <tr class="product_table2">
                                <td><?php echo $i; ?></td>
                                <td>
                                    <?php $this->db->select('*');
                                    $this->db->from('tbl_products');
                                    $this->db->where('id', $data->product_id);
                                    $pro_dsa = $this->db->get()->row();;
                                    if (!empty($pro_dsa)) { ?>

                                        <?= $pro_dsa->description ?>
                                    <?php  } else {
                                        echo "No product name";
                                    }
                                    ?></td>




                                <td>

                                    <?php if (!empty($data->desc_e_name2)) { ?>

                                        <p><?= $data->desc_e_name2; ?>: <?= $data->desc_e_value2 ?></p>


                                    <?php } else if (!empty($data->desc_e_name3)) { ?>

                                        <p><?= $data->desc_e_name3; ?>: <?= $data->desc_e_value3 ?></p>


                                    <?php } else if (!empty($data->desc_e_name4)) { ?>

                                        <p><?= $data->desc_e_name4; ?>: <?= $data->desc_e_value4 ?></p>


                                    <?php }else if (!empty($data->desc_e_name5)) { ?>

                                        <p><?= $data->desc_e_name5; ?>: <?= $data->desc_e_value5 ?></p>

                                    <?php } else{ ?>
                                        <p>NA</p>
                                        <?}?>

                                </td>
                                <td><?php echo "$" .$data->unit_price; ?></td>
                                <td><?php echo $data->quantity; ?></td>
                                <td><?php echo "$" .$data->amount ?></td>
                                <!-- <td><?php echo "$" . $data->total_amount; ?></td> -->
                            </tr>
                    <?php $i++;
                        }
                    } ?>



                    <tr>
                        <th>Total</th>

                        <th class="product_table"><?php if (!empty($order1_data)) {
                                                        echo "";
                                                    } ?></th>
                        <th class="product_table" colspan="3"><?php if (!empty($order1_data)) {
                                                                    echo "";
                                                                } ?></th>

                        <th class="product_table"><?php if (!empty($order1_data)) {
                                                        echo "$" . $order1_data->total_amount;
                                                    } ?></th>
                    </tr>
                    <tr>
                        <th>Shipping Charge:</th>

                        <th class="product_table"><?php if (!empty($order1_data)) {
                                                        echo "";
                                                    } ?></th>
                        <th class="product_table" colspan="3"><?php if (!empty($order1_data)) {
                                                                    echo "";
                                                                } ?></th>

                        <th class="product_table"><?php if (!empty($order1_data)) {
                                                        echo "+$" . $order1_data->shipping;
                                                    } ?></th>
                    </tr>
                    <tr>
                        <th>Delivery Charge:</th>

                        <th class="product_table"><?php if (!empty($order1_data)) {
                                                        echo "";
                                                    } ?></th>
                        <th class="product_table" colspan="3"><?php if (!empty($order1_data)) {
                                                                    echo "";
                                                                } ?></th>

                        <th class="product_table"><?php if (!empty($order1_data)) {
                                                        echo "+$" . $order1_data->delivery_charge;
                                                    } ?></th>
                    </tr>
                    <tr>
                        <th>Promocode Discount:</th>

                        <th class="product_table"><?php if (!empty($order1_data)) {
                                                        echo "";
                                                    } ?></th>
                        <th class="product_table" colspan="3"><?php if (!empty($order1_data)) {
                                                                    echo "";
                                                                } ?></th>

                        <th class="product_table"><?php if (!empty($order1_data->p_discount)) {
                                                            echo "-$ " . $order1_data->p_discount;
                                                        }else{
                                                            echo "-$0";
                                                        } ?></th>
                    </tr>

                    <tr>


                    </tr>

                    <tr>
                        <th colspan="5">SubTotal</th>
                        <th class="product_table">$<?php if (!empty($order1_data)) {
                                                            echo  $order1_data->final_amount;
                                                        } ?></th>

                    </tr>



                </tbody>
            </table>

            <h6 class="amount_content">Amount in Words:<br>
                <span id="checks123" style="text-transform: capitalize;font-style: revert;"></span>
            </h6><br>




            <h4 class="oswal_head"><br><br>

                Authorized Signatory </h4>

            </tr>

        </div>


        <h5 class="warning" style="margin-left: 15px;">Whether tax is payable under reverse charge-No</h5>


    </div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    //alert('Changed!')

    $('#gst_percentage').keyup(function() {
        // alert("Key up detected");

        var total_price = $("#mrp").val();
        //var gst_percentage = $("#gst_percentage").val();$(this).val
        var gst_percentage = $(this).val();
        var gst_price = (total_price * gst_percentage) / 100;
        var total_gst_price = parseInt(total_price) + parseInt(gst_price);
        //alert(total_gst_price);
        $('#gst_percentage_price').val(gst_price);
        $('#selling_price').val(total_gst_price);

    });
</script>

<script>
    window.onload = function() {

        var unit_mrp = $(".unit_mrp").text();
        var unit_qty = $(".qty").text();
        //var gst_percentage = $("#gst_percentage").val();$(this).val

        var total_unit_mrp = parseInt(unit_mrp) * parseInt(unit_qty);
        //alert(total_gst_price);
        $('.net_unit_mrp').text(total_unit_mrp);

        var total_amount = document.getElementById("tot_amnt").value;
        //alert(total_amount);
        inWords(total_amount);
        window.print();
    };



    var a = ['', 'one ', 'two ', 'three ', 'four ', 'five ', 'six ', 'seven ', 'eight ', 'nine ', 'ten ', 'eleven ', 'twelve ', 'thirteen ', 'fourteen ', 'fifteen ', 'sixteen ', 'seventeen ', 'eighteen ', 'nineteen '];
    var b = ['', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];

    function inWords(num) {
        if ((num = num.toString()).length > 9) return 'overflow';
        n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
        if (!n) return;
        var str = '';
        str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'crore ' : '';
        str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'lakh ' : '';
        str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : '';
        str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : '';
        str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + 'only ' : '';
        //return str;
        // alert(str);
        $("#checks123").text(str);

    }
</script>

</html>