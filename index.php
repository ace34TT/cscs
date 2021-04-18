<?php
// index.php
// On charge les modeles et les controleurs

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(dirname(__FILE__) . '/Inc/Controller/Personnal_information_Controller.php');

// gestion des routes
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$route = "/cscs/";

if ($route == $uri) {
  include('Pages/Frontend/index.php');
} else {
  header('Status: 404 Not Found');
  echo '<html><body><h1>Page Not Found</h1></body></html>';
}
