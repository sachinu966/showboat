<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>User Registration</title>
  </head>
  <style>
    label {
    font-weight: 600;
    color: #666;
}
body {
  background: #f1f1f1;
}
.box8{
  box-shadow: 0px 0px 5px 1px #999;
}
.mx-t3{
  margin-top: -3rem;
}
  </style>
  <body>
  <div class="container mt-5">
  <form action="{{route('user_store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row jumbotron box8">
      <div class="col-sm-12 mx-t3 mb-4 justify-content-center">
       <center> <img src="{{asset('image/logo1.png')}}" alt="" height="100" width="200"/></center>
        <h2 class="text-center text-info">Welcome to Showboat IT</h2>
      </div>
      <div class="col-sm-12 form-group">
        <label for="name-f">Full Name</label>
        <input type="text" class="form-control" name="name" id="name-f" placeholder="Enter your full name." required>
        @error('name')<div class="invalid-feedback">{{ $message }}</div>    @enderror
      </div>
      
      <div class="col-sm-6 form-group">
        <label for="Profile">Profile</label>
        <input type="file" class="form-control" name="profile" id="Profile" required>
        @error('profile')<div class="invalid-feedback">{{ $message }}</div>    @enderror
      </div>
      <div class="col-sm-6 form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email." required>
        @error('email')<div class="invalid-feedback">{{ $message }}</div>    @enderror
      </div>
      <div class="col-sm-12 form-group">
        <label for="address">Address</label>
        <textarea class="form-control" name="address" id="address" placeholder="Enter your address." required></textarea>
        @error('address')<div class="invalid-feedback">{{ $message }}</div>    @enderror
      </div>
      <div class="col-sm-6 form-group">
    <label for="mobile">Pan Card Number</label>
    <input type="text" class="form-control" name="pan" id="pan" placeholder="Enter your pan no." required>
    @error('pan')<div class="invalid-feedback">{{ $message }}</div>    @enderror
   <div id="pan-status" class="invalid-feedback">Invalid PAN card number</div>
    <div id="pan-valid" class="valid-feedback">Valid PAN card number</div>
</div>

<div class="col-sm-6 form-group">
    <label for="adhar">Adhar Card Number</label>
    <input type="text" class="form-control" name="adhar" id="adhar" placeholder="Enter your adhar no." required>
    @error('adhar')<div class="invalid-feedback">{{ $message }}</div>    @enderror
    <div id="adhar-status" class="invalid-feedback">Invalid Aadhar card number</div>
    <div id="adhar-valid" class="valid-feedback">Valid Aadhar card number</div>
</div>


      <div class="col-sm-12 form-group mb-0">
        <button class="btn btn-primary float-right">Submit</button>
      </div>

    </div>
  </form>
</div>
@include('sweetalert::alert')

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    const panInput = $('#pan');
    const adharInput = $('#adhar');
    const panStatus = $('#pan-status');
    const adharStatus = $('#adhar-status');
    const panValid = $('#pan-valid');
    const adharValid = $('#adhar-valid');

    panInput.on('keyup', function() {
        const panValue = panInput.val();
        const isValid = validatePAN(panValue);
        if (!isValid) {
            panInput.removeClass('is-valid').addClass('is-invalid');
            panStatus.show();
            panValid.hide();
        } else {
            panInput.removeClass('is-invalid').addClass('is-valid');
            panStatus.hide();
            panValid.show();
        }
    });

    adharInput.on('keyup', function() {
        const adharValue = adharInput.val();
        const isValid = validateAadhar(adharValue);
        if (!isValid) {
            adharInput.removeClass('is-valid').addClass('is-invalid');
            adharStatus.show();
            adharValid.hide();
        } else {
            adharInput.removeClass('is-invalid').addClass('is-valid');
            adharStatus.hide();
            adharValid.show();
        }
    });

    function validatePAN(pan) {
        const panRegex = /[A-Z]{5}[0-9]{4}[A-Z]{1}$/;
        return panRegex.test(pan);
    }

    // Function to validate Aadhar card number
    function validateAadhar(adhar) {
        const adharRegex = /^\d{12}$/;
        return adharRegex.test(adhar);
    }
});
</script>


  </body>
</html>