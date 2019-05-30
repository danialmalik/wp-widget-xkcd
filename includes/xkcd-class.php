<?php
/**
 * Adds Foo_Widget widget.
 */
class Xkcd_widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */

	function __construct() {
		parent::__construct(
			'xkcd_widget', // Base ID
			esc_html__( 'XKCD', 'xkcd_domain' ), // Name
			array( 'description' => esc_html__( 'XKCD Comics Widget', 'xkcd_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget']; // Display before widget <div> etc.

        // titile
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

        // get image url
        // $url = 'https://xkcd.com/info.0.json';
		$randomImgUrl = 'http://xkcd-imgs.herokuapp.com/';
        $response = wp_remote_get($randomImgUrl);
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);

        ?>
        <div class='xkcd-container'>
			<span><?php echo $data['title']?></span>
            <img class='xkcd-comic' src=<?php echo $data['url'] ?>>
        </div>
        <?php
		echo $args['after_widget']; // Display after widget </div> etc.
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'XKCD Comics', 'xkcd_domain' );
		?>
        <!-- TITLE -->
		<p>
		    <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
                <?php esc_attr_e( 'Title:', 'xkcd_domain' ); ?>
            </label> 

		    <input 
                class="widefat" 
                id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" 
                name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" 
                type="text" 
                value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';

		return $instance;
	}

} // class Foo_Widget
