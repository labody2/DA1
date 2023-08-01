<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Quarter - Real Estate HTML Template</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
<body> 
<?php
    include_once 'C:\Users\dungv\Desktop\DA1\view\component\header.php';
?>
<div class="container_main">
<?php
        if (isset($_GET['link'])) {
        $link = $_GET['link'];

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

            case 'tin_tuc':
            include '../page/article-card.php';
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

            default:
            include '../page/home.php';
            break;
        }
        }
    ?>
</div>
<?php
    include 'C:\Users\dungv\Desktop\DA1\view\component\footer.html';
?>
</body>
</html>