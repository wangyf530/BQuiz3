<?php include_once "db.php";

// 從main.php 撈出院線片清單的程式碼 去掉分頁所需的code 還有limit部分
$today = date("Y-m-d");
$ondate = date("Y-m-d",strtotime("-2 days"));
$rows = $Movie->all(['sh'=>1]," AND ondate BETWEEN '$ondate' AND '$today' ORDER BY rank");

foreach ($rows as $row) {
    echo "<option value='{$row['id']}'>";
    echo $row['name'];
    echo "</option>";
    
}