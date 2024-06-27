<?php
include '../component/userSidebar.php'
?>
<div class="container p-3 m-4 h-100" style="background-color: #FFFFFF; border-top: 5px
    solid #0f5a7a; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0,
    0.19);" >
    <div class="body d-flex justify-content-between">
        <h4>IZIN INSTRUKTUR</h4>
    </div>
    <div>
        
    </div>
    <hr>
    <table class="table ">
        <thead>
            <tr>
            <th scope="col">Kelas</th>
            <th scope="col">Instruktur Utama</th>
            <th scope="col">Instruktur Pengganti</th>
            <th scope="col">Status</th>

            <?php
                echo '<th scope="col">Aksi</th>';
            ?>
            </tr>
            
        </div>
        </thead>

        <tbody>
            <?php


                $query = mysqli_query($con, "SELECT id_izin, i.status_izin, j.tanggal, j.hari, j.jam_mulai, k.nama_kelas, u.nama, p.nama as nama_pengganti FROM izin_instruktur i join user u ON i.id_user_instruktur_utama=u.id_user JOIN user p
                    ON i.id_user_instruktur_pengganti=p.id_user JOIN jadwal_kelas j ON i.id_jadwal=j.id_jadwal JOIN kelas k ON k.id_kelas=j.id_kelas") or
                die(mysqli_error($con));

                if( isset($_POST["cari"])) {
                    $keyword = $_POST["keyword"];
                    $query = mysqli_query($con, "SELECT i.id_izin, i.status_izin, j.tanggal, j.hari, j.jam_mulai, k.nama_kelas, u.nama, p.nama as nama_pengganti FROM izin_instruktur i join user u ON i.id_user_instruktur_utama=u.id_user JOIN user p
                    ON i.id_user_instruktur_pengganti=p.id_user JOIN jadwal_kelas j ON i.id_jadwal=j.id_jadwal JOIN kelas k ON k.id_kelas=j.id_kelas WHERE (j.tanggaL LIKE '%$keyword%' OR j.hari LIKE '%$keyword%' OR j.jam_mulai LIKE '%$keyword%' OR
                    k.nama_kelas LIKE '%$keyword%' OR u.nama LIKE '%$keyword%' OR p.nama LIKE '%$keyword%')") or
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
                    if($data['status_izin'] == 0){
                        $status = "Belum dikonfirmasi";
                    }else{
                        $status = "Sudah dikonfirmasi";
                    }
                    echo'
                        <tr>
                            <td>'.$data['nama_kelas'].' - '.$data['jam_mulai'].' - '.$data['hari'].' '.$data['tanggal'].'</td>
                            <td>'.$data['nama'].'</td>
                            <td>'.$data['nama_pengganti'].'</td>
                            <td>'.$status.'</td>
                            
                            <td>
                            ';
                        if($data['status_izin'] == 0){
                            echo'<a href="../process/accIzinInstrukturProcess.php?id='.$data['id_izin'].'" onClick="return confirm ( \'Izinkan ?\')" 
                            class="btn btn-success btn-lg" tabindex="-1" role="button" aria-disabled="false">APPROVE IZIN</a></td></tr>';
                        }else{
                            echo'</td></tr>';
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