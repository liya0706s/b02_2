<fieldset>
  <legend>目前位置 : 首頁 > 人氣文章</legend>
  <table>
    <tr>
      <th>標題</th>
      <th>內容</th>
      <th>人氣</th>
    </tr>

    <!-- 分頁又來囉 -->
    <?php
    // 算總共有幾筆要顯示的最新文章
    $total = $News->count(['sh' => 1]);
    $div = 5;
    $pages = ceil($total / $div);
    // 目前的頁碼數字是分頁GET傳值的數字，不存在的話就是1
    $now = $_GET['p'] ?? 1;
    // 每一頁的第一個, 例如現在在第二頁, (2-1)*5=5
    $start = ($now - 1) * $div;

    // 人氣文章取得所有，其中有顯示的，更改排序的方式，限制從每頁的開始算起取5筆
    $rows = $News->all(['sh' => 1], " order by `good` desc limit $start, $div");
    foreach ($rows as $row) {
    ?>

      <tr>
        <td>
          <div class="title" data-id="<?= $row['id']; ?>" style="cursor:pointer">
            <?= $row['title']; ?>
          </div>
        </td>

        <td>
          <div>
            <!-- 部分文章內容，中文字從第零個字取25個字 -->
            <?= mb_substr($row['news'], 0, 25); ?>...
          </div>
          <!-- hover過去會有的完整文章內容 -->
          <!-- class pop是彈出視窗的CSS, id=p+文章id是控制顯示隱藏 -->
          <div id="p<?= $row['id']; ?>" class="pop">
            <h4 style="color:skyblue;"><?= $row['title']; ?></h4>
            <pre><?= $row['news']; ?></pre>
          </div>
        </td>
        
        <!-- 第三欄根據登入狀態，顯示可以按讚的程式 -->
        <td>
          <span><?= $row['good']; ?></span>個人說
          <img src="./icon/02B03.jpg" style="width:25px;">
          <?php
          if (isset($_SESSION['user'])) {
            if ($Log->count(['news' => $row['id'], 'acc' => $_SESSION['user']]) > 0) {
              echo "<a href='Javascript:good({$row['id']})'>收回讚</a>";
            } else {
              echo "<a href='Javascript:good({$row['id']})'>讚</a>";
            }
          }
          ?>
        </td>
      </tr>
    <?php
    }
    ?>
  </table>

  <div>
    <?php
    // 目前頁數減掉一頁大於零代表可以上一頁
    if (($now - 1) > 0) {
      $prev = $now - 1;
      echo "<a href='?do=pop&p=$prev'> < </a>";
    }
    // 設定變數i從一開始跑，每次跑一圈，不能超過總頁數 
    for ($i = 1; $i <= $pages; $i++) {
      $fontsize = ($i == $now) ? 'font-size:20px' : 'font-size:18px';
      echo "<a href='?do=pop&p=$i' style='$fontsize'> $i </a>";
    }
    if (($now + 1) >= $pages) {
      $next = $now + 1;
      echo "<a href='?do=pop&p=$next'> > </a>";
    }
    ?>
  </div>
</fieldset>

<script>
  $(".title").hover(
    function() {
      $(".pop").hide()
      let id = $(this).data("id")
      $("#p" + id).show()
    }
  )

  // 1. 點擊事件改為hover
  // 2. 函式設定class pop 藏起來
  // 3. 用.data("id") 取得點擊的id
  // 4. 將對應的id前面加上#p 讓它顯示出來


  // good函數會控制讚數的按讚和收回，這裡的變數news是文章id--$row['id']
  function good(news) {
    $.post("./api/good.php", {news}, () => {
      location.reload();
    })
  }
</script>