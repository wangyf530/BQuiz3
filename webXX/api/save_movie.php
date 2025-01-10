<?php
include_once "db.php";

if(!empty($_FILES['trailer']['tmp_name'])){
    move_uploaded_file($_FILES['trailer']['tmp_name'], "../upload/{$_FILES['trailer']['name']}");
    $_POST['trailer']=$_FILES['trailer']['name'];
}

if(!empty($_FILES['poster']['tmp_name'])){
    move_uploaded_file($_FILES['poster']['tmp_name'], "../upload/{$_FILES['poster']['name']}");
    $_POST['poster']=$_FILES['poster']['name'];
}

$_POST['ondate'] = $_POST['year'] . "-" . $_POST['month'] . "-" . $_POST['day'];
unset($_POST['year'], $_POST['month'], $_POST['day']);

// 如果沒有帶入id進來就是要新增
if(!isset($_POST['id'])){
    $_POST['sh']=1;
    $_POST['rank']=$Movie->max('id')+1;
}

// save會自己判斷是新增還是修改
$Movie->save($_POST);

to("../back.php?do=movie");
// dd($_POST);