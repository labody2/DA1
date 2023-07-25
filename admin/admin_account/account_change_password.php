<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thay đổi mật khẩu admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<?php
// Kiểm tra thông tin session (chắc chắn session đã được bắt đầu)

// Kết nối cơ sở dữ liệu và thực hiện câu truy vấn
include 'C:\Users\dungv\Desktop\DA1\controller_admin\controller_admin_account.php';
include 'C:\Users\dungv\Desktop\DA1\model\connect.php';
// Kiểm tra xem session username có tồn tại không
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Lấy thông tin người dùng từ cơ sở dữ liệu bằng hàm getUserDetail()
    $user = getUserDetail($conn, $username);

    if ($user) {

        // Hiển thị mật khẩu hoặc thực hiện các thao tác khác với thông tin mật khẩu
        echo '<form action="/controller_admin/controller_admin_account.php" method="post">';
        echo '<div class="mb-6">';
        echo '    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mật khẩu mới:</label>';
        echo '    <input type="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="•••••••••" required>';
        echo '</div>';

        echo '<div class="mb-6">';
        echo '    <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Xác nhận lại mật khẩu mới:</label>';
        echo '    <input type="password" name="confirm_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="•••••••••" required>';
        // Trường ẩn để xác định action
        echo '    <input type="hidden" name="action" value="update">';

        // Trường ẩn để lưu user_id của người dùng
        echo '    <input readonly type="hidden" name="user_id" value="' . $user['id'] . '">';
        echo'<br>';
        echo '    <button type="submit" name="update" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Thay đổi mật khẩu</button>';
        echo '</div>';
        echo '</form>';
    } else {
        // Người dùng không tồn tại trong cơ sở dữ liệu, xử lý tương ứng
        echo "Người dùng $username không tồn tại.";
    }
} else {
    // Session username không tồn tại, xử lý tương ứng
    echo "Bạn chưa đăng nhập hoặc session đã hết hạn.";
}

// Đóng kết nối
mysqli_close($conn);
?>

</body>
</html>