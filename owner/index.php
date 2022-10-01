<?php 
require_once '../config/config.php';
if (isset($_SESSION["login"]) && isset($_SESSION["driver"])) {
  header("Location: ../driver/index.php");
}
if (!isset($_SESSION["login"]) && !isset($_SESSION["user"])) {
  header("Location: ../index.php");
} else {
  $id = $_SESSION["user"];
  $result = query("SELECT * FROM users WHERE id_user = $id")[0];
  if ($result['roles'] !== 'OWNER') {
    header("Location: ../index.php");
  }
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Dashboard | Toko Oleh-Oleh Karya Indah</title>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link href="../assets/style/main.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../assets/vendor/DataTables/datatables.min.css"/>
    <style>
      .dropdown-toggle:focus {
        outline-style: none;
      }
    </style>
  </head>

  <body>
    <?php 
    if (isset($_GET["page"])) {
      $page = $_GET["page"];
    }
    ?>
    <div class="page-dashboard">
      <div class="d-flex" id="wrapper" data-aos="fade-right">
        <!-- sidebar -->
        <div class="border-right" id="sidebar-wrapper">
          <div class="sidebar-heading text-center">
            <img src="../assets/images/kilogo.png" alt="" class="my-4 w-25" />
          </div>
          <div class="list-group list-group-flush">
            <a
              href="?page=dashboard"
              class="list-group-item list-group-item-action<?= $page == 'dashboard' ? ' active' : ''; ?> <?= $page == '' ? ' active' : ''; ?>"
            >
              Dashboard
            </a>
            <div class="dropdown">
              <button class="list-group-item list-group-item-action dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Transactions
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="?page=transactions">All Transactions</a>
                <a class="dropdown-item" href="?page=transactions-no-confirm">Belum Konfirmasi</a>
                <a class="dropdown-item" href="?page=transactions-confirm">Konfirmasi</a>
                <!--<a class="dropdown-item" href="?page=transactions-pickup">Pick Up</a>-->
                <a class="dropdown-item" href="?page=transactions-sent">Terkirim</a>
              </div>
            </div>
            <a
              href="?page=logout"
              class="list-group-item list-group-item-action<?= $page == 'logout' ? ' active' : ''; ?>"
            >
              Sign Out
            </a>
          </div>
        </div>

        <!-- page content -->
        <div id="page-content-wrapper">
          <?php 

          if (isset($page)) {
            if ($page == 'dashboard') {
              include 'dashboard.php';
            } elseif ($page == 'transactions') {
              include 'transaction/dashboard-transactions.php';
            } elseif ($page == 'transactions-no-confirm') {
              include 'transaction/dashboard-transactions-no-confirm.php';
            } elseif ($page == 'transactions-confirm') {
              include 'transaction/dashboard-transactions-confirm.php';
            } elseif ($page == 'transactions-pickup') {
              include 'transaction/dashboard-transactions-pickup.php';
            } elseif ($page == 'transactions-sent') {
              include 'transaction/dashboard-transactions-sent.php';
            } elseif ($page == 'transactions-details') {
              include 'transaction/dashboard-transactions-details.php';
            } elseif ($page == 'transactions-delete') {
              include 'transaction/dashboard-transactions-delete.php';
            } elseif ($page == 'transactions-transfer') {
              include 'transaction/dashboard-transfer.php';
            } elseif ($page == 'logout') {
              include '../logout.php';
            } else {
              echo "Halaman Tidak Ditemukan";
            }
          } else {
            include 'dashboard.php';
          }

          ?>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="cetakPDF" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <form action="transaction/report-pdf.php" method="GET">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Cetak Laporan PDF</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row" id="tanggal">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="tanggalAwal">Dari Tanggal :</label>
                    <input type="date" name="tanggalAwal" id="tanggalAwal" class="form-control">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="tanggalAkhir">Sampai Tanggal :</label>
                    <input type="date" name="tanggalAkhir" id="tanggalAkhir" class="form-control">
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" name="filter" class="btn btn-primary">Cetak PDF</button>
            </div>
          </div>
        </div>
      </form>
    </div>

    
    

    <!-- Bootstrap core JavaScript -->
    <script src="../assets/vendor/jquery/jquery.slim.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
    <script>
      $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
      });
    </script>
    <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script>
      CKEDITOR.replace("editor");
    </script>
    <script type="text/javascript" src="../assets/vendor/DataTables/datatables.min.js"></script>
    <script>
      $(document).ready(function() {
          $('#table').DataTable();
      } );
    </script>
  </body>
</html>
