<!DOCTYPE html>
<html>
<head>
    <title>Sửa bài báo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <?php
    // Include file controller để sử dụng các hàm xử lý
    include 'C:\Users\dungv\Desktop\DA1\controller_admin\controller_admin_article.php';
    include 'C:\Users\dungv\Desktop\DA1\model\connect.php';

    // Kiểm tra xem có ID bài báo được truyền qua URL hay không
    if (isset($_GET['id'])) {
        $articleId = $_GET['id'];

        // Lấy thông tin chi tiết của bài báo từ bảng "article" với ID tương ứng
        $article = getArticleDetail($conn, $articleId);

        if (!$article) {
            echo "Không tìm thấy bài báo có ID $articleId";
            exit;
        }
    } else {
        echo "Thiếu thông tin ID bài báo";
        exit;
    }
    ?>

    <h1>Sửa bài báo</h1>
    <form method="post" enctype="multipart/form-data">
        <label for="title">ID:</label>
        <input readonly name="articleId" value="<?= $articleId ?>">
        <div>
            <label for="title">Tiêu đề:</label>
            <input type="text" name="title" id="title" value="<?= $article['title'] ?>">
        </div>
        <div>
            <label for="author">Tác giả:</label>
            <input disabled type="text" name="author" id="author" value="<?= $article['author'] ?>">
        </div>
        <div>
            <label for="content">Nội dung:</label>
            <textarea name="content" id="content" rows="6"><?= $article['content'] ?></textarea>
        </div>
        <div>
            <label for="image">Chọn hình ảnh:</label>
            <input type="file" name="image[]" id="image" multiple>
        </div>
        <button type="submit" name="update">Cập nhật</button>
    </form>
</body>
</html>
