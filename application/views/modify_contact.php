
    <style media="screen">
      .text-decoration-underline{
        text-decoration: underline !important;
      }

      .borfder-radius-50{
        border-radius: 50%;
      }

      .contact_heading{
        width: 50px;
      height: 50px;
      padding: 9px;
      text-align: center;
      }

      /* Chrome, Safari, Edge, Opera */
      input::-webkit-outer-spin-button,
      input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
      }

      /* Firefox */
      input[type=number] {
        -moz-appearance: textfield;
      }

      @media (max-width: 767px) {
        .flex-col-mob-revert{
          flex-direction: column-reverse !important;
        }
        .sm-mob-width-100{
          width: 100%;
          text-align: center;
        }
      }
      p{
      font-size: 15px;
      }

    </style>

    <br>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h3>Modify a <?echo $product_data->description;?></h3>
          <b><p><h5>Starts at <span>$</span>11328.40</h5></p></b>

        </div>
      </div>
      <div class="row flex-col-mob-revert">

        <div class="col-md-8">
          <p>
            <?echo $content_data->text;?>
          </p>
          <!-- <div class="col-12 py-3 text-center" style="background: #e1e1e1;">
            <p class="h6">have questions?</p>
            <p class="h6">Call 800-527-5057 now.</p>
          </div>
          <a href="javascript:void(0)" >
            <button type="button" name="button" style="background: #547f9e;color: white;" class="btn text-uppercase shadow-sm mt-3 mb-3 sm-mob-width-100">view all services</button>
          </a> -->
        </div>
        <div class="col-md-4 text-center">
            <img src="<?=$product_data->FullySetImage1?>" class="img-fluid" alt="">
          <!-- <div class="embed-responsive embed-responsive-4by3">
              <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/v64KOxKVLVg" allowfullscreen></iframe>
          </div> -->
        </div>
      </div>
    </div>

    <div class="container mt-5">
      <div class="row my-3">
        <!-- <div class="col-2 col-md-1">
          <h4 class="contact_heading text-light borfder-radius-50" style="background: #547f9e;"><span>1</span></h4>
        </div> -->
        <div class="col-md-12 col-10 m-auto" style="color: #547f9e;">
          <h4>Contact Information</h4>
        </div>
      </div>

      <div class="row">
        <div class="col-12" style="background: #c4dced;">
          <div class="mt-1 py-3" style="color: #075d9b;">
            <h5><i class='fas fa-exclamation-triangle'></i><span class="px-2">Please verify contact information for this request is correct.</span></h5>
          </div>
        </div>
      </div>

      <div class="row py-5">

        <div class="col-12">
          <form class="needs-validation" method="POST" novalidate action="<?=base_url()?>Home/modify_contact/<?=$id?>">

    <div class="form-row row mb-3">
        <label for="validationCustom04" class="col-sm-2 col-form-label">Your Name</label>
        <div class="col-md-10 ">
          <input type="text" class="form-control" name="name" id="validationCustom04" placeholder="Enter Name" required>
          <div class="invalid-feedback">
            Please provide Your Name.
          </div>
        </div>
    </div>
    <div class="form-row row mb-3">
        <label for="validationCustom01" class="col-sm-2 col-form-label">Bussiness Phone</label>
        <div class="col-md-10">
          <input type="number" class="form-control" name="b_phone" id="validationCustom01" placeholder="#" required>
          <div class="valid-feedback">
            Looks good!
          </div>
        </div>
      </div>
    <div class="form-row row mb-3">
        <label for="validationCustom02" class="col-sm-2 col-form-label">Mobile Number</label>
        <div class="col-md-10">
          <input type="number" class="form-control" name="m_phone" id="validationCustom02" placeholder="#" required>
          <div class="valid-feedback">
            Looks good!
          </div>
        </div>
      </div>
      <div class="form-row row mb-3">
        <label for="validationCustomEmail" class="col-sm-2 col-form-label">Email</label>
          <div class="col-md-10">
            <input type="email" class="form-control" name="email" id="validationCustomEmail" placeholder="Enter Email" required>
            <div class="invalid-feedback">
              Please Enter Your Email.
            </div>
          </div>
      </div>
    <div class="form-row row mb-3">
      <label for="validationCustom03" class="col-sm-2 col-form-label">AccountNumber</label>
      <div class="col-md-10">
        <input type="text" class="form-control" name="acc_no" id="validationCustom03" placeholder="Account Number" required>
        <div class="invalid-feedback">
          Please provide a  Account Number.
        </div>
      </div>
    </div>
    <!-- <div class="form-group">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
        <label class="form-check-label" for="invalidCheck">
          Automatically accept model Modification Carges
        </label>
        <div class="invalid-feedback">
          You must Accept before submitting.
        </div>
      </div>
    </div> -->
    <div class="row">
      <div class="col-12 text-center">
        <button class="btn text-center" style="background: #547f9e; color:white" type="submit">Submit Now</button>
      </div>
    </div>
  </form>
        </div>
      </div>

    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
    </script>
