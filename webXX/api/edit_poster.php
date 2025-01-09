<?php
include_once "db.php";

if(isset($_POST['id'])){
    foreach ($_POST['id'] as $idx => $id) {
        // 是否有被勾選的delete 且查看該id是否存在
        if(isset($_POST['del']) && in_array($id, $_POST['del'])){
            $Poster->del($id);
        // edit(save)
        } else {
            $row = $Poster->find($id);
            $row['name'] = $_POST['name'][$idx];
            $row['ani'] = $_POST['ani'][$idx];
            // 先看sh是否存在 id是否在裡面(判斷是否要顯示)
            $row['sh'] = (isset($_POST['sh']) && in_array($id, $_POST['sh'])?1:0);
            $Poster->save($row);
        }
    }
}

// dd($_POST);
to("../back.php?do=poster");
?>