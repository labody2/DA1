<?php
function showArticle($conn)
{
    $sql = "SELECT * FROM article";
    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    } else {
        echo 'Không có bài báo nào';
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
        return null;
    }
}
function showArticleDetail($conn,$article_id)
{
    $sql = "SELECT * FROM article WHERE id='$article_id'";
    $result = $conn->query($sql);
    $article = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $article[] = $row;
        }
    }
    return $article;
}

// Đóng kết nối
mysqli_close($conn);
?>