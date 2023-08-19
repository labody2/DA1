<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<?php 
include 'C:\Users\dungv\Desktop\DA1\model\connect.php';?>
<div id="alert-container" style="display: absolute"></div>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    
    <div class="flex items-center justify-between pb-4">

        <div>
            <div id="dropdownRadio" class="z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="top" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(522.5px, 3847.5px, 0px);">
            </div>
        </div>
        <div class="relative mt-4">
            <select id="table-filter-status" class="block p-2 pl-3 pr-8 text-sm text-gray-900 border border-gray-300 rounded-lg w-48 bg-white focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="">All</option>
                <option value="khả dụng">Active</option>
                <option value="vô hiệu">Inactive</option>
            </select>
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
                    Product name
                </th>
                <th scope="col" class="px-6 py-3">
                    Creat-time
                </th>
                <th scope="col" class="px-6 py-3">
                    Category
                </th>
                <th scope="col" class="px-6 py-3">
                    Price
                </th>
                <th scope="col" class="px-6 py-3">
                    Description
                </th>
                <th scope="col" class="px-6 py-3">
                    Trạng thái
                </th>
                <th scope="col" class="px-6 py-3">
                    Lí do từ chối
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
                <th scope="col" class="px-6 py-3"></th>
                <th scope="col" class="px-6 py-3"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'C:\Users\dungv\Desktop\DA1\controller_admin\controller_admin_product.php';
            include 'C:\Users\dungv\Desktop\DA1\model\connect.php';
            //get_products
                $products = getProductsByStatus($conn);?>
                <?php foreach ($products as $product) : ?>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="w-4 p-4">
                            <div class="flex items-center">
                                <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                            </div>
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <?= $product["id"] ?>
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <?= $product["name"] ?>
                        </td>
                        <td class="px-6 py-4">
                            <?= $product["create_time"] ?>
                        </td>
                        <td class="px-6 py-4">
                            <?= $product["categoryId"] ?>
                        </td>
                        <td class="px-6 py-4">
                            <?= $product["price"] ?>đ
                        </td>
                        <td class="px-6 py-4">
                            <?= strlen($product["description"]) > 200 ? substr($product["description"], 0, 200) . "..." : $product["description"] ?>
                        </td>
                        <td class="px-6 py-4" style="color: <?= ($product["status"] === 'fail') ? 'red' : 'green' ?>">
                            <?= $product["status"] ?>
                        </td>
                        <td class="px-6 py-4" style="color: <?= ($product["status"] === 'fail') ? 'red' : 'green' ?>">
                            <?= $product["message_decline"] ?>
                        </td>
                        <td class="px-6 py-4">
                            <a href="/admin/admin_control.php?link=dashboard-edit&&product_id=<?= $product['id'] ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Chi tiết</a>
                            <br>
                        </td>
                        <td>
                        <a href="/admin/admin_control.php?link=dashboard-change&&id=<?= $product['id'] ?>&action=change_success"><button type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Chấp nhận</button></a>
                        </td>
                        <td>
                            <?php if ($product["status"] === 'pending') : ?>
                                <button type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 cancel-button cancel-button">Hủy</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php if ($product["status"] === 'pending') : ?>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 cancel-form hidden">
                           <form action="/admin/admin_control.php?link=dashboard-change&&id=<?= $product['id'] ?>&action=change_fail" method="post">
                           <td colspan="11" class="py-4">
                                <label for="Lí do" class="block font-medium text-gray-900 dark:text-white">Lí do</label>
                                <input type="text" id="Lí do" class="w-full px-4 py-2 rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:focus:border-blue-500 dark:focus:ring-blue-500 dark:text-white" placeholder="Nhập lí do" name="message_fail">
                            </td>
                            <td><button type="submit" style="margin:20 0 0 0" class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Gửi</button></td>
                           </form>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
                    <script>
                            const cancelButtons = document.querySelectorAll('.cancel-button');
                            const cancelForms = document.querySelectorAll('.cancel-form');

                            cancelButtons.forEach((cancelButton, index) => {
                                cancelButton.addEventListener('click', () => {
                                    // Ẩn tất cả các form khác
                                    cancelForms.forEach((form) => {
                                        form.classList.add('hidden');
                                    });

                                    // Hiển thị form tương ứng với nút "Hủy" được nhấn
                                    cancelForms[index].classList.remove('hidden');
                                });
                            });
                            </script>
        </tbody>
    </table>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const searchInputUsers = document.getElementById("table-search-users");
            const filterStatus = document.getElementById("table-filter-status");
            const userRows = document.querySelectorAll(".user-row");
            searchInputUsers.addEventListener("input", updateFilter);
            filterStatus.addEventListener("change", updateFilter);

            function updateFilter() {
                const searchTerm = searchInputUsers.value.trim().toLowerCase();
                const statusFilter = filterStatus.value;
                userRows.forEach(function (row) {
                    const userName = row.querySelector(".user-name").textContent.toLowerCase();
                    const status = row.querySelector(".user-status").textContent.trim().toLowerCase();
                    const showByName = searchTerm === "" || userName.includes(searchTerm);
                    const showByStatus = statusFilter === "" || statusFilter === status;
                    console.log(showByStatus);
                    if (showByName && showByStatus) {
                        row.style.display = "table-row";
                    } else {
                        row.style.display = "none";
                    }
                });
            }
        });
    </script>
</div>

</body>
</html>
