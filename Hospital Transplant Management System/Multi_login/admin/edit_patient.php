<?php include('../functions.php') ?>
<?php

$servername = "localhost";
$username = "root";
$dbpassword = "";
$dbname = "multi_login";

 //create connection
$conn = new mysqli( $servername, $username, $dbpassword, $dbname);

$patient_id = "";
$patient_name= "";
$patient_email= "";
$patient_phone= "";
$patient_organ= "";
$patient_bloodtype= "";
$patient_status = "";

$successMessage = "";
$errorMessage = "";

if($_SERVER['REQUEST_METHOD'] == "GET") {
    //Get method show data to the client

    if( !isset($_GET["patient_id"])) {
       header("Location: home.php");
       exit;
    }

    $patient_id= $_GET["patient_id"];
    
    //read the row from the selected id in the database
    $sql = "SELECT * FROM patients WHERE patient_id = $patient_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if(!$row) {
        header("Location: home.php");
        exit;
    }

    $patient_name= $row['patient_name'];
    $patient_email= $row['patient_email'];
    $patient_phone= $row['patient_phone'];
    $patient_organ= $row['patient_organ'];
    $patient_bloodtype= $row['patient_bloodtype'];
    $patient_status = $row['patient_status'];

}
else {
    //Post method update data in the database
    $patient_id= $_POST['patient_id'];
    $patient_name= $_POST['patient_name'];
    $patient_email= $_POST['patient_email'];
    $patient_phone= $_POST['patient_phone'];
    $patient_organ= $_POST['patient_organ'];
    $patient_bloodtype= $_POST['patient_bloodtype'];
    $patient_status = $_POST['patient_status'];

    do{
        if( empty($patient_id) || empty($patient_name) || empty($patient_email) || empty($patient_phone) || empty($patient_organ) || empty($patient_bloodtype) || empty($patient_status)){
            $errorMessage = "Please fill all fields";
            break;
        }
         $password = md5($password);//encrypt the password before saving in the database
        $sql= "UPDATE patients SET patient_name = '$patient_name', patient_email = '$patient_email', patient_phone = '$patient_phone', patient_organ = '$patient_organ', patient_bloodtype = '$patient_bloodtype', patient_status = '$patient_status' WHERE patient_id = $patient_id";

       
        $result = $conn -> query($sql);

             //check if there is any error with data fetching
            if(!$result) {
                die('Invalid query: ' . $conn->error);
            }

        $successMessage = "patient data updated successfully!";

        header("Location: home.php");
        exit;

    }while(false);

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View patients Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" ></script>
</head>
<body>
    <div class="container my-5">
     <?php
        if(!empty($errorMessage)){
            echo "
                 <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                 <strong> $errorMessage </strong> 
                 <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                 </div>
            ";
          
        }

       ?>

        <form method="post">
            <input type="hidden" name="patient_id" value="<?php echo $patient_id; ?>">
        <div class="mb-3">
          <label for="patient_name" class="form-label">patient Name</label>
          <input type="text" class="form-control" id="patient_name" name="patient_name" placeholder="Enter patient name" value="<?php echo $patient_name; ?>">
        </div>
        <div class="mb-3">
          <label for="patient_email" class="form-label">patient Email</label>
          <input type="email" class="form-control" id="patient_email" name="patient_email" placeholder="Enter email" value="<?php echo $patient_email; ?>">
        </div>
        <div class="mb-3">
          <label for="patient_phone" class="form-label">patient Phone Number</label>
          <input type="text" class="form-control" id="patient_phone" name="patient_phone" placeholder="Enter patient phone number" value="<?php echo $patient_phone; ?>">
        </div>
        <div class="mb-3">
          <label for="patient_organ" class="form-label">patient Organ</label>
          <input type="text" class="form-control" id="patient_organ" name="patient_organ" placeholder="Enter patient organ" value="<?php echo $patient_organ; ?>">
        </div>
         <div class="mb-3">
          <label for="patient_bloodtype" class="form-label">patient Blood Type</label>
          <input type="text" class="form-control" id="patient_bloodtype" name="patient_bloodtype" placeholder="Enter patient blood type" value="<?php echo $patient_bloodtype; ?>">
        </div>
          <div class="mb-3">
          <label for="patient_bloodtype" class="form-label">Patient status</label>
          <input type="text" class="form-control" id="patient_status" name="patient_status" placeholder="Enter patient blood type" value="<?php echo $patient_status; ?>">
        </div>

        <?php
        if(!empty($successMessage)){
            echo "
                 <div class='alert alert-success alert-dismissible fade show' role='alert'>
                 <strong> $successMessage </strong> 
                 <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                 </div>
            ";
          
        }

       ?>
      

        <button type="submit" class="btn btn-primary" href="/admin/home.php">SUBMIT</button>
         <button type="submit" class="btn btn-outline-primary" href="/admin/home.php">CLOSE</button>


      </form>


    
</body>
</html>