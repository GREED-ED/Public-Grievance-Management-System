<?php
session_start();
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'en';
session_unset();
session_destroy();
header("Location: login.php?lang=" . $lang);
exit();
?>
