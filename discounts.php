<html>

	<head>
		<?php
			session_start();
//			$_SESSION['position']='manager';
			$servername = "rash227.netlab.uky.edu";
			$username = "root";
			$password = $username;
			$conn = new mysqli($servername, $username, $password, 'PROJECT');

		?>

		<title>Discounts</title>

	</head>

	<?php
		if($_SESSION['position'] === 'manager'){
			if(!isset($_POST['item']) && !isset($_POST['discount'])){
	?>
	<body>
		<?php
			$query = "SELECT mid, price, discount FROM merch";
			$result = $conn->query($query);
			echo "<table>";
			echo "<th>Item</th>";
			echo "<th>Price</th>";
			echo "<th>Discount</th>";
			echo "<th>New Price</th>";
			while($row = $result->fetch_assoc()){
				echo "<tr>";
				echo "<td>".$row['mid']."</td>";
				echo "<td>".$row['price']."</td>";
				echo "<td>".$row['discount']."</td>";
				echo "<td>".($row['price']*(1 - $row['discount']))."</td>";
				echo "</tr>";
			}
		?>

		<form method="POST">
			<input type='text' name='item'>
			<input type='number' step='any' min=0 max=1  name='discount'>
			<input type='submit' method='POST'>
		</form>

	</body>

	<?php	} else {
				$query = "UPDATE merch SET discount = ".$_POST['discount']." WHERE mid='".$_POST['item']."'";
				echo $query;
				$result = $conn->query($query);
				echo "Discount updated.";
				echo "<a href=./discounts.php>Back to discount page</a>";
			  }
		}	
		else{ echo "You shouldn't be here."; }
	?>

</html>
