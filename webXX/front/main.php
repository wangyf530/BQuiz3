<style>
/* 清空所有邊框 */
.poster-block * {
    margin: 0;
    padding: 0;
    font-size: 12px;
    box-sizing: border-box;
}

/* 左半邊總體大小 */
.poster-block {
    width: 420px;
    height: 400px;
}

/* 放預告片的上半部 */
.lists {
    width: 210px;
    height: 280px;
    margin: auto;
    position: relative;
    /* background:white; */
}

/* 所有預告片 默認隱藏*/
.poster {
    position: absolute;
    display: none;
    text-align: center;
}

.poster img {
    display: block;
    width: 210px;
    height: 250px;
}

.poster span {
    font-size: 18px;
}

/* 下半部控制區域 */
.controls {
    width: 100%;
    height: 100px;
    margin: 10px auto;
    /* background:blue; */
    display: flex;
    align-items: center;
    justify-content: space-around;
}

/* 畫三角形 因為只有左右所以上下先寫好 */
.left,
.right {
    width: 0;
    border-top: 15px solid transparent;
    border-bottom: 15px solid transparent;
}

/* 左右三角形 */
.left {
    border-right: 25px solid #eee;
    border-left: 0;
}

.right {
    border-left: 25px solid #eee;
    border-right: 0;
}

/* 中間放索略圖 */
.icons {
    width: 320px;
    display: flex;
    overflow: hidden;
    position: relative;
}

/* 每一個縮圖 */
.icon {
    width: 80px;
    height: 100px;
    flex-shrink: 0;
    text-align: center;
    position: relative;
}

.icon img {
    width: 70px;
    height: 80px;
}

.icon div {
    font-size: 12px;

}

/* 放院線片清單 */
.movie-item {
    width: 49%;
    height: 150px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin: 0.25%;
    display: flex;
    flex-wrap: wrap;
    padding: 3px;
    box-sizing: border-box;
    font-size: 14px;
    align-content: center;
}
</style>

<!-- 從index移動過來的 -->
<div class="half" style="vertical-align:top;">
    <h1>預告片介紹</h1>
    <div class="rb tab" style="width:95%;">
        <div class="poster-block">

            <!-- 上方預告片 -->
            <div class="lists">
                <?php
            $posters=$Poster->all(['sh'=>1], " ORDER BY rank");
            foreach($posters as $idx => $poster):
            ?>
                <div class="poster" data-ani='<?=$poster['ani'];?>'>
                    <img src="./upload/<?=$poster['img'];?>" alt="" width=''>
                    <span><?=$poster['name'];?></span>
                </div>
                <?php endforeach ?>
            </div>

            <!-- 下方控制 -->
            <div class="controls">
                <!-- 左箭頭 -->
                <div class="left"></div>
                <!-- 中間顯示縮略圖 -->
                <div class='icons'>
                    <?php foreach($posters as $idx => $poster): ?>
                    <div class="icon">
                        <img src="./upload/<?=$poster['img'];?>" alt="">
                        <div class=""> <?=$poster['name'];?> </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- 右箭頭 -->
                <div class="right"></div>
            </div>
        </div>
    </div>
</div>

<script>
$(".poster").eq(0).show();

// 沒有let的話就停不了
let slider = setInterval(() => {sliders();}, 2500);

// 輪播
function sliders(next=-1) {
    now = $(".poster:visible").index();
    // 默認-1 從頭開始輪播
    if(next==-1){
        next = ($(".poster").length == now + 1) ? 0 : now + 1;
    }
    let ani = $(".poster").eq(next).data('ani');

    // console.log(now, next,ani)

    switch (ani) {
        case 1:
            // 淡入淡出
            $(".poster").eq(now).fadeOut(1000,function(){
                $(".poster").eq(next).fadeIn(1000);
            });
            break;
        case 2:
            // 縮放
            $(".poster").eq(now).hide(1000,function(){
                $(".poster").eq(next).show(1000);
            });
            break;
        case 3:
            // 滑入滑出
            $(".poster").eq(now).slideUp(1000,function(){

                $(".poster").eq(next).slideDown(1000);
            });
            break;
    }
}

let total = $(".icon").length;
let p = 0;
// console.log('total',total);

$(".left,.right").on("click",function(){
    if($(this).hasClass('left')){
        /*if(p-1>0){
            p--;
        } else {
            p = total-1;
        } */
    //    最後就是0不會出現負數(空白)
        p=(p-1>=0)?p-1:0;
    } else {
        /*if(p+1<total-4){
            p++;
        } else {
            p=0;
        }*/
       p=(p+1<=total-4)?p+1:total-4;
    }
    // console.log('p=',p);
    
    $(".icon").animate({right:p*80});
})
// 滑鼠移入移出的時候會停止輪播跟繼續動畫
$(".icons").hover(
    function(){
        clearInterval(slider);
    },
    function(){
        slider = setInterval(() => {sliders();}, 2500);
    }

)
// 點擊小圖會切換大圖
$(".icon").on("click",function(){
    let next = $(this).index();
    sliders(next);
})
</script>

<div class="half">
    <h1>院線片清單</h1>
    <?php
    // 上映時間在三天內的
    // 要:顯示的 + 上映時間小於等於今天的 + 上映時間大於兩天前的電影
    $today = date("Y-m-d");
    $ondate = date("Y-m-d",strtotime("-2 days"));
    $all = $Movie->count(['sh'=>1]," AND ondate BETWEEN '$ondate' AND '$today'");

    $div = 4;
    $pages = ceil($all/$div);
    $now = $_GET['p']??1;
    $start = ($now - 1)* $div;

    $rows = $Movie->all(['sh'=>1]," AND ondate BETWEEN '$ondate' AND '$today' ORDER BY rank limit $start, $div")
    ?>
    <div class="rb tab" style="width:95%;">
        <div style="display:flex; flex-wrap:wrap;">
            <?php
            foreach ($rows as $row):
            ?>
            <div class='movie-item'>
                <div style='width:65px;'>
                    <a href="?do=intro&id=<?=$row['id'];?>">
                        <img src="./upload/<?=$row['poster'];?>" style="width:60px;height:80px;">
                    </a>
                </div>
                <div style="width:calc(100% - 65px);">
                    <div><?=$row['name'];?></div>
                    <div>分級：
                        <img src="./icon/03C0<?=$row['level'];?>.png" alt="" style='width:20px;'>
                        <?=$Movie::$level[$row['level']];?>

                    </div>
                    <div>上映日期：<?=$row['ondate'];?></div>
                </div>
                <div style="width:100%;" class="ct">
                    <button onclick="location.href='?do=intro&id=<?=$row['id'];?>'">劇情簡介</button>
                    <button onclick="location.href='?do=order&id=<?=$row['id'];?>'">線上訂票</button>
                </div>
            </div>
            <?php
            endforeach;
            ?>
        </div>
        <div class="ct a">
            <?php 
            if(($now-1)>0){
                echo "<a href='?p=".($now-1)."' > < </a>";
            }

            for($i=1;$i<=$pages;$i++){
                $fontsize=($i==$now)?'24px':'18px';
                echo "<a href='?p=$i' style='font-size:$fontsize'>$i</a>";
            }

            if(($now+1)<=$pages){
                echo "<a href='?p=".($now+1)."' > > </a>";
            }
            ?>
        </div>
    </div>
</div>