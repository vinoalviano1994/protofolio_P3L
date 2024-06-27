<?php
include '../component/userSidebar.php';

$id = $_GET['id'];
$_SESSION['idInstruktur'] = $id;
$query = mysqli_query($con, "SELECT j.id_jadwal_tetap, j.hari, j.jam_mulai, j.id_user_instruktur, j.id_kelas FROM jadwal_tetap j JOIN kelas k ON j.id_kelas=k.id_kelas 
JOIN user u ON j.id_user_instruktur=u.id_user WHERE id_jadwal_tetap=$id") or
die(mysqli_error($con));
$data = mysqli_fetch_array($query);

$hari = $data['hari'];
$jam_mulai = $data['jam_mulai'];
$id_instruktur = $data['id_user_instruktur'];
$id_kelas = $data['id_kelas'];
$_SESSION['jadwal_tetap'] = $data['id_jadwal_tetap'];
$kelas = mysqli_query($con, "SELECT id_kelas, nama_kelas FROM kelas") or
    die(mysqli_error($con));

$userInstruktur = mysqli_query($con, "SELECT id_user, nama FROM user WHERE id_user_type = 3") or
    die(mysqli_error($con));

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
        <form action="../process/editJadwalProcess.php" method="post">
            <div class="mb-3">
                <i class="fa-sharp fa-solid fa-user"></i>
                <label for="exampleInputEmail1" class="form-label">Hari</label>
                <select name="hari" id="hari">
                    <option value="Senin" <?php if($hari == "Senin"){?> selected<?php }?>>Senin</option>
                    <option value="Selasa" <?php if($hari == "Selasa"){?> selected<?php }?>>Selasa</option>
                    <option value="Rabu" <?php if($hari == "Rabu"){?> selected<?php }?>>Rabu</option>
                    <option value="Kamis" <?php if($hari == "Kamis"){?> selected<?php }?>>Kamis</option>
                    <option value="Jumat" <?php if($hari == "Jumat"){?> selected<?php }?>>Jumat</option>
                    <option value="Sabtu" <?php if($hari == "Sabtu"){?> selected<?php }?>>Sabtu</option>
                    <option value="Minggu" <?php if($hari == "Minggu"){?> selected<?php }?>>Minggu</option>
                </select>
            </div>
            <div class="mb-3">
                <i class="fa-sharp fa-solid fa-user"></i>
                <label for="exampleInputEmail1" class="form-label">Jam</label>
                <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" aria-describedby="emailHelp" required value="<?php echo $jam_mulai; ?>">
            </div>
            <div class="mb-3">
                <i class="fa-sharp fa-solid fa-user"></i>
                <label for="exampleInputEmail1" class="form-label">Kelas</label>
                <select name="id_kelas" id="id_kelas">
                    <?php while($row = mysqli_fetch_array($kelas)):;
                    if($row['id_kelas'] == $id_kelas){?>
                    <option value="<?php echo $row['id_kelas'];?>" selected><?php echo $row["nama_kelas"];?></option>
                    <?php
                    }else{ ?>
                        
                    <option value="<?php echo $row['id_kelas'];?>"><?php echo $row["nama_kelas"];?></option>
                        <?php
                    }
                     endwhile;?>
                </select>
            </div>
            <div class="mb-3">
                <i class="fa-sharp fa-solid fa-user"></i>
                <label for="exampleInputEmail1" class="form-label">Instruktur</label>
                <select name="id_user_instruktur" id="id_user_instruktur">
                    <?php while($row = mysqli_fetch_array($userInstruktur)):;
                    if($row['id_user'] == $id_instruktur){?>
                    <option value="<?php echo $row['id_user'];?>" selected><?php echo $row["nama"];?></option>
                    <?php
                    }else{ ?>
                        
                        <option value="<?php echo $row['id_user'];?>"><?php echo $row["nama"];?></option>
                        <?php
                    }
                    endwhile;?>
                </select>
            </div>
            <div class="d-grid gap-2">
                <a href="./lisTJadwalPage.php" id="cancel" name="cancel" class="btn btn-default">Cancel</a>
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