<!-- 處理最新文章編輯表單傳過來的資料 -->
<!-- 有顯示和刪除兩個input -->
<?php
include_once "db.php";

// 檢查是否有設定 $_POST['id']
if (isset($_POST['id'])) {
    // 用迴圈來巡訪 $_POST['id']陣列
    foreach ($_POST['id'] as $id) {
        // 檢查是否有設定$_POST['del'] 且 $id是在 $_POST['del']陣列中
        if (isset($_POST['del']) && in_array($id, $_POST['del'])) {
            // 呼叫 News 物件的 del() 方法刪除新聞
            $News->del($id);
        } else {
            // 取得指定id的新聞資料
            $news = $News->find($id);
            // 檢查是否有設定 $_POST['sh'] 且 $id在$_POST['sh'] 陣列中
            // 若是則將$news['sh']設為1, 否則設為0
            $news['sh'] = (isset($_POST['sh']) && in_array($id, $_POST['sh'])) ? 1 : 0;
            // 呼叫 News 物件的 save() 方法儲存新聞資料
            $News->save($news);
        }
    }
}

to("../back.php?do=news");



?>