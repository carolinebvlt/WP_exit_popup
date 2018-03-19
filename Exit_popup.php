<?php
/*
Plugin Name: Exit Popup Plugin
Description: Permet d'ajouter un "exit popup" sur les articles
Version: 0.2.1
Author: CeaB
*/

class Exit_Popup_Plugin
{
  public function __construct()
  {
    include_once plugin_dir_path( __FILE__ ).'/Page_admin_popups.php';
    new Page_admin_popups();
    include_once plugin_dir_path( __FILE__ ).'/Page_admin_posts.php';
    new Page_admin_posts();
    include_once plugin_dir_path( __FILE__ ).'/Popups.php';
    new Popups();
  }
}
new Exit_Popup_Plugin();
