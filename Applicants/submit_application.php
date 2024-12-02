<?php
require_once 'core/dbConfig.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $job_id = $_POST['job_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $resume = $_FILES['resume'];

    if ($resume['error'] == 0) {
        if (!is_dir('uploads')) {
            mkdir('uploads', 0777, true); 
        }

        $resume_name = basename($resume['name']);
        $resume_url = 'uploads/' . $resume_name;

        $allowed_extensions = ['pdf', 'doc', 'docx'];
        $file_extension = pathinfo($resume_name, PATHINFO_EXTENSION);

        if (in_array($file_extension, $allowed_extensions)) {
            if (move_uploaded_file($resume['tmp_name'], $resume_url)) {
                $stmt = $pdo->prepare("INSERT INTO applicants (job_id, first_name, last_name, email, resume_url) 
                                        VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$job_id, $first_name, $last_name, $email, $resume_url]);

                header("Location: index.php?message=Application submitted successfully!");
                exit();
            } else {
                die("Failed to upload resume.");
            }
        } else {
            die("Invalid file type. Only PDF and Word files are allowed.");
        }
    } else {
        die("Failed to upload resume.");
    }
}
?>
