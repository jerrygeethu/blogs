<!-- File: /app/View/Blog/add.ctp -->

	<div class="head"><h2>Add Post</h2></div><br/>
	<div class="form">
		<?php
			
			echo $this->Form->create('Blog');
					
			echo $this->Form->input('title',array('label' => 'Post Title','placeholder'=>"Add your post title here..."));
			echo $this->Form->input('comments', array('rows' => '5', 'label' => 'Post Description', 'placeholder'=>"Add your post here..."));
			echo $this->Form->hidden('user_id',array('value' => $id));
			
			echo $this->Form->end('Save Post');
		?>
	</div>
