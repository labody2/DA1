<?php
// Kiểm tra xem session đã được bắt đầu chưa trước khi gọi session_start()
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
