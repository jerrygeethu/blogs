<!-- File: /app/View/Users/pwd.ctp -->
	<div class="head"><h2>Change Password</h2></div><br/>
	<div class="form">
	
		<?php 
			//echo $this->Session->flash('auth'); 
			echo $this->Form->create('User', array('action' => 'pwd')); 
			
				echo $this->Form->input('old_password',array('type' => 'password','placeholder'=>"Please enter your old password here..."));
				echo $this->Form->input('password',array('placeholder'=>"Add new password here..."));
				echo $this->Form->input('confirm_password',array('type' => 'password','placeholder'=>"Retype your new password here..."));
				echo $this->Form->hidden('id',array('value' => $usrid));
				echo $this->Form->end('Reset Password'); 
		?>
	</div>
