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

function addProduct($conn, $productName, $price, $description, $categoryId, $img1, $other_room, $bathroom, $square, $accountId_post)
{
    $safeProductName = $conn->real_escape_string($productName);
    $safePrice = (float)$price;
    $safeDescription = $conn->real_escape_string($description);
    $safeCategoryId = (int)$categoryId;
    $safeImg1 = $conn->real_escape_string($img1);
    $safeOtherRoom = (int)$other_room;
    $safeBathroom = (int)$bathroom;
    $safeSquare = (float)$square;
    $safeAccountIdPost = (int)$accountId_post;

    $sql = "INSERT INTO products (name, price, description, categoryId, img1, other_room, bathroom, square, accountId_post)
            VALUES ('$safeProductName', $safePrice, '$safeDescription', $safeCategoryId, '$safeImg1', $safeOtherRoom, $safeBathroom, $safeSquare, $safeAccountIdPost)";

    // Thực thi câu truy vấn
    if ($conn->query($sql) === TRUE) {
        return true; // Thêm sản phẩm thành công
    } else {
        return false; // Lỗi khi thêm sản phẩm
    }
}

?>