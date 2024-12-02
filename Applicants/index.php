<?php
require_once 'core/dbConfig.php';  

$stmt = $pdo->query("SELECT * FROM job_posts WHERE status = 'Open'");
$job_posts = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicants Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h1 class="text-center">Available Job Posts</h1>
    
    <div class="row">
        <?php foreach ($job_posts as $job) { ?>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($job['job_title']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($job['job_description']); ?></p>
                        <a href="apply.php?job_id=<?php echo $job['job_id']; ?>" class="btn btn-primary">Apply Now</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

   



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
