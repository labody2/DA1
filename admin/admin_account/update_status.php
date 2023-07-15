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
        
        // Đảo ngược giá trị status
        $newStatus = ($currentStatus == 1) ? 0 : 1;
        echo $newStatus;
        // Cập nhật giá trị trong cơ sở dữ liệu
        $updateSql = "UPDATE users SET status = '$newStatus' WHERE id = '$userId'";
        if (mysqli_query($conn, $updateSql)) {
            echo "success";
        } else {
            echo "error";
        }
    } else {
        echo "User not found";
    }
} else {
    echo "Invalid request";
}
?>
