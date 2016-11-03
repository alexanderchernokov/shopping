<?php
/**
 * Created by PhpStorm.
 * User: Alex.Chernokov
 * Date: 03/11/2016
 * Time: 10:41
 */
require "classes/sanitize.class.php";

$validator = new SANITIZATION();
$_POST = array(
	'username' => "my username",
	'password' => "' OR ''='"
);

$validator->sanitize($_POST);

$filters = array(
	'username' => 'noise_words',
	'password' => 'trim|strtolower|addslashes'
);

print_r($validator->filter($_POST, $filters));

// OR (If you have a mysql connection)

$validator->sanitize($_POST);

$_POST = array(
	'username' => "my username",
	'password' => "' OR ''='"
);

$filters = array(
	'username' => 'noise_words',
	'password' => 'trim|strtolower'
);

$validator->filter($_POST, $filters);

echo mysql_real_escape_string($_POST['password']);
