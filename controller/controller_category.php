<?php
include 'C:\Users\dungv\Desktop\DA1\model\connect.php';
function getCategories($conn)
{
    $sql = "SELECT * FROM categories";
    $result = $conn->query($sql);
    $categories = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
    }
    return $categories;
}
function getCategoryById($conn, $categoryId)
{
    $sql = "SELECT * FROM categories WHERE categoryId = $categoryId";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        return $row;
    } else {
        return null;
    }
}
?>