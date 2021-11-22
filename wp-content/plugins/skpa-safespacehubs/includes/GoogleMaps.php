<?php 

class GoogleMaps{

	protected $_conn;

	public function __construct() {
	    $db = new MyDB();
	    $this->_conn = $db->connect();
	}


	public function htmlvalidation($form_data){
		$form_data = trim( stripslashes( htmlspecialchars( $form_data ) ) );
		$form_data = mysqli_real_escape_string($this->_conn, trim(strip_tags($form_data)));
		return $form_data;
	}

	public function select($tblname, $columnname = null ,$id = null){

		if($id){
			$select = "SELECT * FROM $tblname WHERE $columnname = '$id'";
		}else{

			$select = "SELECT e.id as id, e.name as name, e.address as address, e.contact_number as contact_number, e.category as category, e.latitude as latitude, e.longitude as longitude, e.nature as nature, e.page_website as page_website, region.name as region_name, region.id as region_id, region.latitude as reg_lat, region.longitude as reg_long, province.name as province_name, province.id as province_id, city.name as municipality_name, city.id as municipality_id FROM $tblname e INNER JOIN city ON e.city_id=city.id INNER JOIN province ON city.province_id=province.id INNER JOIN region ON province.region_id=region.id ";
		}

		$select_query = mysqli_query($this->_conn, $select);
		if(mysqli_num_rows($select_query) > 0){
			$select_fetch = mysqli_fetch_all($select_query, MYSQLI_ASSOC);
			if($select_fetch){
				return $select_fetch;
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
	}

	public function search($tblname,$search_val, $match_field_like, $op="AND"){

		$search = "";
		foreach($search_val as $s_key => $s_value){
			$search = $search."$s_key = '$s_value' $op ";
		}
		foreach($match_field_like as $s_key => $s_value){
			$search = $search."$s_key LIKE '%$s_value%' $op ";
		}
		$search = rtrim($search, "$op ");

		$search = "SELECT e.id as id, e.name as name, e.address as address, e.contact_number as contact_number, e.category as category, e.latitude as latitude, e.longitude as longitude, e.nature as nature, e.page_website as page_website, region.name as region_name, region.id as region_id, region.latitude as reg_lat, region.longitude as reg_long, province.name as province_name, province.id as province_id, city.name as municipality_name, city.id as municipality_id FROM $tblname e INNER JOIN city ON e.city_id=city.id INNER JOIN province ON city.province_id=province.id INNER JOIN region ON province.region_id=region.id WHERE $search";


		$search_query = mysqli_query($this->_conn, $search);
		if(mysqli_num_rows($search_query) > 0){
			$serch_fetch = mysqli_fetch_all($search_query, MYSQLI_ASSOC);
			return $serch_fetch;
		}
		else{
			return false;
		}
	}

	public function get_dropdown($tblname, $select, $groupby = null){
		$category = "SELECT $select FROM $tblname $groupby";
		$category_query = mysqli_query($this->_conn, $category);
		if(mysqli_num_rows($category_query) > 0){
			$category_fetch = mysqli_fetch_all($category_query, MYSQLI_ASSOC);
			return $category_fetch;
		}
		else{
			return false;
		}
	}	

	public function get_geo_location($tblname, $region_id){
		$category = "SELECT longitude, latitude FROM $tblname WHERE id = $region_id";
		$category_query = mysqli_query($this->_conn, $category);
		if(mysqli_num_rows($category_query) > 0){
			$category_fetch = mysqli_fetch_all($category_query, MYSQLI_ASSOC);
			return $category_fetch;
		}
		else{
			return false;
		}
	}	
}

?>
