<!doctype html>
<html class="no-js" lang="zxx">


<!-- Mirrored from tunatheme.com/tf/html/quarter-preview/quarter/product-details.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 13 Jul 2023 06:27:35 GMT -->
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
    <script src="../js/plugins.js"></script>
    <!-- Main JS -->
    <script src="../js/main.js"></script>
</head>

<body>

<!-- Body main wrapper start -->
<div class="body-wrapper">

    <div class="ltn__utilize-overlay"></div>

    <!-- BREADCRUMB AREA START -->
    <div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image mb-0"  data-bs-bg="img/bg/14.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__breadcrumb-inner">
                        <h1 class="page-title">Thông tin chi tiết BĐS</h1>
                        <div class="ltn__breadcrumb-list"></div>
                            <ul>
                                <li><a href="index.php"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->
        
    <?php
    include 'C:\Users\dungv\Desktop\DA1\controller\controller_product.php';
    include 'C:\Users\dungv\Desktop\DA1\model\connect.php';
    if (isset($_GET['id'])) {
        $productDetails = getProductDetail($conn, $_GET['id']);
        if (!empty($productDetails)) {
            $product = $productDetails[0];
           
        } else {
            // Handle product not found
            echo "Sản phẩm không tồn tại.";
            exit();
        }
    } else {
        echo "Lỗi: Không có ID sản phẩm được cung cấp.";
        exit();
    }
    ?>            
    <?php
        $imageStr = $product['img1'] ;
        $imageArray = explode(",", $imageStr);
    ?>
    <!-- IMAGE SLIDER AREA START (img-slider-3) -->

    <div class="ltn__img-slider-area mb-90">
        <div class="container-fluid">
            <div class="row ltn__image-slider-5-active slick-arrow-1 slick-arrow-1-inner ltn__no-gutter-all">

            <?php foreach ($imageArray as $image) : ?>
                <div class="col-lg-12">
                    <div class="ltn__img-slide-item-4">
                        <a href="<?= $image ?>" data-rel="lightcase:myCollection">
                            <img src="<?= $image ?>" alt="Image">
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>

            </div>
            </div>
        </div>
    </div>
    <!-- IMAGE SLIDER AREA END -->

    <!-- SHOP DETAILS AREA START -->
    <div class="ltn__shop-details-area pb-10">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="ltn__shop-details-inner ltn__page-details-inner mb-60">
                        <div class="ltn__blog-meta">
                            <ul>
                                <li class="ltn__blog-category">
                                    <a href="#">Featured</a>
                                </li>
                                <li class="ltn__blog-category">
                                    <a class="bg-orange" href="#">For Rent</a>
                                </li>
                                <li class="ltn__blog-date">
                                    <i class="far fa-calendar-alt"></i><?= $product['create_time'] ?>
                                </li>
                                <li>
                                    <a href="#"><i class="far fa-comments"></i>35 Comments</a>
                                </li>
                            </ul>
                        </div>
                        <h1><?= $product['name'] ?></h1>
                        <label><span class="ltn__secondary-color"><i class="flaticon-pin"></i></span> <?= $product['address'] ?></label>
                        <h4 class="title-2">Description</h4>
                        <p><?= $product['description'] ?></p>

                        <h4 class="title-2">Property Detail</h4>  
                        <div class="property-detail-info-list section-bg-1 clearfix mb-60">                          
                            <ul>
                                <li><label>Mã số  ID:</label> <span><?= $product['id'] ?></span></li>
                                <li><label>Diện tích </label> <span><?= $product['square'] ?>m2</span></li>
                                <li><label>Phòng ngủ:</label> <span><?= $product['bed_room'] ?></span></li>
                                <li><label>Phòng tắm:</label> <span><?= $product['bathroom'] ?></span></li>
                                <li><label>Phòng khách:</label> <span><?= $product['other_room'] ?></span></li>
                            </ul>
                            <ul>
                                <li><label>Giá:</label> <span>~<?= $product['price'] ?> tỷ đồng</span></li>
                                <li><label>Trạng thái:</label> <span>Đang rao</span></li>
                            </ul>
                        </div>

                        <h4 class="title-2">From Our Gallery</h4>
                        <div class="ltn__property-details-gallery mb-30">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="../img/others/14.jpg" data-rel="lightcase:myCollection">
                                        <img class="mb-30" src="../img/others/14.jpg" alt="Image">
                                    </a>
                                    <a href="../img/others/15.jpg" data-rel="lightcase:myCollection">
                                        <img class="mb-30" src="../img/others/15.jpg" alt="Image">
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="../img/others/16.jpg" data-rel="lightcase:myCollection">
                                        <img class="mb-30" src="../img/others/16.jpg" alt="Image">
                                    </a>
                                </div>
                            </div>
                        </div>

                        <h4 class="title-2">Location</h4>
                        <div class="property-details-google-map mb-60">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29793.988458865213!2d105.81636406617432!3d21.022738359976767!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab9bd9861ca1%3A0xe7887f7b72ca17a9!2zSMOgIE7hu5lpLCBIb8OgbiBLaeG6v20sIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1691179472414!5m2!1svi!2s" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>

                      
                    </div>
                </div>
                <div class="col-lg-4">
                    <aside class="sidebar ltn__shop-sidebar ltn__right-sidebar---">
                        <!-- Author Widget -->
                        <div class="widget ltn__author-widget">
                            <div class="ltn__author-widget-inner text-center">
                                <img src="../img/team/4.jpg" alt="Image">
                                <?php
                                $userPost=getUserByAccountId_post($conn, $product['accountId_post'] );
                                if (!empty($userPost)) {
                                    $user = $userPost[0];
                                
                                } else {
                                    // Handle product not found
                                    echo "Người dùng không tồn tại.";
                                    exit();
                                }
                                ?>
                                <h5><?= $user['name'] ?></h5>
                                <span>Email:</span>
                                <a href="mailto:<?=$user['email']?>"><?= $user['email'] ?></a>
                                <div class="product-ratting">
                                    <ul>
                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                        <li class="review-total"> <a href="#"> ( 1 Reviews )</a></li>
                                    </ul>
                                </div>
                                <span>Liên hệ: (+84)</span>
                                <a href="tel:<?= $user['sđt'] ?>">
                                <?= $user['sđt'] ?>
                                </a>
                                <div class="ltn__social-media">
                                    <ul>
                                        <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
                                        
                                        <li><a href="#" title="Youtube"><i class="fab fa-youtube"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Form Widget -->
                        <div class="widget ltn__form-widget">
                            <h4 class="ltn__widget-title ltn__widget-title-border-2">Drop Messege For Book</h4>
                            <form action="/controller/controller_product.php" method="post">
                                <input type="text" name="yourname" placeholder="Your Name*">
                                <input type="text" name="youremail" placeholder="Your e-Mail*">
                                <div class="relative z-0 w-full mb-6 group">
                                    <input type="number" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" name="yourphone" id="floating_phone" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="" required />
                                    <label for="floating_phone" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Phone number (+84)</label>
                                </div>
                                <textarea name="yourmessage" placeholder="Write Message..."></textarea>
                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                <button type="submit" class="btn theme-btn-1">Gửi thông tin liên lạc</button>
                            </form>
                        </div>
                        

</div>

  
</body>

<!-- Mirrored from tunatheme.com/tf/html/quarter-preview/quarter/product-details.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 13 Jul 2023 06:27:41 GMT -->
</html>

