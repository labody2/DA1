<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<!-- Your HTML code for the category table -->
<!-- Make sure to include the CSS classes and structure from your original code -->
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <div class="flex items-center justify-between pb-4">
        <a
        class="inline-block rounded border border-indigo-600 px-12 py-3 text-sm font-medium text-indigo-600 hover:bg-indigo-600 hover:text-white focus:outline-none focus:ring active:bg-indigo-500"
        href="/admin/admin_control.php?link=category-add"
        >
        Thêm danh mục
        </a>
    </div>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="p-4">
                    <div class="flex items-center">
                        <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-all-search" class="sr-only">checkbox</label>
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    Id
                </th>
                <th scope="col" class="px-6 py-3">
                    Category name
                </th>
                <th scope="col" class="px-6 py-3">
                    Create time
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'C:\Users\dungv\Desktop\DA1\controller_admin\controller_admin_category.php';
            include 'C:\Users\dungv\Desktop\DA1\model\connect.php';
            $categories = getCategories($conn);
            if (count($categories) > 0) {
                foreach ($categories as $category) {
                    echo "<tr id='category_" . $category["id"] . "' class='bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600'>";
                    echo "<td class='w-4 p-4'>";
                    echo "<div class='flex items-center'>";
                    echo "<input id='checkbox-table-search-1' type='checkbox' class='w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600'>";
                    echo "<label for='checkbox-table-search-1' class='sr-only'>checkbox</label>";
                    echo "</div>";
                    echo "</td>";
                    echo "<td class='px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white'>";
                    echo $category["id"];
                    echo "</td>";
                    echo "<td class='px-6 py-4'>";
                    echo $category["category_name"];
                    echo "</td>";
                    echo "<td class='px-6 py-4'>";
                    echo $category["create_time"];
                    echo "</td>";
                    echo "<td class='px-6 py-4'>";
                    echo "<a href='/admin/admin_control.php?link=category-edit&&id=" . $category["id"] . "' class='text-blue-700 hover:underline'>Edit</a>";
                    echo "<br>";
                    echo '<a href="/admin/admin_control.php?link=category-del&&id=' . $category["id"] . '&action=delete" class="font-medium text-red-600 dark:text-red-500 hover:underline" onclick="return confirm(\'Bạn có chắc chắn muốn xóa danh mục này?\')">Del</a>';

                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr>";
                echo "<td colspan='6'>Không có danh mục nào tồn tại.</td>";
                echo "</tr>";
            }

            // Đóng kết nối
            mysqli_close($conn);
            ?>
        </tbody>
    </table>


