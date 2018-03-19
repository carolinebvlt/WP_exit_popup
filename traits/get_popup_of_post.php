<?php
function get_popup_of_post($id_of_post){

  $_popup_id = get_post_meta($id_of_post, '_popup_choice')[0]; 
  if($_popup_id === '-'){
    return false;
  }
  else{
    if(intval($_popup_id) !== 0){
      $popup_id = intval($_popup_id);
      $popup_url = get_post_meta($popup_id, '_popup_link')[0];
      $args = ['p' => $popup_id, 'post_type' => ['popup_type']];
      $query = new WP_Query($args);
      $popup_title = $query->post->post_title;
      $popup_description = $query->post->post_content;

      $data = [
        'popup_id'            => $popup_id,
        'popup_title'         => $popup_title,
        'popup_description'   => $popup_description,
        'popup_url'           => $popup_url
      ];
      return $data;
    }
    else{
      return false;
    }
  }
}
