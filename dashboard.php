<?php
include '../db.php';
if(!isset($_SESSION['admin'])) header("Location: login.php");

$orders = $conn->query("SELECT * FROM orders ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Panel</title>
</head>
<body>

<h2>🛒 Orders</h2>
<a href="logout.php">Logout</a><br><br>

<table border="1" cellpadding="10">
<tr>
<th>ID</th>
<th>Product</th>
<th>Size</th>
<th>Price</th>
<th>Customer</th>
<th>Phone</th>
<th>Screenshot</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php while($o = $orders->fetch_assoc()){ ?>
<tr>
<td><?= $o['id'] ?></td>
<td><?= $o['product'] ?></td>
<td><?= $o['size'] ?></td>
<td>৳<?= $o['price'] ?></td>
<td><?= $o['name'] ?></td>
<td><?= $o['phone'] ?></td>

<td>
<a href="../uploads/<?= $o['screenshot'] ?>" target="_blank">View</a>
</td>

<td><?= $o['status'] ?></td>

<td>
<?php if($o['status']=="Pending"){ ?>
<a href="approve.php?id=<?= $o['id'] ?>&s=Approved">✅ Approve</a> |
<a href="approve.php?id=<?= $o['id'] ?>&s=Rejected">❌ Reject</a>
<?php } ?>
</td>
</tr>
<?php } ?>

</table>

</body>
</html>
