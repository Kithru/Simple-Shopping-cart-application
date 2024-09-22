<?php

require_once "Classes/DBConnect.php";

class ItemManager {

    public function additemdetails($name, $price, $remark, $image, $category) {
        $con = DBConnect::getConnection();
        $sql = "INSERT INTO meals(`name`, `price`,`remark`,`image`,`category`,`added_date`)
                VALUES ('$name','$price','" . mysql_real_escape_string($remark) . "','$image','$category',CURRENT_TIMESTAMP)";
        $result = mysql_query($sql, $con) or die(mysql_error());
        if ($result) {
            return "Success";
        } else {
            return "Error";
        }
    }

    public function getitemdetails() {
        $con = DBConnect::getConnection();
        
        $sql = "SELECT * FROM meals";
        $result = mysql_query($sql, $con) or die(mysql_error());

        if ($result) {
            $i = 0;
            $array = array();

            while ($row = mysql_fetch_assoc($result)) {
                $array[$i]['id'] = $row['id'];
                $array[$i]['name'] = $row['name'];
                $array[$i]['price'] = $row['price'];
                $array[$i]['image'] = $row['image'];
                $array[$i]['category'] = $row['category'];
                $i++;
            }

            return $array;
        }
    }
    public function getitemdetailsforcart($id) {
        if (empty($id)) {
            return array();
        }
        $itemsid = implode(',', $id);
        $con = DBConnect::getConnection();
        $sql = "SELECT * FROM meals WHERE id IN ($itemsid)";
        $result = mysql_query($sql, $con) or die(mysql_error());
        
        if ($result) {
            $i = 0;
            while ($row = mysql_fetch_assoc($result)) { 
                $array[$i]['id'] = $row['id'];
                $array[$i]['name'] = $row['name'];
                $array[$i]['price'] = $row['price'];
                $array[$i]['image'] = $row['image'];
                $array[$i]['category'] = $row['category'];
                $i++;
            }
            $results->free(); 
            return $array;
        } else {
            die($con->error);
        }
        $con->close(); 
    }

    public function addorderdetails($name,$email,$address,$city,$state,$zip,$quantity,$amount) {
        $con = DBConnect::getConnection();
        $query = "INSERT INTO `order`(`customer_name`,`address`,`email`,`city`,`state`,`zip`,`order_quantity`,`order_amount`,`added_date`)
        VALUES ('$name','".mysql_real_escape_string($address)."','$email','$city','$state','$zip','$quantity','$amount',CURRENT_TIMESTAMP)";       
            $result = mysql_query($query, $con) or die(mysql_error());
            if ($result) {
                return "Success";
            } else {
                return "Error";
            }
    }

   

}

?>
