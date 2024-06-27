<?php
include '../component/userSidebar.php';
$id = $_GET['id'];

$_SESSION['idUser'] = $id;
$query = mysqli_query($con, "SELECT m.deposit_uang,
u.ussername, u.nama FROM user u JOIN membership m ON u.id_user = m.id_user WHERE m.id_user=$id") or
die(mysqli_error($con));
$data = mysqli_fetch_array($query);

$nama = $data['nama'] . " / " . $data['ussername'];
$saldo = $data['deposit_uang'];

$promo = mysqli_query($con, "SELECT id_promo, nama_promo, deskripsi_promo FROM promo WHERE promo_type = 0") or
            die(mysqli_error($con));


?>
<div class="container p-3 m-4 h-100" style="background-color: #FFFFFF; border-top: 5px
    solid #D40013; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0,
    0.19);" >
    <div class="body d-flex justify-content-between">
        <h4>DEPOSIT UANG</h4>
    </div>
    <hr>
    <table class="table ">
        <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <?php echo $nama ?>
            <span >Rp. <?php echo $saldo ?></span>
        </li>
        </ul>
        <form action="../process/depositeUangProcess.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <i class="fa-sharp fa-solid fa-user"></i>
                <label for="exampleInputEmail1" class="form-label">Nominal</label>
                <input class="form-control" id="nominal" name="nominal" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <i class="fa-sharp fa-solid fa-user"></i>
                <label for="exampleInputEmail1" class="form-label">Promo</label>
                <select name="promo" id="promo">
                    <option value="-1">None</option>
                    <?php while($row = mysqli_fetch_array($promo)):;?>
                    <option value="<?php echo $row['id_promo'];?>"><?php echo $row["nama_promo"] . " - " . $row["deskripsi_promo"];?></option>
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