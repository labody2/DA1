<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hồ sơ</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
    :root {
        --main-color: #4a76a8;
    }

    .bg-main-color {
        background-color: var(--main-color);
    }

    .text-main-color {
        color: var(--main-color);
    }

    .border-main-color {
        border-color: var(--main-color);
    }
</style>
</head>
<body>
    <?php
    include_once 'C:\Users\dungv\Desktop\DA1\model\connect.php';
    include_once 'C:\Users\dungv\Desktop\DA1\controller\controller_account.php';
    include_once 'C:\Users\dungv\Desktop\DA1\admin\start_session.php';
    if (isset($_SESSION["username"])) {
    }else{
        header("Location: /view/signin_signup/signin.php ");
        exit();
    }
    $userData = getAllByUsername($conn, $_SESSION["username"]);
    if ($userData !== null) {
        foreach ($userData as $user) {
        }}
    ?>
<div class="bg-gray-100 flex-grow ">
    <div class="container mx-auto my-5 p-5">
        <div class="md:flex no-wrap md:-mx-2 ">
            <!-- Left Side -->
            <div class="w-full md:w-3/12 md:mx-2">
                <!-- Profile Card -->
                <div class="bg-white p-3 border-t-4 border-green-400">
                    <h1 class="text-gray-900 font-bold text-xl leading-8 my-1"><?= $user['name']?></h1>
                    <h3 class="text-gray-600 font-lg text-semibold leading-6">Owner at Her Company Inc.</h3>
                    <p class="text-sm text-gray-500 hover:text-gray-600 leading-6">Lorem ipsum dolor sit amet
                        consectetur adipisicing elit.
                        Reprehenderit, eligendi dolorum sequi illum qui unde aspernatur non deserunt</p>
                    <ul
                        class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm">
                        <li class="flex items-center py-3">
                            <span>Status</span>
                            <span class="ml-auto"><span
                                    class="bg-green-500 py-1 px-2 rounded text-white text-sm"><?= $user['status'] === '1' ? 'Hoạt động' : 'Vô hiệu' ?></span></span>
                        </li>
                        <li class="flex items-center py-3">
                            <span>Member since</span>
                            <span class="ml-auto"><?= $user['create_time']?></span>
                        </li>
                    </ul>
                </div>
                <!-- End of profile card -->
                <div class="my-4"></div>
                <!-- Friends card -->
                <div class="bg-white p-3 hover:shadow">
                    <div class="flex items-center space-x-3 font-semibold text-gray-900 text-xl leading-8">
                        <span class="text-green-500">
                            <svg class="h-5 fill-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </span>
                        <span>Similar Profiles</span>
                    </div>
                    <div class="grid grid-cols-3" style="height:800px">
                    </div>
                </div>
                <!-- End of friends card -->
            </div>
            <!-- Right Side -->
            <div class="w-full md:w-9/12 mx-2 h-64">
                <!-- Profile tab -->
                <!-- About Section -->
                <div class="bg-white p-3 shadow-sm rounded-sm">
                    <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                        <span clas="text-green-500">
                            <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </span>
                        <span class="tracking-wide">About</span>
                    </div>
                    <div class="text-gray-700">
                        <div class="grid md:grid-cols-2 text-sm">
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold"> Name</div>
                                <div class="px-4 py-2"><?= $user['name']?></div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">UserName</div>
                                <div class="px-4 py-2"><?= $user['username']?></div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Contact No.</div>
                                <div class="px-4 py-2">0<?= $user['sđt']?></div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Email.</div>
                                <div class="px-4 py-2">
                                    <a class="text-blue-800" href="mailto:jane@example.com"><?= $user['email']?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button
                        class="block w-full text-blue-800 text-sm font-semibold rounded-lg hover:bg-gray-100 focus:outline-none focus:shadow-outline focus:bg-gray-100 hover:shadow-xs p-3 my-4">Chỉnh sửa thông tin</button>
                </div>
                <!-- End of about section -->

                <div class="my-4"></div>

        <!-- Buscador -->
            <div class="bg-white rounded-full border-none p-3 mb-4 shadow-md">
                <div class="flex items-center">
                    <i class="px-3 fas fa-search ml-1"></i>
                    <input type="text" placeholder="Buscar..." class="ml-3 focus:outline-none w-full">
                </div>
            </div>
    <div class="credit">
        <div class="lg:flex gap-4 items-stretch">
                    <!-- Caja Grande -->
                    <div class="bg-white md:p-2 p-6 rounded-lg border border-gray-200 mb-4 lg:mb-0 shadow-md lg:w-[35%]">
                    <div class="flex justify-center items-center space-x-5 h-full">
                        <div>
                            <p>Số dư khả dụng</p>
                            <h2 class="text-4xl font-bold text-gray-600"><?= $user['credit']?>đ</h2>
                        </div>
                        <img src="https://www.emprenderconactitud.com/img/Wallet.png" alt="wallet" class="h-24 md:h-20 w-38">
                    </div>
                </div>

                    <!-- Caja Blanca -->
                    <div class="bg-white p-4 rounded-lg xs:mb-4 max-w-full shadow-md lg:w-[65%]"> 
                        <!-- Cajas pequeñas -->
                        <div class="flex-1 bg-gradient-to-r from-cyan-400 to-cyan-600 rounded-lg flex flex-col items-center justify-center p-4 space-y-2 border border-gray-200 m-2" id="napTienButton" style="cursor: pointer;">
                            <i class="fas fa-hand-holding-usd text-white text-4xl"></i>
                            <p class="text-white">Nạp tiền</p>
                        </div>

                        <!-- Caja pequeña 2 -->
                        <div class="flex-1 bg-gradient-to-r from-cyan-400 to-cyan-600 rounded-lg flex flex-col items-center justify-center p-4 space-y-2 border border-gray-200 m-2" id="lichSuNapTienButton"
                        style="cursor: pointer;">
                            <i class="fas fa-exchange-alt text-white text-4xl"></i>
                            <p class="text-white">Lịch sử nạp tiền</p>
                        </div>

                        <!-- Caja pequeña 3 -->
                        <div class="flex-1 bg-gradient-to-r from-cyan-400 to-cyan-600 rounded-lg flex flex-col items-center justify-center p-4 space-y-2 border border-gray-200 m-2" id="napQuaQRButton"
                        style="cursor: pointer;">
                            <i class="fas fa-qrcode text-white text-4xl"></i>
                            <p class="text-white">Nạp qua Qr</p>
                        </div>

                        <script>
                            // Lấy các phần tử nút bằng cách sử dụng id
                            const napTienButton = document.getElementById("napTienButton");
                            const lichSuNapTienButton = document.getElementById("lichSuNapTienButton");
                            const napQuaQRButton = document.getElementById("napQuaQRButton");

                            // Thêm sự kiện click cho mỗi nút
                            napTienButton.addEventListener("click", function() {
                                // Thực hiện chuyển hướng tới trang nap-tien.php
                                window.location.href = "/view/page/index.php?link=recharge";
                            });

                            lichSuNapTienButton.addEventListener("click", function() {
                                // Thực hiện chuyển hướng tới trang lich-su-nap-tien.php
                                window.location.href = "lich-su-nap-tien.php";
                            });

                            napQuaQRButton.addEventListener("click", function() {
                                // Thực hiện chuyển hướng tới trang nap-qua-qr.php
                                window.location.href = "nap-qua-qr.php";
                            });
                        </script>

                    </div>
                </div>

                <!-- Tabla -->
                <div class="bg-white rounded-lg p-4 shadow-md my-4 max-h-100 overflow-y-scroll" >
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-left border-b-2 w-full">
                                    <h2 class="text-ml font-bold text-gray-600">Transacciones</h2>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b w-full">
                                <td class="px-4 py-2 text-left align-top w-1/2">
                                    <div>
                                        <h2>Comercio</h2>
                                        <p>24/07/2023</p>
                                    </div>
                                </td>
                                <td class="px-4 py-2 text-right text-cyan-500 w-1/2">
                                    <p><span>150$</span></p>
                                </td>
                            </tr>
                            <tr class="border-b w-full">
                                <td class="px-4 py-2 text-left align-top w-1/2">
                                    <div>
                                        <h2>Comercio</h2>
                                        <p>24/06/2023</p>
                                    </div>
                                </td>
                                <td class="px-4 py-2 text-right text-cyan-500 w-1/2">
                                    <p><span>15$</span></p>
                                </td>
                            </tr>
                            <tr class="border-b w-full">
                                <td class="px-4 py-2 text-left align-top w-1/2">
                                    <div>
                                        <h2>Comercio</h2>
                                        <p>02/05/2023</p>
                                    </div>
                                </td>
                                <td class="px-4 py-2 text-right text-cyan-500 w-1/2">
                                    <p><span>50$</span></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var menuButton = document.getElementById('menu-button');
        var sidebar = document.getElementById('sidebar');

        menuButton.addEventListener('click', function() {
            sidebar.classList.toggle('hidden');
            sidebar.classList.toggle('lg:block');
        });
    });
</script>

                    <!-- End of Experience and education grid -->
                </div>
                <!-- End of profile tab -->
            </div>
        </div>
    </div>
</div>
</body>
</html>