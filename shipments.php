<!DOCTYPE html>

<html>

	<head>
		<?php
			$servername = "rash227.netlab.uky.edu";
			$username = "root";
			$password = $username;

			$conn = new mysqli($servername, $username, $password, 'PROJECT');
		?>		
		
		<title>Shipments</title>

		<style type="text/css">

			div.user_info {
				position: absolute;
				top: 0px;
				right: 10px;
				width: 100px;

				text-align: right;
				font-size: 11pt;
			}

			div.pending_shipments {
				position: absolute;
				top: 10%;
				left: 5%;
				
				font-size: 65pt;
				font-family: Verdana, sans-serif;
			}

			div.shipments_table {
				position: absolute;
				top: 15%;
				left: 5%;
			}

		</style>

	</head>

	<body>

		<?php 
			if(!empty($_POST)){ 
				$query = "SELECT mid, quantity, totalPrice FROM orders WHERE status = 'pending'";
				$result = $conn->query($query);

				$stock_query = "SELECT mid, quantity FROM merch WHERE merch.mid IN orders";
				$stock_result = $conn->query($stock_query);

				while($row = $result->fetch_assoc()){
					$item = $stock_result->fetch_assoc();
					if($item["quantity"] > $row["quantity"]){
						$update_query = "UPDATE merch SET quantity = ". $item["quantity"] - $row["quantity"] ."WHERE merch.mid=\"". $item["mid"]."\"; UPDATE orders SET status = 'shipped' WHERE status = 'pending'";
						$update_result = $conn->query($update_query);
					}
				}
				echo "<p>Orders shipped.</p>";
			} else {
		?>

		<div class="pending_shipments">Pending Shipments</div>

		<div class="shipments_table">
		<br><br><br>
			<?php
				$query = "SELECT mid, quantity, totalPrice FROM orders";
				$result = $conn->query($query);
				$attributes = array('mid','quantity','totalPrice');

				echo "<form method=\"POST\">";
				echo "<input type=\"submit\" value=\"Ship\" name=\"Ship_Order\">";
				echo "</form>";
				echo "<table style=\"border: 1px solid black; border-spacing: 5px\"";
				echo "<tr>";

				foreach($attributes as $heading) {
					echo "<th>" . $heading . "</th>";
				}
				echo "</tr>";

				while($row = $result->fetch_assoc()){

					echo "<tr>";
					echo "<td>" . $row['mid'] . "</td>";
					echo "<td>" . $row['quantity'] . "</td>";
					echo "<td>" . $row['totalPrice'] . "</td>";
					echo "</tr>";
				}

				echo "</table>";
				mysqli_free_result($result);
	
			?>
		</div>

		<?php } ?>

		<div class="user_info">
			Hello, user<br>
			<a href="./inventory.php">Inventory</a><br>
			<a href="./index.html">Logout</a>
		</div>

	</body>

</html>
