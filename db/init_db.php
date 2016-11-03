<?php
/**
 * Created by PhpStorm.
 * User: Alex.Chernokov
 * Date: 03/11/2016
 * Time: 10:40
 */
require_once('db/db.php');
require_once('db/config.php');
$DB = new DB;
//define('PRGM_TABLE_PREFIX', $_POST['db_prefix']);
$DB->database = $database["name"];
$DB->password = $database["password"];
$DB->server   = $database["server_name"];
$DB->user     = $database["username"];
if(!$DB->connect(true))
{
    die('<div style="background-color: #ffeaef; margin: 10% auto; font-size: 15px; font-weight: bold; border: 1px solid red; padding: 10px; text-align: center; width: 80%">We are sorry, this page cannot be loaded right now due to a database error.<br /><br />Please visit this site later.</div>');
}
