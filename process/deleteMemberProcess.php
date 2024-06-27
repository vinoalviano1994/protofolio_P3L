<?php
    session_start();
        if(isset($_GET['id']) && $_SESSION['userType'] == 0){
            include ('../db.php');
            $id = $_GET['id'];

            $query = mysqli_query($con, "SELECT * FROM user where id_user=$id") or
                die(mysqli_error($con));

                if (mysqli_num_rows($query) > 0) {
                    $queryDelete = mysqli_query($con, "DELETE FROM user WHERE id_user='$id'") or
                    die(mysqli_error($con));
                    $queryDelete2 = mysqli_query($con, "DELETE FROM membership WHERE id_user='$id'") or
                    die(mysqli_error($con));
                    if($queryDelete && $queryDelete2){
                        echo
                            '<script>
                            alert("Delete Success!!"); window.location = "../page/listMemberPage.php"
                            </script>';
                    }else{
                        echo
                            '<script>
                            alert("Delete Failed [!]"); window.location = "../page/listMemberPage.php"
                            </script>';
                    }
                }else{
                    echo '<script>
                            alert("Kesalahan !"); window.location = "../page/listMemberPage.php"
                        </script>';
                }
            
        }else {
            echo
                '<script>
                window.history.back()
                </script>';
    }
?>