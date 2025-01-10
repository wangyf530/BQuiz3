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

<form action="./api/save_movie.php" method="post" enctype="multipart/form-data">
<div class='main'>
    <div class='left'>影片資料</div>
    <div class="right">
        <div class="form">
            <div>片名</div>：
            <div>
                <input type="text" name="name" id="" required>
            </div>
        </div>
        <div class="form">
            <div>分級</div>：
            <div>
                <select name="level" id="" required>
                    <option value="1">普通級</option>
                    <option value="2">輔導級</option>
                    <option value="3">保護級</option>
                    <option value="4">限制級</option>
                </select>
            </div>
        </div>
        <div class="form">
            <div>片長</div>：
            <div>
                <input type="number" name="length" id="" required>
            </div>
        </div>
        <div class="form">
            <div>上映日期</div>：
            <div>
                <select name="year" id="" placeholder='2025' required>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                </select>年
                <select name="month" id="" placeholder='1' required>
                    <?php
                    for ($i=1; $i<=12; $i++) { 
                        echo "<option value='$i'>$i</option>";
                    }
                    ?>
                </select>月
                <select name="day" id="" placeholder='1' required>
                <?php
                    for ($i=1; $i<=31; $i++) { 
                        echo "<option value='$i'>$i</option>";
                    }
                    ?>
                </select>日
            </div>
        </div>
        <div class="form">
            <div>發行商</div>：
            <div>
                <input type="text" name="publish" id="" required>
            </div>
        </div>
        <div class="form">
            <div>導演</div>：
            <div>
                <input type="text" name="director" id="" required>
            </div>
        </div>
        <div class="form">
            <div>預告影片</div>：
            <div>
                <input type="file" name="trailer" id="" required>
            </div>
        </div>
        <div class="form">
            <div>電影海報</div>：
            <div>
                <input type="file" name="poster" id="" required>
            </div>
        </div>
    </div>
</div>
<div class='main'>
    <div class='left'>劇情簡介</div>
    <div class='right'>
        <textarea name="intro" id="" style='width:99%'></textarea>
    </div>
</div>

<div class="ct">
    <input type="submit" value="新增">
    <input type="reset" value="重置">
</div>
</form>