<!-- register start -->
<style>
  @media(max-width: 767px){
    .resp{
        flex-wrap: wrap !important;
    }
}
</style>
<section>
  <div class="container-fluid pl-5 pr-5 pt-3 pb-5">

    <div class="row">
      <div class="col-md-12">
        <h1 class="font-we">Add Address</h1>
      </div>
    </div>

    <div class="row register_row">

      <div class="col-md-6">
        <form action="<?= base_url(); ?>Order/checkout" method="post" enctype="multipart/form-data">
          <div class="row">

            <div class="col-md-12 text-center">
              <h2>Select Address</h2>
            </div>

            <div class="col-md-12">
              <?php
              $i = 0;
              if (!empty($user_addr_data)) {
                foreach ($user_addr_data->result() as $address) {
                  if (!empty($address->country_id)) {

                    $country_data1 = $this->db->get_where('tbl_country', array('id' => $address->country_id))->result();
                    $country_name = $country_data1[0]->name;
                  } else {
                    $country_name = '';
                  }
                  if (!empty($address->state_id)) {

                    $state_data = $this->db->get_where('tbl_state', array('id' => $address->state_id))->result();
                    if(!empty($state_data)){
                      $state_name = $state_data[0]->name;
                    }else{
                    $state_name='';
                    }
                    
                  } else {
                    $state_name = '';
                  }

              ?>

                  <div class=" row add_sel">
                    <div class="col-2 col-md-1">
                      <input type="radio" name="selected_address" value="<?= $address->id; ?>" <?php if ($i == 0) {
                                                                                                  echo 'checked';
                                                                                                } ?> required>
                    </div>
                    <div class="col-10 col-md-11">
                    
                      <p><b>Name:</b> <a><?= $address->first_name.' '.$address->last_name; ?></a></p>
                      <p><b>Address:</b> <a><?= $address->address; ?></a></p>
                    

                    

                      <p><b>city:</b><a><?= $address->city; ?></a></p>
                      <p><b>Zipcode:</b><a><?= $address->zipcode; ?></a></p>
                     
                      <p><b>State:</b><a><?= $state_name;?></a></p>
                      <p><b>Country:</b><a><?= $country_name; ?></a></p>
                    </div>
                  </div>

              <?php $i++;
                }
              } ?>
              <div class="row bg-white">
                <div class="col-md-12">
                  <!-- <button class="more_btn mb-3">More</button> -->
                </div>
              </div>
            </div>
            <div class="col-md-12  mt-3 mb-2">
              <!-- <a href="<?= base_url(); ?>Home/checkout"> -->
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
            <form action="<?= base_url(); ?>Home/add_new_address" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label>Country *</label>
                <select name="country_id" class="form-control" required>
                  <option value="">-----select Country-----</option>
                  <?php $i = 1;
                  foreach ($country_data->result() as $country) { ?>
                    <option value="<?= $country->id ?>"><?= $country->name ?></option>
                  <?php } ?>
                </select>
              </div>
              <div style="display:flex; gap:6px; " class="resp" >
                <div class="form-group col-md-6 p-0">
                  <label for="first_name">First Name *</label>
                  <input type="text" class="form-control" name="first_name" id="first_name" required>
                </div>
                <div class="form-group col-md-6 p-0">
                  <label for="last_name">Last Name *</label>
                  <input type="text" class="form-control" name="last_name" id="last_name" required>
                </div>

              </div>
              <div class="form-group">
                <label for="address">Address *</label>
                <textarea  name="address" id="address" required></textarea>
              </div>
              <div class="form-group">
                <label for="address2">Address 2</label>
                <textarea  name="address2" id="address2"></textarea>
              </div>
              <div class="form-group">
                <label for="city">City *</label>
                <input type="text" name="city" id="city" required></textarea>
              </div>
              <div style="display:flex; " class="resp">
                <div class="form-group col-md-6 p-0">
                  <label for="state">States *</label>
                <select name="state_id" class="form-control" required>
                  <option value="">----Select State---</option>
                    <?php
                    foreach($states->result() as $st){

                      $this->db->select('*');
                                  $this->db->from('tbl_state_detail');
                                  $this->db->where('country',$st->country);
                                  $dsa_id= $this->db->get()->row();
                                 
                 
                      ?>
                      <option value="<?=$dsa_id->id ?>"><?=$st->name ?></option>
                      <?php

                    }
                    ?>
                </select>
                </div>
                <div class="form-group col-md-6 p-0" >
                  <label for="zipcode">Zip/Postal Code *</label>
                  <input type="text" class="form-control" name="zipcode" id="zipcode" required>
                </div>

              </div>
              <div class="form-group col-md-6 mb-2  ">
                 
                  <input type="checkbox" class="form-check-input"  style="width:5%; height:auto;" name="is_gift" id="is_gift" value="1">
                  <span style="margin-left:8px">This Order Contains a Gift</span>
                </div>
                <div class="form-group">
                <label for="notes">Special Instruction or Notes</label>
                <textarea  name="notes" id="notes"></textarea>
              </div>


              
              <button class="sub_btn">SUBMIT</button>
            </form>
          </div>
        </div>
      </div>



    </div>
  </div>
</section>


<!-- register end -->