<?php
require_once __DIR__ . '/config.php';

class Database {
    private static ?PDO $instance = null;

    public static function getConnection(): PDO {
        if (self::$instance === null) {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
            ];
            try {
                self::$instance = new PDO($dsn, DB_USER, DB_PASS, $options);
            } catch (PDOException $e) {
                error_log("DB Connection failed: " . $e->getMessage());
                $isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                          strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
                if ($isAjax) {
                    header('Content-Type: application/json');
                    die(json_encode(['success' => false, 'message' => 'Database connection error.']));
                }
                http_response_code(503);
                die('<!DOCTYPE html><html><head><title>Service Unavailable</title></head><body style="font-family:sans-serif;text-align:center;padding:80px"><h2>We\'ll be back soon</h2><p>Our site is temporarily undergoing maintenance. Please try again in a few minutes.</p></body></html>');
            }
        }
        return self::$instance;
    }
}

function db(): PDO {
    return Database::getConnection();
}
