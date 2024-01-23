
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<style>

@media (min-width: 992px) {
  .modal-lg, .modal-xl{
max-width: 680px;
}
}
/* arorow position */
.slider_thumb, .slider_thumb{
  top: auto;
  margin-top: -8rem !important;
}

@media (max-width:1750px){
  .slider_thumb, .slider_thumb{
    margin-top: -6rem !important;
  }
}
@media (max-width:1450px){
  .slider_thumb, .slider_thumb{
    margin-top: -5rem !important;
  }
}
@media (max-width:1250px){
  .slider_thumb, .slider_thumb{
    margin-top: -4rem !important;
  }
}
@media (max-width:1000px){
  .slider_thumb, .slider_thumb{
    margin-top: -3.7rem !important;
  }
}

@media (max-width:850px){
  .slider_thumb, .slider_thumb{
    margin-top: -3.4rem !important;
  }
}

@media (max-width:768px){
  .slider_thumb, .slider_thumb{
    margin-top: -8rem !important;
  }
}

@media (max-width:670px){
  .slider_thumb, .slider_thumb{
    margin-top: -6.5rem !important;
  }
}
@media (max-width:500px){
  .slider_thumb, .slider_thumb{
    margin-top: -5.4rem !important;
  }
}
@media (max-width:400px){
  .slider_thumb, .slider_thumb{
    margin-top: -4rem !important;
  }
}
@media (max-width:340px){
  .slider_thumb, .slider_thumb{
    margin-top: -3.2rem !important;
  }
}

/* these styles are for the demo, but are not required for the plugin */
.v_style{
  width:300px;
  height:375px;
}
  .zoom {
    display:inline-block;
    position: relative;
  }
.img-responsive{
  width:100%;
  height:auto !important;
}
  /* magnifying glass icon */
  .zoom:after {
    content:'';
    display:block;
    width:33px;
    height:33px;
    position:absolute;
    top:0;
    right:0;
    background:url(icon.png);
  }

  .zoom img {
    display: block;
  }


  .zoomImg {
    width: 600px !important;
    height: 600px !important;
}

  .zoom img::selection { background-color: transparent; }
.productdetailmodal img{
  width: 33rem;
  /* height: 45rem; */
  }
  .w-100{
    font-size: 14px;
  }
  input {
    /* text-align:center; */
    /* margin-top:1rem; */
    /* width:auto;
    font-size:0.9rem;
    border: solid grey 1px; */
}
  .qtyminus {
    text-align:center;
    width:auto;
    margin-top:1rem;
    font-size: 0.9rem;
    /* border: solid grey 1px; */
    /* margin-right: 0.3rem; */
    background: #547f9e;
    border: 0px;
    color: white;
	}
  .qtyplus {
    text-align:center;
    width:auto;
    margin-top:1rem;
    font-size:0.9rem;
    /* border: solid grey 1px; */
    /* margin-left: 0.3rem; */
    background: #547f9e;
    border: 0px;
    color: white;
	}

  .vodiapicker{
  display: none;
}

#a{
  padding-left: 0px;
}

#a img, .btn-select img{
  width: 20px;

}

#a li{
  list-style: none;
  padding-top: 0px;
  padding-bottom: 0px;
  font-size: 14px;
}

#a li:hover{
 background-color: #F4F3F3;
}

#a li img{
  margin: 5px;
}

#a li span, .btn-select li span{
  margin-left: 7px;
}

/* item list */

.b{
  display: none;
  width: 100%;
  max-width: 350px;
  box-shadow: 0 6px 12px rgba(0,0,0,.175);
  border: 1px solid rgba(0,0,0,.15);
  border-radius: 5px;

}

.open{
  display: show !important;
}

.btn-select{
  margin-top: 10px;
  width: 100%;
  max-width: 350px;
  height: 34px;
  background-color: #fff;
  border: 1px solid #ccc;

}
.btn-select li{
  list-style: none;
  float: left;
  padding-bottom: 0px;
}

.btn-select:hover li{
  margin-left: 0px;
}

.btn-select:hover{
  background-color: #F4F3F3;
  border: 1px solid transparent;
}

.btn-select:focus{
   outline:none;
}

.lang-select{
  margin-left: 50px;
}


.imagebacked {
padding-left: 26px; /* image-width */
background-repeat: no-repeat;
}


/*=================loader======================*/
/* The Modal (background) */
@media (max-width: 991px)
{
  .modal
  {
    /* left: 1% !important; */
       overflow-y:auto;
  }
   .modal-content
   {
     width: 97% !important;
   }
}
   .modal {
     display: none; /* Hidden by default */
     overflow-y:auto;
     z-index: 99999; /* Sit on top */
     left: 0;
     top: 0;
     width:100%; /* Full width */
     height: 90%; /* Full height */
     /* top: 10%; */


   }
   .modal::-webkit-scrollbar {
       display: none;
   }

   /* Modal Content */
   .modal-content {
     background-color: #fefefe;
     margin: auto;
     padding: 20px;
     width: 70%;
     box-shadow: 5px 10px 18px #888888;
   }

   /* The Close Button */
   .closeclose {
     color: #aaaaaa;
     position: absolute;
     right: 5%;
     font-size: 28px;
     font-weight: bold;
   }

   .closeclose:hover,
   .closeclose:focus {
     color: #000;
     text-decoration: none;
     cursor: pointer;
   }
</style>


  <!-- Modal -->
<div class="modal fade productdetailmodal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="width: auto; max-width: 682px;">
    <div class="modal-content">
      <div class="modal-header" style="border: none;">
        <!-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding: 0rem 0.5rem;
    margin: -1rem -1rem -1rem auto;">
          <span aria-hidden="true" style="font-size: 1.1rem;">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner" style="width: 80%;margin: auto;">
    <div class="carousel-item text-center active">
      <img class="d-block" src="<?=$products->image1?>?$xlarge$" alt="First slide">
    </div>
    <div class="carousel-item text-center">
      <img class="d-block" src="<?=$products->image2?>?$xlarge$" alt="Second slide">
    </div>
    <div class="carousel-item text-center">
      <img class="d-block" src="<?=$products->image3?>?$xlarge$" alt="Third slide">
    </div>
    <div class="carousel-item text-center">
      <img class="d-block" src="<?=$products->image4?>?$xlarge$" alt="Fourth slide">
    </div>
    <div class="carousel-item text-center">
      <img class="d-block" src="<?=$products->image5?>?$xlarge$" alt="Fifth slide">
    </div>
    <?if(!empty($products->image6)){?>}
    <div class="carousel-item text-center">
      <img class="d-block" src="<?=$products->image6?>?$xlarge$" alt="Sixth slide">
    </div>
    <?}?>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" style=" background: transparent; color: black; font-size: 60px; font-weight: 800;" aria-hidden="true"><i class="fa fa-angle-left"></i></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" style="background: transparent; color: black; font-size: 60px; font-weight: 800;" aria-hidden="true"><i class="fa fa-angle-right"></i></span>
    <span class="sr-only">Next</span>
  </a>
</div>
      </div>

      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>
  <div class="container-fluid pl-5 pr-5 pt-3 pb-5">
    <div class="row">
      <div class="col-md-12 page_span">

        <p><a href="<?=base_url()?>"><span>Home</span></a> > <a href="<?=base_url()?>Home/sub_category/<?=$cat_id?>"><span><?=$cat_name?></span></a> > <a href="<?=base_url()?>Home/all_products/<?=$subcat_id?>/<?=base64_encode(0);?>"><span><?=$subcat_name?></span></a> > <span id="s_title">
          <?=$products->description?></span></p>
      </div>
      <div class="col-md-12">
        <h1 id="p_title" class="r-title" style="font-weight:600;"><?=$products->description?></h1>
      </div>
    </div>
    <div class="row mt-1" style="padding-left: 12px;">
       <!-- <div class="col-2 col-md-3"> -->
       <span style="font-size:1.2rem;margin-top:0px">Item # &nbsp</span>
      <span style="font-size:1.2rem;margin-top:0px" id="p_sku"> <?="SLR-".$products->sku?></span>
    <!-- </div> -->
      <div class="col-md-9 justify-content-around">
        <?$currentURL = current_url();?>
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?=$currentURL?>" target="blank">
          <i style="color: #3b5998;font-size: 1.2rem;" class="fab fa-facebook-square"></i>
        </a>&nbsp
        <a href="http://twitter.com/share?text=ddjewelers&url=<?=$currentURL?>">
          <i style="    color: #3b5998;font-size: 1.2rem;" class="fab fa-twitter"></i>
        </a>&nbsp
        <a href="http://pinterest.com/pin/create/button/?url=<?=$currentURL?>" target="blank">
          <i style="    color: #cb2027;font-size: 1.2rem;" class="fab fa-pinterest"></i>
        </a>&nbsp
        <a href="mailto:?subject=ddjewelers&body=ddjewelers<?=$currentURL?>" target="blank">
          <i style="    color: #547F9E;font-size: 1.2rem;" class="fa fa-envelope"></i>
        </a>
        <a href="javascript:void(0);" style="margin-left:7px;"  data-bs-target="#myModal" data-bs-toggle="modal" data-bs-dismiss="modal" id="myBtn">
          <i style="color: #547F9E;font-size: 1.2rem;" class="fa fa-paper-plane"></i>
        </a>
  </div>
          <!-- The Modal -->

          <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
              <span class="closeclose">&times;</span>
             <h2>Send</h2>
             <h4>Share this page with your friends or loved ones.</h4>
            <form style="width: 100%;" action="<?=base_url()?>Home/share_with" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="link" value="<?=$currentURL?>" >
              <input type="hidden" name="shared_product" value="<?=$products->id?>" >
          <label style="font-weight: 600;">Your Name *</label><br>
          <input type="text" name="name" required style="width: 100%;padding:10px 0px;margin-top:10px;"><br><br>
          <label style="font-weight: 600;">Your Email *</label><br>
          <input type="email" name="from_email" required style="width: 100%;padding:10px 0px;margin-top:10px;"><br><br>
          <label style="font-weight: 600;">To Email *</label><br>
          <input type="email" name="to_email" required style="width: 100%;padding:10px 0px;margin-top:10px;"><br><br>
          <label>Message</label><br>
          <textarea name="message" rows="6" style="width: 100%;"></textarea><br><br>
          <input type="submit" value="Send" required style="background: #799c48; border: none;padding: 10px 20px;border-radius: 5px;">
      </form>
            </div>
          </div>
    </div>
   <div class="row">
      <div class="col-md-4">

        <!-- Swiper -->
        <!-- data-toggle="modal" data-target="#exampleModal" -->
        <div type="button" class="position-absolute" style="z-index: ; height:400px; width:100%;" >
      </div>
  <div class="swiper-container gallery-top mt-5">
    <div class="swiper-wrapper">

<!-- IMAGES -->
<?//=$products->video;die();?>
<?php if(!empty($products->video) && strpos($products->video, '.mp4') !== false){ ?>
<div class="swiper-slide active" id="vid_div" onclick = c_show(0)>
  <a href="javascript:void(0)" role="btn" data-toggle="modal" data-target="#exampleModalCenter" >
    <video width="300" height="375"  loop autoplay muted>
      <source id="vid-1" src="<?=$products->video?>"  type="video/mp4">
    </video></a>
  </div>

  <!-- </div> -->
<?php }else{?>
  <div id="vid_div2" style="display: none" onclick = c_show(16)>
      <a href="javascript:void(0)" role="btn" data-toggle="modal" data-target="#exampleModalCenter" >
  <video width="300" height="375"  loop autoplay muted>
    <source id="vid-2" src="<?=$products->video?>"  type="video/mp4">
  </video></a>
  </div>
<?} ?>

<?php if(!empty($products->image1)){ ?>
  <div class="swiper-slide active"  onclick = c_show(1)>
    <a href="javascript:void(0)" role="btn" data-toggle="modal" data-target="#exampleModalCenter" >
    <img class="img-responsive" id="img-1" src="<?=$products->image1?>?$xlarge$" >
    </a>
  </div>
<?php } ?>
<?php if(!empty($products->image2)){ ?>
  <div class="swiper-slide active"  onclick = c_show(2)>
    <a href="javascript:void(0)" role="btn" data-toggle="modal" data-target="#exampleModalCenter">
    <img class="img-responsive" id="img-2" src="<?=$products->image2?>?$xlarge$" >
  </a>
  </div>
<?php } ?>

<?php if(!empty($products->image3)){ ?>
  <div class="swiper-slide active"  onclick = c_show(3)>
    <a href="javascript:void(0)" role="btn" data-toggle="modal" data-target="#exampleModalCenter">
    <img  class="img-responsive" id="img-3" src="<?=$products->image3?>?$xlarge$" >
  </a>
  </div>
<?php } ?>

<?php if(!empty($products->image4)){ ?>
  <div class="swiper-slide active" onclick = c_show(4)>
    <a href="javascript:void(0)" role="btn" data-toggle="modal" data-target="#exampleModalCenter">
    <img  class="img-responsive" id="img-4" src="<?=$products->image4?>?$xlarge$" >
    </a>
  </div>
<?php } ?>

<?php if(!empty($products->image5)){ ?>
  <div class="swiper-slide active" onclick = c_show(5)>
    <a href="javascript:void(0)" role="btn" data-toggle="modal" data-target="#exampleModalCenter">
      <img class="img-responsive" id="img-5" src="<?=$products->image5?>?$xlarge$" >
    </a>
  </div>
<?php } ?>

<?php if(!empty($products->image6)){ ?>
  <div class="swiper-slide active" onclick = c_show(6)>
    <a href="javascript:void(0)" role="btn" data-toggle="modal" data-target="#exampleModalCenter">
    <img  class="img-responsive" id="img-6" src="<?=$products->image6?>?$xlarge$" >
  </a>
  </div>
<?php } ?>

<!-- GROUP IMAGES -->
<?php if(!empty($products->gimage1)){ ?>
  <div class="swiper-slide" onclick = c_show(7)>
    <a href="javascript:void(0)" role="btn" data-toggle="modal" data-target="#exampleModalCenter">
<img  class="img-responsive" id="img-7" src="<?=$products->gimage1?>?$xlarge$" >  </a>

  </div>
<?php } ?>

<?php if(!empty($products->gimage2)){ ?>
  <div class="swiper-slide" onclick = c_show(8)>
    <a href="javascript:void(0)" role="btn" data-toggle="modal" data-target="#exampleModalCenter">
<img  class="img-responsive" id="img-8" src="<?=$products->gimage2?>?$xlarge$" >  </a>

  </div>
<?php } ?>

<?php if(!empty($products->gimage3)){ ?>
  <div class="swiper-slide" onclick = c_show(9)>
    <a href="javascript:void(0)" role="btn" data-toggle="modal" data-target="#exampleModalCenter">
<img  class="img-responsive" id="img-9" src="<?=$products->gimage3?>?$xlarge$" >  </a>

  </div>
<?php } ?>


<!-- FullySetImages IMAGES -->

<?php if(!empty($products->FullySetImage1)){ ?>
  <div class="swiper-slide" onclick = c_show(10)>
    <a href="javascript:void(0)" role="btn" data-toggle="modal" data-target="#exampleModalCenter">
<img  class="img-responsive" id="img-10" src="<?=$products->FullySetImage1?>?$xlarge$" >  </a>

  </div>
<?php } ?>

<?php if(!empty($products->FullySetImage2)){ ?>
  <div class="swiper-slide" onclick = c_show(11)>
    <a href="javascript:void(0)" role="btn" data-toggle="modal" data-target="#exampleModalCenter">
<img  class="img-responsive" id="img-11" src="<?=$products->FullySetImage2?>?$xlarge$" >  </a>

  </div>
<?php } ?>

<?php if(!empty($products->FullySetImage3)){ ?>
  <div class="swiper-slide" onclick = c_show(12)>
    <a href="javascript:void(0)" role="btn" data-toggle="modal" data-target="#exampleModalCenter">
<img  class="img-responsive" id="img-12" src="<?=$products->FullySetImage3?>?$xlarge$" >  </a>

  </div>
<?php } ?>

<?php if(!empty($products->FullySetImage4)){ ?>
  <div class="swiper-slide" onclick = c_show(13)>
    <a href="javascript:void(0)" role="btn" data-toggle="modal" data-target="#exampleModalCenter">
<img  class="img-responsive" id="img-13" src="<?=$products->FullySetImage4?>?$xlarge$" >  </a>

  </div>
<?php } ?>

<?php if(!empty($products->FullySetImage5)){ ?>
  <div class="swiper-slide" onclick = c_show(14)>
    <a href="javascript:void(0)" role="btn" data-toggle="modal" data-target="#exampleModalCenter">
  <img  class="img-responsive" id="img-14" src="<?=$products->FullySetImage5?>?$xlarge$" >  </a>

  </div>
<?php } ?>

<?php if(!empty($products->FullySetImage6)){ ?>
  <div class="swiper-slide" onclick = c_show(15)>
    <a href="javascript:void(0)" role="btn" data-toggle="modal" data-target="#exampleModalCenter">
<img  class="img-responsive" id="img-15" src="<?=$products->FullySetImage6?>?$xlarge$" >  </a>

  </div>
<?php } ?>




    </div>

  </div>

  <div class="swiper-container gallery-thumbs">
    <div class="swiper-wrapper">

