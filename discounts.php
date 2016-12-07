<html>

	<head>
		<?php
			session_start();
//			$_SESSION['position']='manager';
			$servername = "rash227.netlab.uky.edu";
			$username = "root";
			$password = $username;
			$conn = new mysqli($servername, $username, $password, 'PROJECT');
			include "css.php";
			scripts();
		?>

		<title>Discounts</title>

	</head>
	<body>
	<?php
		navbarStaff();
		if($_SESSION['position'] === 'manager'){
			if(!isset($_POST['item']) && !isset($_POST['discount'])){
			$query = "SELECT mid, price, discount FROM merch";
			$result = $conn->query($query);
			echo "<table class=\"table table-striped table-hover\"><thead>";
			echo "<th>Item</th>";
			echo "<th>Price</th>";
			echo "<th>Discount</th>";
			echo "<th>New Price</th></thead>";
			while($row = $result->fetch_assoc()){
				echo "<tbody><tr>";
				echo "<td>".$row['mid']."</td>";
				echo "<td>".$row['price']."</td>";
				echo "<td>".$row['discount']."</td>";
				echo "<td>".($row['price']*(1 - $row['discount']))."</td>";
				echo "</tr></tbody>";
			}
		?>
		<div class="container"><div class="jumbotron">
		<form class="form form-inline" method="POST">
			<legend>Set Discount</legend>
			<div class="form-group">
			<div class="col-lg-3">
			<input type='text' name='item' id='item' placeholder='Item' class="form-control">
			</div></div>
			<div class="form-group col-lg-3">
			<input type='number' class="form-control" step=.01 min=0 max=1 id="discount" placeholder="0" name='discount'>
			</div>
			<input type='submit' class="btn btn-primary" method='POST'>
		</form>
		</div></div>


	<?php	} else {
				$query = "UPDATE merch SET discount = ".$_POST['discount']." WHERE mid='".$_POST['item']."'";
				//echo $query;
				$result = $conn->query($query);
				echo "<div class=container><div class=jumbotron><h2>Discount updated.</h2></div></div>";
				//echo "<a href=./discounts.php>Back to discount page</a>";
			  }
		}	
		else{
		?>
		<div class="alert alert-danger" role="alert">
  <strong>MANAGER ACCESS ONLY</strong>
</div>

		<?php
		}
	?>
</body>
</html>
