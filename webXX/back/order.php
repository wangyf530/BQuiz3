<h1 class="ct">訂單清單</h1>
<div style="margin-top:10px;">
    快速刪除：
    <input type="radio" name="type" value="date" checked>
    依日期
    <input type="text" name="date" id="date">

    <input type="radio" name="type" value="movie">
    依電影
    <select type="text" name="movie" id="movie">
        <?php
            $movies = q("SELECT `movie` from `orders` GROUP BY `movie`");
            foreach ($movies as $movie) {
                echo "<option value='{$movie['movie']}'>";
                echo $movie['movie'];
                echo "</option>";
            }
        ?>
    </select>
    <button onclick="qdel()">刪除</button>
</div>

<style>
.header {
    display: flex;
    background: #ccc;
    margin: 10px 0;
    padding: 5px 0;
}

.header div {
    width: 14.2%;
    text-align: center;
}
</style>

<div class="header">
    <div>訂單編號</div>
    <div>電影名稱</div>
    <div>觀看日期</div>
    <div>場次時間</div>
    <div>訂購數量</div>
    <div>訂購位置</div>
    <div>操作</div>
</div>

<div style="overflow:auto; height:300px">
    <?php
        $orders = $Order->all( " ORDER BY no DESC");
        foreach($orders as $order):
    ?>
    <div style="display:flex; align-items:center;">
        <div style="width:14.2%;"><?=$order['no'];?></div>
        <div style="width:14.2%;"><?=$order['movie'];?></div>
        <div style="width:14.2%;"><?=$order['date'];?></div>
        <div style="width:14.2%;"><?=$order['session'];?></div>
        <div style="width:14.2%;"><?=$order['qt'];?></div>
        <div style="width:14.2%;">
            <?php
            $seats = unserialize($order['seats']);
            foreach ($seats as $seat) {
                echo floor($seat/5)+1 . "排" . ($seat%5)+1 . "號 <br>";
            }
            ?>
        </div>
        <div style="width:14.2%;text-align:center;">
            <button onclick="del(<?=$order['id'];?>)">刪除</button>
        </div>
    </div>
    <hr>
    <?php endforeach; ?>
</div>

<script>
let confirm = "確定要刪除所有符合條件的訂單嗎？";
function del(id){
    if(confirm(confirm)){
        $.post("api/del.php",{table:'Order',id},function(){
            location.reload();
        })
    }
}
function qdel() {
    let type = $("input[name='type']:checked").val();
    let data = "";
    switch (type) {
        case "date":
            if($("#date").val()==''){
                alert("請選擇日期");
                return;
            } else {
                data = $("#date").val();
                break;
            }

        case "movie":
            if ($("#movie").val()==''){
                alert("請選擇電影");
                return;
            } else {
                data = $("#movie").val();
                break;
            }
    }
    
    if(confirm(confirm)){
        $.post("api/qdel.php",{type,data},function(){
            location.reload();
        })
    }
}
</script>