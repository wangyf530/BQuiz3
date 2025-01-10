<style>
    .form{
        width: 95%;
        margin:auto;
        display:flex;
    }

    .form div:nth-child(1){
        width:20%;
        padding:5px;
        text-align-last:justify;
    }

    .form div:nth-child(2){
        width:80%;
        padding:5px;
    }

    .main{
        width:70%; 
        margin:auto;
        display:flex;
    }

    .left{
        width: 15%;
    }

    .right{
        width: 85%;
    }

</style>

<?php
$row = $Movie->find($_GET['id']);
?>

<form action="./api/save_movie.php" method="post" enctype="multipart/form-data">
<div class='main'>
    <div class='left'>影片資料</div>
    <div class="right">
        <div class="form">
            <div>片名</div>：
            <div>
                <input type="text" name="name" id="" value="<?=$row['name'];?>">
            </div>
        </div>
        <div class="form">
            <div>分級</div>：
            <div>
                <select name="level" id="">
                    <option value="1" <?=$row['level']==1?'selected':'';?>>普通級</option>
                    <option value="2" <?=$row['level']==2?'selected':'';?>>輔導級</option>
                    <option value="3" <?=$row['level']==3?'selected':'';?>>保護級</option>
                    <option value="4" <?=$row['level']==4?'selected':'';?>>限制級</option>
                </select>
            </div>
        </div>
        <div class="form">
            <div>片長</div>：
            <div>
                <input type="number" name="" id=""  value="<?=$row['length'];?>">
            </div>
        </div>
        <div class="form">
            <div>上映日期</div>：
            <?php
            list($year,$month,$day) = explode("-", $row['ondate']);
            ?>
            <div>
                <select name="year" id="" >
                    <option value="2025" <?=($year==2025)?'selected':'';?>>2025</option>
                    <option value="2026" <?=($year==2026)?'selected':'';?>>2026</option>
                </select>年
                <select name="month" id="">
                    <?php
                    for ($i=1; $i<=12; $i++) { 
                        $selected = ($i==$month)?'selected':'';
                        echo "<option value='$i' $selected>$i</option>";
                    }
                    ?>
                </select>月
                <select name="day" id="">
                <?php
                    for ($i=1; $i<=31; $i++) { 
                        $selected = ($i==$day)?'selected':'';
                        echo "<option value='$i' $selected>$i</option>";
                    }
                    ?>
                </select>日
            </div>
        </div>
        <div class="form">
            <div>發行商</div>：
            <div>
                <input type="text" name="publish" id="" value="<?=$row['publish'];?>">
            </div>
        </div>
        <div class="form">
            <div>導演</div>：
            <div>
                <input type="text" name="director" id="" value="<?=$row['director'];?>">
            </div>
        </div>
        <div class="form">
            <div>預告影片</div>：
            <div>
                <input type="file" name="trailer" id="">
            </div>
        </div>
        <div class="form">
            <div>電影海報</div>：
            <div>
                <input type="file" name="poster" id="">
            </div>
        </div>
    </div>
</div>
<div class='main'>
    <div class='left'>劇情簡介</div>
    <div class='right'>
        <textarea name="intro" id="" value="<?=ln2br($row['intro']);?>" style='width:99%'></textarea>
    </div>
</div>

<input type="hidden" name="id" value="<?=$row['id'];?>">

<div class="ct">
    <input type="submit" value="編輯">
    <input type="reset" value="重置">
</div>
</form>