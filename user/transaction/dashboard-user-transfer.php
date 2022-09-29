<?php 

if (isset($_POST["uploadTransfer"])) {
  if (uploadTransfer($_POST) > 0) {
    $_SESSION["success"] = "Bukti transfer berhasil dikirim, tunggu konfirmasi dari admin";
    header("Location: ?page=transactions");
  }
}

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
              $id_user = $_SESSION['user'];
              $user = query("SELECT * FROM users WHERE id_user = $id_user")[0];
            ?>
            Hi, <?= $user["name"]; ?>
          </a>
          <div class="dropdown-menu">
            <a href="../index.php" class="dropdown-item">Back To Home</a>
            <div class="dropdown-divider"></div>
            <a href="../logout.php" class="dropdown-item">logout</a>
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
      <h2 class="dashboard-title">Foto Bukti Transfer</h2>
      <p class="dashboard-subtitle">Fotokan bukti transfer anda disini</p>
    </div>
    <div class="dashboard-content">
      <div class="row mt-4">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <?php 
                  $id_transaction = $_GET["id"];
                  $transaction = query("SELECT * FROM transactions INNER JOIN rekening_numbers ON transactions.rekening_id = rekening_numbers.id_rekening WHERE id_transaction = $id_transaction")[0];
                ?>
                <div class="col-12">
                  <h5 class="mb-4">Transfer ke No Rekening Ini</h5>
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
              </div>
              <div class="row mt-3">
                <div class="col-12">
                <form action="" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="photo">Photo</label>
                    <input type="file" name="photo" id="photo" class="form-control">
                  </div>
                  <div class="text-right mt-4">
                    <input type="hidden" name="id_transaction" value="<?= $id_transaction; ?>">
                    <button type="submit" class="btn btn-success" name="uploadTransfer">Upload Transfer</button>
                  </div>
                </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
