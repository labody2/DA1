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
    if ($productId!==null) {
        $products = getProductbyProductId($conn, $productId);
    }

    if (!empty($products)) {
        foreach ($products as $product) {
            $categoryname=getCategoryById($conn, $product['categoryId']);
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
                    <div class="ml-3 my-5 ">
                    <?php
                        $status = $product['status'];
                        if ($status === 'fail') {
                            echo '
                            <button id="dropdownButton' . $product['id'] . '" class="bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300 cursor-pointer w-full" type="button">
                                Không được duyệt
                            </button>
                            <div id="messageDecline' . $product['id'] . '" class="z-10 bg-white divide-y divide-gray-100 shadow w-44 dark:bg-gray-700 hidden w-full">
                                <ul>
                                    <span class="block px-4 py-2 ">Lí do: ' . $product['message_decline'] . '</span>
                                </ul>
                            </div>
                            <script>
                                document.getElementById("dropdownButton' . $product['id'] . '").addEventListener("click", function() {
                                    const messageDiv = document.getElementById("messageDecline' . $product['id'] . '");
                                    if (messageDiv.style.display === "block") {
                                        messageDiv.style.display = "none";
                                    } else {
                                        messageDiv.style.display = "block";
                                    }
                                });
                            </script>
                        ';
                        
        
                        } elseif ($status === 'success') {
                            echo '<span class="bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Duyệt thành công</span>';
                        } elseif ($status === 'pending') {
                            echo '<span class="bg-yellow-100 text-yellow-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Đang duyệt...</span>';
                        }
                    ?>
                    
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