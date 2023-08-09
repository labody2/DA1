<?php
include 'C:\Users\dungv\Desktop\DA1\model\connect.php';
function getProducts($conn)
{
    $sql = "SELECT * FROM products where  status = 'success'";
    $result = $conn->query($sql);
    $products = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }
    return $products;
}

function getUserByAccountId_post($conn, $id)
{
    $sql = "SELECT * FROM users WHERE id = '$id'";
    $result = $conn->query($sql);
    $user = array(); 

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $user[] = $row;
        }
        return $user;
    } else {
        return null;
    }
}
function getProductDetail($conn,$id)
{
    $sql = "SELECT * FROM products where  id = '$id'";
    $result = $conn->query($sql);
    $products = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }
    return $products;
}

if (isset($_GET["id"])) {
    $productId = $_GET["id"];
    if (isset($_GET["action"]) && $_GET["action"] == "del") {
        if (deleteProduct($conn, $productId)) {
            $message = "Xóa sản phẩm thành công!";
            echo "<script>alert('$message');</script>";
            // echo "<script>window.location.href = '';</script>";
            exit();
        } else {
            echo "Lỗi: Không thể xóa sản phẩm!";
            exit();
        }
    }
}
function deleteProduct($conn, $productId)
{
    // Kiểm tra xem productId có phải là một số nguyên hợp lệ hay không
    if (is_numeric($productId)) {
        // Xóa sản phẩm từ cơ sở dữ liệu
        $sql = "DELETE FROM products WHERE id = $productId";
        if (mysqli_query($conn, $sql)) {
            return true;
        } else {
            echo"false";
            return false;
        }
    } else {
        echo"false";
        return false;
    }
}
function getCategoryNameById($conn, $id)
{
    $sql = "SELECT id FROM products WHERE categoryId = '$id'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        return $row['id'];
    } else {
        return null;
    }
}

function getStatusProduct($conn, $id)
{
    $sql = "SELECT status FROM products WHERE categoryId = '$id'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        return $row['status'];
    } else {
        return null;
    }
}


function getProductIdByUsername_id($conn, $id)
{
    $sql = "SELECT id FROM products WHERE accountId_post = '$id'";
    $result = $conn->query($sql);
    $productIds = array(); // Mảng lưu trữ các ID sản phẩm

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $productIds[] = $row['id']; // Thêm ID sản phẩm vào mảng
        }
        return $productIds;
    } else {
        return null;
    }
}

function getProductbyProductId($conn, $ids)
{
    $idList = implode(',', $ids);

    $sql = "SELECT * FROM products WHERE id IN ($idList)";
    $result = $conn->query($sql);

    $products = array();

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }

    return $products;
}

