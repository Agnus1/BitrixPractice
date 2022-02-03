<?php

function dump($var) {
  echo '<pre>';
  var_dump($var);
  echo '</pre>';
}

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/local/php_interface/include/constants.php")) {
    require_once($_SERVER['DOCUMENT_ROOT'] . "/local/php_interface/include/constants.php");
}

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/local/php_interface/include/event_handlers.php")) {
    require_once($_SERVER['DOCUMENT_ROOT'] . "/local/php_interface/include/event_handlers.php");
}