<?php
include_once('database.php');

$password_length = 10;

$possible_chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

$password = "";
for ($i = 0; $i < $password_length; $i++) {
    $random_index = mt_rand(0, strlen($possible_chars) - 1);
    $password .= $possible_chars[$random_index];
}

echo "willekeurig wachtwoord = $password";


?>