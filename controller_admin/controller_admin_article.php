<?php
require_once 'C:\Users\dungv\Desktop\DA1\admin\start_session.php';
include 'C:\Users\dungv\Desktop\DA1\model\connect.php';
//admin-article
function getArticles($conn)
{
    $sql = "SELECT * FROM article";
    $result = $conn->query($sql);
    $articles = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $articles[] = $row;
        }
    }
    return $articles;
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    // Lấy ID của bài báo cần xóa
    $articleId = $_GET["id"];

    if (isset($_GET["action"])) {
        $action = $_GET["action"];

        // Kiểm tra hành động là "update"
        if ($action === "delete") {
            deleteArticle($conn, $articleId);
        }
    }
}

// Hàm xóa bài báo dựa vào ID
function deleteArticle($conn, $articleId)
{
    $sql = "DELETE FROM article WHERE id = $articleId";
    if (mysqli_query($conn, $sql) === TRUE) {
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
        echo "<script>window.location.href = '/admin/admin_control.php?link=article';</script>";
    } else {
        echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
    }
}

//thêm article
function processForm($conn, $title, $video_link, $content, $imageFiles)
{
    // Khởi tạo mảng để lưu trữ đường dẫn hình ảnh
    $imagePaths = array();

    // Xử lý upload hình ảnh
    if (isset($imageFiles) && !empty($imageFiles['tmp_name'][0])) {
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");
        $uploadDirectory = "C:/Users/dungv/Desktop/DA1/admin/admin_article/img_article/img";
    
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
                        $imagePaths[] = "/admin/admin_article/img_article/". 'img'.$newFileName;
                    } else {
                        echo "Lỗi: Không thể di chuyển tệp hình ảnh.";
                        echo '<script>
                        window.history.back();
                    </script>';
                    }
                } else {
                    echo "Lỗi: Phần mở rộng tệp không được phép.";
                    echo '<script>
                    window.history.back();
                </script>';
                }
            } else {
                echo "Lỗi: Không thể tải lên hình ảnh.";
                echo '<script>
                window.history.back();
            </script>';
            }
        }
    
        // Kiểm tra xem đã có hình ảnh được tải lên hay chưa
        if (!empty($imagePaths)) {
            // Chuyển mảng thành chuỗi bằng cách nối các đường dẫn với dấu phẩy (,).
            $imageText = implode(",", $imagePaths);
            $currentTime = date("Y-m-d H:i:s");
            $author=$_SESSION["username"];
            // Thực hiện truy vấn SQL để chèn dữ liệu mới vào bảng articles
            $sql = "INSERT INTO article (title, author, video_link, content, images, create_time) VALUES ('$title', '$author','$video_link', '$content', '$imageText', '$currentTime')";
            if ($conn->query($sql) === TRUE) {
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
             echo "<script>window.location.href = '/admin/admin_control.php?link=article';</script>";
                        exit;
            } else {
                echo "Lỗi: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Lỗi: Không có hình ảnh nào được tải lên.";
            echo '<script>
            window.history.back();
        </script>';
        }
    } else {
        echo "Lỗi: Không có hình ảnh nào được tải lên.";
        echo '<script>
        window.history.back();
    </script>';
    }
}

// Sử dụng hàm processForm()
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $video_link=$_POST["video_link"];
    $imageFiles = $_FILES['image'];

    if (isset($_POST["update"])) {
        $articleId=$_POST["articleId"];
        // Thực hiện hành động sửa bài báo
        updateArticle($conn, $articleId,$video_link, $title, $content, $imageFiles);
        
    } elseif (isset($_POST["add"])) {
        processForm($conn, $title,$video_link, $content, $imageFiles);
    }
   
}
//update article
// Hàm lấy thông tin chi tiết của bài báo dựa vào ID
function getArticleDetail($conn, $articleId)
{
    $sql = "SELECT * FROM article WHERE id = $articleId";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $article = mysqli_fetch_assoc($result);
        return $article;
    } else {
        return null;
    }
}
// Hàm cập nhật bài báo dựa vào ID
function updateArticle($conn, $articleId,$video_link, $title, $content, $imageFiles)
{
    $article = getArticleDetail($conn, $articleId);
    $currentTime = date("Y-m-d H:i:s");
    $author=$_SESSION["username"];
    if ($article) {
        // Khởi tạo mảng để lưu trữ đường dẫn hình ảnh
        $imagePaths = array();

        // Xử lý upload hình ảnh
        if (isset($imageFiles) && !empty($imageFiles['tmp_name'][0])) {
            $allowedExtensions = array("jpg", "jpeg", "png", "gif");
            $uploadDirectory = "C:/Users/dungv/Desktop/DA1/admin/admin_article/img_article/img";
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
                            $imagePaths[] = "/admin/admin_article/img_article/" . 'img' . $newFileName;
                        } else {
                            echo "Lỗi: Không thể di chuyển tệp hình ảnh.";
                            echo '<script>
                            window.history.back();
                        </script>';
                        }
                    } else {
                        echo "Lỗi: Phần mở rộng tệp không được phép.";
                        echo '<script>
                        window.history.back();
                    </script>';
                    }
                } else {
                    echo "Lỗi: Không thể tải lên hình ảnh.";
                    echo '<script>
                    window.history.back();
                </script>';
                }
            }

            // Kiểm tra xem đã có hình ảnh được tải lên hay chưa
            if (!empty($imagePaths)) {
                // Chuyển mảng thành chuỗi bằng cách nối các đường dẫn với dấu phẩy (,).
                $imageText = implode(",", $imagePaths);
                // Cập nhật thông tin của bài báo trong cơ sở dữ liệu
                $sql = "UPDATE article SET create_time='$currentTime', title = '$title', author = '$author', content = '$content', images = '$imageText',video_link='$video_link' WHERE id = $articleId";

                if ($conn->query($sql) === TRUE) {
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
                    echo "<script>window.location.href = '/admin/admin_control.php?link=article';</script>";
                } else {
                    echo "Lỗi: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Lỗi: Không có hình ảnh nào được tải lên.";
                echo '<script>
                        window.history.back();
                    </script>';
            }
        } else {
            // Nếu không có hình ảnh mới được tải lên, chỉ cập nhật các trường thông tin khác
            $sql = "UPDATE article SET create_time='$currentTime' , title = '$title', author = '$author', content = '$content',video_link='$video_link' WHERE id = $articleId";

            if ($conn->query($sql) === TRUE) {
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
                echo "<script>window.location.href = '/admin/admin_control.php?link=article';</script>";
            } else {
                echo "Lỗi: " . $sql . "<br>" . $conn->error;
            }
        }
    } else {
        echo "Không tìm thấy bài báo có ID $articleId";
    }
}






// Đóng kết nối
mysqli_close($conn);
?>