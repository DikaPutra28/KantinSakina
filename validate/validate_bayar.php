
<?php
session_start();



include("../Database/connect.php");
$kodeorder = (isset($_POST["kode_order"])) ? htmlentities($_POST["kode_order"]) : "";
$meja = (isset($_POST["meja"])) ? htmlentities($_POST["meja"]) : "";
$pelanggan = (isset($_POST["pelanggan"])) ? htmlentities($_POST["pelanggan"]) : "";
$catatan_order = (isset($_POST["catatan_order"])) ? htmlentities($_POST["catatan_order"]) : "";
$toko = (isset($_POST["kios"])) ? htmlentities($_POST["kios"]) : "";
$total_bayar = (isset($_POST["total_bayar"])) ? htmlentities($_POST["total_bayar"]) : "";
$bayar = (isset($_POST["bayar"])) ? htmlentities($_POST["bayar"]) : "";

$kembalian = $bayar - $total_bayar;
if (isset($_POST['proses_bayar'])) {
        if ($bayar < $total_bayar) {
                echo "<script>alert('Jumlah bayar tidak cukup'); window.location.href='../?x=orderitem&kode_order=".$kodeorder."&meja=".$meja."&pelanggan=".$pelanggan."&kios=".$toko."';</script>";
                exit();
        } else {
                $query1 = mysqli_query($conn, "INSERT INTO tb_bayar (id_bayar,nominal_uang,jumlah_bayar) VALUES ('$kodeorder', '$bayar', '$total_bayar')");
                $query = mysqli_query($conn, "UPDATE tb_list_order SET status = 'Lunas' WHERE kode_order = '$kodeorder'");
                if ($query1 && $query) {
                        echo "<script>alert('Pembayaran berhasil. Kembalian: Rp. ".number_format($kembalian, 0, ',', '.')."'); window.location.href='../?x=orderitem&kode_order=".$kodeorder."&meja=".$meja."&pelanggan=".$pelanggan."&kios=".$toko."';</script>";
                } else {
                        echo "<script>alert('Gagal memproses pembayaran'); window.location.href='../?x=orderitem&kode_order=".$kodeorder."&meja=".$meja."&pelanggan=".$pelanggan."&kios=".$toko."';</script>";
                }
        }
}

// if (isset($_POST['proses_bayar'])) {
//         $select_query = mysqli_query($conn, "SELECT * FROM tb_list_order WHERE kode_order = '$kodeorder' AND menu = '$menu'");
//         if (mysqli_num_rows($select_query) > 0) {
//                 $message = "<script>alert('Item sudah terdaftar dalam order ini'); window.location.href='../?x=orderitem&kode_order=".$kodeorder."&meja=".$meja."&pelanggan=".$pelanggan."&kios=".$toko."';</script>";
//                 exit();
//         } else {
//                 $query = mysqli_query($conn, "INSERT INTO tb_list_order (kode_order, menu, jumlah, catatan_order) VALUES ('$kodeorder', '$menu', '$jumlah', '$catatan_order')");
//                 if ($query) {
//                         $message =  '<script>
//                         window.location.href="../?x=orderitem&kode_order='.$kodeorder.'&meja='.$meja.'&pelanggan='.$pelanggan.'&kios='.$toko.'";</script>';
//                 } else {
//                         echo "<script>alert('Gagal menambahkan item'); window.location.href='../order';</script>";
//                 }
//         }
        
// }
echo $message;



