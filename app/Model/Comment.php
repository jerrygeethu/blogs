<?php
	class Comment extends AppModel
	{
		public $name = 'Comments';
		public $table = 'comments';//defines the table to be used
		//validation
		public $validate = array(
								'title' => array(
									'rule' => 'notEmpty',
									'required'   => true, 
									'message'    => 'Please provide the comment title'),
								'desc' => array(
									'rule' => 'notEmpty',
									'required'   => true,
									'message'    => 'Please provide the comment')
								);
		
		//end vlidation
		public $primaryKey = 'id';
	}
?>
