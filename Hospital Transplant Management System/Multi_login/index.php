<?php 
	include('functions.php');
   if (!isLoggedIn()) {
	    $_SESSION['msg'] = "You must log in first";
	    header('location: login.php');
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Doctors Home Page</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<style>
	.header {
		background: #003366;
	}
	button[name=register_btn] {
		background: #003366;
	}
	</style>
	   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</head>
<body>
	<div class="header">
		<h2>Doctors Dashboard</h2>
	</div>
	<div class="content">
		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>
		<!-- logged in user information -->
		<div class="profile_info">
			<img class="user_profile" src="Images/user_profile.png"  >
             <div>
                 <?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['username']; ?></strong>

					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
						<br>
						<a href="index.php?logout='1'" style="color: red;">logout</a><br><br>
				         <a class="btn btn-primary" href="add_patients.php" role="button"> + add Patients</a> &nbsp;<a class="btn btn-primary" href="view_patient.php" role="button"> View patients</a> 
					</small>

				<?php endif ?>
			</div>
		</div>
	</div>
</body>
</html>