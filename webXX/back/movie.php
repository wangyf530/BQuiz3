<button onclick="location.href='?do=add_movie'">新增電影</button>

<hr>
<div style=" height:425px; overflow:auto;">
    <?php
    $rows = $Movie->all(" order by rank");
    foreach($rows as $idx => $row):
        $prev = ($idx!=0)?$rows[$idx-1]['id']:$row['id'];
        $next = ($idx!=(count($rows)-1))?$rows[$idx+1]['id']:$row['id'];
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
                <button class="show" data-id="<?=$row['id'];?>">
                    <?= ($row['sh']==1)?'隱藏':'顯示';?>
                </button>
                <button class="sw" data-id="<?=$row['id'];?>" data-sw="<?=$prev;?>">往上</button>
                <button class="sw" data-id="<?=$row['id'];?>" data-sw="<?=$next;?>">往下</button>
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
$(".sw").on("click", function() {
    let id = $(this).data('id');
    let sw = $(this).data('sw');
    $.post("./api/sw.php", {table: "Movie", id, sw}, () => {
        location.reload();
    })
})

$(".show").on("click", function() {
    let id = $(this).data('id');
    $.post("./api/show.php",{id},()=>{
        location.reload();
    })
})

$(".del").on("click", function() {
    let id = $(this).data('id');
    $.post("./api/del.php",{table:'Movie', id},()=>{
        location.reload();
    })
})
</script>