<?php
session_start();
include ("data.php");
include ("header.php");
include ("navbar.php");
include ("sidebar.php");
?>

<?php

if(isset($_POST['row_submit']))
{
    $random = rand(1,99999);
    $image = $random."-".$_FILES['image']['name'];
    $target = "all-image/slider/".basename($image);
    $title = $_POST['title'];


    $sql = "INSERT INTO `slider`(`title`, `image`, `date`) VALUES ('$title','$image', current_timestamp())";

    mysqli_query($conn,$sql);


    if(move_uploaded_file($_FILES['image']['tmp_name'],$target))
    {
        echo "<script>
        alert('Successful');
        window.location.href = 'slider.php';
        </script>";
    }
    else
    {
        echo "<script>
        alert('Inset Error');
        window.location.href = 'slider.php';
        </script>";

    }

}

if (isset($_POST["slider_delete"])) 
{
    $id = $_POST['del_id'];
    $image = $_POST['del_image'];

    $sql = "DELETE FROM `slider` WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    if($result){
        unlink("all-image/slider/" . $image);
        echo "<script>
        alert('Deleted Successful');
        window.location.href = 'slider.php';
        </script>";
    }else{
        echo "<script>
        alert('Deleted Error');
        window.location.href = 'slider.php';
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
                    <h1 class="m-0">ADD SLIDER</h1>
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

                <div class="container-fluid bg-white rounded">
                    <form action="slider.php" method="post" enctype="multipart/form-data" class="my-3">
                        <input type="hidden" name="id">
                        <div class="mb-3">
                            <label class="form-label">Slider Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Slider Title" required>
                        </div>
                        <div class="mb-3">
                            <label for="formFileMultiple" class="form-label">Slider Image</label>
                            <input class="form-control" name="image" type="file" required>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" name="row_submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-danger" style="margin-left: 5px;">Reset</button>
                        </div>
                    </form>
                </div>

                <!-- form end -->

                <!-- Table Start -->
                <div class="container-fluid mt-5">
                    <h4 class="fw-bold mb-3">Slider Ditails</h4>
                    <table class="table table-success table-striped text-center">
                        <thead>
                            <tr>
                                <th scope="col">NO</th>
                                <th scope="col">Slider Title</th>
                                <th scope="col">Slider Image</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $conn = mysqli_connect("localhost", "root", "", "admin_project");
                            $sql = "SELECT * FROM `slider`";
                            $result = mysqli_query($conn, $sql);
                            $i = 0;
                            while ($row = mysqli_fetch_assoc($result)) {
                                $i += 1;
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $i; ?></th>
                                    <td><?php echo $row["title"]; ?></td>
                                    <td><img src="<?php echo "all-image/slider/".$row["image"]; ?>" width="150px"></td>
                                    <td>
                                        <a href="<?php echo "slider_edit.php?id=$row[id]" ?>" class="btn btn-primary">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="slider.php" method="POST">
                                            <input type="hidden" name="del_id" value="<?php echo $row["id"]; ?>">
                                            <input type="hidden" name="del_image" value="<?php echo $row["image"]; ?>">
                                            <button type="submit" name="slider_delete" class="btn btn-danger mt-3"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- Table End -->

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- main content end -->

<?php include ("footer.php"); ?>