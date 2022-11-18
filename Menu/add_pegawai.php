<?php
//cek button    
    if ($_POST['submit'] == "submit") {
    $nama_pegawai   = $_POST['form_nama'];
    $email_pegawai  = $_POST['form_email'];
    $no_hp_pegawai  = $_POST['form_no_hp'];
    $gambar         = $_POST['img'];
    $tipe_akun      = $_POST['form_account_type'];
    $status_hutang  = $_POST['form_status'];
    //validasi data data kosong
    if (empty($_POST['form_nama'])||empty($_POST['form_email'])) {
        ?>
             <script language="JavaScript">
                alert('Data Harap Dilengkapi!');
                document.location='../tambah_pegawai.php';
            </script>
        <?php
    }
    else {
    include "../config/koneksi.php";
    //Masukan data ke Table
    
    $sql = "INSERT INTO pegawai (nama_pegawai,email_pegawai,no_hp,gambar,account_type,status_hutang) VALUES ('$nama_pegawai','$email_pegawai','$no_hp_pegawai','$gambar','$tipe_akun','$status_hutang')";
   
    if (mysqli_query($conn, $sql)) {
    //Jika Sukses
    ?>
        <script language="JavaScript">
        alert('Input Data Pegawai Berhasil');
        document.location='../tambah_pegawai.php';
        </script>
    <?php
    }
    else {
    //Jika Gagal
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
//Tutup koneksi engine MySQL
    mysql_close($Open);
    }
}
?>