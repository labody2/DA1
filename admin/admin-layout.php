<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<?php
include 'C:\Users\dungv\Desktop\DA1\admin\checkpermission.php';
?>
<body class="bg-gray-100">
  <div class="flex h-screen">
    <!-- Sidebar -->
    <aside class="bg-gray-800 text-white w-64 flex-none">
      <div class="flex items-center justify-center h-16 bg-gray-900">
        <h1 class="text-2xl font-semibold">Quản lí</h1>
      </div>
      <nav class="py-4">
        <ul>
          <a href="#" id="dashboardLink"><li class="px-8 py-2 hover:bg-gray-700">Products</li></a>
          <a href="#" id="usersLink"><li class="px-8 py-2 hover:bg-gray-700">Users</li></a>
          <a href="#" id="categoryLink"><li class="px-8 py-2 hover:bg-gray-700">Category</li></a>
          <a href="#" id="articleLink"><li class="px-8 py-2 hover:bg-gray-700">Article</li></a>
          <a href="#" id="articleCategoryLink"><li class="px-8 py-2 hover:bg-gray-700">Article-Category</li></a>
        </ul>
      </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-grow">
    <header class="bg-white shadow flex justify-between">
      <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-semibold text-gray-800">Admin Dashboard</h1>
      </div>
      <div class="container mx-auto px-4 py-6">
        <p class="text-right text-gray-800">
          <a href="">
          <?php echo $_SESSION["username"]; ?>
          </a>
        </p>
      </div>
    </header>


      <div class="container mx-auto px-4 py-6">
      <div class="grid grid-cols-4 gap-4">
          <div class="bg-white rounded shadow p-4">
            <h2 class="text-xl font-semibold text-gray-800">Users</h2>
            <p class="text-gray-600">Total users: 100</p>
          </div>
          
          <div class="bg-white rounded shadow p-4">
            <h2 class="text-xl font-semibold text-gray-800">Orders</h2>
            <p class="text-gray-600">Total orders: 50</p>
          </div>
          
          <div class="bg-white rounded shadow p-4">
            <h2 class="text-xl font-semibold text-gray-800">Products</h2>
            <p class="text-gray-600">Total products: 200</p>
          </div>
          
          <div class="bg-white rounded shadow p-4">
            <h2 class="text-xl font-semibold text-gray-800">Revenue</h2>
            <p class="text-gray-600">Total revenue: $10,000</p>
          </div>
        </div>
        <div id="content"></div>
        
        
      </div>

      <footer class="bg-gray-200">
        <div class="container mx-auto px-4 py-6">
          <p class="text-center text-gray-600">© 2023 Admin Dashboard. All rights reserved.</p>
        </div>
      </footer>
    </div>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var dashboardLink = document.querySelector('#dashboardLink');
      var usersLink = document.querySelector('#usersLink');
      var categoryLink = document.querySelector('#categoryLink');
      var articleLink = document.querySelector('#articleLink');
      var articleCategoryLink = document.querySelector('#articleCategoryLink');
      var content = document.querySelector('#content');

      function includeContent(file) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', file, true);
        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
            content.innerHTML = xhr.responseText;
          }
        };
        xhr.send();
      }

      dashboardLink.addEventListener('click', function(event) {
        event.preventDefault();
        includeContent('admin_product/admin-controlpanel.php');
      });

      usersLink.addEventListener('click', function(event) {
        event.preventDefault();
        includeContent('admin_account/manager_account.php');
      });

      categoryLink.addEventListener('click', function(event) {
        event.preventDefault();
        includeContent('admin_category/admin-categories.php');
      });

      articleLink.addEventListener('click', function(event) {
        event.preventDefault();
        includeContent('admin_article/article.php');
      });

      articleCategoryLink.addEventListener('click', function(event) {
        event.preventDefault();
        includeContent('article-category.php');
      });
    });
  </script>
</body>


</html>
