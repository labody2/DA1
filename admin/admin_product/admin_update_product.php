<?php
// Kết nối cơ sở dữ liệu và thực hiện câu truy vấn
include 'C:\Users\dungv\Desktop\DA1\admin\checkpermission.php';
include 'C:\Users\dungv\Desktop\DA1\model\connect.php';

// Kiểm tra xem có tham số truy vấn "product_id" và dữ liệu gửi đi từ form hay không
if (isset($_POST["product_id"]) && isset($_POST["name"]) && isset($_POST["price"]) && isset($_POST["description"])) {
    $productId = $_POST["product_id"];
    $name = $_POST["name"];
    $price = $_POST["price"];
    $description = $_POST["description"];

    // Cập nhật thông tin sản phẩm trong cơ sở dữ liệu
    $sql = "UPDATE products SET name = '$name', price = '$price', description = '$description' WHERE id = $productId";
    if (mysqli_query($conn, $sql)) {
        echo "Thông tin sản phẩm đã được cập nhật thành công!";
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
}

// Đóng kết nối
mysqli_close($conn);
?>
