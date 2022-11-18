<?php 
 
session_start();
session_destroy();
header("Location: ../form_login.php");

 
?>
<script language="JavaScript">
        alert('Berhasil Keluar');
        
</script>