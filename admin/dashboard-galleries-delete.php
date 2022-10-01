<?php 

$id = $_GET["id"];

if (hapusGallery($id) > 0) {
    echo "<script>
            alert('Produk Berhasil Dihapus');
            document.location.href = '?page=galleries';
        </script>";
} else {
    echo "<script>
            alert('Produk Gagal Dihapus');
            document.location.href = '?page=galleries';
        </script>";
}

?>