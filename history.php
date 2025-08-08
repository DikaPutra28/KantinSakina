<?php
include "Database/connect.php";
date_default_timezone_set("Asia/Jakarta");

// Inisialisasi variabel
$where_clause = "";
$start_date = "";
$end_date = "";

// Periksa apakah tanggal filter telah dikirimkan


// Buat query utama




// Pastikan query berjalan dengan benar

$query2 = mysqli_query($conn, "select * from tb_kios");

// var_dump($result);
// exit();
while ($record2 = mysqli_fetch_array($query2)) {
    $result2[] = $record2;
}





?>



<!-- Conten -->
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <i class="bi bi-fork-knife"></i>
            Laporan
        </div>
        <div class="card-body">
            <div>
                <form method="POST">
                    <div class="row g-3 mb-3">
                        <div class="col-md-3">
                            <label for="start_date" class="form-label">Tanggal Mulai</label>
                            <input type="date" class="form-control" name="start_date">
                        </div>
                        <div class="col-md-3">
                            <label for="end_date" class="form-label">Tanggal Selesai</label>
                            <input type="date" class="form-control" name="end_date">
                        </div>
                        <div class="col-md-3">
                            <label for="kios_filter" class="form-label">Nama Kios</label>
                            <select class="form-select" aria-label="Default select example" name="kios_filter">
                                <option selected hidden value="">Pilih Kios User</option>
                                <?php
                                foreach ($result2 as $row2) {
                                ?>
                                    <option value="<?php echo $row2['nama'] ?>"><?php echo $row2['nama'] ?></option>
                                <?php
                                }
                                ?>
                                <option value="all">all</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary" name="filter" value="filter">Filter</button>
                        </div>
                        <div>

                        </div>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col">

                    <?php
                    // Jika filter diterapkan, tampilkan tanggal yang dipilih
                    if (isset($_POST['filter']) && isset($_POST['kios_filter']) && $_POST['kios_filter'] == 'all') {
                        $query_string = "SELECT *, SUM(harga*jumlah) AS harganya FROM tb_order
                                    LEFT JOIN user ON user.id = tb_order.kasir
                                    LEFT JOIN tb_list_order ON tb_list_order.kode_order = tb_order.id_order
                                    LEFT JOIN tb_menu ON tb_menu.id = tb_list_order.menu
                                    LEFT JOIN tb_bayar ON tb_bayar.id_bayar = tb_list_order.kode_order
                                    GROUP BY tb_order.id_order ORDER BY tb_order.nama_kios DESC";
                    } else if (isset($_POST['filter'])) {

                        $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
                        $end_date = mysqli_real_escape_string($conn, $_POST['end_date']);
                        $kios_filter = mysqli_real_escape_string($conn, $_POST['kios_filter']);
                        $start_date_with_time = $start_date . " 00:00:00";
                        $end_date_with_time = $end_date . " 23:59:59";

                        $query_string = "SELECT tb_order.waktu_order,tb_menu.nama,sum(tb_list_order.jumlah) AS Total_Terjual,tb_menu.harga AS harga_satuan, SUM(tb_list_order.jumlah)*tb_menu.harga as Total_harga,tb_menu.nama_toko FROM tb_order
                                    LEFT JOIN user ON user.id = tb_order.kasir
                                    LEFT JOIN tb_list_order ON tb_list_order.kode_order = tb_order.id_order
                                    LEFT JOIN tb_menu ON tb_menu.id = tb_list_order.menu
                                    LEFT JOIN tb_bayar ON tb_bayar.id_bayar = tb_list_order.kode_order
                                    WHERE tb_order.nama_kios = '$kios_filter' AND tb_order.waktu_order BETWEEN '$start_date_with_time' AND '$end_date_with_time'
                                    GROUP BY tb_menu.nama ORDER BY tb_menu.nama ASC";
                    } else {

                        // Query untuk mendapatkan data laporan
                        $query_string = "SELECT tb_order.waktu_order,tb_menu.nama,sum(tb_list_order.jumlah) AS Total_Terjual,tb_menu.harga AS harga_satuan, SUM(tb_list_order.jumlah)*tb_menu.harga as Total_harga,tb_menu.nama_toko FROM tb_order
                                    LEFT JOIN user ON user.id = tb_order.kasir
                                    LEFT JOIN tb_list_order ON tb_list_order.kode_order = tb_order.id_order
                                    LEFT JOIN tb_menu ON tb_menu.id = tb_list_order.menu
                                    LEFT JOIN tb_bayar ON tb_bayar.id_bayar = tb_list_order.kode_order
                                    GROUP BY tb_menu.nama ORDER BY tb_menu.nama ASC";
                    }
                    $query = mysqli_query($conn, $query_string);
                    if (!$query) {
                        die("Query Error: " . mysqli_error($conn));
                    }

                    $result = [];
                    while ($record = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                        $result[] = $record;
                    }

                    ?>

                    <table class="table table-hover" id="table_laporan">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Waktu Order</th>
                                <th scope="col">Nama Menu</th>
                                <th scope="col">Total Item Terjual</th>
                                <th scope="col">Harga Satuan</th>
                                <th scope="col">Total</th>
                                <th scope="col">Nama Toko</th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $id_nomor = 1;
                            foreach ($result as $row) {
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $id_nomor++ ?></th>
                                    <td><?php echo $row['waktu_order'] ?></td>
                                    <td><?php echo $row['nama'] ?></td>
                                    <td><?php echo $row['Total_Terjual'] ?></td>
                                    <td><?php echo number_format($row['harga_satuan'], 0, ',', '.') ?></td>
                                    <td><?php echo number_format($row['Total_harga'], 0, ',', '.') ?></td>
                                    <td><?php echo $row['nama_toko'] ?></td>

                                </tr>
                            <?php
                            }
                            ?>
                            <!-- <tr>
                                <td class="fw-bold" colspan="4">
                                    Total Penjualan
                                </td>
                                <td class="fw-bold">
                                    <?php
                                    $total = 0;
                                    foreach ($result as $row) {
                                        $total += $row['harganya'];
                                    }
                                    echo number_format($total, 0, ',', '.');
                                    ?>
                                </td>
                            </tr> -->
                        </tbody>
                    </table>
                    <div class="mb-3">
                        <form method="POST" action="export_excel_menu.php" target="_blank">
                            <input type="hidden" name="start_date" value="<?php echo htmlspecialchars($start_date); ?>">
                            <input type="hidden" name="end_date" value="<?php echo htmlspecialchars($end_date); ?>">
                            <input type="hidden" name="kios_filter" value="<?php echo isset($_POST['kios_filter']) ? htmlspecialchars($_POST['kios_filter']) : ''; ?>">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-file-earmark-excel"></i> Cetak All Data Excel
                            </button>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>



    <script>
        let table = new DataTable('#table_laporan');
    </script>