<?php
session_start(); // Bắt đầu phiên làm việc
if (isset($_SESSION["username"])) {
  header("Location: /view/page/index.php");
  exit;
}
include 'C:\Users\dungv\Desktop\DA1\model\connect.php';

// Khởi tạo biến lưu thông báo lỗi
$errorMsg = "";
$successMsg="";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Lấy dữ liệu từ form
    $username = $_POST["username"];
    $password = $_POST["password"];
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        if ($user['status'] == 0) {
            // Tài khoản bị khóa, hiển thị thông báo lỗi
            $errorMsg = "Tài khoản của bạn đã bị khóa!";
        } elseif ($user['password'] === $password) {
            // Đăng nhập thành công, lưu thông tin vào session và chuyển hướng đến trang chính
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $username;
            echo "<script>window.location.href = '/view/page/index.php';</script>";
        } else {
            // Sai mật khẩu, hiển thị thông báo lỗi
            $errorMsg = "Mật khẩu không chính xác!";
        }
    } else {
        // Tài khoản không tồn tại, hiển thị thông báo lỗi
        $errorMsg = "Tên đăng nhập không chính xác!";
    }
}

// Đóng kết nối
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <?php if ($errorMsg !== ""): ?>
        <div role="alert" class="rounded border-s-4 border-red-500 bg-red-50 p-4">
            <strong class="block font-medium text-red-800">Lỗi:</strong>
            <p class="mt-2 text-sm text-red-700"><?php echo $errorMsg; ?></p>
        </div>
    <?php endif; ?>
        <div class="container" style="margin-top:100px">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" style="width:50%;margin:0 auto">
    <h1 style="font-size:30px">Đăng nhập</h1>
    <br>
  <div class="mb-6">
    <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tên đăng nhập</label>
    <input type="username" id="username" name="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tên đăng nhập" required>
  </div>
  <div class="mb-6">
    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mật khẩu</label>
    <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
  </div>
  <div class="flex items-start mb-6">
    <div class="flex items-center h-5">
      <input id="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" >
    </div>
    <label for="remember" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember me</label>
    <a class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300" href="/view/signin_signup/signup.php"><u>Chưa có tài khoản?</u></a>
  </div>
  <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Đăng nhập</button>
</form>
        </div>


</body>
</html>
