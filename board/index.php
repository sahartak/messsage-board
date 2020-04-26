<?php
require_once dirname(__DIR__).'/configs/autoload.php';
define('APP_DIR', __DIR__);

$app = new \board\BoardApp();
$app->run();