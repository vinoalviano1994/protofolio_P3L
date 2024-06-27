<?php
include '../component/userSidebar.php';
$id = $_GET['id'];

$_SESSION['idUser'] = $id;
$query = mysqli_query($con, "SELECT m.deposit_kelas,
u.ussername, u.nama FROM user u JOIN membership m ON u.id_user = m.id_user WHERE m.id_user=$id") or
die(mysqli_error($con));
$data = mysqli_fetch_array($query);

$nama = $data['nama'] . " / " . $data['ussername'];
$sisaKelas = $data['deposit_kelas'];

$promo = mysqli_query($con, "SELECT id_promo, nama_promo, deskripsi_promo FROM promo WHERE promo_type = 1") or
            die(mysqli_error($con));

$kelas = mysqli_query($con, "SELECT id_kelas, nama_kelas, harga FROM kelas") or
            die(mysqli_error($con));

?>
<div class="container p-3 m-4 h-100" style="background-color: #FFFFFF; border-top: 5px
    solid #D40013; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0,
    0.19);" >
    <div class="body d-flex justify-content-between">
        <h4>DEPOSIT KELAS</h4>
    </div>
    <hr>
    <table class="table ">
        <form action="../process/depositeKelasProcess.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <i class="fa-sharp fa-solid fa-user"></i>
                <label for="exampleInputEmail1" class="form-label">Paket</label>
                <select name="promo" id="promo">
                    <?php while($row = mysqli_fetch_array($promo)):;?>
                    <option value="<?php echo $row['id_promo'];?>"><?php echo $row["nama_promo"] . " - " . $row["deskripsi_promo"];?></option>
                    <?php endwhile;?>
                </select>
            </div>
            <div class="mb-3">
                <i class="fa-sharp fa-solid fa-user"></i>
                <label for="exampleInputEmail1" class="form-label">Instruktur</label>
                <select name="id_kelas" id="id_kelas">
                    <?php while($row = mysqli_fetch_array($kelas)):;?>
                    <option value="<?php echo $row['id_kelas'];?>"><?php echo $row["nama_kelas"] . " - " . $row["harga"];?></option>
                    <?php endwhile;?>
                </select>
            </div>
            <input type="hidden" id="id_user" name="id_user" value="<?php $id;?>">
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary" name="register">Submit</button>
            </div>
        </form>
    </table>
</div>
</aside>
<script
src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
crossorigin="anonymous"></script>
</body>
</html>