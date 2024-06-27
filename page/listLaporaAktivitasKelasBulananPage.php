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
            <th scope="col">Kelas</th>
            <th scope="col">Instruktur</th>
            <th scope="col">Jumlah Peserta</th>
            <th scope="col">Jumlah Libur</th>
            </tr>
            
        </div>
        </thead>

        <tbody>
            <?php

                $tanggal = date("y-m-d");

                $query = mysqli_query($con, "SELECT k.nama_kelas, u.nama, sum(j.libur) as jumlah_libur, sum(j.terisi) AS jumlah_terisi from jadwal_kelas j 
                LEFT JOIN kelas k ON k.id_kelas = j.id_kelas LEFT JOIN user u on u.id_user = j.id_user_instruktur group by j.id_kelas ,j.id_user_instruktur order by k.nama_kelas asc") or
                die(mysqli_error($con));

                $bulan = "Semua Bulan dan Tahun";

                if( isset($_POST["cari"])) {
                    $month = $_POST["month"];
                    $year = $_POST['year'];

                    $bulan = $month . " - " . $year;
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

                    
                    $_SESSION['bulan'] = $month;
                    $_SESSION['tahun'] = $year;
                    $_SESSION['bulan_string'] = $bulan;

                    $query = mysqli_query($con, "SELECT k.nama_kelas, u.nama, sum(j.libur) as jumlah_libur, sum(j.terisi) AS jumlah_terisi from jadwal_kelas j 
                    LEFT JOIN kelas k ON k.id_kelas = j.id_kelas LEFT JOIN user u on u.id_user = j.id_user_instruktur WHERE YEAR(j.tanggal) = $year AND MONTH(j.tanggal) = $month group by j.id_kelas ,j.id_user_instruktur order by k.nama_kelas asc") or
                die(mysqli_error($con));
                }

                    
                
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
                </div>
                ';

                
                echo'

                <a href="../process/downloadLaporankelasProcess.php" class="btn btn-success btn-lg" tabindex="-1" role="button" aria-disabled="false">CETAK STRUK</a>
                ';
                
                
                if (mysqli_num_rows($query) == 0) {
                    echo '<tr> <td colspan="7"> Tidak ada data </td> </tr>';
                }else{
                    $no = 1;
                while($data = mysqli_fetch_assoc($query)){

                    echo'
                        <tr>
                            <td>'.$data['nama_kelas'].'</td>
                            <td>'.$data['nama'].'</td>
                            <td>'.$data['jumlah_terisi'].'</td>
                            <td>'.$data['jumlah_libur'].'</td>
                                
                        </tr>';
                    $no++;
                }

                
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