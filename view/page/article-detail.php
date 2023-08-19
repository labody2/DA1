<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=yes">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/core.min.css">
    <title>Tin tức</title>
</head>
<body class="relative">
    <?php
    include 'C:\Users\dungv\Desktop\DA1\controller\controller_article.php';
    include 'C:\Users\dungv\Desktop\DA1\model\connect.php';
    if (isset($_GET['id'])) {
        $articleDetails = showArticleDetail($conn, $_GET['id']);
        if (!empty($articleDetails)) {
            $article = $articleDetails[0];
           
        } else {
            // Handle product not found
            echo "Bài báo không tồn tại";
            exit();
        }
    } else {
        echo "Lỗi: Không có ID bài báo được cung cấp.";
        exit();
    }
    ?>
        <div class="w-full md:w-3/5 mx-auto">
            <div class="mx-5 my-3 text-sm">
            <a href="" class=" text-red-600 font-bold tracking-widest">Tin tức mỗi ngày</a>
            </div>
            <div class="w-full text-gray-800 text-4xl px-5 font-bold leading-none">
            <?= $article['title'] ?>
            </div>
            
            <div class="w-full text-gray-500 px-5 pb-5 pt-2">
               Theo dõi bds.com để nhận tin tức mỗi ngày.
            </div>
            
            <div class="mx-5">
            <?php
            $imageString = $article['images'];
            $imagePaths = explode(",", $imageString);
            $firstImageDisplayed = false;
            foreach ($imagePaths as $imagePath) {
                if (!$firstImageDisplayed) {
                    echo '<div class="w-auto h-64 overflow-hidden">
                              <img src="' . $imagePath . '" alt="Image" class="w-full h-full object-cover">
                          </div>';
                    $firstImageDisplayed = true;
                }
            }
            ?>
            </div>
            
            <div class="w-full text-gray-600 text-normal mx-5">
                <p class="border-b py-3">Ảnh minh họa</p>
            </div>
            
            <div class="w-full text-gray-600 font-thin italic px-5 pt-3">
                By <strong class="text-gray-700"><?= $article['author'] ?></strong><br>
                <?= $article['create_time'] ?><br>
                Updated: <?= $article['create_time'] ?>
            </div>
            <br>
            <div class="px-5 w-full mx-auto">
            <?= $article['content'] ?>
            </div>
            <div class="mx-5 mt-5">
    <?php
    // Hiển thị ảnh cuối trang
    if (!empty($imagePaths)) {
        $lastImagePath = end($imagePaths);
        echo '<div class="w-auto h-64 overflow-hidden">
                  <img src="' . $lastImagePath . '" alt="Image" class="w-full h-full object-cover">
              </div>';
    }
    ?>
</div>
        </div>
        <div class="absolute w-full text-right text-sm bottom-0 p-3 mx-auto text-gray-400">
            Làm <i class="text-red-300 fa fa-heart"></i> bởi <a href="https://timelydevs.com">bds.com</a>
        </div>
    </body>
</html>