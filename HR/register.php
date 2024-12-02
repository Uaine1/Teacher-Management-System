<?php  
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1 class="text-center">Register here!</h1>

		<?php  
		if (isset($_SESSION['message']) && isset($_SESSION['status'])) {
			if ($_SESSION['status'] == "200") {
				echo "<div class='alert alert-success text-center'>{$_SESSION['message']}</div>";
			} else {
				echo "<div class='alert alert-danger text-center'>{$_SESSION['message']}</div>";	
			}
		}
		unset($_SESSION['message']);
		unset($_SESSION['status']);
		?>

		<form action="core/handleForms.php" method="POST">
			<div class="form-group">
				<label for="username">Username</label>
				<input type="text" class="form-control" name="username" required>
			</div>
			<div class="form-group">
				<label for="first_name">First Name</label>
				<input type="text" class="form-control" name="first_name" required>
			</div>
			<div class="form-group">
				<label for="last_name">Last Name</label>
				<input type="text" class="form-control" name="last_name" required>
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" class="form-control" name="password" required>
			</div>
			<div class="form-group">
				<label for="confirm_password">Confirm Password</label>
				<input type="password" class="form-control" name="confirm_password" required>
			</div>
			<button type="submit" name="insertNewUserBtn" class="btn btn-primary btn-block">Register</button>
		</form>
	</div>
	
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
