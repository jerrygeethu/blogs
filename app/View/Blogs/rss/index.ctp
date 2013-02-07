<?php
	App::uses('Sanitize', 'Utility');
	
	$this->set('channelData', array(
								'title' => __("Most Recent Posts"),
								'link' => $this->Html->url('/', true),
								'description' => __("Most recent posts."),
								'language' => 'en-us'));
								
	foreach ($page as $post) 
	{
		$postTime = strtotime($post['Blog']['created']);

		$postLink = array(
						'controller' => 'blogs',
						'action' => 'view',
						'year' => date('Y', $postTime),
						'month' => date('m', $postTime),
						'day' => date('d', $postTime),
						$post['Blog']['title'],
						$post['Blog']['comments']
    );

    // This is the part where we clean the body text for output as the description
    // of the rss item, this needs to have only text to make sure the feed validates
    $bodyText = preg_replace('=\(.*?\)=is', '', $post['Blog']['comments']);
    $bodyText = $this->Text->stripLinks($bodyText);
    $bodyText = Sanitize::stripAll($bodyText);
    $bodyText = $this->Text->truncate($bodyText, 400, array(
															'ending' => '...',
															'exact'  => true,
															'html'   => true,));

    echo  $this->Rss->item(array(), array(
											'title' => $post['Blog']['title'],
											'link' => $postLink,
											'guid' => array('url' => $postLink, 'isPermaLink' => 'true'),
											'description' => $bodyText,
											'pubDate' => $post['Blog']['created']));
}
?>
