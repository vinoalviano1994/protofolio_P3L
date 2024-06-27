<?php
    session_start();
    
    if($_SESSION['userType'] == 0){
        include('../db.php');
        

        $date = date('y-m-d');

        $lastDate = mysqli_query($con, "SELECT * FROM durasi_validasi WHERE id_durasi = 1") or
            die(mysqli_error($con));
        $lastDate = mysqli_fetch_array($lastDate);
        $tanggal_min_process = $lastDate['tanggal_minimal'];

        $date2 = strtotime($date);
        $tanggal_min_process = strtotime($tanggal_min_process);

        if($tanggal_min_process < $date2){

            //untuk agar bisa diganti tiap 1 bulan sekali
            $tanggal_minimal = date('y-m-d', strtotime('+1 month',strtotime($date)));
            $query = mysqli_query($con,
            "UPDATE durasi_validasi SET tanggal_minimal = $tanggal_minimal")
            or die(mysqli_error($con));

            $query2 = mysqli_query($con,
            "UPDATE user SET terlambat_instruktur = 0")
            or die(mysqli_error($con));

            if($query && $query2){
                echo
                    '<script>
                    alert("Berhasil Reset data terlambat instruktur");
                    window.location = "../page/menuPage.php"
                    </script>';
                
            }else{
                echo
                    '<script>
                    alert("Gagal [!]");
                    window.location = "../page/menuPage.php"
                    </script>';
            }
        }else{
            echo
                    '<script>
                    alert("Maxminal sebulan sekali reset data instruktur [!]");
                    window.location = "../page/menuPage.php"
                    </script>';
        }

        


            
    }else{
        echo
        '<script>
        alert("Gagal [!]");
        </script>';
    }
?>