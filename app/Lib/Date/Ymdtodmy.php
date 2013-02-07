<?php
	class Ymdtodmy extends AppController 
	{
		public function index($dateformate) 
		{
			$explode=explode("-",$dateformate);					 
			$new_date=$explode[2]."/".$explode[1]."/".$explode[0]; 
			return $new_date;
		}
	}
?>
