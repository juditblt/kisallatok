<?php
const APP_PATH = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR .
    'app' . DIRECTORY_SEPARATOR;
const VIEW_PATH = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR .
    'resources' . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR;

require_once APP_PATH.'exception/RouteNotFoundException.php';
require_once APP_PATH.'exception/ViewNotFoundException.php';

require_once APP_PATH.'Router.php';
require_once APP_PATH.'DB.php';
require_once APP_PATH.'models/Pet.php';
require_once APP_PATH.'Session.php';
require_once APP_PATH.'View.php';
require_once APP_PATH.'controller/PetsController.php';

use App\Router;
use App\DB;
use App\View;
use App\Session;
use App\Controller\PetsController;
use App\Exception\RouteNotFoundException;
use App\Exception\ViewNotFoundException;

session_start();

// útvonalakhoz tartozó fgv-k regisztrációja:
$router = new Router();

$router
    -> get('/', [PetsController::class, 'index'])
    -> get('/create', [PetsController::class, 'create'])
    -> post('/create', [PetsController::class, 'store'])
    -> get('/details', [PetsController::class, 'show'])
    -> get('/sell', [PetsController::class, 'sell'])
    -> get('/delete', [PetsController::class, 'delete'])
    -> get('/edit', [PetsController::class, 'edit'])
    -> post('/edit', [PetsController::class, 'update']);


try {
    echo $router->resolve($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
} catch (RouteNotFoundException $ex) {
    echo $ex->getMessage();
} catch (ViewNotFoundException $ex){
    echo $ex->getMessage();
}