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
                if (isset($_GET['x']) && $_GET['x'] == 'Home') {
                    include "home.php";
                } elseif (isset($_GET['x']) && $_GET['x'] == 'makanan') {
                    include "makanan.php";
                } elseif (isset($_GET['x']) && $_GET['x'] == 'minuman') {
                    include "minuman.php";
                }
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