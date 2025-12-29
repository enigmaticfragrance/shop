<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$conn = new mysqli("localhost","root","","orders_db");
if ($conn->connect_error) {
    die("Database connection failed");
}

if (!isset($_FILES['screenshot'])) {
    die("Screenshot required");
}

/* Screenshot Upload */
$imgName = time() . '_' . basename($_FILES['screenshot']['name']);
$target = "uploads/" . $imgName;

if (!move_uploaded_file($_FILES['screenshot']['tmp_name'], $target)) {
    die("Upload failed");
}

/* Save Order */
$stmt = $conn->prepare("
INSERT INTO orders 
(product, size, price, name, phone, address, screenshot, status) 
VALUES (?, ?, ?, ?, ?, ?, ?, 'Pending')
");

$stmt->bind_param(
    "ssissss",
    $_POST['product'],
    $_POST['size'],
    $_POST['price'],
    $_POST['name'],
    $_POST['phone'],
    $_POST['address'],
    $imgName
);

$stmt->execute();

/* SEND EMAIL */
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'enigmatic.fragrance@gmail.com';
    $mail->Password   = 'jvjd hozz hdie thii';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom('enigmatic.fragrance@gmail.com', 'Enigmatic Fragrance');
    $mail->addAddress('enigmatic.fragrance@gmail.com');

    $mail->isHTML(true);
    $mail->Subject = '🛒 New Order Received';

    $mail->Body = "
        <h2>New Order</h2>
        <p><b>Product:</b> {$_POST['product']}</p>
        <p><b>Size:</b> {$_POST['size']}</p>
        <p><b>Price:</b> ৳{$_POST['price']}</p>
        <p><b>Name:</b> {$_POST['name']}</p>
        <p><b>Phone:</b> {$_POST['phone']}</p>
        <p><b>Address:</b> {$_POST['address']}</p>
        <p><b>Payment Screenshot:</b></p>
        <img src='http://yourdomain.com/uploads/$imgName' width='200'>
    ";

    $mail->send();
} catch (Exception $e) {
    // Mail fail হলেও order save থাকবে
}

echo "<h2>✅ Order Confirmed! We will contact you soon.</h2>";
?>