<!-- IMAGES -->
  <?php if(!empty($products->video) && strpos($products->video, '.mp4') !== false){ ?>
    <div class="swiper-slide" id="t_vid_div" style="display: block">
        <!-- <div class="swiper-slide"> -->
          <video width="133" height="133"  loop paused muted>
          <source id="t_vid-1" src="<?=$products->video?>" type="video/mp4" >
          </video>
        <!-- </div> -->
        </div>
      <?php }else{ ?>
        <div id="t_vid_div2" style="display: none">
        <video width="133" height="133"  loop paused muted>
          <source id="t_vid-2" src="javascript:void(0)"  type="video/mp4">
        </video>
        </div>
        <?}?>
      <?php if(!empty($products->image1)){ ?>
        <div class="swiper-slide">
          <img  class="img-responsive" id="t_img-1" src="<?=$products->image1?>?$xlarge$" >
        </div>
      <?php } ?>

      <?php if(!empty($products->image2)){ ?>
        <div class="swiper-slide" >
          <img  class="img-responsive" id="t_img-2" src="<?=$products->image2?>?$xlarge$" >
        </div>
      <?php } ?>

      <?php if(!empty($products->image3)){ ?>
        <div class="swiper-slide" >
          <img  class="img-responsive" id="t_img-3" src="<?=$products->image3?>?$xlarge$" >
        </div>
      <?php } ?>

      <?php if(!empty($products->image4)){ ?>
        <div class="swiper-slide" >
          <img  class="img-responsive" id="t_img-4" src="<?=$products->image4?>?$xlarge$" >
        </div>
      <?php } ?>

      <?php if(!empty($products->image5)){ ?>
        <div class="swiper-slide" >
          <img  class="img-responsive" id="t_img-5" src="<?=$products->image5?>?$xlarge$" >
        </div>
      <?php } ?>

      <?php if(!empty($products->image6)){ ?>
        <div class="swiper-slide" >
          <img  class="img-responsive" id="t_img-6" src="<?=$products->image6?>?$xlarge$" >
        </div>
      <?php } ?>


<!-- GROUP IMAGES -->
      <?php if(!empty($products->gimage1)){ ?>
        <div class="swiper-slide" >
          <img  class="img-responsive" id="t_img-7" src="<?=$products->gimage1?>?$xlarge$" >
        </div>
      <?php } ?>

      <?php if(!empty($products->gimage2)){ ?>
        <div class="swiper-slide" >
          <img  class="img-responsive" id="t_img-8" src="<?=$products->gimage2?>?$xlarge$" >
        </div>
      <?php } ?>

      <?php if(!empty($products->gimage8)){ ?>
        <div class="swiper-slide" >
          <img  class="img-responsive" id="t_img-9" src="<?=$products->gimage8?>?$xlarge$" >
        </div>
      <?php } ?>


<!-- FullySetImages IMAGES -->

      <?php if(!empty($products->FullySetImage1)){ ?>
        <div class="swiper-slide" >
          <img  class="img-responsive" id="t_img-10" src="<?=$products->FullySetImage1?>?$xlarge$" >
        </div>
      <?php } ?>

      <?php if(!empty($products->FullySetImage2)){ ?>
        <div class="swiper-slide" >
          <img  class="img-responsive" id="t_img-11" src="<?=$products->FullySetImage2?>?$xlarge$" >
        </div>
      <?php } ?>

      <?php if(!empty($products->FullySetImage3)){ ?>
        <div class="swiper-slide">
          <img  class="img-responsive" id="t_img-12" src="<?=$products->FullySetImage3?>?$xlarge$" >
        </div>
      <?php } ?>

      <?php if(!empty($products->FullySetImage4)){ ?>
        <div class="swiper-slide" >
          <img  class="img-responsive" id="t_img-13" src="<?=$products->FullySetImage4?>?$xlarge$" >
        </div>
      <?php } ?>

      <?php if(!empty($products->FullySetImage5)){ ?>
        <div class="swiper-slide">
          <img  class="img-responsive" id="t_img-14" src="<?=$products->FullySetImage5?>?$xlarge$" >
        </div>
      <?php } ?>

      <?php if(!empty($products->FullySetImage6)){ ?>
        <div class="swiper-slide" >
          <img  class="img-responsive" id="t_img-15" src="<?=$products->FullySetImage6?>?$xlarge$" >
        </div>
      <?php } ?>



    </div>
    <!-- Add Arrows -->
    <div class="swiper-button-next slider_thumb swiper-button-white" style=""></div>
    <div class="swiper-button-prev slider_thumb swiper-button-white" style=""></div>

  </div>



<!-- vedio part start -->


<!-- <div class='video-wrapper' >

<?php
if(!empty($products->video)){
?>

  <iframe width="375" height="200" src="<?=$products->video;?>">
  </iframe>


<?php }?>

<?php if(!empty($products->gvideo)){ ?>

  <iframe width="375" height="200" src="<?=$products->gvideo;?>">
  </iframe>

<?php }?>

</div> -->

<!-- vedio part end -->

<div class="row mt-5">
  <div class="col-md-8 m-auto">
  <a href="javascript:void(0)">
  <button type="button" id="view" class="btn w-100" style="background: #547f9e;color: white;">View Full Detail</button>
  </a>
</div>
<div class="col-md-8 m-auto">
<a href="<?=base_url()?>Home/load_modify_contact/<?=$products->id?>">
<button type="button" class="btn w-100 mt-3" style="background-color:#2a2828;color:white"><i class="fa fa-cog" style="color:#edbe68" aria-hidden="true"></i><span> Modify This Style</span></button>
</a>

</div>

</div>
<script>
$("#view").click(function() {
  $('html,body').animate({
      scrollTop: $("#specification").offset().top},
      'slow');
});
</script>


    </div>
    <div class="col-md-5 mt-5 border-le">
      <style media="screen">
      .Stone_Shape_img:hover{
          content: url('https://www.fineoutput.co.in/ddjewelers/assets/jewel/img/stone_shape/round_2.png');
        }
        .Stone_Shape_img2:hover{
          content: url('https://www.fineoutput.co.in/ddjewelers/assets/jewel/img/stone_shape/cushion_2.png');
        }

        .Stone_Shape_img3:hover{
          content: url('https://www.fineoutput.co.in/ddjewelers/assets/jewel/img/stone_shape/oval_2.png');
        }

        .Stone_Shape_img4:hover{
          content: url('https://www.fineoutput.co.in/ddjewelers/assets/jewel/img/stone_shape/emerald_2.png');
        }

        .Stone_Shape_img5:hover{
          content: url('https://www.fineoutput.co.in/ddjewelers/assets/jewel/img/stone_shape/square_2.png');
        }

        .Stone_Shape_img6:hover{
          content: url('https://www.fineoutput.co.in/ddjewelers/assets/jewel/img/stone_shape/pear_2.png');
        }

        .Stone_Shape_img7:hover{
          content: url('https://www.fineoutput.co.in/ddjewelers/assets/jewel/img/stone_shape/asscher_2.png');
        }

        .Stone_Shape_img8:hover{
          content: url('https://www.fineoutput.co.in/ddjewelers/assets/jewel/img/stone_shape/marquise_2.png');
        }

        .Stone_Shape_img9:hover{
          content: url('https://www.fineoutput.co.in/ddjewelers/assets/jewel/img/stone_shape/heart_2.png');
        }

      </style>

      <?
      $head="";
      $s_array="";
      if(strpos($b11, 'Stone Shape')==true || $b11=='Stone Shape'){
      $head= $b11;
      $s_array = $d11;
      $col='desc_e_value2';
    }else if(strpos($b21, 'Stone Shape')==true || $b21=='Stone Shape'){
        $head= $b21;
        $s_array = $d21;
        $col='desc_e_value3';
      }else if(strpos($b31, 'Stone Shape')==true || $b31=='Stone Shape'){
        $head= $b31;
        $s_array = $d31;
        $col='desc_e_value4';
      }else if(strpos($b41, 'Stone Shape')==true || $b41=='Stone Shape'){
        $head= $b41;
        $s_array = $d41;
        $col='desc_e_value5';
      }else if(strpos($b51, 'Stone Shape')==true || $b51=='Stone Shape'){
        $head= $b51;
        $s_array = $d51;
        $col='desc_e_value6';
      }else if(strpos($b61, 'Stone Shape')==true || $b61=='Stone Shape'){
        $head= $b61;
        $s_array = $d61;
        $col='desc_e_value7';
      }else if(strpos($b71, 'Stone Shape')==true || $b71=='Stone Shape'){
        $head= $b71;
        $s_array = $d71;
        $col='desc_e_value8';
      }else if(strpos($b81, 'Stone Shape')==true || $b81=='Stone Shape'){
        $head= $b81;
        $s_array = $d81;
        $col='desc_e_value9';
      }else if(strpos($b91, 'Stone Shape')==true || $b91=='Stone Shape'){
        $head= $b91;
        $s_array = $d91;
        $col='desc_e_value10';
      }else if(strpos($b101, 'Stone Shape')==true || $b101=='Stone Shape'){
        $head= $b101;
        $s_array = $d101;
        $col='desc_e_value11';
      }else{
        $col='';
      }
      // $b41 = 'Eng Stone Shape';
      // if(strpos($b41, 'Stone Shape')==true || $b41=='Stone Shape'){
      //   echo "yes";
      // }else{
      //   echo "else";
      // }
      // echo $b41."----";die();
      if(!empty($head)){
      ?>
      <div class="row">
        <div class="col-md-12">
          <h5><?=$head?></h5 >
          <hr>
        </div>
          <div class="col-md-12 mb-4">
        <div class=" swiper-container swiper-containericon">
          <div class="swiper-wrapper text-center">
            <?php $i=1; foreach($s_array as $array) {
              if($array=="Round"){
               ?>
            <div class="swiper-slide">
              <a href="javascript:void(0)"><img id="round" onclick="pro_change(this)" icn="1" value="<?=$array?>" img1="<?=base_url()?>assets\jewel\img\stone_shape\round_1.png" img2="<?=base_url()?>assets\jewel\img\stone_shape\round_3.png" para="1"  col="<?=$col?>" active="<?=$products->$col?>" pro_sku="<?=$products->sku_series;?>"
              <?if($products->$col==$array){echo 'src="'.base_url().'assets\jewel\img\stone_shape\round_3.png"' ;}else{echo 'src="'.base_url().'assets\jewel\img\stone_shape\round_1.png"';}?> alt="Round" style="width:70%;" class="img-fluid Stone_Shape_img"></a>
              <p class="h6">Round</p>
            </div>
            <?}else if($array=="Cushion"){?>
            <div class="swiper-slide">
              <a href="javascript:void(0)"><img id="cushion" onclick="pro_change(this)" icn="2" active="<?=$products->$col?>" value="<?=$array?>" para="1" col="<?=$col?>" pro_sku="<?=$products->sku_series;?>" img1="<?=base_url()?>assets\jewel\img\stone_shape\cushion_1.png" img2="<?=base_url()?>assets\jewel\img\stone_shape\cushion_3.png"
          <?if($products->$col==$array){echo 'src="'.base_url().'assets\jewel\img\stone_shape\cushion_3.png" ';}else{echo 'src="'.base_url().'assets\jewel\img\stone_shape\cushion_1.png"';}?> alt="Cushion" style="width:70%;" class="img-fluid Stone_Shape_img2"></a>
              <p class="h6">Cushion</p>
            </div>
            <?}else if($array=="Oval"){?>
            <div class="swiper-slide">
            <a href="javascript:void(0)">  <img id="oval" para="1" onclick="pro_change(this)" icn="3" active="<?=$products->$col?>" value="<?=$array?>"  col="<?=$col?>" pro_sku="<?=$products->sku_series;?>" img1="<?=base_url()?>assets\jewel\img\stone_shape\oval_1.png" img2="<?=base_url()?>assets\jewel\img\stone_shape\oval_3.png"
           <?if($products->$col==$array){echo 'src="'.base_url().'assets\jewel\img\stone_shape\oval_3.png"';}else{echo 'src="'.base_url().'assets\jewel\img\stone_shape\oval_1.png"';}?>  alt="icon" style="width:70%;" class="img-fluid Stone_Shape_img3"></a>
              <p class="h6">Oval</p>
            </div>
            <?}else if($array=="Emerald"){?>
            <div class="swiper-slide">
            <a href="javascript:void(0)">  <img id="emerald" onclick="pro_change(this)" icn="4" active="<?=$products->$col?>" value="<?=$array?>" para="1"  col="<?=$col?>" pro_sku="<?=$products->sku_series;?>" img1="<?=base_url()?>assets\jewel\img\stone_shape\emerald_1.png" img2="<?=base_url()?>assets\jewel\img\stone_shape\emerald_3.png"  <?if($products->$col==$array){echo 'src="'.base_url().'assets\jewel\img\stone_shape\emerald_3.png" ';}else{echo 'src="'.base_url().'assets\jewel\img\stone_shape\emerald_1.png"';}?>  alt="icon" style="width:70%;" class="img-fluid Stone_Shape_img4"></a>
              <p class="h6">Emerald</p>
            </div>
              <?}else if($array=="Square"){?>
            <div class="swiper-slide">
            <a href="javascript:void(0)">  <img id="square" onclick="pro_change(this)" icn="1" active="<?=$products->$col?>" value="<?=$array?>" para="1"  col="<?=$col?>" pro_sku="<?=$products->sku_series;?>" img1="<?=base_url()?>assets\jewel\img\stone_shape\square_1.png" img2="<?=base_url()?>assets\jewel\img\stone_shape\square_3.png"  <?if($products->$col==$array){echo 'src="'.base_url().'assets\jewel\img\stone_shape\square_3.png"';}else{echo 'src="'.base_url().'assets\jewel\img\stone_shape\square_1.png"';}?> alt="icon" style="width:70%;" class="img-fluid Stone_Shape_img5"></a>
              <p class="h6">Square </p>
            </div>
              <?}else if($array=="Pear"){?>
            <div class="swiper-slide">
              <a href="javascript:void(0)"><img id="pear" onclick="pro_change(this)" icn="1" active="<?=$products->$col?>" value="<?=$array?>" para="1"  col="<?=$col?>" pro_sku="<?=$products->sku_series;?>" img1="<?=base_url()?>assets\jewel\img\stone_shape\pear_1.png" img2="<?=base_url()?>assets\jewel\img\stone_shape\pear_3.png" <?if($products->$col==$array){echo 'src="'.base_url().'assets\jewel\img\stone_shape\pear_3.png" ';}else{echo 'src="'.base_url().'assets\jewel\img\stone_shape\pear_1.png"';}?>  alt="icon" style="width:70%;" class="img-fluid Stone_Shape_img6"></a>
              <p class="h6">Pear</p>
            </div>
              <?}else if($array=="Asscher"){?>
            <div class="swiper-slide">
              <a href="javascript:void(0)"><img id="asscher" onclick="pro_change(this)" active="<?=$products->$col?>" icn="1" value="<?=$array?>" para="1" col="<?=$col?>" pro_sku="<?=$products->sku_series;?>" img1="<?=base_url()?>assets\jewel\img\stone_shape\asscher_1.png" img2="<?=base_url()?>assets\jewel\img\stone_shape\asscher_3.png" <?if($products->$col==$array){echo 'src="'.base_url().'assets\jewel\img\stone_shape\asscher_3.png" ';}else{echo 'src="'.base_url().'assets\jewel\img\stone_shape\asscher_1.png"';}?>  alt="icon" style="width:70%;" class="img-fluid Stone_Shape_img7"></a>
              <p class="h6">Asscher</p>
            </div>
              <?}else if($array=="Marquise"){?>
            <div class="swiper-slide">
              <a href="javascript:void(0)"><img id="marquise" onclick="pro_change(this)" active="<?=$products->$col?>" icn="1" value="<?=$array?>" para="1" col="<?=$col?>" pro_sku="<?=$products->sku_series;?>" img1="<?=base_url()?>assets\jewel\img\stone_shape\marquise_1.png" img2="<?=base_url()?>assets\jewel\img\stone_shape\marquise_3.png"  <?if($products->$col==$array){echo 'src="'.base_url().'assets\jewel\img\stone_shape\marquise_3.png"';}else{echo 'src="'.base_url().'assets\jewel\img\stone_shape\marquise_1.png"';}?> alt="icon" style="width:70%;" class="img-fluid Stone_Shape_img8"></a>
              <p class="h6">Marquise</p>
            </div>
              <?}else if($array=="Heart"){?>
            <div class="swiper-slide">
            <a href="javascript:void(0)">  <img id="heart" onclick="pro_change(this)" active="<?=$col?>" icn="1" value="<?=$array?>" para="1"  col="<?=$col?>" pro_sku="<?=$products->sku_series;?>" img1="<?=base_url()?>assets\jewel\img\stone_shape\heart_1.png" img2="<?=base_url()?>assets\jewel\img\stone_shape\heart_3.png"  <?if($col==$array){echo 'src="'.base_url().'assets\jewel\img\stone_shape\heart_3.png"';}else{echo 'src="'.base_url().'assets\jewel\img\stone_shape\heart_1.png"';}?> alt="icon" style="width:70%;" class="img-fluid Stone_Shape_img9"></a>
              <p class="h6">Heart</p>
            </div>
            <?}?>
            <?php $i++; } ?>
        </div>

          <div class="swiper-button-next"></div>
          <div class="swiper-button-prev"></div>
        </div>
        </div>
      </div>
      <?}?>
      <input type="hidden" id="active" value="<?if(!empty($products->$col)){echo $products->$col;}else{echo $col;}?>">
      <!-- <div class="row">
        <div class="col-12">
          <h4 class="font-weight-bold">Center Stone Shape</h4>
        </div>

      </div>

      <div class="row">
        <div class="col-12">


        </div>
      </div> -->





      <div class="d-flex jus_cont">
      <p><b>Product</b></p>
      <p id="p_des"><?=$products->description?></p>
      </div>

      <!-- <div class="d-flex jus_cont">
      <p><b>SKU</b></p>
      <p id="p_sku"><?="SLR-".$products->sku?></p>
      </div> -->

      <!-- <div class="d-flex jus_cont">
      <p><b>Status</b></p>
      <p id="p_status"><?=$products->status?></p>
      </div> -->

      <div class="d-flex jus_cont">
      <p><b>Product Type</b></p>
      <p id="p_type"><?=$products->product_type?></p>
      </div>


<!-- product types listing on sku series based start -->



<?php
if($page_t == 1){
  // from quickshop products page

  $this->db->select('*');
$this->db->from('tbl_quickshop_products');
$this->db->where('sku_series_type1',$products->sku_series_type1);
$this->db->where('sku_series',$products->sku_series);
$this->db->where('is_active',1);
$types_wise_product_data= $this->db->get();

}elseif ($page_t == 2) {
  // from new arrivals products page

  $this->db->select('*');
$this->db->from('tbl_new_arrival_products');
$this->db->where('sku_series_type1',$products->sku_series_type1);
$this->db->where('sku_series',$products->sku_series);
$this->db->where('is_active',1);
$types_wise_product_data= $this->db->get();

}else{
  // from normal products page

            $this->db->select('*');
$this->db->from('tbl_products');
$this->db->where('sku_series_type1',$products->sku_series_type1);
$this->db->where('sku_series',$products->sku_series);
$this->db->where('is_active',1);
$types_wise_product_data= $this->db->get();



}
?>

