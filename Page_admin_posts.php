<?php
/*
  - Ajoute une metabox sur la page d'édition des articles pour choisir d'activer un pop-up
*/

class Page_admin_posts
{
  public function __construct(){
    add_action('add_meta_boxes',[$this, 'init_popup_choice_box']);
    add_action('save_post',[$this,'save_popup_choice_box']);
  }

  /************************  SELECT BOX  *********************************/

  public function init_popup_choice_box(){
    add_meta_box('id_meta_popup_choice', 'Activate an "exit pop-up"', [$this, 'popup_choice_box_render'], 'post');
  }

  public function save_popup_choice_box($post_ID){
    if(isset($_POST['popup_choice'])){
      update_post_meta($post_ID, '_popup_choice', $_POST['popup_choice']);
    }
  }

  /* RENDER */
  public function popup_choice_box_render(){
    global $wpdb;

    // pour afficher le choix déjà sélectionné avec selected()
    include 'traits/get_popup_of_post.php';
    $data = get_popup_of_post(get_the_ID());

    $popup_possibilities = $wpdb->get_results("SELECT ID, post_title FROM {$wpdb->prefix}posts WHERE post_type = 'popup_type' AND post_status = 'publish' ");

    echo '<select name="popup_choice">';
    echo '<option value ="-" > - </option>';
    foreach ($popup_possibilities as $key=>$value) {
      echo '<option value="' .$value->ID. '"'. selected($data['popup_title'], $value->post_title ) .'>'. $value->post_title.'</option>';
    }
    echo '</select>';
  }
}
