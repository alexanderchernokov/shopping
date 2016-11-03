<?php
/**
 * Created by PhpStorm.
 * User: Alex.Chernokov
 * Date: 03/11/2016
 * Time: 10:41
 */
require "classes/sanitize.class.php";

$validator = new SANITIZATION();

// What are noise words? http://support.dtsearch.com/webhelp/dtsearch/noise_words.htm

$_POST = array(
	'words' => "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English"
);

$filters = array(
	'words' => 'noise_words'
);

print_r($validator->filter($_POST, $filters));
