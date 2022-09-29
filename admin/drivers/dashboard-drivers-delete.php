<?php

$id = $_GET["id"];

if (hapusDriver($id) > 0) {
    echo "<script>
            alert('Driver Berhasil Dihapus');
            document.location.href = '?page=drivers';
        </script>";
} else {
    echo "<script>
            alert('Driver Gagal Dihapus');
            document.location.href = '?page=drivers';
        </script>";

}

?>