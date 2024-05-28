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
    $title = $_POST["title"];
    $description = $_POST["description"];
    $keyword = $_POST["keyword"];

    $sql = "UPDATE `seo` SET `title`='$title',`description`='$description',`keyword`='$keyword',`date`= current_timestamp() WHERE `id`='$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
       echo "<script>
       alert('Update Successfully');
       window.location.href = 'seo.php'; 
       </script>";
    } else {
        echo "<script>
       alert('Update Error');
       window.location.href = 'seo.php'; 
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
                    <h1 class="m-0">SEO Tools</h1>
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
                <!-- form Start -->

                <!-- home page start -->
                <?php
                $conn = mysqli_connect("localhost", "root", "", "admin_project");
                $sql = "SELECT * FROM `seo` WHERE `id`=1";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <div class="container-fluid bg-white rounded">
                        <form action="seo.php" method="post" class="my-3">
                            <h5 class="fw-bold ps-3 mb-3">→ HOME PAGE</h5>
                            <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
                            <div class="mb-3">
                                <label class="form-label">Page Title</label>
                                <input type="text" value="<?php echo $row["title"]; ?>" class="form-control" name="title"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="description" rows="3"
                                    required><?php echo $row["description"]; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Page Keywords</label>
                                <textarea class="form-control" name="keyword" rows="3"
                                    required><?php echo $row["keyword"]; ?></textarea>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" name="row_update" class="btn btn-primary">Update</button>
                                <button type="reset" class="btn btn-danger" style="margin-left: 5px;">Reset</button>
                            </div>
                        </form>
                    </div>
                    <?php
                }
                ?>
                <!-- home page end -->

                <!-- about us page start -->
                <?php
                $conn = mysqli_connect("localhost", "root", "", "admin_project");
                $sql = "SELECT * FROM `seo` WHERE `id`=2";
                $result = mysqli_query($conn, $sql);
                while ($ab = mysqli_fetch_array($result)) {
                    ?>
                    <div class="container-fluid bg-white rounded mt-3">
                        <form action="seo.php" method="post" class="my-3">
                            <h5 class="fw-bold ps-3 mb-3">→ ABOUT-US PAGE</h5>
                            <input type="hidden" name="id" value="<?php echo $ab["id"]; ?>">
                            <div class="mb-3">
                                <label class="form-label">Page Title</label>
                                <input type="text" class="form-control" value="<?php echo $ab["title"]; ?>" name="title"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Page Description</label><br>
                                <textarea class="form-control" name="description" rows="3"
                                    required><?php echo $ab["description"]; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Page Keywords</label><br>
                                <textarea class="form-control" name="keyword" rows="3"
                                    required><?php echo $ab["keyword"]; ?></textarea>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" name="row_update" class="btn btn-primary">Update</button>
                                <button type="reset" class="btn btn-danger" style="margin-left: 5px;">Reset</button>
                            </div>
                        </form>
                    </div>
                <?php } ?>
                <!-- about us page end -->

                <!-- product page start -->
                <?php
                $conn = mysqli_connect("localhost", "root", "", "admin_project");
                $sql = "SELECT * FROM `seo` WHERE `id`=3";
                $result = mysqli_query($conn, $sql);
                while ($pr = mysqli_fetch_array($result)) {
                    ?>
                    <div class="container-fluid bg-white rounded mt-3">
                        <form action="seo.php" method="post" class="my-3">
                            <h5 class="fw-bold ps-3 mb-3">→ PRODUCT PAGE</h5>
                            <input type="hidden" name="id" value="<?php echo $pr["id"]; ?>">
                            <div class="mb-3">
                                <label class="form-label">Page Title</label>
                                <input type="text" value="<?php echo $pr["title"]; ?>" class="form-control" name="title"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Page Description</label><br>
                                <textarea class="form-control" name="description" rows="3"
                                    required><?php echo $pr["description"]; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Page Keywords</label><br>
                                <textarea class="form-control" name="keyword" rows="3"
                                    required><?php echo $pr["keyword"]; ?></textarea>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" name="row_update" class="btn btn-primary">Update</button>
                                <button type="reset" class="btn btn-danger" style="margin-left: 5px;">Reset</button>
                            </div>
                        </form>
                    </div>
                <?php } ?>
                <!-- product page end -->

                <!-- quality page start -->
                <?php
                $conn = mysqli_connect("localhost", "root", "", "admin_project");
                $sql = "SELECT * FROM `seo` WHERE `id`=4";
                $result = mysqli_query($conn, $sql);
                while ($qu = mysqli_fetch_array($result)) {
                    ?>
                    <div class="container-fluid bg-white rounded mt-3">
                        <form action="seo.php" method="post" class="my-3">
                            <h5 class="fw-bold ps-3 mb-3">→ QUALITY PAGE</h5>
                            <input type="hidden" name="id" value="<?php echo $qu["id"]; ?>">
                            <div class="mb-3">
                                <label class="form-label">Page Title</label>
                                <input type="text" class="form-control" value="<?php echo $qu["title"]; ?>" name="title"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Page Description</label><br>
                                <textarea class="form-control" name="description" rows="3"
                                    required><?php echo $qu["description"]; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Page Keywords</label><br>
                                <textarea class="form-control" name="keyword" rows="3"
                                    required><?php echo $qu["keyword"]; ?></textarea>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" name="row_update" class="btn btn-primary">Update</button>
                                <button type="reset" class="btn btn-danger" style="margin-left: 5px;">Reset</button>
                            </div>
                        </form>
                    </div>
                <?php } ?>
                <!-- quality page end -->

                <!-- contact page start -->
                <?php
                $conn = mysqli_connect("localhost", "root", "", "admin_project");
                $sql = "SELECT * FROM `seo` WHERE `id`=5";
                $result = mysqli_query($conn, $sql);
                while ($co = mysqli_fetch_array($result)) {
                    ?>
                    <div class="container-fluid bg-white rounded my-3">
                        <form action="seo.php" method="post" class="my-3">
                            <h5 class="fw-bold ps-3 mb-3">→ CONTACT-US PAGE</h5>
                            <input type="hidden" name="id" value="<?php echo $co["id"]; ?>">
                            <div class="mb-3">
                                <label class="form-label">Page Title</label>
                                <input type="text" class="form-control" value="<?php echo $co["title"]; ?>" name="title"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Page Description</label><br>
                                <textarea class="form-control" name="description" rows="3"
                                    required><?php echo $co["description"]; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Page Keywords</label><br>
                                <textarea class="form-control" name="keyword" rows="3"
                                    required><?php echo $co["keyword"]; ?></textarea>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" name="row_update" class="btn btn-primary">Update</button>
                                <button type="reset" class="btn btn-danger" style="margin-left: 5px;">Reset</button>
                            </div>
                        </form>
                    </div>
                <?php } ?>
                <!-- contact page end -->

                <!-- form end -->

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- main content end -->

<?php include ("footer.php"); ?>