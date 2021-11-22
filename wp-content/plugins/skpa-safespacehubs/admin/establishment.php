<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include ("../includes/header_admin.php");
include ("../includes/body.php");
// if(!isset($_SESSION['username'])) {
// 	@header('location:index.php');
// }
?>
<div class="sixteen columns">
	<div class="box clearfix">
		<?php 
			$task = 'get_establishment';
			if(isset($_GET['task'])) {
				$task = $_GET['task'];
			}
			$admin->process($task);
		?>
	</div>
</div>
<script type="text/javascript">

	$(document).ready(function(){
	    var table = $('.uitablerecords:not(.no-page)').DataTable({
	        pagingType: "full_numbers",
	        pageLength: 10,
	        lengthChange: false,
	        columnDefs: [
	            { orderable: false, targets: -1 }
	        ],
	        "language": {
	            "emptyTable": "No records to display",
	            "paginate": {
	              "previous": "Prev"
	            },
	            info:"Showing _START_ - _END_ of _MAX_ Records"
	          },
	        // "order": [[ 0, "asc" ]],
	        dom: '<"top">rt<"bottom"pi><"clear">'
	    });
	});
</script>
<?php include ("../includes/footer.php"); ?>