function getProductbyCategoryId($conn, $categoryId)
{
    $sql = "SELECT * FROM products WHERE categoryId = '$categoryId'";
    $result = $conn->query($sql);

    $products = array();

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }

    return $products;
}
function addContact($conn, $name, $email, $phone, $message,$productId)
{
    $create_time = date("Y-m-d H:i:s");
    $sql = "INSERT INTO contact (name, email, phone, create_time,message,product_id) VALUES ('$name', '$email', $phone, '$create_time','$message',$productId)";
    
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        echo "Lỗi SQL: " . $sql . "<br>" . $conn->error;
        return false;
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["yourname"])&&isset($_POST["youremail"])&&isset($_POST["yourphone"])&&isset($_POST["yourmessage"])&&isset($_POST["product_id"])) {
        $name=$_POST["yourname"];
        $email=$_POST["youremail"];
        $phone=$_POST["yourphone"];
        $message=$_POST["yourmessage"];
        $productId=$_POST["product_id"];
        if (addContact($conn, $name, $email, $phone, $message,$productId)) {
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
                window.history.back();
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
    $address=$_POST["address"];
    $productName = $_POST["productName"];
    $price = $_POST["price"];
    $description = $_POST["description"];
    $categoryId = $_POST["categoryId"];
    $imageFiles = $_FILES['image'];
    $bed_room = $_POST["bed_room"];
    $other_room = $_POST["other_room"];
    $bathroom = $_POST["bathroom"];
    $square = $_POST["square"];
    include 'C:\Users\dungv\Desktop\DA1\admin\start_session.php';
    $account_name= $_SESSION["username"];
    include 'C:\Users\dungv\Desktop\DA1\controller\controller_account.php';
    $accountId_post=getIdByUsername($conn, $account_name);
    addProduct($conn,$address,$productName, $price, $description, $categoryId, $imageFiles, $other_room, $bathroom, $square, $accountId_post,$bed_room);
    
}
function addProduct($conn,$address, $productName, $price, $description, $categoryId, $imageFiles, $other_room, $bathroom, $square, $accountId_post,$bed_room)
{
    $imagePaths = array();

    // Xử lý upload hình ảnh
    if (isset($imageFiles) && !empty($imageFiles['tmp_name'][0])) {
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");
        $uploadDirectory = "C:/Users/dungv/Desktop/DA1/view/img/product/";
    
        if (!is_dir($uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true); // Tạo thư mục nếu chưa tồn tại
        }
    
        // Xử lý từng file được chọn
        foreach ($imageFiles['tmp_name'] as $key => $tmpName) {
            // Kiểm tra xem có hình ảnh được upload thành công hay không
            if (is_uploaded_file($tmpName)) {
                $fileName = $imageFiles['name'][$key];
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
                if (in_array($fileExtension, $allowedExtensions)) {
                    $newFileName = uniqid('image_') . '.' . $fileExtension;
                    $destination = $uploadDirectory . $newFileName;
                    if (move_uploaded_file($tmpName, $destination)) {
                        $imagePaths[] = "/view/img/product/".$newFileName;
                    } else {
                        echo "Lỗi: Không thể di chuyển tệp hình ảnh.";
                    }
                } else {
                    echo "Lỗi: Phần mở rộng tệp không được phép.";
                }
            } else {
                echo "Lỗi: Không thể tải lên hình ảnh.";
            }
        }
    
        // Kiểm tra xem đã có hình ảnh được tải lên hay chưa
        if (!empty($imagePaths)) {
            $imageText = implode(",", $imagePaths);
            $currentTime = date("Y-m-d H:i:s");
            $safeAddress = $conn->real_escape_string($address);
            $safeProductName = $conn->real_escape_string($productName);
            $safePrice = (float)$price;
            $safeDescription = $conn->real_escape_string($description);
            $safeCategoryId = (int)$categoryId;
            $safeOtherRoom = (int)$other_room;
            $safeBathroom = (int)$bathroom;
            $safeBedroom = (int)$bed_room;
            $safeSquare = (float)$square;
            $safeAccountIdPost = $conn->real_escape_string($accountId_post);

            $sql = "INSERT INTO products (address,name, price, description, categoryId, img1, other_room, bathroom, square, accountId_post,create_time,bed_room)
                VALUES ('$safeAddress','$safeProductName', $safePrice, '$safeDescription', $safeCategoryId, '" . $imageText . "', $safeOtherRoom, $safeBathroom, $safeSquare, '$safeAccountIdPost','$currentTime',$safeBedroom)";

            // Thực thi câu truy vấn
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert ('Đăng bất động sản thành công');</script>";
                echo "<script>window.location.href = '../view/page/index.php?link=trang_chu';</script>";
                return true; // Thêm sản phẩm thành công
            } else {
                // echo "<script>alert ('Có lỗi xảy ra');</script>";
                // echo "<script>window.location.href = '../view/page/index.php?link=trang_chu';</script>";
                echo "Lỗi: " . mysqli_error($conn);
                
                return false; // Lỗi khi thêm sản phẩm
            }
        } else {
            echo "<script>alert ('Không có hình ảnh được tải lên, bạn vui lòng tải ảnh lên');</script>"; 
        }
    } else {
         echo "<script>alert ('Không có hình ảnh được tải lên, bạn vui lòng tải ảnh lên');</script>";
    }
   
}

?>