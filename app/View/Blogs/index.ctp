<!-- File: /app/View/Blogs/index.ctp -->
	<?php 
		$this->Paginator->options(array(
		   'update' => '#posts',
		   'evalScripts' => true,
		   'before' => $this->Js->get('#sb-loading')->effect('fadeIn', array('buffer' => false)),
		   'complete' => $this->Js->get('#sb-loading')->effect('fadeOut', array('buffer' => false)),
		));
	?>
	
	<span class="sort"> 
		<h4><i>
			<blink> Sorted By :&nbsp;&nbsp;</blink>			
			<?php
				//sorted by date, title, posts as asc/desc
				echo $this->Paginator->sort('title', 'Title',array('title'=>"Sorted By ASC/DESC")) ." &nbsp;&nbsp;";
				echo $this->Paginator->sort('comments', 'Posts',array('title'=>"Sorted By ASC/DESC")) ." &nbsp;&nbsp; ";
				echo $this->Paginator->sort('created', 'Date',array('title'=>"Sorted By ASC/DESC")); 
			?>
		</i></h4>
	</span>
	
	<!-- Here’s where we loop through our $posts array, printing out post info -->
		
	<?php foreach($page as $paginate): ?>
		<div class="post">
			<h2>
				<?php
					echo $this->Html->link(html_entity_decode(ucwords($paginate['Blog']['title'])),
							array('controller' => 'blogs', 'action' => 'view', $paginate['Blog']['id'])); 
				?>					
			</h2>
				
			<div>
				<span class="date">
					<?php 
						//covert date/time format
						$explode=explode(" ",$paginate['Blog']['created']);		
						$date_old=$explode[0];
						$date_new=explode("-",$date_old);	
						$date=$date_new[2]."/".$date_new[1]."/".$date_new[0]; 
						
						$time=$explode[1];
							
						echo $datetime=$date."&nbsp;".$time;
					?>
				</span>&nbsp;
				<span class="categories">by :&nbsp;<?php echo $paginate['User']['name'];?></span>
			</div>				
			
			<div class="description">
				<?php						
					//used for readmore feature
					$post=ucfirst($paginate['Blog']['comments']);
					echo wordwrap(substr(html_entity_decode($post),0,500),50);
				?>
			</div>
			<div class="comments">Comments - 	
				<?php
					$totcount = $paginate[0]['count'];
					if($paginate[0]['count']>=1)
					{ 
						$append = $totcount;
					}
					else
					{
						$append ="  No Comments";
					} 
					echo $this->Html->link( $append,array('controller' => 'blogs', 
				  										  'action' => 'view', $paginate['Blog']['id'])); 					
					$len=strlen($paginate['Blog']['comments']);
					if($len>500)
					{
						echo "<span>|</span>";
						echo $this->Html->link("Continue Reading",
							array('controller' => 'blogs', 'action' => 'view', $paginate['Blog']['id']),
							array('class' => 'button')); 
					}
				
					//edit, delete only can used for sign in persons
					if($id>0)
					{	
						if($id==$paginate['Blog']['user_id'] or $nam['User']['role']=='admin')
						{
							echo "<span>|</span>";
							echo $this->Html->link('Edit', array('action' => 'edit', $paginate['Blog']['id']));							
							echo "<span>|</span>";
							if($paginate[0]['count']>0)
							{
								echo $this->Form->postLink('Delete',array('url' =>array()),
																	array('confirm' => 'You cant delete this post.If you want to delete this post, to delete all the comments'));
							}
							else
							{
								echo $this->Form->postLink('Delete',array('action' => 'delete', $paginate['Blog']['id']),
																	array('confirm' => 'Are you sure you want to delete the data ??'));
							}
						}
					}
				?>
				
			</div>		
		</div>
	<?php endforeach; ?>
		
	<p class="page">					
		<?php 
			//Shows the next and previous links 
				
			echo $this->Paginator->prev('« Previous', null, null, array('class' => 'disabled'))."&nbsp;&nbsp;&nbsp;&nbsp;";
				
			//Shows the page numbers 
			echo $this->Paginator->numbers()."&nbsp;&nbsp;&nbsp;&nbsp;";
				
			echo $this->Paginator->next('Next »', null, null, array('class' => 'disabled'));
		?>
	</p>
	<span class="paging">
		<?php
			//prints X of Y, where X is current page and Y is number of pages
			//echo $this->Paginator->counter();
			
			echo $this->Js->writeBuffer(array('catche'=>TRUE)); 
			echo $this->Paginator->counter(array(
												'format' => 'Page %page% of %pages%, showing %current% records out of
												 %count% total, starting on record %start%, ending on %end%'));
															 
		?>
	</span>
		
		




