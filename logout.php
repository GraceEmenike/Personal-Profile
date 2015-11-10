<?php
$expiretime = time() - 3600;
setcookie("login", "", $expiretime);
setcookie("index", "", $expiretime);
header("location: index.html")
?>
<!DOCTYPE html>
