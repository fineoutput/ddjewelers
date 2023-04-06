
<!-- <style>
@import url('https://fonts.googleapis.com/css2?family=Crimson+Pro:wght@500&family=Lato:ital,wght@0,300;1,100;1,300&family=Lora&display=swap');


/* .container{width:1140px;margin: auto;} */
.d-flex{display: flex;}
.sb{justify-content: space-between;}
.hh i{padding-right: 10px;}

.left{width:30%;}
.center{width: 30%;}
.right{width: 40%;padding: 120px 0px 0px 30px;}
.mnb{padding-top: 40px;}
.hhg h2{padding-left:30px;padding-top: inherit;padding-top: 27px;font-size: 16px;color: #993333;}
.hhgg h2{padding-left:30px;padding-top: inherit;padding-top: 34px;font-size: 16px;color: #993333;margin-bottom: 20px;}
.left a{text-decoration: none;color: #ffff;background:#333366 ;padding: 10px;margin-left:40px; }
.ii img{width:80%;}
.ii{text-align: center;}
 .ii h4 {color: #666666;margin-top:inherit;}
 .ghf{text-align: center;}
 .ghf p{font-size:12px; }
.ghff i{font-size: 30px;margin-top:60px;}
.ppp {border:solid 1px #999999;}
.ppp p{padding-left: 20px;}
.ppp a{text-decoration: none;color: #ffff;background:#333366 ;padding: 10px 8px;margin-left: 307px;}
.text-center{text-align: center;}
.vcb h2{font-size: inherit;font-size: 40px;}
/* .imgg{width: 50%;} */
.imgg img{width: 100%;}
.content{width: 50%;}
.aqpp{margin-bottom: 40px;}
.fgt a{text-decoration: none;color: #ffff;background:#333366 ;padding: 10px 10px;margin-left: 70px;}
.aqpp a{text-decoration: none;color:#ccc;border: solid 1px #ccc ;padding: 10px 10px;display: inline-block;}
.vbfd{border: solid 1px #ccc;margin-left: 70px;}
.vbfd p{padding-left: 20px;}
/* .kjhg p{;} */
.vbfd h2{padding-left: 20px;}
.thu{border: solid 1px #ccc;margin:20px 10px 0px 10px;background:#ccc;}
.thu span{padding-left: 60px;}
.thuu{margin:20px 10px 0px 10px;}
.thuu span{padding-left: 60px;}
.maps iframe{width:100%;}
.w100{margin-top: 100px;}
.mn{justify-content: space-between;}
.f1{width: 23%;}
.f1 h2{color: #333333;}
.f1 p{color: #333366;}
.f4{width: 30%;text-align: center;}
.f4 h2{color: #333333;}
.f4 p{color: #333333;}
.fgt{margin-bottom: 20px;}

.item{
  text-align: center !important;
  margin-top: 2rem;
  margin-bottom: 1.4rem;
  font-size: 3.5rem;
  font-family: 'Crimson Pro', serif;
  letter-spacing: 0.3rem;
}





</style> -->

<style>
.fgt a{color: #ffff;background:#333366 }
</style>

<div class="container">
  <div class="row">
    <div class=" vcb w-100">
      <h2 class="item text-center w-100">Walnut Creek</h2>
	   </div>
   </div>
   <div class="row">
	<div class=" col-md-12 d-md-flex d-lg-flex mb-5">
		<div class="col-md-6 my-4"> <img src="<?=base_url().$visit_us->image?>"></div>
  	<div class="col-md-6 content">
      <div class=" d-flex">
        <div class="fgt mt-sm-4 mt-xs-4">
          <a class="btn" href="<?=base_url()?>Home/contact_us">Schedule Appointment</a>
        </div>
      </div>
      <div class="p-4 mt-3" style="border: 1px solid grey">
      <div class="vbfd" style="border-bottom: 1px solid grey">
        <?=$visit_us->address?>
      </div>
      <div class="vbfd py-3" style="border-bottom: 1px solid grey">

         Fax: <?=$visit_us->fax?>
      </div>
      <div class="vbfd mt-2">
  	     <h4>Store Hours</h4>
  	      <div class="days mt-2">
            <?=$visit_us->store_hours?>
            </div>
          </div>
        </div>

        </div>
      </div>
    </div>
</div>



</div>
<!-- <div class="maps"><iframe src="https://www.google.com/maps/d/embed?mid=1ist7YM1xBJ36ey51ynRQffgddXU&hl=en" width="640" height="480"></iframe></div> -->
<div class="col-md-12">

  <div id="map_static">
    <iframe src="<?=$visit_us->map?>" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

  </div>
</div>
<br>



<!-- <h2 class="text-center mb-4 mt-4">Visit Showroom</h2> -->

<!-- <div class="container terms_h3">
<div class="row">

  <p class="mb-4 mt-4">
  <?php

  if(!empty($visit_our_showroom_data)){
    echo $visit_our_showroom_data->visit_our_showroom;
  }

  ?>
  </p>

</div>
</div> -->
