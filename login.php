<?php

$servername = 'rash227.netlab.uky.edu';
$username = 'root';
$conn = new mysqli($servername, $username, $username, 'PROJECT');
if($conn->connect_error) {
        die("connection failed ".$conn->connect_error."\n");
}

$uname = htmlspecialchars($_GET["user"]);
$pword = htmlspecialchars($_GET["pword"]);
$pos = htmlspecialchars($_GET["position"]);
if($pos == "customer") {
	$q = "SELECT * FROM customer WHERE cid=\"".$uname."\" AND pass=\"".$pword."\";";
} else {
	$q = "SELECT * FROM staff WHERE sid=\"".$uname."\" AND pass=\"".$pword."\";";
}
$result = $conn->query($q);
if($result->num_rows > 0) {
	if($pos == "customer") {
		header("Location: /main.php?user=".$uname."&pos=".$pos);
		die();
	} else {
		header("Location: /shipments.php");
		die();
	}
} else {
	echo "LOGIN FAILED<br>";
	echo "go to <a href=\"/createaccount.html\">here</a> to create an account<br>";
	echo "or <a href=/login.html>here</a> to try again";
}

?>
