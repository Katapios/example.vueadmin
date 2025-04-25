<?php
define("PUBLIC_AJAX_MODE", true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Loader;

header('Content-Type: application/json');

if (!Loader::includeModule("crm")) {
    echo json_encode(["error" => "CRM module not loaded"]);
    return;
}

$result = [];

$entities = [
    'lead' => \CCrmLead::GetList([], [], ['ID', 'TITLE', 'DATE_CREATE']),
    'deal' => \CCrmDeal::GetList([], [], ['ID', 'TITLE', 'DATE_CREATE']),
    'contact' => \CCrmContact::GetList([], [], ['ID', 'NAME', 'DATE_CREATE']),
    'company' => \CCrmCompany::GetList([], [], ['ID', 'TITLE', 'DATE_CREATE']),
];

foreach ($entities as $type => $res) {
    while ($row = $res->Fetch()) {
        $result[] = [
            'created' => $row['DATE_CREATE'],
            'type' => ucfirst($type),
            'title' => $row['TITLE'] ?? $row['NAME'] ?? '(без названия)',
        ];
    }
}

echo json_encode($result);
