<?php 
session_start();

$root = $_SERVER["DOCUMENT_ROOT"];
include_once $root."/store/database/db.php";

$dbo = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    $query = "SELECT firstname FROM userinfo WHERE email = :email AND password = :password";
    $stmt = $dbo->connect->prepare($query);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $stmt->execute();

    $count = $stmt->rowCount();

    if ($count == 1) {
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $firstName = $row['firstname'];
      $_SESSION['loginSuccess'] = true;
      $_SESSION['firstName'] = $firstName;
      header("Location: userinterface.php");
      exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="global/bootstrap.css" rel="stylesheet" />
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

        <div class="container-fluid">
          <a class="navbar-brand" href="#">Online Store </a>
          <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <div class="navbar-toggler-icon"></div>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item m-2">
                <a class="nav-link active" aria-current="page" href="ui.php">Home</a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
              </li> -->
              <!-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Dropdown
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled" href="#">Disabled</a>
              </li>
            </ul>
            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form> -->
          </div>
        </div>
</nav>

<div class="container-fluid">
    <div class="container">
        <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
        <div class="card">
            <div class="card-header lg bg-primary text-white" style="text-align: center; "><h1>Log in</h1></div>
            <div class="card-body">
<!-- action="/store/userName/userName.php" -->
<form  method="post">

              <label for="firstName">Your Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Your Email">


              <!-- <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Your First Name"> -->


              <label for="lastName">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Your Password">

              <input type="submit" name="Log"  class="btn btn-primary lg p-3 m-3 " value="Log in" >

</form> 


<?php
$root = $_SERVER["DOCUMENT_ROOT"];
include_once $root."/store/database/db.php";

$dbo = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    // $loginSuccess;

    if (isset($_POST["Log"])) {

        if (empty($email) || empty($password)) {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            Both email and password are required.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        } else {
            $query = "SELECT * FROM userinfo WHERE email = :email AND password = :password";
            $stmt = $dbo->connect->prepare($query);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->execute();

            $count = $stmt->rowCount();

            if ($count == 1) {
              // log in success
              header("Location: userinterface.php");
              exit();
            } else {
                // Log in failed
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                Invalid email or password.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }
        }
    }
}
?>



<div id="loginResult"></div>

            </div> 
            <!-- <div class="card-footer"><div id="login_msg"></div></div>      -->
        </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>

<script src="js/jquery.js"></script>
<script src="/store/controle carts/script2.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>



<?php



?>