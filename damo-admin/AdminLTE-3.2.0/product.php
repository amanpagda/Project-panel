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
                    <form method="POST" enctype="multipart/form-data" action="product">

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
                            <input type="file" class="form-control" name="pro_image" accept=".jpg, .png, .jpeg"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="floatingTextarea">Sub Category Description</label>
                            <textarea placeholder="Sub Category Description" class="form-control" name="pro_desc"
                                required></textarea>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" name="pro_add" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-danger" style="margin-left: 5px;">Reset</button>
                        </div>
                    </form>
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