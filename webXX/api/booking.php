<style>
    #info{
        width: 540px;
        height: 370px;
        margin:auto;
        background-image:url("./icon/03D04.png");
        background-position:center;
        background-repeat:no-repeat;
        padding:19px 110px 10px 110px;

        display:flex;
        flex-wrap:wrap;
        flex-direction:row;
    }

    #movieInfo{
        width: 540px;
        height: 120px;
        margin:auto;
        background:#ccc;
        padding:10px 100px;
    }

    .seat{
        width: 63px;
        height: 83px;
        text-align: center;
    }

    .seat:nth-child(even){
        background:lightblue;
    }
</style>

<?php include_once "db.php";?>

<div id="info">
<?php
for ($i=1; $i <= 4; $i++):
    for($j=1; $j<=5; $j++):
?>
<div class="seat">
    <?php echo $i."排". $j."號";?>
</div>
<?php endfor;
endfor; ?>
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


