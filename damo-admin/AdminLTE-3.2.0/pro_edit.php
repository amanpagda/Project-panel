<?php
session_start();
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
                    <h1 class="m-0 fw-bold">Product Edit Page</h1>
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
                    <?php
                    $conn = mysqli_connect("localhost", "root", "", "admin_project");
                    $id = $_GET["id"];
                    $sql = "SELECT * FROM `products` WHERE id='$id'";
                    $result = mysqli_query($conn, $sql);
                    while ($a = mysqli_fetch_assoc($result)) {
                        ?>
                        <form method="POST" enctype="multipart/form-data" action="product.php">
                            <input type="hidden" name="id" value="<?php echo $a["id"]; ?>">
                            <div class="mb-3">
                                <label class="form-label">Product Name</label>
                                <input placeholder="Enter Product Name" type="text" class="form-control" name="pro-name"
                                    value="<?php echo $a["pro-name"]; ?>" required>
                            </div>
                            <!-- ajax start -->
                            <div class="mb-3">
                                <label class="form-label">Product Category</label>
                                <select id="pro-category" class="form-control" name="pro-category">
                                    <?php
                                    $conn = mysqli_connect("localhost", "root", "", "admin_project");
                                    $pid = $a["pro-category"];
                                    $sql_pro = "SELECT * FROM `pro-category` WHERE code='$pid'";
                                    $result_pro = mysqli_query($conn, $sql_pro);
                                    while ($row_pro = mysqli_fetch_assoc($result_pro)) {
                                        ?>
                                        <option value="1" <?php if ($row_pro["pname"] == "Hardware Fitting") {
                                            echo "selected";
                                        } ?>>Hardware Fitting</option>
                                        <option value="2" <?php if ($row_pro["pname"] == "Precision Parts") {
                                            echo "selected";
                                        } ?>>Precision Parts</option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Sub Category</label>
                                <select id="pro-sub-cate" class="form-control" name="pro-sub-cate">
                                <?php
                                    $conn = mysqli_connect("localhost", "root", "", "admin_project");
                                    $ps_id = $a["pro-sub-cate"];
                                    $sub_sql = "SELECT * FROM `pro-sub-cate` WHERE ps_id='$ps_id'";
                                    $result_sub = mysqli_query($conn, $sub_sql);
                                    while ($row_sub = mysqli_fetch_assoc($result_sub)) {
                                        ?>
                                        <option value="<?php echo $row_sub["ps_id"];?>" <?php if($row_sub["ps_name"] == $ps_id) {
                                            echo "selected";
                                        } ?>><?php echo $row_sub["ps_name"];?></option>
                                        <?php
                                    }
                                ?>
                                </select>
                            </div>
                            <!-- ajax end -->
                            <div class="mb-3">
                                <label class="form-label">Sub Category Image</label>
                                <input type="file" class="form-control" name="pro-image" accept=".jpg, .png, .jpeg">
                                <input type="hidden" class="form-control" name="pro-image-old" value="<?php echo $a["pro-image"];?>" accept=".jpg, .png, .jpeg">
                                <img class="mt-3" src="<?php echo "all-image/product-upload/" . $a["pro-image"]; ?>"
                                    width="150px">
                            </div>
                            <div class="mb-3">
                                <label for="floatingTextarea">Sub Category Description</label>
                                <textarea placeholder="Sub Category Description" class="form-control" name="pro-desc"
                                    required><?php echo $a["pro-desc"]; ?></textarea>

                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" name="pro-update" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-danger" style="margin-left: 5px;">Reset</button>
                            </div>
                        </form>
                        <?php
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('#pro-category').change(function () {
            var ps_code = $(this).val();
            $.ajax({
                url: "action.php",
                method: "POST",
                data: { code: ps_code },
                success: function (data) {
                    $('#pro-sub-cate').html(data);
                }
            })
        })
    })
</script>