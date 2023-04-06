<h2 class="text-center mb-4 mt-4"><?if(!empty($lifetime_upgrades_data)){
  echo $lifetime_upgrades_data->title;}?></h2>

  <div class="container">
  <div class="row">

  <p class="mb-4 mt-4">
  <?php

  if(!empty($lifetime_upgrades_data)){
    echo $lifetime_upgrades_data->lifetime_upgrades;
  }

  ?>
  </p>

</div>
</div>
