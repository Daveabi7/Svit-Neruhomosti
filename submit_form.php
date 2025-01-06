<?php
// Перевірка, чи надійшли дані через POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Отримання даних з форми
    $name = htmlspecialchars(trim($_POST['name']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Перевірка заповненості полів
    if (empty($name) || empty($phone) || empty($email) || empty($message)) {
        echo "Будь ласка, заповніть усі поля.";
        exit;
    }

    // Формування листа
    $to = "baskoills@gmail.com"; // Змініть на потрібний email
    $subject = "Нове повідомлення з форми зворотного зв'язку";
    $body = "Ім'я: $name\nТелефон: $phone\nEmail: $email\nПовідомлення:\n$message";
    $headers = "From: $email";

    // Надсилання листа
    if (mail($to, $subject, $body, $headers)) {
        echo "Дякуємо! Ваше повідомлення надіслано.";
    } else {
        echo "Виникла помилка під час відправки. Спробуйте пізніше.";
    }
} else {
    echo "Неправильний метод запиту.";
}
?>