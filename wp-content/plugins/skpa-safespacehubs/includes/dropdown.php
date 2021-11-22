<?php

include_once('config.php');
$map = new GoogleMaps();

if(isset($_POST['region_id']) && !empty(trim($_POST['region_id']))){
    $region_id = $map->htmlvalidation($_POST['region_id']);
    $select = $map->select("province","region_id", $region_id);
    echo json_encode($select);
}

if(isset($_POST['province_id']) && !empty(trim($_POST['province_id']))){
    $province_id = $map->htmlvalidation($_POST['province_id']);
    $select = $map->select("city","province_id", $province_id);
    echo json_encode($select);
}

?>

