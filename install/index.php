<?php
use Bitrix\Main\ModuleManager;

class example_vueadmin extends CModule
{
    public function __construct()
    {
        $arModuleVersion = [];
        include __DIR__ . '/version.php';

        $this->MODULE_ID = 'example.vueadmin';
        $this->MODULE_VERSION = $arModuleVersion['VERSION'];
        $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        $this->MODULE_NAME = 'Vue Admin Module';
        $this->MODULE_DESCRIPTION = 'Административный интерфейс с Vue 3';
    }

    public function DoInstall()
    {
        \Bitrix\Main\ModuleManager::registerModule($this->MODULE_ID);

        // Очистка дубликатов обработчиков
        UnRegisterModuleDependences(
            "main",
            "OnBuildGlobalMenu",
            $this->MODULE_ID,
            "Example\\Vueadmin\\Menu",
            "addAdminMenu"
        );

        // Регистрация обработчика меню
        RegisterModuleDependences(
            "main",
            "OnBuildGlobalMenu",
            $this->MODULE_ID,
            "Example\\Vueadmin\\Menu",
            "addAdminMenu"
        );

        // Копируем JS-файлы (из install/js/example.vueadmin → /bitrix/js/example.vueadmin)
        CopyDirFiles(
            __DIR__ . "/js/" . $this->MODULE_ID,
            $_SERVER["DOCUMENT_ROOT"] . "/bitrix/js/" . $this->MODULE_ID,
            true,
            true
        );

        // Копируем .php-файлы из install/admin/*.php
        $adminDir = $_SERVER["DOCUMENT_ROOT"] . "/bitrix/admin";
        foreach (glob(__DIR__ . "/admin/*.php") as $file) {
            $fileName = basename($file);

            // Копия с префиксом example.vueadmin_*
            CopyDirFiles($file, "$adminDir/{$this->MODULE_ID}_$fileName", true, true);

            // Обёртка без префикса
            file_put_contents(
                "$adminDir/$fileName",
                "<?php require(\$_SERVER['DOCUMENT_ROOT'].'/local/modules/{$this->MODULE_ID}/install/admin/$fileName'); ?>"
            );
        }

        // Копируем ajax обработчик (реальный backend-файл)
        CopyDirFiles(
            __DIR__ . "/admin/ajax/crm_entities.php",
            "$adminDir/{$this->MODULE_ID}_ajax_crm_entities.php",
            true,
            true
        );

        // Создаём основную ajax-обёртку для Vue-приложения
        file_put_contents(
            "$adminDir/ajax_crm_entities.php",
            "<?php require(\$_SERVER['DOCUMENT_ROOT'].'/local/modules/{$this->MODULE_ID}/install/admin/ajax/crm_entities.php'); ?>"
        );
    }


    public function DoUninstall()
    {
        // Удаление обработчика меню
        UnRegisterModuleDependences(
            "main",
            "OnBuildGlobalMenu",
            $this->MODULE_ID,
            "Example\\Vueadmin\\Menu",
            "addAdminMenu"
        );

        // Снятие регистрации модуля
        \Bitrix\Main\ModuleManager::unRegisterModule($this->MODULE_ID);

        $adminDir = $_SERVER["DOCUMENT_ROOT"] . "/bitrix/admin";

        // Удаляем admin-файлы модуля (и обёртки)
        foreach (glob(__DIR__ . "/admin/*.php") as $file) {
            $fileName = basename($file);

            // Префиксированный файл
            @unlink("$adminDir/{$this->MODULE_ID}_$fileName");

            // Обёртка без префикса (vueadmin.php)
            @unlink("$adminDir/$fileName");
        }

        // Удаляем ajax-обёртку
        @unlink("$adminDir/ajax_crm_entities.php");

        // Удаляем ajax-файл с префиксом (если копировался)
        @unlink("$adminDir/{$this->MODULE_ID}_ajax_crm_entities.php");

        // Удаляем JS-бандлы
        DeleteDirFilesEx("/bitrix/js/" . $this->MODULE_ID);
    }

}
