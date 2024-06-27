<?php
include '../component/userSidebar.php'
?>
<div class="container p-3 m-4 h-100" style="background-color: #FFFFFF; border-top: 5px
    solid #0f5a7a; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0,
    0.19);" >
    <div class="body d-flex justify-content-between">
        <h4>GENERATE JADWAL</h4>
    </div>
    <div>
        
    </div>
    <hr>
    <table class="table ">
        <thead>
            <tr>
            <th scope="col">Tanggal</th>
            <th scope="col">Hari</th>
            <th scope="col">Jam</th>
            <th scope="col">Nama Kelas</th>
            <th scope="col">Nama Instruktur</th>
            <th scope="col">keterangan</th>
            <?php
                echo '<th scope="col">Aksi</th>';
            ?>
            </tr>
            
        </div>
        </thead>

        <tbody>
            <?php


                $query = mysqli_query($con, "SELECT j.id_jadwal, j.keterangan, j.id_kelas, j.tanggal, j.hari, j.jam_mulai, k.nama_kelas, j.libur, u.nama FROM jadwal_kelas j JOIN
                user u ON j.id_user_instruktur=u.id_user JOIN kelas k ON k.id_kelas=j.id_kelas WHERE j.tanggal IS NOT NULL AND j.show_status = 1 ORDER BY j.sort_hari, j.jam_mulai asc") or
                die(mysqli_error($con));

                echo'

                <a href="./generateJadwalPage.php" class="btn btn-success btn-lg" tabindex="-1" role="button" aria-disabled="false">GENERATE JADWAL</a>
                ';

                if( isset($_POST["cari"])) {
                    $keyword = $_POST["keyword"];
                    $query = mysqli_query($con, "SELECT j.id_jadwal, j.keterangan, j.id_kelas, j.tanggal, j.hari, j.jam_mulai, k.nama_kelas, j.libur, u.nama FROM jadwal_kelas j JOIN
                    user u ON j.id_user_instruktur=u.id_user JOIN kelas k ON k.id_kelas=j.id_kelas 
                    WHERE j.tanggal IS NOT NULL AND (j.hari LIKE '%$keyword%' OR j.jam_mulai LIKE '%$keyword%' OR k.nama_kelas LIKE '%$keyword%' OR u.nama LIKE '%$keyword%' OR j.keterangan LIKE '%$keyword%') ORDER BY j.sort_hari, j.jam_mulai asc") or
                die(mysqli_error($con));
                }

                    
                
                    echo '
                <hr>
                <form action="" method="post">
                    <div class="form-outline">
                    <input type="search" class="form-control rounded" name="keyword" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                    <button type="submit" name="cari" class="btn btn-outline-primary">search</button>
                    </div>
                </form>';
                


                if (mysqli_num_rows($query) == 0) {
                    echo '<tr> <td colspan="7"> Tidak ada data </td> </tr>';
                }else{
                    $no = 1;
                while($data = mysqli_fetch_assoc($query)){
                    

                    echo'
                        <tr>
                            <td>'.$data['tanggal'].'</td>
                            <td>'.$data['hari'].'</td>
                            <td>'.$data['jam_mulai'].'</td>
                            <td>'.$data['nama_kelas'].'</td>
                            <td>'.$data['nama'].'</td>
                            <td>'.$data['keterangan'].'</td>
                            </td>
                            ';
                            if($data['libur'] == 0){
                                echo '<td>
                                <a href="../process/liburkanKelasHarianProcess.php?id='.$data['id_jadwal'].'" onClick="return
                                    confirm ( \'Liburkan Kelas ?\')"class="btn btn-danger btn-lg" tabindex="-1" role="button" aria-disabled="false">LIBURKAN</a>
                                
                        </tr>';
                            }
                            
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
</body>
</html>