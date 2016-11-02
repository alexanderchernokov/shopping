<?php
/**
 * Created by PhpStorm.
 * User: Alex.Chernokov
 * Date: 02/11/2016
 * Time: 20:58
 */
function generateRandomString($length = 3) {
    return substr(str_shuffle(str_repeat($x='abcdefghijklmnopqrstuvwxyz', ceil($length/strlen($x)) )),1,$length);
}

echo  generateRandomString();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping</title>
    <link href="../css/style.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="wrapper">
        <div class="content">
            <?php
            $config_content = file_get_contents('../db/config.php');
            if($config_content != ''){
                echo $config_content;
            }
            else{
                echo   '<h1>Installation progress</h1>
                        <h2>Step 1 - DB info</h2>
                        <form id="db_form">
                            <div class="form_group">
                                <label>Host</label>
                                <input type="text" name="host" id="host" value="localhost" required>
                            </div>
                            <div class="form_group">
                                <label>Database name</label>
                                <input type="text" name="db_name" id="db_name" required>
                            </div>
                            <div class="form_group">
                                <label>Database user</label>
                                <input type="text" name="db_user" id="db_user" required>
                            </div>
                            <div class="form_group">
                                <label>Database password</label>
                                <input type="text" name="db_password" id="db_password" required>
                            </div>
                            <div class="form_group">
                                <label>Database preffix</label>
                                <input type="text" name="db_prefix" id="db_prefix" value="'.generateRandomString().'_" required>
                            </div>
                            <div class="form_group check clear_fix">
                                <input type="checkbox" name="insert_values" id="insert_values" value="1" checked>
                                <label>Insert default values for categories, types and products?</label>
                            </div>
                            
                            <div class="form_group">
                                <div id="results"></div>    
                                <input type="submit" class="db_submit" value="Start Instalation">
                            </div>
                        </form>
                        ';
            }
            ?>
        </div>
    </div>
</div>
<script src="../js/jquery-2.1.1.js" type="text/javascript"></script>
<script src="../js/main.js" type="text/javascript"></script>
</body>
</html>



//chmod("../config.php",0777);