<?php
require_once 'C:\Users\dungv\Desktop\DA1\admin\start_session.php';
include 'C:\Users\dungv\Desktop\DA1\model\connect.php';

// Function to get all users
function getUsers($conn)
{
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);
    $users = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
    }
    return $users;
}

// Function to get user detail by username
function getUserDetail($conn, $username)
{
    // Sử dụng prepared statement để tránh SQL injection
    $sql = "SELECT id, username, status, role FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);

    // Kiểm tra xem truy vấn đã chuẩn bị thành công chưa
    if ($stmt) {
        // Gán giá trị vào tham số trong prepared statement
        mysqli_stmt_bind_param($stmt, "s", $username);

        // Thực thi truy vấn
        mysqli_stmt_execute($stmt);

        // Lấy kết quả từ truy vấn
        $result = mysqli_stmt_get_result($stmt);

        // Kiểm tra xem có kết quả hay không
        if (mysqli_num_rows($result) > 0) {
            // Lấy tất cả dữ liệu của người dùng (không bao gồm trường password)
            $user = mysqli_fetch_assoc($result);
            return $user;
        } else {
            return null;
        }

        // Đóng statement sau khi sử dụng
        mysqli_stmt_close($stmt);
    } else {
        // Xử lý lỗi khi truy vấn không được chuẩn bị
        return null;
    }
}



// Function to add a new user
function addUser($conn, $username, $password)
{
    $checkQuery = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
        echo '            
            <script src="https://cdn.tailwindcss.com"></script>
            <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert" style="max-width:500px;text-align: center;margin: 10 auto;">
            <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div>
            <span class="font-medium">Thất bại!</span> Tài khoản đã tồn tại
            </div>
            </div>
        ';
            echo '<script>
                setTimeout(function() {
                    window.history.back();
                }, 1000);
            </script>';
        return; 
    }
    $currentTime = date("Y-m-d H:i:s");
    // Giá trị mặc định cho role và status
    $role = "admin";
    $status = true;
    $name="admin";
    $sql = "INSERT INTO users (username, password, create_time, status, role,name) VALUES ('$username', '$password', '$currentTime', $status, '$role','$name')";
    if ($conn->query($sql) === TRUE) {
        echo '
            <script src="https://cdn.tailwindcss.com"></script>
            <div class=" flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert" style="max-width:500px;text-align: center;margin: 10 auto;">
            <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">Thành công!</span> 
            </div>
        ';     
            echo '<script>
                setTimeout(function() {
                    window.location.href = \'/admin/admin_control.php?link=users\';
                }, 1000);
            </script>';
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}

