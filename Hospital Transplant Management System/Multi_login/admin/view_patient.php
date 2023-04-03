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
                <th scope="col">patient Id</th>
                <th scope="col">patient Name</th>
                <th scope="col"> patient Email</th>
                <th scope="col">patient Phone</th>
                <th scope="col">patient Organ</th>
                <th scope="col">patient Blood Type</th>
                <th scope="col">patient Status</th>
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
            $sql = "SELECT * FROM patients ";
            $result = $conn->query($sql);

            //check if there is any error with data fetching
            if(!$result) {
                die('Invalid query: ' . $conn->error);
            }

            //read data from each row of table in database
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['patient_id'] . "</td>";
                echo "<td>" . $row['patient_name'] . "</td>";
                echo "<td>" . $row['patient_email'] . "</td>";
                echo "<td>" . $row['patient_phone'] . "</td>";
                echo "<td>" . $row['patient_organ'] . "</td>";
                echo "<td>" . $row['patient_bloodtype'] . "</td>";
                echo "<td>" . $row['patient_status'] . "</td>";
                echo "<td>";
                echo "<a href='edit_patient.php?patient_id=$row[patient_id]' class='btn btn-primary btn-sm'>Edit</a>";
                echo "</td>";
                 echo "<td>";
                echo "<a href='delete_patient.php?patient_id=$row[patient_id]' class='btn btn-danger btn-sm'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
?>
      
         </tbody>


        </table>

    </div>
    
</body>
</html>