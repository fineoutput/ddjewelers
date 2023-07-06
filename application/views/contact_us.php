<style>
    .btn-primary {
        background-color: #1a3065;
        border-color: #122247;
        box-shadow: inset 0 1px 0 hsla(0, 0%, 100%, .15), 0 1px 1px 2px 5px rgba(0, 0, 0, .075) rgba(0, 0, 0, .4);
        color: #fff;
    }
    .btn-primary:focus,
    .btn-primary:hover {
        color: #fff;
        background-color: #101d3c;
        border-color: #1f3a79;
    }
    .btn-primary:focus {
        box-shadow: 0 0 0 .2rem rgba(54, 67, 98, .5);
    }
    .btn-primary:disabled {
        color: #fff;
        background-color: #1a3065;
        border-color: #122247;
    }
    .widget-emailform form .is-required .form-control-label {
        font-weight: 700;
    }
    .widget-emailform form .required {
        color: #f00;
    }
    @media (max-width:1199.98px) {
        .widget-emailform form {
            text-align: left;
            margin-bottom: 2rem;
        }
    }
    .submission-spinner {
        margin-left: 8px;
    }
    .widget-location .location-listing .card {
        margin-bottom: 1rem;
        padding: 1rem;
        background-color: transparent;
    }
    @media (max-width:575.98px) {
        .widget-location .location-listing .card {
            text-align: center;
        }
    }
    .widget-location .location-listing .card-hours:not(.style-canvas) h3 {
        position: relative;
        font-size: 1.1rem;
    }
    @media (max-width:575.98px) {
        .widget-location .location-listing .card-hours:not(.style-canvas) h3 {
            white-space: nowrap;
        }
    }
    @media (max-width:1199.98px) {
        .widget-location .location-listing .card-hours .hours-inner {
            width: 100%;
            text-align: center;
        }
    }
    @media (max-width:991.98px) {
        .widget-location .location-listing .card-hours {
            display: flex;
            flex-flow: column nowrap;
            align-items: center;
            justify-content: center;
            width: 100%;
        }
    }
    .widget-location .location-listing .card-hours .collapse {
        margin-bottom: 1rem;
    }
    .widget-location .location-listing .card-hours .hours-inner p[data-toggle=collapse] {
        font-size: .95rem;
    }
    @media (max-width:1199.98px) {
        .widget-location .location-listing .card-hours .hours-inner {
            width: auto;
            text-align: left;
        }
    }
    .widget-location .location-listing .card-hours dl.row-hours {
        margin-bottom: 0;
    }
    .widget-location .location-listing .card-hours dl.row-hours.active {
        font-weight: 700;
    }
    .widget-location .location-listing .card-hours dl.row-hours dd {
        margin-bottom: 0;
    }
    .widget-location .location-listing .card-hours dl.row-hours dd {
        font-size: .95rem;
    }
    .widget-location .location-listing .card-address {
        position: relative;
        font-size: inherit;
        /* padding-left:0; */
    }
    .widget-location .location-listing .card-address .actions {
        padding-top: .5rem;
        font-size: inherit;
    }
    .widget-location h2 {
        padding-bottom: .5rem;
        font-size: inherit;
    }
    @media (max-width:575.98px) {
        .widget-location .card {
            padding: 0;
            border: none;
        }
        .widget-location h2 {
            padding: 0 0 .5rem !important;
        }
    }
</style>
<div class="title-wrapper pt-5 pb-5">
    <div class="container">
        <div class="row w-100 d-flex justify-content-center">
            <div class="column column-full col-xs-12 text-center">
                <h1 class="text-center">
                    Contact Us
                </h1>
            </div>
        </div>
        <?php if (!empty($this->session->flashdata('smessage'))) { ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                <?php echo $this->session->flashdata('smessage'); ?>
            </div>
        <?php }
        if (!empty($this->session->flashdata('emessage'))) { ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                <?php echo $this->session->flashdata('emessage'); ?>
            </div>
        <?php } ?>
    </div>
