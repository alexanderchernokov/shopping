<?php
/**
 * Created by PhpStorm.
 * User: Alex.Chernokov
 * Date: 03/11/2016
 * Time: 10:41
 */
require "classes/sanitize.class.php";


// Add the custom validator
SANITIZATION::add_validator("is_object", function($field, $input, $param = NULL) {
    return is_object($input[$field]);
});

// Generic test data
$input_data = array(
  'not_object'   => "asdasd",
  'valid_object' => new stdClass()
);

$rules = array(
  'not_object'   => "is_object",
  'valid_object' => "is_object"
);

// METHOD 1 (Long):

$validator = new SANITIZATION();

$validated = $validator->validate(
	$input_data, $rules
);

if($validated === true) {
	echo "Validation passed!";
} else {
	echo $validator->get_readable_errors(true);
}

// METHOD 2 (Short):

$is_valid = SANITIZATION::is_valid($input_data, $rules);

if($is_valid === true) {
	echo "Validation passed!";
} else {
    print_r($is_valid);
}
