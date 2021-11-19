<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require "config/MyDB.php";
require "inc/PartnerNotification.php";
$partner_notification = new PartnerNotification();
	session_start();
  	
	// include "inc/header.php";
	 session_regenerate_id();
	// define variables and set to empty values
	$first_name_err = $email_address_err = "";
	$first_name = $email_address = $participant_id = "";


	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  if (empty($_POST["first_name"])) {
	    $first_name_err = "";
	  } else {
	    $first_name = $_POST["first_name"];
	  }
	  
	  if (empty($_POST["email_address"])) {
	    $email_address_err = "";
	  } else {
	    $email_address = $_POST["email_address"];
	  } 

	  if (empty($_POST["participant_id"])) {
	    $participant_id = "";
	  } else {
	    $participant_id = filter_html($_POST["participant_id"]);
	  } 
	}

		$data = $partner_notification->get_participant();

		$number = count($_POST["first_name"]);  
		if($data){
			//$delete = $connection->query("DELETE FROM person_information WHERE participant_id = '".$participant_id."'");
			$delete = $partner_notification->delete_participant($participant_id);
			if($number > 0){  
		      	for($i=0; $i<$number; $i++)  {  
		           if(trim($first_name[$i] != '')){ 
		                //$participant = $connection->query("INSERT INTO `person_information`(`participant_id`,`first_name`, `email_address`) VALUES ('".filter_html($_POST["participant_id"])."','".$first_name[$i]."', '".$email_address[$i]."')");
		                	$insert = $partner_notification->add_person_info($participant_id, $first_name[$i], $email_address[$i]);
		                
		           }  
		      	}  
		     echo json_encode($_POST["participant_id"]);
			}
			
		}else{
			//$participant1 = $connection->query("INSERT INTO `participant`(`status`, `session_id`) VALUES ('pending', '".$_SESSION['id']."')");
			//$last_id = mysqli_insert_id($connection);
			$inserted_id = $partner_notification->add_participant($_SESSION['id']);
		//	echo json_encode($inserted_id);
			if($number > 0){  
		      	for($i=0; $i<$number; $i++)  {  
		           if(trim(filter_html($_POST["first_name"][$i]) != '')){  
		                //$participant = $connection->query("INSERT INTO `person_information`(`participant_id`,`first_name`, `email_address`) VALUES ('".$last_id."','".$first_name[$i]."', '".$email_address[$i]."')");
		           	$insert = $partner_notification->add_person_info($inserted_id, $first_name[$i], $email_address[$i]);
		           }  
		      	} 
		      	echo json_encode($inserted_id);
			}
		}

function filter_html($data) {
 // $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>