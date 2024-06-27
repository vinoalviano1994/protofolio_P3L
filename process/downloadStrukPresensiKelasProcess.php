<?php
session_start();
require_once "../vendor/autoload.php";


use Dompdf\Dompdf;

if(1 ==1){
    include ('../db.php');
    $id = $_GET['id'];
    $query = mysqli_query($con, "SELECT * FROM booking_kelas WHERE id_booking_kelas  = $id") or
die(mysqli_error($con));
$booking_kelas = mysqli_fetch_array($query);


$id_member = $booking_kelas['id_member'];
$noTransaksi = $booking_kelas['nomor_transaksi_presensi'];
$id_jadwal_kelas = $booking_kelas['id_jadwal_kelas'];
$tanggal = $booking_kelas['waktu_presensi'];
$tipe_kelas = $booking_kelas['tipe_kelas'];
$sisa_deposit_uang = $booking_kelas['sisa_deposit_uang'];
$sisa_deposit_kelas = $booking_kelas['sisa_deposit_kelas'];
$berlaku_kelas = $booking_kelas['berlaku_kelas'];

// cari nama member
$member = mysqli_query($con, "SELECT u.ussername, u.nama FROM membership m JOIN user u ON m.id_user = u.id_user WHERE m.id_member  = $id_member") or
die(mysqli_error($con));
$member = mysqli_fetch_array($member);
$ussername_member = $member['ussername'];
$nama_member = $member['nama'];
$member = $ussername_member . " / " . $nama_member;


// cari ID jadwal kelas
$sesi_kelas = mysqli_query($con, "SELECT * FROM jadwal_kelas WHERE id_jadwal = $id_jadwal_kelas") or
die(mysqli_error($con));
$sesi_kelas = mysqli_fetch_array($sesi_kelas);
$sesi = $sesi_kelas['tanggal'] . " / " . $sesi_kelas['jam_mulai'];
$id_kelas = $sesi_kelas['id_kelas'];
$id_instruktur = $sesi_kelas['id_user_instruktur'];

// cari ID jadwal kelas
$kelas = mysqli_query($con, "SELECT * FROM kelas WHERE id_kelas = $id_kelas") or
die(mysqli_error($con));
$kelas = mysqli_fetch_array($kelas);
$nama_kelas = $kelas['nama_kelas'];
$harga_kelas = $kelas['harga'];
    
//cari instruktur
$intruktur = mysqli_query($con, "SELECT * FROM user WHERE id_user = $id_instruktur") or
die(mysqli_error($con));
$intruktur = mysqli_fetch_array($intruktur);
$nama_instruktur = $instruktur['nama'];
    
    $dompdf = new Dompdf();
    ob_get_clean();

    if($tipe_kelas == 0){
        $dompdf->loadHtml('
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <title>STRUK PRESENSI KELAS - '.$noTransaksi.'</title>

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
        <br/>
        <tr>
            <td><strong>Member              :</strong> '.$member.'</td>
        </tr>
        <tr>
            <td><strong>Kelas   :</strong> '.$nama_kelas.'</td>
        </tr>
        <tr>
            <td><strong>Tanggal Kelas   :</strong> '.$sesi.'</td>
        </tr>
        <tr>
                <td><strong>Tarif   :</strong> '.$harga_kelas.'</td>
            </tr>
            <tr>
                <td><strong>Sisa Deposit   :</strong> '.$sisa_deposit_uang.'</td>
            </tr>
        
    </table>


    <br/>


    </body>
    </html>');
    }else{
        $dompdf->loadHtml('
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <title>STRUK PRESENSI GYM - '.$noTransaksi.'</title>

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
        <br/>
        <tr>
            <td><strong>Member              :</strong> '.$member.'</td>
        </tr>
        <tr>
            <td><strong>Kelas   :</strong> '.$nama_kelas.'</td>
        </tr>
        <tr>
            <td><strong>Tanggal Kelas   :</strong> '.$sesi.'</td>
        </tr>
        <tr>
                <td><strong>Sisa Deposit   :</strong> '.$sisa_deposit_kelas.'</td>
            </tr><tr>
                <td><strong>Berlaku Sampai   :</strong> '.$berlaku_kelas.'</td>
            </tr>
        
        
    </table>


    <br/>


    </body>
    </html>');
    }
    

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'potrait');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream();
    od_end_clean();
}

// instantiate and use the dompdf class
