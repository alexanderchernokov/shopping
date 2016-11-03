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
	'str' => null
);

$rules = array(
	'str' => 'required'
);

SANITIZATION::set_field_name("str", "Street");

$validated = SANITIZATION::is_valid($data, $rules);

if($validated === true) {
	echo "Valid Street Address\n";
} else {
	print_r($validated);
}