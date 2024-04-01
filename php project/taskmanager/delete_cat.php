<?php 

    include('config/constants.php');

    if(isset($_GET['name'])){

        $category_name=$_GET['name'];

        $conn=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error($conn));

        $db_select=mysqli_select_db($conn,DB_NAME) or die (mysqli_error($conn));

        $sql="DELETE FROM categories WHERE name='$category_name'";

        $res=mysqli_query($conn,$sql);

        if($res==true){
            $_SESSION['delete']="Category deleted successfully";
            header('location:'.SITEURL.'Category list.php');
        }else{
            $_SESSION['delete_fail']="Failed to delete the category";
            header('location:'.SITEURL.'Category list.php');

        }

    }else{
        header('location:'.SITEURL.'Category list.php');
    }

    

    


?>