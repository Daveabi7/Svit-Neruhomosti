<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['messageperson']));

    $mail = new PHPMailer(true);

    try {
        // Налаштування SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Змініть на ваш SMTP-сервер
        $mail->SMTPAuth = true;
        $mail->Username = 'baskoills@gmail.com'; // Ваш email
        $mail->Password = 'gcio gmvo upnr ovse'; // Ваш пароль
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->CharSet = 'UTF-8';

        // Налаштування листа
        $mail->setFrom('baskoills@gmail.com', 'Світ нерухомості');
        $mail->addAddress('baskoills@gmail.com'); // Куди відправляти

        $mail->isHTML(true);
        $mail->Subject = "Новий запит із сайту";
        $mail->Body = "
            <h1>Новий запит:</h1>
            <p><strong>Ім'я:</strong> $name</p>
            <p><strong>Телефон:</strong> $phone</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Повідомлення:</strong> $message</p>
        ";

        $mail->send();
        echo json_encode(["status" => "success", "message" => "Повідомлення відправлено!"]);
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => "Не вдалося відправити повідомлення. Помилка: {$mail->ErrorInfo}"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Невірний запит."]);
}
?>