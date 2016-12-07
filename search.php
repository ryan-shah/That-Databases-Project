<?php
session_start();
$conn = new mysqli('rash227.netlab.uky.edu', 'root', 'root','PROJECT');
$uname = htmlspecialchars($_GET["user"]);
$pos = htmlspecialchars($_GET["pos"]);
$search = htmlspecialchars($_GET["search"]);
include "css.php";
?>
<html>
<head>
<title>Search Results</title>
<?php
scripts();
?>
</head>
<body>
<?php
navbarCust($uname,$pos);
?>
<div class="container">
<div class="jumbotron">
<?php
$q = "select * from merch where mid =\"".$search."\";";
$result = $conn->query($q);
if($result->num_rows > 0) {
	$vals = $result->fetch_assoc();
        echo "<h1>".$search."</h1>";
        echo "<h2>Normal Price: $".$vals['price']."</h2>";
        echo "<h2>Available: ".$vals['quantity']."</h2>";
	echo "<h2>Sale: ".$vals['discount']."%</h2>";
	echo "<h2>Current Price: $".($vals['price']-($vals['price']*$vals['discount']))."</h2>";
	echo "<form class=\"form-horizontal\" action=\"/cart.php\" method=\"get\">";
	echo "<fieldset>\n";
	echo "<div class=\"form-group\">";
	echo "<label for=amount class=\"col-lg-2 control-label\">Desired amount: </label>";
	echo "<div class=\"col-lg-2\">";
	echo "<input class=\"form-control\" type=\"number\" id=amount name=\"amount\" min=1 max=".$vals['quantity'].">";
        echo "</div>";
	echo "<input type=\"hidden\" name=\"item\" value=".$search.">";
	echo "<input type=\"hidden\" name=\"user\" value=".$uname.">";
        echo "<input type=\"hidden\" name=\"pos\" value=".$pos.">";
        echo "<button type=submit class=\"btn btn-primary\">Add to cart</button>";
	echo "</div></fieldset>";
	echo "</form>";
} else {
	echo "Could not find your item.";
}
?>

</div></div>
</body>
</html>
