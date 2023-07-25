<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Category</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <h1>Cập nhật danh mục</h1>
    <br>
    <div class="container" style="display: flex;justify-content: center;align-items: center;height: 50vh;">
        <?php
        include 'C:\Users\dungv\Desktop\DA1\controller_admin\controller_admin_category.php';
        include 'C:\Users\dungv\Desktop\DA1\model\connect.php';
        $categoryId = $_GET["id"];
        $category = getCategoryDetail($conn, $categoryId);
        if ($category) {
            echo '<form action="/controller_admin/controller_admin_category.php" method="POST" style="width: 500px;" >';
            echo '<input type="hidden" readonly name="category_id" value="' . $category["id"] . '">';
            echo '<div class="relative z-0 w-full mb-6 group">';
            echo '<input type="text" name="categoryName" id="categoryName" value="' . $category["category_name"] . '" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" required />';
            echo '<label for="categoryName" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Tên danh mục</label>';
            echo '</div>';
            echo '<button type="submit" name="update" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" value="Update Danh mục">Cập nhật</button>';
            echo '</form>';
        } else {
            echo "Không tìm thấy danh mục có ID $categoryId";
        }

        // Đóng kết nối
        mysqli_close($conn);
        ?>
    </div>
</body>
</html>
