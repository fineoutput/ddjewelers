<style>
  ul {
    list-style: inside;
  }
</style>
<h3 class="text-center mb-4 mt-4">Return Policy</h3>

  <div class="container terms_h3">
  <div class="row">

    <p class="mb-4 mt-4">
    <?php

    if(!empty($return_policy)){
      echo $return_policy->content;
    }

    ?>
    </p>

</div>
</div>
