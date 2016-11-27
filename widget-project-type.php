<?php
// Creating the widget 
class austeve_project_type_widget extends WP_Widget {

    const VERSION = '1.0.0';

    const CUSTOM_IMAGE_SIZE_SLUG = 'austeve_image_widget_custom';

    function __construct() {
        parent::__construct(
        // Base ID of your widget
        'austeve_project_type_widget', 

        // Widget name will appear in UI
        __('Project Type Widget', 'austeve_projects_widget_domain'), 

        // Widget description
        array( 'description' => __( 'Display links to pages', 'austeve_projects_widget_domain' ), ) 
        );

        add_action( 'sidebar_admin_setup', array( $this, 'admin_setup' ) );
    }

    /**
     * Enqueue all the javascript.
     */
    public function admin_setup() {
        wp_enqueue_media();
        wp_enqueue_script( 'image-link-widget', plugins_url('js/image-link-widget.js', __FILE__), array( 'jquery', 'media-upload', 'media-views' ), self::VERSION );

        wp_localize_script( 'image-link-widget', 'ImageLinkWidget', array(
            'frame_title' => __( 'Select an Image', 'image_widget' ),
            'button_title' => __( 'Insert Into Widget', 'image_widget' ),
        ) );
    }

    // Creating widget front-end
    // This is where the action happens
    public function widget( $args, $instance ) {

    	// args
        $args = array(
            'page_id'   => $instance[ 'pagelink' ],
        );

        // query
        $the_query = new WP_Query( $args );

        if( $the_query->have_posts() ): 
            while( $the_query->have_posts() ) : $the_query->the_post();
                
                echo "<div class='column'>";
                echo "<a href='".get_permalink($instance['pagelink'])."' ".($instance['newtab'] ? "target='blank'" : "")." title='".get_the_title()."'>";

                echo "<div class='pagelink'>";

                $theImageURL = isset( $instance['imageurl'] ) ? $instance['imageurl'] : '' ;
                echo "<div class='bg-image' style='background-image: url(\"".$theImageURL."\");'>";
                echo "</div>";
                

                echo "<div class='content'>";

                echo the_title( '<h2 class="entry-title">', '</h2>' );

                echo "</div>";

                echo "</div>";

                echo "</a>"; 
                echo "</div>";

            endwhile;
        else:
            echo "Page not found";
        endif;

        wp_reset_query();    // Restore global post data stomped by the_post().

	}
        
    // Widget Backend 
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'Project Type', 'austeve_projects_widget_domain' );
        }
        if ( isset( $instance[ 'pagelink' ] ) ) {
            $pagelink = $instance[ 'pagelink' ];
        }
        else {
            $pagelink = __( '-1', 'austeve_projects_widget_domain' );
        }
        if ( isset( $instance[ 'imageurl' ] ) ) {
            $imageurl = $instance[ 'imageurl' ];
        }
        else {
            $imageurl = __( '', 'austeve_projects_widget_domain' );
        }
        if ( isset( $instance[ 'newtab' ] ) ) {
            $newtab = $instance[ 'newtab' ];
        }
        else {
            $newtab = false;
        }

        // Widget admin form
?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>

        <p>
        <label for="<?php echo $this->get_field_id( 'pagelink' ); ?>"><?php _e( 'Project category: ' ); ?></label> 
        <?php
            wp_dropdown_pages(array(
                'id' => $this->get_field_id('pagelink'),
                'name' => $this->get_field_name('pagelink'),
                'selected' => isset($instance['pagelink']) ? $instance['pagelink'] : '',
                'show_option_none' => 'Select page...',
                'option_none_value' => '-1'
            ));
        ?>
        </p>

        <p> 
        <label for="<?php echo $this->get_field_id( 'newtab' ); ?>"><?php _e( 'Open in new tab: ' ); ?></label> 
        
        <input type="checkbox" name="<?php echo $this->get_field_name('newtab'); ?>" id = "<?php echo $this->get_field_id('newtab');?>" <?php echo $newtab ? " checked='checked'" : "";?> />
        
        </p>

        <?php
            $id_prefix = $this->get_field_id('');
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'imageurl' ); ?>"><?php _e( 'Background Image:' ); ?></label>
            
            <div class="uploader">
                <input type="submit" class="button" name="<?php echo $this->get_field_name('uploader_button'); ?>" id="<?php echo $this->get_field_id('uploader_button'); ?>" value="<?php _e('Select an Image', 'image_widget'); ?>" onclick="imageWidget.uploader( '<?php echo $this->id; ?>', '<?php echo $id_prefix; ?>' ); return false;" />
                
                <input type="hidden" id="<?php echo $this->get_field_id('imageurl'); ?>" name="<?php echo $this->get_field_name('imageurl'); ?>" value="<?php echo $imageurl; ?>" />
            </div>
        </p>

<?php 
    }
        
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? $new_instance['title'] : '';
        $instance['pagelink'] = ( ! empty( $new_instance['pagelink'] ) ) ? $new_instance['pagelink'] : '';
        $instance['imageurl'] = ( ! empty( $new_instance['imageurl'] ) ) ? $new_instance['imageurl'] : '';
        $instance['newtab'] = ( ! empty( $new_instance['newtab'] ) ) ? $new_instance['newtab'] : '';

        return $instance;
    }
} // Class austeve_projects_widget ends here


// Register and load the widget itself
function austeve_projecttype_load_widget() {
    register_widget( 'austeve_project_type_widget' );

}
add_action( 'widgets_init', 'austeve_projecttype_load_widget' );

?>