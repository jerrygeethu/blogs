<!-- File: /app/View/Comments/view.ctp -->

		<div class="post">
			<h2><?php echo html_entity_decode(ucwords($reply['Comment']['title'])); ?></h2>
			
			<div>
				<span class="date">
					<?php 
						//$date is in yyyy-mm-dd format
			
						$explode=explode(" ",$reply['Comment']['created']);		
						$date_old=$explode[0];
						$date_new=explode("-",$date_old);	
						$date=$date_new[2]."/".$date_new[1]."/".$date_new[0]; 
								
						$time=$explode[1];
								
						echo $datetime=$date."&nbsp;".$time;
					?>
				</span>&nbsp;
				<span class="categories">by :&nbsp;<?php echo $reply['User']['name'];?></span>
			</div>			
			<p> <?php echo html_entity_decode(ucfirst($reply['Comment']['desc'])); ?></p>
		</div>


	

   
