<?php 
// mengaktifkan session pada php
session_start();
 
// menghubungkan php dengan koneksi database
// ..//config/koneksi.php
include '../config/koneksi.php';
 
// menangkap data yang dikirim dari form login


if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = ($_POST['password']);
 
// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($conn,"select * from user where email_user='$email' and password='$password'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);
 
// cek apakah username dan password di temukan pada database
if($cek > 0){
 
	$data = mysqli_fetch_assoc($login);
    //menampilkan type_account
    $user_type = mysqli_query($conn,"select * from account_type where id='$data[id_user_type]'");
    $type = mysqli_fetch_assoc($user_type);
	// cek jika user login sebagai admin
	if($data['id_user_type']==1){
		// buat session login dan username
		$_SESSION['email'] = $email;
		$_SESSION['id_user_type'] = $type['type_account'];
        $_SESSION['nama']=$data ['nama_user'];
		// alihkan ke halaman dashboard admin
		header("location:../super_admin.php");
 
	// cek jika user login sebagai pegawai
	}else if($data['id_user_type']=2){
        
		// buat session login dan username
		$_SESSION['email'] = $email;
		$_SESSION['id_user_type'] = $type['type_account'];
        $_SESSION['nama']=$data ['nama_user'];


		// alihkan ke halaman dashboard pegawai
		header("location:../super_admin_dashboard.php");
	}else{
 
		// alihkan ke halaman login kembali
		header("location:form_login.php?pesan=gagal2");
	}	
}else{
	header("location:form_login.php?pesan=gagal1");
}
}
 
?>