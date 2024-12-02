<?php require_once 'core/handleForms.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Teacher</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="styles.css">
</head>
<body class="container mt-5">
	<?php $getUserByID = getTeacherByID($pdo, $_GET['teacher_id']); ?>
	<h1 class="text-center mb-4">Edit the Teacher</h1>

	<form action="core/handleForms.php?teacher_id=<?php echo $_GET['teacher_id']; ?>" method="POST">
		<div class="mb-3">
			<label for="firstName" class="form-label">First Name</label>
			<input type="text" name="first_name" value="<?php echo $getUserByID['first_name']; ?>" class="form-control" id="firstName">
		</div>
		<div class="mb-3">
			<label for="lastName" class="form-label">Last Name</label>
			<input type="text" name="last_name" value="<?php echo $getUserByID['last_name']; ?>" class="form-control" id="lastName">
		</div>
		<div class="mb-3">
			<label for="email" class="form-label">Email</label>
			<input type="email" name="email" value="<?php echo $getUserByID['email']; ?>" class="form-control" id="email">
		</div>
		<div class="mb-3">
			<label for="gender" class="form-label">Gender</label>
			<input type="text" name="gender" value="<?php echo $getUserByID['gender']; ?>" class="form-control" id="gender">
		</div>
		<div class="mb-3">
			<label for="subjectSpecialty" class="form-label">Subject Specialty</label>
			<input type="text" name="subject_specialty" value="<?php echo $getUserByID['subject_specialty']; ?>" class="form-control" id="subjectSpecialty">
		</div>
		<div class="mb-3">
			<label for="employStatus" class="form-label">Employment Status</label>
			<input type="text" name="employ_status" value="<?php echo $getUserByID['employ_status']; ?>" class="form-control" id="employStatus">
		</div>
		<div class="mb-3 text-center">
			<input type="submit" value="Save" name="editUserBtn" class="btn btn-primary btn-lg">
		</div>
	</form>
	
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
