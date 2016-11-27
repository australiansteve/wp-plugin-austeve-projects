<?php
// Creating the widget 
class austeve_projects_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
        // Base ID of your widget
        'austeve_projects_widget', 

        // Widget name will appear in UI
        __('Project Listing', 'austeve_projects_widget_domain'), 

        // Widget description
        array( 'description' => __( 'Display a project category listing on a page', 'austeve_projects_widget_domain' ), ) 
        );
    }

    // Creating widget front-end
    // This is where the action happens
    public function widget( $args, $instance ) {

    	echo "<div class='row small-up-1 medium-up-2'>";

		// args
		$args = array (
			'tax_query' => array(
		        array(
		            'taxonomy' => 'austeve_project_types',
		            'terms' => $instance['projectcategory']
		        )
	   		)
	   	);

		// query
		$the_query = new WP_Query( $args );

		if( $the_query->have_posts() ): 
			while( $the_query->have_posts() ) : $the_query->the_post();
                echo "<div class='column'>";

        		if (locate_template('page-templates/partials/projects-archive.php') != '') {
					// yep, load the page template
					get_template_part('page-templates/partials/projects', 'archive');
				} else {
					// nope, load the default
					include( plugin_dir_path( __FILE__ ) . 'page-templates/partials/projects-archive.php');
				}

				echo "</div>";
			endwhile;
		else:
			echo "<div class='column'>";
			echo "No projects found";
			echo "</div>";
		endif;

		wp_reset_query();	 // Restore global post data stomped by the_post().

    	echo "</div>";
	}
        
    // Widget Backend 
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'Project Type', 'austeve_profiles_widget_domain' );
        }
        if ( isset( $instance[ 'projectcategory' ] ) ) {
            $projectcategory = $instance[ 'projectcategory' ];
        }
        else {
            $projectcategory = __( '-1', 'austeve_projects_widget_domain' );
        }

        // Widget admin form
?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>

        <p>
        <label for="<?php echo $this->get_field_id( 'projectcategory' ); ?>"><?php _e( 'Project category: ' ); ?></label> 
        <?php
            $args = array(
				'show_option_none'   => 'Select project type...',
				'option_none_value'  => '-1',
				'orderby'            => 'name',
				'order'              => 'ASC',
				'show_count'         => 0,
				'hide_empty'         => 0,
				'selected'           => isset($instance['projectcategory']) ? $instance['projectcategory'] : '',
				'hierarchical'       => 0,
				'name'               => $this->get_field_name( 'projectcategory' ),
				'id'                 => $this->get_field_id( 'projectcategory' ),
				'taxonomy'           => 'austeve_project_types',
				'hide_if_empty'      => false,
				'value_field'	     => 'term_id',
			);

            wp_dropdown_categories( $args );
        ?>
        </p>

<?php 
    }
        
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? $new_instance['title'] : '';
        $instance['projectcategory'] = ( ! empty( $new_instance['projectcategory'] ) ) ? $new_instance['projectcategory'] : '';

        return $instance;
    }
} // Class austeve_projects_widget ends here


// Register and load the widget itself
function austeve_projects_load_widget() {
    register_widget( 'austeve_projects_widget' );

}
add_action( 'widgets_init', 'austeve_projects_load_widget' );

?>