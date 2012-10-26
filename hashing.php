<?php
/* Author: Geoffery L. Miller
Code below uses SHA256
http://php.net/manual/en/function.crypt.php

Using PBKDF2 would be better, but iSpace does not have mcrypt installed
http://www.php.net/manual/en/book.mcrypt.php
http://crackstation.net/hashing-security.htm
https://defuse.ca/php-pbkdf2.htm

Using Blowfish would be better, but iSpace has php 5.3.3 and 
$2y$ mode was added in php 2.3.7
http://phpmaster.com/why-you-should-use-bcrypt-to-hash-stored-passwords/

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

Please see http://www.gnu.org/licenses/gpl.txt for GPL3 information
*/
function create_salt() {
	$salt = ""; 
	for ($i = 0; $i < 16; $i++) { 
		$salt .= substr("./ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789", mt_rand(0, 63), 1); 
	} 
	return $salt;
}
function create_hash($password, $hashsalt=null) {
	$mode = '$5$rounds=5000$';
	if (empty($hashsalt))	{
		$salt = create_salt();
		$salty = $mode.$salt;
	}
	else	{
		$l = strlen($mode);
		$salty = substr($hashsalt,0,$l+16);
	}
	$hash = crypt($password,$salty);
	return $hash;
}
function validate_password($password, $hash)	{
	$hash_check = create_hash($password, $hash);
	if (slow_equals($hash,$hash_check))	{
		return true;
	}
	else	{
		return false;
	}
}

/* Author: havoc AT defuse.ca
	https://defuse.ca/php-pbkdf2.htm */
function slow_equals($a, $b)
{
    $diff = strlen($a) ^ strlen($b);
    for($i = 0; $i < strlen($a) && $i < strlen($b); $i++)
    {
        $diff |= ord($a[$i]) ^ ord($b[$i]);
    }
    return $diff === 0; 
}


?>
