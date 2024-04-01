<?php 
    include('config/constants.php');

    if(isset($_GET['name'])){
        $task_name = $_GET['name'];

        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn));
        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));

        $sql = "DELETE FROM tasks WHERE name='$task_name'";
        $res = mysqli_query($conn, $sql);

        if($res == true){
            $_SESSION['delete_task'] = "Task deleted successfully";
            header('location:'.SITEURL.'index.php');
        } else {
            $_SESSION['delete_fail_task'] = "Failed to delete the task";
            header('location:'.SITEURL.'index.php');
        }
    } else {
        header('location:'.SITEURL.'index.php');
    }
?>

    

    


?>