<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "multi_login";

 //create connection
 $conn = new mysqli($servername, $username, $password, $dbname);

$donor_name= "";
$donor_email= "";
$donor_phone= "";
$donor_organ= "";
$donor_bloodtype= "";
$successMessage = "";
$errorMessage = "";

if($_SERVER['REQUEST_METHOD']== 'POST'){
   
    $donor_name = $_POST['donor_name'];
    $donor_email = $_POST['donor_email'];
    $donor_phone = $_POST['donor_phone'];
    $donor_organ= $_POST['donor_organ'];
    $donor_bloodtype= $_POST['donor_bloodtype'];
     
    do{
        if(empty($donor_name) || empty($donor_email) || empty($donor_phone) || empty($donor_organ) || empty($donor_bloodtype)){
            $errorMessage = "Please fill all fields";
            break;
        }
   
        //insert new record into database

        $sql = "INSERT INTO donors (donor_name, donor_email, donor_phone, donor_organ, donor_bloodtype) VALUES ('$donor_name', '$donor_email', '$donor_phone', '$donor_organ', '$donor_bloodtype')";
        $result = $conn -> query($sql);

        if(!$result){
            $errorMessage = "Error while adding Donor" . $conn->error;
            break;
        }  

        

        $donor_name= "";
        $donor_email= "";
        $donor_phone= "";
        $donor_organ= "";
        $donor_bloodtype= "";

        $successMessage= "Donor registered successfully!";
        header("Location: UsersHome.html");
        exit;


    }while(false);

}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Create Donor Page </title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
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
        <h2>Donor Registration Form</h2>
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
    
    <form method="post" action="donor_form.php">
         <div class="input-group">
            <label>donor_name</label>
            <input type="text" name="donor_name" value="<?php echo $donor_name; ?>">
        </div>
        <div class="input-group">
            <label>donor_email</label>
            <input type="email" name="donor_email" value="<?php echo $donor_email; ?>">
        </div>
        <div class="input-group">
            <label>donor_phone</label>
            <input type="tel" name="donor_phone" value="<?php echo $donor_phone; ?>">
        </div>
        <div class="input-group">
            <label>donor_organ</label>
            <input type="text" name="donor_organ" value="<?php echo $donor_organ; ?>">
        </div>
         <div class="input-group">
            <label>donor_bloodtype</label>
            <input type="text" name="donor_bloodtype" value="<?php echo $donor_bloodtype; ?>">
        </div>
         <div class="input-group">
            <button type="submit" class="btn" name="register_btn" href="UsersHome.html"> + Register Donor</button>
        </div>
    </form>
</body>
</html>

