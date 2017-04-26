<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Arlene
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function arlene_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'arlene_body_classes' );


/**
 * Add the appropriate class to post-item in the loop
 */
function arlene_post_item_class() {
    
	if ( is_front_page() || is_home()) {
		$classes[] = 'post-item large-6 medium-6 columns';
	}elseif(is_singular() && !is_singular('page')) {
        $classes[] = 'post-item ';
        
    }else {
        $classes[] = 'post-item large-6 medium-6 columns';
    }
    return $classes;
}
add_filter( 'post_class', 'arlene_post_item_class' );
add_action( 'wp_head', 'arlene_pingback_header' );


/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function arlene_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'arlene_pingback_header' );

/**
 * Override the default excerpt length
 * @link https://wordpress.org/support/topic/changing-excerpt-length/
 */
function new_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'new_excerpt_length');
function arlene_new_excerpt_length($max_char, $more_link_text = '...',$notagp = false, $stripteaser = 0, $more_file = '') {
            $content = get_the_content($more_link_text, $stripteaser, $more_file);
            $content = apply_filters('the_content', $content);
            $content = str_replace(']]>', ']]&gt;', $content);
            $content = strip_tags($content);
    
            /*
             * USEFUL IN TEST MODE
             *
                if (""==$content) {
                $content = "Non a vel turpis tincidunt rhoncus magna mattis! Integer ac, lacus, elit. Et ac est cursus, etiam mus adipiscing auctor, elit vel mid mattis! Pid facilisis! Tincidunt. Lorem dictumst dapibus, tincidunt placerat vel dolor rhoncus rhoncus mid velit massa. Scelerisque! Porttitor placerat auctor a, turpis adipiscing et magna eros pulvinar aliquam aliquam enim pulvinar cum lorem tempor pulvinar cum. Dolor, a magnis, ultrices dis, tincidunt sed, adipiscing vel ridiculus. In augue tristique";
                }
             *
             */
           if (isset($_GET['p']) && strlen($_GET['p']) > 0) {
              if($notagp) {
              echo $content;
              }
              else {
              // echo '<div class="slide_excerpt">';
              echo $content;
              // echo "</div>";
              }
           }
           else if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ", $max_char ))) {
                $content = substr($content, 0, $espacio);
                $content = $content;
                if($notagp) {
                echo $content;
                echo $more_link_text;
                }
                else {
                echo $content;
                echo $more_link_text;
                }
           }
           else {
              if($notagp) {
              echo $content;
              }
              else {
              echo $content;
              }
           }
        }

/**
 * Dealig with submenu items
 */
class Multilevel_Menu extends Walker_Nav_Menu
{
   function start_lvl(&$output, $depth = 0, $args = array())
   {
       $indent = str_repeat("\t", $depth);
       $output .= "\n$indent<ul class=\"dropdown\">\n";
   }
   function end_lvl(&$output, $depth = 0, $args = array())
   {
       $indent = str_repeat("\t", $depth);
       $output .= "$indent</ul>\n";
   }
    // adding arrow to top-menu
    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

        if ( !$element )
                return;

        $id_field = $this->db_fields['id'];

        //display this element
        if ( is_array( $args[0] ) )
                $args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );

        //Adds the 'parent' class to the current item if it has children               
        if( ! empty( $children_elements[$element->$id_field] ) ) {
                array_push($element->classes,'has-dropdown not-click');
                //$element->title .= ' <i class="fa fa-caret-down"></i>';
        }

        $cb_args = array_merge( array(&$output, $element, $depth), $args);

        call_user_func_array(array(&$this, 'start_el'), $cb_args);

        $id = $element->$id_field;

        // descend only when the depth is right and there are childrens for this element
        if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {

                foreach( $children_elements[ $id ] as $child ){

                        if ( !isset($newlevel) ) {
                                $newlevel = true;
                                //start the child delimiter
                                $cb_args = array_merge( array(&$output, $depth), $args);
                                call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
                        }
                        $this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
                }
                unset( $children_elements[ $id ] );
        }

        if ( isset($newlevel) && $newlevel ){
                //end the child delimiter
                $cb_args = array_merge( array(&$output, $depth), $args);
                call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
        }

        //end this element
        $cb_args = array_merge( array(&$output, $element, $depth), $args);
        call_user_func_array(array(&$this, 'end_el'), $cb_args);
    }
}


