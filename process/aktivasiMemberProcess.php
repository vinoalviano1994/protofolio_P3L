<?php
    session_start();
    
    if($_SESSION['userType'] == 0){
        include('../db.php');
        $id = $_GET['id'];
        $date = date('y-m-d');
        $date2 = date('y-m-d h:i:s');
        $date = date('y-m-d', strtotime('+1 year',strtotime($date)));
        $id_kasir = $_SESSION['id_user'];

        //generate nomor transaksi

        $findId = mysqli_query($con, "SELECT id_transaksi_aktivasi FROM transaksi_aktivasi") or
            die(mysqli_error($con));

        $idTransaksi = 0;
        while($row = $findId->fetch_assoc()){
            if($idTransaksi <= $row["id_transaksi_aktivasi"]){
                $idTransaksi = $row['id_transaksi_aktivasi'];
            }
        }
        $idTransaksi = $idTransaksi+1;

        
        $notransaksi = date('y.m.');
        $notransaksi = $notransaksi . $idTransaksi;

        $query2 = mysqli_query($con,
        "UPDATE membership SET member_status = 1, masa_aktif_gym = '$date' WHERE id_user=$id")
        or die(mysqli_error($con));

        $query = mysqli_query($con,
            "INSERT INTO transaksi_aktivasi(id_user_member, nomor_transaksi, id_user_kasir, biaya_aktivasi, tanggal, masa_aktif_membership)
            VALUES
            ('$id', '$notransaksi' ,'$id_kasir', '3000000', '$date2', '$date')")
            or die(mysqli_error($con));

            if ($query) {
                //sysdate
                
                $last_id = mysqli_insert_id($con);
                $notransaksi = date('y.m.');
                $notransaksi = $notransaksi . $last_id;
                echo "New record created successfully. Last inserted ID is: " . $last_id;

                $query = mysqli_query($con,
                "UPDATE transaksi_aktivasi SET nomor_transaksi='$notransaksi' WHERE id_transaksi_aktivasi  = $last_id")
                or die(mysqli_error($con));
              } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
              }

            if($query && $query2){
                echo
                    '<script>
                    alert("Data berhasil diubah");
                    window.location = "../page/afterAktivasiPage.php?id='.$idTransaksi.'"
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