<!-- default -->
<?php
// 如果有帳號並且帳密正確
if(isset($_POST['acc'])){
    if($_POST['acc']=='admin' && $_POST['pw']=='1234'){
        $_SESSION['login']=1;
    } else {
        echo("帳號密碼錯誤");
    } 
}

// 如果沒登入 -> 登入畫面
if(!isset($_SESSION['login'])){
?>
<form action="" method="post">

    <table class="tab" style="width:500px;">
        <tr>
            <td>帳號：</td>
            <td>
                <input type="text" name="acc" id="acc">
            </td>
        </tr>
        <tr>
            <td>密碼：</td>
            <td>
                <input type="password" name="pw" id="pw">
            </td>
        </tr>
    </table>
    <div class="ct">
        <input type="submit" value="登入">
        <input type="reset" value="重置">
    </div>
    <script>
        location.href = 'back.php?do=login'
    </script>
<?php
    exit();
} else {
    ?>
<div class="rb tab">
    <h2 class="ct">請選擇所需功能</h2>
</div>
<?php 
} 
?>
</form>