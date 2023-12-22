<style>
    .banner-21 {
    height: auto;
    position: relative;
    margin-top: 108px;
}
.ltn__login-area{
    padding: 30px 0px;
}
</style>
<div class="banner-21" style="">
    <div id="banner-part  " class="banner inner-banner inner-banner mb-3">
        <div class="container">
            <div class="bread-crumb-main">
   
                <div class="breadcrumb">
                    <ul class="inline">
                        <li><a href="<?= base_url() ?>">Home</a>
                        </li>
                        <li>Reset Password</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="ltn__login-area pb-110">
        <div class="container">

            <div class="row">
                <div class="col-lg-7 mx-auto form-style ">
                <h3 class="section-title text-center">Reset Password  </h3>
                    <div class="account-login-inner">
                        <form action="<?= base_url() ?>Home/update_password/<?= $auth ?>" enctype="multipart/form-data" method="POST">
                            <label for="" class="form-label">Enter Password</label>
                            <input type="password" class="form-control" placeholder="Enter Password" id="pswd1" aria-label="Enter password"  name="reset_password" required>
                            <span id="message1" style="color:red"> </span>
                    </div>
                    <div class="btn-wrapper">
                        <button class="btn btn-fill-out btn-block text-uppercase mt-2 rounded-0 btn-color " style="padding: 14px 18px;" type="submit">Submit</button>
                    </div>
                    </form>
                    <div class="by-agree text-center">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
