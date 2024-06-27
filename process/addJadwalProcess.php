<?php
    
    if(isset($_POST['register'])){
        include('../db.php');
        $hari = $_POST['hari'];
        $jam_mulai = $_POST['jam_mulai'];
        $id_kelas = $_POST['id_kelas'];
        $id_user_instruktur = $_POST['id_user_instruktur'];
        if($hari == "Senin"){
            $sort_hari = 1;
        }else if($hari == "Selasa"){
            $sort_hari = 2;
        }else if($hari == "Rabu"){
            $sort_hari = 3;
        }else if($hari == "Kamis"){
            $sort_hari = 4;
        }else if($hari == "Jumat"){
            $sort_hari = 5;
        }else if($hari == "Sabtu"){
            $sort_hari = 6;
        }else{
            $sort_hari = 7;
        }

        $cekJadwalInstruktur = mysqli_query($con, "SELECT * FROM jadwal_tetap WHERE sort_hari='$sort_hari' AND jam_mulai='$jam_mulai' AND id_user_instruktur='$id_user_instruktur'") or
            die(mysqli_error($con));

        if (mysqli_num_rows($cekJadwalInstruktur) != 0) {
            echo '<script>
            alert("Jadwal Instruktur Bertabrakan !");
            window.location = "../page/listJadwalPage.php"
            </script>';
        }else{
            $query = mysqli_query($con,
            "INSERT INTO jadwal_tetap(hari, jam_mulai, id_kelas, id_user_instruktur, sort_hari)
            VALUES
            ('$hari', '$jam_mulai', '$id_kelas', '$id_user_instruktur', '$sort_hari')")
            or die(mysqli_error($con));

            if($query){
                echo
                    '<script>
                    alert("Success!!");
                    window.location = "../page/listJadwalPage.php"
                    </script>';
                
            }else{
                echo
                    '<script>
                    alert("Failed [!]");
                    </script>';
            }
        }
        }
        

        

?>