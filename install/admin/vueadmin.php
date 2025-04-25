<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_admin_before.php');

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;

// подключаем модуль (необязательно, но безопасно)
Loader::includeModule('example.vueadmin');

// загружаем языковые файлы
Loc::loadMessages(__FILE__);

// заголовок страницы
$APPLICATION->SetTitle(Loc::getMessage('VUEADMIN_TITLE') ?: 'CRM Vue');

// вывод контента Vue-приложения
?>
<div id="vueapp"></div>

<!-- Стили Vue (если есть) -->
<link rel="stylesheet" href="/bitrix/js/example.vueadmin/app.bundle.css">

<!-- Скрипт Vue -->
<script src="/bitrix/js/example.vueadmin/app.bundle.js"></script>

<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_admin.php');
