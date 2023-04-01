<?php
$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'partials/_dbconnect.php';
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $uid = $_POST['uid'];
    // $exists=false;
    $existSql = "SELECT * FROM `tsloginsys` WHERE username = '$username'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows > 0){
        // $exists = true;
        $showError = "Username already exists.";
    }
    else{
        // $exists = false;
        if(($password == $cpassword) && $uid == '$2y$10$wTuRvMMvS6Mtrlu1s.9qdeglbEMdCZxaUlf2no5w9wfxaby.DlbnO'){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `tsloginsys` (`username`, `password`, `dt`) VALUES ('$username', '$hash', current_timestamp());";
            $result = mysqli_query($conn, $sql);
            if($result){
                $showAlert = true;
            }
        }
        else{
            $showError = "Passwords do not match or UID is false.";
        }

}
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Sign Up</title>
  </head>
  <body>
    <?php require 'partials/_nav.php' ?>
    <?php
    if($showAlert){
    echo '
    <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Your account has now been created and you can log-in.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div> ';
    }
    if($showError){
        echo '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Error!</strong> '. $showError.'
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div> ';
        }
    ?>

    <div class="container my-4">
        <h1 class="text-center"> Sign-Up To Our Website </h1>
        <form action="/tsloginsys/signup.php" method="post">
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" id="username" aria-describedby="emailHelp" name="username" placeholder="Enter your username">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
  </div>
  <div class="form-group">
    <label for="cpassword">Confirm Password</label>
    <input type="password" class="form-control" id="password" name="cpassword" placeholder="Confirm your password">
    <small id="passwordHelp" class="form-text text-muted">Make sure to enter the exact same password. </small>
  </div>
  <div class="form-group">
    <label for="Unique ID">UID</label>
    <input type="password" class="form-control" id="uid" name="uid" placeholder="Enter Admin UID">
  </div>
  <button type="submit" class="btn btn-primary">Sign-Up</button>
</form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>