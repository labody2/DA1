<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<?php 
include 'C:\Users\dungv\Desktop\DA1\admin\checkpermission.php';
?>

<div id="editForm" class="inset-0 bg-white dark:bg-gray-700 z-50" style="display: none">
    <form id="categoryForm" action="admin-categories-update.php" method="POST">
        <input type="hidden" name="category_id" id="category_id">
        <label for="category_name">Category Name:</label>
        <input type="text" name="category_name" id="category_name">
        <button type="submit">Save</button>
    </form>
</div>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <div class="flex items-center justify-between pb-4">
        <div>
            <button id="dropdownRadioButton" data-dropdown-toggle="dropdownRadio" class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" type="button">
                <svg class="w-3 h-3 text-gray-500 dark:text-gray-400 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z"/>
                    </svg>
                Last 30 days
                <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                </svg>
            </button>
            <a type="button" href="admin_category/admin-add-category.html" class="text-black bg-green-500 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Add</a>
        </div>
        <label for="table-search" class="sr-only">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
            </div>
            <input type="text" id="table-search" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
        </div>
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
            include 'C:\Users\dungv\Desktop\DA1\model\connect.php';
            $sql = "SELECT * FROM categories";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                die("Lỗi truy vấn SQL: " . mysqli_error($conn));
            }
            if (mysqli_num_rows($result) > 0) {
                // Duyệt qua từng hàng kết quả
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr id='category_" . $row["id"] . "' class='bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600'>";
                    echo "<td class='w-4 p-4'>";
                    echo "<div class='flex items-center'>";
                    echo "<input id='checkbox-table-search-1' type='checkbox' class='w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600'>";
                    echo "<label for='checkbox-table-search-1' class='sr-only'>checkbox</label>";
                    echo "</div>";
                    echo "</td>";
                    echo "<td class='px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white'>";
                    echo $row["id"];
                    echo "</td>";
                    echo "<td class='px-6 py-4'>";
                    echo $row["category_name"];
                    echo "</td>";
                    echo "<td class='px-6 py-4'>";
                    echo $row["create_time"];
                    echo "</td>";
                    echo "<td class='px-6 py-4'>";
                    echo "<a href='#' class='font-medium text-blue-600 dark:text-blue-500 hover:underline' onclick='showEditForm(" . $row["id"] . ")'>Edit</a>";
                    echo "<br>";
                    echo "<a href='#' class='font-medium text-red-600 dark:text-red-500 hover:underline' onclick='confirmDelete(" . $row["id"] . ")'>Del</a>";
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

    <script>
    </script>

</div>

</body>
</html>
