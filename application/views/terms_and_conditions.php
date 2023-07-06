<style>
  ul {
    list-style: inside;
  }
</style>
<h3 class="text-center mb-4 mt-4">Terms and Conditions</h3>

<div class="container terms_h3">
  <div class="row">

      <p class="mb-4 mt-4">
      <?php

      if(!empty($terms_and_conditions)){
        echo $terms_and_conditions->content;
      }

      ?>
      </p>

  </div>
</div>
