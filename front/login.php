<fieldset>
    <legend>會員登入</legend>
    <table>
        <tr>
            <td>帳號</td>
            <td>
                <input type="text" name="acc" id="acc">
            </td>
        </tr>
        <tr>
            <td>密碼</td>
            <td><input type="password" name="pw" id="pw"></td>
        </tr>
        <tr>
            <td>
                <input type="button" value="登入" onclick="login()">
                <input type="button" value="清除" onclick="clean()">            
            </td>
            <td>
                <a href="?do=forget">忘記密碼</a> |
                <a href="?do=reg">尚未註冊</a>
            </td>
        </tr>
    </table>
</fieldset>
<!-- <a href="../api/chk_acc.php"></a> -->
<!-- 不準阿，這是include在index.php的檔案，不能這樣看TT -->

<script>
    function login(){
        // 取得帳號密碼輸入框的值
        let acc=$("#acc").val()
        let pw=$("#pw").val()
        // 發送 POST 請求到chk_acc.php 檢查帳號是否存在
        $.post('./api/chk_acc.php', {acc}, (res)=>{
            // parseInt()將字串轉為整數。如果回傳的結果為0，表示登入帳號錯誤
            if(parseInt(res)==0){
                alert("查無帳號")
            }else{
                // 發送POST請求到chk_pw.php 檢查帳號密碼是否正確
                $.post('./api/chk_pw.php',{acc,pw},(res)=>{
                    // 用console.log(res)來查看js程式的訊息
                    // console.log(res);
                    // 如果回傳的結果為1, 表示帳號 密碼正確
                    if(parseInt(res)==1){
                        // 且帳號是'admin', 導向後台頁面
                        if($("#acc").val()=='admin'){
                            location.href='back.php'
                        }else{
                            // 帳密正確但是帳號不是admin, 導向前台
                            location.href='index.php'
                        }
                    }else{
                        // 帳號正確但是密碼錯誤
                        alert("密碼錯誤")
                    }
                })
            }
        })
    }
</script>