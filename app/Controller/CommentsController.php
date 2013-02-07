<?php 
class CommentsController extends AppController
{
	
	public $name = 'Comments';
	public $helpers = array('Html', 'Form', 'Session');
	public $components = array('Session');
	public $model = array('Comments');// defines the model to be used
	
	//comment details
	public function view($id = null)
	{
		$this->set('reply', $this->Comment->find('first',array(
													'fields' => array(
																		'Comment.*', 
																		'User.name'),
													'conditions' => array('Comment.id' =>$id),	
													'joins' =>array(
																	array(
																		  'table' => 'users',
																		  'alias' => 'User',
																		  'type' => 'LEFT',
																		  'conditions' => array('Comment.user_id = User.id'))),
													'order' => array('Comment.created' => 'desc'))));
	}
	//end comment details
}
?>
