<?php
include 'C:\Users\dungv\Desktop\DA1\model\connect.php';
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
} else {
    // Xử lý khi không có yêu cầu GET
    exit();
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
        echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
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
    addProduct($conn, $productName, $price, $description, $categoryId, $imageFiles, $other_room, $bathroom, $square, $accountId_post,$bed_room);
    
}
function addProduct($conn, $productName, $price, $description, $categoryId, $imageFiles, $other_room, $bathroom, $square, $accountId_post,$bed_room)
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
            $safeProductName = $conn->real_escape_string($productName);
            $safePrice = (float)$price;
            $safeDescription = $conn->real_escape_string($description);
            $safeCategoryId = (int)$categoryId;
            $safeOtherRoom = (int)$other_room;
            $safeBathroom = (int)$bathroom;
            $safeBedroom = (int)$bed_room;
            $safeSquare = (float)$square;
            $safeAccountIdPost = $conn->real_escape_string($accountId_post);

            $sql = "INSERT INTO products (name, price, description, categoryId, img1, other_room, bathroom, square, accountId_post,create_time,bed_room)
                VALUES ('$safeProductName', $safePrice, '$safeDescription', $safeCategoryId, '" . $imageText . "', $safeOtherRoom, $safeBathroom, $safeSquare, '$safeAccountIdPost','$currentTime',$safeBedroom)";

            // Thực thi câu truy vấn
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert ('Đăng bất động sản thành công');</script>";
                echo "<script>window.location.href = '../view/page/index.php?link=trang_chu';</script>";
                return true; // Thêm sản phẩm thành công
            } else {
                echo "<script>alert ('Có lỗi xảy ra');</script>";
                echo "<script>window.location.href = '../view/page/index.php?link=trang_chu';</script>";
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