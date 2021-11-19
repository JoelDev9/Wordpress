<?php
class Admin {
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

	function add( $table, $data = array() ) {
		$op	= false;
		if( !empty($data) ){
			
			foreach($data as $f => $v) {
				$fields[] = $f;
				$values[] = $v;
			}
			$insertq = "INSERT INTO `$table` (". implode(', ',$fields) .") VALUES ('	". implode('\', \'',$values) ."')";
			echo $insertq;
			$op = $this->_conn->query($insertq);
		}
		return $op;
	}

	function delete( $table, $id = false ) {
		$op	= false;
		if($id) {
			$delete = "DELETE FROM $table WHERE `id` = $id";
			$op = mysqli_query($this->_conn,$delete);
		} else {
			echo 'ID not given.';
		}
		return $op;
	}
	
	function htmlvalidation($form_data){
		//$form_data = trim( stripslashes( htmlspecialchars( $form_data ) ) );
		//$form_data = mysqli_real_escape_string($this->_conn, trim(strip_tags($form_data)));
		return $form_data;
	}

	function edit( $table, $data = array(),$id = false ) {
		$op	= false;
		if($id) {
			if( !empty($data) ){
				foreach($data as $field => $values) {
					$field = $this->htmlvalidation($field);
					$values = $this->htmlvalidation($values);
					$field = $field;
					$values = addslashes($values);
					$update[] = "`$field` = '$values'";
				}

				$updateq = "UPDATE `$table` SET " . implode(', ',$update);
				if(is_numeric($id)) {
					$updateq .= " WHERE id = $id";
				} else {
					$updateq .= " WHERE `id` = `$id`";
				}

				$op = mysqli_query($this->_conn,$updateq);
				if($op) {
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
		return $op;
	}


	function get2($id = false ) {
		$op	= false;
		
		$select = "SELECT question.*, step.*, sub_question.*, question.id as id, sub_question.id as sub_q_id, step.id as step_q_id FROM question INNER JOIN step ON question.step_id = step.id LEFT JOIN sub_question ON question.sub_quesion_id = sub_question.id where question.status = 1";
		if($id) {
			if(is_numeric($id)) {
				$select .= " AND question.id = $id";
			} else {
				$select .= " AND question.id = `$id`";
			}
		}
	}

	function get3( $table, $id = false ) {
		$op	= false;
		$select = "SELECT * FROM $table";
		if($id) {
			if(is_numeric($id)) {
				$select .= " WHERE id = $id";
			} else {
				$select .= " WHERE `id` = `$id`";
			}
		}
		
		$result = $this->_conn->query($select);
		if($result) {
			while($entry = mysqli_fetch_assoc($result)) {
				$op[] = $entry;
			}
		}
		return $op;
	}


	function get_participant( $table, $id = false ) {
		$participants	= false;
		$select = "SELECT * FROM $table ";
		if($id) {
			if(is_numeric($id)) {
				$select .= " WHERE participant_id = $id ORDER BY participant_id ASC";
			} else {
				$select .= " WHERE `participant_id` = `$id` ORDER BY participant_id ASC";
			}
		}else{
			$select .= " ORDER BY id ASC";
		}
		$result = $this->_conn->query($select);
		if($result) {

			while($row = mysqli_fetch_assoc($result)) {

			}
		}
		
		return $result;
		
	}

	function get_email_template(){
		$email_temp = $this->get3('email_template');
		
		$html = '';		
		if(!empty($email_temp)) {
			
			foreach ($email_temp as $email) {
				$html .= '<input type="hidden" name="id" value="'.$email['id'].'"><div class="email_template">'
									// .'<label>Name<br>'
									// 	.'<input type="text" name="subject" value="'.$email['name'].'"><br>'
									// .'</label>'
									// .'<br>'
									.'<label>Subject<br>'
										.'<input type="text" name="subject" value="'.$email['subject'].'"><br>'
									.'</label>'
									.'<br>'
									.'<label>Message<br>'
										.'<textarea name="message">'.$email['message'].'</textarea><br>'
									.'</label>'
									.'<br>'
									.'<label>Header<br>'
										.'<input type="text" name="header" value="'.$email['header'].'"><br>'
									.'</label>'
									.'<br>'
									.'<label>Footer<br>'
										.'<input type="text" name="footer" value="'.$email['footer'].'"><br>'
									.'</label>'
								.'</div>';
			}
		}

		return $html;
	}


	function get_participant_list(){
		$qts = $this->get_participant('participant');
	
		if(!empty($qts)) {

			$html = '';		
			$html .= '	<table class="uitablerecords" id="participant">
			<thead> 
				<tr>
					<th hidden>ID</th>
					<th>Name</th>
					<th>STI(s)</th>
					<th>Partner Name(s)</th>
					<th>Partner Email(s)</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				';
				
				
			foreach ($qts as $q) {
				//print_r($q);
				$filter=json_decode($q['sti']);
				$fname = array();
				$email_add = array();
				$qts2 = $this->get_participant('person_information', $q['id']);

				
				foreach ($qts2 as $q2) {
					//print_r($q2);
					if($q2['first_name']){
						$fname[] = $q2['first_name'];
					}
					if($q2['email_address']){
						$email_add[] = $q2['email_address'];
					}
					
				}
				
				$comma_separated = ($filter != null) ? implode(", ", $filter) : '';
				$fname = ($fname != null) ? implode(",", $fname) : '';
				$email_add = ($email_add != null) ? implode(", ", $email_add) : '';

				$html .= "<tr>";
				$html .= '<td hidden>'.$q['id'].'</td>';
				$html .= '<td>'.$q['name'].'</td>';
				$html .= '<td>'.$comma_separated.'</td>';	
				$html .= '<td>'.$fname.'</td>';	
				$html .= '<td>'.$email_add.'</td>';	
				$html .= '<td>'.$q['status'].'</td>';
				$html .= '<td><a href="participant.php?task=delete_participant&id='. $q['id'] .'" class="btn btn-sm"><span class="glyphicon glyphicon-trash">delete</span></button>
					<a href="participant.php?task=view_participant&id='. $q['id'] .'" class="btn btn-sm" ><span class="glyphicon glyphicon-edit">view</span></button>
												</td>';
			}
		}
		return $html;
	}




	function get_all_questions($edit = false) {
		$qts = $this->get3('question', 2);
		$html = '<ol class="questions">';
		// 		print_r($qts);
		// die();
		if(!empty($qts)) {
			foreach ($qts as $q) {
				$html .= '<li class="active">'
						.'<div class="question">'. $q['title'] .'</div>';


				$options = json_decode($q['options']);
				$q_input = json_decode($q['question_input']);
				if(!empty($q['question_input'])){
					foreach ($q_input as $key2 => $question_input) {
						if(!empty($q_input)) {
							$html .= '<div class="test">'
									.'<label>'
										.'<input type="text" name="q_id['. $q['id'] .']" value=""><br>'
									.'</label>'
								.'</div>';
						}
					}

				}
				
				if(!empty($options)) {
					foreach ($options as $key => $option) {
						if(!empty($option)) {

							$html .= '<div class="options">'
										.'<label>'
											.'<input type="radio" name="q_id['. $q['id'] .']" value="'. $key .'">'. $option
										.'</label>'
									.'</div>';
						}
					}
				}
				if($edit) {
					$html .='<div class="actions"><a href="questionnaire.php?task=edit&id='. $q['id'] .'" class="button">Edit</a></div>';
				}
				$html .= '</li>';
			}
		}
		//die();
		$html .= '</ol>';
		return $html;
	}

	function process($task = 'empty', $participant_id = null) {
		$op = false;
		switch($task) {
			case "get_participant" :
					echo $this->get_participant_list();
				break;
			case "manage_questionnaire" :
					echo $this->get_all_questions(true);
				break;
			case "get_email_template" :
					echo $this->get_email_template();

				break;
			case "save":
					$data = $_POST;
					$data['options'] = json_encode($data['options']);
					if(isset($data['id']) && $data['id']=='new'){
						unset($data['id']);
						$this->add('question', $data);
						} else {
						$this->edit('question', $data, $data['id']);
					}
					header('location:questionnaire.php');
				break;
			case "edit":
				$qts = $this->get2($_GET['id']);
				foreach ($qts as $question) {
					$question['options'] = json_decode($question['options']);
					$question['question_input'] = json_decode($question['question_input']);
					include "../admin/edit_questionnaire.php";
				}
				break;
			case 'delete_participant' :
					echo $task;
					$this->delete('participant',$_GET['id']);
					header('location:participant.php');
				break;
			case 'view_participant' :
					$participants = $this->get3('participant',$_GET['id']);
					foreach ($participants as $data) {
						$data['participant'] = $data;
						$filter=json_decode($data['sti']);
						$persons_info = $this->get_participant('person_information',$data['id']);
						$fname = array();
						$email_add = array();
						$comma_separated = ($filter != null) ? implode(", ", $filter) : '';
						foreach ($persons_info as $info) {
							$fname[] = $info['first_name'];
							$email_add[] = $info['email_address'];
						}
						include "../admin/view_participant.php";
					}
				break;
			case "update_email_template":
				$data = $_POST;
					if(isset($data['id']) && $data['id']=='new'){
						unset($data['id']);
					} else {
						$this->edit('email_template', $data, $data['id']);

					}
					header('location:email_template.php');
				break;
			default:
				echo "Undefined Action";
		}
		return $op;
	}



}
