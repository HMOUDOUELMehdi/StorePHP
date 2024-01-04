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
          </div>
        </div>
</nav>

<div class="container-fluid">
    <div class="container">
        <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-success text-white" style="text-align: center; padding:1%;"><h3>Create a compte</h3></div>
            <div class="card-body">   

<form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

              <label for="firstName"> First Name</label>
              <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Your First Name">

              <label for="lastName">Last Name</label>
              <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Your Last  Name">

              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Email">

              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Password">

              <input type="submit" name="Create" id="Create" class="btn btn-success btn-xs" value="Create Now" style="display:block; margin-top:1%; margin-bottom:1%;">




<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $Create = $_POST["Create"];
    
    $root = $_SERVER["DOCUMENT_ROOT"];
    include_once $root."/store/database/db.php";
    
    $dbo = new Database();

    // check if button clicked
    if (isset($Create)) {
        if (!empty($firstName) && !empty($lastName) && !empty($email) && !empty($password)) {
            // Validate First Name
            if (!preg_match('/^[A-Z][a-z]*$/', $firstName)) {
                echo '<div class="alert alert-danger" role="alert">First name must start with an uppercase letter.</div>';
            }

            // Validate Last Name
            if (!preg_match('/^[A-Z][a-z]*$/', $lastName)) {
                echo '<div class="alert alert-danger" role="alert">Last name must start with an uppercase letter.</div>';
            }

            
            // Validate Password
            if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password)) {
                echo '<div class="alert alert-danger" role="alert">Password must contain at least 8 characters, including letters, numbers, and special characters.</div>';
                exit();
            }
            
            $query = "SELECT * FROM userinfo WHERE email = :email";
            $stmt = $dbo->connect->prepare($query);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            
            $count = $stmt->rowCount();
            
            if ($count > 0) {
                echo "<div class='alert alert-danger  role='alert'> Error.this email already exist    </div>";
                exit();
            }

function createnewcompte($dbo, $firstName, $lastName, $email, $password)
{
    $cmd = "INSERT INTO userinfo
            (firstname, lastname, email, password)
            VALUES
            (:firstname, :lastname, :email, :password)";

    $statement = $dbo->connect->prepare($cmd);

    try {
        $statement->execute([
            ":firstname" => $firstName,
            ":lastname" => $lastName,
            ":email" => $email,
            ":password" => $password,
        ]);

        return 1;
    } catch (Exception $t) {
        return 0;
    }
}

$result = createnewcompte($dbo, $firstName, $lastName, $email, $password);

if ($result == 1) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        Your Compte is Created Go To the Home Page To Log in    
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
        header("Location: /store/login.php");

} else {
    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        Error Please Re-enter Your infermation   
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
}

        } else {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                Invalid inputs    
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
        }
    }
}
?>




</form> 



            </div> 
            <!-- <div class="card-footer"><div id="login_msg"></div></div>      -->
        </div>
        </div>
    </div>
</div>

<script src="js/jquery.js"></script>
<!-- <script src="js/script.js"></script> -->
<script src="js/bootstrap.js"></script>
</body>
</html>