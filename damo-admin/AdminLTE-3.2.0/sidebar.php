<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
      style="opacity: .8">
    <span class="brand-text font-weight-light">Admin panel</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Admin</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <?php
        $role = $_SESSION["role"];
        if ($role == "Admin") {
          ?>
          <li class="nav-item menu-open">
            <a href="./index1.php" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="category.php" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Category's
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="sub-category.php" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Sub-Category's
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="product.php" class="nav-link">
              <i class="nav-icon fa-solid fa-cart-plus"></i>
              <p>
                Product's
              </p>
            </a>
          </li>
          <?php
        }
        ?>


        <?php
        $role = $_SESSION["role"];
        if ($role == "Super-Admin") {
          ?>
          <li class="nav-item menu-open">
            <a href="./index1.php" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="category.php" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Category's
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="sub-category.php" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Sub-Category's
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="product.php" class="nav-link">
              <i class="nav-icon fa-solid fa-cart-plus"></i>
              <p>
                Product's
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="seo.php" class="nav-link">
              <i class="nav-icon fa-solid fa-screwdriver-wrench"></i>
              <p>
                SEO Tools
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="slider.php" class="nav-link">
              <i class="nav-icon fa-solid fa-sliders"></i>
              <p>
                Slider
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa-solid fa-gear"></i>
              <p>
                Page Settings
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="logo.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Logo</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="contact.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Contact</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="social.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Social Links</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa-solid fa-otter"></i>
              <p>
                others
              </p>
            </a>
          </li>

          <?php
        }
        ?>
      <li class="nav-item mt-3">
        <a href="logout.php" class="nav-link btn">
          <i class="fa-solid fa-right-from-bracket"></i>
          <p>
            Logout
          </p>
        </a>
      </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>