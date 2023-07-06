<style>
  ul {
    list-style: inside;
  }
</style>
<h2 class="text-center mb-4 mt-4">Services</h2>

  <div class="container terms_h3">
  <div class="row">

  <p class="mb-4 mt-4">
  <?php

  if(!empty($services_data)){
    echo $services_data->services;
  }

  ?>
  </p>

</div>
</div>
