
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action1'] ;
    
    $root = $_SERVER["DOCUMENT_ROOT"];
    include_once $root."/store/database/db.php";
    
    $dbo = new Database();
    

if ($action == "add to cart") {
    $name = $_POST['name'] ;
    $img =  $_POST['img'] ;
    $price = $_POST['price'];
    addToCart($dbo, $name, $img, $price);
}

if ($action == "load to cart") {
    loadProToCarts($dbo);
}

    
if ($action == "addProduct") {

    $category = $_POST['category'] ;
        $sql = "SELECT * FROM products WHERE categorie = :category";
        $stmt = $dbo->connect->prepare($sql);
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);

    try {   
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) > 0) {
            foreach($result as $row) {
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
            echo "0 results";
        }
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
}

function addToCart($dbo, $name, $img, $price) {

    $sql = "SELECT * FROM carts WHERE img = :img";
    $stmt = $dbo->connect->prepare($sql);
    $stmt->execute([':img' => $img]);
    $cartItem = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($cartItem) {
        echo json_encode(2); // Item already exists in the cart
        return;
    }

    $stmt = "INSERT INTO carts(name,img,price) VALUES (:name, :img, :price)";
    $result = $dbo->connect->prepare($stmt);

    try {
        $result->execute([
            ":name" => $name,
            ":img" => $img,
            ":price" => $price,
        ]);

        echo json_encode(1); // Item added successfully
    } catch (Exception $t) {
        echo json_encode(0); // Error adding item
    }

    exit();
}



function loadProToCarts($dbo){
    $sql = "SELECT * FROM carts";
    $stmt = $dbo->connect->prepare($sql);
    $stmt->execute();
    $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

    try {
        if (count($cartItems) > 0) {
            foreach ($cartItems as $item) {
                echo '
                <div class="row bg-light">
                    <div class="col-md-4"><img src="img/'. $item['img'] . '" style="width:60px; height:70px;"></div>
                    <div class="col-md-4">'. $item['name'] .'</div>
                    <div class="col-md-4 text-center">' .$item['price']. 'DH</div>
                </div><hr/>';
            }                  
        }
  
    }  catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
 exit();
}

?>

