<style>
  ul {
    list-style: inside;
  }
</style>
<h2 class="text-center mb-4 mt-4"><?if(!empty($free_shipping_data)){
    echo $free_shipping_data->title;}?></h2>

  <div class="container">
  <div class="row">

  <p class="mb-4 mt-4">
  <?php

  if(!empty($free_shipping_data)){
    echo $free_shipping_data->free_shipping;
  }

  ?>
  </p>

</div>
</div>
