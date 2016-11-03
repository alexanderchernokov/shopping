<?php

/**
 * Created by PhpStorm.
 * User: Alex.Chernokov
 * Date: 03/11/2016
 * Time: 10:56
 */
class CATALOG
{
    public function __construct()
    {
        $this->categories = PRGM_TABLE_PREFIX.'categories';
        $this->types = PRGM_TABLE_PREFIX.'types';
        $this->product = PRGM_TABLE_PREFIX.'product';
        $this->categories_products = PRGM_TABLE_PREFIX.'categories_products';
        $this->types_products = PRGM_TABLE_PREFIX.'types_products';
    }

    public function get_menu_tree($parent_id)
        {
            global $DB;
            if(!$parent_id OR $parent_id ==''){$parent_id = 0;}
            $menu = "";
            $query = $DB->query("SELECT * FROM ".$this->categories." WHERE `parent_category_id`=%d",$parent_id);
            while($row=$DB->fetch_array($query))
            {
                $menu .="<li><a href='?category_id=".$row['category_id']."'>".$row['category_name']."</a>";

                $menu .= "<ul>".$this->get_menu_tree($row['category_id'])."</ul>"; //call  recursively

                $menu .= "</li>";

            }

            return $menu;
        }
    public function get_home_products(){
        global $DB;
        $table = '<table width="100%">
                    <tr>
                        <th>Product</th>
                        <th>Type</th>
                        <th>Price</th>
                    </tr>';
                    $query = $DB->query("
                        SELECT ".$this->product.".*,".$this->types_products.".type_id,".$this->types.".type_name
                        FROM ".$this->product."
                        INNER JOIN ".$this->types_products." ON ".$this->product.".product_id = ".$this->types_products.".product_id
                        INNER JOIN ".$this->types." ON ".$this->types_products.".type_id = ".$this->types.".type_id
                    ");
                    while($row = $DB->fetch_array($query)){
                        $table .= '<tr><td>'.$row['product_name'].'</td><td>'.$row['type_name'].'</td><td>'.$row['product_price'].'</td></tr>';
                    }
        $table .= '</table>';
        return $table;
    }

    public function get_category_products($id){
        global $DB;

        function get_all_subcategories($start,$table)
        {
            global $DB;
            $str = $start;
            $query = $DB->query("SELECT * FROM ".$table." WHERE `parent_category_id`=%d",$start);
            while($row=$DB->fetch_array($query))
            {
                $str .= ",".get_all_subcategories($row['category_id'],$table); //call  recursively
            }

            return $str;
        }
        $sub_categories =  get_all_subcategories($id,$this->categories);
        $table = '<table width="100%">
                    <tr>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Type</th>
                        <th>Price</th>
                    </tr>';

        $query = $DB->query("
                        SELECT 
                            ".$this->categories_products.".*,
                            ".$this->categories.".category_name,
                            ".$this->types_products.".type_id,
                            ".$this->types.".type_name,
                            ".$this->product.".*
                        FROM ".$this->categories_products."
                        INNER JOIN ".$this->categories." ON ".$this->categories_products.".category_id = ".$this->categories.".category_id
                        INNER JOIN ".$this->types_products." ON ".$this->categories_products.".product_id = ".$this->types_products.".product_id
                        INNER JOIN ".$this->types." ON ".$this->types.".type_id = ".$this->types_products.".type_id
                        INNER JOIN ".$this->product." ON ".$this->product.".product_id = ".$this->categories_products.".product_id
                        WHERE ".$this->categories_products.".category_id IN (".$sub_categories.")"
                    );
        $count = $DB->get_num_rows($query);
        if($count >0){
            while($row = $DB->fetch_array($query)){
                $table .= '<tr><td>'.$row['product_name'].'</td><td>'.$row['category_name'].'</td><td>'.$row['type_name'].'</td><td>'.$row['product_price'].'</td></tr>';
            }
        }
        else{
            $table .= '<tr><td colspan="4"><b>No Products found</b></td></tr>';
        }
        $table .= '</table>';
        return $table;
    }
}