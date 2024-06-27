<?php
include '../component/userSidebar.php';

$query = mysqli_query($con, "SELECT id_user, nama FROM user WHERE id_user_type = 3") or
    die(mysqli_error($con));

$kelas = mysqli_query($con, "SELECT id_kelas, nama_kelas FROM kelas") or
    die(mysqli_error($con));



$jadwalDefault = mysqli_query($con, "SELECT j.id_jadwal_tetap, j.hari, j.jam_mulai, k.nama_kelas, j.id_user_instruktur FROM jadwal_tetap j JOIN kelas k ON j.id_kelas=k.id_kelas") or
    die(mysqli_error($con));

$countData = 0;

?>
<div class="container p-3 m-4 h-100" style="background-color: #FFFFFF; border-top: 5px
    solid #D40013; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0,
    0.19);" >
    <div class="body d-flex justify-content-between">
        <h4>GENERATE JADWAL</h4>
    </div>
    <hr>
    <table class="table ">
        <form action="../process/generateJadwalProcess.php" method="post" enctype="multipart/form-data">
            <?php while($row = mysqli_fetch_array($jadwalDefault)):;
                $userInstruktur = mysqli_query($con, "SELECT id_user, nama FROM user WHERE id_user_type = 3") or
                    die(mysqli_error($con));
                $countData += 1;
                $idNameUserInstruktur = "id_user_instruktur_" . $countData;
                $idNameJadwaltetap = "id_jadwal_tetap_" . $countData;
                
                    ?>

                <div class="mb-3">
                    
                    <i class="fa-sharp fa-solid fa-user"></i>
                    <label for="exampleInputEmail1" class="form-label"><?php echo $row['hari'] . " - " . $row['jam_mulai'] . " - " . $row['nama_kelas']; ?></label>
                </div>

                

                <div class="mb-3">
                    <i class="fa-sharp fa-solid fa-user"></i>
                    <label for="exampleInputEmail1" class="form-label">Instruktur</label>
                    <select name="<?php echo $idNameUserInstruktur;?>" id="<?php echo $idNameUserInstruktur;?>">
                        <option value="-1" selected> -- Kelas diliburkan -- </option>
                        <?php while($row2 = mysqli_fetch_array($userInstruktur)):;
                        if($row2['id_user'] == $row['id_user_instruktur']){?>
                            <option value="<?php echo $row2['id_user'];?>" selected><?php echo $row2["nama"];?></option>
                        <?php
                        }else{ ?>
                            
                            <option value="<?php echo $row2['id_user'];?>"><?php echo $row2["nama"];?></option>
                            <?php
                        }
                        endwhile;?>
                    </select>
                    <input type="hidden" id="<?php echo $idNameJadwaltetap;?>" name="<?php echo $idNameJadwaltetap;?>" value="<?php echo $row['id_jadwal_tetap'];?>">
                    <hr>
                </div>
            <?php endwhile;
            $_SESSION['count_data'] = $countData;
            ?>

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