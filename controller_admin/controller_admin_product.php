<?php
include 'C:\Users\dungv\Desktop\DA1\admin\checkpermission.php';
include 'C:\Users\dungv\Desktop\DA1\model\connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ biểu mẫu
    if (isset($_POST["product_id"]) && isset($_POST["name"]) && isset($_POST["price"]) && isset($_POST["description"])) {
        $productId = $_POST["product_id"];
        $name = $_POST["name"];
        $price = $_POST["price"];
        $description = $_POST["description"];
    
        // Gọi hàm updateProduct để cập nhật thông tin sản phẩm trong cơ sở dữ liệu
        if (updateProduct($conn, $productId, $name, $price, $description)) {
            echo "Thông tin sản phẩm đã được cập nhật thành công!";
            header("Location: /admin/admin-layout.php");
        } else {
            echo "Lỗi: Không thể cập nhật thông tin sản phẩm!";
            header("Location: /admin/admin-layout.php");
        }
        exit();
    }
    $name = $_POST["name"];
    $price = $_POST["price"];
    $description = $_POST["description"];
    // Gọi hàm addProduct để thêm sản phẩm vào cơ sở dữ liệu
    if (addProduct($conn, $name, $price, $description)) {
        header("Location: /admin/admin-layout.php");
        exit();
    } else {
        echo "Error: Unable to add product!";
    }
}
// Xử lý khi có yêu cầu POST để cập nhật sản phẩm


// Xử lý khi có yêu cầu GET để xóa sản phẩm
if (isset($_GET["id"])) {
    $productId = $_GET["id"];
    if (isset($_GET["action"]) && $_GET["action"] == "del") {
        if (deleteProduct($conn, $productId)) {
            $message = "Xóa sản phẩm thành công!";
            echo "<script>alert('$message');</script>";
            header("Location: /admin/admin-layout.php");
            exit();
        } else {
            echo "Lỗi: Không thể xóa sản phẩm!";
            exit();
        }
    } else {
        getProductById($conn, $productId);
        exit();
    }
} else {
    // Xử lý khi không có yêu cầu GET
    getProducts($conn);
}



//admin-article
function getProducts($conn)
{
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);
    $products = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }
    return $products;
}
//getbyid
function getProductById($conn, $productId)
{
    $sql = "SELECT * FROM products WHERE id = $productId";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        return $result->fetch_assoc();
        header("Location: /admin/admin-layout.php");    
    } else {
        return null;
    }
}
//del
function deleteProduct($conn, $productId)
{
    // Kiểm tra xem productId có phải là một số nguyên hợp lệ hay không
    if (is_numeric($productId)) {
        // Xóa sản phẩm từ cơ sở dữ liệu
        $sql = "DELETE FROM products WHERE id = $productId";
        if (mysqli_query($conn, $sql)) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function addProduct($conn, $name, $price, $description)
{
    $create_time = date("Y-m-d H:i:s");
    $sql = "INSERT INTO products (name, price, description, create_time) VALUES ('$name', $price, '$description', '$create_time')";
    
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}


//edit
function updateProduct($conn, $productId, $name, $price, $description)
{
    // Cập nhật thông tin sản phẩm trong cơ sở dữ liệu
    $sql = "UPDATE products SET name = '$name', price = '$price', description = '$description' WHERE id = $productId";
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}


// Đóng kết nối
mysqli_close($conn);
?>