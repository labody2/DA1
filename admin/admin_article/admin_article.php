<!DOCTYPE html>
<html>
<head>
    <title>Trang bài báo</title>
</head>
<body>
    
    <?php

    // Kết nối cơ sở dữ liệu và thực hiện câu truy vấn
    include 'C:\Users\dungv\Desktop\DA1\model\connect.php';
    $sql = "SELECT * FROM article";
    $result = mysqli_query($conn, $sql);
    // Kiểm tra kết quả truy vấn
    if (mysqli_num_rows($result) > 0) {
        // Hiển thị danh sách bài báo
        while ($row = mysqli_fetch_assoc($result)) {
            $title = $row['title'];
            $content = $row['content'];
            $image = 'images/' . $row['image']; // Đường dẫn tới thư mục images

            echo '<h2>' . $title . '</h2>';
            echo '<p>' . $content . '</p>';
            echo '<img src="' . $image . '" alt="Hình ảnh">';
        }
    } else {
        echo 'Không có bài báo nào.';
    }

    // Đóng kết nối
    mysqli_close($conn);
    ?>
</body>
</html>
