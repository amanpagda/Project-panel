<?php
include ("cat-data.php");
include ("connection.php");
include ("header.php");
include ("navbar.php");
include ("sidebar.php");
?>

<!-- main content start -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 fw-bold">Category Page</h1>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">

                <!-- form start -->
                <div class="container-fluid">

                    <?php

                    $conn = $conn = mysqli_connect("localhost", "root", "", "admin_project");
                    $id = $_GET["id"];
                    $sql = "SELECT * FROM `category` WHERE id='$id'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        foreach ($result as $row) {
                            ?>
                            <form method="post" action="category.php" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $row["id"];?>">
                                <div class="mb-3">
                                    <label class="form-label">Category Name</label>
                                    <input type="text" class="form-control" name="cat_name" value="<?php echo $row["cat_name"];?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Sub Category</label>
                                    <select class="form-control" name="cat_sub_name">
                                        <option value="yes" <?php if($row["cat_sub_name"] == "yes"){
                                            echo "selected";
                                        }?>>Yes</option>
                                        <option value="no" <?php if($row["cat_sub_name"] == "no"){
                                            echo "selected";
                                        }?>>No</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Category Image</label>
                                    <input type="file" class="form-control" name="cat_image" accept=".jpg, .png, .jpeg">
                                    <input type="hidden" class="form-control" value="<?php echo $row["cat_image"];?>" name="cat_image_old" accept=".jpg, .png, .jpeg">
                                    <img class="mt-3" src="<?php echo "upload/".$row["cat_image"];?>" width="150px" alt="">
                                </div>
                                <div class="mb-3">
                                    <label for="floatingTextarea">Comments</label>
                                    <textarea class="form-control" name="cat_desc" required><?php echo $row["cat_desc"];?></textarea>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" name="update" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-danger" style="margin-left: 5px;">Reset</button>
                                </div>
                            </form>
                            <?php
                        }
                    }

                    ?>
                </div>
                <!-- form end -->

            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- main content end -->

<?php include ("footer.php"); ?>