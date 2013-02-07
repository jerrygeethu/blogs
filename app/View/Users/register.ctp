<!-- File: /app/View/Users/add.ctp -->
	<div class="head"><h2>Registration Form</h2></div><br/>
	<div class="form">
		<?php 
			//echo $this->Session->flash('auth'); 
			echo $this->Form->create('User'); 
		
				echo $this->Form->input('name',array('placeholder'=>"Your name here..."));
				echo $this->Form->input('email',array('label' => 'Email Address','placeholder'=>"Your email address..."));
				//echo $this->Form->hidden('date',array('label' => '<strong>Date Of Birth</strong>','value' => date("Y-m-d")));
				//echo $this->Form->input('gender', array('label' => '<strong>Gender</strong>', 'type' => 'select','options' => array('Male'=>'Male','Female'=>'Female')));
				
				echo $this->Form->input('phone_no',array('label' => 'Mobile Number','placeholder'=>"Your Mobile Number here..."));
				echo '<span id="hint"><i>Hint:eg: +65-8 digit phone no: (+65- is optional)</i></span>';
				
				echo $this->Form->input('username',array('label' => 'User Name','placeholder'=>"Your username here..."));
				echo '<span id="hint"><i>Hint:Your username must be between 3 and 15 characters long.</i></span>';
				
				echo $this->Form->input('password',array('placeholder'=>"Your password here..."));
				echo $this->Form->input('confirm_password',array('type' => 'password','placeholder'=>"Re-type your password here..."));
				echo $this->Form->hidden('role',array('value' => 'author'));
			?>
			<span id="hint"><i>Hint:Password must contain numbers and it must be at least 5 characters long.</i></span>
					
		<?php echo $this->Form->end('Save');?>
	</div>
