<?php
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
?>