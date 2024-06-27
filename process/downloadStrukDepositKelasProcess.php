<?php
session_start();
require_once "../vendor/autoload.php";


use Dompdf\Dompdf;

if(1 ==1){
    include ('../db.php');
    $id = $_GET['id'];
    $query = mysqli_query($con, "SELECT * FROM transaksi_deposit_kelas WHERE id_transaksi_dp_kelas  = $id") or
    die(mysqli_error($con));
    $data_transaksi = mysqli_fetch_array($query);


    $id_member = $data_transaksi['id_user'];
    $noTransaksi = $data_transaksi['no_transaksi'];
    $tanggal = $data_transaksi['tanggal'];
    $deposit = $data_transaksi['deposit'];
    $bonusDeposit = $data_transaksi['bonus_deposit'];
    $totalDeposit = $data_transaksi['total_deposit'];
    $id_kelas = $data_transaksi['id_kelas'];
    $id_kasir = $data_transaksi['id_kasir'];
    $id_promo = $data_transaksi['id_promo'];
    $harga =  $data_transaksi['harga'];
    $masa_aktif = $data_transaksi['masa_aktif'];

    // cari nama member
    $member = mysqli_query($con, "SELECT * FROM user WHERE id_user  = $id_member") or
    die(mysqli_error($con));
    $member = mysqli_fetch_array($member);
    $ussername_member = $member['ussername'];
    $nama_member = $member['nama'];
    $member = $ussername_member . " / " . $nama_member;


    // cari nama kasir
    $kasir = mysqli_query($con, "SELECT * FROM user WHERE id_user = $id_kasir") or
    die(mysqli_error($con));
    $kasir = mysqli_fetch_array($kasir);
    $ussername_kasir = $kasir['ussername'];
    $nama_kasir = $kasir['nama'];
    $kasir = $ussername_kasir . " / " . $nama_kasir;

    // cari ID kelas
    $kelas = mysqli_query($con, "SELECT * FROM kelas WHERE id_kelas = $id_kelas") or
    die(mysqli_error($con));
    $kelas = mysqli_fetch_array($kelas);
    $nama_kelas = $kelas['nama_kelas'];
    $harga_kelas = $kelas['harga'];

    if($id_promo != -1){
        // cari nama promo
        $promo = mysqli_query($con, "SELECT * FROM promo WHERE id_promo = $id_promo") or
        die(mysqli_error($con));
        $promo = mysqli_fetch_array($promo);
        $nama_promo = $promo['nama_promo'];
    }





    
    
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
            <td><strong>No Struk:</strong> '.$noTransaksi.'</td>
        </tr>
        <tr>
            <td><strong>Kasir :</strong> '.$kasir.'</td>
        </tr>
        <br/>
        <tr>
            <td><strong>Member              :</strong> '.$member.'</td>
        </tr>
        <tr>
            <td><strong>Deposit ('.$nama_promo.')    :</strong> Rp. '.$harga.',- ( ' . $deposit . ' x ' . $harga_kelas . ' )</td>
        </tr>
        <tr>
            <td><strong>Jenis Kelas   :</strong> '.$nama_kelas.'</td>
        </tr>
        <tr>
            <td><strong>Total Deposit   :</strong> '.$totalDeposit.'</td>
        </tr>
        <tr>
            <td><strong>Berlaku sampai dengan   :</strong> Rp. '.$masa_aktif.'</td>
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
