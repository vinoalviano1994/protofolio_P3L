<?php
include '../component/userSidebar.php';

$id = $_GET['id'];
$query = mysqli_query($con, "SELECT * FROM transaksi_deposit_kelas WHERE id_transaksi_dp_kelas  = $id") or
die(mysqli_error($con));
$data_transaksi = mysqli_fetch_array($query);


$id_member = $data_transaksi['id_user'];
$noTransaksi = $data_transaksi['no_transaksi'];
$tanggal = $data_transaksi['tanggal'];
$deposit = $data_transaksi['deposit'];
$bonusDeposit = $data_transaksi['bonus_deposit'];
$totalDeposit = $data_transaksi['total_deposit'];
$id_kelas = $data_transaksi['id_kelas'];
$id_kasir = $data_transaksi['id_kasir'];
$id_promo = $data_transaksi['id_promo'];
$harga =  $data_transaksi['harga'];
$masa_aktif = $data_transaksi['masa_aktif'];

// cari nama member
$member = mysqli_query($con, "SELECT * FROM user WHERE id_user  = $id_member") or
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
$kelas = mysqli_query($con, "SELECT * FROM kelas WHERE id_kelas = $id_kelas") or
die(mysqli_error($con));
$kelas = mysqli_fetch_array($kelas);
$nama_kelas = $kelas['nama_kelas'];
$harga_kelas = $kelas['harga'];

if($id_promo != -1){
    // cari nama promo
    $promo = mysqli_query($con, "SELECT * FROM promo WHERE id_promo = $id_promo") or
    die(mysqli_error($con));
    $promo = mysqli_fetch_array($promo);
    $nama_promo = $promo['nama_promo'];
}




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
            Deposit <?php 
            if($id_promo != -1){
            echo "(" . $nama_promo . ")";
            }
            ?>
            <span ><?php echo "Rp. " .  $harga . ",- ( ". $deposit . " x Rp. " . $harga_kelas ." )"?></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Total Deposit
            <span ><?php echo $totalDeposit ?></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Jenis Kelas
            <span ><?php echo $nama_kelas ?></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Berlaku Sampai Dengan
            <span ><?php echo $masa_aktif ?></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Kasir
            <span ><?php echo $kasir ?></span>
        </li>
        
        
    </ul>
    <hr>
    <div class="d-flex justify-content-center">
    <a href="../process/downloadStrukDepositKelasProcess.php?id=<?php echo $id ?>" 
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