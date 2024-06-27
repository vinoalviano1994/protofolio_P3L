<?php
    session_start();
    
    if($_SESSION['userType'] == 2){
        include('../db.php');
        $id = $_GET['id'];
        $query = mysqli_query($con, "SELECT i.id_jadwal, i.id_user_instruktur_pengganti , u.nama FROM izin_instruktur i JOIN user u ON i.id_user_instruktur_pengganti =u.id_user WHERE id_izin=$id") or
        die(mysqli_error($con));
        $data = mysqli_fetch_array($query);
        
        $idJadwal = $data['id_jadwal'];
        $idInstrukturPengganti = $data['id_user_instruktur_pengganti'];

        $keterangan = "Digantikan oleh " . $data['nama'];
        
        $query = mysqli_query($con,
        "UPDATE jadwal_kelas SET id_user_instruktur = '$idInstrukturPengganti', keterangan='$keterangan' WHERE id_jadwal=$idJadwal")
        or die(mysqli_error($con));

        $query2 = mysqli_query($con,
        "UPDATE izin_instruktur SET status_izin = 1 WHERE id_izin=$id")
        or die(mysqli_error($con));



            if($query && $query2){
                echo
                    '<script>
                    alert("Register Success!!");
                    window.location = "../page/listIzinInstrukturPage.php"
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