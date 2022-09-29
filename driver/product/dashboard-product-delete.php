<?php

$id = $_GET["id"];

if (hapusProduk($id) > 0) {
    echo "<script>
            alert('Produk Berhasil Dihapus');
            document.location.href = '?page=products';
        </script>";
} else {
    echo "<script>
            alert('Produk Gagal Dihapus');
            document.location.href = '?page=products';
        </script>";

}

?>