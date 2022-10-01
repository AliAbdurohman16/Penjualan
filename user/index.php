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
  if ($result['roles'] !== 'USER') {
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
            <img src="../assets/images/kilogo.png" alt="" class="my-4 w-50" />
          </div>
          <div class="list-group list-group-flush">
            <a
              href="?page=dashboard"
              class="list-group-item list-group-item-action<?= $page == 'dashboard' ? ' active' : ''; ?> <?= $page == '' ? ' active' : ''; ?>"
            >
              Dashboard
            </a>
            <a
              href="?page=transactions"
              class="list-group-item list-group-item-action<?= $page == 'transactions' ? ' active' : ''; ?> <?= $page == 'transactions-details' ? ' active' : ''; ?> <?= $page == 'transfer' ? ' active' : ''; ?>"
            >
              Transactions
            </a>
            <a
              href="?page=profile"
              class="list-group-item list-group-item-action<?= $page == 'profile' ? ' active' : ''; ?> <?= $page == 'profile-details' ? ' active' : ''; ?>"
            >
              profile
            </a>
            <a
              href="../index.php"
              class="list-group-item list-group-item-action<?= $page == 'logout' ? ' active' : ''; ?>"
            >
              Back To Home
            </a>
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
              include 'dashboard-user.php';
            } elseif ($page == 'transactions') {
              include 'transaction/dashboard-user-transactions.php';
            } elseif ($page == 'transactions-details') {
              include 'transaction/dashboard-user-transactions-details.php';
            } elseif ($page == 'transfer') {
              include 'transaction/dashboard-user-transfer.php';
            } elseif ($page == 'profile') {
              include 'profile/dashboard-user-profile.php';
            } elseif ($page == 'logout') {
              include '../logout.php';
            } else {
              echo "Halaman Tidak Ditemukan";
            }
          } else {
            include 'dashboard-user.php';
          }
          

          ?>
        </div>
      </div>
    </div>

     <!-- Modal -->
     <div class="modal fade" id="terkirim" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Yakin sudah terkirim ?</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="" method="POST">
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-12">
                    <input type="hidden" name="id_transaction" value="<?= $transaction["id_transaction"]; ?>">
                    <div class="form-group">
                      <label for="penerima">Nama Penerima</label>
                      <input type="text" name="penerima" id="penerima" class="form-control">
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="terkirim" class="btn btn-primary">Save changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      </tr>
    

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
