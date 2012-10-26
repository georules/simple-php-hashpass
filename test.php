<?php
include("hashing.php");

$pass = "my_password";

echo $pass;
echo "\n";

$hash = create_hash($pass);

echo $hash;
echo "\n";
$v = validate_password($pass, $hash);
if ($v) 
	echo "yes";
else
	echo "no";
echo "\n";

$v = validate_password($pass."2", $hash);
if($v)
	echo "yes";
else
	echo "no";
echo "\n";

?>
