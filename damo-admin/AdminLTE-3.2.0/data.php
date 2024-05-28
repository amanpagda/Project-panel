<?php 

include("connection.php");

// insert Query start
if(isset($_POST["submit"])){

    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $role = $_POST["role"];

    $sql = "INSERT INTO `admin_table`(`name`, `email`, `password`, `role`, `date`) VALUES ('$name','$email','$password','$role', current_timestamp())";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header('location: index1.php?success=added');
    } else {
        header('location: index1.php?alert=add_error');
    }

}
// insert Query end

// update Query start
if(isset($_POST["update"])){

    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $role = $_POST["role"];

    $sql = "UPDATE `admin_table` SET `name`='$name',`email`='$email',`password`='$password',`role`='$role',`date`=current_timestamp() WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header('location: index1.php?success=Update');
    } else {
        header('location: index1.php?alert=Update_error');
    }

}
// update Query end

// delete Query start
if(isset($_POST['delete'])){
    $id = $_POST['del_id'];

    $sql = "DELETE FROM `admin_table` WHERE id='$id'";

    $result = mysqli_query($conn, $sql);
    if($result){
        echo "<script>
        alert('Delete Successfully');
        window.location.href = 'index1.php';        
        </script>";
    }else{
        echo "<script>
        alert('Delete Error....');
        window.location.href = 'index1.php';        
        </script>";
    }


}
// delete Query end



?>