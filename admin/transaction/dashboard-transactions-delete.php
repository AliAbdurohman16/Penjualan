<?php 

$id = $_GET["id"];

if (hapusTransaction($id) > 0) {
    echo "<script>
            alert('Transaksi Berhasil Dihapus');
            document.location.href = '?page=galleries';
        </script>";
} else {
    echo "<script>
            alert('Transaksi Gagal Dihapus');
            document.location.href = '?page=galleries';
        </script>";
}

?>