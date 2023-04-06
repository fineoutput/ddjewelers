

<!-- cart start -->

<section>
  <div class="container-fluid pl-5 pr-5 pt-3 pb-5">
    <div class="row">
      <div class="col-md-12">
        <h1 class="r-title">Your Cart</h1>
<!-- 
        <?php if (!empty($this->session->flashdata('smessage'))) { ?>
              <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-check"></i> Alert!</h4>
        <?php echo $this->session->flashdata('smessage'); ?>
        </div>
          <?php }
           if (!empty($this->session->flashdata('emessage'))) { ?>
           <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
       <?php echo $this->session->flashdata('emessage'); ?>
       </div>
        <?php } ?> -->

      </div>


    </div>



  </div>

</section>


<section id="cart_items_tbody">




</section>






<section class="font-16">
  <div class="container-fluid pl-5 pr-5 pt-0 pb-5">

    <div class="row">
      <div class="col-md-3">
        <button class="red_btn"><a onclick="removeAllFromCart();">Remove All from My Cart</a></button>
      </div>

      <div class="col-3 ml-auto text-right">
        <p>Subtotal:</p>
        <p>Estimated Sales Tax:</p>
      </div>


      <div class="col-2 text-right">
        <p>$<span id="subtotal_cart_amount">0.00</span></p>
        <p>$0</p>
      </div>

    </div>
    <div class="col-md-6 ml-auto p-0">
      <hr class="mt-0 mb-0">
    </div>
    <div class="row">


      <div class="col-3 ml-auto text-right">
       <p><b>Estimated Total:</b></p>
      </div>
      <div class="col-2 text-right">
       <p><b>$<span id="total_cart_amount">0.00</span></b></p>
      </div>



    </div>
    <div class="row mt-3">
       <div class="col-4 ml-auto">
      <a href="<?=base_url(); ?>Home/register">
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




<!-- cart end -->






<!-- latest jquery-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>



loadCartItemsInView();

