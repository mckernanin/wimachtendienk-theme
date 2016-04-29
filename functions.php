<?php

class Wimachtendienk {

	function __construct() {

		add_filter( 'upload_mimes', array( $this, 'mime_types' ) );
		add_filter( 'body_class',   array( $this, 'add_slug_body_class' ) );
		add_action( 'send_headers', array( $this, 'custom_headers' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'theme_typekit' ) );
		add_action( 'wp_head', array( $this, 'theme_typekit_inline' ) );
		add_action( 'wp_head', array( $this, 'fb_tracking_pixel' ) );

		$this->roots_support();
	}

	public function mime_types( $mimes ) {
		$mimes['svg'] = 'image/svg+xml';

		return $mimes;
	}

	public function add_slug_body_class( $classes ) {
		global $post;
		if ( isset( $post ) ) {
			$classes[] = $post->post_type . '-' . $post->post_name;
		}
		return $classes;
	}

	public function custom_headers() {
		header( 'Access-Control-Allow-Origin: *' );
	}

	public function roots_support() {
		add_theme_support( 'soil-clean-up' );
		add_theme_support( 'soil-disable-asset-versioning' );
		add_theme_support( 'soil-disable-trackbacks' );
		add_theme_support( 'soil-google-analytics', 'UA-76978103-2' );
		add_theme_support( 'soil-jquery-cdn' );
		// add_theme_support( 'soil-js-to-footer' );
		add_theme_support( 'soil-nav-walker' );
		add_theme_support( 'soil-nice-search' );
		add_theme_support( 'soil-relative-urls' );
	}

	public function theme_typekit() {
		wp_enqueue_script( 'theme_typekit', 'https://use.typekit.net/xbk1ivk.js' );
	}

	public function theme_typekit_inline() {
		if ( wp_script_is( 'theme_typekit', 'done' ) ) {
			?>
		  <script type="text/javascript">try{Typekit.load({ async: true });}catch(e){}</script>
	<?php
		}
	}

	public function fb_tracking_pixel() {
?>
		<!-- Facebook Pixel Code -->
		<script>
		!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
		n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
		n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
		t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
		document,'script','https://connect.facebook.net/en_US/fbevents.js');

		fbq('init', '1603613133290267');
		fbq('track', "PageView");</script>
		<noscript><img height="1" width="1" style="display:none"
		src="https://www.facebook.com/tr?id=1603613133290267&ev=PageView&noscript=1"
		/></noscript>
		<!-- End Facebook Pixel Code -->
<?php
	}
}

new Wimachtendienk();
