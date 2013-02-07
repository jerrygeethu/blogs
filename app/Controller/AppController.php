<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	
	public $components = array(
    'Session',
    'Auth' => array(
		'login' => array('controller' => 'Users'),
        'loginRedirect' => array('controller' => 'blogs', 'action' => 'index'),
        'logoutRedirect' => array('controller' => 'blogs', 'action' => 'index'),
        'authorize' => array('Controller') // for authorization of the blog
    )
);



public function isAuthorized($user) {
    // Admin can access every action
    if (isset($user['role']) && $user['role'] === 'admin') {
        return true;
    }

    // Default deny
    return false;
}

    public function beforeFilter() {
		$id = $this->Auth->User('id');
		$this->set('id',$id);	
		//used to print the name of the signin user
		if($id>0)
		{
			$this->loadModel('User');//loads the model users
					
			$name=$this->User->find('first',array(
												'fields'=>array('name','role'),
												'conditions'=> array('User.id' => $id)));	//debug($name);		
			$this->set('nam', $name);//set var name as name of the logged user
		}
        $this->Auth->allow('index', 'view','addcomment','adduser');
    }
}
