<?php
//cek button    
    if ($_POST['submit'] == "submit") {
    $nama_pegawai   = $_POST['form_nama_pegawai'];
    $nominal_hutang  = $_POST['form_nominal'];
    $status_hutang  = $_POST['form_status'];
    //validasi data data kosong
    if (empty($_POST['form_nama_pegawai'])||empty($_POST['form_nominal'])) {
        ?>
             <script language="JavaScript">
                alert('Data Harap Dilengkapi!');
                document.location='../tambah_hutang.php';
            </script>
        <?php
    }
    else {
    include "../config/koneksi.php";
    //Masukan data ke Table
    
    $sql = "INSERT INTO hutang (id_pegawai_hutang,nominal,status_hutang) VALUES ('$nama_pegawai','$nominal_hutang','$status_hutang')";
   
    if (mysqli_query($conn, $sql)) {
    //Jika Sukses
    ?>
        <script language="JavaScript">
        alert('Input Data Pegawai Berhasil');
        document.location='../tambah_hutang.php';
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