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
        $query = mysqli_query($con, "SELECT tanggal, sum(terisi) as jumlah from sesi_gym group by tanggal") or
                die(mysqli_error($con));
    }else{
        $query = mysqli_query($con, "SELECT tanggal, sum(terisi) as jumlah from sesi_gym WHERE YEAR(tanggal) = $year AND MONTH(tanggal) = $month group by tanggal") or
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

    </H4>Laporan Aktivitas Gym Bulan '.$month2.'<H4>
    </h5>Tanggal Cetak : '.date('y-m-d').' <h5>
    <table width="100%">
        <tr>
            <th>Tanggal</th>
            <th>Jumlah Member</th>
        </tr>';

        $jumlah = 0;
        if (mysqli_num_rows($query) == 0) {
                    $html .='<tr> <td colspan="7"> Tidak ada data </td> </tr>';
                }else{
                    $no = 1;
                    $jumlah = 0;
                while($data = mysqli_fetch_assoc($query)){

                    $html .='
                        <tr>
                            <td>'.$data['tanggal'].'</td>
                            <td>'.$data['jumlah'].'</td>
                                
                        </tr>';
                    $no++;
                    $jumlah = $jumlah + $data['jumlah'];
                }
            }
        
    $html .='</table>
    <hr>
    </h5> Jumlah : '.$jumlah.' <h5>

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
