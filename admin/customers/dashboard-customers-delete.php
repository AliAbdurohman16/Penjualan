<?php

$id = $_GET["id"];

if (hapusUser($id) > 0) {
    echo "<script>
            alert('User Berhasil Dihapus');
            document.location.href = '?page=users';
        </script>";
} else {
    echo "<script>
            alert('User Gagal Dihapus');
            document.location.href = '?page=users';
        </script>";

}

?>