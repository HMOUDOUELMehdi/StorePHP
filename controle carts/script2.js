// Function to load products based on category
function loadProducts(category) {
    $.ajax({
        url: '/store/controle carts/Gcarts.php',
        type: 'POST',
        data: { category: category ,action1:"addProduct"},
        success: function(response) {
            $('#listCarts').html(response);
            $('#NameCatg').text("Products  "+ category);
        },
        error: function() {
            $('#listCarts').html('<p>Error loading products.</p>');
        }
    });
}

function Addtocarts(nom, img, price) {
    $.ajax({
        url: '/store/controle carts/Gcarts.php',
        type: 'POST',
        data: { name: nom, img: img, price: price, action1: "add to cart" },
        success: function(response) {
            if (response == 1) {
                $('#successAddToCart').html(`<div class='alert alert-success alert-dismissible fade show' role='alert'>
                Your Products Success Adding To Cart  
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>`);
            } else if (response == 2) {
                $('#successAddToCart').html(`<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                This Product Is Already In Your Cart    
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>`);
            } else {
                $('#successAddToCart').html(`<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                Error adding Product   
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>`);
            }
        },
        error: function() {
            alert("Error");
        }
    });
}


function loadProtocarts() {
    $.ajax({
        url: '/store/controle carts/Gcarts.php',
        type: 'POST',
        data: {action1:"load to cart"},
        success: function(response) {
            $('#modalBody').html(response);
            // $('#NameCatg').text("Products  "+ category);
            // alert(response);
        },
        error: function() {
            // $('#listCarts').html('<p>Error loading products.</p>');
            alert("error");
        }
    });
}

// Function to edit cart items
function EditCARTS(Nqnt, cartItemId,totall) {
    $.ajax({
        url: '/store/controle carts/EditCart.php',
        type: 'POST',
        data: {quantity: Nqnt,total: totall ,cart_item_id: cartItemId, action1: "EditCart"},
        success: function(response) {
            if (response == 1) {
                $('#MSG').html(`<div class='alert alert-success alert-dismissible fade show' role='alert'>
                Your Cart Success Modifie  
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>`);
            } else {
                $('#MSG').html(`<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                Your Cart not  Modifie  retrie again
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>`);
            }
        },
        error: function() {
            alert("Error during the request.");
        }
    });
}

function DELETEFROMCARTS(cartItemId) {
    $.ajax({
        url: '/store/controle carts/EditCart.php',
        type: 'POST',
        data: {cart_item_id: cartItemId, action1: "delete from cart"},
        success: function(response) {
            if (response == 1) {
                $('#MSG').html(`<div class='alert alert-success alert-dismissible fade show' role='alert'>
                Your product Success deleted  
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>`);
            } else {
                $('#MSG').html(`<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                Your products not  deleted  retry again
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>`);
            }
        },
        error: function() {
            alert("Error during the request.");
        }
    });
}

function letProTopage() {
    $.ajax({
        url: '/store/controle carts/EditCart.php',
        type: 'POST',
        data: {action1: "let carts to page"},
        success: function(response) {
                $('#EditCartPage').html(response);
        },
        error: function() {
            alert("Error during the request.");
        }
    });
}

function logOUT() {
    $.ajax({
        url: '/store/userinterface.php',
        type: 'POST',
        data: {action:'logout'},
        success: function(response) {
            window.location.href = '/store/login.php';
        },
        error: function() {
            alert("Error during the request.");
        }
    });
}


$(document).ready(function () {

    letProTopage();

    // Add an event listener to each button
    $('.filter-button').on('click', function() {
        var category = $(this).data('category');
        loadProducts(category);
    });
    
    $('[data-category="phone"]').trigger('click');
    
    $('#username').on('click', function() {
        $("#modalUser").modal("show");
    });   
    
    $('#cart').on('click', function() {
        $("#modalCart").modal("show");
        loadProtocarts();
    });     
    
    $(document).on('click', '.btnADD', function() {
        var img = $(this).data('img');
        var name = $(this).data('name');
        var price = $(this).data('price');
        // console.log(name,img,price);
        Addtocarts(name,img,price);
        
    });
    
    $(document).on('click', '.btnEdit', function() {
        var quantity = $(this).parent().parent().find('.qnt').val(); 
        var total = $(this).parent().parent().find('.total').val(); 
        var cartItemId = $(this).data('cart-item-id'); // Assuming you have a unique identifier for cart items
        EditCARTS(quantity, cartItemId,total);
    });            
    
    $(document).on('click', '.btnDelete', function() {
        var cartItemId = $(this).data('cart-item-id'); // Assuming you have a unique identifier for cart items
        DELETEFROMCARTS(cartItemId);
        letProTopage();
    });  

    $(document).on('click', '#logOut', function() {
        // alert("cll");
        logOUT();
    });  
});
