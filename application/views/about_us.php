<style>
  ul {
    list-style: inside;
  }
</style>
<h3 class="text-center mb-4 mt-4">About Us</h3>


<div class="container">
<div class="row">

  <p class="mb-4 mt-4">
  <?php

  if(!empty($about_us)){
    echo $about_us->content;
  }

  ?>
  </p>

</div>
</div>
