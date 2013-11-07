<?php
///////////////////////////////////////////////////////////////////////////////
// multi instance twitter widget
///////////////////////////////////////////////////////////////////////////////
class My_THEME_Twitter_Widget extends WP_Widget {
function My_THEME_Twitter_Widget() {
//Constructor
parent::WP_Widget(false, $name = ' standardStrap Twitter Counter', array(
'description' => __('Display your twitter follower count.', TEMPLATE_DOMAIN)
));
}

function widget($args, $instance) {
// outputs the content of the widget
extract($args); // Make before_widget, etc available.

$twitter_consumer_key = isset($instance['twitter_consumer_key']) ? $instance['twitter_consumer_key'] : "";
$twitter_consumer_secret = isset($instance['twitter_consumer_secret']) ? $instance['twitter_consumer_secret'] : "";
$twitter_user_token = isset($instance['twitter_user_token']) ? $instance['twitter_user_token'] : "";
$twitter_user_secret = isset($instance['twitter_user_secret']) ? $instance['twitter_user_secret'] : "";
$twitter_username = isset($instance['twitter_username']) ? $instance['twitter_username'] : "";


$twitter_title = empty($instance['title']) ? __('standardStrap Twitter Counter', TEMPLATE_DOMAIN) : apply_filters('widget_title', $instance['title']);
$unique_id = $args['widget_id'];


echo $before_widget;
echo $before_title . $twitter_title . $after_title; ?>



  <a class="twitter-count-link" href="https://twitter.com/<?php echo $twitter_username; ?>">
<?php echo wp_dez_get_twitter_count (
$twitter_username,
$twitter_consumer_key,
$twitter_consumer_secret,
$twitter_user_token,
$twitter_user_secret );
?> </a>

</ul>
<?php echo $after_widget;
}

function update($new_instance, $old_instance) {
//update and save the widget
return $new_instance;
}

function form($instance) {
// Get the options into variables, escaping html characters on the way
$twitter_consumer_key = isset($instance['twitter_consumer_key']) ? $instance['twitter_consumer_key'] : "";
$twitter_consumer_secret = isset($instance['twitter_consumer_secret']) ? $instance['twitter_consumer_secret'] : "";
$twitter_user_token = isset($instance['twitter_user_token']) ? $instance['twitter_user_token'] : "";
$twitter_user_secret = isset($instance['twitter_user_secret']) ? $instance['twitter_user_secret'] : "";
$twitter_title = empty($instance['title']) ? __('My Twitter Count!', TEMPLATE_DOMAIN) : apply_filters('widget_title', $instance['title']);
?>

<p>
<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e("Twitter Title:",TEMPLATE_DOMAIN); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $twitter_title; ?>" />
</p>

<p><label for="<?php echo $this->get_field_id('twitter_consumer_key'); ?>">
<?php echo __('Twitter Consumer Key:', TEMPLATE_DOMAIN)?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id('twitter_consumer_key'); ?>" name="<?php echo $this->get_field_name('twitter_consumer_key'); ?>" value="<?php echo $twitter_consumer_key; ?>" />
</p>

<p><label for="<?php echo $this->get_field_id('twitter_consumer_secret'); ?>">
<?php echo __('Twitter Consumer Secret:', TEMPLATE_DOMAIN)?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id('twitter_consumer_secret'); ?>" name="<?php echo $this->get_field_name('twitter_consumer_secret'); ?>" value="<?php echo $twitter_consumer_secret; ?>" />
</p>

<p><label for="<?php echo $this->get_field_id('twitter_user_token'); ?>">
<?php echo __('Twitter User Token:', TEMPLATE_DOMAIN)?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id('twitter_user_token'); ?>" name="<?php echo $this->get_field_name('twitter_user_token'); ?>" value="<?php echo $twitter_user_token; ?>" />
</p>

<p><label for="<?php echo $this->get_field_id('twitter_user_secret'); ?>">
<?php echo __('Twitter User Secret:', TEMPLATE_DOMAIN)?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id('twitter_user_secret'); ?>" name="<?php echo $this->get_field_name('twitter_user_secret'); ?>" value="<?php echo $twitter_user_secret; ?>" />
</p>

<?php
}
}
register_widget('My_THEME_Twitter_Widget');
		
?>

