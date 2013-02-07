<!-- File: /app/View/Blogs/view.ctp -->

	<div class="post">
		<h2>
			<?php echo html_entity_decode(ucwords($post['Blog']['title'])); ?>
		</h2>
		
		<div>
			<span class="date">
				<?php 
					//$date is in yyyy-mm-dd format
			
					$explode=explode(" ",$post['Blog']['created']);		
					$date_old=$explode[0];
					$date_new=explode("-",$date_old);	
					$date=$date_new[2]."/".$date_new[1]."/".$date_new[0]; 
								
					$time=$explode[1];
								
					echo $datetime=$date."&nbsp;".$time;
				?>
			</span>&nbsp;
			<span class="categories">by :&nbsp;<?php echo $post['User']['name'];?></span>
		</div>
		<p> <?php echo html_entity_decode(ucfirst($post['Blog']['comments'])); ?></p><br/>
	</div><br/>
	
	<div id="comments">
		<?php 
			if($count>0)
			{
		?>
				<div id="comment_info"  class="comment_info">		
					<?php				
						echo $this->Html->image('images/title3.gif',array('alt' =>'','height'=>'39','width'=>'216','class'=>'point','title'=>'Click Here to Show All Comments'));
					?><br />
				</div>	
				<div class="comment_tog" style="display:none;">
					<?php foreach ($lst as $list): ?>																																																																																																																																																																																																																																																			
						<div class="comment">	
							<div class="avatar">
								<?php
									echo $this->Html->image('images/avatar2.gif',array('alt' =>'','height'=>'80','width'=>'80'));
								?><br />
								<span><?php echo ucwords($list['User']['name']);?></span><br />
								<?php	
									$explode=explode(" ",$list['Comment']['created']);		
									$date_old=$explode[0];
									$date_new=explode("-",$date_old);	
									$date=$date_new[2]."/".$date_new[1]."/".$date_new[0]; 
									
									$time=$explode[1];
										
									echo $datetime=$date."&nbsp;".$time;
								?>										
							</div>				
						
							<p class="title">
								<?php 
									$title=html_entity_decode(ucwords($list['Comment']['title']));
									echo $this->Html->link($title,array(
																'controller' => 'comments', 'action' => 'view',$list['Comment']['id']));
								?>
							</p>
							<div>
								<?php
									echo wordwrap(substr(html_entity_decode(ucfirst($list['Comment']['desc'])),0,100),50)."&nbsp;";
								?>
							</div>
							<div class="readmore">	
								<?php
									$len=strlen($list['Comment']['desc']);
									if($len>100)
									{
										echo "<br/>".$this->Html->link("Continue Reading",
														array('controller' => 'comments', 'action' => 'view', $list['Comment']['id']),
														array('class' => 'button', 'target' => '_blank'));
									}
								?>	
							</div>
						</div>	
					<?php endforeach;?>
				</div>	
		<?php
			}
			if(isset($usr_id))
			{
		?>
				<div id="add">	
					<span class="comment_leave">
						<?php
							echo $this->Html->image('images/title4.gif',array('alt' =>'','height'=>'47','width'=>'216','class'=>'point','title'=>'Click Here to Add Your Comments'));
						?>
					</span>
					
					<div class="leave_tog" style="display:none;">
						<div class="avatar">
							<?php
								echo $this->Html->image('images/avatar2.gif',array('alt' =>'','height'=>'80','width'=>'80'));
							?><br />	
							<span><?php echo ucwords($nam['User']['name']); ?></span><br />
										<?php echo date("jS M Y");?>
						</div>
						<div class="form">
							<?php
								echo $this->Form->create('Comment', array('url' => array('controller' => 'blogs', 'action' => 'view/'.$postid)));	
										
								echo $this->Form->input('title', array('placeholder'=>"Add your comment title here..."));
								echo $this->Form->input('desc', array('label' => 'Description','rows' => "3", 'placeholder'=>"Add your comment description here..."));
								echo $this->Form->hidden('blog_id',array('value' => $postid));
								//check user is sign in or not,if user is a sign in set userid as usr_id otherwise set as null 
								if(isset($usr_id))
								{
									echo $this->Form->hidden('user_id',array('value' => $usr_id));
								}		
								//echo $this->Form->hidden('date',array('value' => date("Y-m-d")));
								echo $this->Form->end('Add Comment');		
							?>	
						</div>
					</div>
				</div>
		<?php
			}
		?>
	</div>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

