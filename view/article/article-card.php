<!DOCTYPE html>
<html>
<head>
    <title>Danh sách bài báo</title>
    <link rel="stylesheet" href="https://cdn.tailwindcss.com/2.2.7/tailwind.min.css">
</head>
<body>
    <h1 class="text-3xl font-bold mb-5">Danh sách bài báo</h1>
    <a type="button" href="admin_article/admin_article_add.html" class="text-green-700 bg-green-300 hover:bg-green-400 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-5">Tạo bài báo mới</a>

    <div class="grid grid-cols-3 gap-4">
        <?php
        // Kết nối đến cơ sở dữ liệu
        include 'C:\Users\dungv\Desktop\DA1\model\connect.php';

        // Truy vấn dữ liệu từ bảng "article"
        $sql = "SELECT * FROM article";
        $result = $conn->query($sql);

        // Kiểm tra và hiển thị dữ liệu trên "card"
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="border border-gray-300 rounded p-4">';
                echo '<h2 class="text-xl font-bold mb-2">' . $row['title'] . '</h2>';
                echo '<p class="text-gray-500">' . $row['author'] . '</p>';
                echo '<p class="mt-4">' . $row['content'] . '</p>';
                // Xử lý hình ảnh
                $imageString = $row['images'];
                $imagePaths = explode(",", $imageString);
                foreach ($imagePaths as $imagePath) {
                    echo '<img src="' . $imagePath . '" alt="Image" width="200" class="mt-4">';
                }
                echo '</div>';
            }
        } else {
            echo '<p class="text-red-500">Không có bài báo nào.</p>';
        }

        // Đóng kết nối
        mysqli_close($conn);
        ?>
    </div>

</body>
</html>
