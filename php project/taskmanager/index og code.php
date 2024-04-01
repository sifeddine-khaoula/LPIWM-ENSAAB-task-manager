<?php 
    include('config/constants.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Task List</title>

<link rel="stylesheet" href="index.css">

</head>
<body>
    <h1>Task List</h1>
    <div class="menu">
       <a href="<?php echo SITEURL; ?>profil.php">Profil</a>
       <a href="<?php echo SITEURL; ?>Category list.php">Category list</a>
       <a href="<?php echo SITEURL; ?>Notifications.php">Notifications</a>

    </div>

    
   
    <div class="all-tasks">
        <a href="New task.php">New task</a>
        <table>
            <thead>
                <tr>
                    <th>Task</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Due Date</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $conn=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error($conn));

                    $db_select=mysqli_select_db($conn,DB_NAME) or die (mysqli_error($conn));

                    $sql="SELECT * FROM tasks";

                    $res=mysqli_query($conn,$sql);

                    if($res==true){
                        //echo "executed";

                        //counting the rows:
                        $count_rows=mysqli_num_rows($res);

                        if($count_rows>0){
                            while($task_row=mysqli_fetch_assoc($res)){
                                $task_name=$task_row['name'];
                                $task_description=$task_row['description'];
                                ?>
                                
                                <td>
                                    <div class="wrapper">
                                        <select name="category_select" class="form-control">
                                            <?php 
                                                // Connect to the database
                                                $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME) or die(mysqli_error($conn));

                                                // Fetch category names from the database
                                                $sql = "SELECT name FROM categories";
                                                $result = mysqli_query($conn, $sql);

                                                // Check if categories exist
                                                if(mysqli_num_rows($result) > 0) {
                                                    // Loop through each category and create an <option> element
                                                    while($row = mysqli_fetch_assoc($result)) {
                                                        $category_name = $row['name'];
                                                        echo "<option value='$category_name'>$category_name</option>";
                                                    }
                                                } else {
                                                    // If no categories found, display a default option
                                                    echo "<option value=''>No categories found</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </td>

                                <?php 
                                $task_due_date=$task_row['due_date'];
                                $task_priority=$task_row['priority'];
                                $task_status=$task_row['status'];
                               
                                ?>
                                <tr>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>update_cat.php?name=<?php echo $category_name; ?>">Edit</a>
                                        <!--<button>Edit</button>       -->              
                                        <a href="<?php echo SITEURL; ?>delete_cat.php?name=<?php echo $category_name; ?>">Delete</a>
                                            
                                    </td>
                                </tr>
                                <?php
                            }
                            
                        }else{

                            ?>
                            <tr>
                                <td colspan="7">No tasks added yet</td>
                            </tr>
                            <?php
                        }
                    }

                    
                ?> 

            </tbody>
           
            <tbody>
                <!-- Example task rows, you can add more rows dynamically using JavaScript -->
                <tr>
                    <td>Task 1 hjdjqjdhqjhdqjhdjqhdjqhdqhdjqhdjqhsdskjhfkjshdfdshkjfhdskfdhq</td>
                    <td>Description for Task 1jkjhhuhyhhuhuhuhhhuhiuhiuhiuhihihihihihihihihh</td>

                    <td>
                        <div class="wrapper">
                            <select name="category_select" class="form-control">
                                <?php 
                                    // Connect to the database
                                    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME) or die(mysqli_error($conn));

                                    // Fetch category names from the database
                                    $sql = "SELECT name FROM categories";
                                    $result = mysqli_query($conn, $sql);

                                    // Check if categories exist
                                    if(mysqli_num_rows($result) > 0) {
                                        // Loop through each category and create an <option> element
                                        while($row = mysqli_fetch_assoc($result)) {
                                            $category_name = $row['name'];
                                            echo "<option value='$category_name'>$category_name</option>";
                                        }
                                    } else {
                                        // If no categories found, display a default option
                                        echo "<option value=''>No categories found</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </td>
                    <td>2024-04-01</td>
                    <td>high</td>
                    <td>Pending</td>
                    <td>
                        <!--in the vide he did the buttons as a href-->
                        <a href="">Edit</a>
                        <a href="">Delete</a>
                       
                        
                    </td>
                </tr>
                
                <!-- Add more task rows as needed -->
            </tbody>
        </table>
    </div>
    
</body>
</html>



code for tthe rolling choices of cat.names in index page:
         <!-- <div class="wrapper">
                                        <select name="category_select" class="form-control">
                                        <?php 
                                                $category_conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($category_conn));
                                                $category_db_select = mysqli_select_db($category_conn, DB_NAME) or die (mysqli_error($category_conn));
                                                $category_sql = "SELECT name FROM categories";
                                                $category_result = mysqli_query($category_conn, $category_sql);

                                                if(mysqli_num_rows($category_result) > 0) {
                                                    while($category_row = mysqli_fetch_assoc($category_result)) {
                                                        $category_name = $category_row['name'];
                                                        echo "<option value='$category_name'>$category_name</option>";
                                                    }
                                                } else {
                                                    echo "<option value=''>No categories found</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </td>-->


                *****************************
 <?php 
    include('config/constants.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <h1>Task List</h1>
    <div class="menu">
       <a href="<?php echo SITEURL; ?>profil.php">Profil</a>
       <a href="<?php echo SITEURL; ?>Category list.php">Category list</a>
       <a href="<?php echo SITEURL; ?>Notifications.php">Notifications</a>
    </div>

    <div>
         <?php
            
            // Function to update status of overdue tasks:
           function updateOverdueTasks() {
            $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
            if(!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Get current date
            $currentDate = date('Y-m-d');

            // Update status of tasks with due dates before the current date to "Overdue"
            $updateQuery = "UPDATE tasks SET status = 'Overdue' WHERE due_date < '$currentDate' AND status != 'Done'";
            mysqli_query($conn, $updateQuery);

            mysqli_close($conn);
            }

        // Call the function to update overdue tasks
            updateOverdueTasks();
         
         
            
         ?>

    <p>
        <?php
            if(isset($_SESSION['delete_task'])){
                echo $_SESSION['delete_task'];
                unset($_SESSION['delete_task']);
            }

            if(isset($_SESSION['delete_fail_task'])){
                echo $_SESSION['delete_fail_task'];
                unset($_SESSION['delete_fail_task']);
            }

            if(isset($_SESSION['add_task'])){
                echo $_SESSION['add_task'];
                unset($_SESSION['add_task']);
            }

            
            if(isset($_SESSION['task_update'])){
                echo $_SESSION['task_update'];
                unset($_SESSION['task_update']);
            }
    
        ?>
    </p>
    </div>

    <div class="all-tasks">
        <a href="New task.php">New task</a>
        <table>
            <thead>
                <tr>
                    <th>Task</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>
                        <a href="?order_by=due_date">Due Date</a>
                    </th>
                    <th>
                        <a href="?order_by=priority">Priority</a>
                    </th>
                    <!--<th>Due Date</th>
                    <th>Priority</th>-->
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn));
                    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));
                    $sql = "SELECT * FROM tasks";
                    $res = mysqli_query($conn, $sql);

                    if($res == true){
                        while($task_row = mysqli_fetch_assoc($res)){
                            $task_name = $task_row['name'];
                            $task_description = $task_row['description'];
                            $category_name=$task_row['category_name'];
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
                                    <a href="<?php echo SITEURL; ?>update_task.php?name=<?php echo $task_name; ?>">Edit</a>
                                    <a href="<?php echo SITEURL; ?>delete_task.php?name=<?php echo $task_name; ?>">Delete</a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="7">No tasks added yet</td>
                        </tr>
                        <?php
                    }
                ?> 
            </tbody>
        </table>
    </div>
</body>
</html>