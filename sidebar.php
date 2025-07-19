<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark  accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home">
            <div class="sidebar-brand-icon rotate-n-15">
                  <i class="bi bi-fork-knife"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Sakina Kantin <sup>Beta</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
            <a class="nav-link <?php echo (isset($_GET['x']) && $_GET['x'] == 'home') ?>" href="home">
                  <i class="fas fa-fw fa-tachometer-alt"></i>
                  <span>Home</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
            Menu Kasir
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOrder"
                  aria-expanded="true" aria-controls="collapseOrder">
                  <i class="bi bi-cart4"></i>
                  <span>Order</span>
            </a>
            <div id="collapseOrder" class="collapse" aria-labelledby="headingOrder" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Pilihan</h6>
                        <a class="nav-link collapse-item <?php echo (isset($_GET['x']) && $_GET['x'] == 'makanan') ?>"
                              href="makanan">Makanan</a>
                        <a class="nav-link collapse-item <?php echo (isset($_GET['x']) && $_GET['x'] == 'minuman') ?> "
                              href="minuman">Minuman</a>
                  </div>
            </div>
      </li>
      <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCustomer"
                  aria-expanded="true" aria-controls="collapseCustomer">
                  <i class="bi bi-people-fill"></i>
                  <span>Customer</span>
            </a>
            <div id="collapseCustomer" class="collapse" aria-labelledby="headingCustomer"
                  data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="buttons.html">Buttons</a>
                        <a class="collapse-item" href="cards.html">Cards</a>
                  </div>
            </div>
      </li>
      <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProduct"
                  aria-expanded="true" aria-controls="collapseProduct">
                  <i class="bi bi-box"></i>
                  <span>Product</span>
            </a>
            <div id="collapseProduct" class="collapse" aria-labelledby="headingProduct" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="buttons.html">Buttons</a>
                        <a class="collapse-item" href="cards.html">Cards</a>
                  </div>
            </div>
      </li>
      <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReport"
                  aria-expanded="true" aria-controls="collapseReport">
                  <i class="bi bi-file-earmark-text"></i>
                  <span>Report</span>
            </a>
            <div id="collapseReport" class="collapse" aria-labelledby="headingReport" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="buttons.html">Buttons</a>
                        <a class="collapse-item" href="cards.html">Cards</a>
                  </div>
            </div>
      </li>




      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
            Addons
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                  aria-expanded="true" aria-controls="collapsePages">
                  <i class="fas fa-fw fa-folder"></i>
                  <span>Pages</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.html">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a>
                  </div>
            </div>
      </li>

      <!-- Nav Item - Charts -->
      <li class="nav-item">
            <a class="nav-link" href="charts.html">
                  <i class="fas fa-fw fa-chart-area"></i>
                  <span>Charts</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
            <a class="nav-link" href="tables.html">
                  <i class="fas fa-fw fa-table"></i>
                  <span>Tables</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

      <!-- Sidebar Message -->
      <div class="sidebar-card d-none d-lg-flex">
            <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
            <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components,
                  and more!</p>
            <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to
                  Pro!</a>
      </div>

      <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
      </button>
</ul>
<!-- End of Sidebar -->