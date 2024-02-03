<style>
  ul {
    list-style: inside;
  }
  #menu ul li {
    padding: 0 1rem 5px 1rem;
    cursor: pointer;
    font-size: 14px;
    text-transform: capitalize;
    border-bottom: 1px solid rgb(172, 172, 172);
    list-style: none;
}
/* @media(max-width:425px){
  image .row img {
    width: 77% !important;
    height: auto !important;
}
} */
</style>
<h1 class="text-center mb-4 mt-4 " style="font-weight:bold;"><?if(!empty($why_us_data)){echo $why_us_data->title;}?></h1>

<div class="container terms_h3 canter-image">
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
