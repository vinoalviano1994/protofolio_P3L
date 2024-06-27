<?php
include '../component/userSidebar.php';

?>
<div class="container p-3 m-4 h-100" style="background-color: #FFFFFF; border-top: 5px
    solid #D40013; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0,
    0.19);" >
    <div class="body d-flex justify-content-between">
        <h4>TAMBAH MEMBER</h4>
    </div>
    <hr>
    <table class="table ">
        <form action="../process/addMemberProcess.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <i class="fa-sharp fa-solid fa-user"></i>
                <label for="exampleInputEmail1" class="form-label">Nama</label>
                <input class="form-control" id="nama" name="nama" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <i class="fa-sharp fa-solid fa-user"></i>
                <label for="exampleInputEmail1" class="form-label">Alamat</label>
                <input class="form-control" id="alamat" name="alamat" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <i class="fa-sharp fa-solid fa-user"></i>
                <label for="exampleInputEmail1" class="form-label">Telepon</label>
                <input type="number" class="form-control" id="telepon" name="telepon" aria-describedby="emailHelp" required  minlength="11" maxlength="13">
            </div>
            <div class="mb-3"> 
                <label for="exampleInputEmail1" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" aria-describedby="emailHelp" value="<?php echo $tanggalLahir ?> " required> 
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