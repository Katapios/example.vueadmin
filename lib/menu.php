<?php

namespace Example\Vueadmin;

use Bitrix\Main\Localization\Loc;

class Menu
{
    public static function addAdminMenu(&$aGlobalMenu, &$aModuleMenu)
    {
        global $APPLICATION;

        if (!is_object($APPLICATION) || $APPLICATION->GetGroupRight("example.vueadmin") < "R") {
            return;
        }

        $aModuleMenu[] = [
            "parent_menu" => "global_menu_services",
            "section"     => "example_vueadmin",
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
