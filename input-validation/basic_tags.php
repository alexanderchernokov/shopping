<?php
/**
 * Created by PhpStorm.
 * User: Alex.Chernokov
 * Date: 03/11/2016
 * Time: 10:41
 */
require "classes/sanitize.class.php";

$validator = new SANITIZATION();

$validator->validation_rules(array(
	'comment' => 'required|max_len,500',
));

$validator->filter_rules(array(
	'comment' => 'basic_tags',
));

// Valid Data
$_POST = array(
	'comment' => '<strong>this is freaking awesome</strong><script>alert(1);</script><br><a href="#">Click here</a>'
);


$_POST = $validator->run($_POST);

print_r($_POST);