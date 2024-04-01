<?php 
    include('config/constants.php');

    if(isset($_GET['name'])){
        $task_name = $_GET['name'];

        $conn=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error($conn));
        $db_select=mysqli_select_db($conn,DB_NAME) or die (mysqli_error($conn));

        $sql="SELECT * FROM tasks WHERE name='$task_name'";
        $res=mysqli_query($conn,$sql);

        if($res==true){
            $row=mysqli_fetch_assoc($res);
            $task_name = $row['name'];
            $task_description = $row['description'];
            $task_category = $row['category_name'];
            $due_date = $row['due_date'];
            $priority = $row['priority'];
            $status = $row['status'];
        } else {
            header('location:'.SITEURL.'index.php');
        }
    } else {
        header('location:'.SITEURL.'index.php');
    }
?>

<html>
<head>
    <title>Update Task</title>
    <link rel="stylesheet" href="update cat-task.css">
</head>
<body>
    <h1>Update Task</h1>

    <p>
        <?php 
            if(isset($_SESSION['update_fail'])){
                echo '<div class="fail-message">' .$_SESSION['update_fail']. '</div>';
                unset($_SESSION['update_fail']);
            }
        ?>
    </p>

    <form method="POST" action="">
        <label for="task_name">Task Name:</label>
        <input type="text" id="task_name" name="task_name" value="<?php echo $task_name; ?>" required="required" >

        <label for="task_description">Task Description:</label>
        <textarea id="task_description" name="task_description"><?php echo $task_description; ?></textarea>


        <label for="category_name">Category:</label>
            <select id="category_name" name="category_name">
                <?php 
                    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn));
                    $db_select = mysqli_select_db($conn, DB_NAME);
                    $sql = "SELECT * FROM categories";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            $selected = ($row['name'] == $task_category) ? 'selected' : '';
                            echo "<option value='".$row['name']."' $selected>".$row['name']."</option>";
                        }
                    }
                ?>
            </select>


        <label for="due_date">Due Date:</label>
        <input type="date" id="due_date" name="due_date" value="<?php echo $due_date; ?>" >

        <label for="priority">Priority:</label>
        <select id="priority" name="priority" >
            <option value="Low" <?php if($priority == 'Low') echo 'selected'; ?>>Low</option>
            <option value="High" <?php if($priority == 'High') echo 'selected'; ?>>High</option>
        </select>

        <label for="status">Status:</label>
        <select id="status" name="status" >
            <option value="Pending" <?php if($status == 'Pending') echo 'selected'; ?>>Pending</option>
            <option value="Done" <?php if($status == 'Done') echo 'selected'; ?>>Done</option>
            <option value="Overdue" <?php if($status == 'Overdue') echo 'selected'; ?>>Overdue</option>
        </select>

        <input type="submit" name="submit" value="Save">
    </form>
</body>
</html>

<?php 
    if(isset($_POST['submit'])){
        $new_task_name = $_POST['task_name'];
        $new_task_description = $_POST['task_description'];
        $new_task_category = $_POST['category_name'];
        $new_due_date = $_POST['due_date'];
        $new_priority = $_POST['priority'];
        $new_status = $_POST['status'];

        $conn2 = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error($conn2));
        $db_select2 = mysqli_select_db($conn2,DB_NAME) or die (mysqli_error($conn2));

        $sql2 = "UPDATE tasks SET
            name = '$new_task_name',
            description = '$new_task_description',
            category_name = '$new_task_category',
            due_date = '$new_due_date',
            priority = '$new_priority',
            status = '$new_status'
            WHERE name='$task_name'";

        $res2 = mysqli_query($conn2, $sql2);

        if($res2==true){
            $_SESSION['task_update']="Task updated successfully";
            header('location:'.SITEURL.'index.php');
        } else {
            $_SESSION['task_update_fail']="Failed to update the task";
            header('location:'.SITEURL.'update_task.php?name='.$task_name);
        }
    }
?>
