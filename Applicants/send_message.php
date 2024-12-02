<?php
session_start();

require_once 'core/dbConfig.php'; 

if (!isset($_SESSION['user_id'])) {
    die('User is not logged in.');
}

if (isset($_POST['send_message'])) {
    $sender_id = $_SESSION['user_id']; 
    $receiver_id = 1; 
    $subject = $_POST['subject'];
    $message_text = $_POST['message_text'];

    $stmt = $pdo->prepare("INSERT INTO messages (sender_id, receiver_id, subject, message_text, status) 
                           VALUES (?, ?, ?, ?, 'unread')");
    $stmt->execute([$sender_id, $receiver_id, $subject, $message_text]);

    $_SESSION['message'] = 'Your message has been sent!';

    header("Location: index.php");
    exit();
}
?>
