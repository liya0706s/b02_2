<?php
// 根據網址參數id取得主題資料
// 從front/que.php 我要投票的a連結
// <a href="?do=result&id={$que['id']}"></a>

$que = $Que->find($_GET['id']);
?>
<fieldset>
    <legend>目前位置 : 首頁 > 問卷調查 > <?= $que['text']; ?></legend>
    <h3><?= $que['text']; ?></h3>

    <?php
    $opts = $Que->all(['subject_id' => $_GET['id']]);
    foreach ($opts as $opt) {
        $total = ($que['vote'] != 0) ? $que['vote'] : 1;
        $rate = round($opt['vote'] / $total,2);
    ?>
    <p>
    <div style="width:95%; display: flex; align-items:center">
        <div style="width: 50%"> <?= $opt['text']; ?> </div>
        <div style="width:<?=(40*$rate);?>%; background:#aaa; height: 20px;"></div>
        <div style="width: 10%">
                <?=$opt['vote'];?>票(<?=round($rate*100);?>%)
        </div>
    </div>
    </p>
    <?php } ?>
    <div class="ct">
        <button onclick="location.href='?do=que'">返回</button>
    </div>
</fieldset>