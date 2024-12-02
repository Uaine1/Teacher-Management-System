<?php
require_once 'dbConfig.php';

if (isset($_GET['job_id']) && isset($_GET['applicant_id'])) {
    $job_id = $_GET['job_id'];
    $applicant_id = $_GET['applicant_id'];

    $stmt = $pdo->prepare("SELECT * FROM applicants WHERE applicant_id = ?");
    $stmt->execute([$applicant_id]);
    $applicant = $stmt->fetch();

    if ($applicant) {

        $stmt = $pdo->prepare("INSERT INTO teachers (first_name, last_name, email, gender, subject_specialty, employ_status) 
                               VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $applicant['first_name'], 
            $applicant['last_name'], 
            $applicant['email'], 
            $applicant['gender'], 
            $applicant['subject_specialty'], 
            'Hired'  
        ]);

        $stmt = $pdo->prepare("DELETE FROM applicants WHERE applicant_id = ?");
        $stmt->execute([$applicant_id]);

        $stmt = $pdo->prepare("UPDATE job_posts SET hired_user_id = ? WHERE job_id = ?");
        $stmt->execute([$applicant_id, $job_id]);

        $_SESSION['message'] = 'Applicant successfully hired and moved to teachers!';
        header("Location: ../index.php");
        exit();
    } else {
        $_SESSION['message'] = 'Applicant not found.';
        header("Location: ../index.php");
        exit();
    }
} else {

    $_SESSION['message'] = 'Invalid request. Missing job ID or applicant ID.';
    header("Location: ../index.php");
    exit();
}
?>
