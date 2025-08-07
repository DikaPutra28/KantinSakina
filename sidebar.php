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
            <a class="nav-link" href="home">
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
                        <a class="collapse-item " href="menu">Menu</a>
                        <a class="collapse-item " href="order">Order</a>
                  </div>
            </div>
      </li>
      <?php
      if ($hasil['level'] == 1) {
            ?>
            <li class="nav-item">
                  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSettings"
                        aria-expanded="true" aria-controls="collapseSettings">
                        <i class="bi bi-people-fill"></i>
                        <span>Settings</span>
                  </a>
                  <div id="collapseSettings" class="collapse" aria-labelledby="headingSettings"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                              <h6 class="collapse-header">Pilihan</h6>
                              <a class="collapse-item" href="user">User</a>
                              <a class="collapse-item" href="kios">Kios</a>
                        </div>
                  </div>
            </li>
            <?php
      }
      ?>
      <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReport"
                  aria-expanded="true" aria-controls="collapseReport">
                  <i class="bi bi-file-earmark-text"></i>
                  <span>Report</span>
            </a>
            <div id="collapseReport" class="collapse" aria-labelledby="headingReport" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="laporan">Laporan</a>
                        <a class="collapse-item" href="history">History</a>
                  </div>
            </div>
      </li>




      <!-- Divider -->
      <hr class="sidebar-divider">








      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

      <!-- Sidebar Message -->


      
</ul>
<!-- End of Sidebar -->