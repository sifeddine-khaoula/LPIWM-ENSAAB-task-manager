<?php 
    include('config/constants.php');

    if(isset($_GET['name'])){
        $category_name=$_GET['name'];

        $conn=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error($conn));

        $db_select=mysqli_select_db($conn,DB_NAME) or die (mysqli_error($conn));

        $sql="SELECT * FROM categories WHERE name='$category_name'";

        $res=mysqli_query($conn,$sql);

        if($res==true){
            $row=mysqli_fetch_assoc($res);
            $category_name=$row['name'];
            
        }else{
          
            header('location:'.SITEURL.'Category list.php');

        }
    }
?>



<html>
    <head>
     <title>Update category</title>
     <link rel="stylesheet" href="update cat-task.css">
    </head>
    <body>
     <h1>Update category</h1>
    
        <p>
            <?php 
                if(isset($_SESSION['update_fail'])){
                    echo '<div class="fail-message">' .$_SESSION['update_fail']. '</div>';
                    unset($_SESSION['update_fail']);
                }
            ?>
        </p>

        <form method="POST" action="">
            <input type="text" name="category_update" value="<?php echo $category_name; ?>" required="required">
            <input type="submit" name="submitcatupdate" value="Save">
        </form>
        
    </body>
</html>


<?php 

    if(isset($_POST['submitcatupdate'])){
        $new_category_name=$_POST['category_update'];

        $conn2=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error($conn2));

        $db_select2=mysqli_select_db($conn2,DB_NAME) or die (mysqli_error($conn2));

        $sql2="UPDATE categories SET
        name= '$new_category_name'
        WHERE name='$category_name'";

        $res2=mysqli_query($conn2,$sql2);

        if($res2==true){
            $_SESSION['update']="Category updated successfully";
            header('location:'.SITEURL.'Category list.php');
        }else{
            $_SESSION['update_fail']="Failed to update the category";
            header('location:'.SITEURL.'Category list.php?name='.$category_name);

        }
        
    }
?>