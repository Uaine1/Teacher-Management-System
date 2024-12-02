<?php
require_once 'core/handleForms.php'; 

if (isset($_GET['message_id'])) {
    $message_id = $_GET['message_id'];

    $stmt = $pdo->prepare("SELECT * FROM messages WHERE message_id = ?");
    $stmt->execute([$message_id]);
    $message = $stmt->fetch();

    $pdo->prepare("UPDATE messages SET status = 'read' WHERE message_id = ?")->execute([$message_id]);
}
?>

<h3>Message from: <?php echo getUserById($pdo, $message['sender_id'])['username']; ?></h3>
<p><strong>Subject:</strong> <?php echo $message['subject']; ?></p>
<p><strong>Message:</strong> <?php echo $message['message_text']; ?></p>

<form action="reply_message.php" method="POST">
    <textarea name="message_text" placeholder="Your reply here..." required></textarea>
    <input type="hidden" name="sender_id" value="<?php echo $_SESSION['user_id']; ?>">
    <input type="hidden" name="receiver_id" value="<?php echo $message['sender_id']; ?>">
    <input type="hidden" name="original_message_id" value="<?php echo $message['message_id']; ?>">
    <button type="submit" name="send_reply" class="btn btn-primary">Send Reply</button>
</form>
