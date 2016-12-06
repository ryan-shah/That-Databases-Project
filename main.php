<?php
session_start();
$conn = new mysqli('rash227.netlab.uky.edu', 'root', 'root','PROJECT');
if ( empty($_GET["user"]) ) {
	header("Location: ./");
        die();
}
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
<div class=container>
<div class=jumbotron>
<form class="form-horizontal" action="/search.php" method="get">
	<fieldset>
	<legend>What are you looking for?</legend>
	<div class="form-group">
		<label class="col-lg-2 control-label" for="search">Search</label>
		<div class="col-lg-10">
			<input class="form-control" id="search" type="text" name="search">
	</div></div>
<div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button type="submit" class="btn btn-default">Submit</button>
</div></div>
<?php
	echo "<input type=\"hidden\" name=\"user\" value=".$uname.">";
	echo "<input type=\"hidden\" name=\"pos\" value=".$pos.">";
?>
</fieldset>
</form>
</div></div>
<h2>Current inventory is:</h2>
<table class="table table-striped table-hover">
	<thead>
	<tr>
	<th>Item</th>
	<th>Quantity</th>
	<th>Cost</th>
	</tr>
	</thead>
	<tbody>
<?php
$q = "select mid, quantity, price, discount from merch where quantity>0;";
$result = $conn->query($q);
if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		echo "<tr>";
		echo "<td>".$row["mid"]."</td><td>".$row["quantity"]."</td><td>$".($row["price"] * (1-$row["discount"]))."</td></tr>";
	}
}
?>
</tbody>
</table>
</body>
</html>