// Function to update an existing user
function updateUser($conn, $userId, $username, $password, $status, $role)
{
    $user = getUserDetail($conn, $username);
    if ($user) {
        $currentTime = date("Y-m-d H:i:s");
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $userId = $user['id'];
        $sql = "UPDATE users SET username = '$username', password = '$password', create_time = '$currentTime',  role = '$role' WHERE id = $userId";
        if ($conn->query($sql) === TRUE) {
            echo '
            <script src="https://cdn.tailwindcss.com"></script>
            <div class=" flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert" style="max-width:500px;text-align: center;margin: 10 auto;">
            <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">Thành công!</span> 
            </div>
        ';    
            echo '<script>
            setTimeout(function() {
                window.location.href = \'/admin/admin_control.php?link=users\';
            }, 1000);
            </script>';
        } else {
            echo "Lỗi: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo '            
        <script src="https://cdn.tailwindcss.com"></script>
        <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert" style="max-width:500px;text-align: center;margin: 10 auto;">
        <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span class="sr-only">Info</span>
        <div>
        <span class="font-medium">Thất bại!</span> Không tìm thấy người dùng có ID $userId
        </div>
        </div>
    ';
        echo '<script>
            setTimeout(function() {
                window.history.back();
            }, 1000);
        </script>';
        exit();
    }
}

// Function to delete a user
function deleteUser($conn, $userId)
{
    $sql = "DELETE FROM users WHERE id = $userId";
    if (mysqli_query($conn, $sql) === TRUE) {
        echo '
        <script src="https://cdn.tailwindcss.com"></script>
        <div class=" flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert" style="max-width:500px;text-align: center;margin: 10 auto;">
        <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span class="sr-only">Info</span>
        <div>
            <span class="font-medium">Thành công!</span> 
        </div>
    ';    
        echo '<script>
        setTimeout(function() {
            window.location.href = \'/admin/admin_control.php?link=users\';
        }, 1000);
        </script>';
    } else {
        echo '            
        <script src="https://cdn.tailwindcss.com"></script>
        <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert" style="max-width:500px;text-align: center;margin: 10 auto;">
        <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span class="sr-only">Info</span>
        <div>
        <span class="font-medium">Thất bại!</span> 
        </div>
        </div>
    ';
        echo '<script>
            setTimeout(function() {
                window.history.back();
            }, 1000);
        </script>';
    }
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["action"])&&$_POST["action"] == "update") {
        // Lấy thông tin người dùng từ cơ sở dữ liệu bằng hàm getUserDetail()
        $user = getUserDetail($conn, $_SESSION['username']);

        if ($user) {
            // Lấy dữ liệu từ form
            $password = $_POST["password"];
            $confirm_password = $_POST["confirm_password"];

            // Kiểm tra xác nhận mật khẩu
            if ($password !== $confirm_password) {
                echo "Mật khẩu và xác nhận mật khẩu không khớp.";
                exit();
            }

            // Cập nhật mật khẩu mới vào cơ sở dữ liệu
            $userId = $user['id'];
            $status = $user['status'];
            $role = $user['role'];
            updateUser($conn, $userId, $_SESSION['username'], $password, $status, $role);

            echo '
            <script src="https://cdn.tailwindcss.com"></script>
            <div class=" flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert" style="max-width:500px;text-align: center;margin: 10 auto;">
            <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">Thành công!</span> 
            </div>
        ';    
            echo '<script>
            setTimeout(function() {
                window.location.href = \'/admin/admin_control.php?link=users\';
            }, 1000);
            </script>';
            exit();
        } else {
            echo '            
            <script src="https://cdn.tailwindcss.com"></script>
            <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert" style="max-width:500px;text-align: center;margin: 10 auto;">
            <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div>
            <span class="font-medium">Thất bại!</span> Người dùng không tồn tại.
            </div>
            </div>
        ';
            echo '<script>
                setTimeout(function() {
                    window.history.back();
                }, 1000);
            </script>';
            exit();
        }
    }else{
        $username = $_POST["username"];
        $password = $_POST["password"];
        if (isset($_POST["update"])) {
            $status = $_POST["status"];
            $role = $_POST["role"];
            $userId = $_POST["user_id"];
            updateUser($conn, $userId, $username, $password, $status, $role);
        } elseif (isset($_POST["add"])) {
            addUser($conn, $username, $password);
        }
    }
    
}

// Delete user
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $userId = $_GET["id"];
    if (isset($_GET["action"])) {
        $action = $_GET["action"];
        if ($action === "delete") {
            deleteUser($conn, $userId);
        }
    }else{
        $isUpdated = toggleUserStatus($conn, $userId);
        if ($isUpdated) {
            echo "<script>window.location.href = '/admin/admin_control.php?link=users';</script>";
        exit; // Đảm bảo không có mã HTML hoặc mã PHP khác được thực thi sau khi chuyển hướng
        } else {
            echo '            
            <script src="https://cdn.tailwindcss.com"></script>
            <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert" style="max-width:500px;text-align: center;margin: 10 auto;">
            <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div>
            <span class="font-medium">Thất bại!</span> Yêu cầu không hợp lệ
            </div>
            </div>
        ';
            echo '<script>
                setTimeout(function() {
                    window.history.back();
                }, 1000);
            </script>';
        }
    }
} 

function toggleUserStatus($conn, $userId)
{
    // Tìm giá trị status hiện tại của người dùng dựa vào id
    $selectSql = "SELECT status FROM users WHERE id = '$userId'";
    $result = mysqli_query($conn, $selectSql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $currentStatus = $row["status"];
        // Đảo ngược giá trị status
        $newStatus = ($currentStatus == 1) ? 0 : 1;
        // Cập nhật giá trị trong cơ sở dữ liệu
        $updateSql = "UPDATE users SET status = $newStatus WHERE id = '$userId'";
        if (mysqli_query($conn, $updateSql)) {
            // Cập nhật trạng thái thành công
            return true;
        } else {
            echo "Lỗi: " . mysqli_error($conn);
        }
    } else {
        echo '            
        <script src="https://cdn.tailwindcss.com"></script>
        <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert" style="max-width:500px;text-align: center;margin: 10 auto;">
        <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span class="sr-only">Info</span>
        <div>
        <span class="font-medium">Thất bại!</span> Người dùng không tồn tại
        </div>
        </div>
    ';
        echo '<script>
            setTimeout(function() {
                window.history.back();
            }, 1000);
        </script>';
    }

    return false;
}


// Đóng kết nối
mysqli_close($conn);
?>
