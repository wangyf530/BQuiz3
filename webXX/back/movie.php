<button onclick="location.href='?do=add_movie'">新增電影</button>

<hr>
<div style=" height:425px; overflow:auto;">
    <?php
    $rows = $Movie->all(" order by rank");
    foreach($rows as $row):
?>
    <div style="display:flex; flex-direction:row; justify-content:space-between; text-align:center;">
        <!-- img -->
        <div style="width:10%">
            <img src="./upload/<?=$row['poster'];?>" alt="<?=$row['name'];?>" style="width:80px; height:100px;">
        </div>
        <!-- level -->
        <div style="width:10%">
            分級：<img src="./icon/03C0<?=$row['level'];?>.png" alt="<?=$row['level'];?>">
        </div>
        <!-- description -->
        <div style="width:80%">
            <!-- movie intro -->
            <div style="display:flex; justify-content:space-between;">
                <!-- movie name -->
                <div>片名：<?=$row['name'];?></div>
                <!-- movie length -->
                <div>片長：<?=$row['length'];?></div>
                <!-- movie date -->
                <div>上映時間：<?=$row['ondate'];?></div>
            </div>
            <!-- buttons -->
            <div>
                <button data-id="<?=$row['id'];?>">隱藏</button>
                <button data-id="<?=$row['id'];?>">往上</button>
                <button data-id="<?=$row['id'];?>">往下</button>
                <button onclick="location.href='?do=edit_move&id=<?=$row['id'];?>'">編輯電影</button>
                <button class="del" data-id="<?=$row['id'];?>">刪除電影</button>
            </div>
            <!-- text -->
            <div>
                劇情介紹：<?=nl2br($row['intro']);?>
            </div>
        </div>
    </div>
    <hr>
    <?php endforeach; ?>
</div>

<script>
$(.del).on("click",function(){
    let id = $(this).date('id');
    
    location.reload();
})
</script>