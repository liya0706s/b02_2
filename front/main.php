<style>
    /* 使用flex屬性讓容器中的tag元件併成一個橫列 */
    .tags{
        display: flex;
        margin-left: 1px;
    }
    /* 設定每個標籤的外型和排列 */
    /* 利用margin: -1px讓標籤檢籤的邊緣合成一條線 */
    .tag{
        /* 寬度 */
        width: 100px;
        /* 內距 */
        padding: 5px 10px;
        border:1px solid black;
        /* 內距往左-1px讓重覆的線減少 */
        margin-left: -1px;
        border-radius: 5px 5px 0 0;
        text-align: center;
        background-color: #ccc;
        cursor:pointer;
    }

    /* 設定文章區塊的外型 */
    article section{
        border:1px solid black;
        border-radius: 0 5px 5px 5px;
        min-height:480px;
        margin-top:-1px;
        /* 只有顯示第一部分的section標籤 */
        display: none;
        padding:15px;
    }

    /* 設定啟用中的頁籤的css樣式 */
    .active{
        border-bottom:1px solid white;
        background-color: white;
    }
</style>
<!-- 頁籤 -->
<div class="tags">
<!-- 每個頁籤都會加上secXX的id -->
<div id="sec01" class="tag active">健康新知</div>
<div id="sec02" class="tag">菸害防制</div>
<div id="sec03" class="tag">癌症防治</div>
<div id="sec04" class="tag">慢性病防治</div>
</div>

<!-- 文章 -->
<article>
<section id="section01" style="display:block">
<h2>健康新知</h2>
<pre>

</pre>

<section id="section02">
<h2>菸害防制</h2>
<pre>
    
</pre>

<section id="section03">
<h2>癌症防治</h2>
<pre>
    
</pre>

<section id="section04">
<h2>慢性病防治</h2>
<pre>
    
</pre>
</article>