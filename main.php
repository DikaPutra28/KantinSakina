<?php
//session_start();
if (empty($_SESSION["username_kantin"])) {
      header('location:login');
}

include "Database/connect.php";
$query = mysqli_query($conn, "select * from user where username = '$_SESSION[username_kantin]'");
$hasil = mysqli_fetch_array($query);
?>
<?php include 'head.php'; ?>


<body id="page-top">

      <!-- Page Wrapper -->
      <div id="wrapper">

            <!-- Sidebar -->
            <?php include 'sidebar.php'; ?>

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                  <!-- Main Content -->
                  <div id="content">

                        <!-- Topbar -->
                        <?php include 'head.php'; ?>
                        <?php include 'navbar.php'; ?>
                        <!-- End of Topbar -->
                        <!-- Conten -->
                        <?php
                        include $page;
                        ?>
                        <!-- Footer -->
                        <footer class="sticky-footer bg-white">
                              <div class="container my-auto">
                                    <div class="copyright text-center my-auto">
                                          <span>Copyright &copy; Your Website 2021</span>
                                    </div>
                              </div>
                        </footer>
                        <!-- End of Footer -->

                  </div>
                  <!-- End of Content Wrapper -->

            </div>
            <!-- End of Page Wrapper -->

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                  <i class="fas fa-angle-up"></i>
            </a>

            <!-- Logout Modal-->


            <?php include 'footerJS.php'; ?>


</body>

</html>