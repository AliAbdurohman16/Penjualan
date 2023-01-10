<nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top" data-aos="fade-down">
  <div class="container-fluid">
    <button class="btn btn-secondary d-md-none mr-auto mr-2" id="menu-toggle">
      &laquo; Menu
    </button>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collpase navbar-collapse" id="navbarResponsive">
      <!-- dekstop menu -->
      <ul class="navbar-nav d-none d-lg-flex ml-auto">
        <li class="nav-item dropdown">
          <a href="#" class="nav-link" id="navbarDropdown" role="button" data-toggle="dropdown">
            <img src="../assets/images/person-circle.svg" alt="profile" height="40px" class="rounded-circle mr-2 profile-picture" />
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
      <h2 class="dashboard-title">Dashboard</h2>
      <p class="dashboard-subtitle">Look what you have made today!</p>
    </div>
    <div class="dashboard-content">
      <div class="row">
        <div class="col-md-4">
          <div class="card mb-2">
            <div class="card-body">
              <?php
              $Users = rows("SELECT * FROM users");
              ?>
              <div class="dashboard-card-title">Users</div>
              <div class="dashboard-card-subtitle"><?= $Users; ?></div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card mb-2">
            <div class="card-body">
              <?php
              $transactions = query("SELECT * FROM transactions");
              $total_price = 0;
              foreach ($transactions as $t) {
                $total_price += $t["total_price"];
              }

              $total_price_product = 0;
              $products = query("SELECT * FROM products");
              foreach ($products as $p) {
                $total_price_product += $p["price"];
              }

              $revenue = $total_price - $total_price_product;
              if ($revenue < 0) {
                $revenue = 0;
              }
              ?>
              <div class="dashboard-card-title">Revenue</div>
              <div class="dashboard-card-subtitle">Rp. <?= number_format($revenue); ?></div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card mb-2">
            <div class="card-body">
              <?php
              $transactionCount = rows("SELECT * FROM transactions");
              ?>
              <div class="dashboard-card-title">Transaction</div>
              <div class="dashboard-card-subtitle"><?= $transactionCount; ?></div>
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
      <div class="row mt-3 mb-3">
        <div class="col-12">
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#cetakGrafikPDF">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill mr-1" viewBox="0 0 16 16">
              <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
              <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
            </svg> Cetak Grafik PDF
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="ecommerce-widget">
    <div class="row">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="card">
          <div class="card-header">
            <h5 class="mb-0">Customer Potensial</h5>
          </div>
          <div class="card-body">
            <canvas id="chartCust"></canvas>
          </div>
          <div class="card-footer">
            <a href="?page=transactions" class="btn btn-success float-right">View Details</a>
          </div>
        </div>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="card">
          <div class="card-header">
            <h5 class="mb-0">Asal Customer</h5>
          </div>
          <div class="card-body">
            <canvas id="chartKota"></canvas>
          </div>
          <div class="card-footer">
            <a href="?page=transactions" class="btn btn-success float-right">View Details</a>
          </div>
        </div>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="card">
          <div class="card-header">
            <h5 class="mb-0">Kebiasaan Membeli</h5>
          </div>
          <div class="card-body">
            <canvas id="chartBulan"></canvas>
          </div>
          <div class="card-footer">
            <a href="?page=transactions" class="btn btn-success float-right">View Details</a>
          </div>
        </div>
      </div>
      <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
          <div class="card-header">
            <h5 class="mb-0">Produk Terlaris</h5>
          </div>
          <div class="card-body">
            <canvas id="chartProduk"></canvas>
          </div>
          <div class="card-footer">
            <a href="?page=transactions" class="btn btn-success float-right">View Details</a>
          </div>
        </div>
      </div>
      <div class="mt-3 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
          <div class="card-header">
            <h5 class="mb-0">Berdasarkan Customer</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th scope="col">NO</th>
                    <th scope="col">Pilihan Kebijakan</th>
                    <th scope="col">Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  $dataTertinggiCutomer = query("SELECT SUM(transactions_details.banyak) as 'jumlah', users.name as 'name' FROM transactions_details INNER JOIN users ON transactions_details.user_id = users.id_user GROUP BY name ORDER BY jumlah DESC");
                  ?>

                  <tr>
                    <th scope="row"><?= $no++; ?></th>
                    <td>Harga Spesial</td>
                    <td>
                      <?php foreach ($dataTertinggiCutomer as $customer) : ?>
                        <?php if ($customer['jumlah'] >= 9) : ?>
                        <?= ucwords($customer['name']); ?>,
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row"><?= $no++; ?></th>
                    <td>Gift</td>
                    <td>
                      <?php foreach ($dataTertinggiCutomer as $customer) : ?>
                        <?php if ($customer['jumlah'] >= 9) : ?>
                        <?= ucwords($customer['name']); ?>,
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </td>
                  </tr>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="mt-3 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
          <div class="card-header">
            <h5 class="mb-0">Berdasarkan Daerah</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th scope="col">NO</th>
                    <th scope="col">Pilihan Kebijakan</th>
                    <th scope="col">Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  $dataTertinggiDaerah = query("SELECT COUNT(id_transaction) as 'jumlah', city as 'city' FROM transactions GROUP BY city ORDER BY jumlah DESC LIMIT 1");
                  ?>

                  <tr>
                    <th scope="row"><?= $no++; ?></th>
                    <td>Buka Cabang</td>
                    <td>
                      <?php foreach ($dataTertinggiDaerah as $daerah) : ?>
                        <?= $daerah['city']; ?>
                      <?php endforeach; ?>
                    </td>
                  </tr>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="mt-3 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
          <div class="card-header">
            <h5 class="mb-0">Berdasarkan Hari</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th scope="col">NO</th>
                    <th scope="col">Pilihan Kebijakan</th>
                    <th scope="col">Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  ?>
                  <tr>
                    <th scope="row"><?= $no++; ?></th>
                    <td>Promo peringatan di hari tertentu</td>
                    <td>Promo di moment-moment hari besar dan akhir atau awal tahun</td>
                  </tr>
                  <?php
                  $no = 2;
                  ?>
                  <th scope="row"><?= $no++; ?></th>
                    <td>Diskon awal bulan</td>
                    <td>Diskon setiap awal bulan (tanggal 3 s/d tanggal 7)</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="mt-3 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
          <div class="card-header">
            <h5 class="mb-0">Berdasarkan Produk</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th scope="col">NO</th>
                    <th scope="col">Pilihan Kebijakan</th>
                    <th scope="col">Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  $dataTertinggi = query("SELECT SUM(transactions_details.banyak) as 'jumlah', products.product_name as 'name' FROM transactions_details INNER JOIN products ON transactions_details.product_id = products.id_product GROUP BY product_id ORDER BY jumlah DESC LIMIT 1");

                  $dataTerendah = query("SELECT SUM(transactions_details.banyak) as 'jumlah', products.product_name as 'name' FROM transactions_details INNER JOIN products ON transactions_details.product_id = products.id_product GROUP BY product_id ORDER BY jumlah ASC LIMIT 1");

                  $dataDiscount = query("SELECT SUM(transactions_details.banyak) as 'jumlah', products.product_name as 'name' FROM transactions_details INNER JOIN products ON transactions_details.product_id = products.id_product GROUP BY product_id ORDER BY jumlah ASC LIMIT 5");
                  ?>

                  <tr>
                    <th scope="row"><?= $no++; ?></th>
                    <td>Bundling</td>
                    <td>
                      <?php foreach ($dataTertinggi as $tinggi) : ?>
                        <?php foreach ($dataTerendah as $rendah) : ?>
                          <?= ucwords($tinggi['name']) . ' dan ' . ucwords($rendah['name']); ?>
                        <?php endforeach; ?>
                      <?php endforeach; ?>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row"><?= $no++; ?></th>
                    <td>Beli 2 gratis 1</td>
                    <td>
                      <?php foreach ($dataTerendah as $rendah) : ?>
                        <?= ucwords($rendah['name']); ?>
                      <?php endforeach; ?>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row"><?= $no++; ?></th>
                    <td>Diskon</td>
                    <td>
                      <?php foreach ($dataDiscount as $discount) : ?>
                        <?= ucwords($discount['name']); ?>,
                      <?php endforeach; ?>
                    </td>
                  </tr>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
