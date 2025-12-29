<?php
session_start();
$conn = new mysqli("localhost","root","","enigmatic");

$product = $_POST['product'];
$size = $_POST['size'];
$price = $_POST['price'];
$delivery = $_POST['delivery'];
$total = $_POST['total'];
$user = $_SESSION['user'];

$screenshot = $_FILES['screenshot']['name'];
$tmp = $_FILES['screenshot']['tmp_name'];

move_uploaded_file($tmp,"uploads/".$screenshot);

$conn->query("INSERT INTO orders VALUES(
NULL,'$user','$product','$size','$price','$delivery','$total','$screenshot',NOW()
)");

mail(
  "enigmatic.fragrance@gmail.com",
  "New Order Received",
  "Product: $product\nSize: $size\nTotal: ৳$total\nCustomer: $user"
);

echo "Order Placed Successfully";
?>
