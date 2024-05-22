<?php
include ("connection.php");

//  insert start

$targetdir = "upload/";
$watermark_path = "watermark.png";
$statusMsg = "";

if (isset($_POST["add"])) {
    $name = $_POST["cat_name"];
    $sub_name = $_POST["cat_sub_name"];
    $desc = $_POST["cat_desc"];

    $random = rand(1, 99999);
    $image = $random . '-' .$_FILES["cat_image"]["name"];

    $sql = "INSERT INTO `category`(`cat_name`, `cat_sub_name`, `cat_image`, `cat_desc`, `date`) VALUES ('$name','$sub_name','$image','$desc', current_timestamp())";
    $result = mysqli_query($conn, $sql);

    if (!empty($_FILES["cat_image"]["name"])) {
        $image_name = basename($image);
        $file_name = $image_name;
        $targetFilePath = $targetdir . $file_name;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        $newFolder = "no-watermark/";
        $newtargetFilePath = $newFolder . $file_name;

        $allow_type = array('jpg', 'png', 'jpeg');

        if (in_array($fileType, $allow_type)) {

            if (move_uploaded_file($_FILES["cat_image"]["tmp_name"], $newtargetFilePath)) {
                $watermark_img = imagecreatefrompng($watermark_path);
                switch ($fileType) {
                    case 'jpg':
                        $im = imagecreatefromjpeg($newtargetFilePath);
                        break;
                    case 'jpeg':
                        $im = imagecreatefromjpeg($newtargetFilePath);
                        break;
                    case 'png':
                        $im = imagecreatefrompng($newtargetFilePath);
                        break;
                    default:
                        $im = imagecreatefromjpeg($newtargetFilePath);
                }

                $main_width = imagesx($im);
                $main_height = imagesy($im);
                $watermark_width = imagesx($watermark_img);
                $watermark_height = imagesy($watermark_img);

                $x = ($main_width - $watermark_width) / 2;
                $y = ($main_height - $watermark_height) / 2;

                imagecopy($im, $watermark_img, $x, $y, 0, 0, $watermark_width, $watermark_height);


                imagepng($im, $targetFilePath);
                imagedestroy($im);

                if (file_exists($targetFilePath)) {
                            header('location: category.php');
                } else {
                    $statusMsg = '<p style="color:#EA4335;">Errom watermark</p>';
                }
            } else {
                $statusMsg = '<p style="color:#EA4335;">Errom upload your watermark</p>';
            }
        } else {
            $statusMsg = '<p style="color:#EA4335;">Sorry only jpg, png, & jpeg file uploaded</p>';
        }


    } else {
        $statusMsg = '<p style="color:#EA4335;">Please select a file to upload</p>';
    }
}
//  insert end

// update start
if (isset($_POST["update"])) {
    $id = $_POST["id"];
    $name = $_POST["cat_name"];
    $sub_name = $_POST["cat_sub_name"];
    $desc = $_POST["cat_desc"];

    $random = rand(1, 99999);
    $image = $_FILES["cat_image"]["name"];
    $old_image = $_POST["cat_image_old"];

    if ($image !== '') {
        $update_file = $image;
        unlink("upload/" . $old_image);
        unlink("no-watermark/" . $old_image);
        if (file_exists("upload/" . $image)) {

            header("location: category.php?already_exists_file");

        }
    } else {
        $update_file = $old_image;
    }

    $sql = "UPDATE `category` SET `cat_name`='$name',`cat_sub_name`='$sub_name',`cat_image`='$update_file',`cat_desc`='$desc',`date`= current_timestamp() WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    if (!empty($_FILES["cat_image"]["name"])) {
        $image_name = basename($image);
        $file_name = $image_name;
        $targetFilePath = $targetdir . $file_name;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        $newFolder = "no-watermark/";
        $newtargetFilePath = $newFolder . $file_name;

        $allow_type = array('jpg', 'png', 'jpeg');

        if (in_array($fileType, $allow_type)) {

            if (move_uploaded_file($_FILES["cat_image"]["tmp_name"], $newtargetFilePath)) {
                $watermark_img = imagecreatefrompng($watermark_path);
                switch ($fileType) {
                    case 'jpg':
                        $im = imagecreatefromjpeg($newtargetFilePath);
                        break;
                    case 'jpeg':
                        $im = imagecreatefromjpeg($newtargetFilePath);
                        break;
                    case 'png':
                        $im = imagecreatefrompng($newtargetFilePath);
                        break;
                    default:
                        $im = imagecreatefromjpeg($newtargetFilePath);
                }

                $main_width = imagesx($im);
                $main_height = imagesy($im);
                $watermark_width = imagesx($watermark_img);
                $watermark_height = imagesy($watermark_img);

                $x = ($main_width - $watermark_width) / 2;
                $y = ($main_height - $watermark_height) / 2;

                imagecopy($im, $watermark_img, $x, $y, 0, 0, $watermark_width, $watermark_height);


                imagepng($im, $targetFilePath);
                imagedestroy($im);

                if (file_exists($targetFilePath)) {
                            header('location: category.php');
                } else {
                    $statusMsg = '<p style="color:#EA4335;">Errom watermark</p>';
                }
            } else {
                $statusMsg = '<p style="color:#EA4335;">Errom upload your watermark</p>';
            }
        } else {
            $statusMsg = '<p style="color:#EA4335;">Sorry only jpg, png, & jpeg file uploaded</p>';
        }


    } else {
        $statusMsg = '<p style="color:#EA4335;">Please select a file to upload</p>';
    }
}
// update end


// delete start
if (isset($_POST["delete"])) 
{
    $id = $_POST['del_id'];
    $image = $_POST['del_image'];

    $sql = "DELETE FROM `category` WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    if($result){
        unlink("upload/" . $image);
        unlink("no-watermark/" . $image);
        header("location: category.php?Data=Deleted.");
    }else{
        header("location: category.php?Error=Deleted.");
    }
}
// delete end


?>