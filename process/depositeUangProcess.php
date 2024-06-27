<?php
    session_start();
    
    if(isset($_POST['register']) && $_SESSION['userType'] == 0){
        include('../db.php');
        $id = $_SESSION['idUser'];
        $nominal = $_POST['nominal'];
        $id_promo = $_POST['promo'];
        $date = date('y-m-d');
        $id_kasir = $_SESSION['id_user'];
        $date = date('y-m-d');
        $date2 = date('y-m-d h:i:s');
        echo $id_promo;
        if($id_promo == -1){
            $validatePromo = 0;
            $minimalDP = 0;
            $bonus = 0;
        }else{
            $promo = mysqli_query($con, "SELECT bonus_deposit, minimal_deposit FROM promo WHERE id_promo = $id_promo") or
            die(mysqli_error($con));

            $dataPromo = mysqli_fetch_array($promo);
            $minimalDP = $dataPromo['minimal_deposit'];
            $bonus = $dataPromo['bonus_deposit'];
            $validatePromo = 1;

        
        }

        $findId = mysqli_query($con, "SELECT id_transaksi_dp_uang FROM transaksi_deposit_uang") or
        die(mysqli_error($con));

        $idTransaksi = 0;
        while($row = $findId->fetch_assoc()){
            if($idTransaksi <= $row["id_transaksi_dp_uang"]){
                $idTransaksi = $row['id_transaksi_dp_uang'];
            }
        }
        $idTransaksi = $idTransaksi+1;

        $notransaksi = date('y.m.');
        $notransaksi = $notransaksi . $idTransaksi;

        if($minimalDP > $nominal && $validatePromo == 1){
            echo
                    '<script>
                    alert("Nominal kurang untuk menggunakan Promo !");
                    history.back();
                    </script>';
        }else{

            //ambil sisa deposit
            $member = mysqli_query($con, "SELECT deposit_uang FROM membership WHERE id_user = $id") or
            die(mysqli_error($con));

            $membership = mysqli_fetch_array($member);
            $saldo = $membership['deposit_uang'];

            $totalDeposit = $saldo + $bonus + $nominal;
            
            // add transaksi ke database
            $query = mysqli_query($con,
            "INSERT INTO transaksi_deposit_uang(id_user, tanggal, no_transaksi, deposit, bonus_deposit, sisa_deposit, total_deposit, id_kasir)
            VALUES
            ('$id', '$date' , '$notransaksi', '$nominal', '$bonus', '$saldo', '$totalDeposit', '$id_kasir')")
            or die(mysqli_error($con));

            
            // add saldo ke user database
            $query2 = mysqli_query($con,
            "UPDATE membership SET deposit_uang = '$totalDeposit' WHERE id_user=$id")
            or die(mysqli_error($con));
            if($query && $query2){
                echo
                    '<script>
                    alert("Data berhasil diubah");
                    window.location = "../page/afterDepositUangPage.php?id='.$idTransaksi.'"
                    </script>';
                
            }else{
                echo
                    '<script>
                    alert("Failed [!]");
                    </script>';
            }
        }
        }

        

?>