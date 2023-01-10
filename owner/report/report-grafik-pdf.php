<?php 
require_once '../../assets/dompdf/autoload.php';
require_once '../../config/config.php';
use Dompdf\Dompdf;

$tanggalAwal = $_GET["tanggalAwal"];
$tanggalAkhir = $_GET["tanggalAkhir"];
$recordCustomer = query("SELECT SUM(transactions_details.banyak) as 'jumlah', users.name as 'name' FROM transactions_details INNER JOIN users ON transactions_details.user_id = users.id_user GROUP BY name");
foreach ($recordCustomer as $val) {
  @$labelsCostumer .= "'" . strtoupper($val['name']) . "',";
  @$jumlahCostumer .= "'" . strtoupper($val['jumlah']) . "',";
}

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


$html = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>REPORT GRAFIK PDF</title>
            <link href="../../assets/style/main.css" rel="stylesheet" />
        </head>
        <div>
            <h1 style="text-align: center;">LAPORAN PDF TRANSAKSI</h1>
            <h2 style="text-align: center; color: red;">KARYA INDAH</h2>
            <h3 style="text-align: center;">Tanggal '.date("d-m-Y", strtotime($tanggalAwal)).' - '.date("d-m-Y", strtotime($tanggalAkhir)).'</h3>
        </div> 
        ';

$html .= '<div class="container">
            <div class="ecommerce-widget">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                <div class="card">
                    <div class="card-header">
                    <h5 class="mb-0">Customer Potensial</h5>
                    </div>
                    <div class="card-body">
                    <canvas id="chartCust"></canvas>
                    </div>
                </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                <div class="card">
                    <div class="card-header">
                    <h5 class="mb-0">Asal Customer</h5>
                    </div>
                    <div class="card-body">
                    <canvas id="chartKota"></canvas>
                    </div>
                </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                <div class="card">
                    <div class="card-header">
                    <h5 class="mb-0">Kebiasaan Membeli</h5>
                    </div>
                    <div class="card-body">
                    <canvas id="chartBulan"></canvas>
                    </div>
                </div>
                </div>
                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                <div class="card">
                    <div class="card-header">
                    <h5 class="mb-0">Produk Terlaris</h5>
                    </div>
                    <div class="card-body">
                    <canvas id="chartProduk"></canvas>
                    </div>
                </div>
                </div>
            </div>
            </div>
            </div>
        ';

$html .= '
            <script src="../../assets/Chart.js"></script>

            <script>
            const labelsProduk = ['.$labelsProduk.'];

            const dataProduk = {
                labels: labelsProduk,
                datasets: [{
                label: "Produk Potensial",
                backgroundColor: "#28a745",
                borderColor: "#28a745",
                data: ['.$jumlahProduk.'],
                }]
            };

            const configProduk = {
                type: "bar",
                data: dataProduk,
                options: {}
            };

            const myChartProduk = new Chart(
                document.getElementById("chartProduk"),
                configProduk
            );


            const labelsDaerah = ['.$labelsDaerah.'];
            const dataKota = {
                labels: labelsDaerah,
                datasets: [{
                label: "Daerah Potensial",
                backgroundColor: "#28a745",
                borderColor: "#28a745",
                data: ['.$jumlahDaerah.'],
                }]
            };

            const configKota = {
                type: "bar",
                data: dataKota,
                options: {}
            };

            const myChartKota = new Chart(
                document.getElementById("chartKota"),
                configKota
            );

            const labelsBulan = ['.$labelsWaktu.'];

            const dataBulan = {
                labels: labelsBulan,
                datasets: [{
                label: "Waktu Potensial",
                backgroundColor: "#28a745",
                borderColor: "#28a745",
                data: ['.$jumlahWaktu.'],
                }]
            };

            const configBulan = {
                type: "bar",
                data: dataBulan,
                options: {}
            };

            const myChartBulan = new Chart(
                document.getElementById("chartBulan"),
                configBulan
            );

            const labelsCust = ['.$labelsCostumer.'];

            const dataCust = {
                labels: labelsCust,
                datasets: [{
                label: "Customer Potensial",
                backgroundColor: "#28a745",
                borderColor: "#28a745",
                data: ['.$jumlahCostumer.'],
                }]
            };

            const configCust = {
                type: "bar",
                data: dataCust,
                options: {}
            };

            const myChartCust = new Chart(
                document.getElementById("chartCust"),
                configCust
            );
            </script>
        ';
                                    
$html .= '
        <script src="../../assets/vendor/jquery/jquery.slim.min.js"></script>
        <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>
</html>';                           

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('report-pdf.pdf', array("Attachment"=>0));

?>