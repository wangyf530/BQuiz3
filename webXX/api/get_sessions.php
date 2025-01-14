<?php include_once "db.php";

$movie=$Movie->find($_GET['movie']);
$date = $_GET['date'];

$sess=[
    '1' =>"14:00~16:00",
    '2' =>"16:00~18:00",
    '3' =>"18:00~20:00",
    '4' =>"20:00~22:00",
    '5' =>"22:00~24:00"
];
$today = strtotime(date("Y-m-d"));
// 不補零的小時
$now= date("G")-13;
$start = ($now>0)?ceil($now/2)+1:1;

$seats = 20;
/*
if $now < 14{
    $list = 1;
} elseif ($now < 16){
    $list = 2;
} elseif ($now < 18) {
    $list = 3;
} elseif ($now < 20) {
    $list = 4;
} elseif ($now < 22){
    $list = 5;
}
*/

/**
 * 'G'      -13     $i
 * 0-13     <=0     1
 * 14       1       2
 * 15       2       2
 * 16       3       3
 * 17       4       3
 * 18       5       4
 * 19       6       4
 * 20       7       5
 * 21       8       5
 * 22-23    >=9     x
 */

//  算訂單

for($i=$start; $i<=5; $i++) {
    $booked = $Order->sum('qt',[
        'movie'=>$movie['name'],
        'date'=>$date,
        'session'=>$sess[$i]
    ]);
    echo $booked;
    $seats = 20-$booked;
    // 如果選取日期是今天 要看時間
    // 如果選區日期是今天以後 都可以
    echo "<option value='{$sess[$i]}'>";
    echo $sess[$i];
    echo " 剩餘座位 $seats";
    echo "</option>";
    
}