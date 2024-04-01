<?php 
 
    include('config/constants.php');


    // Function to get tasks that will be overdue in 3 days:
    function getOverdueTasks() {
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if(!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        
        $currentDate = date('Y-m-d');
        $threeDaysLater = date('Y-m-d', strtotime('+3 days'));

        $sql = "SELECT name FROM tasks WHERE due_date BETWEEN '$currentDate' AND '$threeDaysLater' AND status != 'Done'";

        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0) {
            $tasks = array();
            while($row = mysqli_fetch_assoc($result)) {
                $tasks[] = $row['name'];
            }
            return $tasks;
        } else {
            return array();
        }

        mysqli_close($conn);
    }

    $overdueTasks = getOverdueTasks();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="container">
    <div class="menu">
       
       <a href="<?php echo SITEURL; ?>">Task list</a>
       <a href="<?php echo SITEURL; ?>Category list.php">Category list</a>
       <a href="<?php echo SITEURL; ?>login.php"id="logoutBtn">LogOut</a>

        </div>

        <h1>Notifications</h1>

        

        <div class="notification-list">
            <?php if(!empty($overdueTasks)): ?>
                <h3>Caution! these tasks will be overdue in 3 days:</h3>
                <ul>
                    <?php foreach($overdueTasks as $task): ?>
                        <li><?php echo $task; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No tasks will be overdue in the next 3 days.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
