<?php
    session_start();
        if(isset($_GET['id']) && $_SESSION['userType'] == 0){
            include ('../db.php');
            $id = $_GET['id'];

            $query = mysqli_query($con,
                "UPDATE membership SET member_status = '0', deposit_uang = '0', masa_aktif_gym = 'NULL' WHERE id_user=$id")
                or die(mysqli_error($con));

            $queryDelete = mysqli_query($con, "DELETE FROM list_kelas_user WHERE id_user='$id'") or
                    die(mysqli_error($con));

            if($query && $queryDelete){
                echo
                    '<script>
                    alert("Delete Success!!"); window.location = "../page/listTransaksiPage.php"
                    </script>';
            }else{
                echo
                    '<script>
                    alert("Delete Failed [!]"); window.location = "../page/listTransaksiPage.php"
                    </script>';
            }
        }else {
            echo
                '<script>
                window.history.back()
                </script>';
    }
?>