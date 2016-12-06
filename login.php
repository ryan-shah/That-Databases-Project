<?php
include "css.php";
if( empty($_POST["user"]) ) {

?>
<!doctype html>
<html>
<head>
        <title>Login</title>
<?php scripts(); ?>
</head>
<body>
<form action="/login.php" method="post">
Position:<br>
<select name="position">
        <option value="customer">Customer</option>
        <option value="staff">Staff</option>
</select><br>
Username:<br>
        <input type="text" name="user"><br>
Password:<br>
        <input type="password" name="pword"><br>
<input type="submit" value="Submit">
</form>
</body>
</html>
<?php

} else {
		session_start();
		$servername = 'rash227.netlab.uky.edu';
		$username = 'root';
		$conn = new mysqli($servername, $username, $username, 'PROJECT');
		if($conn->connect_error) {
				die("connection failed ".$conn->connect_error."\n");
		}

		$uname = htmlspecialchars($_POST["user"]);
		$pword = htmlspecialchars($_POST["pword"]);
		$pos = htmlspecialchars($_POST["position"]);
		if($pos === "customer") {
			$q = "SELECT * FROM customer WHERE cid=\"".$uname."\" AND pass=\"".$pword."\";";
		} else {
			$q = "SELECT * FROM staff WHERE sid=\"".$uname."\" AND pass=\"".$pword."\";";
}
$result = $conn->query($q);
if($result->num_rows > 0) {
	$_SESSION["username"] = $uname;
	if($pos === "customer") {
		$_SESSION["position"] = "customer";
		header("Location: ./main.php?user=".$uname."&pos=".$pos);
		die();
	} else {
		$result = $result->fetch_assoc();
		if($result["isMgr"] != 1){
			$_SESSION["position"] = "staff";
		} else { $_SESSION["position"] = "manager"; }
		header("Location: ./shipments.php");
		die();
	}
} else {
	echo "LOGIN FAILED<br>";
	echo "go to <a href=\"/create.php\">here</a> to create an account<br>";
	echo "or <a href=/login.php>here</a> to try again";
}
}
?>
