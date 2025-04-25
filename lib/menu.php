<?php
namespace Example\Vueadmin;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Diag\Debug;


Loc::loadMessages(__FILE__);

class Menu
{
    public static function addAdminMenu(&$aGlobalMenu, &$aModuleMenu)
    {
        Debug::writeToFile(
            "addAdminMenu called",
            "VueAdmin Menu Handler",
            "/vueadmin_debug.log"
        );
        global $USER, $APPLICATION;

                if ($APPLICATION->GetGroupRight("example.vueadmin") < "R") {
            Debug::writeToFile(
                "Access denied",
                "VueAdmin Menu Handler",
                "/vueadmin_debug.log"
            );
            return;
        }

        Debug::writeToFile(
            "Access granted, adding menu",
            "VueAdmin Menu Handler",
            "/vueadmin_debug.log"
        );

        // if ($APPLICATION->GetGroupRight("example.vueadmin") < "R") {
        //     return;
        // }

        $aModuleMenu[] = [
            "parent_menu" => "global_menu_services",
            "section" => "example_vueadmin",
            "sort"        => 100,
            "text"        => Loc::getMessage("VUEADMIN_MENU_TEXT"),
            "title"       => Loc::getMessage("VUEADMIN_MENU_TITLE"),
            "url"         => "vueadmin.php",
            "icon"        => "default_menu_icon",
            "page_icon"   => "default_page_icon",
            "items_id"    => "menu_example_vueadmin",
            "items"       => []
        ];
    }
}
