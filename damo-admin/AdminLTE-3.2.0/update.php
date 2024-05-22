<?php
include ("data.php");
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
                    <h1 class="m-0 fw-bold">Update Information.</h1>
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
                <div class="container-fluid">
                    <?php

                    $conn = mysqli_connect("localhost", "root", "", "admin_project");
                    $id = $_GET["id"];
                    $sql = "SELECT * FROM `admin_table` WHERE id='$id'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        foreach ($result as $row) {
                            ?>
                            <form action="index.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo "$row[id]"; ?>">
                                <div class="mb-3">
                                    <label class="form-label">Username</label>
                                    <input type="text" class="form-control" value="<?php echo "$row[name]"; ?>" name="name"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email address</label>
                                    <input type="email" class="form-control" value="<?php echo "$row[email]"; ?>" name="email"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" value="<?php echo "$row[password]"; ?>"
                                        name="password" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Role</label>
                                    <select class="form-control" name="role">
                                        <option value="Admin" <?php if ($row["role"] == "admin") {
                                            echo "selected";
                                        } ?>>Admin</option>
                                        <option value="User" <?php if ($row["role"] == "user") {
                                            echo "selected";
                                        } ?>>User</option>
                                    </select>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" name="update" class="btn btn-primary">Update</button>
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