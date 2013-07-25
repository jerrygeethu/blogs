<?php
	App::uses('CakeEmail', 'Network/Email');//cakeEmail class is loaded
	App::uses('Sanitize', 'Utility');//cake php validations must done.The functions like find(),save()  check the injection querys by default	
	class UsersController extends AppController 
	{
		public $name = 'Users';
		public $helpers = array('Html', 'Form', 'Session');
		public $components = array('Session','Auth');
		
		public $model = array('User');//defines which model to use 
		
		public function beforeFilter() 
		{
			parent::beforeFilter();
			$this->Auth->allow('register','add');
		}
		
		public function index() 
		{
		}
		
		//Register form
		 function register() 
		 {
			if (!empty($this->data)) 
			{	
				//~ Data validation used for App::uses('Sanitize', 'Utility');
				//~ Sanitize::clean($data, $options) uses sanitization against XSS
				//~ Sanitize::html($data, array('remove' => true)) prepares user-submitted data for display inside HTML
									//~ =>If the $remove option is set to true, HTML content detected is removed rather than rendered as HTML entities:
												
				$ins['name']=Sanitize::html($this->data['User']['name'],array('remove' => true));
				$ins['email']=$this->data['User']['email'];
				$ins['phone_no']=$this->data['User']['phone_no'];
				$ins['username']=Sanitize::html($this->data['User']['username'],array('remove' => true));				
				$ins['password']=Sanitize::html($this->data['User']['password'],array('remove' => true));	
				$ins['confirm_password']=Sanitize::html($this->data['User']['confirm_password'],array('remove' => true));	
				$ins['role']=$this->data['User']['role'];			
				
				$insert = Sanitize::clean($ins, array('encode' => false));
				
				$this->User->create();
				if($this->User->save($insert))
				{
					$this->Session->setFlash(__('You are successfully registered'));
					$this->redirect(array('controller' => 'users', 'action' => 'login'));
				}
				else 
				{
					$this->Session->setFlash(__('The Registration form could not be saved. Please, try again.'));
				}
			}
		}
		//ends register()
		
		//to set the role of the user.It can do only registered user with role as admin
		public function add() 
		{
			if($this->Auth->User('id')==1)//id=1 refers to super admin
			{
				$name=$this->User->find('list',array(
												'fields'=>array('name'),
												'conditions'=> array('User.id !='=> 1),
												'order'=>array('name' => 'asc')));
			}
			else
			{
				$name=$this->User->find('list',array(
												'fields'=>array('name'),
												'conditions'=> array('User.role !='=> 'admin'),
												'order'=>array('name' => 'asc')));
			}
			$this->set('name', $name);//var name set as name for list of the registered in user
			if ($this->request->is('post'))
			{
				$this->User->create();		
				
				if ($this->User->save($this->data)) 
				{
					$this->Session->setFlash(__('The user role has been set'));
					$this->redirect(array('controller' => 'blogs','action' => 'index'));
				} 
				else 
				{
					$this->Session->setFlash(__('The user role could not be Set. Please, try again.'));
				}
			}
		}
		//ends the add()
		
		//reset the pwd
		public function pwd()
		{
			$this->set('usrid',$this->Auth->User('id'));				
			if ($this->request->is('post'))
			{
				$this->User->create();
				
				if ($this->User->save($this->data)) 
				{
					$this->Session->setFlash(__('The Password has been changed'));
					$this->redirect(array('controller' => 'blogs','action' => 'index'));
				} 
				else 
				{
						$this->Session->setFlash(__('The Password could not be changed. Please, try again.'));
				}
			}
			
		}
		//ends pwd()
		
		public function login() 
		{
			if ($this->request->is('post')) 
			{
				if ($this->Auth->login()) 
				{
					$this->redirect($this->Auth->redirect(array('controller'=>'blogs','action' => 'index')));
				} 
				else 
				{
					$this->Session->setFlash(__('Invalid username or password, try again'));
				}
			}
		}
		public function logout() 
		{
			$this->redirect($this->Auth->logout());
		}
	}
?>
