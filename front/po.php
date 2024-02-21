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
    // 註冊class type-item的點擊事件
    $(".type-item").on('click',function(){
        // 取出點擊的文字，並放入導航列中
        $(".type").text($(this).text())
        // 點擊同時取得分類項目的代號
        let type=$(this).data('type')
        getList(type)

        // 先載入type=1的文章列表
        getList(1);

    })

    function getList(type){
        $.get("./api/get_list.php".{type},(list ))
    }
</script>