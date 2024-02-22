<!-- 建立後台文章列表 及 分頁連結 -->
<form action="./api/edit_news.php" method="post">
    <table style="text-align:center">
        <tr>
            <td>編號</td>
            <td>標題</td>
            <td>顯示</td>
            <td>刪除</td>
        </tr>

        <!-- 製作分頁 -->
        <?php
        $total = $News->count();
        $div = 3;
        $pages = ceil($total / $div);
        $now = $_GET['p'] ?? 1;
        $start = ($now - 1) * $div;
        // 限制從某一頁$start開始取3筆
        $rows = $News->all(" limit $start,$div");
        // 迴圈開始取資料
        foreach ($rows as $idx => $row) {
        ?>
            <tr>
                <td><?=$idx+1+$start;?></td>
                <td><?=$row['title'];?></td>
                <!-- 用sh欄位代表顯示, 判斷勾選與否 -->
                <td>
                    <input type="checkbox" name="sh[]" value="<?=$row['id'];?>" <?=($row['sh']==1)?'checked':'';?>>
                </td>
                <td>
                    <input type="checkbox" name="del[]" value="<?=$row['id'];?>">
                    <input type="hidden" name="id[]" value="<?=$row['id'];?>">
                </td>
            </tr>
        <?php
        }
        ?>
        </table>
</form>
