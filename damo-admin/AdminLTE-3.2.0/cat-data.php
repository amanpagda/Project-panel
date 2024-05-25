<?php
include ("connection.php");

// CATEGORY PAGE START ************************
// insert start
$targetdir = "all-image/upload/";
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

        $newFolder = "all-image/no-watermark/";
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
        unlink("all-image/upload/" . $old_image);
        unlink("all-image/no-watermark/" . $old_image);
        if (file_exists("all-image/upload/" . $image)) {

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

        $newFolder = "all-image/no-watermark/";
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
        unlink("all-image/upload/" . $image);
        unlink("all-image/no-watermark/" . $image);
        header("location: category.php?Data=Deleted.");
    }else{
        header("location: category.php?Error=Deleted.");
    }
}
// delete end
// CATEGORY PAGE END ************************



// SUB-CATEGORY PAGE START ************************
$conn = mysqli_connect("localhost","root","","admin_project");
// sub-category insert start
$targetdir = "all-image/sub-upload/";
$watermark_path = "watermark.png";
$statusMsg = "";

if (isset($_POST["sub_add"])) {
    $category = $_POST["category"];
    $sub_cat_name = $_POST["sub_cat_name"];
    $desc = $_POST["sub_desc"];

    $random = rand(1, 99999);
    $image = $random . '-' .$_FILES["sub_image"]["name"];

    $sql = "INSERT INTO `sub_category`(`category`, `sub_cat_name`, `sub_image`, `sub_desc`, `date`) VALUES ('$category','$sub_cat_name','$image','$desc', current_timestamp())";
    $result = mysqli_query($conn, $sql);

    if (!empty($_FILES["sub_image"]["name"])) {
        $image_name = basename($image);
        $file_name = $image_name;
        $targetFilePath = $targetdir . $file_name;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        $newFolder = "all-image/sub-no-watermark/";
        $newtargetFilePath = $newFolder . $file_name;

        $allow_type = array('jpg', 'png', 'jpeg');

        if (in_array($fileType, $allow_type)) {

            if (move_uploaded_file($_FILES["sub_image"]["tmp_name"], $newtargetFilePath)) {
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
                            header('location: sub-category.php');
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
// sub-category insert end

// sub-category UPDATE start
if (isset($_POST["sub_update"])) {
    $id = $_POST["id"];
    $category = $_POST["category"];
    $sub_cat_name = $_POST["sub_cat_name"];
    $desc = $_POST["sub_desc"];

    $random = rand(1, 99999);
    $image = $_FILES["sub_image"]["name"];
    $old_image = $_POST["old_sub_image"];

    if ($image !== '') {
        $update_file = $image;
        unlink("all-image/sub-upload/" . $old_image);
        unlink("all-image/sun-no-watermark/" . $old_image);
        if (file_exists("all-image/sub-upload/" . $image)) {

            header("location: sub-category.php?already_exists_file");

        }
    } else {
        $update_file = $old_image;
    }

    $sql = "UPDATE `sub_category` SET `category`='$category',`sub_cat_name`='$sub_cat_name',`sub_image`='$update_file',`sub_desc`='$desc',`date`='[value-6]' WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    if (!empty($_FILES["sub_image"]["name"])) {
        $image_name = basename($image);
        $file_name = $image_name;
        $targetFilePath = $targetdir . $file_name;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        $newFolder = "all-image/sub-no-watermark/";
        $newtargetFilePath = $newFolder . $file_name;

        $allow_type = array('jpg', 'png', 'jpeg');

        if (in_array($fileType, $allow_type)) {

            if (move_uploaded_file($_FILES["sub_image"]["tmp_name"], $newtargetFilePath)) {
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
                            header('location: sub-category.php');
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
// sub-category UPDATE end

// sbu-category DEKETE start
if (isset($_POST["sub_delete"])) 
{
    $id = $_POST['sub_id'];
    $image = $_POST['sub_del_image'];

    $sql = "DELETE FROM `sub_category` WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    if($result){
        unlink("all-image/sub-upload/" . $image);
        unlink("all-image/sub-no-watermark/" . $image);
        header("location: sub-category.php?Data=Deleted.");
    }else{
        header("location: sub-category.php?Error=Deleted.");
    }
}
// sbu-category DEKETE end
// SUB-CATEGORY PAGE END ************************



// PRODUCT START ************************
$conn = mysqli_connect("localhost","root","","admin_project");

// product insert start
$targetdir = "all-image/product-upload/";
$watermark_path = "watermark.png";
$statusMsg = "";

if (isset($_POST["pro-add"])) {
    $name = $_POST["pro-name"];
    $pro_category = $_POST["pro-category"];
    $pro_sub_cate = $_POST["pro-sub-cate"];
    $pro_desc = $_POST["pro-desc"];

    $random = rand(1, 99999);
    $image = $random . '-' .$_FILES["pro-image"]["name"];

    $sql = "INSERT INTO `products`(`pro-name`, `pro-category`, `pro-sub-cate`, `pro-image`, `pro-desc`, `date`) VALUES ('$name','$pro_category','$pro_sub_cate','$image','$pro_desc',current_timestamp())";
    $result = mysqli_query($conn, $sql);

    if (!empty($_FILES["pro-image"]["name"])) {
        $image_name = basename($image);
        $file_name = $image_name;
        $targetFilePath = $targetdir . $file_name;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        $newFolder = "all-image/pro-no-watermark/";
        $newtargetFilePath = $newFolder . $file_name;

        $allow_type = array('jpg', 'png', 'jpeg');

        if (in_array($fileType, $allow_type)) {

            if (move_uploaded_file($_FILES["pro-image"]["tmp_name"], $newtargetFilePath)) {
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
                            header('location: product.php');
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
// product insert end

// product update start

// product update end


// product Delete start
if (isset($_POST["pro-delete"])) 
{
    $id = $_POST['del_id'];
    $image = $_POST['del_image'];

    $sql = "DELETE FROM `products` WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    if($result){
        unlink("all-image/product-upload/" . $image);
        unlink("all-image/pro-no-watermark/" . $image);
        header("location: product.php?Data=Deleted.");
    }else{
        header("location: product.php?Error=Deleted.");
    }
}
// product Delete end
// PRODUCT END ************************

?>