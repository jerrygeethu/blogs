<!-- File: /app/View/Users/login.ctp -->

	<div class="head"><h2>Sign in with your username and password</h2></div><br/>
	<div class="form">
		<?php
			echo $this->Form->create('User', array('action' => 'login')); 
			
				echo $this->Form->input('username',array('label' => 'User Name','placeholder'=>"Your username..."));
				echo $this->Form->input('password',array('placeholder'=>"Your password..."));	
		?>
				<p id="hint"><i>Hint:Password must contain numbers and it must be at least 5 characters long</i></p>
		<?php 
			echo $this->Form->end('Login'); 
		?>
	</div>
