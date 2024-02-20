<?php
include_once "db.php";

// 利用count來檢查是否帳號存在
// 從front/login.php透過js發送POST
$res=$User->count(['acc'=>$_POST['acc']]);
// 回傳檢查的結果
if($res>0){
    // 查有此帳號
    echo 1;
}else{
    // 查無此帳號
    echo 0;
}


?>