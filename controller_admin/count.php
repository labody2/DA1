<?php
// include connect.php if it's not already included in this file
include 'C:\Users\dungv\Desktop\DA1\model\connect.php';

function getTotalUsers($conn) {
    $sql_users = "SELECT COUNT(*) AS total_users FROM users";
    $result_users = mysqli_query($conn, $sql_users);
    $total_users = 0;

    if ($result_users) {
        $row_users = mysqli_fetch_assoc($result_users);
        $total_users = $row_users['total_users'];
    }

    return $total_users;
}

function getTotalProducts($conn) {
    $sql_products = "SELECT COUNT(*) AS total_products FROM products";
    $result_products = mysqli_query($conn, $sql_products);
    $total_products = 0;

    if ($result_products) {
        $row_products = mysqli_fetch_assoc($result_products);
        $total_products = $row_products['total_products'];
    }

    return $total_products;
}
function getTotalArticles($conn){
    $sql_articles = "SELECT COUNT(*) AS total_articles FROM article";
    $result_articles = mysqli_query($conn, $sql_articles);
    if ($result_articles) {
        $row_articles = mysqli_fetch_assoc($result_articles);
        $total_articles = $row_articles['total_articles'];
    } else {
        $total_articles = 0;
    }
    return $total_articles;
}
function getTotalCategories($conn){
    $sql_categories = "SELECT COUNT(*) AS total_categories FROM categories";
    $result_categories = mysqli_query($conn, $sql_categories);
    if ($result_categories) {
        $row_categories = mysqli_fetch_assoc($result_categories);
        $total_categories = $row_categories['total_categories'];
    } else {
        $total_categories = 0;
    }
    return $total_categories;
}
// Define similar functions to get total_articles and total_categories...
?>
