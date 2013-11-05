<?php
/**
 * Twitter Widget
 * Description: A Twitter widget that show count and link to follow page
 * Version: 1.0
 * Author: Frederik Leksell
 * Author URI: http://frederik.se
 */
/****************Twitter Counter********************/

function getTwitterFollowers($screenName = 'wpbeginner')
{
    // some variables
    $consumerKey = 'E2R87LpKIm0B2pk6lFcSg';
    $consumerSecret = 'MFu2ODN0elU2OvAh1chNqEtonbuSFn6fsrSufo';
    $token = get_option('cfTwitterToken');
 
    // get follower count from cache
    $numberOfFollowers = get_transient('cfTwitterFollowers');
 
    // cache version does not exist or expired
    if (false === $numberOfFollowers) {
        // getting new auth bearer only if we don't have one
        if(!$token) {
            // preparing credentials
            $credentials = $consumerKey . ':' . $consumerSecret;
            $toSend = base64_encode($credentials);
 
            // http post arguments
            $args = array(
                'method' => 'POST',
                'httpversion' => '1.1',
                'blocking' => true,
                'headers' => array(
                    'Authorization' => 'Basic ' . $toSend,
                    'Content-Type' => 'application/x-www-form-urlencoded;charset=UTF-8'
                ),
                'body' => array( 'grant_type' => 'client_credentials' )
            );
 
            add_filter('https_ssl_verify', '__return_false');
            $response = wp_remote_post('https://api.twitter.com/oauth2/token', $args);
 
            $keys = json_decode(wp_remote_retrieve_body($response));
 
            if($keys) {
                // saving token to wp_options table
                update_option('cfTwitterToken', $keys->access_token);
                $token = $keys->access_token;
            }
        }
        // we have bearer token wether we obtained it from API or from options
        $args = array(
            'httpversion' => '1.1',
            'blocking' => true,
            'headers' => array(
                'Authorization' => "Bearer $token"
            )
        );
 
        add_filter('https_ssl_verify', '__return_false');
        $api_url = "https://api.twitter.com/1.1/users/show.json?screen_name=$screenName";
        $response = wp_remote_get($api_url, $args);
 
        if (!is_wp_error($response)) {
            $followers = json_decode(wp_remote_retrieve_body($response));
            $numberOfFollowers = $followers->followers_count;
        } else {
            // get old value and break
            $numberOfFollowers = get_option('cfNumberOfFollowers');
            // uncomment below to debug
            //die($response->get_error_message());
        }
 
        // cache for an hour
        set_transient('cfTwitterFollowers', $numberOfFollowers, 1*60*60);
        update_option('cfNumberOfFollowers', $numberOfFollowers);
    }
 
    return $numberOfFollowers;
}



/****************THE WIDGET********************/
add_action( 'widgets_init', 'sss_widget' );


function sss_widget() {
	register_widget( 'SSS_Widget' );
}

class SSS_Widget extends WP_Widget {

	function SSS_Widget() {
		$widget_ops = array( 'classname' => 'example', 'description' => __('Widget that show Twitter count and link to your follow page.', 'example') );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'sss-widget' );
		
		$this->WP_Widget( 'sss-widget', __('standardStrap Twitter Count', 'example'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		$name = $instance['name'];
		// $linkedin = $instance['linkedin'];



		echo $before_widget;

		// Display the widget title 
		if ( $title )
			echo $before_title . $title . $after_title;

		//Display the name 
		if ( $name )
			echo '<div class="ss-Twitter"><a href="';
		echo $name;
		echo '"><i class="fa fa-twitter fa-2x twitter-ikon"></i><span class="twitter-count">';
		echo getTwitterFollowers('FrederikLeksell');
		echo '</span></a></div>';
		

		// if ( $linkedin )
		// 	echo '<div class="ss-LinkedIn"><a href="';
		// 	echo $linkedin;
		// 	echo '"><i class="fa fa-linkedin fa-2x linkedin-ikon"></i><span class="linkedin">';
		// 	echo '</span></a></div>';

		
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['name'] = strip_tags( $new_instance['name'] );
		// $instance['linkedin'] = strip_tags( $new_instance['linkedin'] );

		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'title' => __('Follow me on Twitter!', 'example'), 'name' => __('https://twitter.com/intent/user?screen_name=YOUR NAME', 'example'), 'show_info' => true );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

	
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

		
		<p>
			<label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php _e('Twitter URL:', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" value="<?php echo $instance['name']; ?>" style="width:100%;" />
		</p>

		<!-- <p>
			<label for="<?php echo $this->get_field_id( 'linkedin' ); ?>"><?php _e('LinkedIn URL:', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'linkedin' ); ?>" name="<?php echo $this->get_field_name( 'linkedin' ); ?>" value="<?php echo $instance['linkedin']; ?>" style="width:100%;" />
		</p> -->
	

	<?php
	}
}

?>