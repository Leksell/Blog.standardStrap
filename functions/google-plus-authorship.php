<?php

/**
 * Author: Frederik Leksell 
 * Author URI: http://frederik.se
 * Version: 0.8.0
 * Copyright (C) 2013 Frederik leksell 
 * License: GNU General Public License, version 3 (GPLv3)
 * License URI: license.txt 
 */


function google_plus_authorship_link ($gplus_return) { 
	$gplus_author_name = esc_attr( get_the_author_meta( 'gplus_author_name', $user->ID ) );
	$gplus_author_display = esc_attr( get_the_author_meta( 'display_name', $user->ID ) );	
	$gplus_author_url = esc_attr( get_the_author_meta( 'gplus_author_url', $user->ID ) );

	$author_name = "+";

	$gplus_return .= '<a href="'.$gplus_author_url.'" rel="'.(is_author()?"author":"me").'"';
	$gplus_return .= ' title="Google Plus Profile for '.$author_name.'" plugin="Google Plus Authorship">'.$author_name.'</a>';

	return $gplus_return;
} 

add_filter( 'get_the_author_link',	'google_plus_authorship_link',10,3 );
add_filter( 'the_author_posts_link',	'google_plus_authorship_link',10,3 );
add_action( 'show_user_profile',	'gplus_authorship_profile_fields' );
add_action( 'edit_user_profile',	'gplus_authorship_profile_fields' );

function gplus_authorship_profile_fields( $user ) {
	global $current_user;

	get_currentuserinfo();
	$gplus_author_name = esc_attr( get_the_author_meta( 'gplus_author_name', $current_user->ID ) );
	$gplus_author_url = esc_attr( get_the_author_meta( 'gplus_author_url', $current_user->ID ) );

	?>
	<h3>Google Plus profile information</h3>

	<table class="form-table">

		<tr>
			<th><label for="gplusauthor">Google Plus Profile URL</label></th>

			<td>
				<input type="text" name="gplus_author_url" id="gplus_author_url" value="<?php echo esc_attr( get_the_author_meta( 'gplus_author_url', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your Google Plus Profile URL. ("https://plus.google.com/1234567890987654321" or "https://plus.google.com/+YourName")</span>
			</td>
		</tr>

	</table>
<?php }


add_action( 'profile_update', 'gplus_authorship_profile_save' );


function gplus_authorship_profile_save( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) ){
		echo "You can't edit this user";
		return false;
	}
	update_usermeta( $user_id, 'gplus_author_url', $_POST['gplus_author_url'] );
	update_usermeta( $user_id, 'gplus_author_name', $_POST['gplus_author_name'] );

}

?>
