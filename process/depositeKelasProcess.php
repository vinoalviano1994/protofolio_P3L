<?php
    session_start();
    
    if(isset($_POST['register']) && $_SESSION['userType'] == 0){
        include('../db.php');
        $id = $_SESSION['idUser'];
        $date = date('y-m-d');
        
        $id_promo = $_POST['promo'];
        if($id_promo == 7){
            $deposit_kelas = 5;
            $masaAktif = date('y-m-d', strtotime('+1 month',strtotime($date)));
            $bonus = 1;
        }else{
            $deposit_kelas = 10;
            $masaAktif = date('y-m-d', strtotime('+2 month',strtotime($date)));
            $bonus = 3;
        }
        
        $id_kelas = $_POST['id_kelas'];
        $date = date('y-m-d');
        $id_kasir = $_SESSION['id_user'];
        $date = date('y-m-d');
        $date2 = date('y-m-d h:i:s');

        // cek apakah kelas sudah di beli sebelumnya
        $findKelas = mysqli_query($con, "SELECT * FROM list_kelas_user WHERE id_user='$id' AND id_kelas='$id_kelas'") or
            die(mysqli_error($con));

        if (1 == 0) {
        
        // agar masa aktif terlama yang masuk ke database
        $masaAktifDb = $findKelas['masa_aktif'];
        if($masaAktifDb < $masaAktif){
            $masaAktif = $masaAktifDb;
        }


        }else{
            // cari harga kelas
                $kelas = mysqli_query($con, "SELECT * FROM kelas WHERE id_kelas = $id_kelas") or
                die(mysqli_error($con));
            $kelas = mysqli_fetch_array($kelas);
            $harga_kelas = $kelas['harga'];
            $hargaTotal = $deposit_kelas * $harga_kelas;

            

            $findId = mysqli_query($con, "SELECT id_transaksi_dp_kelas FROM transaksi_deposit_kelas") or
            die(mysqli_error($con));

            $idTransaksi = 0;
            while($row = $findId->fetch_assoc()){
                if($idTransaksi <= $row["id_transaksi_dp_kelas"]){
                    $idTransaksi = $row['id_transaksi_dp_kelas'];
                }
            }
            $idTransaksi = $idTransaksi+1;

            $notransaksi = date('y.m.');
            $notransaksi = $notransaksi . $idTransaksi;

            if($minimalKelas > $deposit_kelas && $validatePromo == 1){
                echo
                        '<script>
                        alert("Kelas kurang untuk menggunakan Promo !");
                        history.back();
                        </script>';
            }else{

                //ambil sisa deposit
                $kelasList = mysqli_query($con, "SELECT * FROM list_kelas_user WHERE id_user = $id AND id_kelas = $id_kelas") or
                die(mysqli_error($con));
                $kelasList = mysqli_fetch_array($kelasList);
                $sisa = $kelasList['jumlah'];
                
                $totalDeposit = $bonus + $deposit_kelas + $sisa;
                
                // add transaksi ke database
                $query = mysqli_query($con,
                "INSERT INTO transaksi_deposit_kelas(id_user, tanggal, no_transaksi, deposit, bonus_deposit, total_deposit, harga, id_kasir, id_kelas, id_promo, masa_aktif)
                VALUES
                ('$id', '$date' , '$notransaksi', '$deposit_kelas', '$bonus', '$totalDeposit', '$hargaTotal','$id_kasir', '$id_kelas', '$id_promo', '$masaAktif')")
                or die(mysqli_error($con));

                // add ke db per kelas
                if(mysqli_num_rows($findKelas) != 0){
                    $query2 = mysqli_query($con,
                    "UPDATE list_kelas_user SET jumlah = '$totalDeposit', masa_aktif = '$masaAktif' WHERE id_user=$id")
                    or die(mysqli_error($con));
                }else{
                    $query2 = mysqli_query($con,
                    "INSERT INTO list_kelas_user(id_user, id_kelas, jumlah, masa_aktif)
                    VALUES
                    ('$id', '$id_kelas' , '$totalDeposit', '$masaAktif')")
                    or die(mysqli_error($con));
                }
                
                
                // add saldo ke user database
                $query3 = mysqli_query($con,
                "UPDATE membership SET deposit_kelas = '$totalDeposit' WHERE id_user=$id")
                or die(mysqli_error($con));
                if($query && $query2 && $query3){
                    echo
                        '<script>
                        alert("Data berhasil diubah");
                        window.location = "../page/afterDepositKelasPage.php?id='.$idTransaksi.'"
                        </script>';
                    
                }else{
                    echo
                        '<script>
                        alert("Failed [!]");
                        </script>';
                }
            }
        }

        
    }

        

?>