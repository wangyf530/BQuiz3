<style>
    #info{
        width: 540px;
        height: 370px;
        margin:auto;
        background-image:url("./icon/03D04.png");
        background-position:center;
        background-repeat:no-repeat;
        padding:19px 110px 14px 110px;

        display:flex;
        flex-wrap:wrap;
    }

    #movieInfo{
        width: 540px;
        height: 120px;
        margin:auto;
        background:#ccc;
        padding:10px 100px;
    }

    .seat{
        width: 64px;
        height: 85px;
        text-align: center;
        padding:2px;
        position:relative;
    }
    
    .null{
        background:url("icon/03D02.png") center no-repeat;
    }
    .chk{
        position:absolute;
        text-align: center;
        right:2px;
        bottom:2px;
    }

    .seated{
        background:url("icon/03D03.png") center no-repeat;
    }
</style>

<?php include_once "db.php";?>

<div id="info">
<?php
for ($i=1; $i <=20; $i++):
?>
<div class="seat null seated">
    <span><?=floor($i/5)+1;?>排<?=($i%5+1);?>號</span>

    <input type="checkbox" class='chk' id="" value="<?=$i;?>">
</div>
<?php endfor;?>
</div>


<div id="movieInfo" class='ct'>
    <div>您選擇的電影是：<?= $_GET['name'] ;?></div>
    <div>您選擇的時刻是：<?= $_GET['date']."&nbsp;&nbsp;".$_GET['session'] ;?></div>
    <div>您已經勾選 <span id="tickets"></span> 張票，最多可以購買四張票</div>
    <div>
        <button onclick="$('#booking,#order').toggle()"
        >上一步</button>
        <button onclick="checkout()">訂購</button>
    </div>
</div>


