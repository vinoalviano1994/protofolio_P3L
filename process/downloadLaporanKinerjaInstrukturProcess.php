<?php
session_start();
require_once "../vendor/autoload.php";


use Dompdf\Dompdf;

if(1 ==1){
    include ('../db.php');
    $month = $_SESSION['bulan'];
    $year = $_SESSION['tahun'];
    $month2 = $_SESSION['bulan_string'];
    if($month == NULL){
        $query = mysqli_query($con, "SELECT u.nama, sum(p.status_hadir) as hadir, sum(p.terlambat) as terlambatDetik, count(p.status_hadir) - sum(p.status_hadir) as libur, j.tanggal
                FROM presensi_instruktur p LEFT JOIN user u ON u.id_user = p.id_instruktur LEFT JOIN jadwal_kelas j ON j.id_jadwal = p.id_jadwal GROUP BY p.id_instruktur") or
                die(mysqli_error($con));
    }else{
        $query = mysqli_query($con, "SELECT u.nama, sum(p.status_hadir) as hadir, sum(p.terlambat) as terlambatDetik, count(p.status_hadir) - sum(p.status_hadir) as libur, j.tanggal
                    FROM presensi_instruktur p LEFT JOIN user u ON u.id_user = p.id_instruktur LEFT JOIN jadwal_kelas j ON j.id_jadwal = p.id_jadwal WHERE YEAR(j.tanggal) = $year AND MONTH(j.tanggal) = $month GROUP BY p.id_instruktur") or
                die(mysqli_error($con));
    }
    
    
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

    </H4>Laporan Kinerja Instruktur Bulan '.$month2.'<H4>
    </h5>Tanggal Cetak : '.date('y-m-d').' <h5>
    <table width="100%">
        <tr>
            <th>Nama</th>
            <th>Jumlah Hadir</th>
            <th>Jumlah Libur</th>
            <th>Waktu Terlambat (detik)</th>
        </tr>';

        if (mysqli_num_rows($query) == 0) {
                    $html .='<tr> <td colspan="7"> Tidak ada data </td> </tr>';
                }else{
                    $no = 1;
                while($data = mysqli_fetch_assoc($query)){

                    $html .='
                        <tr>
                        <td>'.$data['nama'].'</td>
                        <td>'.$data['hadir'].'</td>
                        <td>'.$data['libur'].'</td>
                        <td>'.$data['terlambatDetik'].'</td>
                        </tr>';
                    $no++;
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
