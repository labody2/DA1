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
        if (isset($_GET['link'])) {
        $link = $_GET['link'];

        switch ($link) {
            case 'home':
            include 'C:\Users\dungv\Desktop\DA1\view\page\home.php';
            break;
            
            default:
            // Xử lý trường hợp mặc định ở đây, nếu cần.
            break;
        }
        }
        ?>
</body>
</html>