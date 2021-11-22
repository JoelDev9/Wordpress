<?php //echo "<pre>"; print_r($info['first_name']); echo "</pre>";?>
<?php 
$is_publish = isset($data['status']);
if($is_publish){
	$published = $data['status'] == 1? 'checked':'';
	$unpublished = $data['status'] == 0? 'checked':'';
}
?>
<form action="establishment.php?task=save_establishment" method="post">
	<input type="hidden" name="id" value="<?php echo (isset($data['id']))?$data['id']:'new';?>">
	<fieldset>
		<label for="name">Name</label>
		
		<input type="text" name="name" value="<?php echo (isset($data['name']))?$data['name']:'';?>"/>
		<br>
		<label for="address">Address</label>

		<input type="text" name="address" value="<?php echo (isset($data['address']))?$data['address']:'';?>">
		<br>
		<label for="contact_number">Contact Number</label>
	
		<input type="text" name="contact_number" value="<?php echo (isset($data['contact_number']))?$data['contact_number']:'';?>" >
		<br>
		<label for="latitude">Latitude</label>
		
		<input type="text" name="latitude" value="<?php echo (isset($data['latitude']))?$data['latitude']:'';?>">
		<br>
		<label for="longitude">Longitude</label>
		
		<input type="text" name="longitude" value="<?php echo (isset($data['longitude']))?$data['longitude']:'';?>">
		<br>
		<label for="nature">Nature</label>
		
		<input type="text" name="nature" value="<?php echo (isset($data['nature']))?$data['nature']:'';?>">
		<br>
		<div>
			<strong>Category:</strong>
		</div>
	<select  id="category" class="multiselect" multiple="multiple" name="category[]">
	    <?php
	        foreach( $cat['category'] as $name ){
	    ?>
	        <option value="<?php echo $name ?>" 
	        <?php
	            if( in_array( $name, $selected_cat['category']) ) echo ' selected';
	        ?>

	        ><?php echo $name;?></option>
	    <?php
	        }
	    ?>
	</select>
		<br>
		<label for="page_website">Page Website</label>
		
		<input type="text" name="page_website" value="<?php echo (isset($data['page_website']))?$data['page_website']:'';?>">
		<br>
		<label for="status">Publish</label>
		<br>
		<label for="yes">Yes</label>
		
		<input type="radio" name="status" id="yes" value="1" <?php echo (isset($published))?$published:'checked';?>>

		<label for="no">No</label>
		<input type="radio" name="status" id="no" value="0" <?php echo (isset($unpublished))?$unpublished:'checked';?>>
		

	</fieldset>
	<a type="button" href="establishment.php">Back</a>
		<button type="submit">Save</button>
</form>
		<script type="text/javascript">
		jQuery(function ($) {
			$('.add_more').click(function(e){
				e.preventDefault();
				$('.category').append('<li class="active"><input name="category[]" type="text"></li>');
				return false;
			});

			$('.remove').click(function(e){
				e.preventDefault();
				$(this).parents('li').remove();
				return false;
			})
		})
	</script>