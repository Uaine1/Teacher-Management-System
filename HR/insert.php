<?php
require_once 'core/handleForms.php';
require_once 'core/models.php';

$teacher_id = $_GET['teacher_id'] ?? null;

$getTeacherByID = null;
if ($teacher_id) {
    $getTeacherByID = getTeacherByID($pdo, $teacher_id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $getTeacherByID ? "Edit Teacher" : "Add Teacher"; ?></title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<div class="container mt-5">
		<h1 class="text-center"><?php echo $getTeacherByID ? "Edit Teacher" : "Add Teacher"; ?>!</h1>
		<form action="core/handleForms.php" method="POST">
			<div class="form-group">
				<label for="firstName">First Name</label>
				<input type="text" class="form-control" name="first_name" value="<?php echo $getTeacherByID ? $getTeacherByID['first_name'] : ''; ?>" required>
			</div>
			<div class="form-group">
				<label for="lastName">Last Name</label>
				<input type="text" class="form-control" name="last_name" value="<?php echo $getTeacherByID ? $getTeacherByID['last_name'] : ''; ?>" required>
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" class="form-control" name="email" value="<?php echo $getTeacherByID ? $getTeacherByID['email'] : ''; ?>" required>
			</div>
			<div class="form-group">
				<label for="gender">Gender</label>
				<input type="text" class="form-control" name="gender" value="<?php echo $getTeacherByID ? $getTeacherByID['gender'] : ''; ?>" required>
			</div>
			<div class="form-group">
				<label for="subjectSpecialty">Subject Specialty</label>
				<input type="text" class="form-control" name="subject_specialty" value="<?php echo $getTeacherByID ? $getTeacherByID['subject_specialty'] : ''; ?>" required>
			</div>
			<?php if ($getTeacherByID): ?>
				<input type="hidden" name="teacher_id" value="<?php echo $getTeacherByID['teacher_id']; ?>">
			<?php endif; ?>

			<div class="form-group text-center">
				<button type="submit" class="btn btn-primary" name="editUserBtn"><?php echo $getTeacherByID ? "Save Changes" : "Add Teacher"; ?></button>
			</div>
		</form>
	</div>

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