<input type="hidden" value="<?=$page_t;?>" id="page_tp">
<!-- <div class="d-flex jus_cont">
<select class="w-100" name="s_typee" id="s_typee"  onchange="load_type();">
  <option value="" >Select Type</option>

  <?$i=1;
// $length = count($types_wise_product_data);
// echo $length;
// print_r($types_wise_product_data);
//  exit;
   foreach($types_wise_product_data->result() as $typ_prod) { ?>


      <option value="<?php if($page_t == 1){ echo $typ_prod->product_id; }else{ echo $typ_prod->id; } ?>" <?php
       if($page_t == 1){ if($typ_prod->product_id == $products->product_id){ echo "selected"; } }else{ if($typ_prod->id == $products->id){ echo "selected"; } }
       ?> >
        <?=$typ_prod->sku_series_type2?>
      </option>

  <?  $i++; } ?>

</select>
</div> -->




<!-- product types listing on sku series based end -->


 <!-- Jewelry State dropdown-->
 <?
   $jewel_row="";
   $jewel_state=[];
 if($b1=="Jewelry State"){
   $head= $b1;
   $jewel_state=$state_array;
   $jewel_row='desc_e_value2';
 }else if($b2=="Jewelry State"){
   $head= $b2;
   $jewel_state=$state_array;
   $jewel_row='desc_e_value3';
 }else if($b3=="Jewelry State"){
   $head= $b3;
   $jewel_state=$state_array;
   $jewel_row='desc_e_value4';
 }else if($b4=="Jewelry State"){
   $head= $b4;
   $jewel_state=$state_array;
   $jewel_row='desc_e_value5';
 }else if($b5=="Jewelry State"){
   $head= $b5;
   $jewel_state=$state_array;
   $jewel_row='desc_e_value6';
 }else if($b6=="Jewelry State"){
   $head= $b6;
   $jewel_state=$state_array;
   $jewel_row='desc_e_value7';
 }else if($b7=="Jewelry State"){
   $head= $b7;
   $jewel_state=$state_array;
   $jewel_row='desc_e_value8';
 }else if($b8=="Jewelry State"){
   $head= $b8;
   $jewel_state=$state_array;
   $jewel_row='desc_e_value9';
 }else if($b9=="Jewelry State"){
   $head= $b9;
   $jewel_state=$state_array;
   $jewel_row='desc_e_value10';
 }else if($b10=="Jewelry State"){
   $head= $b10;
   $jewel_state=$state_array;
   $jewel_row='desc_e_value11';
 }else{
   $jewel_row='';
   $jewel_state='';
 }
 // print_r($con);die();
 if(!empty($jewel_state)){
   $check = count($jewel_state);
   if($check==1){
     ?>
     <div class="d-flex jus_cont">
     <p id="jewel_state"><b>Jewelry State</b></p>
     <p id="<?=$jewel_row;?>" ><?=$jewel_state[0]?></p>
     </div>
   <?}else{?>
     <div class="d-flex jus_cont">
       <p><b id="b1">Jewelry State</b></p>
     <select class="w-100" name="jewel_state" id="<?=$jewel_row;?>" para="2" col="<?=$jewel_row;?>" pro_sku=
       "<?=$products->sku_series;?>" required onchange="pro_change(this)">
       <!-- <option value="">Select <?=$b1?></option> -->
       <? $i=1; foreach($jewel_state as $dm) {
         ?>
   <option value="<?=$dm?>"  <?if($products->$jewel_row==$dm){echo "selected";}?>><?=$dm?></option>
 <? }  $i++;?>
 </select>
  </div>
  <?} } ?>

<!-- Product - Engagement ring/Band/Shank dropdown -->
<?
  $product_row="";
  $eng_band_array=[];
if($b1=="Product"){
  $head= $b1;
  $eng_band_array=$eng_band_shank_array;
  $product_row='desc_e_value2';
}else if($b2=="Product"){
  $head= $b2;
  $eng_band_array=$eng_band_shank_array;
  $product_row='desc_e_value3';
}else if($b3=="Product"){
  $head= $b3;
  $eng_band_array=$eng_band_shank_array;
  $product_row='desc_e_value4';
}else if($b4=="Product"){
  $head= $b4;
  $eng_band_array=$eng_band_shank_array;
  $product_row='desc_e_value5';
}else if($b5=="Product"){
  $head= $b5;
  $eng_band_array=$eng_band_shank_array;
  $product_row='desc_e_value6';
}else if($b6=="Product"){
  $head= $b6;
  $eng_band_array=$eng_band_shank_array;
  $product_row='desc_e_value7';
}else if($b7=="Product"){
  $head= $b7;
  $eng_band_array=$eng_band_shank_array;
  $product_row='desc_e_value8';
}else if($b8=="Product"){
  $head= $b8;
  $eng_band_array=$eng_band_shank_array;
  $product_row='desc_e_value9';
}else if($b9=="Product"){
  $head= $b9;
  $eng_band_array=$eng_band_shank_array;
  $product_row='desc_e_value10';
}else if($b10=="Product"){
  $head= $b10;
  $eng_band_array=$eng_band_shank_array;
  $product_row='desc_e_value11';
}else{
  $product_row='';
  $eng_band_array='';
}
// print_r($con);die();
if(!empty($eng_band_array)){
  $check = count($eng_band_array);
  if($check==1){
    ?>
    <div class="d-flex jus_cont">
    <p id="product"><b>Product</b></p>
    <p id="<?=$product_row;?>" ><?=$eng_band_array[0]?></p>
    </div>
  <?}else{?>
    <div class="d-flex jus_cont">
      <p><b id="b1">Product</b></p>
    <select class="w-100" name="eng_band_array" id="<?=$product_row;?>" para="2" col="<?=$product_row;?>" pro_sku=
      "<?=$products->sku_series;?>" required onchange="pro_change(this)">
      <!-- <option value="">Select <?=$b1?></option> -->
      <? $i=1; foreach($eng_band_array as $dm) {
        ?>
  <option value="<?=$dm?>"  <?if($products->$product_row==$dm){echo "selected";}?>><?=$dm?></option>
<? }  $i++;?>
</select>
 </div>
 <?} } ?>


<!-- Quality dropdown-->
<?
  $quality="";
  $con=[];
  $icon="";
//   print_r($d1);die();
if($b1=="Quality"){
  $head= $b1;
  $con=$d1;
  $quality='desc_e_value2';
}else if($b2=="Quality"){
   
  $head= $b2;
  $con=$d2;
  $quality='desc_e_value3';
}else if($b3=="Quality"){
  $head= $b3;
  $con=$d3;
  $quality='desc_e_value4';
}else if($b4=="Quality"){
  $head= $b4;
  $con=$d4;
  $quality='desc_e_value5';
}else if($b5=="Quality"){
  $head= $b5;
  $con=$d5;
  $quality='desc_e_value6';
}else if($b6=="Quality"){
  $head= $b6;
  $con=$d6;
  $quality='desc_e_value7';
}else if($b7=="Quality"){
  $head= $b7;
  $con=$d7;
  $quality='desc_e_value8';
}else if($b8=="Quality"){
  $head= $b8;
  $con=$d8;
  $quality='desc_e_value9';
}else if($b9=="Quality"){
  $head= $b9;
  $con=$d9;
  $quality='desc_e_value10';
}else if($b10=="Quality"){
  $head= $b10;
  $con=$d10;
  $quality='desc_e_value11';
}else{
  $quality='';
  $con='';
}
// print_r($con);die();
if(!empty($con)){
  $check = count($con);
//   echo $check;die();
  if($check==1){
    ?>
    <div class="d-flex jus_cont">
    <p id="quality"><b><?=$head?></b></p>
    <p id="p_quality" ><?=$con[0]?></p>
    </div>
  <?}else{?>
    <input type="hidden" id="<?=$quality;?>" name="<?=$quality?>"  para="0" col="<?=$quality?>" pro_sku= "<?=$products->sku_series;?>" name="<?=$quality?>" value="<?=$products->$quality;?>">
    <select class="vodiapicker" id="thatdropdown" hidden_id="<?=$quality;?>">
      <?foreach($con as $dm){
        $icon="assets/jewel/img/stone_quality/yellow.png";
        if(strpos($dm, 'Rose')==true) {$icon="assets/jewel/img/stone_quality/rose.png";}
        if(strpos($dm, 'White')==true) {$icon="assets/jewel/img/stone_quality/white.png";}
        if(strpos($dm, 'Yellow')==true) {$icon="assets/jewel/img/stone_quality/yellow.png";}
        if(strpos($dm, 'Silver')==true) {$icon="assets/jewel/img/stone_quality/white.png";}
        if(strpos($products->$quality, 'Black')==true) {$icon="assets/jewel/img/stone_quality/black.png";}
        if(strpos($dm, 'White/Rose')==true || (strpos($products->$quality, 'White')==true && strpos($products->$quality, 'Rose')==true)) {$icon="assets/jewel/img/stone_quality/white_rose.png";}
        if(strpos($dm, 'Rose/White')==true || (strpos($products->$quality, 'Platinum')==true && strpos($products->$quality, 'Rose')==true)) {$icon="assets/jewel/img/stone_quality/rose_white.png";}
        if(strpos($dm, 'White/Yellow')==true || strpos($dm, 'Yellow & Platinum')==true || ((strpos($dm, 'Platinum')==true) && strpos($dm, 'Yellow')==true)) {$icon="assets/jewel/img/stone_quality/white_yellow.png";}
        if($dm=='Platinum') {$icon="assets/jewel/img/stone_quality/white.png";}
        ?>
                <option value="<?=$dm?> <?if($products->$quality==$dm){echo "selected";}?>" class="test" data-thumbnail="<?=base_url().$icon?>"><?=$dm?></option>
                <?}?>
          </select>

    <div class="d-flex jus_cont" style="margin-bottom: 0px;">
      <p><b id="b1"><?=$head?></b></p>

    <button class="btn-select w-100 mt-0" style="cursor:pointer;border-color: rgb(118, 118, 118);" id="qualityDropdown">
      <i class="fa fa-angle-down" style="position:relative;float:right;margin-top:4px;"></i>
      <li>
        <?
        if(strpos($products->$quality, 'Rose')==true) {$icon="assets/jewel/img/stone_quality/rose.png";}
        if(strpos($products->$quality, 'White')==true) {$icon="assets/jewel/img/stone_quality/white.png";}
        if(strpos($products->$quality, 'Yellow')==true) {$icon="assets/jewel/img/stone_quality/yellow.png";}
        if(strpos($products->$quality, 'Silver')==true) {$icon="assets/jewel/img/stone_quality/white.png";}
        if(strpos($products->$quality, 'Black')==true) {$icon="assets/jewel/img/stone_quality/black.png";}
        if(strpos($products->$quality, 'White/Rose')==true || (strpos($products->$quality, 'White')==true && strpos($products->$quality, 'Rose')==true)) {$icon="assets/jewel/img/stone_quality/white_rose.png";}
        if(strpos($products->$quality, 'Rose/White')==true || (strpos($products->$quality, 'Platinum')==true && strpos($products->$quality, 'Rose')==true)) {$icon="assets/jewel/img/stone_quality/rose_white.png";}
        if(strpos($products->$quality, 'White/Yellow')==true || strpos($products->$quality, 'Yellow & Platinum')==true || (strpos($products->$quality, 'Platinum')==true && strpos($products->$quality, 'Yellow')==true)) {$icon="assets/jewel/img/stone_quality/white_yellow.png";}
        if($products->$quality=='Platinum') {$icon="assets/jewel/img/stone_quality/white.png";}?>
        <img src="<?=base_url().$icon?>" alt="" />
        <span><?=$products->$quality;?></span>
      </li>
    </button>
    <div class="b" style="cursor: pointer; position: absolute; z-index: 99; right: 14px; width: 256px; margin-top: 34px; display: none;">
    <ul id="a" style="z-index:999;background:white; margin-bottom:0px; max-height: 200px; overflow-y: auto;">
    </ul>
    </div>
    </div>
    <?
      if(strpos($products->$quality, 'Forever')==true){?>
    <style>
    #foreverContent{
    display: block;
    }
    </style>
    <?
    }else{?>
      <style>
      #foreverContent{
      display: none;
      }
      </style>
      <?}
    ?>
    <?
      if(strpos($products->$quality, 'Palladium')==true){?>
        <style>
    #palladiumContent{
    display: block;
    }
    </style>
    <?
    }else{?>
      <style>
      #palladiumContent{
      display: none;
      }
      </style>
      <?}
    ?>
    <?
      if($products->$quality == 'Platinum'){?>
    <style>
    #platinumContent{
    display: block;
    }
    </style>
    <?
    }else{?>
      <style>
      #platinumContent{
      display: none;
      }
      </style>
      <?}
    ?>
    <?
    // echo $products->$quality;die();
      if(strpos($products->$quality, 'ontinuum')==true){?>
    <style>
    #continuumContent{
    display: block;
    }
    </style>
    <?
    }else{?>
      <style>
      #continuumContent{
      display: none;
      }
      </style>
      <?}
    ?>
    <div class="d-flex jus_cont">
      <p>
      </p>
      <p id="foreverContent" style="color: #547f9e; font-size: 0.8rem;">
        (This is a special "Extreme White" grade gold from a new family of karat white gold casting grain that is formulated to achieve a superior white color whithout the need for rhodium plating)
      </p>
      <p id="palladiumContent" style="color: #547f9e; font-size: 0.8rem;">
        (Palladium has a white color that lasts. 950 Palladium is a Platinum Group Metal and is enhanced 95% palladium alloy. Palladium is hypoallergenic and lead-free. It achieves the look and benefits of platinum at half the weight and at a more affordable price. This strong alloy will not tarnish and requires no rhodium plating to retain its bright white color. It will never lose metal weight when poished and is formulated to have the hardness of 14K Gold)
      </p>
      <p id="platinumContent" style="color: #547f9e; font-size: 0.8rem;">
        (Considered the noblest element. Platinum is 30 times more rare than gold, making it the most precious metal. Platinum is also hypoallergenic.)
      </p>
      <p id="continuumContent" style="color: #547f9e; font-size: 0.8rem;">
        (Continuum Sterling Silver is a bright white metal(no rhodium plating required) with more than 95% precious metal content. This patented sterling silver's superior oxidation and tarnish resistance  grade allows for a longer lasting finish.)
      </p>
    </div>

 <?} } ?>


<!-- First Specification -->
      <?if ($b1!='Description' && $b1!='Quality' && !empty($b1) && (strpos($b1, 'Stone Shape')==false) && $b1!='Jewelry State' && $b1!='Stone Shape'  && $b1!='Product'){?>
      <?  $check = count($d1);
       
        if($check==1){
          ?>
          <div class="d-flex jus_cont" id="div_desc_e_value2">
          <p id="b1"><b><?=$b1?></b></p>
          <p id="p_desc_e_value2" ><?=$d1[0]?></p>
          </div>
        <?}else{?>
          <div class="d-flex jus_cont">
            <p><b id="b1"><?=$b1?></b></p>
          <select class="w-100" name="type1" id="desc_e_value2" para="0" col="desc_e_value2" pro_sku=
            "<?=$products->sku_series;?>" required onchange="pro_change(this)">
            <!-- <option value="">Select <?=$b1?></option> -->

            <? $i=1; foreach($d1 as $dm) {

        // if($dm == "Unset"){
        //
        // }else{

              ?>
        <option value="<?=$dm?>"  <?if($products->desc_e_value2==$dm){echo "selected";}?>><?=$dm?></option>
      <? }  $i++;?>
      </select>
       </div>
       <?} } ?>
<!-- Second Specification -->
       <?if ($b2!='Quality' && $b2!='Description' && !empty($b2) && (strpos($b2, 'Stone Shape')==false) && $b2!='Jewelry State' && $b2!='Stone Shape'  && $b2!='Product'){?>
         <?  $check = count($d2);
        //  echo $check;
        //  exit;
           if($check==1){
             ?>
             <div class="d-flex jus_cont" id="div_desc_e_value3">
             <p id="b2"><b><?=$b2?></b></p>
             <p id="p_desc_e_value3"><?=$d2[0]?></p>
             </div>
           <?}else{?>
            
          <div class="d-flex jus_cont">
             <p id="b2"><b><?=$b2?></b></p>
          <select class="w-100" name="type2" id="desc_e_value3" para="0" col="desc_e_value3" pro_sku=
            "<?=$products->sku_series;?>" required onchange="pro_change(this)">
            <!-- <option value="" >Select <?=$b2?></option> -->
             <?$i=1; foreach($d2 as $dm) { ?>
        <option value="<?=$dm?>" <?if($products->desc_e_value3==$dm){echo "selected";}?>><?=$dm?></option>
      <?  $i++; } ?>
      </select>
       </div>
       <?}}?>
<!-- Third Specification -->
       <?if ($b3!='Quality'  && $b3!='Description' && !empty($b3) && (strpos($b3, 'Stone Shape')==false) && $b3!='Jewelry State' && $b3!='Stone Shape'  && $b3!='Product'){?>
         <?  $check = count($d3);
           if($check==1){
             ?>
             <div class="d-flex jus_cont" id="div_desc_e_value4">
             <p id="b3"><b><?=$b3?></b></p>
             <p id="p_desc_e_value4"><?=$d3[0]?></p>
             </div>
           <?}else{?>
          <div class="d-flex jus_cont">
            <p id="b3"><b><?=$b3?></b></p>
          <select class="w-100" name="type3" id="desc_e_value4" para="0" col="desc_e_value4" pro_sku=
            "<?=$products->sku_series;?>" required onchange="pro_change(this)">
            <!-- <option value="" >Select <?=$b3?></option> -->

             <?$i=1; foreach($d3 as $dm) { ?>
        <option value="<?=$dm?>" <?if($products->desc_e_value4==$dm){echo "selected";}?>><?=$dm?></option>
      <?  $i++; } ?>
      </select>
       </div>
       <?}}?>

