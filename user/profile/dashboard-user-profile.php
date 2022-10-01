<?php 

if (isset($_POST["updateUser"])) {
  if (updateUser($_POST) > 0) {
    echo "<script>
            alert('User Berhasil Diubah');
            document.location.href = '?page=profile';
          </script>";
  } else {
    echo "<script>
            alert('User Gagal Diubah');
            document.location.href = '?page=profile';
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
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
    <div class="dashboard-heading">
        <h2 class="dashboard-title">Edit Profile</h2>
        <p class="dashboard-subtitle">Edit Your Proflie</p>
    </div>
    <div class="dashboard-content">
        <div class="row">
          <div class="col-12 mt-2">
              <form action="" method="POST">
                  <div class="card">
                      <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                  <label for="name">Nama Lengkap</label>
                                  <input type="text" name="name" value="<?= $user["name"] ?? ''; ?>" id="name" class="form-control">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                  <label for="email">Email</label>
                                  <input type="email" readonly name="email" value="<?= $user["email"] ?? ''; ?>" id="email" class="form-control">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                  <label for="phone_number">No. Hp / WA</label>
                                  <input type="tel" name="phone_number" value="<?= $user["phone_number"] ?? ''; ?>" id="phone_number" class="form-control">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                  <label for="code">Kode Pos</label>
                                  <input type="number" name="code" value="<?= $user["postal_code"] ?? ''; ?>" id="code" class="form-control">
                              </div>
                            </div>
                            <div class="col-md-12" id="alamat">
                              <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" id="editor"><?= $user["address"] ?? ''; ?></textarea>
                              </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                          <div class="col text-right">
                          <input type="hidden" name="id" value="<?= $user["id_user"] ?? ''; ?>">
                          <input type="hidden" name="roles" value="<?= $user["roles"] ?? ''; ?>">
                          <button type="submit" name="updateUser" class="btn btn-success px-4">Save Now</button>
                          </div>
                      </div>
                  </div>
              </form>
          </div>
        </div>
    </div>
    </div>
</div>