<?php
namespace Example\Vueadmin;

use Bitrix\Main\EventManager;

class Module
{
    public static function init()
    {
        EventManager::getInstance()->addEventHandler(
            "main",
            "OnBuildGlobalMenu",
            [__CLASS__, "onBuildGlobalMenu"]
        );
    }

    public static function onBuildGlobalMenu(&$aGlobalMenu, &$aModuleMenu)
    {
        \Bitrix\Main\Localization\Loc::loadMessages(__FILE__);

        $aModuleMenu[] = [
            "parent_menu" => "global_menu_services",
            "section" => "example_vueadmin",
            "sort" => 100,
            "text" => "CRM Vue",
            "title" => "CRM Vue",
            "url" => "vueadmin.php",
            "icon" => "default_menu_icon",
            "page_icon" => "default_page_icon",
            "items_id" => "menu_example_vueadmin",
            "items" => []
        ];

        \Bitrix\Main\Diag\Debug::writeToFile("Menu handler triggered", "CRM Vue", "/vueadmin_debug.log");
    }
}
