<?php
include 'C:\Users\dungv\Desktop\DA1\model\connect.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $userId = $_GET["id"];
    
    // Tìm giá trị status hiện tại của người dùng dựa vào id
    $selectSql = "SELECT status FROM users WHERE id = '$userId'";
    $result = mysqli_query($conn, $selectSql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $currentStatus = $row["status"];
        echo $currentStatus;
        // Đảo ngược giá trị status
        $newStatus = ($currentStatus == 1) ? 0 : 1;
        echo $newStatus;
        // Cập nhật giá trị trong cơ sở dữ liệu
        $updateSql = "UPDATE users SET status = $newStatus WHERE id = '$userId'";
        if (mysqli_query($conn, $updateSql)) {
            // Cập nhật trạng thái thành công
            echo '<script>window.location.href = "' . $_SERVER["HTTP_REFERER"] . '";</script>';
            exit; // Đảm bảo không có mã HTML hoặc mã PHP khác được thực thi sau khi chuyển hướng
        } else {
            echo "error: " . mysqli_error($conn);
        }        
    } else {
        echo "User not found";
    }
} else {
    echo "Invalid request";
}
?>
