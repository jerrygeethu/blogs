<?php
	class Blog extends AppModel
	{
		var $name = 'Blogs';
		public $table = 'blogs';// to specify the table to be used
		var $primaryKey = 'id';
			
		
		public $validate = array(
									'title' => array(
										'rule' => 'notEmpty',
										'required'   => true, 
										'message'    => 'Please provide title of the post.'),
									'comments' => array(
										'rule' => 'notEmpty',
										'required'   => true,
										'message'    => 'Please provide the post description.'));

	}
?>