$recordCustomer = query("SELECT SUM(transactions_details.banyak) as 'jumlah', users.name as 'name' FROM transactions_details INNER JOIN users ON transactions_details.user_id = users.id_user GROUP BY name");
foreach ($recordCustomer as $val) {
  @$labelsCostumer .= "'" . strtoupper($val['name']) . "',";
  @$jumlahCostumer .= "'" . strtoupper($val['jumlah']) . "',";
  // $scale = $val['jumlah'] % 0.5;
}
// echo $scale;

$recordDaerah = query("SELECT COUNT(id_transaction) as 'jumlah', city as 'city' FROM transactions GROUP BY city");
foreach ($recordDaerah as $val) {
  @$labelsDaerah .= "'" . strtoupper($val['city']) . "',";
  @$jumlahDaerah .= "'" . strtoupper($val['jumlah']) . "',";
}

$recordWaktu = query("SELECT COUNT(id_transaction) as jumlah, DAY(time_arrived) as tanggal FROM transactions WHERE (date(time_arrived) between date_add(curdate(),interval -DAY(curdate())+1 DAY) AND LAST_DAY(CURDATE())) GROUP BY DAY(time_arrived)");
foreach ($recordWaktu as $val) {
  @$labelsWaktu .= "'" . strtoupper($val['tanggal']) . "',";
  @$jumlahWaktu .= "'" . strtoupper($val['jumlah']) . "',";
}

