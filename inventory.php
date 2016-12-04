<!DOCTYPE html>

<html>

	<head>

		<?php
			session_start();
//			$_SESSION['position']='staff';
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
		<?php if($_SESSION["position"] != "staff" and $_SESSION["position"] != "manager"){
				echo "Never should have come here!";
			} else {
		?>

		<?php
	
			if(isset($_POST["item"]) and isset($_POST["qty"]) and isset($_POST["price"])){
				echo $_POST["item"]."<br>".$_POST["qty"]."<br>";

				$query = "SELECT mid FROM merch WHERE mid = '" . $_POST["item"] . "'" ;
				$resp = $conn->query($query);
				echo $resp->num_rows;
				if($resp->num_rows != 0){
					$query = "UPDATE merch SET quantity =" . $_POST["qty"] . ", price = ".$_POST["price"]. " WHERE mid = '".$_POST["item"]."'";
					$conn->query($query);
					echo "<p>Updated item entry.</p>";
				}
				else {
					$query = "INSERT INTO merch (mid, quantity, price) VALUES ('". $_POST["item"]. "'," . $_POST["qty"]. ",".$_POST["price"].")";
					$conn->query($query);
					echo "<p>Added item.</p>";
				}
					echo "<a href = './inventory.php'>Back to inventory.</a>";
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
	
			?>

			<div class="inventory">Inventory</div>
			<input type="text" name="item" value="Item">
			<input type="number" name="qty" value = "Quantity">
			<input type="number" name="price" value = "Price">
			<input type="submit" method="POST" value="Submit">
		</form>
		<?php } ?>

		<div class="user_info">
			Hello, <?php echo $_SESSION['username']?><br>
			<a href="./index.html">Logout</a>
			<?php
			if($_SESSION["position"] === "staff" or $_SESSION["position"] === "manager") {
			echo "<a href='./shipments.php'>Shipments</a><br>";
			}
			?>
		</div>
	<?php } ?>
	</body>

</html>
