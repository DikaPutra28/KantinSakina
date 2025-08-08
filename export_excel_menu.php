<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include "Database/connect.php";
require 'vendor/autoload.php';



// Query data dari database (samakan dengan laporan.php)
$sql = "SELECT tb_order.waktu_order,tb_menu.nama,sum(tb_list_order.jumlah) AS Total_Terjual,tb_menu.harga AS harga_satuan, SUM(tb_list_order.jumlah)*tb_menu.harga as Total_harga,tb_menu.nama_toko FROM tb_order
                                    LEFT JOIN user ON user.id = tb_order.kasir
                                    LEFT JOIN tb_list_order ON tb_list_order.kode_order = tb_order.id_order
                                    LEFT JOIN tb_menu ON tb_menu.id = tb_list_order.menu
                                    LEFT JOIN tb_bayar ON tb_bayar.id_bayar = tb_list_order.kode_order
                                    GROUP BY tb_menu.nama ORDER BY tb_menu.nama ASC";
$result = $conn->query($sql);

// Hitung total penjualan

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Header
$sheet->setCellValue('A1', 'No');
$sheet->setCellValue('B1', 'Waktu Order');
$sheet->setCellValue('C1', 'Nama Menu');
$sheet->setCellValue('D1', 'Total Item Terjual');
$sheet->setCellValue('E1', 'Harga Satuan');
$sheet->setCellValue('F1', 'Total');
$sheet->setCellValue('G1', 'Nama Toko');


$rowNum = 2;
$id_nomor = 1;
foreach ($data as $row) {
    $sheet->setCellValue('A' . $rowNum, $id_nomor++);
    $sheet->setCellValue('B' . $rowNum, $row['waktu_order']);
    $sheet->setCellValue('C' . $rowNum, $row['nama']);
    $sheet->setCellValue('D' . $rowNum, $row['Total_Terjual']);
    $sheet->setCellValue('E' . $rowNum, $row['harga_satuan']);
    $sheet->setCellValue('F' . $rowNum, $row['Total_harga']);
    $sheet->setCellValue('G' . $rowNum, $row['nama_toko']);
    $rowNum++;
}


// Total Penjualan


// Set header untuk download file excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="laporan_penjualan.xlsx"');
header('Cache-Control: max-age=0');

// Tulis ke output
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>