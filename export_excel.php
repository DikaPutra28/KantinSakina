<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include "Database/connect.php";
require 'vendor/autoload.php';



// Query data dari database (samakan dengan laporan.php)
$sql = "SELECT *, SUM(harga*jumlah) AS harganya FROM tb_order
                                    LEFT JOIN user ON user.id = tb_order.kasir
                                    LEFT JOIN tb_list_order ON tb_list_order.kode_order = tb_order.id_order
                                    LEFT JOIN tb_menu ON tb_menu.id = tb_list_order.menu
                                    LEFT JOIN tb_bayar ON tb_bayar.id_bayar = tb_list_order.kode_order
                                    GROUP BY tb_order.id_order ORDER BY tb_order.nama_kios DESC";
$result = $conn->query($sql);

// Hitung total penjualan
$total = 0;
$data = [];
while ($row = $result->fetch_assoc()) {
    $total += $row['harganya'];
    $data[] = $row;
}

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Header
$sheet->setCellValue('A1', 'No');
$sheet->setCellValue('B1', 'Kode Order');
$sheet->setCellValue('C1', 'Pelanggan');
$sheet->setCellValue('D1', 'Meja');
$sheet->setCellValue('E1', 'Total Harga');
$sheet->setCellValue('F1', 'Kasir');
$sheet->setCellValue('G1', 'Status');
$sheet->setCellValue('H1', 'Waktu Order');
$sheet->setCellValue('I1', 'Nama Toko');

$rowNum = 2;
$id_nomor = 1;
foreach ($data as $row) {
    $sheet->setCellValue('A' . $rowNum, $id_nomor++);
    $sheet->setCellValue('B' . $rowNum, $row['id_order']);
    $sheet->setCellValue('C' . $rowNum, $row['pelanggan']);
    $sheet->setCellValue('D' . $rowNum, $row['meja']);
    $sheet->setCellValue('E' . $rowNum, $row['harganya']);
    $sheet->setCellValue('F' . $rowNum, $row['username']);
    $sheet->setCellValue('G' . $rowNum, !empty($row['id_bayar']) ? 'Dibayar' : 'Belum Dibayar');
    $sheet->setCellValue('H' . $rowNum, $row['waktu_order']);
    $sheet->setCellValue('I' . $rowNum, $row['nama_kios']);
    $rowNum++;
}
// Total Penjualan
$sheet->setCellValue('D' . $rowNum, 'Total Penjualan');
$sheet->setCellValue('E' . $rowNum, $total);

// Set header untuk download file excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="laporan_pembayaran.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>