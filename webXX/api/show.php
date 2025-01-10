<?php include_once "db.php";

$row = $Movie->find($_POST['id']);
/**
 * if ($row['sh']==1) {
 *     $row['sh']=0;
 * } else {
 *     $row['sh']=1;
 * }
 */

 /**
  * $row['sh']=($row['sh']==1)?0:1;
  */

$row['sh']=($row['sh']+1)%2;

$Movie->save($row);