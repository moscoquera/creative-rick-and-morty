<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://codercave.net
 * @since      1.0.0
 *
 * @package    Creative_Morty
 * @subpackage Creative_Morty/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Creative_Morty
 * @subpackage Creative_Morty/admin
 * @author     Andrés Mosquera <moscoquera@gmail.com>
 */
class Creative_Morty_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Creative_Morty_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Creative_Morty_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/creative-morty-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Creative_Morty_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Creative_Morty_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/creative-morty-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function register_menu_entries(){
	    add_submenu_page(
	        'edit.php?post_type='.\Creative_Morty\Objects\RAM_character::POST_TYPE,
	        __('Rick and Morty Character Sync','creative-morty'),
            __('Sync characters','creative-morty'),
            'edit_posts',
            sanitize_key('ram_character_sync'),
            array($this,'render_character_sync')
        );
    }

    public function render_character_sync(){
	    include CREATIVE_MORTY_PATH.'admin/partials/creative-morty-character-import.php';
    }

    public function character_sync_handle(){
        if( isset( $_POST['_wpnonce'] ) && wp_verify_nonce( $_POST['_wpnonce'], 'creative_morty_character_sync') ) {

            // sanitize the input
            $cm_sync_limit = sanitize_text_field( $_POST['cm_sync_limit']);
            $cm_sync_limit = absint($cm_sync_limit);

            \Creative_Morty\Objects\RAM_character::delete_all_posts();
            \Creative_Morty\Objects\RAM_character::import($cm_sync_limit);

            // add the admin notice
            $admin_notice = "success";

            // redirect the user to the appropriate page
            $redirect_url=add_query_arg(array(
                'post_type'=>'ram_character',
                'page'=>'ram_character_sync',
                'notice'=>$admin_notice
            ),admin_url('edit.php'));
            wp_redirect($redirect_url);
            exit();
        }
        else {
            wp_die( __( 'Invalid nonce specified', $this->plugin_name ), __( 'Error', $this->plugin_name ), array(
                'response' 	=> 403,
                'back_link' => 'admin.php?page=' . $this->plugin_name,

            ) );
        }
    }

    public function admin_notices(){
	    $current_screen = get_current_screen();
        if($current_screen && $current_screen->id == 'ram_character_page_ram_character_sync'
            && isset($_GET['notice']) && $_GET['notice']=='success'){
            ?>
            <div class="notice notice-success is-dismissible">
                <p><?php _e('Congratulations! The characters has been imported.', 'creative-morty') ?></p>
            </div>
            <?php
        }
    }


}
