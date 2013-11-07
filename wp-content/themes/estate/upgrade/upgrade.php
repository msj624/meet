<?php

function estate_premium_upgrade_content($content){
	$content['premium_title'] = __('Upgrade To Estate Premium', 'estate');
	$content['premium_summary'] = __("If you've enjoyed using Estate, you're going to love Estate Premium. It's a robust upgrade to Estate that gives you loads of cool features. You choose the price, so you can decide what it's worth to give your site a professional edge.", 'estate');

	$content['buy_url'] = 'http://siteorigin.fetchapp.com/sell/vdddaeng';
	$content['premium_video_poster'] = get_template_directory_uri().'/upgrade/poster.jpg';
	//$content['premium_video_id'] = '52853957';

	$content['features'] = array();

	$content['features'][] = array(
		'heading' => __('Premium Email Support', 'estate'),
		'content' => __("Need help setting up Estate? Upgrading to Estate Premium gives you email support - prioritized according to what you paid.", 'estate'),
	);

	$content['features'][] = array(
		'heading' => __('Name The Price', 'estate'),
		'content' => __("You can choose exactly how much you pay for Estate Premium. Pay what ever you think the features are worth to you. Regardless, you're supporting the continued development of Estate.", 'estate'),
	);

	$content['features'][] = array(
		'heading' => __("Responsive Features", 'estate'),
		'content' => __("The final puzzle pieces in making Estate fully responsive. Estate Premium has footer widgets that collapse below each other on small screen devices. Its menu collapses into a single navigate button which activates an intuitive nested menu system and site search.", 'estate'),
	);

	$content['features'][] = array(
		'heading' => __('Remove Attribution Links', 'estate'),
		'content' => __('Estate premium gives you the option to easily remove the "Powered by WordPress, Theme by SiteOrigin" text from your footer. ', 'estate'),
	);

	$content['features'][] = array(
		'heading' => __("Ajax Comments", 'estate'),
		'content' => __("Want to keep the conversation flowing? Ajax comments means your visitors can comment without reloading your page. So commenting wont interrupt a video or lose their position in one of your galleries.", 'estate'),
	);

	$content['features'][] = array(
		'heading' => __("CSS Editor", 'estate'),
		'content' => __("A simple CSS editor that lets you easily add code that changes the look of Estate. You can count on our support staff to help you with CSS snippets to get the look you're after. Best of all, your changes will persist across updates.", 'estate'),
	);

	$content['features'][] = array(
		'heading' => __("Continued Updates", 'estate'),
		'content' => __("You'll help support the continued development of Estate - ensuring it works with future versions of WordPress for years to come.", 'estate'),
	);

	$content['testimonials'] = array(

	);

	return $content;
}
add_filter('siteorigin_premium_content', 'estate_premium_upgrade_content');