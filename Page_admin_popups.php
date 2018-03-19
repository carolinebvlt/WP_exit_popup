<?php
/*
  - Créer un custom post type pour ajouter/éditer des pop-ups : garde title et editor (titre + description du popup)
  - Ajoute une metabox pour renseigner le lien du pop-up
*/

 class Page_admin_popups
 {
   public function __construct(){
     add_action('init', [$this, 'register_popup_type'], 0 );
     add_action('add_meta_boxes',[$this, 'init_popup_link_box']);
     add_action('save_post',[$this,'save_popop_link_box']);
   }

   /************************  LINK BOX  *********************************/

   public function init_popup_link_box(){
     add_meta_box('id_meta_popuplink', 'Pop-up\'s link', [$this, 'popup_link_box_render'], 'popup_type');
   }

   public function save_popop_link_box($post_ID){
     if(isset($_POST['popup_link'])){
       update_post_meta($post_ID,'_popup_link', esc_html($_POST['popup_link']));
     }
   }

   /* RENDER */
   public function popup_link_box_render($post){
     $val = get_post_meta($post->ID,'_popup_link',true);
     echo '<label for="popup_link">URL : https://</label>';
     echo '<input id="popup_link" type="text" name="popup_link" value="'.$val.'"/>';
   }

   /************************  POPUP_TYPE (custum post type)  *********************************/

   public function register_popup_type() {

    $labels = array(
      'name'                  => _x( 'Pop-ups', 'Post Type General Name', 'text_domain' ),
      'singular_name'         => _x( 'Pop-up', 'Post Type Singular Name', 'text_domain' ),
      'menu_name'             => __( 'Exit popup plugin', 'text_domain' ),
      'name_admin_bar'        => __( 'Exit Pop-up Plugin', 'text_domain' ),
      'archives'              => __( 'Item Archives', 'text_domain' ),
      'attributes'            => __( 'Item Attributes', 'text_domain' ),
      'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
      'all_items'             => __( 'All Pop-ups', 'text_domain' ),
      'add_new_item'          => __( 'Add New Pop-up', 'text_domain' ),
      'add_new'               => __( 'Add New', 'text_domain' ),
      'new_item'              => __( 'New Pop-up', 'text_domain' ),
      'edit_item'             => __( 'Edit Pop-up', 'text_domain' ),
      'update_item'           => __( 'Update Pop-up', 'text_domain' ),
      'view_item'             => __( 'View Pop-up', 'text_domain' ),
      'view_items'            => __( 'View Pop-ups', 'text_domain' ),
      'search_items'          => __( 'Search Pop-up', 'text_domain' ),
      'not_found'             => __( 'Not found', 'text_domain' ),
      'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
      'featured_image'        => __( 'Featured Image', 'text_domain' ),
      'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
      'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
      'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
      'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
      'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
      'items_list'            => __( 'Items list', 'text_domain' ),
      'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
      'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
    );
    $args = array(
      'label'                 => __( 'Popup', 'text_domain' ),
      'description'           => __( 'Post Type Description', 'text_domain' ),
      'labels'                => $labels,
      'supports'              => array( 'title', 'editor'),
      'hierarchical'          => false,
      'public'                => false,
      'show_ui'               => true,
      'show_in_menu'          => true,
      'menu_position'         => 5,
       'menu_icon'             => 'dashicons-megaphone',
      'show_in_admin_bar'     => true,
      'show_in_nav_menus'     => true,
      'can_export'            => true,
      'has_archive'           => true,
      'exclude_from_search'   => false,
      'publicly_queryable'    => true,
       'rewrite'               => false,
      'capability_type'       => 'page',
    );
    register_post_type( 'popup_type', $args );
   }
 }
