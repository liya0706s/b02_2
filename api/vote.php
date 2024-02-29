<?php
include_once "db.php";
// dd($_POST);
// Array
// (
//     [opt] => 10
// )

$opt=$Que->find($_POST['opt']);
$opt['vote']++;
$Que->save($opt);

// 選項增加票數的同時和主題票數加一，同時計算總票數，可以計算百分比

// 根據選項資料的subject_id欄位 是主題資料(id)
$sub=$Que->find($opt['subject_id']);

$sub['vote']++;
$Que->save($sub);

// 導回標題id的投票結果頁面
to("../index.php?do=result&id={$sub['id']}");



?>