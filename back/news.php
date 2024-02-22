<!-- 建立 最新文章後臺管理 及 分頁連結 -->
<form action="./api/edit_news.php" method="post">
    <table style="width:100%;text-align:center">
        <tr>
            <td>編號</td>
            <td style="width:60%">標題</td>
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
                <td><?= $idx + 1 + $start; ?></td>
                <td><?= $row['title']; ?></td>
                <!-- 用sh欄位代表顯示, 判斷勾選與否 -->
                <td>
                    <input type="checkbox" name="sh[]" value="<?= $row['id']; ?>" <?= ($row['sh'] == 1) ? 'checked' : ''; ?>>
                </td>
                <td>
                    <!-- 傳到api/edit_news.php會是$_POST['del'] -->
                    <input type="checkbox" name="del[]" value="<?= $row['id']; ?>">
                    <input type="hidden" name="id[]" value="<?= $row['id']; ?>">
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
    <div class="ct">
        <?php
        // 現在頁數減一大於零代表還有上一頁
        if ($now - 1 > 0) {
            $prev = $now - 1;
            echo "<a href='back.php?do=news&p=$prev'> < </a>";
        }
        // 設定變數i從一開始跑，每次跑一圈，不能超過總頁數
        for ($i = 1; $i <= $pages; $i++) {
            // 設定字型尺寸，目前頁數比較大
            $size = ($i == $now) ? 'font-size:22px;' : 'font-size:16px';
            echo "<a href='back.php?do=news&p=$i' style='$size'> $i </a>";
        }
        // 現在的頁數加一小於等於總頁數，代表還有下一頁
        if ($now + 1 <= $pages) {
            $next = $now + 1;
            echo "<a href='back.php?do=news&p=$next'> > </a>";
        }
        ?>
    </div>
    <div class="ct"><input type="submit" value="修改確定"></div>
</form>