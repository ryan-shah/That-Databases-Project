<?php
session_start();
$conn = new mysqli('rash227.netlab.uky.edu', 'root', 'root','PROJECT');
$uname = htmlspecialchars($_GET["user"]);
$pos = htmlspecialchars($_GET["pos"]);
include "css.php";
?>
<html>

<head>
<title>Emazon.com</title>
<?php
scripts();
?>
</head>

<body>

<?php
navbarCust($uname,$pos);
?>
<form action="/search.php" method="get">
	<div>What are you looking for?</div>
	<input type="text" name="search"><br>
	<input type="submit" value="Submit">
<?php
	echo "<input type=\"hidden\" name=\"user\" value=".$uname.">";
	echo "<input type=\"hidden\" name=\"pos\" value=".$pos.">";
?>
</form>

<h2>Current inventory is:</h2>
<table border="1">
	<tr>
	<th>Item</th>
	<th>Quantity</th>
	<th>Cost</th>
	</tr>
<?php
$q = "select mid, quantity, price, discount from merch where quantity>0;";
$result = $conn->query($q);
if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		echo "<tr>";
		echo "<td>".$row["mid"]."</td><td>".$row["quantity"]."</td><td>".($row["price"] * (1-$row["discount"]))."</td></tr>";
	}
}
?>
</table>
</body>
</html>
