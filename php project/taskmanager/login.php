
<?php
    
    include('config/constants.php');

    if(isset($_POST['username_email']) && isset($_POST['password'])) {
        $username_email = $_POST['username_email'];
        $password = $_POST['password'];

    
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if(!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        
        $sql = "SELECT * FROM users WHERE (username='$username_email' OR email='$username_email') AND password='$password'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) == 1) {
        
            $_SESSION['user'] = $username_email; 
            header("Location: index.php");
            
            exit();
        } else {
            
           echo "<script>alert('Invalid username/email or password. Please try again.');</script>";
           
        }

       
        mysqli_close($conn);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="container">
        <h2>Login Form</h2>

        

        <form id="loginForm" method="post">
            <div class="form-group">
                <label for="username_email">Username/Email:</label>
                <input type="text" id="username_email" name="username_email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" id="button">Login</button>
            <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
        </form>

    </div>
</body>
</html>





