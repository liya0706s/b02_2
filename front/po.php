<!-- 建立一麵包屑區塊，用來顯示當前的文章類別 -->
<div class="nav">
    目前位置 : 首頁 > 分類網誌 > <span class="type">健康新知</span>
</div>
<!-- 建立分類項目區塊，其中data-type為設定分類編號，和資料表中的type欄位一致 -->
<fieldset class="types">
    <legend>分類網誌</legend>
    <a class="type-item" data-type="1">健康新知</a>
    <a class="type-item" data-type="2">菸害防治</a>
    <a class="type-item" data-type="3">癌症防治</a>
    <a class="type-item" data-type="4">慢性病防治</a>
</fieldset>

<fieldset class="news-list">
    <legend>文章列表</legend>
    <!-- 放文章標題列表 -->
    <div class="list-items" style="display:none"></div>
    <!-- 放文章內容 -->
    <div class="article"></div>
</fieldset>

<script>
    // init 
    getList(1)
    
    // 分類網誌中的a連結點選會牽動，文章列表(type)的不同
    // 註冊class type-item的點擊事件
    $(".type-item").on('click', function() {
        // 取出點擊的文字，並放入導航列中
        $(".type").text($(this).text())
        // 點擊同時取得分類項目的代號
        let type = $(this).data('type')

        // 執行取得分類文章列表函式
        getList(type)

    })

    // 取得分類列表函式
    function getList(type) {
        $.get("./api/get_list.php", {
            type
        }, (list) => {
            // 返回的數據儲存在名為list的變數中
            $(".list-items").html(list)
            // 將class list-items的元素(放置文章標題列表)內的html內容，更新為list變數中的html內容
            $(".article").hide();
            $(".list-items").show();
        })
    }

    // 建立取得單一文章內容函式
    function getNews(id) {
        $.get("./api/get_news.php", {
            id
        }, (news) => {
            $(".article").html(news)
            $(".article").show();
            $(".list-items").hide();
        })
    }
</script>