<!-- Fourth Specification -->
       <?if ($b4!='Quality' && $b4!='Description' && !empty($b4) && (strpos($b4, 'Stone Shape')==false) && $b4!='Jewelry State' && $b4!='Stone Shape'  && $b4!='Product'){?>
         <?  $check = count($d4);
           if($check==1){
             ?>
             <div class="d-flex jus_cont" id="div_desc_e_value5">
             <p id="b4"><b><?=$b4?></b></p>
             <p id="p_desc_e_value5"><?=$d4[0]?></p>
             </div>
           <?}else{?>
          <div class="d-flex jus_cont">
             <p id="b4"><b><?=$b4?></b></p>
          <select class="w-100" name="type4" id="desc_e_value5" para="0" col="desc_e_value5" pro_sku=
            "<?=$products->sku_series;?>" required onchange="pro_change(this)">
            <!-- <option value="" >Select <?=$b4?></option> -->

            <? $i=1; foreach($d4 as $dm) { ?>
        <option value="<?=$dm?>" <?if($products->desc_e_value5==$dm){echo "selected";}?>><?=$dm?></option>
      <?  $i++; } ?>
      </select>
       </div>
       <?}}?>
<!-- Fifth Specification -->
       <?if ($b5!='Quality' && $b5!='Description' && !empty($b5) && (strpos($b5, 'Stone Shape')==false) && $b5!='Jewelry State' && $b5!='Stone Shape'  && $b5!='Product'){?>
         <? if(!empty($d5)){ $check = count($d5);
           if($check==1){
             ?>
             <div class="d-flex jus_cont" id="div_desc_e_value6">
             <p id="b5"><b><?=$b5?></b></p>
             <p id="p_desc_e_value6"><?=$d5[0]?></p>
             </div>
           <?}else{
             // print_r($d5);die();
             ?>
          <div class="d-flex jus_cont">
             <p id="b5"><b><?=$b5?></b></p>
          <select class="w-100" name="types" id="desc_e_value6" para="0" col="desc_e_value6" pro_sku=
            "<?=$products->sku_series;?>" required onchange="pro_change(this)">
            <!-- <option value="">Select <?=$b5?></option> -->

            <? $i=1; foreach($d5 as $dm) { ?>
        <option value="<?=$dm?>" <?if($products->desc_e_value6==$dm){echo "selected";}?>><?=$dm?></option>
      <?  $i++; } ?>
      </select>
       </div>
       <?}}}?>

       <!-- Sixth Specification -->
              <?if ($b6!='Quality' && $b6!='Description' && !empty($b6) && (strpos($b6, 'Stone Shape')==false) && $b6!='Jewelry State' && $b6!='Stone Shape'  && $b6!='Product'){?>
                <? if(!empty($d6)){ $check = count($d6);
                  if($check==1){
                    ?>
                    <div class="d-flex jus_cont" id="div_desc_e_value7">
                    <p id="b6"><b><?=$b6?></b></p>
                    <p id="p_desc_e_value7"><?=$d6[0]?></p>
                    </div>
                  <?}else{?>
                 <div class="d-flex jus_cont">
                     <p id="b6"><b><?=$b6?></b></p>
                 <select class="w-100" name="types" id="desc_e_value7" para="0" col="desc_e_value7" pro_sku=
                   "<?=$products->sku_series;?>" required onchange="pro_change(this)">
                   <!-- <option value="">Select <?=$b6?></option> -->

                   <? $i=1; foreach($d6 as $dm) { ?>
               <option value="<?=$dm?>" <?if($products->desc_e_value7==$dm){echo "selected";}?>><?=$dm?></option>
             <?  $i++; } ?>
             </select>
              </div>
              <?}}}?>
              <!-- Seventh Specification -->
                     <?if ($b7!='Quality' && $b7!='Description' && !empty($b7) && (strpos($b7, 'Stone Shape')==false) && $b7!='Jewelry State' && $b7!='Stone Shape'  && $b7!='Product'){?>
                       <? if(!empty($d7)){ $check = count($d7);
                         if($check==1){
                           ?>
                           <div class="d-flex jus_cont" id="div_desc_e_value8">
                           <p id="b7"><b><?=$b7?></b></p>
                           <p id="p_desc_e_value8"><?=$d7[0]?></p>
                           </div>
                         <?}else{?>
                        <div class="d-flex jus_cont">
                          <p id="b7"><b><?=$b7?></b></p>
                        <select class="w-100" name="types" id="desc_e_value8" para="0" col="desc_e_value8" pro_sku=
                          "<?=$products->sku_series;?>" required onchange="pro_change(this)">
                          <!-- <option value="">Select <?=$b7?></option> -->

                          <? $i=1; foreach($d7 as $dm) { ?>
                      <option value="<?=$dm?>" <?if($products->desc_e_value8==$dm){echo "selected";}?>><?=$dm?></option>
                    <?  $i++; } ?>
                    </select>
                     </div>
                     <?}}}?>
                     <!-- Eighth Specification -->
                            <?if ($b8!='Quality' && $b8!='Description' && !empty($b8) && (strpos($b8, 'Stone Shape')==false) && $b8!='Jewelry State' && $b8!='Stone Shape'  && $b8!='Product'){?>
                              <? if(!empty($d8)){ $check = count($d8);
                                if($check==1){
                                  ?>
                                  <div class="d-flex jus_cont" id="div_desc_e_value9">
                                  <p id="b8"><b><?=$b8?></b></p>
                                  <p id="p_desc_e_value9"><?=$d8[0]?></p>
                                  </div>
                                <?}else{?>
                               <div class="d-flex jus_cont">
                                   <p id="b8"><b><?=$b8?></b></p>
                               <select class="w-100" name="types" id="desc_e_value9" para="0" col="desc_e_value9" pro_sku=
                                 "<?=$products->sku_series;?>" required onchange="pro_change(this)">
                                 <!-- <option value="">Select <?=$b8?></option> -->

                                 <? $i=1; foreach($d8 as $dm) { ?>
                             <option value="<?=$dm?>" <?if($products->desc_e_value9==$dm){echo "selected";}?>><?=$dm?></option>
                           <?  $i++; } ?>
                           </select>
                            </div>
                            <?}}}?>
                            <!-- Ninth Specification -->
                                   <?if ($b9!='Quality' && $b9!='Description' && !empty($b9) && (strpos($b9, 'Stone Shape')==false) && $b9!='Jewelry State' && $b9!='Stone Shape'  && $b9!='Product'){?>
                                     <?if(!empty($d9)){
                                     $check = count($d9);
                                       if($check==1){
                                         ?>
                                         <div class="d-flex jus_cont" id="div_desc_e_value10">
                                         <p id="b9"><b><?=$b9?></b></p>
                                         <p id="p_desc_e_value10"><?=$d9[0]?></p>
                                         </div>
                                       <?}else{?>
                                      <div class="d-flex jus_cont">
                                         <p id="b9"><b><?=$b9?></b></p>
                                      <select class="w-100" name="types" id="desc_e_value10" para="0" col="desc_e_value10" pro_sku=
                                        "<?=$products->sku_series;?>" required onchange="pro_change(this)">
                                        <? $i=1; foreach($d9 as $dm) { ?>
                                    <option value="<?=$dm?>" <?if($products->desc_e_value10==$dm){echo "selected";}?>><?=$dm?></option>
                                  <?  $i++; } ?>
                                  </select>
                                   </div>
                                   <?}
                                 }
                                 }?>
                                   <!-- Tenth Specification -->
                                          <?if ($b10!='Quality' && $b10!='Description' && !empty($b10) && (strpos($b10, 'Stone Shape')==false) && $b10!='Jewelry State' && $b10!='Stone Shape'  && $b10!='Product'){?>
                                            <? if(!empty($d10)){
                                            $check = count($d10);
                                              if($check==1){
                                                ?>
                                                <div class="d-flex jus_cont" id="div_desc_e_value11">
                                                <p id="b10"><b><?=$b10?></b></p>
                                                <p id="p_desc_e_value11"><?=$d10[0]?></p>
                                                </div>
                                              <?}else{?>
                                             <div class="d-flex jus_cont">
                                               <p id="b10"><b><?=$b10?></b></p>
                                             <select class="w-100" name="types" id="desc_e_value11" para="0" col="desc_e_value11" pro_sku=
                                               "<?=$products->sku_series;?>" required onchange="pro_change(this)">
                                               <!-- <option value="" disabled>Select <?=$b10?></option> -->

                                               <? $i=1; foreach($d10 as $dm) { ?>
                                           <option value="<?=$dm?>" <?if($products->desc_e_value11==$dm){echo "selected";}?>><?=$dm?></option>
                                         <?  $i++; } ?>
                                         </select>
                                          </div>
                                          <?}
                                        }
                                        }?>

      <? $currentSizeprice = 0;
      $this->db->select('*');
      $this->db->from('tbl_product_specifications');
      $this->db->where('product_id',$products->id);
      $ringsize_data = $this->db->get()->row();
      $ringsizeDecode = json_decode($ringsize_data->ringsize);

      if(!empty($ringsizeDecode)){
        
      ?>
      <div id="ringsizeDiv" class="d-flex jus_cont">
      <p><b>Finger Size</b></p>

      <select class="w-100" id="ringsize" onchange = "addRingSizePrice(this)">
        <!-- <option value="" disabled>Select <?=$b10?></option> -->
        <? $i=1; foreach($ringsizeDecode as $setvalue) { ?>
    <option value = "<?=$setvalue->Price?>" size="<?=$setvalue->Size?>" <?if($setvalue->Size==7){echo "selected"; $currentSizeprice = $setvalue->Price;}?> price=""><?=$setvalue->Size?></option>
  <?  $i++; } ?>
  </select>
      </div>
      <?}else{?>
        <div id="ringsizeDiv" class="jus_cont" style="display:none">
        <p><b>Finger Size</b></p>
        <select class="w-100" id="ringsize" onchange = "addRingSizePrice(this)">
        </select>
        </div>
        <!-- <script>document.getElementById("ringsizeDiv").style.display = "none";</script> -->
        <!-- <style>
        #ringsizeDiv{
          display: none;
        }
        </style> -->
        <?}?>


      <!-- <div class="d-flex jus_cont">
      <p><b>Clarity/Color</b></p>
      <?if(!empty($products->dclarity||$products->dcolor)){?>
      <p id="p_clarity"><?=$products->dclarity?>/<?=$products->dcolor?></p>
      <?}{?>
<p id="p_clarity">N/A</p>
      <?}?>
      </div> -->


      <!-- <div class="d-flex jus_cont">
      <p><b>Finish State</b></p>
      <p id="p_state"><?=$products->status?></p>
      </div> -->

      <div class="d-flex jus_cont">
      <p><b>Description</b></p>
      <p id="p_sdesc"><?=$products->sdesc?></p>
      </div>

      <!-- <div class="d-flex jus_cont">
      <p><b>Product</b></p>
      <p id="p_des"><?=$products->description?></p>
      </div> -->





    </div>
    <input type="hidden" id="ringsizeprice" value="<?=$currentSizeprice;?>">
    <div class="col-md-3 mt-5">

      <?php
                  $this->db->select('*');
      $this->db->from('tbl_price_rule');
      $pr_data= $this->db->get()->row();
      $multiplier= $pr_data->multiplier;
      $cost_price11= $pr_data->cost_price1;
      $cost_price22= $pr_data->cost_price2;
      $cost_price33= $pr_data->cost_price3;
      $cost_price44= $pr_data->cost_price4;
      $cost_price55= $pr_data->cost_price5;

      if(!empty($products->price)){
        $cost_price = $products->price + $currentSizeprice;
        $retail = $cost_price * $multiplier;
        $now_price = $cost_price;
        // echo $now_price;
        // exit;
if($cost_price<=500){
  $cost_price2=$cost_price*$cost_price;
  // $now_price= $cost_price*0.00000264018*($cost_price*2)+(-0.002220133*$cost_price)+1.950022201-1+0.95;
  $number= round($cost_price*($cost_price11*$cost_price2+$cost_price22*$cost_price+$cost_price33),2);
  // echo $number;
  $unit=5;
  $remainder = $number % $unit;
$mround = ($remainder < $unit / 2) ? $number - $remainder : $number + ($unit - $remainder);
$now_price = round($mround)-1+0.95;
// $now_price = round($mround);
  // echo $cost_price;
  // exit;
}
if($cost_price>500){
  $number= round($cost_price*($cost_price44*$cost_price/$multiplier+$cost_price55));
  $unit=5;
  $remainder = $number % $unit;
$mround = ($remainder < $unit / 2) ? $number - $remainder : $number + ($unit - $remainder);
$now_price = round($mround)-1+0.95;
// $now_price = round($mround);
  // echo $cost_price;
}
$saved = round($retail - $now_price);
$dis_percent = $saved/$retail * 100;
       ?>
       <input type="hidden" name="pid" id="pid" value="<?=$products->id?>">
       <input type="hidden" name="pp" id="pp" value="<?=$products->price?>">
       <input type="hidden" name="mp" id="mp" value="<?=$multiplier?>">
       <input type="hidden" name="cp1" id="cp1" value="<?=$cost_price11?>">
       <input type="hidden" name="cp2" id="cp2" value="<?=$cost_price22?>">
       <input type="hidden" name="cp3" id="cp3" value="<?=$cost_price33?>">
       <input type="hidden" name="cp4" id="cp4" value="<?=$cost_price44?>">
       <input type="hidden" name="cp5" id="cp5" value="<?=$cost_price55?>">
       <div id="price_div">
      <h6 id="p_retail" class="text-right" >Retail Price: $<?=number_format($retail, 2);?></h6>
      <?if($saved>0){?>
      <p id="p_saved" class="text-right mb-2"  style="color:red;">You Saved: $<?=number_format($saved);?>(<?=round($dis_percent)?>%)</p>
      <?}?>
      <h2  class="text-right mb-3" id="p_price" style="color:red; font-weight: 100;font-size:1.7rem;">Now: $<?=number_format($now_price,2);?></h2>
    </div>
      <?php }else{ ?>
      <a id="no_price" href="<?=base_url(); ?>Home/contact_us"> <p>CONTACT US FOR PRICE AVAILABILITY </p></a>
    <?php }?>

<!-- <form action="<?=base_url()?>Home/add_quantity_data/<? echo base64_encode(1); ?>/<?echo base64_encode($products->product_id);?>" method="post"> -->

      <sup class="float-right">QTY</sup>

      <div class="align-right d-flex  justify-content-end">
        <!-- <input class="w-100 border_ligh" type="number" name="quantity" min="1" value="1" id="qtty_<?=$products->id;?>">
        <button class="no_border">Each</button> -->
        <button class="qtyminus" aria-hidden="true">&minus;</button>
			<input type="number" readonly name="qty" id="qty" min="1" max="20" step="1" value="1" style="text-align:center;margin-top:1rem;width:auto;font-size:0.9rem;">
      <!-- border: solid grey 1px; -->
			<button class="qtyplus" aria-hidden="true">&plus;</button>
      </div>

<input type="hidden" name="sku_series" value="<?=$products->sku_series?>" id="h_sku_series">
<input type="hidden" name="gdesc" value="<?=$products->gdesc?>" id="gdesc">
<input type="hidden" name="desc_e_value2" value="<?=$products->desc_e_value2?>" id="h_desc_e_value2">
<input type="hidden" name="desc_e_value3" value="<?=$products->desc_e_value3?>" id="h_desc_e_value3">
<input type="hidden" name="desc_e_value4" value="<?=$products->desc_e_value4?>" id="h_desc_e_value4">
<input type="hidden" name="desc_e_value5" value="<?=$products->desc_e_value5?>" id="h_desc_e_value5">
<input type="hidden" name="desc_e_value6" value="<?=$products->desc_e_value6?>" id="h_desc_e_value6">
<input type="hidden" name="desc_e_value7" value="<?=$products->desc_e_value7?>" id="h_desc_e_value7">
<input type="hidden" name="desc_e_value8" value="<?=$products->desc_e_value8?>" id="h_desc_e_value8">
<input type="hidden" name="desc_e_value9" value="<?=$products->desc_e_value9?>" id="h_desc_e_value9">
<input type="hidden" name="desc_e_value10" value="<?=$products->desc_e_value10?>" id="h_desc_e_value10">
<input type="hidden" name="desc_e_value11" value="<?=$products->desc_e_value11?>" id="h_desc_e_value11">
<style>
.orderul{
text-align:center;
margin-top:1rem;
font-size:0.9rem;
border: solid grey 1px;
}

/* Chrome, Safari, Edge, Opera */
input.mobilenumbers::-webkit-outer-spin-button,
input.mobilenumbers::-webkit-inner-spin-button {
-webkit-appearance: none;
margin: 0;
}

/* Firefox */
input[type=number].mobilenumbers {
-moz-appearance: textfield;
}
</style>
<?if(!empty($products->leadtime)){
  $dd=round($products->leadtime)-1;
  $NewDate=Date('l, F d', strtotime('+'.$dd.' days'));
  // echo $dd;die();
  if($NewDate===Date('l, F d')){
    $NewDate="Today";
  }
  ?>
<div>
  <ul class="orderul">
    <li style="background:#547f9e;color:white; text-transform: uppercase;">
      <?if($products->status=="Limited Availability"){
        echo $products->status."<br />(NON-RETURNABLE)";
      }elseif($products->status=="While Supplies Last"){
          echo $products->status."<br />(NON-RETURNABLE)";
      }else{
        echo $products->status;
      }

      ?>
    </li>
    <li>
      Ready To Ship: <b><?=$NewDate?></b>
    </li>
  </ul>
</div>
<?}?>
<p>
  <b>Quantity in stock: </b><?if(!empty($products->onhand)){echo round($products->onhand);}else{echo "0";}?>
