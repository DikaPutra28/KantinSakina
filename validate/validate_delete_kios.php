<?php
session_start();

include("../Database/connect.php");
$id = (isset($_POST["id"])) ? htmlentities($_POST["id"]) : "";



if (isset($_POST['input_kios_delete'])) {
      $query = mysqli_query($conn, "DELETE FROM tb_kios WHERE id = '$id'");
        if ($query) {
                echo "<script>alert('User berhasil Di Hapus'); window.location.href='../kios';</script>";
        } else {
                echo "<script>alert('Gagal Menghapus user'); window.location.href='../kios';</script>";
        }
}   
?>