<?php
session_start();
include ("data.php");
include ("header.php");
include ("navbar.php");
include ("sidebar.php");
?>

<!-- main content start -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">SOCIAL LINKS</h1>
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

                <!-- Table Start -->
                <div class="container-fluid">
                    <table class="table text-center fw-bold table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">SNO</th>
                                <th scope="col">SOCIAL MEDIA</th>
                                <th width="50%" scope="col">PROFILE LINK</th>
                                <th scope="col">STATUS</th>
                                <th scope="col">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                $conn = mysqli_connect("localhost", "root", "", "admin_project");
                                $sql = "SELECT * FROM `social` WHERE `id`=1";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <th scope="row"><?php echo $row["id"]; ?></th>
                                    <td><i class="fa-brands fa-facebook" style="font-size:40px;"></i></td>
                                    <td><?php echo $row["link"]; ?></td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" <?php if($row["status"] == '1'){echo "checked";}?> onclick="toggleStatus(<?php echo $row['id'];?>)" type="checkbox" id="ckeck">
                                        </div>
                                    </td>
                                    <td><a href="<?php echo "social_edit.php?id=$row[id]" ?>" class='btn btn-primary'
                                            style="margin-right:5px;">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a></td>
                                    <?php
                                }
                                ?>
                            </tr>
                            <tr>
                                <?php
                                $conn = mysqli_connect("localhost", "root", "", "admin_project");
                                $sql = "SELECT * FROM `social` WHERE `id`=2";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <th scope="row"><?php echo $row["id"]; ?></th>
                                    <td><i class="fa-brands fa-instagram" style="font-size:40px;"></i></td>
                                    <td><?php echo $row["link"]; ?></td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" <?php if($row["status"] == '1'){echo "checked";}?> onclick="toggleStatus(<?php echo $row['id'];?>)" type="checkbox" id="ckeck">
                                        </div>
                                    </td>
                                    <td><a href="<?php echo "social_edit.php?id=$row[id]" ?>" class='btn btn-primary'
                                            style="margin-right:5px;">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a></td>
                                    <?php
                                }
                                ?>
                            </tr>
                            <tr>
                                <?php
                                $conn = mysqli_connect("localhost", "root", "", "admin_project");
                                $sql = "SELECT * FROM `social` WHERE `id`=3";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <th scope="row"><?php echo $row["id"]; ?></th>
                                    <td><i class="fa-brands fa-linkedin" style="font-size:40px;"></i></td>
                                    <td><?php echo $row["link"]; ?></td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" <?php if($row["status"] == '1'){echo "checked";}?> onclick="toggleStatus(<?php echo $row['id'];?>)" type="checkbox" id="ckeck">
                                        </div>
                                    </td>
                                    <td><a href="<?php echo "social_edit.php?id=$row[id]" ?>" class='btn btn-primary'
                                            style="margin-right:5px;">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a></td>
                                    <?php
                                }
                                ?>
                            </tr>
                            <tr>
                                <?php
                                $conn = mysqli_connect("localhost", "root", "", "admin_project");
                                $sql = "SELECT * FROM `social` WHERE `id`=4";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <th scope="row"><?php echo $row["id"]; ?></th>
                                    <td><i class="fa-brands fa-square-x-twitter" style="font-size:40px;"></i></td>
                                    <td><?php echo $row["link"]; ?></td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" <?php if($row["status"] == '1'){echo "checked";}?> onclick="toggleStatus(<?php echo $row['id'];?>)" type="checkbox" id="ckeck">
                                        </div>
                                    </td>
                                    <td><a href="<?php echo "social_edit.php?id=$row[id]" ?>" class='btn btn-primary'
                                            style="margin-right:5px;">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a></td>
                                    <?php
                                }
                                ?>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <!-- Table end -->

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- main content end -->

<?php include ("footer.php"); ?>

<script>
    function toggleStatus(id){
    var id = id;
    $.ajax({
        url : "active.php",
        type : "POST",
        data : {id : id},
        success :function(result){
            if(result == '1'){
                alert('Update Successfuly On');
            }else{
                alert('Update Successfuly Off');
            }
        }
    });
}
</script>