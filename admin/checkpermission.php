<?php
// Kết nối cơ sở dữ liệu và thực hiện câu truy vấn
include 'C:\Users\dungv\Desktop\DA1\model\connect.php';
require_once 'C:\Users\dungv\Desktop\DA1\admin\start_session.php';
function checkAdminAccess() {
    // Kiểm tra thông tin session
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];

        // Truy vấn để lấy vai trò từ username
        global $conn; // Để sử dụng biến $conn trong hàm, chúng ta phải khai báo nó là global
        $sql = "SELECT role FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $role = $row['role'];

            if ($role === 'admin') {
                // Người dùng có vai trò "admin", cho phép truy cập vào file "admin.php"
                return true;
            } else {
                // Người dùng không có quyền truy cập, hiển thị thông báo hoặc chuyển hướng đến trang khác
                echo "Bạn không có quyền truy cập vào trang này.";
                // Hoặc:
                header("Location: /view/signin_signup/signin.php");
                exit();
            }
        } else {
            // Không tìm thấy thông tin người dùng, xử lý tương ứng
            echo "Bạn không có quyền truy cập vào trang này.";
            header("Location: /view/signin_signup/signin.php");
            exit();
        }
    } else {
        echo "Bạn không có quyền truy cập vào trang này.";
        header("Location: /view/signin_signup/signin.php");
        exit();
        // Người dùng chưa đăng nhập, xử lý tương ứng
    }
}

// Gọi hàm để kiểm tra quyền truy cập
if (!checkAdminAccess()) {
    // Người dùng không có quyền truy cập, xử lý tương ứng
    exit();
}

// Các xử lý khác trong trang admin.php
// ...

// Đóng kết nối
mysqli_close($conn);
?>
