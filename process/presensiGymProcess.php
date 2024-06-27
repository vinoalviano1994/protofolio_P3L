<?php
    session_start();
    
    if($_SESSION['userType'] == 0){
        include('../db.php');
        $id = $_GET['id'];

        $notransaksi = date('y.m.');
        $notransaksi = $notransaksi . $id;

        $waktuPresensi = date('y-m-d h:i:s');

        
        $id_kasir = $_SESSION['id_user'];
        

        $query = mysqli_query($con,
        "UPDATE booking_gym SET status_presensi = 1, id_kasir= '$id_kasir', waktu_presensi = '$waktuPresensi', nomor_transaksi_presensi = '$notransaksi' WHERE id_booking_gym=$id")
        or die(mysqli_error($con));
            if($query){
                echo
                    '<script>
                    alert("Presensi Berhasil !!");
                    window.location = "../page/afterPresensiGymPage.php?id='.$id.'"
                    </script>';
            }else{
                echo
                    '<script>
                    alert("Gagal [!]");
                    </script>';
            }
    }else{
        echo
        '<script>
        alert("Gagal [!]");
        </script>';
    }
?>