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
                width: 260px;
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
            .navbar-dark .nav-item .nav-link {
                color: #fff;
              }
              
              .navbar-dark .nav-item .nav-link:hover {
                background-color: rgba(255, 255, 255, 0.1);
                transition: all 0.3s ease;
                border-radius: 0.25rem;
                color: #fff;
              }
              
              .fa-li {
                position: relative;
                left: 0;
              }
            </style>
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <!-- Container wrapper -->
    <div class="container">
      <!-- Navbar brand -->
      <a class="navbar-brand" href="#"><img id="MDB-logo"
          src="https://mdbcdn.b-cdn.net/wp-content/uploads/2018/06/logo-mdb-jquery-small.png" alt="MDB Logo"
          draggable="false" height="30" /></a>
  
      <!-- Toggle button -->
      <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
        data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="Toggle navigation">
        <i class="fa fa-list"></i>
      </button>
  
      <!-- Collapsible wrapper -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left links -->
        <ul class="navbar-nav me-3">
          <li class="nav-item">
            <a class="nav-link active d-flex align-items-center" aria-current="page" href="#"><i
                class="fa fa-list pe-2"></i>Jadwal Kelas</a>
          </li>
        </ul>
        <!-- Left links -->
  

  
        <ul class="navbar-nav ms-3">
          <li class="nav-item me-3">
            <a class="nav-link d-flex align-items-center" href="#!">Jadwal Harian</a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center me-3" href="#!">
              <i class="fas fa-bookmark pe-2"></i> Izin Instruktur
            </a>
          </li>
          <li class="nav-item" style="width: 65px;">
            <a class="nav-link d-flex align-items-center" href="#!">Laporan Gym Bulanan</a>
          </li>
          <li class="nav-item me-3">
            <a class="nav-link d-flex align-items-center" href="#!">Laporan Kelas Bulanan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center me-3" href="#!">
              <i class="fas fa-bookmark pe-2"></i> Laporan Kerja Instruktur Bulanan
            </a>
          </li>
          <li class="nav-item" style="width: 65px;">
            <a class="nav-link d-flex align-items-center" href="#!">Sign In</a>
          </li>
        </ul>
      </div>
      <!-- Collapsible wrapper -->
    </div>
    <!-- Container wrapper -->
  </nav>
    '
?>