<?php
/****
This is security class providing functionalities of two way cryptographic system.
Author : Anurag Jain
****/
class security_class
{
private $key;

function __construct($key)
{
$this->key = $key;
}

function encrypt($value)
{
$output = '';

for ($i = 0; $i < strlen($value); $i++)
{
$char = substr($value, $i, 1);
$keychar = substr($this->key, ($i % strlen($this->key)) - 1, 1);
$char = chr(ord($char) + ord($keychar));	/*adds the ASCII values of corresponding letters of plaintext and key repeatedly. divide by 255 is not required as 
											i needed special characters in cryptic text for encoding it properly.*/

$output .= $char;
}

return base64_encode($output);
}

function decrypt($value)
{
$output = '';

$value = base64_decode($value);

for ($i = 0; $i < strlen($value); $i++)
{
$char = substr($value, $i, 1);
$keychar = substr($this->key, ($i % strlen($this->key)) - 1, 1);
$char = chr(ord($char) - ord($keychar));

$output .= $char;
}

return $output;
}


function random_string($length = 8)
{
$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQ
RSTUVWXYZ0123456789!%,-:;@_{}~";

for ($i = 0, $makepass = '', $len = strlen($chars); $i < $length; $i++)
{
$makepass .= $chars[mt_rand(0, $len-1)];	//appends a random character from  the $char to create $makepass
}

return $makepass;
}


}

?>