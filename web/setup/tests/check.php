<?php

require_once dirname(__FILE__).'/../../../app/SymfonyRequirements.php';
require_once dirname(__FILE__).'/../../../app/PartKeeprRequirements.php';

$partKeeprRequirements = new PartKeeprRequirements();
$iniPath = $partKeeprRequirements->getPhpIniConfigPath();

$errors = array();
$success = true;

foreach ($partKeeprRequirements->getRequirements() as $req) {
    /**
     * @var Requirement $req
     */
    if (!$req->isFulfilled()) {
        $success = false;
        $errors[] = "<b>".$req->getTestMessage()."</b><br/>".$req->getHelpHtml()."<br/>";
    }
}

if ($success === false) {
    $errors[] = "The php.ini file used: ".get_cfg_var("cfg_file_path");
    $errors[] = '<a target="_blank" href="https://wiki.partkeepr.org/wiki/KB00004:Symfony2 Requirements">Read more…</a>';
}
echo json_encode(array("success" => $success, "message" => "Symfony2 Requirements", "errors" => $errors));
