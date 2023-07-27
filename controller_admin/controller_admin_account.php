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
    $currentTime = date("Y-m-d H:i:s");
    // Giá trị mặc định cho role và status
    $role = "admin";
    $status = true;

    $sql = "INSERT INTO users (username, password, create_time, status, role) VALUES ('$username', '$password', '$currentTime', $status, '$role')";
    if ($conn->query($sql) === TRUE) {
        echo "Thêm người dùng thành công!";
        echo "<script>window.location.href = '/admin/admin_control.php?link=users';</script>"; 
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
            echo "Cập nhật người dùng thành công!";
            // echo "<script>window.location.href = '/admin/admin_control.php?link=users';</script>"; 
        } else {
            echo "Lỗi: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Không tìm thấy người dùng có ID $userId";
        exit();
    }
}

// Function to delete a user
function deleteUser($conn, $userId)
{
    $sql = "DELETE FROM users WHERE id = $userId";
    if (mysqli_query($conn, $sql) === TRUE) {
        echo "Xóa người dùng thành công!";
        echo "<script>window.location.href = '/admin/admin_control.php?link=users';</script>"; 
    } else {
        echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["action"] == "update") {
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

            echo "Cập nhật mật khẩu thành công!";
            // echo "<script>window.location.href = '/admin/admin_control.php?link=users';</script>";
            exit();
        } else {
            // Người dùng không tồn tại trong cơ sở dữ liệu, xử lý tương ứng
            echo "Người dùng không tồn tại.";
            exit();
        }
    }
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
            echo "Yêu cầu không hợp lệ";
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
        echo "Người dùng không tồn tại";
    }

    return false;
}


// Đóng kết nối
mysqli_close($conn);
?>
