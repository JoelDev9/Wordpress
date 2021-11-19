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
	<div class="box clearfix">
		<?php 
			$task = 'manage_questionnaire';
			if(isset($_GET['task'])) {
				$task = $_GET['task'];
			}
			$admin->process($task);
		?>
	</div>
</div>
	<script type="text/javascript">
		jQuery(function ($) {
			$('.add_more').click(function(e){
				e.preventDefault();
				$('.options').append('<li><input name="options[]" type="text"></li>');
				return false;
			});

			$('.btn-remove').click(function(e){
				e.preventDefault();
				$(this).parents('li').remove();
				return false;
			})
		})
	</script>
<?php include ("../inc/footer.php"); ?>
