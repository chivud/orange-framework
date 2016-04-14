<?php

require '../vendor/autoload.php';

$installer = new Core\Services\Installer(new \Core\Database\PDOConnection(), new \Core\Services\CodeGenerator());

if(!empty($_POST)){
    $installer->execute($_POST);
}else{
    $installer->index();
}
