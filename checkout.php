<html>
<head>
<title>Checkout</title>
<body>

<?php
session_start();
$conn = new mysqli('rash227.netlab.uky.edu', 'root', 'root','PROJECT');
$uname = $_SESSION['username'];
$q = "select oid, mid, quantity from orders where cid=\"".$uname."\" and status=\"incart\";";
$result = $conn->query($q);
while ($row = $result->fetch_assoc()) {
	$q = "select quantity from merch where mid=\"".$row["mid"]."\";";
	echo $q."<br>";
	$buff = $conn->query($q);
	$buff2 = $buff->fetch_assoc();
	$quant = $buff2["quantity"];
	if ( $quant >= $row["quantity"] ) {
		$q = "update merch set quantity=quantity-".$row["quantity"]." where mid=\"".$row["mid"]."\";";
		echo $q."<br>";
		$conn->query($q);
		$q = "update orders set status=\"pending\" where oid=\"".$row["oid"]."\";";
		echo $q."<br>";
		$conn->query($q);
	} else {
		echo "there was an error with order #".$row["oid"].". It has not been removed from your cart.";
	}
}
?>
<h1>checkout complete</h1>
<?php
	echo "<a href=/main.php>Return to the main page</a>";
?>
</body>
</html>
