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
                    <h1 class="m-0 fw-bold">Sub Category</h1>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">

                <!-- form Start -->
                <div class="container">
                    <form action="sub-category.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Sub Category</label>
                            <select class="form-control" name="category">
                                <option selected class="fw-bold">--Select Sub Category--</option>
                                <option value="Hardware Fitting">Hardware Fitting</option>
                                <option value="Precision Parts">Precision Parts</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sub Category Name</label>
                            <input placeholder="Sub Category Name" type="text" class="form-control" name="sub_cat_name"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Sub Category Image</label>
                            <input type="file" class="form-control" name="sub_image" accept=".jpg, .png, .jpeg"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="floatingTextarea">Sub Category Description</label>
                            <textarea placeholder="Sub Category Description" class="form-control" name="sub_desc"
                                required></textarea>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" name="sub_add" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-danger" style="margin-left: 5px;">Reset</button>
                        </div>
                    </form>
                </div>
                <!-- form end -->

                <!-- table Start -->
                <div class="container">
                    <table class="table table-striped mt-3">
                        <thead class="text-center">
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Sub Category</th>
                                <th scope="col">Sub Category Name</th>
                                <th scope="col">Sub Category Image</th>
                                <th scope="col">Description</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php
                            $conn = mysqli_connect("localhost", "root", "", "admin_project");
                            $sql = "SELECT * FROM `sub_category`";
                            $result = mysqli_query($conn, $sql);
                            $i = 0;
                            if (mysqli_num_rows($result) > 0) {
                                foreach ($result as $row) {
                                    $i += 1;
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $i; ?></th>
                                        <td>
                                            <?php echo $row["category"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $row["sub_cat_name"]; ?>
                                        </td>
                                        <td>
                                            <img src="<?php echo 'all-image/sub-upload/' . $row["sub_image"]; ?>" width="150px"
                                                alt="">
                                        </td>
                                        <td>
                                            <?php echo $row["sub_desc"]; ?>
                                        </td>
                                        <td class="d-flex justify-content-center">
                                            <a href="<?php echo "sub_cat_edit.php?id=$row[id]" ?>" class="btn btn-primary"
                                                style="margin-right:5px;">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <form action="sub-category.php" method="POST">
                                                <input type="hidden" name="sub_id" value="<?php echo $row["id"]; ?>">
                                                <input type="hidden" name="sub_del_image"
                                                    value="<?php echo $row["sub_image"]; ?>">
                                                <button type="submit" name="sub_delete" class="btn btn-danger">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- table End -->

            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- main content end -->

<?php include ("footer.php"); ?>