</div>
<div class="content-wrapper">
    <div class="container">
        <div class="columns">
            <div class="row row-columns">
                <div id="80dd5b18-a986-40a4-8df0-ab52f9ad1e7e" class="widget section-widget widget-emailformemailform   col-8 widget-emailform hidden-print ">
                    <!-- 
                    <div class="widget-title ">
                        <h2>
                            Send a Message
                        </h2>
                    </div> -->
                    <div class="widget-content ">
                        <form id="form-emailform" action="<?= base_url() ?>Home/add_contact_process" method="post" enctype="multipart/form-data">
                            <div class="fieldset">
                                <input id="id_timestamp" name="timestamp" type="hidden" value="1623841334">
                                <input id="id_security_hash" name="security_hash" type="hidden" value="346bd695a84f5e593067a6762214bc731c7cc896">
                                <!-- <div class="form-group charfield honeypot">
                                    <input autocomplete="off" class="form-control" id="id_honeypot" name="honeypot" type="text">
                                    <span class="form-text">
                                    </span>
                                </div> -->
                                <div class="form-group charfield first_name is-required">
                                    <label for="id_first_name" class="form-control-label" aria-lael="First Name Required">
                                        First Name <span class="required">*</span>
                                    </label>
                                    <input class="form-control" id="id_first_name" required name="fname" type="text">
                                    <span class="form-text">
                                    </span>
                                </div>
                                <div class="form-group charfield last_name is-required">
                                    <label for="id_last_name" class="form-control-label" aria-lael="Last Name Required">
                                        Last Name <span class="required">*</span>
                                    </label>
                                    <input class="form-control" id="id_last_name" required name="lname" type="text">
                                    <span class="form-text">
                                    </span>
                                </div>
                                <div class="form-group charfield phone is-required">
                                    <label for="id_phone" class="form-control-label" aria-lael="Phone Required">
                                        Phone <span class="required">*</span>
                                    </label>
                                    <input class="form-control" id="id_phone" required name="phone" type="text">
                                    <span class="form-text">
                                    </span>
                                </div>
                                <div class="form-group emailfield email_address is-required">
                                    <label for="id_email_address" class="form-control-label" aria-lael="Email Address Required">
                                        Email Address <span class="required">*</span>
                                    </label>
                                    <input class="form-control" id="id_email_address" required name="email" type="email">
                                    <span class="form-text">
                                    </span>
                                </div>
                                <div class="form-group charfield message">
                                    <label for="id_message" class="form-control-label">
                                        Message
                                    </label>
                                    <textarea class="form-control" cols="40" id="id_message" required name="message" rows="10"></textarea>
                                    <span class="form-text">
                                    </span>
                                </div>
                                <div class="form-group captchafield verification is-required">
                                    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                                    <div class="g-recaptcha" name="g-recaptcha-response" data-sitekey="6LeGH_QmAAAAAESodt2Bw0XfNXuFfy0SkwMXOaQl"></div>
                                    <!-- <label for="id_verification_1" class="form-control-label" aria-lael="Verification Required">
                            Verification <span class="required">*</span>
                        </label> -->
                                    <!-- <img src="https://www.jewelplus.com/captcha/image/6cbc6cf6beae7a3fb00593bcc1ac07fe9069e3f8/" alt="captcha" class="captcha"><input id="id_verification_0" name="verification_0" type="hidden" value="6cbc6cf6beae7a3fb00593bcc1ac07fe9069e3f8"> -->
                                    <!-- <input autocapitalize="off" autocomplete="off" autocorrect="off" spellcheck="false" id="id_verification_1" name="verification_1" type="text"> -->
                                    <!-- <span class="form-text">
                        Prove you are not a robot.
                    </span> -->
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Submit
                                <!-- <i class="fa fa-arrow-circle-o-right"></i> -->
                            </button>
                            <span class="submission-spinner fas fa-fw fa-spinner fa-spin" style="display: none" aria-hidden="true"></span>
                            <!-- <p style="margin-top: 2rem;"><small>
        This site is protected by reCAPTCHA and the Google
        <a href="https://policies.google.com/privacy" target="_blank">Privacy Policy</a> and
        <a href="https://policies.google.com/terms" target="_blank">Terms of Service</a> apply.
    </small></p> -->
                            <div id="custom_form" class="g-recaptcha" style="visibility: hidden;">
                                <div class="grecaptcha-badge" data-style="inline" style="width: 256px; height: 60px; box-shadow: gray 0px 0px 5px;">
                                    <div class="grecaptcha-logo"><iframe title="reCAPTCHA" src="https://www.google.com/recaptcha/api2/anchor?ar=1&amp;k=6LeGH_QmAAAAAESodt2Bw0XfNXuFfy0SkwMXOaQl&amp;co=aHR0cHM6Ly93d3cuamV3ZWxwbHVzLmNvbTo0NDM.&amp;hl=en&amp;v=6OAif-f8nYV0qSFmq-D6Qssr&amp;size=invisible&amp;badge=inline&amp;cb=f3cqgfdgdukd" width="256" height="60" role="presentation" name="a-6p2028lj629z" frameborder="0" scrolling="no" sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox"></iframe></div>
                                    <div class="grecaptcha-error"></div><textarea id="g-recaptcha-response" name="g-recaptcha-response" class="g-recaptcha-response" style="width: 250px; height: 40px; border: 1px solid rgb(193, 193, 193); margin: 10px 25px; padding: 0px; resize: none; display: none;"></textarea>
                                </div><iframe style="display: none;"></iframe>
                            </div>
                        </form>
                        <div class="confirmation conceal d-none">
                            <hr>
                            <h4 style="text-align: center;"><strong>Thank you for your submission. One of our experienced team members will be in touch with you shortly.</strong></h4>
                            <hr>
                        </div>
                    </div>
                </div>
                <div id="f2c5742b-21a2-404e-a6d9-72161e78531f" class="widget section-widget widget-ts_companylocations   col-4  widget-location ">
                    <div class="widget-header ck-content  conceal">
                    </div>
                    <div class="widget-content ">
                        <div class="location-listing location-layout-box">
                            <div class="location-container slug-walnut-creek">
                                <div class="inner">
                                    <h2 style="text-align: center;">
                                        <a href="/company/locations/walnut-creek/" title="Walnut Creek" aria-label="Walnut Creek"><? if (!empty($contact_data[0]->address_heading)) {
                                                                                                                                        echo $contact_data[0]->address_heading;
                                                                                                                                    } ?></a>
                                    </h2>
                                    <div class="card card-body card-phone">
                                        <a href="tel:<? if (!empty($contact_data[0]->number)) {
                                                            echo $contact_data[0]->number;
                                                        } ?>" class="phone-number" aria-label="Call (925) 274-1444" onclick="gtag('event', 'click_to_call' , { 'event_category': 'Calls', 'event_label': 'Walnut Creek'});">
                                            <? if (!empty($contact_data[0]->number)) {
                                                echo $contact_data[0]->number;
                                            } ?>
                                        </a>
                                    </div>
                                    <div class="card card-body card-address">
                                        <div class="address-wrapper"><span class="address"><? if (!empty($contact_data[0]->address)) {
                                                                                                echo $contact_data[0]->address;
                                                                                            } ?></span></div>
                                        <div class="actions">
                                            <a href="<? if (!empty($contact_data[0]->map_address)) {
                                                            echo $contact_data[0]->map_address;
                                                        } ?>" title="Walnut Creek Location Map" target="_blank" aria-label="View Map" onclick="gtag('event', 'click_to_maps' , { 'event_category': 'Maps', 'event_label': 'Walnut Creek'});">View
                                                Map</a>
                                        </div>
                                    </div>
                                    <div class="card card-body card-hours">
                                        <h3>Store Hours</h3>
                                        <div class="hours-inner">
                                            <div class="dropdown">
                                                <p><? if (!empty($contact_data[0]->hours_list)) {
                                                        echo $contact_data[0]->hours_list;
                                                    } ?></p>
                                                <!-- <p data-toggle="collapse" href="#collapse1" role="button" aria-expanded="false" aria-controls="collapse1">
                                                    Today:
                                                    <span class="id-current-day" data-ordering="today" data-day="Tue">
                                                        10:30AM - 5PM
                                                    </span>
                                                    <i class="fas fa-caret-down"></i>
                                                </p>
                                                <div class="collapse" id="collapse1">
                                                    <dl class="row row-hours active">
                                                        <dd class="column col-3">Wed</dd>
                                                        <dd class="column col-9">
                                                            10:30AM - 5PM
                                                        </dd>
                                                    </dl>
                                                    <dl class="row row-hours">
                                                        <dd class="column col-3">Thu</dd>
                                                        <dd class="column col-9">
                                                            10:30AM - 5PM
                                                        </dd>
                                                    </dl>
                                                    <dl class="row row-hours">
                                                        <dd class="column col-3">Fri</dd>
                                                        <dd class="column col-9">
                                                            10:30AM - 5PM
                                                        </dd>
                                                    </dl>
                                                    <dl class="row row-hours">
                                                        <dd class="column col-3">Sat</dd>
                                                        <dd class="column col-9">
                                                            10:30AM - 4PM
                                                        </dd>
                                                    </dl>
                                                    <dl class="row row-hours">
                                                        <dd class="column col-3">Sun</dd>
                                                        <dd class="column col-9">
                                                            Closed
                                                        </dd>
                                                    </dl>
                                                    <dl class="row row-hours">
                                                        <dd class="column col-3">Mon</dd>
                                                        <dd class="column col-9">
                                                            10:30AM - 5PM
                                                        </dd>
                                                    </dl>
                                                    <dl class="row row-hours">
                                                        <dd class="column col-3">Tue</dd>
                                                        <dd class="column col-9">
                                                            10:30AM - 5PM
                                                        </dd>
                                                    </dl>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="nav-wrapper d-none-print">
            <div class="container">
                <div class="row">
                    <div class="column column-full section-nav col-sm-12 d-md-block d-lg-none text-center">
                        <div id="7def4d5b-1606-472f-be59-da25f0f9f56c" class="widget section-widget widget-pagesmenu     section-widget-nav widget-nav widget-nav-links-overflow d-print-none ">
                            <div class="widget-content ">
                                <nav class="navbar hidden-sm-up navbar-light bg-faded" role="navigation">
                                    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-label">View Menu</span>
                                        <span class="navbar-toggler-icon"></span>
                                    </button>
                                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                        <ul class="main nav">
                                            <li class="nav-item menu-parent-contact-us-1 active" data-tsmpk="249">
                                                <a class="nav-link contact-us-1 active" href="/contact-us/" title="Contact Us" target="_self" data-tsmpk="249" aria-label="Contact Us">
                                                    <span>
                                                        Contact Us
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="nav-item menu-parent-write-testimonial-1" data-tsmpk="251">
                                                <a class="nav-link write-testimonial-1 last" href="/testimonials/form/" title="Write a Testimonial" target="_self" data-tsmpk="251" aria-label="Write a Testimonial">
                                                    <span>
                                                        Write a Testimonial
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>