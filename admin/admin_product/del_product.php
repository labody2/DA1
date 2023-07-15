<?php
include 'C:\Users\dungv\Desktop\DA1\admin\checkpermission.php';
?>
<?php
include 'C:\Users\dungv\Desktop\DA1\model\connect.php';

// Kiểm tra xem có tham số truy vấn "id" được gửi đi hay không
if (isset($_GET["id"])) {
    $productId = $_GET["id"];

    // Kiểm tra xem productId có phải là một số nguyên hợp lệ hay không
    if (is_numeric($productId)) {
        // Xóa sản phẩm từ cơ sở dữ liệu
        $sql = "DELETE FROM products WHERE id = $productId";
        if (mysqli_query($conn, $sql)) {
            echo "Sản phẩm đã được xóa thành công!";
        } else {
            echo "Lỗi: " . mysqli_error($conn);
        }
    } else {
        echo "Lỗi: Product ID không hợp lệ!";
    }
} else {
    echo "Lỗi: Không tìm thấy Product ID!";
}

// Đóng kết nối
mysqli_close($conn);
?>
