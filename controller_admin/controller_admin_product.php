<?php

include 'C:\Users\dungv\Desktop\DA1\model\connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_GET["action"] == "change_fail") {
        $messageFail = $_POST["message_fail"];
        if (changeStatusProductFail($conn, $_GET["id"],$messageFail)) {
            echo'<script src="https://cdn.tailwindcss.com"></script>
            <div class=" flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert" style="max-width:500px;text-align: center;margin: 10 auto;">
            <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">Thành công!</span> 
            </div>';
            echo '<script>
                setTimeout(function() {
                    window.location.href = \'/admin/admin_control.php?link=dashboard-change\';
                }, 1000);
            </script>';
            exit();
        } else {
            echo '            
            <script src="https://cdn.tailwindcss.com"></script>
            <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert" style="max-width:500px;text-align: center;margin: 10 auto;">
            <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div>
            <span class="font-medium">Thất bại!</span>
            </div>
            </div>
        ';
            echo '<script>
                setTimeout(function() {
                    window.history.back();
                }, 1000);
            </script>';
            exit();
        }
    }
    // Lấy dữ liệu từ biểu mẫu
    if (isset($_POST["product_id"]) && isset($_POST["name"]) && isset($_POST["price"]) && isset($_POST["description"])) {
        $productId = $_POST["product_id"];
        $name = $_POST["name"];
        $price = $_POST["price"];
        $description = $_POST["description"];
    
        // Gọi hàm updateProduct để cập nhật thông tin sản phẩm trong cơ sở dữ liệu
        if (updateProduct($conn, $productId, $name, $price, $description)) {
            echo '
            <script src="https://cdn.tailwindcss.com"></script>
            <div class=" flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert" style="max-width:500px;text-align: center;margin: 10 auto;">
            <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">Thành công!</span> 
            </div>
        ';     
            echo '<script>
                setTimeout(function() {
                    window.location.href = \'/admin/admin_control.php?link=dashboard\';
                }, 1000);
            </script>';
        } else {
            echo '            
            <script src="https://cdn.tailwindcss.com"></script>
            <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert" style="max-width:500px;text-align: center;margin: 10 auto;">
            <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div>
            <span class="font-medium">Thất bại!</span> 
            </div>
            </div>
        ';
            echo '<script>
                setTimeout(function() {
                    window.history.back();
                }, 1000);
            </script>';
        }
        exit();
    }
    $name = $_POST["name"];
    $price = $_POST["price"];
    $description = $_POST["description"];
    // Gọi hàm addProduct để thêm sản phẩm vào cơ sở dữ liệu
    if (addProduct($conn, $name, $price, $description)) {
        header("Location: /admin/admin_control.php?link=dashboard");  
        exit();
    } else {
        echo '            
        <script src="https://cdn.tailwindcss.com"></script>
        <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert" style="max-width:500px;text-align: center;margin: 10 auto;">
        <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span class="sr-only">Info</span>
        <div>
        <span class="font-medium">Thất bại!</span> 
        </div>
        </div>
    ';
        echo '<script>
            setTimeout(function() {
                window.history.back();
            }, 1000);
        </script>';
    }
}
// Xử lý khi có yêu cầu POST để cập nhật sản phẩm


// Xử lý khi có yêu cầu GET để xóa sản phẩm
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    if (isset($_GET["action"]) && $_GET["action"] == "del") {
        if (deleteProduct($conn, $_GET["id"])) {
            $message = "Xóa sản phẩm thành công!";
            echo "<script>alert('$message');</script>";
            echo "<script>window.location.href = '/admin/admin_control.php?link=dashboard';</script>";
            exit();
        } else {
            echo '            
            <script src="https://cdn.tailwindcss.com"></script>
            <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert" style="max-width:500px;text-align: center;margin: 10 auto;">
            <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div>
            <span class="font-medium">Thất bại!</span> 
            </div>
            </div>
        ';
            echo '<script>
                setTimeout(function() {
                    window.history.back();
                }, 1000);
            </script>';
            exit();
        }
    } elseif(isset($_GET["action"]) && $_GET["action"] == "change_success") {
        if (changeStatusProductSuccess($conn, $_GET["id"])) {
            echo'<script src="https://cdn.tailwindcss.com"></script>
            <div class=" flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert" style="max-width:500px;text-align: center;margin: 10 auto;">
            <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">Thành công!</span> 
            </div>';
            echo '<script>
                setTimeout(function() {
                    window.location.href = \'/admin/admin_control.php?link=dashboard-change\';
                }, 1000);
            </script>';
            exit();
        } else {
            echo '            
            <script src="https://cdn.tailwindcss.com"></script>
            <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert" style="max-width:500px;text-align: center;margin: 10 auto;">
            <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div>
            <span class="font-medium">Thất bại!</span>
            </div>
            </div>
        ';
            echo '<script>
                setTimeout(function() {
                    window.history.back();
                }, 1000);
            </script>';
            exit();
        }
    }else{
        getProductById($conn, $productId);
        exit();
    }
} else {
    // Xử lý khi không có yêu cầu GET
    getProducts($conn);
}


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

function getProductsByStatus($conn)
{
    $sql = "SELECT * FROM products where status ='pending' or status='fail'";
    $result = $conn->query($sql);
    $products = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }
    return $products;
}
function changeStatusProductSuccess($conn, $productId)
{
    $sql = "UPDATE products SET status = 'success' WHERE id = $productId";
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}
function changeStatusProductFail($conn, $productId,$messageFail)
{
    $sql = "UPDATE products SET status = 'fail', message_decline = '$messageFail' WHERE id = $productId";
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}
//getbyid
function getProductById($conn, $productId)
{
    $sql = "SELECT * FROM products WHERE id = $productId";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        return $result->fetch_assoc();
        header("Location: /admin/admin_control.php?link=dashboard");     
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
            echo '            
            <script src="https://cdn.tailwindcss.com"></script>
            <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert" style="max-width:500px;text-align: center;margin: 10 auto;">
            <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div>
            <span class="font-medium">Thất bại!</span> Tài khoản đã tồn tại
            </div>
            </div>
        ';
            echo '<script>
                setTimeout(function() {
                    window.history.back();
                }, 1000);
            </script>';
            return false;
        }
    } else {
        echo '            
        <script src="https://cdn.tailwindcss.com"></script>
        <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert" style="max-width:500px;text-align: center;margin: 10 auto;">
        <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span class="sr-only">Info</span>
        <div>
        <span class="font-medium">Thất bại!</span> Tài khoản đã tồn tại
        </div>
        </div>
    ';
        echo '<script>
            setTimeout(function() {
                window.history.back();
            }, 1000);
        </script>';
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