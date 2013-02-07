<?php
	App::uses('AuthComponent', 'Controller/Component');
	class User extends AppModel 
	{
		public $name = 'Users';
		public $table = 'users';//defines the table
		//validation for register form
		public $validate = array(
								'name' => array(
									'required' => array(
										'rule' => array('notEmpty'),
										'message' => 'Please provide the name of the user')),
										
								'id' => array(
									'valid' => array(
										'rule' => array('notEmpty'),
										'message' => 'Please select a valid user\'s name',
										'allowEmpty' => false)),
																				
								'email' => array(
										'kosher' => array(
											'rule' => 'email',
											'message' => 'Please make sure your email is entered correctly.'),
										'unique' => array(
											'rule' => 'isUnique',
											'message' => 'An account with that email already exists.'),
										'required' => array(
											'rule' => 'notEmpty',
											'message' => 'Please Enter your email.')),
										
								'phone_no' => array(
										'rule' => '/^([+])?([0-9]{2}-)?[0-9]{8}$/i',
										'required'   => 'notempty', 
										'message' => 'Please provide a valid Mobile number.'),
										
								'username' => array(
									'unique' => array(
										'rule' => 'isUnique',
										'message' => 'Username is already taken, please choose a different one.'),
									'required' => array(
										'rule' => array('notEmpty'),
										'message' => 'You have to choose a username.'),
									'length' => array(
										'rule' => array('between', 3, 15),
										'message' => 'Your username must be between 3 and 15 characters long.')),
										
								'old_password' =>array(	
										'required' => array(
											'rule' => array('notEmpty'),
											'message' => 'Please enter your old password.'),
										'checkpwd' => array(
											'rule' => 'checkoldPassword',
											'message' => 'Old password is incarrect')),
									
								'password' => array(
									'required' => array(										
										'rule' => array('custom','/^.*[0-9].*$/i'),
										'message' => 'Password must contain numbers'),
									'length' => array(
										'rule' => array('minLength',5),
										'message' => 'Password must be at least 5 characters long')),
										
								 'confirm_password' => array(
									'required' => array(
										'rule' => 'notempty',
										'message' => 'You have to confirm the password'),
									'length' => array( 
										'rule' => array('validConfirm','password'),
										'message'=>'Your passwords don\'t match!' )),
								
								'role' => array(
									'valid' => array(
										'rule' => array('inList', array('admin', 'author')),
										'message' => 'Please enter a valid role',
										'allowEmpty' => false)));
										
		//validation for old pwd 				
		function checkoldPassword($data)
		{
			$this->id = AuthComponent::user('id');
			$pwd = $this->field('password');
			return(AuthComponent::password($data['old_password']) == $pwd);
		}	
		
		//validation for pwd/confirm pwd						
		function validConfirm($data)
		{
			if ($this->data['User']['password'] !== $data['confirm_password'])
			{
				return false;
			}
			return true;
		}	
				
		//pwd encryption using hashing
		function beforeSave($options = array())
		{
			if (isset($this->data['User']['password']))
			{
				$this->data['User']['password'] = Security::hash($this->data['User']['password'], null, true);
			}

			if (isset($this->data['User']['confirm_password']))
			{
				unset($this->data['User']['confirm_password']);
			}
			return true;
		}
		 
	}
?>
