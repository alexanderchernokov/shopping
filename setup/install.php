<?php
/**
 * Created by PhpStorm.
 * User: Alex.Chernokov
 * Date: 02/11/2016
 * Time: 22:28
 */
require_once('../db/db.php');
function sanit($val){
    $str = strip_tags($val, '<a><b><i><img>');
    $str = htmlentities($str, ENT_QUOTES, "UTF-8");
    return $str;
}
$DB = new DB;
define('PRGM_TABLE_PREFIX', $_POST['db_prefix']);
$DB->database = sanit($_POST['db_name']);
$DB->password = sanit($_POST['db_password']);
$DB->server   = sanit($_POST['host']);
$DB->user     = sanit($_POST['db_user']);
if(!$DB->connect(true))
{
    die('<div style="background-color: #ffeaef; margin: 10% auto; font-size: 15px; font-weight: bold; border: 1px solid red; padding: 10px; text-align: center; width: 80%">We are sorry, this page cannot be loaded right now due to a database error.<br /><br />Please visit this site later.</div>');
}
else{
    $config_file = fopen("../db/config.php", "w") or die("Unable to open file!");


    $txt = '<?php ';
    $txt .= 'define("PRGM_TABLE_PREFIX", "'.PRGM_TABLE_PREFIX.'"); ';
    $txt .= '$database = array(); ';
    $txt .= '$database["server_name"]  = "'.$DB->server.'"; ';
    $txt .= '$database["name"]  = "'.$DB->database.'"; ';
    $txt .= '$database["username"]  = "'.$DB->user.'"; ';
    $txt .= '$database["password"]  = "'.$DB->password.'"; ';
    $txt .= '?>';
    fwrite($config_file, $txt);
    fclose($config_file);
}
$DB->set_names('utf-8');

$msg = '';
$error = 0;

if($DB->query("CREATE TABLE `".PRGM_TABLE_PREFIX."categories` (
                    `category_id` INT(5) NOT NULL AUTO_INCREMENT,
                    `parent_category_id` INT(5) NULL,
                    `category_name` VARCHAR(45) NULL,
                PRIMARY KEY (`category_id`))")){
    $msg .= '<div class="success">The "<b>category</b>" table has been created successfully</div>';
}
else{
    $msg .= '<div class="failed">The "<b>category</b>" table creating is failed</div>';
    $error = 1;
}

if($DB->query("CREATE TABLE `".PRGM_TABLE_PREFIX."product` (
                    `product_id` INT(10) NOT NULL AUTO_INCREMENT,
                    `product_name` VARCHAR(155) NULL,
                    `product_price` DECIMAL(8,2) NULL,
                PRIMARY KEY (`product_id`))")){
    $msg .= '<div class="success">The "<b>product</b>" table has been created successfully</div>';
}
else{
    $msg .= '<div class="failed">The "<b>product</b>" table creating is failed</div>';
    $error = 1;
}

if($DB->query("CREATE TABLE `".PRGM_TABLE_PREFIX."types` (
                    `type_id` INT(5) NOT NULL AUTO_INCREMENT,
                    `type_name` VARCHAR(45) NULL,
                  PRIMARY KEY (`type_id`))")){
    $msg .= '<div class="success">The "<b>types</b>" table has been created successfully</div>';
}
else{
    $msg .= '<div class="failed">The "<b>types</b>" table creating is failed</div>';
    $error = 1;
}

if($DB->query("CREATE TABLE `".PRGM_TABLE_PREFIX."types_products` (
                      `product_id` INT(10) NOT NULL,
                      `type_id` INT(5) NOT NULL,
                  UNIQUE INDEX `product_id_UNIQUE` (`product_id` ASC))")){
    $msg .= '<div class="success">The "<b>types products</b>" table has been created successfully</div>';
}
else{
    $msg .= '<div class="failed">The "<b>types products</b>" table creating is failed</div>';
    $error = 1;
}

if($DB->query("CREATE TABLE `".PRGM_TABLE_PREFIX."categories_products` (
                      `product_id` INT(10) NOT NULL,
                      `category_id` INT(5) NOT NULL,
                  UNIQUE INDEX `product_id_UNIQUE` (`product_id` ASC))")){
    $msg .= '<div class="success">The "<b>categories_products</b>" table has been created successfully</div>';
}
else{
    $msg .= '<div class="failed">The "<b>categories_products</b>" table creating is failed</div>';
    $error = 1;
}
if($_POST['insert_values'] == 1){
        if($DB->query("INSERT INTO `".PRGM_TABLE_PREFIX."categories`
            (`parent_category_id`,`category_name`)
        VALUES
            (0,'Furniture'),
            (0,'Kitchen'),
            (0,'Bathroom'),
            (1,'Bedroom'),
            (1,'Living Room'),
            (1,'Dining Room'),
            (2,'Tableware'),
            (2,'Barware'),
            (3,'Shower Heads'),
            (3,'Towels')")){
        $msg .= '<div class="success">The "<b>categories </b>" has been created successfully</div>';
        }
        else{
            $msg .= '<div class="failed">The "<b>categories</b>" creating is failed</div>';
            $error = 1;
        }

        if($DB->query("INSERT INTO `".PRGM_TABLE_PREFIX."types`
            (`type_name`)
        VALUES
        ('Table'),
            ('Chair'),
            ('Bathroom'),
            ('Stove'),
            ('Fork'),
            ('Cup'),
            ('Shower'),
            ('Towel'),
            ('Sofa'),
            ('Bed')"
        )
        ){
        $msg .= '<div class="success">The "<b>types </b>" has been created successfully</div>';
        }
        else{
            $msg .= '<div class="failed">The "<b>types</b>" creating is failed</div>';
            $error = 1;
        }
}
if($error == 0){
    $msg .= '<div>Instalation finished.Please <a href="../">GO TO THE SITE</a></div>';
}

echo $msg;