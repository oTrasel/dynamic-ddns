<?php

require '../vendor/autoload.php';

use Dotenv\Dotenv;

use App\Services\GetDDNS;
use App\Services\UpdateDDNS;
use App\Services\VerifyIp;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$verificaIp = new VerifyIp();
$verificaIp->verificaIp();
$isNovoIp = $verificaIp->isNovoIp();

if ($isNovoIp) {
    $apiKey = $_ENV['API_KEY'];

    $ddns = new GetDDNS($apiKey);
    $ddns->request();

    $updateDns = new UpdateDDNS($ddns);
    $novoIp = $verificaIp->getIpv4Address();
    $updateDns->setIpv4Address($novoIp);
    $updateDns->update();
}
