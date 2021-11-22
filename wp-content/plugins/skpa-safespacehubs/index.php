<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'includes/header.php';
include_once('includes/GoogleMaps.php');
$map = new GoogleMaps();
$select_category = $map->get_dropdown("category", "id, short_name, color_code, name");
$category_dropdown = json_encode($select_category);
$region_dropdown = json_encode($map->get_dropdown("region", "id, name"));

?>

<body>
	<div class="filter-container">
		<p class="filter-title font-weight-bold">Facility Filter</p>
		<select id="category">
			<option value="">All Categories</option>
		</select>
		<hr>
		<select id="region">
			<option value="">All Regions</option>
		</select>
		<br>
		<select id="province">
			<option value="">All Provinces</option>
		</select>
		<br>
		<select id="municipality">
			<option value="">All Municipalities</option>
		</select>
		<hr>
		<div class="legend">
			<p class="legend-title">Legend</p>
			<ul>
				<?php
					foreach($select_category as $key => $value){
						echo "<li><span class='dot-nav ".$value['short_name']."'>&nbsp&nbsp;&nbsp;</span>&nbsp;" .$value['name']. "</li>";
					}
				?>
			</ul>
		</div>
	</div>
	
	<div class="container-fluid">
			<div class="" id="map">
			</div>
	</div>
	

<script type="text/javascript">
	var category_dropdown = <?= $category_dropdown?>;
	var region_dropdown = <?= $region_dropdown?>;

	$(document).ready(function (){
	$('#map').load('includes/map.php');
	$('select').on('change', function (){
		var category = $('#category').val();
		var region = $('#region').val();
		var province = $('#province').val();
		var municipality = $('#municipality').val();
		$('#map').load('includes/map.php', {category:category, region:region, province:province, municipality:municipality});
	});
	getCategory();
	getRegion();

});

function getCategory() {
  var opt = '<option value>All Categories</option>';
  $.each(category_dropdown, function( key, value ) {
      opt += '<option value="' + value.short_name + '">' + value.name + '</option>';
     $('#category').html(opt);
  });
}

function getRegion() {
  var opt = '<option value>All Regions</option>';
  $.each(region_dropdown, function( key, value ) {
      opt += '<option value="' + value.id + '">' + value.name + '</option>';
     $('#region').html(opt);
  });
}

	$('#region').on('change', function (){
		$('#province option:not(:first)').remove();
		$('#municipality option:not(:first)').remove();
		if($(this).val() !== ""){
			var opt = '<option value>All Provinces</option>';
			$.ajax({
				type: "POST",
				url: "dropdown.php",
				data:'region_id='+ $('#region').val(),
				success: function(data){
					data = JSON.parse(data);
				 	$.each(data, function( key, value ) {
			      opt += '<option value="' + value.id + '">' + value.name + '</option>';
			     	$('#province').html(opt);
			  	});
				}
			});				 
		}
	});

	$('#province').on('change', function (){
		$('#municipality option:not(:first)').remove();
		if($(this).val() !== ""){
			var opt = '<option value>All Municipalities</option>';
			$.ajax({
				type: "POST",
				url: "dropdown.php",
				data:'province_id='+ $('#province').val(),
				success: function(data){
					data = JSON.parse(data);
				  $.each(data, function( key, value ) {
			      opt += '<option value="' + value.id + '">' + value.name + '</option>';
			    	$('#municipality').html(opt);
			  	});
				}
			});
		}
	});
</script>
<?php include "includes/footer.php"; ?>