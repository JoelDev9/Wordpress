<?php //echo "<pre>"; print_r($info['first_name']); echo "</pre>";?>
<?php 
$fname = ($fname != null) ? implode(", ", $fname) : '';
$email_add = ($email_add != null) ? implode(", ", $email_add) : '';
?>
	<fieldset>
		<label for="name">Name</label>
		
		<input type="text" name="name" value="<?php echo (isset($data['name']))?$data['name']:'';?>" readonly/>
		<br>
		<label for="sti">STI(s)</label>
		
		<input type="text" name="sti" value="<?php echo (isset($comma_separated))?$comma_separated:'';?>" readonly>
		<br>
		<label for="pn">Partner Name(s)</label>
		
		<input type="text" name="pn" value="<?=$fname;?>" readonly>
		<br>
		<label for="pe">Partner Email(s)</label>
		
		<input type="text" name="pe" value="<?= $email_add;?>" readonly>
		<br>
		<label for="name">Status</label>
		
		<input type="text" name="status" value="<?php echo (isset($data['status']))?$data['status']:'';?>" readonly>


	</fieldset>
	<a type="button" href="participant.php">Back</a>
<!-- 		<script type="text/javascript">
		jQuery(function ($) {
			$('.add_more').click(function(e){
				e.preventDefault();
				$('.options').append('<li class="active"><input name="options[]" type="text"></li>');
				return false;
			});

			$('.remove').click(function(e){
				e.preventDefault();
				$(this).parents('li').remove();
				return false;
			})
		})
	</script> -->