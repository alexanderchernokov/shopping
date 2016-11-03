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
	'string' => '<script>alert(1); $("body").remove(); </script>'
);

$filters = array(
	'string' => 'sanitize_string'
);

print_r($validator->filter($_POST, $filters));
