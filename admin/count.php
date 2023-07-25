<?php
        include 'C:\Users\dungv\Desktop\DA1\model\connect.php';
        $sql_users = "SELECT COUNT(*) AS total_users FROM users";
        $result_users = mysqli_query($conn, $sql_users);
        if ($result_users) {
            $row_users = mysqli_fetch_assoc($result_users);
            $total_users = $row_users['total_users'];
        } else {
            $total_users = 0;
        }
        $sql_products = "SELECT COUNT(*) AS total_products FROM products";
        $result_products = mysqli_query($conn, $sql_products);
        if ($result_products) {
            $row_products = mysqli_fetch_assoc($result_products);
            $total_products = $row_products['total_products'];
        } else {
            $total_products = 0;
        }

        $sql_articles = "SELECT COUNT(*) AS total_articles FROM article";
        $result_articles = mysqli_query($conn, $sql_articles);
        if ($result_articles) {
            $row_articles = mysqli_fetch_assoc($result_articles);
            $total_articles = $row_articles['total_articles'];
        } else {
            $total_articles = 0;
        }
        $sql_categories = "SELECT COUNT(*) AS total_categories FROM categories";
        $result_categories = mysqli_query($conn, $sql_categories);
        if ($result_categories) {
            $row_categories = mysqli_fetch_assoc($result_categories);
            $total_categories = $row_categories['total_categories'];
        } else {
            $total_categories = 0;
        }
        ?>