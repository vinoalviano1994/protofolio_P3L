<?php
include '../component/userSidebar.php';

$id = $_GET['id'];
$query = mysqli_query($con, "SELECT * FROM booking_gym WHERE id_booking_gym  = $id") or
die(mysqli_error($con));
$booking_gym = mysqli_fetch_array($query);


$id_member = $booking_gym['id_member'];
$id_kasir = $booking_gym['id_kasir'];
$noTransaksi = $booking_gym['nomor_transaksi_presensi'];
$id_sesi_gym = $booking_gym['id_sesi_gym'];
$tanggal = $booking_gym['waktu_presensi'];

// cari nama member
$member = mysqli_query($con, "SELECT u.ussername, u.nama FROM membership m JOIN user u ON m.id_user = u.id_user WHERE m.id_member  = $id_member") or
die(mysqli_error($con));
$member = mysqli_fetch_array($member);
$ussername_member = $member['ussername'];
$nama_member = $member['nama'];
$member = $ussername_member . " / " . $nama_member;


// cari nama kasir
$kasir = mysqli_query($con, "SELECT * FROM user WHERE id_user = $id_kasir") or
die(mysqli_error($con));
$kasir = mysqli_fetch_array($kasir);
$ussername_kasir = $kasir['ussername'];
$nama_kasir = $kasir['nama'];
$kasir = $ussername_kasir . " / " . $nama_kasir;

// cari ID kelas
$sesi_gym = mysqli_query($con, "SELECT * FROM sesi_gym WHERE id_sesi_gym = $id_sesi_gym") or
die(mysqli_error($con));
$sesi_gym = mysqli_fetch_array($sesi_gym);
$sesi_gym = $sesi_gym['tanggal'] . " / " . $sesi_gym['jam_mulai'] . " - " . $sesi_gym['jam_selesai'];



?>
<div class="container p-3 m-4 h-100" style="background-color: #FFFFFF; border-top: 5px
    solid #0f5a7a; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0,
    0.19);" >
    <div class="body d-flex justify-content-center">
        <h4 >DATA AKTIVASI MEMBER</h4>
    </div>
    
    <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-center">
            No Struk
            <span ><?php echo $noTransaksi ?></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Tanggal
            <span ><?php echo $tanggal ?></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Member
            <span ><?php echo $member ?></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Slot Waktu
            <span ><?php echo $sesi_gym ?></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Kasir
            <span ><?php echo $kasir ?></span>
        </li>
        
        
    </ul>
    <hr>
    <div class="d-flex justify-content-center">
    <a href="../process/downloadStrukPresensiGymProcess.php?id=<?php echo $id ?>" 
    class="btn btn-success btn-lg" tabindex="-1" role="button" aria-disabled="false">CETAK STRUK</a>
    </div>
                                
    <hr>
    
</div>
</aside>
<script
src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
crossorigin="anonymous"></script>
</body>
</html>