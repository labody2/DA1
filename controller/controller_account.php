<?php
include 'C:\Users\dungv\Desktop\DA1\model\connect.php';
function getAllByUsername($conn, $username)
{
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
        $rows = array();  // Mảng để chứa tất cả các dòng dữ liệu
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;  // Thêm dòng vào mảng
        }
        return $rows;
    } else {
        echo 'null';
        return null;
    }
}
function getHistoryTransactions($conn, $id_user)
{
    $sql = "SELECT DISTINCT * FROM recharge_history WHERE id_user = '$id_user'";
    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
        $rows = array();  
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row; 
        }
        return $rows;
    } else {
        echo 'Có lỗi xảy ra';
        return null;
    }
}

function getIdByUsername($conn, $username)
{
    $sql = "SELECT id FROM users WHERE username = '$username'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();
        return $row['id'];
        echo $row['id'];
    } else {
        echo 'null';
        return null;
    }
}
function getNameById($conn, $id)
{
    $sql = "SELECT name FROM users WHERE id = '$id'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();
        return $row['name'];
        echo $row['name'];
    } else {
    }
}

function checkAdmin($conn, $username)
{
    $sql = "SELECT role FROM users WHERE username = '$username'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();
        return $row['role'];
        echo $row['role'];
    } else {
        echo 'null';
        return null;
    }
}
function recharge($conn, $username,$amount) {
    $sql = "SELECT recharge_amount_pending FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $rechargeAmountPending = $row['recharge_amount_pending'];
        if ($rechargeAmountPending == 0) {
            $sql = "UPDATE users SET recharge_amount_pending = $amount WHERE username = '$username'";
            if ($conn->query($sql) === TRUE) {
                // Cập nhật thành công
                echo '<script>alert("Vui lòng đợi xác nhận nạp tiền từ hệ thống");</script>';
                echo '<script>
                setTimeout(function() {
                    window.location.href = \'/view/page/index.php?link=profile\';
                }, 1000);
            </script>';
            } else {
                echo '<script>alert("Có lỗi xảy ra");</script>';
                echo '<script>
                setTimeout(function() {
                    window.location.href = \'/view/page/index.php?link=profile\';
                }, 1000);
            </script>';
            }
        } else {
            echo '<script>alert("Không thể thực hiện giao dịch nạp tiền vì bạn có lệnh nạp tiền chưa hoàn thành");</script>';
            echo '<script>
                setTimeout(function() {
                    window.location.href = \'/view/page/index.php?link=profile\';
                }, 1000);
            </script>';
        }
    } else {
        echo "Không tìm thấy thông tin người dùng.";
    }
}
if (isset($_POST['name'])&&isset($_POST['amount'])) {
    recharge($conn, $_POST['name'],$_POST['amount']);
}
?>