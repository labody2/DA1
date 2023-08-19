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
        <label for="Id">Id:
            <input type="number" name="articleId" aria-label="disabled input 2" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?= $articleId ?>" readonly>
        </label>
        <div class="mb-6">
            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Chủ đề:</label>
            <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  name="title" id="title" value="<?= $article['title'] ?>">
        </div>
        <div class="mb-6">
            <label for="video_link" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Link video:</label>
            <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="video_link" id="video_link" value="<?= $article['video_link'] ?>">
        </div>
        <label for="author">Tác giả:
            <input aria-label="disabled input 2" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" readonly type="text" name="author" id="author" value="<?= $article['author'] ?>">
        </label>
        
        <div>
        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nội dung:</label>
        <textarea class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..." name="content" id="content" rows="6"><?= $article['content'] ?></textarea>
        </div>
        
        <div>
        <p>Chọn hình ảnh:</p>
        <div class="flex items-center justify-center w-full">
            <label for="dropzone-file" class="relative flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                <!-- Thêm thẻ <img> vào nhãn -->
                <img id="uploaded-image" src="#" alt="Uploaded Image" class="hidden w-32 h-32 object-cover rounded-md border border-gray-300" />
                <!-- Thêm nội dung nhãn -->
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                    </svg>
                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                </div>
                <input id="dropzone-file" type="file" class="hidden" name="image[]" id="image" multiple/>
            </label>
        </div>
        <script>
            // Xử lý sự kiện thay đổi của trường input loại "file"
            document.getElementById("dropzone-file").addEventListener("change", function() {
                // Lấy tập tin hình ảnh được tải lên
                const file = this.files[0];

                // Kiểm tra xem tập tin có phải là hình ảnh không
                if (file && file.type.includes("image")) {
                    // Đọc dữ liệu hình ảnh
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        // Hiển thị hình ảnh trong nhãn
                        const uploadedImage = document.getElementById("uploaded-image");
                        uploadedImage.src = e.target.result;
                        uploadedImage.classList.remove("hidden");
                    };
                    reader.readAsDataURL(file);
                }
            });
        </script>
        <br>
        <button type="submit" name="update" class="text-purple-700 hover:text-white border border-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-purple-400 dark:text-purple-400 dark:hover:text-white dark:hover:bg-purple-500 dark:focus:ring-purple-900">Cập nhật</button>
    </form>

</body>
</html>
