<?php
// Kết nối đến cơ sở dữ liệu
include 'C:\Users\dungv\Desktop\DA1\model\connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $category_name = $_POST["category_name"];

    // Thêm dữ liệu vào cơ sở dữ liệu
    $sql = "INSERT INTO categories (category_name) VALUES ('$category_name')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Category added successfully!";
        header("Location: ../admin-layout.php");
        exit(); 
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Đóng kết nối
mysqli_close($conn);
?>
