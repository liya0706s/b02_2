<?php
include_once "db.php";

// 取得指定文章的id
$news=$News->find($_GET['id']);

echo "<span style='font-weight:bolder'>" . $news['title']. "</span>";
echo "<br>";

echo nl2br($news['news']);
   
?>