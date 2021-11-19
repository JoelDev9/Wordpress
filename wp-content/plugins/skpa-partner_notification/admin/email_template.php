<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include ("../inc/header_admin.php");
include ("../inc/body.php");
// if(!isset($_SESSION['username'])) {
// 	@header('location:index.php');
// }
?>
<div class="sixteen columns">
	<form action="email_template.php?task=update_email_template" method="post">
		<div class="box clearfix">
			<?php 
				$task = 'get_email_template';
				if(isset($_GET['task'])) {
					$task = $_GET['task'];
				}
				$admin->process($task);
			?>
			<button type="submit">Update</button>
		</div>

	</form>
</div>
<?php include ("../inc/footer.php"); ?>
