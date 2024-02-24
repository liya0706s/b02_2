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
    $total = $News->count(['sh' => 1]);
    $div = 5;
    $pages = ceil($total / $div);
    // 目前的頁碼數字是分頁GET傳值的數字，不存在的話就是1
    $now = $_GET['p'] ?? 1;
    // 每一頁的第一個, 例如現在在第二頁, (2-1)*5=5
    $start = ($now - 1) * $div;

    // 最新文章取得所有，其中有顯示的限制從每頁的開始算起取5筆
    $rows = $News->all(['sh' => 1], " limit $start, $div");
    foreach ($rows as $row) {
    ?>
      <tr>
        <td>
          <div class="title" data-id="<?= $row['id']; ?>" style="cursor:pointer">
            <?= $row['title']; ?>
          </div>
        </td>
        <td>
          <div id="s<?= $row['id']; ?>">
            <!-- 部分文章內容，中文字從第零個字取25個字 -->
            <?= mb_substr($row['news'], 0, 25); ?>...
          </div>
          <div id="a<?= $row['id']; ?>" style="display:none">
            <?= $row['news']; ?>
          </div>
        </td>
        <!-- 第三欄根據登入狀態，顯示可以按讚的程式 -->
        <td>
          <?php
          // 1. 是否有登入狀況
          if (isset($_SESSION['user'])) {
            // 2. 該筆文章是有目前登入的會員帳號，點選a連結就是要收回讚
            if ($Log->count(['news' => $row['id'], 'acc' => $_SESSION['user']]) > 0) {
              echo "<a href='Javascript:good({$row['id']})'>收回讚</a>";
            } else {
              // 該筆文章沒有目前登入會員帳號，點選a連結是要按讚
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
      echo "<a href='?do=news&p=$prev'> < </a>";
    }
    // 設定變數i從一開始跑，每次跑一圈，不能超過總頁數 
    for ($i = 1; $i <= $pages; $i++) {
      $fontsize = ($i == $now) ? 'font-size:20px' : 'font-size:18px';
      echo "<a href='?do=news&p=$i' style='$fontsize'> $i </a>";
    }
    if (($now + 1) >= $pages) {
      $next = $now + 1;
      echo "<a href='?do=news&p=$next'> > </a>";
    }
    ?>
  </div>
</fieldset>

<!-- 點擊文章標題，控制顯示部分和全部文章內容的js -->
<script>
  // 1. 對class title進行點擊事件註冊
  $(".title").on('click', (e) => {
    // 2. 點擊對象用.data('id')方法來獲得data-id屬性的值, 取得點擊的id
    let id = $(e.target).data('id');

    // 3. 對id為s+id, a+id的元素進行toggle()來切換顯示與隱藏
    $(`#s${id},#a${id}`).toggle();
  })

  // 這裡的變數news是 文章id--$row['id']
  function good(news) {
    $.post("./api/good.php", {
      news
    }, () => {
      location.reload();
    })
  }
</script>