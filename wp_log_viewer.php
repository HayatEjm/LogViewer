<?php

/*
Plugin Name: Visualiseur du fichier debug.log
Description: Plugin réalisé en POO
Author:BIBI
Version: 1.0
*/

defined('ABSPATH') || exit;
//require
//plugin dir_path(__FILE__) permet de récupérer le chemin du dossier du plugin (methde wordpress)
require_once plugin_dir_path (__FILE__)."includes/LogViewer.php";

use WPLogViewer\LogViewer;


function _JL_init_pluggin()
{
    //initialiser la classe principale du plugin
    \WPLogViewer\LogViewer::getInstance()->init();

}
add_action('plugin_loaded', '_JL_init_pluggin');

function JL_log_viewer_activate()
{
error_log('Le plugin a été activé');
   
}

register_activation_hook(__FILE__, 'JL_log_viewer_activate');


function JL_log_viewer_deactivation()
{

    error_log("Le plugin a été désactivé");
//appeler une methode de la classe principle pour mener des actions

}



register_deactivation_hook( __FILE__, 'JL_log_viewer_deactivation' );

function JL_log_viewer_desinstallation()
{
    //appeler une méthode de la classe principale pour mener des actions

}

register_deactivation_hook( __FILE__, 'JL_log_viewer_desinstallation' );




