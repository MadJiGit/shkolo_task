<?php

namespace App;

require_once __DIR__ . '/autoloader.php';
require_once('config/LoadDB.php');

use App\Database\DatabaseConnection;
use App\Controllers\ButtonController;
use App\Models\ButtonRepository;

// Initialize database connection and model
$dotenv = new LoadDB;
$dotenv->load(__DIR__ . "/config/db.ini.php");

$db = DatabaseConnection::getConnection();

$model = new ButtonRepository($db);
$controller = new ButtonController($model);

$action = $_GET['action'] ?? 'index';
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

try {
    switch ($action) {
        case 'edit':
            if ($id === null) {
                throw new \Exception("No ID provided for edit");
            }
            $controller->edit($id);
            break;

        case 'save':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->save($_POST);
            } else {
                throw new \Exception("Invalid request method for save");
            }
            break;

        case 'clear':
            if ($id !== null) {
                $controller->clear($id);
            }
            break;

        default:
            $controller->index();
            break;
    }
} catch (\Exception $e) {
    echo 'Error: ' . htmlspecialchars($e->getMessage());
}