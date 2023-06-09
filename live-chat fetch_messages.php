
<?php
// Database configuration
include 'controlls/db/functions.php';
$dbHost = "localhost";
    $dbName = "project177";
    $dbUser = "root";
    $dbPassword = "";
    
    $variable = $_GET['variable'];

try {
    // Create a new PDO instance
    $db = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4", $dbUser, $dbPassword);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Fetch chat messages from the database
    $query = "SELECT *
FROM chat_messages
WHERE (user1 = $my_profile_id AND user2 = $variable)
   OR (user2 = $my_profile_id AND user1 = $variable) order by id desc";
    $stmt = $db->query($query);
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Display the chat messages
    foreach ($messages as $message) {
        $senderClass = ($message['user1'] === $my_profile_id) ? 'sender' : 'receiver';
        $receiverClass = ($senderClass === !$my_profile_id) ? 'receiver' : 'sender';

        echo '<div class="message ' . $senderClass . '">';
        echo '<img class="profile-picture" src="' . $message['profile_pic'] . '">';
        echo '<div class="message-bubble">';
        echo '<span>' . $message['message'] . '</span>';
        echo '<div class="time-place">';
        echo '<span>' . $message['created_at'] . '</span> | <span>' . $message['user_name'] . '</span>';
        echo '</div></div></div>';
    }
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
