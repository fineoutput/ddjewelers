<!-- sub categories start-->

<section>
  <div class="container-fluid pl-5 pr-5 pt-3 pb-5">
    <div class="row">
      <div class="col-md-12 page_span">
        <p><a href="<?= base_url() ?>"><span>Home</span></a> > <a href="<?= base_url() ?>Home/sub_category/<?= $category_id; ?>"><span><?= $category_name; ?></span></a> > <span><?= $subcategory_name; ?></span>
      </div>
    </div>
    <div class="row">

      <div class="col-md-12">
        <h1 class="r-title mb-4"><?= $subcategory_name; ?></h1>
        <?
        if (!empty($description)) {
        ?>
          <h6 class="mt-3 mb-4"><i><?= $description; ?></i></h6>
        <?
        }
        ?>
        <?
        if (!empty($banner)) {
        ?>
          <img src="<?php echo base_url() . $banner ?>" alt="img">
        <?
        } ?>

        <!-- <img src="<?= base_url(); ?>assets/jewel/img/sub.jpg"> -->
        <div class="row">
          <?php $i = 1;
          foreach ($minorsub_category->result() as $data) {
            $check = $this->db->get_where('tbl_minisubcategory2', array('is_active' => 1, 'minorsubcategory' => $data->id))->row();

          ?>
            <div class="col-md-4">
              <? if ($data->id == 34 || $data->id == 37) {
                $url = base_url() . 'Home/minor_category/' . base64_encode($data->id);
              } else if (!empty($check)) {
                $url = base_url() . 'Home/minor2_sub_products/' . base64_encode($data->id);
              } else {
                $url = base_url() . 'Home/all_products/' . $data->id . '/' . base64_encode(2);
              } ?>
              <a href="<?= $url ?>">
                <div class="text-center sub_img">
                  <img src="<?= base_url(); ?><?= $data->image ?>">
                  <p><a href="<?= $url ?>"><?= $data->name ?></a></p>
                </div>
              </a>
            </div>
          <?php $i++;
          } ?>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>


<!-- sub categories end-->