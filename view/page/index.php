<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Quarter - Real Estate HTML Template</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Place favicon.png in the root directory -->
    <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon" />
    <!-- Font Icons css -->
    <link rel="stylesheet" href="../css/font-icons.css">
    <!-- plugins css -->
    <link rel="stylesheet" href="../css/plugins.css">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- Responsive css -->
    <link rel="stylesheet" href="../css/responsive.css">
</head>
<body class="flex flex-col min-h-screen"> 
<?php
    include_once 'C:\Users\dungv\Desktop\DA1\view\component\header.php';
?>
<div class="container_main flex-grow h-auto ">
    <?php
    $link = isset($_GET['link']) ? $_GET['link'] : 'trang_chu'; {

        switch ($link) {
            case 'trang_chu':
            include '../page/home.php';
            break;
            
            case 'about':
            include '../page/about.php';
            break;

            case 'BĐS':
            include '../page/shop.php';
            break;

            case 'BĐS_detail':
            include '../page/product-details.php';
            break;

            case 'tin_tuc':
            include '../page/article-card.php';
            break;

            case 'tin_tuc_chi_tiet':
            include '../page/article-detail.php';
            break;

            case 'lien_he':
            include '../page/contact.php';
            break;

            case 'dang_BĐS':
            include '../page/add_listing.php';
            break;

            case 'BĐS_cua_toi':
            include '../page/product_own.php';
            break;

            case 'profile':
            include '../page/profile.php';
            break;

            case 'recharge':
            include '../page/recharge.php';
            break;

            default:
            include '../page/home.php';
            break;
        }
        }
    ?>
</div>
<footer class="p-4 text-center bottom-0 inset-x-0" >
<?php
    include 'C:\Users\dungv\Desktop\DA1\view\component\footer.html';
?>
</footer>
</body>
</html>