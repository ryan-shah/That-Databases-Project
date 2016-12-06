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
<?php navbar(); ?>
<div class="container">
<div class="well">
<form class="form-horizontal" action="/create.php" method="get">
<fieldset>
<legend>Create an account</legend>
<div class="form-group">
<label for="user" class="col-lg-2 control-label">Username</label>
<div class="col-lg-10">
        <input type="text" class="form-control" name="user" id="user" placeholder="Username">
</div></div>
<div class="form-group">
<label for="pword" class="col-lg-2 control-label">Password:</label>
	<div class="col-lg-10">
        <input type="password" class="form-control" name="pword" id="pword">
	</div></div>
<div class="form-group">
<div class="col-lg-10">
<button type="submit" class="btn btn-primary">Submit</button>
</div></div>
</fieldset>
</form>
</div></div>
<div class="alert alert-dismissible alert-danger">
<button type="button" class="close" data-dismiss="alert">&times;</button>
<h3>
YOU CAN ONLY CREATE A CUSTOMER ACCOUNT FROM THIS PAGE
</h3>
<p>
Please contact your system administrator to create a staff account
</p>
</div>
</body>
</html>
<?php
} else {
?>
<!doctype html>
<html>
<head>
        <title>Account Creation</title>
<?php scripts(); ?>
</head>
<body>
<?php 
navbar();
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
echo "<div class=container><div class=jumbotron><h3>Account Created with username: ".$uname;
echo "</h3><br>";
echo "<p>You can now login <a href=/>here</a></p></div></div>";
}
?>
