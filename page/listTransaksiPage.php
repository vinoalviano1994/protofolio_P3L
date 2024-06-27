<?php
include '../component/userSidebar.php'
?>
<div class="container p-3 m-4 h-100" style="background-color: #FFFFFF; border-top: 5px
    solid #0f5a7a; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0,
    0.19);" >
    <div class="body d-flex justify-content-between">
        <h4>Transaksi</h4>
    </div>
    <div>
        
    </div>
    <hr>
    <table class="table ">
        <thead>
            <tr>
            <th scope="col">Member ID</th>
            <th scope="col">Nama</th>
            <th scope="col">Alamat</th>
            <th scope="col">Nomor Telepon</th>
            <th scope="col">Tanggal Lahir</th>
            <th scope="col">Status</th>
            <?php
                echo '<th scope="col">Aksi</th>';
            ?>
            </tr>
            
        </div>
        </thead>

        <tbody>
            <?php
                $query = mysqli_query($con, "SELECT m.id_user, m.id_member, m.alamat, m.telepon, m.member_status, m.masa_aktif_gym, u.ussername, u.nama, u.tanggal_lahir FROM membership m JOIN
                user u ON m.id_user = u.id_user") or
                die(mysqli_error($con));

                   

                if( isset($_POST["cari2"])) {
                    $keyword = $_POST["keyword"];
                    $query = mysqli_query($con, "SELECT m.id_user, m.id_member, m.alamat, m.telepon, m.member_status, m.masa_aktif_gym, u.ussername, u.nama, u.tanggal_lahir FROM membership m JOIN
                user u ON m.id_user = u.id_user WHERE m.alamat LIKE '%$keyword%' OR m.telepon LIKE '%$keyword%' OR u.nama LIKE '%$keyword%' OR u.tanggal_lahir LIKE '%$keyword%' OR u.ussername LIKE '%$keyword%'") or
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

                    
                    $tanggal = strtotime(date("y-m-d"));
                    $tanggalDb = strtotime($data['masa_aktif_gym']);
                    if($data['member_status'] == 1 && $tanggalDb <= $tanggal){
                        $status = "Kadaluarsa, berakhir pada - " . $data['masa_aktif_gym'];
                    }else if($data['member_status'] == 1 ){
                        $status = "Aktif - " . $data['masa_aktif_gym'];
                    }else{
                        $status = "belum aktif";
                    }
                    echo'
                        <tr>
                            <td>'.$data['ussername'].'</td>
                            <td>'.$data['nama'].'</td>
                            <td>'.$data['alamat'].'</td>
                            <td>'.$data['telepon'].'</td>
                            <td>'.$data['tanggal_lahir'].'</td>
                            <td>'.$status.'</td>
                            </td>
                            
                            <td>';

                                if($data['member_status'] == 0){
                                    echo '<a href="../process/aktivasiMemberProcess.php?id='.$data['id_user'].'" onClick="return
                                    confirm ( \'Aktivasi Member ?\')"class="btn btn-success btn-lg" tabindex="-1" role="button" aria-disabled="false">AKTIVASI</a>';
                                }else if($data['member_status'] == 1 && $tanggalDb <= $tanggal){
                                    echo '<a href="../process/deaktivasiMemberProcess.php?id='.$data['id_user'].'" onClick="return
                                    confirm ( \'Aktivasi Member ?\')"class="btn btn-danger btn-lg" tabindex="-1" role="button" aria-disabled="false">DEAKTIVASI</a>';
                                }else{
                                    echo '<a href="../page/depositUangPage.php?id='.$data['id_user'].'" class="btn btn-danger btn-lg" tabindex="-1" role="button" aria-disabled="false">DP UANG</a>

                                    <a href="../page/depositKelasPage.php?id='.$data['id_user'].'" class="btn btn-secondary btn-lg" tabindex="-1" role="button" aria-disabled="false">DP KELAS</a>
                                    </td>';
                                }
                                
                                echo'
                                
                                
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