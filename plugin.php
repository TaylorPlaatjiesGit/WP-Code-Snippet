/**
* Register meta boxes.
*/
function register_meta_boxes() {
	$results = get_post_meta(get_the_ID(), 'newsletter_meta');
	
	if(isset($results)) {
		$is_last = false;
		foreach($results as $i => $result) {
			if(($i + 1) == count($results)) {
				$is_last = true;
			}
			
			add_meta_box( "meta-$i", __( 'News Article', 'postmeta' ), 'oss_display_callback', 'article', 'advanced', 'default', [ 'index' => $i, 'is_last' => $is_last, 'result' => $result ] );
		}
	} else {
		add_meta_box( 'meta-1', __( 'News Article', 'postmeta' ), 'oss_display_callback', 'article', 'advanced', 'default', [ 'is_last' => true, 'result' => null ] );
	}
}
add_action( 'add_meta_boxes', 'register_meta_boxes' );

/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */
function oss_display_callback( $post, $args = [] ) {
	if(isset($args['args'])) {
		if(isset($args['args']['index'])) {
			$post->meta_index = $args['args']['index'];
		}
		
		$post->is_last = $args['args']['is_last'];
		
		if($args['args']['result']) {
			$post->result = $args['args']['result'];
		}
	}
	
    include plugin_dir_path( __FILE__ ) . 'form.php';
}
