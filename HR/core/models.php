<?php  

require_once 'dbConfig.php';

function getAllUsers($pdo) {
    $sql = "SELECT * FROM teachers 
            ORDER BY first_name ASC";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute();
    if ($executeQuery) {
        return $stmt->fetchAll();
    }
}

function getTeacherByID($pdo, $teacher_id) {
    $sql = "SELECT * from teachers WHERE teacher_id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$teacher_id]);

    if ($executeQuery) {
        return $stmt->fetch();
    }
}

function searchForAUser($pdo, $searchQuery) {
    $sql = "SELECT * FROM teachers WHERE 
            CONCAT(first_name, last_name, email, gender,
                subject_specialty) 
            LIKE ?";

    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute(["%" . $searchQuery . "%"]);
    if ($executeQuery) {
        return $stmt->fetchAll();
    }
}

function insertNewteacher($pdo, $first_name, $last_name, $email, 
    $gender, $subject_specialty, $employ_status) {

    $sql = "INSERT INTO teachers 
            (
                first_name,
                last_name,
                email,
                gender,
                subject_specialty,
				employ_status
            )
            VALUES (?,?,?,?,?,?)";

    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([
        $first_name, $last_name, $email, 
        $gender, $subject_specialty, $employ_status
    ]);

    if ($executeQuery) {
        return true;
    }
}

function editUser($pdo, $first_name, $last_name, $email, $gender, 
    $subject_specialty, $employ_status, $teacher_id) {

    $sql = "UPDATE teachers
            SET first_name = ?,
                last_name = ?,
                email = ?,
                gender = ?,
                subject_specialty = ?
				employ_status = ?
            WHERE teacher_id = ?";

    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$first_name, $last_name, $email, $gender, 
        $subject_specialty, $employ_status, $teacher_id]);

    if ($executeQuery) {
        return true;
    }
}

function deleteUser($pdo, $teacher_id) {
    $sql = "DELETE FROM teachers 
            WHERE teacher_id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$teacher_id]);

    if ($executeQuery) {
        return true;
    }
}

// Log In and Register
function checkIfUserExists($pdo, $username) {
	$response = array();
	$sql = "SELECT * FROM user_accounts WHERE username = ?";
	$stmt = $pdo->prepare($sql);

	if ($stmt->execute([$username])) {

		$userInfoArray = $stmt->fetch();

		if ($stmt->rowCount() > 0) {
			$response = array(
				"result"=> true,
				"status" => "200",
				"userInfoArray" => $userInfoArray
			);
		}

		else {
			$response = array(
				"status" => "400",
				"message"=> "User doesn't exist from the database"
			);
		}
	}

	return $response;

}

function insertNewUser($pdo, $username, $first_name, $last_name, $password) {
	$response = array();
	$checkIfUserExists = checkIfUserExists($pdo, $username); 

	if (!$checkIfUserExists['result']) {

		$sql = "INSERT INTO user_accounts (username, first_name, last_name, password) 
		VALUES (?,?,?,?)";

		$stmt = $pdo->prepare($sql);

		if ($stmt->execute([$username, $first_name, $last_name, $password])) {
			$response = array(
				"status" => "200",
				"message" => "User successfully inserted!"
			);
		}

		else {
			$response = array(
				"status" => "400",
				"message" => "An error occured with the query!"
			);
		}
	}

	else {
		$response = array(
			"status" => "400",
			"message" => "User already exists!"
		);
	}

	return $response;
}

function getUserByID($pdo, $user_id) {
    $sql = "SELECT * FROM user_accounts WHERE user_id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$user_id]);

    if ($executeQuery) {
        return $stmt->fetch();
    }
    return null;
}

?>
