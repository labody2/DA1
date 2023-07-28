<?php
// Khởi đầu phiên làm việc
session_start();

// Xóa tất cả các biến phiên làm việc
$_SESSION = array();

// Huỷ phiên làm việc
session_destroy();

// Chuyển hướng người dùng về trang đăng nhập hoặc trang chính của ứng dụng
// Tùy thuộc vào yêu cầu của bạn, bạn có thể chuyển hướng đến trang nào khác
header("Location: /view/page/index.php");
exit;
?>