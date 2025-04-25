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
        ModuleManager::registerModule($this->MODULE_ID);

        // Копируем JS
        CopyDirFiles(__DIR__ . "/js", $_SERVER["DOCUMENT_ROOT"] . "/bitrix/js/" . $this->MODULE_ID, true, true);

        // Копируем admin-файлы и создаём обёртки
        $adminDir = $_SERVER["DOCUMENT_ROOT"] . "/bitrix/admin";
        foreach (glob(__DIR__ . "/admin/*.php") as $file) {
            $fileName = basename($file);
            CopyDirFiles($file, "$adminDir/{$this->MODULE_ID}_$fileName", true, true);
            file_put_contents("$adminDir/$fileName", "<?php require(\$_SERVER['DOCUMENT_ROOT'].'/local/modules/{$this->MODULE_ID}/install/admin/$fileName'); ?>");
        }

        // Обёртка меню
        file_put_contents(
            "$adminDir/{$this->MODULE_ID}_menu.php",
            "<?php require(\$_SERVER['DOCUMENT_ROOT'].'/local/modules/{$this->MODULE_ID}/install/admin/menu.php'); ?>"
        );
    }

    public function DoUninstall()
    {
        ModuleManager::unRegisterModule($this->MODULE_ID);

        $adminDir = $_SERVER["DOCUMENT_ROOT"] . "/bitrix/admin";
        foreach (glob(__DIR__ . "/admin/*.php") as $file) {
            $fileName = basename($file);
            @unlink("$adminDir/{$this->MODULE_ID}_$fileName");
            @unlink("$adminDir/$fileName");
        }
        @unlink("$adminDir/{$this->MODULE_ID}_menu.php");

        DeleteDirFilesEx("/bitrix/js/" . $this->MODULE_ID);
    }
}
