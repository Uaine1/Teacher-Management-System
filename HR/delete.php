<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Delete Teacher</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="styles.css">
</head>
<body class="container mt-5">
	<h1 class="text-center text-danger mb-4">Are you sure you want to delete this teacher?</h1>
	<?php $getUserByID = getTeacherByID($pdo, $_GET['teacher_id']); ?>
	<div class="card border-danger shadow">
		<div class="card-body bg-light">
			<h2 class="text-danger">First Name: <span class="text-dark"><?php echo $getUserByID['first_name']; ?></span></h2>
			<h2 class="text-danger">Last Name: <span class="text-dark"><?php echo $getUserByID['last_name']; ?></span></h2>
			<h2 class="text-danger">Email: <span class="text-dark"><?php echo $getUserByID['email']; ?></span></h2>
			<h2 class="text-danger">Gender: <span class="text-dark"><?php echo $getUserByID['gender']; ?></span></h2>
			<h2 class="text-danger">Subject Specialty: <span class="text-dark"><?php echo $getUserByID['subject_specialty']; ?></span></h2>

			<div class="text-end mt-4">
				<form action="core/handleForms.php?teacher_id=<?php echo $_GET['teacher_id']; ?>" method="POST">
					<button type="submit" name="deleteUserBtn" class="btn btn-danger btn-lg">Delete</button>
				</form>			
			</div>
		</div>
	</div>

	<!-- Bootstrap Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
