<?php
function db_conn() {
    if(!isset($db)) {
        require_once ('connect.php');
    }
    return $db;
}
function getArray($query){
    global $db;
    $arr   = array();
    $q     = mysqli_query($db, $query);
    if (mysqli_num_rows($q) > 0) {
        while ($list = mysqli_fetch_assoc($q)) {
            $arr[] = $list;
        }
    }
    return $arr;
}

function getRow($query){
    global $db;
    $arr   = array();
    $q     = mysqli_query($db, $query);

    if (mysqli_num_rows($q) > 0) {
        $arr = mysqli_fetch_assoc($q);
    }

    return $arr;
}