<?php 
require_once '../../assets/dompdf/autoload.php';
require_once '../../config/config.php';
use Dompdf\Dompdf;

$tanggalAwal = $_GET["tanggalAwal"];
$tanggalAkhir = $_GET["tanggalAkhir"];
$no = 1;
$query = "SELECT * FROM transactions INNER JOIN users ON transactions.user_id = users.id_user INNER JOIN rekening_numbers ON transactions.rekening_id = rekening_numbers.id_rekening WHERE created_at BETWEEN '$tanggalAwal' AND '$tanggalAkhir'";
$transactions = query($query);


$html = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>REPORT TRANSACTIONS PDF</title>
            <style>
                table, th, td {
                    font-size: 14px;
                    border: 1px solid black;
                    border-collapse: collapse;
                    padding: 5px;
                }
            </style>';

$html .= '<div>
            <h1 style="text-align: center;">LAPORAN PDF TRANSAKSI</h1>
            <h2 style="text-align: center; color: red;">KARYA INDAH</h2>
        </div>    
        <table width="100%">
            <thead>
                <tr>
                    <th width="5%">ID</th>
                    <th width="15%">Code</th>
                    <th width="20%">Nama</th>
                    <th width="20%">Total</th>
                    <th width="5%">Pembayaran</th>
                    <th width="10%">Kota</th>
                    <th width="25%">Tanggal</th>
                </tr>
            </thead>
            <tbody>';
                $total = 0;
                foreach ($transactions as $transaction) {
                    $tanggal = $transaction["created_at"];
                    $total += $transaction["total_price"];
                    $html .= '<tr>
                                <th>' . $no++ . '</th>
                                <td>#'. $transaction["code"] .'</td>
                                <td>'. $transaction["name"] .'</td>
                                <td>Rp. '. number_format($transaction["total_price"]) .'</td>
                                <td>'. $transaction["bank_name"]  .'</td>
                                <td>'. $transaction["city"] .'</td>
                                <td>'. date('d, F Y', strtotime($tanggal)) .'</td>
                            </tr>';
                }
                    $html .= '</tbody>
                        </table>
                    
                        <div style="margin-top: 20px;">Total</div>
                        <h3>Rp. '. number_format($total) .'</h3>
                        ';
                    
                
                                    
$html .= '
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