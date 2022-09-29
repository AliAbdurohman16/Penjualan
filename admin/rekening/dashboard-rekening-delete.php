<?php

$id = $_GET["id"];

if (hapusRekening($id) > 0) {
    echo "<script>
            alert('Rekening Berhasil Dihapus');
            document.location.href = '?page=rekening';
        </script>";
} else {
    echo "<script>
            alert('Rekening Gagal Dihapus');
            document.location.href = '?page=rekening';
        </script>";

}

?>