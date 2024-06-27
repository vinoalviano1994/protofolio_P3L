<?php
include '../component/userSidebar.php';

$query = mysqli_query($con, "SELECT id_user, nama FROM user WHERE id_user_type = 3") or
    die(mysqli_error($con));

$kelas = mysqli_query($con, "SELECT id_kelas, nama_kelas FROM kelas") or
    die(mysqli_error($con));


?>
<div class="container p-3 m-4 h-100" style="background-color: #FFFFFF; border-top: 5px
    solid #D40013; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0,
    0.19);" >
    <div class="body d-flex justify-content-between">
        <h4>TAMBAH JADWAL</h4>
    </div>
    <hr>
    <table class="table ">
        <form action="../process/addJadwalProcess.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
                <i class="fa-sharp fa-solid fa-user"></i>
                <label for="exampleInputEmail1" class="form-label">Hari</label>
                <select name="hari" id="hari">
                    <option value="Senin">Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                    <option value="Sabtu">Sabtu</option>
                    <option value="Minggu">Minggu</option>
                </select>
            </div>
            <div class="mb-3">
                <i class="fa-sharp fa-solid fa-user"></i>
                <label for="exampleInputEmail1" class="form-label">Jam</label>
                <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <i class="fa-sharp fa-solid fa-user"></i>
                <label for="exampleInputEmail1" class="form-label">Kelas</label>
                <select name="id_kelas" id="id_kelas">
                    <?php while($row = mysqli_fetch_array($kelas)):;?>
                    <option value="<?php echo $row['id_kelas'];?>"><?php echo $row["nama_kelas"];?></option>
                    <?php endwhile;?>
                </select>
            </div>
            <div class="mb-3">
                <i class="fa-sharp fa-solid fa-user"></i>
                <label for="exampleInputEmail1" class="form-label">Instruktur</label>
                <select name="id_user_instruktur" id="id_user_instruktur">
                    <?php while($row = mysqli_fetch_array($query)):;?>
                    <option value="<?php echo $row['id_user'];?>"><?php echo $row["nama"];?></option>
                    <?php endwhile;?>
                </select>
            </div>
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