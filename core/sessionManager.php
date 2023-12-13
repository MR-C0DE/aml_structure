<?php


class SessionManager
{
    /**
     * Démarre ou reprend une session.
     */
    public static function start()
    {
        session_start();
    }

    /**
     * Enregistre une variable de session.
     *
     * @param string $key   Clé de la variable de session.
     * @param mixed  $value Valeur de la variable de session.
     */
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Récupère une variable de session.
     *
     * @param string $key     Clé de la variable de session.
     * @param mixed  $default Valeur par défaut à retourner si la variable n'est pas définie.
     *
     * @return mixed Valeur de la variable de session ou la valeur par défaut si elle n'est pas définie.
     */
    public static function get($key, $default = null)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
    }

    /**
     * Supprime une variable de session.
     *
     * @param string $key Clé de la variable de session à supprimer.
     */
    public static function delete($key)
    {
        unset($_SESSION[$key]);
    }

    /**
     * Détruit la session en cours.
     */
    public static function destroy()
    {
        session_destroy();
    }
}
