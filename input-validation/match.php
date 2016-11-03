<?php
/**
 * Created by PhpStorm.
 * User: Alex.Chernokov
 * Date: 03/11/2016
 * Time: 10:41
 */
require "classes/sanitize.class.php";

$data = array(
  'username'         => "myusername",
  'password'         => "mypassword",
  'password_confirm' => "mypa33word",
);

$is_valid = SANITIZATION::is_valid($data, array(
	'username'         => 'required|alpha_numeric',
	'password'         => 'required|max_len,100|min_len,6',
  'password_confirm' => 'equalsfield,password',
));

if($is_valid === true) {
	// continue
} else {
	print_r($is_valid);
}
