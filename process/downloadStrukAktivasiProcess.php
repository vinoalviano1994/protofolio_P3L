<?php
session_start();
require_once "../vendor/autoload.php";


use Dompdf\Dompdf;

if(1 ==1){
    include ('../db.php');
    $id = $_GET['id'];
    $query = mysqli_query($con, "SELECT * FROM transaksi_aktivasi WHERE id_transaksi_aktivasi = $id") or
    die(mysqli_error($con));
    $data_transaksi = mysqli_fetch_array($query);


    $nomorTransaksi = $data_transaksi['nomor_transaksi'];
    $tanggal = $data_transaksi['tanggal'];
    $biaya_aktivasi = $data_transaksi['biaya_aktivasi'];
    $masaAktifMembership = $data_transaksi['masa_aktif_membership'];
    $id_member = $data_transaksi['id_user_member'];
    $id_kasir = $data_transaksi['id_user_kasir'];

    $member = mysqli_query($con, "SELECT * FROM user WHERE id_user  = $id_member") or
    die(mysqli_error($con));
    $member = mysqli_fetch_array($member);

    $ussername_member = $member['ussername'];
    $nama_member = $member['nama'];
    $member = $ussername_member . " / " . $nama_member;

    $kasir = mysqli_query($con, "SELECT * FROM user WHERE id_user = $id_kasir") or
    die(mysqli_error($con));
    $kasir = mysqli_fetch_array($kasir);

    $ussername_kasir = $kasir['ussername'];
    $nama_kasir = $kasir['nama'];
    $kasir = $ussername_kasir . " / " . $nama_kasir;
    
    
    $dompdf = new Dompdf();
    ob_get_clean();
    $dompdf->loadHtml('
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <title>Aloha!</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        table{
            font-size: small;
        }
        tfoot tr td{
            font-weight: bold;
            font-size: x-small;
        }
        .gray {
            background-color: lightgray
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

    <table width="100%">
        <tr>
            <td><strong>Tanggal:</strong> '.$tanggal.'</td>
            <td><strong>No Struk:</strong> '.$nomorTransaksi.'</td>
        </tr>
        <tr>
            <td><strong>Kasir :</strong> '.$kasir.'</td>
        </tr>
        <br/>
        <tr>
            <td><strong>Member              :</strong> '.$member.'</td>
        </tr>
        <tr>
            <td><strong>Aktivasi Tahunan    :</strong> Rp. '.$biaya_aktivasi.'</td>
        </tr>
        <tr>
            <td><strong>Masa aktif member   :</strong> '.$masaAktifMembership.'</td>
        </tr>
        

    </table>


    <br/>


    </body>
    </html>');

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'potrait');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream();
    od_end_clean();
}

// instantiate and use the dompdf class
