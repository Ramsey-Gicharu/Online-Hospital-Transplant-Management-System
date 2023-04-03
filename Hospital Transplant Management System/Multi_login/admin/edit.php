<?php include('../functions.php') ?>
<?php

$servername = "localhost";
$username = "root";
$dbpassword = "";
$dbname = "multi_login";

 //create connection
$conn = new mysqli( $servername, $username, $dbpassword, $dbname);

$id = "";
$username= "";
$email= "";
$user_type= "";
$password= "";

$successMessage = "";
$errorMessage = "";

if($_SERVER['REQUEST_METHOD'] == "GET") {
    //Get method show data to the client

    if( !isset($_GET["id"])) {
       header("Location: home.php");
       exit;
    }

    $id= $_GET["id"];
    
    //read the row from the selected id in the database
    $sql = "SELECT * FROM users WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if(!$row) {
        header("Location: home.php");
        exit;
    }

    $username= $row['username'];
    $email= $row['email'];
    $user_type= $row['user_type'];
    $password= $row['password'];

}
else {
    //Post method update data in the database
    $id= $_POST['id'];
    $username= $_POST['username'];
    $email= $_POST['email'];
    $user_type= $_POST['user_type'];
    $password= $_POST['password'];

    do{
        if( empty($id) || empty($username) || empty($email) || empty($user_type) || empty($password)){
            $errorMessage = "Please fill all fields";
            break;
        }
         $password = md5($password);//encrypt the password before saving in the database
        $sql= "UPDATE users SET username = '$username', email = '$email', user_type = '$user_type', password = '$password' WHERE id = $id";

       
        $result = $conn -> query($sql);

             //check if there is any error with data fetching
            if(!$result) {
                die('Invalid query: ' . $conn->error);
            }

        $successMessage = "Client updated successfully!";

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
    <title>My Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" ></script>
</head>
<body>
    <div class="container my-5">
       <h2>List of Clients</h2>

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
            <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" value="<?php echo $username; ?>">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="<?php echo $email; ?>">
        </div>
        <div class="mb-3">
          <label for="user_type" class="form-label">user_type</label>
          <input type="text" class="form-control" id="user_type" name="user_type" placeholder="Enter user_type" value="<?php echo $user_type; ?>">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" value="<?php echo $user_type; ?>">
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