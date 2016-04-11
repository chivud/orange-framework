<?php

require '../vendor/autoload.php';

$installer = new Core\Services\Installer(new \Core\Database\PDOConnection(), new \Core\Controller\ViewRender());

$installer->execute();