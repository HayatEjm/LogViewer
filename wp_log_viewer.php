<?php

/*
Plugin Name: Visualiseur du fichier debug.log
Description: Plugin réalisé en POO
Author:BIBI
Version: 1.0
*/

defined('ABSPATH') || exit;
//require
//


function _JL_init_pluggin()
{
    //initialiser la classe principale du plugin

}
add_action('plugins_loaded', '_JL_init_pluggin');

function JL_log_viewer_activate()
{
//appeler une méthode de la classe principale pour mener des actions  
}

register_activation_hook(__FILE__, 'JL_log_viewer_activate');


function JL_log_viewer_deactivation()
{
//appeler une methode de la classe principle pour mener des actions

}



register_deactivation_hook( __FILE__, 'JL_log_viewer_deactivation' );

function JL_log_viewer_desinstallation()
{
    //appeler une méthode de la classe principale pour mener des actions

}

register_deactivation_hook( __FILE__, 'JL_log_viewer_desinstallation' );




