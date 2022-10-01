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
<div
  class="section-content section-dashboard-home"
  data-aos="fade-up"
>
  <div class="container-fluid">
    <div class="dashboard-heading">
      <h2 class="dashboard-title">Dashboard</h2>
      <p class="dashboard-subtitle">Look what you have made today!</p>
    </div>
    <div class="dashboard-content">
      <div class="row">
        <div class="col-md-6">
          <div class="card mb-2">
            <div class="card-body">
                <?php 
                    $user = rows("SELECT * FROM users");
                ?>
              <div class="dashboard-card-title">Users</div>
              <div class="dashboard-card-subtitle"><?= $user; ?> User</div>
            </div>
          </div>
        </div>
        <!-- <div class="col-md-4">
          <div class="card mb-2">
            <div class="card-body">
              <div class="dashboard-card-title">Revenue</div>
              <div class="dashboard-card-subtitle">$931,290</div>
            </div>
          </div>
        </div> -->
       <!-- <div class="col-md-6">
          <div class="card mb-2">
            <div class="card-body">
            <?php 
                $driver = query("SELECT * FROM drivers WHERE id_driver = $id_driver")[0];
                $jurusan = $driver["jurusan"];
                $pickup = rows("SELECT * FROM transactions WHERE transaction_status = 'KONFIRMASI'  AND delivered = 1 AND city = '$jurusan' OR transaction_status = 'PICKUP'");
            
            ?>
              <!--<div class="dashboard-card-title">Pick Up</div>
              <div class="dashboard-card-subtitle"><?= number_format($pickup); ?> Pick Up</div>-->
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="row mt-3">
        <div class="col-12 mt-2">
          <h5 class="mb-3">Recent Transactions</h5>
          <a
            href="/dashboard-transactions-details.html"
            class="card card-list d-block"
          >
            <div class="card-body">
              <div class="row">
                <div class="col-md-1">
                  <img
                    src="../assets/images/1.jpg"
                    class="w-100"
                    alt=""
                  />
                </div>
                <div class="col-md-4">Shirup Marzan</div>
                <div class="col-md-3">Angga Risky</div>
                <div class="col-md-3">14, Januari 2020</div>
                <div class="col-md-1 d-none d-md-block">
                  <img src="/images/icon-row.svg" alt="" />
                </div>
              </div>
            </div>
          </a>
          <a
            href="/dashboard-transactions-details.html"
            class="card card-list d-block"
          >
            <div class="card-body">
              <div class="row">
                <div class="col-md-1">
                  <img
                    src="../assets/images/2.jpg"
                    class="w-100"
                    alt=""
                  />
                </div>
                <div class="col-md-4">Lebrone X</div>
                <div class="col-md-3">Masayashi</div>
                <div class="col-md-3">11 Januari, 2020</div>
                <div class="col-md-1 d-none d-md-block">
                  <img src="/images/icon-row.svg" alt="" />
                </div>
              </div>
            </div>
          </a>
          <a
            href="/dashboard-transactions-details.html"
            class="card card-list d-block"
          >
            <div class="card-body">
              <div class="row">
                <div class="col-md-1">
                  <img
                    src="../assets/images/3.jpg"
                    class="w-100"
                    alt=""
                  />
                </div>
                <div class="col-md-4">Soffa Lembutte</div>
                <div class="col-md-3">Shayna</div>
                <div class="col-md-3">10 Januari, 2020</div>
                <div class="col-md-1 d-none d-md-block">
                  <img src="/images/icon-row.svg" alt="" />
                </div>
              </div>
            </div>
          </a>
        </div>
      </div> -->
    </div>
  </div>
</div>