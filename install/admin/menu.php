<?php
use Bitrix\Main\Localization\Loc;
global $APPLICATION;
// if ($APPLICATION->GetGroupRight('example.vueadmin') < 'R') return false;
file_put_contents($_SERVER["DOCUMENT_ROOT"]."/menu_debug.log", "menu called\\n", FILE_APPEND);
Loc::loadMessages(__FILE__);
$text = Loc::getMessage("VUEADMIN_MENU_TEXT");
return [
  [
    "parent_menu" => "global_menu_services",
    "section" => "example_section",
    "sort" => 100,
    "text" => Loc::getMessage("VUEADMIN_MENU_TEXT"),
    "title" => Loc::getMessage("VUEADMIN_MENU_TITLE"),
    "url" => "vueadmin.php",
    "items_id" => "menu_vueadmin",
  ]
];
