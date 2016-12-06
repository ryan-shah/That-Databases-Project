<!DOCTYPE html>
<?php
include "css.php";
    error_reporting(E_ALL);
	ini_set('display_errors', 1);

?>
<html>

	<head>
		<?php
			scripts();
			session_start();
//			$_SESSION['position'] = 'staff';
			$servername = "rash227.netlab.uky.edu";
			$username = "root";
			$password = $username;

			$conn = new mysqli($servername, $username, $password, 'PROJECT');
		?>

		<title>Shipments</title>
	</head>

	<body>
		<?php 
		navbarStaff();
		if($_SESSION["position"] != "staff" and $_SESSION["position"] != "manager"){
				echo "Never should have come here!";
			} else {
		?>

		<?php 
			if(isset($_POST['Ship_Order'])){ 
				$things_to_ship = "";
				foreach($_POST as $i){
					$things_to_ship .= " oid = '".$i."' OR ";
				}
				$things_to_ship .= '0';

				$query = "SELECT oid, mid, quantity, totalPrice FROM orders WHERE status = 'pending' AND (".$things_to_ship.");";
				$result = $conn->query($query);

				while($row = $result->fetch_assoc()){
					$update_query = "UPDATE orders SET status = 'shipped' WHERE oid='". $row["oid"]."'";
					$update_result = $conn->query($update_query);
				}
				echo "<div class=container><div class=jumbotron><h2>Orders shipped successfully.</h2></div></div>";
			} else {
		?>
		<div class="container">
		<div class="jumbotron">
			<h1>Pending Shipments</h1>
		</div>
		</div>
		<div class="container">
		<br><br><br>
			<?php
				$query = "SELECT oid, mid, quantity, cid, totalPrice FROM orders WHERE status = 'pending'";
				$result = $conn->query($query);
				$attributes = array('mid','quantity', 'cid','totalPrice');

				echo "<form action=\"./shipments.php\" method=\"POST\">";
				echo "<table class=\"table table-striped table-hover\">";
				echo "<thead>";
				echo "<tr>";

				foreach($attributes as $heading) {
					echo "<th>" . $heading . "</th>";
				}
				echo "<th> Ship?</th>\n";
				echo "</tr>\n</thead>\n<tbody>";

				while($row = $result->fetch_assoc()){
					echo "<div class=\"form-group\">";
					echo "<tr>";
					echo "<td>" . $row['mid'] . "</td>";
					echo "<td>" . $row['quantity'] . "</td>";
					echo "<td>" . $row['cid'] . "</td>";
					echo "<td>" . $row['totalPrice'] . "</td>";
					echo "<td> <input type='checkbox' name='".$row['oid']."' value='".$row['oid']."'></td>";
					echo "</tr>";
					echo "</div>";
				}

				echo "</tbody></table>";
				echo "<input type=\"submit\" class=\"btn btn-primary\" value=\"Ship Selected\" name=\"Ship_Order\">";
				echo "</form>";
				mysqli_free_result($result);
	
			?>
		</div>

		<?php } ?>
	</body>
	<?php } ?>
</html>
