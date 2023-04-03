<?php include('../functions.php') ?>
<?php

$servername = "localhost";
$username = "root";
$dbpassword = "";
$dbname = "multi_login";

 //create connection
$conn = new mysqli( $servername, $username, $dbpassword, $dbname);

$donor_id = "";
$donor_name= "";
$donor_email= "";
$donor_phone= "";
$donor_organ= "";
$donor_bloodtype= "";
$donor_status = "";

$successMessage = "";
$errorMessage = "";

if($_SERVER['REQUEST_METHOD'] == "GET") {
    //Get method show data to the client

    if( !isset($_GET["donor_id"])) {
       header("Location: home.php");
       exit;
    }

    $donor_id= $_GET["donor_id"];
    
    //read the row from the selected id in the database
    $sql = "SELECT * FROM donors WHERE donor_id = $donor_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if(!$row) {
        header("Location: home.php");
        exit;
    }

    $donor_name= $row['donor_name'];
    $donor_email= $row['donor_email'];
    $donor_phone= $row['donor_phone'];
    $donor_organ= $row['donor_organ'];
    $donor_bloodtype= $row['donor_bloodtype'];
    $donor_status = $row['donor_status'];

}
else {
    //Post method update data in the database
    $donor_id= $_POST['donor_id'];
    $donor_name= $_POST['donor_name'];
    $donor_email= $_POST['donor_email'];
    $donor_phone= $_POST['donor_phone'];
    $donor_organ= $_POST['donor_organ'];
    $donor_bloodtype= $_POST['donor_bloodtype'];
    $donor_status = $_POST['donor_status'];

    do{
        if( empty($donor_id) || empty($donor_name) || empty($donor_email) || empty($donor_phone) || empty($donor_organ) || empty($donor_bloodtype) || empty($donor_status)){
            $errorMessage = "Please fill all fields";
            break;
        }
        
        $sql= "UPDATE donors SET donor_name = '$donor_name', donor_email = '$donor_email', donor_phone = '$donor_phone', donor_organ = '$donor_organ', donor_bloodtype = '$donor_bloodtype', donor_status = '$donor_status' WHERE donor_id = $donor_id";

       
        $result = $conn -> query($sql);

             //check if there is any error with data fetching
            if(!$result) {
                die('Invalid query: ' . $conn->error);
            }

        $successMessage = "Donor data updated successfully!";

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
    <title>View Donors Page</title>
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
            <input type="hidden" name="donor_id" value="<?php echo $donor_id; ?>">
        <div class="mb-3">
          <label for="donor_name" class="form-label">Donor Name</label>
          <input type="text" class="form-control" id="donor_name" name="donor_name" placeholder="Enter donor name" value="<?php echo $donor_name; ?>">
        </div>
        <div class="mb-3">
          <label for="donor_email" class="form-label">Donor Email</label>
          <input type="email" class="form-control" id="donor_email" name="donor_email" placeholder="Enter email" value="<?php echo $donor_email; ?>">
        </div>
        <div class="mb-3">
          <label for="donor_phone" class="form-label">Donor Phone Number</label>
          <input type="text" class="form-control" id="donor_phone" name="donor_phone" placeholder="Enter donor phone number" value="<?php echo $donor_phone; ?>">
        </div>
        <div class="mb-3">
          <label for="donor_organ" class="form-label">Donor Organ</label>
          <input type="text" class="form-control" id="donor_organ" name="donor_organ" placeholder="Enter donor organ" value="<?php echo $donor_organ; ?>">
        </div>
         <div class="mb-3">
          <label for="donor_bloodtype" class="form-label">Donor Blood Type</label>
          <input type="text" class="form-control" id="donor_bloodtype" name="donor_bloodtype" placeholder="Enter donor blood type" value="<?php echo $donor_bloodtype; ?>">
        </div>
         <div class="mb-3">
          <label for="donor_bloodtype" class="form-label">Donor Status</label>
          <input type="text" class="form-control" id="donor_status" name="donor_status" placeholder="Enter donor status" value="<?php echo $donor_status; ?>">
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