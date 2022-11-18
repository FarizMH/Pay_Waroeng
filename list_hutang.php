<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <?php include('dashboard/head.php') ?>
</head>

<body>
<?php 
    session_start();
  
    // cek apakah yang mengakses halaman ini sudah login
    if($_SESSION['id_user_type']==""){
      header("location:admin.php?pesan=gagal");
    }
  
  ?>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <?php include('dashboard/nav_bar.php')?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_sidebar.html -->
      <?php include('dashboard/side_bar.php') ?>
      <!-- partial -->
      <div class="main-panel">
      <?php
      include "config/koneksi.php"; 
      $batas=10;
      $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
      $halaman_awal = ($halaman > 1)?($halaman * $batas) - $batas : 0;
      $previous = $halaman - 1;
			$next = $halaman + 1;
      $list_hutang = mysqli_query($conn, 'SELECT hutang.id_pegawai_hutang, pegawai.id_pegawai, pegawai.nama_pegawai, hutang.nominal, hutang.status_hutang, hutang.create_at 
              FROM hutang JOIN pegawai ON hutang.id_pegawai_hutang  = pegawai.id_pegawai');
      $jumlah_data = mysqli_num_rows($list_hutang);
      $total_halaman = ceil($jumlah_data / $batas);
      ?>
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">List Hutang</h4>
                  <p class="card-description">
                    Add class <code>.table</code>
                  </p>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama</th>
                          <th>Nominal</th>
                          <th>Status</th>
                          <th>Waktu</th>
                          <th>Tool</th>
                        </tr>
                      </thead>
                      <?php 
                        include "config/koneksi.php";
                        $no=1;
                        $query = mysqli_query($conn, "SELECT hutang.id_pegawai_hutang, pegawai.id_pegawai, pegawai.nama_pegawai, hutang.nominal, hutang.status_hutang, hutang.create_at 
                        FROM hutang  JOIN pegawai ON hutang.id_pegawai_hutang  = pegawai.id_pegawai limit $halaman_awal, $batas");
                        $nomor = $halaman_awal+1;
                        while ($data = mysqli_fetch_array($query)) {
                      ?>
                      <tbody>
                        <tr>
                          <td><?php echo $no++ ?></td>
                          <td><?php echo $data['nama_pegawai'] ?></td>
                          <td><?php echo $data['nominal'] ?></td>
                          <td><?php echo $data['status_hutang'] ?></td>
                          <td><?php echo $data['create_at'] ?></td>
                          <td><a>Ubah ||</a> <a>|| Hapus</a></td>
                        </tr>
                        <?php } ?>
                        
                      </tbody>
                    </table>
                    <ul class="pagination justify-content-center">
                      <li class="page-item">
                        <a class="page-link" <?php if($halaman > 1){ echo "href='?halaman=$previous'"; } ?>>Previous</a>
                      </li>
                      <?php 
                      for($x=1;$x<=$total_halaman;$x++){
                        ?> 
                        <li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                        <?php
                      }
                      ?>				
                      <li class="page-item">
                        <a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?halaman=$next'"; } ?>>Next</a>
                    </li>
                  </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <?php include('dashboard/footer.php')?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <?php include('dashboard/js_script.php')?>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
</body>

</html>
