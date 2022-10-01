<?php 
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'penjualan';
$conn = mysqli_connect($host, $user, $password, $dbname);

?>

<!DOCTYPE html>
<html>
<head>
    <title>MEMBUAT GRAFIK DARI DATABASE MYSQL DENGAN PHP DAN CHART.JS - www.malasngoding.com</title>
    <script type="text/javascript" src="chartjs/Chart.js"></script>
</head>
<body>
    <style type="text/css">
    body{
        font-family: roboto;
    }
 
    table{
        margin: 0px auto;
    }
    </style>
 
 
    <center>
        <h2>MEMBUAT GRAFIK DARI DATABASE MYSQL DENGAN PHP DAN CHART.JS<br/>- www.malasngoding.com -</h2>
    </center>
 
 
    <div style="width: 800px;margin: 0px auto;">
        <canvas id="myChart"></canvas>
    </div>
 
    <br/>
    <br/>
 
    <script>
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Teknik",],
                datasets: [{
                    label: '',
                    data: [
                    <?php 
                    $jumlah_teknik = mysqli_query($koneksi,"select * from transactions_details where code_product='PRD-12943'");
                    echo mysqli_num_rows($jumlah_teknik);
                    ?>,
                    ],
                    backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    ],
                    borderColor: [
                    'rgba(255,99,132,1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    </script>
</body>
</html>