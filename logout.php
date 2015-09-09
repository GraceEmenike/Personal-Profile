<?php
$expiretime = time() - 3600;
setcookie("login", "", $expiretime);
header("location: index.php")
?>
<!DOCTYPE html>
