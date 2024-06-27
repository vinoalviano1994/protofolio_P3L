<?php
session_start();
    if (!$_SESSION['isLogin']) {
        header("location: ../page/loginPage.php");
    }else {
        include('../db.php');
    }
    
    echo '
    <!Doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
            rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
            crossorigin="anonymous">
        <link rel="stylesheet" href="./style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap"
            rel="stylesheet">
        <title>Dashboard!</title>
        <style>
            *{
                font-family: "Poppins";
            }
                .side-bar {
                width: 280px;
                background-color: #0f5a7a;
                min-height: 100vh;
            }
            a {
                padding-left: 10px;
                font-size: 13px;
                text-decoration: none;
                color: white;
            }
            .menu i {
                padding-left: 20px;
            }
            .menu .content-menu {
                padding: 9px 7px;
            }
            .isActive {
                background-color: #071853 !important;
                border-right: 8px solid #010E2F;
            }
            i{
                color:white;
            }
            </style>
    </head>
    <body>
        <aside >
            <div class="d-flex">
            <div class="side-bar">
                <h3 class="text-light text-center pt-2">GO FIT</h3>
                <hr>
                <div class="menu">';
                    // Admin
                    if($_SESSION['userType'] == 1){
                        echo'
                        <div class="content-menu " >
                        <i class="fa fa-list"></i>
                        <a href="./listInstrukturPage.php" style="font-weight:600">List Instruktur</a>
                        </div>';
                    }else if($_SESSION['userType'] == 0){
                        echo'
                        <div class="content-menu " >
                        <i class="fa fa-list"></i>
                        <a href="./listMemberPage.php" style="font-weight:600">List Member</a>
                        </div>
                        
                        <div class="content-menu " >
                        <i class="fa fa-list"></i>
                        <a href="./listTransaksiPage.php" style="font-weight:600">Transaksi</a>
                        </div>
                        
                        <div class="content-menu " >
                        <i class="fa fa-list"></i>
                        <a href="./listKelasKadaluarsaPage.php" style="font-weight:600">Member Kadaluarsa</a>
                        </div>
                        
                        <div class="content-menu " >
                        <i class="fa fa-list"></i>
                        <a href="./menuPage.php" style="font-weight:600">Menu Page</a>
                        </div>
                        
                        <div class="content-menu " >
                        <i class="fa fa-list"></i>
                        <a href="./listPresensiGymPage.php" style="font-weight:600">Presensi Member</a>
                        </div>

                        <div class="content-menu " >
                        <i class="fa fa-list"></i>
                        <a href="./listAfterPresensiGymPage.php" style="font-weight:600">List Presensi Member</a>
                        </div>
                        
                        <div class="content-menu " >
                        <i class="fa fa-list"></i>
                        <a href="./listPresensiKelasPage.php" style="font-weight:600">Presensi Kelas</a>
                        </div>';
                    }else if($_SESSION['userType'] == 2){
                        echo'
                        <div class="content-menu " >
                        <i class="fa fa-list"></i>
                        <a href="./listJadwalPage.php" style="font-weight:600">Jadwal Kelas</a>
                        </div>
                        <div class="content-menu " >
                        <i class="fa fa-calendar"></i>
                        <a href="./listJadwalHarianPage.php" style="font-weight:600">Jadwal Harian</a>
                        </div>
                        <div class="content-menu " >
                        <i class="fa fa-user"></i>
                        <a href="./listIzinInstrukturPage.php" style="font-weight:600">Izin Instruktur</a>
                        </div>
                        <div class="content-menu " >
                        <i class="fa fa-file"></i>
                        <a href="./listLaporanBulananPage.php" style="font-weight:600">Laporan Gym Bulanan</a>
                        </div>
                        <div class="content-menu " >
                        <i class="fa fa-file"></i>
                        <a href="./listLaporaAktivitasKelasBulananPage.php" style="font-weight:600">Laporan Kelas</a>
                        </div>
                        <div class="content-menu " >
                        <i class="fa fa-file"></i>
                        <a href="./listLaporanKinerjainstrukturBulananPage.php" style="font-weight:600">Laporan Kerja Instruktur</a>
                        </div>
                        <div class="content-menu " >
                        <i class="fa fa-file"></i>
                        <a href="./listLaporaPendapatanTahunanPage.php" style="font-weight:600">Laporan Pendapatan</a>
                        </div>';
                        
                    }
                    
                    echo '
                    <div class="content-menu " >
                        <i class="fa fa-sign-out"></i>
                        <a href="../process/logoutProcess.php" onClick="return confirm ( \'Yakin Ingin Log Out ?\')" style="font-weight:600">Logout</a>
                    </div>
                    
                <hr>
            </div>
        </div>
    '
?>