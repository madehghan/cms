<?php
include 'controlls/db/functions.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $senderId = $_POST['senderId'];
    $message = $_POST['message'];
    $user2 = $_POST['user2'];

    // Database configuration
    $dbHost = "localhost";
    $dbName = "project177";
    $dbUser = "root";
    $dbPassword = "";

    try {
        // Create a new PDO instance
        $db = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4", $dbUser, $dbPassword);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insert the new message into the database
        $query = "INSERT INTO chat_messages (user1, profile_pic, message, created_at, user_name , user2)
                  VALUES (:user1, :profilePic, :message, '$current_time', :userName , :user2)";
        $stmt = $db->prepare($query);
        
            $stmt->bindValue(':user1', $my_profile_id);
            $stmt->bindValue(':profilePic', $my_profile_avatar);
            $stmt->bindValue(':userName', $my_profile_name);
            $stmt->bindValue(':user2', $senderId);
        
        $stmt->bindParam(':message', $message);
        $stmt->execute();

        echo "Message sent successfully!";
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
}
?>
