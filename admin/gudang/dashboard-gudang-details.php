<?php

$id = $_GET["id"];

$drivers = query("SELECT * FROM drivers WHERE id_driver = $id")[0];

if (isset($_POST["updateDriver"])) {
  if (updateDriver($_POST) > 0) {
    echo "<script>
            alert('Driver Berhasil Diubah');
            document.location.href = '?page=drivers';
          </script>";
  } else {
    echo "<script>
            alert('Driver Gagal Diubah');
            document.location.href = '?page=drivers';
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
      <h2 class="dashboard-title"><?= $drivers["name_driver"]; ?></h2>
      <p class="dashboard-subtitle">Driver Details</p>
    </div>
    <div class="dashboard-content">
      <div class="row">
        <div class="col-12 mt-2">
          <form action="" method="POST">
            <div class="card">
              <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                    <input type="hidden" name="id" value="<?= $drivers["id_driver"]; ?>">
                      <div class="form-group">
                        <label for="name">Nama User</label>
                        <input
                          type="text"
                          name="name"
                          id="name"
                          class="form-control"
                          value="<?= $drivers["name_driver"]; ?>"
                          required
                        />
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input
                          type="text"
                          name="email"
                          id="email"
                          class="form-control"
                          value="<?= $drivers["email"]; ?>"
                          readonly
                        />
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="password">Password</label>
                        <input
                          type="password"
                          name="password"
                          id="password"
                          class="form-control"
                        />
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="jurusan">Jurusan</label>
                        <select name="jurusan" id="jurusan" class="form-control">
                          <option value="<?= $drivers["jurusan"]; ?>"><?= $drivers["jurusan"]; ?></option>
                          <option value="JAKARTA">JAKARTA</option>
                          <option value="BOGOR">BOGOR</option>
                          <option value="TANGERANG">TANGERANG</option>
                          <option value="DEPOK">DEPOK</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="phone_number">No HP / WA</label>
                        <input
                          type="number"
                          name="phone_number"
                          id="phone_number"
                          class="form-control"
                          value="<?= $drivers["phone_number"]; ?>"
                          required
                        />
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="noPegawai">No Pegawai</label>
                        <input
                          type="number"
                          name="noPegawai"
                          id="noPegawai"
                          class="form-control"
                          value="<?= $drivers["no_pegawai"]; ?>"
                          required
                        />
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 text-right">
                      <button
                        type="submit"
                        name="updateDriver"
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