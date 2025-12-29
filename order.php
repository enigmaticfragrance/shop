<?php
$product = htmlspecialchars($_GET['product'] ?? 'Unknown Product');
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Order - <?= $product ?></title>

<style>
body{font-family:Arial;background:#f5f5f5}
.container{width:400px;margin:40px auto;background:#fff;padding:20px;border-radius:8px}
input,select,button{width:100%;padding:10px;margin:10px 0}
button{background:#000;color:#fff;border:none;cursor:pointer}
.price{font-size:18px;font-weight:bold}
</style>
</head>
<body>

<div class="container">
<h2><?= $product ?></h2>

<form action="order_submit.php" method="POST" enctype="multipart/form-data">

<input type="hidden" name="product" value="<?= $product ?>">

<label>Size</label>
<select name="size" id="size" onchange="priceChange()" required>
  <option value="">Select Size</option>
  <option value="6ml">6ml</option>
  <option value="15ml">15ml</option>
  <option value="30ml">30ml</option>
</select>

<p class="price">Price: ৳<span id="price">0</span></p>

<input type="text" name="name" placeholder="Your Name" required>
<input type="text" name="phone" placeholder="Mobile Number" required>
<input type="text" name="address" placeholder="Delivery Address" required>

<label>bKash / Nagad Payment Screenshot</label>
<input type="file" name="screenshot" accept="image/*" required>

<button type="submit">Confirm Order</button>

</form>
</div>

<script>
function priceChange(){
  let size=document.getElementById("size").value;
  let price=0;
  if(size==="6ml") price=200;
  if(size==="15ml") price=420;
  if(size==="30ml") price=800;
  document.getElementById("price").innerText=price;
}
</script>

</body>
</html>
