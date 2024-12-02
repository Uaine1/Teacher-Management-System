<?php  
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<style>
		body {
			font-family: "Arial";
		}
		
	</style>
</head>
<body class="container mt-5">
	<?php  
	if (isset($_SESSION['message']) && isset($_SESSION['status'])) {
		$alertClass = ($_SESSION['status'] == "200") ? "alert-success" : "alert-danger";
		echo "<div class='alert $alertClass' role='alert'>{$_SESSION['message']}</div>";
	}
	unset($_SESSION['message']);
	unset($_SESSION['status']);
	?>
	
	<h1 class="text-center">Welcome HR! Login Now!</h1>
	<form action="core/handleForms.php" method="POST" class="p-4 shadow rounded bg-light">
		<div class="mb-3">
			<label for="username" class="form-label">Username</label>
			<input type="text" name="username" class="form-control" id="username">
		</div>
		<div class="mb-3">
			<label for="password" class="form-label">Password</label>
			<input type="password" name="password" class="form-control" id="password">
		</div>
		<button type="submit" name="loginUserBtn" class="btn btn-primary w-100">Login</button>
	</form>
	<p class="mt-3 text-center">Don't have an account? <a href="register.php">Register here</a></p>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
