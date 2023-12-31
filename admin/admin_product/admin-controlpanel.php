<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<?php include 'C:\Users\dungv\Desktop\DA1\model\connect.php';?>
<div id="alert-container" style="display: absolute"></div>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    
    <div class="flex items-center justify-between pb-4">

        <div>
            <!-- Dropdown menu -->
            <a type="button" href="/admin/admin_control.php?link=dashboard-add" class="text-black bg-green-500 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Add</a>
            <div id="dropdownRadio" class="z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="top" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(522.5px, 3847.5px, 0px);">
            </div>
        </div>
        <label for="table-search" class="sr-only">Tìm theo tên</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
            </div>
            <input type="text" id="table-search" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tìm theo tên">
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
                    Address
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'C:\Users\dungv\Desktop\DA1\controller_admin\controller_admin_product.php';
            include 'C:\Users\dungv\Desktop\DA1\model\connect.php';
            //get_products
                $products = getProducts($conn);
                foreach ($products as $product) :
            ?>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 product-row">
                    <td class="w-4 p-4">
                        <div class="flex items-center">
                            <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                        </div>
                    </td>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <?= $product["id"] ?>
                    </th>
                    <th scope="row" class="">
                        <?= $product["name"] ?>
                    </td>
                    <td class="px-6 py-4" >
                        <?= $product["create_time"] ?>
                    </td>
                    <td class="px-6 py-4">
                        <?= $product["categoryId"] ?>
                    </td>
                    <td class="px-6 py-4">
                        <?= $product["price"] ?>tỷ đồng
                    </td>
                    <td class="px-6 py-4">
                        <?= strlen($product["description"]) > 200 ? substr($product["description"], 0, 200) . "..." : $product["description"] ?>
                    </td>

                    <td class="px-6 py-4">
                        <?= $product["address"] ?>
                    </td>
                    <td class="px-6 py-4">
                         <a href="/admin/admin_control.php?link=dashboard-edit&&product_id=<?= $product['id'] ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Sửa</a>
                        <br>
                        <a href="/controller_admin/controller_admin_product.php?id=<?= $product['id'] ?>&action=del" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">Xóa</a>
                    </td>
                </tr>
                <?php endforeach; ?>

        </tbody>
    </table>

</div>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("table-search");
    const productRows = document.querySelectorAll(".product-row");

    searchInput.addEventListener("input", function () {
      const searchTerm = searchInput.value.trim().toLowerCase();

      productRows.forEach(function (row) {
        const productName = row.querySelector(".product-name").textContent.toLowerCase();

        if (productName.includes(searchTerm)) {
          row.style.display = "table-row";
        } else {
          row.style.display = "none";
        }
      });
    });
  });
</script>
</body>
</html>
