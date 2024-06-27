<?php
    session_start();
    
    if($_SESSION['userType'] == 0){
        include('../db.php');
        $id = $_GET['id'];

        $query = mysqli_query($con, "SELECT tanggal_lahir FROM user WHERE id_user=$id") or
        die(mysqli_error($con));
        $data = mysqli_fetch_array($query);

        $tanggalLahir = $data['tanggal_lahir'];
        $tanggalLahir = new DateTime($tanggalLahir);
        $password2 = $tanggalLahir->format('d-m-y');
        $password = password_hash($password2, PASSWORD_DEFAULT);
        echo $data['tanggal_lahir'];
        echo $password2;

        $query = mysqli_query($con,
        "UPDATE user SET password = '$password' WHERE id_user=$id")
        or die(mysqli_error($con));
        
            if($query){
                echo 
                    '<script>
                    alert("Password berhasil direset");
                    window.location = "../page/listMemberPage.php"
                    </script>';
                
            }else{
                echo
                    '<script>
                    alert("Password gagal direset");
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