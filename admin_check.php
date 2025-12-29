<?php
include '../db.php';

$user = $_POST['username'];
$pass = md5($_POST['password']);

$q = $conn->query("SELECT * FROM admins WHERE username='$user' AND password='$pass'");

if($q->num_rows == 1){
  $_SESSION['admin'] = $user;
  header("Location: dashboard.php");
}else{
  echo "❌ Login Failed";
}
?>
