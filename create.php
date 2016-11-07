<?php

$servername = 'rash227.netlab.uky.edu';
$username = 'root';
$conn = new mysqli($servername, $username, $username, 'PROJECT');
if($conn->connect_error) {
        die("connection failed ".$conn->connect_error."\n");
}

$uname = htmlspecialchars($_GET["user"]);
$pword = htmlspecialchars($_GET["pword"]);
$q = "INSERT INTO user (uname, pw) VALUES (\"".$uname."\", \"".$pword."\");";
$result = $conn->query($q);
//echo $q."<br>";
echo "Account Created with username: ".$uname;
echo "<br>";
echo "You can now login <a href=/login.html>here</a>";
?>
