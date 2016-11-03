<?php
/**
 * Created by PhpStorm.
 * User: Alex.Chernokov
 * Date: 02/11/2016
 * Time: 20:58
 */
if(!file_exists('db/config.php')){
    header("Location:/setup");
}
else{
    require_once ('db/init_db.php');
    require_once ('classes/catalog.php');

    $catalog = new CATALOG();
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Shopping</title>
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
    <div class="container">
        <div class="wrapper">
                <div class="left">
                    <ul class="main-navigation">
                        <?php echo $catalog->get_menu_tree(0);//start from root menus having parent id 0 ?>
                    </ul>
                </div>
                <div class="right">
                    <?php 
                        if(!isset($_GET['category_id'])){
                            echo $catalog->get_home_products();
                        }
                        else{
                            echo $catalog->get_category_products((int)$_GET['category_id']);
                        }
                        
                    ?>
                </div>
        </div>
    </div>
    <script src="js/jquery-2.1.1.js" type="text/javascript"></script>
    <script src="js/main.js" type="text/javascript"></script>
    </body>
    </html>
    <?php
}

