<?php
session_start();
session_destroy();
// yazılan url ye dikkat et 
header("Location: ../front-end/loginSayfasi.php");
exit;
?>