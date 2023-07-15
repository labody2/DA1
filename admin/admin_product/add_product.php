<?php
include 'C:\Users\dungv\Desktop\DA1\admin\checkpermission.php';
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




