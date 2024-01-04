<!-- <?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    if (isset($_POST["Log"])) {
        if (!empty($email) && !empty($password)) {
            // Connection to database
            $root = $_SERVER["DOCUMENT_ROOT"];
            include_once $root."/store/database/db.php";

            $dbo = new Database();

            $query = "SELECT * FROM userinfo WHERE email = :email AND password = :password";
            $stmt = $dbo->connect->prepare($query);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->execute();
            
            $count = $stmt->rowCount();
            
            if ($count > 0) {
                // Log in successful

            } else {
                // Log in failed
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                Invalid inputs    
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }
        }
    }
}
?> -->
