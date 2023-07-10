<?php
/*
Copyright 2012 Christopher Davis

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

if( ! class_exists( 'Custom_Admin_Branding' ) ):

  /**
   * Custom admin and login branding for WordPress
   *
   * @author Christopher Davis <http://christopherdavis.me>
   * @package Custom_Admin_Branding
   */
  class Custom_Admin_Branding
  {
      /**
       * Container for this class' arguments
       *
       * @access protected
       */
      protected $args;

      /**
       * Constructor.  Takes an array of args that customize various aspects of
       * the login and admin areas.
       *
       * The args
       * `designer_url` - Used in the credit link on the login and admin pages.
       * `designer_anchor` - Used in the credit link on the login and admin pages.
       * `login_footer_image` - URL of logo in footer on login page.
       * `login_footer_image_width` - Logo width.
       * `login_footer_image_height` - Logo height.
       * `backend_footer_image` - URL of small logo in footer of backend pages.
       * `backend_footer_image_widt` - Logo width.
       * `backend_footer_image_height` - Logo height.
       * `backend_footer_text` - Text arround small backend footer logo
       * `favicon_url` - URL of backend favicon
       * `admin_bar_icon_url`  - URL of in WP Admin Bar
       *
       * @param array $args See above
       */
      public function __construct( $args=array() )
      {
          $this->args = wp_parse_args(
              $args,
              array(
                  'login_url'                   => get_bloginfo( "url" ),
                  'login_image'                 => false,
                  'login_title'                 => get_bloginfo( 'site_name' ),
                  'designer_url'                => false,
                  'designer_anchor'             => false,
                  'favicon_url'                 => false,
                  'remove_wp'                   => false,
                  'login_footer_image'          => false,
                  'login_footer_image_width'    => false,
                  'login_footer_image_height'   => false,
                  'backend_footer_image'        => false,
                  'backend_footer_image_width'  => false,
                  'backend_footer_image_height' => false,
                  'admin_bar_icon_url'          => false,
              )
          );

          add_filter( 'login_enqueue_scripts', array( &$this, 'login_enqueue_scripts' ) );
          add_filter( 'admin_enqueue_scripts', array( &$this, 'admin_enqueue_scripts' ) );
          add_filter( 'wp_enqueue_scripts', array( &$this, 'admin_enqueue_scripts' ) ); // load Admin CSS on frontend for adminbar
          add_filter( 'login_headerurl', array( &$this, 'login_headerurl' ) );
          add_filter( 'admin_footer_text', array( &$this, 'admin_footer_text' ) );
          add_filter( 'login_headertitle', array( &$this, 'login_headertitle' ) );
          add_action( 'login_head', array( &$this, 'login_head' ) );
          add_action( 'login_footer', array( &$this, 'login_footer' ) );
          add_action( 'admin_head', array( &$this, 'add_favicon' ) );
          add_action( 'admin_bar_menu', array( &$this, 'admin_bar_menu_icon' ), 25 );
          add_action( 'admin_bar_menu', array( &$this, 'admin_bar_menu_remove' ), 999 );

      }

      /**
       * Eenqueue Login and Backend CSS on Loginpage
       *
       * @access public
       */
       public function login_enqueue_scripts()
       {
           wp_enqueue_style( 'custom-backend-brand', CUSTOM_BACKEND_BRANDING_DIRECTORY_URI . "/css/brand-backend.css", false );
           wp_enqueue_style( 'custom-backend-brand-wpfm-plugin', CUSTOM_BACKEND_BRANDING_DIRECTORY_URI . "/css/brand-backend-wpfm-plugin.css", false );
           wp_enqueue_style( 'custom-backend-brand-login', CUSTOM_BACKEND_BRANDING_DIRECTORY_URI . "/css/brand-login.css", false );
           wp_enqueue_style( 'custom-backend', CUSTOM_BACKEND_BRANDING_DIRECTORY_URI . "/css/custom.css", false );
       }

       /**
        * Eenqueue Backend CSS in Backend
        *
        * @access public
        */
       public function admin_enqueue_scripts()
       {
         if ( is_admin() ) {
           wp_enqueue_style( 'custom-backend-brand', CUSTOM_BACKEND_BRANDING_DIRECTORY_URI . "/css/brand-backend.css", false );
           wp_enqueue_style( 'custom-backend-brand-wpfm-plugin', CUSTOM_BACKEND_BRANDING_DIRECTORY_URI . "/css/brand-backend-wpfm-plugin.css", false );
           wp_enqueue_style( 'custom-backend-brand-wp-admin-bar', CUSTOM_BACKEND_BRANDING_DIRECTORY_URI . "/css/brand-wp-admin-bar.css", false );
           wp_enqueue_style( 'custom-backend', CUSTOM_BACKEND_BRANDING_DIRECTORY_URI . "/css/custom.css", false );
         } else {
           wp_enqueue_style( 'custom-backend-brand-wp-admin-bar', CUSTOM_BACKEND_BRANDING_DIRECTORY_URI . "/css/brand-wp-admin-bar.css", false );
           wp_enqueue_style( 'custom-backend', CUSTOM_BACKEND_BRANDING_DIRECTORY_URI . "/css/custom.css", false );
         }
       }

      /**
       * Change the `login_headerurl` to whatever was specified in $args
       *
       * @access public
       */
      public function login_headerurl( $url )
      {
          return esc_url( $this->args['login_url'] );
      }

      /**
       * Change `login_headerurl` to what was specified in the $args
       *
       * @access public
       */
      public function login_headertitle( $title )
      {
          return esc_attr( $this->args['login_title'] );
      }

      /**
       * Login header.  Adds the favicon
       *
       * @access public
       */
      public function login_head()
      {
          $this->add_favicon();
/*
          // Custom CSS with variables example
          if( !($this->args['login_footer_image']) ) return;
          if( !($this->args['login_footer_image_width']) ) return;
          if( !($this->args['login_footer_image_height']) ) return;

?>

<style>
body.login .custom-login-branding img {
  width: <?php echo $this->args['login_footer_image_width']; ?>px;
  height: <?php echo $this->args['login_footer_image_height']; ?>px;
}
</style>

<?php
          // End custom CSS with variables example
*/
      }

      /**
       * Adds the favicon specified in the $args
       *
       * @access public
       */
      public function add_favicon()
      {
          if( ! $this->args['favicon_url'] ) return;
          printf(
              "<link rel='shortcut icon' href='%s' />\n",
              esc_url( $this->args['favicon_url'] )
          );
      }

      /**
       * Spit out the designer credits (if present in $args) on the login footer
       *
       * @access public
       */
      public function login_footer()
      {
          if( $link = $this->designer_image_link() )
          {
              echo "<div class='custom-login-branding'>{$link}</div>\n";
          }
      }

      /**
       * Adds the designer link (`$args['designer_url']` & `args['designer_anchor`])
       * to the admin footer.
       *
       * @access public
       */
      public function admin_footer_text( $text )
      {

        if( $designer = $this->designer_small_image_link() )
        {
            return $designer;
        } else {
            return $text;
        }

      }

      /**
       * Maybe removes the "W" logo from the admin menu
       *
       * @access public
       */
      public function admin_bar_menu_remove( $wp_admin_bar )
      {
          $wp_admin_bar->remove_node('wp-logo');
          $wp_admin_bar->remove_node('comments');
          $wp_admin_bar->remove_node('customize');
          $wp_admin_bar->remove_node('customize-background');
          $wp_admin_bar->remove_node('customize-header');
          $wp_admin_bar->remove_menu('new-content');
          $wp_admin_bar->remove_menu('comments');         // Remove the comments bubble
          $wp_admin_bar->remove_menu('about');            // Remove the about WordPress link
          $wp_admin_bar->remove_menu('wporg');            // Remove the WordPress.org link
          $wp_admin_bar->remove_menu('documentation');    // Remove the WordPress documentation link
          $wp_admin_bar->remove_menu('support-forums');   // Remove the support forums link
          $wp_admin_bar->remove_menu('feedback');         // Remove the feedback link
      }

      /**
       * Maybe removes the "W" logo from the admin menu
       *
       * @access public
       */
      public function admin_bar_menu_icon( $wp_admin_bar )
      {
          if( ! $this->args['admin_bar_icon_url'] ) return;

          $admin_bar_icon_url = $this->args['admin_bar_icon_url'];

          $wp_admin_bar->add_menu( array(
              'id' => 'custom-brand-icon',
              'title'  => '<img src="' . $admin_bar_icon_url . '" width="32" height="32" />',
              'href' => false,
              'meta' => array(
                'target' => '_blank',
                'html'     => '<!-- Custom HTML that goes below the item -->',
              ),

          ) );        // Remove the feedback link
      }

      /**
       * Make a nice designer credit link
       *
       * @access protected
       */
       /*

      /**
       * Designer Credit Logo + Link for Login (big)
       *
       * @access protected
       */
      protected function designer_image_link()
      {
          $return = '';
          if( $this->args['designer_url'] && $this->args['designer_anchor'] && $this->args['login_footer_image']) {

              $designer_url = esc_url( $this->args['designer_url'] );
              $designer_anchor = esc_attr( $this->args['designer_anchor'] );
              $login_footer_image = esc_url( $this->args['login_footer_image'] );
              $designer_anchor = esc_attr( $this->args['designer_anchor'] );
              $login_footer_image_width = esc_attr( $this->args['login_footer_image_width'] );
              $login_footer_image_height = esc_attr( $this->args['login_footer_image_height'] );

              $return = '<a href="' . $designer_url . '" title="' . $designer_anchor . '" rel="external" targe="_blank">
                            <img src="' . $login_footer_image . '" alt="' . $designer_anchor . ' Logo" width="' . $login_footer_image_width . '" height="' . $login_footer_image_height . '">
                         </a>';

          } elseif( $this->args['designer_url'] && $this->args['designer_anchor'] ) {

              $designer_url = esc_url( $this->args['designer_url'] );
              $designer_anchor = esc_attr( $this->args['designer_anchor'] );

              $return = '<a href="' . $designer_url . '" title="' . $designer_anchor . '" rel="external" targe="_blank">
                          {designer_anchor}
                        </a>';

          }
          return $return;

      }

      /**
       * Designer Credit Logo + Link for Backend Footer (small)
       *
       * @access protected
       */
      protected function designer_small_image_link()
      {
        $return = '';
          if( $this->args['designer_url'] && $this->args['designer_anchor'] && $this->args['backend_footer_image']) {

                  $designer_url = esc_url( $this->args['designer_url'] );
                  $designer_anchor = esc_attr( $this->args['designer_anchor'] );
                  $backend_footer_image = esc_url( $this->args['backend_footer_image'] );
                  $designer_anchor = esc_attr( $this->args['designer_anchor'] );
                  $backend_footer_image_width = esc_attr( $this->args['backend_footer_image_width'] );
                  $backend_footer_image_height = esc_attr( $this->args['backend_footer_image_height'] );

                  $return = '<a class="custom-brand" href="' . $designer_url . '" title="' . $designer_anchor . '" rel="external" targe="_blank">
                                <img class="custom-brand-img" src="' . $backend_footer_image . '" alt="' . $designer_anchor . ' Logo" width="' . $backend_footer_image_width . '" height="' . $backend_footer_image_height . '">
                             </a>';

              if( $backend_footer_text = $this->args['backend_footer_text'] ) {

                $return =  str_replace("%image%", $return, $backend_footer_text);

              }

          } elseif( $this->args['designer_url'] && $this->args['designer_anchor'] ) {

              $designer_url = esc_url( $this->args['designer_url'] );
              $designer_anchor = esc_attr( $this->args['designer_anchor'] );

              $return = '<a href="' . $designer_url . '" title="' . $designer_anchor . '" rel="external" targe="_blank">
                          {designer_anchor}
                        </a>';

          }

          return $return;

      }
  } // end class

endif; // end class_exists

require_once( CUSTOM_BACKEND_BRANDING_DIRECTORY . '/config.php');
