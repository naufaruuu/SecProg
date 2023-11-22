<?php


namespace app;

use app\core\Application;
use app\controllers\SiteController;
use app\controllers\AuthController;
use Dotenv;


require_once __DIR__ . '/vendor/autoload.php';

$config = [
    'db' => [
        'dsn' => getenv('DB_DSN'),
        'user' => getenv('DB_USER'),
        'password' => getenv('DB_PASSWORD')
    ]
];

$app = new Application(__DIR__, $config);

$app->db->applyMigrations();

?>

