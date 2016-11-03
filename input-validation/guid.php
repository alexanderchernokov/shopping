<?php
/**
 * Created by PhpStorm.
 * User: Alex.Chernokov
 * Date: 03/11/2016
 * Time: 10:41
 */
require "classes/sanitize.class.php";


$data = array(
  'guid' => "A98C5A1E-A742-4808-96FA-6F409E799937"
);

$is_valid = SANITIZATION::is_valid($data, array(
	'guid' => 'required|guidv4',
));

if($is_valid === true) {
	// continue
} else {
	print_r($is_valid);
}
