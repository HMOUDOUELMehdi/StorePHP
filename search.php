


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
                <a class="nav-link active" aria-current="page" href="userinterface.php">Home</a>
              </li>
          </div>
        </div>
</nav>



    <section class="py-5 bg-light">
            <div class="container px-4 px-lg-5 mt-5">
                <h2 class="fw-bolder mb-4" id="NameCatg">products</h2>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center" id="listCarts">
<?php
$root = $_SERVER["DOCUMENT_ROOT"];
include_once $root."/store/database/db.php";

$dbo = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get the search query from the form
    $query = $_POST['search'];

    // Construct the SQL query
    $sql = "SELECT * FROM products WHERE productName LIKE '%$query%'";

    $result = $dbo->connect->prepare($sql);
    $result->execute();

    if ($result->rowCount() > 0) {
        // Output data of each row
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo '
            <div class="col mb-5">
                <div class="card h-100">
                    <!-- Product image-->
                    <img class="card-img-top" style="width:100%; height:300px;" src=" img/'. $row['productImg'] . '" alt="..." />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder">' . $row['productName'] . '</h5>
                            <!-- Product price-->
                            ' . $row['productPrice'] . 'DH
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center">
                            <a class="btn btn-outline-dark mt-auto btnADD" href="#" 
                                data-img="' . $row['productImg'] . '" 
                                data-name="' . $row['productName'] . '" 
                                data-price="' . $row['productPrice'] . '">Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>';
        }
    } else {
        echo "No results found";
    }
}
?>
                </div>
            </div>
</section>




<script src="js/jquery.js"></script>
<script src="/store/controle carts/script2.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>



<?php



?>