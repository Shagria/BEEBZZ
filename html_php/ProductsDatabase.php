<?php
require_once './pdo.php';

class ProductsDatabase extends Database
{
    public function fetchAll()
    {
        $query = "SELECT * FROM `products`"; //zmenit na backtics
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function fetchByCategory($category_id)
    {
        $query = "SELECT * FROM `products` where category_id = $category_id";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function fetchWithPrice($category_id, $price_from, $price_to)
    {
        $query = "SELECT * FROM `products` WHERE category_id = $category_id and price between $price_from and $price_to";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function fetchByProductId($product_id)
    {
        $query = "SELECT * FROM `products` where product_id = $product_id";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function fetchByCategoryPagination($category_id, $start, $rows)
    {
        $query = "SELECT * FROM `products` where category_id = $category_id LIMIT $start, $rows";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function fetchSorted($category_id, $sorted, $start, $rows){
        $query = "SELECT * FROM `products` where category_id = $category_id ORDER BY price $sorted";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }
}
