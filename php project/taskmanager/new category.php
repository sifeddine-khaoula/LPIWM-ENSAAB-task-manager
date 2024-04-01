<?php 
    include('config/constants.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New category</title>
    <link rel="stylesheet" href="new category-task.css">

</head>
<body>
    <h3>Enter the new category's name:</h3>

    <p>
        <?php
            if(isset($_SESSION['add_fail'])){
                echo '<div class="fail-message">' .$_SESSION['add_fail']. '</div>';
                unset($_SESSION['add_fail']);
            }
        ?>
    </p>

    <form method="POST" action="">
        <input type="text" name="category_name" required="required">
        <input type="submit" name="submit" value="Save">
    </form>
    
    
</body>
</html>

<?php
if(isset($_POST['submit'])) {
    $category_name= $_POST['category_name'];


    $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error($conn));

    $db_select = mysqli_select_db($conn,DB_NAME);

    
    $sql="INSERT INTO categories SET
        name='$category_name'
    ";

    
    $res=mysqli_query( $conn,  $sql);

    if ( $res==true){
        
        $_SESSION['add']="Category name added successfully";
        header('Location: ' . SITEURL . 'Category list.php');


    }else{
    
        $_SESSION['add_fail']="Failed to add the Category name";
        header('Location: ' . SITEURL . 'new category.php');
    }

}
?>

