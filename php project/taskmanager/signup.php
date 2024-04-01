
<?php
    
    include('config/constants.php');

    if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

    
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if(!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        
        $check_query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
        $check_result = mysqli_query($conn, $check_query);
        if(mysqli_num_rows($check_result) > 0) {
        
            echo "<script>alert('Username or email already exists. Please try again with a different username or email.');</script>";
        } else {
            
            $insert_query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
            $insert_result = mysqli_query($conn, $insert_query);
            if($insert_result) {
                $_SESSION['user'] = $username; 
                header("Location: index.php");
                exit();
            } else {
                echo "<script>alert('Failed to sign up. Please try again.');</script>";
            }
        }

    
        mysqli_close($conn);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="signup.css">
</head>
<body>
    <div class="container">
        <h2>Sign Up Form</h2>
        <form id="signupForm" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" id="button">Sign Up</button>
            <p>Already have an account? <a href="login.php">Login</a></p>
        </form>
    </div>
</body>
</html>
