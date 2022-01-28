<?php

function dump($var) {
  echo '<pre>';
  var_dump($var);
  echo '</pre>';
}

// Путь к кратинке-заглушке
define("NO_IMAGE_PATH", SITE_DIR . 'images/no_photo.png');

// Путь к default-ассетам для шаблонов страниц
define("DEFAULT_ASSETS_PATH", SITE_DIR . 'local/templates/.default/assets');