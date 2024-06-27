<?php
    session_start();
    if(isset($_POST['register'])){
        include('../db.php');
        $id_jadwal_tetap =$_SESSION['jadwal_tetap'];
        $jumlahData = $_SESSION['count_data'];
        
/*
        $query = mysqli_query($con,
        "UPDATE user SET ussername = '$ussername', nama = '$nama' , tanggal_lahir = '$tanggalLahir' WHERE id_user=$id")
        or die(mysqli_error($con));
*/
        $date = date('m-d-y');
        

        

        
        do {
            $day = date('l', strtotime($date));
            if($day == "Monday"){
                $dateMonday = $date;
            }else{
                $date = str_replace('-', '/', $date);
                $date = date('d-m-Y',strtotime($date . "+1 days"));
            }
        } while ($day == "Monday");

        for ($i = 1; $i <= $jumlahData; $i++){
            $idNameJadwaltetap = $_POST['id_jadwal_tetap_'.$i];
            $idNameUserInstruktur = $_POST['id_user_instruktur_'.$i];
            $jadwalTetap = mysqli_query($con, "SELECT * FROM jadwal_tetap WHERE id_jadwal_tetap = $idNameJadwaltetap") or
                die(mysqli_error($con));
            $data = mysqli_fetch_array($jadwalTetap);

            $hari = $data['hari'];
            $jam_mulai = $data['jam_mulai'];
            $id_kelas = $data['id_kelas'];
            $id_user_instruktur = $data['id_user_instruktur'];
            $sort_hari = $data['sort_hari'];
            
            $insert = mysqli_query($con,
            "INSERT INTO jadwal_kelas(tanggal, hari, jam_mulai, id_kelas, id_user_instruktur, sort_hari, show_status)
            VALUES
            ('$tanggal', '$hari', '$jam_mulai', '$id_kelas', '$id_user_instruktur', '$sort_hari', 1)")
            or die(mysqli_error($con));
        }
            

                if($insert){
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
?>