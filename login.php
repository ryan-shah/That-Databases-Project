<?php

$servername = 'rash227.netlab.uky.edu';
$username = 'root';
$conn = new mysqli($servername, $username, $username, 'PROJECT');
if($conn->connect_error) {
        die("connection failed ".$conn->connect_error."\n");
}

$uname = htmlspecialchars($_GET["user"]);
$pword = htmlspecialchars($_GET["pword"]);
$q = "SELECT * FROM user WHERE uname=\"".$uname."\" AND pw=\"".$pword."\";";
$result = $conn->query($q);
if($result->num_rows > 0) {
	header("Location: /main.html?user=".uname."&pword=".pword);
	die();
} else {
	echo "LOGIN FAILED<br>";
	echo "go to <a href=\"/createaccount.html\">here</a> to create an account<br>";
	echo "or <a href=/login.html>here</a> to try again";
}

?>
