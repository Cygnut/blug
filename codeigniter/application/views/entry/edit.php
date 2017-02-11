<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open(isset($id) ? ('entry/update/'.$id) : 'entry/create'); ?>
	<label for="title">Title</label>
	<input type="input" name="title" value="<?php echo $entry_title; ?>"/><br/>
	
	<label for="content">Content</label>
	<textarea name="content"><?php echo $entry_content; ?></textarea><br/>
	
	<select name="category">
		<?php 
			foreach ($categories as $category)
			{
				$valueAttr = 'value="'.$category['id'].'"';
				$selectedAttr = ($category['id'] === $entry_category) ? 'selected="1"' : '';
				echo "<option $valueAttr $selectedAttr>" . 
					$category['name'] . 
					"</option>";
			}
		?>
	</select>
	
	<input type="submit" name="submit" value="OK"/>
</form>