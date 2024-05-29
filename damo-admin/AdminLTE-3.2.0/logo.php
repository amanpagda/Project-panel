<?php
session_start();
include ("data.php");
include ("header.php");
include ("navbar.php");
include ("sidebar.php");
?>

<?php

if (isset($_POST["row_update"])) {

    $id = $_POST["id"];
    $new_image = $_FILES["image"]["name"];
    $old_image = $_POST["image_old"];

    if ($new_image != '') {
        $update_file = $new_image;
        if (file_exists("all-image/logos/" . $_FILES["image"]["name"])) {

            echo "<script>
                alert('File already Exists');
                window.location.href = 'logo.php';
                </script>";

        }
    } else {
        $update_file = $old_image;
    }
    $conn = mysqli_connect("localhost","root","","admin_project");
    $sql = "UPDATE `logo` SET `image`='$update_file',`date`=current_timestamp() WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if ($_FILES["image"]["name"] != '') {
            move_uploaded_file($_FILES["image"]["tmp_name"], "all-image/logos/" . $_FILES["image"]["name"]);
            unlink("all-image/logos/" . $old_image);
        }
        echo "<script>
                alert('Update Successfuly');
                window.location.href = 'logo.php';
                </script>";
    } else {
        echo "<script>
                alert('Update Error!');
                window.location.href = 'logo.php';
                </script>";
    }

}
?>

<!-- main content start -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">WEBSITE LOGOS</h1>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">

                <div class="container-fluid bg-white rounded mt-3">
                    <h5 class="fw-bold mb-4 mt-3">→ Update Header Logo</h5>
                    <?php
                    $conn = mysqli_connect("localhost", "root", "", "admin_project");
                    $sql = "SELECT * FROM `logo` WHERE id=2";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <form action="logo.php" method="post" enctype="multipart/form-data" class="my-3">
                            <input type="hidden" name="id" value="<?php echo $row["id"];?>">
                            <div class="mb-3">
                                <label for="formFileMultiple" class="form-label">Header Logo</label>
                                <input class="form-control" name="image" type="file">
                                <input class="form-control" name="image_old" type="hidden" value="<?php echo $row["image"];?>">
                            </div>
                            <div class="mb-3">
                                <img src="<?php echo "all-image/logos/".$row["image"];?>" width="150px">
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" name="row_update" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-danger" style="margin-left: 5px;">Reset</button>
                            </div>
                        </form>
                        <?php
                    }
                    ?>
                </div>

                <div class="container-fluid bg-white rounded mt-3">
                    <h5 class="fw-bold mb-4 mt-3">→ Update Footer Logo</h5>
                    <?php
                    $conn = mysqli_connect("localhost", "root", "", "admin_project");
                    $sql = "SELECT * FROM `logo` WHERE id=3";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <form action="logo.php" method="post" enctype="multipart/form-data" class="my-3">
                            <input type="hidden" name="id" value="<?php echo $row["id"];?>">
                            <div class="mb-3">
                                <label for="formFileMultiple" class="form-label">Footer Logo</label>
                                <input class="form-control" name="image" type="file">
                                <input class="form-control" name="image_old" type="hidden" value="<?php echo $row["image"];?>">
                            </div>
                            <div class="mb-3">
                                <img src="<?php echo "all-image/logos/".$row["image"];?>" width="150px">
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" name="row_update" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-danger" style="margin-left: 5px;">Reset</button>
                            </div>
                        </form>
                        <?php
                    }
                    ?>
                </div>

                <div class="container-fluid bg-white rounded my-3">
                    <h5 class="fw-bold mb-4 mt-3">→ Update Favicon Logo</h5>
                    <?php
                    $conn = mysqli_connect("localhost", "root", "", "admin_project");
                    $sql = "SELECT * FROM `logo` WHERE id=4";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <form action="logo.php" method="post" enctype="multipart/form-data" class="my-3">
                            <input type="hidden" name="id" value="<?php echo $row["id"];?>">
                            <div class="mb-3">
                                <label for="formFileMultiple" class="form-label">Favicon Logo</label>
                                <input class="form-control" name="image" type="file">
                                <input class="form-control" name="image_old" type="hidden" value="<?php echo $row["image"];?>">
                            </div>
                            <div class="mb-3">
                                <img src="<?php echo "all-image/logos/".$row["image"];?>" width="150px">
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" name="row_update" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-danger" style="margin-left: 5px;">Reset</button>
                            </div>
                        </form>
                        <?php
                    }
                    ?>
                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- main content end -->

<?php include ("footer.php"); ?>