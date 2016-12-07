<!DOCTYPE html>

<html>

	<head>

		<?php
			session_start();
//			$_SESSION['position']='staff';
			$servername = "rash227.netlab.uky.edu";
			$username = "root";
			$password = $username;
			include "css.php";
			scripts();
			$conn = new mysqli($servername, $username, $password, 'PROJECT');

		?>

		<title>Inventory</title>

	</head>

	<body>
		<?php 
			navbarStaff();
			if($_SESSION["position"] != "staff" and $_SESSION["position"] != "manager"){
?>
<div class="alert alert-danger" role="alert">
  <strong>STAFF ACCESS ONLY</strong>
</div>

<?php

			} else {
		?>

		<?php
	
			if(isset($_POST["item"]) and isset($_POST["qty"]) and isset($_POST["price"])){
				echo "<div class=container><div class=jumbotron>";
				$query = "SELECT mid FROM merch WHERE mid = '" . $_POST["item"] . "'" ;
				$resp = $conn->query($query);
				if($resp->num_rows != 0){
					$query = "UPDATE merch SET quantity =" . $_POST["qty"] . ", price = ".$_POST["price"]. " WHERE mid = '".$_POST["item"]."'";
					$conn->query($query);
					echo "<h2>Updated item entry.</h2>";
				}
				else {
					$query = "INSERT INTO merch (mid, quantity, price, discount) VALUES ('". $_POST["item"]. "'," . $_POST["qty"]. ",".$_POST["price"].", 0)";
					$conn->query($query);
					echo "<h2>Added item.</h2>";
				}
				echo "</div></div>";
			}

			else {

		?>
		<div class=container><div class=jumbotron>
		<form class="form form-horizontal" method="POST">
			<legend>Add/Update Inventory</legend>
			<div class="form-group">
				<label for=item class="col-lg-2 control-label">Item</label>
				<div class="col-lg-10">
				<input type="text" class="form-control" id=item name="item" placeholder="Item">
			</div></div>
			<div class="form-group">
				<label for="qty" class="col-lg-2 control-label">Quantity</label>
				<div class="col-lg-10">
				<input type="number" name="qty" class="form-control" id=qty placeholder="10">
			</div></div>
			<div class="form-group">
                                <label for="price" class="col-lg-2 control-label">Price</label>
                                <div class="col-lg-10">
				<input type="number" id=price name="price" step="0.01" class="form-control" placeholder="5.00">
			</div></div>
			<input class="btn btn-primary"  type="submit" method="POST" value="Submit">
		</form>
		</div></div>
<h3>Current Inventory</h3>
			<?php
				$query = "SELECT mid, quantity, price FROM merch";
				$resp = $conn->query($query);
			?>
				<table class="table table-striped table-hover ">
				<thead><tr>
				<th>Item</th>
				<th>Quantity</th>
				<th>Price</th>
				</tr></thead><tbody>
			<?php
				while($row = $resp->fetch_assoc()){
					if($row['quantity'] == 0) {
						echo "<tr class=warning>";
					} else {
						echo "<tr>";
					}
					echo "<td>" . $row['mid'] . "</td>";
					echo "<td>" . $row['quantity'] . "</td>";
					echo "<td>$" . $row['price'] . "</td>";
					echo "</tr>";
				}

				echo "</tbody></table>";
			}

		}
?>	</body>

</html>