</p>
<?php if($page == 0){?>

      <?php if(empty($this->session->userdata('user_id'))){?>

        <input type="submit" class="mt-3 add-btn" value=" Add to cart" id="addToCartBtn" onclick="addToCartOfflineHandler(this);" quantity=""
              data-product-id="<?= $products->id;?>" data-stuller-product-id="" data-category-id="<?= $products->category;?>" data-subcategory-id="<?= $products->sub_category;?>" data-ringprice="<?=$currentSizeprice;?>" data-ringsize="<?if($currentSizeprice==0){}else{echo 7;};?>">
      <?php }else { ?>

      <input type="submit" class="mt-3 add-btn" id="addToCartBtn" value="Add to cart" onclick="addToCartOnlineHandler(this);" quantity="" data-type-id="" data-product-id="<?=$products->id;?>" data-stuller-product-id="" data-category-id="<?= $products->category;?>" data-subcategory-id="<?= $products->sub_category;?>" data-ringsize="<?if($currentSizeprice==0){}else{echo 7;};?>" data-ringprice="<?=$currentSizeprice;?>"
          user-id="<?= $this->session->userdata('user_id');?>">

      <?php } ?>
      <!-- wishlist -->
      <?php if(empty($this->session->userdata('user_id'))){?>

        <!-- <input type="submit" class="mt-1 add-btn" value=" Add to Wishlist" id="addToWishlistBtn" onclick="wishlist(this)"
              data-product-id="<?= $products->id;?>" status="add" data-stuller-product-id="" user_id="1"  data-category-id="<?= $products->category;?>" data-subcategory-id="<?= $products->sub_category;?>" > -->
      <?php }else { ?>

        <input type="submit" class="mt-1 add-btn" value="Add to Wishlist" id="addToWishlistBtn" onclick="wishlist(this)"
              data-product-id="<?=$products->id;?>" status="add" data-stuller-product-id="" user_id="<?=$this->session->userdata('user_id')?>"  data-category-id="<?= $products->category;?>" data-ringprice="<?=$currentSizeprice?>" data-ringsize="<?if($currentSizeprice==0){}else{echo 7;};?>" data-subcategory-id="<?= $products->sub_category;?>" >

      <?php } ?>

<?php }else{?>

  <?php if(empty($this->session->userdata('user_id'))){?>

    <input type="submit" class="mt-3 add-btn" value=" Add to cart" onclick="addToCartOfflineHandler(this);" quantity="" id="addToCartBtn"
          data-product-id="<?= $products->id;?>" data-stuller-product-id="<?= $products->product_id;?>"  data-category-id="<?= $products->category;?>" data-subcategory-id="<?= $products->sub_category;?>" data-ringsize="<?if($currentSizeprice==0){}else{echo 7;};?>" data-ringprice="<?=$currentSizeprice;?>">
  <?php }else { ?>

  <input type="submit" class="mt-3 add-btn" value=" Add to cart" onclick="addToCartOnlineHandler(this);" quantity="" id="addToCartBtn" data-type-id="" data-product-id="<?= $products->id;?>" data-stuller-product-id="<?= $products->product_id;?>" data-category-id="<?= $products->category;?>" data-ringsize="<?if($currentSizeprice==0){}else{echo 7;};?>" data-subcategory-id="<?= $products->sub_category;?>"  data-ringprice="<?=$currentSizeprice;?>"
      user-id="<?= $this->session->userdata('user_id');?>">

  <?php } ?>

<?php } ?>
<?php if($page == 0){?>

      <?php if(empty($this->session->userdata('user_id'))){?>

        <!-- <input type="submit" class="mt-3 add-btn" value=" Add to wishlist" onclick="addToCartOfflineHandler(this);" quantity=""
              data-product-id="<?= $products->id;?>" data-stuller-product-id="" data-category-id="<?= $products->category;?>" data-subcategory-id="<?= $products->sub_category;?>" > -->
      <?php }else { ?>

      <!-- <input type="submit" class="mt-3 add-btn" value=" Add to wishlist" onclick="addToCartOnlineHandler(this);" quantity="" data-type-id=""
          data-product-id="<?= $products->id;?>" data-stuller-product-id="" data-category-id="<?= $products->category;?>" data-subcategory-id="<?= $products->sub_category;?>"
          user-id="<?= $this->session->userdata('user_id');?>"> -->

      <?php } ?>

<?php }else{?>

  <?php if(empty($this->session->userdata('user_id'))){?>

    <input type="submit" class="mt-3 add-btn" value="Add to wishlist" onclick="addToCartOfflineHandler(this);" quantity=""
          data-product-id="<?= $products->id;?>" data-stuller-product-id="<?= $products->product_id;?>"  data-category-id="<?= $products->category;?>" data-subcategory-id="<?= $products->sub_category;?>" >
  <?php }else { ?>

  <input type="submit" class="mt-3 add-btn" value="Add to wishlist" onclick="addToCartOnlineHandler(this)" quantity="" data-type-id="" data-product-id="<?= $products->id;?>" data-stuller-product-id="<?= $products->product_id;?>" data-category-id="<?= $products->category;?>" data-subcategory-id="<?= $products->sub_category;?>"
      user-id="<?= $this->session->userdata('user_id');?>">

  <?php } ?>

<?php } ?>

<div class="d-flex justify-content-between p-2 pb-4">
  <div>
  <a href="<?=base_url(); ?>Home/contact_us"><button class="btn" style="background:#2a2828;color:white;"><i class="fa fa-fw fa-envelope" aria-hidden="true"></i>Contact</button></a>
<a href="<?=base_url(); ?>Home/contact_us"><button class="btn" style="background:#2a2828;color:white;"><i class="fa fa-fw fa-calendar" aria-hidden="true"></i>Appointment</button></a>
<!-- <i class="fa fa-paper-plane"></i> -->
</div>
</div>

<div class="col-md-12">
  <h2>Ask a Question</h2>
  <form action="<?=base_url()?>Home/ask_question" method="post" enctype="multipart/form-data">
    <input type="hidden" name="product_id" value="<?=$products->id;?>" >
    <input class="form-control mb-3" name="name" type="text" placeholder="Name" required/>
    <input class="form-control mb-3"  name="email" type="email" placeholder="Email Address" required/>
    <input class="form-control mb-3 mobilenumbers" name="phone" type="number" placeholder="Phone Number"/>
    <textarea class="form-control mb-3" name="query" placeholder="What can we help you with?" required>

    </textarea>
    <!-- <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <div class="form-group">
    <div class="g-recaptcha" data-sitekey="6LfKURIUAAAAAO50vlwWZkyK_G2ywqE52NU7YO0S" data-callback="verifyRecaptchaCallback" data-expired-callback="expiredRecaptchaCallback"></div>
    <input class="form-control d-none" data-recaptcha="true" required data-error="Please complete the Captcha">
    <div class="help-block with-errors"></div>
    </div> -->

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <div class="g-recaptcha"  name="g-recaptcha-response" data-sitekey="6LcR8e4mAAAAAHyd5lF2fKn86TvJigAL89VadFcQ"></div>

    <button class="enq_btn" type="submit">
      <i class="fa fa-envelope"></i>
         Inquire
    </button>

  </form>
</div>


      <!-- <a href="<?=base_url(); ?>Home/update_cart/<?=$products->id?>"> -->

        <!-- <button class="mt-3 add-btn">add to Cart</button> -->
      <!-- </a> -->
    <!-- </form> -->

    <!-- </div>
   </div> -->


    <!-- <div class="swiper-button-next" style="top: 50%;"></div>
    <div class="swiper-button-prev" style="top: 50%;"></div> -->
  </div>
  </div>
  <style media="screen">
  .swiper-slide a img.small_mob{
    width: 66.5% !important;
  }
  </style>

  <?if(!empty($more)){?>
  <div class="row " style="margin-top: 2.5rem!important;">
  <div class="col-md-12 txt">
    <h2>More Items to Consider</h2>
    <hr>

  </div>
    <div class="col-md-12">
      <!-- Swiper -->
  <div class=" swiper-container swiper-containernew">
    <div class="swiper-wrapper text-center">

<?php
    foreach($more as $data){
?>

      <div class="swiper-slide" style="margin-top:3rem;">
        <a href="<?=base_url()?>Home/product_detail/<?=$data['sku']?>">
          <?if(!empty($data['FullySetImage1'])){?>
        <img src="<?=$data['FullySetImage1']?>?$xlarge$" class="img-responsive small_mob" style="margin-bottom: 1rem;">
        <?}else{?>
          <img src="<?=$data['gimage1']?>?$xlarge$" class="img-responsive small_mob" style="margin-bottom: 1rem;">
          <?}?>
        <p><?=$data['description']?></p>
        </a>
      </div>

<?php }   ?>

    </div>

    <div class="swiper-button-next"></div>
     <!-- style="top: 50%;" -->
    <div class="swiper-button-prev"></div>
     <!-- style="top: 50%;" -->
  </div>
  </div>
</div>
<?}?>
<?
if(!empty($random)){?>
 <div class="row " style="margin-top: 2.5rem!important;">
  <div class="col-md-12 txt">
    <h2>Suggested for you</h2>
    <hr>

  </div>
    <div class="col-md-12">
     <!-- Swipers -->
  <div class=" swiper-container swiper-containernew">
    <div class="swiper-wrapper text-center">

<?php
      foreach($random as $data){
  ?>

        <div class="swiper-slide" style="margin-top:3rem;">
          <a href="<?=base_url()?>Home/product_detail/<?=$data['sku']?>">
          <?if(!empty($data['FullySetImage1'])){?>
          <img src="<?=$data['FullySetImage1']?>?$xlarge$" class="img-responsive small_mob" style="margin-bottom: 1rem;">
          <?}else{?>
            <img src="<?=$data['gimage1']?>?$xlarge$" class="img-responsive small_mob" style="margin-bottom: 1rem;">
            <?}?>
          <p><?=$data['description']?></p>
          </a>
        </div>

  <?php }  ?>

    </div>

    <div class="swiper-button-next"></div>
     <!-- style="top: 50%;" -->
    <div class="swiper-button-prev"></div>
     <!-- style="top: 50%;" -->
  </div>
  </div>
</div>
<?}?>


<!-- <div class="row">
  <div class="col-md-12 txt">
    <h2>Suggested for you</h2>
    <hr>

  </div>
    <div class="col-md-12">

  <div class=" swiper-container swiper-containernew">
    <div class="swiper-wrapper text-center">
      <div class="swiper-slide">
        <
        <img src="<?=base_url();?>assets/jewel/img/ring1.jpg">
        <p>Straight Baguette Ring</p>
      </div>
      <div class="swiper-slide">
        <img src="<?=base_url();?>assets/jewel/img/ring2.jpg">
        <p>Accented Ring</p>
      </div>
      <div class="swiper-slide">
        <img src="<?=base_url();?>assets/jewel/img/ring3.jpg">
        <p>Line Bracelet</p>
      </div>
      <div class="swiper-slide">
        <img src="<?=base_url();?>assets/jewel/img/ring4.jpg">
        <p>Anniversary Band</p>
      </div>
      <div class="swiper-slide">
        <img src="<?=base_url();?>assets/jewel/img/ring4.jpg">
        <p>Beaded Bezel-Set Solitaire Ring</p>
      </div>
      <div class="swiper-slide">
        <img src="<?=base_url();?>assets/jewel/img/ring1.jpg">
        <p>Anniversary Band</p>
      </div>
      <div class="swiper-slide">
        <img src="<?=base_url();?>assets/jewel/img/ring1.jpg">
        <p>Anniversary Band</p>
      </div>
    </div>

    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </div>
  </div>
</div> -->



<script>
jQuery(document).ready(function () {
  //initialize swiper when document ready
  var mySwiper = new Swiper ('.swiper-containernew', {
  slidesPerView: 5,
  spaceBetween: 10,
  breakpoints: {
    '300': {
      slidesPerView: 1,
      spaceBetween: 10,},
      '400': {
        slidesPerView: 2,
        spaceBetween: 30,},
    '500': {
      slidesPerView: 3,
      spaceBetween: 28,},
      '600': {
        slidesPerView: 4,
        spaceBetween: 40,},
    '767': {
      slidesPerView: 5,
      spaceBetween: 50, },
  },
    // Optional parameters
     freeMode: true,
    loop: true,
    scrollbar: {
        el: '.swiper-scrollbar',
        hide: true,},
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev', },

})

});

// jQuery(".swiper-containernew").on( 'mousemove', function( event ) {{
//
//
//     		var mouse = {
//     			x: 0,
//     		};
//
//     		var containerItems = jQuery('.swiper-containernew').width();
//     		var docWidth = jQuery(".swiper-containernew").width();
//
//     		var docMinWidth = jQuery(".swiper-containernew").width();
//
//     		mouse.x = event.clientX || event.pageX;
//
//     		mouse = mouse.x - 0;
//     		var Translate = mouse * 300 / docWidth;
//
//     		jQuery('.swiper-containernew').css({
//                  '-webkit-transform':'translateX(-'+Translate+'%) translateY(-100%)'
//                 ,'-moz-transform':'translateX(-'+Translate+'%) translateY(-100%)'
//                 ,'transform':'translateX(-'+Translate+'%) translateY(-100%)'
//             });
//
//     	}
//     	});
</script>









<style>
     .txt h2{
       font-size: 18px;
       font-weight: bold;
     }
     .txt td{
       font-size: 14px;
     }
   .txt th td{
     font-size: 14px;
   }
</style>



   <div class="row mt-4">

     <div class="col-md-12 txt" id="specification">
       <h2>Specifications</h2>
       <table class="detailsTable">

            <tbody id="specf"><tr>
                <td>Weight</td>
                <td><?=$products->gramweight?> grams</td>
            </tr>
            <?
            // echo $products->id;die();
            $this->db->select('*');
            $this->db->from('tbl_product_specifications');
            $this->db->where('product_id',$products->id);
            $specs_data= $this->db->get()->row();
            $specs = json_decode($specs_data->specifications);
            // print_r($specs);die();
            if(!empty($specs)){
            foreach($specs as $spd){
            ?>
            <tr>
              <td><? echo $spd->Name?> </td>
              <td><? echo $spd->Value?> </td>
            </tr> <?}}?>
    </tbody></table>
     </div>



   </div>


   <div class="row mt-4">
     <div class="col-md-12 txt">
       <h2>Additional Details</h2>
     </div>
     <div class="col-md-12">

         <ul class="detailsTable newjf">
           <li>We do not normally stock this item.</li>
           <li>Out of Stock and Special Order items will ship when available.</li>
         </ul>

     </div>
   </div>
   <style>
   .comesetwith table td, .comesetwith table th{
     padding: 10px;
   }
   </style>
   <?
   // echo $products->id;die();
   $this->db->select('*');
   $this->db->from('tbl_product_specifications');
   $this->db->where('product_id',$products->id);
   $specs_data= $this->db->get()->row();
   $canbe = json_decode($specs_data->canbesetwith);
   // print_r($canbe[0]);die();
   if(!empty($canbe) || $canbe != ""){
   ?>
   <div class="row mt-4 comesetwith">
     <div class="col-md-12 txt">
       <h2>Can Be Set With</h2>
     </div>
     <div class="col-md-12 txt">
       <table class="table table-bordered">
         <thead>
         <tr style="background-color: #f5f5f5;">
           <th>Quantitity</th>
          <th>Stone</th>
          <th>Size</th>
          <th>Setting Type</th>
         </tr>
       </thead>
       <tbody id="canbe">
         <?foreach($canbe as $SetWith){?>
         <tr>
           <td><?if(!empty($SetWith->Quantity)){echo $SetWith->Quantity;}?> </td>
          <td> <?if(!empty($SetWith->Shape)){echo $SetWith->Shape;}?></td>
          <td> <?if(!empty($SetWith->Size)){echo $SetWith->Size;}?></td>
          <td> <?if(!empty($SetWith->SettingType)){echo $SetWith->SettingType;}?></td>
       </tr>
       <?}?>
     </tbody>
       </table>

     </div>
   </div>
   <?}else{?>
     <table>
       <tbody id="canbe">
       </tbody>
     </table>
     <?}?>

 </div> <!-- Container end -->
</section>


<script language="javascript">
          function changeImage(e) {
              // for(var i=0; i>10; i++){
              //   document.getElementById("change"+i).removeClass("Stone_Shape_img");
              // }
              // document.getElementById("change"+e).addClass("Stone_Shape_img");

              if (document.getElementById("imgClickAndChange").src == "https://www.fineoutput.co.in/ddjewelers/assets/jewel/img/stone_shape/3.png")
              {
                  document.getElementById("imgClickAndChange").src = "https://www.fineoutput.co.in/ddjewelers/assets/jewel/img/stone_shape/1.png";
                  document.getElementById('imgClickAndChange').classList.remove("Stone_Shape_img");
              }
              else
              {
                  document.getElementById("imgClickAndChange").src = "https://www.fineoutput.co.in/ddjewelers/assets/jewel/img/stone_shape/3.png";
                  document.getElementById('imgClickAndChange').classList.add("Stone_Shape_img");
              }


          }
      </script>


<script >

jQuery(document).ready(function () {
  //initialize swiper when document ready
  var mySwiper = new Swiper ('.swiper-containericon', {
  slidesPerView: 6,
  spaceBetween: 10,
  breakpoints: {
    '300': {
      slidesPerView: 3,
      spaceBetween: 30,},
      '400': {
        slidesPerView: 3,
        spaceBetween: 30,},
    '500': {
      slidesPerView: 4,
      spaceBetween: 40,},
      '600': {
        slidesPerView: 4,
        spaceBetween: 40,},
    '767': {
      slidesPerView: 6,
      spaceBetween: 30, },
  },
    // Optional parameters
     freeMode: true,
    loop: false,
    scrollbar: {
        el: '.swiper-scrollbar',
        hide: true,},
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev', },

})

});

// jQuery(".swiper-containernew").on( 'mousemove', function( event ) {{
//
//
//     		var mouse = {
//     			x: 0,
//     		};
//
//     		var containerItems = jQuery('.swiper-containernew').width();
//     		var docWidth = jQuery(".swiper-containernew").width();
//
//     		var docMinWidth = jQuery(".swiper-containernew").width();
//
//     		mouse.x = event.clientX || event.pageX;
//
//     		mouse = mouse.x - 0;
//     		var Translate = mouse * 300 / docWidth;
//
//     		jQuery('.swiper-containernew').css({
//                  '-webkit-transform':'translateX(-'+Translate+'%) translateY(-100%)'
//                 ,'-moz-transform':'translateX(-'+Translate+'%) translateY(-100%)'
//                 ,'transform':'translateX(-'+Translate+'%) translateY(-100%)'
//             });
//
//     	}
//     	});
</script>























