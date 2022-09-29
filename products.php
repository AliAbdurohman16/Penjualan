<?php 
require 'config/config.php';

if (isset($_SESSION["user"])) {
  $id = $_SESSION["user"];
  $result = query("SELECT * FROM users WHERE id_user = $id")[0];
  if ($result['roles'] == 'ADMIN') {
    header("Location: admin");
  } elseif($result["roles"] == 'OWNER') {
    header("Location: owner");
  }
}

if (isset($_SESSION["driver"])) {
  header("Location: driver/index.php");
} 
$jumlahDataPerHalaman = 8;
$jumlahData = count(query("SELECT * FROM products"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["page"])) ? $_GET["page"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;
if (isset($_GET["sort"])) {
  $category_id = $_GET["sort"];
  $products = query("SELECT * FROM products WHERE category_id = $category_id");
} else {
  $products = query("SELECT * FROM products LIMIT $awalData, $jumlahDataPerHalaman");
}

$categories = query("SELECT * FROM categories");

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

    <title>Store - Your Best Marketplace</title>

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
            <li class="nav-item active">
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

    <!-- slider / banner -->
    <div class="page-content page-home" data-aos="zoom-in">
      <section class="store-breadcrumb mb-4">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <nav class="breadcrumb bg-transparent p-0">
                <a class="breadcrumb-item" href="index.php">Home</a>
                <div class="breadcrumb-item active">Product</div>
              </nav>
            </div>
          </div>
        </div>
      </section>
      <section class="store-all-products" id="product">
        <div class="container">
          <div class="row justify-content-between mb-2">
            <div class="col-lg-4" data-aos="fade-up">
            <?php 
            if (isset($_GET["sort"])) {
              $category_id = $_GET["sort"];
              $categoryLabel = query("SELECT * FROM categories WHERE id = $category_id")[0];
            }
            ?>
              <?php if (isset($categoryLabel)) : ?>
                <h5 class="mb-1"><?= $categoryLabel["category_name"]; ?></h5>
              <?php else : ?>
                <h5 class="mb-1">All Products</h5>
              <?php endif;?>
              <p class="text-muted">Tersedia Berbagai Macam Makanan Khas Kuningan
            </div>
            <div class="col-lg-4">
              <form action="" method="GET">
              <div class="form-group">
                    <select name="sort" id="sort" class="form-control" onchange="form.submit()">
                    <option disabled selected>-- Select Category --</option>
                    <?php foreach ($categories as $category) : ?>
                      <option value="<?= $category["id"]; ?>"><?= $category["category_name"]; ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
              </form>
            </div>
          </div>
          <div class="row">
            <div
              class="col-6 col-md-4 col-lg-3"
              data-aos="fade-up"
              v-for="(product, index) in products"
              :data-aos-delay="product.iteration"
            >
              <a :href="product.id" class="component-products d-block" v-if="product.stock > 0">
                <div class="products-thumbnail">
                  <img :src="product.url" class="products-image" alt="">
                </div>
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <div class="products-text">{{ product.name }}</div>

                    <div class="products-price">Rp. {{ product.price }}</div>
                  </div>
                  <div>
                    <div class="text-muted">{{ product.unit }}</div>
                  </div>
                </div>
              </a>
              <div class="component-products d-block" v-else>
                <div class="products-thumbnail position-relative">
                  <div class="position-absolute w-100 h-100 d-flex justify-content-center align-items-center bg-dark" style="opacity: .7;">
                        <div class="text-decoration-none font-weight-bold text-white" style="font-weight: 500;">SOLD OUT</div>
                  </div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <div class="products-text">{{ product.name }}</div>

                    <div class="products-price">Rp. {{ product.price }}</div>
                  </div>
                  <div>
                    <div class="text-muted">{{ product.unit }}</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-12 d-flex justify-content-center">
              <nav aria-label="Page navigation">
                <ul class="pagination">
                  <?php if ($halamanAktif > 1) : ?>
                    <li class="page-item">
                      <a class="page-link" href="?page=<?= $halamanAktif - 1; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                      </a>
                    </li>
                  <?php else : ?>
                  <li class="page-item disabled">
                    <a class="page-link" href="" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                      <span class="sr-only">Previous</span>
                    </a>
                  </li>
                  <?php endif;?>
                  <?php for ($i=1; $i <= $jumlahHalaman ; $i++) : ?>
                    <?php if ($i == $halamanAktif) : ?>
                      <li class="page-item active"><a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a></li>
                    <?php else: ?>
                      <li class="page-item"><a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a></li>
                    <?php endif; ?>
                  <?php endfor;?>
                  <?php if ($halamanAktif < $jumlahHalaman) : ?>
                    <li class="page-item">
                      <a class="page-link" href="?page=<?= $halamanAktif + 1; ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                      </a>
                    </li>
                  <?php else :?>
                    <li class="page-item disabled">
                      <a class="page-link" href="" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                      </a>
                    </li>
                  <?php endif; ?>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </section>
    </div>
    <!-- akhir slider -->

    <!-- footer -->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-12">
            <p class="pt-4 pb-2">
              &copy; 2022 Copyright by Karya Indah. All Rights Reserved.
            </p>
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
    <script>
      const NumberFormat = new Intl.NumberFormat();
    </script>
    <script src="assets/vendor/vue/vue.js"></script>
    <script>
      var product = new Vue({
        el: "#product",
        mounted() {
          AOS.init();
        },
        data: {
          products: [
            <?php $iteration = 0 ?>
            <?php foreach ($products as $product ) : ?>
            <?php
              $idProduct = $product["id_product"];
              $gallery = query("SELECT * FROM products_galleries INNER JOIN products ON products_galleries.product_id = products.id_product WHERE products_galleries.product_id = $idProduct");
            ?>
            {
              iteration: <?= $iteration += 100 ?>,
              id: 'details.php?id=<?= $product["id_product"] ?>',
              name: '<?= $product["product_name"] ?>',
              url: "assets/images/<?= $gallery[0]["photos"] ?? '' ?>",
              price: NumberFormat.format('<?= $product["price"] ?>'),
              unit: '<?= $product["unit"] / 1 ?> Pcs',
              stock: '<?= $product["stock"]?>',
            },
            <?php endforeach; ?>
          ],
        },
        methods: {
          changeActive(id) {
            this.activePhoto = id;
          },
        },
      });
    </script>
    <script src="assets/js/navbar-scroll.js"></script>
  </body>
</html>          
