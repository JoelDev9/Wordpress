<?php
//session_start();
class PartnerNotification {
	protected $_conn;

	public function __construct() {
	    $db = new MyDB();
	    $this->_conn = $db->connect();
	}
	
	function query( $q ) {
		$op	= false;
		$result =  mysqli_query($q);
		if($result) {
			while($entry = mysqli_fetch_assoc($result)) {
				$op[] = $entry;
			}
		}
		return $op;
	}
	
	function get() {
		$op	= false;

		$select = "SELECT * FROM question INNER JOIN step ON question.step_id = step.id LEFT JOIN sub_question ON question.sub_quesion_id = sub_question.id where question.status = 1";

		$result = $this->_conn->query($select);
		if($result) {
			while($entry = mysqli_fetch_assoc($result)) {
				$op[] = $entry;
			}
		}
		return $op;
	}

	function get_message() {
		$message = false;

		$select = "SELECT * FROM message";

		$result = $this->_conn->query($select);
		if($result) {
			while($mes = mysqli_fetch_assoc($result)) {
				$message[] = $mes;
			}
		}
		
		if(!empty($message)) {
			foreach ($message as $key => $mes) {
					return "<p>".$mes['message']."</p>";
			}
		}
	}


	function get_participant() {
		//print_r();
		$participants = false;

		$select = "SELECT id, session_id FROM participant WHERE session_id = '".$_SESSION['id']."'";

		$result = $this->_conn->query($select);
		if($result) {
			while($participant = mysqli_fetch_assoc($result)) {
				$participants[] = $participant;
			}
		}

	//	print_r($select);
		return $participants;
	}

	function get_data($table, $field, $value) {
		//print_r();
		$details = false;

		$select = "SELECT * FROM $table where $field = '".$value."'";

		$result = $this->_conn->query($select);
		if($result) {
			while($info = mysqli_fetch_assoc($result)) {
				$details[] = $info;
			}
		}

		return $details;
	}

	function add_person_info($participant_id, $first_name, $email_address) {
		$success	= false;
		if( !empty($participant_id) ){

			$insertq = "INSERT INTO `person_information`(`participant_id`,`first_name`, `email_address`) VALUES ('".$participant_id."','".$first_name."', '".$email_address."')";
	
			$success = $this->_conn->query($insertq);
		}
		return $success;
	}


	function add_participant($session_id) {
		$participant_id	= false;
		if( !empty($session_id) ){

			$insertq = "INSERT INTO `participant`(`status`, `session_id`) VALUES ('pending', '".$session_id."')";
				 //echo $insertq.'eto';
				$success = $this->_conn->query($insertq);
				$participant_id = mysqli_insert_id($this->_conn);

			
		}
		return $participant_id;
	}

	function delete_participant($participant_id) {
		//print_r();
		$success = false;
		if($participant_id) {
			$delete = "DELETE FROM person_information WHERE participant_id = '".$participant_id."'";
			$success = mysqli_query($this->_conn,$delete);
		} else {
			echo 'ID not given.';
		}

		return $success;
	}

	function update_participant($field,$value, $session_id) {
		$update	= false;
		if($session_id) {
			if( !empty($value) ){
				$updateq = "UPDATE participant SET $field = '".$value."' WHERE session_id = '".$session_id."'";
	

				$update = mysqli_query($this->_conn,$updateq);
				if($update) {
					echo "Data Updated";
				} else {
					echo "Data Updated failed :(" .$updateq;
				}
			} else {
				echo 'Data not set';
			}
		} else {
			echo 'ID not given.';
		}
		return $update;
	}