function loadCartItemsInView(){
  var cartItems = [];
     $("#cart_items_tbody").html('');
  if(localStorage.getItem("cartItems") !== null){
    cartItems = JSON.parse(localStorage.getItem("cartItems"));
    if(cartItems.length != 0){
    var base_url = '<?=base_url();?>';
		// alert(base_url);
    var cart_subtotal = 0;
     var totalamount= 0;
     $("#totalCartItems").text('');
     $("#totalCartItems").text(cartItems.length);
    //$("#offline_cart_loader").show();
   for(c=0;c<cartItems.length;c++){

 // var quantity= '';
     var pro_id = cartItems[c].product_id;
     var stuller_pro_id = cartItems[c].stuller_pro_id;

     var desc_e_name2 = cartItems[c].desc_e_name2;
     var desc_e_value2 = cartItems[c].desc_e_value2;

     var desc_e_name3 = cartItems[c].desc_e_name3;
     var desc_e_value3 = cartItems[c].desc_e_value3;

     var desc_e_name4 = cartItems[c].desc_e_name4;
     var desc_e_value4 = cartItems[c].desc_e_value4;

     var desc_e_name5 = cartItems[c].desc_e_name5;
     var desc_e_value5 = cartItems[c].desc_e_value5;

     var quantity = cartItems[c].quantity;

// alert(quantity);
// var cart_data;

// alert('syxqty');
// alert(quantity);
		 $.ajax({
	   url:base_url+'Cart/get_cart_pro_full_data',
	   method: 'post',
	   data: {product_id: pro_id, stuller_pro_id: stuller_pro_id, quantity: quantity, d1:desc_e_name2, d2:desc_e_name3, d3:desc_e_name4, d4:desc_e_name5, t1:desc_e_value2, t2:desc_e_value3, t3:desc_e_value4, t4:desc_e_value5 },
	   dataType: 'json',

     beforeSend: function(){
          $("#wait").show();
        },
        complete: function(){
          $("#wait").hide();
        },


	   success: function(response){
	 // alert(response);
	 // console.log(response);
	 // console.log("response");
	 // console.log(response.productcolorsizeprice);
   // alert(response.productcolorsizeprice);

	   if(response.data == true){



if(response.product_img1 != "" && response.product_img1 != null){
var img= response.product_img1;
}else{
  var img= "";
}

// var qttys= cartItems[c].quantity;
var qttys= response.qnty;
// alert(qttys);
var cart_data= '<div class="container-fluid pl-5 pr-5 pt-3 pb-5">'
                +'<div class="row">'
                +'<div class="col-md-7 pl-0 pr-0">'
                      +'<strong>ITEM DESCRIPTION</strong>'
                      +'</div>'
                    +'<div class="col-md-2 text-right pl-0">'
                      +  '<strong>QUANTITY</strong>'
                    +'</div>'
                      +'<div class="col-md-3 text-right pr-0">'
                        +'<strong>EST. PRICE</strong>'
                      +'</div>'
                    +'</div>'
                    +'<div class="row border_cart">'
                      +'<div class="col-md-2 p-0">'
                        +'<div>'
                        +'  <img src="'+response.product_img1+'">'
                        +'</div>'
                      +'</div>'
                      +'<div class="col-md-5">'
                        +'<p><a href=""><b>'+response.product_name+'</b></a></p>'
                        +'<div class="row">'
                          +'<div class="col-md-4">'
                            +'<p><strong>Item #: SLR-'+response.sku+'</strong></p>'
                            +'<!-- <p><strong>Added on:</strong></p> -->'
                          +'</div>'
                          // +'<div class="col-md-8">'
                          //   +'<p>'+response.product_name+'</p>'
                          //   +'<!-- <p>2/15/2021</p> -->'
                          // +'</div>'
                        +'</div>';

            if(response.d1 != "" && response.d1 != null){

        cart_data=    cart_data+  '<div class="row">'
                +'<div class="col-md-4">'
                  +'<p><strong>'+response.d1+':</strong></p>'
                  +'<!-- <p><strong>Added on:</strong></p> -->'
                +'</div>'
                +'<div class="col-md-8">'
                  +'<p>'+response.t1+'</p>'
                  +'<!-- <p>2/15/2021</p> -->'
                +'</div>'
              +'</div>';
            }

            if(response.d2 != "" && response.d2 != null){

        cart_data=    cart_data+  '<div class="row">'
                +'<div class="col-md-4">'
                  +'<p><strong>'+response.d2+':</strong></p>'
                  +'<!-- <p><strong>Added on:</strong></p> -->'
                +'</div>'
                +'<div class="col-md-8">'
                  +'<p>'+response.t2+'</p>'
                  +'<!-- <p>2/15/2021</p> -->'
                +'</div>'
              +'</div>';
            }

            if(response.d3 != "" && response.d3 != null){

        cart_data=    cart_data+  '<div class="row">'
                +'<div class="col-md-4">'
                  +'<p><strong>'+response.d3+':</strong></p>'
                  +'<!-- <p><strong>Added on:</strong></p> -->'
                +'</div>'
                +'<div class="col-md-8">'
                  +'<p>'+response.t3+'</p>'
                  +'<!-- <p>2/15/2021</p> -->'
                +'</div>'
              +'</div>';
            }

            if(response.d4 != "" && response.d4 != null){

        cart_data=    cart_data+  '<div class="row">'
                +'<div class="col-md-4">'
                  +'<p><strong>'+response.d4+':</strong></p>'
                  +'<!-- <p><strong>Added on:</strong></p> -->'
                +'</div>'
                +'<div class="col-md-8">'
                  +'<p>'+response.t4+'</p>'
                  +'<!-- <p>2/15/2021</p> -->'
                +'</div>'
              +'</div>';
            }

var price= response.product_price;
// alert(response.stuller_product_id)
cart_data=    cart_data+'</div>'
                        +'<div class="col-md-2">'

                        +'<div class="d-flex">';

if(response.stuller_product_id != "" && response.stuller_product_id != null){
cart_data=    cart_data  +'<input type="number" name="quantity" class="w-73" value="'+qttys+'" min="1" id="qntty_'+response.stuller_product_id+'"> ';
}else{
cart_data=    cart_data +'<input type="number" name="quantity" class="w-73" value="'+qttys+'" min="1" id="qntty_'+response.product_id+'"> ';
}


cart_data=    cart_data  +'<button class="each_btn" onclick="updateQuantityCartOffline('+response.product_id+','+response.stuller_product_id+')">Update</button>'
                        +'</div>'
                      +'</div>'
                      +'<div class="col-md-3 text-right">'
                        +'<p class="green_text"><a>$'+response.product_price+'</a></p>'
                    +  '</div>'
                    +'</div>'
                    +'<div class="row back_col">'
                      +'<div class="col-md-12 text-right">'
                      + '<p class="mt-2 mb-2 red_text"><i class="fa fa-trash"></i><a onclick="removeFromCart('+response.product_id+','+response.stuller_product_id+')">remove item</a></p>'
                      +'</div>'
                    +'</div>'

                    +'</div>';













$("#cart_items_tbody").append(cart_data);

var pro_price= response.product_price;
var pro_qty_price= pro_price * qttys;
// alert(pro_price);
// alert(quantity);
// alert(pro_qty_price);
totalamount= totalamount + pro_qty_price;
// alert(totalamount);


$("#total_cart_amount").text('');
$("#subtotal_cart_amount").text('');
// $("#total_cost").text('');
// $("#total_cost_mbl").text('');
// $("#total_cost_web").text('');

$("#total_cart_amount").text(totalamount.toFixed(2));
$("#subtotal_cart_amount").text(totalamount.toFixed(2));
// $("#total_cost").text(totalamount);
// $("#total_cost_mbl").text(totalamount);
// $("#total_cost_web").text(totalamount);

	   // var options;
	   // $.each(pro_color_d, function(i, item) {
		 //
	   //   if(i == 0){
	   //   options= '<option value="" selected>---select color---</option>';
	   //   }else{
	   //     options='';
	   //   }
		 //
	   //  options= options+'<option value="'+item.id+'">'+item.name+'</option>';
		 //
	   //  $(".color_selct").append(options);
	   // });

	   }
	   else{
	   // alert('hiii');
	   }
	   }
	   });


// alert(totalamount);



   }



}else{
  var noItem ='<p style="text-align:center" ><span colspan="7" class="no_item" style="display:table-cell;">No Items in Cart.</span></p>';
   $("#cart_items_tbody").prepend(noItem);

}
}else{
  var noItem ='<p style="text-align:center" ><span colspan="7" class="no_item" style="display:table-cell;">No Items in Cart.</span></p>';
   $("#cart_items_tbody").prepend(noItem);

}
}