/**
 * This functions prints a group of button for browsing through the other pages
 * The pagination logic is inspired from WP Page Numbers plugin and and article of * Codular.
 * 
 * @link https://wordpress.org/plugins/wp-page-numbers
 * @link http://codular.com/implementing-pagination
 */

function arlene_pagination($count_post, $paged)
{
	$pagingString   = "<ul class=\"pagination\">\n";
    $postsPerPage   = get_option('posts_per_page');
    $pagesToShow    = ceil(($count_post)/ ($postsPerPage));
    
    $firstPage      = 1;
    $lastPage   = $pagesToShow;
    if($pagesToShow>10) $pagesToShow = 10;
    
    if($paged > $firstPage): // make sure previous page exists
        $pagingString .="<li class=\"arrow unavailable\">";
        $pagingString .= "<a href=\"" . get_pagenum_link($firstPage) . "\">&laquo;</a>";
        $pagingString .= "</li>\n";
    endif;
    
    for($i=1;$i<=$pagesToShow;$i++):
        if($i== $paged): //highlight the current page
            $pagingString .= "<li class=\"current\">";
            $pagingString .= "<a href=\"" . get_pagenum_link($i) . "\">" . $i . "</a>";
            $pagingString .= "</li>\n";
        else:
            $pagingString .= "<li>";
            $pagingString .= "<a href=\"" . get_pagenum_link($i) . "\">" . $i . "</a>";
            $pagingString .= "</li>\n";
        endif;
    endfor;
    
    if($paged < $pagesToShow): // make sure next page exists
        $pagingString .="<li class=\"arrow unavailable\">";
        $pagingString .= "<a href=\"" . get_pagenum_link(($paged+$postsPerPage)+1) . "\">&raquo;</a>";
        $pagingString .= "</li>\n";
        $pagingString .= '</ul>';
    endif;
	
    echo $pagingString;

}


/**
 * This functions prints a breadcrumb
 * The script is inspired from a Quality Trust article
 * 
 * @link http://www.qualitytuts.com/wordpress-custom-breadcrumbs-without-plugin/
 */
