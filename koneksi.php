<?php
//Koneksi ke database
//Host local
$host 	= "localhost";
$user	= "root";
$pass	= "";
$db		= "penjualan";

$koneksi = mysqli_connect($host, $user, $pass) or die (mysqli_error());
mysqli_select_db($koneksi, $db) or die ("Tidak terdapat database dengan nama <b><i>\"$db\"</i></b>");
?>