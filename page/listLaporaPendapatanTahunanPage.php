<?php
include '../component/userSidebar.php'
?>
<div class="container p-3 m-4 h-100" style="background-color: #FFFFFF; border-top: 5px
    solid #0f5a7a; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0,
    0.19);" >
    <div class="body d-flex justify-content-between">
        <h4>LAPORAN AKTIVITAS KELAS BULANAN</h4>
    </div>
    <div>
        
    </div>
    <hr>
    <table class="table ">
        <thead>
            <tr>
            <th scope="col">Bulan</th>
            <th scope="col">Aktivasi</th>
            <th scope="col">Deposit</th>
            <th scope="col">Total</th>
            </tr>
            
        </div>
        </thead>

        <tbody>
            <?php

                $array_pendapatan = array(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
                $array_deposit_kelas = array(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
                $array_dp_uang = array(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

                $year = NULL;
                //ambil data pendapatan aktivasi
                $aktivasi = mysqli_query($con, "SELECT MONTH(TANGGAL) as bulan, SUM(biaya_aktivasi) as pendapatan_aktivasi FROM transaksi_aktivasi group by MONTH(TANGGAL)") or
                    die(mysqli_error($con));

                if (mysqli_num_rows($aktivasi) == 0) {
                    $arrayAktivasi = NULL;
                }else{
                    $arrayAktivasi = 1;
                    $no = 1;
                    $jumlahBulanAktivasi = 0;
                while($data_aktivasi = mysqli_fetch_assoc($aktivasi)){
                        $array_pendapatan[$data_aktivasi['bulan']] = $data_aktivasi['pendapatan_aktivasi'];
                        $no++;
                        if($jumlahBulanAktivasi < $data_aktivasi['bulan']){
                            $jumlahBulanAktivasi = $data_aktivasi['bulan'];
                        }
                    }
                }

                //ambil data pendapatan deposit kelas
                $deposit_kelas = mysqli_query($con, "SELECT MONTH(TANGGAL) as bulan, SUM(harga) as pendapatan_deposit_kelas FROM transaksi_deposit_kelas group by MONTH(TANGGAL)") or
                    die(mysqli_error($con));

                if (mysqli_num_rows($deposit_kelas) == 0) {
                    $arrayDpKelas = NULL;
                }else{
                    $arrayDpKelas = 1;
                    $no = 1;
                    $jumlahBulanDpKelas = 0;
                while($data_Dp_kelas = mysqli_fetch_assoc($deposit_kelas)){
                        $array_deposit_kelas[$data_Dp_kelas['bulan']] = $data_Dp_kelas['pendapatan_deposit_kelas'];
                        $no++;
                        if($jumlahBulanDpKelas < $data_Dp_kelas['bulan']){
                            $jumlahBulanDpKelas = $data_Dp_kelas['bulan'];
                        }
                    }
                }

                //ambil data pendapatan deposit uang
                $deposit_uang = mysqli_query($con, "SELECT MONTH(TANGGAL) as bulan, SUM(deposit) as pendapatan_deposit_uang FROM transaksi_deposit_uang group by MONTH(TANGGAL)") or
                    die(mysqli_error($con));

                if (mysqli_num_rows($deposit_uang) == 0) {
                    $arrayDpUang = NULL;
                }else{
                    $arrayDpUang = 1;
                    $no = 1;
                    $jumlahBulanDpUang = 0;
                while($data_deposit_uang = mysqli_fetch_assoc($deposit_uang)){
                        $array_dp_uang[$data_deposit_uang['bulan']] = $data_deposit_uang['pendapatan_deposit_uang'];
                        $no++;
                        if($jumlahBulanDpUang < $data_deposit_uang['bulan']){
                            $jumlahBulanDpUang = $data_deposit_uang['bulan'];
                        }
                    }
                }

                $tahun = "Semua Tahun";

                ////
                //// ISEET

                
                    echo '
                <form action="" method="post">
                    <span>
                        <select name="day" id="day" hidden></select>
                    </span>
                    <span>
                        <select name="month" id="month" hidden></select>
                    </span>
                    <span>
                        <label for="year">Year:</label>
                        <select name="year" id="year">Year:</select>
                    </span>
                    <button type="submit" name="cari" class="btn btn-outline-primary">search</button>
                </form>
                
                ';
                
                

                if( isset($_POST["cari"])) {
                    $year = $_POST['year'];
                    $tahun = $_POST['year'];

                        
                    

                    $array_pendapatan = array(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
                    $array_deposit_kelas = array(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
                    $array_dp_uang = array(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

                    //ambil data pendapatan aktivasi
                    $aktivasi = mysqli_query($con, "SELECT MONTH(TANGGAL) as bulan, SUM(biaya_aktivasi) as pendapatan_aktivasi FROM transaksi_aktivasi WHERE YEAR(tanggal) = $year group by MONTH(TANGGAL)") or
                        die(mysqli_error($con));

                    if (mysqli_num_rows($aktivasi) == 0) {
                        $arrayAktivasi = NULL;
                    }else{
                        $arrayAktivasi = 1;
                        $no = 1;
                        $jumlahBulanAktivasi = 0;
                    while($data_aktivasi = mysqli_fetch_assoc($aktivasi)){
                            $array_pendapatan[$data_aktivasi['bulan']] = $data_aktivasi['pendapatan_aktivasi'];
                            $no++;
                            if($jumlahBulanAktivasi < $data_aktivasi['bulan']){
                                $jumlahBulanAktivasi = $data_aktivasi['bulan'];
                            }
                        }
                    }

                    //ambil data pendapatan deposit kelas
                    $deposit_kelas = mysqli_query($con, "SELECT MONTH(TANGGAL) as bulan, SUM(harga) as pendapatan_deposit_kelas FROM transaksi_deposit_kelas WHERE YEAR(tanggal) = $year group by MONTH(TANGGAL)") or
                        die(mysqli_error($con));

                    if (mysqli_num_rows($deposit_kelas) == 0) {
                        $arrayDpKelas = NULL;
                    }else{
                        $arrayDpKelas = 1;
                        $no = 1;
                        $jumlahBulanDpKelas = 0;
                    while($data_Dp_kelas = mysqli_fetch_assoc($deposit_kelas)){
                            $array_deposit_kelas[$data_Dp_kelas['bulan']] = $data_Dp_kelas['pendapatan_deposit_kelas'];
                            $no++;
                            if($jumlahBulanDpKelas < $data_Dp_kelas['bulan']){
                                $jumlahBulanDpKelas = $data_Dp_kelas['bulan'];
                            }
                        }
                    }
                    

                    //ambil data pendapatan deposit uang
                    $deposit_uang = mysqli_query($con, "SELECT MONTH(TANGGAL) as bulan, SUM(deposit) as pendapatan_deposit_uang FROM transaksi_deposit_uang WHERE YEAR(tanggal) = $year group by MONTH(TANGGAL)") or
                        die(mysqli_error($con));

                    if (mysqli_num_rows($deposit_uang) == 0) {
                        $arrayDpUang = NULL;
                    }else{
                        $arrayDpUang = 1;
                        $no = 1;
                        $jumlahBulanDpUang = 0;
                    while($data_deposit_uang = mysqli_fetch_assoc($deposit_uang)){
                            $array_dp_uang[$data_deposit_uang['bulan']] = $data_deposit_uang['pendapatan_deposit_uang'];
                            $no++;
                            if($jumlahBulanDpUang < $data_deposit_uang['bulan']){
                                $jumlahBulanDpUang = $data_deposit_uang['bulan'];
                            }
                        }
                    }
                }

                $_SESSION['tahun'] = $year;

                echo '
                <hr>
                <div class="body d-flex justify-content-between">
                    <h4>Kategori : '.$tahun.'</h4>
                </div>';
                    
                

       /*         
                echo'

                <a href="../process/downloadLaporanPendapatanProcess.php" class="btn btn-success btn-lg" tabindex="-1" role="button" aria-disabled="false">CETAK STRUK</a>
                '; */
                $i = 0; 
                if($i < $jumlahBulanAktivasi){
                    $i = $jumlahBulanAktivasi;
                }
                if($i < $jumlahBulanDpKelas){
                    $i = $jumlahBulanDpKelas;
                }
                if($i < $jumlahBulanDpUang){
                    $i = $jumlahBulanDpUang;
                }
                $j = 1;

                //ubah bulan ke string
                
                
                if ($arrayAktivasi == NULL && $arrayDpKelas == NULL && $arrayDpUang == NULL) {
                    echo '<tr> <td colspan="7"> Tidak ada data </td> </tr>';
                }else{
                    
                while($j <= $i){
                    if($j == 1){
                        $month = "January";
                    }else if($j == 2){
                        $month = "February";
                    }else if($j == 3){
                        $month = "March";
                    }else if($j == 4){
                        $month = "April";
                    }else if($j == 5){
                        $month = "Mei";
                    }else if($j == 6){
                        $month = "June";
                    }else if($j == 7){
                        $month = "July";
                    }else if($j == 8){
                        $month = "August";
                    }else if($j == 9){
                        $month = "September";
                    }else if($j == 10){
                        $month = "October";
                    }else if($j == 11){
                        $month = "November";
                    }else if($j == 12){
                        $month = "December";
                    }
                    $totalAll = 0;

                    echo'
                        <tr>';
                        if($array_pendapatan[$j] == NULL && $array_deposit_kelas[$j] == NULL && $array_dp_uang[$j] == NULL){

                        }else{
                            echo '<td>'.$month.'</td>';
                            if($array_pendapatan[$j] == NULL){
                                $array_pendapatan[$j] == 0;
                            }
                                echo '<td>'.$array_pendapatan[$j].'</td>';
                            if($array_deposit_kelas[$j] == NULL){
                                $array_deposit_kelas[$j] == 0;
                            }
                            if($array_dp_uang[$j] == NULL){
                                $array_dp_uang[$j] = 0;
                            }
                                $totalDeposit = $array_dp_uang[$j] + $array_deposit_kelas[$j];
                                echo '<td>'.$totalDeposit.'</td>';
                                $total = $array_pendapatan[$j] + $totalDeposit;
                                echo '<td>'.$total.'</td>';
                                $totalAll = $totalAll + $total;
                        }
                        
                            
                            
                            
                                
                        echo '</tr>';
                    $j++;
                }
                echo "  Subtotal = " . $totalAll;
                
            }
            ?>
        </tbody>
    </table>
</div>
</aside>
<script
src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
crossorigin="anonymous"></script>
<script
src="../script.js"></script>
</body>
</html>