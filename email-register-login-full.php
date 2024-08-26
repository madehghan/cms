<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer autoloader
require 'vendor/autoload.php';

// Include database connection file if necessary
// require 'db_connection.php'; // Uncomment and modify if you have a database connection file

if (isset($_POST['get_email'])) {
    $email = $_POST['phone_number'];  // Email input field
    $password = rand(1000, 9999);

    // Validate email
    if (empty($email)) {
        $error_message = "لطفاً ایمیل خود را وارد کنید.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "ایمیل وارد شده معتبر نیست.";
    } else {
        $error_message = '';

        // Create a new PHPMailer instance
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'mail.dc248.com';                       // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'info@dc248.com';                   // SMTP username
            $mail->Password = 'Q(irIpC#.V[~';                     // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;      // Enable SSL encryption
            $mail->Port = 465;                                    // TCP port to connect to

            // Recipients
            $mail->setFrom('info@dc248.com', 'DgCollege verification');  // From address and name
            $mail->addAddress($email, 'DgCollege verification');         // Add the recipient's email

            // Content
            $mail->isHTML(true); // Set email format to HTML

            // HTML email body
            $mail->Body = <<<EOD
<div style="
direction:rtl;
font-size:14px;
font-family:tahoma;
">
<div style="text-align:center;height:100px;background:#71CA48"></div>
<br>
<center><img src="*" style="width:200px;"></center>
<br>
خوش آمدید! ورود به * با کد تأیید<br><br>

سلام!<br><br>

به * خوش آمدید! برای ورود به حساب کاربری خود، لطفاً کد زیر را وارد کنید:<br><br>

<h1>{$password}</h1>
<br><br>

از اینکه به ما پیوستید بسیار خوشحالیم و امیدواریم تجربه‌ای عالی داشته باشید.<br><br>

با احترام،<br>
تیم *
<br><br>
------------
<br><br>

Welcome! Access * with your Verification Code!<br><br>

Hi there!!<br><br>

Welcome to *! To access your account, please enter the following code :!<br><br>

<h1>{$password}</h1>

We are excited to have you with us and hope you have a great experience.!<br><br>

Best regards,!<br>
The * Team
EOD;

            // Send the email
            $mail->send();

            // Database operations
            try {
                // Database connection setup (make sure $conn is initialized)
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stat = $conn->prepare("SELECT * FROM users WHERE email = :email");
                $stat->bindParam(':email', $email);
                $stat->execute();

                $userme = $stat->fetch(PDO::FETCH_OBJ);

                if ($userme) {
                    $update = $conn->prepare("UPDATE users SET password = :password WHERE email = :email");
                    $update->bindParam(':password', md5($password));
                    $update->bindParam(':email', $email);
                    $update->execute();
                    
                    $_SESSION['email_old_user']=[
                        'email'=>$email,
                    ];
                    header('Location: verify-email.php');
                } else {
                    $rejister_form = $conn->prepare("INSERT INTO users (email,password) VALUES (:email, :password)");
                    $rejister_form->execute([
                        'email' => $email,
                        'password' => md5($password),
                    ]);
                    
                    $_SESSION['email_old_user']=[
                        'email'=>$email,
                    ];
                    
                    header('Location: verify-email.php?newuser=1');
                    
                }
            } catch (PDOException $e) {
                $error_message = "خطا در پایگاه داده: " . $e->getMessage();
            }
        } catch (Exception $e) {
            $error_message = "پیام نتوانست ارسال شود. خطای Mailer: {$mail->ErrorInfo}";
        }
    }
}
?>
