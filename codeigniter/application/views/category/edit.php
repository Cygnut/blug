<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open(isset($id) ? ('category/update/'.$id) : 'category/create'); ?>
    <label for="name">Name</label>
    <input type="input" name="name" value="<?php echo $category_name; ?>"/><br/>
    
    <label for="description">Description</label>
    <textarea name="description"><?php echo $category_description; ?></textarea><br/>
    
    <input type="submit" name="submit" value="OK"/>
</form>