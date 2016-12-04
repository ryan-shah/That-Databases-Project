<html>

<?php
    error_reporting(E_ALL);
	ini_set('display_errors', 1);

?>

	<head>
		<?php
			session_start();
			$_SESSION['position'] = 'staff';
			$servername = "rash227.netlab.uky.edu";
			$username = "root";
			$password = $username;

			$conn = new mysqli($servername, $username, $password, 'PROJECT');
		?>
	</head>

	<body>
		<p>Sales from last...<br></p>
		<?php
			echo "<table>";
			echo "<th>Time</th>";
			echo "<th>Amount</th>";
			$query = 'SELECT SUM(totalPrice) FROM orders WHERE dateMade > (curdate() - INTERVAL 1 WEEK) AND status = "shipped"';
			$result = $conn->query($query);
			$result = $result->fetch_row();
			echo "<tr>";
			echo "<td>Week</td>";
			echo "<td>".$result[0]."</td>";
			$query = 'SELECT SUM(totalPrice) FROM orders WHERE dateMade > (curdate() - INTERVAL 1 MONTH) AND status = "shipped"';
			$result = $conn->query($query);
			$result = $result->fetch_row();
			echo "<tr>";
			echo "<td>Month</td>";
			echo "<td>".$result[0]."</td>";
			$query = 'SELECT SUM(totalPrice) FROM orders WHERE dateMade > (curdate() - INTERVAL 1 YEAR) AND status = "shipped"';
			$result = $conn->query($query);
			$result = $result->fetch_row();
			echo "<tr>";
			echo "<td>Year</td>";
			echo "<td>".$result[0]."</td>";
			$query = 'SELECT SUM(totalPrice) FROM orders WHERE status = "shipped"';
			$result = $conn->query($query);
			$result = $result->fetch_row();
			echo "<tr>";
			echo "<td>All Time</td>";
			echo "<td>".$result[0]."</td>";

			echo '</table>';
		?>
	</body>



</html>
