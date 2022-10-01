<?php

$id = $_GET["id"];

$rekening = query("SELECT * FROM rekening_numbers WHERE id_rekening = $id")[0];

if (isset($_POST["updateRekening"])) {
  if (updateRekening($_POST) > 0) {
    echo "<script>
            alert('Rekening Berhasil Diubah');
            document.location.href = '?page=rekening';
          </script>";
  } else {
    echo "<script>
            alert('Rekening Gagal Diubah');
            document.location.href = '?page=rekening';
          </script>";
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
<div
  class="section-content section-dashboard-home"
  data-aos="fade-up"
>
  <div class="container-fluid">
    <div class="dashboard-heading">
      <h2 class="dashboard-title"><?= $rekening["bank_name"]; ?></h2>
      <p class="dashboard-subtitle">Rekening Details</p>
    </div>
    <div class="dashboard-content">
      <div class="row">
        <div class="col-12 mt-2">
          <form action="" method="POST">
            <div class="card">
              <div class="card-body">
                  <div class="row">
                    <input type="hidden" name="id" value="<?= $rekening["id_rekening"]; ?>">
                    <div class="col-md-12">
                    <div class="form-group">
                      <label for="bank_name">Nama Bank</label>
                      <input
                        type="text"
                        name="bank_name"
                        id="bank_name"
                        class="form-control"
                        value="<?= $rekening["bank_name"]; ?>"
                        required
                      />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="no_rekening">No Rekening</label>
                      <input
                        type="number"
                        name="no_rekening"
                        id="no_rekening"
                        class="form-control"
                        value="<?= $rekening["number"]; ?>"
                        required
                      />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="name">Pemilik</label>
                      <input
                        type="text"
                        name="pemilik"
                        id="pemilik"
                        value="<?= $rekening["rekening_name"]; ?>"
                        class="form-control"
                        required
                      />
                    </div>
                  </div>
                  </div>
                  <div class="row">
                    <div class="col-12 text-right">
                      <button
                        type="submit"
                        name="updateRekening"
                        class="btn btn-success px-4"
                      >
                        Save Now
                      </button>
                    </div>
                  </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>