<?php
use Bitrix\Main\Loader;

Loader::registerAutoLoadClasses('example.vueadmin', [
    'Example\\Vueadmin\\Menu' => 'lib/menu.php',
]);