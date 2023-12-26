
<div class="container terms_h3 mt-5">
  <div class="col-md-12 row">
    <?php $i = 1;
    foreach ($product as $data) {
      $images = json_decode($data->full_set_images);
    ?>
      <div class="col-md-3 text-center">
        <p><b><?= $data->series_id ?></b></p>
        <img src="<?= $images[0]->FullUrl ?>" class="img-fluid">
        <p><?= $data->short_description ?></p>
      </div>
    <? } ?>
  </div>
</div>