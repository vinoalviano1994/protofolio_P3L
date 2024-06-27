<?php
    session_start();
    
    if($_SESSION['userType'] == 2){
        include('../db.php');
        $id = $_GET['id'];

        $query = mysqli_query($con,
        "UPDATE jadwal_kelas SET libur = '1' WHERE id_jadwal=$id")
        or die(mysqli_error($con));
        $query2 = mysqli_query($con,
        "UPDATE jadwal_kelas SET keterangan = 'Libur' WHERE id_jadwal=$id")
        or die(mysqli_error($con));
        
            if($query && $query2){
                echo
                    '<script>
                    alert("Data berhasil diubah");
                    window.location = "../page/listJadwalHarianPage.php"
                    </script>';
                
            }else{
                echo
                    '<script>
                    alert("Gagal diliburkan !");
                    </script>';
            }
    }else{
        echo
            '<script>
            alert("Anda tidak memiliki aksess");
            window.history.back()
            </script>';
    }
?>