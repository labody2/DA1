<?php
// Kết nối cơ sở dữ liệu và thực hiện câu truy vấn
include 'C:\Users\dungv\Documents\Dự án 1\DA1\api\connect.php';

// Kiểm tra thông tin session
session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Truy vấn để lấy vai trò từ username
    $sql = "SELECT role FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $role = $row['role'];

        if ($role === 'admin') {
            // Người dùng có vai trò "admin", cho phép truy cập vào file "admin.php"
        } else {
            // Người dùng không có quyền truy cập, hiển thị thông báo hoặc chuyển hướng đến trang khác
            echo "Bạn không có quyền truy cập vào trang này.";
            // Hoặc:
            // header("Location: ../signin_signup/signin.php");
            exit();
        }
    } else {
        // Không tìm thấy thông tin người dùng, xử lý tương ứng
        echo "Bạn không có quyền truy cập vào trang này.";
        echo"2";
            exit();
    }
} else {
    echo "Bạn không có quyền truy cập vào trang này.";
    echo"1";
    exit();
    // Người dùng chưa đăng nhập, xử lý tương ứng
}

// Đóng kết nối
mysqli_close($conn);
?>
?php include 'C:\Users\dungv\Documents\Dự án 1\DA1\api\connect.php';?>
<?php
// process.php

// add_product
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ biểu mẫu
    $name = $_POST["name"];
    $price = $_POST["price"];
    $description = $_POST["description"];
    $create_time = date("Y-m-d H:i:s");
    $sql = "INSERT INTO products (name, price, description, create_time) VALUES ('$name', $price, '$description', '$create_time')";    

    if ($conn->query($sql) === TRUE) {
        echo "Product added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
// Đóng kết nối
mysqli_close($conn);
?>




