<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require "config/MyDB.php";
require "inc/PartnerNotification.php";
$partner_notification = new PartnerNotification();
	session_start();
  	use PHPMailer\PHPMailer\PHPMailer;
  	use PHPMailer\PHPMailer\Exception;
  	require 'PHPMailer-master/src/Exception.php';
  	require 'PHPMailer-master/src/PHPMailer.php';
	require 'PHPMailer-master/src/SMTP.php';
	if(isset($_POST['sti'])){
		$sti = json_encode($_POST['sti']);
		$update = $partner_notification->update_participant('sti', $sti, $_SESSION['id']);
	}else{
		if(isset($_POST['full_name'])){
			
			$update = $partner_notification->update_participant('name', $_POST['full_name'], $_SESSION['id']);

			$person_info = $partner_notification->get_data('person_information', 'participant_id', $_POST['participant_id']);
			$sti_list = $partner_notification->get_data('participant', 'id', $_POST['participant_id']);
			foreach ($sti_list as $sti) {
				$sti_listing = implode(', ', json_decode($sti['sti']));
			}
			$from_email = '';
			$from_name = '';
			$email_password = '';
			$subject = '';
			$message = '';
			$header = '';
			$footer = '';
			$email_details = $partner_notification->get_data('email_template', 'id', 1);

			foreach ($email_details as $email_data) {
				$from_email = $email_data['from_email'];
				$from_name = $email_data['from_name'];
				$email_password = $email_data['email_password'];
				$subject = $email_data['subject'];
				$message = $email_data['message'];
				$header = $email_data['header'];
				$footer = $email_data['footer'];
			}

			$message = str_replace('{{sti}}', $sti_listing, $message);
			foreach ($person_info as $row) {
				$to = $row['email_address'];
				$first_name = $row['first_name'];
				$sender = $_POST['full_name'];
				$message = str_replace('{{name}}', $first_name, $message);
				$message_body = str_replace('{{sender}}', $sender, $message);
				$is_sent = send_email($to, $first_name, $message_body, $from_email, $from_name, $email_password, $subject);
				if($is_sent == 1){
					$update = $partner_notification->update_participant('status', 'complete', $_SESSION['id']);
					echo json_encode("Email sent successfully");
				}else{
					echo json_encode("Email not sent");
				}
				 session_regenerate_id();
			}
		 }else{
			$person_info = $partner_notification->get_data('person_information', 'participant_id', $_POST['participant_id']);
			$sti_list = $partner_notification->get_data('participant', 'id', $_POST['participant_id']);
			foreach ($sti_list as $sti) {
				$sti_listing = implode(', ', json_decode($sti['sti']));
			}
			$from_email = '';
			$from_name = '';
			$email_password = '';
			$subject = '';
			$message = '';
			$header = '';
			$footer = '';
			$email_details = $partner_notification->get_data('email_template', 'id', 1);

			foreach ($email_details as $email_data) {
				$from_email = $email_data['from_email'];
				$from_name = $email_data['from_name'];
				$email_password = $email_data['email_password'];
				$subject = $email_data['subject'];
				$message = $email_data['message'];
				$header = $email_data['header'];
				$footer = $email_data['footer'];
			}

			$message = str_replace('{{sti}}', $sti_listing, $message);
			foreach ($person_info as $row) {
				$to = $row['email_address'];
				$first_name = $row['first_name'];
				$sender = 'someone';
				$message = str_replace('{{name}}', $first_name, $message);
				$message_body = str_replace('{{sender}}', $sender, $message);
				$is_sent = send_email($to, $first_name, $message_body, $from_email, $from_name, $email_password, $subject);
				if($is_sent == 1){
					$update = $partner_notification->update_participant('status', 'complete', $_SESSION['id']);
					echo json_encode("Email sent successfully");
				}else{
					echo json_encode("Email not sent");
				}
				 session_regenerate_id();
			}
	 	}
	 }

	function send_email($to, $first_name, $message_body, $from_email, $from_name, $email_password, $subject){
	
		$message = email_template($message_body);
		
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPDebug  = 0;  
		$mail->SMTPAuth   = TRUE;
		$mail->SMTPSecure = "tls";
		$mail->Port       = 587;
		$mail->Host       = "smtp.gmail.com";
		$mail->Username   = $from_name;
		$mail->Password   = $email_password;

		$mail->IsHTML(true);
		$mail->AddAddress($to, $first_name);
		$mail->SetFrom($from_email, "SKPA");
		$mail->Subject = $subject;

   
		$content = "<b>".$message."</b>";
	
		$mail->MsgHTML($content);
		if(!$mail->Send()) {
			return 0;
		}else{
			return 1;
		}
	}

    function email_template($message_body){

        $html = '<html>
                    <head></head>
                        <body style="background: #efefef;width:100%;height: 100%;font-family: Arial, sans-serif;">
                        <table align="center" width="500" bgcolor="white" style="display:block;border:1px solid #dedede;margin-top:30px;margin-bottom:30px;margin-left:auto;margin-right:auto;border-radius: 10px;padding:10px;">
                            <tbody>
                                <tr>
                                    <td style="background-color: #fff;padding:10px 0px;border-radius: 8px 8px 0px 0px;border-bottom: 1px solid #ccc; text-align: center;">
                                        <img width="150" src="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <table style="padding:20px;">
                                            <tr>
                                                <td>
                                                    '.$message_body.'
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="background-color: #1E757C;padding:15px;border-radius:0px 0px 8px 8px ;">
                                        <table width="100%">
                                            <tr>
                                                <td>
                                                    <p style="color:#fff;font-size:14px;">SKPA Love Yourself</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </body>
                    </html>';
        return $html;
    }

function filter_html($data) {
  // $data = trim($data);
  // $data = stripslashes($data);
  // $data = htmlspecialchars($data);
  return $data;
}

?>