<!-- style images -->

<style media="screen">
.carousel-control-prev-icon{
  background-image: url(<?=base_url();?>assets/frontend/icon/left-arrow.png) !important;
}
.carousel-control-next-icon{
  background-image: url(<?=base_url();?>assets/frontend/icon/right-arrow.png) !important;
}
/* Make the image fully responsive */
 .carousel-inner img {
   width: 100%;
   height: 100%;
 }
</style>


  <!-- images model -->

  <!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="padding-left:0px;padding-right:0px;">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="myCarousel" class="carousel slide">

  <!-- Indicators -->
  <!-- <ul class="carousel-indicators">
    <li class="item1 active"></li>
    <li class="item2"></li>
    <li class="item3"></li>
  </ul> -->

  <!-- The slideshow -->
  <div class="carousel-inner">
    <?php if(!empty($products->video) && strpos($products->video, '.mp4') !== false){ ?>
    <div class="carousel-item" id="c_0" style="display: block;">
        <video loop autoplay muted style="width:100%;">
          <source id="c_img0" src="<?=$products->video?>"  type="video/mp4">
        </video>
      </div>
      <!-- </div> -->
    <?php }else{?>
      <div id="c_16" style="display: none;">
          <video loop autoplay muted>
            <source id="c_imgo" src="javascript:void(0)"  type="video/mp4">
          </video>
        </div>
        <?}?>
    <div class="carousel-item" id="c_1">
      <?$c_img1=explode("standard",$products->image1)?>
      <img class="d-block w-100 " id="c_img1"  src="<?=$c_img1[0]?>?xlarge$" alt="First slide">
    </div>
    <div class="carousel-item active" id="c_2">
      <?$c_img2=explode("standard",$products->image2)?>
      <img class="d-block w-100" id="c_img2" src="<?=$c_img2[0]?>?xlarge$" alt="Second slide">
    </div>
    <?if(!empty($products->image3)){?>
    <div class="carousel-item" id="c_3">
      <?$c_img3=explode("standard",$products->image3)?>
      <img class="d-block w-100" id="c_img3" src="<?=$c_img3[0]?>?xlarge$" alt="Third slide">
    </div>
    <?}?>
    <?if(!empty($products->image4)){?>
    <div class="carousel-item" id="c_4">
      <?$c_img4=explode("standard",$products->image4)?>
      <img class="d-block w-100" id="c_img4" src="<?=$c_img4[0]?>?xlarge$" alt="Fourth slide">
    </div>
    <?}?>
    <?if(!empty($products->image5)){?>
    <div class="carousel-item" id="c_5">
      <?$c_img5=explode("standard",$products->image5)?>
      <img class="d-block w-100" id="c_img5" src="<?=$c_img5[0]?>?xlarge$" alt="Fifth slide">
    </div>
    <?}?>
    <?if(!empty($products->image6)){?>
    <div class="carousel-item" id="c_6">
      <?$c_img6=explode("standard",$products->image6)?>
      <img class="d-block w-100" id="c_img6" src="<?=$c_img6[0]?>?xlarge$" alt="Sixth slide">
    </div>
    <?}?>
    <?if(!empty($products->gimage1)){?>
    <div class="carousel-item" id="c_7">
      <?$c_img7=explode("standard",$products->gimage1)?>
      <img class="d-block w-100" id="c_img7" src="<?=$c_img7[0]?>?xlarge$" alt="Sixth slide">
    </div>
    <?}?>
    <?if(!empty($products->gimage2)){?>
    <div class="carousel-item" id="c_8">
      <?$c_img8=explode("standard",$products->gimage2)?>
      <img class="d-block w-100" id="c_img8" src="<?=$c_img8[0]?>?xlarge$" alt="Sixth slide">
    </div>
    <?}?>
    <?if(!empty($products->gimage3)){?>
    <div class="carousel-item" id="c_9">
      <?$c_img9=explode("standard",$products->gimage3)?>
      <img class="d-block w-100" id="c_img9" src="<?=$c_img9[0]?>?xlarge$" alt="Sixth slide">
    </div>
    <?}?>
    <?if(!empty($products->FullySetImage1)){?>
    <div class="carousel-item" id="c_10">
      <?$c_img10=explode("standard",$products->FullySetImage1)?>
      <img class="d-block w-100" id="c_img10" src="<?=$c_img10[0]?>?xlarge$" alt="Sixth slide">
    </div>
    <?}?>
    <?if(!empty($products->FullySetImage2)){?>
    <div class="carousel-item" id="c_11">
      <?$c_img11=explode("standard",$products->FullySetImage2)?>
      <img class="d-block w-100" id="c_img11" src="<?=$c_img11[0]?>?xlarge$" alt="Sixth slide">
    </div>
    <?}?>
    <?if(!empty($products->FullySetImage3)){?>
    <div class="carousel-item" id="c_12">
      <?$c_img12=explode("standard",$products->FullySetImage3)?>
      <img class="d-block w-100" id="c_img12" src="<?=$c_img12[0]?>?xlarge$" alt="Sixth slide">
    </div>
    <?}?>
    <?if(!empty($products->FullySetImage4)){?>
    <div class="carousel-item" id="c_13">
      <?$c_img13=explode("standard",$products->FullySetImage4)?>
      <img class="d-block w-100" id="c_img13" src="<?=$c_img13[0]?>?xlarge$" alt="Sixth slide">
    </div>
    <?}?>
    <?if(!empty($products->FullySetImage5)){?>
    <div class="carousel-item" id="c_14">
      <?$c_img14=explode("standard",$products->FullySetImage5)?>
      <img class="d-block w-100" id="c_img14" src="<?=$c_img14[0]?>?xlarge$" alt="Sixth slide">
    </div>
    <?}?>
    <?if(!empty($products->FullySetImage6)){?>
    <div class="carousel-item" id="c_15">
      <?$c_img15=explode("standard",$products->FullySetImage6)?>
      <img class="d-block w-100" id="c_img15" src="<?=$c_img15[0]?>?xlarge$" alt="Sixth slide">
    </div>
    <?}?>
  </div>

<script>
  function c_show(e){
    for(i=0; i<=16; i++){
      $("#c_"+i).removeClass("active");
    }
    $("#c_"+e).addClass("active");
  }
</script>
  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="javascript:void(0)">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="javascript:void(0)">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>
