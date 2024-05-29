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
          <h1 class="m-0 fw-bold">Dashboard</h1>
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
        <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>150</h3>

              <p>New Orders</p>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>

              <p>Bounce Rate</p>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>44</h3>

              <p>User Registrations</p>
            </div>
          </div>
        </div>

        <!-- form Start -->
        <?php
        if ($role == "Super-Admin") {
          ?>
          <div class="container-fluid">
            <form action="index1.php" method="post" enctype="multipart/form-data">
              <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" name="name" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Role</label>
                <select class="form-control" name="role">
                  <option selected value="Admin">Admin</option>
                  <option value="Super-Admin">Super-Admin</option>
                </select>
              </div>
              <div class="d-flex justify-content-end">
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-danger" style="margin-left: 5px;">Reset</button>
              </div>
            </form>
          </div>
          <?php
        }
        ?>
        <!-- form end -->

        <!-- table start -->
        <div class="container-fluid mt-4">
          <table class="table table-dark table-striped">
            <thead class="text-center">
              <tr>
                <th scope="col">NUMBER</th>
                <th scope="col">USERNAME</th>
                <th scope="col">EMAIL</th>
                <th scope="col">ROLE</th>
                <?php
                if ($role == "Super-Admin") {
                  ?>
                  <th scope="col">ACTION'S</th>
                  <?php
                }
                ?>
              </tr>
            </thead>
            <tbody class="text-center">
              <?php
              $conn = mysqli_connect("localhost", "root", "", "admin_project");
              $sql = "SELECT * FROM `admin_table`";
              $result = mysqli_query($conn, $sql);
              $i = 0;
              if (mysqli_num_rows($result) > 0) {
                foreach ($result as $row) {
                  $i += 1;
                  ?>

                  <tr>
                    <th scope="row"><?php echo $i; ?></th>
                    <td><?php echo $row["name"]; ?></td>
                    <td><?php echo $row["email"]; ?></td>
                    <td><?php echo $row["role"]; ?></td>
                    <?php
                    if ($role == "Super-Admin") {
                      ?>
                      <td class="d-flex justify-content-center">
                        <a href="<?php echo "update.php?id=$row[id]" ?>" class='btn btn-primary' style="margin-right:5px;">
                          <i class="fa-regular fa-pen-to-square"></i>
                        </a>
                        <form action="index1.php" method="POST">
                          <input type="hidden" name="del_id" value="<?php echo "$row[id]"; ?>">
                          <button type="submit" name="delete" class="btn btn-danger">
                            <i class="fa-solid fa-trash"></i>
                          </button>
                        </form>
                      </td>
                      <?php
                    }
                    ?>

                  </tr>

                  <?php
                }
              }
              ?>
            </tbody>
          </table>
        </div>
        <!-- table end -->

      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- main content end -->

<?php include ("footer.php"); ?>