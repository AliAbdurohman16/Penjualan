<?php 
if (isset($_POST["pickup"])) {
  if (pickup($_POST) > 0) {
    header("Location: ?page=pickup");
  }
}

if (isset($_POST["terkirim"])) {
  if (terkirim($_POST) > 0) {
    header("Location: ?page=pickup");
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
              $id_driver = $_SESSION['driver'];
              $driver = query("SELECT * FROM drivers WHERE id_driver = $id_driver")[0];
            ?>
            Hi, <?= $driver["name_driver"]; ?>
          </a>
          <div class="dropdown-menu">
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
      <h2 class="dashboard-title">Pick Up</h2>
      <p class="dashboard-subtitle">This is menu for your Pick Up</p>
    </div>
    <div class="dashboard-content">
      <div class="row mt-4">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table class="table table-striped table-hover" id="table">
                      <thead>
                        <tr>
                          <th scope="col">ID</th>
                          <th scope="col">Code</th>
                          <th scope="col">Pemilik</th>
                          <th scope="col">Kota</th>
                          <th scope="col">Status</th>
                          <th scope="col">Barang tiba</th>
                          <th scope="col">Tanggal</th>
                          <th scope="col" class="text-center">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          $no = 1;
                          $driver = query("SELECT * FROM drivers WHERE id_driver = $id_driver")[0];
                          $jurusan = $driver["jurusan"];
                          $pickup = query("SELECT * FROM transactions INNER JOIN users ON transactions.user_id = users.id_user WHERE transaction_status = 'TERKONFIRMASI'  AND delivered = 1 AND city = '$jurusan' OR transaction_status = 'PICKUP'");
                        ?>
                        <?php foreach ($pickup as $pc) : ?>
                          <tr>
                            <th scope="row"><?= $no; ?></th>
                            <td>#<?= $pc["code"]; ?></td>
                            <td><?= $pc["name"]; ?></td>
                            <td><?= $pc["city"]; ?></td>
                            <td>
                              <?php if ($pc["transaction_status"] == "BELUM KONFIRMASI") : ?>
                                <span class="badge badge-pill badge-danger">BELUM KONFIRMASI</span>
                              <?php elseif($pc["transaction_status"] == "TERKONFIRMASI"): ?>
                                <span class="badge badge-pill badge-warning"><?= $pc["transaction_status"]; ?></span>
                              <?php elseif($pc["transaction_status"] == "PICKUP"): ?>
                              <span class="badge badge-pill badge-primary"><?= $pc["transaction_status"]; ?></span>
                              <?php else: ?>
                              <span class="badge badge-pill badge-success"><?= $pc["transaction_status"]; ?></span>
                              <?php endif; ?>
                            </td>
                            <?php 
                              $barangTiba = $pc["time_arrived"];
                            ?>
                            <?php if (isset($pc["time_arrived"])) : ?>
                              <td><?= date('d-m-Y H:i:s', strtotime($barangTiba) ); ?></td>
                            <?php else : ?>
                              <td>Belum disetel</td>
                            <?php endif;?>
                            <?php 
                              $tanggal = $pc["created_at"];
                            ?>
                            <td><?= date('d, F Y', strtotime($tanggal)); ?></td>
                            <td style="width: 17%; text-align: center;">
                              <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Aksi
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                  <a class="dropdown-item" href="?page=pickup-details&id=<?= $pc["id_transaction"]; ?>">Lihat</a>
                                  <?php if ($pc["transaction_status"] == "TERKONFIRMASI") : ?>
                                  <form action="" method="POST">
                                    <input type="hidden" name="id_transaction" value="<?= $pc["id_transaction"]; ?>">
                                    <button type="submit" onclick="return confirm('Apakah Barang Ingin di Pickup ?')" name="pickup" class="dropdown-item">Pickup</button>
                                  </form>
                                  <?php elseif($pc["transaction_status"] == "PICKUP"): ?>
                                    <a href="?page=pickup-receiver&id=<?= $pc["id_transaction"]; ?>" class="dropdown-item">terima</a>
                                  <?php endif;?>
                                </div>
                              </div>
                            </td>
                          </tr>
                          <?php $no++ ?>
                        <?php endforeach;?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
