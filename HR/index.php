<?php 
require_once 'core/dbConfig.php'; 
require_once 'core/models.php'; 

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM messages WHERE receiver_id = ? ORDER BY date_sent DESC");
$stmt->execute([$_SESSION['user_id']]); 
$messages = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body class="container mt-5">
    <?php if (isset($_SESSION['message'])) { ?>
        <div class="alert alert-success text-center">
            <?php echo $_SESSION['message']; ?>
        </div>
    <?php } unset($_SESSION['message']); ?>

    <div class="text-center mb-4">
        <h1>Hello there! Welcome, <?php echo $_SESSION['username']; ?></h1>
        <a href="core/handleForms.php?logoutUserBtn=1" class="btn btn-danger">Logout</a>  
    </div>
    
    <!-- Job Post Form -->
    <div class="createJobPost mb-5">
        <h2>Create a Job Post</h2>
        <form action="core/handleJobPost.php" method="POST">
            <div class="mb-3">
                <label for="job_title" class="form-label">Job Title:</label>
                <input type="text" name="job_title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="job_description" class="form-label">Job Description:</label>
                <textarea name="job_description" class="form-control" required></textarea>
            </div>
            <button type="submit" name="create_job_post" class="btn btn-primary">Post Job</button>
        </form>
    </div>
    
    <!-- Job Posts Table -->
    <div class="jobPosts mb-5">
        <h2>Job Posts</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Job Description</th>
                    <th>Date Posted</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $pdo->query("SELECT * FROM job_posts");
                while ($job = $stmt->fetch()) {
                    $job_id = $job['job_id'];
                    $applicants_stmt = $pdo->prepare("SELECT * FROM applicants WHERE job_id = ?");
                    $applicants_stmt->execute([$job_id]);
                    $applicants = $applicants_stmt->fetchAll();
                ?>
                    <tr>
                        <td><?php echo $job['job_title']; ?></td>
                        <td><?php echo $job['job_description']; ?></td>
                        <td><?php echo $job['date_posted']; ?></td>
                        <td><?php echo $job['status']; ?></td>
                        <td>
                            <a href="core/deleteJobPost.php?job_id=<?php echo $job['job_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                    
                    <!-- Applicants for this Job -->
                    <?php if (!empty($applicants)) { ?>
                        <tr>
                            <td colspan="5">
                                <h4>Applicants:</h4>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Applicant Name</th>
                                            <th>Email</th>
                                            <th>Resume</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($applicants as $applicant) { ?>
                                            <tr>
                                                <td><?php echo $applicant['first_name'] . ' ' . $applicant['last_name']; ?></td>
                                                <td><?php echo $applicant['email']; ?></td>
                                                <td><a href="<?php echo $applicant['resume_url'];?>" target="_blank">View Resume</a></td>
                                                <td>
                                                    <!-- Accept Button -->
                                                    <a href="core/acceptApplicant.php?job_id=<?php echo $job['job_id']; ?>&applicant_id=<?php echo $applicant['applicant_id']; ?>" class="btn btn-success btn-sm">Accept</a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Teachers Table -->
    <div class="tableClass mb-5">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="searchInput" class="form-control" placeholder="Search here">
                <button type="submit" name="searchBtn" class="btn btn-secondary">Search</button>
            </div>
        </form>

        <p><a href="index.php">Clear Search Query</a></p>
        <p><a href="insert.php">Insert New Teacher</a></p>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Subject Specialty</th>
                    <th>Employment Status</th>
                    <th>Date Added</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!isset($_GET['searchBtn'])) { ?>
                    <?php $getAllUsers = getAllUsers($pdo); ?>
                    <?php foreach ($getAllUsers as $row) { ?>
                        <tr>
                            <td><?php echo $row['first_name']; ?></td>
                            <td><?php echo $row['last_name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['gender']; ?></td>
                            <td><?php echo $row['subject_specialty']; ?></td>
                            <td><?php echo $row['employ_status']; ?></td>
                            <td><?php echo $row['date_added']; ?></td>
                            <td>
                                <a href="edit.php?teacher_id=<?php echo $row['teacher_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="delete.php?teacher_id=<?php echo $row['teacher_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <?php $searchForAUser = searchForAUser($pdo, $_GET['searchInput']); ?>
                    <?php foreach ($searchForAUser as $row) { ?>
                        <tr>
                            <td><?php echo $row['first_name']; ?></td>
                            <td><?php echo $row['last_name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['gender']; ?></td>
                            <td><?php echo $row['subject_specialty']; ?></td>
                            <td><?php echo $row['employ_status']; ?></td>
                            <td><?php echo $row['date_added']; ?></td>
                            <td>
                                <a href="edit.php?teacher_id=<?php echo $row['teacher_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="delete.php?teacher_id=<?php echo $row['teacher_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Messages Table -->
    <div class="messages mb-5">
        <h2>Messages</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Sender</th>
                    <th>Subject</th>
                    <th>Date Sent</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($messages as $message) { ?>
                    <tr>
                        <td><?php echo getUserById($pdo, $message['sender_id'])['username']; ?></td>
                        <td><?php echo $message['subject']; ?></td>
                        <td><?php echo $message['date_sent']; ?></td>
                        <td><?php echo $message['status']; ?></td>
                        <td>
                            <a href="view_message.php?message_id=<?php echo $message['message_id']; ?>" class="btn btn-info btn-sm">View</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
