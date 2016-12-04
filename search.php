<?php
session_start();
$conn = new mysqli('rash227.netlab.uky.edu', 'root', 'root','PROJECT');
$uname = htmlspecialchars($_GET["user"]);
$pos = htmlspecialchars($_GET["pos"]);
$search = htmlspecialchars($_GET["search"]);
?>
<html>
<head>
<title>Search Results</title>
</head>
<body>

<?php
$conn = new mysqli('rash227.netlab.uky.edu', 'root', 'root','PROJECT');
$uname = htmlspecialchars($_GET["user"]);
$pos = htmlspecialchars($_GET["pos"]);
$search = htmlspecialchars($_GET["search"]);
$q = "select * from merch where mid =\"".$search."\";";
$result = $conn->query($q);
if($result->num_rows > 0) {
	$vals = $result->fetch_assoc();
        echo "<h3>".$search."</h3><br>";
        echo "price: ".$vals['price']."<br>";
        echo "quantity: ".$vals['quantity']."<br>";
	echo "discount: ".$vals['discount']."%<br>";
	echo "<form action=\"/cart.php\" method=\"get\">";
	echo "Desired amount: <input type=\"number\" name=\"amount\" min=1 max=".$vals['quantity']."><br>";
        echo "<input type=\"hidden\" name=\"item\" value=".$search.">";
	echo "<input type=\"hidden\" name=\"user\" value=".$uname.">";
        echo "<input type=\"hidden\" name=\"pos\" value=".$pos.">";
        echo "<input type=\"submit\" value=\"Purchase\">";
	echo "</form>";
} else {
	echo "Could not find your item.";
}
?>


</body>
</html>
