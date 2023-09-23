<?php

session_start();
$_SESSION = [];
session_unset();
session_destroy();

setcookie('key', '', time() - (60 * 60 * 24)); 

header("Location: index.php");
exit;

?>