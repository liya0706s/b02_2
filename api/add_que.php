<?php
include_once "db.php";

/**
 * 
 * back/que.php 同時把題目和選項一起送出的，資料庫在儲存時會依照subject_id這個欄位來判斷這筆資料是題目還是選項。
 * 撰寫api時要注意資料處理的先後順序，先處理題目的新增，才能取得題目的id做為選項的 subject_id值
 */

//  判斷主題是否存在
 if(isset($_POST['subject'])){
    // 新增主題資料
    $Que->save(['text'=>$_POST['subject'],
                'subject_id'=>0,
                'vote'=>0]);
    // 使用max()找到剛剛新增的主題的id
    $subject_id=$Que->max('id');
 }

// 判斷選項是否存在
if(isset($_POST['option'])){
    // 使用迴圈來巡訪 $_POST['option'] 陣列
    foreach($_POST['option'] as $option){
        // 新增選項資料
        $Que->save(['text'=>$option,
                    'subject_id'=>$subject_id,
                    'vote'=>0]);
    }
}

to("../back.php?do=que");


?>