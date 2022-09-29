<?php 
$idTransaction = $_GET["id"];
$transaction_details = query("SELECT * FROM transactions_details INNER JOIN transactions ON transactions_details.transaction_id = transactions.id_transaction INNER JOIN products ON transactions_details.product_id = products.id_product WHERE transaction_id = $idTransaction");

?>
  <nav
  class="navbar navbar-expand-lg navbar-light navbar-store fixed-top"
  data-aos="fade-down"
>
  <div class="container-fluid">
    <button
      class="btn btn-secondary d-md-none mr-auto mr-2"
      id="menu-toggle"
    >
      &laquo; Menu
    </button>
    <button
      class="navbar-toggler"
      type="button"
      data-toggle="collapse"
      data-target="#navbarResponsive"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collpase navbar-collapse" id="navbarResponsive">
      <!-- dekstop menu -->
      <ul class="navbar-nav d-none d-lg-flex ml-auto">
        <li class="nav-item dropdown">
          <a
            href="#"
            class="nav-link"
            id="navbarDropdown"
            role="button"
            data-toggle="dropdown"
          >
          <img
              src="../assets/images/person-circle.svg"
              alt="profile"
              height="40px"
              class="rounded-circle mr-2 profile-picture"
            />
            <?php 
              $id_driver = $_SESSION['driver'];
              $driver = query("SELECT * FROM drivers WHERE id_driver = $id_driver")[0];
            ?>
            Hi, <?= $driver["name_driver"]; ?>
          </a>
          <div class="dropdown-menu">
            <a href="../../logout.php" class="dropdown-item">logout</a>
          </div>
        </li>
      </ul>

      <!-- mobile app -->
      <ul class="navbar-nav d-block d-lg-none">
        <li class="nav-item">
          <a href="" class="nav-link"> Hi, Hafizh </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
  <div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
      <div class="dashboard-heading">
      <?php 
        $transactionMain = query("SELECT * FROM transactions INNER JOIN users ON transactions.user_id = users.id_user WHERE id_transaction = $idTransaction")[0];
      ?>
        <h2 class="dashboard-title"><?= $transactionMain["name"]; ?></h2>
        <p class="dashboard-subtitle">#<?= $transactionMain["code"]; ?></p>
      </div>
      <div class="dashboard-content store-cart">
        <div class="row" data-aos="fade-up" data-aos-delay="100">
            <div class="col-12 table-responsive">
              <table class="table table-borderless table-cart">
                <thead>
                  <tr>
                    <th>Image</th>
                    <th>Name &amp; Seller</th>
                    <th>Kode Produk</th>
                    <th>Banyak</th>
                    <th>Price</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                $banyak = 0;
                $total = 0;
                ?>
                  <?php foreach ($transaction_details as $t) : ?>
                    <?php 
                      $idProduct = $t["product_id"];
                      $product = query("SELECT * FROM products WHERE products.id_product = $idProduct");
                      $gallery = query("SELECT * FROM products_galleries INNER JOIN products ON products_galleries.product_id = products.id_product WHERE products_galleries.product_id = $idProduct");
                      $banyak += $t["banyak"];
                      $total = $t["price"] * $t["banyak"];
                    ?>
                    <tr>
                      <td style="width: 10%;">
                        <img src="../assets/images/<?= $gallery[0]["photos"]; ?>" alt="" class="cart-image w-100">
                      </td>
                      <td style="width: 20%;">
                        <div class=""><?= $t["product_name"]; ?></div>
                        <div class="product-title"><?= $t["unit"] / 1000; ?> Kilogram</div>
                      </td>
                      <td style="width: 20%;">
                        <div class="">#<?= $t["code_product"]; ?></div>
                      </td>
                      <td style="width: 10%;">
                        <div class=""><?= $t["banyak"]; ?></div>
                      </td>
                      <td style="width: 20%;">
                        <div class="">Rp. <?= number_format($t["price"]); ?></div>
                        <div class="product-title">IDR</div>
                      </td>
                      <td style="width: 20%;">
                        <div class="">Rp. <?= number_format($total); ?></div>
                        <div class="product-title">IDR</div>
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
                <input type="text" readonly value="<?= $transactionMain["city"]; ?>" class="form-control">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="phone_number">No HP / WA</label>
                <input type="tel" readonly name="phone_number" id="phone_number" class="form-control form-store" value="<?= $transactionMain["phone_number"] ?? ''; ?>" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="zip_code">Kode Pos</label>
                <input type="number" readonly name="zip_code" id="zip_code" required value="<?= $transactionMain["postal_code"] ?? ''; ?>" class="form-control form-store">
              </div>
            </div>
            <div class="col-md-12" id="alamat">
              <div class="form-group">
                <label for="address">Alamat</label>
                <textarea name="address" readonly id="editor"><?= $transactionMain["address"] ?? ''; ?></textarea>
              </div>
            </div>
          </div>
          <div class="row" data-aos="fade-up" data-aos-delay="150">
            <div class="col-12">
              <hr>
            </div>
            <div class="col-12">
              <h2 class="mb-2">
                Information product
              </h2>
            </div>
          </div>
          <?php 
          $rekening_id = $transactionMain["rekening_id"];
          $rekening = query("SELECT * FROM rekening_numbers WHERE id_rekening = $rekening_id")[0];
          ?>
          <div class="row justify-content-center mb-5" data-aos="fade-up" data-aos-delay="200">
            <div class="col-4 col-md-3">
              <div class="font-weight-bold"><?= $banyak; ?></div>
              <div class="text-muted">Banyak Barang</div>
            </div>
            <div class="col-4 col-md-3">
              <div class="font-weight-bold"><?= $transactionMain["weight_total"] / 1000; ?> Kilogram</div>
              <div class="text-muted">Berat Barang</div>
            </div>
            <div class="col-4 col-md-3">
              <?php if ($transactionMain["transaction_status"] == 'BELUM KONFIRMASI') : ?>
                <div class="text-danger font-weight-bold"><?= ($transactionMain["transaction_status"]); ?></div>
              <?php else : ?>
                <div class="text-success font-weight-bold"><?= ($transactionMain["transaction_status"]); ?></div>
              <?php endif;?>
              <div class="text-muted">Status Pembayaran</div>
            </div>
            <div class="col-4 col-md-3">
              <div class="text-success font-weight-bold">Rp. <?= number_format($transactionMain["total_price"]); ?></div>
              <div class="text-muted">Total</div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  



