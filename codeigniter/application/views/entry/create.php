<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('entry/create'); ?>
	<label for="title">Title</label>
	<input type="input" name="title" /><br/>
	
	<label for="content">Content</label>
	<textarea name="content"></textarea><br/>
	
	<select name="category">
		<?php 
			foreach ($categories as $category) 
				echo '<option value="' . $category['id'] .  '">' . $category['name'] . '</option>';
		?>
	</select>
	
	<input type="submit" name="submit" value="Create entry"/>
</form>