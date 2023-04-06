
<!-- poup start -->
<section class="register_row">
<section class="pop_sec mt-5 mb-5 ">
<!-- from the tutorial https://medium.freecodecamp.org/how-to-build-a-double-slider-sign-in-and-sign-up-form-6a5d03612a34 -->
<? if(!empty($this->session->flashdata('smessage'))){ ?>
					<div class="alert alert-success">
						<strong><? echo $this->session->flashdata('smessage'); ?></strong>
					</div>
				<? }
				 if(!empty($this->session->flashdata('emessage'))){ ?>
				<div class="alert alert-danger">
					<strong><? echo $this->session->flashdata('emessage'); ?></strong>
				</div>
			<? } ?>
<div class="container pop_up" id="container">
	<div class="form-container sign-up-container">
		<form action="<?echo base_url() ?>Home/add_register_data" method="post">
			<h1>Create Account</h1>
            <br>

			<!-- <div class="social-container">
				<a href="#" class="social"><i class="fa fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fa fa-google-plus"></i></a>
				<a href="#" class="social"><i class="fa fa-linkedin"></i></a>
			</div>
			<span>or use your email for registration</span> -->
			<input type="text" placeholder="Name" name="name" required=""/>
			<input type="email" placeholder="Email" name="email" required=""/>
			<input type="password" placeholder="Password" name="psw" required=""/>
			<button>Sign Up</button>
		</form>
	</div>
	<div class="form-container sign-in-container">
		<form action="<?echo base_url(); ?>Home/login" method="post">
			<h1>Sign in</h1>
            <br>
			<!-- <div class="social-container">
				<a href="#" class="social"><i class="fa fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fa fa-google-plus"></i></a>
				<a href="#" class="social"><i class="fa fa-linkedin"></i></a>
			</div> -->
			<!-- <span>or use your account</span> -->
			<input type="email" placeholder="Email" name="email" required=""/>
			<input type="password" placeholder="Password" name="psw" required=""/>
			<a href="#">Forgot your password?</a>
			<button>Sign In</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Welcome Back!</h1>
				<p>To keep connected with us please login with your personal info</p>
				<button class="ghost" id="signIn">Sign In</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Hello, Friend!</h1>
				<p>Enter your personal details and start journey with us</p>
				<button class="ghost" id="signUp">Sign Up</button>
			</div>
		</div>
	</div>
</div>
</section>


<section class="mob_log">
  <div class="container-fluid pl-5 pr-5 pt-3 pb-5">
    <div class="row">
      <div class="col-md-12 page_span">
        <p><span>Home</span> > <span> SHOPPING CART </span>> <span> SUBMIT INQUIRY </span></p>
      </div>
    </div>


    <div class="row register_row">
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-12 text-center">
            <h2>Login</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <form>
              <label>Email Address: *</label>
              <input type="Email" name="Email" placeholder="">
              <label>Password: *</label>
              <input type="Password" name="Password" placeholder="">
              <button class="sub_btn">SUBMIT</button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-12 text-center">
            <h2>Sign up</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <form>
              <label>First Name: *</label>
              <input type="text" name="name" placeholder="">
              <label>Last Name: *</label>
              <input type="text" name="name" placeholder="">
              <label>Phone Number: *</label>
              <input type="number" name="number" placeholder="">
              <label>Email Address: *</label>
              <input type="Email" name="Email" placeholder="">
              <label>Confirm Email Address: *</label>
              <input type="Email" name="Email" placeholder="">
              <label>Password: *</label>
              <input type="Password" name="Password" placeholder="">
              <label>Confirm Password: *</label>
              <input type="Password" name="Password" placeholder="">
              <button class="sub_btn">SUBMIT</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>




</section>

<!-- poup end -->



<!-- script start -->



<!-- script end -->
