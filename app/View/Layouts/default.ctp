<?php
/**
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
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)   <?= //$content_for_layout ?>
 */

//$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeDescription = __d('cake_dev', 'Heart Touching Stories');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php echo $this->Html->charset(); ?>
		<title>
			<?php echo $cakeDescription ?>:
			<?php echo $title_for_layout; ?>
		</title>
		<?php
			echo $this->Html->meta('icon');

			echo $this->Html->css('style');
			
			echo $this->Html->script('jquery.min');	
			echo $this->Html->script('scripts');

			echo $this->fetch('meta');
			echo $this->fetch('css');
			echo $this->fetch('script');
		?>
		
	</head>
	<body data-twttr-rendered="true">	
		<div id="header">
			<span class="logo">blog about moral stories</span>																																																											
			<ul id="menu">
				<?php
					echo "<li>".$this->Html->link('Home',array('controller' => 'blogs', 'action' => 'index'), 
														 array('escape' => false))."</li>&nbsp;";
					if($id==0)
					{
						echo "<li>".$this->Html->link('Signin',array('controller' => 'blogs', 'action' => 'add'),
															   array('escape' => false,'target' => '_blank'))."</li>&nbsp;";
						echo  "<li class='signup'>".$this->Html->link('Signup',array('controller' => 'users', 'action' => 'register'),
																array('escape' => false))."</li>";	
					}
					else
					{
						echo "<li>".$this->Html->link('Add Post',array('controller' => 'blogs', 'action' => 'add'), array('escape' => false))."</li>&nbsp;";
						if($nam['User']['role']=='admin')
						{
							echo "<li>".$this->Html->link('User Role',array('controller' => 'users', 'action' => 'add'), array('escape' => false))."</li>&nbsp;";
						}
						echo "<li>".$this->Html->link('Reset Password',array('controller' => 'users', 'action' => 'pwd'), array('escape' => false))."</li>&nbsp;";
						echo "<li>".$this->Html->link('Signout',array('controller' => 'users', 'action' => 'logout'), array('escape' => false))."</li>&nbsp;";
					}
				?>
			</ul>
			<?php 				
				echo $this->Html->image('images/spacer.gif',array('alt' =>'setalpm','height'=>'120','width'=>'120','border'=>'0','usemap'=>'#Map','class'=>'rss'));
			?>
			<map name="Map">
			  <area shape="circle" coords="60,60,63" href="">
			</map>
		</div>
		
		<div id="sb-loading" style="display: none;">
			<div id="sb-loading-inner">
				<span>loading</span>
			</div>
		</div>
		
		<div id="content">
			<div id="posts">
				<?php 				
					echo $this->Session->flash();
					echo $content_for_layout;	
				?>
			</div>	
			<div id="sidebar">
				<div id="search">
					<?php
						if($id>0)
						{
					?>
							<input type="text" value="Sign in as&nbsp;<?php echo ucwords($nam['User']['name']);?>" readonly="readonly"/>
					<?php
						}
					?>																																																																																																																																																																																																																																													
				</div>
			</div>
		</div>
		
		<div id="footer">
			<p>Copyright &copy;. All rights reserved. Design by <?php echo $this->Html->link('Heart Touching Stories',array('controller' => 'blogs', 'action' => 'index'), 
														 array('escape' => false,'target'=>'_blank','title'=>'CakePHP Project'));?></p>																																																																		
		</div>	
		<?php //echo $this->element('sql_dump'); ?>
	</body>
</html>
