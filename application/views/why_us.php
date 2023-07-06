<style>
  ul {
    list-style: inside;
  }
</style>
<h1 class="text-center mb-4 mt-4" style="font-weight:bold;"><?if(!empty($why_us_data)){echo $why_us_data->title;}?></h1>

<div class="container terms_h3">
<div class="row">

  <p class="mb-4 mt-4">
  <?php

  if(!empty($why_us_data)){
    echo $why_us_data->why_us;
  }

  ?>
  </p>

</div>
</div>
