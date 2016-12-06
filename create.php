<?php
include "css.php";
if ( empty($_GET["user"]) ) {

?>
<!doctype html>
<html>
<head>
        <title>Account Creation</title>
<?php scripts(); ?>
</head>
<body>
<form action="/create.php" method="get">
Username:<br>
        <input type="text" name="user"><br>
Password:<br>
        <input type="password" name="pword"><br>
<input type="submit" value="Submit">
</form>
<h3>
YOU CAN ONLY CREATE A CUSTOMER ACCOUNT FROM THIS PAGE
</h3>
<p>
Please contact your system administrator to create a staff account
</p>
</body>
</html>
<?php
} else {
$servername = 'rash227.netlab.uky.edu';
$username = 'root';
$conn = new mysqli($servername, $username, $username, 'PROJECT');
if($conn->connect_error) {
        die("connection failed ".$conn->connect_error."\n");
}

$uname = htmlspecialchars($_GET["user"]);
$pword = htmlspecialchars($_GET["pword"]);
$q = "INSERT INTO customer (cid, pass) VALUES (\"".$uname."\", \"".$pword."\");";
$result = $conn->query($q);
//echo $q."<br>";
echo "Account Created with username: ".$uname;
echo "<br>";
echo "You can now login <a href=/>here</a>";
}
?>
