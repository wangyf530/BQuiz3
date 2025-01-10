<?php
include_once "db.php";

if($_FILES['trailer']['error']==0){
    move_uploaded_file($_FILES['trailer']['tmp_name'], "../upload/{$_FILES['trailer']['name']}");
    $_POST['trailer']=$_FILES['trailer']['name'];
} else {
    unset($_POST['trailer']);
}

if($_FILES['poster']['error']==0){
    move_uploaded_file($_FILES['poster']['tmp_name'], "../upload/{$_FILES['poster']['name']}");
    $_POST['poster']=$_FILES['poster']['name'];
} else {
    unset($_POST['poster']);
}

$_POST['ondate'] = $_POST['year'] . "-" . $_POST['month'] . "-" . $_POST['day'];
unset($_POST['year'], $_POST['month'], $_POST['day']);

// 是否顯示跟排序不需要更改
/*
$_POST['sh']=1;
$_POST['rank']= $Movie->Max('id')+1;
*/

$Movie->save($_POST);

to("../back.php?do=movie");
// dd($_POST);