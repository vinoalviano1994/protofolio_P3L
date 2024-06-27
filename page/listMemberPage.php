<?php
include '../component/userSidebar.php'
?>
<div class="container p-3 m-4 h-100" style="background-color: #FFFFFF; border-top: 5px
    solid #0f5a7a; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0,
    0.19);" >
    <div class="body d-flex justify-content-between">
        <h4>LIST MEMBER</h4>
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
            <?php
                echo '<th scope="col">Aksi</th>';
            ?>
            </tr>
            
        </div>
        </thead>

        <tbody>
            <?php
                $query = mysqli_query($con, "SELECT m.id_user, m.id_member, m.alamat, m.telepon, u.ussername, u.nama, u.tanggal_lahir FROM membership m JOIN
                user u ON m.id_user = u.id_user") or
                die(mysqli_error($con));

                    echo '
                <a href="./addMemberPage.php" class="btn btn-success btn-lg" tabindex="-1" role="button" aria-disabled="false">DAFTAR MEMBER</a>
                ';

                if( isset($_POST["cari2"])) {
                    $keyword = $_POST["keyword"];
                    $query = mysqli_query($con, "SELECT m.id_user, m.id_member, m.alamat, m.telepon, u.ussername, u.nama, u.tanggal_lahir FROM membership m JOIN
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

                    echo'
                        <tr>
                            <td>'.$data['ussername'].'</td>
                            <td>'.$data['nama'].'</td>
                            <td>'.$data['alamat'].'</td>
                            <td>'.$data['telepon'].'</td>
                            <td>'.$data['tanggal_lahir'].'</td>
                            </td>
                            
                            <td>
                                <a href="../page/editMemberPage.php?id='.$data['id_user'].'" onClick="return
                                    confirm ( \'Are you sure want to edit this data?\')"class="btn btn-success btn-lg" tabindex="-1" role="button" aria-disabled="false">EDIT</a>
                                
                                <a href="../process/deleteMemberProcess.php?id='.$data['id_user'].'" onClick="return confirm ( \'Are you sure want to delete this data ?\')"class="btn btn-danger btn-lg" tabindex="-1" role="button" aria-disabled="false">HAPUS</a>

                                <a href="../process/resetMemberPasswordProcess.php?id='.$data['id_user'].'" onClick="return
                                    confirm ( \'Apakah Anda yakin ingin mereset Password Member ?\')"class="btn btn-secondary btn-lg" tabindex="-1" role="button" aria-disabled="false">Reset Pssword</a>
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