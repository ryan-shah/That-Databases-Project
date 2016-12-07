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
<?php navbar(); ?>
<div class="container">
<div class="jumbotron">
<h1> Welcome to Emazon.com! </h1>
<form class="form-horizontal" action="/" method="post">
<legend>Please login to continue</legend>
<div class="form-group">
<label for="position" class="col-lg-2 control-label">Position</label>
<div class="col-lg-10">
<select id="position" class="form-control" name="position">
        <option value="customer">Customer</option>
        <option value="staff">Staff</option>
</select>
</div>
</div>
<div class="form-group">
	<label for="user" class="col-lg-2 control-label">Username</label>
	<div class="col-lg-10">
	<input type="text" class="form-control" id="user" placeholder="Username" name="user">
</div></div>
<div class="form-group">
      <label for="pword" class="col-lg-2 control-label">Password</label>
	<div class="col-lg-10">
        <input type="password" class="form-control" id="pword" name="pword" placeholder="Password">
	</div>
</div>
<div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">

	<button type="submit" class="btn btn-primary">Submit</button>
</div></div>
</form>
</div></div>
<div class="col-md-3"></div>
<div class="alert alert-dismissible alert-success col-md-6">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
<h3>Welcome Testers</h3>
<p>you can create a customer account if you'd like, however in order to accesss staff functionality please use the following logins</p>
<p><strong>Staff:</strong> test, test </p>
<p><strong>Manager:</strong> manager, pass </p>
</div>
<div class="col-md-3"></div>

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
?>
<!doctype html>
<html>
<head>
        <title>Login</title>
<?php scripts(); ?>
</head>
<body>
<?php 
	navbar();
	echo "<div class=container><div class=jumbotron><h1>LOGIN FAILED</h1>";
	echo "<p>go to <a href=\"/create.php\">here</a> to create an account<br>";
	echo "or <a href=/>here</a> to try again</p></div></div>";

}
}
?>
