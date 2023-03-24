<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Register Here.</title>
</head>

<body>
  <div class="container">
    <div class="row m-5 offset-2 mt-5">
      <div class="col-5 offset-3 mt-5">
        <h1 class="mt-5 text-center"> Register Page
</h1>
<?php
if(session()->get('success')){
  echo session()  ->get('success');
}

?>
<div class="text-danger"><?= validation_list_errors() ?></div>
        <form method="post" action="<?= base_url() ?>register">
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">First Name<spam class="text-danger">*</spam></label>
            <input type="text" name="Fname" class="form-control" placeholder=" Enter First Name" value="<?= set_value('Fname') ?>" id="exampleInputEmail1" aria-describedby="emailHelp" required>
            <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Last Name<spam class="text-danger">*</spam></label>
            <input type="text" name="Lname" class="form-control" value="<?= set_value('Lname') ?>" placeholder=" Enter Last Name" id="exampleInputEmail1" aria-describedby="emailHelp" required>
            <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email Address<spam class="text-danger">*</spam></label>
            <input type="email" name="email" class="form-control" value="<?= set_value('email') ?>" placeholder=" Enter Last Name" id="exampleInputEmail1" aria-describedby="emailHelp"required>
            <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Referral Id<spam class="text-danger">*</spam></label>
            <input type="text" name="ReferId" value="<?= set_value('ReferId') ?>" class="form-control" id="exampleInputEmail1" placeholder=" Enter Referral Id" aria-describedby="emailHelp"required>
            <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Pan Card<spam class="text-danger">*</spam></label>
            <input type="text" name="pan" value="<?= set_value('pan') ?>" class="form-control" id="exampleInputEmail1" placeholder=" Enter Pan Card Number" aria-describedby="emailHelp"required>
            <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password<spam class="text-danger">*</spam></label>
            <input type="password" name="password" value="<?= set_value('password') ?>" class="form-control" id="exampleInputPassword1" placeholder=" Enter Password">
          </div>
          <div class="mb-3 text-center">
          
            <button type="submit" class="btn btn-primary text-center">Submit</button>
          </div>
         
        </form>

      </div>
    </div>

  </div>




  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>