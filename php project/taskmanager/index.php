<?php 
    include('config/constants.php');

    // Function to update status of overdue tasks:
    function updateOverdueTasks() {
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if(!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $currentDate = date('Y-m-d');

        $updateQuery = "UPDATE tasks SET status = 'Overdue' WHERE due_date < '$currentDate' AND status != 'Done'";
        mysqli_query($conn, $updateQuery);

        mysqli_close($conn);
    }

    updateOverdueTasks();

    // Sorting and filtering logic:
    $orderBy = isset($_GET['order_by']) ? $_GET['order_by'] : 'due_date';
    $filterBy = isset($_GET['filter_by']) ? $_GET['filter_by'] : '';

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME) or die(mysqli_error($conn));
    $sql = "SELECT * FROM tasks";

   
    if (!empty($filterBy)) {
        
        if (strpos($sql, "ORDER BY") !== false) {
            $sql .= " WHERE status = '$filterBy'";
        } else {
            
            $sql .= " ORDER BY due_date ASC WHERE status = '$filterBy'";
        }
    }

    
    if ($orderBy == 'priority') {
        $sql .= " ORDER BY priority DESC";
    } elseif ($orderBy == 'due_date') {
        $sql .= " ORDER BY due_date ASC";
    }

    $res = mysqli_query($conn, $sql);


    if($res) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List</title>
    <link rel="stylesheet" href="index.css">
    <script>
        function toggleOrder(orderBy) {
            var currentUrl = window.location.href;
            var url = new URL(currentUrl);
            var currentOrderBy = url.searchParams.get("order_by");
            var newOrderBy = orderBy;

            if (currentOrderBy === orderBy) {
                newOrderBy += "_desc";
            }

            
            url.searchParams.set("order_by", newOrderBy);
            window.location.href = url.toString();
        }
    </script>
</head>
<body>
    <div class="menu">
        
        <a href="<?php echo SITEURL; ?>Category list.php">Category list</a>
        <a href="<?php echo SITEURL; ?>Notifications.php">Notifications</a>
        <a href="<?php echo SITEURL; ?>login.php"id="logoutBtn">LogOut</a>
    </div>
    <h1>Task List</h1>
    
    <p>
        <?php
            if(isset($_SESSION['delete_task'])){
                echo '<div class="success-message">' .$_SESSION['delete_task']. '</div>';
                unset($_SESSION['delete_task']);
            }

            if(isset($_SESSION['delete_fail_task'])){
                echo '<div class="fail-message">' .$_SESSION['delete_fail_task']. '</div>';
                unset($_SESSION['delete_fail_task']);
            }

            if(isset($_SESSION['add_task'])){
                echo '<div class="success-message">' .$_SESSION['add_task']. '</div>';
                unset($_SESSION['add_task']);
            }

            
            if(isset($_SESSION['task_update'])){
                echo '<div class="success-message">' .$_SESSION['task_update']. '</div>';
                unset($_SESSION['task_update']);
            }
    
        ?>
    </p>

    <div class="all-tasks">
        <a href="New task.php" id="newTaskBtn"><span class="plus-sign">+</span>New task</a>
        <table>
            <thead>
                <tr>
                    <th>Task</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>
                        <a href="#" onclick="toggleOrder('due_date')">Due Date</a>
                    </th>
                    <th>
                        <a href="#" onclick="toggleOrder('priority')">Priority</a>
                    </th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    while($task_row = mysqli_fetch_assoc($res)){
                        $task_name = $task_row['name'];
                        $task_description = $task_row['description'];
                        $category_name = $task_row['category_name'];
                        $task_due_date = $task_row['due_date'];
                        $task_priority = $task_row['priority'];
                        $task_status = $task_row['status'];
                ?>
                <tr>
                    <td><?php echo $task_name; ?></td>
                    <td><?php echo $task_description; ?></td>
                    <td><?php echo $category_name; ?></td>
                    <td><?php echo $task_due_date; ?></td>
                    <td><?php echo $task_priority; ?></td>
                    <td><?php echo $task_status; ?></td>
                    <td>
                        <a href="<?php echo SITEURL; ?>update_task.php?name=<?php echo $task_name; ?>"id="EditBtn">Edit</a>
                        <a href="<?php echo SITEURL; ?>delete_task.php?name=<?php echo $task_name; ?>"id="DeleteBtn">Delete</a>
                    </td>
                </tr>
                <?php
                    }
                ?> 
            </tbody>
        </table>
    </div>
</body>
</html>
<?php 
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
?>