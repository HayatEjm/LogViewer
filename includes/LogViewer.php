<?php

namespace WPLogViewer;

defined('ABSPATH') || exit;


class LogViewer
{
    private static ?LogViewer $instance = null;
    private string $logfile; //contient le chemin vers le fichier du log


    public function init(): void //void=elle ne retourne rien
    {
        error_log("Le plugin a été initialisé");
        $this->logfile = WP_CONTENT_DIR . '/debug.log'; //chemin vers le fichier de log
        error_log($this->logfile);


        add_action('admin_menu', [$this, 'add_admin_menu']); //ajoute un menu dans le tableau de bord admin
        //$this lié à l'instance de class en cours d'exécution
        add_action('admin_init', [$this, 'handle_log_clear']); //gère la demande de nettoyage du log

        
    }

//design pattern singleton
    //permet de s'assurer qu'il n'y a qu'une seule instance de la classe LogViewer
    public static function getInstance(): LogViewer
    {
        if (is_null(self::$instance)) {
            self::$instance = new LogViewer();
        }
        return self::$instance;
    }

    public static function activate(): void {}

    public static function desactivate(): void {}

    public static function uninstall(): void {}

   public function add_admin_menu(): void {
    add_menu_page(
        'Fichier de log',
        'Fichier de log',
        'manage_options',
        'debug-log-viewer',
        [$this, 'render_log_page'],
        'dashicons-media-text',
        90
    );
}


    public function handle_log_clear(): void {

        if (
            isset($_GET['debug_log_clear']) &&
            $_GET['debug_log_clear'] === '1' &&
            current_user_can('manage_options')
        ) {
            if (file_exists($this->logfile)) {
                file_put_contents($this->logfile, '');
            }

            wp_redirect(admin_url('admin.php?page=debug-log-viewer&cleared=1'));
            exit;
        }
    }

    public function render_log_page(): void {

       echo '<div class="wrap">';
        echo '<h1>Fichier debug.log</h1>';

        if (isset($_GET['cleared']) && $_GET['cleared'] == 1) {
            echo '<div class="notice notice-success is-dismissible"><p>Le fichier debug.log a été vidé avec succès.</p></div>';
        }

        echo '<p><a href="' . esc_url(admin_url('admin.php?page=debug-log-viewer&debug_log_clear=1')) . '" class="button">Vider le log</a></p>';
        echo '<p><label for="log-search">Filtrer les lignes du log :</label> ';
        echo '<input type="text" class="log-search" placeholder="Error..." style="min-width: 300px;"></p>';
        echo '<p><a href="#" class="button btn-search">Rechercher dans le log</a></p>';

        echo '<section class="containerlog"><div class="pre_container"><pre style="background:#111; color:#0f0; padding:1rem; max-height:500px; overflow:auto;">';

        if (file_exists($this->logfile)) {
            echo esc_html(file_get_contents($this->logfile));
        } else {
            echo 'Le fichier debug.log est introuvable ou vide.';
        }

        echo '</pre></div></section></div>'; echo "<h1> log viewer</h1>";
    }
}