if(!function_exists('arlene_custom_breadcrumbs')) {
    function arlene_custom_breadcrumbs() {
 
  $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $delimiter = '/'; // delimiter between crumbs
  $home = __('Home','arlene'); // text for the 'Home' link
  $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $before = '<span class="active">'; // tag before the current crumb
  $after = '</span>'; // tag after the current crumb
 
  global $post;
  $homeLink = home_url();
 
  if (is_home() || is_front_page()) {
 
    if ($showOnHome == 1) echo '<a href="' . $homeLink . '">' . $home . '</a>';
 
  } else {
 
    echo '<a href="' . $homeLink . '">' . $home . '</a>';
 
    if ( is_category() ) {
      $thisCat = get_category(get_query_var('cat'), false);
      if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, '');
      echo $before . single_cat_title('', false) . $after;
 
    } elseif ( is_search() ) {
      echo $before . '"' . get_search_query() . '"' . $after;
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a>';
      echo $before . get_the_time('d') . $after;
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>';
      echo $before . get_the_time('F') . $after;
 
    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;
 
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        //echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
        if ($showCurrent == 1) echo '' . $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, '');
        if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
        echo $cats;
        if ($showCurrent == 1) echo $before . get_the_title() . $after;
      }
 
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, '');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
      if ($showCurrent == 1) echo '' . $before . get_the_title() . $after;
 
    } elseif ( is_page() && !$post->post_parent ) {
      if ($showCurrent == 1) echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      for ($i = 0; $i < count($breadcrumbs); $i++) {
        echo $breadcrumbs[$i];
        if ($i != count($breadcrumbs)-1) echo '';
      }
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
 
    } elseif ( is_tag() ) {
      echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . __('Articles posted by ','arlene') . $userdata->display_name . $after;
 
    } elseif ( is_404() ) {
      echo $before .__('Error 404','arlene')  . $after;
    }
 
  }
}
  /*
   * Print social links
   *
   */
    function arlene_social_links() {
        $socials = array('facebook','twitter','youtube','github');
        
        foreach($socials as $social){
            $id = $social.'_url';
            if(""!=get_theme_mod($id)){
                echo '<li class="reveal" id="'.$id.'"><a href="'.esc_url(get_theme_mod($id)).'"><i class="fa fa-'.$social.'"></i></a></li>';  
            }
        }
    }
}
    /*
     * Get content out of the_custom_logo()
     */
    
    function arlene_get_custom_logo() {
        if(has_custom_logo()) {
            $custom_logo_id = get_theme_mod( 'custom_logo' );
            $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
            return $image[0];
        }else {
            return get_template_directory_uri().'/img/arlene_logo.png';
        }
    }
    add_filter( 'the_custom_logo', 'arlene_body_classes' );
    
    /*
     * Do the typing machine thing
     *
     */
     function arlene_typing_machine(){
         $text = "a minimalist woodstyle theme/ it looks like wood/ and tastes like soup.";
         if(get_theme_mod( 'typing_text' ) && ""!=get_theme_mod( 'typing_text' )) {
            $text = get_theme_mod( 'typing_text' );
         }
         $lines = explode('/', $text);
         foreach($lines as $line){
             echo '<p>';
                echo $line;
             echo '</p>';
         }
     }
    
    /*
     * Getters for customizer options
     *
     */
     function arlene_get_events_label(){
         $text = __("Events", "arlene");
         if(get_theme_mod( 'events_label' ) && ""!=get_theme_mod( 'events_label' )) {
            $text = get_theme_mod( 'events_label' );
         }
         return $text;
     }
    function arlene_get_events_page(){
         $text = "#";
         if(get_theme_mod( 'events_page' ) && ""!=get_theme_mod( 'events_page' )) {
            $text = get_theme_mod( 'events_page' );
         }
         return $text;
     }
    
    function arlene_get_programmes_label(){
         $text = __("Our programmes", "arlene");
         if(get_theme_mod( 'programmes_label' ) && ""!=get_theme_mod( 'programmes_label' )) {
            $text = get_theme_mod( 'programmes_label' );
         }
         return $text;
     }
    function arlene_get_programmes_page(){
        $text = "#"; 
        if(get_theme_mod( 'programmes_page' ) && ""!=get_theme_mod( 'programmes_page' )) {
            $text = get_theme_mod( 'programmes_page' );
         }
         return $text;
     }
        
    /*
     * Override the default post_thumbnail() content
     *
     */
    function arlene_get_attachment_id_from_src( $image_src ) {
        global $wpdb;
        $query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
        $id = $wpdb->get_var($query);
        return $id;
    }
    function arlene_get_first_image($post_id) {
        $post = get_post($post_id);
        $post_content = $post->post_content;
        preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post_content, $matches);
        if(0<count($matches[1])) {
            return $matches[1][0];
        }
        
    }

    function arlene_modify_post_thumbnail_html($html, $post_id, $post_thumbnail_id, $size, $attr) {
        if( '' == $html ) {
            $attr['class'] = 'default';
            global $post, $posts;
            ob_start();
            ob_end_clean();
            
            arlene_get_first_image($post_id);
            $first_img = arlene_get_first_image($post_id);
            if ( !empty( $first_img ) ){
                $html = '<img src="' . $first_img . '" alt="' . $alt . '" class="' . $attr['class'] . '" />';
            }
        }
        return $html;
    }
    add_filter('post_thumbnail_html', 'arlene_modify_post_thumbnail_html', 10, 5);

    /*
     * Check if thumbnail or firstImage exist
     *
     */
    function has_post_thumbnail_or_image(){
        global $post;
        $first_img = arlene_get_first_image($post->ID);
        if(!has_post_thumbnail())
            if (empty( $first_img ) ){
                return false;
            }
        return true;
    }
    /**
     * Add Thumbnail Column to Post Listing
     */

    add_image_size( 'admin-list-thumb', 80, 80, false );

    function arlene_add_thumbnail_columns( $columns ) {

        if ( !is_array( $columns ) )
            $columns = array();
        $new = array();

        foreach( $columns as $key => $title ) {
            if ( $key == 'title' ) // Put the Thumbnail column before the Title column
                $new['featured_thumb'] = __( 'Image');
            $new[$key] = $title;
        }
        return $new;
    }

    function arlene_add_thumbnail_columns_data( $column, $post_id ) {
        switch ( $column ) {
        case 'featured_thumb':
            echo '<a href="' . $post_id . '">';
            echo the_post_thumbnail( 'admin-list-thumb' );
            echo '</a>';
            break;
        }
    }

    if ( function_exists( 'add_theme_support' ) ) {
        add_filter( 'manage_posts_columns' , 'arlene_add_thumbnail_columns' );
        add_action( 'manage_posts_custom_column' , 'arlene_add_thumbnail_columns_data', 10, 2 );
    }
    
    /*
     * Creating the social nav menu
     * inspired by @http://justintadlock.com/archives/2013/08/14/social-nav-menus-part-2
     *
     */
    add_action( 'init', 'acajou_register_nav_menus' );

    function acajou_register_nav_menus() {
        register_nav_menu( 'social', __( 'Social', 'acajou' ) );
    }

    /*
     * A function for creating  Custom Post Types (CPT)
     * @link http://www.wpbeginner.com/wp-tutorials/how-to-create-custom-post-types-in-wordpress/
     */

    function arlene_register_post_type($singular,$plural,$taxonomies, $description, $icon) {
        // Set UI labels for Custom Post Type
        $labels = array(
            'name'                => _x( ucfirst($plural), 'Post Type General Name', 'arlene' ),
            'singular_name'       => _x( ucfirst($singular), 'Post Type Singular Name', 'arlene' ),
            'menu_name'           => __( ucfirst($plural), 'arlene' ),
            'parent_item_colon'   => __( 'Parent '.ucfirst($singular), 'arlene' ),
            'all_items'           => __( 'All '.ucfirst($plural), 'arlene' ),
            'view_item'           => __( 'View '.ucfirst($singular), 'arlene' ),
            'add_new_item'        => __( 'Add New '.ucfirst($singular), 'arlene' ),
            'add_new'             => __( 'Add '.ucfirst($singular), 'arlene' ),
            'edit_item'           => __( 'Edit '.ucfirst($singular), 'arlene' ),
            'update_item'         => __( 'Update '.ucfirst($singular), 'arlene' ),
            'search_items'        => __( 'Search '.ucfirst($singular), 'arlene' ),
            'not_found'           => __( 'Not Found', 'arlene' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'arlene' ),
        );

    // Set other options for Custom Post Type

        $args = array(
            'label'               => __( $plural, 'arlene' ),
            'description'         => __( $description, 'arlene' ),
            'labels'              => $labels,
            // Features this CPT supports in Post Editor
            'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
            // You can associate this CPT with a taxonomy or custom taxonomy. 
            'taxonomies'          => $taxonomies,
            /* A hierarchical CPT is like Pages and can have
            * Parent and child items. A non-hierarchical CPT
            * is like Posts.
            */	
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'menu_icon'           => $icon,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
        );
            register_post_type($singular, $args);
    }

    function arlene_custom_post_types() {
        // Registering your Custom Post Type
        arlene_register_post_type('programme','programmes', array('categories'), 'Programmes','dashicons-portfolio');
        arlene_register_post_type('event','events', array('categories'), 'Past and future events','dashicons-calendar-alt');
    }

    add_action( 'init', 'arlene_custom_post_types', 0 );

    /*
     * Check is a certain template is currently being used 
     * by a page. If yes, return the url of that page
     */
    function arlene_get_template_url($filename) {
        if ( is_page_template($filename) ) {
            echo $filename.' is being used';
        } else {
            //return false;// Returns false when 'about.php' is not being used.
            echo $filename.' is not being used';
        }
    }