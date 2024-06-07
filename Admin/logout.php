<?php 
session_start();
session_destroy();
header("Location: Login.php");
exit(); // Ensure script execution stops after redirection
?>
