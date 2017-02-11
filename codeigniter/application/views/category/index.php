<h2><?php echo $title; ?></h2>

<p><a href="<?php echo site_url('category/create_form'); ?>">Create category</a></p>

<?php foreach ($categories as $category): ?>

	<h3><?php echo $category['name']; ?></h3>
	<p><a href="<?php echo site_url('category/'.$category['id']); ?>">View</a></p>
	<p><a href="<?php echo site_url('category/update_form/'.$category['id']); ?>">Edit</a></p>
	<p><a href="<?php echo site_url('category/delete/'.$category['id']); ?>">Delete</a></p>

<?php endforeach; ?>