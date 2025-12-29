<?php
include '../db.php';
if(!isset($_SESSION['admin'])) die("Unauthorized");

$id = $_GET['id'];
$status = $_GET['s'];

$conn->query("UPDATE orders SET status='$status' WHERE id=$id");

header("Location: dashboard.php");
?>
