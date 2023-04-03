<?php include('../functions.php') ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
     <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>View Users</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    
</head>
<body></body>
    <div class="container my-5">
     <table class="table">
         <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">user_type</th>
                <th scope="col">password</th></th>
               </tr>
         </thead>
         <tbody>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "multi_login";

            //create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            //check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            //read all rows from database table
            $sql = "SELECT * FROM users ";
            $result = $conn->query($sql);

            //check if there is any error with data fetching
            if(!$result) {
                die('Invalid query: ' . $conn->error);
            }

            //read data from each row of table in database
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['user_type'] . "</td>";
                echo "<td>" . $row['password'] . "</td>";
                echo "<td>";
                echo "<a href='edit.php?id=$row[id]' class='btn btn-primary btn-sm'>Edit</a>";
                echo "<a href='delete.php?id=$row[id]' class='btn btn-danger btn-sm'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
?>
      
         </tbody>


        </table>

    </div>
    
</body>
</html>