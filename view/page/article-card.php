<!DOCTYPE html>
<html>
<head>
    <title>Danh sách bài báo</title>
    <link rel="stylesheet" href="https://cdn.tailwindcss.com/2.2.7/tailwind.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
   <div class="container" style="margin:auto">
   <h1 class="text-3xl font-bold mb-5">Tin tức</h1>
    <?php
    include 'C:\Users\dungv\Desktop\DA1\controller\controller_article.php';
    include 'C:\Users\dungv\Desktop\DA1\model\connect.php';
    $articleData = showArticle($conn);
        if ($articleData !== null) {
        }else{
            echo "Có lỗi xảy ra";
        }
    ?>
        <div class="grid grid-cols-3 gap-10">
        <?php foreach ($articleData as $article) { ?>
    <div class="max-w-lg mx-auto">
        <div class="bg-white shadow-md border border-gray-200 rounded-lg max-w-sm mb-5" style="height:850px">
            <a href="../page/index.php?link=tin_tuc_chi_tiet&&id=<?=$article["id"]?>">
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
            </a>
            <div class="p-5">
                <a href="../page/index.php?link=tin_tuc_chi_tiet&&id=<?=$article["id"]?>">
                    <h5 class="text-gray-900 font-bold text-2xl tracking-tight mb-2"><?= $article['title'] ?></h5>
                </a>
                <?php
                $max_length = 250; // Độ dài tối đa mong muốn
                $text = $article['content'];
                if (strlen($text) > $max_length) {
                    $shortened_text = substr($text, 0, $max_length) . '...';
                } else {
                    $shortened_text = $text;
                }
                ?>
                <p class="font-normal text-gray-700 mb-3"><?= $shortened_text ?></p>
                <a class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 text-center inline-flex items-center" href="../page/index.php?link=tin_tuc_chi_tiet&&id=<?=$article["id"]?>">
                    Đọc thêm
                </a>
            </div>
        </div>
    </div>
<?php } ?>



    </div>
</div>
</body>
</html>
