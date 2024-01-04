<?php
session_start();

if (!$_SESSION['loginS']) {
    header("Location: /store/login.php");
    exit();
}

$root = $_SERVER["DOCUMENT_ROOT"];
include_once $root."/store/database/db.php";
$dbo = new Database();

// ...
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action1'] ;

    if ($action == "let carts to page") {
        $sql="SELECT * FROM carts";
        $stmt = $dbo->connect->prepare($sql);
        $stmt->execute();
        $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);             
        try {
            if (count($cartItems) > 0) {
                foreach ($cartItems as $item) {
                    echo '
                    <div class="row bg-light text-center" style="display:flex;align-items:center;justify-content: center;text-align: center;">
                        <div class="col-md-2 text-center my-auto" style="margin-right:30px;">
                            <a class="btn text-center my-auto btnDelete"  data-cart-item-id="'.$item['id_produit'].'" href="#"><i class="material-icons">delete</i></a>
                            <a class="btn text-center my-auto btnEdit" data-cart-item-id="'.$item['id_produit'].'" href="#"><i class="material-icons">edit</i></a>
                        </div>
                        <div class="col-md-2"><img src="/store/img/'. $item['img'] . '" style="width:60px; height:70px;"></div>
                        <div class="col-md-2 text-center my-auto">'. $item['name'] .'</div>
                        <div class="col-md-2 text-center my-auto">' .$item['price']. 'DH</div>
                        <input type="number" placeholder="QNT" value="'.$item['quantity'].'" 
                        class="col-md-2 form-control text-center my-auto qnt" data-price="'.$item['price'].'" id="qnt_'.$item['id_produit'].'" 
                        style="width:80px;margin-left:70px;" oninput="validateInput(this)" min="1">
                        <input type="text" placeholder="Total" value="'.$item['total'].'" class="col-md-2 form-control text-center my-auto total" value="0" id="total" style="width:80px;margin-left:50px;" disabled>
                    </div><hr/>';
                }
            }
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        exit();
    }    


    $item = $_POST['cart_item_id'] ;
    if ($action == "delete from cart") {
        $sql = "DELETE FROM carts  WHERE id_produit = :itemID ";
        $stmt = $dbo->connect->prepare($sql);
        try {
            $stmt->execute([":itemID"=>$item]);
            echo 1;
        } catch (Exception $t) {
            echo 0;
        }
        exit();
    }    
    
    $qnt = $_POST['quantity'] ;
    $totale = $_POST['total'] ;

    if ($action == "EditCart") {
        $sql = "UPDATE carts SET quantity = :Nquantity, total = :totaal  WHERE id_produit = :itemID ";
        $stmt = $dbo->connect->prepare($sql);
        try {
            $stmt->execute([":Nquantity"=>$qnt,":itemID"=>$item,":totaal"=>$totale]);
            echo 1;
        } catch (Exception $t) {
            echo 0;
        }
        exit();
    }





}
// ...

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="/store/global/bootstrap.css" rel="stylesheet" />
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
                    <a class="nav-link active" aria-current="page" href="/store/userinterface.php">Home</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<br>

<div id="MSG" ></div>

<div class="container border border-dark">
    <div class="row text-light bg-secondary text-centre text-xxl font-weight-bold" style="display:flex;align-items:centre;justify-content: center;text-align: center;"> 
        <h1> Your Cart</h1>
    </div>

    <div>
        <div class="row bg-primary text-center" style=" font-weight:bold;display:flex;align-items:centre;justify-content: center;text-align: center;padding:20px;   ">
            <div class="col-md-2 text-center my-auto" style="margin-right:20px;">Actions</div>
            <div class="col-md-2 text-center my-auto" >Product Image</div>
            <div class="col-md-2  text-center my-auto">Product Name</div>
            <div class="col-md-2  text-center my-auto" >Product Price</div>
            <div class="col-md-2  text-center my-auto" style="margin-left:50px;">Quantity</div>
            <div class="col-md-1  text-center my-auto">Total</div>
        </div><hr/>

        <div id="EditCartPage">

        </div>
    </div>

    <div class="row text-light bg-secondary p-3"> 
        <div class="col-md-8"></div>
        <div class="col-md-4">
            <b id="AllTotal">
                <?php 
                $s = "SELECT SUM(total) AS total_sum FROM carts";
                $t = $dbo->connect->prepare($s);
                try {
                    $t->execute();
                    $result = $t->fetch(PDO::FETCH_ASSOC);

                    if ($result && isset($result['total_sum'])) {
                        $totalSum = $result['total_sum'];
                        echo "Total : " . $totalSum;
                    } else {
                        echo "No data found in carts.";
                    }
                } catch (Exception $t) {
                    echo "Error executing the query.";
                }

                ?>                
            </b> 
        </div>
    </div>
</div><br>
<script>

function validateInput(input) {
    if (input.value < 0) {
        input.value = 1; // Set the value to 0 if it's negative
    }
    calculateTotal(input);
}

// function calculateTotal(input) {
//     var quantity = input.value;
//     var price = input.dataset.price;
//     var totalField = input.parentElement.parentElement.querySelector('.total');

//     var total = quantity * price;
//     totalField.value = total;

//     updateOverallTotal(); // Call a function to update the overall total
// }


function calculateTotal(input) {
    const quantity = input.value;
    const price = input.dataset.price;
    const totalField = input.parentElement.querySelector('#total');
    const total = quantity * price;
    totalField.value = total;

    updateOverallTotal();
}

function updateOverallTotal() {
    var totalSum = 0;
    var totalFields = document.querySelectorAll('.total');

    totalFields.forEach(function(field) {
        totalSum += parseFloat(field.value);
    });

    // Assuming you have an element with id 'totalSum' to display the sum
    document.getElementById('AllTotal').textContent ="Total : " + totalSum;
}



</script> 

<script src="/store/js/jquery.js"></script>
<script src="/store/controle carts/script2.js"></script>
<script src="/store/js/bootstrap.js"></script>
</body>
</html>
