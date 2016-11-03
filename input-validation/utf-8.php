<?php
/**
 * Created by PhpStorm.
 * User: Alex.Chernokov
 * Date: 03/11/2016
 * Time: 10:41
 */
error_reporting(-1);

ini_set('display_errors', 1);

require "classes/sanitize.class.php";

$data = array(
	'one' => 'Freiheit, Mobilität und Unabhängigkeit lebt. ö, Ä, é, or ß',
	'two' => 'ß'
);

$validated = SANITIZATION::is_valid($data, array(
	'one' => 'required|min_len,10',
	'two' => 'required|min_len,1',
));

if($validated === true) {
	echo "Valid Text\n";
} else {
	print_r($validated);
}