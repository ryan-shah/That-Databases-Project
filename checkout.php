<html>
<head>
<title>Checkout</title>
<?php
include "css.php";
scripts();
?>
<body>

<?php

session_start();
$conn = new mysqli('rash227.netlab.uky.edu', 'root', 'root','PROJECT');
$uname = $_SESSION['username'];
$pos = $_SESSION['position'];
navbarCust($uname,$pos);
$q = "select oid, mid, quantity from orders where cid=\"".$uname."\" and status=\"incart\";";
$result = $conn->query($q);
while ($row = $result->fetch_assoc()) {
	$q = "select quantity from merch where mid=\"".$row["mid"]."\";";
//	echo $q."<br>";
	$buff = $conn->query($q);
	$buff2 = $buff->fetch_assoc();
	$quant = $buff2["quantity"];
	if ( $quant >= $row["quantity"] ) {
		$q = "update merch set quantity=quantity-".$row["quantity"]." where mid=\"".$row["mid"]."\";";
//		echo $q."<br>";
		$conn->query($q);
		$q = "update orders set status=\"pending\" where oid=\"".$row["oid"]."\";";
//		echo $q."<br>";
		$conn->query($q);
	} else {
?>
		<div class="col-lg-10">
		<div class="alert alert-dismissable alert-danger">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>Uh Oh!</strong>
<?php
		echo "There was an error with order #".$row["oid"].". It has not been removed from your cart.<br>";
		echo "You may have tried to order an out of stock item."
?>
		</div></div>
<?php
	}
}
?>
<div class="col-lg-10">
<h1>Checkout Complete</h1>
</div>
<?php
?>
</body>
</html>
