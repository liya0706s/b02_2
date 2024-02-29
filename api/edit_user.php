<?php
include_once "db.php";
// dd($_POST['del']);
// 從../back.php?do=admin傳POST來要刪除的del[] 
if(isset($_POST['del'])){
    foreach($_POST['del'] as $id){
        dd($id);
        $User->del($id);
    }
}
to("../back.php?do=admin");

?>
<!-- <a href="../back.php"></a> -->