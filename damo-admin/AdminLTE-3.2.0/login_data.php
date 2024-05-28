<?php 

session_start();
include("connection.php");

if(isset($_POST["login_submit"])){
    $name = $_POST["name"];
    $password = $_POST["password"];
    
    $sql= "SELECT * FROM `admin_table` WHERE `name`='$name' AND `password`='$password'";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);

    if(!empty($data)){

        $_SESSION["role"] = $data["role"];
        $_SESSION["name"] = $data["name"];

        header("location: index1.php");
    }


}

?>