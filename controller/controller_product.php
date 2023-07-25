<?php
include 'C:\Users\dungv\Desktop\DA1\model\connect.php';
function getProducts($conn)
{
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);
    $products = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }
    return $products;
}
function getCategoryNameById($conn, $categoryId)
{
    $sql = "SELECT name FROM categories WHERE categoryId = $categoryId";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        return $row['name'];
    } else {
        return null;
    }
}

?>