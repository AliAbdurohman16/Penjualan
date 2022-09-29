<?php 
require_once 'config/config.php';

if (isset($_SESSION["user"])) {
  $id = $_SESSION["user"];
  $result = query("SELECT * FROM users WHERE id_user = $id")[0];
  if ($result['roles'] == 'ADMIN') {
    header("Location: admin");
  } elseif($result["roles"] == 'OWNER') {
    header("Location: owner");
  }
}

if (!isset($_SESSION["login"]) && !isset($_SESSION["user"])) {
  header("Location: login.php");
} elseif (isset($_SESSION["driver"])) {
  header("Location: driver/index.php");
}

if (isset($_POST["checkout"])) {
  header("Location: success.php");
}

if (isset($_POST["deleteCart"])) {
  if (deleteProductAtCart($_POST) > 0) {
    echo "<script>
            alert('Product berhasil di hapus dari cart Anda');
            document.location.href = 'cart.php';
          </script>";
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Cart | Toko Makanan Khas Kuningan</title>

  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
  <link href="assets/style/main.css" rel="stylesheet" />
</head>

<body>
  <!-- navbar -->
  <nav
      class="navbar bg-light navbar-expand-lg navbar-light navbar-store fixed-top navbar-fixed-top"
      data-aos="fade-down"
  >
    <div class="container">
      <a href="index.php" class="navbar-brand" title="home">
        <img src="assets/images/karyalogo.png" class="w-25" alt="logo" />
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarResponsive"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collpase navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a href="index.php" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
            <a href="products.php" class="nav-link">All Products</a>
          </li>
          <li class="nav-item">
            <a href="about.php" class="nav-link">About</a>
          </li>
          <?php
          if (!isset($_SESSION["login"]) && !isset($_SESSION["user"])) : ?>
            <li class="nav-item">
              <a href="register.php" class="nav-link">Sign Up</a>
            </li>
            <li class="nav-item">
              <a
                href="login.php"
                class="btn btn-success nav-link px-4 text-white"
                >Sign In</a
              >
            </li>
          <?php else: ?>
            <li class="nav-item dropdown">
              <?php 
                $id = $_SESSION["user"];
                $user = query("SELECT * FROM users WHERE id_user = $id")[0];
              ?>
                <a
                  href="#"
                  class="nav-link font-weight-bold"
                  id="navbarDropdown"
                  role="button"
                  data-toggle="dropdown"
                >
                  <!-- <img
                    src="../assets/images/user_pc.png"
                    alt="profile"
                    class="rounded-circle mr-2 profile-picture"
                  /> -->
                  Hi, <?= $user["name"]; ?>
                </a>
                <div class="dropdown-menu">
                  <?php if ($user["roles"] == 'ADMIN') : ?>
                      <a href="admin" class="dropdown-item">
                        Dashboard
                      </a>
                  <?php else : ?>
                      <a href="user" class="dropdown-item">
                        Dashboard
                      </a>
                  <?php endif; ?>
                  <div class="dropdown-divider"></div>
                  <a href="logout.php" class="dropdown-item">logout</a>
                </div>
            </li>
            <li class="nav-item">
              <?php 
                $id = $user["id_user"];
                $carts = rows("SELECT * FROM carts WHERE id_user = $id");
              ?>
              <?php if ($carts >= 1) : ?>
                <a href="cart.php" class="nav-link d-inline-block">
                  <img
                    src="assets/images/shopping-cart-filled.svg"
                    alt="cart-empty"
                  />
                  <div class="cart-badge"><?= $carts; ?></div>
                </a>
              <?php else : ?>
                <a href="cart.php" class="nav-link d-inline-block">
                  <img
                    src="assets/images/icon-cart-empty.svg"
                    alt="cart-empty"
                  />
                </a>
              <?php endif; ?>
            </li>
          <?php endif;?>
        </ul>
      </div>
    </div>
  </nav>
  <!-- akhir navbar -->

  <!-- page content -->
  <div class="page-content page-cart">
    <section class="store-breadcrumb" data-aos="fade-down" data-aos-delay="100">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <nav>
              <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item">
                  <a href="/index.html">Home</a>
                </li>
                <li class="breadcrumb-item active">
                  Cart
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </section>
    <section class="store-cart">
      <div class="container">
        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-12 table-responsive">
            <table class="table table-borderless table-cart">
              <thead>
                <tr>
                  <th>Image</th>
                  <th>Name &amp; Seller</th>
                  <th>Banyak</th>
                  <th>Price</th>
                  <th>Total</th>
                  <th>Menu</th>
                </tr>
              </thead>
              <tbody>
              <?php 
                $id = $user["id_user"];
                $carts = query("SELECT * FROM carts INNER JOIN users ON carts.id_user = users.id_user INNER JOIN products ON carts.id_product = products.id_product WHERE users.id_user = $id");
                $banyak = 0;
                $berat = 0;
                $total = 0;
                ?>
                <?php foreach ($carts as $cart) : ?>
                  <?php 
                    $idProduct = $cart["id_product"];
                    $product = query("SELECT * FROM products WHERE products.id_product = $idProduct");
                    $gallery = query("SELECT * FROM products_galleries INNER JOIN products ON products_galleries.product_id = products.id_product WHERE products_galleries.product_id = $idProduct"); 
                    $banyak += $cart["banyak"];
                    $berat += $product[0]["unit"] * $cart["banyak"];
                    $total += $cart["total"];
                  ?>
                  <tr>
                    <td style="width: 20%;">
                      <img src="assets/images/<?= $gallery[0]["photos"]; ?>" alt="" class="cart-image">
                    </td>
                    <td style="width: 20%;">
                      <div class="product-title"><?= $cart["product_name"]; ?></div>
                      <div class="product-subtitle"><?= $cart["unit"] / 1; ?> Pcs</div>
                    </td>
                    <td style="width: 10%;">
                      <div class="product-title"><?= $cart["banyak"]; ?></div>
                    </td>
                    <td style="width: 20%;">
                      <div class="product-title">Rp. <?= number_format($cart["price"]); ?></div>
                      <div class="product-subtitle">IDR</div>
                    </td>
                    <td style="width: 20%;">
                      <div class="product-title">Rp. <?= number_format($cart["total"]); ?></div>
                      <div class="product-subtitle">IDR</div>
                    </td>
                    <td style="width: 10%;">
                    <form action="" method="POST">
                      <input type="hidden" name="deleteProduct" value="<?= $cart["id_cart"]; ?>">
                      <button type="submit" onclick="return confirm('Yakin Ingin Menghapus Product Ini dari cart ?')" name="deleteCart" class="btn btn-remove text-white btn-block px-3">Remove</button>
                    </form>
                    </td>
                  </tr>
                <?php endforeach;?>
              </tbody>
            </table>
          </div>
        </div>
        <form action="" method="POST">
          <div class="row" data-aos="fade-up" data-aos-delay="150">
            <div class="col-12">
              <hr>
            </div>
            <div class="col-12">
              <h2>
                Shipping Details
              </h2>
            </div>
          </div>
          <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
            <div class="col-md-4">
              <div class="form-group">
                <label for="city">Kota</label>
                <select name="city" id="city" class="form-control" required>
                  <option value="JAKARTA">JAKARTA</option>
                  <option value="BOGOR">BOGOR</option>
                  <option value="TANGERANG">TANGERANG</option>
                  <option value="DEPOK">DEPOK</option>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="phone_number">No HP / WA</label>
                <input type="tel" name="phone_number" id="phone_number" class="form-control form-store" value="<?= $user["phone_number"] ?? ''; ?>" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="zip_code">Kode Pos</label>
                <input type="number" name="zip_code" id="zip_code" required value="<?= $user["postal_code"] ?? ''; ?>" class="form-control form-store">
              </div>
            </div>
            <div class="col-md-6 mt-2">
              <div class="form-group">
              <label for="rekening">Pilihan Pembayaran</label>
                  <?php 
                    $rekening = query("SELECT * FROM rekening_numbers");
                  ?>
                  <select name="rekening" id="rekening" class="form-control">
                    <?php foreach ($rekening as $r) : ?>
                      <option value="<?= $r["id_rekening"]; ?>"><?= $r["bank_name"]; ?></option>
                    <?php endforeach; ?>
                  </select>
              </div>
            </div>
            <div class="col-md-6 mt-2">
              <div class="form-group">
                <label for="no_rekening">No Rekening</label>

              </div>
            </div>
            <?php if ($berat >= 10000) : ?>
              <div class="col-md-12 text-center my-4" id="alert-berat">
                <h5>Berat barang anda lebih dari <strong>10 Kilogram</strong></h5>
                <p class="text-muted">Apakah barang anda ingin di antar kami ?</p>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="radioTrue" value="1" name="delivered" class="custom-control-input">
                  <label class="custom-control-label" for="radioTrue">Ya, Antar</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="radioFalse" value="0" name="delivered" class="custom-control-input">
                  <label class="custom-control-label" for="radioFalse">Tidak, Terimakasih</label>
                </div>
              </div>
              <?php else : ?>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="alamat">Masukkan Alamat Anda :</label>
                  <textarea name="alamat" id="editor"><?= $user["address"] ?? ''; ?></textarea>
                </div>
              </div>
              <?php endif; ?>
              <div class="col-md-12 mt-2" style="display: none;" id="alamat">
                <div class="form-group">
                  <label for="address">Masukkan Alamat Anda :</label>
                  <textarea name="address" id="editor"><?= $user["address"] ?? ''; ?></textarea>
                </div>
              </div>
              <div class="col-md-12 text-center my-4" style="display: none;" id="bawa-sendiri">
                <h5 class="mb-2">Alamat Toko Kami</h5>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4716.654901073462!2d106.97228048105524!3d-6.234943196910656!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698d1e6641a377%3A0xa736e953b5a40749!2sELZA%20MANDIRI!5e0!3m2!1sid!2sid!4v1611021244967!5m2!1sid!2sid" width="400" height="250" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
              </div>
          </div>
          <div class="row" data-aos="fade-up" data-aos-delay="150">
            <div class="col-12">
              <hr>
            </div>
            <div class="col-12">
              <h2 class="mb-2">
                Payment Information
              </h2>
            </div>
          </div>
          <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <div class="col-4 col-md-3">
              <div class="product-title"><?= number_format($banyak); ?> Barang</div>
              <div class="product-subtitle mb-3">Banyak Barang</div>
            </div>
            <div class="col-4 col-md-3">
              <div class="product-title"><?= $berat / 4; ?> Kilogram</div>
              <div class="product-subtitle">Berat Barang</div>
            </div>
            <div class="col-4 col-md-3">
              <div class="product-title text-success">Rp. <?= number_format($total); ?></div>
              <div class="product-subtitle">Total</div>
            </div>
            <div class="col-8 col-md-3">
              <input type="hidden" name="user_id" value="<?= $user["id_user"]; ?>">
              <input type="hidden" name="weight" value="<?= $berat; ?>">
              <input type="hidden" name="total_price" value="<?= $total; ?>">
              <button type="submit" name="checkout" class="btn btn-success btn-block px-4 mt-1">Checkout Now</button>
            </div>
          </div>
        </form>
      </div>
    </section>
  </div>





    <footer>
      <div class=" container">
        <div class="row">
          <div class="col-12">
            <p class="pt-4 pb-2">&copy; <?= date('Y'); ?> Copyright by Karya Indah. All Rights Reserved.</p>
          </div>
        </div>
      </div>
    </footer>
    <!-- akhir footer -->

    <!-- Bootstrap core JavaScript -->
    <script src="assets/vendor/jquery/jquery.slim.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
    <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script>
      const editor = CKEDITOR.replace("editor", {
        extraPlugins: 'notification',
      });
      editor.on('required', function(evt) {
          alert( 'Address is required.' );
          evt.cancel();
      } );
    </script>
    <script src="assets/js/navbar-scroll.js"></script>
    <script src="assets/js/delivered.js"></script>
</body>

</html>