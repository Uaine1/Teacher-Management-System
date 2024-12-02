<?php
require_once 'core/dbConfig.php';  // Include the database connection

if (isset($_GET['job_id'])) {
    $job_id = $_GET['job_id'];

    // Fetch job details for the selected job post
    $stmt = $pdo->prepare("SELECT * FROM job_posts WHERE job_id = ?");
    $stmt->execute([$job_id]);
    $job = $stmt->fetch();

    if (!$job) {
        // If job does not exist
        die("Job not found.");
    }
} else {
    // If no job id is passed
    die("No job selected.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for Job</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h1 class="text-center">Apply for <?php echo htmlspecialchars($job['job_title']); ?></h1>
    
    <form action="submit_application.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="job_id" value="<?php echo $job['job_id']; ?>">
        
        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control" name="first_name" required>
        </div>

        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" class="form-control" name="last_name" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" required>
        </div>

        <div class="mb-3">
            <label for="resume" class="form-label">Resume (PDF or Word)</label>
            <input type="file" class="form-control" name="resume" accept=".pdf,.doc,.docx" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit Application</button>
    </form>

    <form action="send_message.php" method="POST">
        <input type="hidden" name="receiver_id" value="<?php echo $hr_user_id; ?>"> 
        <label for="subject">Subject:</label>
        <input type="text" name="subject" required>
        <br>
        <label for="message_text">Message:</label>
        <textarea name="message_text" required></textarea>
        <br>
        <button type="submit" name="send_message" class="btn btn-primary">Send Message</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
