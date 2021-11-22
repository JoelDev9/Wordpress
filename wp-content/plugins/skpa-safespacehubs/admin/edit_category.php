<?php //echo "<pre>"; print_r($question); echo "</pre>";?>

<form action="questionnaire.php?task=save" method="post">
	<fieldset>
		<label for="regularTextarea">TITLE</label>
		<textarea id="regularTextarea" name="title"><?php echo (isset($question['title']))?$question['title']:'';?></textarea>
		<input type="hidden" name="id" value="<?php echo (isset($category['id']))?$category['id']:'new';?>">
		<div>
			<strong>Options:</strong>
		</div>
		<ol class="options">
		<?php if(!empty($question['options'])): ?>
			<?php foreach ($question['options'] as $option): ?>
				<li class="active">
					<input name="options[]" type="text" value="<?php echo $option; ?>">  <a href="#remove" class="button btn-remove">-</a>
				</li>
			<?php endforeach; ?>

		<?php else: ?>
		<?php endif; ?>
				
		</ol>
		<a href="#add_more" class="button add_more">Add more options</a>
	</fieldset>
	<button type="submit">Save</button>
</form>
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