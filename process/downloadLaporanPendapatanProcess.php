<?php
session_start();
require_once "../vendor/autoload.php";


use Dompdf\Dompdf;

if(1 ==1){
    include ('../db.php');
    $year = $_SESSION['tahun'];
    if($year == NULL){
        $array_pendapatan = array(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
                $array_deposit_kelas = array(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
                $array_dp_uang = array(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

                //ambil data pendapatan aktivasi
                $aktivasi = mysqli_query($con, "SELECT MONTH(TANGGAL) as bulan, SUM(biaya_aktivasi) as pendapatan_aktivasi FROM transaksi_aktivasi group by MONTH(TANGGAL)") or
                    die(mysqli_error($con));

                if (mysqli_num_rows($aktivasi) == 0) {
                    $arrayAktivasi = NULL;
                }else{
                    $arrayAktivasi = 1;
                    $no = 1;
                    $jumlahBulanAktivasi = 0;
                while($data_aktivasi = mysqli_fetch_assoc($aktivasi)){
                        $array_pendapatan[$data_aktivasi['bulan']] = $data_aktivasi['pendapatan_aktivasi'];
                        $no++;
                        if($jumlahBulanAktivasi < $data_aktivasi['bulan']){
                            $jumlahBulanAktivasi = $data_aktivasi['bulan'];
                        }
                    }
                }

                //ambil data pendapatan deposit kelas
                $deposit_kelas = mysqli_query($con, "SELECT MONTH(TANGGAL) as bulan, SUM(harga) as pendapatan_deposit_kelas FROM transaksi_deposit_kelas group by MONTH(TANGGAL)") or
                    die(mysqli_error($con));

                if (mysqli_num_rows($deposit_kelas) == 0) {
                    $arrayDpKelas = NULL;
                }else{
                    $arrayDpKelas = 1;
                    $no = 1;
                    $jumlahBulanDpKelas = 0;
                while($data_Dp_kelas = mysqli_fetch_assoc($deposit_kelas)){
                        $array_deposit_kelas[$data_Dp_kelas['bulan']] = $data_Dp_kelas['pendapatan_deposit_kelas'];
                        $no++;
                        if($jumlahBulanDpKelas < $data_Dp_kelas['bulan']){
                            $jumlahBulanDpKelas = $data_Dp_kelas['bulan'];
                        }
                    }
                }

                //ambil data pendapatan deposit uang
                $deposit_uang = mysqli_query($con, "SELECT MONTH(TANGGAL) as bulan, SUM(deposit) as pendapatan_deposit_uang FROM transaksi_deposit_uang group by MONTH(TANGGAL)") or
                    die(mysqli_error($con));

                if (mysqli_num_rows($deposit_uang) == 0) {
                    $arrayDpUang = NULL;
                }else{
                    $arrayDpUang = 1;
                    $no = 1;
                    $jumlahBulanDpUang = 0;
                while($data_deposit_uang = mysqli_fetch_assoc($deposit_uang)){
                        $array_dp_uang[$data_deposit_uang['bulan']] = $data_deposit_uang['pendapatan_deposit_uang'];
                        $no++;
                        if($jumlahBulanDpUang < $data_deposit_uang['bulan']){
                            $jumlahBulanDpUang = $data_deposit_uang['bulan'];
                        }
                    }
                }
    }else{
        $array_pendapatan = array(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        $array_deposit_kelas = array(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        $array_dp_uang = array(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

        //ambil data pendapatan aktivasi
        $aktivasi = mysqli_query($con, "SELECT MONTH(TANGGAL) as bulan, SUM(biaya_aktivasi) as pendapatan_aktivasi FROM transaksi_aktivasi WHERE YEAR(tanggal) = $year group by MONTH(TANGGAL)") or
            die(mysqli_error($con));

        if (mysqli_num_rows($aktivasi) == 0) {
            $arrayAktivasi = NULL;
        }else{
            $arrayAktivasi = 1;
            $no = 1;
            $jumlahBulanAktivasi = 0;
            while($data_aktivasi = mysqli_fetch_assoc($aktivasi)){
                $array_pendapatan[$data_aktivasi['bulan']] = $data_aktivasi['pendapatan_aktivasi'];
                $no++;
                if($jumlahBulanAktivasi < $data_aktivasi['bulan']){
                    $jumlahBulanAktivasi = $data_aktivasi['bulan'];
                }
            }
        }

        //ambil data pendapatan deposit kelas
        $deposit_kelas = mysqli_query($con, "SELECT MONTH(TANGGAL) as bulan, SUM(harga) as pendapatan_deposit_kelas FROM transaksi_deposit_kelas WHERE YEAR(tanggal) = $year group by MONTH(TANGGAL)") or
            die(mysqli_error($con));

        if (mysqli_num_rows($deposit_kelas) == 0) {
            $arrayDpKelas = NULL;
        }else{
            $arrayDpKelas = 1;
            $no = 1;
            $jumlahBulanDpKelas = 0;
            while($data_Dp_kelas = mysqli_fetch_assoc($deposit_kelas)){
                $array_deposit_kelas[$data_Dp_kelas['bulan']] = $data_Dp_kelas['pendapatan_deposit_kelas'];
                $no++;
                if($jumlahBulanDpKelas < $data_Dp_kelas['bulan']){
                    $jumlahBulanDpKelas = $data_Dp_kelas['bulan'];
                }
            }
        }
                    

        //ambil data pendapatan deposit uang
        $deposit_uang = mysqli_query($con, "SELECT MONTH(TANGGAL) as bulan, SUM(deposit) as pendapatan_deposit_uang FROM transaksi_deposit_uang WHERE YEAR(tanggal) = $year group by MONTH(TANGGAL)") or
            die(mysqli_error($con));

        if (mysqli_num_rows($deposit_uang) == 0) {
            $arrayDpUang = NULL;
        }else{
            $arrayDpUang = 1;
            $no = 1;
            $jumlahBulanDpUang = 0;
            while($data_deposit_uang = mysqli_fetch_assoc($deposit_uang)){
                $array_dp_uang[$data_deposit_uang['bulan']] = $data_deposit_uang['pendapatan_deposit_uang'];
                $no++;
                if($jumlahBulanDpUang < $data_deposit_uang['bulan']){
                    $jumlahBulanDpUang = $data_deposit_uang['bulan'];
                }
            }
        }
    }

    $i = 0; 
                if($i < $jumlahBulanAktivasi){
                    $i = $jumlahBulanAktivasi;
                }
                if($i < $jumlahBulanDpKelas){
                    $i = $jumlahBulanDpKelas;
                }
                if($i < $jumlahBulanDpUang){
                    $i = $jumlahBulanDpUang;
                }
                $j = 1;

                
    
    $html .= '<html lang="en">
    <head>
    <meta charset="UTF-8">
    <title>LAPORAN BULANAN</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        tfoot tr td{
            font-weight: bold;
            font-size: x-small;
        }
        .gray {
            background-color: lightgray
        }
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
          }
          
          td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
          }
          
          tr:nth-child(even) {
            background-color: #dddddd;
          }
    </style>

    </head>
    <body>

    <table width="100%">
        <tr>
            
            <td align="left">
                <h1>Go Fit</h1>
                <pre>Jl. Centralpark No. 10 Yogyakarta
                </pre>
            </td>
        </tr>

    </table>

    </H4>Laporan Kinerja Instruktur Bulan '.$year.'<H4>
    </h5>Tanggal Cetak : '.date('y-m-d').' <h5>
    <table width="100%">
        <tr>
            <th>Nama</th>
            <th>Jumlah Hadir</th>
            <th>Jumlah Libur</th>
            <th>Waktu Terlambat (detik)</th>
        </tr>';

        if ($arrayAktivasi == NULL && $arrayDpKelas == NULL && $arrayDpUang == NULL) {
            echo '<tr> <td colspan="7"> Tidak ada data </td> </tr>';
        }else{
            
        while($j <= $i){
            if($j == 1){
                $month = "January";
            }else if($j == 2){
                $month = "February";
            }else if($j == 3){
                $month = "March";
            }else if($j == 4){
                $month = "April";
            }else if($j == 5){
                $month = "Mei";
            }else if($j == 6){
                $month = "June";
            }else if($j == 7){
                $month = "July";
            }else if($j == 8){
                $month = "August";
            }else if($j == 9){
                $month = "September";
            }else if($j == 10){
                $month = "October";
            }else if($j == 11){
                $month = "November";
            }else if($j == 12){
                $month = "December";
            }

            $html .= '
                <tr>';
                if($array_pendapatan[$j] == NULL && $array_deposit_kelas[$j] == NULL && $array_dp_uang[$j] == NULL){

                }else{
                    $html .=  '<td>'.$month.'</td>';
                    if($array_pendapatan[$j] == NULL){
                        $array_pendapatan[$j] == 0;
                    }
                    $html .=  '<td>'.$array_pendapatan[$j].'</td>';
                    if($array_deposit_kelas[$j] == NULL){
                        $array_deposit_kelas[$j] == 0;
                    }
                    if($array_dp_uang[$j] == NULL){
                        $array_dp_uang[$j] = 0;
                    }
                        $totalDeposit = $array_dp_uang[$j] + $array_deposit_kelas[$j];
                        $html .=  '<td>'.$totalDeposit.'</td>';
                        $total = $array_pendapatan[$j] + $totalDeposit;
                        $html .=  '<td>'.$total.'</td>';
                }
                
                $html .=   '</tr>';
        }
    }
        
    $html .='</table>
    <hr>

    <br/>


    </body>
    </html>';
    $html .= ' sop';
    
    $dompdf = new Dompdf();
    ob_get_clean();
    $dompdf->loadHtml($html);

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'potrait');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream();
    od_end_clean();
}

// instantiate and use the dompdf class
