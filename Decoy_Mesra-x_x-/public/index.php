<?php


namespace app\public;

error_reporting(E_ERROR); 


use app\core\Application;
use app\controllers\SiteController;
use app\controllers\AuthController;
use Dotenv;


require_once __DIR__ . '/../vendor/autoload.php';

$config = [
    'db' => [
        'dsn' => getenv('DB_DSN'),
        'user' => getenv('DB_USER'),
        'password' => getenv('DB_PASSWORD')
    ]
];

$app = new Application(dirname(__DIR__), $config);

$app->router->get('/', [SiteController::class, 'loginRedirect']);
$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->get('/dashboard', [SiteController::class, 'dashboard']);
$app->router->get('/mapel', [SiteController::class, 'mapel']);
$app->router->get('/transaksi_murid', [SiteController::class, 'transaksi_murid']);
$app->router->get('/guruPage', [SiteController::class, 'guruPage']);
$app->router->get('/transaksi', [SiteController::class, 'transaksi']);
$app->router->get('/formTransaksi', [SiteController::class, 'formTransaksi']);
$app->router->get('/grading', [SiteController::class, 'grading']);
$app->router->get('/saran', [SiteController::class, 'saran']);
$app->router->get('/logout', [SiteController::class, 'formTransaksi']);
$app->router->get('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->get('/logout', [SiteController::class, 'logout']);

$app->router->post('/contact', [SiteController::class, 'handleContact']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->post('/mapel', [SiteController::class, 'mapel']);
$app->router->post('/grading', [SiteController::class, 'grading']);
$app->router->post('/formTransaksi', [SiteController::class, 'formTransaksi']);
$app->router->post('/delete-transaksi', [SiteController::class, 'deleteTransaksi']);


$app->run();

?>
