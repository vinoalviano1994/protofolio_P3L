<?php
include '../component/userSidebar.php'
?>
<div class="container p-3 m-4 h-100" style="background-color: #FFFFFF; border-top: 5px
    solid #0f5a7a; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0,
    0.19);" >
    <div class="body d-flex justify-content-between">
        <h4>LIST INSTRUKTUR</h4>
    </div>
    <div>
        
    </div>
    <hr>
    <table class="table ">
        <thead>
            <tr>
            <th scope="col">ussername</th>
            <th scope="col">nama</th>
            <th scope="col">Tanggal Lahir</th>
            <?php
                echo '<th scope="col">Aksi</th>';
            ?>
            </tr>
            
        </div>
        </thead>

        <tbody>
            <?php


                $query = mysqli_query($con, "SELECT id_user, ussername, nama, tanggal_lahir FROM user WHERE id_user_type = 3") or
                die(mysqli_error($con));

                echo'

                <a href="./addInstrukturPage.php" class="btn btn-success btn-lg" tabindex="-1" role="button" aria-disabled="false">TAMBAH INSTRUKTUR</a>
                ';

                if( isset($_POST["cari"])) {
                    $keyword = $_POST["keyword"];
                    $query = mysqli_query($con, "SELECT id_user, ussername, nama, tanggal_lahir FROM user 
                    WHERE id_user_type = 3 AND (nama LIKE '%$keyword%' OR ussername LIKE '%$keyword%' OR tanggal_lahir LIKE '%$keyword%')") or
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
                            <td>'.$data['ussername'].'</td>
                            <td>'.$data['nama'].'</td>
                            <td>'.$data['tanggal_lahir'].'</td>
                            </td>
                            
                            <td>
                                <a href="../page/editInstrukturPage.php?id='.$data['id_user'].'" onClick="return
                                    confirm ( \'Are you sure want to edit this data?\')"class="btn btn-success btn-lg" tabindex="-1" role="button" aria-disabled="false">EDIT</a>
                                
                                <a href="../process/deleteInstrukturProcess.php?id='.$data['id_user'].'" onClick="return confirm ( \'Are you sure want to delete this data?\')"class="btn btn-danger btn-lg" tabindex="-1" role="button" aria-disabled="false">HAPUS</a>
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