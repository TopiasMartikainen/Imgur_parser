<?php

	require('phpmailer/PHPMailerAutoload.php');
	include 'simple_html_dom.php';
	include 'sendpost.php';

	$picture = array();

	$html = file_get_html('http://www.imgur.com/top');
	$points_min = 15000;
		
	foreach($html->find('.post') as $element){
		$points_elem = $element->children[0]->children[1]->children[0]->children[0]->children[1]->children[0];
		$points_arr = explode('">',$points_elem);
		$points_int = str_replace(',', '',$points_arr[1]);
			
		$element->children[0]->href = "http://imgur.com".$element->children[0]->href;
			
		if($points_int > $points_min){
			$html_inner = file_get_html($element->children[0]->href);
			$img_content = $html_inner->find('.post-images')[0];
			echo $element;
			$picture[] = $element;
			echo '<br><br>';
		}
	}

	echo '<div style="display: inline-block;">';

	foreach($picture as $pic){
		$post .= $pic;
	}

	echo '</div>';

	$t = time();
	$time = date("Y.m.d h:i:s",$t);

	post($time, $post);

?>
