<?php
    
    if(isset($_POST['register'])){
        include('../db.php');
        $findId = mysqli_query($con, "SELECT id_user FROM user") or
            die(mysqli_error($con));


        

        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $telepon = $_POST['telepon'];
        $tanggalLahir = $_POST['tanggal_lahir'];
        $password = new DateTime($_POST['tanggal_lahir']);
        $password = $password->format('d-m-y');
        $password = password_hash($password, PASSWORD_DEFAULT);
        $availableCheck = 0;

        if($availableCheck != 0){
            echo
            '<script>
                alert("Register Failed [!]");
                window.location = "../page/registerPage.php"
            </script>';
        }else{
            $query = mysqli_query($con,
            "INSERT INTO user(password, nama, tanggal_lahir, id_user_type)
            VALUES
            ('$password', '$nama', '$tanggalLahir', '4')")
            or die(mysqli_error($con));

            if ($query) {
                //sysdate
                
                $last_id = mysqli_insert_id($con);
                $ussername = date('y.m.');
                $ussername = $ussername . $last_id;
                echo "New record created successfully. Last inserted ID is: " . $last_id;

                $query = mysqli_query($con,
                "UPDATE user SET ussername='$ussername' WHERE id_user = $last_id")
                or die(mysqli_error($con));
              } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
              }

            $query2 = mysqli_query($con,
            "INSERT INTO membership(alamat, telepon, id_user)
            VALUES
            ('$alamat', '$telepon', '$last_id')")
            or die(mysqli_error($con));



            if($query){
                echo
                    '<script>
                    alert("Register Success!!");
                    window.location = "../page/listMemberPage.php"
                    </script>';
                
            }else{
                echo
                    '<script>
                    alert("Register Failed [!]");
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