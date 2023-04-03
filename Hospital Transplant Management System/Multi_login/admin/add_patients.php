<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "multi_login";

 //create connection
 $conn = new mysqli($servername, $username, $password, $dbname);

$patient_name= "";
$patient_email= "";
$patient_phone= "";
$patient_organ= "";
$patient_bloodtype= "";
$successMessage = "";
$errorMessage = "";

if($_SERVER['REQUEST_METHOD']== 'POST'){
   
    $patient_name = $_POST['patient_name'];
    $patient_email = $_POST['patient_email'];
    $patient_phone = $_POST['patient_phone'];
    $patient_organ= $_POST['patient_organ'];
    $patient_bloodtype= $_POST['patient_bloodtype'];
     
    do{
        if(empty($patient_name) || empty($patient_email) || empty($patient_phone) || empty($patient_organ) || empty($patient_bloodtype)){
            $errorMessage = "Please fill all fields";
            break;
        }
   
        //insert new record into database

        $sql = "INSERT INTO patients (patient_name, patient_email, patient_phone, patient_organ, patient_bloodtype) VALUES ('$patient_name', '$patient_email', '$patient_phone', '$patient_organ', '$patient_bloodtype')";
        $result = $conn -> query($sql);

        if(!$result){
            $errorMessage = "Error while adding patient" . $conn->error;
            break;
        }  

        

        $patient_name= "";
        $patient_email= "";
        $patient_phone= "";
        $patient_organ= "";
        $patient_bloodtype= "";

        $successMessage= "patient added successfully!";
        header("Location: home.php");
        exit;


    }while(false);

}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Create patient Page </title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <style>
        .header {
            background: #003366;
        }
        button[name=register_btn] {
            background: #003366;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Admin - create patient</h2>
    </div>

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
    
    <form method="post" action="add_patients.php">
         <div class="input-group">
            <label>patient_name</label>
            <input type="text" name="patient_name" value="<?php echo $patient_name; ?>">
        </div>
        <div class="input-group">
            <label>patient_email</label>
            <input type="email" name="patient_email" value="<?php echo $patient_email; ?>">
        </div>
        <div class="input-group">
            <label>patient_phone</label>
            <input type="tel" name="patient_phone" value="<?php echo $patient_phone; ?>">
        </div>
        <div class="input-group">
            <label>patient_organ</label>
            <input type="text" name="patient_organ" value="<?php echo $patient_organ; ?>">
        </div>
         <div class="input-group">
            <label>patient_bloodtype</label>
            <input type="text" name="patient_bloodtype" value="<?php echo $patient_bloodtype; ?>">
        </div>
         <div class="input-group">
            <button type="submit" class="btn" name="register_btn" href="home.php"> + Create patient</button>
        </div>
    </form>
</body>
</html>

