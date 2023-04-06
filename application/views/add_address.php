

<!-- register start -->

<section>
  <div class="container-fluid pl-5 pr-5 pt-3 pb-5">

    <div class="row">
      <div class="col-md-12">
        <h1 class="font-we">Add Address</h1>
      </div>
    </div>

    <div class="row register_row">

      <div class="col-md-6">
        <form action="<?=base_url(); ?>Order/checkout" method="post" enctype="multipart/form-data">
        <div class="row">

          <div class="col-md-12 text-center">
            <h2>Select Address</h2>
          </div>

          <div class="col-md-12">
<?php
$i=0;
if(!empty($user_addr_data)){
  foreach ($user_addr_data->result() as $address) {
    if(!empty($address->country_id)){

        $country_data1 = $this->db->get_where('tbl_country', array('id'=> $address->country_id))->result();
        $country_name=$country_data1[0]->name;
    }else{
        $country_name='';
    }

?>

            <div class=" row add_sel">
              <div class="col-2 col-md-1">
                <input type="radio" name="selected_address" value="<?=$address->id;?>" <?php if($i== 0){ echo 'checked'; } ?> required >
              </div>
              <div class="col-10 col-md-11">
              <p><b>Phone Number:</b> <a><?=$address->customer_phone;?></a></p>
              <p><b>Address:</b> <a><?=$address->address;?></a></p>
              <p><b>State:</b><a><?=$address->state;?></a></p>
          
              <p><b>Country:</b><a><?=$country_name;?></a></p>
            
              <p><b>city:</b><a><?=$address->town_city;?></a></p>
              <p><b>Zipcode:</b><a><?=$address->postal_code;?></a></p>
              </div>
            </div>

<?php $i++;} } ?>
            <div class="row bg-white">
              <div class="col-md-12">
                <!-- <button class="more_btn mb-3">More</button> -->
              </div>
            </div>
          </div>
          <div class="col-md-12  mt-3">
            <!-- <a href="<?=base_url(); ?>Home/checkout"> -->
            <button class="sub_btn" type="submit">Continue</button>
          <!-- </a> -->
          </div>
        </div>
        </form>
      </div>

      <div class="col-md-6">
        <div class="row">
          <div class="col-md-12 text-center">
            <h2>Add New Address</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <form action="<?=base_url();?>Home/add_new_address" method="post" enctype="multipart/form-data">
              <label>Phone Number: *</label>
              <input type="text" value="" maxlength="10" onkeydown="if(event.key==='.'){event.preventDefault();}"  oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');" name="customer_phone" required>
              <label>Full Address: *</label>
              <textarea type="text" name="address" required></textarea>
              <label>Country : *</label>
             <select name="country_id" class="form-control" required>
                          <option value="">-----select Country-----</option>
                          <?php $i=1; foreach ($country_data->result() as $country) { ?>
                          <option value="<?=$country->id?>"><?=$country->name?></option>
                          <?php } ?>
                        </select>
           
              <label>Select State: *</label>
              <!-- <select>
                <option>Alabama</option>
                <option>Alaska</option>
                <option>Arizona</option>
                <option>Arkansas</option>
                <option>California</option>
                <option>Colorado</option>
                <option>Connecticut</option>
                <option>Delaware</option>
                <option>Delaware</option>
              </select> -->

<input type="text" value="" name="state" required>

              <label>Select city: *</label>
              <!-- <select>
                <option>Alabama</option>
                <option>Alaska</option>
                <option>Arizona</option>
                <option>Arkansas</option>
                <option>California</option>
                <option>Colorado</option>
                <option>Connecticut</option>
                <option>Delaware</option>
                <option>Delaware</option>
              </select> -->

<input type="text" value="" name="city" required>

              <label>Zipcode: *</label>
              <input type="number" name="zipcode" required>
              <!-- <label>Landmark: *</label>
              <input type="text" name="text"> -->
              <button class="sub_btn">SUBMIT</button>
            </form>
          </div>
        </div>
      </div>



    </div>
  </div>
</section>


<!-- register end -->
