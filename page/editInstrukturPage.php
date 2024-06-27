<?php
include '../component/userSidebar.php';

$id = $_GET['id'];
$_SESSION['idInstruktur'] = $id;
$query = mysqli_query($con, "SELECT * FROM user WHERE id_user=$id") or
die(mysqli_error($con));
$data = mysqli_fetch_array($query);

$nama = $data['nama'];
$ussername = $data['ussername'];
$tanggalLahir = $data['tanggal_lahir'];
?>
<div class="container p-3 m-4 h-100" style="background-color: #FFFFFF; border-top: 5px
    solid #D40013; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0,
    0.19);" >
    <div class="body d-flex justify-content-between">
        <h4>EDIT INSTRUKTUR</h4>
    </div>
    
    <hr>
    <br>
    
    <table class="table ">
        <form action="../process/editInstrukturProcess.php" method="post">
            <div class="mb-3">
                <label for="nama" class="form-
                label">Nama</label>
                <input class="form-control" id="nama" name="nama"
                aria-describedby="emailHelp" value="<?php echo $nama; ?> " required>
            </div>
            <div class="mb-3">
                <label for="genre" class="form-
                label">Ussername</label>
                <input class="form-control"
                id="ussername" name="ussername" value="<?php echo $ussername; ?>" required>
            </div>
            <div class="mb-3">
                <label for="genre" class="form-
                label">Tanggal Lahir</label>
                <input type="date" class="form-control"
                id="tanggalLahir" name="tanggalLahir" value="<?php echo $tanggalLahir; ?>" required>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary"
                name="save">SAVE</button>
                
            </div>
            <div class="d-grid gap-2">
                <a href="./listInstrukturPage.php" id="cancel" name="cancel" class="btn btn-default">Cancel</a>
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