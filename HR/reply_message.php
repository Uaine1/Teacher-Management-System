<?php
require_once 'core/handleForms.php'; 

if (isset($_POST['send_reply'])) {
    $sender_id = $_POST['sender_id'];
    $receiver_id = $_POST['receiver_id'];
    $message_text = $_POST['message_text'];
    $original_message_id = $_POST['original_message_id'];

    $stmt = $pdo->prepare("INSERT INTO messages (sender_id, receiver_id, message_text, subject, status) 
                           SELECT ?, ?, ?, CONCAT('Re: ', subject), 'unread' 
                           FROM messages WHERE message_id = ?");
    $stmt->execute([$sender_id, $receiver_id, $message_text, $original_message_id]);

    $_SESSION['message'] = 'Your reply has been sent!';
    header("Location: view_message.php?message_id=" . $original_message_id);
    exit();
}
?>