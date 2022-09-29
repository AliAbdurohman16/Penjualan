<?php 
// include "../koneksi.php";

require_once '../config/config.php';
if (isset($_SESSION["login"]) && isset($_SESSION["driver"])) {
  header("Location: ../driver/index.php");
}
if (!isset($_SESSION["login"]) && !isset($_SESSION["user"])) {
  header("Location: ../index.php");
} else {
  $id = $_SESSION["user"];
  $result = query("SELECT * FROM users WHERE id_user = $id")[0];
  if ($result['roles'] !== 'ADMIN') {
    header("Location: ../index.php");
  }
}

if (isset($_POST["terkirim"])) {
  if (terkirim($_POST) > 0) {
    header("Location: ?page=transactions");
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

    <title>Dashboard | Toko Makanan Khas Kuningan</title>

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
              href="?page=products"
              class="list-group-item list-group-item-action<?= $page == 'products' ? ' active' : ''; ?> <?= $page == 'products-create' ? ' active' : ''; ?> <?= $page == 'products-details' ? ' active' : ''; ?>"
            >
              Products
            </a>
            <a
              href="?page=galleries"
              class="list-group-item list-group-item-action<?= $page == 'galleries' ? ' active' : ''; ?> <?= $page == 'galleries-create' ? ' active' : ''; ?> <?= $page == 'galleries-details' ? ' active' : ''; ?>"
            >
              Galleries
            </a>
            <a
              href="?page=categories"
              class="list-group-item list-group-item-action<?= $page == 'categories' ? ' active' : ''; ?> <?= $page == 'categories-create' ? ' active' : ''; ?> <?= $page == 'categories-details' ? ' active' : ''; ?> <?= $page == 'categories-delete' ? ' active' : ''; ?>"
            >
              Categories
            </a>
            <div class="dropdown">
              <button class="list-group-item list-group-item-action dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Transactions
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="?page=transactions">All Transactions</a>
                <a class="dropdown-item" href="?page=transactions-no-confirm">Belum Konfirmasi</a>
                <a class="dropdown-item" href="?page=transactions-confirm">Konfirmasi</a>
                <!--<a class="dropdown-item" href="?page=transactions-pickup">Pick Up</a> -->
                <a class="dropdown-item" href="?page=transactions-sent">Terkirim</a>
              </div>
            </div>
            <a
              href="?page=rekening"
              class="list-group-item list-group-item-action<?= $page == 'rekening' ? ' active' : ''; ?> <?= $page == 'rekening-create' ? ' active' : ''; ?> <?= $page == 'rekening-details' ? ' active' : ''; ?>"
            >
              Rekening
            </a>
           
            <a
              href="?page=gudang"
              class="list-group-item list-group-item-action<?= $page == 'gudang' ? ' active' : ''; ?> <?= $page == 'gudang-create' ? ' active' : ''; ?> <?= $page == 'gudang-details' ? ' active' : ''; ?> <?= $page == 'gudang-delete' ? ' active' : ''; ?>"
            >
              Gudang
            </a>
            <a
              href="?page=users"
              class="list-group-item list-group-item-action<?= $page == 'users' ? ' active' : ''; ?> <?= $page == 'users-create' ? ' active' : ''; ?> <?= $page == 'users-details' ? ' active' : ''; ?>"
            >
              Users
            </a>
            <a
              href="?page=customers"
              class="list-group-item list-group-item-action<?= $page == 'customers' ? ' active' : ''; ?> <?= $page == 'customers-create' ? ' active' : ''; ?> <?= $page == 'customers-details' ? ' active' : ''; ?>"
            >
              Customers
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
              include 'dashboard.php';
            } elseif ($page == 'products') {
              include 'dashboard-products.php';
            } elseif ($page == 'products-create') {
              include 'dashboard-product-create.php';
            } elseif ($page == 'products-details') {
              include 'dashboard-products-details.php';
            } elseif ($page == 'products-delete') {
              include 'dashboard-product-delete.php';
            } elseif ($page == 'galleries') {
              include 'dashboard-galleries.php';
            } elseif ($page == 'galleries-create') {
              include 'dashboard-galleries-create.php';
            } elseif ($page == 'galleries-details') {
              include 'dashboard-galleries-details.php';
            } elseif ($page == 'galleries-delete') {
              include 'dashboard-galleries-delete.php';
            } elseif ($page == 'categories') {
              include 'dashboard-categories.php';
            } elseif ($page == 'categories-create') {
              include 'dashboard-categories-create.php';
            } elseif ($page == 'categories-details') {
              include 'dashboard-categories-details.php';
            } elseif ($page == 'categories-delete') {
              include 'dashboard-categories-delete.php';
            } elseif ($page == 'transactions') {
              include 'transaction/dashboard-transactions.php';
            } elseif ($page == 'transactions-receiver') {
              include 'transaction/dashboard-transactions-receiver.php';
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
            } elseif ($page == 'rekening') {
              include 'rekening/dashboard-rekening.php';
            } elseif ($page == 'rekening-create') {
              include 'rekening/dashboard-rekening-create.php';
            } elseif ($page == 'rekening-details') {
              include 'rekening/dashboard-rekening-details.php';
            } elseif ($page == 'rekening-delete') {
              include 'rekening/dashboard-rekening-delete.php';
            } elseif ($page == 'drivers') {
              include 'drivers/dashboard-drivers.php';
            } elseif ($page == 'drivers-create') {
              include 'drivers/dashboard-drivers-create.php';
            } elseif ($page == 'drivers-details') {
              include 'drivers/dashboard-drivers-details.php';
            } elseif ($page == 'drivers-delete') {
              include 'drivers/dashboard-drivers-delete.php';
            } elseif ($page == 'gudang') {
              include 'gudang/dashboard-gudang.php';
            } elseif ($page == 'gudang-create') {
              include 'gudang/dashboard-gudang-create.php';
            } elseif ($page == 'gudang-details') {
              include 'gudang/dashboard-gudang-details.php';
            } elseif ($page == 'gudang-delete') {
              include 'gudang/dashboard-gudang-delete.php';
            } elseif ($page == 'customers') {
              include 'customers/dashboard-customers.php';
            } elseif ($page == 'customers-create') {
              include 'customers/dashboard-customers-create.php';
            } elseif ($page == 'customers-details') {
              include 'customers/dashboard-customers-details.php';
            } elseif ($page == 'customers-delete') {
              include 'customers/dashboard-customers-delete.php';
            } elseif ($page == 'users') {
              include 'users/dashboard-users.php';
            } elseif ($page == 'users-create') {
              include 'users/dashboard-users-create.php';
            } elseif ($page == 'users-details') {
              include 'users/dashboard-users-details.php';
            } elseif ($page == 'users-delete') {
              include 'users/dashboard-users-delete.php';
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
