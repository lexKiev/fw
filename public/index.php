<?php
require_once dirname(__DIR__) . '/config/init.php';
require_once LIBS.DS.'functions.php';

new \fw\App();

throw new Exception('Not Found', 500);