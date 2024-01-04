<?php
session_start(); // Make sure you start the session at the beginning of the file.
if (!$_SESSION['loginSuccess']) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ;
    if ($action == "logout") {
        if(isset($_SESSION['loginSuccess'])) {
            // Unset all session variables
            session_unset();
        
            // Destroy the session
            session_destroy();
            echo "success"; // Send a response back to the JavaScript
        } else {
            echo "error";
        }

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
<!-- this starting of navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid px-4 px-lg-5">
        <a class="navbar-brand me-auto" href="#!">Store D Mehdi</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item me-auto mb-2 mb-lg-0 ms-lg-4"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
                <li class="nav-item me-auto mb-2 mb-lg-0 ms-lg-4"><a class="nav-link" href="#!">About</a></li>
            </ul>
            <div class="d-flex me-4 mb-2 mb-lg-0">
                <button class="btn btn-outline-dark me-3" id="cart">
                    <i class="bi-cart-fill me-1"></i>
                    Cart
                    <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                </button>
            </div>

            <div class="modal fade" id="modalCart">
               <div class="modal-dialog">

                <div class="modal-content">

                    <div class="modal-header">
                        <h1>Your Carts</h1>
                    <button class="btn btn-danger fw-bold p-3" data-bs-dismiss="modal"> X </button>
                    </div>
                    <div class="modal-body " id="modalBody">

                    </div>
                    <div class="modal-footer">
                    <button class="btn btn-danger p-3" data-bs-dismiss="modal"> Cancel </button>
                    <a class="btn btn-primary p-3" href="/store/controle carts/EditCart.php <?php $_SESSION['loginS'] = true; ?> ">Edit</a> 
                    </div>
                </div>

               </div>

            </div>


            <div class="me-4 mb-2 mb-lg-0">
                <button class="btn btn-outline-primary"  id="username">

            <?php
                // Check if the user is logged in
                if(isset($_SESSION['firstName'])) {
                    $firstName = $_SESSION['firstName'];
                    echo "Welcome, $firstName!";
                } else {

                    echo "error";

                }
            ?> 
                </button>
            </div>
                   
            <div class="modal fade" id="modalUser">
               <div class="modal-dialog">

                <div class="modal-content">

                    <div class="modal-header">
                        <h1><?php // Check if the user is logged in
                if(isset($_SESSION['firstName'])) {$firstName = $_SESSION['firstName'];echo "Welcome, $firstName"; } else {echo "error";}?>
                    </h1>
                    <button class="btn btn-danger fw-bold p-3" data-bs-dismiss="modal"> X </button>
                    </div>
                    <div class="modal-body text-end">
                        <button class="btn btn-danger fw-bold px-4 py-3 me-2" id="logOut">Log Out</button>
                        <a class="btn btn-success fw-bold px-4 py-3" href="/store/controle carts/EditCart.php" >Show Cart</a>
                    </div>
                </div>

               </div>

            </div>

            <form class="d-flex my-2 my-lg-0" action='search.php' method="POST">
                <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
<!-- end of navbar -->
<div id="successAddToCart"  class="container" style="width:80%;"></div>
<!-- starting carousel  -->
<div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <!-- Item 1 -->
        <div class="carousel-item active">
            <section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" style="width:100%; height:600px;"  src="img/dinner6.jpeg" alt="" /></div>
                    <div class="col-md-6">
                        <div class="small mb-1">SKU: BST-498</div>
                        <h1 class="display-5 fw-bolder">Shop item template</h1>
                        <div class="fs-5 mb-5">
                            <span class="text-decoration-line-through">1400 DH</span>
                            <span>1000 DH</span>
                        </div>
                        <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium at dolorem quidem modi. Nam sequi consequatur obcaecati excepturi alias magni, accusamus eius blanditiis delectus ipsam minima ea iste laborum vero?</p>
                        <div class="d-flex">
                            <button class="btn btn-outline-dark flex-shrink-0 btnADD" data-img="dinner6.jpeg" data-name="dinnner set" data-price="1000" type="button">
                                <i class="bi-cart-fill me-1"></i>
                                Add to cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            </section>
        </div>
        <!-- Item 2 -->
        <div class="carousel-item">
            <section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0"  style="width:100%; height:500px;"  src="img/pc1.jpg" alt="..." /></div>
                    <div class="col-md-6">
                        <div class="small mb-1">SKU: BST-498</div>
                        <h1 class="display-5 fw-bolder">Shop item template</h1>
                        <div class="fs-5 mb-5">
                            <span class="text-decoration-line-through">3000 DH</span>
                            <span>2800 DH</span>
                        </div>
                        <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium at dolorem quidem modi. Nam sequi consequatur obcaecati excepturi alias magni, accusamus eius blanditiis delectus ipsam minima ea iste laborum vero?</p>
                        <div class="d-flex">
                            <button class="btn btn-outline-dark flex-shrink-0 btnADD"  data-img="pc1.jpg" data-name="Pc " data-price="3000" type="button">
                                <i class="bi-cart-fill me-1"></i>
                                Add to cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            </section>
        </div>
        <!-- Item 3 -->
        <div class="carousel-item">
            <section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" style="width:100%; height:540px;"  src="img/wallshleves1.jpeg" alt="..." /></div>
                    <div class="col-md-6">
                        <div class="small mb-1">SKU: BST-498</div>
                        <h1 class="display-5 fw-bolder">Shop item template</h1>
                        <div class="fs-5 mb-5">
                            <span class="text-decoration-line-through">1200 DH</span>
                            <span>1000 DH</span>
                        </div>
                        <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium at dolorem quidem modi. Nam sequi consequatur obcaecati excepturi alias magni, accusamus eius blanditiis delectus ipsam minima ea iste laborum vero?</p>
                        <div class="d-flex">
                            <button class="btn btn-outline-dark flex-shrink-0  btnADD" data-img="wallshleves1.jpeg" data-name="wallshleves" data-price="1000" type="button">
                                <i class="bi-cart-fill me-1"></i>
                                Add to cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            </section>
        </div>
        <!-- Item 4 -->
        <div class="carousel-item">
            <section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" style="width:100%; height:570px;" src="img/Samsung Galaxy S20 5G.jpg" alt="..." /></div>
                    <div class="col-md-6">
                        <div class="small mb-1">SKU: BST-498</div>
                        <h1 class="display-5 fw-bolder">Shop item template</h1>
                        <div class="fs-5 mb-5">
                            <span class="text-decoration-line-through">2200DH</span>
                            <span>2000DH</span>
                        </div>
                        <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium at dolorem quidem modi. Nam sequi consequatur obcaecati excepturi alias magni, accusamus eius blanditiis delectus ipsam minima ea iste laborum vero?</p>
                        <div class="d-flex">
                            <button class="btn btn-outline-dark flex-shrink-0  btnADD"  data-img="Samsung Galaxy S20 5G.jpg" data-name="Samsung Galaxy S20" data-price="2000" type="button">
                                <i class="bi-cart-fill me-1"></i>
                                Add to cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            </section>
        </div>
    </div>

    <!-- Previous and Next Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon  bg-dark text-white rounded-pill" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next " type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon bg-dark text-white  rounded-pill" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var myCarousel = new bootstrap.Carousel(document.getElementById('myCarousel'), {
            interval: 5000 // Set the interval to 5 seconds
        });
    });
