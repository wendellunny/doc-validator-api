<?php

require __DIR__ 
. DIRECTORY_SEPARATOR 
. '..'
. DIRECTORY_SEPARATOR
. 'vendor'
. DIRECTORY_SEPARATOR
. 'autoload.php';

$app = new App\Bootstrap\Kernel();

$app->execute();