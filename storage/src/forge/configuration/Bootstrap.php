<?php

// Set para conexión en producción o servidor real
define('DB_ENGINE'    , $_ENV['DB_ENGINE']);
define('DB_HOST'      , $_ENV['DB_HOST']);
define('DB_NAME'      , $_ENV['DB_NAME']);
define('DB_USER'      , $_ENV['DB_USER']);
define('DB_PASS'      , $_ENV['DB_PASS']);
define('DB_CHARSET'   , $_ENV['DB_CHARSET']);