<?php 
    include('config/constants.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category list</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
<body>
    <div class="menu">

       <a href="<?php echo SITEURL; ?>">Task list</a>
       <a href="<?php echo SITEURL; ?>Notifications.php">Notifications</a>
       <a href="<?php echo SITEURL; ?>login.php" id="logoutBtn">LogOut</a>

    </div>

    <h1>Category list</h1>
    <div>
    <p>
        <?php
            if(isset($_SESSION['add'])){
                echo '<div class="success-message">' .$_SESSION['add']. '</div>';
                unset($_SESSION['add']);
            }


            if(isset($_SESSION['delete'])){
                echo '<div class="success-message">' .$_SESSION['delete']. '</div>';
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['update'])){
                echo '<div class="success-message">' .$_SESSION['update']. '</div>';
                unset($_SESSION['update']);
            }

            if(isset($_SESSION['delete_fail'])){
                echo $_SESSION['delete_fail'];
                unset($_SESSION['delete_fail']);
            }
        ?>
    </p>
    </div>

    
   
    <div class="all-categories">
        <a href="new category.php" id="newCatBtn"><span class="plus-sign">+</span>New category</a>
        
        <table>
            <thead>
                <tr>
                    
                    <th>Category</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                        $conn=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error($conn));

                        $db_select=mysqli_select_db($conn,DB_NAME) or die (mysqli_error($conn));

                        $sql="SELECT * FROM categories";

                        $res=mysqli_query($conn,$sql);

                        if($res==true){
                            
                            $count_rows=mysqli_num_rows($res);

                            if($count_rows>0){
                                while($row=mysqli_fetch_assoc($res)){
                                    $category_name=$row['name'];
                                    ?>
                                    <tr>
                                        <td><?php echo $category_name; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>update_cat.php?name=<?php echo $category_name; ?>"id="EditBtn">Edit</a>            
                                            <a href="<?php echo SITEURL; ?>delete_cat.php?name=<?php echo $category_name; ?>"id="DeleteBtn">Delete</a>
                                                
                                        
                                        </td>
                                    </tr>
                                    <?php
                                }
                                
                            }else{

                                ?>
                                <tr>
                                    <td colspan="7">No categories added yet</td>
                                </tr>
                                <?php
                            }
                        }

                        
                    ?> 
            </tbody>
                 
            
        </table>
    </div>
    
</body>
</html>