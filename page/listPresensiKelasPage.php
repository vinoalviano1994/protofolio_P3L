<?php
include '../component/userSidebar.php'
?>
<div class="container p-3 m-4 h-100" style="background-color: #FFFFFF; border-top: 5px
    solid #0f5a7a; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0,
    0.19);" >
    <div class="body d-flex justify-content-between">
        <h4>PRESENSI KELAS</h4>
    </div>
    <div>
        
    </div>
    <hr>
    <table class="table ">
        <thead>
            <tr>
            <th scope="col">Member</th>
            <th scope="col">Kelas</th>
            <th scope="col">Waktu Presensi</th>
            <?php
                echo '<th scope="col">Aksi</th>';
            ?>
            </tr>
            
        </div>
        </thead>

        <tbody>
            <?php
                $query = mysqli_query($con, "SELECT u.ussername, u.nama, j.jam_mulai, j.tanggal, b.id_booking_kelas, b.waktu_presensi, k.nama_kelas from booking_kelas b 
                JOIN membership m ON m.id_member = b.id_member JOIN user u ON u.id_user = m.id_user JOIN jadwal_kelas j ON j.id_jadwal = b.id_jadwal_kelas JOIN kelas k 
                ON k.id_kelas = j.id_kelas WHERE b.status_presensi = 1") or
                die(mysqli_error($con));
                
                if( isset($_POST["cari2"])) {
                    $keyword = $_POST["keyword"];
                    $query = mysqli_query($con, "SELECT u.ussername, u.nama, j.jam_mulai, j.tanggal, b.id_booking_kelas, b.waktu_presensi, k.nama_kelas from booking_kelas b 
                    JOIN membership m ON m.id_member = b.id_member JOIN user u ON u.id_user = m.id_user JOIN jadwal_kelas j ON j.id_jadwal = b.id_jadwal_kelas JOIN kelas k 
                    ON k.id_kelas = j.id_kelas WHERE b.status_presensi = 1 AND (u.ussername LIKE '%$keyword%' OR u.nama LIKE '%$keyword%' OR j.jam_mulai LIKE '%$keyword%' OR j.tanggal LIKE '%$keyword%' OR b.id_booking_kelas LIKE '%$keyword%' 
                    OR b.waktu_presensi LIKE '%$keyword%' OR k.nama_kelas LIKE '%$keyword%')") or
                die(mysqli_error($con));
                }
                
                echo'
                
                <hr>
                <form action="" method="post">
                    <div class="form-outline">
                    <input type="search" class="form-control rounded" name="keyword" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                    <button type="submit" name="cari2" class="btn btn-outline-primary">search</button>
                    </div>
                </form>';
                


                if (mysqli_num_rows($query) == 0) {
                    echo '<tr> <td colspan="7"> Tidak ada data </td> </tr>';
                }else{
                    $no = 1;
                while($data = mysqli_fetch_assoc($query)){
                    
                        echo'
                            <tr>
                                <td>'.$data['nama'].' - '.$data['ussername'].'</td>
                                <td>'.$data['nama_kelas'].' / '.$data['tanggal'].' / '.$data['jam_mulai'].'</td>
                                <td>'.$data['waktu_presensi'].'</td>
                                <td>
                                <a href="../process/downloadStrukpresensiKelasProcess.php?id='.$data['id_booking_kelas'].'" onClick="return
                                confirm ( \'Presensi Member ?\')"class="btn btn-danger btn-lg" tabindex="-1" role="button" aria-disabled="false">CETAK STRUK</a>
                            </td>                        
                            
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
</body>
</html>