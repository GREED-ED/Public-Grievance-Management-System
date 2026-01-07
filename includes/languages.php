<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Set Language
if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
    if ($lang == 'en' || $lang == 'np') {
        $_SESSION['lang'] = $lang;
    }
}

// Default to English
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'en';
}

$lang_code = $_SESSION['lang'];

// Load Language File
$lang_file = __DIR__ . "/../lang/$lang_code.php";
if (file_exists($lang_file)) {
    $lang = include($lang_file);
} else {
    // Fallback
    $lang = []; 
}

// Helper Function
function __($key) {
    global $lang;
    return isset($lang[$key]) ? $lang[$key] : $key;
}
?>
