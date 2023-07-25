<?php

include 'C:\Users\dungv\Desktop\DA1\model\connect.php';

//admin-category
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

function getCategoryDetail($conn, $categoryId)
{
    $sql = "SELECT * FROM categories WHERE id = $categoryId";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $category = mysqli_fetch_assoc($result);
        return $category;
    } else {
        return null;
    }
}

function addCategory($conn, $categoryName)
{
    $currentTime = date("Y-m-d H:i:s");
    $sql = "INSERT INTO categories (category_name, create_time) VALUES ('$categoryName', '$currentTime')";
    if ($conn->query($sql) === TRUE) {
        echo "Thêm danh mục thành công!";
        echo "<script>window.location.href = '/admin/admin_control.php?link=category';</script>";
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}

function updateCategory($conn, $categoryId, $categoryName)
{
    $category = getCategoryDetail($conn, $categoryId);
    if ($category) {
        $currentTime = date("Y-m-d H:i:s");
        $sql = "UPDATE categories SET category_name = '$categoryName', create_time = '$currentTime' WHERE id = $categoryId";
        if ($conn->query($sql) === TRUE) {
            echo "Cập nhật danh mục thành công!";
            echo "<script>window.location.href = '/admin/admin_control.php?link=category';</script>";
        } else {
            echo "Lỗi: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Không tìm thấy danh mục có ID $categoryId";
    }
}

function deleteCategory($conn, $categoryId)
{
    $sql = "DELETE FROM categories WHERE id = $categoryId";
    if (mysqli_query($conn, $sql) === TRUE) {
        echo "Xóa danh mục thành công!";
        echo "<script>window.location.href = '/admin/admin_control.php?link=category';</script>";
    } else {
        echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $categoryName = $_POST["categoryName"];

    if (isset($_POST["update"])) {
        $categoryId = $_POST["category_id"];
        updateCategory($conn, $categoryId, $categoryName);
    } elseif (isset($_POST["add"])) {
        addCategory($conn, $categoryName);
    }
}

// Delete category
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $categoryId = $_GET["id"];
    if (isset($_GET["action"])) {
        $action = $_GET["action"];
        if ($action === "delete") {
            deleteCategory($conn, $categoryId);
        }
    }
}

// Đóng kết nối
mysqli_close($conn);
?>
