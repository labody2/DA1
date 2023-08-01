<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Đăng bất động sản</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div id="categoryWarning" style="color: red;fixed; top: 0; right: 0;display:none ; position:fixed;" role="alert" class="rounded border-s-4 border-red-500 bg-red-50 p-4">
  <div class="flex items-center gap-2 text-red-800">
    <svg
      xmlns="http://www.w3.org/2000/svg"
      viewBox="0 0 24 24"
      fill="currentColor"
      class="h-5 w-5"
    >
      <path
        fill-rule="evenodd"
        d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z"
        clip-rule="evenodd"
      />
    </svg>

    <strong class="block font-medium"> Có lỗi xảy ra </strong>
  </div>

  <p class="mt-2 text-sm text-red-700">
  Vui lòng chọn loại BĐS bạn muốn đăng trước khi đăng BĐS!
  </p>
</div>
<form class="bg-white dark:bg-gray-900" action="/controller/controller_product.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm();">
        <div class=" items-center w-full max-w-3xl p-8 mx-auto lg:px-12 lg:w-3/5">
            <div class="w-full">
                <div class="mt-6">
                    <h1 class="text-gray-500 dark:text-gray-300">Chọn loại BĐS bạn muốn đăng:</h1>
                    
                    <div class="mt-3 md:flex md:items-center md:-mx-2">
                        <input readonly type="hidden" id="categoryIdInput" name="categoryId" value="" />
                        <!-- HTML -->
                       <!-- HTML -->
                       <?php
                       include_once 'C:\Users\dungv\Desktop\DA1\controller\controller_category.php';
                        // Gọi hàm getCategories để lấy danh sách các categories
                        $categories = getCategories($conn);
                        // Duyệt qua từng category và in ra các button tương ứng
                        foreach ($categories as $category) {
                            $categoryId = $category['id'];
                            $categoryName = $category['category_name'];
                            echo '<button id="button' . $categoryId . '" class="flex justify-center w-full px-6 py-3 mt-4 text-blue-500 border border-blue-500 rounded-md md:mt-0 md:w-auto md:mx-2 dark:border-blue-400 dark:text-blue-400 focus:outline-none" style="width: 200px; height: 100px;"onclick="toggleClicked(' . $categoryId . ')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <span class="mx-2">' . $categoryName . '</span>
                                </button>';
                        }
                        ?>

                        <script>
                            let selectedCategoryId = null;

                            function toggleClicked(categoryId) {
                                const button = document.getElementById('button' + categoryId);
                                const categoryIdInput = document.getElementById('categoryIdInput');
                                
                                if (selectedCategoryId === categoryId) {
                                    // Bỏ chọn sản phẩm hiện tại nếu đã được chọn
                                    button.setAttribute('class', 'flex justify-center w-full px-6 py-3 mt-4 text-blue-500 border border-blue-500 rounded-md md:mt-0 md:w-auto md:mx-2 dark:border-blue-400 dark:text-blue-400 focus:outline-none');
                                    button.classList.remove('clicked');
                                    categoryIdInput.value = '';
                                    selectedCategoryId = null;
                                } else {
                                    // Chọn sản phẩm mới
                                    // Bỏ chọn sản phẩm cũ nếu có
                                    if (selectedCategoryId !== null) {
                                        const prevButton = document.getElementById('button' + selectedCategoryId);
                                        prevButton.setAttribute('class', 'flex justify-center w-full px-6 py-3 mt-4 text-blue-500 border border-blue-500 rounded-md md:mt-0 md:w-auto md:mx-2 dark:border-blue-400 dark:text-blue-400 focus:outline-none');
                                        prevButton.classList.remove('clicked');
                                    }

                                    button.setAttribute('class', 'flex justify-center w-full px-6 py-3 text-white bg-blue-500 rounded-md md:w-auto md:mx-2 focus:outline-none');
                                    button.classList.add('clicked');
                                    categoryIdInput.value = categoryId;
                                    selectedCategoryId = categoryId;
                                    if (categoryIdInput.value === '') {
                                        const categoryWarning = document.getElementById('categoryWarning');
                                        categoryWarning.style.display = 'block';
                                    }   
                                }
                                event.preventDefault();
                            }
                        </script>
                    </div>
                </div>

                <form>
                    <div>
                        <label for="productName" class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Tên nhà/đất muốn đăng:</label>
                        <input placeholder="Điền vào đây" class="block w-full px-5 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40"type="text" id="productName" name="productName" required />
                    </div>

                    <div>
                        <label for="price" class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Giá dao động:</label>
                        <input  type="number" id="price" name="price" required placeholder="Giá (tỷ VNĐ)" class="block w-full px-5 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                    </div>

                    <div>
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> Mô tả chi tiết</label>
                        <textarea id="description" name="description" required rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Viết mô tả của bạn vào đây..."></textarea>
                    </div>
                    
                    <div>
                            <label
                            for="formFileMultiple"
                            class="mb-2 inline-block text-neutral-700 dark:text-neutral-200"
                            >Ảnh</label
                            >
                            <input
                                class="relative m-0 block w-full min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700 dark:file:text-neutral-100 dark:focus:border-primary"
                                type="file"
                                id="image"
                                name="image[]"
                                accept="image/*"
                                multiple
                            />
                                <div id="imagePreview" class="mt-2 grid grid-cols-10 gap-3">
                                <!-- Các ảnh đã upload sẽ được hiển thị ở đây -->
                                </div>
                                <img id="selectedImage" style="display: none;" class="h-auto max-w-sm rounded-lg mt-4" src="" alt="Selected Image">


                    </div>
                    <script>
                        // Lấy thẻ <img> để hiển thị ảnh đang được chọn
                        const selectedImage = document.getElementById('selectedImage');

                        document.getElementById('image').addEventListener('change', function () {
                            // Lấy danh sách các ảnh đã chọn
                            const files = this.files;

                            // Lấy div để hiển thị các ảnh
                            const imagePreview = document.getElementById('imagePreview');

                            // Xóa các ảnh cũ trong div
                            imagePreview.innerHTML = '';

                            // Kiểm tra nếu chưa có ảnh được chọn thì ẩn thẻ <img> selectedImage
                            if (files.length === 0) {
                                selectedImage.style.display = 'none';
                            } else {
                                selectedImage.style.display = 'block';
                            }

                            // Duyệt qua từng ảnh đã chọn và hiển thị nó trong div
                            for (let i = 0; i < files.length; i++) {
                                const file = files[i];
                                const reader = new FileReader();

                                reader.onload = function (e) {
                                    const img = document.createElement('img');
                                    img.setAttribute('src', e.target.result);
                                    img.setAttribute('class', 'w-full h-full object-cover cursor-pointer');
                                    // Thêm sự kiện click cho từng ảnh
                                    img.addEventListener('click', function () {
                                        // Thay đổi ảnh hiển thị khi click vào ảnh
                                        selectedImage.setAttribute('src', e.target.result);
                                    });
                                    imagePreview.appendChild(img);
                                };

                                reader.readAsDataURL(file);
                            }
                        });
                    </script>
                    <div>
                        <label for="square" class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Diện tích:</label>
                        <input type="number" id="square" name="square" required placeholder="m2" class="block w-full px-5 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                    </div>
                    <div>
                        <div class="flex items-center">
                            <span style="width:120px">Số phòng ngủ:</span>
                            <button
                                id="decrementBtn"
                                type="button"
                                class="w-10 h-10 leading-10 text-gray-600 transition hover:opacity-75"
                            >
                                &minus;
                            </button>

                            <input
                                name="bed_room"
                                type="number"
                                id="Quantity"
                                value="1"
                                class="h-10 w-16 border-transparent text-center [-moz-appearance:_textfield] sm:text-sm [&::-webkit-outer-spin-button]:m-0 [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:m-0 [&::-webkit-inner-spin-button]:appearance-none"
                            />

                            <button
                                id="incrementBtn"
                                type="button"
                                class="w-10 h-10 leading-10 text-gray-600 transition hover:opacity-75"
                            >
                                &plus;
                            </button>
                        </div>
                        <div class="flex items-center">
                            <span style="width:120px">Số phòng khách:</span>
                            <button
                                id="decrementBtn2"
                                type="button"
                                class="w-10 h-10 leading-10 text-gray-600 transition hover:opacity-75"
                            >
                                &minus;
                            </button>

                            <input
                                name="other_room"
                                type="number"
                                id="Quantity2"
                                value="1"
                                class="h-10 w-16 border-transparent text-center [-moz-appearance:_textfield] sm:text-sm [&::-webkit-outer-spin-button]:m-0 [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:m-0 [&::-webkit-inner-spin-button]:appearance-none"
                            />

                            <button
                                id="incrementBtn2"
                                type="button"
                                class="w-10 h-10 leading-10 text-gray-600 transition hover:opacity-75"
                            >
                                &plus;
                            </button>
                        </div>
                        <div class="flex items-center">
                            <span style="width:120px">Số phòng tắm:</span>
                            <button
                                id="decrementBtn3"
                                type="button"
                                class="w-10 h-10 leading-10 text-gray-600 transition hover:opacity-75"
                            >
                                &minus;
                            </button>

                            <input
                                name="bathroom"
                                type="number"
                                id="Quantity3"
                                value="1"
                                class="h-10 w-16 border-transparent text-center [-moz-appearance:_textfield] sm:text-sm [&::-webkit-outer-spin-button]:m-0 [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:m-0 [&::-webkit-inner-spin-button]:appearance-none"
                            />

                            <button
                                id="incrementBtn3"
                                type="button"
                                class="w-10 h-10 leading-10 text-gray-600 transition hover:opacity-75"
                            >
                                &plus;
                            </button>
                        </div>

                        <script>
                            const decrementBtn = document.getElementById('decrementBtn');
                            const incrementBtn = document.getElementById('incrementBtn');
                            const quantityInput = document.getElementById('Quantity');
                            const decrementBtn2 = document.getElementById('decrementBtn2');
                            const incrementBtn2 = document.getElementById('incrementBtn2');
                            const quantityInput2 = document.getElementById('Quantity2');
                            const decrementBtn3 = document.getElementById('decrementBtn3');
                            const incrementBtn3 = document.getElementById('incrementBtn3');
                            const quantityInput3 = document.getElementById('Quantity3');
                            decrementBtn.addEventListener('click', function () {
                                // Lấy giá trị hiện tại của input
                                let currentValue = parseInt(quantityInput.value);

                                // Giảm giá trị nếu nó lớn hơn 1
                                if (currentValue > 1) {
                                    currentValue -= 1;
                                }

                                // Cập nhật giá trị mới cho input
                                quantityInput.value = currentValue;
                            });

                            incrementBtn.addEventListener('click', function () {
                                // Lấy giá trị hiện tại của input
                                let currentValue = parseInt(quantityInput.value);

                                // Tăng giá trị
                                currentValue += 1;

                                // Cập nhật giá trị mới cho input
                                quantityInput.value = currentValue;
                            });
                            decrementBtn2.addEventListener('click', function () {
                                // Lấy giá trị hiện tại của input
                                let currentValue = parseInt(quantityInput2.value);

                                // Giảm giá trị nếu nó lớn hơn 1
                                if (currentValue > 1) {
                                    currentValue -= 1;
                                }

                                // Cập nhật giá trị mới cho input
                                quantityInput2.value = currentValue;
                            });

                            incrementBtn2.addEventListener('click', function () {
                                // Lấy giá trị hiện tại của input
                                let currentValue = parseInt(quantityInput2.value);

                                // Tăng giá trị
                                currentValue += 1;

                                // Cập nhật giá trị mới cho input
                                quantityInput2.value = currentValue;
                            });
                            decrementBtn3.addEventListener('click', function () {
                                // Lấy giá trị hiện tại của input
                                let currentValue = parseInt(quantityInput3.value);

                                // Giảm giá trị nếu nó lớn hơn 1
                                if (currentValue > 1) {
                                    currentValue -= 1;
                                }

                                // Cập nhật giá trị mới cho input
                                quantityInput3.value = currentValue;
                            });

                            incrementBtn3.addEventListener('click', function () {
                                // Lấy giá trị hiện tại của input
                                let currentValue = parseInt(quantityInput3.value);

                                // Tăng giá trị
                                currentValue += 1;

                                // Cập nhật giá trị mới cho input
                                quantityInput3.value = currentValue;
                            });
                        </script>

                    </div>
                    <button type="submit"
                        class="flex items-center justify-between w-full px-6 py-3 text-sm tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-500 rounded-md hover:bg-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                        <span>Thêm bất động sản </span>

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 rtl:-scale-x-100" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </form>
            </div>
<script>
                            function validateForm() {
                                const categoryIdInput = document.getElementById('categoryIdInput');
                                const categoryWarning = document.getElementById('categoryWarning');
                                if (categoryIdInput.value === '') {
                                    categoryWarning.style.display = 'block';
                                    return false; // Ngăn không gửi form nếu chưa chọn danh mục
                                }
                                return true; // Gửi form nếu đã chọn danh mục
                            }
</script>
</form>
</body>
</html>
