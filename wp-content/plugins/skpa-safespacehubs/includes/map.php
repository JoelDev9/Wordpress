<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require "../config/MyDB.php";
include_once('GoogleMaps.php');
$map = new GoogleMaps();
if(isset($_POST['category']) && !empty(trim($_POST['category'])) || isset($_POST['region']) && !empty(trim($_POST['region'])) || isset($_POST['province']) && !empty(trim($_POST['province'])) || isset($_POST['municipality']) && !empty(trim($_POST['municipality']))){
  $category = $map->htmlvalidation($_POST['category']);
  $region = $map->htmlvalidation($_POST['region']);
  $province = $map->htmlvalidation($_POST['province']);
  $municipality = $map->htmlvalidation($_POST['municipality']);
  if($category){
    $match_field_like['category'] = $category;  
  }
  if($region){
    $match_field['region_id'] = $region;
  }
  if($province){
    $match_field['province_id'] = $province;
  }
  if($municipality){
    $match_field['city_id'] = $municipality;
  }
  $get_loc = $map->search("establishment", $match_field, $match_field_like,"AND");
}
else{
  $get_loc = $map->select("establishment");
}

$get_geo_location= '';

if(isset($_POST['region']) && !empty(trim($_POST['region']))){
  $get_geo_location = $map->get_geo_location("region", $_POST['region']);
}

$get_geo_location = json_encode($get_geo_location);
$location = json_encode($get_loc);
?>

<div id="map"></div>
<script>
var gmarkers1 = [];
var markers1 = [];
var infowindow = new google.maps.InfoWindow({
    content: ''
});

var customIcons = {
  hubs: {
    icon: 'img/png/hubs.png'
  },
  pep: {
    icon: 'img/png/pep.png'
  },
  prep: {
    icon: 'img/png/prep.png'
  },
  treatment: {
    icon: 'img/png/treatment.png'
  }
};

markers1 = <?= $location?>;
geo_loc = <?= $get_geo_location?>;
function initialize() {
  var center = new google.maps.LatLng(14.581548344925007, 120.97919225692749);
  var zoom = 10;
  if (geo_loc) {
    center= new google.maps.LatLng(geo_loc[0]['latitude'], geo_loc[0]['longitude']);
  }

  if($('#region').val() == ''){
    zoom = 5;
  }
  
  var mapOptions = {
      zoom: zoom,
      center: center,
      disableDefaultUI: false,
      mapTypeId: google.maps.MapTypeId.TERRAIN
  };

  map = new google.maps.Map(document.getElementById('map'), mapOptions);
  for (i = 0; i < markers1.length; i++) {
      addMarker(markers1[i]);
  }
}


function addMarker(marker) {
  console.log(marker);
  if(marker.category){
    cat = JSON.parse(marker.category);
    var category = '';
    $.each(cat, function(x,y){
      category += '<span id="category_info" class="'+y+'">&emsp;</span>';
      type = y;
       
    });
    cat_dropdown = $('#category').val();
    if(cat_dropdown){
      type = cat_dropdown;
    }
  
  }
  var nature = marker.nature;
  var title = marker.name;
  var region = marker.region_name;
  var province = marker.province_name;
  var municipality = marker.municipality_name;
  var address = marker.address;
  type = type.replace(/\s+/g, "_").replace(/\//g, '').replace(/,/g, '');
  console.log(type);
  var icon = customIcons[type] || {};
  console.log(icon);
  var pos = new google.maps.LatLng(marker.latitude, marker.longitude);
  var content = marker.name;

  marker1 = new google.maps.Marker({
      title: title,
      position: pos,
      nature: nature,
      region: region,
      province: province,
      municipality: municipality,
      map: map,
      icon: {url:icon.icon, scaledSize: new google.maps.Size(30, 30)}
  });
  marker1.content = '<div class="infoWindowContent"><span>ESTABLISHMENT CATEGORY</span><div>'+category+'</div></div><div class="infoWindowContent"><span>ESTABLISHMENT NATURE</span><h6>' + nature + '</h6></div><div class="infoWindowContent"><span>ADDRESS</span><h6>' + marker.address + '</h6></div><div class="infoWindowContent"><span>CONTACT NUMBER</span><h6>' + marker.contact_number  + '<h6></div><div class="infoWindowContent"><span>SOCIAL MEDIA PAGE / WEBSITE</span><h6>' + marker.page_website + '<h6></div>';
  gmarkers1.push(marker1);

  google.maps.event.addListener(marker1, 'click', (function (marker1, content) {
      return function () {
          infowindow.setContent('<div class="marker-title"><span>ESTABLISHMENT NAME</span><h3>' + marker1.title + '</h3></div>' + marker1.content);
          infowindow.open(map, marker1);
          map.panTo(this.getPosition());
          map.setZoom(13);
      }
  })(marker1, content));
  
  google.maps.event.addListener(infowindow, "closeclick", function() {
    map.setZoom(10);
  });

}
initialize();
</script>