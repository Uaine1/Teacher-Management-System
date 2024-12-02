<?php
require_once 'dbConfig.php';
if (isset($_POST['create_job_post'])) {
    $job_title = $_POST['job_title'];
    $job_description = $_POST['job_description'];

    $stmt = $pdo->prepare("INSERT INTO job_posts (job_title, job_description) VALUES (?, ?)");
    $stmt->execute([$job_title, $job_description]);

    $_SESSION['message'] = 'Job posted successfully!';
    header("Location: ../index.php");
    exit();
}
?>
