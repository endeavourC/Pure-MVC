<?php
require_once('config/config.php');
spl_autoload_register('autoload');
function autoload($className){
    require('libs/'.$className.'.php');
}


$app = new App();