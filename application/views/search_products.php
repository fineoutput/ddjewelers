
<!-- all products start-->
<style>
  .img-fluid {
          width: 100% !important;
        }
        .searchColumn{
          margin-bottom: 3.5rem;
        }
</style>
<section>
  <div class="container-fluid pl-5 pr-5 pt-3 pb-5">
    <div class="row">
      <div class="col-md-12 page_span">
        <p><a href="<?=base_url()?>"><span>Home</span></a> > Search Products



      </div>
    </div>
    <div class="row ">

      <div class="col-md-12">
        <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="row ">
                            <div class="col-md-12 mb-4 hrds">
                                <h1 class="r-title">
                                   Search Products - <?=$search_string;?>
                                </h1>
                            </div>
                            <!-- <div class="col-md-12">
                                <div class="pd-toggle">
                                    <div class="toggle-text">
                                        <div class="tgl-lt">
                                            <label class="switch mr-2">
                                                <input type="checkbox" checked>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                        <div class="prgrf">
                                            <p class="lettr"><b>Ready to Ship</b> - Only show products that have at
                                                least one in-stock option <span class="new-feature-badge">NEW</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="pd-toggle-2">
                                    <div class="toggle-text">
                                        <div class="tgl-lt">
                                            <label class="switch mr-2">
                                                <input type="checkbox" checked>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                        <div class="prgrf">
                                            <p class="lettr"><b>Ready to Ship</b> - Only show products that have at
                                                least one in-stock option</p> <span class="new-feature-badge">NEW</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-5 hrdx">
                                <div class="sb-text ">
                                    <div class="s-option">
                                        <label for="sort">Sort-by:</label>
                                        <select name="sort" id="sort">
                                            <option value="volvo">Default</option>
                                            <option value="saab">Newest</option>
                                            <option value="mercedes">Price:High to Low</option>
                                            <option value="mercedes">Price:Low to High</option>
                                            <option value="audi">Name</option>
                                            <option value="audi">Bestseller</option>
                                        </select>
                                    </div>
                                    <div class="opt">
                                        <p class="tgline">Showing 1 - 36 of 641 | </p>
                                        <label for="sort">Items per page:</label>
                                        <select name="sort" id="sort">
                                            <option value="volvo">36</option>
                                            <option value="saab">72</option>
                                            <option value="mercedes">144</option>
                                        </select>
                                    </div>
                                </div>
                                <hr class="dt">
                            </div>
                            <div class="col-md-12 mt-5 fltr-btn">
                                <button class="btn btn-secondary text-dark" id="fl-btn">Filter</button>
                                <div class="sbsj-text mt-3 mb-5">
                                    <div class="s-option">
                                        <label for="sort">Sort-by:</label>
                                        <select name="sort" id="sort">
                                            <option value="volvo">Default</option>
                                            <option value="saab">Newest</option>
                                            <option value="mercedes">Price:High to Low</option>
                                            <option value="mercedes">Price:Low to High</option>
                                            <option value="audi">Name</option>
                                            <option value="audi">Bestseller</option>
                                        </select>
                                    </div>
                                    <div class="opt">
                                        <label for="sort">Items:</label>
                                        <select name="sort" id="sort">
                                            <option value="volvo">36</option>
                                            <option value="saab">72</option>
                                            <option value="mercedes">144</option>
                                        </select>
                                    </div>
                                </div>

                                <hr>

                            </div> -->
                        </div>
                    </div>
                    <div class="row w-100">
                    <?php $i=1; foreach($product as $data) {
                       ?>

                        <div class="col-md-2 col-4 searchColumn">
                        <a href="<?=base_url(); ?>Home/product_detail/<?=$data['sku']?>">
                            <p class="text-center"><?=$data['sku_series']?></p>
                            <img src="<?=$data['FullySetImage1']?>?$list$" alt=""
                                class="img-fluid first_img">
                          <img src="<?=$data['FullySetImage2']?>?$list$" alt=""
                                class="img-fluid second_img">
                            <a href="#">
                                <p><?=$data['description']?></p>
                            </a>
                            <p class="price"><?=$data['price']?> <?=$data['currency']?></p>
                          </a>
                          </a>
                        </div>
                        <?php $i++; } ?>
                      </div>
                </div>
            </div>
      </div>
    </div>

  </div>
</section>

<!-- all products end-->
