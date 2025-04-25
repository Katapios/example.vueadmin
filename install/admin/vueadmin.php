<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_admin_before.php');
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
$APPLICATION->SetTitle(Loc::getMessage('VUEADMIN_TITLE'));
?><div id="vueapp"></div>
<link rel="stylesheet" href="/bitrix/js/example.vueadmin/app.bundle.css">
<script src="/bitrix/js/example.vueadmin/app.bundle.js"></script>
<?php require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/epilog_admin.php'); ?>