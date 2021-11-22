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


	function get_establishment( $table, $id = false ) {
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


	function get_establishment_list(){
		$establishment = $this->get_establishment('establishment');
	
		if(!empty($establishment)) {

			$html = '';		
			$html .= '<div style="overflow-x: scroll;"><table class="uitablerecords" id="establishment">
			<thead> 
				<tr>
					<th hidden>ID</th>
					<th>Name</th>
					<th>Address</th>
					<th>Contact Number(s)</th>
					<th>Latitude</th>
					<th>Logitude</th>
					<th>Nature</th>
					<th style="width: 40px;">Category</th>
					<th>Page Website</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				';
				
				
			foreach ($establishment as $data) {
				//print_r($q);
				 $filter=json_decode($data['category']);
				// $fname = array();
				// $email_add = array();
				// $qts2 = $this->get_participant('person_information', $q['id']);

				
				// foreach ($qts2 as $q2) {
				// 	//print_r($q2);
				// 	if($q2['first_name']){
				// 		$fname[] = $q2['first_name'];
				// 	}
				// 	if($q2['email_address']){
				// 		$email_add[] = $q2['email_address'];
				// 	}
					
				// }
				
				 $comma_separated = ($filter != null) ? implode(", ", $filter) : '';
				 $status = ($data['status'] == 1) ? 'Published' : 'Unpublished';
				// $email_add = ($email_add != null) ? implode(", ", $email_add) : '';

				$html .= "<tr>";
				$html .= '<td hidden>'.$data['id'].'</td>';
				$html .= '<td>'.$data['name'].'</td>';
				$html .= '<td>'.$data['address'].'</td>';	
				$html .= '<td>'.$data['contact_number'].'</td>';	
				$html .= '<td>'.$data['latitude'].'</td>';	
				$html .= '<td>'.$data['longitude'].'</td>';
				$html .= '<td>'.$data['nature'].'</td>';
				$html .= '<td>'.$comma_separated.'</td>';
				$html .= '<td>'.$status.'</td>';
				$html .= '<td style="width: 40px;">'.$this->set_char_limit($data['page_website']).'</td>';
				$html .= '<td><a href="establishment.php?task=delete_establishment&id='. $data['id'] .'" class="btn btn-sm"><span class="glyphicon glyphicon-trash">delete</span></button>
					<a href="establishment.php?task=update_establishment&id='. $data['id'] .'" class="btn btn-sm" ><span class="glyphicon glyphicon-edit">update</span></button>
												</td></div>';
			}
		}
		return $html;
	}

    function set_char_limit($str){
	if (strlen($str) > 10)
	   $str = substr($str, 0, 7) . '...';
		return $str; 
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
			case "get_establishment" :
					echo $this->get_establishment_list();
				break;
			case "get_category" :
					echo $this->get_all_questions(true);
				break;
			case "get_email_template" :
					echo $this->get_email_template();

				break;
			case "save_category":
					$data = $_POST;
					//$data['category'] = json_encode($data['category']);
					// print_r($data);
					// die();
					if(isset($data['id']) && $data['id']=='new'){
						unset($data['id']);
						$this->add('category', $data);
						} else {
						$this->edit('category', $data, $data['id']);
					}
					header('location:category.php');
				break;
			case "edit":
				$qts = $this->get2($_GET['id']);
				foreach ($qts as $question) {
					$question['options'] = json_decode($question['options']);
					$question['question_input'] = json_decode($question['question_input']);
					include "../admin/edit_category.php";
				}
				break;
			case "add_new_establishment":
				$question = false;
				$categories = $this->get3('category');
				$category_list = array();
				$category_list_not_selected = array();
				foreach ($categories as $name) {
					$category_list[] = $name['short_name'];
					$category_list_not_selected[] = $name['name'];
				}
				$cat['category'] = $category_list;
				$selected_cat['category'] = $category_list_not_selected;
				include "../admin/form_establishment.php";
				break;
			case "save_establishment":
					$data = $_POST;
					$data['category'] = json_encode($data['category']);
					// print_r($data);
					// die();
					if(isset($data['id']) && $data['id']=='new'){
						unset($data['id']);
						$this->add('establishment', $data);
						} else {
						$this->edit('establishment', $data, $data['id']);
					}
					header('location:establishment.php');
				break;
			case 'delete_establishment' :
					echo $task;
					$this->delete('establishment',$_GET['id']);
					header('location:establishment.php');
				break;
			case 'update_establishment' :
					$participants = $this->get3('establishment',$_GET['id']);
					$categories = $this->get3('category');
					$category_list = array();
					foreach ($categories as $name) {
						$category_list[] = $name['short_name'];
					}
					foreach ($participants as $data) {
						$data['establishment'] = $data;
						$selected_cat['category'] = json_decode($data['category']);
						$cat['category'] = $category_list;
						$filter=json_decode($data['category']);
						$comma_separated = ($filter != null) ? implode(", ", $filter) : '';
						include "../admin/form_establishment.php";
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