	function get_all_questionnaire() {
		$qts = $this->get();
		$html = '';

		if(!empty($qts)) {

			foreach ($qts as $q) {

				$options = json_decode($q['options']);
				$input_type = json_decode($q['question_input']);
				$input_radio = json_decode($q['question_radio']);
				$sub_input_type = json_decode($q['sub_input']);
				
				$active = $q['step_id'] == 1 ? 'active' : '';
				//$task = $q['step_id'] == 1 ? 'add_participant' : 'update_participant';
				$html .= '<ul class="'.$active.' step-'.$q['step_id'].'">
						  <div class="steps-container step-'.$q['step_id'].' listing">
						  <form id="step_'.$q['step_id'].'_form" class="questions">
						  <h2 class="container-title">'.$q['name'].'</h2>
      					  <p>'.$q['description'].'</p>';
						
				if(($q['step_id']) == 1){
					$html .= '<div class="form-holder title-container mb-3">
						        <h2 class="title-header font-weight-bold person">Person 1</h2>
						        <div class="d-inline-block s1">
						          <input type="button" class="btn btn-danger remove" name="remove" value="Remove this person" id="btn_remove">
						        </div>';
				}

				if(!empty($input_type)){
					foreach ($input_type as $key => $question_input) {
						if(!empty($input_type)) {
							$key++;
							
							$placeholder = $key == 1 ? 'Enter your name here' : 'Enter your email address here';
							$attribute = $key == 1 ? 'first_name' : 'email_address';
							$html .='<div><h4 class="font-weight-bold">'.$question_input.'</h4>';
							$html .= '<input type="text" placeholder="'.$placeholder.'" name="'.$attribute.'[]" class="'.$attribute.' input-data" id="'.$attribute.'" required/></div>';
						}
					}
				}

				if(($q['step_id']) == 1){
					$html .= '</div>
				      <div class="form-holder-append"></div>
				      <input type="button" name="addmore" class="btn btn-secondary" value="Add another person" id="add_more">
				      <input type="text" class="participant_id remove hide" name="participant_id" value="" id="participant_id">
				      <br>';
				}
				if(!empty($options)) {
					$multiple = '';
					if($q['is_multiple'] == 1){
						$multiple = 'multiple';
					}  
					$attribute = 'dd';
					$arr = '';
					if($q['class_name'] != ""){
						$attribute = $q['class_name'];
						$arr = "[]";
					}   
					$html .= '<select  name="'.$attribute.$arr.'" id="'.$attribute.'" required '.$multiple.'>';
					foreach ($options as $key2 => $option) {
						if(!empty($option)) {
							$key2++;
							$check = '';
							if($key2 == 1){
								$check = "selected";
							}
							$html .= '<option value="'.$option.'" '.$check.'>'.$option.'</option>';
						              
						}
					}
					$html .= '</select>';	
				}

				if(!empty($input_radio)){
					if($q['class_name'] != ""){
						$class_name = $q['class_name'];
					}
					foreach ($input_radio as $key3 => $radio) {
						if(!empty($radio)) {
							$check = '';
							$key3++;
							if($key3 == 1){
								$check = "checked";
							}
							$attribute = str_replace(' ', '_', strtolower($radio));
							$html .= '<div class="d-inline-block">';
							$html .= '<input type="radio"  name="'.$class_name.'" class="'.$attribute.'" id="'.$q['sub_class_name'].'_'.$key3.'" value="'.$radio.'" '.$check.'>';
							$html .= '<label class="label" for="'.$q['sub_class_name'].'_'.$key3.'">'.$radio.'</label><br>';
							$html .= '</div>';
						}
					}
				}
				if(!empty($q['sub_input'])){
					$html .= '<div class="title-container mt-3 '.$q['sub_class_name'].'">';
					$html .= '<h4 class="font-weight-bold">'.$q['sub_title'].'</h4>';
					foreach ($sub_input_type as $key4 => $sub_input) {
						if(!empty($sub_input)) {
							$attribute = str_replace(' ', '_', strtolower($sub_input));
							$html .= '<input type="text" placeholder="Enter your name here" name="'.$attribute.'" class="'.$attribute.'" id="'.$q['sub_class_name'].'"/>';
							}
					}
					$html .= '</div>';
				}

				$html .= '</form></div></ul>';
				$html .= '';
			}
		}
		$html .= '';
		return $html;
	}


	function process($task = 'empty', $participant_id = null) {
		$op = false;
		switch($task) {
			case "index":
				header("location:step1.php");
				break;
			case "get_all_questionnaire" :
					echo $this->get_all_questionnaire();
				break;
			case "get_message" :
					echo $this->get_message();
				break;
			// case "add_participant" :
			// 		$data = $_POST;
			// 		print_r($data);
			// 		die();
			// 		//echo $this->add_participant();
			// 	break;
			// case "update_participant" :
			// 		$data = $_POST;
			// 		//echo $this->add_participant();
			// 	break;
			default:
				echo "Undefined Action";
		}
		return $op;
	}



}
