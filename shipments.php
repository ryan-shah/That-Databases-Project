<!DOCTYPE html>
<?php
     error_reporting(E_ALL);
	      ini_set('display_errors', 1);

		  ?>
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
			if(isset($_GET['Ship_Order'])){ 
				$query = "SELECT mid, quantity, totalPrice FROM orders WHERE status = 'pending';";
				$result = $conn->query($query);
				

				while($row = $result->fetch_assoc()){

					$stock_query = "SELECT quantity FROM merch WHERE mid = '".$row["mid"]."'";	
					$stock_result = $conn->query($stock_query);
					$item = $stock_result->fetch_assoc();
					echo $row["quantity"] . " and " . $item["quantity"] . "<br>";
					if($item["quantity"] > $row["quantity"]){
						$new_quantity = $item["quantity"] - $row["quantity"];
						$update_query = "UPDATE merch SET quantity = ". $new_quantity ." WHERE mid='". $row["mid"]."'";
						$update_result = $conn->query($update_query);
						$update_query = "UPDATE orders SET status = 'shipped' WHERE mid='". $row["mid"]."'";
						$update_result = $conn->query($update_query);
					}
				}
				echo "<p>Orders shipped.</p><br>";
				echo "<a href=\"./shipments.php\"> Back to shipments </a>";
			} else {
		?>

		<div class="pending_shipments">Pending Shipments</div>

		<div class="shipments_table">
		<br><br><br>
			<?php
				$query = "SELECT mid, quantity, totalPrice FROM orders WHERE status = 'pending'";
				$result = $conn->query($query);
				$attributes = array('mid','quantity','totalPrice');

				echo "<form action=\"./shipments.php\" method=\"GET\">";
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
