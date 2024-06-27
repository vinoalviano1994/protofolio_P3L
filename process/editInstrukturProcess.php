<?php
    session_start();
    
    if(isset($_POST['save']) && $_SESSION['userType'] == 1){
        include('../db.php');
        $ussername = $_POST['ussername'];
        $nama = $_POST['nama'];
        $tanggalLahir = $_POST['tanggalLahir'];
        $id = $_SESSION['idInstruktur'];

        $query = mysqli_query($con,
        "UPDATE user SET ussername = '$ussername', nama = '$nama' , tanggal_lahir = '$tanggalLahir' WHERE id_user=$id")
        or die(mysqli_error($con));
        
            if($query){
                echo
                    '<script>
                    alert("Data berhasil diubah");
                    window.location = "../page/listInstrukturPage.php"
                    </script>';
                
            }else{
                echo
                    '<script>
                    alert("Data gagal diubah");
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