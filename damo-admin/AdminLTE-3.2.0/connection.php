<?php 

$conn = mysqli_connect("localhost","root","","admin_project");

$db = mysqli_select_db($conn, "admin_project") or die ("Not connected");

?>