<html>
<head>
<title>Cart</title>
</head>
<body>
<?php
//insert into orders values (uuid(), 'test', 'apples', 'incart', CURDATE(), 3, 2);
$conn = new mysqli('rash227.netlab.uky.edu', 'root', 'root','PROJECT');
$uname = htmlspecialchars($_POST["user"]);
$pos = htmlspecialchars($_POST["pos"]);
if (isset($_GET["item"])) {
	$item = htmlspecialchars($_POST["item"]);
	$amount = htmlspecialchars($_POST["amount"]);
	$q = "select price, discount from merch where mid=\"".$item."\";";
	//echo $q."<br>";
	$result = $conn->query($q);
	$row = $result->fetch_assoc();
	$tprice = ( $row["price"] - ( $row["price"] * $row["discount"] ) ) * $amount;
	$q = "insert into orders values (uuid(), \"".$uname."\", \"".$item."\", \"incart\", CURDATE(), ".$tprice.", ".$amount.");";
	//echo $q;
	$result = $conn->query($q);
	//echo "done";
}
?>
Your cart: <br>
<table border=1>
<tr>
	<th>item</th>
	<th>quantity</th>
	<th>price</th>
</tr>
<?php
	$total = 0;
	$q = "select mid, quantity, totalPrice from orders where cid=\"".$uname."\" and status=\"incart\";";
	$result = $conn->query($q);
	while ( $row = $result->fetch_assoc() ) {
		echo "<tr>";
		echo "<td>".$row["mid"]."</td>";
		echo "<td>".$row["quantity"]."</td>";
		echo "<td>".$row["totalPrice"]."</td>";
		echo "</tr>";
		$total = $total + $row["totalPrice"];
	}
	echo "</table>";
	echo "your total = $".$total;
?>
<form method=POST action=checkout.php>
	<?php
		echo "<input type=hidden name=user value=".$uname.">";
		echo "<a href='./main.php'>Back to main page</a>"
	?>
	<input type=submit value=Checkout>
</form>
</body>
</html>
