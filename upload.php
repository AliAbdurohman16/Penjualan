<?php 

if (isset($_POST["uploadTransfer"])) {
  if (uploadTransfer($_POST) > 0) {
    $_SESSION["success"] = "Bukti transfer berhasil dikirim, tunggu konfirmasi dari admin";
    header("Location: ?page=transactions");
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>upload bukti transaksi</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
  <br>
  <h4 style="text-align: center;">Upload Bukti Pembayaran</h4> <br>
  <div class="col-12">
    <h6 class="mb-4">Transfer ke No Rekening Ini</h6>
    <hr>
    <div class="mb-2">
      Nama Bank : <strong><?= $transaction["bank_name"]; ?></strong>
    </div>
    <div class="mb-2">
      No Rekening: <strong><?= $transaction["number"]; ?></strong>
    </div>
    <div class="mb-2">
      Atas Nama : <strong><?= $transaction["rekening_name"]; ?></strong>
    </div>
  </div>
  <div class="container"> <br>
    <form action="user_act.php" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="photo">Upload Bukti Pembayaran</label>
        <input type="file" name="photo" id="photo" class="form-control">
      </div>
        <div class="text-right mt-4">
          <input type="hidden" name="id_transaction" value="<?= $id_transaction; ?>">
          <button type="submit" class="btn btn-success" name="uploadTransfer">Upload Transfer</button>
    </form>
  </div>
 
</body>
</html>