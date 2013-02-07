<?php
	class Unlog extends AppModel
	{
		var $name = 'Unlogs';
		public $table = 'unlogs';// to specify the table to be used
		var $primaryKey = 'id';
		
		public $validate = array(
									'name' => array(
										'rule' => 'notEmpty',		
										'required'   => true, 
										'message'    => 'Please provide name of the user'));	
	}
?>
