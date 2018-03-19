<?php
/*
  - Regarde dans la requête quels articles doivent être afficher :
    - si il y en a plusieurs (page archives,...), pas de pop-up
    - si il n'y en a qu'un, regarde si un pop-up lui est assigné
    - si oui, récupère les données et lance le script
*/

class Popups
{
  public function __construct(){
    add_action('wp', [$this, 'enqueue_my_script']);
  }

  public function enqueue_my_script() {
    $rq = $GLOBALS['wp_query']->posts;

    if(count($rq) == 1){ // Si un seul article affiché
      include 'traits/get_popup_of_post.php';
      $data = get_popup_of_post($rq[0]->ID);

      if($data['popup_url'] !== NULL){
        wp_register_script('popup_script', plugin_dir_url(__FILE__) . 'popup_script.js');
        $data_popup_script = [
          'popupTitle' => $data['popup_title'],
          'popupDescription' => $data['popup_description'],
          'popupUrl' => $data['popup_url']
        ];
        wp_localize_script('popup_script', 'popupData', $data_popup_script);
        wp_enqueue_script('popup_script');
      }
    }
  }
}
