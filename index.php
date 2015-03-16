<?php

require __DIR__ . '/vendor/autoload.php';

define('URI', $_SERVER['REQUEST_URI']);
define('METHOD', $_SERVER['REQUEST_METHOD']);

$routes = [
  'GET'  => ['/' => 'Mederi\ImageController::form'],
  'POST' => ['/images/upload' => 'Mederi\ImageController::upload']
];

try {

  $app = new Mederi\Application;
  $app->setRoutes($routes);  
  $app->dispatch(METHOD, URI);

} catch(Mederi\ExceptionBase $e) {
  echo $e->getMessage();
} catch(Mederi\NotFoundException $e) {
  http_response_code(404);
  echo $e->getMessage();
}