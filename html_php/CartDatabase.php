<?php
require_once './pdo.php';

class CartDatabase extends Database
{
    
    public function addToCart($product_id,$user_id,$quantity){
        $now = time();
        $query = "INSERT INTO cart (product_id, user_id, quantity, order_id)
                  VALUES ('$product_id', '$user_id', '$quantity', '$now') ";
        $statement = $this->pdo->prepare($query);
        $result = $statement->execute();
        return $result;
    }
    public function getAllFromCart(){
        $query = "SELECT `order_id`,COUNT(`quantity`)  FROM cart GROUP BY `order_id`;";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function getCartByOrderId($order_id){
        $query = "SELECT * FROM cart WHERE order_id = $order_id";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }
}
