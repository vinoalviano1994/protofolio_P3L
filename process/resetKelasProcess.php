<?php
    session_start();
    
    if($_SESSION['userType'] == 0){
        include('../db.php');
        $id = $_GET['id'];
        $query = mysqli_query($con, "SELECT * FROM transaksi_deposit_kelas WHERE id_transaksi_dp_kelas=$id") or
        die(mysqli_error($con));
        $data = mysqli_fetch_array($query);
        $id_kelas = $data['id_kelas'];
        $id_user = $data['id_user'];
        $jumlah_kadaluarsa = $data['deposit'] + $data['bonus_deposit'];
        
        $query = mysqli_query($con,
        "UPDATE list_kelas_user SET jumlah = jumlah - $jumlah_kadaluarsa WHERE id_kelas=$id_kelas AND id_user=$id_user")
        or die(mysqli_error($con));

        $query2 = mysqli_query($con,
        "UPDATE transaksi_deposit_kelas SET kadaluarsa = 1 WHERE id_transaksi_dp_kelas=$id")
        or die(mysqli_error($con));

            if($query && $query2){
                echo
                    '<script>
                    alert("Berhasil Reset data kelas kadaluarsa!!");
                    window.location = "../page/listKelasKadaluarsaPage.php"
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