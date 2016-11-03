<?php
/**
 * Created by PhpStorm.
 * User: Alex.Chernokov
 * Date: 03/11/2016
 * Time: 10:41
 */
require "classes/sanitize.class.php";


$_FILES = array(
	'attachments' => array(
		'name'     => array("test1.png"),
		'type'     => array("image/png"),
		'tmp_name' => array("/tmp/phpmFkEUe"),
		'error'    => array(0),
		'size'     => array(9855)
	)
);

$errors = array();

$length = count($_FILES['attachments']['name']);

for($i = 0; $i < $length; $i++) {
	$struct = array(
		'name'     => $_FILES['attachments']['name'][$i],
		'type'     => $_FILES['attachments']['type'][$i],
		'tmp_name' => $_FILES['attachments']['tmp_name'][$i],
		'error'    => $_FILES['attachments']['error'][$i],
		'size'     => $_FILES['attachments']['size'][$i],
	);
	
	$validated = SANITIZATION::is_valid($struct, array(
	    'name'     => 'required',
	    'type'     => 'required',
	    'tmp_name' => 'required',
	    'size'     => 'required|numeric',
	));	
	
	if($validated !== true) {
		$errors[] = $validated;
	}
}

print_r($errors);