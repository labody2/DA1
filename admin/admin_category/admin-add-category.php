<?php
// Kết nối đến cơ sở dữ liệu
include 'C:\Users\dungv\Desktop\DA1\model\connect.php';
// (Giả sử bạn đã có tập tin kết nối với tên connect.php)

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $category_id = $_POST["category_id"];
    $category_name = $_POST["category_name"];

    // Kiểm tra và xử lý dữ liệu nếu cần

    // Thực hiện truy vấn để thêm mới danh mục vào cơ sở dữ liệu
    // Ví dụ:
    // $sql = "INSERT INTO categories (id, name) VALUES ('$category_id', '$category_name')";
    // mysqli_query($conn, $sql); // Thực thi truy vấn
    // (Lưu ý: Trước khi thực hiện truy vấn, hãy chắc chắn là bạn đã kết nối thành công đến cơ sở dữ liệu)

    // Sau khi thêm mới thành công, bạn có thể chuyển hướng người dùng đến trang danh sách danh mục hoặc trang chi tiết danh mục, ví dụ:
    // header("Location: /admin/admin_category/category_list.php");
    // exit;
}
?>
