<?php
    
    if(isset($_POST['register'])){
        include('../db.php');
        $ussername = $_POST['ussername'];
        $nama = $_POST['nama'];
        $tanggalLahir = $_POST['tanggal_lahir'];
        $password = new DateTime($_POST['tanggal_lahir']);
        $password = $password->format('d-m-y');
        $password = password_hash($password, PASSWORD_DEFAULT);
        $availableCheck = 0;

        $findEmail = mysqli_query($con, "SELECT * FROM user WHERE ussername='$ussername'") or
            die(mysqli_error($con));

        if (mysqli_num_rows($findEmail) != 0) {
            echo '<script>
            alert("Ussername sudah terpakai [!]");
            </script>';
            $availableCheck += 1;
        }

        if($availableCheck != 0){
            echo
            '<script>
                alert("Register Failed [!]");
                window.location = "../page/registerPage.php"
            </script>';
        }else{
            $query = mysqli_query($con,
            "INSERT INTO user(ussername, password, nama, tanggal_lahir, id_user_type)
            VALUES
            ('$ussername', '$password', '$nama', '$tanggalLahir', '3')")
            or die(mysqli_error($con));

            if($query){
                echo
                    '<script>
                    alert("Berhasil tambah data Instruktur!!");
                    window.location = "../page/listInstrukturPage.php"
                    </script>';
                
            }else{
                echo
                    '<script>
                    alert("Gagal tambah data Instruktur");
                    </script>';
            }
        }

        
    }else{
        echo
            '<script>
            window.history.back()
            </script>';
    }
?>