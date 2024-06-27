<?php
    session_start();
        if(isset($_GET['id']) && $_SESSION['userType'] == 2){
            include ('../db.php');
            $id = $_GET['id'];

            $query = mysqli_query($con, "SELECT * FROM jadwal_tetap where id_jadwal_tetap=$id") or
                die(mysqli_error($con));

                if (mysqli_num_rows($query) > 0) {
                    $queryDelete = mysqli_query($con, "DELETE FROM jadwal_tetap WHERE id_jadwal_tetap='$id'") or
                    die(mysqli_error($con));
                    
                    if($queryDelete){
                        echo
                            '<script>
                            alert("Delete Success!!"); window.location = "../page/listJadwalPage.php"
                            </script>';
                    }else{
                        echo
                            '<script>
                            alert("Delete Failed [!]"); window.location = "../page/listJadwalPage.php"
                            </script>';
                    }
                }else{
                    echo '<script>
                            alert("Kesalahan !"); window.location = "../page/listJadwalPage.php"
                        </script>';
                }
            
        }else {
            echo
                '<script>
                window.history.back()
                </script>';
    }
?>