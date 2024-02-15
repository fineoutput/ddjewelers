<!DOCTYPE html>
<html lang="en">

<head>
  <!-- PAGE TITLE -->
  <? if (!empty($title)) { ?>
    <title><?= $title ?></title>
  <? } else { ?>
    <title>D&D Jewelry</title>
  <? } ?>
  <!-- //-------- PAGE KEYWORDS ------ -->
  <? if (!empty($keyword)) { ?>
    <meta name="keywords" content="<?= $keyword ?>">
  <? } ?>
  <!-- -------- PAGE DESCRIPTION ---------- -->
  <? if (!empty($dsc)) { ?>
    <meta name="description" content="<?= $dsc ?>">
  <? } ?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="<?= base_url() ?>assets/jewel/img/favicon.png" sizes="32x32">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet" type='text/css'>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/jewel/css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://js.braintreegateway.com/web/dropin/1.34.0/js/dropin.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css">
  <!-- <link rel="stylesheet" href="https://www.insightindia.com/mcss/icon-font.css"> -->
  <!-- Add these links in your HTML head section -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

</head>


<style>
  ul.hov_ul li a {
    width: 100%;
    display: block;
  }


  
	@media (min-width: 1268px) and (max-width:2560px) {
    button#view {
      width: 65% !important;
    font-size: 14px;
    padding: 6px 10px;
    justify-content: center;
    display: flex;
    margin: auto;
}
.container.mt-3 .col-md-12.row.mt-5.p-0 .col-md-4.col-xl-4.col-xxl-4 .row.mt-5 .col-md-12.m-auto button.btn.w-100.mt-3{
  width: 65% !important;
    font-size: 14px;
    padding: 6px 10px;
    justify-content: center;
    display: flex;
    margin: auto;
    align-items: center;
}
div#stonesTypes .col-md-12 .row.mt-3 .col-md-3 button.btn.btn-light {
    font-size: 16px;
}
	}
  .container.mt-3 .col-md-12.row.mt-5.p-0 .col-md-4.col-xl-4.col-xxl-4 .row.mt-5 .col-md-12.m-auto button.btn.w-100.mt-3 span {
    padding: 0px 6px;
}



  #menu ul:hover {
    display: block !important;
  }

  .swiper-backface-hidden .swiper-slide {
    margin-right: 20px !important;
  }

  .swiper-backface-hidden .swiper-slide a p.h6 {
    font-size: 13px;
  }

  .center {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    position: fixed;
    width: 100%;
    height: 100%;
    background-color: #fff;
    z-index: 9999;
  }

  .swiper-slide a img.img-responsive.small_mob {
    width: 54%;
  }

  @media(max-width:767px) {
    .swiper-slide a img.img-responsive.small_mob {
      width: 100%;
    }
  }

  .loader {
    border: 16px solid #f3f3f3;
    border-top: 16px solid #1A2F64;
    border-radius: 50%;
    width: 120px;
    height: 120px;
    animation: spin 2s linear infinite;
    z-index: 100;
  }

  @keyframes spin {
    0% {
      transform: rotate(0deg);
    }

    100% {
      transform: rotate(360deg);
    }
  }
</style>
<!--Start of Tawk.to Script-->
<!--Start of Tawk.to Script-->

<script type="text/javascript">
  var Tawk_API = Tawk_API || {},
    Tawk_LoadStart = new Date();

  (function() {

    var s1 = document.createElement("script"),
      s0 = document.getElementsByTagName("script")[0];

    s1.async = true;

    s1.src = 'https://embed.tawk.to/64a60968cc26a871b0269e7f/1h4k99gg5';

    s1.charset = 'UTF-8';

    s1.setAttribute('crossorigin', '*');

    s0.parentNode.insertBefore(s1, s0);

  })();
</script>

<!--End of Tawk.to Script-->
<!--End of Tawk.to Script-->

