<style>
  ul {
    list-style: inside;
  }
</style>
<h2 class="text-center mb-4 mt-4"><?  if(!empty($lifetime_warranty_data)){
    echo $lifetime_warranty_data->title;}?></h2>

  <div class="container">
  <div class="row">

  <p class="mb-4 mt-4">
  <?php

  if(!empty($lifetime_warranty_data)){
    echo $lifetime_warranty_data->lifetime_warranty;
  }

  ?>
  </p>

</div>
</div>
