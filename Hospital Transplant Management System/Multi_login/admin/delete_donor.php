<?php
if ( isset($_GET['donor_id'] ) ) {
    $donor_id = $_GET['donor_id'];
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "multi_login";

            //create connection
    $conn = new mysqli($servername, $username, $password, $dbname);


    $sql = "DELETE FROM donors WHERE donor_id = $donor_id";
    $conn->query($sql);

}

header("Location: home.php");
exit;
?>