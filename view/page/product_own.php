<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BĐS của tôi</title>
    <link rel="stylesheet" href="https://cdn.tailwindcss.com/2.2.7/tailwind.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>  
<?php
// Code PHP của bạn (trước đoạn HTML)
include_once 'C:\Users\dungv\Desktop\DA1\controller\controller_product.php';
include_once 'C:\Users\dungv\Desktop\DA1\controller\controller_account.php';
include_once 'C:\Users\dungv\Desktop\DA1\controller\controller_category.php';
include_once 'C:\Users\dungv\Desktop\DA1\model\connect.php';
include_once 'C:\Users\dungv\Desktop\DA1\admin\start_session.php';
if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
    $id = getIdByUsername($conn, $username);
    $productId = getProductIdByUsername_id($conn, $id);
    $products = getProductbyProductId($conn, $productId);

    if (!empty($products)) {
        foreach ($products as $product) {
            $categoryname=getCategoryById($conn, $product['categoryId']);
            // Bắt đầu vòng lặp của bạn
?>
            <!-- start  -->
            
            <div class="bg-gray-100 mx-auto border-gray-500 border rounded-sm text-gray-700 mb-0.5 h-30 max-w-4xl">
                <div class="flex p-3 border-l-8 border-yellow-600">
                    <div class="space-y-1 border-r-2 pr-3">
                        <div class="text-sm leading-5 font-semibold"><span class="text-xs leading-4 font-normal text-gray-500"> Mã BĐS:</span> #<?= $product['id']; ?></div>
                        <div class="text-sm leading-5 font-semibold"><span class="text-xs leading-4 font-normal text-gray-500 pr"> Giá: </span> <?= $product['price']; ?></div>
                        <div class="text-sm leading-5 font-semibold"><?= $product['create_time']; ?></div>
                    </div>
                    <div class="flex-1">
                        <div class="ml-3 space-y-1 border-r-2 pr-3">
                            <div class="text-base leading-6 font-normal"><?= $product['name']; ?></div>
                            <div class="text-sm leading-4 font-normal"><span class="text-xs leading-4 font-normal text-gray-500"> Phân loại:</span> <?= $categoryname ?></div>
                            <div class="text-sm leading-4 font-normal"><span class="text-xs leading-4 font-normal text-gray-500"> Mô tả:</span> <?= $product['description']; ?></div>
                        </div>
                    </div>
                    <div>
                        <div class="ml-3 my-5 bg-yellow-600 p-1 w-20">
                            <a href="/controller/controller_product.php?id=<?= $product['id'] ?>&action=del"><div class="uppercase text-xs leading-4 font-semibold text-center text-red-100">Xóa</div></a>
                        </div>
                    </div>
                    <div>
                    </div>
                </div>
            </div>
            <!-- end -->
<?php
        }
    } else {
        echo "Không có BĐS nào được bạn đăng lên";
    }
} else {
    echo 'null';
}
?>

</body>
</html>