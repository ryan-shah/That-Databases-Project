<?php
function scripts() {
?>
<link rel="stylesheet" href="http://bootswatch.com/united/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<?php
}

function navbarCust($id, $pos) {
?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href=<?php echo "/main.php?user=$id&pos=$pos"?>>Emazon.com</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li><a href=<?php echo "/main.php?user=$id&pos=$pos"?>>Inventory</a></li>
      <li><a href=<?php echo "/cart.php?user=$id&pos=$pos"?>>Cart</a></li>
      <li class="align-right"><a href="/">Logout</a></li>
    </ul>
  </div>
</nav>
<?php
}

function navbarStaff($id, $pos) {
?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href=<?php echo "/shipments.php" ?>>Emazon.com</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li><a href=<?php echo "/discounts.php"?>>Discounts</a></li>
      <li><a href=<?php echo "/stats.php"?>>Stats</a></li>
      <li class="align-right"><a href="/">Logout</a></li>
    </ul>
  </div>
</nav>
<?php
}

?>
