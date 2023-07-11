<?php
//connect
$servername = "localhost"; // Tên máy chủ MySQL
$username = "root"; // Tên đăng nhập MySQL
$password = "123456"; // Mật khẩu MySQL
$database = "land_list"; // Tên cơ sở dữ liệu MySQL (nếu có)

// Tạo kết nối
$conn = mysqli_connect($servername, $username, $password, $database);

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối MySQL thất bại: " . mysqli_connect_error());
}else{
    
}
?>