<?php 
class UnlogsController extends AppController
{
	
	public $name = 'Unlogs';
	public $helpers = array('Html', 'Form', 'Session');
	public $components = array('Session');
	public $model = array('Unlog');// defines the model to be used
	
	//comment details
	public function view($id = null)
	{
		$this->Comment->id = $id;
        $this->set('reply', $this->Unlog->read());
	}
	//end comment details
}
?>
