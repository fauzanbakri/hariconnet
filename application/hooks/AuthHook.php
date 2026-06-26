<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthHook {

    public function checkSession()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $ci =& get_instance();
        $uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';

        $publicPaths = array('login', 'index.php', 'assets', 'js', 'css', 'images', 'favicon.ico');
        $lowerUri = strtolower($uri);
        foreach ($publicPaths as $public) {
            if (strpos($lowerUri, '/' . $public) !== false) {
                return;
            }
        }

        if (empty($_SESSION['role'])) {
            $basePath = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
            if ($basePath === '/') {
                $basePath = '';
            }
            $loginUrl = $basePath . '/Login';
            header('Location: ' . $loginUrl);
            exit;
        }
    }
}
