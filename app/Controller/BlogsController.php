<?php
	App::uses('AuthComponent', 'Controller/Component');//for authorization component
	App::import('Controller', 'Comments');// for importing the comments controller
	
	//App::uses('Sanitize', 'Utility');  =>cake php validations must done.The functions like find(),save()  check the injection querys by default	
	
	class BlogsController extends AppController 
	{
		public $name = 'Blogs';
		
		//Our view will also use the TextHelper for formatting
		public $helpers = array('Html', 'Form', 'Session', 'Text', 'Paginator', 'Js');
		
		public $components = array('Session', 'RequestHandler');
		
		public $model = array('Blog');//defines which model to use 
				
		//variable. used to define query conditions of pagination
		var $paginate = array(
							'fields' => array('Blog.*','count(Comment.id) AS count', 'User.name AS name'),	
							'joins' =>array(
										array(
											'table' => 'comments',
											'alias' => 'Comment',
											'type' => 'LEFT',
											'conditions' => array(
											'Blog.id = Comment.blog_id')),
										array(
											'table' => 'users',
											'alias' => 'User',
											'type' => 'LEFT',
											'conditions' => array(
											'Blog.user_id = User.id'))),
							'limit' => 2,
							'order' => array('Blog.created' => 'desc'),			
							'group' =>array('Blog.id'));	
		
		public function index() 
		{
			//debug($this->paginate('Blog'));	
			$page = $this->paginate('Blog');
			
			$this->set(compact('page'));			
		}	
		
		//view all the post details and list the comments and post the comments
		public function view($id = null)
		{
			$this->set('usr_id', $this->Auth->User('id'));//sets user id 
			
			$this->Blog->id = $id;
			
			$this->set('postid', $this->Blog->id);//sets blog id 
			
			$this->set('post', $this->Blog->read());// blog details	
			
			$post=$this->Blog->find('first',array(
													'fields' => array(
																		'Blog.*', 
																		'User.name'),
													'conditions' => array('Blog.id' =>$id),	
													'joins' =>array(
																	array(
																		  'table' => 'users',
																		  'alias' => 'User',
																		  'type' => 'LEFT',
																		  'conditions' => array('Blog.user_id = User.id')))));	
			$this->set('post',$post);//show all the details for the particular blog id
			
			$this->loadModel('Comment');//loads the model comments
			
			$list=$this->Comment->find('all',array(
													'fields' => array(
																		'Comment.*', 
																		'User.name'),
													'conditions' => array('Comment.blog_id' =>$id),	
													'joins' =>array(
																	array(
																		  'table' => 'users',
																		  'alias' => 'User',
																		  'type' => 'LEFT',
																		  'conditions' => array('Comment.user_id = User.id'))),
													'order' => array('Comment.created' => 'desc')));	
			
			
			
			$this->set('lst',$list);//comments list for the particular blog id
			
			$options['conditions'] = array('Comment.blog_id' => $id);//query conditions
			$this->set('count',$this->Comment->find('count',$options));// comment count
			
			//only sign in user can posts the comments others will direct to sign in page
			if ($this->request->is('post')) 
			{
				//Data validation used for the php function htmlentities()
				//which is used to encode all the values to the db
				$insert['user_id']=$this->data['Comment']['user_id'];
				$insert['blog_id']=$this->data['Comment']['blog_id'];
				$insert['title']=htmlentities($this->data['Comment']['title']);
				$insert['desc']=htmlentities($this->data['Comment']['desc']);
				
				if($this->Auth->User('id')>0)
				{
					if ($this->Comment->save($insert)) 
					{
						$this->Session->setFlash('Your comment has been posted.');
						$this->redirect(array('controller' => 'blogs','action' => 'index'));
					} 
					else 
					{					
						$this->Session->setFlash('Unable to post your comment.');					
					}
				}
				else
				{
					$this->redirect(array('controller' => 'blogs','action' => 'add'));
				}	
			}
		}
		//ends view()
		
		//Add() only can used for sign in persons		
		public function add($id=null) 
		{			
			if ($this->request->is('post')) 
			{	
			
				$insert['user_id']=$this->data['Blog']['user_id'];
				$insert['title']=htmlentities($this->data['Blog']['title']);
				$insert['comments']=htmlentities($this->data['Blog']['comments']);	
			
				$this->Blog->create();
				 
				if ($this->Blog->save($insert)) 
				{
					$this->Session->setFlash('Your post has been saved.');
					$this->redirect(array('action' => 'index'));
				} 
				else 
				{
					$this->Session->setFlash('Unable to add your post.');
				}
			}
		}
		//ends add()
		
		//edit() only can used for sign in persons		
		public function edit($id = null) 
		{
			$this->Blog->id = $id;//post id
			
			$usrid = $this->Auth->user('id');//user id
			if($usrid >0)
			{ 
				$ids = $usrid;
				
				$this->loadModel('User');//loads the model users
				
				$name=$this->User->find('first',array(
													'fields'=>'name',
													'conditions'=> array('User.id' => $ids)));	
				$this->set('name', $name);//name of the logged user
			}
			else
			{
				$ids = 0;
			}
			$this->set('id',$id);
			
			if ($this->request->is('get')) 
			{
				$this->request->data = $this->Blog->read();
			} 
			else 
			{
				$update['id']=$this->Blog->id;
				$update['title']=htmlentities($this->data['Blog']['title']);
				$update['comments']=htmlentities($this->data['Blog']['comments']);	
				
				if($this->Blog->save($update)) 
				{
					$this->Session->setFlash('Your post has been updated.');
					$this->redirect(array('action' => 'index'));
				} 
				else 
				{
					$this->Session->setFlash('Unable to update your post.');
				}
			}
		}
		//ends eidt()
		
		//delete() only can used for sign in persons		
		public function delete($id) 
		{
			if ($this->request->is('get')) 
			{
				throw new MethodNotAllowedException();
			}
			if ($this->Blog->delete($id)) 
			{
				$this->Session->setFlash('The post with id: ' . $id . ' has been deleted.');
				$this->redirect(array('action' => 'index'));
			}
		}
		//ends delete()

		public function isAuthorized($user) 
		{
			$msg = sprintf("Action: %s", $this->action);
			$this->log($msg, 'shop');
			// All registered users can add, edit, delete posts
			if ($this->action === "add" || $this->action === "edit"|| $this->action === "delete") {
				$this->log("Got into check", 'debug');
				return true;
			}
			return parent::isAuthorized($user);
		}
	}
?>
