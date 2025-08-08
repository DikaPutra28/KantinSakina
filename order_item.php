<?php
include "Database/connect.php";

$query = mysqli_query($conn, "SELECT *, SUM(harga*jumlah) AS harganya from tb_list_order
LEFT JOIN tb_order ON tb_order.id_order = tb_list_order.kode_order
LEFT JOIN tb_menu ON tb_menu.id = tb_list_order.menu
LEFT JOIN tb_bayar ON tb_bayar.id_bayar = tb_list_order.kode_order
GROUP BY tb_list_order.id_list_order
HAVING tb_list_order.kode_order = $_GET[kode_order]");
$kode = $_GET['kode_order'];
$meja = $_GET['meja'];
$customer = $_GET['pelanggan'];
$toko = $_GET['kios'];
$waktu_order = $GET['waktu_order'] ?? date('Y-m-d H:i:s');
$set_menu = mysqli_query($conn, "SELECT id,nama FROM tb_menu where nama_toko = '$toko'");
$query2 = mysqli_query($conn, "select * from tb_kios");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
    // $kode = $record['id_order'];
    // $meja = $record['meja'];
    // $customer = $record['pelanggan'];
    // $toko = $record['nama_toko'];
}

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
            Setingan User
        </div>
        <div class="card-body-scrollable">
            <a href="order" class="btn btn-info mb-3">back</a>
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-floating ">
                        <input disabled type="text" class="form-control" id="id_order"
                            value="<?php echo $kode ?>" name="id_order">
                        <label for="floatingInputGambar">Kode Order</label>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-floating ">
                        <input disabled type="text" class="form-control" id="meja"
                            value="<?php echo $meja ?>" name="meja">
                        <label for="floatingInputGambar">Nomor Meja</label>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-floating ">
                        <input disabled type="text" class="form-control" id="pelanggan"
                            value="<?php echo $customer ?>" name="pelanggan">
                        <label for="floatingInputGambar">Pelanggan</label>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-floating ">
                        <input disabled type="text" class="form-control" id="toko"
                            value="<?php echo $toko ?>" name="toko">
                        <label for="floatingInputGambar">Nama Kios</label>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col">
                    <!-- <div class="col d-flex justify-content-end">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalTambah">Tambah Menu</button>
                    </div> -->
                </div>
                <div class="row mt-3">
                    <!-- Modal tambah item -->
                    <div class="modal fade" id="tambahItem" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Makanan Dan Minuman</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="validate/validate_order_item.php" method="post">
                                        <input type="hidden" name="kode_order" value="<?php echo $kode ?>">
                                        <input type="hidden" name="meja" value="<?php echo $meja ?>">
                                        <input type="hidden" name="pelanggan" value="<?php echo $customer ?>">
                                        <input type="hidden" name="kios" value="<?php echo $toko ?>">
                                        <div class="row mt-3">
                                            <div class="col-lg-6">
                                                <div class="form-floating mb-3">
                                                    <select class="form-select" name="menu" id="">
                                                        <option selected hidden value="">Pilih Menu</option>
                                                        <?php
                                                        foreach ($set_menu as $value) {
                                                        ?>
                                                            <option value="<?php echo $value['id'] ?>"><?php echo $value['nama'] ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <label for="menu">Menu Makanan/Minuman</label>
                                                    <div class="invalid-feedback">
                                                        Pilih Menu
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-floating">
                                                    <input type="number" class="form-control" id="floatingJumlah" placeholder="Masukan Jumlah" name="jumlah" required>
                                                    <label for="floatingJumlah">Jumlah Porsi</label>
                                                    <div class="invalid-feedback">
                                                        Jumlah tidak boleh kosong
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="catatan_order" placeholder="Masukan Keterangan" name="catatan_order">
                                                    <label for="catatan_order">Catatan</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="input_order_item_proses">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal bayar -->
                    <!-- <div class="modal fade" id="bayar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Makanan Dan Minuman</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="validate/validate_menu_edit.php" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                        <div class="row mt-3">
                                            <div class="col lg-12">
                                                <div class="input-group">
                                                    <input type="file" class="form-control py-9" id="floatingInputGambar" placeholder="Masukan Gambar" name="foto" required>
                                                    <label class="input-group-text" for="floatingInputGambar">Upload Foto Menu</label>
                                                    <div class="invalid-feedback">
                                                        Gambar tidak boleh kosong
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="floatingNama" placeholder="Masukan Nama" name="nama_menu" value="<?php echo $row['nama'] ?>" required>
                                                    <label for="floatingNama">Nama Makanan</label>
                                                    <div class="invalid-feedback">
                                                        Nama tidak boleh kosong
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="floatingKeterangan" placeholder="Masukan Keterangan" name="keterangan" value="<?php echo $row['keterangan'] ?>">
                                                    <label for="floatingKeterangan">Keterangan</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col lg-4">
                                                <div class="form-floating mt-3">
                                                    <select class="form-select" aria-label="Default select example" name="kategori_menu" required>
                                                        <option selected hidden value="">Pilih Jenis Menu</option>
                                                        <?php
                                                        foreach ($sel_kategori as $row2) {
                                                            if ($row['kategori'] == $row2['id_kategori']) {
                                                                echo "<option selected value='" . $row2['id_kategori'] . "'>" . $row2['kategori_menu'] . "</option>";
                                                            } else {
                                                                echo "<option value='" . $row2['id_kategori'] . "'>" . $row2['kategori_menu'] . "</option>";
                                                            }
                                                        ?>

                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <label for="floatingKategori">Kategori Menu</label>
                                                    <div class="invalid-feedback">
                                                        Jenis Menu tidak boleh kosong
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col lg-4">
                                                <div class="form-floating mt-3">
                                                    <input type="number" class="form-control" id="floatingHarga" placeholder="Masukan Harga" name="harga" value="<?php echo $row['harga'] ?>" required>
                                                    <label for="floatingHarga">Harga</label>
                                                    <div class="invalid-feedback">
                                                        Harga tidak boleh kosong
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col lg-4">
                                                <div class="form-floating mt-3">
                                                    <input type="number" class="form-control" id="floatingStok" placeholder="Masukan Stok" name="stok" value="<?php echo $row['stok'] ?>" required>
                                                    <label for="floatingStok">Stok</label>
                                                    <div class="invalid-feedback">
                                                        Stok tidak boleh kosong
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col">
                                                <div class="form-floating mt-3">
                                                    <select class="form-select" aria-label="Default select example" name="kios" required>
                                                        <option selected hidden value="">Pilih Kios User</option>
                                                        <?php
                                                        foreach ($result2 as $row2) {
                                                        ?>
                                                            <option value="<?php echo $row2['nama'] ?>" <?php echo ($row['nama_toko'] == $row2['nama']) ? 'selected' : ''; ?>><?php echo $row2['nama'] ?> </option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <label for="floatingKios">Kios</label>
                                                    <div class="invalid-feedback">
                                                        Kios tidak boleh kosong
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="input_menu_edit_proses">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <?php
                    if (empty($result)) {
                        echo "<div class='alert alert-warning'>Data tidak ditemukan</div>";
                    } else {
                        foreach ($result as $row) {
                    ?>
                            <!-- Modal edit -->
                            <div class="modal fade" id="ModalEdit<?php echo $row['id_list_order'] ?>" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Item</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="needs-validation" novalidate action="validate/validate_edit_order_item.php" method="post">
                                                <input type="hidden" name="id_list_order" value="<?php echo $row['id_list_order'] ?>">
                                                <input type="hidden" name="kode_order" value="<?php echo $kode ?>">
                                                <input type="hidden" name="meja" value="<?php echo $meja ?>">
                                                <input type="hidden" name="pelanggan" value="<?php echo $customer ?>">
                                                <input type="hidden" name="kios" value="<?php echo $toko ?>">
                                                <div class="row mt-3">
                                                    <div class="col-lg-6">
                                                        <div class="form-floating mb-3">
                                                            <select class="form-select" name="menu" id="">
                                                                <option selected hidden value="">Pilih Menu</option>
                                                                <?php
                                                                foreach ($set_menu as $value) {
                                                                    if ($row['menu'] == $value['id']) {
                                                                        echo "<option selected value='" . $value['id'] . "'>" . $value['nama'] . "</option>";
                                                                    } else {
                                                                        echo "<option value='" . $value['id'] . "'>" . $value['nama'] . "</option>";
                                                                    }
                                                                ?>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                            <label for="menu">Menu Makanan/Minuman</label>
                                                            <div class="invalid-feedback">
                                                                Pilih Menu
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-floating">
                                                            <input type="number" class="form-control" id="floatingJumlahEdit" placeholder="Masukan Jumlah" name="jumlah" value="<?php echo $row['jumlah'] ?>" required>
                                                            <label for="floatingJumlahEdit">Jumlah Porsi</label>
                                                            <div class="invalid-feedback">
                                                                Jumlah tidak boleh kosong
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control" id="catatan_order" placeholder="Masukan Keterangan" name="catatan_order" value="<?php echo $row['catatan_order'] ?>">
                                                            <label for="catatan_order_edit">Catatan</label>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary" name="edit_order_item">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <!-- Modal delete -->
                            <div class="modal fade" id="ModalDelete<?php echo $row['id_list_order'] ?>" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Item</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Apakah Anda yakin ingin menghapus item ini?</p>
                                            <form action="validate/validate_delete_order_item.php" method="post">
                                                <input type="hidden" name="id_list_order" value="<?php echo $row['id_list_order'] ?>">
                                                <input type="hidden" name="kode_order" value="<?php echo $kode ?>">
                                                <input type="hidden" name="meja" value="<?php echo $meja ?>">
                                                <input type="hidden" name="pelanggan" value="<?php echo $customer ?>">
                                                <input type="hidden" name="kios" value="<?php echo $toko ?>">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-danger" name="delete_order_item">Hapus</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>




                        <?php
                        }
                        ?>
                        <!-- Modal bayar -->
                        <div class="modal fade" id="bayar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Bayar</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive-lg-12">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Menu</th>
                                                        <th scope="col">Harga</th>
                                                        <th scope="col">Qty</th>
                                                        <th scope="col">Catatan</th>
                                                        <th scope="col">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php

                                                    foreach ($result as $row) {
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $row['nama'] ?></td>
                                                            <td><?php echo number_format($row['harga'], 0, ',', '.') ?></td>
                                                            <td><?php echo $row['jumlah'] ?></td>
                                                            <td><?php echo $row['catatan_order'] ?></td>
                                                            <td><?php echo number_format($row['harganya'], 0, ',', '.') ?></td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td class="fw-bold" colspan="4">
                                                            Total Harga
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
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                        <span class="text-danger fs-h fw-semibold">Apakah anda yakin ingin melakukan pembayaran?</span>
                                        <form class="needs-validation" novalidate action="validate/validate_bayar.php" method="post">
                                            <input type="hidden" name="kode_order" value="<?php echo $kode ?>">
                                            <input type="hidden" name="meja" value="<?php echo $meja ?>">
                                            <input type="hidden" name="pelanggan" value="<?php echo $customer ?>">
                                            <input type="hidden" name="kios" value="<?php echo $toko ?>">
                                            <input type="hidden" name="total_bayar" value="<?php echo $total ?>">
                                            <div class="row mt-3">
                                                <!-- <div class="col-lg-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="total_bayar" placeholder="Total Bayar" name="total_bayar" value="<?php echo number_format($total, 0, ',', '.') ?>" readonly>
                                                        <label for="total_bayar">Total Bayar</label>
                                                    </div>
                                                </div> -->
                                                <div class="col-lg-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="number" class="form-control" id="bayar" value="<?php echo $total ?>" placeholder="<?php echo $total ?>" name="bayar" required>
                                                        <label for="bayar">Jumlah Bayar</label>
                                                        <div class="invalid-feedback">
                                                            Jumlah bayar tidak boleh kosong
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success" name="proses_bayar">Bayar</button>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>



                    <?php
                    }
                    ?>
                    <?php
                    if (empty($result)) {
                    } else {
                    ?>
                        <div class="table-responsive-lg-12">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Menu</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Catatan</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    foreach ($result as $row) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['nama'] ?></td>
                                            <td><?php echo number_format($row['harga'], 0, ',', '.') ?></td>
                                            <td><?php echo $row['jumlah'] ?></td>
                                            <td><?php echo $row['catatan_order'] ?></td>
                                            <td><?php echo number_format($row['harganya'], 0, ',', '.') ?></td>
                                            <td>
                                                <div class="d-flex">
                                                <?php
                                                if ($_SESSION["level_kantin"] == 1) {

                                                ?>
                                                    <button class="btn btn-warning btn-sm me-2"data-bs-toggle="modal" data-bs-target="#ModalEdit<?php echo $row['id_list_order'] ?>"> <i class="bi bi-pencil-fill"></i></button>
                                                    <button class="btn btn-danger btn-sm me-2"data-bs-toggle="modal" data-bs-target="#ModalDelete<?php echo $row['id_list_order'] ?>"> <i class="bi bi-trash-fill"></i></button>
                                                <?php
                                                } else {
                                                ?>
                                                    <button class="<?php echo (!empty($row['id_bayar'])) ? "btn btn-secondary btn-sm me-2 disabled" : "btn btn-warning btn-sm me-2 ";  ?> " data-bs-toggle="modal" data-bs-target="#ModalEdit<?php echo $row['id_list_order'] ?>"> <i class="bi bi-pencil-fill"></i></button>
                                                    <button class="<?php echo (!empty($row['id_bayar'])) ? "btn btn-secondary btn-sm me-2 disabled" : "btn btn-danger btn-sm me-2";  ?> " data-bs-toggle="modal" data-bs-target="#ModalDelete<?php echo $row['id_list_order'] ?>"> <i class="bi bi-trash-fill"></i></button>
                                                <?php
                                                }
                                                ?>
                                                
                                                    
                                                </div>

                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    <tr>
                                        <td class="fw-bold" colspan="4">
                                            Total Harga
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
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    <?php
                    }
                    ?>
                    <div>
                        <?php
                        if ($_SESSION["level_kantin"] == 1) {
                        ?>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahItem"><i class="bi bi-plus-square-dotted"></i> Item</button>
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#bayar"><i class="bi bi-cash-coin"></i> Bayar</button>
                            <button class="btn btn-info" onclick="printStruk()"><i class="bi bi-printer"></i> Print Struk</button>
                        <?php
                        } else {
                            // Cek apakah sudah bayar (id_bayar tidak kosong pada salah satu item)
                            $sudah_bayar = false;
                            if (!empty($result)) {
                                foreach ($result as $row) {
                                    if (!empty($row['id_bayar'])) {
                                        $sudah_bayar = true;
                                        break;
                                    }
                                }
                            }
                        ?>
                            <button class="<?php echo (!empty($row['id_bayar'])) ? "btn btn-secondary disabled" : "btn btn-primary"; ?>" data-bs-toggle="modal" data-bs-target="#tambahItem"><i class="bi bi-plus-square-dotted"></i> Item</button>
                            <button class="<?php echo (!empty($row['id_bayar'])) ? "btn btn-secondary disabled" : "btn btn-success"; ?>" data-bs-toggle="modal" data-bs-target="#bayar"><i class="bi bi-cash-coin"></i> Bayar</button>
                            <button class="btn btn-info<?php echo $sudah_bayar ? '' : ' disabled'; ?>" onclick="if(<?php echo $sudah_bayar ? 'true' : 'false'; ?>) printStruk()"><i class="bi bi-printer"></i> Print Struk</button>
                        <?php
                        }
                        ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="strukContent" style="display: none;">

        <style>
            #struk_body {
                width: 60mm;
                font-family: Arial, sans-serif;
                text-align: left;
                font-size: 12px;
                border: 1px solid black;
                padding: 10px;

            }
            #struk_body h2 {
                text-align: center;
                margin-bottom: 10px;
            }

            #struk_body table {
                width: 50%;
                font-size: 12px;
                text-align: left;
                margin: 0 auto;
                border-collapse: collapse;
            }

            #struk_body table th,
            #struk_body table td {
                border: 1px solid black;
                padding: 5px;
            }

            .logo-struk {
                width: 100px;
                /* Adjust the size as needed */
                height: auto;
            }

           
        </style>

        <div id="struk_body" class="container">
            <img src="assets/img/logosakina.png" alt="Logo Toko" class="logo-struk">
            <h2 class="text-center">Struk Pembayaran</h2>
            waktu order : <?php echo $waktu_order ?>
            <div class="row">
                <div class="col-lg-3">
                    Kode Order: <?php echo $kode;  ?>
                </div>
                <div class="col-lg-3">
                    Meja: <?php echo $meja; ?>
                </div>
                <div class="col-lg-3">
                    Pelanggan: <?php echo $customer; ?>
                </div>
                <div class="col-lg-3">
                    Kios: <?php echo $toko; ?>
                </div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Menu</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($result as $row) {
                        echo "<tr>";
                        echo "<td>" . $row['nama'] . "</td>";
                        echo "<td>" . number_format($row['harga'], 0, ',', '.') . "</td>";
                        echo "<td>" . $row['jumlah'] . "</td>";
                        echo "<td>" . number_format($row['harganya'], 0, ',', '.') . "</td>";
                        echo "<td>" . $row['catatan_order'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <h3>Total: <?php echo number_format($total, 0, ',', '.'); ?></h3>
        </div>
    </div>



    <script>
        function printStruk() {
            var strukContent = document.getElementById("strukContent").innerHTML;
            var printFrame = document.createElement("iframe");
            printFrame.style.display = "none";
            document.body.appendChild(printFrame);
            printFrame.contentDocument.write(strukContent);
            printFrame.contentWindow.print();
        }
    </script>



    <script>
        (() => {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
    <style>
        .logo-struk {
            width: 5px;
            height: auto;
        }
    </style>

    <style>
        /* Include the CSS here or link to an external stylesheet */
        .card {
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 97%;
            /* Example width for the card */
            margin: 20px;
            display: flex;
            flex-direction: column;
        }

        .card-header {
            background-color: #f0f0f0;
            padding: 10px 15px;
            border-bottom: 1px solid #eee;
            font-weight: bold;
        }

        .card-body-scrollable {
            overflow-x: auto;
            /* Adds horizontal scrollbar when content overflows */
            padding: 15px;
            /* white-space: nowrap; /* Uncomment if you want text to stay on one line */
        }

        .long-content {
            min-width: 800px;
            /* Ensure content is wide enough to trigger scroll */
            /* Adjust this value based on your content's natural width */
        }
    </style>