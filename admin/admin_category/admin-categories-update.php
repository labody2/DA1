<?php
// Kết nối cơ sở dữ liệu và thực hiện câu truy vấn
include 'C:\Users\dungv\Desktop\DA1\model\connect.php';

// Khai báo biến toàn cục
$GLOBALS['message'] = '';

// Kiểm tra xem yêu cầu POST đã được gửi lên hay chưa
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy thông tin từ form chỉnh sửa
    $categoryId = $_POST['category_id'];
    $categoryName = $_POST['category_name'];

    // Câu lệnh SQL UPDATE để cập nhật thông tin category
    $sql = "UPDATE categories SET name = '$categoryName' WHERE id = $categoryId";

    // Thực hiện câu truy vấn
    if (mysqli_query($conn, $sql)) {
        // Cập nhật giá trị của biến toàn cục
        $GLOBALS['message'] = "Thông tin category đã được cập nhật thành công!";
    } else {
        $GLOBALS['message'] = "Lỗi: " . mysqli_error($conn);
    }
}

// Đóng kết nối
mysqli_close($conn);

// Hiển thị thông báo
echo $GLOBALS['message'];
?>
