<?php
    session_start();
    if(isset($_POST['register'])){
        include('../db.php');
        $id_jadwal_tetap =$_SESSION['jadwal_tetap'];
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

        $cekJadwalInstruktur = mysqli_query($con, "SELECT * FROM jadwal_tetap WHERE (sort_hari='$sort_hari' AND jam_mulai='$jam_mulai' 
        AND id_user_instruktur='$id_user_instruktur') AND id_jadwal_tetap <> '$id_jadwal_tetap'") or
            die(mysqli_error($con));

        if (mysqli_num_rows($cekJadwalInstruktur) != 0) {
            echo '<script>
            alert("Jadwal Instruktur Bertabrakan !");
            window.location = "../page/listJadwalPage.php"
            </script>';
        }else{
            $query = mysqli_query($con,
                "UPDATE jadwal_tetap SET hari='$hari' ,jam_mulai='$jam_mulai' , id_kelas='$id_kelas' ,id_user_instruktur='$id_user_instruktur' , 
                sort_hari='$sort_hari' WHERE id_jadwal_tetap=$id_jadwal_tetap")
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