$recordProduct = query("SELECT SUM(transactions_details.banyak) as 'jumlah', products.product_name as 'name' FROM transactions_details INNER JOIN products ON transactions_details.product_id = products.id_product GROUP BY product_id");
foreach ($recordProduct as $val) {
  @$labelsProduk .= "'" . strtoupper($val['name']) . "',";
  @$jumlahProduk .= "'" . strtoupper($val['jumlah']) . "',";
}
?>

<!-- Ini Buat Grafik -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const labelsProduk = [<?= $labelsProduk ?>];

  const dataProduk = {
    labels: labelsProduk,
    datasets: [{
      label: 'Produk Potensial',
      backgroundColor: '#28a745',
      borderColor: '#28a745',
      data: [<?= $jumlahProduk ?>],
    }]
  };

  const configProduk = {
    type: 'bar',
    data: dataProduk,
  };

  const myChartProduk = new Chart(
    document.getElementById('chartProduk'),
    configProduk
  );


  const labelsDaerah = [<?= $labelsDaerah ?>];
  const dataKota = {
    labels: labelsDaerah,
    datasets: [{
      label: 'Daerah Potensial',
      backgroundColor: '#28a745',
      borderColor: '#28a745',
      data: [<?= $jumlahDaerah ?>],
    }]
  };

  const configKota = {
    type: 'bar',
    data: dataKota,
  };

  const myChartKota = new Chart(
    document.getElementById('chartKota'),
    configKota
  );

  const labelsBulan = [<?= $labelsWaktu ?>];

  const dataBulan = {
    labels: labelsBulan,
    datasets: [{
      label: 'Waktu Potensial',
      backgroundColor: '#28a745',
      borderColor: '#28a745',
      data: [<?= $jumlahWaktu ?>],
    }]
  };

  const configBulan = {
    type: 'bar',
    data: dataBulan,
  };

  const myChartBulan = new Chart(
    document.getElementById('chartBulan'),
    configBulan
  );

  const labelsCust = [<?= $labelsCostumer ?>];

  const dataCust = {
    labels: labelsCust,
    datasets: [{
      label: 'Customer Potensial',
      backgroundColor: '#28a745',
      borderColor: '#28a745',
      data: [<?= $jumlahCostumer ?>],
    }],
  };

  const successTracker = {
    id: 'successTracker',
    beforeDraw(chart, args, options) {
      const { ctx, chartArea: { top, right, bottom, left, width, height }, scales: { x, y } } = chart; 
      ctx.save();
      
      // success line
      ctx.strokeStyle = 'green';
      ctx.strokeRect(left, y.getPixelForValue(9), width, 0);
      ctx.restore();

      // success background
      ctx.fillStyle = 'rgba(0, 200, 0, 0.2)';
      ctx.fillRect(left, top, width, y.getPixelForValue(9) - top);
    }
  }

  const configCust = {
    type: 'bar',
    data: dataCust,
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    },
    plugins: [successTracker],
  };

  const myChartCust = new Chart(
    document.getElementById('chartCust'),
    configCust
  );

</script>