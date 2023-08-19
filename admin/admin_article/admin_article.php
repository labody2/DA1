<!DOCTYPE html>
<html>

<head>
    <title>Danh sách bài báo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <h1>Danh sách bài báo</h1>
    <a type="button" href="/admin/admin_control.php?link=article-add" class="text-green bg-green-500 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Tạo bài báo mới</a>
    <table class="table-auto">
        <thead>
            <tr>
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Thời gian tạo:</th>
                <th class="px-4 py-2">Tiêu đề</th>
                <th class="px-4 py-2">Tác giả</th>
                <th class="px-4 py-2">Nội dung</th>
                <th class="px-4 py-2">Link video</th>
                <th class="px-4 py-2">Hình ảnh</th>
                <th class="px-4 py-2" colspan="2">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Include file controller để sử dụng các hàm xử lý
            include 'C:\Users\dungv\Desktop\DA1\controller_admin\controller_admin_article.php';
            include 'C:\Users\dungv\Desktop\DA1\model\connect.php';
            // Lấy danh sách các bài báo từ cơ sở dữ liệu
            $articles = getArticles($conn);

            foreach ($articles as $article) :
            ?>
                <tr>
                    <td class="border px-4 py-2"><?= $article['id'] ?></td>
                    <td class="border px-4 py-2"><?= $article['create_time'] ?></td>
                    <td class="border px-4 py-2"><?= $article['title'] ?></td>
                    <td class="border px-4 py-2"><?= $article['author'] ?></td>
                    <td class="border px-4 py-2"><?= $article['content'] ?></td>
                    <td class="border px-4 py-2"><?= $article['video_link'] ?></td>
                    <td class="border px-4 py-2">
                        <?php
                        $imageString = $article['images'];
                        // Tách các đường dẫn ảnh thành mảng
                        $imagePaths = explode(",", $imageString);
                        // Hiển thị các ảnh trong trang web
                        foreach ($imagePaths as $imagePath) {
                            echo '<img src="' . $imagePath . '" alt="Image" width="200">';
                        }
                        ?>
                    </td>
                 
                    <td class="border px-4 py-5">
                        <a href="/admin/admin_control.php?link=article-edit&&id=<?= $article['id'] ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Sửa</a>
                    </td>
                    <td class="border px-4 py-5">
                        <a href="/admin/admin_control.php?link=article-del&&id=<?= $article['id'] ?>&action=delete" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Bạn có chắc chắn muốn xóa bài báo này?')">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>
