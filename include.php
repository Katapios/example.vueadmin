<?php
use Bitrix\Main\Loader;
Loader::registerAutoLoadClasses('example.vueadmin', [
    'Example\\Vueadmin\\Module' => 'lib/Module.php',
]);

use Bitrix\Main\EventManager;

EventManager::getInstance()->addEventHandler(
    "main",
    "OnBuildGlobalMenu",
    ["\\Example\\Vueadmin\\Menu", "addAdminMenu"]
);