<?php

// Fichier : ./core/CookieManager.php

class CookieManager
{
    /**
     * Définit un cookie.
     *
     * @param string $name    Nom du cookie.
     * @param mixed  $value   Valeur du cookie.
     * @param int    $expire  Date d'expiration du cookie (timestamp).
     * @param string $path    Chemin où le cookie est disponible.
     * @param string $domain  Domaine où le cookie est disponible.
     * @param bool   $secure  Indique si le cookie doit être sécurisé (HTTPS).
     * @param bool   $httponly Indique si le cookie doit être accessible uniquement via HTTP.
     */
    public static function set($name, $value, $expire = 0, $path = '/', $domain = '', $secure = false, $httponly = false)
    {
        setcookie($name, $value, $expire, $path, $domain, $secure, $httponly);
    }

    /**
     * Récupère la valeur d'un cookie.
     *
     * @param string $name     Nom du cookie.
     * @param mixed  $default  Valeur par défaut à retourner si le cookie n'est pas défini.
     *
     * @return mixed Valeur du cookie ou la valeur par défaut si le cookie n'est pas défini.
     */
    public static function get($name, $default = null)
    {
        return isset($_COOKIE[$name]) ? $_COOKIE[$name] : $default;
    }

    /**
     * Supprime un cookie.
     *
     * @param string $name Nom du cookie à supprimer.
     */
    public static function delete($name)
    {
        if (isset($_COOKIE[$name])) {
            // Réinitialise le cookie avec une date d'expiration passée pour le supprimer
            setcookie($name, '', time() - 3600, '/');
            unset($_COOKIE[$name]);
        }
    }
}
