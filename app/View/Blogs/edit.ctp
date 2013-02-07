<!-- File: /app/View/Blogs/add.ctp -->

<div class="head"><h2>Edit Post</h2></div><br/>
<div class="form">
	<?php
		echo $this->Form->create('Blog', array('action' => 'edit'));
		
		echo $this->Form->input('title',array('label' => 'Post Title', 'escape' => false, 'placeholder'=>"Edit your post title here..."));
		echo $this->Form->input('comments', array('rows' => '5', 'label' => 'Post Description', 'escape' => false, 'placeholder'=>"Edit your post here..."));
		echo $this->Form->hidden('id',array('value' => $id));
		
		echo $this->Form->end('Update Post');
	?>
</div>