<body>
  <div class="center">
    <div class="loader"></div>
  </div>
  <!-- header start -->

  <style media="screen">
    @media (max-width:992px) {
      .cart-value {
        background: #e21837 none repeat scroll 0 0;
        border-radius: 50px;
        font-size: 10px;
        font-weight: 500;
        height: 15px;
        /* line-height: 0px; */
        width: 15px;
        position: absolute;
        left: 14px !important;
        /* left: 0; */
        top: -4px;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
      }

      #totalCartItems {
        left: 0px !important;
      }

      .mbs-sm-5 {
        margin-top: 1rem;
        margin-bottom: 1rem;
      }

      .mr-sm {
        margin-right: 20px;
      }
    }

    .d-flex.justify-content-between.p-2.pb-4 button.btn.d-flex {
      width: 98%;
      justify-content: center;
    }

    .signup {
      background: #333366;
      color: white !important;
    }

    .pro_ul::-webkit-scrollbar-thumb {
      background: #1a2f64 !important;
    }

    .pro_ul::-webkit-scrollbar {
      background: #fff !important;
      Width: 4px !important;
    }

    .d-flex.justify-content-between.p-2.pb-4 {
      flex-direction: column;
    }

    @media (max-width: 1744px) {
      .d-flex.justify-content-between.p-2.pb-4 {
        flex-direction: row;
      }
    }

    @media (min-width: 991px) and (max-width: 1038px) {
      .displaynone {
        display: none;
      }
    }

    .ulcontent {
      display: none;
      position: absolute;
      top: 50%;
      background: #fff;
      color: #094981;
      width: 100px;
      border: 1px solid #094981;
      border-top: 0;
      display: none;
      z-index: 50;
    }

    .ulcontent li a {
      padding: 3px 8px;
    }

    @media (max-width: 1950px) {
      .ulcontent {
        top: 45%;
      }
    }

    @media (max-width: 1500px) {
      .ulcontent {
        top: 42%;
      }
    }

    @media (max-width: 1350px) {
      .ulcontent {
        top: 40%;
      }
    }

    .showcontent:hover .ulcontent {
      display: block;
    }

    .showcontent {
      cursor: pointer;
    }

    @media(max-width:1108px) {
      .ulcontent {
        top: 25%;
      }

      button.ser_btn {
        min-width: 13% !important;
      }
    }

    @media(max-width:1168px) {
      svg.svg-inline--fa.fa-heart.fa-w-18 {
        margin-right: 6px !important;
      }
    }

    @media(max-width:329px) {
      button.ser_btn {
        min-width: 13% !important;
      }
    }
  </style>
  <section class="top_her">
    <div class="container-fluid pt-0 pb-0 pl-5 pr-5 h-100">
      <div class="row h-100">
        <div class="col-md-12 d-flex align-items-center justify-content-center">
          <div class="d-flex h-100 align-items-center">
            <i class="fa fa-question-circle mr-2 " style="font-size: 22px;"></i>
            <a href="<?= base_url(); ?>Home/why_us">
              <p>Why Buy From Us</p>
            </a>
            <!-- <i class="fa fa-certificate mr-2 ml-3" style="font-size: 22px;"></i>
           <a href="<?= base_url(); ?>Home/lifetime_warranty"> <p>LIFETIME WARRANTY</p></a> -->
            <i class="fa fa-caret-up mr-2 ml-3" style="font-size: 22px;"></i>
            <a href="<?= base_url(); ?>Home/lifetime_upgrades">
              <p>LIFETIME UPGRADES</p>
            </a>
            <i class="fa fa-phone mr-2 ml-3" style="font-size: 22px;"></i>
            <a href="<?= base_url(); ?>Home/services">
              <p>SERVICES </p>
            </a>
            <i class="fa fa-truck mr-2 ml-3" style="font-size: 22px;"></i>
            <a href="<?= base_url(); ?>Home/free_shipping">
              <p>FREE SHIPPING </p>
            </a>
            <i class="far fa-gem mr-2 ml-3" style="font-size: 22px;"></i>
            <a href="<?= base_url(); ?>Home/flexiblefinancing">
              <p>FLEXIBLE FINANCING </p>
            </a>
            <i class="fas fa-map-marker-alt mr-2 ml-3" style="font-size: 22px;"></i>
            <a href="<?= base_url(); ?>Home/visit_our_showroom">
              <p>VISIT OUR SHOWROOM </p>
            </a>
            <i class="fa fa-envelope mr-2 ml-3" style="font-size: 22px;"></i>
            <a href="<?= base_url(); ?>Home/contact_us">
              <p>CONTACT US </p>
            </a>
            <!-- <i class="fa fa-question-circle mr-2 ml-3" style="font-size: 22px;"></i>
          <a href="<?= base_url(); ?>Home/faq"> <p>FAQ </p></a> -->
          </div>
        </div>
        <!-- <div class="col-md-6">
         <div class="row h-100">
           <div class="col-md-9 h-100">
             <div  class="d-flex text-right cart_div h-100">
               <div class="h-100 new_HOV">
                 <span class="d-flex align-items-center h-100 ">
                   <i class="fa fa-user mr-2"></i>
                <? if (!empty($this->session->userdata('user_id'))) { ?>
                   <p><a href="<?= base_url(); ?>Home/register"><?= $cid = $this->session->userdata('user_name'); ?></a> </p>
                   <span class="hov_span">
                     <ul class="mb-0">
                       <li><a href="<?= base_url(); ?>Home/myorder">My Order</a></li>
                       <li><a href="<?= base_url(); ?>Home/profile">My Profile</a></li>
                       <li><a href="<?= base_url(); ?>Home/logout">Log out</a></li>
                     </ul>
                   </span>
                 <? } else { ?>
                   <p><a href="<?= base_url(); ?>Home/register">Login</a> </p>
                 <? } ?>
                 </span>
               </div>
             </div>
           </div>
           <div class="col-md-3 h-100">
             <div  class="d-flex text-right cart_div h-100">
               <i class="fa fa-shopping-bag mr-2"></i>
               <p><a href="<?= base_url(); ?>Home/cart" class="carticon">My cart ( 1 )</a> </p>
             </div></div>
         </div>
       </div> -->
      </div>
    </div>
  </section>
  <section class="header">
    <style>
      @media (max-width:1024px) {
        #menu {
          /* width: 200px; */
          height: 100% !important;
          text-align: justify !important;
          overflow: auto !important;
        }
      }
    </style>
    <header>
      <div class="container-fluid Pad_new">
        <div class="row ">
          <div class="col-4 lardis align-self-center">
            <a onclick="opennav()">
              <i class="fa fa-bars"></i>
            </a>
          </div>
          <!-- mobile search -->
          <style>
          </style>
          <!-- <div class="col-8 d-lg-none d-sm-block text-center m-auto" style="padding:unset !important;">
            <a href="<?= base_url(); ?>Home/index">
              <img src="<?= base_url() ?>assets/jewel/img/
              .png" class="img-fluid logo1" style="width:25%" />
              <h3 class=" text-center lobi">D&D Jewelry</h3>
              <h5>Since 1985</h5>
            </a> -->
          <!-- <button type="button" class="btn signup" style="font-size: x-small;">Sign Up for Special Offer</button> -->
          <!-- </div> -->
          <!-- <div class="col-6 col-md-4 m-auto text-center offer_btn"> -->
          <div class="col-md-4 m-auto  d-none d-lg-block iconimg">
            <!-- <button class="offer_btn">SignUp For Special Offers</button> -->
            <div class="d-flex pt-3 pb-3">
              <div class="w-30 mr-3">
                <img src="<?= base_url() ?>assets/jewel/img/shipping.png" class="img-fluid" />
              </div>
              <h6 class="m-auto">Free Shipping Over $100</h6>
            </div>
            <div class="d-flex">
              <div class="w-30  mr-3">
                <img src="<?= base_url() ?>assets/jewel/img/assure.png" class="img-fluid" />
              </div>
              <h6 class="m-auto">100% Satisfaction Guarantee</h6>
            </div>
            <div class="mt-2" style="padding-left:70px;">
              <a aria-label="Sign Special Offers m-auto" class="btn-md btn signup text-right" data-tspages="true" href="<?= base_url() ?>Home/signup_special_offers" target="_blank" rel="noopener">Sign Up For Special Offers</a>
            </div>
          </div>
          <div class="col-md-4 d-none d-lg-block">
            <!-- d-none d-lg-block -->
            <div class="col-md-12 text-center">
              <a href="<?= base_url(); ?>Home/index">

                <img src="<?= base_url() ?>assets/jewel\img\dd_logo.png" class="" style="width:40%" /></a>
              <!-- assets\jewel\img\dd.jewelplus.com_Website_Latest_-removebg-preview.png -->
            </div>
            <!-- <h4 class=" text-center">D&D Jewelry</h4>
              <div class="text-center">
                  <h6>Since 1985</h6>
              </div> -->
          </div>
          <div class="col-4 lardis ">
            <!-- d-none d-lg-block -->
            <div class=" text-center">
              <a href="<?= base_url(); ?>Home/index">
                <img src="<?= base_url() ?>assets/jewel\img\dd_logo.png" class="" style="width:100px" />
              </a>
            </div>
          </div>
          <div class="col-4 lardis align-self-center" style="margin:0;padding:0px;justify-content: end; text-align: right;">
            <a href="#!" role="button" onclick="mobSearch()" style="padding-right:7px;">
              <!--  -->
              <img src="https://www.monicavinader.com/images/2020/search-black.svg" width="28px" height="20px" class="" alt="" style="Width:20px;">
            </a>
            <!-- </div> -->
            <? if (!empty($this->session->userdata('user_id'))) { ?>
              <?php
              $user_id = $this->session->userdata('user_id');
              $ctd = $this->db->get_where('tbl_cart', array('user_id' => $this->session->userdata('user_id')))->result();
              foreach ($ctd as $cc) {
                $pp_data = $this->db->get_where('tbl_products', array('pro_id' => $cc->pro_id))->row();
                if (empty($pp_data)) {
                  $delete = $this->db->delete('tbl_cart', array('pro_id', $cc->pro_id));
                }
              }
              $this->db->select('*');
              $this->db->from('tbl_cart');
              $this->db->where('user_id', $user_id);
              $data_count = $this->db->count_all_results();
              ?>
              <a href="<?= base_url(); ?>Home/cart" class="" style="position:relative;">
                <i class="fa fa-shopping-cart" style="margin-right:7px;"></i>
                <small class="cart-value" style="left: 19px;"><span id="totalCartItems">0</span></small>
              </a>
              <a href="<?= base_url(); ?>Home/wishlist" class="" style="position:relative;">
                <!-- margin-right:1.5rem;  -->
                <i class="fa fa-heart" style="margin-right:18px;font-size:22px; display:inline;"></i>
                <small class="cart-value"><span><? $this->db->select('*');
                                                $this->db->from('tbl_wishlist');
                                                $this->db->where('user_id', $this->session->userdata('user_id'));
                                                $wish_count = $this->db->count_all_results();
                                                echo $wish_count ?></span></small>
              </a>
            <?php } else { ?>
              <a href="<?= base_url(); ?>Home/cart" class="carticon" style="position:relative;margin-right: 1.5rem;">
                <i class="fa fa-shopping-cart"></i>
                <small class="cart-value" style="left: 19px;"><span id="totalCartItems">0</span></small>
              </a>
            <?php } ?>
          </div>
          <div class="col-md-4 ser_col d-flex justify-content-between align-content-center" style="flex-wrap:wrap">
            <div class="text-center d-none d-lg-block">
              <i class="fa fa-phone I_size"></i>
              <p class="B_size">(925) 274-1444</p>
            </div>
            <div class="text-center d-none d-lg-block">
              <i class="	fas fa-chart-pie I_size"></i>
              <p class="B_size"><a href="<? echo base_url() ?>Home/flexiblefinancing">Financing</a></p>
            </div>
            <div class="text-center d-none d-lg-block">
              <i class="fas fa-user-md I_size"></i>
              <p class="B_size"><a href="<? echo base_url() ?>Home/contact_us">Book Appointment</a> </p>
            </div>
            <div class="text-center d-none d-lg-block showcontent">
              <? if (empty($this->session->userdata('user_id'))) { ?>
                <a href="<?= base_url(); ?>Home/register" style="display:inline">
                  <i class="fa fa-user I_size"></i>
                  <p class="B_size">Sign in/Sign up</p>
                </a>
              <? } else { ?>
                <!-- <span class="hov_span"> -->
                <!-- <i class="fa fa-user"></i> -->
                <!-- <a  style="margin-right:1.5rem;"> -->
                <i class="fa fa-user showcontent I_size"></i>
                <p class="B_size "> <?= $this->session->userdata('user_name') ?> </p>
                <ul class="mb-0  ulcontent">
                  <li style=" border-bottom: 1px solid #094981;"><a href="<?= base_url(); ?>Home/myorder">My Order</a></li>
                  <li style=" border-bottom: 1px solid #094981;"><a href="<?= base_url(); ?>Home/profile">My Profile</a></li>
                  <li><a href="<?= base_url(); ?>Home/logout">Log out</a></li>
                </ul>
                <!-- </span> -->
              <? } ?>
            </div>
            <? if (!empty($this->session->userdata('user_id'))) { ?>
              <div class="text-center d-none d-lg-block " id="totalwishlistItemsM">
                <a href="<?= base_url(); ?>Home/wishlist" class="carticon" style="position:relative;padding-right:rem;border-right: px solid #adadad;margin-left:10px;">
                  <!-- margin-right:1.5rem;  -->
                  <i class="fa fa-heart I_size"></i>
                  <small class="cart-value"><span><? $this->db->select('*');
                                                  $this->db->from('tbl_wishlist');
                                                  $this->db->where('user_id', $this->session->userdata('user_id'));
                                                  $wish_count = $this->db->count_all_results();
                                                  echo $wish_count ?></span></small>
                </a>
                <p class="B_size">Wishlist</p>
              </div>
            <? } ?>
            <div class="text-center d-none d-lg-block " id="totalCartItemsW">
              <a href="<?= base_url(); ?>Cart/view_cart" class="carticon" style="position:relative;padding-right:rem;border-right: px solid #adadad;margin-Left:10px;">
                <?
                $cartCount = 0;
                if (!empty($this->session->userdata('user_data'))) {
                  $cartCount = $this->db->get_where('tbl_cart', array('user_id' => $this->session->userdata('user_id')))->num_rows();
                } else {
                  if (!empty($this->session->userdata('cart_data'))) {
                    $cartCount = count($this->session->userdata('cart_data'));
                  }
                }

                ?>
                <i class="fa fa-shopping-cart I_size"></i>
                <?

                if (empty($this->session->userdata('user_id'))) {
                ?>
                  <small class="cart-value"><span><?= $cartCount ?></span></small>
                <? } else { ?>
                  <small class="cart-value"><span><?
                                                  $ctd = $this->db->get_where('tbl_cart', array('user_id' => $this->session->userdata('user_id')))->result();
                                                  foreach ($ctd as $cc) {
                                                    $pp_data = $this->db->get_where('tbl_products', array('pro_id' => $cc->pro_id))->row();
                                                    if (empty($pp_data)) {
                                                      $delete = $this->db->delete('tbl_cart', array('pro_id', $cc->pro_id));
                                                    }
                                                  }
                                                  echo $cartCount ?></span></small>
                <? } ?>
              </a>
              <p class="B_size">Cart</p>
            </div>
            <p class="displaynone"></p>
            <form class="d-none d-lg-block" action="<?= base_url() ?>Home/search_product" method="POST" enctype="multipart/form-data" style="margin-left:10px;">
              <div>
                <div class="w-100 float-right d-flex">
                  <input type="text" id="searchinput" name="search_input" placeholder="What can we help you find?" class="ser_top" style="min-width:100%;">
                  <!-- <button class="ser_btn" >SEARCH</button> -->
                  <button class="ser_btn" style="Width:85px !important; min-width:25%;"><i class="fa fa-search"></i></button>
                </div>
                <!-- search show search data div start-->
                <div class="row searc">
                  <div class="col divpro">
                    <ul class="pro_ul" id="serc">
                    </ul>
                  </div>
                </div>
              </div>
              <!-- search show search data div end-->
            </form>
          </div>
          <!-- <form action="" method="post" enctype="multipart/form-data">
            <div class="w-100 float-right d-flex ">
              <input type="text" name="" placeholder="Search" class="ser_top"> -->
          <!-- <button class="ser_btn" >SEARCH</button> -->
          <!-- <button class="ser_btn" style="Width:60px !important;"><i class="fa fa-search"></i></button>
            </div>
            </form> -->
          <!-- search  icons start -->
          <!-- <a href="#">
                          <i class="fa fa-search"></i>
                        </a> -->
          <!-- search  icons end -->
          <? if (!empty($this->session->userdata('user_id'))) { ?>
            <!--  wishlist icons start -->
            <!-- <a href="#">
              <i class="fa fa-heart"></i>
            </a> -->
            <!--  wishlist icons end -->
            <?php
            $user_id = $this->session->userdata('user_id');
            $this->db->select('*');
            $this->db->from('tbl_cart');
            $this->db->where('user_id', $user_id);
            $data_count = $this->db->count_all_results();
            ?>
            <style>
              .carticon {
                padding-right: 1rem;
              }
            </style>
          <?php } else { ?>
            <a href="<?= base_url(); ?>Home/cart" class="carticon" style="position:relative;padding-right:1.5rem;">
              <!-- margin-right:1.5rem; -->
              <!-- <i class="fa fa-shopping-cart"></i> -->
              <!-- <small class="cart-value"><span id="totalCartItemsM">0</span></small> -->
            </a>
          <?php } ?>
          <? if (empty($cid = $this->session->userdata('user_name'))) { ?>
            <!-- <a href="<?= base_url(); ?>Home/profile" style="padding-left:15px;">
                <i class="fa fa-user"></i>
              </a> -->
          <? } else { ?>
            <!-- <a href="<?= base_url(); ?>Home/profile" style="margin-right:1.5rem;">
              <i class="fa fa-user"></i>
            </a>
            <a href="<?= base_url(); ?>Home/logout" style="margin-right:1.5rem;" class="border-none">
              <i class="fas fa-sign-out-alt"></i>
            </a> -->
          <? } ?>
        </div>
      </div>
      <style>
        .form-control:focus {
          box-shadow: none;
        }

        #mobSearch {
          display: none;
        }
      </style>
      <div id="mobSearch" class="modalsearch" style="width:94%;padding-left:21px;">
        <div class="row mb-1 search d-sm-d-flex d-lg-none " style="border: 1px solid #ced4da;">
          <div class="col-10" style="padding:0px;">
            <div class="w-100">
              <input class="form-control" id="srcinput" type="text" placeholder="Search" aria-label="Search" style="border:none;margin-top:0px;">
            </div>
            <!-- search show search data div start-->
            <div class="row searc" style="top:143px;z-index:99999;">
              <div class="col divpro">
                <ul class="pro_ul" id="serch">
                </ul>
              </div>
            </div>
            <!-- search show search data div end-->
          </div>
          <div class="col-1" style="padding:0px;">
            <img src="https://www.monicavinader.com/images/2020/search-black.svg" width="28px" height="20px" class="" alt="" style="    vertical-align: -webkit-baseline-middle;">
          </div>

          <div class="col-1 text-center" style="padding:0px;">
            <button type="button" class="close" onclick="mobSearch()" style="float: unset;">
              <span aria-hidden="true" style="vertical-align: sub;font-size: 35px;">&times;</span>
            </button>
          </div>
        </div>
      </div>
      </div>
    </header>
  </section>
  <section id="menu">
    <div class="container-fluid ">
      <div class="row">
        <div class="col-md-12 closetab">
          <p>close <span onclick="closenav()"><i class="fa fa-times"></i></span></p>
        </div>
        <? $this->db->select('*');
        $this->db->from('tbl_category');
        $this->db->where('is_active', 1);
        $this->db->order_by('seq', "ASC");
        $data = $this->db->limit(8)->get();
        $i = 1;
        foreach ($data->result() as $da) {
          $cid = $da->id ?>
          <div class=" menu_col">
            <?php
            $this->db->select('*');
            $this->db->from('tbl_sub_category');
            $this->db->where('is_active', 1);
            $this->db->where('category', $da->id);
            $subcategory_da = $this->db->get()->row(); ?>
            <?php if (!empty($subcategory_da)) { ?>
              <p class="text-center menu_p">
                <a href="<?= base_url(); ?>Home/sub_category/<?= $da->id ?>">
                  <?= $da->name ?>
                </a>
              </p>
            <?php   } else { ?>
              <a href="<?= base_url(); ?>Home/all_products/<?= $da->id ?>/<?= base64_encode(3); ?>">
                <p class="text-center menu_p">
                  <?= $da->name ?>
                </p>
              </a>
            <?php  } ?>

            <? $this->db->select('*');
            $this->db->from('tbl_sub_category');
            $this->db->where('is_active', 1);
            $this->db->where('category', $cid);
            $this->db->order_by('seq', 'ASC');
            $db = $this->db->get();
            if (!empty($db->row())) {
            ?>
              <ul class="hov_ul">
                <? $i = 1;
                foreach ($db->result() as $df) {
                  if ($df->name == "Loose Natural Diamonds without Grading Report") { ?>

                    <li>
                      <a href="<?= base_url(); ?>Home/subcategories/<?= base64_encode(1); ?>" target="_blank">
                        <?= $df->name ?>
                      </a>
                    </li>

                  <?php } elseif ($df->name == "Loose Lab-Grown Diamonds without Grading Report") { ?>
                    <li>
                      <a href="<?= base_url(); ?>Home/subcategories/<?= base64_encode(2); ?>" target="_blank">
                        <?= $df->name ?>
                      </a>
                    </li>
                  <?php } elseif ($df->name == "Loose Lab-Grown Diamonds with Grading Report") { ?>
                    <li>
                      <a href="<?= base_url(); ?>Home/subcategories/<?= base64_encode(3); ?>" target="_blank">
                        <?= $df->name ?>
                      </a>
                    </li>
                  <?php } elseif ($df->name == "Loose Natural Diamonds with Grading Report") { ?>
                    <li>
                      <a href="<?= base_url(); ?>Home/subcategories/<?= base64_encode(4); ?>" target="_blank">
                        <?= $df->name ?>
                      </a>
                    </li>
                  <?php } elseif ($df->id == 82) { ?>
                    <li>
                      <a href="<?= base_url(); ?>Home/minor_category/<?= base64_encode($df->id); ?>" target="_blank">
                        <?= $df->name ?>
                      </a>
                    </li>
                    <?php } else {
                    $this->db->select('*');
                    $this->db->from('tbl_minisubcategory');
                    $this->db->where('is_active', 1);
                    $this->db->where('subcategory', $df->id);
                    // $this->db->order_by('seq','ASC');
                    $this->db->where('is_active', 1);
                    $minorsub_category = $this->db->get()->row();
                    if (empty($minorsub_category)) {
                    ?>
                      <li>
                        <a href="<?= base_url(); ?>Home/all_products/<?= $df->id ?>/<?= base64_encode(0); ?>">
                          <?= $df->name ?>
                        </a>
                      </li>
                    <?php } else { ?>
                      <li>
                        <a href="<?= base_url(); ?>Home/minor_sub_products/<?= base64_encode($df->id); ?>">
                          <?= $df->name ?>
                        </a>
                      </li>
                    <?php } ?>
                  <?php } ?>
                <?php $i++;
                } ?>
              </ul>
            <? } ?>
          </div>
        <?php $i++;
        } ?>
        <!-- <div class=" menu_col">
          <p class="text-center menu_p">
          <a href="<?= base_url(); ?>Home/new_arrivals">
            New Arrivals
          </a>
          </p>
        </div> -->
        <div class=" menu_col">
          <p class="text-center menu_p">
            <a href="<?= base_url(); ?>QuickShops/quickshops_category">
              QuickShops
            </a>
          </p>
        </div>
        <div class=" side_option menu_col">
          <p class="text-center menu_p">
            <a href="<?= base_url(); ?>Home/why_us">
              Why Buy From Us
            </a>
          </p>
        </div>
        <div class=" side_option menu_col">
          <p class="text-center menu_p">
            <a href="<?= base_url(); ?>Home/lifetime_upgrades">
              Lifetime Upgrades
            </a>
          </p>
        </div>
        <div class=" side_option menu_col">
          <p class="text-center menu_p">
            <a href="<?= base_url(); ?>Home/services">
              Services
            </a>
          </p>
        </div>
        <div class=" side_option menu_col">
          <p class="text-center menu_p">
            <a href="<?= base_url(); ?>Home/free_shipping">
              Free Shipping
            </a>
          </p>
        </div>
        <div class=" side_option menu_col">
          <p class="text-center menu_p">
            <a href="<?= base_url(); ?>Home/flexiblefinancing">
              Flexible Financing
            </a>
          </p>
        </div>
        <div class=" side_option menu_col">
          <p class="text-center menu_p">
            <a href="<?= base_url(); ?>Home/visit_our_showroom">
              Visit Out Showroom
            </a>
          </p>
        </div>
        <div class=" side_option menu_col">
          <p class="text-center menu_p">
            <a href="<?= base_url(); ?>Home/contact_us">
              Contact Us
            </a>
          </p>
        </div>
        <? if (empty($this->session->userdata('user_id'))) { ?>
          <!-- <div class=" menu_col"> -->
          <span class=" w-100 text-center mt-2 side_option">
            <a href="<?= base_url(); ?>Home/register">
              <b>Sign in/Sign up</b>
            </a>
          </span>
          <!-- </div> -->
        <? } else { ?>
          <div class=" side_option menu_col">
            <p class="text-center menu_p">
              <a href="<?= base_url(); ?>Home/myorder">
                My Order
              </a>
            </p>
          </div>
          <div class="side_option menu_col">
            <p class="text-center menu_p">
              <a href="<?= base_url(); ?>Home/profile">
                My Profile
              </a>
            </p>
          </div>
          <span class=" side_option w-100 text-center mt-2">
            <a href="<?= base_url(); ?>Home/logout">
              <b> Log out</b>
            </a>
          </span>
          <!-- </span> -->
        <? } ?>
        <div class="col-md-12 phonetab">
          <p><span class="mr-3"><i class="fa fa-phone"></i></span>(925) 274-1444</p>
        </div>
      </div>
    </div>
  </section>

  <!-- header end -->
  <script>
    function mobSearch() {
      // alert();
      var x = document.getElementById("mobSearch");
      if (x.style.display === "none") {
        x.style.display = "block";
      } else {
        x.style.display = "none";
      }
    }
    // When the user clicks anywhere outside of the modal, close it
    // window.onclick = mobSearch(event) {
    //
    //   if (event.target == modalsearch) {
    //     modalsearch.style.display = "none";
    //   }}
  </script>