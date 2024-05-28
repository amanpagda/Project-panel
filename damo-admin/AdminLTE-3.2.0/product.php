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
                    <h1 class="m-0 fw-bold">Products</h1>
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
                    <form method="POST" enctype="multipart/form-data" action="product.php">
                        <input type="hidden" name="pid">
                        <div class="mb-3">
                            <label class="form-label">Product Name</label>
                            <input placeholder="Enter Product Name" type="text" class="form-control" name="pro-name"
                                required>
                        </div>
                        <!-- ajax start -->
                        <div class="mb-3">
                            <label class="form-label">Product Category</label>
                            <select id="pro-category" class="form-control" name="pro-category">
                                <option value="" disabled selected>--Select Category--</option>
                                <?php
                                include ("connection.php");
                                $sql = "SELECT * FROM `pro-category` ORDER BY pname";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <option value="<?php echo $row["pid"]; ?>"><?php echo $row["pname"]; ?></option>
                                    <?php
                                }

                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Sub Category</label>
                            <select id="pro-sub-cate" class="form-control" name="pro-sub-cate">
                                <option value="" disabled selected>--Select Sub Category--</option>
                            </select>
                        </div>
                        <!-- ajax end -->
                        <div class="mb-3">
                            <label class="form-label">Sub Category Image</label>
                            <input type="file" class="form-control" name="pro-image" accept=".jpg, .png, .jpeg"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="floatingTextarea">Sub Category Description</label>
                            <textarea placeholder="Sub Category Description" class="form-control" name="pro-desc"
                                required></textarea>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" name="pro-add" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-danger" style="margin-left: 5px;">Reset</button>
                        </div>
                    </form>
                </div>
                <!-- form end -->

                <!-- table start -->
                <table class="table table-bordered border-primary mt-3">
                    <thead class="text-center">
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Sub Category</th>
                            <th scope="col">Product Image</th>
                            <th scope="col">Description</th>
                            <th scope="col">Edit's</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php
                        $conn = mysqli_connect("localhost", "root", "", "admin_project");
                        $sql = "SELECT * FROM `products`";
                        $result = mysqli_query($conn, $sql);
                        $i = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $i += 1;
                            ?>
                            <tr>
                                <th scope="row"><?php echo $i; ?></th>
                                <td><?php echo $row["pro-name"]; ?></td>
                                <?php
                                    $conn = mysqli_connect("localhost", "root", "", "admin_project");
                                    $pid = $row["pro-category"];
                                    $sql_pro = "SELECT * FROM `pro-category` WHERE code='$pid'";
                                    $result_pro = mysqli_query($conn, $sql_pro);
                                    while ($row_pro = mysqli_fetch_assoc($result_pro)) {
                                        ?>
                                        <td><?php echo $row_pro["pname"]; ?></td>
                                        <?php
                                    }
                                ?>
                                <?php
                                    $conn = mysqli_connect("localhost", "root", "", "admin_project");
                                    $ps_id = $row["pro-sub-cate"];
                                    $sub_sql = "SELECT * FROM `pro-sub-cate` WHERE ps_id='$ps_id'";
                                    $result_sub = mysqli_query($conn, $sub_sql);
                                    while ($row_sub = mysqli_fetch_assoc($result_sub)) {
                                        ?>
                                        <td><?php echo $row_sub["ps_name"]; ?></td>
                                        <?php
                                    }
                                ?>
                                <td><img src="<?php echo 'all-image/product-upload/' . $row["pro-image"]; ?>" width="150px">
                                </td>
                                <td><textarea style="height: 100px;" class="form-control"><?php echo $row["pro-desc"]; ?></textarea></td>
                                <td>
                                    <a href="<?php echo "pro_edit.php?id=$row[id]" ?>" class="btn btn-primary">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="product.php" method="POST">
                                        <input type="hidden" name="del_id" value="<?php echo $row["id"]; ?>">
                                        <input type="hidden" name="del_image" value="<?php echo $row["pro-image"]; ?>">
                                        <button type="submit" name="pro-delete" class="btn btn-danger mt-3"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <!-- table end -->

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