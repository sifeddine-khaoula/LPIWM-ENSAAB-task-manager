<?php 
    include('config/constants.php');

    if(isset($_POST['submit'])) {
        $task_name = $_POST['task_name'];
        $task_description = $_POST['task_description'];
        $due_date = $_POST['due_date'];
        $priority = $_POST['priority'];
        $category_name = $_POST['category_name'];

        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn));
        $db_select = mysqli_select_db($conn, DB_NAME);


        $sql = "INSERT INTO tasks (name, description,category_name, due_date, priority) VALUES ('$task_name', '$task_description', '$category_name', '$due_date', '$priority')";
        $res = mysqli_query($conn, $sql);

        if($res == true){
            $_SESSION['add_task'] = "Task added successfully";
            header('Location: ' . SITEURL . 'index.php');
        } else {
            $_SESSION['add_fail_task'] = "Failed to add the task";
            header('Location: ' . SITEURL . 'New task.php');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Task</title>
    <link rel="stylesheet" href="new category-task.css">
</head>
<body>
    <h3>New Task</h3>
    <p>
        <?php
            if(isset($_SESSION['add_fail_task'])){
                echo '<div class="fail-message">' .$_SESSION['add_fail_task']. '</div>';
                unset($_SESSION['add_fail_task']);
            }
        ?>
    </p>

    <form method="POST" action="">
        <label for="task_name">Task Name:</label>
        <input type="text" id="task_name" name="task_name" required>

        <label for="task_description">Task Description:</label>
        <textarea id="task_description" name="task_description" ></textarea>
            
        <label for="category_name">Category:</label>
        <select id="category_name" name="category_name" >
            <option value="">Select Category</option>
            <?php 
                $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn));
                $db_select = mysqli_select_db($conn, DB_NAME);
                $sql = "SELECT * FROM categories";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='".$row['name']."'>".$row['name']."</option>";

                    }
                }
            ?>
        </select>

        <label for="due_date">Due Date:</label>
        <input type="date" id="due_date" name="due_date" required>

        <label for="priority">Priority:</label>
        <select id="priority" name="priority" required>
            <option value="Low">Low</option>
            <option value="High">High</option>
        </select>

        <input type="submit" name="submit" value="Save">
    </form>
</body>
</html>
