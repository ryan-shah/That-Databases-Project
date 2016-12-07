<html>

<?php
	include "css.php";
    error_reporting(E_ALL);
	ini_set('display_errors', 1);

?>

	<head>
		<?php
			session_start();
			$servername = "rash227.netlab.uky.edu";
			$username = "root";
			$password = $username;
			$conn = new mysqli($servername, $username, $password, 'PROJECT');
			scripts();
		?>
	</head>

	<body>
		<?php navbarStaff(); ?>
		<div class=container><div class=jumbotron>
		<h1>Sales from the last...</h1>
		<?php
			if($_SESSION['position'] === 'manager'){
				echo "<table class=\"table table-striped table-hover\"><thead>";
				echo "<th>Time</th>";
				echo "<th>Amount</th></thead><tbody>";
				
				echo "<tr>";
				echo "<td>Day</td>";
				$query = 'SELECT SUM(totalPrice) FROM orders WHERE dateMade=curdate() AND status = "shipped"';
				$result = $conn->query($query);
				$result = $result->fetch_row();
				echo "<td>$".$result[0]."</td></tr>";
				
				$query = 'SELECT SUM(totalPrice) FROM orders WHERE dateMade > (curdate() - INTERVAL 1 WEEK) AND status = "shipped"';
				$result = $conn->query($query);
				$result = $result->fetch_row();
				echo "<tr>";
				echo "<td>Week</td>";
				echo "<td>$".$result[0]."</td>";
				$query = 'SELECT SUM(totalPrice) FROM orders WHERE dateMade > (curdate() - INTERVAL 1 MONTH) AND status = "shipped"';
				$result = $conn->query($query);
				$result = $result->fetch_row();
				echo "<tr>";
				echo "<td>Month</td>";
				echo "<td>$".$result[0]."</td>";
				$query = 'SELECT SUM(totalPrice) FROM orders WHERE dateMade > (curdate() - INTERVAL 1 YEAR) AND status = "shipped"';
				$result = $conn->query($query);
				$result = $result->fetch_row();
				echo "<tr>";
				echo "<td>Year</td>";
				echo "<td>$".$result[0]."</td>";
				$query = 'SELECT SUM(totalPrice) FROM orders WHERE status = "shipped"';
				$result = $conn->query($query);
				$result = $result->fetch_row();
				echo "<tr>";
				echo "<td>All Time</td>";
				echo "<td>$".$result[0]."</td>";
				echo '</tbody></table>';
			}
			else {
			?>
<div class="alert alert-danger" role="alert">
  <strong>MANAGER ACCESS ONLY</strong>
</div>
			<?php
			}
		?>
	</div></div>
	</body>



</html>
