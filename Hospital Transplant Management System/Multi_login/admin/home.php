<?php 
include('../functions.php');

if (!isAdmin()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../login.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: ../login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Home Page</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
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
		<h2>Admin Dashboard</h2>
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
			<img src="../Images/admin_profile.png"  >

			<div>
				<?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['username']; ?></strong>

					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
						<br>
						<a href="home.php?logout='1'" style="color: red;">logout</a><br><br>
                       <a class="btn btn-primary" href="create_user.php" role="button">+ add user</a> 
					   <a class="btn btn-primary" href="view_users.php" role="button"> view users</a>
			        <a class="btn btn-primary" href="add_donors.php" role="button"> + add Donors</a>  
				    <a class="btn btn-primary" href="view_donors.php" role="button"> view Donors</a>
				 <a class="btn btn-primary" href="add_patients.php" role="button">   + add Patients</a> <a class="btn btn-primary" href="view_patient.php" role="button"> view Patients</a> 
				  <a class="btn btn-primary" href="BulK_Sms" role="button">SMS Alert</a><br><br>
				  <a class="btn btn-primary" href="Patient_Organs.php" role="button">Patient_Organs-Report</a>
				  <a class="btn btn-primary" href="Donor_Organs.php" role="button"> Donor_Organs_Report</a>
				   <a class="btn btn-primary" href="patient_report.php" role="button"> Surgery_Report</a>
				   <a class="btn btn-primary" href="donor_report.php" role="button"> Donor_Report</a>

					</small>

				<?php endif ?>
			</div>
		</div>
	</div>
</body>
</html>