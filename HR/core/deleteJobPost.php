<?php
session_start();
require_once 'dbConfig.php';

if (isset($_GET['job_id'])) {
    $job_id = $_GET['job_id'];

    $stmt = $pdo->prepare("DELETE FROM job_posts WHERE job_id = ?");
    $stmt->execute([$job_id]);

    $_SESSION['message'] = 'Job post deleted successfully!';
    header("Location: ../index.php");
    exit();
}
?>
