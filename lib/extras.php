<?php
/**
 * Clean up the_excerpt()
 */
function roots_excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'roots') . '</a>';
}
add_filter('excerpt_more', 'roots_excerpt_more');

/**
 * Manage output of wp_title()
 */
function roots_wp_title($title) {
  if (is_feed()) {
    return $title;
  }

  $title .= get_bloginfo('name');

  return $title;
}
add_filter('wp_title', 'roots_wp_title', 10);



function enhance_post( ) {

    global $wp_post_types;
    $wp_post_types['post']->hierarchical = true;
    $wp_post_types['post']->has_archive = true;
    $wp_post_types['post']->public = true;
    $wp_post_types['post']->query_var = true;
    $wp_post_types['post']->publicly_queryable = true;

    /*##########################################
    # Solução: criar um novo post type para notícias 
    # e incluir no menu
    # ou criar um page template para o post type (blog)
    # assim ele poderá ser incluído no menu sem precisar de plugin
    ############################################ */

    //$wp_post_types['post']->rewrite = array('slug' => 'post', 'with_front' => false);
//    print_r($wp_post_types['post']);
}
add_action( 'init', 'enhance_post' );
/*

add_filter( 'template_include', 'enhance_post_template' );
function enhance_post_template( $original_template ) {
    // we're loading the template conditionally, 
    // but only if we're actually at the »aview« "endpoint"
    if (get_query_var('post_type')  == 'post')  {
        // you've to create the template you want to use here
        return get_template_directory().'/archive.php';
    } else {
        return $original_template;
    }
}
*/

/**
 * Register Custom Taxonomy
 */
// Portfolio taxonomy
function esportes() {
  add_rewrite_tag( '%post_type%', '([^/]+)' );
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name'              => _x( 'Esportes', 'Esportes' ),
    'singular_name'     => _x( 'Esporte', 'Esporte' ),
    'all_items'         => __( 'Esportes' ),
    'edit_item'         => __( 'Editar esporte' ),
    'update_item'       => __( 'Atualizar esporte' ),
    'add_new_item'      => __( 'Adicionar nova esporte' ),
    'new_item_name'     => __( 'Novo esporte' ),
    'menu_name'         => __( 'Esportes' )
  );

  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'has_archive'       => true,
    'show_in_menu'      => true,
    'show_in_nav_menus' => true,
    'rewrite'           => array('slug' => 'esportes', 'with_front' => true)
  );

  register_taxonomy('esportes', 'albuns', $args );
}

// Hook into the 'init' action
add_action( 'after_setup_theme', 'esportes', 0 );

/**
 * Register Post type
 */
// Custom post type albuns
function albuns() {
  $labels = array(
    'name'              => _x( 'Álbuns', 'Álbuns' ),
    'singular_name'     => _x( 'Álbum', 'Álbum' ),
    'all_items'         => __( 'Todos os álbuns' ),
    'edit_item'         => __( 'Editar álbuns' ),
    'update_item'       => __( 'Atualizar álbuns' ),
    'add_new_item'      => __( 'Adicionar novo álbum' ),
    'new_item_name'     => __( 'Novo álbum' ),
    'menu_name'         => __( 'Álbuns' ),
  );

  register_post_type( 'albuns',
    array(
      'labels'          => $labels,
      'public'          => true,
      'menu_position'   => 6,
      'query_var'       => true,
      'has_archive'     => true,
      'show_in_nav_menus' => true,
      'hierarchical'    => true,
      'menu_icon' => 'dashicons-images-alt2',
      'supports' => array('title','thumbnail', 'slug', 'excerpt'),
      'taxonomies' => array('esportes'),
      'rewrite' => array('slug' => 'albuns','with_front' => true)
    )
  );
}
// Hook into the 'init' action
add_action( 'after_setup_theme', 'albuns', 0 );


// Custom post type Home Banners (Slides)
function home_banner() {
  $labels = array(
    'name'              => _x( 'Slide', 'Slide' ),
    'singular_name'     => _x( 'Slide', 'Slide' ),
    'all_items'         => __( 'Todos os slides' ),
    'edit_item'         => __( 'Editar slide' ),
    'update_item'       => __( 'Atualizar slide' ),
    'add_new_item'      => __( 'Adicionar novo slide' ),
    'new_item_name'     => __( 'Novo slide' ),
    'menu_name'         => __( 'Slider' ),
  );

  register_post_type( 'home_banner',
    array(
      'labels' => $labels,
      'public' => true,
      'menu_position' => 4,
      'menu_icon' => 'dashicons-slides',
      'query_var' => true,
      'supports' => array('title','thumbnail', 'slug', 'excerpt'),
      'rewrite' => array('slug' => 'home_banner')
    )
  );
}
// Hook into the 'init' action
add_action( 'after_setup_theme', 'home_banner', 0 );


add_theme_support('soil-relative-urls');

