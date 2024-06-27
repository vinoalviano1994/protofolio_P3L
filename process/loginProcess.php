<?php
    if(isset($_POST['login'])){
        include('../db.php');

        $ussername = $_POST['ussername'];
        $password = $_POST['password'];
        $query = mysqli_query($con, "SELECT * FROM user WHERE ussername = '$ussername'") or
        die(mysqli_error($con));

        if(mysqli_num_rows($query) == 0){
            echo
                '<script>
                alert("Pengguna tidak ada !"); window.location = "../page/loginPage.php"
                </script>';
            }else{
                $user = mysqli_fetch_assoc($query);
                if(password_verify($password, $user['password'])){

                    session_start();

                    $_SESSION['isLogin'] = true;
                    $_SESSION['user'] = $user;
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['id_user'] = $user['id_user'];
                    $_SESSION['userType'] = $user['id_user_type'];
                    
                    if($_SESSION['userType'] == 1){
                        echo
                        '<script>
                        alert("Berhasil Login !"); window.location = "../page/listInstrukturPage.php"
                        </script>';
                    }
                    if($_SESSION['userType'] == 0){
                        echo
                        '<script>
                        alert("Berhasil Login !"); window.location = "../page/listMemberPage.php"
                        </script>';
                    }
                    if($_SESSION['userType'] == 2){
                        echo
                        '<script>
                        alert("Berhasil Login !"); window.location = "../page/listJadwalPage.php"
                        </script>';
                    }
                    echo
                    '<script>
                    alert("Berhasil Login !"); window.location = "../page/dashboardPage.php"
                    </script>';
                }else {
                    echo
                    '<script>
                    alert("Email or Password Invalid [!]");
                    window.location = "../page/loginPage.php"
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