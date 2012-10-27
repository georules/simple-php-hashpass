<?php
include("hashing.php");

$tests = empty($argv[1]) ? 100 : $argv[1]; 

function random_pass()	{
	return create_salt();	
}

$time1=time();
echo $tests . " correct password tests: ";
for ($i=0; $i<$tests; $i++)	{
	$pass = random_pass();
	$hash = create_hash($pass);
	$v = validate_password($pass,$hash);
	if (!$v)	{
		die("Fail: " . $pass . " " . $hash . "\n");
	}
}
echo "pass\n";

echo $tests . " incorrect password tests: ";
for ($i=0; $i<$tests; $i++)	{
	$pass = random_pass();
	$pass2 = random_pass();
	$hash = create_hash($pass);
	$v = validate_password($pass2,$hash);
	if ($v)	{
		die("Fail: " . $pass . " " . $pass2 . " ". $hash . "\n");
	}
}
echo "pass\n";
$time2=time();
$diffsec = ($time2-$time1);
echo "completed in $diffsec seconds\n";
?>
