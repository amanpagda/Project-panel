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
                    $sql = "SELECT * FROM `sub_category` WHERE id='$id'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        foreach ($result as $row) {
                            ?>
                            <!-- form Start -->
                            <div class="container">
                                <form action="sub-category.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?php echo $row["id"];?>">
                                    <div class="mb-3">
                                        <label class="form-label">Sub Category</label>
                                        <select class="form-control" name="category">
                                            <option selected class="fw-bold">--Select Sub Category--</option>
                                            <option value="Hardware Fitting" <?php if ($row["category"] == "Hardware Fitting"){
                                                echo "selected";
                                            } ?>>
                                                Hardware Fitting
                                            </option>
                                            <option value="Precision Parts" <?php if ($row["category"] == "Precision Parts"){
                                                echo "selected";
                                            } ?>>
                                                Precision Parts
                                            </option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Sub Category Name</label>
                                        <input placeholder="Sub Category Name" type="text" class="form-control"
                                            name="sub_cat_name" value="<?php echo $row["sub_cat_name"]; ?>" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Sub Category Image</label>
                                        <input type="file" class="form-control" name="sub_image" accept=".jpg, .png, .jpeg">
                                        <input type="hidden" class="form-control" name="old_sub_image"
                                            value="<?php echo $row["sub_image"]; ?>" accept=".jpg, .png, .jpeg">
                                    </div>

                                    <div class="mb-3">
                                        <img src="<?php echo "all-image/sub-upload/".$row["sub_image"]; ?>" width="150px" alt="image">
                                    </div>

                                    <div class="mb-3">
                                        <label for="floatingTextarea">Sub Category Description</label>
                                        <textarea placeholder="Sub Category Description" class="form-control" name="sub_desc"
                                            required><?php echo $row["sub_desc"]; ?></textarea>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <button type="submit" name="sub_update" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-danger" style="margin-left: 5px;">Reset</button>
                                    </div>
                                </form>
                            </div>
                            <!-- form end -->
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