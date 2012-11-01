<?php
include("hashing.php");
$password = "password";
$hashpass = create_hash($password);
echo $hashpass . "\n";
echo strlen($hashpass) . "\n";
?>