</script>

<!-- end of carousel -->

<form action="/store/controle carts/Gcarts.php" class="container text-light bg-light d-flex justify-content-center align-items-center" style="max-width: 600px;" method="post">
    <button class="btn btn-outline-dark mx-2 flex-fill filter-button" type="button" style="height: 50px; max-width: 400px;" data-category="phone" >
        Phone
    </button>

    <button class="btn btn-outline-dark mx-2 flex-fill filter-button" type="button" style="height: 50px; max-width: 400px;" data-category="pc">
        PC
    </button>

    <button class="btn btn-outline-dark mx-2 flex-fill filter-button" type="button" style="height: 50px; max-width: 400px;" data-category="dinner">
        Dinner
    </button>

    <button class="btn btn-outline-dark mx-2 flex-fill filter-button" type="button" style="height: 50px; max-width: 400px;" data-category="painting">
        Painting
    </button>
</form>

<!-- <div id="listCarts" class="container"></div> -->


<br><br>

<section class="py-5 bg-light">
            <div class="container px-4 px-lg-5 mt-5">
                <h2 class="fw-bolder mb-4" id="NameCatg">products</h2>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center" id="listCarts">

                </div>
            </div>
</section>



<script src="js/jquery.js"></script>
<script src="/store/controle carts/script2.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>


