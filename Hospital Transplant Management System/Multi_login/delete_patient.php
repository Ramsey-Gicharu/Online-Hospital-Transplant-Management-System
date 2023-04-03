<?php
if ( isset($_GET['patient_id'] ) ) {
    $patient_id = $_GET['patient_id'];
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "multi_login";

            //create connection
    $conn = new mysqli($servername, $username, $password, $dbname);


    $sql = "DELETE FROM patients WHERE patient_id = $patient_id";
    $conn->query($sql);

}

header("Location: index.php");
exit;
?>