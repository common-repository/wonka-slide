<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://wonkasoft.com
 * @since      1.0.0
 *
 * @package    Wonka_Slide
 * @subpackage Wonka_Slide/admin/partials
 */
?>

<div class="page-wrapper">
	<div class="page-header">
		<div id="ws-slide-logo-wrap">
			<img src="<?php echo plugins_url( "../img/ws-slide-logo.svg", __FILE__ ); ?>">
		</div> <!-- /ws-slide-logo-wrap -->
		<h1>Wonka Slide Plugin</h1>
	</div> <!-- /page-header -->
	<div class="content-area">
		<p>Documentation for Wonka Slide</p>
		<h2>Shortcode Information - Instructions on how to use the Wonka Slide plugin</h2>
		<strong><p>Default Shortcode</p></strong>
		<code>[wonka-slider]</code>
		<p>Default option has all options enabled</p>
		<strong><p>Slide Indicators Shortcode Option</p></strong>
		<code>[wonka-slider slide_indicators="false"]</code>
		<p>Slide indicators option is a bool (True/False) for silde indicators</p>
		<strong><p>Slide Arrows Shortcode Option</p></strong>
		<code>[wonka-slider slide_arrows="false"]</code>
		<p>Slide arrows option is a bool (True/False) for silde arrows</p>
		<strong><p>Slider Count Shortcode Option</p></strong>
		<code>[wonka-slider slide_count="5"]</code>
		<p>Slider count option sets the slider count (1-10) slides</p>
		<code>[wonka-slider style="true"]</code>
		<p>This will add the font style italic to the excerpt of the slides</p>
		<h3>Description</h3>
		<h4>Wonka Slide was build to add a slider using your latest blog post featured images. You can add a slider anywhere that you uses shortcode on your site such as widgets, post, pages etc.</h4>
		<p>If you have any questions, comments, or suggestions please send all inquiries to <a href="mail:support@wonkasoft.com">support@wonkasoft.com</a>. If you would like to <a href="https://paypal.me/Wonkasoft" target="_blank">donate</a> to support us please use this <a href="https://paypal.me/Wonkasoft" target="_blank">link</a></p>
	</div> <!-- /content-area -->
</div> <!-- /page-wrapper -->
