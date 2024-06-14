<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Affirm Processing</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
  <style>
  .loader {
  border: 16px solid #f3f3f3; /* Light grey */
  border-top: 16px solid #6fa8d1; /* Blue */
  border-radius: 50%;
  width: 100px;
  height: 100px;
  animation: spin 2s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
  </style>
  <div style="display: flex;
    justify-content: center;
  margin-top: 20%;">
<!-- <div class="loader"></div> -->
</div>
<script>
// var affirm_config = {
//   public_api_key: "9PDZ6ZT2BFOPNZXJ",  /* replace with public api key */
//   //   script:         "https://affirm.com/js/v2/affirm.js"//--- live ---
//   script:         "https://cdn1-sandbox.affirm.com/js/v2/affirm.js"//--- test ---
// };


var affirm_config = {
  public_api_key: "<?=AFFIRM_API_KEY?>",  /* replace with public api key */
  //   script:         "https://affirm.com/js/v2/affirm.js"//--- live ---
  script:         "<?=AFFIRM_BASE_URL?>"//--- test ---
};

(function(m,g,n,d,a,e,h,c){var b=m[n]||{},k=document.createElement(e),p=document.getElementsByTagName(e)[0],l=function(a,b,c){return function(){a[b]._.push([c,arguments])}};b[d]=l(b,d,"set");var f=b[d];b[a]={};b[a]._=[];f._=[];b._=[];b[a][h]=l(b,a,h);b[c]=function(){b._.push([h,arguments])};a=0;for(c="set add save post open empty reset on off trigger ready setProduct".split(" ");a<c.length;a++)f[c[a]]=l(b,d,c[a]);a=0;for(c=["get","token","url","items"];a<c.length;a++)f[c[a]]=function(){};k.async=
!0;k.src=g[e];p.parentNode.insertBefore(k,p);delete g[e];f(g);m[n]=b})
(window,affirm_config,"affirm","checkout","ui","script","ready","jsReady");
//   window.onload = (event) => {
//     affirm.checkout();
// };
<?
$amount = $this->session->flashdata('amn');
$order_id = $this->session->flashdata('order_id');
$currency_code = $this->session->flashdata('currency_code');
$address_data = $this->session->flashdata('address_data');
$user_data = $this->session->flashdata('user_data');
?>
affirm.checkout({
 
//  "merchant": {
//    "user_confirmation_url": "https://merchantsite.com/confirm",
//    "user_cancel_url": "https://merchantsite.com/cancel",
//    "user_confirmation_url_action": "POST",
//    "name": "DD Jewellers"
//  },
 "merchant": {
   "user_confirmation_url": "<?=AFFIRM_CONFIRMATION_URL?>",
   "user_cancel_url": "<?=AFFIRM_CANCEL_URL?>",
   "user_confirmation_url_action": "<?=AFFIRM_CONFIRMATION_URL_ACTION?>",
   "name": "DD Jewellers"
 },
 "shipping":{
   "name":{
     "first":"<?=$user_data[0]->name?>",
     "last":"Doe"
   },
   "address":{
     "line1":'<?=$address_data[0]->address?>',
     "line2":"",
     "city":"<?=$address_data[0]->town_city?>",
     "state":"<?=$address_data[0]->state?>",
     "zipcode":"<?=$address_data[0]->postal_code?>",
     "country":"USA"
   },
   "phone_number": "<?=$address_data[0]->customer_phone?>",
   "email": "<?=$user_data[0]->email?>"
 },
 "billing":{
   "name":{
    "first":"<?=$user_data[0]->name?>",
     "last":"Doe"
   },
   "address":{
    "line1":'<?=$address_data[0]->address?>',
     "line2":"",
     "city":"<?=$address_data[0]->town_city?>",
     "state":"<?=$address_data[0]->state?>",
     "zipcode":"<?=$address_data[0]->postal_code?>",
     "country":"USA"
   },
   "phone_number": "<?=$address_data[0]->customer_phone?>",
   "email": "<?=$user_data[0]->email?>"
 },
 "items": [
    {
   "display_name":         "Awesome Pants",
   "sku":                  "ABC-123",
   "unit_price":           1999,
   "qty":                  3,
   "item_image_url":       "http://merchantsite.com/images/awesome-pants.jpg",
   "item_url":             "http://merchantsite.com/products/awesome-pants.html",
   "categories": [
       ["Home", "Bedroom"],
       ["Home", "Furniture", "Bed"]
   ]
 }
],
 "discounts":{
//     "RETURN5":{
//        "discount_amount":'',
//        "discount_display_name":""
//    },
//    "PRESDAY10":{
//        "discount_amount":1000,
//        "discount_display_name":"President's Day 10% off"
//  }
},
"metadata":{
 "shipping_type":"UPS Ground",
 "mode":"modal"
},
"order_id":"<?=$order_id?>",
"currency":"<?=$currency_code?>",  
"financing_program":"",
"shipping_amount":0,
"tax_amount":0,
"total":"<?=round($amount)?>"
})

affirm.checkout.open({
  onFail:(error)=>{

  },
  onSuccess: (data)=>{
    console.log('response'+data);

  }
})

</script>
</body>
</html>