</div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
  // Activate Carousel with a specified interval
  // $("#myCarousel").carousel({interval: 1000});

  // // Enable Carousel Indicators
  // $(".item1").click(function(){
  //   $("#myCarousel").carousel(0);
  // });
  // $(".item2").click(function(){
  //   $("#myCarousel").carousel(1);
  // });
  // $(".item3").click(function(){
  //   $("#myCarousel").carousel(2);
  // });

  // Enable Carousel Controls
  $(".carousel-control-prev").click(function(){
    $("#myCarousel").carousel("prev");
  });
  $(".carousel-control-next").click(function(){
    $("#myCarousel").carousel("next");
  });
});
</script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function(){
   $("#types").change(function(){
   var vf=$(this).val();
   // var yr = $("#year_id option:selected").val();
   if(vf==""){
     return false;

   }else{
     $('#specify option').remove();
       // var opton="<option value='0'>Please select</option>";
       var opton="<option>Select Specifications</option>";
     $.ajax({
       url:base_url+"Home/getSpecify?isl="+vf,
       data : '',
       type: "get",
       success : function(html){
           if(html!="NA")
           {
             var s = jQuery.parseJSON(html);
             $.each(s, function(i) {

             opton +='<option value="'+s[i]['id']+'">'+s[i]['name']+'</option>';
             });
             $('#specify').append(opton);
             //$('#city').append("<option value=''>Please Select State</option>");

                      //var json = $.parseJSON(html);
                      //var ayy = json[0].name;
                      //var ayys = json[0].pincode;
           }
           else
           {
             alert('No Specifications Found');
             return false;
           }

         }

       })
   }


 })
});
  </script>




  <script>

  function load_type(){

    var load_type_pro_id =  $('#s_typee').val();
    var page =  $('#page_tp').val();
    // var level_id =  $('#level_id').val();
alert(load_type_pro_id);
alert(page);
    if(load_type_pro_id != '' ){

  if(page == 1) {
    window.location.href="<?= base_url()?>QuickShops/quickshops_product_detail/"+btoa(load_type_pro_id);
  }else if (page == 2) {
    window.location.href="<?= base_url()?>Home/new_arrive_product_detail/"+load_type_pro_id;
  }else {
    window.location.href="<?= base_url()?>Home/product_detail/"+load_type_pro_id;
  }



    }else{
      alert("Please Select Series Type.");
    }


  }

  </script>



  <script>
  function pro_change(obj) {
    var icn="";
    var col = $(obj).attr("col");
    // alert(col)
    var pro_sku = $(obj).attr("pro_sku");
    var para = $(obj).attr("para");
    var icn = $(obj).attr("icn");
    if (typeof icn === "undefined"){
      var value = $('#'+col).val();
    }else{
      var value =  $(obj).attr("value");
      // alert(value);
    }
      // var active=$('#active').val();
      //     // var lactive = active.toLowerCase();
      //     var lactive = active.toLowerCase();
      //       var src2=$('#'+lactive).attr("img1");
      // alert(lactive)

      var yuu = $('#thatdropdown').attr('hidden_id')
      var dropdownName = $('#h_'+yuu).val()

    $('#h_'+col).val(value);
    // alert(value);
    // return
    var active=$('#active').val();
    if(value!==active){
    var sku_series = $('#h_sku_series').val();
    var gdesc = $('#gdesc').val();
    var desc_e_value2 = $('#h_desc_e_value2').val();
    var desc_e_value3 = $('#h_desc_e_value3').val();
    var desc_e_value4 = $('#h_desc_e_value4').val();
    var desc_e_value5 = $('#h_desc_e_value5').val();
    var desc_e_value6 = $('#h_desc_e_value6').val();
    var desc_e_value7 = $('#h_desc_e_value7').val();
    var desc_e_value8 = $('#h_desc_e_value8').val();
    var desc_e_value9 = $('#h_desc_e_value9').val();
    var desc_e_value10 = $('#h_desc_e_value10').val();
    var desc_e_value11 = $('#h_desc_e_value11').val();
    var qty = $('#qty').val();
    var active = $('#active').val();
    var stullerProIdExists = $("#addToCartBtn").attr("data-stuller-product-id");
    // alert(sku_series);
    var base_path = "<?=base_url();?>";
    $.ajax({
      url: '<?=base_url();?>Home/quick_pro_change',
      method: 'post',
      data: {
        col: col,
        value: value,
        active: active,
        sku_series: sku_series,
        gdesc: gdesc,
        desc_e_value2: desc_e_value2,
        desc_e_value3: desc_e_value3,
        desc_e_value4: desc_e_value4,
        desc_e_value5: desc_e_value5,
        desc_e_value6: desc_e_value6,
        desc_e_value7: desc_e_value7,
        desc_e_value8: desc_e_value8,
        desc_e_value9: desc_e_value9,
        desc_e_value10: desc_e_value10,
        desc_e_value11: desc_e_value11,
        dropdownName: dropdownName,
        qty: qty,
        para: para,
      },
      dataType: 'json',
      success: function(response) {
        if (response.data == true) {
          // alert(response.update_pro.desc_e_value8);
          $('#h_sku_series').val(response.update_pro.sku_series);
          $('#gdesc').val(response.update_pro.gdesc);
          $('#h_desc_e_value2').val(response.update_pro.desc_e_value2);
          $('#h_desc_e_value3').val(response.update_pro.desc_e_value3);
          $('#h_desc_e_value4').val(response.update_pro.desc_e_value4);
          $('#h_desc_e_value5').val(response.update_pro.desc_e_value5);
          $('#h_desc_e_value6').val(response.update_pro.desc_e_value6);
          $('#h_desc_e_value7').val(response.update_pro.desc_e_value7);
          $('#h_desc_e_value8').val(response.update_pro.desc_e_value8);
          $('#h_desc_e_value9').val(response.update_pro.desc_e_value9);
          $('#h_desc_e_value10').val(response.update_pro.desc_e_value10);
          $('#h_desc_e_value11').val(response.update_pro.desc_e_value11);
          // alert(response.update_pro.weight);
          if((response.update_pro.weight).length!==0){
          var tbl='<tr><td>Weight</td><td>'+ Math.round(response.update_pro.weight) + ' grams</td></tr>';
        }else{
          var tbl ='';
        }
          // var tbl='';
          var Specs = jQuery.parseJSON(''+response.specs+'');
          // alert(Specs);
          $.each(Specs, function(Name, Value){
            if(typeof Value !== "undefined"){
              tbl=tbl+'<tr><td>'+Value.Name+'</td><td>'+Value.Value+'</td></tr>';
        }else{
        } if((response.specs).length == 0){
          document.getElementById("specf").innerHTML = tbl;
        }
        });
        document.getElementById("specf").innerHTML = tbl;

        // alert(response.canbe);
          var canbe = jQuery.parseJSON(''+response.canbe+'');
          var set = '';
          $.each(canbe, function(Key, Values){
            if(typeof Values !== "undefined"){
              set = set+'<tr><td>'+Values.Quantity+'</td><td>'+Values.Shape+'</td><td>'+Values.Size+'</td><td>'+Values.SettingType+'</td></tr>';
        }else{
        } if((response.specs).length == 0){
          document.getElementById("canbe").innerHTML = set;
        }
        });
        document.getElementById("canbe").innerHTML = set;

        // alert(tbl);
// alert(icn);


  if (typeof icn !== "undefined"){
    if(value=="Round"){
    var src=$('#round').attr("img2");
    $("#round").attr("src",src+"?xlarge$");
    var active=$('#active').val();
    // alert(active)
    if(typeof active !== "undefined"){
      var lactive = active.toLowerCase();
        var src2=$('#'+lactive).attr("img1");
        $('#'+lactive).attr("src",src2+"?xlarge$");
        $('#active').val('Round');
    }

  }else if(value=="Cushion"){
    var src=$('#cushion').attr("img2");
    $("#cushion").attr("src",src+"?xlarge$");
    var active=$('#active').val();
    if(typeof active !== "undefined"){
      var lactive = active.toLowerCase();
        var src2=$('#'+lactive).attr("img1");
        $('#'+lactive).attr("src",src2+"?xlarge$");
        $('#active').val('Cushion');

    }

  }else if(value=="Oval"){
    var src=$('#oval').attr("img2");
    $("#oval").attr("src",src+"?xlarge$");
    var active=$('#active').val();
    if(typeof active !== "undefined"){
      var lactive = active.toLowerCase();
        var src2=$('#'+lactive).attr("img1");
        $('#'+lactive).attr("src",src2+"?xlarge$");
          $('#active').val('Oval');
    }

  }else if(value=="Emerald"){
    var src=$('#emerald').attr("img2");
    $("#emerald").attr("src",src+"?xlarge$");
    var active=$('#active').val();
    if(typeof active !== "undefined"){
      var lactive = active.toLowerCase();
        var src2=$('#'+lactive).attr("img1");
        $('#'+lactive).attr("src",src2+"?xlarge$");
          $('#active').val('Emerald');
    }

  }else if(value=="Square"){
    var src=$('#square').attr("img2");
    $("#square").attr("src",src+"?xlarge$");
    var active=$('#active').val();
    if(typeof active !== "undefined"){
      var lactive = active.toLowerCase();
        var src2=$('#'+lactive).attr("img1");
        $('#'+lactive).attr("src",src2+"?xlarge$");
          $('#active').val('Square');
    }

  }else if(value=="Pear"){
    var src=$('#pear').attr("img2");
    $("#pear").attr("src",src+"?xlarge$");
    var active=$('#active').val();
    if(typeof active !== "undefined"){
      var lactive = active.toLowerCase();
        var src2=$('#'+lactive).attr("img1");
        $('#'+lactive).attr("src",src2+"?xlarge$");
          $('#active').val('Pear');
    }

  }else if(value=="Asscher"){
    var src=$('#asscher').attr("img2");
    $("#asscher").attr("src",src+"?xlarge$");
    var active=$('#active').val();
    if(typeof active !== "undefined"){
      var lactive = active.toLowerCase();
        var src2=$('#'+lactive).attr("img1");
        $('#'+lactive).attr("src",src2+"?xlarge$");
          $('#active').val('Asscher');
    }

  }else if(value=="Marquise"){
    var src=$('#marquise').attr("img2");
    $("#marquise").attr("src",src+"?xlarge$");
    var active=$('#active').val();
    if(typeof active !== "undefined"){
      var lactive = active.toLowerCase();
        var src2=$('#'+lactive).attr("img1");
        $('#'+lactive).attr("src",src2+"?xlarge$");
          $('#active').val('Marquise');
    }

  }else if(value=="Heart"){
    var src=$('#heart').attr("img2");
    $("#heart").attr("src",src+"?xlarge$");
    var active=$('#active').val();
    if(typeof active !== "undefined"){
      var lactive = active.toLowerCase();
        var src2=$('#'+lactive).attr("img1");
        $('#'+lactive).attr("src",src2+"?xlarge$");
          $('#active').val('Heart');
    }
  }
  }


// console.log("response"+response.quality.length)

  // alert(response.quality);
  if($("#qualityDropdown").length !== 0){
  if(typeof response.quality !=='undefined' || response.quality.length !==0){
  if(response.quality.length > 50) {
      var quality = jQuery.parseJSON(response.quality);
      var i=0;
      var bq = '';
      $.each(quality, function(i, Value){
        // alert(Value);
        var icon = 'https://www.fineoutput.co.in/ddjewelers/assets/jewel/img/stone_quality/yellow.png';
        if(Value.includes('Rose')==true){
          var icon = 'https://www.fineoutput.co.in/ddjewelers/assets/jewel/img/stone_quality/rose.png';
        }
        if(Value.includes('White')==true){
          var icon = 'https://www.fineoutput.co.in/ddjewelers/assets/jewel/img/stone_quality/white.png';
        }
        if(Value.includes('Yellow')==true){
          var icon = 'https://www.fineoutput.co.in/ddjewelers/assets/jewel/img/stone_quality/yellow.png';
        }
        if(Value=='Platinum'){
          var icon = 'https://www.fineoutput.co.in/ddjewelers/assets/jewel/img/stone_quality/white.png';
        }

        if(Value.includes('Silver')==true){
          var icon="https://www.fineoutput.co.in/ddjewelers/assets/jewel/img/stone_quality/white.png";
        }
        if(Value.includes('Black')==true){
          var icon="https://www.fineoutput.co.in/ddjewelers/assets/jewel/img/stone_quality/black.png";
        }
        if(Value.includes('White/Yellow')==true || Value.includes('Yellow & Platinum')==true){
          var icon="https://www.fineoutput.co.in/ddjewelers/assets/jewel/img/stone_quality/white_yellow.png";
        }
        if(Value.includes('White/Rose')==true){
          var icon="https://www.fineoutput.co.in/ddjewelers/assets/jewel/img/stone_quality/white_rose.png";
        }
        if(Value.includes('Rose/White')==true){
          var icon="https://www.fineoutput.co.in/ddjewelers/assets/jewel/img/stone_quality/rose_white.png";
        }

        bq +='<option class="test" data-thumbnail="'+icon+'" value ="'+Value+'">'+Value+'</option>';
        i++;
      });
      // alert(bq);
      document.getElementById('thatdropdown').innerHTML = bq;
      var langArray = [];
      $('.vodiapicker option').each(function(){
        var img = $(this).attr("data-thumbnail");
        var text = this.innerText;
        var value = $(this).val();
        if(value==response.update_pro.desc_e_value2 || value==response.update_pro.desc_e_value3 || value==response.update_pro.desc_e_value4 || value==response.update_pro.desc_e_value5 || value==response.update_pro.desc_e_value6 || value==response.update_pro.desc_e_value7 || value==response.update_pro.desc_e_value8){
          var top_li = '<i class="fa fa-angle-down" style="position:relative;float:right;margin-top:4px;"></i><li><img src="'+img+'" alt="" value = "'+value+'"/><span>'+ text +'</span></li>';
          // alert(top_li)
          $('.btn-select').html(top_li)
        }
        var item = '<li onclick="change_again(this)"><img src="'+img+'" alt="" value = "'+value+'"/><span>'+ text +'</span></li>';
        langArray.push(item);
      })

      $('#a').html(langArray);

  }else{
  // alert()
  var icon = 'https://www.fineoutput.co.in/ddjewelers/assets/jewel/img/stone_quality/yellow.png';
  if(response.quality.includes('Rose')==true){
    var icon = 'https://www.fineoutput.co.in/ddjewelers/assets/jewel/img/stone_quality/rose.png';
  }
  if(response.quality.includes('White')==true){
    var icon = 'https://www.fineoutput.co.in/ddjewelers/assets/jewel/img/stone_quality/white.png';
  }
  if(response.quality.includes('Yellow')==true){
    var icon = 'https://www.fineoutput.co.in/ddjewelers/assets/jewel/img/stone_quality/yellow.png';
  }
  if(response.quality=='Platinum' || response.quality.includes('Platinum')==true){
    var icon = 'https://www.fineoutput.co.in/ddjewelers/assets/jewel/img/stone_quality/white.png';
  }

  if(response.quality.includes('Silver')==true){
    var icon="https://www.fineoutput.co.in/ddjewelers/assets/jewel/img/stone_quality/white.png";
  }
  if(response.quality.includes('Black')==true){
    var icon="https://www.fineoutput.co.in/ddjewelers/assets/jewel/img/stone_quality/black.png";
  }
  if(response.quality.includes('White/Yellow')==true || response.quality.includes('Yellow & Platinum')==true){
    var icon="https://www.fineoutput.co.in/ddjewelers/assets/jewel/img/stone_quality/white_yellow.png";
  }
  if(response.quality.includes('White/Rose')==true){
    var icon="https://www.fineoutput.co.in/ddjewelers/assets/jewel/img/stone_quality/white_rose.png";
  }
  if(response.quality.includes('Rose/White')==true){
    var icon="https://www.fineoutput.co.in/ddjewelers/assets/jewel/img/stone_quality/rose_white.png";
  }

  if(response.quality.includes('{')==true){
    var quality = jQuery.parseJSON(response.quality);
    $.each(quality, function(i, Value){
      if (i==0) {
        document.getElementById('qualityDropdown').innerHTML = '<i class="fa fa-angle-down" style="position:relative;float:right;margin-top:4px;"></i><li><img src="'+icon+'" alt /><span>'+Value+'</span></li>';
        // console.log(quality)
      }
      else {
        document.getElementById('qualityDropdown').innerHTML = '<i class="fa fa-angle-down" style="position:relative;float:right;margin-top:4px;"></i><li><img src="'+icon+'" alt /><span>'+Value+'</span></li>';
        // console.log(quality)
      }

  i++
  });
  }else{
    document.getElementById('qualityDropdown').innerHTML = '<i class="fa fa-angle-down" style="position:relative;float:right;margin-top:4px;"></i><li><img src="'+icon+'" alt /><span>'+response.quality+'</span></li>';
  }

}
}
}
            if($("#desc_e_value2").length == 0) {
              if(response.b2.length < 70){
            $('#p_desc_e_value2').html(response.update_pro.desc_e_value2);
          }else{
            var b1 = jQuery.parseJSON(response.b1);
            // alert(b1);
            var i=0;
            var b11 = '';
            $.each(b1, function(i, Value){
              // alert(Value);
              b11 +='<option value"'+Value+'">'+Value+'</option>';
              i++;
            });
            document.getElementById("div_desc_e_value2").innerHTML = '<p id="b3"><b>'+response.update_pro.desc_e_name2+'</b></p>'+
          '<select id="desc_e_value2" para="0" col="desc_e_value2" required pro_sku="'+response.update_pro.sku_series+'" onchange="pro_change(this)">'+b11+'</select>';
          $('#desc_e_value2').addClass('w-100')
          }
            }else{
              if(response.changeThem==1 && response.b1!=""){
                var b1 = jQuery.parseJSON(response.b1);
                // alert(b1);
                var i=0;
                var b11 = '';
                $.each(b1, function(i, Value){
                  // alert(Value);
                  b11 +='<option value"'+Value+'">'+Value+'</option>';
                  i++;
                });
                document.getElementById("desc_e_value2").innerHTML = b11;
                $('#desc_e_value2').val(response.update_pro.desc_e_value2);
              }else{
                document.querySelector('#desc_e_value2').value = response.update_pro.desc_e_value2;
              }
       }

            if($("#desc_e_value3").length == 0) {
              if(response.b2.length < 70){
            $('#p_desc_e_value3').html(response.update_pro.desc_e_value3);
          }else{
            var b2 = jQuery.parseJSON(response.b2);
            var i=0;
            var b12 = '';
            $.each(b2, function(i, Value){
              // alert(Value);
              b12 +='<option value"'+Value+'">'+Value+'</option>';
              i++;
            });
            document.getElementById("div_desc_e_value3").innerHTML = '<p id="b3"><b>'+response.update_pro.desc_e_name3+'</b></p>'+
            '<select id="desc_e_value3" para="0" col="desc_e_value3" required pro_sku="'+response.update_pro.sku_series+'" onchange="pro_change(this)">'+b12+'</select>';
            $('#desc_e_value3').addClass('w-100')
          }
            }else{
              if(response.changeThem==1 && response.b2!=""){
                var b2 = jQuery.parseJSON(response.b2);
                var i=0;
                var b12 = '';
                $.each(b2, function(i, Value){
                  // alert(Value);
                  b12 +='<option value"'+Value+'">'+Value+'</option>';
                  i++;
                });
                document.getElementById("desc_e_value3").innerHTML = b12;
                $('#desc_e_value3').val(response.update_pro.desc_e_value3);

              }else{
                document.querySelector('#desc_e_value3').value = response.update_pro.desc_e_value3;

              }
            }

          if($("#desc_e_value4").length == 0) {
            if(response.b3.length < 70){
          $('#p_desc_e_value4').html(response.update_pro.desc_e_value4);
        }else{
          var b3 = jQuery.parseJSON(response.b3);
          var i=0;
          var b13 = '';
          $.each(b3, function(i, Value){
            // alert(Value);
            b13 +='<option value"'+Value+'">'+Value+'</option>';
            i++;
          });
          document.getElementById("div_desc_e_value4").innerHTML = '<p id="b3"><b>'+response.update_pro.desc_e_name4+'</b></p>'+
          '<select id="desc_e_value4" para="0" col="desc_e_value4" required pro_sku="'+response.update_pro.sku_series+'" onchange="pro_change(this)">'+b13+'</select>';
          $('#desc_e_value4').addClass('w-100')
        }
          }else{
            if(response.changeThem==1 && response.b3!=""){
              var b3 = jQuery.parseJSON(response.b3);
              var i=0;
              var b13 = '';
              $.each(b3, function(i, Value){
                // alert(Value);
                b13 +='<option value"'+Value+'">'+Value+'</option>';
                i++;
              });
              document.getElementById("desc_e_value4").innerHTML = b13;
              $('#desc_e_value4').val(response.update_pro.desc_e_value4);
            }else{
              document.querySelector('#desc_e_value4').value = response.update_pro.desc_e_value4;
            }
            }

         if($("#desc_e_value5").length == 0) {
           if(response.b4.length < 70){
           $('#p_desc_e_value5').html(response.update_pro.desc_e_value5);
         }else{
           var b4 = jQuery.parseJSON(response.b4);
           var i=0;
           var b14 = '';
           $.each(b4, function(i, Value){
             // alert(Value);
             b14 +='<option value"'+Value+'">'+Value+'</option>';
             i++;
           });
           document.getElementById("div_desc_e_value5").innerHTML = '<p id="b3"><b>'+response.update_pro.desc_e_name5+'</b></p>'+
           '<select id="desc_e_value5" para="0" col="desc_e_value5" required pro_sku="'+response.update_pro.sku_series+'" onchange="pro_change(this)">'+b14+'</select>';
           $('#desc_e_value5').addClass('w-100')
         }
         }else{
           if(response.changeThem==1 && response.b4!=""){
                var b4 = jQuery.parseJSON(response.b4);
                var i=0;
                var b14 = '';
                $.each(b4, function(i, Value){
                  // alert(Value);
                  b14 +='<option value"'+Value+'">'+Value+'</option>';
                  i++;
                });
                document.getElementById("desc_e_value5").innerHTML = b14;
                $('#desc_e_value5').val(response.update_pro.desc_e_value5);

              }else{
                document.querySelector('#desc_e_value5').value = response.update_pro.desc_e_value5;
              }
       }

         if($("#desc_e_value6").length == 0) {
           // alert()
           $('#p_desc_e_value6').html(response.update_pro.desc_e_value6);
         }else{
           if(response.changeThem==1 && response.b5!=""){
              var b5 = jQuery.parseJSON(response.b5);
              var i=0;
              var b15 = '';
              $.each(b5, function(i, Value){
                // alert(Value);
                b15 +='<option value"'+Value+'">'+Value+'</option>';
                i++;
              });
              document.getElementById("desc_e_value6").innerHTML = b15;
              $('#desc_e_value6').val(response.update_pro.desc_e_value6);
            }else{
              document.querySelector('#desc_e_value6').value = response.update_pro.desc_e_value6;
            }
              }

         if($("#desc_e_value7").length == 0) {
           $('#p_desc_e_value7').html(response.update_pro.desc_e_value7);
         }else{
           if(response.changeThem==1 && response.b6!=""){
                var b6 = jQuery.parseJSON(response.b6);
                var i=0;
                var b16 = '';
                $.each(b6, function(i, Value){
                  // alert(Value);
                  b16 +='<option value"'+Value+'">'+Value+'</option>';
                  i++;
                });
                document.getElementById("desc_e_value7").innerHTML = b16;
                $('#desc_e_value7').val(response.update_pro.desc_e_value7);
              }
                  }

         if($("#desc_e_value8").length == 0) {
           $('#p_desc_e_value8').html(response.update_pro.desc_e_value8);
         }else{
           if(response.changeThem==1 && response.b7!=""){
           var b7 = jQuery.parseJSON(response.b7);
           var i=0;
           var b17 = '';
           $.each(b7, function(i, Value){
             // alert(Value);
             b17 +='<option value"'+Value+'">'+Value+'</option>';
             i++;
           });
           document.getElementById("desc_e_value8").innerHTML = b17;
           $('#desc_e_value8').val(response.update_pro.desc_e_value8);

         }
                  }

         if($("#desc_e_value9").length == 0) {
           $('#p_desc_e_value9').html(response.update_pro.desc_e_value9);
         }else{
           if(response.changeThem==1 && response.b8!=""){
           var b8 = jQuery.parseJSON(response.b8);
               var i=0;
               var b18 = '';
               $.each(b8, function(i, Value){
                 // alert(Value);
                 b18 +='<option value"'+Value+'">'+Value+'</option>';
                 i++;
               });
               document.getElementById("desc_e_value9").innerHTML = b18;
               $('#desc_e_value9').val(response.update_pro.desc_e_value9);

             }
         }

         if($("#desc_e_value10").length == 0) {
           $('#p_desc_e_value10').html(response.update_pro.desc_e_value10);
         }else{
           if(response.changeThem==1 && response.b9!=""){
           var b9 = jQuery.parseJSON(response.b9);
              var i=0;
              var b19 = '';
              $.each(b9, function(i, Value){
                // alert(Value);
                b19 +='<option value"'+Value+'">'+Value+'</option>';
                i++;
              });
              document.getElementById("desc_e_value10").innerHTML = b19;
              $('#desc_e_value10').val(response.update_pro.desc_e_value10);

            }
         }

         if($("#desc_e_value11").length == 0) {
           $('#p_desc_e_value11').html(response.update_pro.desc_e_value11);
         }else{
           if(response.changeThem==1 && response.b10!=""){
           var b10 = jQuery.parseJSON(response.b10);
              var i=0;
              var b110 = '';
              $.each(b10, function(i, Value){
                // alert(Value);
                b110 +='<option value"'+Value+'">'+Value+'</option>';
                i++;
              });
              document.getElementById("desc_e_value11").innerHTML = b110;
              $('#desc_e_value11').val(response.update_pro.desc_e_value11);

            }
         }

 //--------document.querySelector('#desc_e_value11').value = response.update_pro.desc_e_value11;

 //--------------------ring size dropdown replace------------------------
 // alert(response.RingSize)
 if(response.RingSize=='""' || response.RingSize==null){
   $("#ringsizeDiv").css('display', 'none');
   $("#ringsizeDiv").removeClass('d-flex');
   $("#ringsize").html('')
 }else{
   $("#ringsizeDiv").css('display', 'block')
   $("#ringsizeDiv").addClass('d-flex')
   var RingSize = jQuery.parseJSON(response.RingSize);
   var i=0;
   var ringdropdown = '';
   $.each(RingSize, function(i, Value){
     // alert(Value);
     ringdropdown +='<option value"'+Value.Price+'">'+Value.Size+'</option>';
     i++;
   });
   document.getElementById("ringsize").innerHTML = ringdropdown;
   $('#ringsize').val('7.00');
 }


 var descriptionFor = response.update_pro.description;
         // alert(descriptionFor);
          $('#pid').val(response.update_pro.id);
          $('#s_title').html(response.update_pro.description);
          $('#p_title').html(response.update_pro.description);
          if(descriptionFor.includes('Forever')){
            $('#foreverContent').css('display', 'block')
            $('#palladiumContent').css('display', 'none')
            $('#platinumContent').css('display', 'none')
            $('#continuumContent').css('display', 'none')
          }else if(descriptionFor.includes('Palladium')){
            $('#foreverContent').css('display', 'none')
            $('#palladiumContent').css('display', 'block')
            $('#platinumContent').css('display', 'none')
            $('#continuumContent').css('display', 'none')
          }else if(descriptionFor.includes('Platinum')){
            $('#foreverContent').css('display', 'none')
            $('#palladiumContent').css('display', 'none')
            $('#platinumContent').css('display', 'block')
            $('#continuumContent').css('display', 'none')
          }else if(descriptionFor.includes('Continuum')){
            $('#foreverContent').css('display', 'none')
            $('#palladiumContent').css('display', 'none')
            $('#platinumContent').css('display', 'none')
            $('#continuumContent').css('display', 'block')
          }else{
            $('#foreverContent').css('display', 'none')
            $('#palladiumContent').css('display', 'none')
            $('#platinumContent').css('display', 'none')
            $('#continuumContent').css('display', 'none')
          }
          $('#p_des').html(response.update_pro.description);
          $('#p_sku').html("SLR-"+response.update_pro.sku);
          $('#p_status').html(response.update_pro.status);
          $('#p_type').html(response.update_pro.product_type);
          if (typeof response.update_pro.dclarity === "undefined" && typeof response.update_pro.dcolor === "undefined") {
          $('#p_clarity').html("");
        }else{
          $('#p_clarity').html(response.update_pro.dclarity+"/"+response.update_pro.dcolor);
        }
          $('#p_state').html(response.update_pro.status);
          $('#p_sdesc').html(response.update_pro.sdesc);

          if (typeof response.retail === "undefined") {
            $('#price_div').html('<a href="<?=base_url(); ?>Home/contact_us"> <p>CONTACT US FOR PRICE AVAILABILITY </p></a>');
          }else{
          $('#p_retail').html("Retail Price: $"+(response.retail).toLocaleString("en-US"));
          if(response.saved>0){
          $('#p_saved').html("You Saved: $"+(response.saved).toLocaleString("en-US")+"("+response.dis+"%)");
        }else{
          $('#p_saved').html("");
        }

          $('#p_price').html("Now: $"+(response.price).toLocaleString("en-US"));
        }

        if (typeof response.update_pro.video === "undefined" || response.update_pro.video === "") {
          $("#vid_div").css("display","none");
          $("#vid_div2").css("display","none");
        }else{
          // if(response.update_pro.video.includes('.mp4'))){
          if(response.update_pro.video.includes(".mp4")){
            $("#vid_div").css("display","block");
            $("#vid_div2").css("display","block");
           if($("#vid-1").length == 0) {
             // $("#vid_div2").css("display","block");
            document.getElementById("vid_div2").innerHTML = '  <a href="javascript:void(0)" role="btn" data-toggle="modal" data-target="#exampleModalCenter" ><video autoplay loop muted class="v_style"><source id="vid-2" src="'+response.update_pro.video+'"  type="video/mp4"></video></a>';
        }else{
        document.getElementById("vid_div").innerHTML = '  <a href="javascript:void(0)" role="btn" data-toggle="modal" data-target="#exampleModalCenter" ><video autoplay loop muted class="v_style"><source id="vid-1" src="'+response.update_pro.video+'"  type="video/mp4"></video></a>';
        // alert(response.update_pro.video);
        // $("#vid-1").attr("src", response.update_pro.video);

        }
      }else{
        $("#vid_div").css("display","none");
        $("#vid_div2").css("display","none");
      }
        }
        // alert(response.update_pro.video);
        if(typeof response.update_pro.video === "undefined" || response.update_pro.video === ""){
          $("#t_vid_div").css("display","none");
          $("#t_vid_div2").css("display","none");
        }else{
          // if(response.update_pro.video.includes('.mp4'))){
          if(response.update_pro.video.includes(".mp4")){
            $("#t_vid_div").css("display","block");
            $("#t_vid_div").addClass("swiper-slide");
            $("#t_vid_div2").addClass("swiper-slide");
            $("#t_vid_div2").css("display","block");
           if($("#t_vid-1").length == 0) {
             // $("#vid-2").attr("src",response.update_pro.video);
             // $("#t_vid_div2").css("display","block");
            document.getElementById("t_vid_div2").innerHTML = '<video width="133" height="133"  loop paused muted><source id="t_vid-2" src="'+response.update_pro.video+'" type="video/mp4"></video>';
        }else{
        document.getElementById("t_vid_div").innerHTML = '<video width="133" height="133"  loop paused muted><source id="t_vid-1" src="'+response.update_pro.video+'"  type="video/mp4"></video>';
        }
      }else{
        $("#t_vid_div").css("display","none");
        $("#t_vid_div").removeClass("swiper-slide");
        $("#t_vid_div2").removeClass("swiper-slide");
        $("#t_vid_div2").css("display","none");
      }
        }
          //==============Slider image update=======================
            if(response.update_pro.video.includes(".mp4")){
              $("#c_0").css("display","block");
              $("#c_0").addClass("carousel-item");
              $("#c_16").css("display","block");
              $("#c_16").addClass("carousel-item");
            // alert(response.update_pro.video);
            if($("#c_img0").length == 0) {
            document.getElementById("c_16").innerHTML = '<video loop autoplay muted><source id="c_imgo" src="'+response.update_pro.video+'"  type="video/mp4"></video>';
          }else{
              document.getElementById("c_0").innerHTML = '<video loop autoplay muted><source id="c_img0" src="'+response.update_pro.video+'"  type="video/mp4"></video>';
            }
          }else{
            $("#c_0").removeClass("carousel-item");
            $("#c_0").css("display","none");
            $("#c_16").removeClass("carousel-item");
            $("#c_16").css("display","none");
          }
          $("#img-1").attr("src",response.update_pro.image1+"?$xlarge$");
          var img_1 = response.update_pro.image1.split("standard");
          $("#c_img1").attr("src",img_1+"?xlarge$");

          $("#img-2").attr("src",response.update_pro.image2+"?$xlarge$");
          var img_2 = response.update_pro.image2.split("standard");
          $("#c_img2").attr("src",img_2+"?xlarge$");
          $("#img-3").attr("src",response.update_pro.image3+"?$xlarge$");
          var img_3 = response.update_pro.image3.split("standard");
          $("#c_img3").attr("src",img_3+"?xlarge$");
          $("#img-4").attr("src",response.update_pro.image4+"?$xlarge$");
          var img_4 = response.update_pro.image4.split("standard");
          $("#c_img4").attr("src",img_4+"?xlarge$");
          $("#img-5").attr("src",response.update_pro.image5+"?$xlarge$");
          var img_5 = response.update_pro.image5.split("standard");
          $("#c_img5").attr("src",img_5+"?xlarge$");
          if(response.update_pro.image6.lenth!==0){
            $("#img-9").css("display", "block");
            $("#c_img9").css("display", "block");
          $("#img-6").attr("src",response.update_pro.image6+"?$xlarge$");
          var img_6 = response.update_pro.image6.split("standard");
          $("#c_img6").attr("src",img_6+"?xlarge$");
        }else{
          $("#img-6").css("display", "none");
          $("#c_img6").css("display", "none");
        }
          $("#img-7").attr("src",response.update_pro.gimage1+"?$xlarge$");
          var img_7 = response.update_pro.gimage1.split("standard");
          $("#c_img7").attr("src",img_7+"?xlarge$");
          // alert(response.update_pro.gimage2);
          $("#img-8").attr("src",response.update_pro.gimage2+"?$xlarge$");
          var img_8 = response.update_pro.gimage2.split("standard");
          $("#c_img8").attr("src",img_8+"?xlarge$");
          if(response.update_pro.gimage3.length!==0){
            $("#img-9").css("display", "block");
            $("#c_img9").css("display", "block");
          $("#img-9").attr("src",response.update_pro.gimage3+"?$xlarge$");
          var img_9 = response.update_pro.gimage3.split("standard");
          $("#c_img9").attr("src",img_9+"?xlarge$");
        }else{
          $("#img-9").css("display", "none");
          $("#c_img9").css("display", "none");
        }
// alert(dropdownName)

          $("#img-10").attr("src",response.update_pro.FullySetImage1+"?$xlarge$");
          var img_10 = response.update_pro.FullySetImage1.split("standard");
          $("#c_img10").attr("src",img_10+"?xlarge$");
          $("#img-11").attr("src",response.update_pro.FullySetImage2+"?$xlarge$");
          var img_11 = response.update_pro.FullySetImage2.split("standard");
          $("#c_img11").attr("src",img_11+"?xlarge$");
          $("#img-12").attr("src",response.update_pro.FullySetImage3+"?$xlarge$");
          var img_12 = response.update_pro.FullySetImage3.split("standard");
          $("#c_img12").attr("src",img_12+"?xlarge$");
          $("#img-13").attr("src",response.update_pro.FullySetImage4+"?$xlarge$");
          var img_13 = response.update_pro.FullySetImage4.split("standard");
          $("#c_img13").attr("src",img_13+"?xlarge$");
          $("#img-14").attr("src",response.update_pro.FullySetImage5+"?$xlarge$");
          var img_14 = response.update_pro.FullySetImage5.split("standard");
          $("#c_img14").attr("src",img_14+"?xlarge$");
          $("#img-15").attr("src",response.update_pro.FullySetImage6+"?$xlarge$");
          var img_15 = response.update_pro.FullySetImage6.split("standard");
          $("#c_img15").attr("src",img_15+"?xlarge$");



          $("#t_img-1").attr("src",response.update_pro.image1+"?$xlarge$");
          $("#t_img-2").attr("src",response.update_pro.image2+"?$xlarge$");
          $("#t_img-3").attr("src",response.update_pro.image3+"?$xlarge$");
          $("#t_img-4").attr("src",response.update_pro.image4+"?$xlarge$");
          $("#t_img-5").attr("src",response.update_pro.image5+"?$xlarge$");
          if(response.update_pro.image6.length!==0){
            $("#t_img-6").css("display", "block");
          $("#t_img-6").attr("src",response.update_pro.image6+"?$xlarge$");
        }else{
          $("#t_img-6").css("display", "none");
        }
          $("#t_img-7").attr("src",response.update_pro.gimage1+"?$xlarge$");
          $("#t_img-8").attr("src",response.update_pro.gimage2+"?$xlarge$");
          if(response.update_pro.gimage3.length!==0){
            $("#t_img-9").css("display", "block");
          $("#t_img-9").attr("src",response.update_pro.gimage3+"?$xlarge$");
        }else{
          $("#t_img-9").css("display", "none");
        }
          $("#t_img-10").attr("src",response.update_pro.FullySetImage1+"?$xlarge$");
          $("#t_img-11").attr("src",response.update_pro.FullySetImage2+"?$xlarge$");
          $("#t_img-12").attr("src",response.update_pro.FullySetImage3+"?$xlarge$");
          $("#t_img-13").attr("src",response.update_pro.FullySetImage4+"?$xlarge$");
          $("#t_img-14").attr("src",response.update_pro.FullySetImage5+"?$xlarge$");
          $("#t_img-15").attr("src",response.update_pro.FullySetImage6+"?$xlarge$");

          // add to cart button attributes change-----------
          $("#addToCartBtn").attr("data-product-id", response.update_pro.id);
          $("#addToCartBtn").attr("data-category-id", response.update_pro.category);
          if(stullerProIdExists == ""){
            $("#addToCartBtn").attr("data-stuller-product-id", '');
          }else{
            $("#addToCartBtn").attr("data-stuller-product-id", response.update_pro.product_id);
          }

          // add to wishlist button attributes change-----------
          $("#addToWishlistBtn").attr("data-product-id", response.update_pro.id);
          $("#addToWishlistBtn").attr("data-category-id", response.update_pro.category);
          if(stullerProIdExists == ""){
            $("#addToWishlistBtn").attr("data-stuller-product-id", '');
          }else{
            $("#addToWishlistBtn").attr("data-stuller-product-id", response.update_pro.product_id);
          }


        } else if (response.data == false) {

        }
      }
    });
  }
  }

  //==========Loader==================================================

  </script>

  <script>
    function addRingSizePrice(obj){
        var ringsizePrice = $(obj).val()
        var option = $('option:selected', obj).attr('size');
        var pid= $('#pid').val();
        var qty= $('#qty').val();
        $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>Home/price_change",
        method: 'post',
        data: {
          pid: pid,
          qty: qty,
          ringsizeprice: ringsizePrice,
        },
        dataType: 'json',
        success: function(response) {
          if (response.data == true) {
                   if (typeof response.retail === "undefined") {
                     $('#price_div').html('<a href="<?=base_url(); ?>Home/contact_us"> <p>CONTACT US FOR PRICE AVAILABILITY </p></a>');
                   }else{
                   $('#p_retail').html("Retail Price: $"+(response.retail).toLocaleString("en-US"));
                   if(response.saved>0){
                   $('#p_saved').html("You Saved: $"+(response.saved).toLocaleString("en-US")+"("+response.dis+"%)");
                 }else{
                   $('#p_saved').html("");
                 }

                   $('#p_price').html("Now: $"+(response.price).toLocaleString("en-US"));
                   $('#ringsizeprice').val(ringsizePrice)
                   $('#addToCartBtn').attr('data-ringsize', option)
                   $('#addToCartBtn').attr('data-ringprice', ringsizePrice)
                   $('#addToCartBtn').attr('data-ringsize', option)
                   $('#addToWishlistBtn').attr('data-ringprice', ringsizePrice)
                   $('#addToWishlistBtn').attr('data-ringsize', option)
                 }
              }


        }
        });

    }
  </script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

      <script>
      // Get the modal
      var modal = document.getElementById("myModal");

      // Get the button that opens the modal
      var btn = document.getElementById("myBtn");

      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("closeclose")[0];

      // When the user clicks the button, open the modal
      btn.onclick = function() {
        modal.style.display = "block";
      }

      // When the user clicks on <span> (x), close the modal
      span.onclick = function() {
        modal.style.display = "none";
      }

      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      }
      </script>
  <!-- product details start -->
  <section>
  <script>
  /*
  * @Adilade Input Quantity Increment
  *
  */

  var input = document.querySelector('#qty');
  var btnminus = document.querySelector('.qtyminus');
  var btnplus = document.querySelector('.qtyplus');

  if (input !== undefined && btnminus !== undefined && btnplus !== undefined && input !== null && btnminus !== null && btnplus !== null) {

  var min = Number(input.getAttribute('min'));
  var max = Number(input.getAttribute('max'));
  var step = Number(input.getAttribute('step'));

  function qtyminus(e) {
    var current = Number(input.value);
    var newval = (current - step);
    // alert(newval)
    if(newval < min) {
      newval = min;
      input.value = Number(newval);
      e.preventDefault();
    } else if(newval > max) {
      newval = max;
      input.value = Number(newval);
      e.preventDefault();
    }else{
      var pid= $('#pid').val();
      var ringsizeprice= $('#ringsizeprice').val();
      $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>Home/price_change",
      method: 'post',
      data: {
        pid: pid,
        qty: newval,
        ringsizeprice: ringsizeprice,
      },
      dataType: 'json',
      success: function(response) {
        if (response.data == true) {
                 if (typeof response.retail === "undefined") {
                   $('#price_div').html('<a href="<?=base_url(); ?>Home/contact_us"> <p>CONTACT US FOR PRICE AVAILABILITY </p></a>');
                 }else{
                 $('#p_retail').html("Retail Price: $"+(response.retail).toLocaleString("en-US"));
                 if(response.saved>0){
                 $('#p_saved').html("You Saved: $"+(response.saved).toLocaleString("en-US")+"("+response.dis+"%)");
               }else{
                 $('#p_saved').html("");
               }

                 $('#p_price').html("Now: $"+(response.price).toLocaleString("en-US"));
               }
                 input.value = Number(newval);
                 $("#qty").val(newval)
                 e.preventDefault();
            }


      }
      });

    }

  }

  function qtyplus(e) {
    var current = Number(input.value);
    var newval = (current + step);
    if(newval > max) newval = max;
    var pid= $('#pid').val();
    var ringsizeprice= $('#ringsizeprice').val();
    // alert(pid);

    $.ajax({
    type: "POST",
    url: "<?php echo base_url(); ?>Home/price_change",
    method: 'post',
    data: {
      pid: pid,
      qty: newval,
      ringsizeprice: ringsizeprice,
    },
    dataType: 'json',
    success: function(response) {
      if (response.data == true) {
               if (typeof response.retail === "undefined") {
                 $('#price_div').html('<a href="<?=base_url(); ?>Home/contact_us"> <p>CONTACT US FOR PRICE AVAILABILITY </p></a>');
               }else{
               $('#p_retail').html("Retail Price: $"+(response.retail).toLocaleString("en-US"));
               if(response.saved>0){
               $('#p_saved').html("You Saved: $"+(response.saved).toLocaleString("en-US")+"("+response.dis+"%)");
             }else{
               $('#p_saved').html("");
             }

               $('#p_price').html("Now: $"+(response.price).toLocaleString("en-US"));
             }
             input.value = Number(newval);
             $("#qty").val(newval)

             e.preventDefault();
          }


    }
    });

  }

  btnminus.addEventListener('click', qtyminus);
  btnplus.addEventListener('click', qtyplus);

  } // End if test
  </script>

  <script>

