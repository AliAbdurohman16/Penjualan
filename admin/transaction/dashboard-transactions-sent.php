<?php 

if (isset($_POST["konfirmasi"])) {
  if (konfirmasi($_POST) > 0) {
    header("Location: ?page=transactions-sent");
  }
}

if (isset($_POST["terkirim"])) {
  if (terkirim($_POST) > 0) {
    header("Location: ?page=transactions-sent");
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
      <h2 class="dashboard-title">My Transaction</h2>
      <p class="dashboard-subtitle">This is menu for your transactions</p>
    </div>
    <div class="dashboard-content">
      <div class="row mt-4">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-12">
                  <?php if (isset($_SESSION["success"])) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <?= $_SESSION["success"]; ?>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  <?php endif;?>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table class="table table-striped table-hover" id="table">
                      <thead>
                        <tr>
                          <th scope="col">ID</th>
                          <th scope="col">Code</th>
                          <th scope="col">Nama</th>
                          <th scope="col">Total</th>
                          <th scope="col">Pembayaran</th>
                          <th scope="col">Status</th>
                          <th scope="col">Penerima</th>
                          <th scope="col">Tanggal</th>
                          <th scope="col" class="text-center">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          $no = 1;
                          $user_id = $_SESSION["user"];
                          $query = "SELECT * FROM transactions INNER JOIN users ON transactions.user_id = users.id_user INNER JOIN rekening_numbers ON transactions.rekening_id = rekening_numbers.id_rekening WHERE transaction_status = 'TERKIRIM'";
                          $transactions = query($query);
                        ?>
                        <?php foreach ($transactions as $transaction) : ?>
                          <tr>
                            <th scope="row"><?= $no; ?></th>
                            <td>#<?= $transaction["code"]; ?></td>
                            <td><?= $transaction["name"]; ?></td>
                            <td><?= number_format($transaction["total_price"]); ?></td>
                            <td><?= $transaction["bank_name"]; ?></td>
                            <td>
                              <?php if ($transaction["transaction_status"] == "BELUM KONFIRMASI") : ?>
                                <span class="badge badge-pill badge-danger"><?= $transaction["transaction_status"]; ?></span>
                              <?php elseif($transaction["transaction_status"] == "TERKONFIRMASI"): ?>
                              <span class="badge badge-pill badge-warning"><?= $transaction["transaction_status"]; ?></span>
                              <?php elseif($transaction["transaction_status"] == "PICKUP") : ?>
                                <span class="badge badge-pill badge-primary"><?= $transaction["transaction_status"]; ?></span>
                              <?php else: ?>
                                <span class="badge badge-pill badge-success"><?= $transaction["transaction_status"]; ?></span>
                              <?php endif; ?>
                            </td>
                            <?php if (isset($transaction["receiver"])) : ?>
                              <td><?= $transaction["receiver"] ? $transaction['receiver'] : 'Belum Diterima'; ?></td>
                            <?php endif;?>
                            <?php 
                              $tanggal = $transaction["created_at"];
                            ?>
                            <td><?= date('d, F Y', strtotime($tanggal)); ?></td>
                            <td style="width: 17%; text-align: center;">
                              <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Aksi
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                  <a class="dropdown-item" href="?page=transactions-details&id=<?= $transaction["id_transaction"]; ?>">Lihat</a>
                                  <?php if($transaction["transaction_status"] == "TERKONFIRMASI" && $transaction["delivered"] == 0): ?>
                                    <a href="?page=transactions-receiver&id=<?= $transaction["id_transaction"]; ?>" class="dropdown-item">terima</a>
                                  <?php endif; ?>
                                  <a class="dropdown-item" onclick="return confirm('Apakah Ingin Menghapus transaction ini ?')" href="?page=transactions-delete&id=<?= $transaction["id_transaction"]; ?>">Delete</a>
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