// Attachments fields plugin
function attachments_field( $attachments ) {
  $args = array(
 
    // title of the meta box (string)
    'label'         => 'Galeria',
 
    // all post types to utilize (string|array)
    'post_type'     => array( 'albuns' ),
 
    // allowed file type(s) (array) (image|video|text|audio|application)
    'filetype'      => ('image'),  // no filetype limit
 
    // include a note within the meta box (string)
    'note'          => "Não há imagens!",
 
    // text for 'Attach' button in meta box (string)
    'button_text'   => __( 'Escolher Imagens', 'attachments' ),
 
    // text for modal 'Attach' button (string)
    'modal_text'    => __( 'Adicionar', 'attachments' ),
 
    /**
     * Fields for the instance are stored in an array. Each field consists of
     * an array with three keys: name, type, label.
     *
     * name  - (string) The field name used. No special characters.
     * type  - (string) The registered field type.
     *                  Fields available: text, textarea
     * label - (string) The label displayed for the field.
     */
 
    'fields'        => array(
      array(
        'name'  => 'title',                          // unique field name
        'type'  => 'text',                           // registered field type
        'label' => __( 'Title', 'attachments' ),     // label to display
      ),
      array(
        'name'  => 'caption',                        // unique field name
        'type'  => 'textarea',                       // registered field type
        'label' => __( 'Caption', 'attachments' ),   // label to display
      ),
      array(
        'name'  => 'copyright',                      // unique field name
        'type'  => 'text',                           // registered field type
        'label' => __( 'Copyright', 'attachments' ), // label to display
      ),
    ),
 
  );
 
  $attachments->register( 'attachments_field', $args ); // unique instance name
}
 
add_action( 'attachments_register', 'attachments_field' );

// Facebook Open Graph
add_action('wp_head', 'add_fb_open_graph_tags');
function add_fb_open_graph_tags() {
  if (is_single()) {
    global $post;
    if(get_the_post_thumbnail($post->ID, 'thumbnail')) {
      $thumbnail_id = get_post_thumbnail_id($post->ID);
      $thumbnail_object = get_post($thumbnail_id);
      $image = $thumbnail_object->guid;
    } else {  
      $image = ''; // Change this to the URL of the logo you want beside your links shown on Facebook
    }
    //$description = get_bloginfo('description');
    $description = my_excerpt( $post->post_content, $post->post_excerpt );
    $description = strip_tags($description);
    $description = str_replace("\"", "'", $description);
?>
<meta property="og:title" content="<?php the_title(); ?>" />
<meta property="og:type" content="article" />
<meta property="og:image" content="<?php echo $image; ?>" />
<meta property="og:url" content="<?php the_permalink(); ?>" />
<meta property="og:description" content="<?php echo $description ?>" />
<meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>" />

<?php   
  }
}



function my_excerpt($text, $excerpt){
  
    if ($excerpt) return $excerpt;

    $text = strip_shortcodes( $text );

    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]&gt;', $text);
    $text = strip_tags($text);
    $excerpt_length = apply_filters('excerpt_length', 55);
    $excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
    $words = preg_split("/[\n
   ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
    if ( count($words) > $excerpt_length ) {
            array_pop($words);
            $text = implode(' ', $words);
            $text = $text . $excerpt_more;
    } else {
            $text = implode(' ', $words);
    }

    return apply_filters('wp_trim_excerpt', $text, $excerpt);
}


/**
 * Custom post type specific rewrite rules
 * @return wp_rewrite             Rewrite rules handled by Wordpress
 */


function cpt_rewrite_rules($wp_rewrite) {
  $rules = cpt_generate_archives('E', $wp_rewrite);
  $wp_rewrite->rules = $rules + $wp_rewrite->rules;
  return $wp_rewrite;
}
add_action('generate_rewrite_rules', 'cpt_rewrite_rules');


/**
 * Generate archive rewrite rules for a given custom post type
 * @param  string $cpt        slug of the custom post type
 * @return rules              returns a set of rewrite rules for Wordpress to handle
 */


function cpt_generate_archives($cpt, $wp_rewrite) {
  $rules = array();

  $post_type = get_post_type_object($cpt);
  if ($post_type->has_archive === false)
    return $rules;

  $taxonomies = get_taxonomies(array(), 'objects');
//print_r($taxonomies);
  $permalink_structs = array();

  foreach ($taxonomies as $key => $tax) {
    // get first associated taxonomy
    if ($tax->object_type[0] == $cpt) {
      $permalink_structs[] = array(
        'rule' => "{$tax->rewrite['slug']}/([^/]+)",
        'vars' => array($tax->query_var)    
      );
      break;
    }
  }

  foreach ($permalink_structs as $data) {
    $query = 'index.php?post_type='.$cpt;
    $rule = $slug_archive.'/'.$data['rule'];

    $i = 1;
    foreach ($data['vars'] as $var) {
        $query.= '&'.$var.'='.$wp_rewrite->preg_index($i);
        $i++;
    }

    $rules[$rule."/?$"] = $query;

    if ($post_type->rewrite['feeds']) {
      $rules[$rule."/feed/(feed|rdf|rss|rss2|atom)/?$"] = $query."&feed=".$wp_rewrite->preg_index($i);
      $rules[$rule."/(feed|rdf|rss|rss2|atom)/?$"] = $query."&feed=".$wp_rewrite->preg_index($i);
    }
    if ($post_type->rewrite['pages']) {
      $rules[$rule."/page/([0-9]{1,})/?$"] = $query."&paged=".$wp_rewrite->preg_index($i);
    }
  }
return $rules;
}


/*
add_filter('term_link', 'ptype_permalink', 1, 3);
function ptype_permalink($term_name, $taxonomy, $cpt_slug) {
  global $wp_rewrite;

  $newlink = $wp_rewrite->get_extra_permastruct($cpt_slug);
  $newlink = str_replace("%post_type%", $cpt_slug, $newlink);
  $newlink = str_replace("%esportes%", $term_name, $newlink);
  $newlink = home_url(user_trailingslashit($newlink));
  return $newlink;
}

*/