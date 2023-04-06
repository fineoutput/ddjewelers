<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 20px;
}
.switch input { 
  opacity: 0;
  width: 0;
  height: 0;


}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color:grey;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 16px;
  width: 18px;
  top: 2px;
  left: 4px;
  right: 4px;
  bottom: 2px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: red;
}

input:focus + .slider {
  box-shadow: 0 0 0px white;
}

input:checked + .slider:before {
  -webkit-transform: translateX(20px);
  -ms-transform: translateX(20px);
  transform: translateX(25px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 18px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>



    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="author" content="TechyDevs">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Baecars - Travel Booking HTML Template</title>
    <!-- Favicon -->
    <link rel="icon" href="images/logo.svg">

    <!-- Google Fonts -->

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet">

    <!-- Template CSS Files -->
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-select.min.css">
    <link rel="stylesheet" href="css/line-awesome.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="css/daterangepicker.css">
    <link rel="stylesheet" href="css/animated-headline.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/flag-icon.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.3/css/swiper.css">
   
</head>
<body>
<!-- start cssload-loader -->
<div class="preloader" id="preloader">
    <div class="loader">
        <svg class="spinner" viewBox="0 0 50 50">
            <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
        </svg>
    </div>
</div>
<!-- end cssload-loader -->


<!-- ================================
            START HEADER AREA
================================= -->
<header class="header-area">
    <div class="header-top-bar padding-right-100px padding-left-100px">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="header-top-content">
                        <div class="header-left">
                            <ul class="list-items pt-1">
                                <li><a href="#"><i class="la la-phone mr-1"></i>(123) 123-456</a></li>
                                <li><a href="#"><i class="la la-envelope mr-1"></i>Baecars@example.com</a></li>
                                <li><a href="http://www.facebook.com/baecarsin"><i class="lab la-facebook-f ml-1"></i></a></li>
                                <li><a href="http://www.twitter.com/bae_cars"><i class="lab la-twitter"></i></a></li>
                                <li><a href="http://instagram.com/bae.cars"><i class="lab la-instagram"></i></a></li>
                                <li><a href="http://www.youtube.com/"><i class="lab la-youtube"></i></a></li>
                                <li><a href="http://www.linkedin.com/company/baecars"><i class="lab la-linkedin-in"></i></a></li>
                            </ul>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                   <ul style="float: right;" class="d-flex">
                    <li style="margin-right: 2px;">
                        <a href="#" class="theme-btn theme-btn-small "   data-toggle="modal" data-target="#signupPopupForm">SignUp</a>
                    </li>
                    <li>
                        <a href="#" class="theme-btn theme-btn-small"  data-toggle="modal" data-target="#loginPopupForm">Login</a>
                    </li>
                   </ul>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="header-menu-wrapper padding-right-100px padding-left-100px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="menu-wrapper">
                        <a href="#" class="down-button"><i class="la la-angle-down"></i></a>
                        <div class="logo header-logo">
                            <a href="index.html"><img src="images/logo.svg" alt="logo"></a>
                            <div class="menu-toggler">
                                <i class="la la-bars"></i>
                                <i class="la la-times"></i>
                            </div><!-- end menu-toggler -->
                        </div><!-- end logo -->
                        <div class="main-menu-content ml-auto">
                            <nav>
                                <ul>
                                    <li>
                                        <a href="index.html">Home </a>
                                    </li>
                                    <li>
                                        <a href="self-drive-cars.html">Self Drive Cars </a>
                                    </li>
                                    <li>
                                        <a href="#">Deals </a>
                                    </li>
                                    <li>
                                        <a href="#">Download App <i class="la la-angle-down"></i></a>
                                        <ul class="dropdown-menu-item">
                                            <li><a href="#">Android App</a></li>
                                            <li><a href="#">IOS</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div><!-- end main-menu-content -->
                        <div class="nav-btn">
                            <a  class="theme-btn theme-btn-small" style="float: right;" href= "C:\xampp\htdocs\bae_cars\html\add-flight.html" >Host Registration</a>
                        </div><!-- end nav-btn -->
                    </div><!-- end menu-wrapper -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container-fluid -->
    </div><!-- end header-menu-wrapper -->
</header>
<!-- ================================
         END HEADER AREA
================================= -->


<!-- ================================
    START HERO-WRAPPER AREA
================================= -->
<section class="hero-wrapper hero-wrapper3">
    <div class="hero-box pb-0 hero-bg-3  bg-fixed">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 ">
                    <div class="hero-content pb-5 hero-content-3 text-center sec_head">
                        <div class="section-heading ">
                            <h2 class="sec__title">Self Drive Cars</h2>
                        
                        </div>
                    </div><!-- end hero-content -->
                    <div class="search-fields-container search-fields-container-shape">
                        <div class="search-fields-container-inner">
                            <div class="contact-form-action">
                                <form action="#" class="row">
                                    <div class="col-lg-4 col-sm-12 ">
                                        <div class="input-box city_st" >
                                            <label class="label-text">City</label>
                                            <div class="input-box">
                                                <div class="form-group">
                                                    <span class="la la-map-marker form-icon form-check-inline"></span>
                                                    <input a href="#" data-toggle="modal" data-target="#selectcity"
                                                        class="form-control" type="text" placeholder="City , State">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end col-lg-4 -->
<!--                                    
                                    <div class="col-lg-4 col-sm-0"> -->
                                        <div class=" form-check-inline m-0">
                                            <div class=" form-check-inline form_t1">
                                           
                                                <div class="input-box ">
                                                    <label class="label-text">From</label>
                                                    <div class="form-group">
                                                        <span class="la la-calendar form-icon"></span>
                                                        <input class="date-picker-single form-control" type="text" name="daterange-single" readonly>
                                                    </div>
                                                </div>
                                            
                                            
                                                <div class="input-box form_t2">
                                                    <label class="label-text">Time</label>
                                                    <div class="form-group">
                                                        <div class="select-contain select-contain-shadow w-auto">
                                                            <select class="select-contain-select">
                                                                <option value="1200AM">12:00AM</option>
                                                                <option value="1230AM">12:30AM</option>
                                                                <option value="0100AM">1:00AM</option>
                                                                <option value="0130AM">1:30AM</option>
                                                                <option value="0200AM">2:00AM</option>
                                                                <option value="0230AM">2:30AM</option>
                                                                <option value="0300AM">3:00AM</option>
                                                                <option value="0330AM">3:30AM</option>
                                                                <option value="0400AM">4:00AM</option>
                                                                <option value="0430AM">4:30AM</option>
                                                                <option value="0500AM">5:00AM</option>
                                                                <option value="0530AM">5:30AM</option>
                                                                <option value="0600AM">6:00AM</option>
                                                                <option value="0630AM">6:30AM</option>
                                                                <option value="0700AM">7:00AM</option>
                                                                <option value="0730AM">7:30AM</option>
                                                                <option value="0800AM">8:00AM</option>
                                                                <option value="0830AM">8:30AM</option>
                                                                <option value="0900AM" selected>9:00AM</option>
                                                                <option value="0930AM">9:30AM</option>
                                                                <option value="1000AM">10:00AM</option>
                                                                <option value="1030AM">10:30AM</option>
                                                                <option value="1100AM">11:00AM</option>
                                                                <option value="1130AM">11:30AM</option>
                                                                <option value="1200PM">12:00PM</option>
                                                                <option value="1230PM">12:30PM</option>
                                                                <option value="0100PM">1:00PM</option>
                                                                <option value="0130PM">1:30PM</option>
                                                                <option value="0200PM">2:00PM</option>
                                                                <option value="0230PM">2:30PM</option>
                                                                <option value="0300PM">3:00PM</option>
                                                                <option value="0330PM">3:30PM</option>
                                                                <option value="0400PM">4:00PM</option>
                                                                <option value="0430PM">4:30PM</option>
                                                                <option value="0500PM">5:00PM</option>
                                                                <option value="0530PM">5:30PM</option>
                                                                <option value="0600PM">6:00PM</option>
                                                                <option value="0630PM">6:30PM</option>
                                                                <option value="0700PM">7:00PM</option>
                                                                <option value="0730PM">7:30PM</option>
                                                                <option value="0800PM">8:00PM</option>
                                                                <option value="0830PM">8:30PM</option>
                                                                <option value="0900PM">9:00PM</option>
                                                                <option value="0930PM">9:30PM</option>
                                                                <option value="1000PM">10:00PM</option>
                                                                <option value="1030PM">10:30PM</option>
                                                                <option value="1100PM">11:00PM</option>
                                                                <option value="1130PM">11:30PM</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                           
                                        </div>
                                    <!-- </div> -->
                                    <!-- end col-lg-4 -->


                                    <!-- <div class="col-lg-4 "> -->
                                        <div class=" form-check-inline form_t1">
                                           
                                                <div class="input-box">
                                                    <label class="label-text">To</label>
                                                    <div class="form-group">
                                                        <span class="la la-calendar form-icon"></span>
                                                        <input class="date-picker-single form-control" type="text" name="daterange-single" readonly>
                                                    </div>
                                                </div>
                                            
                                            
                                                <div class="input-box form_t2">
                                                    <label class="label-text">Time</label>
                                                    <div class="form-group">
                                                        <div class="select-contain select-contain-shadow w-auto">
                                                            <select class="select-contain-select">
                                                                <option value="1200AM">12:00AM</option>
                                                                <option value="1230AM">12:30AM</option>
                                                                <option value="0100AM">1:00AM</option>
                                                                <option value="0130AM">1:30AM</option>
                                                                <option value="0200AM">2:00AM</option>
                                                                <option value="0230AM">2:30AM</option>
                                                                <option value="0300AM">3:00AM</option>
                                                                <option value="0330AM">3:30AM</option>
                                                                <option value="0400AM">4:00AM</option>
                                                                <option value="0430AM">4:30AM</option>
                                                                <option value="0500AM">5:00AM</option>
                                                                <option value="0530AM">5:30AM</option>
                                                                <option value="0600AM">6:00AM</option>
                                                                <option value="0630AM">6:30AM</option>
                                                                <option value="0700AM">7:00AM</option>
                                                                <option value="0730AM">7:30AM</option>
                                                                <option value="0800AM">8:00AM</option>
                                                                <option value="0830AM">8:30AM</option>
                                                                <option value="0900AM" selected>9:00AM</option>
                                                                <option value="0930AM">9:30AM</option>
                                                                <option value="1000AM">10:00AM</option>
                                                                <option value="1030AM">10:30AM</option>
                                                                <option value="1100AM">11:00AM</option>
                                                                <option value="1130AM">11:30AM</option>
                                                                <option value="1200PM">12:00PM</option>
                                                                <option value="1230PM">12:30PM</option>
                                                                <option value="0100PM">1:00PM</option>
                                                                <option value="0130PM">1:30PM</option>
                                                                <option value="0200PM">2:00PM</option>
                                                                <option value="0230PM">2:30PM</option>
                                                                <option value="0300PM">3:00PM</option>
                                                                <option value="0330PM">3:30PM</option>
                                                                <option value="0400PM">4:00PM</option>
                                                                <option value="0430PM">4:30PM</option>
                                                                <option value="0500PM">5:00PM</option>
                                                                <option value="0530PM">5:30PM</option>
                                                                <option value="0600PM">6:00PM</option>
                                                                <option value="0630PM">6:30PM</option>
                                                                <option value="0700PM">7:00PM</option>
                                                                <option value="0730PM">7:30PM</option>
                                                                <option value="0800PM">8:00PM</option>
                                                                <option value="0830PM">8:30PM</option>
                                                                <option value="0900PM">9:00PM</option>
                                                                <option value="0930PM">9:30PM</option>
                                                                <option value="1000PM">10:00PM</option>
                                                                <option value="1030PM">10:30PM</option>
                                                                <option value="1100PM">11:00PM</option>
                                                                <option value="1130PM">11:30PM</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                           
                                           </div>
                                        </div>
                                    <!-- </div> -->
                                    <!-- end col-lg-4 -->
                                </form>
                            
                            </div>
                            <div class="row  flex-nowrap" >
                                <div class="col-lg-9 col-md-8 col-sm-1 order-sm-2 order-lg-1">
                                    <div class="btn-box ">
                                        <a href="activity-search-result.html" class="theme-btn bth-theme">Search Now</a>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-1 order-sm-1 order-lg-2" >
                                    
                                        <span class="d-flex ">
                                            <label class="switch mt-1 ">
                                                <input type="checkbox">
                                                <span class="slider round"></span>
                                               
                                            </label ><p class="ml-3 "> Unlimited</p>
                                        </span>
                                       
                                   
                                </div>
                                    </div>
                            
                               
                          
                        </div>
                    </div>
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
        <svg class="hero-svg" viewBox="0 0 500 150" preserveAspectRatio="none"><path d="M0.00,49.98 C149.99,150.00 349.20,-49.98 500.00,49.98 L500.00,150.00 L0.00,150.00 Z"></path></svg>
    </div>
</section><!-- end hero-wrapper -->
<!-- ================================
    END HERO-WRAPPER AREA
================================= -->

<!-- ================================
    START FILTER AREA
================================= -->


<!-- ================================
       END FILTER AREA 
================================= -->

<!-- ================================
    START CARS
================================= -->


<!-- <div class="search-fields-container">  
 <div class="search-fields-container-inner">
    <div class="col-lg-4">
        <div class="filter-option">
            <h3 class="title font-size-16">Filter by: <a href="#" class="theme-btn theme-btn-small"  data-toggle="modal">Apply</a></h3>
           
        </div>
        <div class="filter-option">
            <div class="dropdown dropdown-contain">
                <a class="dropdown-toggle dropdown-btn dropdown--btn" href="#" role="button" data-toggle="dropdown">
                    Brands<span class="caret"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-wrap">
                    <div class="dropdown-item">
                        <div class="checkbox-wrap">
                            <div class="custom-checkbox">
                                <input type="checkbox" id="catChb1">
                                <label for="catChb1">Maruti Suzuki</label>
                            </div>
                            <div class="custom-checkbox">
                                <input type="checkbox" id="catChb2">
                                <label for="catChb2">Mahindra</label>
                            </div>
                            <div class="custom-checkbox">
                                <input type="checkbox" id="catChb3">
                                <label for="catChb3">Chevrolet</label>
                            </div>
                            <div class="custom-checkbox">
                                <input type="checkbox" id="catChb4">
                                <label for="catChb4">Tata</label>
                            </div>
                           
                        </div>
                    </div>
                    
                </div>
               
            </div>
        <div class="filter-option">
            <div class="dropdown dropdown-contain">
                <a class="dropdown-toggle dropdown-btn dropdown--btn" href="#" role="button" data-toggle="dropdown">
                    Fuel Type<span class="caret"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-wrap">
                    <div class="dropdown-item">
                        <div class="checkbox-wrap">
                            <div class="custom-checkbox">
                                <input type="checkbox" id="catChb5">
                                <label for="catChb5">Petrol</label>
                            </div>
                            <div class="custom-checkbox">
                                <input type="checkbox" id="catChb6">
                                <label for="catChb6">Diesel</label>
                            </div>
                            <div class="custom-checkbox">
                                <input type="checkbox" id="catChb7">
                                <label for="catChb7">CNG</label>
                            </div>
                            
                           
                        </div>
                    </div>
                </div
            </div>
        </div>
        <div class="filter-option">
            <div class="dropdown dropdown-contain">
                <a class="dropdown-toggle dropdown-btn dropdown--btn" href="#" role="button" data-toggle="dropdown">
                    Transmission Type<span class="caret"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-wrap">
                    <div class="dropdown-item">
                        <div class="checkbox-wrap">
                            <div class="custom-checkbox">
                                <input type="checkbox" id="catChb8">
                                <label for="catChb8">Manual</label>
                            </div>
                            <div class="custom-checkbox">
                                <input type="checkbox" id="catChb9">
                                <label for="catChb9">Automatic</label>
                            </div>
                           
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="filter-option">
            <div class="dropdown dropdown-contain" class="well">
                <a class="dropdown-toggle dropdown-btn dropdown--btn" href="#" role="button" data-toggle="dropdown">
                    Seating Capacity<span class="caret"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-wrap">
                    <div class="dropdown-item">
                        <div class="checkbox-wrap">
                            <div class="custom-checkbox">
                                <input type="checkbox" id="catChb10">
                                <label for="catChb10">5 Seats</label>
                            </div>
                            <div class="custom-checkbox">
                                <input type="checkbox" id="catChb11">
                                <label for="catChb11">7 Seats</label>
                            </div>
                            <div class="custom-checkbox">
                                <input type="checkbox" id="catChb12">
                                <label for="catChb12">9 Seats</label>
                            </div>
                            
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
 </div>
    
</div> -->



<section class="section-padding">
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="sidebar mt-0">
                    <div class="sidebar-widget mb-2 pb-2 ">
                        <h3 class="title stroke-shape">Filter by:</h3>
                        
                        <div class="btn-box pt-0" style="float: right; ">
                            <a href="tour-search-result.html" class="theme-btn theme-btn-small">Apply</a>
                        </div>
                    </div><!-- end sidebar-widget -->



                    <div class="sidebar-widget mb-2 pb-2" >
                        <h3 class="title stroke-shape">Brands</h3>
                        <div class="custom-checkbox">
                            <input type="checkbox" id="r6">
                            <label for="r6">Maruti Suzuki</label>
                        </div>
                        <div class="custom-checkbox">
                            <input type="checkbox" id="r7">
                            <label for="r7">Mahindra</label>
                        </div>
                        <div class="sidebar-widget mb-0 pb-2">
                            <!-- <h3 class="title stroke-shape">Brands</h3> -->
                            <div class="sidebar-category">
                                
                                <div class="collapse" id="tourDurationMenu">
                                   
                                    <div class="custom-checkbox">
                                        <input type="checkbox" id="r8">
                                        <label for="r8">Chevrolet</label>
                                    </div>
                                    <div class="custom-checkbox">
                                        <input type="checkbox" id="r9">
                                        <label for="r9">Tata</label>
                                    </div>
                                </div><!-- end collapse -->
                                <a class="btn-text" data-toggle="collapse" href="#tourDurationMenu" role="button" aria-expanded="true" aria-controls="tourDurationMenu">
                                    <span class="show-more ">show-more <i class="la la-angle-down" style="float: right;"></i></span>
                                    <span class="show-less">Show-less<i class="la la-angle-up" style="float: right;"></i></span>
                                </a>
                            </div>
                        </div>
                    </div><!-- end sidebar-widget -->

                    <div class="sidebar-widget mb-2 pb-2">
                        <h3 class="title stroke-shape">Fuel Type</h3>
                       
                            <div class="custom-checkbox">
                                <input type="checkbox" id="r6">
                                <label for="r6">Petrol</label>
                            </div>
                            <div class="custom-checkbox">
                                <input type="checkbox" id="r7">
                                <label for="r7">Diesel</label>
                            </div>
                           
                            <div class="sidebar-widget mb-0 pb-2">
                                <!-- <h3 class="title stroke-shape">Brands</h3> -->
                                <div class="sidebar-category">
                                    
                                    <div class="collapse" id="tourDurationMenu">
                                       
                                       
                                        <div class="custom-checkbox">
                                            <input type="checkbox" id="r8">
                                            <label for="r8">CNG</label>
                                        </div>
                                    </div><!-- end collapse -->
                                    <a class="btn-text" data-toggle="collapse" href="#tourDurationMenu" role="button" aria-expanded="true" aria-controls="tourDurationMenu">
                                        <span class="show-more ">show-more <i class="la la-angle-down" style="float: right;"></i></span>
                                        <span class="show-less">Show-less<i class="la la-angle-up" style="float: right;"></i></span>
                                    </a>
                                </div>
                        </div>
                    </div><!-- end sidebar-widget -->

                    <div class="sidebar-widget mb-2 pb-2">
                        <h3 class="title stroke-shape">Transmission Type</h3>
                        <div class="sidebar-category">
                            <div class="custom-checkbox">
                                <input type="checkbox" id="r6">
                                <label for="r6">Manual</label>
                            </div>
                            <div class="custom-checkbox">
                                <input type="checkbox" id="r7">
                                <label for="r7">Automatic</label>
                            </div>
                        </div>
                    </div><!-- end sidebar-widget -->


                    <div class="sidebar-widget mb-2 pb-2">
                        <h3 class="title stroke-shape">Seating Capacity</h3>
                       
                            <div class="custom-checkbox">
                                <input type="checkbox" id="r6">
                                <label for="r6">5 Seats</label>
                            </div>
                            <div class="custom-checkbox">
                                <input type="checkbox" id="r7">
                                <label for="r7">7 Seats</label>
                            </div>
                           
                            <div class="sidebar-widget mb-0 pb-2">
                                <!-- <h3 class="title stroke-shape">Brands</h3> -->
                                <div class="sidebar-category">
                                    
                                    <div class="collapse" id="tourDurationMenu">
                                       
                                        <div class="custom-checkbox">
                                            <input type="checkbox" id="r8">
                                            <label for="r8">9 Seats</label>
                                        </div>
                                    </div><!-- end collapse -->
                                    <a class="btn-text" data-toggle="collapse" href="#tourDurationMenu" role="button" aria-expanded="true" aria-controls="tourDurationMenu">
                                        <span class="show-more ">show-more <i class="la la-angle-down" style="float: right;"></i></span>
                                        <span class="show-less">Show-less<i class="la la-angle-up" style="float: right;"></i></span>
                                    </a>
                                </div>
                        </div>
                    </div>
                 
                    
                    <!-- end sidebar-widget -->
                   
                   
                   <!-- <div class="sidebar-widget mb-1 pb-1">
                        <h3 class="title stroke-shape">Categories</h3>
                        <div class="sidebar-category">
                            <div class="custom-checkbox">
                                <input type="checkbox" id="c1">
                                <label for="c1">All <span class="font-size-13 ml-1">(1809)</span></label>
                            </div>
                            <div class="custom-checkbox">
                                <input type="checkbox" id="c2">
                                <label for="c2">Active Adventure Tours <span class="font-size-13 ml-1">(809)</span></label>
                            </div>
                            <div class="custom-checkbox">
                                <input type="checkbox" id="c3">
                                <label for="c3">Ecotourism <span class="font-size-13 ml-1">(504)</span></label>
                            </div>
                            <div class="custom-checkbox">
                                <input type="checkbox" id="c4">
                                <label for="c4">Escorted Tours <span class="font-size-13 ml-1">(401)</span></label>
                            </div>
                            <div class="custom-checkbox">
                                <input type="checkbox" id="c5">
                                <label for="c5">Group Tours <span class="font-size-13 ml-1">(277)</span></label>
                            </div>
                            <div class="custom-checkbox">
                                <input type="checkbox" id="c6">
                                <label for="c6">Ligula <span class="font-size-13 ml-1">(87)</span></label>
                            </div>
                            <div class="collapse" id="categoryMenu">
                                <div class="custom-checkbox">
                                    <input type="checkbox" id="c7">
                                    <label for="c7">Family Tours <span class="font-size-13 ml-1">(100)</span></label>
                                </div>
                                <div class="custom-checkbox">
                                    <input type="checkbox" id="c8">
                                    <label for="c8">City Trips <span class="font-size-13 ml-1">(58)</span></label>
                                </div>
                                <div class="custom-checkbox">
                                    <input type="checkbox" id="c9">
                                    <label for="c9">National Parks Tours <span class="font-size-13 ml-1">(33)</span></label>
                                </div>
                            </div> 
                          
                            <a class="btn-text" data-toggle="collapse" href="#categoryMenu" role="button" aria-expanded="false" aria-controls="categoryMenu">
                                <span class="show-more">Show More <i class="la la-angle-down"></i></span>
                                <span class="show-less">Show Less <i class="la la-angle-up"></i></span>
                            </a>
                        </div>
                    </div>  -->
                    
                    <!-- end sidebar-widget -->
                
                </div>
                
                <!-- end sidebar -->
            </div>
                        <div class="col-md-9 col-sm-6 ">
                            <div class="row ">
                                <div class="col-lg-4 responsive-column">
                                    <div class="card-item car-card1"  >
                                        <div class="card-img">
                                            <!-- <a href="car-single.html" class="d-block">
                                            <img src="images/product1.webp" alt="car-img">
                                        </a> -->
                                            <div class="swiper-container">
        
                                                <!-- swiper slides -->
                                                <div class="swiper-wrapper selfd-img">
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product1.webp" alt="car-img">
                                                        </a>
                                                        </div>
        
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product2.webp" alt="car-img">
                                                        </a>
                                                    </div>
        
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product3.jpg" alt="car-img">
                                                        </a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product4.jpg" alt="car-img">
                                                        </a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product5.jpg" alt="car-img">
                                                        </a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product6.webp" alt="car-img">
                                                        </a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product7.jpg" alt="car-img">
                                                        </a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product8.jpg" alt="car-img">
                                                        </a>
                                                    </div>
        
                                                </div>
                                                <!-- !swiper slides -->
        
                                                <!-- next / prev arrows -->
                                                <div class="swiper-button-next" ></div>
                                                <div class="swiper-button-prev" ></div>
                                                <!-- !next / prev arrows -->
        
                                                <!-- pagination dots -->
                                                
                                                <!-- !pagination dots -->
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-meta">Compact SUV</p>
                                            <h3 class="card-title">
                                                <a href="car-single.html">Toyota Corolla or Similar</a></h3>
                                            <div class="card-rating">
                                                <span class="badge text-white">4.4/5</span>
                                                <span class="review__text">Average</span>
                                                <span class="rating__text">(30 Reviews)</span>
                                            </div>
                                            <div class="card-attributes">
                                                <ul class="d-flex align-items-center">
                                                    <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="" data-original-title="Passengers">
                                                        <i class="vehicle-specs-icon"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0px" y="0px" viewBox="0 0 408.987 408.987" xml:space="preserve"><g><path d="M305.299,328.853c-11.836-10.152-27.46-14.615-42.872-12.241l-78.524,12.076l-22.293-93.446 c-5.72-24.02-18.182-45.729-36.037-62.782c-10.551-10.083-22.653-18.193-35.79-24.11c13.655-9.651,20.502-27.188,15.776-44.201 l-9.268-33.361c-6.015-21.647-28.516-34.37-50.168-28.353c-13.048,3.625-20.714,17.189-17.09,30.238l22.099,79.545 c0.106,0.38,42.998,179.748,42.998,179.748c-1.783,4.351-2.774,9.108-2.774,14.094c0,9.567,3.625,18.302,9.569,24.911v5.197 c0,18.097,14.723,32.82,32.819,32.82h157.36c18.097,0,32.82-14.723,32.82-32.82v-6.8 C323.925,353.773,317.135,339.007,305.299,328.853z M50.942,59.778c2.029-0.563,4.071-0.833,6.081-0.833 c9.962,0,19.131,6.605,21.924,16.661l9.268,33.361c3.357,12.084-3.742,24.647-15.827,28.005l-6.321,1.756L46.377,67.855 C45.408,64.37,47.457,60.746,50.942,59.778z M113.138,185.476c15.341,14.651,26.047,33.302,30.962,53.939l21.953,92.018 l-2.923,0.45c-5.591-13.55-18.939-23.114-34.484-23.114c-7.412,0-14.319,2.182-20.131,5.925L71.766,160.607 C87.183,165.702,101.292,174.155,113.138,185.476z M109.355,346.059c0-10.637,8.654-19.291,19.291-19.291 s19.291,8.654,19.291,19.291s-8.654,19.291-19.291,19.291S109.355,356.697,109.355,346.059z M305.925,376.167 c0,8.172-6.648,14.82-14.82,14.82h-157.36c-5.942,0-11.066-3.524-13.426-8.586c2.68,0.614,5.465,0.949,8.328,0.949 c19.338,0,35.28-14.796,37.112-33.661l99.407-15.288c10.209-1.571,20.57,1.384,28.415,8.113s12.345,16.517,12.345,26.852V376.167z"></path></g></svg></i>
                                                        <span>5</span>
                                                    </li>
                                                    <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="" data-original-title="Transmission">
                                                        <i class="vehicle-specs-icon"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0px" y="0px" viewBox="0 0 417.649 417.649" xml:space="preserve"><g><path d="M382.348,361.639c-19.466,0-35.302-15.836-35.302-35.302v-82.21h-45.078v82.21c0,19.465-15.836,35.302-35.302,35.302 s-35.302-15.836-35.302-35.302v-82.21h-45.079v82.21c0,19.465-15.836,35.302-35.302,35.302s-35.302-15.836-35.302-35.302v-82.21 h-80.38C15.836,244.126,0,228.29,0,208.825V91.313c0-19.465,15.836-35.302,35.302-35.302s35.302,15.836,35.302,35.302v82.21h45.079 v-82.21c0-19.465,15.836-35.302,35.302-35.302s35.302,15.836,35.302,35.302v82.21h45.079v-82.21 c0-19.465,15.836-35.302,35.302-35.302s35.302,15.836,35.302,35.302v82.21h45.078v-82.21c0-19.465,15.836-35.302,35.302-35.302 s35.302,15.836,35.302,35.302v235.024C417.649,345.802,401.813,361.639,382.348,361.639z M292.968,226.126h63.078 c4.971,0,9,4.029,9,9v91.21c0,9.54,7.762,17.302,17.302,17.302s17.302-7.762,17.302-17.302V91.313 c0-9.54-7.762-17.302-17.302-17.302s-17.302,7.762-17.302,17.302v91.21c0,4.971-4.029,9-9,9h-63.078c-4.971,0-9-4.029-9-9v-91.21 c0-9.54-7.762-17.302-17.302-17.302s-17.302,7.762-17.302,17.302v91.21c0,4.971-4.029,9-9,9h-63.079c-4.971,0-9-4.029-9-9v-91.21 c0-9.54-7.762-17.302-17.302-17.302s-17.302,7.762-17.302,17.302v91.21c0,4.971-4.029,9-9,9H61.604c-4.971,0-9-4.029-9-9v-91.21 c0-9.54-7.762-17.302-17.302-17.302S18,81.772,18,91.313v117.512c0,9.54,7.762,17.302,17.302,17.302h89.38c4.971,0,9,4.029,9,9 v91.21c0,9.54,7.762,17.302,17.302,17.302s17.302-7.762,17.302-17.302v-91.21c0-4.971,4.029-9,9-9h63.079c4.971,0,9,4.029,9,9 v91.21c0,9.54,7.762,17.302,17.302,17.302s17.302-7.762,17.302-17.302v-91.21C283.968,230.156,287.997,226.126,292.968,226.126z"></path></g></svg></i>
                                                        <span>Manual</span>
                                                    </li>
                                                    <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="" data-original-title="Fuel Type">
                                                        <i class="vehicle-specs-icon"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  width="25" height="25" x="0px" y="0px" viewBox="0 0 445.944 445.944" xml:space="preserve"><path d="M445.898,85.856l-3.711-37.085c-0.237-2.375-1.409-4.559-3.256-6.07c-1.848-1.511-4.221-2.229-6.595-1.989l-62.355,6.241 c-28.195,2.822-54.757,15.41-74.793,35.447l-47.907,47.908l-0.816-0.816c-2.601-2.601-6.521-3.357-9.902-1.912l-125.406,53.612 c-1.055,0.451-2.014,1.1-2.826,1.912l-51.692,51.691c-2.696,2.696-3.401,6.798-1.759,10.239c1.505,3.154,4.681,5.125,8.12,5.125 c0.313,0,0.629-0.017,0.946-0.05l3.609-0.38L2.636,314.646c-3.515,3.515-3.515,9.213,0,12.728l66.044,66.044 c1.688,1.688,3.977,2.636,6.364,2.636c2.387,0,4.676-0.948,6.364-2.636l60.972-60.972l33.225,33.225l-24.244,24.244 c-3.515,3.515-3.515,9.213,0,12.728c1.757,1.758,4.06,2.636,6.364,2.636c2.303,0,4.607-0.879,6.364-2.636l80.803-80.803 c26.501-26.501,42.404-61.369,45.088-98.624c0.108-1.505,2.433-43.532,2.433-43.532c0.143-2.557-0.811-5.054-2.622-6.864 l-3.431-3.431l49.955-49.955c9.721-9.721,22.608-15.828,36.286-17.197l65.237-6.529C442.785,95.212,446.393,90.802,445.898,85.856z M119.829,197.059l118.211-50.536l36.178,36.178l-1.522,27.335L87.342,229.546L119.829,197.059z M75.044,374.326L21.728,321.01 l74.275-74.275l119.178-12.545L75.044,374.326z M232.165,309.111l-43.832,43.832l-33.225-33.225l88.523-88.523l27.785-2.925 C267.793,258.804,254.08,287.195,232.165,309.111z M292.448,110.593l7.034,20.218l-9.513,9.513l-7.034-20.218L292.448,110.593z M268.796,134.246l7.034,20.218l-2.196,2.196l-13.626-13.626L268.796,134.246z M370.81,84.325 c-17.801,1.781-34.571,9.729-47.222,22.38l-9.967,9.967l-7.035-20.219l1.328-1.328c17.107-17.106,39.786-27.854,63.858-30.264 l53.4-5.344l1.919,19.175L370.81,84.325z"></path></svg></i>
                                                        <span>Petrol</span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="card-price d-flex align-items-center justify-content-between">
                                                <p>
                                                    <span class="price__from">From</span>
                                                    <span class="price__num">₹23.00/</span>
                                                    <span class="price__text" style="display: inline;">Per day</span>
                                                </p>
                                                <a href="car-single.html" class="btn-text">See details<i
                                                        class="la la-angle-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 responsive-column">
                                    <div class="card-item car-card1" >
                                        <div class="card-img">
                                            <div class="swiper-container">
        
                                                <!-- swiper slides -->
                                                <div class="swiper-wrapper selfd-img ">
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product8.jpg" alt="car-img">
                                                        </a>
                                                        </div>
        
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product3.jpg" alt="car-img">
                                                        </a>
                                                    </div>
        
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product4.jpg" alt="car-img">
                                                        </a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product5.jpg" alt="car-img">
                                                        </a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product6.webp" alt="car-img">
                                                        </a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product7.jpg" alt="car-img">
                                                        </a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product1.webp" alt="car-img">
                                                        </a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product2.webp" alt="car-img">
                                                        </a>
                                                    </div>
        
                                                </div>
                                                <!-- !swiper slides -->
        
                                                <!-- next / prev arrows -->
                                                <div class="swiper-button-next" ></div>
                                                <div class="swiper-button-prev" ></div>
                                                <!-- !next / prev arrows -->
        
                                                <!-- pagination dots -->
                                                
                                                <!-- !pagination dots -->
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-meta">Standard</p>
                                            <h3 class="card-title"><a href="car-single.html">Volkswagen Jetta 2 Doors or
                                                    Similar</a></h3>
                                            <div class="card-rating">
                                                <span class="badge text-white">4.4/5</span>
                                                <span class="review__text">Average</span>
                                                <span class="rating__text">(30 Reviews)</span>
                                            </div>
                                            <div class="card-attributes">
                                                <ul class="d-flex align-items-center">
                                                    <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="" data-original-title="Passengers">
                                                        <i class="vehicle-specs-icon"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0px" y="0px" viewBox="0 0 408.987 408.987" xml:space="preserve"><g><path d="M305.299,328.853c-11.836-10.152-27.46-14.615-42.872-12.241l-78.524,12.076l-22.293-93.446 c-5.72-24.02-18.182-45.729-36.037-62.782c-10.551-10.083-22.653-18.193-35.79-24.11c13.655-9.651,20.502-27.188,15.776-44.201 l-9.268-33.361c-6.015-21.647-28.516-34.37-50.168-28.353c-13.048,3.625-20.714,17.189-17.09,30.238l22.099,79.545 c0.106,0.38,42.998,179.748,42.998,179.748c-1.783,4.351-2.774,9.108-2.774,14.094c0,9.567,3.625,18.302,9.569,24.911v5.197 c0,18.097,14.723,32.82,32.819,32.82h157.36c18.097,0,32.82-14.723,32.82-32.82v-6.8 C323.925,353.773,317.135,339.007,305.299,328.853z M50.942,59.778c2.029-0.563,4.071-0.833,6.081-0.833 c9.962,0,19.131,6.605,21.924,16.661l9.268,33.361c3.357,12.084-3.742,24.647-15.827,28.005l-6.321,1.756L46.377,67.855 C45.408,64.37,47.457,60.746,50.942,59.778z M113.138,185.476c15.341,14.651,26.047,33.302,30.962,53.939l21.953,92.018 l-2.923,0.45c-5.591-13.55-18.939-23.114-34.484-23.114c-7.412,0-14.319,2.182-20.131,5.925L71.766,160.607 C87.183,165.702,101.292,174.155,113.138,185.476z M109.355,346.059c0-10.637,8.654-19.291,19.291-19.291 s19.291,8.654,19.291,19.291s-8.654,19.291-19.291,19.291S109.355,356.697,109.355,346.059z M305.925,376.167 c0,8.172-6.648,14.82-14.82,14.82h-157.36c-5.942,0-11.066-3.524-13.426-8.586c2.68,0.614,5.465,0.949,8.328,0.949 c19.338,0,35.28-14.796,37.112-33.661l99.407-15.288c10.209-1.571,20.57,1.384,28.415,8.113s12.345,16.517,12.345,26.852V376.167z"></path></g></svg></i>
                                                        <span>5</span>
                                                    </li>
                                                    <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="" data-original-title="Transmission">
                                                        <i class="vehicle-specs-icon"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0px" y="0px" viewBox="0 0 417.649 417.649" xml:space="preserve"><g><path d="M382.348,361.639c-19.466,0-35.302-15.836-35.302-35.302v-82.21h-45.078v82.21c0,19.465-15.836,35.302-35.302,35.302 s-35.302-15.836-35.302-35.302v-82.21h-45.079v82.21c0,19.465-15.836,35.302-35.302,35.302s-35.302-15.836-35.302-35.302v-82.21 h-80.38C15.836,244.126,0,228.29,0,208.825V91.313c0-19.465,15.836-35.302,35.302-35.302s35.302,15.836,35.302,35.302v82.21h45.079 v-82.21c0-19.465,15.836-35.302,35.302-35.302s35.302,15.836,35.302,35.302v82.21h45.079v-82.21 c0-19.465,15.836-35.302,35.302-35.302s35.302,15.836,35.302,35.302v82.21h45.078v-82.21c0-19.465,15.836-35.302,35.302-35.302 s35.302,15.836,35.302,35.302v235.024C417.649,345.802,401.813,361.639,382.348,361.639z M292.968,226.126h63.078 c4.971,0,9,4.029,9,9v91.21c0,9.54,7.762,17.302,17.302,17.302s17.302-7.762,17.302-17.302V91.313 c0-9.54-7.762-17.302-17.302-17.302s-17.302,7.762-17.302,17.302v91.21c0,4.971-4.029,9-9,9h-63.078c-4.971,0-9-4.029-9-9v-91.21 c0-9.54-7.762-17.302-17.302-17.302s-17.302,7.762-17.302,17.302v91.21c0,4.971-4.029,9-9,9h-63.079c-4.971,0-9-4.029-9-9v-91.21 c0-9.54-7.762-17.302-17.302-17.302s-17.302,7.762-17.302,17.302v91.21c0,4.971-4.029,9-9,9H61.604c-4.971,0-9-4.029-9-9v-91.21 c0-9.54-7.762-17.302-17.302-17.302S18,81.772,18,91.313v117.512c0,9.54,7.762,17.302,17.302,17.302h89.38c4.971,0,9,4.029,9,9 v91.21c0,9.54,7.762,17.302,17.302,17.302s17.302-7.762,17.302-17.302v-91.21c0-4.971,4.029-9,9-9h63.079c4.971,0,9,4.029,9,9 v91.21c0,9.54,7.762,17.302,17.302,17.302s17.302-7.762,17.302-17.302v-91.21C283.968,230.156,287.997,226.126,292.968,226.126z"></path></g></svg></i>
                                                        <span>Manual</span>
                                                    </li>
                                                    <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="" data-original-title="Fuel Type">
                                                        <i class="vehicle-specs-icon"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  width="25" height="25" x="0px" y="0px" viewBox="0 0 445.944 445.944" xml:space="preserve"><path d="M445.898,85.856l-3.711-37.085c-0.237-2.375-1.409-4.559-3.256-6.07c-1.848-1.511-4.221-2.229-6.595-1.989l-62.355,6.241 c-28.195,2.822-54.757,15.41-74.793,35.447l-47.907,47.908l-0.816-0.816c-2.601-2.601-6.521-3.357-9.902-1.912l-125.406,53.612 c-1.055,0.451-2.014,1.1-2.826,1.912l-51.692,51.691c-2.696,2.696-3.401,6.798-1.759,10.239c1.505,3.154,4.681,5.125,8.12,5.125 c0.313,0,0.629-0.017,0.946-0.05l3.609-0.38L2.636,314.646c-3.515,3.515-3.515,9.213,0,12.728l66.044,66.044 c1.688,1.688,3.977,2.636,6.364,2.636c2.387,0,4.676-0.948,6.364-2.636l60.972-60.972l33.225,33.225l-24.244,24.244 c-3.515,3.515-3.515,9.213,0,12.728c1.757,1.758,4.06,2.636,6.364,2.636c2.303,0,4.607-0.879,6.364-2.636l80.803-80.803 c26.501-26.501,42.404-61.369,45.088-98.624c0.108-1.505,2.433-43.532,2.433-43.532c0.143-2.557-0.811-5.054-2.622-6.864 l-3.431-3.431l49.955-49.955c9.721-9.721,22.608-15.828,36.286-17.197l65.237-6.529C442.785,95.212,446.393,90.802,445.898,85.856z M119.829,197.059l118.211-50.536l36.178,36.178l-1.522,27.335L87.342,229.546L119.829,197.059z M75.044,374.326L21.728,321.01 l74.275-74.275l119.178-12.545L75.044,374.326z M232.165,309.111l-43.832,43.832l-33.225-33.225l88.523-88.523l27.785-2.925 C267.793,258.804,254.08,287.195,232.165,309.111z M292.448,110.593l7.034,20.218l-9.513,9.513l-7.034-20.218L292.448,110.593z M268.796,134.246l7.034,20.218l-2.196,2.196l-13.626-13.626L268.796,134.246z M370.81,84.325 c-17.801,1.781-34.571,9.729-47.222,22.38l-9.967,9.967l-7.035-20.219l1.328-1.328c17.107-17.106,39.786-27.854,63.858-30.264 l53.4-5.344l1.919,19.175L370.81,84.325z"></path></svg></i>
                                                        <span>Petrol</span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="card-price d-flex align-items-center justify-content-between">
                                                <p>
                                                    <span class="price__from">From</span>
                                                    <span class="price__num">₹33.00/</span>
                                                    <span class="price__text" style="display: inline;">Per day</span>
                                                </p>
                                                <a href="car-single.html" class="btn-text">See details<i
                                                        class="la la-angle-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 responsive-column">
                                    <div class="card-item car-card1" >
                                        <div class="card-img">
                                            <div class="swiper-container">
        
                                                <!-- swiper slides -->
                                                <div class="swiper-wrapper selfd-img">
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product4.jpg" alt="car-img">
                                                        </a>
                                                        </div>
        
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product5.jpg" alt="car-img">
                                                        </a>
                                                    </div>
        
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product6.webp" alt="car-img">
                                                        </a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product3.jpg" alt="car-img">
                                                        </a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product7.jpg" alt="car-img">
                                                        </a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product8.jpg" alt="car-img">
                                                        </a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product2.webp" alt="car-img">
                                                        </a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product1.webp" alt="car-img">
                                                        </a>
                                                    </div>
        
                                                </div>
                                                <!-- !swiper slides -->
        
                                                <!-- next / prev arrows -->
                                                <div class="swiper-button-next" ></div>
                                                <div class="swiper-button-prev" ></div>
                                                <!-- !next / prev arrows -->
        
                                                <!-- pagination dots -->
                                                
                                                <!-- !pagination dots -->
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-meta">Compact Elite</p>
                                            <h3 class="card-title"><a href="car-single.html">Toyota Yaris or Similar</a></h3>
                                            <div class="card-rating">
                                                <span class="badge text-white">4.4/5</span>
                                                <span class="review__text">Average</span>
                                                <span class="rating__text">(30 Reviews)</span>
                                            </div>
                                            <div class="card-attributes">
                                                <ul class="d-flex align-items-center">
                                                    <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="" data-original-title="Passengers">
                                                        <i class="vehicle-specs-icon"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0px" y="0px" viewBox="0 0 408.987 408.987" xml:space="preserve"><g><path d="M305.299,328.853c-11.836-10.152-27.46-14.615-42.872-12.241l-78.524,12.076l-22.293-93.446 c-5.72-24.02-18.182-45.729-36.037-62.782c-10.551-10.083-22.653-18.193-35.79-24.11c13.655-9.651,20.502-27.188,15.776-44.201 l-9.268-33.361c-6.015-21.647-28.516-34.37-50.168-28.353c-13.048,3.625-20.714,17.189-17.09,30.238l22.099,79.545 c0.106,0.38,42.998,179.748,42.998,179.748c-1.783,4.351-2.774,9.108-2.774,14.094c0,9.567,3.625,18.302,9.569,24.911v5.197 c0,18.097,14.723,32.82,32.819,32.82h157.36c18.097,0,32.82-14.723,32.82-32.82v-6.8 C323.925,353.773,317.135,339.007,305.299,328.853z M50.942,59.778c2.029-0.563,4.071-0.833,6.081-0.833 c9.962,0,19.131,6.605,21.924,16.661l9.268,33.361c3.357,12.084-3.742,24.647-15.827,28.005l-6.321,1.756L46.377,67.855 C45.408,64.37,47.457,60.746,50.942,59.778z M113.138,185.476c15.341,14.651,26.047,33.302,30.962,53.939l21.953,92.018 l-2.923,0.45c-5.591-13.55-18.939-23.114-34.484-23.114c-7.412,0-14.319,2.182-20.131,5.925L71.766,160.607 C87.183,165.702,101.292,174.155,113.138,185.476z M109.355,346.059c0-10.637,8.654-19.291,19.291-19.291 s19.291,8.654,19.291,19.291s-8.654,19.291-19.291,19.291S109.355,356.697,109.355,346.059z M305.925,376.167 c0,8.172-6.648,14.82-14.82,14.82h-157.36c-5.942,0-11.066-3.524-13.426-8.586c2.68,0.614,5.465,0.949,8.328,0.949 c19.338,0,35.28-14.796,37.112-33.661l99.407-15.288c10.209-1.571,20.57,1.384,28.415,8.113s12.345,16.517,12.345,26.852V376.167z"></path></g></svg></i>
                                                        <span>5</span>
                                                    </li>
                                                    <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="" data-original-title="Transmission">
                                                        <i class="vehicle-specs-icon"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0px" y="0px" viewBox="0 0 417.649 417.649" xml:space="preserve"><g><path d="M382.348,361.639c-19.466,0-35.302-15.836-35.302-35.302v-82.21h-45.078v82.21c0,19.465-15.836,35.302-35.302,35.302 s-35.302-15.836-35.302-35.302v-82.21h-45.079v82.21c0,19.465-15.836,35.302-35.302,35.302s-35.302-15.836-35.302-35.302v-82.21 h-80.38C15.836,244.126,0,228.29,0,208.825V91.313c0-19.465,15.836-35.302,35.302-35.302s35.302,15.836,35.302,35.302v82.21h45.079 v-82.21c0-19.465,15.836-35.302,35.302-35.302s35.302,15.836,35.302,35.302v82.21h45.079v-82.21 c0-19.465,15.836-35.302,35.302-35.302s35.302,15.836,35.302,35.302v82.21h45.078v-82.21c0-19.465,15.836-35.302,35.302-35.302 s35.302,15.836,35.302,35.302v235.024C417.649,345.802,401.813,361.639,382.348,361.639z M292.968,226.126h63.078 c4.971,0,9,4.029,9,9v91.21c0,9.54,7.762,17.302,17.302,17.302s17.302-7.762,17.302-17.302V91.313 c0-9.54-7.762-17.302-17.302-17.302s-17.302,7.762-17.302,17.302v91.21c0,4.971-4.029,9-9,9h-63.078c-4.971,0-9-4.029-9-9v-91.21 c0-9.54-7.762-17.302-17.302-17.302s-17.302,7.762-17.302,17.302v91.21c0,4.971-4.029,9-9,9h-63.079c-4.971,0-9-4.029-9-9v-91.21 c0-9.54-7.762-17.302-17.302-17.302s-17.302,7.762-17.302,17.302v91.21c0,4.971-4.029,9-9,9H61.604c-4.971,0-9-4.029-9-9v-91.21 c0-9.54-7.762-17.302-17.302-17.302S18,81.772,18,91.313v117.512c0,9.54,7.762,17.302,17.302,17.302h89.38c4.971,0,9,4.029,9,9 v91.21c0,9.54,7.762,17.302,17.302,17.302s17.302-7.762,17.302-17.302v-91.21c0-4.971,4.029-9,9-9h63.079c4.971,0,9,4.029,9,9 v91.21c0,9.54,7.762,17.302,17.302,17.302s17.302-7.762,17.302-17.302v-91.21C283.968,230.156,287.997,226.126,292.968,226.126z"></path></g></svg></i>
                                                        <span>Manual</span>
                                                    </li>
                                                    <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="" data-original-title="Fuel Type">
                                                        <i class="vehicle-specs-icon"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  width="25" height="25" x="0px" y="0px" viewBox="0 0 445.944 445.944" xml:space="preserve"><path d="M445.898,85.856l-3.711-37.085c-0.237-2.375-1.409-4.559-3.256-6.07c-1.848-1.511-4.221-2.229-6.595-1.989l-62.355,6.241 c-28.195,2.822-54.757,15.41-74.793,35.447l-47.907,47.908l-0.816-0.816c-2.601-2.601-6.521-3.357-9.902-1.912l-125.406,53.612 c-1.055,0.451-2.014,1.1-2.826,1.912l-51.692,51.691c-2.696,2.696-3.401,6.798-1.759,10.239c1.505,3.154,4.681,5.125,8.12,5.125 c0.313,0,0.629-0.017,0.946-0.05l3.609-0.38L2.636,314.646c-3.515,3.515-3.515,9.213,0,12.728l66.044,66.044 c1.688,1.688,3.977,2.636,6.364,2.636c2.387,0,4.676-0.948,6.364-2.636l60.972-60.972l33.225,33.225l-24.244,24.244 c-3.515,3.515-3.515,9.213,0,12.728c1.757,1.758,4.06,2.636,6.364,2.636c2.303,0,4.607-0.879,6.364-2.636l80.803-80.803 c26.501-26.501,42.404-61.369,45.088-98.624c0.108-1.505,2.433-43.532,2.433-43.532c0.143-2.557-0.811-5.054-2.622-6.864 l-3.431-3.431l49.955-49.955c9.721-9.721,22.608-15.828,36.286-17.197l65.237-6.529C442.785,95.212,446.393,90.802,445.898,85.856z M119.829,197.059l118.211-50.536l36.178,36.178l-1.522,27.335L87.342,229.546L119.829,197.059z M75.044,374.326L21.728,321.01 l74.275-74.275l119.178-12.545L75.044,374.326z M232.165,309.111l-43.832,43.832l-33.225-33.225l88.523-88.523l27.785-2.925 C267.793,258.804,254.08,287.195,232.165,309.111z M292.448,110.593l7.034,20.218l-9.513,9.513l-7.034-20.218L292.448,110.593z M268.796,134.246l7.034,20.218l-2.196,2.196l-13.626-13.626L268.796,134.246z M370.81,84.325 c-17.801,1.781-34.571,9.729-47.222,22.38l-9.967,9.967l-7.035-20.219l1.328-1.328c17.107-17.106,39.786-27.854,63.858-30.264 l53.4-5.344l1.919,19.175L370.81,84.325z"></path></svg></i>
                                                        <span>Petrol</span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="card-price d-flex align-items-center justify-content-between">
                                                <p>
                                                    <span class="price__from">From</span>
                                                    <span class="price__num">₹23.00/</span>
                                                    <span class="price__text" style="display: inline;">Per day</span>
                                                </p>
                                                <a href="car-single.html" class="btn-text">See details<i
                                                        class="la la-angle-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 responsive-column">
                                    <div class="card-item car-card1" >
                                        <div class="card-img">
                                            <div class="swiper-container">
        
                                                <!-- swiper slides -->
                                                <div class="swiper-wrapper selfd-img">
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product5.jpg" alt="car-img">
                                                        </a>
                                                        </div>
        
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product4.jpg" alt="car-img">
                                                        </a>
                                                    </div>
        
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product5.jpg" alt="car-img">
                                                        </a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product7.jpg" alt="car-img">
                                                        </a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product8.jpg" alt="car-img">
                                                        </a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product1.webp" alt="car-img">
                                                        </a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product6.webp" alt="car-img">
                                                        </a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product3.jpg" alt="car-img">
                                                        </a>
                                                    </div>
        
                                                </div>
                                                <!-- !swiper slides -->
        
                                                <!-- next / prev arrows -->
                                                <div class="swiper-button-next" ></div>
                                                <div class="swiper-button-prev" ></div>
                                                <!-- !next / prev arrows -->
        
                                                <!-- pagination dots -->
                                                
                                                <!-- !pagination dots -->
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-meta">Fullsize Van</p>
                                            <h3 class="card-title"><a href="car-single.html">Seat Alhambra or Similar</a></h3>
                                            <div class="card-rating">
                                                <span class="badge text-white">4.4/5</span>
                                                <span class="review__text">Average</span>
                                                <span class="rating__text">(30 Reviews)</span>
                                            </div>
                                            <div class="card-attributes">
                                                <ul class="d-flex align-items-center">
                                                    <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="" data-original-title="Passengers">
                                                        <i class="vehicle-specs-icon"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0px" y="0px" viewBox="0 0 408.987 408.987" xml:space="preserve"><g><path d="M305.299,328.853c-11.836-10.152-27.46-14.615-42.872-12.241l-78.524,12.076l-22.293-93.446 c-5.72-24.02-18.182-45.729-36.037-62.782c-10.551-10.083-22.653-18.193-35.79-24.11c13.655-9.651,20.502-27.188,15.776-44.201 l-9.268-33.361c-6.015-21.647-28.516-34.37-50.168-28.353c-13.048,3.625-20.714,17.189-17.09,30.238l22.099,79.545 c0.106,0.38,42.998,179.748,42.998,179.748c-1.783,4.351-2.774,9.108-2.774,14.094c0,9.567,3.625,18.302,9.569,24.911v5.197 c0,18.097,14.723,32.82,32.819,32.82h157.36c18.097,0,32.82-14.723,32.82-32.82v-6.8 C323.925,353.773,317.135,339.007,305.299,328.853z M50.942,59.778c2.029-0.563,4.071-0.833,6.081-0.833 c9.962,0,19.131,6.605,21.924,16.661l9.268,33.361c3.357,12.084-3.742,24.647-15.827,28.005l-6.321,1.756L46.377,67.855 C45.408,64.37,47.457,60.746,50.942,59.778z M113.138,185.476c15.341,14.651,26.047,33.302,30.962,53.939l21.953,92.018 l-2.923,0.45c-5.591-13.55-18.939-23.114-34.484-23.114c-7.412,0-14.319,2.182-20.131,5.925L71.766,160.607 C87.183,165.702,101.292,174.155,113.138,185.476z M109.355,346.059c0-10.637,8.654-19.291,19.291-19.291 s19.291,8.654,19.291,19.291s-8.654,19.291-19.291,19.291S109.355,356.697,109.355,346.059z M305.925,376.167 c0,8.172-6.648,14.82-14.82,14.82h-157.36c-5.942,0-11.066-3.524-13.426-8.586c2.68,0.614,5.465,0.949,8.328,0.949 c19.338,0,35.28-14.796,37.112-33.661l99.407-15.288c10.209-1.571,20.57,1.384,28.415,8.113s12.345,16.517,12.345,26.852V376.167z"></path></g></svg></i>
                                                        <span>5</span>
                                                    </li>
                                                    <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="" data-original-title="Transmission">
                                                        <i class="vehicle-specs-icon"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0px" y="0px" viewBox="0 0 417.649 417.649" xml:space="preserve"><g><path d="M382.348,361.639c-19.466,0-35.302-15.836-35.302-35.302v-82.21h-45.078v82.21c0,19.465-15.836,35.302-35.302,35.302 s-35.302-15.836-35.302-35.302v-82.21h-45.079v82.21c0,19.465-15.836,35.302-35.302,35.302s-35.302-15.836-35.302-35.302v-82.21 h-80.38C15.836,244.126,0,228.29,0,208.825V91.313c0-19.465,15.836-35.302,35.302-35.302s35.302,15.836,35.302,35.302v82.21h45.079 v-82.21c0-19.465,15.836-35.302,35.302-35.302s35.302,15.836,35.302,35.302v82.21h45.079v-82.21 c0-19.465,15.836-35.302,35.302-35.302s35.302,15.836,35.302,35.302v82.21h45.078v-82.21c0-19.465,15.836-35.302,35.302-35.302 s35.302,15.836,35.302,35.302v235.024C417.649,345.802,401.813,361.639,382.348,361.639z M292.968,226.126h63.078 c4.971,0,9,4.029,9,9v91.21c0,9.54,7.762,17.302,17.302,17.302s17.302-7.762,17.302-17.302V91.313 c0-9.54-7.762-17.302-17.302-17.302s-17.302,7.762-17.302,17.302v91.21c0,4.971-4.029,9-9,9h-63.078c-4.971,0-9-4.029-9-9v-91.21 c0-9.54-7.762-17.302-17.302-17.302s-17.302,7.762-17.302,17.302v91.21c0,4.971-4.029,9-9,9h-63.079c-4.971,0-9-4.029-9-9v-91.21 c0-9.54-7.762-17.302-17.302-17.302s-17.302,7.762-17.302,17.302v91.21c0,4.971-4.029,9-9,9H61.604c-4.971,0-9-4.029-9-9v-91.21 c0-9.54-7.762-17.302-17.302-17.302S18,81.772,18,91.313v117.512c0,9.54,7.762,17.302,17.302,17.302h89.38c4.971,0,9,4.029,9,9 v91.21c0,9.54,7.762,17.302,17.302,17.302s17.302-7.762,17.302-17.302v-91.21c0-4.971,4.029-9,9-9h63.079c4.971,0,9,4.029,9,9 v91.21c0,9.54,7.762,17.302,17.302,17.302s17.302-7.762,17.302-17.302v-91.21C283.968,230.156,287.997,226.126,292.968,226.126z"></path></g></svg></i>
                                                        <span>Manual</span>
                                                    </li>
                                                    <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="" data-original-title="Fuel Type">
                                                        <i class="vehicle-specs-icon"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  width="25" height="25" x="0px" y="0px" viewBox="0 0 445.944 445.944" xml:space="preserve"><path d="M445.898,85.856l-3.711-37.085c-0.237-2.375-1.409-4.559-3.256-6.07c-1.848-1.511-4.221-2.229-6.595-1.989l-62.355,6.241 c-28.195,2.822-54.757,15.41-74.793,35.447l-47.907,47.908l-0.816-0.816c-2.601-2.601-6.521-3.357-9.902-1.912l-125.406,53.612 c-1.055,0.451-2.014,1.1-2.826,1.912l-51.692,51.691c-2.696,2.696-3.401,6.798-1.759,10.239c1.505,3.154,4.681,5.125,8.12,5.125 c0.313,0,0.629-0.017,0.946-0.05l3.609-0.38L2.636,314.646c-3.515,3.515-3.515,9.213,0,12.728l66.044,66.044 c1.688,1.688,3.977,2.636,6.364,2.636c2.387,0,4.676-0.948,6.364-2.636l60.972-60.972l33.225,33.225l-24.244,24.244 c-3.515,3.515-3.515,9.213,0,12.728c1.757,1.758,4.06,2.636,6.364,2.636c2.303,0,4.607-0.879,6.364-2.636l80.803-80.803 c26.501-26.501,42.404-61.369,45.088-98.624c0.108-1.505,2.433-43.532,2.433-43.532c0.143-2.557-0.811-5.054-2.622-6.864 l-3.431-3.431l49.955-49.955c9.721-9.721,22.608-15.828,36.286-17.197l65.237-6.529C442.785,95.212,446.393,90.802,445.898,85.856z M119.829,197.059l118.211-50.536l36.178,36.178l-1.522,27.335L87.342,229.546L119.829,197.059z M75.044,374.326L21.728,321.01 l74.275-74.275l119.178-12.545L75.044,374.326z M232.165,309.111l-43.832,43.832l-33.225-33.225l88.523-88.523l27.785-2.925 C267.793,258.804,254.08,287.195,232.165,309.111z M292.448,110.593l7.034,20.218l-9.513,9.513l-7.034-20.218L292.448,110.593z M268.796,134.246l7.034,20.218l-2.196,2.196l-13.626-13.626L268.796,134.246z M370.81,84.325 c-17.801,1.781-34.571,9.729-47.222,22.38l-9.967,9.967l-7.035-20.219l1.328-1.328c17.107-17.106,39.786-27.854,63.858-30.264 l53.4-5.344l1.919,19.175L370.81,84.325z"></path></svg></i>
                                                        <span>Petrol</span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="card-price d-flex align-items-center justify-content-between">
                                                <p>
                                                    <span class="price__from">From</span>
                                                    <span class="price__num">₹45.00/</span>
                                                    <span class="price__text" style="display: inline;">Per day</span>
                                                </p>
                                                <a href="car-single.html" class="btn-text">See details<i
                                                        class="la la-angle-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 responsive-column">
                                    <div class="card-item car-card1" >
                                        <div class="card-img">
                                            <div class="swiper-container">
        
                                                <!-- swiper slides -->
                                                <div class="swiper-wrapper selfd-img">
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product6.webp" alt="car-img">
                                                        </a>
                                                        </div>
        
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product7.jpg" alt="car-img">
                                                        </a>
                                                    </div>
        
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product5.jpg" alt="car-img">
                                                        </a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product8.jpg" alt="car-img">
                                                        </a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product1.webp" alt="car-img">
                                                        </a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product2.webp" alt="car-img">
                                                        </a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product3.jpg" alt="car-img">
                                                        </a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product4.jpg" alt="car-img">
                                                        </a>
                                                    </div>
        
                                                </div>
                                                <!-- !swiper slides -->
        
                                                <!-- next / prev arrows -->
                                                <div class="swiper-button-next" ></div>
                                                <div class="swiper-button-prev" ></div>
                                                <!-- !next / prev arrows -->
        
                                                <!-- pagination dots -->
                                                
                                                <!-- !pagination dots -->
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-meta">Luxury</p>
                                            <h3 class="card-title"><a href="car-single.html">Mercedes E Class or Similar</a>
                                            </h3>
                                            <div class="card-rating">
                                                <span class="badge text-white">4.4/5</span>
                                                <span class="review__text">Average</span>
                                                <span class="rating__text">(30 Reviews)</span>
                                            </div>
                                            <div class="card-attributes">
                                                <ul class="d-flex align-items-center">
                                                    <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="" data-original-title="Passengers">
                                                        <i class="vehicle-specs-icon"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0px" y="0px" viewBox="0 0 408.987 408.987" xml:space="preserve"><g><path d="M305.299,328.853c-11.836-10.152-27.46-14.615-42.872-12.241l-78.524,12.076l-22.293-93.446 c-5.72-24.02-18.182-45.729-36.037-62.782c-10.551-10.083-22.653-18.193-35.79-24.11c13.655-9.651,20.502-27.188,15.776-44.201 l-9.268-33.361c-6.015-21.647-28.516-34.37-50.168-28.353c-13.048,3.625-20.714,17.189-17.09,30.238l22.099,79.545 c0.106,0.38,42.998,179.748,42.998,179.748c-1.783,4.351-2.774,9.108-2.774,14.094c0,9.567,3.625,18.302,9.569,24.911v5.197 c0,18.097,14.723,32.82,32.819,32.82h157.36c18.097,0,32.82-14.723,32.82-32.82v-6.8 C323.925,353.773,317.135,339.007,305.299,328.853z M50.942,59.778c2.029-0.563,4.071-0.833,6.081-0.833 c9.962,0,19.131,6.605,21.924,16.661l9.268,33.361c3.357,12.084-3.742,24.647-15.827,28.005l-6.321,1.756L46.377,67.855 C45.408,64.37,47.457,60.746,50.942,59.778z M113.138,185.476c15.341,14.651,26.047,33.302,30.962,53.939l21.953,92.018 l-2.923,0.45c-5.591-13.55-18.939-23.114-34.484-23.114c-7.412,0-14.319,2.182-20.131,5.925L71.766,160.607 C87.183,165.702,101.292,174.155,113.138,185.476z M109.355,346.059c0-10.637,8.654-19.291,19.291-19.291 s19.291,8.654,19.291,19.291s-8.654,19.291-19.291,19.291S109.355,356.697,109.355,346.059z M305.925,376.167 c0,8.172-6.648,14.82-14.82,14.82h-157.36c-5.942,0-11.066-3.524-13.426-8.586c2.68,0.614,5.465,0.949,8.328,0.949 c19.338,0,35.28-14.796,37.112-33.661l99.407-15.288c10.209-1.571,20.57,1.384,28.415,8.113s12.345,16.517,12.345,26.852V376.167z"></path></g></svg></i>
                                                        <span>5</span>
                                                    </li>
                                                    <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="" data-original-title="Transmission">
                                                        <i class="vehicle-specs-icon"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0px" y="0px" viewBox="0 0 417.649 417.649" xml:space="preserve"><g><path d="M382.348,361.639c-19.466,0-35.302-15.836-35.302-35.302v-82.21h-45.078v82.21c0,19.465-15.836,35.302-35.302,35.302 s-35.302-15.836-35.302-35.302v-82.21h-45.079v82.21c0,19.465-15.836,35.302-35.302,35.302s-35.302-15.836-35.302-35.302v-82.21 h-80.38C15.836,244.126,0,228.29,0,208.825V91.313c0-19.465,15.836-35.302,35.302-35.302s35.302,15.836,35.302,35.302v82.21h45.079 v-82.21c0-19.465,15.836-35.302,35.302-35.302s35.302,15.836,35.302,35.302v82.21h45.079v-82.21 c0-19.465,15.836-35.302,35.302-35.302s35.302,15.836,35.302,35.302v82.21h45.078v-82.21c0-19.465,15.836-35.302,35.302-35.302 s35.302,15.836,35.302,35.302v235.024C417.649,345.802,401.813,361.639,382.348,361.639z M292.968,226.126h63.078 c4.971,0,9,4.029,9,9v91.21c0,9.54,7.762,17.302,17.302,17.302s17.302-7.762,17.302-17.302V91.313 c0-9.54-7.762-17.302-17.302-17.302s-17.302,7.762-17.302,17.302v91.21c0,4.971-4.029,9-9,9h-63.078c-4.971,0-9-4.029-9-9v-91.21 c0-9.54-7.762-17.302-17.302-17.302s-17.302,7.762-17.302,17.302v91.21c0,4.971-4.029,9-9,9h-63.079c-4.971,0-9-4.029-9-9v-91.21 c0-9.54-7.762-17.302-17.302-17.302s-17.302,7.762-17.302,17.302v91.21c0,4.971-4.029,9-9,9H61.604c-4.971,0-9-4.029-9-9v-91.21 c0-9.54-7.762-17.302-17.302-17.302S18,81.772,18,91.313v117.512c0,9.54,7.762,17.302,17.302,17.302h89.38c4.971,0,9,4.029,9,9 v91.21c0,9.54,7.762,17.302,17.302,17.302s17.302-7.762,17.302-17.302v-91.21c0-4.971,4.029-9,9-9h63.079c4.971,0,9,4.029,9,9 v91.21c0,9.54,7.762,17.302,17.302,17.302s17.302-7.762,17.302-17.302v-91.21C283.968,230.156,287.997,226.126,292.968,226.126z"></path></g></svg></i>
                                                        <span>Manual</span>
                                                    </li>
                                                    <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="" data-original-title="Fuel Type">
                                                        <i class="vehicle-specs-icon"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  width="25" height="25" x="0px" y="0px" viewBox="0 0 445.944 445.944" xml:space="preserve"><path d="M445.898,85.856l-3.711-37.085c-0.237-2.375-1.409-4.559-3.256-6.07c-1.848-1.511-4.221-2.229-6.595-1.989l-62.355,6.241 c-28.195,2.822-54.757,15.41-74.793,35.447l-47.907,47.908l-0.816-0.816c-2.601-2.601-6.521-3.357-9.902-1.912l-125.406,53.612 c-1.055,0.451-2.014,1.1-2.826,1.912l-51.692,51.691c-2.696,2.696-3.401,6.798-1.759,10.239c1.505,3.154,4.681,5.125,8.12,5.125 c0.313,0,0.629-0.017,0.946-0.05l3.609-0.38L2.636,314.646c-3.515,3.515-3.515,9.213,0,12.728l66.044,66.044 c1.688,1.688,3.977,2.636,6.364,2.636c2.387,0,4.676-0.948,6.364-2.636l60.972-60.972l33.225,33.225l-24.244,24.244 c-3.515,3.515-3.515,9.213,0,12.728c1.757,1.758,4.06,2.636,6.364,2.636c2.303,0,4.607-0.879,6.364-2.636l80.803-80.803 c26.501-26.501,42.404-61.369,45.088-98.624c0.108-1.505,2.433-43.532,2.433-43.532c0.143-2.557-0.811-5.054-2.622-6.864 l-3.431-3.431l49.955-49.955c9.721-9.721,22.608-15.828,36.286-17.197l65.237-6.529C442.785,95.212,446.393,90.802,445.898,85.856z M119.829,197.059l118.211-50.536l36.178,36.178l-1.522,27.335L87.342,229.546L119.829,197.059z M75.044,374.326L21.728,321.01 l74.275-74.275l119.178-12.545L75.044,374.326z M232.165,309.111l-43.832,43.832l-33.225-33.225l88.523-88.523l27.785-2.925 C267.793,258.804,254.08,287.195,232.165,309.111z M292.448,110.593l7.034,20.218l-9.513,9.513l-7.034-20.218L292.448,110.593z M268.796,134.246l7.034,20.218l-2.196,2.196l-13.626-13.626L268.796,134.246z M370.81,84.325 c-17.801,1.781-34.571,9.729-47.222,22.38l-9.967,9.967l-7.035-20.219l1.328-1.328c17.107-17.106,39.786-27.854,63.858-30.264 l53.4-5.344l1.919,19.175L370.81,84.325z"></path></svg></i>
                                                        <span>Petrol</span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="card-price d-flex align-items-center justify-content-between">
                                                <p>
                                                    <span class="price__from">From</span>
                                                    <span class="price__num">₹58.00/</span>
                                                    <span class="price__text" style="display: inline;">Per day</span>
                                                </p>
                                                <a href="car-single.html" class="btn-text">See details<i
                                                        class="la la-angle-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 responsive-column">
                                    <div class="card-item car-card1" >
                                        <div class="card-img">
                                            <div class="swiper-container">
        
                                                <!-- swiper slides -->
                                                <div class="swiper-wrapper selfd-img">
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product7.jpg" alt="car-img">
                                                        </a>
                                                        </div>
        
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product8.jpg" alt="car-img">
                                                        </a>
                                                    </div>
        
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product6.webp" alt="car-img">
                                                        </a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product1.webp" alt="car-img">
                                                        </a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product2.webp" alt="car-img">
                                                        </a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product3.jpg" alt="car-img">
                                                        </a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product4.jpg" alt="car-img">
                                                        </a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product5.jpg" alt="car-img">
                                                        </a>
                                                    </div>
        
                                                </div>
                                                <!-- !swiper slides -->
        
                                                <div class="swiper-button-next" ></div>
                                                <div class="swiper-button-prev" ></div>
                                                <!-- !next / prev arrows -->
        
                                                <!-- pagination dots -->
                                                
                                                <!-- !pagination dots -->
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-meta">Mini</p>
                                            <h3 class="card-title"><a href="car-single.html">Fiat Fiesta 2 Doors or Similar</a>
                                            </h3>
                                            <div class="card-rating">
                                                <span class="badge text-white">4.4/5</span>
                                                <span class="review__text">Average</span>
                                                <span class="rating__text">(30 Reviews)</span>
                                            </div>
                                            <div class="card-attributes">
                                                <ul class="d-flex align-items-center">
                                                    <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="" data-original-title="Passengers">
                                                        <i class="vehicle-specs-icon"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0px" y="0px" viewBox="0 0 408.987 408.987" xml:space="preserve"><g><path d="M305.299,328.853c-11.836-10.152-27.46-14.615-42.872-12.241l-78.524,12.076l-22.293-93.446 c-5.72-24.02-18.182-45.729-36.037-62.782c-10.551-10.083-22.653-18.193-35.79-24.11c13.655-9.651,20.502-27.188,15.776-44.201 l-9.268-33.361c-6.015-21.647-28.516-34.37-50.168-28.353c-13.048,3.625-20.714,17.189-17.09,30.238l22.099,79.545 c0.106,0.38,42.998,179.748,42.998,179.748c-1.783,4.351-2.774,9.108-2.774,14.094c0,9.567,3.625,18.302,9.569,24.911v5.197 c0,18.097,14.723,32.82,32.819,32.82h157.36c18.097,0,32.82-14.723,32.82-32.82v-6.8 C323.925,353.773,317.135,339.007,305.299,328.853z M50.942,59.778c2.029-0.563,4.071-0.833,6.081-0.833 c9.962,0,19.131,6.605,21.924,16.661l9.268,33.361c3.357,12.084-3.742,24.647-15.827,28.005l-6.321,1.756L46.377,67.855 C45.408,64.37,47.457,60.746,50.942,59.778z M113.138,185.476c15.341,14.651,26.047,33.302,30.962,53.939l21.953,92.018 l-2.923,0.45c-5.591-13.55-18.939-23.114-34.484-23.114c-7.412,0-14.319,2.182-20.131,5.925L71.766,160.607 C87.183,165.702,101.292,174.155,113.138,185.476z M109.355,346.059c0-10.637,8.654-19.291,19.291-19.291 s19.291,8.654,19.291,19.291s-8.654,19.291-19.291,19.291S109.355,356.697,109.355,346.059z M305.925,376.167 c0,8.172-6.648,14.82-14.82,14.82h-157.36c-5.942,0-11.066-3.524-13.426-8.586c2.68,0.614,5.465,0.949,8.328,0.949 c19.338,0,35.28-14.796,37.112-33.661l99.407-15.288c10.209-1.571,20.57,1.384,28.415,8.113s12.345,16.517,12.345,26.852V376.167z"></path></g></svg></i>
                                                        <span>5</span>
                                                    </li>
                                                    <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="" data-original-title="Transmission">
                                                        <i class="vehicle-specs-icon"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0px" y="0px" viewBox="0 0 417.649 417.649" xml:space="preserve"><g><path d="M382.348,361.639c-19.466,0-35.302-15.836-35.302-35.302v-82.21h-45.078v82.21c0,19.465-15.836,35.302-35.302,35.302 s-35.302-15.836-35.302-35.302v-82.21h-45.079v82.21c0,19.465-15.836,35.302-35.302,35.302s-35.302-15.836-35.302-35.302v-82.21 h-80.38C15.836,244.126,0,228.29,0,208.825V91.313c0-19.465,15.836-35.302,35.302-35.302s35.302,15.836,35.302,35.302v82.21h45.079 v-82.21c0-19.465,15.836-35.302,35.302-35.302s35.302,15.836,35.302,35.302v82.21h45.079v-82.21 c0-19.465,15.836-35.302,35.302-35.302s35.302,15.836,35.302,35.302v82.21h45.078v-82.21c0-19.465,15.836-35.302,35.302-35.302 s35.302,15.836,35.302,35.302v235.024C417.649,345.802,401.813,361.639,382.348,361.639z M292.968,226.126h63.078 c4.971,0,9,4.029,9,9v91.21c0,9.54,7.762,17.302,17.302,17.302s17.302-7.762,17.302-17.302V91.313 c0-9.54-7.762-17.302-17.302-17.302s-17.302,7.762-17.302,17.302v91.21c0,4.971-4.029,9-9,9h-63.078c-4.971,0-9-4.029-9-9v-91.21 c0-9.54-7.762-17.302-17.302-17.302s-17.302,7.762-17.302,17.302v91.21c0,4.971-4.029,9-9,9h-63.079c-4.971,0-9-4.029-9-9v-91.21 c0-9.54-7.762-17.302-17.302-17.302s-17.302,7.762-17.302,17.302v91.21c0,4.971-4.029,9-9,9H61.604c-4.971,0-9-4.029-9-9v-91.21 c0-9.54-7.762-17.302-17.302-17.302S18,81.772,18,91.313v117.512c0,9.54,7.762,17.302,17.302,17.302h89.38c4.971,0,9,4.029,9,9 v91.21c0,9.54,7.762,17.302,17.302,17.302s17.302-7.762,17.302-17.302v-91.21c0-4.971,4.029-9,9-9h63.079c4.971,0,9,4.029,9,9 v91.21c0,9.54,7.762,17.302,17.302,17.302s17.302-7.762,17.302-17.302v-91.21C283.968,230.156,287.997,226.126,292.968,226.126z"></path></g></svg></i>
                                                        <span>Manual</span>
                                                    </li>
                                                    <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="" data-original-title="Fuel Type">
                                                        <i class="vehicle-specs-icon"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  width="25" height="25" x="0px" y="0px" viewBox="0 0 445.944 445.944" xml:space="preserve"><path d="M445.898,85.856l-3.711-37.085c-0.237-2.375-1.409-4.559-3.256-6.07c-1.848-1.511-4.221-2.229-6.595-1.989l-62.355,6.241 c-28.195,2.822-54.757,15.41-74.793,35.447l-47.907,47.908l-0.816-0.816c-2.601-2.601-6.521-3.357-9.902-1.912l-125.406,53.612 c-1.055,0.451-2.014,1.1-2.826,1.912l-51.692,51.691c-2.696,2.696-3.401,6.798-1.759,10.239c1.505,3.154,4.681,5.125,8.12,5.125 c0.313,0,0.629-0.017,0.946-0.05l3.609-0.38L2.636,314.646c-3.515,3.515-3.515,9.213,0,12.728l66.044,66.044 c1.688,1.688,3.977,2.636,6.364,2.636c2.387,0,4.676-0.948,6.364-2.636l60.972-60.972l33.225,33.225l-24.244,24.244 c-3.515,3.515-3.515,9.213,0,12.728c1.757,1.758,4.06,2.636,6.364,2.636c2.303,0,4.607-0.879,6.364-2.636l80.803-80.803 c26.501-26.501,42.404-61.369,45.088-98.624c0.108-1.505,2.433-43.532,2.433-43.532c0.143-2.557-0.811-5.054-2.622-6.864 l-3.431-3.431l49.955-49.955c9.721-9.721,22.608-15.828,36.286-17.197l65.237-6.529C442.785,95.212,446.393,90.802,445.898,85.856z M119.829,197.059l118.211-50.536l36.178,36.178l-1.522,27.335L87.342,229.546L119.829,197.059z M75.044,374.326L21.728,321.01 l74.275-74.275l119.178-12.545L75.044,374.326z M232.165,309.111l-43.832,43.832l-33.225-33.225l88.523-88.523l27.785-2.925 C267.793,258.804,254.08,287.195,232.165,309.111z M292.448,110.593l7.034,20.218l-9.513,9.513l-7.034-20.218L292.448,110.593z M268.796,134.246l7.034,20.218l-2.196,2.196l-13.626-13.626L268.796,134.246z M370.81,84.325 c-17.801,1.781-34.571,9.729-47.222,22.38l-9.967,9.967l-7.035-20.219l1.328-1.328c17.107-17.106,39.786-27.854,63.858-30.264 l53.4-5.344l1.919,19.175L370.81,84.325z"></path></svg></i>
                                                        <span>Petrol</span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="card-price d-flex align-items-center justify-content-between">
                                                <p>
                                                    <span class="price__from">From</span>
                                                    <span class="price__num">₹23.00/</span>
                                                    <span class="price__text" style="display: inline;">Per day</span>
                                                </p>
                                                <a href="car-single.html" class="btn-text">See details<i
                                                        class="la la-angle-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 responsive-column">
                                    <div class="card-item car-card1" >
                                        <div class="card-img">
                                            <div class="swiper-container">
        
                                                <!-- swiper slides -->
                                                <div class="swiper-wrapper selfd-img">
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product5.jpg" alt="car-img">
                                                        </a>
                                                        </div>
        
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product4.jpg" alt="car-img">
                                                        </a>
                                                    </div>
        
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product5.jpg" alt="car-img">
                                                        </a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product7.jpg" alt="car-img">
                                                        </a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product8.jpg" alt="car-img">
                                                        </a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product1.webp" alt="car-img">
                                                        </a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product6.webp" alt="car-img">
                                                        </a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product3.jpg" alt="car-img">
                                                        </a>
                                                    </div>
        
                                                </div>
                                                <!-- !swiper slides -->
        
                                                <!-- next / prev arrows -->
                                                <div class="swiper-button-next" ></div>
                                                <div class="swiper-button-prev" ></div>
                                                <!-- !next / prev arrows -->
        
                                                <!-- pagination dots -->
                                                
                                                <!-- !pagination dots -->
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-meta">Fullsize Van</p>
                                            <h3 class="card-title"><a href="car-single.html">Seat Alhambra or Similar</a></h3>
                                            <div class="card-rating">
                                                <span class="badge text-white">4.4/5</span>
                                                <span class="review__text">Average</span>
                                                <span class="rating__text">(30 Reviews)</span>
                                            </div>
                                            <div class="card-attributes">
                                                <ul class="d-flex align-items-center">
                                                    <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="" data-original-title="Passengers">
                                                        <i class="vehicle-specs-icon"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0px" y="0px" viewBox="0 0 408.987 408.987" xml:space="preserve"><g><path d="M305.299,328.853c-11.836-10.152-27.46-14.615-42.872-12.241l-78.524,12.076l-22.293-93.446 c-5.72-24.02-18.182-45.729-36.037-62.782c-10.551-10.083-22.653-18.193-35.79-24.11c13.655-9.651,20.502-27.188,15.776-44.201 l-9.268-33.361c-6.015-21.647-28.516-34.37-50.168-28.353c-13.048,3.625-20.714,17.189-17.09,30.238l22.099,79.545 c0.106,0.38,42.998,179.748,42.998,179.748c-1.783,4.351-2.774,9.108-2.774,14.094c0,9.567,3.625,18.302,9.569,24.911v5.197 c0,18.097,14.723,32.82,32.819,32.82h157.36c18.097,0,32.82-14.723,32.82-32.82v-6.8 C323.925,353.773,317.135,339.007,305.299,328.853z M50.942,59.778c2.029-0.563,4.071-0.833,6.081-0.833 c9.962,0,19.131,6.605,21.924,16.661l9.268,33.361c3.357,12.084-3.742,24.647-15.827,28.005l-6.321,1.756L46.377,67.855 C45.408,64.37,47.457,60.746,50.942,59.778z M113.138,185.476c15.341,14.651,26.047,33.302,30.962,53.939l21.953,92.018 l-2.923,0.45c-5.591-13.55-18.939-23.114-34.484-23.114c-7.412,0-14.319,2.182-20.131,5.925L71.766,160.607 C87.183,165.702,101.292,174.155,113.138,185.476z M109.355,346.059c0-10.637,8.654-19.291,19.291-19.291 s19.291,8.654,19.291,19.291s-8.654,19.291-19.291,19.291S109.355,356.697,109.355,346.059z M305.925,376.167 c0,8.172-6.648,14.82-14.82,14.82h-157.36c-5.942,0-11.066-3.524-13.426-8.586c2.68,0.614,5.465,0.949,8.328,0.949 c19.338,0,35.28-14.796,37.112-33.661l99.407-15.288c10.209-1.571,20.57,1.384,28.415,8.113s12.345,16.517,12.345,26.852V376.167z"></path></g></svg></i>
                                                        <span>5</span>
                                                    </li>
                                                    <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="" data-original-title="Transmission">
                                                        <i class="vehicle-specs-icon"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0px" y="0px" viewBox="0 0 417.649 417.649" xml:space="preserve"><g><path d="M382.348,361.639c-19.466,0-35.302-15.836-35.302-35.302v-82.21h-45.078v82.21c0,19.465-15.836,35.302-35.302,35.302 s-35.302-15.836-35.302-35.302v-82.21h-45.079v82.21c0,19.465-15.836,35.302-35.302,35.302s-35.302-15.836-35.302-35.302v-82.21 h-80.38C15.836,244.126,0,228.29,0,208.825V91.313c0-19.465,15.836-35.302,35.302-35.302s35.302,15.836,35.302,35.302v82.21h45.079 v-82.21c0-19.465,15.836-35.302,35.302-35.302s35.302,15.836,35.302,35.302v82.21h45.079v-82.21 c0-19.465,15.836-35.302,35.302-35.302s35.302,15.836,35.302,35.302v82.21h45.078v-82.21c0-19.465,15.836-35.302,35.302-35.302 s35.302,15.836,35.302,35.302v235.024C417.649,345.802,401.813,361.639,382.348,361.639z M292.968,226.126h63.078 c4.971,0,9,4.029,9,9v91.21c0,9.54,7.762,17.302,17.302,17.302s17.302-7.762,17.302-17.302V91.313 c0-9.54-7.762-17.302-17.302-17.302s-17.302,7.762-17.302,17.302v91.21c0,4.971-4.029,9-9,9h-63.078c-4.971,0-9-4.029-9-9v-91.21 c0-9.54-7.762-17.302-17.302-17.302s-17.302,7.762-17.302,17.302v91.21c0,4.971-4.029,9-9,9h-63.079c-4.971,0-9-4.029-9-9v-91.21 c0-9.54-7.762-17.302-17.302-17.302s-17.302,7.762-17.302,17.302v91.21c0,4.971-4.029,9-9,9H61.604c-4.971,0-9-4.029-9-9v-91.21 c0-9.54-7.762-17.302-17.302-17.302S18,81.772,18,91.313v117.512c0,9.54,7.762,17.302,17.302,17.302h89.38c4.971,0,9,4.029,9,9 v91.21c0,9.54,7.762,17.302,17.302,17.302s17.302-7.762,17.302-17.302v-91.21c0-4.971,4.029-9,9-9h63.079c4.971,0,9,4.029,9,9 v91.21c0,9.54,7.762,17.302,17.302,17.302s17.302-7.762,17.302-17.302v-91.21C283.968,230.156,287.997,226.126,292.968,226.126z"></path></g></svg></i>
                                                        <span>Manual</span>
                                                    </li>
                                                    <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="" data-original-title="Fuel Type">
                                                        <i class="vehicle-specs-icon"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  width="25" height="25" x="0px" y="0px" viewBox="0 0 445.944 445.944" xml:space="preserve"><path d="M445.898,85.856l-3.711-37.085c-0.237-2.375-1.409-4.559-3.256-6.07c-1.848-1.511-4.221-2.229-6.595-1.989l-62.355,6.241 c-28.195,2.822-54.757,15.41-74.793,35.447l-47.907,47.908l-0.816-0.816c-2.601-2.601-6.521-3.357-9.902-1.912l-125.406,53.612 c-1.055,0.451-2.014,1.1-2.826,1.912l-51.692,51.691c-2.696,2.696-3.401,6.798-1.759,10.239c1.505,3.154,4.681,5.125,8.12,5.125 c0.313,0,0.629-0.017,0.946-0.05l3.609-0.38L2.636,314.646c-3.515,3.515-3.515,9.213,0,12.728l66.044,66.044 c1.688,1.688,3.977,2.636,6.364,2.636c2.387,0,4.676-0.948,6.364-2.636l60.972-60.972l33.225,33.225l-24.244,24.244 c-3.515,3.515-3.515,9.213,0,12.728c1.757,1.758,4.06,2.636,6.364,2.636c2.303,0,4.607-0.879,6.364-2.636l80.803-80.803 c26.501-26.501,42.404-61.369,45.088-98.624c0.108-1.505,2.433-43.532,2.433-43.532c0.143-2.557-0.811-5.054-2.622-6.864 l-3.431-3.431l49.955-49.955c9.721-9.721,22.608-15.828,36.286-17.197l65.237-6.529C442.785,95.212,446.393,90.802,445.898,85.856z M119.829,197.059l118.211-50.536l36.178,36.178l-1.522,27.335L87.342,229.546L119.829,197.059z M75.044,374.326L21.728,321.01 l74.275-74.275l119.178-12.545L75.044,374.326z M232.165,309.111l-43.832,43.832l-33.225-33.225l88.523-88.523l27.785-2.925 C267.793,258.804,254.08,287.195,232.165,309.111z M292.448,110.593l7.034,20.218l-9.513,9.513l-7.034-20.218L292.448,110.593z M268.796,134.246l7.034,20.218l-2.196,2.196l-13.626-13.626L268.796,134.246z M370.81,84.325 c-17.801,1.781-34.571,9.729-47.222,22.38l-9.967,9.967l-7.035-20.219l1.328-1.328c17.107-17.106,39.786-27.854,63.858-30.264 l53.4-5.344l1.919,19.175L370.81,84.325z"></path></svg></i>
                                                        <span>Petrol</span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="card-price d-flex align-items-center justify-content-between">
                                                <p>
                                                    <span class="price__from">From</span>
                                                    <span class="price__num">₹45.00/</span>
                                                    <span class="price__text" style="display: inline;">Per day</span>
                                                </p>
                                                <a href="car-single.html" class="btn-text">See details<i
                                                        class="la la-angle-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 responsive-column">
                                    <div class="card-item car-card1" >
                                        <div class="card-img">
                                            <div class="swiper-container">
        
                                                <!-- swiper slides -->
                                                <div class="swiper-wrapper selfd-img">
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product8.jpg" alt="car-img">
                                                        </a>
                                                        </div>
        
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product3.jpg" alt="car-img">
                                                        </a>
                                                    </div>
        
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product4.jpg" alt="car-img">
                                                        </a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product5.jpg" alt="car-img">
                                                        </a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product6.webp" alt="car-img">
                                                        </a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product7.jpg" alt="car-img">
                                                        </a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product1.webp" alt="car-img">
                                                        </a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a href="car-single.html" class="d-block">
                                                            <img src="images/product2.webp" alt="car-img">
                                                        </a>
                                                    </div>
        
                                                </div>
                                                <!-- !swiper slides -->
        
                                                <!-- next / prev arrows -->
                                                <div class="swiper-button-next" ></div>
                                                <div class="swiper-button-prev" ></div>
                                                <!-- !next / prev arrows -->
        
                                                <!-- pagination dots -->
                                                
                                                <!-- !pagination dots -->
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-meta">Standard</p>
                                            <h3 class="card-title"><a href="car-single.html">Volkswagen Jetta 2 Doors or
                                                    Similar</a></h3>
                                            <div class="card-rating">
                                                <span class="badge text-white">4.4/5</span>
                                                <span class="review__text">Average</span>
                                                <span class="rating__text">(30 Reviews)</span>
                                            </div>
                                            <div class="card-attributes">
                                                <ul class="d-flex align-items-center">
                                                    <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="" data-original-title="Passengers">
                                                        <i class="vehicle-specs-icon"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0px" y="0px" viewBox="0 0 408.987 408.987" xml:space="preserve"><g><path d="M305.299,328.853c-11.836-10.152-27.46-14.615-42.872-12.241l-78.524,12.076l-22.293-93.446 c-5.72-24.02-18.182-45.729-36.037-62.782c-10.551-10.083-22.653-18.193-35.79-24.11c13.655-9.651,20.502-27.188,15.776-44.201 l-9.268-33.361c-6.015-21.647-28.516-34.37-50.168-28.353c-13.048,3.625-20.714,17.189-17.09,30.238l22.099,79.545 c0.106,0.38,42.998,179.748,42.998,179.748c-1.783,4.351-2.774,9.108-2.774,14.094c0,9.567,3.625,18.302,9.569,24.911v5.197 c0,18.097,14.723,32.82,32.819,32.82h157.36c18.097,0,32.82-14.723,32.82-32.82v-6.8 C323.925,353.773,317.135,339.007,305.299,328.853z M50.942,59.778c2.029-0.563,4.071-0.833,6.081-0.833 c9.962,0,19.131,6.605,21.924,16.661l9.268,33.361c3.357,12.084-3.742,24.647-15.827,28.005l-6.321,1.756L46.377,67.855 C45.408,64.37,47.457,60.746,50.942,59.778z M113.138,185.476c15.341,14.651,26.047,33.302,30.962,53.939l21.953,92.018 l-2.923,0.45c-5.591-13.55-18.939-23.114-34.484-23.114c-7.412,0-14.319,2.182-20.131,5.925L71.766,160.607 C87.183,165.702,101.292,174.155,113.138,185.476z M109.355,346.059c0-10.637,8.654-19.291,19.291-19.291 s19.291,8.654,19.291,19.291s-8.654,19.291-19.291,19.291S109.355,356.697,109.355,346.059z M305.925,376.167 c0,8.172-6.648,14.82-14.82,14.82h-157.36c-5.942,0-11.066-3.524-13.426-8.586c2.68,0.614,5.465,0.949,8.328,0.949 c19.338,0,35.28-14.796,37.112-33.661l99.407-15.288c10.209-1.571,20.57,1.384,28.415,8.113s12.345,16.517,12.345,26.852V376.167z"></path></g></svg></i>
                                                        <span>5</span>
                                                    </li>
                                                    <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="" data-original-title="Transmission">
                                                        <i class="vehicle-specs-icon"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0px" y="0px" viewBox="0 0 417.649 417.649" xml:space="preserve"><g><path d="M382.348,361.639c-19.466,0-35.302-15.836-35.302-35.302v-82.21h-45.078v82.21c0,19.465-15.836,35.302-35.302,35.302 s-35.302-15.836-35.302-35.302v-82.21h-45.079v82.21c0,19.465-15.836,35.302-35.302,35.302s-35.302-15.836-35.302-35.302v-82.21 h-80.38C15.836,244.126,0,228.29,0,208.825V91.313c0-19.465,15.836-35.302,35.302-35.302s35.302,15.836,35.302,35.302v82.21h45.079 v-82.21c0-19.465,15.836-35.302,35.302-35.302s35.302,15.836,35.302,35.302v82.21h45.079v-82.21 c0-19.465,15.836-35.302,35.302-35.302s35.302,15.836,35.302,35.302v82.21h45.078v-82.21c0-19.465,15.836-35.302,35.302-35.302 s35.302,15.836,35.302,35.302v235.024C417.649,345.802,401.813,361.639,382.348,361.639z M292.968,226.126h63.078 c4.971,0,9,4.029,9,9v91.21c0,9.54,7.762,17.302,17.302,17.302s17.302-7.762,17.302-17.302V91.313 c0-9.54-7.762-17.302-17.302-17.302s-17.302,7.762-17.302,17.302v91.21c0,4.971-4.029,9-9,9h-63.078c-4.971,0-9-4.029-9-9v-91.21 c0-9.54-7.762-17.302-17.302-17.302s-17.302,7.762-17.302,17.302v91.21c0,4.971-4.029,9-9,9h-63.079c-4.971,0-9-4.029-9-9v-91.21 c0-9.54-7.762-17.302-17.302-17.302s-17.302,7.762-17.302,17.302v91.21c0,4.971-4.029,9-9,9H61.604c-4.971,0-9-4.029-9-9v-91.21 c0-9.54-7.762-17.302-17.302-17.302S18,81.772,18,91.313v117.512c0,9.54,7.762,17.302,17.302,17.302h89.38c4.971,0,9,4.029,9,9 v91.21c0,9.54,7.762,17.302,17.302,17.302s17.302-7.762,17.302-17.302v-91.21c0-4.971,4.029-9,9-9h63.079c4.971,0,9,4.029,9,9 v91.21c0,9.54,7.762,17.302,17.302,17.302s17.302-7.762,17.302-17.302v-91.21C283.968,230.156,287.997,226.126,292.968,226.126z"></path></g></svg></i>
                                                        <span>Manual</span>
                                                    </li>
                                                    <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="" data-original-title="Fuel Type">
                                                        <i class="vehicle-specs-icon"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  width="25" height="25" x="0px" y="0px" viewBox="0 0 445.944 445.944" xml:space="preserve"><path d="M445.898,85.856l-3.711-37.085c-0.237-2.375-1.409-4.559-3.256-6.07c-1.848-1.511-4.221-2.229-6.595-1.989l-62.355,6.241 c-28.195,2.822-54.757,15.41-74.793,35.447l-47.907,47.908l-0.816-0.816c-2.601-2.601-6.521-3.357-9.902-1.912l-125.406,53.612 c-1.055,0.451-2.014,1.1-2.826,1.912l-51.692,51.691c-2.696,2.696-3.401,6.798-1.759,10.239c1.505,3.154,4.681,5.125,8.12,5.125 c0.313,0,0.629-0.017,0.946-0.05l3.609-0.38L2.636,314.646c-3.515,3.515-3.515,9.213,0,12.728l66.044,66.044 c1.688,1.688,3.977,2.636,6.364,2.636c2.387,0,4.676-0.948,6.364-2.636l60.972-60.972l33.225,33.225l-24.244,24.244 c-3.515,3.515-3.515,9.213,0,12.728c1.757,1.758,4.06,2.636,6.364,2.636c2.303,0,4.607-0.879,6.364-2.636l80.803-80.803 c26.501-26.501,42.404-61.369,45.088-98.624c0.108-1.505,2.433-43.532,2.433-43.532c0.143-2.557-0.811-5.054-2.622-6.864 l-3.431-3.431l49.955-49.955c9.721-9.721,22.608-15.828,36.286-17.197l65.237-6.529C442.785,95.212,446.393,90.802,445.898,85.856z M119.829,197.059l118.211-50.536l36.178,36.178l-1.522,27.335L87.342,229.546L119.829,197.059z M75.044,374.326L21.728,321.01 l74.275-74.275l119.178-12.545L75.044,374.326z M232.165,309.111l-43.832,43.832l-33.225-33.225l88.523-88.523l27.785-2.925 C267.793,258.804,254.08,287.195,232.165,309.111z M292.448,110.593l7.034,20.218l-9.513,9.513l-7.034-20.218L292.448,110.593z M268.796,134.246l7.034,20.218l-2.196,2.196l-13.626-13.626L268.796,134.246z M370.81,84.325 c-17.801,1.781-34.571,9.729-47.222,22.38l-9.967,9.967l-7.035-20.219l1.328-1.328c17.107-17.106,39.786-27.854,63.858-30.264 l53.4-5.344l1.919,19.175L370.81,84.325z"></path></svg></i>
                                                        <span>Petrol</span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="card-price d-flex align-items-center justify-content-between">
                                                <p>
                                                    <span class="price__from">From</span>
                                                    <span class="price__num">₹33.00/</span>
                                                    <span class="price__text" style="display: inline;">Per day</span>
                                                </p>
                                                <a href="car-single.html" class="btn-text">See details<i
                                                        class="la la-angle-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
    </div>  
</section>
<!-- mobile sort and filter model -->

<div class="x_car_book_sider_main_Wrapper float_left mt-4 ">
    <div class="container-fluid" style="position: fixed;bottom: 0; background-color: #fff;z-index: 110000;">
        <div class="row text-center mobiledown">
           <div class="col-12">
            <div class="row">
                <div class="col-6 p-3">
                    
                        <a href="#" data-toggle="modal" data-target="#sortby"  data-dismiss="modal"> <img src="images/icon2.png" alt=""> Sort By</a>
                    
                </div>
                <div class="col-6  p-3">
                    <a href="#" data-toggle="modal" data-target="#filterby"  data-dismiss="modal"> <img src="images/icon1.png" alt=""> Filter</a>
                </div>
            </div>
           </div>
        </div>
    </div>
</div>  


<!-- Sort by -->

<div class="modal-popup disable" >
    <div class=" modal fade" id="sortby" tabindex="-1" role="dialog" aria-hidden="true" width="200px" >
        
            <div class="modal-dialog fixed-bottom" role="document">
                <div class="modal-content " >
                   
                        <div class="modal-header">
                            <h4 class="modal-title">Sort By</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="la la-close"></span>
                            </button>
                        </div>
                  
                    <div class="modal-body text-center">
                        <ul class="sortul">
                            <li>
                                <a href="#">Popularity</a>
                            </li>
                            <li>
                                <a href="#">Price: &nbsp; Low To High</a>
    
                            </li>
                            <li>
                                <a href="#">Price: &nbsp; High To Low</a>
                            </li>
                            <!-- <li>
                                <a href="#">Extra Km Charges: &nbsp; Low To High</a>
                            </li>
                            <li>
                                <a href="#">Extra Km Charges: &nbsp; High To Low</a>
                            </li> -->
                        </ul>
    
                    </div>
                    <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div> -->
                </div>
            </div>
        
    </div>
</div>

<!-- filter -->

<div class="modal-popup">
    <div class="modal fade" id="filterby" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog fixed-bottom  " role="document" >
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title ">Filter</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="la la-close"></span>
                    </button>
                </div>
                <div class="modal-body">
					<!-- Segment -->
					<h5 class="mb-2" style="font-weight: bold;">Segment</h5>
					<div class="d-flex flex-row">
						<div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use custom-checkbox">
							<input type="checkbox" id="seg1" name="cb">
							<label for="seg1">Hatchback</label>
						</div> &nbsp; &nbsp; &nbsp; &nbsp;
						<div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use custom-checkbox">
							<input type="checkbox" id="Sed1" name="cb">
							<label for="Sed1">Sedan</label>
						</div> &nbsp; &nbsp;  &nbsp;  &nbsp;
						<div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use custom-checkbox">
							<input type="checkbox" id="SUV1" name="cb">
							<label for="SUV1">SUV</label>
						</div>
					</div>
					<!-- Brand -->
					<h5 class="mb-2" style="font-weight: bold;">Brand</h5>
					<div class="d-flex flex-row">
						<div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use custom-checkbox">
							<input type="checkbox" id="Hyu1" name="cb">
							<label for="Hyu1">Hyundai</label>
						</div> &nbsp;  &nbsp; &nbsp;  &nbsp;
						<div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use custom-checkbox">
							<input type="checkbox" id="Mar" name="cb">
							<label for="Mar">Maruti</label>
						</div> &nbsp;  &nbsp; &nbsp;  &nbsp;
						<div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use custom-checkbox">
							<input type="checkbox" id="Mahi" name="cb">
							<label for="Mahi">Mahindra</label>
						</div>
					</div>

					<!-- Fuel Type -->
					<h5 class="mb-2" style="font-weight: bold;">Fuel Type</h5>
					<div class="d-flex flex-row">
						<div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use custom-checkbox">
							<input type="checkbox" id="Diesel" name="cb">
							<label for="Diesel">Diesel</label>
						</div> &nbsp;  &nbsp; &nbsp;  &nbsp;
						<div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use custom-checkbox">
							<input type="checkbox" id="Petrol" name="cb">
							<label for="Petrol">Petrol</label>
						</div> &nbsp;  &nbsp; &nbsp;  &nbsp;
						<div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use custom-checkbox">
							<input type="checkbox" id="CNG2" name="cb">
							<label for="CNG2">CNG</label>
						</div> &nbsp;  &nbsp; &nbsp;  &nbsp;
					</div>

					<!-- Transmission Type -->
					<h5 class="mb-2" style="font-weight: bold;">Transmission Type</h5>
					<div class="d-flex flex-row">
						<div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use custom-checkbox">
							<input type="checkbox" id="Automaticcc" name="cb">
							<label for="Automaticcc">Automatic</label>
						</div> &nbsp;  &nbsp; &nbsp;  &nbsp;
						<div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use custom-checkbox">
							<input type="checkbox" id="Manualll" name="cb">
							<label for="Manualll">Manual</label>
						</div> &nbsp;  &nbsp; &nbsp;  &nbsp;
					</div>

					<!-- Seating Capacity -->
					<h5 class="mb-2" style="font-weight: bold;">Seating Capacity</h5>
					<div class="d-flex flex-row">
						<div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use custom-checkbox">
							<input type="checkbox" id="5-Seats" name="cb">
							<label for="5-Seats"> 5 Seats </label>
						</div> &nbsp;  &nbsp; &nbsp;  &nbsp;
						<div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use custom-checkbox">
							<input type="checkbox" id="7-Seats" name="cb">
							<label for="7-Seats">7 Seats </label>
						</div> &nbsp;  &nbsp; &nbsp;  &nbsp;
						<div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use custom-checkbox">
							<input type="checkbox" id="9-Seatsss" name="cb">
							<label for="9-Seatsss">9 Seats </label>
						</div> &nbsp;  &nbsp; &nbsp;  &nbsp;
					</div>




				</div>
               
            </div>
        </div>
    </div>
</div>

<!-- filetr end -->
<!-- ================================
       START FOOTER AREA
================================= -->

<section class="footer-area bg-white padding-top-90px padding-bottom-30px">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 responsive-column">
                <div class="footer-item">
                    <div class="footer-logo padding-bottom-30px header-logo">
                        <a href="https://baecars.com/" class="foot__logo"><img src="images/logo.svg" alt="logo" class="header-logo"></a>
                    </div>
                    <ul class="list-items pt-3">
                        <li>13A Parvati Nagar Extension, Jan Path, Shyam Nagar, Jaipur, Rajasthan 302019</li>
                        <li><a href="tel:0141-2782626">0141-2782626</a></li>
                        <li><a href="mailto:support@baecars.dev">support@baecars.dev</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 responsive-column">
                <div class="footer-item">
                    <h4 class="title curve-shape pb-3 margin-bottom-20px" data-text="curvs">Company</h4>
                    <ul class="list-items list--items">
                        <li><a href="about.html">About BaeCars</a></li>
                        <li><a href="blog-grid.html">Blog &amp; News</a></li>
                        <li><a href="faq.html">Frequently Asked Questions</a></li>
                        <li><a href="career.html">Careers @ BaeCars</a></li>
                        <li><a href="terms.html">Terms &amp; Conditions</a></li>
                        <li><a href="index.html">Policy</a></li>
                        <li><a href="contact.html">Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 responsive-column">
                <div class="footer-item">
                    <h4 class="title curve-shape pb-3 margin-bottom-20px" data-text="curvs">Quick Links</h4>
                    <ul class="list-items list--items">
                        <li><a href="https://baecars.com/">Self Drive Cars Provider</a></li>
                        <li><a href="javascript:;" class="select-city" data-city="Jaipur">Self Drive Cars in Jaipur</a></li>
                        <li><a href="javascript:;" class="select-city" data-city="Jhunjhunu">Self Drive Cars in Jhunjhunu</a></li>
                        <li><a href="javascript:;" class="select-city" data-city="Sikar">Self Drive Cars in Sikar</a></li>
                        <li><a href="javascript:;" class="select-city" data-city="Udaipur">Self Drive Cars in Udaipur</a></li>
                        <li><a href="javascript:;" class="select-city" data-city="Ajmer">Self Drive Cars in Ajmer</a></li>
                        <li><a href="javascript:;" class="select-city" data-city="Kota">Self Drive Cars in Kota</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 responsive-column">
                <div class="footer-item">
                    <h4 class="title curve-shape pb-3 margin-bottom-20px" data-text="curvs">Other Links</h4>
                    <ul class="list-items list--items">
                        <li><a href="https://baecars.com/">Car Rental Services Provider</a></li>
                        <li><a href="javascript:;" class="select-city" data-city="Jaipur">Car Rental Services in Jaipur</a></li>
                        <li><a href="javascript:;" class="select-city" data-city="Jhunjhunu">Car Rental Services in Jhunjhunu</a></li>
                        <li><a href="javascript:;" class="select-city" data-city="Sikar">Car Rental Services in Sikar</a></li>
                        <li><a href="javascript:;" class="select-city" data-city="Udaipur">Car Rental Services in Udaipur</a></li>
                        <li><a href="javascript:;" class="select-city" data-city="Ajmer">Car Rental Services in Ajmer</a></li>
                        <li><a href="javascript:;" class="select-city" data-city="Kota">Car Rental Services in Kota</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="section-block"></div>
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="copy-right padding-top-30px">
                    <p class="copy__desc">
                        &copy; Copyright Baecars 2020. Made with
                        <span class="la la-heart"></span> by <a
                            href="https://www.fineoutput.com/">Fineoutput</a>
                    </p>
                </div><!-- end copy-right -->
            </div><!-- end col-lg-7 -->
            <div class="col-lg-5">
                <div class="footer-social-box padding-top-30px text-right">
                    <ul class="social-profile">
                        <li><a href="http://www.facebook.com/baecarsin"><i class="lab la-facebook-f"></i></a></li>
                        <li><a href="http://www.twitter.com/bae_cars"><i class="lab la-twitter"></i></a></li>
                        <li><a href="http://instagram.com/bae.cars"><i class="lab la-instagram"></i></a></li>
                        <li><a href="http://www.youtube.com/"><i class="lab la-youtube"></i></a></li>
                        <li><a href="http://www.linkedin.com/company/baecars"><i class="lab la-linkedin-in"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section><!-- end footer-area -->
<!-- ================================
       START FOOTER AREA
================================= -->

<!-- start back-to-top -->
<div id="back-to-top">
    <i class="la la-angle-up" title="Go top"></i>
</div>
<!-- end back-to-top -->

<!-- end modal-shared -->
<div class="modal-popup">
    <div class="modal fade" id="signupPopupForm" tabindex="-1" role="dialog" aria-hidden="true" width="200px">
        <div class="modal-dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div>
                            <h5 class="modal-title title" id="exampleModalLongTitle">Sign Up</h5>
                            <p class="font-size-14">Hello! Welcome Create a New Account</p>
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="la la-close"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="contact-form-action">
                            <form method="post" action="#" class="row">
                                <div class="col-lg-6 responsive-column">
                                    <div class="input-box">
                                        <label class="label-text">Username</label>
                                        <div class="form-group">
                                            <span class="la la-user form-icon"></span>
                                            <input class="form-control" type="text" name="text"
                                                placeholder="Type your username">
                                        </div>
                                    </div><!-- end input-box -->
                                </div>
                                <hr>
                                <div class="col-lg-6 responsive-column">
                                    <div class="input-box">
                                        <label class="label-text">Mobile No.</label>
                                        <div class="form-group">
                                            <span class="la la-phone form-icon"></span>
                                            <input class="form-control" type="text" name="text"
                                                placeholder="Type your Mobile no.">
                                        </div>
                                    </div><!-- end input-box -->
                                </div>
                                <!-- <hr>
                                <div class="col-lg-6 responsive-column">
                                    <div class="input-box">
                                        <label class="label-text">Address</label>
                                        <div class="form-group">
                                            <span class="la la-home form-icon"></span>
                                            <input class="form-control" type="text" name="text"
                                                placeholder="Type your address">
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div class="col-lg-6 responsive-column">
                                    <div class="input-box">
                                        <label class="label-text">City</label>
                                        <div class="form-group">
                                            <span class="la la-map-marker form-icon"></span>
                                            <input class="form-control" type="text" name="text"
                                                placeholder="Type your city">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-lg-6 responsive-column">
                                    <div class="input-box">
                                        <label class="label-text">State</label>
                                        <div class="form-group">
                                            <span class="la la-map-marker form-icon"></span>
                                            <input class="form-control" type="text" name="text"
                                                placeholder="Type your state">
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div class="col-lg-6 responsive-column">
                                    <div class="input-box">
                                        <label class="label-text">Email</label>
                                        <div class="form-group">
                                            <span class="la la-envelope form-icon"></span>
                                            <input class="form-control" type="text" name="text"
                                                placeholder="Type your email">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 responsive-column">
                                    <div class="input-box">
                                        <label class="label-text">Aadhar Card No.</label>
                                        <div class="form-group">
                                            <span class="la la-user form-icon"></span>
                                            <input class="form-control" type="text" name="text"
                                                placeholder="Aadhar no.">
                                        </div>
                                    </div> -->
                                    <!-- end input-box -->
                                <!-- </div>
                                <div class="col-lg-6 responsive-column">
                                    <div class="input-box">
                                        <label class="label-text">Date Of Birth</label>
                                        <div class="form-group">
                                            <span class="la la-calendar form-icon"></span>
                                            <input class="date-picker-single form-control" type="text"
                                                name="daterange-single" readonly placeholder="Date of Birth">
                                        </div>
                                    </div> -->
                                    <!-- end input-box -->
                                <!-- </div>
                                <div class="col-lg-6 responsive-column">
                                    <div class="input-box">
                                        <label class="label-text">Driving Licence</label>
                                        <div class="form-group">
                                            <span class="la la-car form-icon"></span>
                                            <input class="form-control" type="text" name="text"
                                                placeholder="Driving Licence No.">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 responsive-column">
                                    <div class="input-box">
                                        <label class="label-text">Image Upload</label>
                                        <div class="form-group">
                                            <span class="la la-photo form-icon"></span>
                                            <input class="form-control" type="text" name="text"
                                                placeholder="Upload your image">
                                        </div>
                                    </div>
                                </div> -->

                                <hr>
                                <div class="col-lg-6 responsive-column">
                                    <div class="input-box">
                                        <label class="label-text">Password</label>
                                        <div class="form-group">
                                            <span class="la la-lock form-icon"></span>
                                            <input class="form-control" type="text" name="text"
                                                placeholder="Type password">
                                        </div>
                                    </div><!-- end input-box -->
                                </div>

                                <div class="col-lg-6 responsive-column">
                                    <div class="input-box">
                                        <label class="label-text">Confirm Password</label>
                                        <div class="form-group">
                                            <span class="la la-lock form-icon"></span>
                                            <input class="form-control" type="text" name="text"
                                                placeholder="Type again password">
                                        </div>
                                    </div><!-- end input-box -->
                                </div>
                                <div class="col-lg-6 responsive-column">
                                    <div class="input-box">
                                        <label class="label-text">Enter OTP</label>
                                        <div class="form-group">
                                            <span class="la la-pencil form-icon"></span>
                                            <input class="form-control" type="text" name="text"
                                                placeholder="Enter Your OTP">
                                        </div>
                                    </div><!-- end input-box -->
                                </div>
                                <div class="col-lg-6 responsive-column">
                                    <div class="input-box">
                                        <label class="label-text">GST Details(Optional)</label>
                                        <div class="form-group">
                                            <span class="la la-money form-icon"></span>
                                            <input class="form-control" type="text" name="text"
                                                placeholder="GST details(optional)">
                                        </div>
                                    </div>
                                    <!-- end input-box -->
                                </div>

                                <div class="btn-box pt-3 pb-4 padding-left-150px">
                                    <button type="button" class="theme-btn w-100">Register Account</button>
                                </div>

                                <!-- <div class="action-box text-center">
                                    <p class="font-size-14"><br><br>Or Sign up Using</p>
                                    <ul class="social-profile py-3">
                                        <li><a href="#" class="bg-5 text-white"><i
                                                    class="lab la-facebook-f"></i></a></li>
                                        <li><a href="#" class="bg-6 text-white"><i class="lab la-twitter"></i></a>
                                        </li>
                                        <li><a href="#" class="bg-7 text-white"><i class="lab la-instagram"></i></a>
                                        </li>
                                        <li><a href="#" class="bg-5 text-white"><i
                                                    class="lab la-linkedin-in"></i></a></li>
                                    </ul>
                                </div> -->
                            </form>
                        </div><!-- end contact-form-action -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- end modal-popup -->
<div class="modal-popup">
    <div class="modal fade" id="loginPopupForm" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title title" id="exampleModalLongTitle2">Login</h5>
                        <p class="font-size-14">Hello! Welcome to your account</p>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="la la-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="contact-form-action">
                        <form method="post">
                            <div class="input-box">
                                <label class="label-text">Username</label>
                                <div class="form-group">
                                    <span class="la la-user form-icon"></span>
                                    <input class="form-control" type="text" name="text"
                                        placeholder="Type your username">
                                </div>
                            </div><!-- end input-box -->
                            <div class="input-box">
                                <label class="label-text">Password</label>
                                <div class="form-group mb-2">
                                    <span class="la la-lock form-icon"></span>
                                    <input class="form-control" type="text" name="text"
                                        placeholder="Type your password">
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="custom-checkbox mb-0">
                                        <input type="checkbox" id="rememberchb">
                                        <label for="rememberchb">Remember me</label>
                                    </div>
                                    <p class="forgot-password">
                                        <a href="recover.html">Forgot Password?</a>
                                    </p>
                                </div>
                            </div><!-- end input-box -->
                            <div class="btn-box pt-3 pb-4">
                                <button type="button" class="theme-btn w-100">Login Account</button>
                            </div>

                        </form>
                    </div><!-- end contact-form-action -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- end modal-shared -->




<div class="modal-popup">
    <div class="modal fade" id="selectcity" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title title1" id="exampleModalLongTitle3"> Select your city </h5>
                        <!-- <p class="font-size-14">Hello! Select your city to continue</p> -->
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="la la-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="contact-form-action">
                        <div class="row" id="city_div1">
                            <div class="align-items-center" style="padding-left:15px ;">
                                <div class="mask flex-center rgba-red-strong">

                                    <h5> <a href=""> <img src="delhi.png" alt="" class="img-fluid rounded "
                                                class="title1 select_active" width="20%" href="#"
                                                class="select-city" data-city="Delhi" ><p class="text-dark" style="display: inline; margin-left: 15px;">Delhi</p></a></h5>

                                    <h5> <a href=""><img src="jaipurc.png" alt="" class="img-fluid rounded"
                                                class="title1" width="20%" href="#" class="select-city"
                                                data-city="Jaipur"> <p class="text-dark" style="display: inline; margin-left: 10px;"> Jaipur</p> </a></h5>

                                    <h5> <a href=""><img src="mumbai.png" alt="" class="img-fluid rounded"
                                                class="title1" width="20%" href="#" class="select-city"
                                                data-city="Mumbai"> <p class="text-dark" style="display: inline; margin-left: 10px;">
                                                    Mumbai
                                                </p> </a></h5>

                                    <h5> <a href=""><img src="kolkatac.png" alt="" class="img-fluid rounded"
                                                class="title1" width="20%" href="#" class="select-city"
                                                data-city="Kolkata"> <p class="text-dark" style="display: inline; margin-left: 10px;">
                                                    Kolkata
                                                </p> </a></h5>

                                    <h5><a href=""> <img src="chennai.png" alt="" class="img-fluid rounded"
                                                class="title1" width="20%" href="#" class="select-city"
                                                data-city="Chennai"> <p class="text-dark" style="display: inline; margin-left: 10px;">
                                                    Chennai
                                                </p> </a></h5>

                                    <h5> <a href=""><img src="hyderabadci.png" alt="" class="img-fluid rounded"
                                                class="title1" width="20%" href="#" class="select-city"
                                                data-city="Hyderabad"> <p class="text-dark" style="display: inline; margin-left: 10px;">
                                                    Hyderabad
                                                </p> </a></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- end modal-popup -->
    </div>
</div>

<!-- filter by model -->
<!-- <div class="modal-popup">
    <div class="filterbyModal fade" id="filterbyModal" role="dialog" style="z-index: 99999;">
        <div class="sortbyModal-dialog modal-dialog">
    
          
            <div class="sortbyModal-content modal-content" >
                <div class="modal-header p-1">
                    <div class="col-md-11 col-11 text-center">
                        <h6 class="modal-title">Filters</h6>
                    </div>
                    <div class="col-md-1 col-1"> <button type="button" class="close"
                            data-dismiss="modal">&times;</button>
                    </div>
                </div>
              
                <div class="modal-body">
                
                    <h5 class="mb-2" style="font-weight: bold;">Segment</h5>
                    <div class="doflex">
                        <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
                            <input type="checkbox" id="seg1" name="cb">
                            <label for="seg1">Hatchback</label>
                        </div> &nbsp; &nbsp;
                        <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
                            <input type="checkbox" id="Sed1" name="cb">
                            <label for="Sed1">Sedan</label>
                        </div> &nbsp; &nbsp;
                        <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
                            <input type="checkbox" id="SUV1" name="cb">
                            <label for="SUV1">SUV</label>
                        </div>
                    </div>
                   -->  <!-- Brand
                    <h5 class="mb-2" style="font-weight: bold;">Brand</h5>
                    <div class="doflex">
                        <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
                            <input type="checkbox" id="Hyu1" name="cb">
                            <label for="Hyu1">Hyundai</label>
                        </div> &nbsp; &nbsp;
                        <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
                            <input type="checkbox" id="Mar" name="cb">
                            <label for="Mar">Maruti</label>
                        </div> &nbsp; &nbsp;
                        <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
                            <input type="checkbox" id="Mahi" name="cb">
                            <label for="Mahi">Mahindra</label>
                        </div>
                    </div>
    
                    Fuel Type --> <!--
                    <h5 class="mb-2" style="font-weight: bold;">Fuel Type</h5>
                    <div class="doflex">
                        <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
                            <input type="checkbox" id="Diesel" name="cb">
                            <label for="Diesel">Diesel</label>
                        </div> &nbsp; &nbsp;
                        <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
                            <input type="checkbox" id="Petrol" name="cb">
                            <label for="Petrol">Petrol</label>
                        </div> &nbsp; &nbsp;
                        <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
                            <input type="checkbox" id="CNG2" name="cb">
                            <label for="CNG2">CNG</label>
                        </div> &nbsp; &nbsp;
                    </div>
    
                   Transmission Type --> <!-- 
                    <h5 class="mb-2" style="font-weight: bold;">Transmission Type</h5>
                    <div class="doflex">
                        <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
                            <input type="checkbox" id="Automaticcc" name="cb">
                            <label for="Automaticcc">Automatic</label>
                        </div> &nbsp; &nbsp;
                        <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
                            <input type="checkbox" id="Manualll" name="cb">
                            <label for="Manualll">Manual</label>
                        </div> &nbsp; &nbsp;
                    </div>
    
                 Seating Capacity -->    <!--
                    <h5 class="mb-2" style="font-weight: bold;">Seating Capacity</h5>
                    <div class="doflex">
                        <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
                            <input type="checkbox" id="5-Seats" name="cb">
                            <label for="5-Seats"> 5 Seats </label>
                        </div> &nbsp; &nbsp;
                        <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
                            <input type="checkbox" id="7-Seats" name="cb">
                            <label for="7-Seats">7 Seats </label>
                        </div> &nbsp; &nbsp;
                        <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
                            <input type="checkbox" id="9-Seatsss" name="cb">
                            <label for="9-Seatsss">9 Seats </label>
                        </div> &nbsp; &nbsp;
                    </div>
    
    
    
    
                </div>
               Segment End -->  <!--
            </div>
        </div>
    </div>
</div> -->
<!-- filter by model end -->
    
    <!-- Template JS Files -->
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
    <script src="js/moment.min.js"></script>
    <script src="js/daterangepicker.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.fancybox.min.js"></script>
    <script src="js/jquery.countTo.min.js"></script>
    <script src="js/animated-headline.js"></script>
    <script src="js/jquery.ripples-min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/wow.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.3/js/swiper.js"></script>
    <script>
        new WOW().init();
    </script>
    <script>
		$("#sbymodal").click(function () {
			$("#filterbyModal").hide();
		});
		$("#fbymodal").click(function () {
			$("#sortbyModal").hide();
		});


   

		// filter remove
		// function resetfunction() {
		// 	$('.clearcheckbox').prop("checked", false)
		// }
	</script>
    <script>
        // Add active class to the current button (highlight it)
        var header = document.getElementById("city_div1");
        var btns = header.getElementsByClassName("title1");
        for (var i = 0; i < btns.length; i++) {
            btns[i].addEventListener("click", function () {
                var current = document.getElementsByClassName("select_active");
                current[0].className = current[0].className.replace("select_active", "");
                this.className += " select_active";
                $('#selectcity').modal('hide');
            });
        }
    </script>
    <script>
        var Swipes = new Swiper('.swiper-container', {
            loop: true,
            autoplay:true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
            },
        });
    </script>
    <!--<script>
    var slideIndex = 1;
    showDivs(slideIndex);
    
    function plusDivs(n) {
      showDivs(slideIndex += n);
    }
    
    function showDivs(n) {
      var i;
      var x = document.getElementsByClassName("mySlides");
      if (n > x.length) {slideIndex = 1}
      if (n < 1) {slideIndex = x.length}
      for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";  
      }
      x[slideIndex-1].style.display = "block";  
    }
    </script>-->


</body>

</html>