var langArray = [];
$('.vodiapicker option').each(function(){
  var img = $(this).attr("data-thumbnail");
  var text = this.innerText;
  var value = $(this).val();
  var item = '<li><img src="'+ img +'" alt="" value="'+value+'"/><span>'+ text +'</span></li>';
  langArray.push(item);
})

$('#a').html(langArray);

//Set the button value to the first el of the array
// $('.btn-select').html(langArray[0]);
// $('.btn-select').attr('value', 'en');

function change_again(obj){
  var img = $(obj).find('img').attr("src");
  var value = $(obj).find('img').attr('value');
  var text = obj.innerText;
  var item = '<li><img src="'+ img +'" alt="" /><span>'+ text +'</span></li>';
 $('.btn-select').html(item);
 // $('.vodiapicker').val(text)
 hidden_id = $('.vodiapicker').attr('hidden_id');
 $('#'+hidden_id).val(text);
 var col_name = $('#'+hidden_id).attr('name');
 var hidden = "#h_"+col_name;
 // alert(hidden)
 // $(hidden).val(text)

 // alert(text);
 // alert(quality);
 $(".b").toggle();
 var quality_obj = $('#'+hidden_id);
 var [node] = $('#'+hidden_id);
 var attrs = {}
 $.each(node.attributes, (index, attribute) => {
     attrs[attribute.name] = attribute.value;
 });
 // console.log(attrs)
 // console.log(quality_obj.value);
 setTimeout(pro_change(attrs), 800);
 // console.log(value);

}
//change button stuff on click
$('#a li').click(function(){
   var img = $(this).find('img').attr("src");
   var value = $(this).find('img').attr('value');
   var text = this.innerText;
   var item = '<li><img src="'+ img +'" alt="" /><span>'+ text +'</span></li>';
  $('.btn-select').html(item);
  // $('.vodiapicker').val(text)
  hidden_id = $('.vodiapicker').attr('hidden_id');
  $('#'+hidden_id).val(text);
  var col_name = $('#'+hidden_id).attr('name');
  var hidden = "#h_"+col_name;
  // alert(hidden)
  // $(hidden).val(text)

  // alert(text);
  // alert(quality);
  $(".b").toggle();
  var quality_obj = $('#'+hidden_id);
  var [node] = $('#'+hidden_id);
  var attrs = {}
  $.each(node.attributes, (index, attribute) => {
      attrs[attribute.name] = attribute.value;
  });
  // console.log(attrs)
  // console.log(quality_obj.value);
  setTimeout(pro_change(attrs), 1000);
  // console.log(value);
});

$(".btn-select").click(function(){
        $(".b").toggle();
    });

    // When the user clicks anywhere outside of the modal, close it
    $(document).click(function() {
        var container = $(".b");
        var button = $(".btn-select")
        if (!container.is(event.target) && !container.has(event.target).length && !button.is(event.target) && !button.has(event.target).length) {
            container.hide();
        }
    });

//check local storage for the lang
var sessionLang = localStorage.getItem('lang');
if (sessionLang){
  //find an item with value of sessionLang
  var langIndex = langArray.indexOf(sessionLang);
  $('.btn-select').html(langArray[langIndex]);
  $('.btn-select').attr('value', sessionLang);
} else {
   var langIndex = langArray.indexOf('ch');
  // console.log(langIndex);
  $('.btn-select').html(langArray[langIndex]);
  //$('.btn-select').attr('value', 'en');
}

  </script>

  <!-- product details end -->
