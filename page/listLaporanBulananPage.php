<?php
include '../component/userSidebar.php'
?>
<div class="container p-3 m-4 h-100" style="background-color: #FFFFFF; border-top: 5px
    solid #0f5a7a; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0,
    0.19);" >
    <div class="body d-flex justify-content-between">
        <h4>LAPORAN AKTIVITAS GYM BULANAN</h4>
    </div>
    <div>
        
    </div>
    <hr>
    <table class="table ">
        <thead>
            <tr>
            <th scope="col">Tanggal</th>
            <th scope="col">Jumlah Member</th>
            </tr>
            
        </div>
        </thead>

        <tbody>
            <?php


                $query = mysqli_query($con, "SELECT tanggal, sum(terisi) as jumlah from sesi_gym group by tanggal") or
                die(mysqli_error($con));
                $month = null;
                $year = null;

                $bulan = "Semua Bulan dan Tahun";
                if( isset($_POST["cari"])) {
                    $month = $_POST['month'];
                    $month2 = $_POST['month'];
                    $year = $_POST['year'];

                    $bulan = $month . " " . $year;
                    if($month == "January"){
                        $month = 1;
                    }else if($month == "February"){
                        $month = 2;
                    }else if($month == "March"){
                        $month = 3;
                    }else if($month == "April"){
                        $month = 4;
                    }else if($month == "May"){
                        $month = 5;
                    }else if($month == "June"){
                        $month = 6;
                    }else if($month == "July"){
                        $month = 7;
                    }else if($month == "August"){
                        $month = 8;
                    }else if($month == "September"){
                        $month = 9;
                    }else if($month == "October"){
                        $month = 10;
                    }else if($month == "November"){
                        $month = 11;
                    }else if($month == "December"){
                        $month = 12;
                    }


                    $query = mysqli_query($con, "SELECT tanggal, sum(terisi) as jumlah from sesi_gym WHERE YEAR(tanggal) = $year AND MONTH(tanggal) = $month group by tanggal") or
                die(mysqli_error($con));
                }

                    $_SESSION['bulan'] = $month;
                    $_SESSION['tahun'] = $year;
                    $_SESSION['bulan_string'] = $bulan;
                
                    echo '
                <form action="" method="post">
                    <span>
                        <select name="day" id="day" hidden></select>
                    </span>
                    <span>
                        <label for="month">Month:</label>
                        <select name="month" id="month"></select>
                    </span>
                    <span>
                        <label for="year">Year:</label>
                        <select name="year" id="year">Year:</select>
                    </span>
                    <button type="submit" name="cari" class="btn btn-outline-primary">search</button>
                </form>
                
                <hr>
                <div class="body d-flex justify-content-between">
                    <h4>Kategori : '.$bulan.'</h4>
                </div>';

                echo'

                <a href="../process/downloadLaporanGymProcess.php" class="btn btn-success btn-lg" tabindex="-1" role="button" aria-disabled="false">CETAK STRUK</a>
                ';
                
                $jumlah = 0;

                if (mysqli_num_rows($query) == 0) {
                    echo '<tr> <td colspan="7"> Tidak ada data </td> </tr>';
                }else{
                    $no = 1;
                    $jumlah = 0;
                while($data = mysqli_fetch_assoc($query)){

                    echo'
                        <tr>
                            <td>'.$data['tanggal'].'</td>
                            <td>'.$data['jumlah'].'</td>
                                
                        </tr>';
                    $no++;
                    $jumlah = $jumlah + $data['jumlah'];
                }

                
            }
            echo "  Jumlah : " . $jumlah;
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