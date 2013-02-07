<?php
//~ if (!isset($channel)) {
	//~ $channel = array();
//~ }
//~ if (!isset($channel['title'])) {
	//~ $channel['title'] = $title_for_layout;
//~ }
//~ 
//~ echo $this->Rss->document(
	//~ $this->Rss->channel(
		//~ array(), $channel, $this->fetch('content')
	//~ )
//~ );




	if (!isset($documentData)) 
	{
		$documentData = array();
	}
	if (!isset($channelData)) 
	{
		$channelData = array();
	}
	if (!isset($channelData['title'])) 
	{
		$channelData['title'] = $title_for_layout;
	}
	$channel = $this->Rss->channel(array(), $channelData, $content_for_layout);
	echo $this->Rss->document($documentData, $channel);
?>
