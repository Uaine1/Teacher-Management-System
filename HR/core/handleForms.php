<?php  

require_once 'dbConfig.php';
require_once 'models.php';

if (isset($_POST['insertUserBtn'])) {
    $insertUser = insertNewTeacher($pdo, $_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['gender'], $_POST['subject_specialty'], $_POST['employ_status']);

    if ($insertUser) {
        $_SESSION['message'] = "Successfully inserted!";
        header("Location: ../index.php");
    }
}

if (isset($_POST['editUserBtn'])) {
    $first_name = $_POST['first_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $subject_specialty = $_POST['subject_specialty'] ?? '';
	$employ_status = $_POST['employ_status'] ?? '';
    $teacher_id = $_POST['teacher_id'] ?? null;

    if ($teacher_id) {
        $updateSuccess = editUser($pdo, $first_name, $last_name, $email, $gender, $subject_specialty, $teacher_id, $employ_status);
        
        if ($updateSuccess) {
            echo "Teacher updated successfully!";
            header("Location: ../index.php");
            exit();
        } else {
            echo "Failed to update teacher.";
        }
    }
    else {
        $insertSuccess = insertNewteacher($pdo, $first_name, $last_name, $email, $gender, $subject_specialty, $employ_status);
        
        if ($insertSuccess) {
            echo "New teacher added successfully!";
            header("Location: ../index.php");
            exit();
        } else {
            echo "Failed to add new teacher.";
        }
    }
}

if (isset($_POST['deleteUserBtn'])) {
    $deleteUser = deleteUser($pdo, $_GET['teacher_id']);

    if ($deleteUser) {
        $_SESSION['message'] = "Successfully deleted!";
        header("Location: ../index.php");
    }
}

if (isset($_GET['searchBtn'])) {
    $searchForAUser = searchForAUser($pdo, $_GET['searchInput']);
    foreach ($searchForAUser as $row) {
        echo "<tr> 
                <td>{$row['teacher_id']}</td>
                <td>{$row['first_name']}</td>
                <td>{$row['last_name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['gender']}</td>
                <td>{$row['subject_specialty']}</td>
              </tr>";
    }
}

// Log In and Register
if (isset($_POST['insertNewUserBtn'])) {
	$username = trim($_POST['username']);
	$first_name = trim($_POST['first_name']);
	$last_name = trim($_POST['last_name']);
	$password = trim($_POST['password']);
	$confirm_password = trim($_POST['confirm_password']);

	if (!empty($username) && !empty($first_name) && !empty($last_name) && !empty($password) && !empty($confirm_password)) {

		if ($password == $confirm_password) {

			$insertQuery = insertNewUser($pdo, $username, $first_name, $last_name, password_hash($password, PASSWORD_DEFAULT));

			if ($insertQuery['status'] == '200') {
				$_SESSION['message'] = $insertQuery['message'];
				$_SESSION['status'] = $insertQuery['status'];
				header("Location: ../login.php");
			}

			else {
				$_SESSION['message'] = $insertQuery['message'];
				$_SESSION['status'] = $insertQuery['status'];
				header("Location: ../register.php");
			}

		}
		else {
			$_SESSION['message'] = "Please make sure both passwords are equal";
			$_SESSION['status'] = "400";
			header("Location: ../register.php");
		}

	}

	else {
		$_SESSION['message'] = "Please make sure there are no empty input fields";
		$_SESSION['status'] = "400";
		header("Location: ../register.php");
	}
}

if (isset($_POST['loginUserBtn'])) {
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);

	if (!empty($username) && !empty($password)) {

		$loginQuery = checkIfUserExists($pdo, $username);

		if ($loginQuery['status'] == '200') {
			$usernameFromDB = $loginQuery['userInfoArray']['username'];
			$passwordFromDB = $loginQuery['userInfoArray']['password'];

			if (password_verify($password, $passwordFromDB)) {
				$_SESSION['username'] = $usernameFromDB;
				header("Location: ../index.php");
			}
		}

		else {
			$_SESSION['message'] = $loginQuery['message'];
			$_SESSION['status'] = $loginQuery['status'];
			header("Location: ../login.php");
		}
	}

	else {
		$_SESSION['message'] = "Please make sure no input fields are empty";
		$_SESSION['status'] = "400";
		header("Location: ../login.php");
	}
}

if (isset($_GET['logoutUserBtn'])) {
	unset($_SESSION['username']);
	header("Location: ../login.php");
}

?>
