<?php
session_start();

include("../Database/connect.php");
$id_order = (isset($_POST["id_order"])) ? htmlentities($_POST["id_order"]) : "";



if (isset($_POST['input_order_delete'])) {
        $select_query = mysqli_query($conn, "SELECT order FROM tb_order_item WHERE order = '$id_order'");
        
        $query = mysqli_query($conn, "DELETE FROM tb_order WHERE id_order = '$id_order'");
        if ($query) {
                echo "<script>alert('Order berhasil Di Hapus'); window.location.href='../order';</script>";
        } else {
                // Check if there are items associated with the order
                if (mysqli_num_rows($select_query) > 0) {
                        echo "<script>alert('Gagal menghapus order karena masih ada item terkait'); window.location.href='../order';</script>";
                } else {
                        // If no items, proceed with deletion
                        echo "<script>alert('Order berhasil dihapus'); window.location.href='../order';</script>";
                }
        }

}
