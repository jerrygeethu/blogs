<!-- File: /app/View/Users/add.ctp -->
	
	<div class="head"><h2>Add Role of the User</h2></div><br/>
	<div class="form">
		<?php 
			echo $this->Form->create('User', array('action' => 'add')); 
				echo $this->Form->input('id', array(
													'label' => 'Name',
													'empty'=>'Select the Registered User',
													'options' => $name));
													
				echo $this->Form->input('password',array('placeholder'=>"Add your password here..."));
				echo $this->Form->input('confirm_password',array('type' => 'password','placeholder'=>"Retype your password here..."));
				echo $this->Form->input('role', array(
													'empty'=>'Set Role of the User',
													'options' => array(
																	'admin' => 'Admin', 'author' => 'Author')));
			
			echo $this->Form->end('Save');
		?>
	</div>
