<?php 

$id = $_GET["id"];

if (hapusCategories($id) > 0) {
    echo "<script>
            alert('Category Berhasil Dihapus');
            document.location.href = '?page=categories';
        </script>";
} else {
    echo "<script>
            alert('Category Gagal Dihapus');
            document.location.href = '?page=categories';
        </script>";
}

?>