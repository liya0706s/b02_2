<fieldset>
    <legend>目前位置 : 首頁 > 最新文章</legend>
    <table>
        <tr>
            <th>標題</th>
            <th>內容</th>
            <th></th>
        </tr>
        <!-- 分頁又來囉 -->
        <?php
        // 算總共有幾筆要顯示的最新文章
$total=$News->count(['sh'=>1]);
$div=5;
$pages=ceil($total/$div);
// 目前的頁碼數字是分頁GET傳值的數字，不存在的話就是1
$now=$_GET['p']??1;
// 每一頁的第一個, 例如現在在第二頁, (2-1)*5=5
$start=($now-1)*$div;

// 最新文章取得所有，其中有顯示的限制從每頁的開始算起取5筆
$rows=$News->all(['sh'=>1], " limit $start, $div");
foreach($rows as $row){
?>
<tr>
    <td>
        <div class="title" data-id="<?= $row['id'] ;?>" style="cursor:pointer">
            <?=$row['title'];?>
        </div>
    </td>
    <td>
        <div id="s<?=$row['id'];?>">
            <!-- 部分文章內容，中文字從第零個字取25個字 -->
            <?=mb_substr($row['news'],0,25);?>...
        </div>
        <div id="a<?=$row['id'];?>" style="display:none">
            <?=$row['news'];?>
        </div>
    </td>
    <td></td>
</tr>
<?php
}
?>
    </table>

<div>    
<?php
// 目前頁數減掉一頁大於零代表可以上一頁
if(($now-1)>0){
    $prev=$now-1;
    echo "<a href='?do=news&p=$prev'> < </a>";
}
// 設定變數i從一開始跑，每次跑一圈，不能超過總頁數 
for($i=1;$i<=$pages;$i++){
    $fontsize=($i==$now)?'font-size:20px':'font-size:18px';
    echo "<a href='?do=news&p=$i' style='$fontsize'> $i </a>";
}
if(($now+1)>=$pages){
    $next=$now+1;
    echo "<a href='?do=news&p=$next'> > </a>";
}
?>
</div>
</fieldset>