<!DOCTYPE html>

<html>

	<head>

		<?php
			$servername = "rash227.netlab.uky.edu";
			$username = "root";
			$password = $username;

			$conn = new mysqli($servername, $username, $password, 'PROJECT');

		?>

		<title>Inventory</title>

		<style type="text/css">

			div.user_info {
				position: absolute;
				top: 0px;
				right: 10px;
				width: 100px;

				text-align: right;
				font-size: 11pt;
			}

<!-			div.inventory {
				position: absolute;
				top: 10%;
				left: 5%;
				
				font-size: 65pt;
				font-family: Verdana, sans-serif;
			}

			div.inventory_table {
				position: absolute;
				top: 15%;
				left: 5%;
			}
-!>
		</style>

	</head>

	<body>
		<?php
	
			if(isset($_POST["item"])){
				echo $_POST["item"]."<br>".$_POST["qty"]."<br>";
				$query = "UPDATE merch SET quantity = ".$_POST["qty"]." WHERE mid = '".$_POST['item']."'";
				$resp = $conn->query($query);

				$query = "UPDATE merch SET price = ".$_POST["price"]." WHERE mid = '".$_POST['item']."'";
				$resp = $conn->query($query);

				echo "<p>Updated item entry.</p>";
			}

			else {

		?>

		<form method="POST">

			<?php
				$query = "SELECT mid, quantity FROM merch";
				$resp = $conn->query($query);

				echo "<table>";
				while($row = $resp->fetch_assoc()){
					echo "<tr>";
					echo "<td>" . $row['mid'] . "</td>";
					echo "<td>" . $row['quantity'] . "</td>";
					echo "</tr>";
				}

				echo "</table>";
				mysqli_free_result($result);
	
			?>

			<div class="inventory">Inventory</div>
			<input type="text" name="item" value="Item">
			<input type="number" name="qty" value = "Quantity">
			<input type="number" name="price" value = "Price">
			<input type="submit" method="POST" value="Submit">
		</form>
		<?php } ?>

		<div class="user_info">
			Hello, user<br>
			<a href="./shipments.php">Shipments</a><br>
			<a href="./index.html">Logout</a>
		</div>

	</body>

</html>