</script>

<script>
//remove all item from cart onClick
function removeAllFromCart(){
  var cartItems = [];
  if(localStorage.getItem("cartItems") !== null){


       localStorage.removeItem("cartItems");
       $("#total_cart_amount").text('0.00');
       $("#subtotal_cart_amount").text('0.00');
       loadCartItemsInView();

  }
}

</script>
<script>
//remove item from cart onClick
function removeFromCart(prod_id, stuller_pro_id=""){
  // alert()
  var cartItems = [];
  if(localStorage.getItem("cartItems") !== null){
    cartItems = JSON.parse(localStorage.getItem("cartItems"));
    // console.log(cartItems)

if(stuller_pro_id == "" || stuller_pro_id == null){

    var index = cartItems.findIndex(x => x.product_id == prod_id);
    if(index !== -1){
       cartItems.splice(index, 1);
       var cart_array = [...cartItems];
       localStorage.setItem("cartItems" , JSON.stringify(cart_array));
       loadCartItemsInView();
    }

}else{

  var index = cartItems.findIndex(x => x.stuller_pro_id == stuller_pro_id);
  if(index !== -1){
     cartItems.splice(index, 1);
     var cart_array = [...cartItems];
     localStorage.setItem("cartItems" , JSON.stringify(cart_array));
     loadCartItemsInView();
  }

}

  }
}

</script>
<script>
//Update quantity in localstorage onClick
function updateQuantityCartOffline(product_id, stuller_pro_id=""){
    var cartItems = [];

    // alert(event.target.value);
    // var quantity = $('#qntty_'+product_id).val();
//
if(stuller_pro_id != "" && stuller_pro_id != null){
  var quantity = $('#qntty_'+stuller_pro_id).val();
}else{
  var quantity = $('#qntty_'+product_id).val();
}
  // alert(quantity);


    if(quantity < 1){
      alert('Less than 1 quantity is not allowed.')
      quantity = 1;
    }

    if(localStorage.getItem("cartItems") !== null){
      cartItems = JSON.parse(localStorage.getItem("cartItems"));

if(stuller_pro_id == "" || stuller_pro_id == null){

      var index = cartItems.findIndex(x => x.product_id == product_id);
      if(index !== -1){
         cartItems[index].quantity = quantity;
         var quantity = quantity;
         // var pro_mrp = cartItems[index].pro_mrp;
         // var total_pro_mrp = parseInt(quantity)  * parseInt(pro_mrp);
         // cartItems[index].total_pro_mrp = total_pro_mrp;
         var cart_array = [...cartItems];
         localStorage.setItem("cartItems" , JSON.stringify(cart_array));
         loadCartItemsInView();
      }

}else{

  var index = cartItems.findIndex(x => x.stuller_pro_id == stuller_pro_id);
  if(index !== -1){
     cartItems[index].quantity = quantity;
     var quantity = quantity;
     // var pro_mrp = cartItems[index].pro_mrp;
     // var total_pro_mrp = parseInt(quantity)  * parseInt(pro_mrp);
     // cartItems[index].total_pro_mrp = total_pro_mrp;
     var cart_array = [...cartItems];
     localStorage.setItem("cartItems" , JSON.stringify(cart_array));
     loadCartItemsInView();
  }

}

    }
}


</script>
