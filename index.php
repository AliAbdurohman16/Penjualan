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

if (isset($_SESSION["driver"])) {
  header("Location: driver");
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

    <title>Toko oleh-oleh karya indah</title>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link href="assets/style/main.css" rel="stylesheet" />

    <style>      
    .store-adventeges {
        padding: 40px;
        background-color: #F7F7E8;
      }
    </style>
  </head>

  <body>
    <!-- navbar -->
    <nav
      class="navbar bg-light navbar-expand-lg navbar-light navbar-store fixed-top navbar-fixed-top"
      data-aos="fade-down"
    >
      <div class="container">
        <a href="index.php" class="navbar-brand" title="home">
          <img src="assets/images/kilogo.png" class="w-25" alt="logo" />
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
            <li class="nav-item active">
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
    <div class="page-content page-home" data-aos="zoom-in">
      <section class="store-landing">
        <div class="container">
          <div class="row align-items-center justify-content-between">
            <div class="col-md-5">
              <img src="assets/images/karyaindah.png" class="w-100" alt="" />
            </div>
            <div class="col-md-6">
              <h1 style="font-weight: bold; margin-bottom: 15px;">Toko oleh-oleh karya indah</h1>
              <p class="store-subtitle-landing" style="line-height: 28px; color: rgb(146, 146, 146);">
                Karya Indah adalah toko oleh-oleh yang menjual berbagai macam makanan khas kota kuningan.
              </p>
              <a href="products.php" class="btn btn-success px-4 py-2 mt-4"
                ><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-cart-fill" viewBox="0 0 20 20">
  <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
</svg> Shop Now</a
              >
            </div>
          </div>
        </div>
      </section>
      <section class="store-adventeges" style="margin-top: 100px;" id="adventeges">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="title-adventeges" style="text-align: center; font-size: 24px; font-weight: 600; margin-bottom: 20px;">Kelebihan Belanja Disini</div>
            </div>
          </div>
          <div class="row">
            <div
              class="col-6 col-md-4"
              data-aos="fade-down"
              data-aos-delay="100"
            >
              <div class="card mb-4">
                <div class="card-body">
                  <div class="row justify-content-center align-content-center">
                    <div class="col-10 col-md-4">
                      <div class="adventeges-thumbnail mb-lg-0 mb-2">
                        <img
                          src="assets/images/fast.svg"
                          class="w-100"
                          alt=""
                        />
                      </div>
                    </div>
                    <div class="col-md-8">
                      <div
                        class="adventege-description text-center text-lg-left"
                      >
                        <div class="title-text">Good Quality</div>
                        <div class="subtitle-text">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div
              class="col-6 col-md-4"
              data-aos="fade-down"
              data-aos-delay="200"
            >
              <div class="card mb-4">
                <div class="card-body">
                  <div class="row justify-content-center align-content-center">
                    <div class="col-10 col-md-4">
                      <div class="adventeges-thumbnail mb-lg-0 mb-2">
                        <img
                          src="assets/images/money.svg"
                          class="w-100"
                          alt=""
                        />
                      </div>
                    </div>
                    <div class="col-md-8">
                      <div
                        class="adventege-description text-center text-lg-left"
                      >
                        <div class="title-text">Affordable</div>
                        <div class="subtitle-text">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div
              class="col-6 col-md-4"
              data-aos="fade-down"
              data-aos-delay="300"
            >
              <div class="card mb-4">
                <div class="card-body">
                  <div class="row justify-content-center align-content-center">
                    <div class="col-10 col-md-4">
                      <div class="adventeges-thumbnail mb-lg-0 mb-2">
                        <img src="assets/images/env.svg" class="w-100" alt="" />
                      </div>
                    </div>
                    <div class="col-md-8">
                      <div
                        class="adventege-description text-center text-lg-left"
                      >
                        <div class="title-text">Tasty</div>
                        <div class="subtitle-text">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="store-products-kilogram" style="margin-top: 100px;">
        <div class="container">
          <div class="row">
            <div class="col-12" data-aos="fade-up">
              <h5 style="font-weight: 600; margin-bottom: 15px;">New Products</h5>
            </div>
          </div>
          <div class="row">
            <?php 
            $products = query("SELECT * FROM products LIMIT 8");
            $iteration = 0;
            ?>

            <?php foreach ($products as $product) : ?>
            <?php 
            $idProduct = $product["id_product"];
            $galleries = query("SELECT * FROM products_galleries INNER JOIN products ON products_galleries.product_id = products.id_product WHERE products_galleries.product_id = $idProduct");    
            ?>
              <div
                class="col-6 col-md-4 col-lg-3"
                data-aos="fade-up"
                data-aos-delay="<?= $iteration += 100; ?>"
              >
                <?php if ($product["stock"] > 0) : ?>
                <a href="details.php?id=<?= $idProduct; ?>" class="component-products d-block">
                  <div class="products-thumbnail">
                    <div
                      class="products-image"
                      style="background-image: url('assets/images/<?= $galleries[0]["photos"] ?>')"
                    >
                    </div>
                  </div>
                  <div class="d-flex justify-content-between align-items-center">
                    <div>
                      <div class="products-text"><?= $product["product_name"]; ?></div>

                      <div class="products-price">Rp. <?= number_format($product["price"]); ?></div>
                    </div>
                    <div>
                      <div class="text-muted"><?= $product["unit"] / 1; ?> Pcs</div>
                    </div>
                  </div>
                </a>
                <?php else : ?>
                <div class="component-products d-block">
                  <div class="products-thumbnail position-relative">
                      <div class="position-absolute w-100 h-100 d-flex justify-content-center align-items-center bg-dark" style="opacity: .7;">
                          <div class="text-decoration-none font-weight-bold text-white" style="font-weight: 500;">SOLD OUT</div>
                      </div>
                  </div>
                  <div class="d-flex justify-content-between align-items-center">
                    <div>
                      <div class="products-text"><?= $product["product_name"]; ?></div>

                      <div class="products-price">Rp. <?= number_format($product["price"]); ?></div>
                    </div>
                    <div>
                      <div class="text-muted"><?= $product["unit"] / 1; ?> Pcs</div>
                    </div>
                  </div>
                </div>
                <?php endif;?>
              </div>
            <?php endforeach;?>
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
    <script src="assets/js/navbar-scroll.js"></script>
  </body>
</html>
