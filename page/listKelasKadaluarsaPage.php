<?php
include '../component/userSidebar.php'
?>
<div class="container p-3 m-4 h-100" style="background-color: #FFFFFF; border-top: 5px
    solid #0f5a7a; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0,
    0.19);" >
    <div class="body d-flex justify-content-between">
        <h4>LIST KELAS KADALUARSA</h4>
    </div>
    <div>
        
    </div>
    <hr>
    <table class="table ">
        <thead>
            <tr>
            <th scope="col">Member</th>
            <th scope="col">Kelas</th>
            <th scope="col">Jumlah Paket</th>
            <th scope="col">Status</th>
            <?php
                echo '<th scope="col">Aksi</th>';
            ?>
            </tr>
            
        </div>
        </thead>

        <tbody>
            <?php
                $query = mysqli_query($con, "SELECT t.id_transaksi_dp_kelas, t.deposit, t.bonus_deposit, u.nama, u.ussername, k.nama_kelas, t.masa_aktif FROM transaksi_deposit_kelas t JOIN kelas k ON t.id_kelas=k.id_kelas JOIN user u ON u.id_user=t.id_user WHERE kadaluarsa = 0") or
                die(mysqli_error($con));
                
                if( isset($_POST["cari2"])) {
                    $keyword = $_POST["keyword"];
                    $query = mysqli_query($con, "SELECT t.id_transaksi_dp_kelas, t.deposit, t.bonus_deposit, u.nama, u.ussername, k.nama_kelas, t.masa_aktif FROM transaksi_deposit_kelas t JOIN kelas k ON t.id_kelas=k.id_kelas JOIN user u ON u.id_user=t.id_user 
                    WHERE  WHERE kadaluarsa = 0 AND (u.nama LIKE '%$keyword%' OR u.ussername LIKE '%$keyword%' OR k.nama_kelas LIKE '%$keyword%' OR t.masa_aktif LIKE '%$keyword%')") or
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
                    $tanggalDb = strtotime($data['masa_aktif']);
                    if($tanggalDb <= $tanggal){
                        if($tanggalDb <= $tanggal){
                            $status = "Kadaluarsa, berakhir pada - " . $data['masa_aktif'];
                        }else{
                            $status = "Aktif - " . $data['masa_aktif'];
                        }
    
                        $jumlah = $data['deposit'] + $data['bonus_deposit'];
    
                        echo'
                            <tr>
                                <td>'.$data['nama'].' - '.$data['ussername'].'</td>
                                <td>'.$data['nama_kelas'].'</td>
                                <td>'.$jumlah.'</td>
                                <td>'.$status.'</td>
                                <td>
                                ';
                            if($tanggalDb <= $tanggal){
                                echo '<a href="../process/resetKelasProcess.php?id='.$data['id_transaksi_dp_kelas'].'" onClick="return
                                confirm ( \'Reset Kelas ?\')"class="btn btn-danger btn-lg" tabindex="-1" role="button" aria-disabled="false">RESET</a>';
                            }else{
                            }
                            
                            echo'
                            </td>                        
                            
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